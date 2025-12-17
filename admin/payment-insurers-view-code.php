<? 

include("sessions.php");

$id = $_POST['id'];

$billid = $_POST['ibillid'];
$billdate3 = $_POST['billdate3'];
$billdate4 = $_POST['billdate4'];
$billdate5 = $_POST['billdate5'];
$billdate6 = $_POST['billdate6'];
$billcomments = $_POST['billcomments'];

for($c=0;$c<sizeof($billid);$c++){
	
	if($billdate3[$c] != ""){
		$today3 = date("Y-m-d", strtotime($billdate3[$c]));
	}else{
		$today3 = "";
	}
	
	if($billdate4[$c] != ""){
		$today4 = date("Y-m-d", strtotime($billdate4[$c]));
	}else{
		$today4 = "";
	}
	
	if($billdate5[$c] != ""){
		$today5 = date("Y-m-d", strtotime($billdate5[$c]));
	}else{
		$today5 = "";
	}
	
	if($billdate6[$c] != ""){
		$today6 = date("Y-m-d", strtotime($billdate6[$c]));
	}else{
		$today6 = "";
	}
	
	$query_bills = "update bills set billdate3='$today3', billdate4='$today4', billdate5='$today5', billdate6='$today6', billcomments='$billcomments[$c]' where id = '$billid[$c]'";
	$result_bills = mysqli_query($con, $query_bills);

}

header('location: payments-insurers-consultations.php'); 

?>