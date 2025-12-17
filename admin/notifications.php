<?php 

include("sessions.php"); 

$id = $_GET['id'];

$query = "select * from notifications where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$link = $row['link'];

$query2 = "update notifications set active = 0 where id = '$id'";
$result2 = mysqli_query($con, $query2);

header('location: '.$link);

?>