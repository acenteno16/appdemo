<? 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include('session-bankingDebtAdmin.php');

$today = date('Y-m-d');
$totime = date('H:i:s');

$id = $_POST['id'];
$type = $_POST['type'];
#type catalog 1: Abono 2: Pago de interes 3: Cancelacion

$amount = $_POST['damount'];
if($amount == ''){
	$amount = 0;
}
$interest = $_POST['dinterest'];
if($interest == ''){
	$interest = '0';
}
$amortization = $_POST['amortization'];
$bankingmovement = $_POST['bankingmovement'];
$reference = $_POST['reference'];

$date2 = $_POST['date2'];
if($date2 != ''){
	$date2 = date("Y-m-d", strtotime($_POST['date2']));
}
$dateBank = $_POST['dateBank'];
if($dateBank != ''){
	$dateBank = date("Y-m-d", strtotime($_POST['dateBank']));
}

$amortizationUrl = $_POST['amortizationUrl'];
$bankingmovementUrl = $_POST['bankingmovementUrl'];

#Leemos el desembolso
$query = "select * from bankingDebt where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$contract = $row['contract'];
$bdType = $row['type'];

$queryContract = "select * from bankingDebtContracts where id = '$row[contract]'";
$resultContract = mysqli_query($con, $queryContract);
$rowContract = mysqli_fetch_array($resultContract);

#var revolvente para saber si hay que actualizar el contrato
$queryBdType = "select revolving from bankingDebtContractTypes where id = '$bdType'";
$resultBdType = mysqli_query($con, $queryBdType);
$rowBdType = mysqli_fetch_array($resultBdType);

$queryTransaction = "insert into bankingDebtTransactions (bankingDebt, type, interest, amount, userid, amortization, bankingmovement, proforma, swift1, swift2, swift3, commission, letter, reference, dateBank) values ('$id', '$type', '$interest', '$amount', '$_SESSION[userid]', '$amortizationUrl', '$bankingmovementUrl', '$proformaUrl', '$swift1Url', '$swift2Url', '$swift3Url', '$commissionUrl', '$letterUrl', '$reference', '$dateBank')";
$resultTransaction = mysqli_query($con, $queryTransaction);
$tid = mysqli_insert_id($con);

#Balance del Desembolso (Al desembolso hay que irle restando los abonos)
$queryBalance = "select balance from bankingDebtBalance where bankingDebt = '$id' order by id desc limit 1";
$resultBalance = mysqli_query($con, $queryBalance);
$rowBalance = mysqli_fetch_array($resultBalance);
$theBalance = $rowBalance['balance'];
$newBalance = $theBalance-$amount;

#Save new balance
$queryBalanceSave = "insert into bankingDebtBalance (today, totime, bankingDebt, userid, type, transaction, interest, amount, balance) values ('$today', '$totime', '$id', '$_SESSION[userid]', '1', '$tid', '$interest', '$amount', '$newBalance')";
$resultBalanceSave = mysqli_query($con, $queryBalanceSave);

$query = "update bankingDebt set status2 = '1.10', date2='$date2' where id = '$id'"; 
$result = mysqli_query($con, $query);

#Tiempo del desembolso
$tComments = "El desembolso ha sido documentado";
$queryTimes = "insert into bankingDebtTimes (bankingDebt, today, totime, userid, stage, comments) values ('$id', '$today', '$totime', '$_SESSION[userid]', '2', '$tComments')";
$resultTimes = mysqli_query($con, $queryTimes); 


###        CONTRATO          ###

if(($amount > 0) and ($rowBdType['revolving'] == 1)){

	#Leemos el balance del contrato
	$queryContractBalance = "select balance from bankingDebtContractBalance where bankingDebtContract = '$contract' order by id desc limit 1";
	$resultContractBalance = mysqli_query($con, $queryContractBalance);
	$rowContractBalance = mysqli_fetch_array($resultContractBalance);
	$theContractBalance = $rowContractBalance['balance'];
	$newContractBalance = $theContractBalance+$amount;

	#Guardamos el balance actual del contrato
	$queryBalanceSave = "insert into bankingDebtContractBalance (today, totime, bankingDebtContract, userid, type, bdtype, transaction, amount, balance) values ('$today', '$totime', '$contract', '$_SESSION[userid]', '0', '0', '$tid', '$amount', '$newContractBalance')"; 
	$resultBalanceSave = mysqli_query($con, $queryBalanceSave);
	
}

if(($rowContract['parent'] > 0) and ($amount > 0) and ($rowBdType['revolving'] == 1)){
    
    #Leemos el balance del contrato madre
    $queryContractParentBalance = "select balance from bankingDebtContractBalance where bankingDebtContract = '$rowContract[parent]' order by id desc limit 1";
    $resultContractParentBalance = mysqli_query($con, $queryContractParentBalance);
    $rowContractParentBalance = mysqli_fetch_array($resultContractParentBalance);
    $theContractParentBalance = $rowContractParentBalance['balance']+$amount;
    
    #Guardamos el balance actual del contrato
	$queryBalanceSave = "insert into bankingDebtContractBalance (today, totime, bankingDebtContract, userid, type, bdtype, transaction, amount, balance) values ('$today', '$totime', '$rowContract[parent]', '$_SESSION[userid]', '0', '0', '$tid', '$amount', '$theContractParentBalance')"; 
	$resultBalanceSave = mysqli_query($con, $queryBalanceSave);
    
}

###         END CONTRATO      ###

header('location: bankingDebt.php');

?>