<?php

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
exit();
include('functions.php');

$iva = sanitizeInput($_POST['iva'], $con);
$intur = sanitizeInput($_POST['intur'], $con);
$route = sanitizeInput($_POST['theroute'], $con);
$headship = sanitizeInput($_POST['headship'], $con);
$route2 = sanitizeInput($_POST['theroute2'], $con);
$headship2 = sanitizeInput($_POST['headship2'], $con);
$lapprove1 = sanitizeInput($_POST['lapprove1'], $con);
$lapprove2 = sanitizeInput($_POST['lapprove2'], $con);
$cic = sanitizeInput($_POST['cic'], $con);
$cic2 = sanitizeInput($_POST['cic2'], $con);
$type = sanitizeInput($_POST['type'], $con);
$concept = sanitizeInput($_POST['concept'], $con);
$concept2 = sanitizeInput($_POST['concept2'], $con);
$provider = sanitizeInput($_POST['provider'], $con);

$cut = sanitizeInput($_POST['cut'], $con);
$sqlcut = "";
if (!empty($cut)) {
    $cut = date("Y-m-d", strtotime($cut));
    $sqlcut = ", cut=?";
}

$query1 = "UPDATE config SET iva=?, intur=?, route=?, headship=?, route2=?, headship2=?, cic=?, cic2=? $sqlcut WHERE id=1";
$stmt1 = $con->prepare($query1);
if (!empty($cut)) {
    $stmt1->bind_param("sssssssss", $iva, $intur, $route, $headship, $route2, $headship2, $cic, $cic2, $cut);
} else {
    $stmt1->bind_param("ssssssss", $iva, $intur, $route, $headship, $route2, $headship2, $cic, $cic2);
}
$stmt1->execute();

$query2 = "UPDATE config SET 
    imitype=?, imiconcept=?, imiconcept2=?, 
    irtype=?, irconcept=?, irconcept2=?, 
    imiprovider=?, irprovider=?, 
    lapprove1=?, lapprove2=?";
$stmt2 = $con->prepare($query2);
$stmt2->bind_param(
    "ssssssssss",
    $type[0], $concept[0], $concept2[0],
    $type[1], $concept[1], $concept2[1],
    $provider[0], $provider[1],
    $lapprove1, $lapprove2
);
$stmt2->execute();

$stmt1->close();
$stmt2->close();

header("location: admin-config.php"); 

?>