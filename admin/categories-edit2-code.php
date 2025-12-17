<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php");

$id         = isset($_POST['id'])         ? sanitizeInput($_POST['id'], $con)         : null;
$name       = isset($_POST['name'])       ? sanitizeInput($_POST['name'], $con)       : null;
$aname      = isset($_POST['aname'])      ? sanitizeInput($_POST['aname'], $con)      : null;
$searchable = isset($_POST['searchable']) ? sanitizeInput($_POST['searchable'], $con) : null;
$aux        = isset($_POST['aux'])        ? sanitizeInput($_POST['aux'], $con)        : null;

$query = "UPDATE accountingCategories SET name = ?, aname = ?, searchable = ?, cobject = ? WHERE id = ?";
$stmt  = $con->prepare($query);
$stmt->bind_param("ssssi", $name, $aname, $searchable, $aux, $id);
$stmt->execute();

header("location: categories-edit.php?id=1");

?>