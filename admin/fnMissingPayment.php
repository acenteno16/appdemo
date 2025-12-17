<? 

function missingPayment($id,$forceRetrention,$forceToday){
	
	#forceretention: 0: debe de hacer el proceso normal. Anula y genera retencion 1: No anula, crea si hace falta
	#forceToday: Genera las retenciones con fecha forzada.
	
	include_once("session-treasury.php");
	include_once('pdf-ir-single.php'); 
	include_once('imiGenerator.php');
	
	$today = date("Y-m-d");
	$now = date('Y-m-d H:i:s');
	$now2 = date('H:i:s'); 
	
	
	if(($forceToday == 0) or ($forceToday == '')){
		$forced = 0;
	}else{
		$forced = 1;
	}
	
	$queryGroup = "select schedule.thebank2 from schedule inner join schedulecontent on schedule.id = schedulecontent.schedule where schedulecontent.payment = '$id'";
	$resultGroup = mysqli_query($con, $queryGroup); 
	$rowGroup = mysqli_fetch_array($resultGroup);
	
	$bank = $rowGroup['thebank2'];
	
	//Actualizamos el pago como Programación aprobada.
	$query1 = "update payments set status = '13', bank='$bank', abank='$bank', cnotification = '1', rnotification = '1' where id = '$id'";
	$result1 = mysqli_query($con, $query1); 
	
	//Insertamos el registro de la programacion aprobada (Registro del pago)
	$query2 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '13', 'Enhorabuena, la programación del pago ha sido aprobada.')"; 
	$result2 = mysqli_query($con, $query2);
				
	$querypayment = "select id, ret1a, ret2a, hall, route, company from payments where id = '$id'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	
	$queryHall = "select active from halls where id = '$rowpayment[hall]'";
    $resultHall = mysqli_query($con, $queryHall);
    $rowHall = mysqli_fetch_array($resultHall);
				
	#generamos retencion imi si existe
	if(($rowpayment['ret1a'] > 0) and ($rowHall['active'] == 1)){
		createIMIRetention($rowpayment['id'], $forceToday, '0');	
	}
				
	#Anulacion de retenciones ir anteriores
	$voidtoday = date('Y-m-d');
	
	#IR Check
	$queryIrCheck = "select id from irretention where payment = '$id' and void = '0'";
	$resultIrCheck = mysqli_query($con, $queryIrCheck);
	$numIrCheck = mysqli_num_rows($resultIrCheck);
	
	#Anulacion IR
	#Opcion de que debe anular
	
	$generateIr = 1;
	if($forceRetrention == 0){
		if($numIrCheck > 0){
	
			while($rowIrCheck=mysqli_fetch_array($resultIrCheck)){
		
				$queryIrVoid = "update irretention set void='1', voidcomments='Anulada por getPay para generar una nueva.', voiduserid='999999999', voidtoday='$voidtoday' where id = '$rowIrCheck[id]'"; 
				$resultIrVoid = mysqli_query($con, $queryIrVoid);
		
			}
	
		}
	}
	
	if(($forceRetrention == 1) and (($numIrCheck > 0))){
		$generateIr = 0;
	}

	if($generateIr == 1){
		
    	//IR Rets
    	$sqlret2 = "";
    	$idretstr = "";
    	if($rowpayment['ret2a'] > 0){
		
			$company = $rowpayment['company'];
                    
        	$thisToday = date('Y-m-d');
        	$queryauth = "select id from authorized where company = '$company' and '$thisToday' >= today order by id desc limit 1";
        	$resultauth = mysqli_query($con, $queryauth);
        	$rowauth = mysqli_fetch_array($resultauth);
        	$authorized = $rowauth['id'];
                   
			$querydocs = "select * from bills where payment = '$rowpayment[id]' and ret2a > '0' group by ret2";
			$resultdocs = mysqli_query($con, $querydocs);
			while($rowdocs=mysqli_fetch_array($resultdocs)){
			
				//leer el ultimo id2
				$querycompany2 = "select number from irretention where company = '$company' order by id desc limit 1";
				$resultcompany2 = mysqli_query($con, $querycompany2);
				$rowcompany2 = mysqli_fetch_array($resultcompany2);
				$number = $rowcompany2['number'];
					
				//Sumarle uno para obeter el nuevo numero
				$number = $number+1;

				$strdocuments = "";
				$querydocscontent = "select * from bills where payment = '$rowpayment[id]' and ret2a > '0' and ret2 = '$rowdocs[ret2]'";
				$resultdocscontent = mysqli_query($con, $querydocscontent);
				$numdocscontent = mysqli_num_rows($resultdocscontent);
				while($rowdocscontent=mysqli_fetch_array($resultdocscontent)){
					$strdocuments.=$rowdocscontent['id'].",";
				} 
				
				if($numdocscontent > 0){
					$strdocuments = substr($strdocumentsr, 0, -1);
				}
				
				$rtoday = $today;
				if($forceToday > '2015-01-01'){
					$rtoday = $forceToday;
				}
				
				$queryret = "insert into irretention (today, now, payment, company, number, bills, authorized, forced) values ('$rtoday', '$now', '$rowpayment[id]', '$company', '$number', '$strdocuments', '$authorized', '$forced')"; 
				$resultret = mysqli_query($con, $queryret); 
				$idret = mysqli_insert_id($con);
				$idretstr.= $idret.",";
				$sqlret2 = ", irstage = '1'"; 
				$idretstr = substr($idretstr, 0, -1);

				//Aca creamos la retencion.
				makeRetention($rowpayment['id'],0,$con);
	
			}
		
			#######################End New code
			
			//Si no hay un monto de retencion IR
		}
		else{
			 $idret = 0;
		}
		
		$sqlret = $sqlret2; 

		//UPDATE DEL PAGO 
		$queryapprove = "update payments set ret2id='$idretstr'".$sqlret." where id = '$rowpayment[id]'"; 
		$resultapprove = mysqli_query($con, $queryapprove);
	
	}
	
		
		//Si es un pago de Retenciones Alcaldia el que se esta cancelando
		//entonces hacemos que las retenciones contenidas aparezcan como canceladas 
		if($rowpayment['provider'] == $rowconfig['imiprovider']){
			$querymayor = "select * from mayorcontent where payment2 = '$rowpayment[id]'";
			$resultmayor = mysqli_query($con, $querymayor);
			while($rowmayor=mysqli_fetch_array($resultmayor)){
				$querymayor2 = "update payments set irstage = '3' where id = '$rowmayor[payment]'";
				$resultmayor2 = mysqli_query($con, $querymayor2);
			} 
		}

		//Si es un pago de Retencion de IR actualizamos el que se esta cancelando
		//entonces hacemos que las retenciones contenidas aparezcan como canceladas 
		if($rowpayment['provider'] == $rowconfig['irprovider']){ 
	
			$queryir = "select * from ircontent where payment2 = '$rowpayment[id]'";
			$resultir = mysqli_query($con, $queryir);
			while($rowir=mysqli_fetch_array($resultir)){
				$queryir2 = "update payments set irstage = '3' where id = '$rowir[payment]'";
				$resultir2 = mysqli_query($con, $queryir2); 
			} 
		} 
		
		//end of new retention code 

}

?>