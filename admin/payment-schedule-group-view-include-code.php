<? 

include("session-schedule.php"); 

$idschedule = $_POST['id'];
$payment = $_POST['payment'];
$schedule = $_POST['schedule'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s'); 
$now2 = date('H:i:s');

$queryschedule2 = "insert into schedulecontent (schedule, payment) values ('$idschedule', '$payment')";
$resultschedule2 = mysqli_query($con, $queryschedule2); 
	
$query1 = "update payments set status = '12', schedule = '$schedule', blockschedule='$_SESSION[userid]' where id = '$payment'";
$result1 = mysqli_query($con, $query1);   
	
$query2 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$payment', '$today', '$now', '$now2', '$_SESSION[userid]', '12', 'Enhorabuena, el pago ha sido programado para el $schedule.')"; 
$result2 = mysqli_query($con, $query2); 

//
$queryschedule = "select ammount from schedule where id = '$idschedule'";
$resultschedule = mysqli_query($con, $queryschedule);
$rowschedule = mysqli_fetch_array($resultschedule);

$querypayment = "select payment from payments where id = '$payment'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);

$gammount = $rowschedule['ammount']+$rowpayment['payment'];

$queryschedule3 = "update schedule set ammount='$gammount' where id = '$idschedule'";
$resultschedule3 = mysqli_query($con, $queryschedule3); 
	
header('location: payment-schedule-group-view.php?id='.$schedule);	

?>