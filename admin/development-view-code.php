<? 

include('sessions.php');
require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$queryHost = "select * from mailer";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost);

$id = $_POST['iddevelopment'];
$today = date('Y-m-d');
$totime = date('H:i:s');

$user = $_SESSION['userid'];
$stage = $_POST['stage'];
$comments = $_POST['comments'];
$userid = $_POST['userid'];
$userid2 = $_POST['userid2'];
$taskname = $_POST['taskname'];

$query = "insert into development_trello (development, today, totime, user, stage, comments) values ('$id', '$today', '$totime', '$user', '$stage', '$comments')"; 
$result = mysqli_query($con, $query);

if($stage > 0){
	$query2 = "update development set status = '$stage' where id = '$id'";
	$result2 = mysqli_query($con, $query2);
}

if($userid == $_SESSION['userid']){
	$cuserid = $userid2;
}else{
	$cuserid = $userid;
}

$queryuser = "select * from workers where code = '$cuserid'";
$resultuser = mysqli_query($con, $queryuser);
$rowuser = mysqli_fetch_array($resultuser);
$username = $rowuser['first'].' '.$rowuser['last'];
$useremail = $rowuser['email'];

$queryuser2 = "select * from workers where code = '$_SESSION[userid]'";
$resultuser2 = mysqli_query($con, $queryuser2);
$rowuser2 = mysqli_fetch_array($resultuser2);
$username2 = $rowuser2['first'].' '.$rowuser2['last']; 
$useremail2= $rowuser2['email'];

switch($stage){
		case 0:
		$stagename = "Comentario/Consulta";
		break;
		case 1:
		$stagename = "Rechazo";
		break;
		case 2:
		$stagename = "Solucionado de otra manera";
		break;
		case 3:
		$stagename = "En desarrollo";
		break;
		case 4:
		$stagename = "Finalizado";
		break;
}

//Notification
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
      			<td><img src="https://getpaycp.com/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    			</tr>
				<tr>
      			<td style="padding:15px;">
				<p>Estimado '.$username.',</p>
        		<p>Usted esta recibiendo esta notificacion debido a la actividad en la siguiente tarea:</p>
        		<p>Nombre de la tarea: '.$taskname.'<br>
        		  Usuario: '.$username2.'<br>
        		  Etapa: '.$stagename.'<br>
				  Comentario:'.$comments.'<br>
        		</p>
        		<p>M&aacute;s informaci&oacute;n en http://getpaycp.com</p>
        		<p>&nbsp;</p></td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="https://getpaycp.com/images/casa-pellas.png" height="20" style="padding:15px;"></td>
    			</tr>
  				</tbody>
				</table>
				</body><br><br><br>
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

$mail->addAddress($useremail, $username);     // Add a recipient
$mail->addAddress($useremail2, $username2); 
        
$asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Actividad en Modulo de Desarrollo.') . "?=");
$mail->Subject = $asunto;
$mail->Body    = $message;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    //echo 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo; 
} else {
    //echo 'Message has been sent';
}

header('location: '.$_SERVER['HTTP_REFERER']);

?>