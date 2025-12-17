<?php include("session-payer.php");

$id = $_GET['id'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$userid = $_SESSION['userid'];

$query = "update payments set approved='2', status='7.05' where id = '$id'";
$result = mysqli_query($con, $query);
$gcomments = "Rechazado en Cancelaci&oacute;n.";

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '7.05', '$gcomments')"; 
$resulttime = mysqli_query($con, $querytime);

header("location: payable-payments.php");   

?>