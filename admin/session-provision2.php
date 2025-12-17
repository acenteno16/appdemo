<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and ($_SESSION["provision2"] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noProvision2");	  
}
	
include('online.php');

?> 