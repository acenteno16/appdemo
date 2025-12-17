<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and (($_SESSION["provision"] == "active") or ($_SESSION["provision_bt"] == "active"))){
	include("../connection.php"); 
}else{ 
	session_destroy();
	header("location: ../?err=nosession_provision");	 
}

include('online.php');
	
?> 