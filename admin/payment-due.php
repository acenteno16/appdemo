<?php include("session-request.php");

$today = date('Y-m-d');

$query = "select * from payments where expired = '0' or expired = '1'";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	$rowtime = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' and stage = '1'"));
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
	
	$date1 = $rowtime['today'];
	$date2 = strtotime('+'.$rowprovider['term'].' day',strtotime($date1));
	$date2 = date('Y-m-d',$date2);
	
	$date3 =  strtotime('-7 day',strtotime($date2));
	$date3 = date('Y-m-d',$date3);
	
	
	echo 'Ingresado: '.$date1.' <br>
	Vence: a los:'.$rowprovider['term'].' dias <br>
	El: '.$date2.' <br>
	Esta proximo: '.$date3.'<br><br>
';
	if($today >= $date3){
		//update payment to timed
		$query1 = "update payments set expired = '1' where id = '$row[id]'";
		$result1 = mysqli_query($con, $query1);
	} 
	if($today >= $date2){
		//update payment to expitated
		$query2 = "update payments set expired = '2' where id = '$row[id]'";
		$result2 = mysqli_query($con, $query2);
	} 
	 
	
	
}

?>