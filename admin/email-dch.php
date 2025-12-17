<?php 


/*
error_reporting(E_ALL); 
ini_set('display_errors', 1);

$message = '		<!doctype html>
				<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
				<style>body{ border:0px; background: #f6f6f6; }</style>
				<body bgcolor="#f6f6f6">
				<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  				<tbody>
    			<tr bgcolor="#18bff1">
      			<td><img src="http://192.168.1.193/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    			</tr>
				<tr>
      			<td style="padding:15px;">
				<p>Estimado Danilo Chamorro,</p>
        		<p>Favor omitir correos de cambio de Clave. Estos correos han sido resultado de una pruba realizada a la seguridad del servidor. </p>
        		<p>Un saludo de parte de GetPay.</p>
      			<p>&nbsp;</p></td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="http://192.168.1.193/images/casa-pellas.png" height="20" style="padding:15px;"></td>
    			</tr>
  				</tbody>
				</table>
				</body>
				</html>';

require '../assets/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = $rowHost['mailHost'];  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $rowHost['mailUsername'];                 // SMTP username
$mail->Password = $rowHost['mailPassword'];                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = $rowHost['mailPort'];                                    // TCP port to connect 

$mail->setFrom('getpay@casapellas.com.ni', 'GetPay');  
$mail->addAddress('dchamorro@casapellas.com', 'Danilo Chamorro');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('enavarro@casapellas.com');
$mail->addBCC('ablandon@casapellas.com'); 

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Nueva clave en GetPay';
$mail->Body    = $message;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo; 
} else {
    echo 'Message has been sent';
}


*/ 

?> 