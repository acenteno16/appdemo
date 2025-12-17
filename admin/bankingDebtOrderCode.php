<? 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require('session-bankingDebtAdmin.php');
require('functions.php');

$uid = isset($_POST['uid']) ? $_POST['uid'] : 0;

$queryCheck = "select * from bankingDebt where uid = '$uid'";
$resultCheck = mysqli_query($con, $queryCheck);
$numCheck = mysqli_num_rows($resultCheck);
if($numCheck > 0){
	exit('<script>window.location="bankingDebt.php";</script>');
}
$today = date('Y-m-d');
$totime = date('H:i:s');

$isNew = $_POST['isNew'];
$contract = $_POST['contract'];

if($contract == 0){
	exit('<script>alert("CODE: Debe de seleccionar un contrato.");history.go(-1);</script>');
}
###############
$date1 = $_POST['date1'];
if($date1 != ''){
	$date1 = date("Y-m-d", strtotime($_POST['date1']));
}
$number = $_POST['number'];


$queryContract = "select * from bankingDebtContracts where id = '$contract'";
$resultContract = mysqli_query($con, $queryContract);
$rowContract = mysqli_fetch_array($resultContract);

$type = $rowContract['type'];
#Type = tipo de contrato (arrastra el tipo de desembolso del tipo de contrato)

if($type == 4){
	#Si el contrato es mixto, entoces el tipo de contrarto lo cogemos del selector del formulario.
	$type = $_POST['type'];
}

$date1 = $rowContract['date1'];

##############
$amount = $_POST['amount'];
$date2 = $_POST['date2'];
if($date2 != ''){
	$date2 = date("Y-m-d", strtotime($_POST['date2']));
}

$reference = $_POST['reference'];
$billUrl = $_POST['billUrl'];
$promissoryUrl = $_POST['promissoryUrl'];
$amortizationUrl = $_POST['amortizationUrl'];
$bankingmovementUrl = $_POST['bankingmovementUrl'];
$proformaUrl = $_POST['proformaUrl'];
$swift1Url = $_POST['swift1Url'];
$swift2Url = $_POST['swift2Url'];
$swift3Url = $_POST['swift3Url'];
$commissionUrl = $_POST['commissionUrl'];
$letterUrl = $_POST['letterUrl'];
$provider = $_POST['provider'];
$unit = $_POST['route'];
$bills = $_POST['nofileUrl'];

#CONTRATO
#Leemos el balance del contrato
$queryContractBalance = "select balance from bankingDebtContractBalance where bankingDebtContract = '$contract' order by id desc limit 1";
$resultContractBalance = mysqli_query($con, $queryContractBalance);
$rowContractBalance = mysqli_fetch_array($resultContractBalance);
$theContractBalance = $rowContractBalance['balance'];
$newContractBalance = $theContractBalance-$amount;

if($amount > $theContractBalance){
    exit('<script>alert("CODE: El monto exede el balance disponible.");history.go(-1);</script>');
}

#En caso de que sea un pago hijo validamos que el balance del pago madre cubra el desembolso.
if($rowContract['parent'] > 0){
    
    #Leemos el balance del contrato madre
    $queryContractParentBalance = "select balance from bankingDebtContractBalance where bankingDebtContract = '$rowContract[parent]' order by id desc limit 1";
    $resultContractParentBalance = mysqli_query($con, $queryContractParentBalance);
    $rowContractParentBalance = mysqli_fetch_array($resultContractParentBalance);
    $theContractParentBalance = $rowContractParentBalance['balance'];
    #$newContractParentBalance = $theContractParentBalance-$amount;
    
    if($amount > $theContractParentBalance){
        exit('<script>alert("CODE: El monto exede el balance disponible del pago madre.");history.go(-1);</script>');
    }
    
}

$queryInsert = "insert into bankingDebt (uid, today, totime, userid) values ('$uid', '$today', '$totime', '$_SESSION[userid]')";
$resultInsert = mysqli_query($con, $queryInsert);
$id = mysqli_insert_id($con);

$queryTransaction = "insert into bankingDebtTransactions (bankingDebt, type, amount, userid, amortization, bankingmovement, proforma, swift1, swift2, swift3, commission, letter, reference, bill, promissory, unit, provider) values ('$id', '0', '$amount', '$_SESSION[userid]', '$amortizationUrl', '$bankingmovementUrl', '$proformaUrl', '$swift1Url', '$swift2Url', '$swift3Url', '$commissionUrl', '$letterUrl', '$reference', '$billUrl', '$promissoryUrl', '$unit', '$provider')";
$resultTransaction = mysqli_query($con, $queryTransaction);
$tid = mysqli_insert_id($con);

for($i=0;$i<sizeof($bills);$i++){
    $queryBills = "insert into bankingDebtBills (bankingDebt, transaction, url) values ('$id', '$tid', '$bills[$i]')";
	$resultBills = mysqli_query($con, $queryBills);
}

#Los desembolsos denen de entrar pendientes de contabiliza
$status2 = 1;
#si es una carta de credito entra contabilizada
if($type == 3){
	$status2 = 2;
}
if($isNew == 1){
	$status2 = 2;
}

#Actualizamos el desembolso
$queryUpdate = "update bankingDebt set type='$type', contract = '$contract', amount = '$amount', date1 = '$date1', date2='$date2', status2='$status2', isNew='$isNew', number='$number' where id = '$id'";
$resultUpdate = mysqli_query($con, $queryUpdate);

#grabamos el balance del desembolso
$queryBalanceSave = "insert into bankingDebtBalance (today, totime, bankingDebt, userid, type, transaction, amount, balance) values ('$today', '$totime', '$id', '$_SESSION[userid]', '0', '$tid', '$amount', '$amount')";
$resultBalanceSave = mysqli_query($con, $queryBalanceSave);

#Tiempo del desembolso
$tComments = "El desembolso ha sido agregado y documentado";
$queryTimes = "insert into bankingDebtTimes (bankingDebt, today, totime, userid, stage, comments) values ('$id', '$today', '$totime', '$_SESSION[userid]', '1', '$tComments')";
$resultTimes = mysqli_query($con, $queryTimes); 

#Guardamos el balance actual del contrato
$queryBalanceSave = "insert into bankingDebtContractBalance (today, totime, bankingDebtContract, userid, type, transaction, amount, balance) values ('$today', '$totime', '$contract', '$_SESSION[userid]', '1', '$tid', '$amount', '$newContractBalance')";
$resultBalanceSave = mysqli_query($con, $queryBalanceSave);

#if Subcupo
if($rowContract['parent'] > 0){
    
    
    $newContractBalance2 = $theContractParentBalance-$amount;

    #Guardamos el balance actual del contrato
    $queryBalanceSave = "insert into bankingDebtContractBalance (today, totime, bankingDebtContract, bankingDebtContractChild, userid, type, transaction, amount, balance) values ('$today', '$totime', '$rowContract[parent]', '$contract', '$_SESSION[userid]', '1', '$tid', '$amount', '$newContractBalance2')";
    $resultBalanceSave = mysqli_query($con, $queryBalanceSave);
    
    # 
    
}

header('location: bankingDebt.php');

?>