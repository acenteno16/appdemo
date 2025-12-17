<?php 

session_start();

if(($_SESSION["filereview"] == "active") or ($_SESSION["request"] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=3");	 
}
require('functions.php');
	
$id = isset($_POST['payment']) ? intval($_POST['payment']) : 0;
$comments = isset($_POST['comments']) ? sanitizeInput($_POST['comments'], $con) : '';
$userid = $_SESSION['userid'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$query = "INSERT INTO filescomments (payment, today, now, now2, userid, comments) 
              VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param("isssss", $id, $today, $now, $now2, $userid, $comments);
$stmt->execute();

header("location: ".$_SERVER['HTTP_REFERER']);  

?>