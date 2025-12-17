<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../connection.php';
require 'fn-pending.php';
require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$queryHost = "select * from mailer where active = '1'";
$resultHost = mysqli_query($con, $queryHost);
$rowHost = mysqli_fetch_array($resultHost); 

#List halls
$query = "select * from hallsbook group by hall";  
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
    
    $queryHall = "select * from halls where id = '$row[hall]'";
    $resultHall = mysqli_query($con, $queryHall);
    $rowHall = mysqli_fetch_array($resultHall);
    
    $query2 = "select * from hallsbook where hall = '$row[hall]' order by id desc limit 1";
    $result2 = mysqli_query($con, $query2);
    $row2= mysqli_fetch_array($result2);
    
    #numero de retenciones disponibles
    $query3 = "select * from hallsretention where book = '$row2[id]' and payment = '0'";
    $result3 = mysqli_query($con, $query3);
    $num3 = mysqli_num_rows($result3);
    if($num3 <= 100){ 
        $row3 = mysqli_fetch_array($result3);
        #echo '<br>-'.$rowHall['name'].': '." ($row[start] - $row[end]) -".$num3;
        
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
		$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);                            // TCP port to connect 
        
        $queryNotifications = "select * from hallsbooknotifications where company = '$rowHall[company]'";
        $resultNotifications = mysqli_query($con, $queryNotifications);
        while($rowNotifications=mysqli_fetch_array($resultNotifications)){
            
            $queryUser = "select * from workers where code = '$rowNotifications[userid]'";
            $resultUser = mysqli_query($con, $queryUser);
            $rowUser = mysqli_fetch_array($resultUser); 
            $user_email = $rowUser['email'];
            $user_name = $rowUser['first']." ".$rowUser['last'];
            $mail->addAddress($user_email, $user_name); 
        }
        
        $message= '<!doctype html>  
		  <html><head><meta charset="UTF-8"><title>GET PAY</title></head>
	      <style>body{ border:0px; background: #f6f6f6; }</style>
		  <body bgcolor="#f6f6f6">
		  <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  		  <tbody>
    	  <tr bgcolor="#24355c"><td><img src="http://getpaycp.com/images/gcp-white.png" height="20"  style="padding:15px;"></td></tr>
		  <tr>
      	  <td style="padding:15px;">
		  <p>Estimados usuarios,</p>
          <p>Se les informa que el talonario '.$row['serial'].'-'.$row['start'].'-'.$row['end'].' cuenta con '.$num3.' retenciones disponibles.		  </p>
          <p>Ingresar a <a href="http://getpaycp.com/">http://getpaycp.com</a></p>
      	  </td>
   	 	  </tr>
    	  <tr bgcolor="#18bff1">
      	  <td><img src="getpaycp.com/images/getpay-white-h.png" height="30" style="padding:15px;""></td>
    	  </tr>
          <tr>
          <td>    
          </td>
          </tr>
  		  </tbody>
		  </table>
		  </body>
		  </html>';
                                 
		  $asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Talonarios de retenciones') . "?=");
		  $mail->Subject = $asunto; 
		  $mail->MsgHTML($body); 

		  if(!$mail->send()) {
    	  	echo 'Message could not be sent.'; 
    		echo 'Mailer Error: ' . $mail->ErrorInfo; 
		  } 
		  else {
    		echo 'Message has been sent'; 
		  } 
        
        
        
        
    }

}

?>