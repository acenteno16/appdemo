<? 

include('session-bankingDebtAdmin.php');

$uid = $_POST['uid'];
$queryCheck = "select * from bankingDebtContracts where uid = '$uid'";
$resultCheck = mysqli_query($con, $queryCheck);
$numCheck = mysqli_num_rows($resultCheck);
if($numCheck > 0){
	exit('<script>window.location="bankingDebtContracts.php";</script>');
}

$today = date('Y-m-d');
$totime = date('H:i:s');

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

if($parent > 0){
	$queryParent = "select * from bankingDebtContracts where id = '$parent'";
	$resultParent = mysqli_query($con, $queryParent);
	$rowParent = mysqli_fetch_array($resultParent);
	
	if($rowParent['bank'] != $bank){
		exit('<script>alert("No coincide el banco con el prestamo mandre. (Code)");history.go(-1);</script>');
	}
	if($rowParent['currency'] != $currency){
		exit('<script>alert("No coincide la moneda con el prestamo mandre. (Code)");history.go(-1);</script>');
	}
    
    $queryParentBalance = "select * from bankingDebtContractParentBalance where bankingDebtContract = '$parent' order by id desc limit 1";
	$resultParentBalance = mysqli_query($con, $queryParentBalance);
	$rowParentBalance = mysqli_fetch_array($resultParentBalance);
    
    if($amount > $rowParentBalance['balance']){
        #exit('<script>alert("El monto excede el disponible del balance madre. (Code)");history.go(-1);</script>');
    } 
	
}

$queryInsert = "insert into bankingDebtContracts (uid, today, totime, userid) values ('$uid', '$today', '$totime', '$_SESSION[userid]')";
$resultInsert = mysqli_query($con, $queryInsert); 
$id = mysqli_insert_id($con);

$queryUpdate = "update bankingDebtContracts set type='$type', company='$company', bank='$bank', number='$number', amount='$amount', currency='$currency', date1='$date1', date2='$date2', isNew='$isNew', contract='$billUrl', title='$title', parent='$parent' where id = '$id'";
$resultUpdate = mysqli_query($con, $queryUpdate);

#Update Balance
$queryBalanceSave = "insert into bankingDebtContractBalance (today, totime, bankingDebtContract, userid, type, transaction, currency, amount, balance) values ('$today', '$totime', '$id', '$_SESSION[userid]', '0', '$tid', '$currency', '$amount', '$amount')";
$resultBalanceSave = mysqli_query($con, $queryBalanceSave);

if($parent > 0){
    
    $newParentBalance = $rowParentBalance['balance']-$amount;
   
    #Update Parent Balance
    $queryBalanceSave = "insert into bankingDebtContractParentBalance (today, totime, bankingDebtContract, userid, type, transaction, currency, amount, balance) values ('$today', '$totime', '$parent', '$_SESSION[userid]', '1', '$tid', '$currency', '$amount', '$newParentBalance')";
    $resultBalanceSave = mysqli_query($con, $queryBalanceSave);
      
}
else{
    
    #Update Parent Balance
    $queryBalanceSave = "insert into bankingDebtContractParentBalance (today, totime, bankingDebtContract, userid, type, transaction, currency, amount, balance) values ('$today', '$totime', '$id', '$_SESSION[userid]', '0', '$tid', '$currency', '$amount', '$amount')";
    $resultBalanceSave = mysqli_query($con, $queryBalanceSave);
    
}

header('location: bankingDebtContracts.php');

?>