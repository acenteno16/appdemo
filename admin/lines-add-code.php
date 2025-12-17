<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php");
require('sanitize.php');

$name = isset($_POST['name']) ? sanitizeInput($_POST['name'], $con) : '';
$userid = $_SESSION['userid'];
$today = date('Y-m-d');

$query = "INSERT INTO businessLines (code, name) VALUES (?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param("sss", $code, $name);
$stmt->execute();

$id = $stmt->insert_id;     

header("location: lines-edit.php?id=".$id);     

?>