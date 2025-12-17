<?php

include("sessions.php");

$id = $_POST['id'];
$isadmin = $_POST['isadmin'];

$query = "update workers set admin = '$isadmin' where id = '$id'";
$result = mysqli_query($con, $query);

header('location: '.$_SERVER['HTTP_REFERER']); 

 ?>