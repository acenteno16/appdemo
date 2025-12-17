<?

#ini_set('display_errors', '1');
#ini_set('display_startup_errors', '1');
#error_reporting(E_ALL);

include('sessions.php');

$id = $_POST['id'];

notifyCancellation($id,0,1,$con);

function notifyCancellation($payment,$forwarding,$noRequire,$con){ 
	
	include_once('/var/www/html/assets/PHPMailer/PHPMailerAutoload.php'); 
	
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
	
	$querypayment = "select * from payments where id = '$payment'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment); 
	$thisConcept = utf8_decode($rowpayment['description']);
	
	if($rowpayment['btype'] == 1){
		//Proveedor
		$queryprovider = "select * from providers where id = '$rowpayment[provider]'";
		$resultprovider = mysqli_query($con, $queryprovider); 
		$rowprovider = mysqli_fetch_array($resultprovider);
		$provider_name = utf8_decode($rowprovider['name']);
		$provider_code = $rowprovider['code'];
		
		$btype = "Proveedor";
	}
	else{
		//Colaborador
		$queryprovider = "select * from workers where id = '$rowpayment[provider]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$provider_name = utf8_decode($rowprovider['first']." ".$rowprovider['last']);
		$provider_code = $rowprovider['code'];
		
		$btype = "Colaborador";
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
	
	
	$currency = $rowpayment['currency']; 
	$querycurrency = "select * from currency where id = '$currency'"; 
	$resultcurrency = mysqli_query($con, $querycurrency);
	$rowcurrency =mysqli_fetch_array($resultcurrency);
	$beCurrency = $rowcurrency['pre'].' '.$rowcurrency['symbol'];
	
	//Facturas
	$billsStr = '';
	$tableStr = '<table><tr><th>Fecha de documento&nbsp;&nbsp;</th><th>No. documento&nbsp;&nbsp;</th><th>Monto a pagar&nbsp;&nbsp;</th></tr>';
	$querybills = "select * from bills where payment = '$payment'";
	$resultbills = mysqli_query($con, $querybills);
	while($rowbills = mysqli_fetch_array($resultbills)){
		
		$bills.= '- '.$rowbills['number'].'<br>'; 
		
		$billcurrency = $rowbills['currency'];
				
		if((($billcurrency == 1) and ($currency == 1)) or (($billcurrency == 2) and ($currency == 2))){
				
				
									//STOTAL IVA
									$rthe2rstotal = $rowbills['stotal']; 
									$rthe2rstotalglobal+=$rthe2rstotal;
									
									//STOTAL (NO IVA)
									$rthe2rstotal2 = $rowbills['stotal2'];
									$rthe2rstotal2global += $rthe2rstotal2;
									 
									//TAX
									$rthe2rtax = $rowbills['tax'];
									$rthe2rtaxglobal += $rthe2rtax;
								
									//INTUR
									$rthe2rintur = $rowbills['inturammount'];
									$rthe2rinturglobal += $rthe2rintur;
									
									//EXCENTO IMI
									$rthe2exempt2 = $rowbills['exempt2'];
									$rthe2exempt2global += $rthe2exempt2;
									
									//EXCENTO IR
									$rthe2exempt = $rowbills['exempt'];
									$rthe2exemptglobal += $rthe2exempt;
									
									//STOTAL
									$rthe2rgstotal = $rthe2rstotal+$rthe2rstotal2+$rthe2rtax+$rthe2rintur;
									$rthe2rgstotalglobal += $rthe2rgstotal;
									
									//RET BASE
									//$retentionbase = $rthe2rstotal-$rthe2exempt2-$rthe2exempt;
								    $retentionbase = $rthe2rstotal+$rthe2rstotal2;
									$retentionbaseglobal += $retentionbase;
									
									//RET IR
									
									if(($billcurrency == 1) and ($currency == 1)){
										$rthe2ret2a = $rowbills['ret2a'];
										$rthe2ret2aglobal += $rthe2ret2a; 
									}
									if(($billcurrency == 2) and ($currency == 2)){
										$rthe2ret2a = $rowbills['ret2a']/$rowbills['tc'];
										$rthe2ret2aglobal += $rthe2ret2a;
									}
									
									//RET IMI
									
									if(($billcurrency == 1) and ($currency == 1)){
										$rthe2ret1a = $rowbills['ret1a'];
										$rthe2ret1aglobal += $rthe2ret1a ;
									}
									if(($billcurrency == 2) and ($currency == 2)){
										$rthe2ret1a = $rowbills['ret1a']/$rowbills['tc'];
										$rthe2ret1aglobal += $rthe2ret1a ;
									}
									
									//PAYMENT
									$rthe2rpayment = $rthe2rgstotal-$rthe2ret2a-$rthe2ret1a;
									$rthe2rpaymentglobal += $rthe2rpayment;
									}
		elseif(($billcurrency == 1) and ($currency == 2)){	
				
									//STOTAL IVA
									$rthe2rstotal = $rowbills['stotal']/$rowbills['tc']; 
									$rthe2rstotalglobal+=$rthe2rstotal;
									
									//STOTAL (NO IVA)
									$rthe2rstotal2 = $rowbills['stotal2']/$rowbills['tc'];
									$rthe2rstotal2global += $rthe2rstotal2;
									 
									//TAX
									$rthe2rtax = $rowbills['tax']/$rowbills['tc'];
									$rthe2rtaxglobal += $rthe2rtax;
								
									//INTUR
									$rthe2rintur = $rowbills['inturammount']/$rowbills['tc'];
									$rthe2rinturglobal += $rthe2rintur;
									
									//EXCENTO IMI
									$rthe2exempt2 = $rowbills['exempt2']/$rowbills['tc'];
									$rthe2exempt2global += $rthe2exempt2;
									
									//EXCENTO IR
									$rthe2exempt = $rowbills['exempt']/$rowbills['tc'];
									$rthe2exemptglobal += $rthe2exempt;
									
									//STOTAL
									$rthe2rgstotal = $rthe2rstotal+$rthe2rstotal2+$rthe2rtax+$rthe2rintur;
									$rthe2rgstotalglobal += $rthe2rgstotal;
									
									//RET BASE
									//$retentionbase = $rthe2rstotal-$rthe2exempt2-$rthe2exempt;
									$retentionbase = $rthe2rstotal+$rthe2rstotal2;
								    $retentionbaseglobal += $retentionbase;
									
									//RET IR
									
									$rthe2ret2a = $rowbills['ret2a']/$rowbills['tc'];;
									$rthe2ret2aglobal += $rthe2ret2a; 
									
									//RET IMI
									$rthe2ret1a = $rowbills['ret1a']/$rowbills['tc'];;
									$rthe2ret1aglobal += $rthe2ret1a ; 
									
									//PAYMENT
									$rthe2rpayment = $rthe2rgstotal-$rthe2ret2a-$rthe2ret1a;
									$rthe2rpaymentglobal += $rthe2rpayment;
										
									} 
		elseif(($billcurrency == 2) and ($currency == 1)){	
				
									//STOTAL IVA
									$rthe2rstotal = $rowbills['stotal']*$rowbills['tc']; 
									$rthe2rstotalglobal+=$rthe2rstotal;
									
									//STOTAL (NO IVA)
									$rthe2rstotal2 = $rowbills['stotal2']*$rowbills['tc'];
									$rthe2rstotal2global += $rthe2rstotal2;
									 
									//TAX
									$rthe2rtax = $rowbills['tax']*$rowbills['tc'];
									$rthe2rtaxglobal += $rthe2rtax;
								
									//INTUR
									$rthe2rintur = $rowbills['inturammount']*$rowbills['tc'];
									$rthe2rinturglobal += $rthe2rintur;
									
									//EXCENTO IMI
									$rthe2exempt2 = $rowbills['exempt2']*$rowbills['tc'];
									$rthe2exempt2global += $rthe2exempt2;
									
									//EXCENTO IR
									$rthe2exempt = $rowbills['exempt']*$rowbills['tc'];
									$rthe2exemptglobal += $rthe2exempt;
									
									//STOTAL
									$rthe2rgstotal = $rthe2rstotal+$rthe2rstotal2+$rthe2rtax+$rthe2rintur;
									$rthe2rgstotalglobal += $rthe2rgstotal;
									
									//RET BASE
									//$retentionbase = $rthe2rstotal-$rthe2exempt2-$rthe2exempt;
									$retentionbase = $rthe2rstotal+$rthe2rstotal2;
								    $retentionbaseglobal += $retentionbase;
									
									//RET IR
									
									$rthe2ret2a = $rowbills['ret2a'];
									$rthe2ret2aglobal += $rthe2ret2a; 
									
									//RET IMI
									$rthe2ret1a = $rowbills['ret1a'];
									$rthe2ret1aglobal += $rthe2ret1a ; 
									
									//PAYMENT
									$rthe2rpayment = $rthe2rgstotal-$rthe2ret2a-$rthe2ret1a;
									$rthe2rpaymentglobal += $rthe2rpayment;
										
									} 
			
		$thisBillPayment = number_format($rthe2rpayment,2);
		
		$thisBillDate = date("d-m-Y", strtotime($rowbills['billdate']));
		$tableStr.= "<tr><td>$thisBillDate</td><td>$rowbills[number]</td><td>$beCurrency$thisBillPayment</td></tr>";
		
	}
	
	$tableStr.= '</table>';

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
	$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);  
	
	switch($rowpayment['btype']){ 
		case 1:
			$queryUsers = "select * from providerscontacts where provider = '$rowpayment[provider]' and cnot = '1'"; 
			$resultUsers = mysqli_query($con, $queryUsers); 
			$usr = $numUsers = mysqli_num_rows($resultUsers);
			while($rowUsers = mysqli_fetch_array($resultUsers)){
				#$mail->addAddress($rowUsers['cemail'], $rowUsers['cname']); 
				$users_names.= utf8_decode($rowUsers['cname']).', ';
				$email_str.= $rowUsers['cemail'].', ';
			}
			break;
		case 2:
			$queryUsers = "select * from workers where id = '$rowpayment[collaborator]'";
			$resultUsers = mysqli_query($con, $queryUsers);
			$rowUsers=mysqli_fetch_array($resultUsers);
			if($rowUsers['email'] != ''){
				#$mail->addAddress($rowUsers['email'], $rowUsers['fisrt'].' '.$rowUsers['last']); 
				$users_names = utf8_decode($rowUsers['first'].' '.$rowUsers['last']).', ';
				$email_str = $rowUsers['email'].', ';
				$usr = 1;
			}else{
				$usr = 0;
			}
			break;
		case 3:
			$queryUsers = "select first, last, email from interns where code = '$rowpayment[intern]'";
			$resultUsers = mysqli_query($con, $queryUsers);
			$rowUsers= mysqli_fetch_array($resultUsers);
			if($rowUsers['email'] != ''){
				#$mail->addAddress($rowUsers['email'], $rowUsers['fisrt'].' '.$rowUsers['last']); 
				utf8_decode($users_names = $rowUsers['first'].' '.$rowUsers['last']).', ';
				$email_str = $rowUsers['email'].', ';
				$usr = 1;
			}else{
				$usr = 0;
			}
			break;
		case 4:
			$queryUsers = "select * from clients where code = '$rowpayment[client]'";
			$resultUsers = mysqli_query($con, $queryUsers);
			$rowUsers =mysqli_fetch_array($resultUsers);
			#$mail->addAddress($rowUsers['email'], $rowUsers['fisrt'].' '.$rowUsers['last']); 
			$users_names = utf8_decode($rowUsers['first'].' '.$rowUsers['last']).', ';
			$email_str = $rowUsers['email'].', ';
			break;
	}
	
	$mail->addAddress('jairovargasg@gmail.com', 'Jairo Vargas');
	$mail->addAddress('hgaitan@casapellas.com', 'Hector Gaitan');

	$splural = "";
	if($usr > 1){
		$splural = "(s)";
	}
	$users_names = substr($users_names,0,-2);
	
	$strFavor = '';
	if($rowpayment['btype'] == 1){
		$strFavor = ' a favor de: <i>'.$provider_code.' | '.$provider_name.'</i>';
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
        	<p>'.$company_name.' se complace en notificarle que se est&aacute procesando pago con ID: <i>'.$payment.'</i>'.$bankname.$strFavor.', a continuaci&oacute;n recibir&aacute; un detalle de documento(s) que se est&aacute(n) procesando:</p>
			<p>Concepto: '.$thisConcept.'</p>
			<p>Documento(s):<br>
			'.$tableStr.'</p>
			<p>Si necesita asistencia; con gusto les podremos atender en el PBX 2255-4444 Ext. 5775, en horario de Lunes a Viernes de 8:00am a 12m y de 2pm a 4:00pm y brinde el n&uacute;mero de ID al ejecutivo que lo atiende.</p>
			
			</td>
   	 		</tr>
    		<tr bgcolor="#18bff1">
      		<td><img src="http://multitechserver.com/getpay/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    		</tr>
			</tbody>
			</table>
			<p style="text-align:center;color:#535353; font-size:12px;">Este correo electr&oacute;nico fue generado autom&aacute;ticamente por:<br>
			<strong>GetPay</strong> <em>"Sistema de Pagos de Grupo Casa Pellas"</em><br> 
			Favor no responder este mensaje.</p> 
			</body>
			</html>';  

		#$mail->addBCC('tesoreria@casapellas.com.ni');
		#$mail->addBCC('lbrizuela@casapellas.com');
		$mail->isHTML(true);        
	
		$asunto = utf8_encode("=?UTF-8?B?" . base64_encode($company_name.' le ha procesado un pago'.$subject_post) . "?=");
		$mail->Subject = $asunto;  
		$mail->MsgHTML($message);

		if($usr > 0){  
			
			if(!$mail->send()) { 
    	  		
				$cnotStatus = 3;
				$emailSent = 0;
				$emailStatusMessage = $mail->ErrorInfo;  
				
			}else{
				
				$cnotStatus = 2;
				$emailSent = 1;
				$emailStatusMessage = 'Correo enviado exitosamente.';
				
			}
		}else{
			
			$cnotStatus = 3;
			$emailSent = 0;
			$emailStatusMessage = 'No se encontró un correo electrónico para hacer el envío.';
			
		}
	
	
	$now = date('Y-m-d H:i:s a');
	$pagename = $_SERVER['REQUEST_URI'];
	
	if($forwarding == 0){
		#1 envío de cancelacion
		$queryUpt = "update payments set cnotification = '$cnotStatus' where id = '$payment'";
		$resultUpt = mysqli_query($con, $queryUpt);
		
		$queryErr = "insert into mailerLog (payment, type, status, today, sent, message, pagename) values ('$payment', '1', '$cnotStatus', '$now', '$emailSent', '$emailStatusMessage', '$pagename')";
		$resultErr = mysqli_query($con, $queryErr);
		
	}else{
		#3 reenvio de cancelacion
		$queryErr = "insert into mailerLog (payment, type, status, today, sent, message, pagename) values ('$payment', '3', '$cnotStatus', '$now', '$emailSent', '$emailStatusMessage', '$pagename')";
		$resultErr = mysqli_query($con, $queryErr);
		
	}

	
	return $queryErr;

}

header('location: email-cancellation.php');

?>