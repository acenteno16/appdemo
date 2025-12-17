<?php 
/*
include("session-financemanager.php");

$id = $_POST['id'];
$approve = $_POST['approve'];
$reason = $_POST['reason']; 

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s'); 
$now2 = date('H:i:s');

$querymain = "select * from schedule where id = '$id'";
$resultmain = mysqli_query($con, $querymain);
$rowmain = mysqli_fetch_array($resultmain);

$currency = $rowmain['currency'];
$ammount = $rowmain['ammount'];

$queryconfig = "select * from config where id = '1'";
$resultconfig = mysqli_query($con, $queryconfig);
$rowconfig = mysqli_fetch_array($resultconfig); 


if($approve == 1){
	$query = "update schedule set status = '5' where id = '$id'";
	$result = mysqli_query($con, $query);
	
	$query7 = "insert into scheduletimes (schedule, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '5', 'Enhorabuena, la programación del grupo de pago ha sido aprobada por la Gerencia Financiera.', '$reason')"; 
	$result7 = mysqli_query($con, $query7);
	
	$queryupay = "select * from schedulecontent where schedule = '$id'";
	$resultupay = mysqli_query($con, $queryupay);
	while($rowupay=mysqli_fetch_array($resultupay)){
		
		//Withholding
		$querypayment = "select * from payments where id = '$rowupay[payment]'";
		$resultpayment = mysqli_query($con, $querypayment);
		$rowpayment = mysqli_fetch_array($resultpayment);

		//ACA HAY QUE AGREGAR LA DEL IMI
		$sqlret1 = "";
		if($rowpayment['ret1a'] > 0){
			//Aca primero consultamos si el pago tiene seleccinada una alcaldia por el provisionador.
			if($rowpayment['hall'] > 0){ 
				$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0' and halls.id = '$rowpayment[hall]' order by hallsretention.id asc limit 1";
			}else{
				//Sino entonces generamos la alcaldía automaticamanete.
				$querygretention = "select hallsretention.* from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0' and halls.units like '%$rowpayment[route]%' order by hallsretention.id asc limit 1";
			}
			$resultgretention = mysqli_query($con, $querygretention);
			$numgretention = mysqli_num_rows($resultgretention);
	
	
			if($numgretention > 0){
				$rowgretention = mysqli_fetch_array($resultgretention);
				$idgretention =  $rowgretention['id'];	
				$querygretention2 = "update hallsretention set status = '1', payment='$rowupay[payment]' where id = '$idgretention'";
				$resultgretention2 = mysqli_query($con, $querygretention2);  
				$sqlret1 = ", mayorstage='1'";    
		
			}else{
				//RETENCIONES ATASCADAS (FALTA) 
				$idgretention = 0;
				$sqlret1 = "";
			}
		}else{
			$idgretention = 0;
			$sqlret1 = "";
		}

		//ir
		$sqlret2 = "";
		
		if($rowpayment['ret2a'] > 0){
			
			//identificar la compañia
			
			if(strlen($rowpayment['route']) == 4){
				$querycompany = "select * from units where code = '$rowpayment[route]'";
			}else{
				$querycompany = "select * from units where code2 = '$rowpayment[route]'";
			} 
				
			$resultcompany = mysqli_query($con, $querycompany);
			$rowcompany = mysqli_fetch_array($resultcompany);
			$company = $rowcompany['company']; 
			
			//leer el ultimo id2
			$querycompany2 = "select * from irretention where company = '$company' order by id desc limit 1";
			$resultcompany2 = mysqli_query($con, $querycompany2);
			$rowcompany2 = mysqli_fetch_array($resultcompany2);
			$number = $rowcompany2['number'];  
			
			//Sumarle uno
			$number = $number+1;
			
			$queryret = "insert into irretention (today, now, payment, company, number) values ('$today', '$now', '$rowupay[payment]', '$company', '$number')"; 
			$resultret = mysqli_query($con, $queryret); 
			$idret = mysqli_insert_id($con);
			$sqlret2 = ", irstage = '1'"; 	 
		
		}else{
			$idret = 0;
		}
		
		$sqlret = $sqlret1.$sqlret2;

		//UPDATE DEL PAGO 
		$queryapprove = "update payments set ret1id='$idgretention', ret2id='$idret'".$sqlret." where id = '$rowupay[payment]'"; 
		$resultapprove = mysqli_query($con, $queryapprove);
		
		//Si es un pago de Retenciones Alcaldia el que se esta cancelando
		//entonces hacemos que las retenciones contenidas aparezcan como canceladas 
		if($rowpayment['provider'] == $rowconfig['imiprovider']){
			$querymayor = "select * from mayorcontent where payment2 = '$rowupay[payment]'";
			$resultmayor = mysqli_query($con, $querymayor);
			while($rowmayor=mysqli_fetch_array($resultmayor)){
				$querymayor2 = "update payments set irstage = '3' where id = '$rowmayor[payment]'";
				$resultmayor2 = mysqli_query($con, $querymayor2);
			} 
		}

		//Si es un pago de Retencion de IR actualizamos el que se esta cancelando
		//entonces hacemos que las retenciones contenidas aparezcan como canceladas 
		if($rowpayment['provider'] == $rowconfig['irprovider']){ 
	
			$queryir = "select * from ircontent where payment2 = '$rowupay[payment]'";
			$resultir = mysqli_query($con, $queryir);
			while($rowir=mysqli_fetch_array($resultir)){
				$queryir2 = "update payments set irstage = '3' where id = '$rowir[payment]'";
				$resultir2 = mysqli_query($con, $queryir2); 
			} 
		} 
	}
	
}

//RECHAZANDO EL GRUPO DE PAGOS
elseif($approve == 2){

	$query = "update schedule set status = '4' where id = '$id'";
	$result = mysqli_query($con, $query);
	
	$query7 = "insert into scheduletimes (schedule, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '4', 'La programación del grupo de pago ha sido rechazada por la Gerencia Financiera.', '$reason')";  
	$result7 = mysqli_query($con, $query7); 

	$query2 = "select * from schedulecontent where schedule = '$id'";
	$result2 = mysqli_query($con, $query2);
	while($row2=mysqli_fetch_array($result2)){
	
		$query3 = "update payments set status = '9', schedule='0000-00-00' where id = '$row2[payment]'";
		$result3 = mysqli_query($con, $query3);
	
		$query4 = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$row2[payment]', '$today', '$now', '$now2', '$_SESSION[userid]', '13.03', 'La programacion ha sido rechazada por la Gerencia Financiera.', '$reason')";
		$result4 = mysqli_query($con, $query4); 
	
	}
	
		$type = "nc";
		$description = "Rechazo del grupo no. ".$id;

		if($currency != 0){
	
			$query4 = "select * from balance where currency = '$currency' order by id desc limit 1"; 
			$result4 = mysqli_query($con, $query4);
			$row4 = mysqli_fetch_array($result4);
			$balance = $row4['balance']+$ammount;

			$query5 = "insert into balance (today, now, type, description, ammount, balance, currency) values ('$today', '$now', '$type', '$description', '$ammount', '$balance', '$currency')";
			$result5 =  mysqli_query($con, $query5); 
	
		
		}

//END REJECTION
}
header('location: approve-cfo.php'); 
*/ 
?>