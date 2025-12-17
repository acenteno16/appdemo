<? 
/*
include('sessions.php');

$query = "select id, currency from payments where mgmp = '0' limit 1000";
$result = mysqli_query($con, $query); 
while($row=mysqli_fetch_array($result)){

	$querybill = "select currency from bills where payment = '$row[id]' limit 1";
	$resultbill = mysqli_query($con, $querybill);
	$rowbill = mysqli_fetch_array($resultbill);
	
	$val = 4;
	//Cordobas-Cordobas
	if(($row['currency'] == 1) and ($rowbill['currency'] == 1)){
		$val = "1";
	}
	//Dolares-Dolares
	if(($row['currency'] == 2) and ($rowbill['currency'] == 2)){
		$val = "2";
	}
	//Dolares-Cordobas
	if(($row['currency'] == 1) and ($rowbill['currency'] == 2)){
		$val = "3";
	}
	
	echo '<br>'.$queryupdate = "update payments set mgmp='$val' where id = '$row[id]'";
	$resultupdate = mysqli_query($con, $queryupdate);
	
}
*/
?>