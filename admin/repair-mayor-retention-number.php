<?php
/*
include("../connection.php");
$ii=0;

$queryupdate1 = mysqli_query($con, "update hallsretention set payment = '0', status='0'");
$queryupdate2 = mysqli_query($con, "update payments set ret1id = '0'"); 

$query = "select * from schedule where status = '6'";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
	$query2 = "select * from schedulecontent where schedule = '$row[id]'";
	$result2 = mysqli_query($con, $query2);
	while($row2=mysqli_fetch_array($result2)){  

		
		$querypayment = "select * from payments where id = '$row2[payment]'";
		$resultpayment = mysqli_query($con, $querypayment);
		$rowpayment = mysqli_fetch_array($resultpayment);
		
		if($rowpayment['ret1a'] > 0){ 
			$ii++;
		$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0' and halls.units like '%$rowpayment[route]%' order by hallsretention.id asc limit 1"; 
	echo '<br>Payment :'.$rowpayment['id'];	
	echo '<br>Route :'.$rowpayment['route'];	
	$resultgretention = mysqli_query($con, $querygretention);
	$numgretention = mysqli_num_rows($resultgretention);
	if($numgretention > 0){
		$rowgretention = mysqli_fetch_array($resultgretention);
		$idgretention =  $rowgretention['id'];	
		echo "<br>".$querygretention2 = "update hallsretention set status = '1', payment='$rowpayment[id]' where id = '$idgretention'";
		$resultgretention2 = mysqli_query($con, $querygretention2);
		
		$querypu = "update payments set ret1id='$idgretention' where id = '$rowpayment[id]'"; 
		$resultpu = mysqli_query($con, $querypu);   
		    
		
	}
	
	}
	
	
		
	} //end row2

} // Enn $row


echo "<br> ii=".$ii;
*/
?>