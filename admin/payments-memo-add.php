<?php include("session-request-memo.php");

$user = $_SESSION['userid'];

$query = "insert into payments (status, userid, type) values ('0', '$user', '6')";
$result = mysqli_query($con, $query);  
$id = mysqli_insert_id($con); 

header("location: payments-order-memo.php?id=".$id);

?>