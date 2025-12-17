<?php 

session_start();
session_destroy();
header("location: ../");
$_SESSION["userid"] = "";
$_SESSION["firstname"] = "";
$_SESSION["lastname"] = ""; 
$_SESSION["email"] = ""; 
$_SESSION["unit"] = ""; 
$_SESSION["authdata"] = "";
$_SESSION["id"] = ""; 

?>
