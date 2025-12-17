<?php 

include("session-schedule.php");
//include("pdf-ir-single.php");
//include('function-email-irretention.php');

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

$theid = $_POST['theid'];
$schedule = $_POST['schedule'];
$bank = $_POST['schedulebank'];
$varschedule = date("Y-m-d", strtotime($schedule));

$currency = '';

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s'); 
$now2 = date('H:i:s');

$currency = $_POST['currency'];	
$pp = $_POST['pp'];

$queryschedule = "insert into schedule (today, now, now2, userid, currency, schedule, status, bank, userid2, thebank) values ('$today', '$now', '$now2', '$_SESSION[userid]', '$currency', '$varschedule', '1', '$bank', '$pp', '$bank')";   
$resultschedule = mysqli_query($con, $queryschedule);
$idschedule = mysqli_insert_id($con); 

$queryschedule2 = "insert into scheduletimes (schedule, today, now, now2, userid, stage, comment) values ('$idschedule', '$today', '$now', '$now2', '$_SESSION[userid]', '1', 'Enhorabuena, el pago ha sido programado para el $schedule.')"; 
$resultschedule2 = mysqli_query($con, $queryschedule2);

for($c=0;$c<sizeof($theid);$c++){
	
	$querycheck = "select * from schedulecontent inner join schedule on schedulecontent.schedule = schedule.id where schedulecontent.payment = '$theid[$c]' and (schedule.status = '1' or schedule.status = '3' or schedule.status = '5' or schedule.status = '6' or schedule.status = '7')";
	$resultcheck = mysqli_query($con, $querycheck);
	$numcheck = mysqli_num_rows($resultcheck);
	 
	if($numcheck == 0){
	
		$queryschedule2 = "insert into schedulecontent (schedule, payment) values ('$idschedule', '$theid[$c]')";
		$resultschedule2 = mysqli_query($con, $queryschedule2);
	
		$query1 = "update payments set status = '12', schedule = '$varschedule', blockschedule='$_SESSION[userid]', bank='$bank', sbank='$bank' where id = '$theid[$c]'";
		$result1 = mysqli_query($con, $query1);   
	
		$today = date("Y-m-d");
		$now = date('Y-m-d H:i:s');
		$now2 = date('H:i:s');
	
		$query2 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$theid[$c]', '$today', '$now', '$now2', '$_SESSION[userid]', '12', 'Enhorabuena, el pago ha sido programado para el $schedule.')"; 
		$result2 = mysqli_query($con, $query2); 
	
		$query3 = "select id, payment, currency, parent from payments where id = '$theid[$c]'";
		$result3 = mysqli_query($con, $query3);
		$row3 = mysqli_fetch_array($result3);
	
		$gammount+= $row3['payment'];
		$currency = $row3['currency'];
		
		//Childs
		if($row3['parent'] > 0){
		
			$querypaymentchilds = "select id, payment from payments where child = '$row3[id]'";
			$resultpaymentchilds = mysqli_query($con, $querypaymentchilds);
			while($rowpaymentchilds=mysqli_fetch_array($resultpaymentchilds)){
			
				$queryschedule2c = "insert into schedulecontent (schedule, payment) values ('$idschedule', '$rowpaymentchilds[id]')";
				$resultschedule2c = mysqli_query($con, $queryschedule2c);
	
				$query1c = "update payments set status = '12', schedule = '$varschedule', blockschedule='$_SESSION[userid]', bank='$bank' where id = '$rowpaymentchilds[id]'";
				$result1c = mysqli_query($con, $query1c);   
	
				$query2c = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$rowpaymentchilds[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '12', 'Enhorabuena, el pago ha sido programado para el $schedule.')"; 
				$result2c = mysqli_query($con, $query2c); 
	
				$gammount+= $rowpaymentchilds['payment']; 
	
			//End While Childs	
			
			}
			
		//End if Childs exists
		}
		
		//makeRetention($theid[$c]);
		//sendEmailRetention($theid[$c]);
	
	} 
} 

$queryschedule3 = "update schedule set ammount='$gammount', currency='$currency' where id = '$idschedule'";
$resultschedule3 = mysqli_query($con, $queryschedule3); 

header('location: '.$_SERVER['HTTP_REFERER']); 
#header('location: '.$_SERVER['HTTP_REFERER']); 

?>