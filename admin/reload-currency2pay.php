<?php 

include_once("sessions.php");

$id = $_POST['variable'];
$query = "select currency from providers where id = '$id'";
$result = mysqli_query($con, $query); 
$num = mysqli_num_rows($result);
if($num > 0){
	$row = mysqli_fetch_array($result);
	echo number_format($row['currency'], 0); 
}else{
	echo "1";
} 