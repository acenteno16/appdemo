<? 

include('sessions.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$queryDelete = "delete from hcfiles where id = ?";
$stmtDelete = $con->prepare($queryDelete);
$stmtDelete->bind_param("i", $id);
$stmtDelete->execute();

header('location: payment-hc-docs.php');

?>