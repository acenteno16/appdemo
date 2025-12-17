<?php

include("session-admin.php");

#1ro de mayo

$id = $_POST['id'];
$subject = $_POST['subject'];
$body = $_POST['body'];
$to = $_POST['to'];
$name = $_POST['name'];
$email = $_POST['email'];

$queryHost = "select * from mailer where id = '$id'";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost);
	

echo  'Userame: '.$rowHost['mailUsername'].'<br>Server: '.$rowHost['mailServer'].'<br>From: '.$rowHost['mailFrom'].'<br><br>';
echo "<a href='javascript:history.go(-1);'>Regresar</a><br><br>";

if($id == ''){
	exit('<script>aleret("Seleccione una cuenta.");history.go(-1);</script>');
}


require '../assets/PHPMailer/PHPMailerAutoload.php';  

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
				<p>'.$body.'</p>
      			</td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="http://getpay.casapellas.com.ni/images/casa-pellas.png" height="20" style="padding:15px;"></td>
    			</tr>
  				</tbody>
				</table>
				</body>
				</html>';     

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 2;  
$mail->SMTPAuth   = TRUE;
if($rowHost['mailTLS'] == 1){
		$mail->SMTPSecure = "tls";
	}elseif($rowHost['mailTLS'] == 2){
		$mail->SMTPSecure = "ssl";
	}
$mail->Port       = $rowHost['mailPort'];
$mail->Host       = $rowHost['mailHost'];
$mail->Username   = $rowHost['mailUsername'];
$mail->Password   = $rowHost['mailPassword'];

$mail->IsHTML(true);


for($i=0;$i<sizeof($to);$i++){
	switch($to[$i]){
		case 1:
			$mail->AddAddress($email[$i], $name[$i]);
			break;
		case 2:
			$mail->addCC($email[$i], $name[$i]);
			break;
		case 3:
			$mail->addBCC($email[$i], $name[$i]); 
			break;		
	}	
}

    
$mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFomName']);
$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);

$mail->Subject = $subject;
$mail->CharSet = 'UTF-8';
$mail->MsgHTML($message); 
if(!$mail->Send()) {
  #echo "Error while sending Email.";
  #var_dump($mail);
} else {
  #echo "Email sent successfully";
}



/*

echo "$rowHost[mailHost]<br>$rowHost[mailPort]<br>$rowHost[mailUsername]<br><br>";
#echo "<a href='javascript:history.go(-1);'>Regresar</a><br><br>";
#<br>$rowHost[mailPassword]

 
    
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 2;  
$mail->SMTPAuth   = TRUE;

$mail->Port       = $rowHost['mailPort'];
$mail->Host       = $rowHost['mailHost'];
$mail->Username   = $rowHost['mailUsername'];
$mail->Password   = $rowHost['mailPassword'];
$mail->IsHTML(true);




$from = $rowHost['mailFrom'];
if($from == ''){
	$from = $rowHost['mailUsername'];
}
$mail->SetFrom($from, $rowHost['mailFromName']);
$mail->AddReplyTo($from, $rowHost['mailFromName']);

$mail->Subject = $subject; 
$mail->CharSet = 'UTF-8';
$mail->MsgHTML($message); 
if(!$mail->Send()) {
  echo "Error while sending Email.";
  #var_dump($mail);
} else {
  echo "Email sent successfully";
}

?> 