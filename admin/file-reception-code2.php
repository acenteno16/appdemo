<?php include("session-reception.php");

$id = $_GET['id'];
$query = "update packages set stage = '3' where id = '$id'";
$result = mysqli_query($con, $query);
	
header('location: '.$_SERVER['HTTP_REFERER']);
	

?>