<? 

function taxCredit($paymentId, $type, $con){
	
	$today = date('Y-m-d');
	$totime = date('H:i:s'); 
	
	$queryBills = "select * from bills where payment = '$paymentId' and tax > '0'";
	$resultBills = mysqli_query($con, $queryBills);
	while($rowBills=mysqli_fetch_array($resultBills)){
	
			$queryInsert = "insert into taxCredit (today, totime, payment, bill, type, userid, status) values ('$today', '$totime', '$paymentId', '$rowBills[id]', '$type', '$_SESSION[userid]', '1')";
			$resultInsert = mysqli_query($con, $queryInsert);
		
	}
		
}

?>