<?php include("sessions.php");

$worker = $_POST['worker'];
$type = $_POST['type'];


$query = "insert into routes (worker, type, addby) values ('$worker', '$type', '$_SESSION[userid]')";
$result = mysqli_query($con, $query); 

header('location: routes-letters.php'); 

 
?>