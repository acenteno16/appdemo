<? 

include("session-bankingDebtAdmin.php");  

$today = date('Y-m-d');
$totime = date('H:i:s');

$id = $_POST['id'];
$type = $_POST['type'];
$isNew = $_POST['isNew'];
$title = $_POST['title'];
$company = $_POST['company'];
if(($company == '') or ($company == '0') or ($company == null)){
	exit('<script>alert("Seleccione una compañia. (Code)");history.go(-1);</script>');
}
$bank = $_POST['bank'];
$amount = $_POST['amount'];
$currency = $_POST['currency'];
$date1 = $_POST['date1'];
if($date1 != ''){
	$date1 = date("Y-m-d", strtotime($_POST['date1']));
}
$date2 = $_POST['date2'];
if($date2 != ''){
	$date2 = date("Y-m-d", strtotime($_POST['date2']));
}
$number = $_POST['number'];
$billUrl = $_POST['billUrl'];
$parent = $_POST['parent'];

$query = "select amount from bankingDebtContracts where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$queryUpdate = "update bankingDebtContracts set type='$type', title='$title', company='$company', bank='$bank', amount='$amount', currency='$currency', date1='$date1', date2='$date2', number='$number', contract='$billUrl', parent='$parent' where id = '$id'"; 
$resultUpdate = mysqli_query($con, $queryUpdate);

if($row['amount'] != $amount){

    #leemos el balance
    $queryBalance = "select balance from bankingDebtContractBalance where bankingDebtContract = '$id' order by id desc limit 1";
    $resultBalance = mysqli_query($con, $queryBalance);
    $rowBalance = mysqli_fetch_array($resultBalance);

    #hacemos el debito del balance
    $queryBalanceSave = "insert into bankingDebtContractBalance (today, totime, bankingDebtContract, userid, type, transaction, currency, amount, balance) values ('$today', '$totime', '$id', '$_SESSION[userid]', '1', '$tid', '$currency', '$rowBalance[balance]', '0')";
    $resultBalanceSave = mysqli_query($con, $queryBalanceSave);

    $totime = date('H:i:s');

    #hacemos el credito del balance
    $queryBalanceSave = "insert into bankingDebtContractBalance (today, totime, bankingDebtContract, userid, type, transaction, currency, amount, balance) values ('$today', '$totime', '$id', '$_SESSION[userid]', '0', '$tid', '$currency', '$amount', '$amount')";
    $resultBalanceSave = mysqli_query($con, $queryBalanceSave);
    
    #parent#parent#parent#parent#parent#parent#
    #                    #                    #
    #parent#parent#parent#parent#parent#parent#
    #                    #                    #
    #parent#parent#parent#parent#parent#parent#
    
    #leemos el balance
    $queryParentBalance = "select balance from bankingDebtContractParentBalance where bankingDebtContract = '$id' order by id desc limit 1";
    $resultParentBalance = mysqli_query($con, $queryParentBalance);
    $rowParentBalance = mysqli_fetch_array($resultParentBalance);

    #hacemos el debito del balance
    $queryParentBalanceSave = "insert into bankingDebtContractParentBalance (today, totime, bankingDebtContract, userid, type, transaction, currency, amount, balance) values ('$today', '$totime', '$id', '$_SESSION[userid]', '1', '$tid', '$currency', '$rowParentBalance[balance]', '0')";
    $resultParentBalanceSave = mysqli_query($con, $queryParentBalanceSave);

    $totime = date('H:i:s');

    #hacemos el credito del balance
    $queryParentBalanceSave = "insert into bankingDebtContractParentBalance (today, totime, bankingDebtContract, userid, type, transaction, currency, amount, balance) values ('$today', '$totime', '$id', '$_SESSION[userid]', '0', '$tid', '$currency', '$amount', '$amount')";
    $resultParentBalanceSave = mysqli_query($con, $queryParentBalanceSave);

}

header("location: bankingDebtContractView.php?id=$id"); 

?>