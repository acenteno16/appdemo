<?php

include("session-withholding.php");

$id = $_GET['id'];

$query = "update payments set ret1void = '1' where id = '$id'";
$result = mysqli_query($con, $query);

header('location: '.$_SERVER['HTTP_REFERER']);


?>