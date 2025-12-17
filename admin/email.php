<?php 
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);

$manemail = "";
$manname = "";
$id = "";
$mancurrency = "";
$gstotald = "";
$mancurrency2 = "";
$description = "";
$manprovider = "";
$unitmanname = "";
$namerequest = "";
$emailrequest = "";
$emailrequest = "";
$unitrequestname = "";

$message = '<!doctype html>
				<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
				<style>body{ border:0px; background: #f6f6f6; }</style>
				<body bgcolor="#f6f6f6">
				<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  				<tbody>
    			<tr bgcolor="#18bff1">
      			<td><img src="http://getpay.casapellas.com.ni/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    			</tr>
				<tr>
      			<td style="padding:15px;"><p>ESTO ES UNA PRUEBA</p>
				<p>Estimado <a href="mailto:"></a>,</p>
        		<p>Se le informa que en la solicitud de pago se ha distribuido a su unidad de negocio el siguiente monto:</p>
      			<p><strong>ID de solicitud:</strong> <br>
      			<strong>Monto de Solicitud:</strong> <br>
        		<strong>Monto cargado:</strong> <span style="color:#059b33;"></span><br>
        		<strong>Motivo:</strong><br> 
        		<strong>Proveedor:</strong> <br>
       			<strong>Cargado a la UN:</strong> </p>
      			<p>&nbsp; </p>
				<p><strong>INFORMACION DEL SOLICITANTE</strong></p>
      			<p><strong>Nombre:</strong> <br>
        		<strong>Email:</strong> <a href="mailto:">'.$emailrequest.'</a> <br>
        		<strong>UN:</strong> </p>
				</td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="http://getpay.casapellas.com.ni/images/casa-pellas.png" height="20" style="padding:15px;"></td>
    			</tr>
  				</tbody>
				</table>
				</body>
				</html>';
				


//$mail->Password = "MTV-rC25"; // Contraseña


require '../assets/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.casapellas.com.ni';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'getpay@casapellas.com.ni';                 // SMTP username
$mail->Password = 'MTV-rC25';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect 

$mail->setFrom('getpat@casapellas.com.ni', 'GetPay'); 
$mail->addAddress('jairovargasg@gmail.com', 'Jairo Vargas');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = $message;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo; 
} else {
    echo 'Message has been sent';
}



*/


 
?>