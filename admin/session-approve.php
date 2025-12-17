<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and (($_SESSION["approve1"] == "active") or ($_SESSION["approve2"] == "active") or ($_SESSION["approve3"] == "active") or ($_SESSION["dch"] == "active") or ($_SESSION["spellas"] == "active"))){ 
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=5");	 
}

include('online.php');
	
?> 