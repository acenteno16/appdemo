<?php 

require('headers.php');
$allowedRoles = ['admin', 'request'];
require('sessionCheck.php'); 
require('sanitize.php');

$today = date('Y-m-d');
$provider = sanitizeInput($_POST['provider'], $con);
$name = sanitizeInput($_POST['name'], $con);
$comments = sanitizeInput($_POST['comments'], $con);
$userid = $_SESSION['userid']; 

$query = "INSERT INTO beneficiaries (provider, name, active, userid, today, comments1) 
          VALUES (?, ?, 0, ?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param("sssss", $provider, $name, $userid, $today, $comments);
$stmt->execute();

header('location: beneficiaries.php');  

?>