<?php
/*
include('../connection.php');

$query = "select * from schedule where status = '6'";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
	$query2 = "select * from schedulecontent where schedule = '$row[id]' limit 1";
	$result2 = mysqli_query($con, $query2);
	$row2 = mysqli_fetch_array($result2);
	
	$query3 = "select * from times where payment = '$row2[payment]' and stage = '14.00'";
	$result3 = mysqli_query($con, $query3);
	$row3 = mysqli_fetch_array($result3);
	
	$today = $row3['today'];
	$now = $row3['now'];
	$now2 = $row3['now2'];
	$userid = $row3['userid']; 
	
	
	$gcomments = "Enhorabuena, el grupo de pagos ha sido cancelado.";
	$querytime = "insert into scheduletimes (schedule, today, now, now2, userid, stage, comment) values ('$row[id]', '$today', '$now', '$now2', '$userid', '6', '$gcomments')";  
	$resulttime = mysqli_query($con, $querytime);  
	
	
}
*/
?>