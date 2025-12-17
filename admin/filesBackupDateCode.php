<? 

exit();

/*
include('session-admin.php');

if($_SESSION['email'] != 'jairovargasg@gmail.com'){
	exit();
}	

$bdate = $_POST['bdate'];
if($bdate != ''){
	
	$bdate = date("Y-m-d", strtotime($bdate)); 
	$query = "update config set dateBackup = '$bdate' where id = '1'";
	$result = mysqli_query($con, $query);
	
}

header('location: filesBackupDate.php');
*/
?>