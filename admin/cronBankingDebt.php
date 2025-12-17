<?php
 
if(php_sapi_name() !== 'cli') {
    die("Acceso denegado: Este script solo puede ejecutarse desde un cron job."); 
}
if(date("l") == 'Sunday'){ 
	die("Acceso denegado: Este script no puede ejecutarse los Domingos");
}

require('/var/www/html/connection.php');  
require '/var/www/html/assets/PHPMailer/PHPMailerAutoload.php';

$numBD = 0;
$today = date('Y-m-d');
$tomorrow = date("Y-m-d", strtotime($today ." +1 day")); 
#$tomorrow2 = date("Y-m-d", strtotime($today ." +2 day")); 
$tomorrow3 = date("Y-m-d", strtotime($today ." +3 day")); 
$str1 = '';
$str2 = '';

#companies
$theCompany = array();
$querycompany = "select id, name from companies";
$resultcompany = mysqli_query($con, $querycompany);
while($rowcompany = mysqli_fetch_array($resultcompany)){
    $theCompany[$rowcompany['id']] = $rowcompany['name'];
} 

#banks
$thebank = array();
$querybanks = "select id, name from banks";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){
  $thebank[$rowbanks['id']] = $rowbanks['name'];
}

$query = "select bankingDebt.*, bankingDebtContracts.company, bankingDebtContracts.bank, bankingDebtContracts.currency from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where (bankingDebt.status2 = '2' or bankingDebt.status2 = '2.10') and bankingDebt.date2 = '$today'";   
$result = mysqli_query($con, $query); 
$num = mysqli_num_rows($result);
if($num > 0){
	$str1 = '<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px; text-align: left;">
	<thead>
        <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
            <th style="padding: 10px; border: 1px solid #dee2e6;">ID</th>
            <th style="padding: 10px; border: 1px solid #dee2e6;">Compa&ntilde;&iacute;a</th>
            <th style="padding: 10px; border: 1px solid #dee2e6;">Banco</th>
            <th style="padding: 10px; border: 1px solid #dee2e6;">No. De prestamo</th>
			 <th style="padding: 10px; border: 1px solid #dee2e6;">Fecha de pago</th>
        </tr>
    </thead>';
	while($row = mysqli_fetch_array($result)){
		$numBD++;
		$thisDate = date('d-m-Y',strtotime($row['date2']));
		$str1.='<tr style="background-color: #ffffff; border-bottom: 1px solid #dee2e6;">
		<td style="padding: 10px; border: 1px solid #dee2e6;">'.$row['id'].'</td>
		<td style="padding: 10px; border: 1px solid #dee2e6;">'.$theCompany[$row['company']].'</td>
		<td style="padding: 10px; border: 1px solid #dee2e6;">'.$thebank[$row['bank']].'</td>
		<td style="padding: 10px; border: 1px solid #dee2e6;">'.$row['number'].'</td>
		<td style="padding: 10px; border: 1px solid #dee2e6;">'.$thisDate.'</td>
		</tr>'; 
	}
	$str1.= '</table>';
}

$query2 = "select bankingDebt.*, bankingDebtContracts.company, bankingDebtContracts.bank, bankingDebtContracts.currency from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where (bankingDebt.status2 = '2' or bankingDebt.status2 = '2.10') and bankingDebt.date2 >= '$tomorrow' and bankingDebt.date2 <= '$tomorrow3' order by date2 asc";   
$result2 = mysqli_query($con, $query2); 
$num2 = mysqli_num_rows($result2);
if($num2 > 0){
	$str2 = '<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px; text-align: left;">
	<thead>
        <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
            <th style="padding: 10px; border: 1px solid #dee2e6;">ID</th>
            <th style="padding: 10px; border: 1px solid #dee2e6;">Compa&ntilde;&iacute;a</th>
            <th style="padding: 10px; border: 1px solid #dee2e6;">Banco</th>
            <th style="padding: 10px; border: 1px solid #dee2e6;">No. De prestamo</th>
			 <th style="padding: 10px; border: 1px solid #dee2e6;">Fecha de pago</th>
        </tr>
    </thead>';
	while($row2 = mysqli_fetch_array($result2)){
		$numBD++;
		$thisDate2 = date('d-m-Y',strtotime($row2['date2']));
		$str2.='<tr style="background-color: #ffffff; border-bottom: 1px solid #dee2e6;">
		<td style="padding: 10px; border: 1px solid #dee2e6;">'.$row2['id'].'</td>
		<td style="padding: 10px; border: 1px solid #dee2e6;">'.$theCompany[$row2['company']].'</td>
		<td style="padding: 10px; border: 1px solid #dee2e6;">'.$thebank[$row2['bank']].'</td>
		<td style="padding: 10px; border: 1px solid #dee2e6;">'.$row2['number'].'</td>
		<td style="padding: 10px; border: 1px solid #dee2e6;">'.$thisDate2.'</td> 
		</tr>'; 
	}
	$str2.= '</table>';
}

if(($num > 0) or ($num2 > 0)){
	
	$queryHost = "select * from mailer where active = '1'";
	$resultHost = mysqli_query($con, $queryHost);
	$rowHost = mysqli_fetch_array($resultHost);  
	
	$str1Main = '';
	if($str1 != ''){
		$str1Main = '<p>El siguiente detalle de prestamos presenta transacciones pendientes para el d&iacute;a de hoy:</p>'.$str1;
	}
	
	$str2Main = '';
	if($str2 != ''){
		$str2Main = '<p>El siguiente detalle de prestamos presenta transacciones pendientes en los proximos 3 d&iacute;as:</p>'.$str2;
	}
	
	$message = "";
	$message.= '<!doctype html>
				<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
				<style>body{ border:0px; background: #f6f6f6; }</style>
				<body bgcolor="#f6f6f6">
				<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  				<tbody>
    			<tr bgcolor="#18bff1">
      			<td><img src="https://getpay.casapellas.com.ni/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    			</tr>
				<tr>
      			<td style="padding:15px;">
				<p>Estimados usuarios,</p>
        		'.$str1Main.'
				'.$str2Main.'
				</td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="https://getpay.casapellas.com.ni/images/casa-pellas.png" height="20" style="padding:15px;"></td>
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
	
	$mail->addCC('jairovargasg@gmail.com', 'Jairo Vargas');
	$mail->addCC('hgaitan@casapellas.com', 'Hector Gaitan');
	
	$queryUsers = "select workers.email, workers.first, workers.last from routes inner join workers on routes.worker = workers.code where routes.type = '56'";
	$resultUsers = mysqli_query($con, $queryUsers);
	while($rowUsers=mysqli_fetch_array($resultUsers)){
		$mail->addAddress($rowUsers['email'], $rowUsers['first'].' '.$rowUsers['last']);
	}
    
	// Set email format to HTML
	$asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Prestamos con transacciones pendientes.') . "?=");
	$mail->Subject = $asunto;
	$mail->MsgHTML($message); 
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) { 
      	echo 'Message could not be sent.'; 
    	echo 'Mailer Error: ' . $mail->ErrorInfo;  
	} else {
    	echo '<br>Message has been sent';   
	}
	
}

?>