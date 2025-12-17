<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php");
require_once('sanitize.php');

$name = sanitizeInput($_POST['name'], $con);
$parentcat = sanitizeInput($_POST['parentcat'], $con);

$query1 = "SELECT level FROM accountingCategories WHERE id = ?";
$stmt1 = $con->prepare($query1);
$stmt1->bind_param("i", $parentcat);
$stmt1->execute();
$result1 = $stmt1->get_result();

$row1 = $result1->fetch_assoc();
$level = $row1['level'] + 1;

$query = "INSERT INTO accountingCategories (name, parent, level) VALUES (?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param("sii", $name, $parentcat, $level);
$stmt->execute();

header("location: ".$_SERVER['HTTP_REFERER']);    

?>