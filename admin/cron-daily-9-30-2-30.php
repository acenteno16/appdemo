<?php 

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

require '../connection.php';
require 'fn-pending.php';
require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$queryHost = "select * from mailer";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost); 

$workername2 = "";	 
$workeremail2 = "";
$notification = ""; 

//Notificaciones a aprobados.
$query = "select * from routes where ((type = '2') or (type = '3') or (type = '4')) group by worker";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$queryworker = "select * from workers where code = '$row[worker]'";
	$resultworker = mysqli_query($con, $queryworker);
	$rowworker = mysqli_fetch_array($resultworker);
	$workername = $rowworker['first']." ".$rowworker['last'];	
	$workeremail = $rowworker['email'];  
	
	$queryu = "select * from routes where worker = '$row[worker]' and (type = '2' or type = '3' or type = '4')";
	$resultu = mysqli_query($con, $queryu);
	$numu = mysqli_num_rows($resultu); 
	
	if($numu > 0 ){
		$firstu = 1; 
		while($rowu=mysqli_fetch_array($resultu)){
										$rowutype = intval($rowu['type']);
										 $rowutype = $rowutype-1;
										
										if($firstu == 1){ //First
											$sqlu = " and (((payments.status = '$rowutype') and (payments.route = '$rowu[unit]') and (payments.headship = '$rowu[headship]'))";
											if($numu == 1){
												$sqlu .= ")";
											}
											$firstu++;
										}elseif($firstu == $numu){ //Last
											$sqlu .= " or ((payments.status = '$rowutype') and (payments.route = '$rowu[unit]') and (payments.headship = '$rowu[headship]')))";
											$firstu++;
										}else{ //Middle
											$sqlu .= " or ((payments.status = '$rowutype') and (payments.route = '$rowu[unit]') and (payments.headship = '$rowu[headship]'))";
											$firstu++;
										}
									} 
		$querybefore1 = "select payments.* from payments inner join workers on payments.userid = workers.code inner join times on payments.id = times.payment where payments.approved = '0'".$sqlu." group by payments.id order by payments.expiration desc"; 
		
		$resultbefore1 = mysqli_query($con, $querybefore1); 
		$numbefore1 = mysqli_num_rows($resultbefore1);
		$ids= "";
		$numbefore2 = 0;
		if($numbefore1 > 0){
			while($rowbefore1=mysqli_fetch_array($resultbefore1)){
				
				if($rowbefore1['route'] > 0){
					$ids.= $rowbefore1[0].', ';
					$numbefore2++;
				}
							
			}
		if($numbefore2 > 0){
					
			fnPending($workername,$workeremail,$numbefore1,$con);
			
		}
				
	
		} 
	}

}


//Notificaciones a Vistos buenos.
$queryvobo = "select * from routes where type = '20' group by worker"; 
$resultvobo = mysqli_query($con, $queryvobo);
$numvobo = mysqli_num_rows($resultvobo);
while($rowvobo=mysqli_fetch_array($resultvobo)){
	
	$queryworkervobo = "select * from workers where code = '$rowvobo[worker]'";
	$resultworkervobo = mysqli_query($con, $queryworkervobo);
	$rowworkervobo = mysqli_fetch_array($resultworkervobo);
	$workernamevobo = $rowworkervobo['first']." ".$rowworkervobo['last'];	
	$workeremailvobo = $rowworkervobo['email'];  
	
	$queryuvobo = "select * from routes where worker = '$rowvobo[worker]' and type = '20'";
	$resultuvobo = mysqli_query($con, $queryuvobo);
	$numuvobo = mysqli_num_rows($resultuvobo); 
	
	if($numuvobo > 0 ){
		$firstuvobo = 1; 
		while($rowuvobo=mysqli_fetch_array($resultuvobo)){
										$rowutypevobo = intval($rowuvobo['type']);
										 $rowutypevobo = $rowutypevobo-1;
										
										if($firstuvobo == 1){ //First
											$sqluvobo = " and (((payments.route = '$rowuvobo[unit]') and (payments.headship = '$rowuvobo[headship]'))";
											if($numuvobo == 1){
												$sqluvobo .= ")";
											}
											$firstuvobo++;
										}elseif($firstuvobo == $numuvobo){ //Last
											$sqluvobo .= " or ((payments.route = '$rowuvobo[unit]') and (payments.headship = '$rowuvobo[headship]')))";
											$firstuvobo++;
										}else{ //Middle
											$sqluvobo .= " or ((payments.route = '$rowuvobo[unit]') and (payments.headship = '$rowuvobo[headship]'))";
											$firstuvobo++;
										}
									} 
		
		$querybefore1vobo = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.child='0' and payments.status = '1' and payments.approved = '0' and payments.arequest = '0'".$sqluvobo." order by payments.expiration desc"; 
		
		$resultbefore1vobo = mysqli_query($con, $querybefore1vobo); 
		$numbefore1vobo = mysqli_num_rows($resultbefore1vobo);
		$idsvobo= "";
		$numbefore2vobo = 0;
		if($numbefore1vobo > 0){
			while($rowbefore1vobo=mysqli_fetch_array($resultbefore1vobo)){
				
				if($rowbefore1vobo['route'] > 0){
					$idsvobo.= $rowbefore1vobo[0].', ';
					$numbefore2vobo++;
				}
							
			}
		if($numbefore2vobo > 0){
					
			fnPendingvobo($workernamevobo,$workeremailvobo,$numbefore1vobo,$con); 
			
		}
				
	
		} 
	}

}

//Notificaciones a Contadores (Provisión)
$queryprovision = "select * from routes where type = '5' group by worker"; 
$resultprovision = mysqli_query($con, $queryprovision);
$numprovision = mysqli_num_rows($resultprovision);
while($rowprovision=mysqli_fetch_array($resultprovision)){
	
	$queryworkerprovision = "select * from workers where code = '$rowprovision[worker]'";
	$resultworkerprovision = mysqli_query($con, $queryworkerprovision);
	$rowworkerprovision = mysqli_fetch_array($resultworkerprovision);
	$workernameprovision = $rowworkerprovision['first']." ".$rowworkerprovision['last'];	
	$workeremailprovision = $rowworkerprovision['email'];  
	
	$queryuprovision = "select * from routes where worker = '$rowprovision[worker]' and type = '5'";
	$resultuprovision = mysqli_query($con, $queryuprovision);
	$numuprovision = mysqli_num_rows($resultuprovision); 
	
	if($numuprovision > 0 ){
		$firstuprovision = 1; 
		while($rowuprovision=mysqli_fetch_array($resultuprovision)){
			$rowutypeprovision = intval($rowuprovision['type']);
			$rowutypeprovision = $rowutypeprovision-1;
										
			if($firstuprovision == 1){ //First
				$sqluprovision = " and (((payments.route = '$rowuprovision[unit]') and (payments.headship = '$rowuprovision[headship]'))";
				if($numuprovision == 1){
					$sqluprovision .= ")";
				}
				$firstuprovision++;
				}elseif($firstuprovision == $numuprovision){ //Last
						$sqluprovision .= " or ((payments.route = '$rowuprovision[unit]') and (payments.headship = '$rowuprovision[headship]')))";
							$firstuprovision++;
										}else{ //Middle
											$sqluprovision .= " or ((payments.route = '$rowuprovision[unit]') and (payments.headship = '$rowuprovision[headship]'))";
											$firstuprovision++;
										}
									} 
		
		$querybefore1provision = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.status = '1' and payments.approved = '0' and payments.arequest = '0'".$sqluprovision." order by payments.expiration desc"; 
		
		$resultbefore1provision = mysqli_query($con, $querybefore1provision); 
		$numbefore1provision = mysqli_num_rows($resultbefore1provision);
		$idsprovision= "";
		$numbefore2provision = 0;
		if($numbefore1provision > 0){
			while($rowbefore1provision=mysqli_fetch_array($resultbefore1provision)){
				
				if($rowbefore1provision['route'] > 0){
					$idsprovision.= $rowbefore1provision[0].', ';
					$numbefore2provision++;
				}
							
			}
		if($numbefore2provision > 0){
					
			fnPendingprovision($workernameprovision,$workeremailprovision,$numbefore1provision,$con); 
			
		}
				
	
		} 
	}

}


//Notificacion de retenciones atascadas
$chain = "";

//IR
$queryrstuck = "select * from payments where status = '14' and irstage= '0' and ret1a > '0'";
$queryrstuck = "select * from payments where status = '14' and hall = '0' and ((ret1a > '0') or (ret2a > 0))";
$resultrstuck = mysqli_query($con, $queryrstuck);
$numrstuck = mysqli_num_rows($resultrstuck);
if($numrstuck > 0){
	$chain.= "<p>FS: $numrstuck | Ver en: Retenciones > Atascadas (FS)</p>";
}

//IMI
$queryrstuck2 = "select * from payments where status = '14' and mayorstage= '0' and ret1a > '0'";
$resultrstuck2 = mysqli_query($con, $queryrstuck2);
$numrstuck2 = mysqli_num_rows($resultrstuck2);
if($numrstuck > 0){
	$chain.= "<p>IMI: $numrstuck2 | Ver en: Retenciones > Atascadas IMI</p>";
}

if(($numrstuck > 0) or ($numrstuck2 > 0)){

//mail all retention routes
$querytworker2 = "select * from routes where type = '13'";
$resulttworker2 = mysqli_query($con, $querytworker2);
while($rowtworker2=mysqli_fetch_array($resulttworker2)){
	
	$queryworker2 = "select * from workers where code = '$rowtworker2[worker]'";
	$resultworker2 = mysqli_query($con, $queryworker2);
	$rowworker2 = mysqli_fetch_array($resultworker2);
	$workername2 = $rowworker2['first']." ".$rowworker2['last'];	 
	$workeremail2 = $rowworker2['email'];  

$message = '<!doctype html>  
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
				<p>Estimad@ '.$workername2.'<a href="mailto:'.$workeremail2.'"></a>,</p>
        		<p>Se le informa que se encuentran atascada(s) retencion(es) en GetPay. </p>
				'.$chain.'
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
		//require '../assets/PHPMailer/PHPMailerAutoload.php';
		
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

		$mail->addAddress($workeremail2, $workername2);         // Add a recipient 
	
		$asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Retenciones atascadas.') . "?=");
		$mail->Subject = $asunto;
		$mail->MsgHTML($message);

		if(!$mail->send()) {
    	  	echo 'Message could not be sent.'; 
    		echo 'Mailer Error: ' . $mail->ErrorInfo; 
		} 
		else {
    		echo 'Message has been sent';
		} 
		
}

}

*/

?>