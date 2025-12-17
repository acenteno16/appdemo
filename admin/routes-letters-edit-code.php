<? 

include('session-admin.php');

$id = $_POST['id'];
$access = $_POST['access'];
for($c = 0; $c < sizeof($access); $c++) {
	$access_chain = $access_chain . "$access[$c],"; 
}

$query = "update routes set access = '$access_chain' where id = '$id'";
$result = mysqli_query($con, $query);

header('location: routes-letters.php');

?>