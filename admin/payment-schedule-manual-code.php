<?php include("session-schedule.php"); 

$id = $_POST['id'];
$schedule = $_POST['schedule'];

for($c=0;$c<sizeof($id);$c++){
     if($schedule[$c] != ''){
	
	 $varschedule = date("Y-m-d", strtotime($schedule[$c])); 
	 $query1 = "update payments set status = '12', schedule = '$varschedule' where id = '$id[$c]'";
	 $result1 = mysqli_query($con, $query1); 
	 
	 
	 $today = date("Y-m-d");
	 $now = date('Y-m-d H:i:s');
	 $now2 = date('H:i:s');
	 
	 $query2 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id[$c]', '$today', '$now', '$now2', '$_SESSION[userid]', '12', 'Enhorabuena, el pago ha sido programado para el $schedule[$c]')";
	 $result2 = mysqli_query($con, $query2); 

	 }  
}

header('location: payment-schedule.php');

?>