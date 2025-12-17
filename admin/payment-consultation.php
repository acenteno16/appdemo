<?php session_start();

if($_SESSION["consultation"] == "active"){
	include("../connection.php");
	}else{
		session_destroy();
		header("location: ../?err=noconsultation_payment_consultation");	  
	}
	
?> 