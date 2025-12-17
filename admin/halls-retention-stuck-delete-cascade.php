<?php 

session_start(); 
if(($_SESSION['admin'] == "active") or ($_SESSION["imistuck"] == 'active')){
	include("../connection.php");  
}else{
	session_destroy();
	header("location: ../?err=noadmin-or-retention");	 
}

include('functions.php');

$id = isset($_POST['theid']) ? sanitizeInput(explode(',', $_POST['theid']), $con) : [];

for($i=0;$i<sizeof($id);$i++){
	$query = "update payments set ret1void = '1' where id = ?";
	$stmt = $con->prepare($query);
	$stmt->bind_param("i", $id[$i]);
	$stmt->execute();
}

header('location: halls-retention-stuck.php');   
 
?>