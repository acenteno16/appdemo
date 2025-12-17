<? 

include("session-bankingDebt.php");  

#if($_SESSION['email'] == 'jairovargasg@gmail.com'){

$today = date('Y-m-d');
$totime = date('H:i:s');

$id = $_GET['id'];
$sOption = 3;
$reason = $_GET['reason'];

#regresar/anular
if($reason == ''){
	exit('<script>alert("Debe de ingresar un motivo de anulacion de documentacion.");history.go(-1);</script>');
}
if(strlen($reason) < 10){
	exit('<script>alert("Debe de ingresar una motivo de anulacion mayor a 10 caracteres.");history.go(-1);</script>');
}

#Leemos el desembolso
$queryBankingDebt = "select * from bankingDebt where id = '$id'";
$resultBankingDebt = mysqli_query($con, $queryBankingDebt);
$rowBankingDebt = mysqli_fetch_array($resultBankingDebt);

$contract = $rowBankingDebt['contract'];

#Leemos el contrato
$queryContract = "select * from bankingDebtContracts where id = '$contract'";
$resultContract = mysqli_query($con, $queryContract);
$rowContract = mysqli_fetch_array($resultContract);

#leemos todas las transacciones del desembolso
$queryBankingDebtTransactions = "select * from bankingDebtTransactions where bankingDebt = '$id'";
$resultBankingDebtTransactions = mysqli_query($con, $queryBankingDebtTransactions);
while($rowBankingDebtTransactions=mysqli_fetch_array($resultBankingDebtTransactions)){
    
    $idTransaction = $rowBankingDebtTransactions['id'];
    
    #Anulamos la transaccion
	$queryUpdateTransaction = "update bankingDebtTransactions set void='1', reason='$reason' where id = '$rowBankingDebtTransactions[id]'";
	$resultUpdateTransaction = mysqli_query($con, $queryUpdateTransaction );
    
    #Leemos el balance del contrato
	$queryContractBalance = "select balance from bankingDebtContractBalance where bankingDebtContract = '$contract' order by id desc limit 1";
	$resultContractBalance = mysqli_query($con, $queryContractBalance);
	$rowContractBalance = mysqli_fetch_array($resultContractBalance);
	$theContractBalance = $rowContractBalance['balance'];
    
    #En caso de que sea un pago hijo validamos que el balance del pago madre cubra el desembolso.
    if($rowContract['parent'] > 0){
    
        #Leemos el balance del contrato madre
        $queryContractParentBalance = "select balance from bankingDebtContractBalance where bankingDebtContract = '$rowContract[parent]' order by id desc limit 1";
        $resultContractParentBalance = mysqli_query($con, $queryContractParentBalance);
        $rowContractParentBalance = mysqli_fetch_array($resultContractParentBalance);
        $theContractParentBalance = $rowContractParentBalance['balance'];
    
    }
    
    $ttype = 0;
    $newStatus = '9';
	$comments = "La transaccion #$idTransaction ha sido anulada.";
    
    $newContractBalance = $theContractBalance+$rowBankingDebtTransactions['amount'];
    if($rowContract['parent'] > 0){
        $newContractParentBalance = $theContractParentBalance+$rowBankingDebtTransactions['amount'];
    }
    
    #Guardamos el balance actual del contrato
	$queryBalanceSave = "insert into bankingDebtContractBalance (today, totime, bankingDebtContract, userid, type, bdtype, transaction, amount, balance) values ('$today', '$totime', '$contract', '$_SESSION[userid]', '$ttype', '0', '$idTransaction', '$rowThisFund[amount]', '$newContractBalance')"; 
	$resultBalanceSave = mysqli_query($con, $queryBalanceSave);
    
    #if Subcupo
    if($rowContract['parent'] > 0){

        #Guardamos el balance actual del contrato
        $queryBalanceSave = "insert into bankingDebtContractBalance (today, totime, bankingDebtContract, bankingDebtContractChild, userid, type, transaction, amount, balance) values ('$today', '$totime', '$rowContract[parent]', '$contract', '$_SESSION[userid]', '$ttype', '$tid', '$amount', '$newContractParentBalance')";
        $resultBalanceSave = mysqli_query($con, $queryBalanceSave);
    
    }
	
    
} #End While 

$queryUpdate = "update bankingDebt set status2='$newStatus' where id = '$id'";
$resultUpdate = mysqli_query($con, $queryUpdate);

$queryTimes = "insert into bankingDebtTimes (bankingDebt, today, totime, userid, stage, comments) values ('$id', '$today', '$totime', '$_SESSION[userid]', '$newStatus', '$comments')";
$resultTimes = mysqli_query($con, $queryTimes); 
    
#}

header('location: bankingDebt.php'); 

?>