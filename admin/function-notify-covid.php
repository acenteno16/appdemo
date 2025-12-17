<? 

function notifyUserCovid($payment, $con){
	
	include_once('../assets/PHPMailer/PHPMailerAutoload.php');  

	$queryHost = "select * from mailer where active = '1'";
    $resultHost = mysqli_query($con, $queryHost);
    $rowHost = mysqli_fetch_array($resultHost);
    
	$querypayment = "select * from payments where id = '$payment'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	
	$route = $rowpayment['route'];
	$headship = $rowpayment['headship'];
	
	switch($rowpayment['currency']){
				case 1:
				$pre_m = "NIO C$";
				break;
				case 2:
				$pre_m = "USD $";
				break;
				case 3:
				$pre_m = "EUR ";
				break;
				case 4:
				$pre_m = "YEN ";
				break;
		}
	
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
	
	//Solicitante
	$queryuser = "select * from workers where code = '$rowpayment[userid]'"; 
	$resultuser = mysqli_query($con, $queryuser);
	$rowuser = mysqli_fetch_array($resultuser);
	
	$userName = $rowuser['first'].' '.$rowuser['last'];
	$userEmail = $rowuser['email'];
    
    $mail->addAddress($rowuser['email'], $rowuser['first']." ".$rowuser['last']);
	$users_names.= $rowuser['first']." ".$rowuser['last'].', ';
    $tusr++; 
    
    //Contador
    $queryuser2 = "select * from workers where code = '$rowpayment[userid]'"; 
	$resultuser2 = mysqli_query($con, $queryuser2);
	$rowuser2 = mysqli_fetch_array($resultuser2);
	
	$userName2 = $rowuser['first'].' '.$rowuser['last'];
	$userEmail2 = $rowuser['email'];
    
    $mail->addAddress($rowuser['email'], $rowuser['first']." ".$rowuser['last']);
	$users_names.= $rowuser['first']." ".$rowuser['last'].', ';
    $tusr++; 
	
	//Proveedor/Colaborador
	if($rowpayment['btype'] == 1){
		$queryprovider = "select * from providers where id = '$rowpayment[provider]'";
		$resultprovider = mysqli_query($con, $queryprovider); 
		$rowprovider = mysqli_fetch_array($resultprovider);
		$provider_name = $rowprovider['code']." | ".$rowprovider['name'];
	}
	elseif($rowpayment['btype'] == 2){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$rowpayment[collaborator]'"));
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
	}
    elseif($rowpayment['btype'] == 3){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from interns where code = '$rowpayment[intern]'")); 
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
	}
	elseif($row['btype'] == 4){
		$queryprovider = "select * from clients where code = '$rowpayment[client]'";
		$rowprovider = mysqli_fetch_array(mysqli_query($con, $queryprovider)); 
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
	}

		        $sentfrom = $_SERVER['HTTP_REFERER'];
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
        		<p>Estimados usuarios,</p>
        		<p>Se les informa que la siguiente solicitud ha sido procesada por el modulo de provisión covid/especial y debe de ser remisionada a recepción de plaza españa por su persona o por el Contador si se encuentra disponible en la sucursal del Grupo Casa Pellas.</p> 
        		<p><strong>ID de solicitud:</strong> '.$payment.'<br>
      			<strong>Proveedor/Colaborador:</strong> '.$provider_name.'<br>
				<strong>Descripcion: </strong> '.$rowpayment['description'].'
				<br>
				<br>
        		<strong>Ruta de pago:</strong> '.$rowpayment['route'].'
				</td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="https://getpaycp.com/images/casa-pellas.png" height="20" style="padding:15px;">
				</td>
    			</tr>
  				</tbody>
				</table>
				</body>
				</html>';  
	
	
		$asunto = utf8_encode("=?UTF-8?B?" . base64_encode("Ingreso de Pago $rsvp_word en getPay") . "?="); 
		$mail->Subject = $asunto;  
		$mail->MsgHTML($message);
	
		if(!$mail->send()) { 
    	  	echo 'Message could not be sent.'; 
    		echo 'Mailer Error: ' . $mail->ErrorInfo;  
		} else {
    		//echo '<br>Message has been sent  
		}
		

}


?>