<?php 

require('config.php');

session_start();

if(($_SESSION["provision"] == "active") or ($_SESSION["provision_global"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION['request'] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=nosession_remission"); 	 
}

include('online.php');
	
?> 