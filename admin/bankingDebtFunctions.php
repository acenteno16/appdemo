<? 

include('session-bankingDebt.php');

function notifyDisbursement($id){ 
    
    exit();
	
	include_once('//home/getpaycp/public_html/assets/PHPMailer/PHPMailerAutoload.php'); 
	
	if($noRequire == 1){
		include('//home/getpaycp/public_html/connection.php');
	}else{
		include('sessions.php');
	}
	
	$queryHost = "select * from mailer where active = '1'";
    $resultHost = mysqli_query($con, $queryHost);
    $rowHost = mysqli_fetch_array($resultHost);  
    
  
	$users_names = ""; 
	$email_str = "";
	$bankname = "";
	
	$subject_post = "";
	if($forwarding == 1){
		$subject_post = " [Reenvío]";
	}
	
	$queryBankingDebt = "select * from bankingDebt where id = '$payment'";
	$resultBankingDebt = mysqli_query($con, $queryBankingDebt);
	$rowBankingDebt = mysqli_fetch_array($resultBankingDebt);  
	

	
	
	
	$currency = $rowpayment['currency']; 
	$querycurrency = "select * from currency where id = '$currency'"; 
	$resultcurrency = mysqli_query($con, $querycurrency);
	$rowcurrency =mysqli_fetch_array($resultcurrency);
	$beCurrency = $rowcurrency['pre'].' '.$rowcurrency['symbol'];
	

	

	$companyLogo = "companies/$company-email.png";
	if(!file_exists($companyLogo)){
		$companyLogo = 'companies/grupo-casa-pellas.png';
	}
	
	$company_header = '<tr bgcolor="#24355c"><td><img src="'.$companyLogo.'" height="30px" id="wlogo" style="padding:15px;"></td></tr>';
	$company_name = $rowThisCompany['name'];
	
	
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
	$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);  
	
	if($forcedEmail != ''){
		$mail->addAddress($forcedEmail); 
	}
	
		
	$message = '<!doctype html> 
			<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
			<style>body{ border:0px; background: #f6f6f6; font-family: "Roboto", sans-serif;}#wlogo{ max-height: 30px; }</style>
			<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
			<body bgcolor="#e8e8e8"> 
			<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  			<tbody>
    		'.$company_header.'
			<tr>
      		<td style="padding:15px;">
			<p>Estimad@'.$splural.' '.$users_names.'<br><br>
        	'.$company_name.' se complace en notificarle que se est&aacute procesando pago con ID: <i>'.$payment.'</i>'.$bankname.$strFavor.', a continuaci&oacute;n recibir&aacute; un detalle de documento(s) que se est&aacute(n) procesando:<br><br>
			<strong>Concepto:</strong> '.$thisConcept.'<br>
			<strong>Documento(s):</strong><br>
			'.$tableStr.'<br><br>
			Si necesita asistencia; con gusto les podremos atender en el PBX 2255-4444 Ext. 5775, en horario de Lunes a Viernes de 8:00am a 12m y de 2pm a 4:00pm y brinde el n&uacute;mero de ID al ejecutivo que lo atiende.</p>
			
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

		#$mail->addBCC('jairovargasg@gmail.com');
		#$mail->addBCC('tesoreria@casapellas.com.ni');
		#$mail->addBCC('lbrizuela@casapellas.com');
		$mail->isHTML(true);        
	
		$asunto = utf8_encode("=?UTF-8?B?" . base64_encode($company_name.' le ha procesado un pago'.$subject_post) . "?=");
		$mail->Subject = $asunto;  
		$mail->MsgHTML($message);

		if($usr > 0){  
			
			if(!$mail->send()) { 
    	  		
				$cnotStatus = 3;
				$emailSent = 0;
				$emailStatusMessage = $mail->ErrorInfo; 
				
			}else{
				
				$cnotStatus = 2;
				$emailSent = 1;
				$emailStatusMessage = 'Correo enviado exitosamente.';
				
			}
		}else{
			
			$cnotStatus = 3;
			$emailSent = 0;
			$emailStatusMessage = 'No se encontró un correo electrónico para hacer el envío.';
			
		}
	
	
	$now = date('Y-m-d H:i:s a');
	$pagename = $_SERVER['REQUEST_URI'];
	
	if($forwarding == 0){
		#1 envío de cancelacion
		$queryUpt = "update payments set cnotification = '$cnotStatus' where id = '$payment'";
		$resultUpt = mysqli_query($con, $queryUpt);
		
		$queryErr = "insert into mailerLog (payment, type, status, today, sent, message, pagename) values ('$payment', '1', '$cnotStatus', '$now', '$emailSent', '$emailStatusMessage', '$pagename')";
		$resultErr = mysqli_query($con, $queryErr);
		
	}else{
		#3 reenvio de cancelacion
		$queryErr = "insert into mailerLog (payment, type, status, today, sent, message, pagename) values ('$payment', '3', '$cnotStatus', '$now', '$emailSent', '$emailStatusMessage', '$pagename')";
		$resultErr = mysqli_query($con, $queryErr);
		
	}

	
	return $queryErr;

}

?>