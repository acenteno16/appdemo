<?php 

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require '../connection.php';
require 'fn-pending.php';
require '../assets/PHPMailer/PHPMailerAutoload.php';

$queryHost = "select * from mailer";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost);

//Pendientes de envío
$query_inprovision = "select userid from payments where payments.child='0' and (payments.status = '2' or payments.status = '3' or payments.status = '4') and payments.approved = '1' and ((payments.credit = 0) or (payments.credit = 2)) and fprovision = '0' group by userid";
$result_inprovision = mysqli_query($con, $query_inprovision);
$num_inprovision = mysqli_num_rows($result_inprovision);
while($row_inprovision=mysqli_fetch_array($result_inprovision)){

	$table_iprovision= "<table>
					   <tr>
					   <td style='border-bottom: 1px solid #000000;'>IDS</td>
					   <td style='border-bottom: 1px solid #000000;'>Beneficiario</td>
					   <td style='border-bottom: 1px solid #000000;'>Documento(s)</td>
					   </tr>";
					   
	$query_inprovision2 = "select id, btype, provider, collaborator, intern, client from payments where payments.child='0' and (payments.status = '2' or payments.status = '3' or payments.status = '4') and payments.approved = '1' and ((payments.credit = 0) or (payments.credit = 2)) and fprovision = '0' and userid = '$row_inprovision[userid]'";
	$result_inprovision2 = mysqli_query($con, $query_inprovision2);
	while($row_inprovision2=mysqli_fetch_array($result_inprovision2)){
		
		$query_user = "select code, first, last, email from workers where code = '$row_inprovision[userid]'";
		$result_user = mysqli_query($con, $query_user);
		$row_user = mysqli_fetch_array($result_user);
		$user_name = $row_user['first']." ".$row_user['last'];
		$user_email = $row_user['email'];
		
		switch($row_inprovision2['btype']){
		case 1:
		$query_beneficiarie = "select code, name from providers where id = '$row_inprovision2[provider]'";
		$result_beneficiary = mysqli_query($con, $query_beneficiarie);
		$row_beneficiary = mysqli_fetch_array($result_beneficiary);
		$ben_name = $row_beneficiary['name'];
		break;
		case 2:
		$query_beneficiarie = "select code, first, last, email from workers where id = '$row_inprovision2[collaborator]'";
		$result_beneficiary = mysqli_query($con, $query_beneficiarie);
		$row_beneficiary = mysqli_fetch_array($result_beneficiary);
		$ben_name = $row_beneficiary['first']." ".$row_beneficiary['last'];
		$users_names.= $ben_name.', ';
		$email_str.= $row_beneficiary['email'].', '; 
		break;
		case 3:
		$query_beneficiarie = "select first, last from intern where code = '$row_inprovision2[intern]'";
		$result_beneficiary = mysqli_query($con, $query_beneficiarie);
		$row_beneficiary = mysqli_fetch_array($result_beneficiary);
		$ben_name = $row_beneficiary['code']." | ".$row_beneficiary['name'];
		break;
		case 4:
		$query_beneficiarie = "select first, last, email, name, type from clients where code = '$row_inprovision2[client]'";
		$result_beneficiary = mysqli_query($con, $query_beneficiarie);
		$row_beneficiary = mysqli_fetch_array($result_beneficiary);
		if($row_beneficiary['type'] == 1){
			$ben_name = $row_beneficiary['first']." ".$row_beneficiary['last'];
		}else{
			$ben_name = $row_beneficiary['name'];
		} 
		break;
	}
	
	$documents = "";
	$query_documents = "select number from bills where payment = '$row_inprovision2[id]'";
	$result_documents = mysqli_query($con, $query_documents);
	while($row_documents=mysqli_fetch_array($result_documents)){
		$documents.= $row_documents['number'].", "; 
	}
	$documents = substr($documents, 0, -2);
	
	
	
	$table_iprovision.= "<tr>
				 		<td style='border-bottom: 1px solid #000000;'>$row_inprovision2[0]</td>
				 		<td style='border-bottom: 1px solid #000000;'>$ben_name</td>
				 		<td style='border-bottom: 1px solid #000000;'>$documents</td>
				 		</tr>";
	}
		
		
	$table_iprovision.= "</table>";
	$message= '<!doctype html>  
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
		  <p>Estimad@ '.$user_name.',</p>
          <p>Se le informa las siguientes solicitudes se encuentran pendiente(s) de entrega de documento(s) en Provisi&oacute;n.</p>
		  '.$table_iprovision.'
		  <p>Cuando entregue documentos al contador, asegurese de que dichos documentos se marquen como recibidos en GetPay.   </p>
		  <p>Ingresar a <a href="http://getpaycp.com/">http://getpaycp.com</a></p>
      	  <p>&nbsp;</p></td>
   	 	  </tr>
    	  <tr bgcolor="#24355c">
      	  <td><img src="http://getpaycp.com/images/casa-pellas.png" height="20" style="padding:15px;"></td>
                
    	  </tr>
          <tr>
          <td>
               
          </td>
          </tr>
  		  </tbody>
		  </table>
		  </body>
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
	
	
		$mail->addAddress($user_email, $user_name);    
		$mail->isHTML(true); 
		$asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Documentos pendientes de entrega.') . "?=");
		$mail->Subject = $asunto; 
		$mail->MsgHTML($message); 
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
    	  	echo 'Message could not be sent.'; 
    		echo 'Mailer Error: ' . $mail->ErrorInfo; 
		} 
		else {
    		echo 'Message has been sent'; 
		} 

}

?>