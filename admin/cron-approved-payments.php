<?php 

require '../connection.php';
require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$queryHost = "select * from mailer";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost);

$querynotifications = "select id, userid from payments where approved = '1' and notify = '0' group by userid"; 
$resultnotifications = mysqli_query($con, $querynotifications);
//echo "<br>Usuarios pendientes de notificar: ".
$numnotifications = mysqli_num_rows($resultnotifications);  
while($rownotifications=mysqli_fetch_array($resultnotifications)){
	$querynotuser = "select * from workers where code = '$rownotifications[userid]'";
	$resultnotuser = mysqli_query($con, $querynotuser); 
	$rownotuser = mysqli_fetch_array($resultnotuser);
	
	$workername3 = $rownotuser['first']." ".$rownotuser['last'];
	$workeremail3 = $rownotuser['email'];
	
	
	$querynotifications2 = "select id from payments where approved = '1' and notify = '0' and userid = '$rownotifications[userid]'"; 
	$resultnotifications2 = mysqli_query($con, $querynotifications2);
	//echo "<br>Pending notifications: ".
	$numnotifications2 = mysqli_num_rows($resultnotifications2);  
	$ids = "";
	while($rownotifications2=mysqli_fetch_array($resultnotifications2)){
		$ids.= $rownotifications2[0].", ";
		$queryupdate = "update payments set notify = '1' where id = '$rownotifications2[0]'";
		$resultupdate = mysqli_query($con, $queryupdate); 
	}
	
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
				<p>Estimad@ '.$workername3.'<a href="mailto:'.$workeremail3.'"></a>,</p>
        		<p>Se le informa que las siguientes solicitudes de pago han sido aprobadas: '.$ids.'.</p>
				<p>Puede proceder a imprimirlas para su entrega al provisionador. Ingresar a <a href="http://getpaycp.com/">http://getpaycp.com</a></p>
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
		//require '../assets/PHPMailer/PHPMailerAutoload.php'; 

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
	
		$mail->addAddress($workeremail3, $workername3);     // Add a recipient 
		
		$asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Solicitudes de pago aprobadas.') . "?=");
		$mail->Subject = $asunto;
		$mail->MsgHTML($message); 
	
		if(!$mail->send()) {
    	  	echo 'Message could not be sent.'; 
    		echo 'Mailer Error: ' . $mail->ErrorInfo; 
		} else {
    		echo 'Message has been sent';
		}
	
}


?>