<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and (($_SESSION["pce1"] == 'active') or ($_SESSION['admin'] == 'active'))){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noPce1"); 
}

include('online.php');
	
?> 