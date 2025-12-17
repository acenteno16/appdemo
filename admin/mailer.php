<?php 

/*

if($noRequire == 1){
	include('/home/getpaycp/public_html/connection.php');
}else{
	include('sessions.php');
}
require '/home/getpaycp/public_html/assets/PHPMailer/PHPMailerAutoload.php'; 	

$queryHost = "select * from mailer where active = '1'";
$resultHost = mysqli_query($con, $queryHost); 
$rowHost = mysqli_fetch_array($resultHost); 

echo "$rowHost[mailHost]<br>$rowHost[mailPort]<br>$rowHost[mailUsername]<br><br>";
#<br>$rowHost[mailPassword]

$message = '<!doctype html>
				<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
				<style>body{ border:0px; background: #f6f6f6; }</style>
				<body bgcolor="#f6f6f6">
				<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  				<tbody>
    			<tr bgcolor="#18bff1">
      			<td><img src="http://getpaycp.com/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    			</tr>
				<tr>
      			<td style="padding:15px;">
				<p>Test email.</p>
      			</td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="http://getpaycp.com/images/casa-pellas.png" height="20" style="padding:15px;"></td>
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
$mail->Host = $rowHost[ 'mailHost' ]; 
$mail->Username = $rowHost[ 'mailUsername' ]; 
$mail->Password = $rowHost[ 'mailPassword' ]; 
$mail->IsHTML( true );
$mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFromName']);
$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);

$mail->AddAddress("jairovargasg@gmail.com", "jairovargasg@gmail.com");

$asunto = utf8_encode("=?UTF-8?B?" . base64_encode("Prueba mailer") . "?="); 
$mail->Subject = $asunto; 
$mail->MsgHTML($message);  

if(!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
  echo "Email sent successfully";
}
*/

?> 