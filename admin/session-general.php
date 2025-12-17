<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and ($_SESSION["authdata"] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=0");	  
}

include('online.php');
	
?>