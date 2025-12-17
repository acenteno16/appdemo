<?php 

include("sessions.php");

$today = date("Y-m-d", strtotime($_POST['today']));
$query = "select * from tc where today = '$today'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result); 
if($num > 0){
	$row = mysqli_fetch_array($result);
	echo $tc = $row['tc']; 	
}else{
	echo "0";   
}