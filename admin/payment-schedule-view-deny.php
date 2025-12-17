<?php 

include("session-schedule.php");
require '../assets/PHPMailer/PHPMailerAutoload.php';  

$id = intval($_GET['id']);

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$userid = $_SESSION['userid'];

$reason = $_GET['reason'];
$reason2 = $_GET['reason2']; 

$query = "update payments set approved='2', status='7.03', reason='$reason2' where id = '$id'";
$result = mysqli_query($con, $query);
$gcomments = "Rechazado en Programación.";

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '7.03', '$gcomments', '$reason')";  
$resulttime = mysqli_query($con, $querytime);

include('fn-rejection.php');
fnReject($id,$_SESSION['userid']);     


header("location: payment-schedule-view.php");  

?>