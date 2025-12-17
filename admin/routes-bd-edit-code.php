<? 

include('sessions.php');

$id = $_POST['id'];
$company = $_POST['company'];

$query = "update routes set company = '$company' where id = '$id'";
$result = mysqli_query($con, $query);

header('location: routes-bd.php');

?>