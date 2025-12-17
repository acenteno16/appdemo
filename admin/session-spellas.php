<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and (($_SESSION["spellas"] == "active") or ($_SESSION["admin"] == "active"))){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noSpellas");	 
}

include('online.php');
	
?> 