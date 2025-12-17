<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and (($_SESSION["auditor_report"] == "active") or ($_SESSION['admin'] == "active"))){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noAuditorReport");	 
}

include('online.php');
	
?> 