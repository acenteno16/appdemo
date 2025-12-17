<?php 

include("session-schedule.php");

$id = $_POST['id'];
$today = date('Y-m-d');
$now = date('Y-m-d H:i:s');
$comments = $_POST['comments'];
#$comments = 'ERRSPELLAS';
if($comments == ''){
	exit('<script>alert("Ingrese un comentario.");history.go(-1);</script>');
}

for($i=0;$i<sizeof($id);$i++){
	
	$query = "update payments set cnotification2 = '1' where id = '$id[$i]'";
	$result = mysqli_query($con, $query);
	
	$queryInsert = "insert into cnotificationTimes (today, now, userid, notification, payment, stage, comments) values ('$today', '$now', '$_SESSION[userid]', '2', '$id[$i]', '1', '$comments')";
	$resultInsert = mysqli_query($con, $queryInsert);
}

header('location: retentions-forwarding-range.php');

/*
Stage catalog:
1- Solicitud de envío
2- Err de envio
3- Envio exitoso
*/

?>