<?php include("sessions.php"); 

$id = $_GET['id'];
$id2 = $_GET['id2'];

$query = "update providers set account='$id' where id = '$id2'";
$result = mysqli_query($con, $query); 
 
header("location: providers-edit.php?id=".$id2."&changes=2"); 

?>