<?
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include('session-admin.php');

require '../assets/PHPMailer/PHPMailerAutoload.php'; 
//Envio de cancelación de retenciones
//include('function-email-cancellation.php');
//Envio de retenciones IR
include('function-email-irretention.php');
//Creacion de PDF retencion ir para envío
include('pdf-ir-single.php'); 

$forwarding = 1;
	
echo $query_main = "select payments.id from payments where cnotification2 = '1' and ret1a > '0' order by id desc limit 50"; 
$result_main = mysqli_query($con, $query_main); 
echo '<br>Num: '.$num_main = mysqli_num_rows($result_main);
	
	while($row_main=mysqli_fetch_array($result_main)){ 
		
		echo '<br>'.$row_main['id'].' ';
		$thefile = "//home/getpaycp/tosend/".$row_main['id'].'.pdf';

		if(!file_exists($thefile)){
			makeRetention($row_main['id'],$con);
		}
		
		sendEmailRetention($row_main['id'],1,'',$con); 
		
		$today = date('Y-m-d');
		$now = date('Y-m-d H:i:s');
		
		$queryTimes = "insert into cnotificationTimes (today, now, userid, notification, payment, stage, comments) values ('$today', '$now', '999999999', '2', '$row_main[id]', '1', 'ESPELLAS')";
		$resultTimes = mysqli_query($con, $queryTimes);
		
		echo '<br>'.$queryUpdate = "update payments set cnotification2 = '0' where id = '$row_main[id]'"; 
		$resultUpdate = mysqli_query($con, $queryUpdate); 
		
		}

?>