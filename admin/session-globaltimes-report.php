<?php  

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and (($_SESSION["globaltimes_report"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION["special_payments_report"] == 'active'))){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=no_globaltimes_report");	 
}

include('online.php');
	
?> 