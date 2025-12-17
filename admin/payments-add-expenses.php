<?php 

include("session-request.php");

$user = $_SESSION['userid'];

$query = "insert into payments (status, userid, parent, type) values ('0', '$user', '2', '3')";
$result = mysqli_query($con, $query);  
$id = mysqli_insert_id($con);

header("location: payment-order-expenses.php?id=".$id); 

?>