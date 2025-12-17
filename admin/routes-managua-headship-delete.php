<?php 

include("sessions.php");

$id = $_GET['id'];

$query = "update routes set deleted='1' where headship = '$id'";
$result = mysqli_query($con, $query);

$query2 = "update headship set deleted='1' where id = '$id'";
$result2 = mysqli_query($con, $query2);

header("location: ".$_SERVER['HTTP_REFERER']); 
	  
?>