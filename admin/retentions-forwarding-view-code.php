<? 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL); 

include("session-schedule.php");
require('functions.php');

$id = isset($_GET['id']) ? sanitizeInput(intval($_GET['id']), $con) : 0;
$send_cancellation = isset($_GET['send_cancellation']) ? sanitizeInput(intval($_GET['send_cancellation']), $con) : 0;
$send_retention = isset($_GET['send_retention']) ? sanitizeInput(intval($_GET['send_retention']), $con) : 0;
$email = isset($_GET['ntype']) && $_GET['ntype'] == 2 ? sanitizeInput($_GET['theEmail'], $con) : '';

require '/var/www/html/assets/PHPMailer/PHPMailerAutoload.php'; 
//Envio de cancelación de retenciones
include('function-email-cancellation.php');
//Envio de retenciones IR
include('function-email-irretention.php');
//Creacion de PDF retencion ir para envío
include('pdf-ir-single.php');

$forwarding = 1;
if($send_cancellation == 1){
	notifyCancellation($id,$forwarding,0,$email,$con);
}
if($send_retention == 1){
	
	$fileUrl = "/home/tosend/$id.pdf";
	if(file_exists($fileUrl)){
		unlink($fileUrl); 
	}
	makeRetention($id,0,$con);
	sendEmailRetention($id,$forwarding,0,$email,$con);
} 

header('location:'.$_SERVER['HTTP_REFERER']);

?>