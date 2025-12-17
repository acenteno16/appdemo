<?php 

session_start(); 
if(($_SESSION['admin'] == "active") or ($_SESSION["imistuck"] == 'active')){
	include("../connection.php");  
}else{
	session_destroy();
	header("location: ../?err=noadmin-or-retention");	 
}

#$id = $_GET['id'];

#$querypayments = "update payments set ret1void = '1' where id = '$id'";
#$resultpayments = mysqli_query($con, $querypayments);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    
	$id = intval($_GET['id']); 
    $querypayments = "UPDATE payments SET ret1void = '1' WHERE id = ?";
    $stmt = $con->prepare($querypayments);
    $stmt->bind_param("i", $id); 
	$stmt->execute();
	$stmt->close();
}

header('location: halls-retention-stuck.php');   
	 
?>