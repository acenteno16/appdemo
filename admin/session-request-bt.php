<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and (($_SESSION["request_bt"] == "active") or ($_SESSION['admin'] == "active"))){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=no_bank_transfers");	 
}

include('online.php');
	
?> 