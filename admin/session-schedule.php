<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and (($_SESSION["paymentschedule"] == "active") or ($_SESSION["admin"] == "active"))){
	include("../connection.php"); 
}else{
	session_destroy();
	header("location: ../?err=noSchedule");	 
}

include('online.php');
	
?> 