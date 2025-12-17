<?php 

require('config.php');

session_start();

if(($_SESSION['2fa_verified'] == true) and ($_SESSION["scholarships"] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noScholarships"); 	 
}

include('online.php');
	
?> 