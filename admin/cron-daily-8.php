<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../connection.php';
require 'fn-pending.php';
require '../assets/PHPMailer/PHPMailerAutoload.php';   

$queryHost = "select * from mailer";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost); 

$notification = array();
$workername2 = "";
$workeremail2 = "";

//Notificaciones de Distribución

$pq = 0;
//$querymaindistribution = "select * from distribution where notified = '0' group by payment";
$querymaindistribution = "select distribution.* from distribution inner join payments on distribution.payment = payments.id where distribution.notified = '0' and payments.status > '0' and payments.distributable = '1' order by distribution.id desc limit 10";   
$resultmaindistribution = mysqli_query($con, $querymaindistribution); 
$nummaindistribution = mysqli_num_rows($resultmaindistribution);
while($rowmaindistribution = mysqli_fetch_array($resultmaindistribution)){
	
	$pq++;
	
	//Get the payment information
	$querypayment = "select * from payments where id = '$rowmaindistribution[payment]'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	$payment = $rowpayment['id'];
	
	//Get the currency
	switch($rowpayment['currency']){
			case 1:
			$mancurrency = "NIO C$";
			$mancurrency2 = " Córdobas";
			break;
			case 2:
			$mancurrency = "USD $";
			$mancurrency2 = " Dólares";
			break;
			case 3:
			$mancurrency = "EUR &euro;";
			$mancurrency2 = " Euros";
			break;
			case 4:
			$mancurrency = "YEN &yen;";
			$mancurrency2 = " Yenes";
			break; 
		}
	
	//Get the request
	$querymanrequest = "select * from workers where code = '$rowpayment[userid]'";
	$resultmanrequest = mysqli_query($con, $querymanrequest);
	$rowmanrequest = mysqli_fetch_array($resultmanrequest);
	$namerequest = $rowmanrequest['first']." ".$rowmanrequest['last'];
	$emailrequest = $rowmanrequest['email'];
	
	//Seleccionamos el proveedor
	if($rowpayment['btype'] == 1){
		$querymanprovider = "select * from providers where id = '$rowpayment[provider]'";
		$resultmanprovider = mysqli_query($con, $querymanprovider);
		$rowmanprovider = mysqli_fetch_array($resultmanprovider);
		$nameprovider = $rowmanprovider['code']." | ".$rowmanprovider['name'];
		$typeprovider = "Proveedor";
	}else{
		$querymanprovider = "select * from workers where id = '$rowpayment[collaborator]'"; 
		$resultmanprovider = mysqli_query($con, $querymanprovider);
		$rowmanprovider = mysqli_fetch_array($resultmanprovider);
		$nameprovider = $rowmanprovider['code']." | ".$rowmanprovider['first']." ".$rowmanprovider['last'];
		$typeprovider = "Colaborador";
	}
	
	
	//Get the unit name
	$querymanunit = "select * from units where ((code = '$rowmaindistribution[unit]') or (code2 = '$rowmaindistribution[unit]'))";
	$resultmanunit = mysqli_query($con, $querymanunit);
	$rowmanunit = mysqli_fetch_array($resultmanunit);
	$nameunit = $rowmanunit['code']." | ".$rowmanunit['name'];
	
	//Get the unit name
	$querymanunit2 = "select * from units where ((code = '$rowpayment[route]') or (code2 = '$rowpayment[route]'))";
	$resultmanunit2 = mysqli_query($con, $querymanunit2);
	$rowmanunit2 = mysqli_fetch_array($resultmanunit2);
	$nameunit2 = $rowmanunit2['code']." | ".$rowmanunit2['name'];
	
	//echo "<br>Payment: ".$rowpayment['id'];
	//echo "<br>Unit: ".$rowmanunit['code']." | ".$rowmanunit['name'];
	//echo "<br>Worker: ".$namerequest;
	
	//get the Line
	$queryline = "select * from blines where units like '%$rowmaindistribution[unit]%'";
	$resultline = mysqli_query($con, $queryline);
	$rowline = mysqli_fetch_array($resultline);
	
	//Lineal mailto
	unset($mailto);  
	$mailto = array();
	
	if($rowline['mailto'] != ""){ $mailto[] = $rowline['mailto']; }
	if($rowline['mailto2'] != ""){ $mailto[] = $rowline['mailto2']; }
	if($rowline['mailto3'] != ""){ $mailto[] = $rowline['mailto3']; }
	if($rowline['mailto4'] != ""){ $mailto[] = $rowline['mailto4']; }
	if($rowline['mailto5'] != ""){ $mailto[] = $rowline['mailto5']; }
	
	
	//echo "<br>sizeof: ".sizeof($mailto);
	
	for($m=0;$m<sizeof($mailto);$m++){  
		
		
		$notification[$mailto[$m]][$payment][$rowmaindistribution['id']]['did'] = $rowmaindistribution['id'];
		$notification[$mailto[$m]][$payment][$rowmaindistribution['id']]['requestname'] = $namerequest;
		$notification[$mailto[$m]][$payment][$rowmaindistribution['id']]['requestemail'] = $emailrequest;
		$notification[$mailto[$m]][$payment][$rowmaindistribution['id']]['requestunit'] = $nameunit2;
		$notification[$mailto[$m]][$payment][$rowmaindistribution['id']]['unit'] = $nameunit;
		$notification[$mailto[$m]][$payment][$rowmaindistribution['id']]['provider'] = $nameprovider;
		$notification[$mailto[$m]][$payment][$rowmaindistribution['id']]['providert'] = $typeprovider;
		$notification[$mailto[$m]][$payment][$rowmaindistribution['id']]['stotal'] = $rowpayment['stotal'];
		$notification[$mailto[$m]][$payment][$rowmaindistribution['id']]['distribution'] = $rowmaindistribution['total'];
		$notification[$mailto[$m]][$payment][$rowmaindistribution['id']]['distributionp'] = $rowmaindistribution['percent'];
		$notification[$mailto[$m]][$payment][$rowmaindistribution['id']]['distributionc'] = $mancurrency;
		$notification[$mailto[$m]][$payment][$rowmaindistribution['id']]['distributionc2'] = $mancurrency2;
		$notification[$mailto[$m]][$payment][$rowmaindistribution['id']]['description'] = $rowpayment['description'];
		
	} 
	
	//7864441271 
	//CargoBMW
	
	//End of $rowmaindistribution array
	$querymainupdate = "update distribution set notified = '1' where id = '$rowmaindistribution[id]'";
	$resultmainupdate = mysqli_query($con, $querymainupdate);
	
}
 //echo "<br>Payments: ".$pq; 
 //echo "<br>Size of Notifications: ".sizeof($notification); 
 //echo '<br><br>';

//$notification = array_filter($notification);
//$notification = array_unique($notification);  


//Users
foreach($notification as $key=>$value){
	//echo '<br>'.$key;
	
	$querynot = "select * from workers where code = '$key'";
	$resultnot = mysqli_query($con, $querynot);
	$rownot = mysqli_fetch_array($resultnot);
	
	$notname = $rownot['first']." ".$rownot['last'];
	$notemail = $rownot['email'];
	
	$message = "";
	$message.= '<!doctype html>
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
				<p>Estimad@ <a href="mailto:'.$notemail.'">'.$notname .'</a></p>
        		<p>Se le informan las siguientes distribuciones en su línea de negocio:</p>';
	//Payments
	foreach($notification[$key] as $key2=>$value2){
		//echo '<br>'.$key2;
		$farray = key($notification[$key][$key2]); 
		$message.='<p><strong>ID de solicitud:</strong> '.$key2.'<br>
      			<strong>Monto de Solicitud:</strong> '.$notification[$key][$key2][$farray]['distributionc'].str_replace('.00','',number_format($notification[$key][$key2][$farray]['stotal'],2)).' '.$notification[$key][$key2][$farray]['distributionc2']."<br>
";
				//$message.= '<br><strong>Distributions:</strong> '.count($notification[$key])."<br>";
					
					
		//Distributions
		
		foreach($notification[$key][$key2] as $key3=>$value3){
			
			$message.= '<br><strong>ID de Distribucion: </strong> '.$notification[$key][$key2][$key3]['did'].'<br>
			<strong>Monto cargado:</strong> <span style="color:#059b33;">'.$notification[$key][$key2][$key3]['distributionc'].str_replace('.00','',number_format($notification[$key][$key2][$key3]['distribution'],2)).' '.$notification[$key][$key2][$key3]['distributionc2'].' ('.str_replace('.00','',number_format($notification[$key][$key2][$key3]['distributionp'],2)).'%)</span><br>
        	<strong>Cargado a la UN:</strong> '.$notification[$key][$key2][$key3]['unit'].'<br>'; 
		}
		
		$message.= '<br><strong>Motivo:</strong> '.$notification[$key][$key2][$key3]['description'].'<br> 
        		<strong>'.$notification[$key][$key2][$key3]['providert'].':</strong> '.$notification[$key][$key2][$key3]['provider'].'<br>
       			
				
      			<p><strong>Nombre del Solicitante:</strong> '.$notification[$key][$key2][$key3]['requestname'].'<br>
        		<strong>Email del Solicitante:</strong> <a href="mailto:'.$emailrequest.'">'.$notification[$key][$key2][$key3]['requestemail'].'</a> <br>
        		<strong>UN del Solicitante:</strong> '.$notification[$key][$key2][$key3]['requestunit'].'</p><hr>';
	}
	
	$message.= '</td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="https://getpaycp.com/images/casa-pellas.png" height="20" style="padding:15px;"></td>
    			</tr>
  				</tbody>
				</table>
				</body>
				</html>'; 
	
	    //echo '<br><hr><br>'.$message;
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
	
		$mail->addAddress($notemail, $notname);      // Add a recipient 
                            // Set email format to HTML
		$asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Notificacion de distribuciones.') . "?=");
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