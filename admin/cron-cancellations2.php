<?php 

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

//Conection
require '../connection.php';
require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$queryHost = "select * from mailer where active = '1'";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost); 

$today = date('Y-m-d');
$now = date('Y-m-d H:i:s a');

//Declare Vars
$providers = array();
$btype = "";
$provider = "";
$collaborator = "";
$intern = "";
$client = "";
$users_names = "";
$email_str = "";

$subject_post = " [Reenvío]";


$query_main = "select id, btype, provider, collaborator, intern, client from payments where cnotification2 = '1' and btype = '1' limit 500";  
$result_main = mysqli_query($con, $query_main);
while($row_main=mysqli_fetch_array($result_main)){
	
	$id = $row_main[0];
	$btype = $row_main[1];
	
	if($row_main[2] > 0){
		$provider = $row_main[2];
	}else{
		$provider = 0;
	}
	if($row_main[3] > 0){
		$collaborator = $row_main[3];
	}else{
		$collaborator = 0;
	}
	
	if($row_main[4] > 0){
		$intern = $row_main[4];
	}else{
		$intern = 0;
	}
	
	if($row_main[5] > 0){
		$client = $row_main[5];
	}else{
		$client = 0;
	}
	
	//echo "<br>"."$btype,$provider,$collaborator,$intern,$client"; 
	$providers["$btype,$provider,$collaborator,$intern,$client"].= $id.","; 
	
	$query_main_update = "update payments set cnotification2 = '0' where id  = '$id'";
	$result_main_update = mysqli_query($con, $query_main_update); 
	
}

//Sent 
foreach ($providers as $beneficiary => $payments) {
    
	$users_names = ''; 
	$providers_arr = explode(',',$beneficiary);
	$payments = substr($payments,0,-1); 
	$payments_arr = explode(',',$payments);
	
	$btype_arr = $providers_arr[0];
	$provider_arr = $providers_arr[1];
	$collaborator_arr = $providers_arr[2];
	$intern_arr = $providers_arr[3];
	$client_arr = $providers_arr[4];
	
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
$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);                              // TCP port to connect 
	
	switch($btype_arr){
		case 1:
		$query_beneficiarie = "select code, name from providers where id = '$provider_arr'";
		$result_beneficiary = mysqli_query($con, $query_beneficiarie);
		$row_beneficiary = mysqli_fetch_array($result_beneficiary);
		$ben_name = $row_beneficiary['name'];
		
		$query_users = "select * from providerscontacts where provider = '$provider_arr' and cnot = '1'"; 
		$result_users = mysqli_query($con, $query_users);
		$num_users = mysqli_num_rows($result_users);
		$usr = 0;	
		while($row_users = mysqli_fetch_array($result_users)){
			$mail->addAddress($row_users['cemail'], $row_users['cname']); 
			$users_names.= $row_users['cname'].', ';
			$email_str.= $row_users['cemail'].', '; 
			$usr++;
		} 
		break;
		case 2:
		$query_beneficiarie = "select code, first, last, email from workers where id = '$collaborator_arr'";
		$result_beneficiary = mysqli_query($con, $query_beneficiarie);
		$row_beneficiary = mysqli_fetch_array($result_beneficiary);
		$ben_name = $row_beneficiary['first']." ".$row_beneficiary['last'];
		$mail->addAddress($row_beneficiary['email'], $ben_name); 
		$users_names.= $ben_name.', ';
		$email_str.= $row_beneficiary['email'].', '; 
		break;
		case 3:
		$query_beneficiarie = "select first, last from intern where code = '$intern_arr'";
		$result_beneficiary = mysqli_query($con, $query_beneficiarie);
		$row_beneficiary = mysqli_fetch_array($result_beneficiary);
		$ben_name = $row_beneficiary['code']." | ".$row_beneficiary['name'];
		break;
		case 4:
		$query_beneficiarie = "select first, last, email, name, type from clients where code = '$client_arr'";
		$result_beneficiary = mysqli_query($con, $query_beneficiarie);
		$row_beneficiary = mysqli_fetch_array($result_beneficiary);
		if($row_beneficiary['type'] == 1){
			$ben_name = $row_beneficiary['first']." ".$row_beneficiary['last'];
		}else{
			$ben_name = $row_beneficiary['name'];
		}
		$mail->addAddress($row_beneficiary['email'], $ben_name); 
		break;
	}
	
	$body = '<!doctype html> 
			 <html><head><meta charset="UTF-8"><title>GET PAY</title></head>
			 <style>body{ border:0px; background: #f6f6f6; font-family: "Roboto", sans-serif;}</style>
			 <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
			 <body bgcolor="#e8e8e8">
			 <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  			 <tbody>
			 <tr bgcolor="#24355c"><td><img src="http://multitechserver.com/getpay/images/gcp-white.png" height="20"  style="padding:15px;"></td></tr> 
			 <tr><td style="padding:10px;">
			 <p>Estimad@'.$splural.' '.$users_names.'</p> 
			 <p>Nos complacemos en informarle que se le ha procesado un pago con la siguiente informaci&oacute;n:</p>
			 <table>'; 
			
	//For de condiciones
	for($i=0;$i<sizeof($payments_arr);$i++){
		if($i==0){
			$sql = " and ((id = $payments_arr[$i])";
		}else{
			$sql.= " or (id = $payments_arr[$i])";
		}
		if($i==sizeof($payments_arr)-1){
			$sql.= ")";
		}
	}
	
	$company = 0;
	$retentions_str = "";
	$table_content = "";
	$query_payments = "select id, payment, company, currency, bank, ret2a from payments where id > '0'$sql order by company asc";
	$result_payments = mysqli_query($con, $query_payments);
	$num_payments = mysqli_num_rows($result_payments);
	$inc = 0;
	//While de payments
	
	$arr_retentions = ""; 
	$arr_retentions = array();	
		
	while($row_payments = mysqli_fetch_array($result_payments)){
		
		//Fecha de Ingreso a Banco
		$query_today = "select today from times where stage='13.00' and payment = '$row_payments[id]' order by id desc limit 1";
		$result_today = mysqli_query($con, $query_today);
		$row_today = mysqli_fetch_array($result_today);
		$today = date("d-m-Y", strtotime($row_today['today']));
		
		//Currency
		$query_currency = "select symbol from currency where id = '$row_payments[currency]'";
		$result_currency = mysqli_query($con, $query_currency); 
		$row_currency = mysqli_fetch_array($result_currency);
		$currency = $row_currency['symbol'];
		
		//Bills
		$documents = "";
		$query_documents = "select number, currency from bills where payment = '$row_payments[id]'";
		$result_documents = mysqli_query($con, $query_documents); 
		while($row_documents = mysqli_fetch_array($result_documents)){
			$documents.= $row_documents['number'].", ";
			$bills_currency = $row_documents['currency'];
		}
		
		$payments_currency = $row_payments['currency'];
		
		$query_bank = "select name from banks where id = '$row_payments[bank]'";
		$result_bank = mysqli_query($con, $query_bank);
		$row_bank = mysqli_fetch_array($result_bank);
		$bank = $row_bank['name'];
		
		
		
		
		if($totalize == 1){
			$amount_global_f = $currency.number_format($amount_global,2);
			$body.= "<tr><td colspan='$colspan'><b>Total $company_name:</b> $amount_global</td></tr>";
			$table_content.= "<tr><td colspan='$colspan'><b>Total $company_name:</b> $amount_global </td></tr>";
			$totalize = 0;
		}
		
		
		$inc++;
		$totalize = 0;
		if((($company != $row_payments['company']) and ($inc > 1)) or ($num_payments == $inc)){
			$totalize = 1;
		}else{
			$totalize = 0;
		}
		
		if($company != $row_payments['company']){
			$company = $row_payments['company'];
			$query_company = "select name from companies where id = '$row_payments[company]'";
			$result_company = mysqli_query($con, $query_company);
			$row_company = mysqli_fetch_array($result_company);
			$company_name = $row_company['name'];
			
			//Notificcion de Cancelación
			
			$colspan = 4;
			if(($payments_currency == $bills_currency) or (1 == 1)){
				$colspan = 5;
				$table_amount_str = "<td style='border-bottom: 1px solid #000000;'>Monto</td>";
				$body_amount_str = "<td style='border-bottom: 1px solid #000000;'>Monto</td>";
			}  
			
			$body.=  "<tr>
					  <td colspan='$colspan'>$company_name</td>
					  </tr>
					  <tr>
					  <td width='15%'></td>
					  <td width='25%'></td>
					  <td width='45%'></td>
					  <td width='25%'></td>
					  </tr>
					  <tr>
					  <td style='border-bottom: 1px solid #000000;'>ID</td>
					  <td style='border-bottom: 1px solid #000000;'>Fecha</td>
					  <td style='border-bottom: 1px solid #000000;'>Documento(s)</td>
					  ".$body_amount_str."
					  <td style='border-bottom: 1px solid #000000;'>Banco</td>
					  </tr>"; 
			
			//Notificacion de retencion IR
			$table_content.=  "<tr>
							   <td colspan='$colspan'>$company_name</td>
							   </tr>
							   <tr>
							   <td width='15%'></td>
							   <td width='25%'></td>
							   <td width='35%'></td>
							   <td width='15%'></td>
							   <td width='25%'></td>
							   </tr>
							   <tr>
							   <td style='border-bottom: 1px solid #000000;'>ID</td>
							   <td style='border-bottom: 1px solid #000000;'>Fecha</td>
							   <td style='border-bottom: 1px solid #000000;'>Documento(s)</td>
							   <td style='border-bottom: 1px solid #000000;'>Retenci&oacute;n</td>
							    ".$table_amount_str."
							   <td style='border-bottom: 1px solid #000000;'>Banco</td>
							   </tr>"; 
			
		}
		
		$the_amount = "";  
		if(($payments_currency == $bills_currency) or (1 == 1)){
				$the_amount = "<td style='border-bottom: 1px solid #000000;'>".$currency.number_format($row_payments[1],2)."</td>"; 
				$amount_global+=$row_payments[1];
		} 
		
		$body.= "<tr>
				 <td style='border-bottom: 1px solid #000000;'>$row_payments[0]</td>
				 <td style='border-bottom: 1px solid #000000;'>$today</td>
				 <td style='border-bottom: 1px solid #000000;'>$documents</td>
				 $the_amount
				 <td style='border-bottom: 1px solid #000000;'>$bank</td>
				 </tr>";
				 
		if($row_payments['ret2a'] > 0){
			
			$query_retention = "select number from irretention where payment = '$row_payments[id]' order by id desc limit 1";
			$result_retention = mysqli_query($con, $query_retention);
			
			
			while($row_retention = mysqli_fetch_array($result_retention)){
				$arr_retentions[] = $row_payments['id'].",".$row_retention['number'];
				$retno = $row_retention['number'];
				$table_content.= "<tr>
				 		  	  	<td style='border-bottom: 1px solid #000000;'>$row_payments[0]</td>
						  	  	<td style='border-bottom: 1px solid #000000;'>$today</td>
						  	  	<td style='border-bottom: 1px solid #000000;'>$documents</td>
							  	<td style='border-bottom: 1px solid #000000;'>$retno</td>
							  	$the_amount
						  	  	<td style='border-bottom: 1px solid #000000;'>$bank</td>
						  	  	</tr>";
		
				$retentions_str.= $row_payments['id'].","; 
			
			}
		}
		
		if($totalize == 1){
			$amount_global=$currency.number_format($amount_global,2);
			$body.= "<tr><td colspan='$colspan'><b>Total $company_name:</b> $amount_global</td></tr>";
			$table_content.= "<tr><td colspan='$colspan'><b>Total $company_name:</b> $amount_global </td></tr>";
			$totalize = 0;
		}
	}
	
		
	$body.= "</table>
			 <p>Si necesita asistencia; con gusto les podremos atender en el PBX 2255-4444 Ext. 5775, en horario de Lunes a Viernes de 8:00am a 12m y de 2pm a 4:00pm</p>
			 </td>
			 </tr>
			 <tr bgcolor='#18bff1'>
      		 <td><img src='http://multitechserver.com/getpay/images/getpay-white-h.png' height='30' style='padding:15px;'></td>
    		 </tr>
			 </tbody>
			 </table>".'<p style="text-align:center;color:#535353; font-size:12px;">Este correo electr&oacute;nico fue generado autom&aacute;ticamente por:<br>
			 <strong>GetPay</strong> <em>"Sistema de Pagos de Grupo Casa Pellas"</em><br> 
			 Favor no responder este mensaje.</p>'."</body>
			 </html>"; 
	 
	$mail->addBCC('getpay.retenciones@gmail.com');
	$mail->isHTML(true);                                    // Set email format to HTML
	$asunto = utf8_encode("=?UTF-8?B?" . base64_encode($company_name.' le ha procesado un pago'.$subject_post) . "?=");
	$mail->Subject = $asunto;  
	$mail->MsgHTML($body);
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; 

	if($usr > 0){ 
		
		$today = date('Y-m-d');
		
		if(!$mail->send()){ 
    	  	#echo 'Message could not be sent.'; 
    		#echo 'Mailer Error: ' . $mail->ErrorInfo;
			$message = $mail->ErrorInfo; 
			
			for($ie=0;$ie<sizeof($payments_arr);$ie++){
			
				$queryErr = "insert into mailerLog (payment, type, today, sent, message) values ('$payments_arr[$ie]', 'cron-cancellation.php Notification', '$now', '0', '$message')";
				$resultErr = mysqli_query($con, $queryErr);
			
				$queryInsert = "insert into cnotificationTimes (today, now, userid, notification, payment, stage, comments) values ('$today', '$now', '999999999', '3', '$payments_arr[$ie]', '2', '$comments')";
				$resultInsert = mysqli_query($con, $queryInsert);
			
			}
			
		} else {
			
			for($ie=0;$ie<sizeof($payments_arr);$ie++){
				
    			#echo "<br>Message has been sent to ".$providers[$p]." (".date('d-m-Y').' @'.date('H:i:s').')'; 
				$queryErr = "insert into mailerLog (payment, type, today, sent, message) values ('$payments_arr[$ie]', 'cron-cancellation.php Notification', '$now', '1', '$message')";
				$resultErr = mysqli_query($con, $queryErr);
			
				$query_main_update = "update payments set cnotification2 = '0' where id  = '$payments_arr[$ie]'";
				$result_main_update = mysqli_query($con, $query_main_update); 
			
				$queryInsert = "insert into cnotificationTimes (today, now, userid, notification, payment, stage, comments) values ('$today', '$now', '999999999', '3', '$payments_arr[$ie]', '3', '$comments')";
				$resultInsert = mysqli_query($con, $queryInsert);
			}
		}
	}
	
	//End of Cancellation Message 
	
	#####    ####    ### ####
	#####    ####    ### ### ####
	#####    ####    ###     ### ####
	#####    ####    ###         ### ####
	#####    ####    ###             ### ####
	#####    ####    ###                 ######
	#####    ####    ###             ### ####
	#####    ####    ###         ### ####
	#####    ####    ###     ### ####
	#####    ####    ### ### ####
	#####    ####    ### ####
	
	//Start IR Retention
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
	
	$query_users = "select * from providerscontacts where provider = '$provider_arr' and cret = '1'"; 
	$result_users = mysqli_query($con, $query_users);
	$num_users = mysqli_num_rows($result_users);
	$usr = 0; 
	
	$users_names = "";
	$email_str = "";
	while($row_users = mysqli_fetch_array($result_users)){
	
		$mail->addAddress($row_users['cemail'], $row_users['cname']); 
		$users_names.= $row_users['cname'].', ';
		$email_str.= $row_users['cemail'].', ';
		$usr++;
			
	}
				
	$splural = "";
	if($usr > 1){
		$splural = "(s)";
	}
	$users_names = substr($users_names,0,-2);
	
	
	$message = '<!doctype html> 
				<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
				<style>body{ border:0px; background: #f6f6f6; font-family: "Roboto", sans-serif;}</style>
				<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
				<body bgcolor="#e8e8e8"> 
				<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  				<tbody>
    			<tr bgcolor="#24355c"><td><img src="http://multitechserver.com/getpay/images/gcp-white.png" height="20" style="padding:15px;"></td></tr>
				<tr>
      			<td style="padding:15px;">
				<p>Estimad@'.$splural.' '.$users_names.'</p>
        		<p>Nos complacemos en notificarle que conforme a la(s) solicitud(es) de pago para '.$ben_name.' se la ha(n) cancelado los siguientes documentos; Adjuntando "Retenci&oacute;n(es) de IR" correspondiente a:</p>
			
				<table>
				'.$table_content.'
				</table>
			
				<p>Atentamente<br>
				Grupo Casa Pellas</p>
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
			
	
	$mail->addBCC('getpay.retenciones@gmail.com');
	$mail->addBCC('tesoreria@casapellas.com.ni');
	#$mail->addBCC('lbrizuela@casapellas.com');
	
	$retentions_str = substr($retentions_str,0,-1);
	$retentions_str_arr = explode(',',$retentions_str); 
	$numret = 0;
	for($rt=0;$rt<sizeof($retentions_str_arr);$rt++){
	
		//Comprobando si existe el arvhivo
		if(file_exists('/var/www/html/admin/tosend/'.$retentions_str_arr[$rt].'.pdf')){
			// Add attachments
			$mail->addAttachment('/var/www/html/admin/tosend/'.$retentions_str_arr[$rt].'.pdf'); 
			$numret++;
		}
	}
	
	$mail->isHTML(true);
	#$mail->CharSet = 'UTF-8'; // Set email format to HTML
	$asunto = utf8_encode("=?UTF-8?B?" . base64_encode("Retención(es) IR #".$retentions_str.$subject_post) . "?="); 
	$mail->Subject = $asunto;
	$mail->MsgHTML($message);
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			
	if(($num_users > 0) and ($numret > 0)){   
		$today = date('Y-m-d');
		$now = date('Y-m-d H:i:s a'); 
		
		if(!$mail->send()) {
    		//echo 'Message could not be sent.';
    		//echo 'Mailer Error: ' . $mail->ErrorInfo; 
			
			for($ie=0;$ie<sizeof($payments_arr);$ie++){
				
				$queryErr = "insert into mailerLog (payment, type, today, sent, message) values ('$payments_arr[$ie]', 'cron-cancellation.php IR', '$now', '0', '$message')";
				$resultErr = mysqli_query($con, $queryErr);
			
				$queryInsert = "insert into cnotificationTimes (today, now, userid, notification, payment, stage, comments) values ('$today', '$now', '999999999', '4', '$payments_arr[$ie]', '2', '$comments')";
				$resultInsert = mysqli_query($con, $queryInsert);
				
			}
			
			
		} else {
			
			for($ie=0;$ie<sizeof($payments_arr);$ie++){
    		
				#echo "<br>Message has been sent to ".$providers[$p]." (".date('d-m-Y').' @'.date('H:i:s').')';
				$queryErr = "insert into mailerLog (payment, type, today, sent, message) values ('$payments_arr[$ie]', 'cron-cancellation.php IR', '$now', '0', '$message')";
				$resultErr = mysqli_query($con, $queryErr);
			
				$today = date('Y-m-d');
				$totime = date('H:i:s'); 
			
				//Aqui se debe de hacer un foreach para el array de 
			
				$query_main_update = "update payments set rnotification2 = '0' where id  = '$payments_arr[$ie]'";
				$result_main_update = mysqli_query($con, $query_main_update); 
			
				$queryInsert = "insert into cnotificationTimes (today, now, userid, notification, payment, stage, comments) values ('$today', '$now', '999999999', '4', '$payments_arr[$ie]', '3', '$comments')";
				$resultInsert = mysqli_query($con, $queryInsert);  
				
			}
			
			
				for($a=0;$a<sizeof($arr_retentions);$a++){
	
					$arr_vars = explode(',', $arr_retentions[$a]);
				
					$queryret_update = "update irretention set dsent='1', dsenttoday='$today', dsenttotime='$totime' where payment = '$arr_vars[0]' and number='$arr_vars[1]'";
  					$resultret_update = mysqli_query($con, $queryret_update);
				
				}
					
		} 
	}

			
	//End IR Retention
	
	
}

?>