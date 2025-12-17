<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php");
require_once('sanitize.php');

$category = isset($_POST['category']) ? sanitizeInput($_POST['category'], $con) : null;
$worker   = isset($_POST['worker'])   ? sanitizeInput($_POST['worker'], $con)   : null;
$today    = date('Y-m-d'); // Asumo que querés la fecha actual. Si ya viene antes, dejalo como estaba.

$query = "INSERT INTO categoriesusers (category, worker, addby, today) VALUES (?, ?, ?, ?)";
$stmt  = $con->prepare($query);
$stmt->bind_param("iiis", $category, $worker, $_SESSION['userid'], $today);
$stmt->execute();

header("location: ".$_SERVER['HTTP_REFERER']);

?>