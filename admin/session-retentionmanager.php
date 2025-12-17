<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and ($_SESSION["retentionmanager"] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noRetentionManager");	 
}

include('online.php');
	
?> 