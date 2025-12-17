<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('sanitize.php');

$id = isset($_POST['id']) ? sanitizeInput($_POST['id'], $con) : '';
$name = isset($_POST['name']) ? sanitizeInput($_POST['name'], $con) : '';

$query = "UPDATE reason SET name = ? WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("si", $name, $id);
$result = $stmt->execute();
   
header("location: rejections-view.php?id=".$id);

?> 