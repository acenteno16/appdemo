<?php

require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$queryHost = "select * from mailer where active = '1'";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost);

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
if($rowHost['mailTLS'] == 1){
	$mail->SMTPSecure = "tls";
}elseif($rowHost['mailTLS'] == 2){
	$mail->SMTPSecure = "ssl";
}
$mail->Port = $rowHost[ 'mailPort' ];
$mail->Host = $rowHost[ 'mailHost' ]; 
$mail->Username = $rowHost[ 'mailUsername' ]; 
$mail->Password = $rowHost[ 'mailPassword' ]; 
$mail->IsHTML( true );
$mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFromName']);
$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);
		
//Seleccionamos el usuario
$querymanrequest = "select * from workers where code = '$_SESSION[userid]'";
$resultmanrequest = mysqli_query($con, $querymanrequest);
$rowmanrequest = mysqli_fetch_array($resultmanrequest);
$namerequest = $rowmanrequest['first']." ".$rowmanrequest['last'];
$emailrequest = $rowmanrequest['email'];
$unitrequest = $rowmanrequest['unit'];
		
$querymanrequestunit = "select * from units where code = '$unitrequest'";
$resultmanrequestunit = mysqli_query($con, $querymanrequestunit);
$rowmanrequestunit = mysqli_fetch_array($resultmanrequestunit);
		
$unitrequestname = $unitrequest." | ".$rowmanrequestunit['name'];
		
switch($currency){
	case 1:
	$mancurrency = "NIO C$";
	$mancurrency2 = " Cordobas";
	break;
	case 2:
	$mancurrency = "USD $";
	$mancurrency2 = " Dolares";
	break;
	case 3:
	$mancurrency = "EUR &euro;";
	$mancurrency2 = " Euros";
	break;
	case 4:
	$mancurrency = "YEN &yen;";
	$mancurrency2 = " Yenes";
	break; 
}
			
		$dunit = $_POST['dunit'];
		$dpercent = $_POST['dpercent'];
		$dtotal = $_POST['dtotal'];
		$did = $_POST['did'];

		for($c=0;$c<sizeof($dunit);$c++){
		
		if($dunit[$c] != $route){ 
			
			//Seleccionamos la unidad de negocio a la que se le envia la distribucion
			$querymanunit = "select * from units where code = '$dunit[$c]'";
			$resultmanunit = mysqli_query($con, $querymanunit);
			$rowmanunit = mysqli_fetch_array($resultmanunit);
			
			$unitmanname = $rowmanunit['code']." | ".$rowmanunit['name'];
			
			//Seleccionamos el proveedor 
			$querymanprovider = "select * from providers where id = '$provider'";
			$resultmanprovider = mysqli_query($con, $querymanprovider);
			$rowmanprovider = mysqli_fetch_array($resultmanprovider);
			
			$manprovider = $rowmanprovider['code']." | ".$rowmanprovider['name'];
			
			//Seleccionamos la ruta aprobado1 de dicha ruta
			$querymanroute = "select * from routes where unit = '$dunit[$c]' and type = '2'";
			$resultmanroute = mysqli_query($con, $querymanroute);
			echo '<br>'.$nummanroute = mysqli_num_rows($resultmanroute); 
			while($rowmanroute = mysqli_fetch_array($resultmanroute)){
			
				//Seleccionamos el usuario
				$querymanuser = "select * from workers where code = '$rowmanroute[worker]'";
				$resultmanuser = mysqli_query($con, $querymanuser);
				$rowmanuser = mysqli_fetch_array($resultmanuser);
				
				$manname = $rowmanuser['first']." ".$rowmanuser['last'];
				$manemail = $rowmanuser['email'];
				
				$to = $manemail;  
				$subject = 'Distribucion de pago | GetPay';
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
      			<td style="padding:15px;">
				<p>Estimado <a href="mailto:'.$manemail.'">'.$manname.'</a>,</p>
        		<p>Se le informa que una solicitud de pago le ha sido rechazada.</p>
      			<p><strong>ID de solicitud:</strong> '.$id.'<br> 
        		<strong>Proveedor:</strong> '.$manprovider.'|<br>
        		Rechazado por: '.$manname.'
        		<br>
       			<strong>Motivo:</strong> '.$unitmanname.'</p>
      			<p>&nbsp; </p>
				<p>&nbsp;</p>
				</td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="http://getpay.casapellas.com.ni/images/casa-pellas.png" height="20" style="padding:15px;"></td>
    			</tr>
  				</tbody>
				</table>
				</body>
				</html>'; 
				
				
				$mail->setFrom('getpay@casapellas.com.ni', 'GetPay'); 
				$mail->addAddress('$manemail', '$manname');     // Add a recipient
				//$mail->addAddress('ellen@example.com');               // Name is optional
				//$mail->addReplyTo('info@example.com', 'Information');
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');

				//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
				$mail->isHTML(true);                                  // Set email format to HTML
				
				$mail->Subject = 'Rechazo de solicitud'; 
				$mail->Body    = $message;
				/*$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';*/

				/*if(!$mail->send()) {
   				 echo 'Message could not be sent.';
   				 echo 'Mailer Error: ' . $mail->ErrorInfo; 
				} else {
   				 echo 'Message has been sent';
				}
				*/
				
			}
			
		}
		
	}
	
	
?>