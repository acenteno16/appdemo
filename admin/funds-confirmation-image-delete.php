<? 

include('sessions.php');

$id = $_POST['id'];

$queryFund = "select * from funds where id = '$id' and userid = '$_SESSION[userid]'";
$resultFund = mysqli_query($con, $queryFund);
$numFund = mysqli_num_rows($resultFund);
if($numFund > 0){
	
	$theFile = "../../funds/$id.jpg";
	if(file_exists($theFile)){
		unlink($theFile);
		$val = '1';
	}else{
		$val = '2';
	}
	
}else{
	$val = '3';
}


?>

<? echo $val; ?>