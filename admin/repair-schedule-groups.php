<? 

include('sessions.php');

$querygroups = "select * from schedule where vo = '0'";
$resultgroups = mysqli_query($con, $querygroups);
echo 'Num: '.$numgroups = mysqli_num_rows($resultgroups);
while($rowgroups = mysqli_fetch_array($resultgroups)){
	$querygroups_c = "select * from schedulecontent where schedule = '$rowgroups[id]'";
	$resultgroups_c = mysqli_query($con, $querygroups_c);
	while($rowgroups_c = mysqli_fetch_array($resultgroups_c)){
		//echo '<br>'.$rowgroups_c['payment'];
		$querypayment = "select * from payments where id = '$rowgroups_c[payment]'";
		$resultpayment = mysqli_query($con, $querypayment);
		$rowpayment = mysqli_fetch_array($resultpayment);
		
		if($rowpayment['status'] >= 13){
			echo '<br>-'.$rowgroups['id']; 
			$queryupdate = "update schedule set vo = '1' where id = '$rowgroups[id]'"; 
			//$resultupdate = mysqli_query($con, $queryupdate); 
		
		}
	}
}

?>