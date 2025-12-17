<?php 
include("session-credit.php");
require '../assets/PHPMailer/PHPMailerAutoload.php';  

$id = intval($_GET['id']);

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$userid = $_SESSION['userid'];

$reason = $_GET['reason'];
$reason2 = $_GET['reason2']; 

$query = "update payments set approved='2', status='7.11', reason='$reason2' where id = '$id'";
$result = mysqli_query($con, $query);
$gcomments = "Rechazado en Crédito.";

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '7.11', '$gcomments', '$reason', '$reason2')"; 
$resulttime = mysqli_query($con, $querytime); 

include('fn-rejection.php'); 
fnReject($id,$_SESSION['userid']);  

header("location: provision.php");  

?>