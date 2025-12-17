<?php

function fnPending($workername, $workeremail, $payments, $con) {
	
  include_once('/var/www/html/assets/PHPMailer/PHPMailerAutoload.php');

  $queryHost = "select * from mailer where active = '1'";
  $resultHost = mysqli_query($con, $queryHost );
  $rowHost = mysqli_fetch_array( $resultHost );

  $message = '<!doctype html> 
				<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
				<style>body{ border:0px; background: #f6f6f6; }</style>
				<body bgcolor="#f6f6f6">
				<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  				<tbody>
    			<tr bgcolor="#24355c"><td><img src="https://multitechserver.com/getpay/images/gcp-white.png" height="20"  style="padding:15px;"></td></tr>
				<tr>
      			<td style="padding:15px;">
				<p>Estimad@ '.$workername . '<a href="mailto:'.$workeremail.'"></a>,</p>
        		<p>Se le informa que  hay ' . $payments . ' solicitud(es) de pago pendiente(s) de su aprobaci&oacute;n en GetPay. Ingresar a <a href="https://getpaycp.com/">https://getpaycp.com</a></p>
      			<p>&nbsp;</p></td>
   	 			</tr>
    			<tr bgcolor="#18bff1">
      		 	<td><img src="https://multitechserver.com/getpay/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    		 	</tr>
                <tr>
                <td>
               
                </td>
                </tr>
  				</tbody>
				</table>
				</body>
				</html>';


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
	


$mail->addAddress( $workeremail, $workername ); // Add a recipient 

  $asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Solicitudes de pago pendientes de aprobación.') . "?=");
  $mail->Subject = $asunto;
  $mail->MsgHTML($message);

  if ( !$mail->send() ) {
	  
  } else {
	  
  }

}

function fnPendingvobo($workername, $workeremail, $payments, $con) {
	
  include('../connection.php');
  include_once('../assets/PHPMailer/PHPMailerAutoload.php');
	
  $queryHost = "select * from mailer where active = '1'";
  $resultHost = mysqli_query($con, $queryHost );
  $rowHost = mysqli_fetch_array( $resultHost );

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
				<p>Estimad@ ' . $workername . '<a href="mailto:' . $workeremail . '"></a>,</p>
        		<p>Se le informa que  hay ' . $payments . ' solicitud(es) de pago pendiente(s) de su visto bueno en GetPay. Ingresar a <a href="https://getpaycp.com">https://getpaycp.com</a></p>
      			<p>&nbsp;</p></td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="https://getpaycp.com/images/casa-pellas.png" height="20" style="padding:15px;"></td>
                
    			</tr>
                <tr>
                <td>
               
                </td>
                </tr>
  				</tbody>
				</table>
				</body>
				</html>';

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
  $mail->Host = $rowHost[ 'mailHost' ]; // Specify main and backup SMTP servers 
  $mail->Username = $rowHost[ 'mailUsername' ]; // SMTP username
  $mail->Password = $rowHost[ 'mailPassword' ]; // SMTP password
  $mail->IsHTML( true );
  $mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFromName']);
  $mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);
	
  $mail->addAddress( $workeremail, $workername ); // Add a recipient 
  
  $asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Solicitudes de pago pendientes de Visto Bueno') . "?=");
  $mail->Subject = $asunto;
  $mail->MsgHTML($message);
  //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  if ( !$mail->send() ) {
    #echo 'Message could not be sent.';
    #echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
    #echo 'Message has been sent';
  }

}

function fnPendingprovision( $workername, $workeremail, $payments, $con ) {
	
  include('../connection.php');
  include_once('../assets/PHPMailer/PHPMailerAutoload.php');

  $queryHost = "select * from mailer where active = '1'";
  $resultHost = mysqli_query($con, $queryHost );
  $rowHost = mysqli_fetch_array( $resultHost );	
	
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
				<p>Estimad@ ' . $workername . '<a href="mailto:' . $workeremail . '"></a>,</p>
        		<p>Se le informa que  hay ' . $payments . ' solicitud(es) de pago pendiente(s) de su provision en GetPay. Ingresar a <a href="http://getpay.casapellas.com.ni/">http://getpay.casapellas.com.ni</a></p>
      			<p>&nbsp;</p></td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="https://getpaycp.com/images/casa-pellas.png" height="20" style="padding:15px;"></td>
                
    			</tr>
                <tr>
                <td>
               
                </td>
                </tr>
  				</tbody>
				</table>
				</body>
				</html>';

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
  $mail->Host = $rowHost[ 'mailHost' ]; // Specify main and backup SMTP servers 
  $mail->Username = $rowHost[ 'mailUsername' ]; // SMTP username
  $mail->Password = $rowHost[ 'mailPassword' ]; // SMTP password
  $mail->IsHTML( true );
  $mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFromName']);
  $mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);
	
  $mail->addAddress( $workeremail, $workername ); // Add a recipient 
  
  $asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Solicitudes de pago pendientes de Provision') . "?=");
  $mail->Subject = $asunto;
  $mail->MsgHTML($message);

  if ( !$mail->send() ) {
    #echo 'Message could not be sent.';
    #echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
    #echo 'Message has been sent';
  }

}

?>