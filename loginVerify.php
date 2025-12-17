<?php

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require('admin/headers.php');
require('admin/config.php');

if(!isset($_SESSION)){ session_start(); }

if(($_SESSION["generalsession"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['spellas'] == "active")){
	include("connection.php");
}else{
	if(isset($_SESSION)){ session_destroy(); }
	header("location: /?err=nosession_sessions");	  
} 

$loginId = $_SESSION['logID'];

include('admin/online.php');
require 'TwoFactorAuth.php'; 

$tfa = new TwoFactorAuth();
$userCode = isset($_POST['code']) ? $_POST['code'] : '';
$userCode = str_replace(' ','',$userCode);
$secret = $_SESSION["uid"];

if($tfa->verifyCode($secret, $userCode, 1)){
	
	
	$_SESSION['2fa_verified'] = true;
	#5=login2faVerified
	$queryLoginUpdate = "update login set 2fa='5' where id = '$loginId'";
	$resultLoginUpdate = mysqli_query($con, $queryLoginUpdate);
	
	if(($row['email'] == 'dchamorro@casapellas.com') or ($row['email'] == 'spellasm@casapellas.com')){
		header('location: admin/approve-special.php');
	}
	else{
		if($referer != ""){
			header('location: admin/');
		}else{
			header('location: admin/dashboard.php');
		}
	}

}else{
	exit("<script nonce='$nonce'>alert('Código inválido. Intenta de nuevo.');history.go(-1);</script>");
	#4=login2faVerified
	$queryLoginUpdate = "update login set 2fa='4' where id = '$loginId'";
	$resultLoginUpdate = mysqli_query($con, $queryLoginUpdate);
}

?>