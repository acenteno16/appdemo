<?php 

include("session-request-bt.php"); 

$today = date("Y-m-d");

$query = "insert into letters (userid, today) values ('$_SESSION[userid]', '$today')";
$result = mysqli_query($con, $query);
$id = mysqli_insert_id($con);

header('location: payment-order-letters.php?id='.$id);

?>