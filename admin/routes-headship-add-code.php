<?php 

include("session-admin.php");

$id = $_POST['id'];
$name = $_POST['name'];

$query = "insert into headship (name, unitid) values ('$name', '$id')";
$result = mysqli_query($con, $query);

header('location: routes-managua-view.php?id='.$id); 

?>