<?php

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

$loginId = $_SESSION['logId'];

include('admin/online.php');

require 'TwoFactorAuth.php'; // tu clase personalizada que ya tienes

$tfa = new TwoFactorAuth(); 

$userCode = isset($_POST['code']) ? $_POST['code'] : '';

	$label = $_SESSION["email"];
	$secret = $_SESSION["uid"];
	
	if ($tfa->verifyCode($secret, $userCode, 0)) {
		if(strlen($secret) > 5){
			#2=setup
			$queryLoginUpdate = "update login set 2fa='3' where id = '$loginId'";
			$resultLoginUpdate = mysqli_query($con, $queryLoginUpdate);
			
			$query = "update workers set msActive = '1' where uid = '$secret'";
			$result = mysqli_query($con, $query);
		}
		exit("<script>alert('2FA configurado exitosamente.');window.location='/';</script>");
	} else {
		#3=Error
		$queryLoginUpdate = "update login set 2fa='4' where id = '$loginId'";
		$resultLoginUpdate = mysqli_query($con, $queryLoginUpdate);
		exit("<script>alert('Codigo erroneo o expirado. Elimine el registro en el app de autenticador y vuelva a empezar el proceso.');window.location='/'</script>"); 
		
	}
	
?>