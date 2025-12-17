<?php 

include("session-retentions.php");

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);
 
/*
if($_SESSION["admin"] == "active"){
	//Do Nothing
}else{

	$id = $_POST['theid'];
	$queryprint = "update payments set irprinted = 1 where id = '$id'";
	$resultprint = mysqli_query($con, $queryprint);

}
*/ 

if($_SESSION['irprint'] == 'active'){
	include("pdf-ir.php");
}else{
	echo "<script>alert('No tiene permisos de impresion de retenciones IR.'); history.go(-1);</script>";
}
 
?>