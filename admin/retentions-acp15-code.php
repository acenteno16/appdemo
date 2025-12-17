<?php 

include('session-admin.php');

$id = $_POST['id'];

$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$ret_ir = $row['ret2'];
$acp_ir = $row['acp2'];

if((($ret_ir == 15) or ($ret_ir == 10)) and ($acp_ir == 0)){
	
	$queryupdate = "update payments set acp2 = '1' where id = '$id'";
	$resultupdate = mysqli_query($con, $queryupdate);
	
	echo "<script>alert('Corregido correctamente.'); window.location = 'retentions-home.php'; </script>";
	
}else{
	
	echo "<script>alert('No se efectuaron cambios.'); history.go(-1); </script>";

	 }


?>