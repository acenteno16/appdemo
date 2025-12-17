<?php 

function fnExpirated($workername,$workeremail,$payments,$expirated_payments){
    
  include('../connection.php');
  include_once('../assets/PHPMailer/PHPMailerAutoload.php');
	
  $queryHost = "select * from mailer where active = '1'";
  $resultHost = mysqli_query($con, $queryHost );
  $rowHost = mysqli_fetch_array( $resultHost );

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
				<p>Estimad@ '.$workername.'<a href="mailto:'.$workeremail.'"></a>,</p>
        		<p>Se le informa que  hay '.$payments.' solicitud(es) de pago vencidas de su UN en las siguientes etapas. </p>
        		<table width="100%" border="1" cellspacing="0" cellpadding="0">
        		  <tbody>
        		    <tr>
        		      <td width="8%"><strong>IDS</strong></td>
        		      <td width="42%"><strong>Beneficiario</strong></td>
					  <td width="20%"><strong>Pendiente en</strong></td>
        		      <td width="20%"><strong>Vencimiento</strong></td>
					  <td width="10%"><strong>Ingreso Vencido</strong></td>
      		      </tr>
        		   '.$expirated_payments.'
      		    </tbody>
      		  </table>
        		<p>&nbsp;</p>
        		<p>Ingresar a <a href="https://getpaycp.com/">https://getpaycp.com</a></p>
      			<p>&nbsp;</p></td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="https://getpaycp.com/images/casa-pellas.png" height="20" style="padding:15px;"></td>
                
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
	
		$mail->addAddress($workeremail, $workername);    
	            
		$asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Solicitudes expiradas') . "?=");
		$mail->Subject = $asunto;
		$mail->MsgHTML($message); 
	
		if(!$mail->send()) {
    	  	echo 'Message could not be sent.'; 
    		echo 'Mailer Error: ' . $mail->ErrorInfo; 
		} else {
    		echo 'Message has been sent';
		}
	
}

function nextStage($stage,$route,$headship,$cc){
	
	$stage_force = 0;
	
	if($stage <= 8){
		
		$queryroute = "select routes.type from routes inner join usertype on routes.type = usertype.id where routes.type > '$stage' and routes.unit = '$route' and routes.headship = '$headship' and usertype.type = '1' and routes.headship='0' order by usertype.position asc limit 1";
		$resultroute = mysqli_query($con, $queryroute);
		$numroute = mysqli_num_rows($resultroute);
		if($numroute > 0){
			
			$rowroute = mysqli_fetch_array($resultroute);
			
			switch($rowroute[0]){
				default:
				$querystage = "select name2 from stages where id = '$rowroute[0]'";
				$resultstage = mysqli_query($con, $querystage);
				$rowstage = mysqli_fetch_array($resultstage);
				$payment_status = $rowstage['name2'];
				break;
				case 19:
				$payment_status = "Aprobado de Provisión";
				break;
				case 20:
				$payment_status = "VoBo. Solicitud";
				break;
			}
			
			
		}else{
			$stage_force = 1;
		}
		
	}
	if(($stage >= 9) or ($stage_force == 1)){
		switch($stage){
			default:
			$payment_status = "NA";
			break;
			case 8:
			$payment_status = "Liberación";
			break;
			case 9:
			if($cc == 1){
				$payment_status = "Programación";
			}else{
				$payment_status = "Control de Calidad";
			}
			break;
			case 11:
			$payment_status = "Provisión";
			break;
			case "11.01":
			$payment_status = "Provisión";
			break;
			case "11.02":
			$payment_status = "Provisión";
			break;
			case 12:
			$payment_status = "VoBo de Grupo";
			break;
			case "12.01":
			$payment_status = "Ingreso a Banco";
			break;
			case 13:
			$payment_status = "Cancelación";
			break;
			case "13.02":
			$payment_status = "Programación";
			break;
		}
	}
	
	return($payment_status);
	
}

?>