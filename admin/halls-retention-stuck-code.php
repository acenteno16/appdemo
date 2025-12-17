<?php 

#ini_set('display_errors', '1');
#ini_set('display_startup_errors', '1');
#error_reporting(E_ALL);

session_start();

if(($_SESSION['admin'] == "active") or ($_SESSION["imistuck"] == "active")){
	include("../connection.php"); 
}else{
	session_destroy();
	header("location: ../?err=noadmin-or-retention");	 
}

include('imiGenerator.php');

$theid = $_POST['theid'];
$hallid = $_POST['hallid'];
$datetype = $_POST['datetype'];

echo sizeof($theid);

//Start for
for($c=0;$c<sizeof($theid);$c++){
	#echo "<br>-createIMIRetention($theid[$c], $datetype, $hallid[$c]);";
	createIMIRetention($theid[$c], $datetype, $hallid[$c]);
	
}	

header('location: halls-retention-stuck.php');

?>