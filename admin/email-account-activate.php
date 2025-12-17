<?php

include("session-admin.php");

$id = $_GET['id'];

$query = "update mailer set active = '0'";
$result = mysqli_query($con, $query);

$query = "update mailer set active = '1' where id = '$id'";
$result = mysqli_query($con, $query);

header('location: email-accounts.php');

?>