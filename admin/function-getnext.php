<? 

function getNext($payment, $stage){
	
	#ini_set('display_errors', 1);
	#ini_set('display_startup_errors', 1);
	#error_reporting(E_ALL);
	
	include('sessions.php');
	//include('../assets/PHPMailer/PHPMailerAutoload.php');   
	
	$bills = "";
	$users_names = "";
	
    $queryHost = "select * from mailer where active = '1'";
    $resultHost = mysqli_query($con, $queryHost);
    $rowHost = mysqli_fetch_array($resultHost);
    
	$querypayment = "select * from payments where id = '$payment'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	
	if($rowpayment['immediate'] == 1){
		$rsvp_word = "Inmediato";
	}
	else{
		$rsvp_word = "Importante";
	}
	
	$route = $rowpayment['route'];
	$headship = $rowpayment['headship'];
	
	switch($rowpayment['currency']){
				case 1:
				$pre_m = "NIO C$";
				break;
				case 2:
				$pre_m = "USD $";
				break;
				case 3:
				$pre_m = "EUR ";
				break;
				case 4:
				$pre_m = "YEN ";
				break;
		}
	
	//Solicitante
	$queryuser = "select first, last, email from workers where code = '$rowpayment[userid]'"; 
	$resultuser = mysqli_query($con, $queryuser);
	$rowuser = mysqli_fetch_array($resultuser);
	
	$request_name = $rowuser['first'].' '.$rowuser['last'];
	$request_email = $rowuser['email'];
	
	//Proveedor/Colaborador
	if($rowpayment['btype'] == 1){
		$queryprovider = "select * from providers where id = '$rowpayment[provider]'";
		$resultprovider = mysqli_query($con, $queryprovider); 
		$rowprovider = mysqli_fetch_array($resultprovider);
		$provider_name = $rowprovider['code']." | ".$rowprovider['name'];
	}
	elseif($rowpayment['btype'] == 2){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$rowpayment[collaborator]'"));
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
	}
    elseif($rowpayment['btype'] == 3){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from interns where code = '$rowpayment[intern]'")); 
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
	}
	elseif($row['btype'] == 4){
		$queryprovider = "select * from clients where code = '$rowpayment[client]'";
		$rowprovider = mysqli_fetch_array(mysqli_query($con, $queryprovider)); 
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
	}
	
	//Facturas
	$querybills = "select * from bills where payment = '$payment'";
	$resultbills = mysqli_query($con, $querybills);
	while($rowbills = mysqli_fetch_array($resultbills)){
		switch($rowbills['currency']){
				case 1:
				$pre = "NIO C$";
				break;
				case 2:
				$pre = "USD $";
				break;
				case 3:
				$pre = "EUR ";
				break;
				case 4:
				$pre = "YEN ";
				break;
		}
		
		$bills.= '#'.$rowbills['number'].'('.$pre.$rowbills['ammount'].'), ';
	}
	$bills = substr($bills,0,-2);
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Mailer = "smtp";
	$mail->SMTPDebug  = 0;  
	$mail->SMTPAuth   = TRUE;
	if($rowHost['mailTLS'] == 1){
		$mail->SMTPSecure = "tls";
	}elseif($rowHost['mailTLS'] == 2){
		$mail->SMTPSecure = "ssl";
	}
	$mail->Port = $rowHost['mailPort'];
	$mail->Host = $rowHost['mailHost']; 
	$mail->Username = $rowHost['mailUsername']; 
	$mail->Password = $rowHost['mailPassword'];
	$mail->IsHTML(true);
	$mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFromName']);
	$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);                                   // TCP port to connect 
	
	if($stage == 1){
		//Get users from the route
		$queryroute = "select * from routes where unit = '$route' and headship = '$headship' and type > '1' group by worker"; 
		$resultroute = mysqli_query($con, $queryroute); 
		$numroute = mysqli_num_rows($resultroute);
		while($rowroute = mysqli_fetch_array($resultroute)){
			$queryuser2 = "select first, last, email from workers where code = '$rowroute[worker]'"; 
			$resultuser2 = mysqli_query($con, $queryuser2);
			$rowuser2 = mysqli_fetch_array($resultuser2);
	
			$mail->addAddress($rowuser2['email'], $rowuser2['first']." ".$rowuser2['last']);
			$users_names.= $rowuser2['first']." ".$rowuser2['last'].', ';
		}
		
		$users_names = substr($users_names,0,-2);
		$message_top = "Estimados ".$users_names.",<br><br>Se les informa que se ha ingresado una Solicitud de Pago $rsvp_word.";
	
	}
	elseif($stage == 8){
		$queryroute = "select * from routes where type = '6' and FIND_IN_SET('2',companies) > 0"; 
		$resultroute = mysqli_query($con, $queryroute); 
		$numroute = mysqli_num_rows($resultroute);
		$tusr = 0;
		while($rowroute = mysqli_fetch_array($resultroute)){
			$queryuser2 = "select first, last, email from workers where code = '$rowroute[worker]'"; 
			$resultuser2 = mysqli_query($con, $queryuser2);
			$rowuser2 = mysqli_fetch_array($resultuser2);
	
			$mail->addAddress($rowuser2['email'], $rowuser2['first']." ".$rowuser2['last']);
			$users_names.= $rowuser2['first']." ".$rowuser2['last'].', ';
			$tusr++;
		}
		
		$s = "";
		$n = "";
		if($tusr > 1){
			$s = "s";
			$n = "n";
		}
		
		$users_names = substr($users_names,0,-2);
		
		$message_top = "Estimad@".$s.' '.$users_names.",<br><br>Se le".$s." informa que tiene".$n." pendiente una Solictud de Pago $rsvp_word. Favor revisar getPay.";
		
	}
	elseif($stage == 9){ 
		//Reportar a tesorería
		
		$queryroute = "select * from routes where (type = '9' or type = '7' or type = '11') and FIND_IN_SET('2',companies) > 0 group by worker";  
		$resultroute = mysqli_query($con, $queryroute); 
		$numroute = mysqli_num_rows($resultroute);
		$tusr = 0;
		while($rowroute = mysqli_fetch_array($resultroute)){
			$queryuser2 = "select first, last, email from workers where code = '$rowroute[worker]'"; 
			$resultuser2 = mysqli_query($con, $queryuser2);
			$rowuser2 = mysqli_fetch_array($resultuser2);
	
			$mail->addAddress($rowuser2['email'], $rowuser2['first']." ".$rowuser2['last']);
			$users_names.= $rowuser2['first']." ".$rowuser2['last'].', ';
			$tusr++;
		}
		
		$s = "";
		$n = "";
		if($tusr > 1){
			$s = "s";
			$n = "n";
		}
		
		$users_names = substr($users_names,0,-2);

		
		$message_top = "Estimad@".$s.' '.$users_names.",<br><br>Se le".$s." informa que se ha recibido una Solicitud de Pago $rsvp_word en Recepcion.";
		
	}
	else{
		
		$queryroute_p = "select type from routes where unit = '$route' and headship = '$headship' and type > '$stage' limit 1"; 
		$resultroute_p = mysqli_query($con, $queryroute_p);
		$rowroute_p = mysqli_fetch_array($resultroute_p);
		$new_stage = $rowroute_p['type']; 
			
		$queryroute = "select * from routes where unit = '$route' and headship = '$headship' and type = '$new_stage'"; 
		$resultroute = mysqli_query($con, $queryroute);
		$numroute = mysqli_num_rows($resultroute);  
		$tusr = 0;
		while($rowroute = mysqli_fetch_array($resultroute)){
			
			$queryuser2 = "select first, last, email from workers where code = '$rowroute[worker]'"; 
			$resultuser2 = mysqli_query($con, $queryuser2);
			$rowuser2 = mysqli_fetch_array($resultuser2); 
	
			$mail->addAddress($rowuser2['email'], $rowuser2['first']." ".$rowuser2['last']);
			$users_names.= $rowuser2['first']." ".$rowuser2['last'].', ';
			$tusr++;
			
		}
		
		$s = "";
		$n = "";
		if($tusr > 1){
			$s = "s";
			$n = "n";
		}
		
		$users_names = substr($users_names,0,-2);
		
		$message_top = "Estimad@".$s.' '.$users_names.",<br><br>Se le".$s." informa que tiene".$n." pendiente una Solictud de Pago $rsvp_word. Favor revisar getPay."; 
	} 

	
		        $sentfrom = $_SERVER['HTTP_REFERER'];
				$message = '<!doctype html>
				<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
				<style>body{ border:0px; background: #f6f6f6; }</style>
				<body bgcolor="#f6f6f6">
				<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  				<tbody>
    			<tr bgcolor="#18bff1">
      			<td><img src="https://getpaycp.com/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    			</tr>
				<tr>
      			<td style="padding:15px;">
        		<p>'.$message_top.'</p> 
        		<p><strong>ID de solicitud:</strong> '.$payment.'<br>
      			<strong>Proveedor/Colaborador:</strong> '.$provider_name.'<br>
				<strong>Monto de Solicitud:</strong> '.$pre_m.$rowpayment['payment'].'<br>
				<strong>Documento(s): </strong> '.$bills.'<br>
				<strong>Descripcion: </strong> '.$rowpayment['description'].'
				<br>
      			<p><strong>Nombre del Solicitante:</strong> '.$request_name.'<br>
        		<strong>Email del Solicitante:</strong> <a href="mailto:'.$request_email.'">'.$request_email.'</a> <br>
        		<strong>UN del Solicitante:</strong> '.$rowpayment['route'].'</p>
				</td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="https://getpaycp.com/images/casa-pellas.png" height="20" style="padding:15px;">
				</td>
    			</tr>
  				</tbody>
				</table>
				</body>
				</html>';  
	
	    
		$asunto = utf8_encode("=?UTF-8?B?" . base64_encode("Ingreso de Pago $rsvp_word en getPay") . "?="); 
		$mail->Subject = $asunto;  
		$mail->MsgHTML($message);
	
		if(!$mail->send()) { 
    	  	echo 'Message could not be sent.'; 
    		echo 'Mailer Error: ' . $mail->ErrorInfo;  
		} else {
    		//echo '<br>Message has been sent  
		}
		

}


?>