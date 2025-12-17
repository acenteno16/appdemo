<?php 

require('config.php');

session_start();

if(($_SESSION["retentions"] == "active") or ($_SESSION['admin'] == "active")){ 
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noRetentions"); 	 
}

include('online.php');
	
?> 