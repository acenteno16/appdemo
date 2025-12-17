<? 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require('admin/config.php');
 
if(!isset($_SESSION)){ session_start(); }

if(($_SESSION["generalsession"] == "active")){
	include("connection.php");
}else{
	if(isset($_SESSION)){ session_destroy(); }
	header("location: /?err=nosession_sessions");	  
} 
	
include('online.php');

include "assets/phpqrcode/qrlib.php";

	
	$label =  $_SESSION["email"];
	$secret = $_SESSION["uid"];
	$issuer = 'getPay Grupo Casa Pellas';

// Formato otpauth compatible con Google/Microsoft Authenticator
$otpauth = "otpauth://totp/{$issuer}:{$label}?secret={$secret}&issuer={$issuer}";

// Salida como imagen PNG directamente al navegador
header('Content-Type: image/png');
QRcode::png($otpauth); 
exit;


?>