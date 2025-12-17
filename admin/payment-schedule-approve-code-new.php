<?php  


include("session-treasury.php");
/*
//Generar PDF de retencion IR
include('pdf-ir-single.php'); 

//Cuando el grupo es en cordobas

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

$queryconfig = "select * from config where id = '1'"; 
$resultconfig = mysqli_query($con, $queryconfig);
$rowconfig = mysqli_fetch_array($resultconfig);

//Loop po paquetes de cancelación
for($c=0;$c<sizeof($theid);$c++){ 
	
	if($theid[$c] != 0){
	
	//Seleccionamos la informacion del grupo de pago
	$query3 = "select * from schedule where id = '$theid[$c]'";
	$result3 = mysqli_query($con, $query3);
	$row3 = mysqli_fetch_array($result3); 
		
	$query6 = "update schedule set code='$wid[$c]', bank='$bank[$c]', status='3' where id = '$theid[$c]'";
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
				$query1 = "update payments set status = '13', bank='$bank[$c]', cnotification = '1' where id = '$rowgroup[payment]'";
				$result1 = mysqli_query($con, $query1); 
	
				//Insertamos el registro de la programacion aprobada (Registro del pago)
				$query2 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$rowgroup[payment]', '$today', '$now', '$now2', '$_SESSION[userid]', '13', 'Enhorabuena, la programación del pago ha sido aprobada.')"; 
				$result2 = mysqli_query($con, $query2);
				
				//Start of retention code 
				//Aqui creamos las retenciones
				//Withholdings
				$querypayment = "select * from payments where id = '$rowgroup[payment]'";
				$resultpayment = mysqli_query($con, $querypayment);
				$rowpayment = mysqli_fetch_array($resultpayment);

				//ACA HAY QUE AGREGAR LA DEL IMI
				$sqlret1 = ""; 
					
				
				if($rowpayment['ret1a'] > 0){
			
				$bill_chain = "";
				$bill_chain2 = "";
				$bill_amount = "";
				$binc = 0;
				$query_bills = "select id, number, ret1a from bills where payment = '$rowgroup[payment]' and ret1a > '0'";
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
				$querygretention2 = "update hallsretention set status = '1', payment='$rowpayment[id]', created='$today', billsno='$bill_chain[$ib]', billsid='$bill_chain2[$ib]', amount='$bill_amount[$ib]' where id = '$idgretention'";
				$resultgretention2 = mysqli_query($con, $querygretention2);   
				$sqlret1 = ", mayorstage='1'";
				$query_update = "update payments set ret1id = if(ret1id is null, '$idgretention', concat(ret1id, '$idgretention')) where id = '$rowpayment[id]'"; 
		        $result_update = mysqli_query($con, $query_update);
		
			} 
			else{
				//RETENCIONES ATASCADAS (FALTA) 
				$idgretention = 0;
				$sqlret1 = "";
				
			}
			
			}
				
			}
				
				else{
				$idgretention = 0;
				$sqlret1 = "";
			}

		//ir
		$sqlret2 = "";
		
		if($rowpayment['ret2a'] > 0){
			
			$company = $rowpayment['company'];
			
			//Mandamos a anular cualquier retencion que halla sido creada anteriormente
			$gid = "Nueva retencion generada en grupo #".$theid[$c];
			$queryvoid = "update irretention set void='1' and voidcomments='$gid' where payment = '$rowpayment[id]' and void = '0'"; 
			$resultvoid = mysqli_query($con, $queryvoid);
			
			//leer el ultimo id2
			$querycompany2 = "select * from irretention where company = '$company' order by id desc limit 1";
			$resultcompany2 = mysqli_query($con, $querycompany2);
			$rowcompany2 = mysqli_fetch_array($resultcompany2);
			$number = $rowcompany2['number'];  
			
			//Sumarle uno
			$number = $number+1;
			
			$queryret = "insert into irretention (today, now, payment, company, number) values ('$today', '$now', '$rowpayment[id]', '$company', '$number')"; 
			$resultret = mysqli_query($con, $queryret); 
			$idret = mysqli_insert_id($con);
			$sqlret2 = ", irstage = '1'"; 
			
			//Aca enviamos la retencion.
			makeRetention($rowpayment['id']);
			
		
		}else{
			$idret = 0;
		}
		
		$sqlret = $sqlret1.$sqlret2; 

		//UPDATE DEL PAGO 
		$queryapprove = "update payments set ret2id='$idret'".$sqlret." where id = '$rowpayment[id]'"; 
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
 
//header('location: '.$_SERVER['HTTP_REFERER']); 
echo '<script>window.location = "'.$_SERVER['HTTP_REFERER'].'";</script>';

*/

echo 'Ask developer code:2';

?>