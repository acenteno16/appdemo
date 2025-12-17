<?php 

require("session-admin.php"); 

$today = date('Y-m-d');
$totime = date('H:i:s');

$query = "insert into news (userid, today, totime) values ('$_SESSION[userid]', '$today', '$totime')"; 
$result = mysqli_query($con, $query);
$id = mysqli_insert_id($con); 

header('location: news-edit.php?id='.$id); 

?>