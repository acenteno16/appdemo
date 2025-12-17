<?php 

include("session-request.php");

$user = $_SESSION['userid'];

$query = "insert into payments (status, userid, type) values ('0', '$user', '4')"; 
$result = mysqli_query($con, $query);  
$id = mysqli_insert_id($con);

header("location: payment-order-refund.php?id=".$id); 

?>