<?

include('../connection.php');
require '../assets/PHPMailer/PHPMailerAutoload.php';     

$queryHost = "select * from mailer where active = '1'";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost); 

function getNext($payment, $stage){
	
	include_once('sessions.php');
	
	$bills = "";
	$users_names = "";
	
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
	
	//Solicitante
	$queryuser = "select * from workers where code = '$rowpayment[userid]'"; 
	$resultuser = mysqli_query($con, $queryuser);
	$rowuser = mysqli_fetch_array($resultuser);
	
	$request_name = $rowuser['first'].' '.$rowuser['last'];
	$request_email = $rowuser['email'];
	
	//Proveedor
	$queryprovider = "select * from providers where id = '$rowpayment[provider]'";
	$resultprovider = mysqli_query($con, $queryprovider); 
	$rowprovider = mysqli_fetch_array($resultprovider);
	$provider_name = $rowprovider['name'];
	
	//Facturas
	$querybills = "select * from bills where payment = '$payment'";
	$resultbills = mysqli_query($con, $querybills);
	while($rowbills = mysqli_fetch_array($resultbills)){
		switch($rowbills['currency']){
				case 1:
				$pre = "NIO C$";
				break;
				case 2:
				$pre = "USD $";
				break;
				case 3:
				$pre = "EUR ";
				break;
				case 4:
				$pre = "YEN ";
				break;
		}
		
		$bills.= '#'.$rowbills['number'].'('.$pre.$rowbills['ammount'].'), ';
	}
	$bills = substr($bills,0,-2);
	
	$mail = new PHPMailer;
	$mail->isSMTP();                         // Set mailer to use SMTP
	$mail->Host = $rowHost['mailHost'];  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = $rowHost['mailUsername'];                 // SMTP username
	$mail->Password = $rowHost['mailPassword'];                           // SMTP password
	//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted 
	$mail->Port = $rowHost['mailPort'];                                     // TCP port to connect 
	
	if($stage == 1){
		//Get users from the route
		$queryroute = "select * from routes where unit = '$route' and headship = '$headship' group by worker"; 
		$resultroute = mysqli_query($con, $queryroute); 
		$numroute = mysqli_num_rows($resultroute);
		while($rowroute = mysqli_fetch_array($resultroute)){
			$queryuser2 = "select * from workers where code = '$rowroute[worker]'"; 
			$resultuser2 = mysqli_query($con, $queryuser2);
			$rowuser2 = mysqli_fetch_array($resultuser2);
	
			$mail->addAddress($rowuser2['email'], $rowuser2['first']." ".$rowuser2['last']);
			$users_names.= $rowuser2['first']." ".$rowuser2['last'].', ';
		}
		
		$users_names = substr($users_names,0,-2);
		$message_top = "Estimados ".$users_names.",<br><br>Se les informa que se ha ingresado una solicitud de pago inmediato.";
	
	}
	elseif($stage == 8){
		$queryroute = "select * from routes where type = '6' and companies like '%2%'"; 
		$resultroute = mysqli_query($con, $queryroute); 
		$numroute = mysqli_num_rows($resultroute);
		$tusr = 0;
		while($rowroute = mysqli_fetch_array($resultroute)){
			$queryuser2 = "select * from workers where code = '$rowroute[worker]'"; 
			$resultuser2 = mysqli_query($con, $queryuser2);
			$rowuser2 = mysqli_fetch_array($resultuser2);
	
			$mail->addAddress($rowuser2['email'], $rowuser2['first']." ".$rowuser2['last']);
			$users_names.= $rowuser2['first']." ".$rowuser2['last'].', ';
			$tusr++;
		}
		
		$s = "";
		$n = "";
		if($tusr > 1){
			$s = "s";
			$n = "n";
		}
		
		$users_names = substr($users_names,0,-2);
		
		$message_top = "Estimad@".$s.' '.$users_names.",<br><br>Se le".$s." informa que tiene".$n." pendiente una solictud de pago inmediato. Favor revisar getPay.";
		
	}
	
	else{
		
		$queryroute_p = "select type from routes where unit = '$route' and headship = '$headship' and type > '$stage' limit 1"; 
		$resultroute_p = mysqli_query($con, $queryroute_p);
		$rowroute_p = mysqli_fetch_array($resultroute_p);
		$new_stage = $rowroute_p['type']; 
			
		$queryroute = "select * from routes where unit = '$route' and headship = '$headship' and type = '$new_stage'"; 
		$resultroute = mysqli_query($con, $queryroute);
		$numroute = mysqli_num_rows($resultroute);  
		$tusr = 0;
		while($rowroute = mysqli_fetch_array($resultroute)){
			
			$queryuser2 = "select * from workers where code = '$rowroute[worker]'"; 
			$resultuser2 = mysqli_query($con, $queryuser2);
			$rowuser2 = mysqli_fetch_array($resultuser2);
	
			$mail->addAddress($rowuser2['email'], $rowuser2['first']." ".$rowuser2['last']);
			$users_names.= $rowuser2['first']." ".$rowuser2['last'].', ';
			$tusr++;
			
		}
		
		$s = "";
		$n = "";
		if($tusr > 1){
			$s = "s";
			$n = "n";
		}
		
		$users_names = substr($users_names,0,-2);
		
		$message_top = "Estimad@".$s.' '.$users_names.",<br><br>Se le".$s." informa que tiene".$n." pendiente una solictud de pago inmediato. Favor revisar getPay."; 
	} 

	
		        return $message = '<!doctype html>
				<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
				<style>body{ border:0px; background: #f6f6f6; }</style>
				<body bgcolor="#f6f6f6">
				<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  				<tbody>
    			<tr bgcolor="#18bff1">
      			<td><img src="http://192.168.1.193/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    			</tr>
				<tr>
      			<td style="padding:15px;">
        		<p>'.$message_top.'</p> 
        		<p><strong>ID de solicitud:</strong> '.$payment.'<br>
      			<strong>Proveedor:</strong> '.$provider_name.'<br>
				<strong>Monto de Solicitud:</strong> '.$pre_m.$rowpayment['payment'].'<br>
				<strong>Documento(s): </strong> '.$bills.'
				<br>
      			<p><strong>Nombre del Solicitante:</strong> '.$request_name.'<br>
        		<strong>Email del Solicitante:</strong> <a href="mailto:'.$request_email.'">'.$request_email.'</a> <br>
        		<strong>UN del Solicitante:</strong> '.$rowpayment['route'].'</p>
				</td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="http://192.168.1.193/images/casa-pellas.png" height="20" style="padding:15px;"></td>
    			</tr>
  				</tbody>
				</table>
				</body>
				</html>';  
	
	    
		$mail->setFrom('getpay@casapellas.com.ni', 'GetPay'); 
		// Add a recipient 
		//$mail->addAddress('example@casapellas.com');               // Name is optional
		//$mail->addReplyTo('example@casapellas.com', 'Information');
		//$mail->addCC('example@casapellas.com');
		$mail->addBCC('ablandon@casapellas.com');
		$mail->addBCC('jairovargasg@gmail.com');

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                   // Set email format to HTML

		$mail->Subject = 'Ingreso de Pago Inmediato en getPay';
		$mail->Body    = $message; 
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		/*
		if(!$mail->send()) { 
    	  	echo 'Message could not be sent.'; 
    		echo 'Mailer Error: ' . $mail->ErrorInfo;  
		} else {
    		echo '<br>Message has been sent to'.$email_str;   
		}*/
		

}


?>