<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and ($_SESSION["fundsApprove2"] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=0");	  
}

include('online.php');
	
?>