<?php

/*
include('../connection.php'); 

$query = "select * from workers";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
	$email = $row['email'];
	$part = "@";
	$strings = strpos ($email, $part);
	$password = substr ($email, 0,$strings);
	$password = md5('cp'.$password); 
	$password = strtolower($password);
				
	$query2 = "update workers set password='$password' where id = '$row[id]'";
	$result2 = mysqli_query($con, $query2);
} 
*/
?> 