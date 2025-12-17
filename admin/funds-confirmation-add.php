<?php 

include("session-request.php");  

$today = date("Y-m-d");
$totime = date('Y-m-d H:i:s');

$queryFunds = "insert into funds (today, totime, userid) values ('$today', '$totime', '$_SESSION[userid]')";
$resultFunds = mysqli_query($con, $queryFunds);
$id = mysqli_insert_id($con);

header('location: funds-confirmation-order.php?id='.$id);

?>