<? 

require('session-admin.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$queryDelete = "delete from hallsbooknotifications where id = ?";
$stmtDelete = $con->prepare($queryDelete);
$stmtDelete->bind_param("i", $id);
$stmtDelete->execute();

header('location: halls-retention-notifications.php');

?>