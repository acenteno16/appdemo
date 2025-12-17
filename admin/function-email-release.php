<?
/*
function getRelease($payment){ 
	
	$queryHost = "select * from mailer where active = '1'";
    $resultHost = mysqli_query($con, $queryHost);
    $rowHost = mysqli_fetch_array($resultHost);   
   
	$querypayment = "select blockrelease, company from payments where id = '$payment'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	
	$queryworker = "select first, last, email from workers where code = '$rowpayment[blockrelease]'";
	$resultworker = mysqli_query($con, $queryworker);
	$rowworker = mysqli_fetch_array($resultworker);
	
	$workerName = $rowworker['first'].' '.$rowworker['last'];
	
	$querycompany = "select name from companies where id = '$rowpayment[company]'";
	$resultcompany = mysqli_query($con, $querycompany);
	$rowcompany = mysqli_fetch_array($resultcompany);
	
	$company_header = '<tr bgcolor="#24355c"><td><img src="http://multitechserver.com/getpay/images/'.$rowcompany['imgroute2'].'" height="20" style="padding:15px;"></td></tr>';
	$company_name = $rowcompany['name'];
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Mailer = "smtp";
	$mail->SMTPDebug  = 0;  
	$mail->SMTPAuth   = TRUE;
	$mail->SMTPSecure = "tls";
	$mail->Port = $rowHost['mailPort'];
	$mail->Host = $rowHost['mailHost'];  // Specify main and backup SMTP servers 
	$mail->Username = $rowHost['mailUsername'];                 // SMTP username
	$mail->Password = $rowHost['mailPassword'];                           // SMTP password
	$mail->IsHTML(true);
	$mail->SetFrom("getpay@casapellas.com", "Getpay | Grupo Casa Pellas");                                // TCP port to connect 
	
	$mail->addAddress($rowworker['email'], $workerName); 
	
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
			<p>Estimad@ '.$workerName.'</p>
        	<p>El presente correo es para notificarle que se ha provisionado el ID de solicitud '.$payment.'. Dicho ID de solicitud fue gestionado previamente por su persona y deberá de ser revisado y gestionado nuevamente por usted.</p>
			</td>
   	 		</tr>
    		<tr bgcolor="#18bff1">
      		<td><img src="http://192.168.1.193/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    		</tr>
			</tbody>
			</table>
			<p style="text-align:center;color:#535353; font-size:12px;">Este correo electr&oacute;nico fue generado autom&aacute;ticamente por:<br>
			<strong>GetPay</strong> <em>"Sistema de Pagos de Grupo Casa Pellas"</em><br> 
			Favor no responder este mensaje.</p> 
			</body>
			</html>';  

		$mail->isHTML(true);                                    // Set email format to HTML
	
		$asunto = utf8_encode("=?UTF-8?B?" . base64_encode('ID'.$payment.' pendiente de liberación') . "?=");
		$mail->Subject = $asunto;  
		$mail->MsgHTML($message);

		if($usr > 0){ 
			$now = date('Y-m-d H:i:s a');
			if(!$mail->send()) { 
    	  		#echo 'Message could not be sent.'; 
    			#echo 'Mailer Error: ' . $mail->ErrorInfo;  
				$message = $mail->ErrorInfo; 
				$queryErr = "insert into mailerLog (payment, type, today, sent, message) values ('$payment', 'function-email-release.php Notification', '$now', '0', '$message')";
				$resultErr = mysqli_query($con, $queryErr);
		} else {
    		//echo '<br>Message has been sent to '.$email_str; 
				$message = '';
				$queryErr = "insert into mailerLog (payment, type, today, sent, message) values ('$payment', 'function-email-release.php Notification', '$now', '1', '$message')";
				$resultErr = mysqli_query($con, $queryErr);
		}
		}
		

}
*/

?>