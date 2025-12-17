<?php include("sessions.php");

$submitType = $_POST['submitType'];
$today = $_POST['today'];
$today = date("Y-m-d", strtotime($today));
$tc = $_POST['tc'];


if($submitType == 0){
	
	$query = "insert into tc (today, tc) values ('$today', '$tc')";
	$result = mysqli_query($con, $query);
	
}else{
	
	$from = $_POST['from'];
	$from = strtotime($from);
	$to = $_POST['to'];
	$to = strtotime($to);
	
	for($i=$from; $i<=$to; $i+=86400){
		
		$thisToday = date("Y-m-d", $i);
		
		$queryCheck = "select id from tc where today = '$thisToday'";
		$resultCheck = mysqli_query($con, $queryCheck);
		$numCheck = mysqli_num_rows($resultCheck);
		
		if($numCheck == 0){
			$query = "insert into tc (today, tc) values ('$thisToday', '$tc')";
			$result = mysqli_query($con, $query);
		}
    	
	}
	
}

header('location: '.$_SERVER['HTTP_REFERER']);

?>