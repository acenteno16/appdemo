<?php include("session-request.php");

$today = date('Y-m-d');
$user = $_SESSION['userid'];

$query = "insert into payments (today, status, userid, type, btype, provider, collaborator) values ('$today', '0', '$user', '1', '0', '0', '0')"; 
$result = mysqli_query($con, $query); 
$id = mysqli_insert_id($con);
header("location: payment-order.php?id=".$id);

?>