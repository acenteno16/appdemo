<?php 

require( 'headers.php' );
$allowedRoles = [ 'admin', '2FA' ];
require( "sessionCheck.php" );

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$tools = isset($_POST['tools']) ? intval($_POST['tools']) : 0;

if(($id > 0) and ($tools == 1)){
	
	$query = "update workers set msActive='', uid='' where id = '$id'";
	$result = mysqli_query($con, $query);
	header('Location: '.$_SERVER['HTTP_REFERER']);
	
}else{
	exit("<script nonce='$nonce'>alert('Debe de seleccionar una opcion.');history.go(-1);</script>");
}

?>