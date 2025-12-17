<?php 

include("session-banks.php");

$name = $_POST['name'];

$query = "insert into banks (name) values ('$name')";
$result = mysqli_query($con, $query); 
$id = mysqli_insert_id($con);      

header("location: banks-view.php?id=".$id);     

?>