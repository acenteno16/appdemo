<? 

include('sessions.php');

//Crear retenciones Alcaldía (Codigo mejorado 40 Caracteres)

$today = date('Y-m-d');

$ids_chain = "49564,50895,51440,51033,51012,50966,50997,50992,50991,51000,51001,50998,50993,50996,50994,52704,50995,53163,53637,53612,50775,50986,52929,52678,53614,52206,52717,51380,51576,52773,54192,53866,53634,54218,52805,53518,53868,54538,52846,53884,52933,52911,52215,50302,54626,53056,52225,53064,51904,53631,53615,51905,51967,52684,53825,52427,52776,52196,52889,53670,52125,52887,52900,53243,52884,53826,52901,52882,52894,52899,53320,51871,52883,53524,51938,52671,54057,54249,53244,53144,52873,52924,54083,53912,54116,53523,53450,52325,54403,54329,54625,54466,54038,53891,52129,53142,53531,53788,54165,54227,54620,52319,48464,50159,49866,51371,54435,54498,52439,54117,54136,53533,54606,52042,52115,52912,53596,52730,52775,53071,53018,53062,53017,53403,53346,53813,53803,53804,54171,53939,54166,54504,54507,54320,53203,53579,54601,54189,54782,53962,54262,54839,54672,54680,52885,54416,51457,51460,54395,54322,54609,54575,52435";
$ids_chain_arr = explode(',', $ids_chain);
echo sizeof($ids_chain_arr); 

/*
$ids_chain = "49564,50895,51440,51033,51012,50966,50997,50992,50991,51000,51001,50998,50993,50996,50994,52704,50995,53163,53637,53612,50775,50986,52929";
$ids_chain_arr = explode(',', $ids_chain);

for($i=0;$i<sizeof($ids_chain_arr);$i++){

	echo '<br>'.$queryrets = "select * from hallsretention where void = '0' and payment = '$ids_chain_arr[$i]'";
	$resultrets = mysqli_query($con, $queryrets);
	while($rowrets=mysqli_fetch_array($resultrets)){

		//echo "<br>-".$rowrets['serial'].'-'.$rowrets['number'];
		
		echo '<br>'.$query_update = "update hallsretention set created = '2018-02-28' where id = '$rowrets[id]'";
		$result_update = mysqli_query($con, $query_update);

	}
	
}

echo '<br>i: '.$i;
/*
$ids_chain = "49564,50895,51440,51033,51012,50966,50997,50992,50991,51000,51001,50998,50993,50996,50994,52704,50995,53163,53637,53612,50775,50986,52929,52678,53614,52206,52717,51380,51576,52773,54192,53866,53634,54218,52805,53518,53868,54538,52846,53884,52933,52911,52215,50302,54626,53056,52225,53064,51904,53631,53615,51905,51967,52684,53825,52427,52776,52196,52889,53670,52125,52887,52900,53243,52884,53826,52901,52882,52894,52899,53320,51871,52883,53524,51938,52671,54057,54249,53244,53144,52873,52924,54083,53912,54116,53523,53450,52325,54403,54329,54625,54466,54038,53891,52129,53142,53531,53788,54165,54227,54620,52319,48464,50159,49866,51371,54435,54498,52439,54117,54136,53533,54606,52042,52115,52912,53596,52730,52775,53071,53018,53062,53017,53403,53346,53813,53803,53804,54171,53939,54166,54504,54507,54320,53203,53579,54601,54189,54782,53962,54262,54839,54672,54680,52885,54416,51457,51460,54395,54322,54609,54575,52435";
$ids_chain_arr = explode(',', $ids_chain);

for($i=0;$i<sizeof($ids_chain_arr);$i++){

	$querypayment = "select * from payments where id = '$ids_chain_arr[$i]'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	
				
	if($rowpayment['ret1a'] > 0){
		$bill_chain = "";
		$bill_chain2 ="";
		$bill_amount=""; 
		$binc = 0;
		$query_bills = "select number, id, ret1a from bills where payment = '$ids_chain_arr[$i]' and ret1a > '0'";
		$result_bills = mysqli_query($con, $query_bills);
		while($row_bills=mysqli_fetch_array($result_bills)){
			$this_number = $row_bills['number'];
			$this_number_size = strlen($this_number)+1;
			if(strlen($bill_chain[$binc])+$this_number_size <= 41){
				$bill_chain[$binc].=$this_number.',';
				$bill_chain2[$binc].=$row_bills['id'].',';
				$bill_amount[$binc]+=$row_bills['ret1a']; 
			}else{
				$binc++;
				$bill_chain[$binc].=$this_number.',';
				$bill_chain2[$binc].=$row_bills['id'].',';
				$bill_amount[$binc]+=$row_bills['ret1a']; 
			} 
		}
		
		for($ib=0;$ib<sizeof($bill_chain);$ib++){
			
			$bill_chain[$ib] = substr($bill_chain[$ib],0,-1);
			$bill_chain2[$ib] = substr($bill_chain2[$ib],0,-1);
		
			//Aca primero consultamos si el pago tiene seleccinada una alcaldia por el provisionador.
			
		
				$queryretention = "select * from hallsretention where billsno = '$bill_chain[$ib]'";
				$resultretention = mysqli_query($con, $queryretention);
				$rowretention = mysqli_fetch_array($resultretention);
				
				$idretention = $rowretention[id];
				echo '<br><br>'.$querygretention2 = "update hallsretention set status = '1', payment='$rowpayment[id]', created='$today', billsid='$bill_chain2[$ib]', amount='$bill_amount[$ib]' where id = '$idretention'";
				//echo " NUMBER: ".$rowretention['number'];
				$resultgretention2 = mysqli_query($con, $querygretention2);   
				
			
		}
		}
}


/*

$ids_chain = "49564,50895,51440,51033,51012,50966,50997,50992,50991,51000,51001,50998,50993,50996,50994,52704,50995,53163,53637,53612,50775,50986,52929,52678,53614,52206,52717,51380,51576,52773,54192,53866,53634,54218,52805,53518,53868,54538,52846,53884,52933,52911,52215,50302,54626,53056,52225,53064,51904,53631,53615,51905,51967,52684,53825,52427,52776,52196,52889,53670,52125,52887,52900,53243,52884,53826,52901,52882,52894,52899,53320,51871,52883,53524,51938,52671,54057,54249,53244,53144,52873,52924,54083,53912,54116,53523,53450,52325,54403,54329,54625,54466,54038,53891,52129,53142,53531,53788,54165,54227,54620,52319,48464,50159,49866,51371,54435,54498,52439,54117,54136,53533,54606,52042,52115,52912,53596,52730,52775,53071,53018,53062,53017,53403,53346,53813,53803,53804,54171,53939,54166,54504,54507,54320,53203,53579,54601,54189,54782,53962,54262,54839,54672,54680,52885,54416,51457,51460,54395,54322,54609,54575,52435";
$ids_chain_arr = explode(',', $ids_chain);

for($i=0;$i<sizeof($ids_chain_arr);$i++){

	$querypayment = "select * from payments where id = '$ids_chain_arr[$i]'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	
	//Clean payment ret1id info
	$querypayment_clean = "update payments set ret1id='' where id = '$ids_chain_arr[$i]'";
	$resultpayment_clean = mysqli_query($con, $querypayment_clean);
				
	if($rowpayment['ret1a'] > 0){
		$bill_chain = "";
		$binc = 0;
		$query_bills = "select number from bills where payment = '$ids_chain_arr[$i]' and ret1a > '0'";
		$result_bills = mysqli_query($con, $query_bills);
		while($row_bills=mysqli_fetch_array($result_bills)){
			$this_number = $row_bills['number'];
			$this_number_size = strlen($this_number)+1;
			if(strlen($bill_chain[$binc])+$this_number_size <= 41){
				$bill_chain[$binc].=$this_number.',';
			}else{
				$binc++;
				$bill_chain[$binc].=$this_number.',';
			} 
		}
		
		for($ib=0;$ib<sizeof($bill_chain);$ib++){
			
			$bill_chain[$ib] = substr($bill_chain[$ib],0,-1);
		
			//Aca primero consultamos si el pago tiene seleccinada una alcaldia por el provisionador.
			if($rowpayment['hall'] > 0){ 
					$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0' and halls.id = '$rowpayment[hall]' order by hallsretention.id asc limit 1";
				}
			else{
					//Sino entonces generamos la alcaldía automaticamanete.
					$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0' and halls.units like '%$rowpayment[route]%' order by hallsretention.id asc limit 1";
				}
			$resultgretention = mysqli_query($con, $querygretention);
			$numgretention = mysqli_num_rows($resultgretention);
	
			if($numgretention > 0){
				$rowgretention = mysqli_fetch_array($resultgretention);
				$idgretention =  $rowgretention['id'];	
				echo '<br><br>'.$querygretention2 = "update hallsretention set status = '1', payment='$rowpayment[id]', created='$today', bills='$bill_chain[$ib]' where id = '$idgretention'";
				$resultgretention2 = mysqli_query($con, $querygretention2);   
				$sqlret = ", mayorstage='1'";  
				echo '<br>'.$query_update = "update payments set ret1id = if(ret1id is null, '$idgretention', concat(ret1id, '$idgretention')) where id = '$rowpayment[id]'"; 
		        $result_update = mysqli_query($con, $query_update);
		
		
			}
			else{
				//RETENCIONES ATASCADAS (FALTA) 
				$idgretention = 0;
				$sqlret1 = "";
				
			}
		}
		}
}











/*
//limpiar retenciones de Marzo
$chain2 = "33637,33638,33639,33640,33641,33642,33643,33644,33645,33646,33647,33648,33649,33650,33651,33652,33653,33654,33655,33656,33657,33658,33659,33660,33661,33662,33663,33664,33665,33666,33667,33668,33669,33670,33671,33672,33673,33674,33675,33676,33677,33678,33679,33680,33681,33682,33683,33684,33685,33686,33687,33688,33689,33690,33691,33692,33693,33694,33695,33696,33697,33698,33699,33700,33701,33702,33703,33704,33705,33706,33707,33708,33709,33710,33711,33712,33713,33714,33715,33716,33717,33718,33719,33720,33721,33722,33723,33724,33725,33726,33727,33728,33729,33730,33731,33732,33733,33734,33735,33736,33737,33738,33739,33740,33741,33742,33743,33744,33745,33746,33747,33748,33749,33750,33751,33752,33753,33754,33755,33756,33757,33758,33759,33760,33761,33762,33763,33764,33765,33766";
$chain_arr2 = explode(',', $chain2);

for($i=0;$i<sizeof($chain_arr2);$i++){
	echo '<br>'.$query_clean = "update hallsretention set payment='0', status='0', created='0000-00-00' where id = '$chain_arr2[$i]'";
	$result_clean = mysqli_query($con, $query_clean);
}




/*
$today = date('Y-m-d');
$comments = "Casos que exceden 40 caracteres en la columna factura, no se pueden ingresar a sistema de Alcaldía de Managua.";


//Void retentions
$chain = "33020,33094,33187,33243,33247,33248,33270,33306,33307,33308,33309,33310,33314,33353,33356,33357,33358,33412,33482,33501,33538,33554,33604";
$chain_arr = explode(',', $chain);

//IDS de los casos que exceden
for($i=0;$i<sizeof($chain_arr);$i++){
	
	$queryretention = "update hallsretention set void = '1', voidcomments='$comments', voidtoday='$today', voiduserid='$_SESSION[userid]' where id = '$chain_arr[$i]'"; 
	$resultretention = mysqli_query($con, $queryretention);
}

/*

$ids_chain = "49564,50895,51440,51033,51012,50966,50997,50992,50991,51000,51001,50998,50993,50996,50994,52704,50995,53163,53637,53612,50775,50986,52929";
$ids_chain_arr = explode(',', $ids_chain);

$ids2_chain = "52678,53614,52206,52717,51380,51576,52773,54192,53866,53634,54218,52805,53518,53868,54538,52846,53884,52933,52911,52215,50302,54626,53056,52225,53064,51904,53631,53615,51905,51967,52684,53825,52427,52776,52196,52889,53670,52125,52887,52900,53243,52884,53826,52901,52882,52894,52899,53320,51871,52883,53524,51938,52671,54057,54249,53244,53144,52873,52924,54083,53912,54116,53523,53450,52325,54403,54329,54625,54466,54038,53891,52129,53142,53531,53788,54165,54227,54620,52319,48464,50159,49866,51371,54435,54498,52439,54117,54136,53533,54606,52042,52115,52912,53596,52730,52775,53071,53018,53062,53017,53403,53346,53813,53803,53804,54171,53939,54166,54504,54507,54320,53203,53579,54601,54189,54782,53962,54262,54839,54672,54680,52885,54416,51457,51460,54395,54322,54609,54575,52435";
$ids2_chain_arr = explode(',', $ids2_chain);

/*
//Casos que exceden 40 Caracteres
$chain = "33020,33094,33187,33243,33247,33248,33270,33306,33307,33308,33309,33310,33314,33353,33356,33357,33358,33412,33482,33501,33538,33554,33604";
$chain_arr = explode(',', $chain);

//IDS de los casos que exceden
for($i=0;$i<sizeof($chain_arr);$i++){
	
	$query_ids = "select * from hallsretention where id = '$chain_arr[$i]'";
	$result_ids = mysqli_query($con, $query_ids);
	$row_ids = mysqli_fetch_array($result_ids);
	echo $row_ids['payment'].",";
}


//Retenciones Marzo
$chain2 = "33637,33638,33639,33640,33641,33642,33643,33644,33645,33646,33647,33648,33649,33650,33651,33652,33653,33654,33655,33656,33657,33658,33659,33660,33661,33662,33663,33664,33665,33666,33667,33668,33669,33670,33671,33672,33673,33674,33675,33676,33677,33678,33679,33680,33681,33682,33683,33684,33685,33686,33687,33688,33689,33690,33691,33692,33693,33694,33695,33696,33697,33698,33699,33700,33701,33702,33703,33704,33705,33706,33707,33708,33709,33710,33711,33712,33713,33714,33715,33716,33717,33718,33719,33720,33721,33722,33723,33724,33725,33726,33727,33728,33729,33730,33731,33732,33733,33734,33735,33736,33737,33738,33739,33740,33741,33742,33743,33744,33745,33746,33747,33748,33749,33750,33751,33752,33753,33754,33755,33756,33757,33758,33759,33760,33761,33762,33763,33764,33765,33766";

$chain_arr2 = explode(',', $chain2);

//IDS de las retenciones de Marzo.
for($i=0;$i<sizeof($chain_arr2);$i++){
	
	$query_ids = "select * from hallsretention where id = '$chain_arr2[$i]'";
	$result_ids = mysqli_query($con, $query_ids);
	$row_ids = mysqli_fetch_array($result_ids);
	echo $row_ids['payment'].",";
}


*/

?>