<? 

include("session-providers.php"); 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$queryDelete = "delete from plans where id = ?";
$stmtDelete = $con->prepare($queryDelete);
$stmtDelete->bind_param("i", $id);
$stmtDelete->execute();

header('location: '.$_SERVER['HTTP_REFERER']);

?>