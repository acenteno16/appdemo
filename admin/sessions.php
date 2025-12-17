<?php

require('config.php');

if(!isset($_SESSION)){ session_start(); }

if(($_SESSION['2fa_verified'] == true) and (($_SESSION["generalsession"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['spellas'] == "active"))){
	include("../connection.php");
}else{
	if(isset($_SESSION)){ session_destroy(); }
	header("location: ../?err=nosession_sessions");	  
} 
	
include('online.php');

?> 