<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and (($_SESSION["financemanager"] == "active") or ($_SESSION["financemanager2"] == "active"))){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=15");	  
}

include('online.php');
	
?> 