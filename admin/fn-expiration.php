<?php


function getExpiration($paymentid){  
	include('../connection.php');  
	
	$querypayment = "select expiration, status from payments where id = '$paymentid'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	
	$date1 = date("Y-m-d");
	$date2 = $rowpayment['expiration'];
	$date3 = date('d-m-Y',strtotime($rowpayment['expiration']));  
	if($date2 == "0000-00-00"){
		$date2 = date("Y-m-d"); 
		$date3 = date('d-m-Y',strtotime($date2)); 
	}
	
	
	if($rowpayment['status'] == 14){
		$querytime = "select today from times where payment = '$paymentid' and stage = '14.00' limit 1";
		$resulttime = mysqli_query($con, $querytime);
		$rowtime = mysqli_fetch_array($resulttime);
		
		$date1 = $rowtime['today'];
	}


	$dias = (strtotime($date1)-strtotime($date2))/86400;
	
	if($dias <= -8) $parentesis = ' <span style="color:#060">('.intval(abs($dias)).")</span>";
	if(($dias <= 0) and ($dias >= -7)) $parentesis =  ' <span style="color:#FC0">('.intval(abs($dias)).")</span>";
	elseif($dias > 0) $parentesis = ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>";
	
	$vencimiento = $date3." ".$parentesis;
	return($vencimiento); 
	
}

?>