<?php

include("session-withholding.php");

$id = $_GET['id'];
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$query = "select * from ircontent where package = '$id'";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
	$querypayments = "update payments set irstage = '1' where id = '$row[payment]'";
	$resultpayments = mysqli_query($con, $querypayments);
	
	$payment2 = $row['payment2'];
	
}

$querydelete = "update ir set deleted = '1' where id = '$id'";
$resultdelete = mysqli_query($con, $querydelete);

$querydelete2 = "update ircontent set deleted = '1' where package = '$id'"; 
$resultdelete2 = mysqli_query($con, $querydelete2);

$queryreject = "update payments set status='7.10', approved = '2' where id = '$payment2'";
$resultreject = mysqli_query($con, $queryreject); 

$gcomments = "Rechazo por grupo de retenciones eliminiado.";

$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$payment2', '$today', '$now', '$now2', '$_SESSION[userid]', '7.10', '$gcomments')"; 
$resulttime = mysqli_query($con, $querytime); 

header('location: withholding-income-tax.php'); 

?>