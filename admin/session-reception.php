<?php 

#require('config.php');
ini_set('session.cookie_secure', 1); // Solo enviar cookies por HTTPS
ini_set('session.cookie_httponly', 1); // Impide el acceso a las cookies desde JavaScript

session_start();

if(($_SESSION['2fa_verified'] == true) and ($_SESSION["filereception"] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=nosession_reception");	 
}
	
include('online.php');

?> 