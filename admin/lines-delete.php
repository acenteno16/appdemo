<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require('headers.php'); 
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require("../TwoFactorAuth.php"); 

$tfa = new TwoFactorAuth();

$userCode = isset($_GET['code']) ? $_GET['code'] : '';
$userCode = str_replace(' ','',$userCode);
$secret = $_SESSION["uid"];

if($tfa->verifyCode($secret, $userCode, 0)){  
	
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	$queryDelete = "update businessLines set deleted='1' where id = ?";
	$stmtDelete = $con->prepare($queryDelete);
	$stmtDelete->bind_param("i", $id);
	$stmtDelete->execute();

	header("location: lines.php?response=1"); 

}else{
	header("location: lines.php?reponse=5282");
}

?>