<?php  

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

exit();

include("session-treasury.php");
include('pdf-ir-single.php'); 
include('imiGenerator.php');

$forwarding = 0;
$theid = 0;
if(isset($_POST['id'])){
	$theid = $_POST['id'];
}
if(isset($_POST['bank'])){
	$bank = $_POST['bank'];
}
if(isset($_POST['wid'])){
	$wid = $_POST['wid'];
}
if(!isset($_POST['id'])){
	//Cuando el grupo es en dolares
	if(isset($_POST['id2'])){
		$theid = $_POST['id2'];
	}
	if(isset($_POST['wid2'])){
		$wid = $_POST['wid2'];
	}
	if(isset($_POST['bank2'])){
		$bank = $_POST['bank2'];
	}
	
	if(!isset($_POST['id2'])){
		//Cuando el grupo es otras monedas
		if(isset($_POST['id3'])){
			$theid = $_POST['id3']; 
		}
		if(isset($_POST['wid3'])){
			$wid = $_POST['wid3'];
		}
		if(isset($_POST['bank3'])){
			$bank = $_POST['bank3'];
		}
	}
}

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s'); 
$strdocuments = "";

$queryconfig = "select * from config where id = '1'"; 
$resultconfig = mysqli_query($con, $queryconfig);
$numconfig = mysqli_num_rows($resultconfig);
$rowconfig = mysqli_fetch_array($resultconfig);

//Loop po paquetes de cancelación
for($c=0;$c<sizeof($theid);$c++){ 
	
	if($theid[$c] != 0){
	
	//Seleccionamos la informacion del grupo de pago
	$query3 = "select * from schedule where id = '$theid[$c]'";
	$result3 = mysqli_query($con, $query3);
	$row3 = mysqli_fetch_array($result3); 
		
	$query6 = "update schedule set code='$wid[$c]', thebank2='$bank[$c]', status='3' where id = '$theid[$c]'";
	$result6 = mysqli_query($con, $query6); 

	$query7 = "insert into scheduletimes (schedule, today, now, now2, userid, stage, comment) values ('$theid[$c]', '$today', '$now', '$now2', '$_SESSION[userid]', '3', 'Enhorabuena, la programación del grupo de pago ha sido aprobada.')"; 
	$result7 = mysqli_query($con, $query7); 	
		
		if($row3['status'] == 1){
			
			$queryup = "update schedule set bank = '$bank[$c]' where id = '$theid[$c]'";
			$rsultup = mysqli_query($con, $queryup);
			
			$querygroup = "select * from schedulecontent where schedule = '$theid[$c]'";
			$resultgroup = mysqli_query($con, $querygroup);
			
			//Loop de pagos incluidos en el paquete de cancelación
			while($rowgroup=mysqli_fetch_array($resultgroup)){ 
		
				//Actualizamos el pago como Programación aprobada.
				$query1 = "update payments set status = '13', bank='$bank[$c]', abank='$bank[$c]', cnotification = '1', rnotification = '1' where id = '$rowgroup[payment]'";
				$result1 = mysqli_query($con, $query1); 
	
				//Insertamos el registro de la programacion aprobada (Registro del pago)
				$query2 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$rowgroup[payment]', '$today', '$now', '$now2', '$_SESSION[userid]', '13', 'Enhorabuena, la programación del pago ha sido aprobada.')"; 
				$result2 = mysqli_query($con, $query2);
				
				$querypayment = "select id, ret1a, ret2a, hall, route, company from payments where id = '$rowgroup[payment]'";
				$resultpayment = mysqli_query($con, $querypayment);
				$rowpayment = mysqli_fetch_array($resultpayment);
				
				#generamos retencion imi si existe
				if($rowpayment['ret1a'] > 0){
					
					createIMIRetention($rowpayment['id'], 0, 0); 
		
				}
				
				#Anulacion de retenciones ir anteriores
				$voidtoday = date('Y-m-d');
	
				#Anulacion IR
				$queryIrCheck = "select id from irretention where payment = '$rowgroup[payment]' and void = '0'";
				$resultIrCheck = mysqli_query($con, $queryIrCheck);
				$numIrCheck = mysqli_num_rows($resultIrCheck);
				if($numIrCheck > 0){
	
					while($rowIrCheck=mysqli_fetch_array($resultIrCheck)){
		
						$queryIrVoid = "update irretention set void='1', voidcomments='Anulada por getPay para generar una nueva.', voiduserid='999999999', voidtoday='$voidtoday' where id = '$rowIrCheck[id]'"; 
						$resultIrVoid = mysqli_query($con, $queryIrVoid);
		
					}
	
				}
				

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
                    
                    //Mandamos a anular cualquier retencion que halla sido creada anteriormente
                    $gid = "Nueva retencion generada en grupo #".$theid[$c];
			        $queryvoid = "update irretention set void='1' and voidcomments='$gid' where payment = '$rowpayment[id]' and void = '0'"; 
			        $resultvoid = mysqli_query($con, $queryvoid);
			

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
				
				        $queryret = "insert into irretention (today, now, payment, company, number, bills, authorized) values ('$today', '$now', '$rowpayment[id]', '$company', '$number', '$strdocuments', '$authorized')"; 
				        $resultret = mysqli_query($con, $queryret); 
				        $idret = mysqli_insert_id($con);
				        $idretstr.= $idret.",";
				        $sqlret2 = ", irstage = '1'"; 
				        $idretstr = substr($idretstr, 0, -1);

				        //Aca creamos la retencion.
				        makeRetention($rowpayment['id'],0,$con);
	
			}
			
			
			
			#######################End New code
			
		//Si no hay un mon to de retencion IR
		}else{
				$idret = 0;
		}
		
		$sqlret = $sqlret2; 

		//UPDATE DEL PAGO 
		$queryapprove = "update payments set ret2id='$idretstr'".$sqlret." where id = '$rowpayment[id]'"; 
		$resultapprove = mysqli_query($con, $queryapprove);
		
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
		
			} //Fin de loop de pagos 
	
			$ammount= $row3['ammount'];
			$currency = $row3['currency'];
			
			$today = date("Y-m-d");
			$now = date('H:i:s');
			$type = "nd";
			$description = "Cancelaci&oacute;n del grupo no. ".$theid[$c]."";

			if($currency != 0){
			$query4 = "select * from balance where currency = '$currency' order by id desc limit 1"; 
			$result4 = mysqli_query($con, $query4);
			$row4 = mysqli_fetch_array($result4);
			$balance = $row4['balance']-$ammount;

			$query5 = "insert into balance (today, now, type, description, ammount, balance, currency) values ('$today', '$now', '$type', '$description', '$ammount', '$balance', '$currency')";
			$result5 =  mysqli_query($con, $query5); 
			 
		}
	} 
	}
	
}

echo '<script>window.location = "'.$_SERVER['HTTP_REFERER'].'";</script>';

?>