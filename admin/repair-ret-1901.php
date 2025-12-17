<?php
/*
include('../connection.php');

$query = "select * from payments where route = '1901' and ret1a > '0' and status = '14'";
$result = mysqli_query($con, $query);
$i = 1;
while($row=mysqli_fetch_array($result)){
	
	
	$query3 = "select * from times where stage= '14.00' and payment = '$row[id]'";
	$result3 = mysqli_query($con, $query3);
	$row3 = mysqli_fetch_array($result3);
	echo '<br><br>'.$row3["today"];
	
	
	if($row3['today'] < '2016-10-01'){ 
	// 
	echo '<br>'.$query2 = "update times set today = '2016-10-06' where payment = '$row[id]' and stage = '14.00'";
	$result2 = mysqli_query($con, $query2);  
}
	
	
}

*/
?>