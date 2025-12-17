<?php  

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require("session-treasury.php");
require('pdf-ir-single.php'); 
require('imiGenerator.php');
require('fnMissingPayment.php');

$irActive = array();
$queryCompany = "select id, iractive from companies";
$resultCompany = mysqli_query($con, $queryCompany);
while($rowCompany=mysqli_fetch_array($resultCompany)){
	$irActive[$rowCompany['id']] = $rowCompany['iractive'];
}

if (isset($_GET['paymentId'])) {
    $paymentIds = $_GET['paymentId'];

    if (!is_array($paymentIds)) {
        $paymentIds = [$paymentIds];
    }

    foreach ($paymentIds as $id) {
        $id = intval($id); // Sanitizar
        if ($id > 0) {
            missingPayment($id,'','');
        }
    }

    exit("<script>alert('Listo!');window.location='$referer';</script>");
}

$forwarding = 0;
$theid = 0;
if(isset($_GET['theid'])){
	$theid = $_GET['theid'];
}
if(isset($_GET['bank'])){
	$bank = $_GET['bank'];
}
if(isset($_GET['wid'])){
	$wid = $_GET['wid'];
}

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s'); 
$strdocuments = "";

$queryconfig = "select * from config where id = '1'"; 
$resultconfig = mysqli_query($con, $queryconfig);
$numconfig = mysqli_num_rows($resultconfig);
$rowconfig = mysqli_fetch_array($resultconfig);


if($theid > 0){
	
	//Seleccionamos la informacion del grupo de pago
	$query3 = "select * from schedule where id = '$theid'";
	$result3 = mysqli_query($con, $query3);
	$row3 = mysqli_fetch_array($result3); 
		
	$query6 = "update schedule set code='$wid', thebank2='$bank', status='3' where id = '$theid'";
	$result6 = mysqli_query($con, $query6); 

	$query7 = "insert into scheduletimes (schedule, today, now, now2, userid, stage, comment) values ('$theid', '$today', '$now', '$now2', '$_SESSION[userid]', '3', 'Enhorabuena, la programación del grupo de pago ha sido aprobada.')"; 
	$result7 = mysqli_query($con, $query7); 	
		
	if($row3['status'] == 1){
		
		$queryup = "update schedule set bank = '$bank' where id = '$theid'";
		$rsultup = mysqli_query($con, $queryup);
			
		$querygroup = "select * from schedulecontent where schedule = '$theid'";
		$resultgroup = mysqli_query($con, $querygroup);
		//Loop de pagos incluidos en el paquete de cancelación
		while($rowgroup=mysqli_fetch_array($resultgroup)){
			
			//Actualizamos el pago como Programación aprobada.
			$query1 = "update payments set status = '13', bank='$bank', abank='$bank', cnotification = '1', rnotification = '1' where id = '$rowgroup[payment]'";
			$result1 = mysqli_query($con, $query1); 
	
			//Insertamos el registro de la programacion aprobada (Registro del pago)
			$query2 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$rowgroup[payment]', '$today', '$now', '$now2', '$_SESSION[userid]', '13', 'Enhorabuena, la programación del pago ha sido aprobada.')"; 
			$result2 = mysqli_query($con, $query2);
				
			$querypayment = "select id, ret1a, ret2a, hall, route, company from payments where id = '$rowgroup[payment]'";
			$resultpayment = mysqli_query($con, $querypayment);
			$rowpayment = mysqli_fetch_array($resultpayment);
            
            $queryHall = "select active from halls where id = '$rowpayment[hall]'";
            $resultHall = mysqli_query($con, $queryHall);
            $rowHall = mysqli_fetch_array($resultHall);
				
			#generamos retencion imi si existe y si está activa la sucursal
			if(($rowpayment['ret1a'] > 0) and ($rowHall['active'] == 1)){
					
				createIMIRetention($rowpayment['id'], '0', '0'); 
		
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
			 $company = $rowpayment['company'];
             if(($rowpayment['ret2a'] > 0) and ($irActive[$company] == 1)){
                    
                    $thisToday = date('Y-m-d');
                    $queryauth = "select id from authorized where company = '$company' and '$thisToday' >= today order by id desc limit 1";
                    $resultauth = mysqli_query($con, $queryauth);
                    $rowauth = mysqli_fetch_array($resultauth);
                    $authorized = $rowauth['id'];
                    
                    //Mandamos a anular cualquier retencion que halla sido creada anteriormente
                    $gid = "Nueva retencion generada en grupo #".$theid;
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
			$description = "Cancelaci&oacute;n del grupo no. ".$theid."";

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
	
echo '<script>window.location = "'.$_SERVER['HTTP_REFERER'].'";</script>';

?>