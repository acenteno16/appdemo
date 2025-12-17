<? 

include('sessions.php');

function tc($today){
	
	include_once('sessions.php');
	
	$query = "select tc from tc where today = '$today'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	
	return $row['tc'];
	
}

?>