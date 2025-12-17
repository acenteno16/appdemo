<?

function createIMIRetention($id, $dateType, $hallId) {
	
	include('sessions.php');
	$forced = 0;
	
	$queryPayment = "select approved, route, hall, status from payments where id = '$id'";
	$resultPayment = mysqli_query($con, $queryPayment);
	$rowPayment = mysqli_fetch_array($resultPayment);
	
	if(($rowPayment['approved'] == 1) and ($rowPayment['status'] >= 13)){
	
	   $today = date('Y-m-d');

	   $queryVoid = "update hallsretention set void = '1', voidcomments='Anulada por getPay para generar una nueva.', voidtoday='$today', voiduserid='999999999' where payment = '$id' and void = '0'";
	   $resultVoid = mysqli_query($con, $queryVoid);
	
       if($dateType == 0){
		   #doNothing
	   }elseif($dateType == 1){
            
            $querytoday = "select today from times where payment = '$id' and stage = '13' order by id desc limit 1";
            $resulttoday = mysqli_query($con, $querytoday);
            $rowtoday = mysqli_fetch_array($resulttoday);
           
            $today = $rowtoday['today'];
		   
       }elseif (strtotime($dateType)) {
    		// Si no es 0 y strtotime reconoce la fecha, entonces es válida
    		$today = $dateType;
		   $forced = 1;
	   }
	
	   $billChainNumber = array();
       $billChainId = array();
  	   $billChainAmount = array();

  	   $binc = 0;
	   $globalBillChainSize = 0;
	
  	$query_bills = "select id, number, ret1a from bills where payment = '$id' and ret1a > '0'";
  	$result_bills = mysqli_query($con, $query_bills);
  	while($row_bills = mysqli_fetch_array($result_bills)){
		
	  	$billChainSize = strlen($row_bills['number'].', ');
	  	if($globalBillChainSize+$billChainSize <= 40){
			$globalBillChainSize += $billChainSize;
		}else{
			$binc++;
			$globalBillChainSize = $billChainSize;
		}
		
		if(!isset($billChainNumber[$binc])){
			$billChainNumber[$binc] = '';
		}

		if(!isset($billChainId[$binc])){
			$billChainId[$binc] = '';
		}
		
		if(!isset($billChainAmount[$binc])){
			$billChainAmount[$binc] = 0;
		}
		
		$billChainNumber[$binc] = $billChainNumber[$binc].$row_bills['number'].',';
		$billChainId[$binc] = $billChainId[$binc].$row_bills['id'].',';
		$billChainAmount[$binc]= $billChainAmount[$binc]+$row_bills['ret1a'];
		
	}
	
  	for($ib=0;$ib<sizeof($billChainNumber);$ib++){

    	$thisChainNumber = $billChainNumber[$ib];
    	$thisChainNumber = substr($thisChainNumber,0,-1); 
    	$thisChainId = $billChainId[$ib];
    	$thisChainId = substr($thisChainId,0,-1); 
		$thisChainAmount = $billChainAmount[$ib];

    	/*if($hallId == 999999999){
			
			$queryRtype =  "select * from units where code = '$rowPayment[route]' or code2 = '$rowPayment[route]'";
			$resultRtype = mysqli_query($con, $queryRtype);
			$numRtype = mysqli_num_rows($resultRtype);
			$r=0;
			while($rowRtype = mysqli_fetch_array($resultRtype)){
				
				if($rowRtype['managua'] == 0){
					if($r==0){
					$strRoutes.= " and (FIND_IN_SET('$rowRtype[code]',halls.units) > 0";
					}else{
					$strRoutes.= " or FIND_IN_SET('$rowRtype[code]',halls.units) > 0";
					}
					$r++;
					if($r == $numRtype){
					$strRoutes.= ")";
					}
				}else{
					$strRoutes = " and halls.units like '%$rowPayment[route]%'";
				}
			}
		
			$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0'$strRoutes order by hallsretention.id asc limit 1";
			$resultgretention = mysqli_query($con, $querygretention);
    		$numgretention = mysqli_num_rows($resultgretention);
		}
		else */ 
			
		if($hallId == 0){
			$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0' and hallsretention.void = '0' and halls.id = '$rowPayment[hall]' order by hallsretention.id asc limit 1";
			$resultgretention = mysqli_query($con, $querygretention);
    		$numgretention = mysqli_num_rows($resultgretention);
		}
		elseif($hallId > 0){
			$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0' and hallsretention.void = '0' and halls.id = '$hallId' order by hallsretention.id asc limit 1";
			$resultgretention = mysqli_query($con, $querygretention);
    		$numgretention = mysqli_num_rows($resultgretention);
		}

    	if($numgretention > 0){
            
			$rowgretention = mysqli_fetch_array($resultgretention);
			$idgretention = $rowgretention['id'];
            
            $queryHall = "select version from halls where id = '$rowgretention[hall]'";
            $resultHall = mysqli_query($con, $queryHall);
            $rowHall = mysqli_fetch_array($resultHall);
            
			$querygretention2 = "update hallsretention set status = '1', payment='$id', created='$today', billsno='$thisChainNumber', billsid='$thisChainId', amount='$thisChainAmount', version='$rowHall[version]' where id = '$idgretention'";
			$resultgretention2 = mysqli_query($con, $querygretention2);
			
			$pre = '';
			$queryRead = "select ret1id from payments where id = '$id'";
			$resultRead = mysqli_query($con, $queryRead);
			$rowRead = mysqli_fetch_array($resultRead);
			if($rowRead['ret1id'] != ''){
				$pre = $rowRead['ret1id'].',';
			}
			
			$preIdgretention = $pre.$idgretention;	
			
			$query_update = "update payments set ret1id = '$preIdgretention', mayorstage = '1' where id = '$id'";
			$result_update = mysqli_query($con, $query_update);

    	}

  	}
		
	}
	else{
		
		$query_update = "update payments set ret1void = '1' where id = '$id'";
		$result_update = mysqli_query($con, $query_update);
		
	}

}

?>