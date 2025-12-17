<?php 

function fnReceived($id, $con){

	require_once '../assets/PHPMailer/PHPMailerAutoload.php'; 
	
	$queryHost = "select * from mailer where active = '1'";
    $resultHost = mysqli_query($con, $queryHost);
    $rowHost = mysqli_fetch_array($resultHost);
    
    //Get Request information
	$query = "select * from packages where id = '$id'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	
	$queryremmission= "select * from workers where code = '$row[userid]'";
	$resultremmission = mysqli_query($con, $queryremmission);
	$rowremmission = mysqli_fetch_array($resultremmission);
	
	$remmissionname = $rowremmission['first']." ".$rowremmission['last'];
	$remmissionemail = $rowremmission['email'];
	
	//Get reject information
	$queryreception = "select * from workers where code = '$_SESSION[userid]'";
	$resultreception = mysqli_query($con, $queryreception);
	$rowreception = mysqli_fetch_array($resultreception);
	
	$receptionname = $rowreception['first']." ".$rowreception['last']; 
	
	$rejectname = $rowreject['first']." ".$rowreject['last'];
	
	$message = '<!doctype html>
				<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
				<style>body{ border:0px; background: #f6f6f6; }</style>
				<body bgcolor="#f6f6f6">
				<br>
				<br>
				<br>
				<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  				<tbody>
    			<tr bgcolor="#18bff1">
      			<td><img src="https://getpay.casapellas.com.ni/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    			</tr>
				<tr>
      			<td style="padding:15px;">
				<p>Estimado '.$remmissionname.'<a href="mailto:'.$requestemail.'"></a>,</p>
        		<p>Se le informa que  la remisi&oacute;n con ID '.$id.' fue recibida por '.$receptionname.'</p>
				<p>M&aacute;s informaci&oacute;n en <a href="https://getpay.casapellas.com.ni/">https://getpay.casapellas.com.ni</a></p>
        		<p>&nbsp;</p></td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="https://getpay.casapellas.com.ni/images/casa-pellas.png" height="20" style="padding:15px;"></td>
    			</tr>
  				</tbody>
				</table>
				</body><br><br><br>
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
$mail->Host = $rowHost[ 'mailHost' ]; 
$mail->Username = $rowHost[ 'mailUsername' ]; 
$mail->Password = $rowHost[ 'mailPassword' ]; 
$mail->IsHTML( true );
$mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFromName']);
$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);
$mail->addAddress($remmissionemail, $remmissionname);     
	
$asunto = utf8_encode("=?UTF-8?B?" . base64_encode("Remisión recibida en recepción") . "?="); 
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