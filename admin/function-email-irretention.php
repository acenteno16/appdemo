<? 

function sendEmailRetention($id,$forwarding,$noRequire,$forcedEmail,$con){ 
	
	include_once('/var/www/html/assets/PHPMailer/PHPMailerAutoload.php'); 
		
	$provider_name= '';
	
	$bills = "";
	$users_names = ""; 
	$email_str = "";
	$bankname = "";
	
	$subject_post = "";
	if($forwarding == 1){
		$subject_post = " [Reenvío]";
	}
    
    $queryHost = "select * from mailer where active = '1'";
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
	$mail->Host = $rowHost['mailHost']; 
	$mail->Username = $rowHost['mailUsername']; 
	$mail->Password = $rowHost['mailPassword'];
	$mail->IsHTML(true);
	$mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFromName']);
	$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);	
			
	switch($rowpayment['btype']){ 
		case 1:
			$queryUsers = "select * from providerscontacts where provider = '$rowpayment[provider]' and cnot = '1'"; 
			$resultUsers = mysqli_query($con, $queryUsers); 
			$usr = $numUsers = mysqli_num_rows($resultUsers);
			while($rowUsers = mysqli_fetch_array($resultUsers)){
				if($forcedEmail == ''){
					$mail->addAddress($rowUsers['cemail'], $rowUsers['cname']); 
				}
				$users_names.= $rowUsers['cname'].', ';
				$email_str.= $rowUsers['cemail'].', ';
			}
			break;
		case 2:
			$queryUsers = "select * from workers where id = '$rowpayment[collaborator]'";
			$resultUsers = mysqli_query($con, $queryUsers);
			$rowUsers=mysqli_fetch_array($resultUsers);
			if($rowUsers['email'] != ''){
				if($forcedEmail == ''){
					$mail->addAddress($rowUsers['email'], $rowUsers['fisrt'].' '.$rowUsers['last']); 
				}
				$users_names = $rowUsers['first'].' '.$rowUsers['last'].', ';
				$email_str = $rowUsers['email'].', ';
				$usr = 1;
			}
			else{
				$usr = 0;
			}
			break;
		case 3:
			$queryUsers = "select first, last, email from interns where code = '$rowpayment[intern]'";
			$resultUsers = mysqli_query($con, $queryUsers);
			$rowUsers= mysqli_fetch_array($resultUsers);
			if($rowUsers['email'] != ''){
				if($forcedEmail == ''){
					$mail->addAddress($rowUsers['email'], $rowUsers['fisrt'].' '.$rowUsers['last']); 
				}
				$users_names = $rowUsers['first'].' '.$rowUsers['last'].', ';
				$email_str = $rowUsers['email'].', ';
				$usr = 1;
			}else{
				$usr = 0;
			}
			break;
		case 4:
			$queryUsers = "select * from clients where code = '$rowpayment[client]'";
			$resultUsers = mysqli_query($con, $queryUsers);
			$rowUsers =mysqli_fetch_array($resultUsers);
			if($rowUsers['email'] != ''){
				if($forcedEmail == ''){
					$mail->addAddress($rowUsers['email'], $rowUsers['fisrt'].' '.$rowUsers['last']); 
				}
				$users_names = $rowUsers['first'].' '.$rowUsers['last'].', ';
				$email_str = $rowUsers['email'].', ';
				$usr = 1;
			}else{
				$usr = 0;
			}
			break;
	}
	
	if($forcedEmail != ''){
		$mail->addAddress($forcedEmail); 
	}
				
	$splural = "";
	if($usr > 1){
		$splural = "(s)";
	}
	$users_names = substr($users_names,0,-2);	
	
	$company = $rowpayment['company'];
	
	$company = $rowpayment['company'];
	$queryThisCompany = "select name from companies where id = '$company'";
	$resultThisCompany = mysqli_query($con, $queryThisCompany);
	$rowThisCompany = mysqli_fetch_array($resultThisCompany);
	
	$companyLogo = "companies/$company-email.png";
	if(!file_exists($companyLogo)){
		$companyLogo = 'companies/grupo-casa-pellas.png';
	}
	
	$company_header = '<tr bgcolor="#24355c"><td><img src="'.$companyLogo.'" height="30px" id="wlogo" style="padding:15px;"></td></tr>';
	$company_name = $rowThisCompany['name'];
	

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
		
	$mail->addAttachment("/home/tosend/$id.pdf");  
	$asunto = utf8_encode("=?UTF-8?B?" . base64_encode("Retención IR #".$retentionno.$subject_post) . "?="); 
	$mail->Subject = $asunto;  
	$mail->MsgHTML($message);

	//Si hay mas de un usuario a quien enviarle y si existe una retención.
	if(($usr > 0) and ($numret > 0)){  
		if(!$mail->send()) {
			$rnotStatus = 3; 
			$emailSent = 0;
			$emailStatusMessage = $mail->ErrorInfo; 
					
		} else {
			$today = date('Y-m-d');
			$totime = date('H:i:s'); 
			$queryret_update = "update irretention set dsent='1', dsenttoday='$today', dsenttotime='$totime' where payment = '$id' and number='$retentionno'";
  			$resultret_update = mysqli_query($con, $queryret_update);
					
			$rnotStatus = 2;
			$emailSent = 1;
			$emailStatusMessage = 'Correo enviado exitosamente.';
					
		} 
	}
	else{
		$rnotStatus = 3;
		$emailSent = 0;
		$emailStatusMessage = 'No se encontró un correo electrónico para hacer el envío.';
	}
	
	$now = date('Y-m-d H:i:s a');
	$pagename = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : 'CLI/Unknown';
	
	if($forwarding == 0){
		#envío de retencion
		$queryUpt = "update payments set rnotification = '$rnotStatus' where id = '$id'";
		$resultUpt = mysqli_query($con, $queryUpt);
		
		$queryErr = "insert into mailerLog (payment, type, status, today, sent, message, pagename) values ('$id', '2', '$rnotStatus', '$now', '$emailSent', '$emailStatusMessage', '$pagename')";
		$resultErr = mysqli_query($con, $queryErr);
		
	}else{
		#reenvío de retencion
		$queryErr = "insert into mailerLog (payment, type, status, today, sent, message, pagename) values ('$id', '4', '$rnotStatus', '$now', '$emailSent', '$emailStatusMessage', '$pagename')";
		$resultErr = mysqli_query($con, $queryErr);
		
	}
	
	return $queryErr.'<br>'.$retentionno; 
	
}

?>