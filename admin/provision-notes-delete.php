<?php

include("session-provision.php");

$id = $_GET['id'];
require('fn-relative.php');

//GET Note info
$querynote = "select * from notes where payment = '$id'";
$resultnote = mysqli_query($con, $querynote);
while($rownote = mysqli_fetch_array($resultnote)){
	$noteamount+= $rownote['ammount'];
}

//GET Payment info 
$querypayment = "select * from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);
$paymentamount = $rowpayment['payment'];

//Calculate new value
$newpayment = $paymentamount+$noteamount;

//Update
$queryupdate = "update payments set payment = '$newpayment' where id = '$id'";
$resultupdate = mysqli_query($con, $queryupdate);

$querydelete = "delete from notes where payment = '$id'";  
$resultdelete = mysqli_query($con, $querydelete);

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$querytimes = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '0.01', 'Notas de debito eliminadas.')";  
$resulttimes = mysqli_query($con, $querytimes);     

header('location: '.$_SERVER['HTTP_REFERER']); 

?>