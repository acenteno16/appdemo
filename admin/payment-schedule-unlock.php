<?php 

include("session-schedule.php");

$id = $_GET['id'];
$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if($row['blockschedule'] == $_SESSION['userid']){
	$query = mysqli_query($con, "update payments set blockschedule='' where id = '$id'");
	header('location: payment-schedule.php');
}else{ 

echo "<script>alert('Error de persmisos.');</script>";
session_destroy(); 
header('location: ../');    

} 

?>