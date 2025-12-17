<?php 

include("session-admin.php");

$id = $_POST['sid'];
$provider = $_POST['sprovider'];
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$querypayment = "select * from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);

$query = "update payments set sprovider = '$provider' where id = '$id'";
$result = mysqli_query($con, $query);

$queryprovider = "select * from providers where id = '$provider'";
$resultprovider = mysqli_query($con, $queryprovider);
$rowprovider = mysqli_fetch_array($resultprovider);

$providername = 'Proveedor sobrepuesto: '.$rowprovider['name']; 

$query2 = "insert into times (payment, today, now, now2, userid, stage, stage2, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '$rowpayment[status]', 'Proveedor sobrepuesto', '$providername')";  
$result2 = mysqli_query($con, $query2);      

header('location: '.$_SERVER['HTTP_REFERER']);

?>