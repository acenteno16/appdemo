<?php

require("session-admin.php");
require('functions.php');

$id = isset($_POST['id']) ? sanitizeInput(intval($_POST['id']), $con) : 0;
$name = sanitizeInput($_POST['name'], $con);
$content = sanitizeCkeditorInput($_POST['content'], $con); 
$visible = sanitizeInput($_POST['visible'], $con);

$act = "";
$profiles1 = "";

if (!empty($_POST['ckprofiles']) && is_array($_POST['ckprofiles'])) {
    $profiles = sanitizeInput($_POST['ckprofiles'], $con);
    $profiles1 = implode(", ", $profiles);
    $act = ", profiles = ?";
}

$query = "UPDATE news SET name = ?, visible = ?, content = ? $act WHERE id = ?";
$stmt = $con->prepare($query);
if (!empty($act)) {
    $stmt->bind_param("ssssi", $name, $visible, $content, $profiles1, $id);
} else {
    $stmt->bind_param("sssi", $name, $visible, $content, $id);
}
$stmt->execute();

header('location: news.php'); 

?>