<?php 

include("session-admin.php");

$today = date("Y-m-d");

$id = $_GET['id'];

$comments = 'Talonario anulado.';

$queryVoid = "update hallsbook set void = '1' where id = '$id'";
$resultVoid = mysqli_query($con, $queryVoid);

$queryVoidDetail = "update hallsretention set void = '1', voidcomments='$comments', voidtoday='$today', voiduserid='$_SESSION[userid]' where book = '$id'";
$resultVoidDetail = mysqli_query($con, $queryVoidDetail);
	
echo "<script>alert('Talonario anulado con exito!'); window.location = 'halls-retention.php'; </script>";
	 
?>