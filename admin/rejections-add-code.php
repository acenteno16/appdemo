<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('sanitize.php');

$name = isset($_POST['name']) ? sanitizeInput($_POST['name'], $con) : '';

$query = "INSERT INTO reason (name) VALUES (?)";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $name);
$stmt->execute();

header("location: rejections.php");     

?>