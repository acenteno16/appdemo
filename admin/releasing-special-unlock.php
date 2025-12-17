<?php 

include("session-releasing-special.php");

$id = $_GET['id'];
$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if(($row['blockrelease'] == $_SESSION['userid']) or ($_SESSION['admin'] == "active")){
	$query = mysqli_query($con, "update payments set blockrelease='' where id = '$id'");
	header('location: releasing-special.php'); 
}else{ 

echo "<script>alert('Error de persmisos.');</script>";
session_destroy();
header('location: ../');    

} 

?>