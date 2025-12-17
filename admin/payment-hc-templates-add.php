<?php 

include("session-request.php"); 
if(($_SESSION['request-7'] == 'active') or ($_SESSION['admin'] == 'active')){ 
	#doNothing
}else{
	exit('<script>alert("Error de persimos. Contactar al administrador."); window.location = "dashboard.php";</script>');
}

$today = date('Y-m-d');

$query = "insert into hcTemplates (today, userid) values ('$today', '$userid')";
$result = mysqli_query($con, $query);
$id = mysqli_insert_id($con);

header('location: payment-hc-templates-edit.php?id='.$id);

?>