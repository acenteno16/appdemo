<?php  

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL); 

include("session-provision.php");
include("functions.php");

$id = $_POST['id']; 
$amount = $_POST['commissionamount'];
if($amount > 0){
    
}else{
    exit('<script>alert("El valor de la comision bancaria debe de ser positivo."); history.go(-1);</script>');
}
$comments = $_POST['commissioncomments']; 

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$commissionsAmount = 0;

//GET commissions info
$queryCommissions = "select * from refundCommissions where payment = '$id'";
$resultCommissions = mysqli_query($con, $queryCommissions);
while($rowCommissions = mysqli_fetch_array($resultCommissions)){
	$commissionsAmount+= $rowCommissions['amount'];
}

$queryPayment = "select * from payments where id = '$id'";
$resultPayment = mysqli_query($con, $queryPayment);
$rowPayment = mysqli_fetch_array($resultPayment);
$newPayment = $rowPayment['payment']+$commissionsAmount;

echo $queryUpdate = "update payments set payment = '$newPayment', refundCommission='0' where id = '$id'";
$resultUpdate = mysqli_query($con, $queryUpdate);

$query = "insert into refundCommissions (today, totime, payment, amount, userid, comments) values ('$today', '$now2', '$id', '$amount', '$_SESSION[userid]', '$comments')"; 
$result = mysqli_query($con, $query);

$query2 = "select payment from payments where id = '$id'"; 
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_array($result2); 

$newPayment2 = $row2['payment']-$amount;

$query3 = "update payments set payment='$newPayment2', refundCommission='$amount' where id = '$id'"; 
$result3 = mysqli_query($con, $query3); 

$query4 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '0.07', 'Ingreso de comision bancaria.')";  
$result4 = mysqli_query($con, $query4);  

header("location: ".$_SERVER['HTTP_REFERER']);

?>