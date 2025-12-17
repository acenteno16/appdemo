<?php 

include("session-request.php");

$type = $_GET['type'];
$parent = $_GET['parent'];

$user = $_SESSION['userid'];

$query = "insert into payments (status, userid, parent, type) values ('0', '$user', '$parent', '$type')"; 
$result = mysqli_query($con, $query);  
$id = mysqli_insert_id($con);

header("location: payment-order-cascade.php?id=".$id);

?>