<?php 

include("session-schedule.php");

$id = $_POST['variable'];
$message = $_POST['message'];

$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if($row['blockschedule'] == ""){
	
	$query2 = "update payments set blockschedule = '$_SESSION[userid]' where id = '$id'"; 
	$result2 = mysqli_query($con, $query2);
	if($message == 1){
		echo "Pago ".$id." bloqueado con exito.";  
	}
	
}else{
	$rowprocessor = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[blockschedule]'"));
	$processor = $rowprocessor['first']." ".$rowprocessor['last'];
	echo "El pago ".$id." se encuentra bloqueado por ".$processor;
}


?>