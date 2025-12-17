<?

require '../connection.php';
require '../assets/PHPMailer/PHPMailerAutoload.php';  

$queryHost = "select * from mailer";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost);

#GLOBAL STUCKS
$querystuck = "select * from payments where status = '14' and mayorstage = '0' and ret1a > '0'";
$resultstuck = mysqli_query($con, $querystuck);
$numstuck = mysqli_num_rows($resultstuck);

if($numstuck > 0){
    
    $querythisroute = "select * from routes where type = '23'";
    $resultthisroute = mysqli_query($con, $querythisroute);
    $numthisroute = mysqli_num_rows($resultthisroute);
    if($numthisroute > 0){
        while($rowthisroute=mysqli_fetch_array($resultthisroute)){
    
            #Atascadas 
            if((in_array('16', $route_access))){
                #si la sucursal es global
                if(($rowthisroute['company'] == 999999999) and ($rowthisroute['unit'] == 999999999)){
                    $usersGlobal1[] = $rowthisroute['worker'];
                }  
            
            }
        }
        
        if(sizeof($userGlobal1 > 0)){ 
            
            #email
            for($i=0;$i<sizeof($userStuck);$i++){
                $querynotuser = "select * from workers where code = '$userStuck[$i]'";
	           $resultnotuser = mysqli_query($con, $querynotuser); 
	           $rownotuser = mysqli_fetch_array($resultnotuser);
	
	           $stuckStr.="-".$rownotuser['email']."<br>";
            }
            
            $stuckStr="<table class='small' width='550'>
            <tr>
            <td><strong>IDS</strong></td><td><strong>Proveedor</strong></td><td><strong>Monto</strong></td><td><strong>Ruta</strong></td> 
            </tr>";
            while($rowstuck=mysqli_fetch_array($resultstuck)){
                $ret1a = number_format($rowstuck['ret1a'],2);
                
                if($rowstuck['btype'] == 1){
				    $rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$rowstuck[provider]'"));
				    $theprovider = $rowprovider['code']." | ".$rowprovider['name'];
                }else{
				    $rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$rowstuck[collaborator]'"));
				    $theprovider = $rowcollaborator['code']." | ".$rowcollaborator['first']." ".$rowcollaborator['last'];
				}

                $stuckStr.="<tr><td>$rowstuck[id]</td><td>$theprovider</td><td>C$$ret1a</td><td>$rowstuck[route]</td><tr>";
            }
            $stuckStr.="</table>"; 
    
            echo $message = '<!doctype html>  
				        <html><head><meta charset="UTF-8"><title>GET PAY</title>
                        <style>
                        table .small{
                            font-size: 12px;
                        }
                        </style>
                        </head>
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
        		<p>Se le informa que las siguientes solicitudes de pago presentan retenciones atascadas.</p>
				<p>'.$stuckStr.'</p>
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
        //require '../assets/PHPMailer/PHPMailerAutoload.php'; 

		/*$mail = new PHPMailer;
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = $rowHost['mailHost'];  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $rowHost['mailUsername'];                 // SMTP username
		$mail->Password = $rowHost['mailPassword'];                           // SMTP password
		//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted 
		$mail->Port = $rowHost['mailPort'];                                     // TCP port to connect 

		$mail->setFrom('getpay@casapellas.com.ni', 'GetPay');
		//$mail->addAddress($workeremail3, $workername3);     // Add a recipient 
		$mail->addAddress('jairovargasg@gmail.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('enavarro@casapellas.com');
		//$mail->addBCC('ablandon@casapellas.com');    

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Retenciones atascadas.';
		$mail->Body    = $message; 
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
    	  	echo 'Message could not be sent.'; 
    		echo 'Mailer Error: ' . $mail->ErrorInfo; 
		} else {
    		echo 'Message has been sent';
		}
	    */

            
        }
    }
    
    
    
} 

?>