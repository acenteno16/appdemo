<? 

include('sessions.php');

$id = $_POST['variable'];

$query = "select cc from providers where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if($row['cc'] == 1){
	echo "1";
}else{
	echo "0";
}

?>