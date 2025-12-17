<?php 

include("session-schedule.php"); 

$id = $_POST['id'];
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s'); 

$query = "update schedule set vo = '1', userid3='$_SESSION[userid]' where id = '$id'";
$result = mysqli_query($con, $query); 

//Times
$query7 = "insert into scheduletimes (schedule, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '1.01', 'Enhorabuena, VoBo de grupo de cancelacion.')"; 
$result7 = mysqli_query($con, $query7); 

$queryschedule = "select * from schedulecontent where schedule = '$id'";
$resultschedule = mysqli_query($con, $queryschedule);
while($rowschedule=mysqli_fetch_array($resultschedule)){

	$querytimes = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$rowschedule[payment]', '$today', '$now', '$now2', '$_SESSION[userid]', '12.01', 'Enhorabuena, el pago a sido aprobado de programaci&oacute;n')"; 
	$resulttimes = mysqli_query($con, $querytimes); 

}

header("location: payment-schedule-group.php"); 

?> 