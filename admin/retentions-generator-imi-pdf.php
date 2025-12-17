<?php 


#ini_set('display_errors', '1');
#ini_set('display_startup_errors', '1');
#error_reporting(E_ALL);

include("session-retentions.php"); 
/*
$scheduleid = $_POST['scheduleid'];
$queryprint = "update schedule set imiprinted = 1 where id = '$scheduleid'";
$resultprint = mysqli_query($con, $queryprint);
*/

if($_SESSION['imiprint'] == "active"){
	include("pdf-imi.php");
}else{
	echo "<script>alert('No tiene permisos de impresion de retenciones IMI.'); history.go(-1);</script>";
}

?>