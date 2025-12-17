<? 

include("session-admin.php");
include('functions.php');

$id = isset($_POST['id']) ? sanitizeInput(intval($_POST['id']), $con) : 0;
$worker = isset($_POST['worker']) ? sanitizeInput($_POST['worker'], $con) : 0;
$unit = isset($_POST['unit']) ? sanitizeInput($_POST['unit'], $con) : 0;
$company = isset($_POST['company']) ? sanitizeInput($_POST['company'], $con) : 0;

if($id == 0){
	$query = "insert into routes (type) values ('48')";
	$result = mysqli_query($con, $query);
	$id = mysqli_insert_id($con);
}

$query = "update routes set worker = ?, company = ? where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("sii", $worker,$company,$id);
$stmt->execute();

header('location: routes-tax.php'); 

?>