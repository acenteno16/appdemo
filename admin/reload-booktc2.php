<?php include("sessions.php");

$comma = $_POST['comma'];
$tcchange = $_POST['tchange'];
$today = date("Y-m-d", strtotime($tcchange));
$process = $_POST['process'];
$ammount = 0;

/*
$comma = "200,2,300,48,10";
$today = "2014-11-10";
$process = 1;
*/

$query = "select * from tc where today = '$today'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);      
if($num > 0){
	$row = mysqli_fetch_array($result);
	$tc = $row['tc']; 

$a = explode(',',$comma); 

foreach($a as $val1){
	switch($process){
		case 1:
		$calculation1 = $val1*$tc;
		//echo $val1."*".$tc."=".$calculation1."<br>";
		if($calculation1 >= 1000){
			$ammount+= $calculation1;
		}
		break;
		case 2:
		$calculation1 = $val1*$tc;
		$ammount+= $calculation1; 
		break;
	}
	
}
echo str_replace(',','',number_format($ammount,4)); 
}