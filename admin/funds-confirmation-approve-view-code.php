<? 

include('sessions.php');

require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$queryHost = "select * from mailer where active = '1'";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost);

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$id = $_POST['id'];
$fAction= $_POST['fAction'];
$approved = $_POST['approved'];
$validated = $_POST['validated'];
$reason = $_POST['reason'];
$fApproved = $_POST['fApproved'];
$fReason = $_POST['fReasn'];
$bankreference = $_POST['bankreference'];
$statement = $_POST['statement'];
$company = $_POST['company'];
$bank = $_POST['bank'];
$currency = $_POST['currency'];
$tContent = '';

$queryFund = "select * from funds where id = '$id'";
$resultFund = mysqli_query($con, $queryFund);
$rowFund = mysqli_fetch_array($resultFund);

#requester
$queryUser = "select * from workers where code = '$rowFund[userid]'";
$resultUser = mysqli_query($con, $queryUser);
$rowUser = mysqli_fetch_array($resultUser);
$userEmail = $rowUser['email'];
$userName = $rowUser['first'].' '.$rowUser['last'];

#approver
$queryUser2 = "select * from workers where code = '$_SESSION[userid]'";
$resultUser2 = mysqli_query($con, $queryUser2);
$rowUser2 = mysqli_fetch_array($resultUser2);
$userEmail2 = $rowUser2['email'];
$userName2 = $rowUser2['first'].' '.$rowUser2['last'];

if($fAction == 0){
	exit('<script>alert("Debe de seleccionar una accion.");history.go(-1);</script>');
}
#encontrada
elseif($fAction == 1){
	
	if($validated == 0){
		exit('<script>alert("No se ha validado la referencia bancaria. Por favor presione el boton validar.");history.go(-1);</script>');
	}
	
	#repetida
	if(($approved == 0) and ($fApproved == 2)){
		
		$tContent.= '<h3 class="form-section">Transacciones</h3>
		 <table border="0" cellspacing="0" cellpadding="0">
		 <thead>
		 <tr>
		 <th width="5%">ID</th>
		 <th width="30%">Fecha</th>
		 <th width="45%">Usuario</th>
		 <th width="20%">Referencia</th>
		 </tr>
		 </thead>
		 <tbody>';
		$queryContent = "select * from funds where bankreference = '$bankreference' and approved = '1' and bank = '$rowFund[bank]' and currency = '$rowFund[currency] and company = '$rowFund[company]'";
		$resultContent = mysqli_query($con, $queryContent);
		while($rowContent=mysqli_fetch_array($resultContent)){ 
			
			$queryuser = "select * from workers where code = '$rowContent[userid]'";
			$resultuser = mysqli_query($con, $queryuser);
			$rowuser = mysqli_fetch_array($resultuser);
			$theuser = '<a href="mailto:'.$rowuser['email'].'">'.$rowuser['code']." | ".$rowuser['first']." ".$rowuser['last'].'</a>';
			
			$tContent.= '<tr>
						<td>'.$rowContent['id'].'</td>
						<td>'.date('d-m-Y',strtotime($rowContent['today'])).' @'.date('h:i:s a', strtotime($rowContent['now2'])).'</td>
						<td>'.$theuser.'</td>
						<td>'.$rowContent['bankreference'].'</td>
						</tr>'; 
		}
		$tContent.= '</tbody></table>';
		
		$theStatus = 3;
		$theApproved = 2;
		$theColor = 'red';
		$theReason = $fReason;
		
		$theSubject = 'FONDOS NO CONFIRMADOS';
		$body = 'Estimado: '.$userName.'<br><br>
		Lamentamos informarle que su solicitud no fue confirmada debido a que se encontraron los siguientes registros en el estado de cuenta: '.$statement.'.<br><br>
		'.$tContent.'<br><br>
		Comentarios del Aprobador: '.$theReason.'<br><br>
		
		Saludos.<br>
		'.$userName2;
		
	
	}
	
	#confirmada
if(($approved == 1) or ($fApproved == 1)){
		
		$theStatus = 4;
		$theApproved = 1;
		$sqlStr = ", bankreference='$bankreference', statement='$statement'";
		$theColor = 'green';
		$theReason = '';
		
		$theSubject = 'FONDOS CONFIRMADOS';
		$body = 'Estimado: '.$userName.'<br><br>
		Fondos confirmados en '.$company.' | '.$bank.' | '.$currency.'.<br>
		Estado de cuenta: '.$statement.'<br>
		Referencia Bancaria: '.$bankreference.'<br><br>
		Saludos.<br>
		'.$userName2;
		
	}
}
elseif($fAction > 1){
	#noEncontrada
	
	$theStatus = 3;
	$theApproved = 2;
	$theColor = 'red';
	$theReason = $reason;
	
	if($fAction == 2){
		$theSubject = 'FONDOS NO CONFIRMADOS';
		$body = 'Estimado: '.$userName.'<br><br>
		Lamentamos informarle que su solicitud no pudo ser confirmada ya que los fondos no se encuentran en la cuenta de '.$company.' | '.$bank.' | '.$currency.'.<br><br>
		Por favor ingresar nuevamente la solicitud una vez tenga la seguridad que su cliente hizo la transacción.<br><br>
		Comentarios del Aprobador: '.$reason.'<br><br>
		Saludos.<br>
		'.$userName2;
	}
	if($fAction == 3){
		
		if($reason == ''){
			exit('<script>alert("Favor ingresar comentarios del rechazo.");history.go(-1);</script>');
		}
		
		$theApproved = 2;
		$theColor = 'red';
		$theReason = $reason;
		$theSubject = 'FONDOS NO CONFIRMADOS';
		$body = 'Estimado: '.$userName.'<br><br>
		Lamentamos informarle que su solicitud no pudo ser confirmada ya que los fondos no se encuentran en la cuenta de '.$company.' | '.$bank.' | '.$currency.'.<br><br>
		Por favor ingresar nuevamente la solicitud una vez tenga la seguridad que su cliente hizo la transacción.<br><br>
		Comentarios del Aprobador: '.$reason.'<br><br>
		Saludos.<br>
		'.$userName2;
	}
	if($fAction == 4){
		$theSubject = 'FONDOS NO CONFIRMADOS';
		$body = 'Estimado: '.$userName.'<br><br>
		Lamentamos informarle que su solicitud no pudo ser confirmada ya que los fondos no se encuentran en la cuenta de '.$company.' | '.$bank.' | '.$currency.'.<br><br>
		Por favor ingresar nuevamente la solicitud una vez tenga la seguridad que su cliente hizo la transacción.<br><br>
		Comentarios del Aprobador: '.$reason.'<br><br>
		Saludos.<br>
		'.$userName2;
	}
	
}

$querySave = "update funds set userid2='$_SESSION[userid]', status = '$theStatus', status2='$fAction', approved='$theApproved'$sqlStr where id = '$id'";
$resultSave = mysqli_query($con, $querySave);
		
$queryFtimes = "insert into fundstimes (fund, today, now, now2, userid, stage, reason, color) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '$theStatus', '$theReason', '$theColor')";
$resultFtimes = mysqli_query($con, $queryFtimes);

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
				'.$body.'
				<p>M&aacute;s informaci&oacute;n en <a href="http://getpaycp.com/">http://getpaycp.com</a></p>
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
$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);                               // TCP port to connect 

// Add a recipient
$mail->addAddress('jairovargasg@gmail.com', 'Jairo Vargas'); 
$mail->addAddress($userEmail, $userName); 
$mail->addAddress($userEmail2, $userName2);  

$asunto = utf8_encode("=?UTF-8?B?" . base64_encode($theSubject) . "?="); 
$mail->Subject = $asunto; 
$message = 'test';
$mail->MsgHTML($message);
$mail->send();

header('location: funds-confirmation-approve.php'); 

?>