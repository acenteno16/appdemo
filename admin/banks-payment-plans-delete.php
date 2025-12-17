<? 

include('sessions-admin.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "delete from bankspaymentplans where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

header('location: '.$_SERVER['HTTP_REFERER']);

?>