<?php

include("session-treasury.php");

$id = $_GET['id'];
$currency = $_GET['currency'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s'); 
$now2 = date('H:i:s');

$querymain = "select * from schedule where id = '$id'";
$resultmain = mysqli_query($con, $querymain);
$rowmain = mysqli_fetch_array($resultmain);

$currency = $rowmain['currency'];
$ammount = $rowmain['ammount'];

$query = "update schedule set status = '2' where id = '$id'";
$result = mysqli_query($con, $query);

$query7 = "insert into scheduletimes (schedule, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '2', 'La programación del grupo de pago ha sido rechazada por la Jefatura de Tesoreria.')";  
$result7 = mysqli_query($con, $query7); 

//Acreditamos la plata de regreso
$type = "nc";
$description = "Rechazo del grupo no. ".$id;

if($currency != 0){
	
			$query4 = "select * from balance where currency = '$currency' order by id desc limit 1"; 
			$result4 = mysqli_query($con, $query4);
			$row4 = mysqli_fetch_array($result4);
			$balance = $row4['balance']+$ammount;

			$query5 = "insert into balance (today, now, type, description, ammount, balance, currency) values ('$today', '$now', '$type', '$description', '$ammount', '$balance', '$currency')";
			$result5 =  mysqli_query($con, $query5); 
	
		}


$query2 = "select * from schedulecontent where schedule = '$id'"; 
$result2 = mysqli_query($con, $query2);
while($row2=mysqli_fetch_array($result2)){
	
	$query3 = "update payments set status = '9', schedule='0000-00-00' where id = '$row2[payment]'";
	$result3 = mysqli_query($con, $query3);
	
	$query4 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$row2[payment]', '$today', '$now', '$now2', '$_SESSION[userid]', '13.02', 'La programacion ha sido rechazada por la Jefatura de Tesoreria.')";
	$result4 = mysqli_query($con, $query4); 
	
}

header('location: payment-schedule-approve-group.php'); 

?>