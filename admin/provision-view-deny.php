<?php 
include("session-provision.php");
require '../assets/PHPMailer/PHPMailerAutoload.php'; 
require 'functions.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$id = isset($_GET['id']) ? sanitizeInput(intval($_GET['id']), $con) : 0;
$reason  = isset($_GET['reason']) ? sanitizeInput($_GET['reason'], $con) : 0;
$reason2 = isset($_GET['reason2']) ? sanitizeInput($_GET['reason2'], $con) : 0;
$userid = isset($_SESSION['userid']) ? sanitizeInput($_SESSION['userid'], $con) : 0;

$query = "update payments set approved='2', status='7.01', reason=? where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("si", $reason2,$id);
$stmt->execute();

$gcomments = "Rechazado en Provisión.";

$queryTime = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values (?, '$today', '$now', '$now2', ?, '7.01', '$gcomments', ?, ?)";
$stmtTime = $con->prepare($queryTime);
$stmtTime->bind_param("isss", $id,$userid,$reason,$reason2);
$stmtTime->execute();

//Multiple Rejection
$query_multiple = "select id from payments where child = ?";
$stmt_multiple = $con->prepare($query_multiple);
$stmt_multiple->bind_param("i", $id);
$stmt_multiple->execute();
$result_multiple = $stmt_multiple->get_result();
while ($row_multiple = $result_multiple->fetch_assoc()){
	//Aqui rechazamos todos los hijos.
	$queryReject = "update payments set approved='2', status='7.01', reason=? where id = ?";
	$stmtReject = $con->prepare($queryReject);
	$stmtReject->bind_param("si", $reason2,$row_multiple['id']);
	$stmtReject->execute();
	$gcomments = "Rechazado en Provisión.";

	$queryTimeReject = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values (?, '$today', '$now', '$now2', ?, '7.01', '$gcomments', ?, ?)";
	$stmtTimeReject = $con->prepare($queryTimeReject);
	$stmtTimeReject->bind_param("isss", $row_multiple['id'],$userid,$reason,$reason2);
	$stmtTimeReject->execute(); 
	
}

include('fn-rejection.php');
fnReject($id,$_SESSION['userid']);

if($_GET['global'] == '1'){
    header("location: provision-global.php");  
}elseif($_GET['covid'] == '1'){
    header("location: provision-covid.php");  
}else{
    header("location: provision.php"); 
}


?>