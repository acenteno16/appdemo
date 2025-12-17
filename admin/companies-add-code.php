<?php 

$allowedRoles = ['admin'];
require("sessionCheck.php");
require_once('sanitize.php'); 

$name = sanitizeInput($_POST['name'], $con); 

$query = "SELECT id FROM companies WHERE name = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();
$num = $result->num_rows;

if($num > 0){
	
    echo "<script>alert('Ya existe una compañía con el nombre $name'); history.go(-1);</script>";
    exit();
	
}else{
	
	$query = "INSERT INTO companies (name) VALUES (?)";
	$stmt = $con->prepare($query);
	$stmt->bind_param("s", $name);
	$stmt->execute();
	$id = $stmt->insert_id;

	header('location: companies-edit.php?id='.$id); 
}
 
?>