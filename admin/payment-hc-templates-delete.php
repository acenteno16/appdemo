<? 

include("session-request.php");  
if(($_SESSION['request-7'] == 'active') or ($_SESSION['admin'] == 'active')){ 
	#doNothing
}else{
	exit('<script>alert("Error de persimos. Contactar al administrador."); window.location = "dashboard.php";</script>');
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$queryDelete = "delete from hcTemplates where id = ?";
$stmtDelete = $con->prepare($queryDelete);
$stmtDelete->bind_param("i", $id);
$stmtDelete->execute();

$queryDelete2 = "delete from hcTemplatesContent where template = ?";
$stmtDelete2 = $con->prepare($queryDelete2);
$stmtDelete2->bind_param("i", $id);
$stmtDelete2->execute();

header('location: '.$_SERVER['HTTP_REFERER']);

?>