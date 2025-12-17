<?php

function fnRelative($paymentid){
	
	include('sessions.php');
	
	$allpayments = "";
	//Get payment information
	$querypayment = "select status from payments where id = '$paymentid'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	
	if($rowpayment['status'] == 1){
		$sqlu = "";
		$numu = 0;
		$queryu = "select * from routes where worker = '$_SESSION[userid]' and type = '2'";
		$resultu = mysqli_query($con, $queryu);
		$numu = mysqli_num_rows($resultu);
		if($numu > 0){
			$firstu = 1;
			while($rowu=mysqli_fetch_array($resultu)){
				if($firstu == 1){ //First
					$sqlu = " and (((payments.routeid = '$rowu[unitid]'))";
					if($numu == 1){ $sqlu .= ")"; } $firstu++;
				}elseif($firstu == $numu){ //Last
					$sqlu .= " or ((payments.routeid = '$rowu[unitid]')))";
					$firstu++;
				}else{ //Middle
					$sqlu .= " or ((payments.routeid = '$rowu[unitid]'))";
					$firstu++;
				}
			}
			
			$query = "select payments.id from payments inner join workers on payments.userid = workers.code where payments.status = '1' and payments.arequest = '1' and payments.approved = '0'".$sqlu." order by payments.expiration desc"; 
			$result = mysqli_query($con, $query);
			$num = mysqli_num_rows($result);
			while($row=mysqli_fetch_array($result)){
				$allpayments.= $row['id'].',';
			}
		} 
	
		$allpayments; 

		$myarray = explode(',',$allpayments); 
		$myarray = array_unique($myarray);

		if(in_array($paymentid, $myarray)) {
    		return true; 
		}else{
			return false;
		}
	} //end if
	
	if($rowpayment['status'] == 2){
		$sqlu = "";
		$numu = 0;
		$queryu = "select * from routes where worker = '$_SESSION[userid]' and type = '3'";
		$resultu = mysqli_query($con, $queryu);
		$numu = mysqli_num_rows($resultu);
		if($numu > 0){
			$firstu = 1;
			while($rowu=mysqli_fetch_array($resultu)){
				if($firstu == 1){ //First
					$sqlu = " and (((payments.routeid = '$rowu[unitid]') and (payments.headship = '$rowu[headship]'))";
					if($numu == 1){ $sqlu .= ")"; } $firstu++;
				}elseif($firstu == $numu){ //Last
					$sqlu .= " or ((payments.routeid = '$rowu[unitid]') and (payments.headship = '$rowu[headship]')))";
					$firstu++;
				}else{ //Middle
					$sqlu .= " or ((payments.routeid = '$rowu[unitid]') and (payments.headship = '$rowu[headship]'))";
					$firstu++;
				}
			}
			
			//2	
			
			$query = "select payments.id from payments inner join workers on payments.userid = workers.code where payments.status = '2' and payments.arequest = '1' and payments.approved = '0'".$sqlu." order by payments.expiration desc"; 
			$result = mysqli_query($con, $query);
			$num = mysqli_num_rows($result);
			while($row=mysqli_fetch_array($result)){
				$allpayments.= $row['id'].',';
			}
		} 
	
		$allpayments; 

		$myarray = explode(',',$allpayments); 
		$myarray = array_unique($myarray);
		if(in_array($paymentid, $myarray)) {
    		return true;
		}else{
			return false;
		}
	} //end if
	
	if($rowpayment['status'] == 3){
		$sqlu = "";
		$numu = 0;
		$queryu = "select * from routes where worker = '$_SESSION[userid]' and type = '4'";
		$resultu = mysqli_query($con, $queryu);
		$numu = mysqli_num_rows($resultu);
		if($numu > 0){
			$firstu = 1;
			while($rowu=mysqli_fetch_array($resultu)){
				if($firstu == 1){ //First
					$sqlu = " and (((payments.routeid = '$rowu[unitid]') and (payments.headship = '$rowu[headship]'))";
					if($numu == 1){ $sqlu .= ")"; } $firstu++;
				}elseif($firstu == $numu){ //Last
					$sqlu .= " or ((payments.routeid = '$rowu[unitid]') and (payments.headship = '$rowu[headship]')))";
					$firstu++;
				}else{ //Middle
					$sqlu .= " or ((payments.routeid = '$rowu[unitid]') and (payments.headship = '$rowu[headship]'))";
					$firstu++;
				}
			}
			//1	
			
			$query = "select payments.id from payments inner join workers on payments.userid = workers.code where payments.status = '3' and payments.arequest = '1' and payments.approved = '0'".$sqlu." order by payments.expiration desc"; 
			$result = mysqli_query($con, $query);
			$num = mysqli_num_rows($result);
			while($row=mysqli_fetch_array($result)){
				$allpayments.= $row['id'].',';
			}
		} 
	
		$allpayments; 

		$myarray = explode(',',$allpayments); 
		$myarray = array_unique($myarray);

		if(in_array($paymentid, $myarray)) {
			return true;
		}else{
			return false;
		}
	} //end if  
	
} //End function

function fnRelative2($paymentid){ 
	
		include('sessions.php');
		
		$sqlu = ""; 
		$numu = 0;
		$queryu = "select * from routes where worker = '$_SESSION[userid]' and type = '5'";
		$resultu = mysqli_query($con, $queryu);
		$numu = mysqli_num_rows($resultu);
		if($numu > 0){
									$firstu = 1;
									 	
									while($rowu=mysqli_fetch_array($resultu)){
										
										$sql = " and (payments.status = '2' or payments.status = '3' or payments.status = '4')";
 										
										
										if($firstu == 1){ //First
											$sqlu = " and (((payments.routeid = '$rowu[unitid]') ".$sql.")";
											if($numu == 1){ $sqlu .= ")"; }
											$firstu++;
										}elseif($firstu == $numu){ //Last
											$sqlu .= " or ((payments.routeid = '$rowu[unitid]') ".$sql."))";
											$firstu++;
										}else{ //Middle
											$sqlu .= " or ((payments.routeid = '$rowu[unitid]') ".$sql.")";
											$firstu++;
										}
									} 
							


//1st process 
$querybefore1 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join times on payments.id = times.payment where payments.id > '0'".$sqlu." group by payments.id order by payments.expiration desc"; 
//group by payments.userid 
$resultbefore1 = mysqli_query($con, $querybefore1);  
$numbefore1 = mysqli_num_rows($resultbefore1);
$globalpaymentsnumber=0;
while($rowbefore1=mysqli_fetch_array($resultbefore1)){
$allpayments.=$rowbefore1[0].',';
}
}

$myarray = explode(',',$allpayments); 
$myarray = array_unique($myarray);

if(in_array($paymentid, $myarray)) {
    return true;
}elseif($_SESSION['admin'] == 'active'){ 
	return true;
}else{
	return false;
}

} //End function

?>