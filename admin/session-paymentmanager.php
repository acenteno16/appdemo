<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and ($_SESSION["paymentmanager"] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=7");	 
}

include('online.php');
	
?> 