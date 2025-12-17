<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and ($_SESSION["consultation"] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=nosession_consultation"); 	 
}

include('online.php');

?> 