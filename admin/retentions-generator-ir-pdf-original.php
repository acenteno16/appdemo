<?php 

include("session-retentions.php");

if($_SESSION['irprint'] == 'active'){
	include("pdf-ir-original.php"); 
}else{
	echo "<script>alert('No tiene permisos de impresion de retenciones IR.'); history.go(-1);</script>";
}
 
?>