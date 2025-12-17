<?php

include("session-provision.php");
require('fn-relative.php');

$id = $_GET['id'];
$amount = $_GET['amount'];

//GET Note info
$queryCommissions = "select * from refundCommissions where payment = '$id'";
$resultCommissions = mysqli_query($con, $queryCommissions);
while($rowCommissions = mysqli_fetch_array($resultCommissions)){
	$commissionsAmount+= $rowCommissions['amount'];
}

//GET Payment info 
$queryPayment = "select * from payments where id = '$id'";
$resultPayment = mysqli_query($con, $queryPayment);
$rowPayment = mysqli_fetch_array($resultPayment);
$newPayment = $rowPayment['payment']+$commissionsAmount;

//Update
$queryUpdate = "update payments set payment = '$newPayment', refundCommission='0' where id = '$id'";
$resultUpdate = mysqli_query($con, $queryUpdate);

$queryDelete = "delete from refundCommissions where payment = '$id'";  
$resultDelete = mysqli_query($con, $queryDelete);

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$querytimes = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '0.07', 'Comisiones bancarias eliminadas.')";  
$resulttimes = mysqli_query($con, $querytimes);     

header('location: '.$_SERVER['HTTP_REFERER']); 

?>