<? 
/*
function sendEmailRetention($id,$forwarding,$noRequire,){ 
	
	include_once('../assets/PHPMailer/PHPMailerAutoload.php'); 
	if($noRequire == 1){
		include('../connection.php');
	}else{
		include('sessions.php');
	}
		
	$bills = "";
	$users_names = ""; 
	$email_str = "";
	$bankname = "";
	
	$subject_post = "";
	if($forwarding == 1){
		$subject_post = " [Reenvío]";
	}
    
    $queryHost = "select * from mailer where id = '1'";
    $resultHost = mysqli_query($con, $queryHost);
    $rowHost = mysqli_fetch_array($resultHost);
	
	$querypayment = "select * from payments where id = '$id'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	
	$queryret = "select * from irretention where payment = '$id' order by id desc limit 1";
  	$resultret = mysqli_query($con, $queryret);
  	$rowret = mysqli_fetch_array($resultret);
	$numret = mysqli_num_rows($resultret);
	
	$retentionno = $rowret['number'];
	
	if($rowpayment['btype'] == 1){
		//Proveedor
		$queryprovider = "select * from providers where id = '$rowpayment[provider]'";
		$resultprovider = mysqli_query($con, $queryprovider); 
		$rowprovider = mysqli_fetch_array($resultprovider);
		$provider_name = $rowprovider['name'];
		$provider_code = $rowprovider['code'];
		
		$btype = "Proveedor";
	}
	elseif($rowpayment['btype'] == 2){
		//Colaborador
		$queryprovider = "select * from workers where id = '$rowpayment[provider]'";
		$resultprovider = mysqli_query($con, $queryprovider); 
		$rowprovider = mysqli_fetch_array($resultprovider);
		$provider_name = $rowprovider['first']." ".$rowprovider['last'];
		$provider_code = $rowprovider['code'];
		$provider_email = $rowprovider['email'];
		
		$btype = "Colaborador";
	}
	
	//Facturas
	$querybills = "select * from bills where payment = '$id' and ret2a > '0'";
	$resultbills = mysqli_query($con, $querybills); 
	while($rowbills = mysqli_fetch_array($resultbills)){
		$bills.= '- '.$rowbills['number'].'<br>'; 
	}
	
	//Bank
	$querybank = "select * from banks where id = '$rowpayment[bank]'";
	$resultbank = mysqli_query($con, $querybank);
	$rowbank = mysqli_fetch_array($resultbank);
	
	if($rowbank['name'] != ""){
		$bankname = ' en el banco: <i>'.$rowbank['name'].'</i>'; 
	}
	else{
		$querybank0 = "select schedule.* from schedule inner join schedulecontent on schedule.id = schedulecontent.schedule where schedulecontent.payment = '$id'";
		$resultbank0 = mysqli_query($con, $querybank0);
		$rowbank0 = mysqli_fetch_array($resultbank0);
		
		$querybank1 = "select * from banks where id = '$rowbank0[bank]'";
		$resultbank1 = mysqli_query($con, $querybank1);
		$rowbank1 = mysqli_fetch_array($resultbank1);
		if($rowbank1['name'] != ""){
			$bankname = ' en el banco: <i>'.$rowbank1['name'].'</i>'; 
		} 
	}
	
      
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
	$mail->Host = $rowHost['mailHost'];  // Specify main and backup SMTP servers 
	$mail->Username = $rowHost['mailUsername'];                 // SMTP username
	$mail->Password = $rowHost['mailPassword'];                           // SMTP password
	$mail->IsHTML(true);
	$mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFromName']);
	$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);
	
	// TCP port to connect 
			
	if($rowpayment['btype'] == 1){		
		$query_users = "select * from providerscontacts where provider = '$rowpayment[provider]' and cret = '1'"; 
		$result_users = mysqli_query($con, $query_users);
		$num_users = mysqli_num_rows($result_users);
		$usr = 0; 
			
		while($row_users = mysqli_fetch_array($result_users)){
	
		$mail->addAddress($row_users['cemail'], $row_users['cname']); 
		$users_names.= $row_users['cname'].', ';
		$email_str.= $row_users['cemail'].', ';
		$usr++;
			
		}
	}
	elseif($rowpayment['btype'] == 2){
		$mail->addAddress($provider_email, $provider_name); 
		$users_names.= $provider_name.', ';
		$email_str.= $provider_email.', ';
	} 
				
	$splural = "";
	if($usr > 1){
		$splural = "(s)";
	}
	$users_names = substr($users_names,0,-2);	
	$company = $rowpayment['company'];
	
	//Alpesa
	if($company == 2){
		$company_header = '<tr bgcolor="#24355c"><td><img src="http://multitechserver.com/getpay/images/alpesa.png" height="20" style="padding:15px;"></td></tr>';
		$company_name = "Alpesa";
	}
	//Velosa
	elseif($company == 3){
		$company_header = '<tr bgcolor="#24355c"><td><img src="http://multitechserver.com/getpay/images/velosa.png" height="20" style="padding:15px;"></td></tr>';
		$company_name = "Velosa";
	}
	//Casa Pellas
	else{
		$company_header = '<tr bgcolor="#24355c"><td><img src="http://multitechserver.com/getpay/images/casa-pellas.png" height="20" style="padding:15px;"></td></tr>';
		$company_name = "Casa Pellas";
	}



$message = '<!doctype html> 
			<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
			<style>body{ border:0px; background: #f6f6f6; font-family: "Roboto", sans-serif;}</style>
			<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
			<body bgcolor="#e8e8e8"> 
			<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  			<tbody>
    		'.$company_header.'
			<tr>
      		<td style="padding:15px;">
			<p>Estimad@'.$splural.' '.$users_names.'</p>
        	<p>'.$company_name.' se complace en notificarle que conforme a la cancelaci&oacute;n de la solicitud de pago a  '.$provider_name.' con ID #'.$id.' se la ha generado "Retenci&oacute;n de IR" #'.$retentionno.' correspondiente a las siguientes facturas.</p>
			
			<p>Facturas:<br><br> 
			'.$bills.'
			
			<p>Atentamente<br>
			Grupo Casa Pellas</p>
			</td>
   	 		</tr>
    		<tr bgcolor="#18bff1">
      		<td><img src="http://multitechserver.com/getpay/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    		</tr>
			</tbody>
			</table>
			<p style="text-align:center;color:#535353; font-size:12px;">Este correo electr&oacute;nico fue generado autom&aacute;ticamente por:<br>
			<strong>GetPay</strong> <em>"Sistema de Pagos de Grupo Casa Pellas"</em><br> 
			Favor no responder este mensaje.</p> 
			</body>
			</html>';
		
			#$mail->addBCC('tesoreria@casapellas.com.ni');
			#$mail->addBCC('lbrizuela@casapellas.com');
			#$mail->addBCC('getpay.retenciones@gmail.com');
			$mail->addBCC('coo@rentalsnicaragua.com');

			$mail->addAttachment("//home/getpaycp/tosend/$id.pdf");        // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			                                // Set email format to HTML
			$asunto = utf8_encode("=?UTF-8?B?" . base64_encode("Retención IR #".$retentionno.$subject_post) . "?="); 
			$mail->Subject = $asunto;  
			$mail->MsgHTML($message);

			//Si hay mas de un usuario a quien enviarle y si existe una retención.
			if(($num_users > 0) and ($numret > 0)){  
				$now = date('Y-m-d H:i:s a');
				if(!$mail->send()) {
    				#echo 'Message could not be sent.';
    				$message = $mail->ErrorInfo; 
					$queryErr = "insert into mailerLog (payment, type, today, sent, message) values ('$id', '4', '$now', '0', '$message')";
					$resultErr = mysqli_query($con, $queryErr);
					
					if($forwarding == 0){
						$queryUpt = "update payments set rnotification = '3' where id = '$id'";
						$resultUpt = mysqli_query($con, $queryUpt);
					}
					
				} else {
    				#echo "<br>Message has been sent to ".$providers[$p]." (".date('d-m-Y').' @'.date('H:i:s').')';
					
					$queryErr = "insert into mailerLog (payment, type, today, sent) values ('$id', '4', '$now', '0')";
					$resultErr = mysqli_query($con, $queryErr);
					
					$queryUpt = "update payments set rnotification = '2' where payment = '$id'";
					$resultUpt = mysqli_query($con, $queryUpt);
					
					$today = date('Y-m-d');
					$totime = date('H:i:s'); 
					$queryret_update = "update irretention set dsent='1', dsenttoday='$today', dsenttotime='$totime' where payment = '$id' and number='$retentionno'";
  					$resultret_update = mysqli_query($con, $queryret_update);
					
					if($forwarding == 0){
						$queryUpt = "update payments set rnotification = '2' where id = '$id'";
						$resultUpt = mysqli_query($con, $queryUpt);
					}
					
				} 
			}
			
			else{
			
				//Enviar notificacion de que la retencion no existe.
				$mail = new PHPMailer;
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = $rowHost['mailHost'];  			  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = $rowHost['mailUsername'];         // SMTP username
				$mail->Password = $rowHost['mailPassword'];                          // SMTP password
				if($rowHost['mailTLS'] == 1){
					$mail->SMTPSecure = "tls";
				}elseif($rowHost['mailTLS'] == 2){
					$mail->SMTPSecure = "ssl";
				}   // Enable TLS encryption, `ssl` also accepted
				$mail->Port = $rowHost['mailPort'];
				
				$message = '<!doctype html> 
				<html><head><meta charset="UTF-8">
				<title>GET PAY</title></head>
				<style>body{ border:0px; background: #f6f6f6; font-family: "Roboto", sans-serif;}</style>
				<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
				<body bgcolor="#e8e8e8"> 
				<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  				<tbody>
    			'.$company_header.'
				<tr>
      			<td style="padding:15px;">
				<p>Se le informa que no existe una retención IR para el ID de solcicitud #'.$id.' a nombre de '.$company_name.' </p>
				<p>Atentamente<br>
				Grupo Casa Pellas</p>
				</td>
   	 			</tr>
    			<tr bgcolor="#18bff1">
      			<td><img src="http://multitechserver.com/getpay/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    			</tr>
				</tbody>
				</table>
				<p style="text-align:center;color:#535353; font-size:12px;">Este correo electr&oacute;nico fue generado autom&aacute;ticamente por:<br>
				<strong>GetPay</strong> <em>"Sistema de Pagos de Grupo Casa Pellas"</em><br> 
				Favor no responder este mensaje.</p> 
				</body>
				</html>';
				
				$mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFromName']);
				$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);
				$mail->addAddress('tesoreria@casapellas.com.ni');
				$mail->addBCC('jairovargasg@gmail.com');
				$mail->addBCC('getpay.retenciones@gmail.com');
				
				$mail->isHTML(true);          

				$asunto = utf8_encode("=?UTF-8?B?" . base64_encode("Retención IR #".$retentionno.$subject_post) . "?="); 
				$mail->Subject = $asunto;  

				$mail->Body = $message;
				$now = date('Y-m-d H:i:s a');
				if(!$mail->send()) {
    				//echo 'Message could not be sent.';
    				//echo 'Mailer Error: ' . $mail->ErrorInfo; 
					$queryErr = "insert into mailerLog (payment, type, today, sent, message) values ('$payment', 'function-email-irretention.php IR', '$now', '0', '$message')";
					$resultErr = mysqli_query($con, $queryErr);
				} else {
    				//echo "<br>Message has been sent to ".$providers[$p]." (".date('d-m-Y').' @'.date('H:i:s').')';
					$message = '';
					$queryErr = "insert into mailerLog (payment, type, today, sent, message) values ('$payment', 'function-email-irretention.php IR', '$now', '1', '$message')";
					$resultErr = mysqli_query($con, $queryErr);
					
					
					
				} 
				
			}

		}
*/
?>