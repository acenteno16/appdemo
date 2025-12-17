<?php include("sessions.php");

$id = $_GET['id'];

$query = "delete from routes where id = '$id'";
$result = mysqli_query($con, $query);

header('location: '.$_SERVER['HTTP_REFERER']); 

?>