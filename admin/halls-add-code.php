<?php 

include("session-admin.php");

$name = $_POST['name'];
$comments = $_POST['comments'];
$userid = $_SESSION['userid'];

$today = date('Y-m-d');

$query = "insert into halls (name, today, userid) values ('$name', '$today', '$userid')";
$result = mysqli_query($con, $query); 
$id = mysqli_insert_id($con);      

header("location: halls-edit.php?id=".$id);     

?>