<? 

include('sessions.php');

$id = $_GET['id'];

$sql = " and userid = '$_SESSION[userid]'";
if($_SESSION['admin'] == 'active'){
	$sql = '';
}

$querymain = "select * from funds where id = '$id' and status = '0'$sql";
$resultmain = mysqli_query($con, $querymain);
$nummain = mysqli_num_rows($resultmain);
if($nummain > 0){
	
	$queryUpdate = "update funds set status = '1.1', approved = '2' where id = '$id'";
	$resultUpdate = mysqli_query($con, $queryUpdate);
	
}

header('location: funds-confirmation.php');

?>