<?php 

include("session-admin.php");

exit();

$id = $_POST['id'];
$name = $_POST['name'];

$query = "update units set name='$name' where id = '$id'";
$result = mysqli_query($con, $query); 

header('location: units.php');  

?>