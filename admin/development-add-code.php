<? 

include('session-admin.php');
require '../assets/PHPMailer/PHPMailerAutoload.php';  

$queryHost = "select * from mailer";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost);

$today = date('Y-m-d');
$totime = date('H:i:s');
$today2 = $_POST['today2'];
if($today2 != ''){
	$today2 = date('Y-m-d', strtotime($today2));
}
$totime2 = $_POST['totime2'];
$name = $_POST['name'];
$description = $_POST['description'];
$priority = $_POST['priority'];
$userid2 = $_POST['userid2'];

$query = "insert into development (today, totime, name, description, userid, userid2, priority, today2, totime2) values ('$today', '$totime', '$name', '$description', '$_SESSION[userid]', '$userid2', '$priority', '$today2', '$totime2')"; 
$result = mysqli_query($con, $query); 
$id = mysqli_insert_id($con);

switch($priority){
		case 0:
		$priorityname = "Baja";
		break;
		case 1:
		$priorityname = "Media";
		break;
		case 2:
		$priorityname = "Alta";
		break;
		case 3:
		$priorityname = "Baja";
		break;
}

$queryuser = "select * from workers where code = '$userid2'";
$resultuser = mysqli_query($con, $queryuser);
$rowuser = mysqli_fetch_array($resultuser);
$username = $rowuser['first'].' '.$rowuser['last'];
$useremail = $rowuser['email'];

$queryuser2 = "select * from workers where code = '$_SESSION[userid]'";
$resultuser2 = mysqli_query($con, $queryuser2);
$rowuser2 = mysqli_fetch_array($resultuser2);
$username2 = $rowuser2['first'].' '.$rowuser2['last']; 
$useremail2= $rowuser2['email'];

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
        		<p>Se le informa que '.$username2.' ha agregado una peticion de desarrollo con la siguiente información:</p>
        		<p>Nombre: '.$name.'<br>
				Prioridad: '.$priorityname.'<br>
				Descripción: '.$description.'
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
$mail->Host = $rowHost['mailHost'];  // Specify main and backup SMTP servers 
$mail->Username = $rowHost['mailUsername'];                 // SMTP username
$mail->Password = $rowHost['mailPassword'];                           // SMTP password
$mail->IsHTML(true);
$mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFromName']);
$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);

$mail->addAddress($useremail, $username);     			// Add a recipient
$mail->addAddress($useremail2, $username2); 
                                 	// Set email format to HTML
$asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Nueva solicitud de Desarrollo.') . "?=");
$mail->Subject = $asunto;
$mail->MsgHTML($message); 

if(!$mail->send()) {
    //echo 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo; 
} else {
    //echo 'Message has been sent';
}

header('location: development-view.php?id='.$id);

?>