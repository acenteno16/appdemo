<?php 

require('config.php');

session_start();

if(($_SESSION["request"] == "active") or ($_SESSION["provision"] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=3");	 
}

include('online.php');
	
?> 