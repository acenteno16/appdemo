<?php 

require('config.php');

session_start();

if($_SESSION["payer"] == "active"){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=9");	 
}

include('online.php');
	
?> 