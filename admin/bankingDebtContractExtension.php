<? 

include("session-bankingDebtAdmin.php"); 

$today = date('Y-m-d');
$totime = date('H:i:s');

$id = $_POST['id'];
$amount = $_POST['amount'];
$date2 = $_POST['date2'];
$comments = $_POST['comments'];

$query = "select amount, date2 from bankingDebtContracts where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if(($date2 == '') and (($amount == 0) or ($amount == '') or ($amount == 'NULL') or ($amount == ' '))){
    exit('<script>alert("La extencion debe de contener un monto o una fecha.");history.go(-1);</script>');
}
    
    
if($date2 != ''){
    
	$date2 = date("Y-m-d", strtotime($_POST['date2']));

    $queryUpdate = "update bankingDebtContracts set date2='$date2' where id = '$id'"; 
    $resultUpdate = mysqli_query($con, $queryUpdate);
    
}

if(($amount > 0) or ($amount < 0)){
    
    if(($amount > 0)){
        $ttype = 0;
    }
    if(($amount < 0)){
        $ttype = 1;
    }

    #leemos el balance
    $queryBalance = "select balance from bankingDebtContractBalance where bankingDebtContract = '$id' order by id desc limit 1";
    $resultBalance = mysqli_query($con, $queryBalance);
    $rowBalance = mysqli_fetch_array($resultBalance);

    $balance = $rowBalance['balance'];
    $newBalance = $balance+$amount;

    #hacemos el credito del balance
    $queryBalanceSave = "insert into bankingDebtContractBalance (today, totime, bankingDebtContract, userid, type, transaction, currency, amount, balance) values ('$today', '$totime', '$id', '$_SESSION[userid]', '$ttype', '$tid', '$currency', '$amount', '$newBalance')";
    $resultBalanceSave = mysqli_query($con, $queryBalanceSave); 
    
    #parentBalance
    
    #parent
    
    #parent
        
    
    #leemos el balance
    $queryBalanceParent = "select balance from bankingDebtContractParentBalance where bankingDebtContract = '$id' order by id desc limit 1";
    $resultBalanceParent = mysqli_query($con, $queryBalanceParent);
    $rowBalanceParent = mysqli_fetch_array($resultBalanceParent);

    $balanceParent = $rowBalanceParent['balance'];
    $newBalanceParent = $balanceParent+$amount;

    #hacemos el credito del balance
    $queryBalanceParentSave = "insert into bankingDebtContractParentBalance (today, totime, bankingDebtContract, userid, type, transaction, currency, amount, balance) values ('$today', '$totime', '$id', '$_SESSION[userid]', '$ttype', '$tid', '$currency', '$amount', '$newBalanceParent')"; 
    $resultBalanceParentSave = mysqli_query($con, $queryBalanceParentSave);
    
}

$queryUpdate = "insert into bankingDebtContractExtensions (today, totime, userid, bankingDebtContract, comments) values ('$today', '$totime', '$_SESSION[userid]', '$id', '$comments')"; 
$resultUpdate = mysqli_query($con, $queryUpdate);
$idUpdate = mysqli_insert_id($con); 

if(($amount > 0) or ($amount < 0)){
    
    $newAmount = $row['amount']+$amount;
    $queryUpdate = "update bankingDebtContracts set amount='$newAmount' where id = '$id'"; 
    $resultUpdate = mysqli_query($con, $queryUpdate);
    
    
    $queryUpdate2 = "update bankingDebtContractExtensions set amountold='$row[amount]', amount='$amount' where id = '$idUpdate'"; 
    $resultUpdate2 = mysqli_query($con, $queryUpdate2);
}
if($date2 != ''){
    $queryUpdate3 = "update bankingDebtContractExtensions  set date2old='$row[date2]', date2='$date2' where id = '$idUpdate'"; 
    $resultUpdate3 = mysqli_query($con, $queryUpdate3);
}

header('location: '.$_SERVER['HTTP_REFERER']); 

?>