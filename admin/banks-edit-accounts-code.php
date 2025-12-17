<?php 

#ini_set('display_errors', '1');
#ini_set('display_startup_errors', '1');
#error_reporting(E_ALL);

include("session-admin.php");
include('functions.php');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$account = isset($_POST['account']) ? sanitizeInput($_POST['account'], $con) : '';
$account2 = isset($_POST['account2']) ? sanitizeInput($_POST['account2'], $con) : '';
$aname = isset($_POST['aname']) ? sanitizeInput($_POST['aname'], $con) : '';
$currency = isset($_POST['currency']) ? sanitizeInput($_POST['currency'], $con) : '';
$plan = isset($_POST['plan']) ? sanitizeInput($_POST['plan'], $con) : '';

$query = $con->prepare("select bank from banksaccounts where id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();

$queryUpdate = $con->prepare("update banksaccounts set account = ?, account2 = ?, aname = ?, currency = ?, plan = ? where id = ?");
$queryUpdate->bind_param("sssisi", $account,$account2,$aname,$currency,$plan,$id);
$queryUpdate->execute();

header('location: banks-edit.php?id='.$row['bank']);

?>