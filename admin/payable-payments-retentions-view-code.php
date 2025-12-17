<?php 

include("session-retentionmanager.php");

$theid = $_POST['theid'];
$link = $_POST['link'];
$number = $_POST['number'];
$reference = $_POST['reference'];
$bank = $_POST['bank'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$queryconfig = "select * from config where id = '1'";
$resultconfig = mysqli_query($con, $queryconfig);
$rowconfig = mysqli_fetch_array($resultconfig);

$makecancellation = 1;

if($link == "") $makecancellation = 0; 
if($number == "") $makecancellation = 0;

//if($international == 1){
	if($reference == "") $makecancellation = 0;
	if($bank == 0) $makecancellation = 0;
//}

if($makecancellation == 1){ 

//Withholding
$querypayment = "select * from payments where id = '$theid'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);

//UPDATE DEL PAGO 
$queryapprove = "update payments set status = '14', cnumber = '$number', clink='$link', reference='$reference', bank='$bank' where id = '$theid'"; 
$resultapprove = mysqli_query($con, $queryapprove);
$gcomments = "Enhorabuena, el pago ha sido cancelado.";

//time stage DEL PAGO
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$theid', '$today', '$now', '$now2', '$_SESSION[userid]', '14', '$gcomments')"; 
$resulttime = mysqli_query($con, $querytime);

}

header("location: payable-payments-retentions.php");

?> 