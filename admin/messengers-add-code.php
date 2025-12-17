<?php 

include("session-reception.php");

$first = $_POST['first'];
$last = $_POST['last'];

$query = "insert into collector (first, last) values ('$first', '$last')";
$result = mysqli_query($con, $query); 
$id = mysqli_insert_id($con);      

header("location: messengers-edit.php?id=".$id);     

?>