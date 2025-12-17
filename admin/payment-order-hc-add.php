<?php 

include("session-request.php");  
if(($_SESSION['request-7'] == 'active') or ($_SESSION['admin'] == 'active')){ 
	#doNothing
}else{
	exit('<script>alert("Error de persimos. Contactar al administrador."); window.location = "dashboard.php";</script>');
}

$today = date('Y-m-d');
$user = $_SESSION['userid'];

$query = "insert into payments (today, status, userid, type, hc, private) values ('$today', '0', '$user', '7', '1', '1')"; 
$result = mysqli_query($con, $query); 
$id = mysqli_insert_id($con);

header("location: payment-order-hc.php?id=".$id);

?>