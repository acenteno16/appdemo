<?php include('session-admin.php');

$id = $_GET['id'];

$query = "delete from templatescontent where template = '$id'";  
$result = mysqli_query($con, $query);

$query2 = "delete from templates where id = '$id'";  
$result2 = mysqli_query($con, $query2); 

header("location: ".$_SERVER['HTTP_REFERER']); 

?>