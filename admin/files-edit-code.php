<?php 

include("session-files.php");   

$id = $_POST['id'];
$filename = $_POST['filename'];
$title = $_POST['title'];
$description = $_POST['description']; 

$query = "update filebox set filename='$filename', title='$title', description='$description' where id='$id'";
$result = mysqli_query($con, $query);  

header("location: ".$_SERVER['HTTP_REFERER']);  

?>