<?
/*
function notifyCancellations($payments,$forwarding){ 
	
	include_once('../assets/PHPMailer/PHPMailerAutoload.php'); 
	
	if($noRequire == 1){
		include('../connection.php');
	}else{
		include('sessions.php');
	}
	
	$queryHost = "select * from mailer where active = '1'";
    $resultHost = mysqli_query($con, $queryHost);
    $rowHost = mysqli_fetch_array($resultHost);  
    
    $bills = "";
	$users_names = ""; 
	$email_str = "";
	$bankname = "";
	
	$subject_post = "";
	if($forwarding == 1){
		$subject_post = " [Reenvío]";
	}
	
	$payment = explode(",", $payments);
	
	for($w=0;$w<sizeof($payment);$w++){
	
	//Todas las Variables a Cero
	
	
	$querypayment = "select * from payments where id = '$payment[$w]'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	
	if($rowpayment['btype'] == 1){
		//Proveedor
		$queryprovider = "select * from providers where id = '$rowpayment[provider]'";
		$resultprovider = mysqli_query($con, $queryprovider); 
		$rowprovider = mysqli_fetch_array($resultprovider);
		$provider_name = $rowprovider['name'];
		$provider_code = $rowprovider['code'];
		
		$btype = "Proveedor";
	}elseif($rowpayment['btype'] == 2){
		//Colaborador
		$queryprovider = "select * from workers where id = '$rowpayment[provider]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$provider_name = $rowprovider['first']." ".$rowprovider['last'];
		$provider_code = $rowprovider['code'];
		
		$btype = "Colaborador";
	}elseif($rowpayment['btype'] == 4){
		//Clientes
		$queryclients = "select type, first, last, name, email from clients where code = '$rowpayment[client]'";
		$resultclients = mysqli_query($con, $queryclients);
		$rowclients = mysqli_fetch_array($resultclients);
		if($rowclients['type'] == 1){
			//
			$provider_name = $rowprovider['first']." ".$rowprovider['last'];
			$provider_code = $rowprovider['code'];
		}else{
			//
			$provider_name = $rowprovider['first']." ".$rowprovider['last'];
			$provider_code = $rowprovider['code'];
		}
		
	}
	
	//Bank 
	$querybank = "select * from banks where id = '$rowpayment[bank]'";
	$resultbank = mysqli_query($con, $querybank);
	$rowbank = mysqli_fetch_array($resultbank);
	
	if($rowbank['name'] != ""){
		$bankname = ' en el banco: <i>'.$rowbank['name'].'</i>'; 
	}
	else{
		$querybank0 = "select schedule.* from schedule inner join schedulecontent on schedule.id = schedulecontent.schedule where schedulecontent.payment = '$payment'";
		$resultbank0 = mysqli_query($con, $querybank0);
		$rowbank0 = mysqli_fetch_array($resultbank0);
		
		$querybank1 = "select * from banks where id = '$rowbank0[bank]'";
		$resultbank1 = mysqli_query($con, $querybank1);
		$rowbank1 = mysqli_fetch_array($resultbank1);
		if($rowbank1['name'] != ""){
			$bankname = ' en el banco: <i>'.$rowbank1['name'].'</i>'; 
		} 
	}
	
	//Facturas
	$querybills = "select * from bills where payment = '$payment[$c]'";
	$resultbills = mysqli_query($con, $querybills);
	while($rowbills = mysqli_fetch_array($resultbills)){
		$bills.= '- '.$rowbills['number'].'<br>'; 
	}
	
	$company = $rowpayment['company'];
	
	//Alpesa
	if($company == 2){
		$company_header = '<tr bgcolor="#24355c"><td><img src="http://multitechserver.com/getpay/images/alpesa.png" height="20" style="padding:15px;"></td></tr>';
		$company_name = "Alpesa";
	}
	//Velosa
	elseif($company == 3){
		$company_header = '<tr bgcolor="#24355c"><td><img src="http://multitechserver.com/getpay/images/velosa.png" height="20" style="padding:15px;"></td></tr>';
		$company_name = "Velosa";
	}
	//Casa Pellas
	else{
		$company_header = '<tr bgcolor="#24355c"><td><img src="http://multitechserver.com/getpay/images/casa-pellas.png" height="20" style="padding:15px;"></td></tr>';
		$company_name = "Casa Pellas";
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
	$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);                                  // TCP port to connect 
	
	
		if($rowpayment['btype'] == 1){ 
			$query_users = "select * from providerscontacts where provider = '$rowpayment[provider]' and cnot = '1'"; 
			$result_users = mysqli_query($con, $query_users); 
			$num_users = mysqli_num_rows($result_users);
			$usr = 0; 
			
			while($row_users = mysqli_fetch_array($result_users)){
	
				$mail->addAddress($row_users['cemail'], $row_users['cname']); 
				$users_names.= $row_users['cname'].', ';
				$email_str.= $row_users['cemail'].', ';
				$usr++;
			
			}
		}
		elseif($rowpayment['btype'] == 2){
			//Collaborator
			$mail->addAddress($rowprovider['email'], $provider_name); 
			$users_names.= $provider_name.', ';
			$email_str.= $rowprovider['email'].', '; 
			
			//$mail->addBCC('jairovargasg@gmail.com');
			
		}
		elseif($rowpayment['btype'] == 4){
			//Collaborator
			$mail->addAddress($rowprovider['email'], $provider_name); 
			$users_names.= $provider_name.', ';
			$email_str.= $rowprovider['email'].', '; 
			
			//$mail->addBCC('jairovargasg@gmail.com');
			
		}
	
		
		$splural = "";
		if($usr > 1){
			$splural = "(s)";
		}
	    $users_names = substr($users_names,0,-2);
		
	
		//$message_top = "Estimados ".$users_names.",<br><br>Se les informa que se ha ingresado una solicitud de pago inmediato.";
	
	
		$table_tr = "<tr>
					<td>id</td>
					<td>'.$bills.'</td>
					<td>'.$bank_name.'</td>
					<td></td>
					</tr>";
					
					
					
					
	}
		
		
		$message = '<!doctype html> 
					<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
					<style>body{ border:0px; background: #f6f6f6; font-family: "Roboto", sans-serif;}</style>
					<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
					<body bgcolor="#e8e8e8"> 
					<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  					<tbody>
    				'.$company_header.'
					<tr>
      				<td style="padding:15px;">
					<p>Estimad@'.$splural.' '.$users_names.'</p>
        			<p>'.$company_name.' se complace en notificarle que se ha procesado pago con ID: 
					
					a favor de: <i>'.$provider_code.' | '.$provider_name.'</i></p>
			
					<p>Documento(s):<br>
					</p>
			
					<p>Si necesita asistencia; con gusto les podremos atender en el PBX 2255-4444 Ext. 5775, en horario de Lunes a Viernes de 8:00am a 12m y de 2pm a 4:00pm</p>
			
					</td>
   	 				</tr>
    				<tr bgcolor="#18bff1">
      				<td><img src="https://getpaycp.com/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    				</tr>
					</tbody>
					</table>
					<p style="text-align:center;color:#535353; font-size:12px;">Este correo electr&oacute;nico fue generado autom&aacute;ticamente por:<br>
					<strong>GetPay</strong> <em>"Sistema de Pagos de Grupo Casa Pellas"</em><br> 
					Favor no responder este mensaje.</p> 
					</body>
					</html>';  

		
		$asunto = utf8_encode("=?UTF-8?B?" . base64_encode($company_name.' le ha procesado un pago'.$subject_post) . "?=");
		$mail->Subject = $asunto;  
		$mail->MsgHTML($message);

		if($usr > 0){ 
			if(!$mail->send()) { 
    	  	echo 'Message could not be sent.'; 
    		echo 'Mailer Error: ' . $mail->ErrorInfo;   
		} else {
    		//echo '<br>Message has been sent to '.$email_str;   
		}
		}
		

}
*/
?>