<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php");

$id = isset($_POST['id']) ? sanitizeInput($_POST['id'], $con) : '';
$code = isset($_POST['code']) ? sanitizeInput($_POST['code'], $con) : '';
$name = isset($_POST['name']) ? sanitizeInput($_POST['name'], $con) : '';
$userid = $_SESSION['userid'];

$query = "UPDATE businessLines SET 
    code = ?, 
    name = ? 
    $act 
    WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ssssssi", $code, $name, $id);
$result = $stmt->execute();

if(isset($_POST['update'])){
	header("location: lines-edit.php?id=".$id);   
}
if(isset($_POST['save'])){
	
	header("location: lines.php"); 
}

?>