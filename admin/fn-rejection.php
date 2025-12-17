<?php

function fnReject( $paymentid, $by ) {
	
  include('sessions.php');
  include_once('../assets/PHPMailer/PHPMailerAutoload.php');

  $queryHost = "select * from mailer where active = '1'";
  $resultHost = mysqli_query($con, $queryHost);
  $rowHost = mysqli_fetch_array($resultHost); 

  //Get payment information
  $querypayment = "select userid from payments where id = '$paymentid'";
  $resultpayment = mysqli_query($con, $querypayment );
  $rowpayment = mysqli_fetch_array( $resultpayment );

  //Get Request information
  $queryrequest = "select first, last, email from workers where code = '$rowpayment[userid]'";
  $resultrequest = mysqli_query($con, $queryrequest );
  $rowrequest = mysqli_fetch_array( $resultrequest );

  $requestname = $rowrequest[ 'first' ] . " " . $rowrequest[ 'last' ];
  $requestemail = $rowrequest[ 'email' ];

  //Get provision information
  $querytprovision = "select * from times where payment = '$paymentid' and stage = '8.00'";
  $resulttprovision = mysqli_query($con, $querytprovision );
  $rowtprovision = mysqli_fetch_array( $resulttprovision );

  $queryprovision = "select first, last, email from workers where code = '$rowtprovision[userid]'";
  $resultprovision = mysqli_query($con, $queryprovision );
  $rowprovision = mysqli_fetch_array( $resultprovision );

  $provisionname = $rowprovision[ 'first' ] . " " . $rowprovision[ 'last' ];
  $provisionemail = $rowprovision[ 'email' ];

  //Get reject information
  $queryreject = "select first, last from workers where code = '$by'";
  $resultreject = mysqli_query($con, $queryreject );
  $rowreject = mysqli_fetch_array( $resultreject );

  $rejectname = $rowreject[ 'first' ] . " " . $rowreject[ 'last' ];


  $void_comments = "";

  $querytimec = "select * from times where payment = '$paymentid' order by id desc limit 1";
  $resulttimec = mysqli_query($con, $querytimec );
  $rowtimec = mysqli_fetch_array( $resulttimec );

  $queryvoidc = "select * from reason where id = '$rowtimec[reason2]'";
  $resultvoidc = mysqli_query($con, $queryvoidc );
  $rowvoidc = mysqli_fetch_array( $resultvoidc );

  if ( $rowvoidc[ 'name' ] != "" ) {
    $void_comments .= "<br><strong>Motivo:</strong> " . $rowvoidc[ 'name' ];
  } else {
    $void_comments .= "<br><strong>Motivo:</strong> Otro";
  }

  if ( $rowtimec[ 'reason' ] != "" ) {
    $void_comments .= '<br><strong>Comentario:</strong> ' . $rowtimec[ 'reason' ];
  }

  $message = '<!doctype html>
				<html><head><meta charset="UTF-8"><title>GET PAY</title></head>
				<style>body{ border:0px; background: #f6f6f6; }</style>
				<body bgcolor="#f6f6f6">
				<br>
				<br>
				<br>
				<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  				<tbody>
    			<tr bgcolor="#18bff1">
      			<td><img src="https://getpaycp.com/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    			</tr>
				<tr>
      			<td style="padding:15px;">
				<p>Estimado ' . $requestname . '<a href="mailto:' . $requestemail . '"></a>,</p>
        		<p>Se le informa que  la solicitud de pago con ID ' . $paymentid . ' fue rechazada por ' . $rejectname . '.
 				' . $void_comments . '
				</p>
				<p>M&aacute;s informaci&oacute;n en <a href="http://getpaycp.com/">http://getpaycp.com</a></p>
        		<p>&nbsp;</p></td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="https://getpaycp.com/images/casa-pellas.png" height="20" style="padding:15px;"></td>
    			</tr>
  				</tbody>
				</table>
				</body><br><br><br>
				</html>';

  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->Mailer = "smtp";
  $mail->SMTPDebug = 0;
  $mail->SMTPAuth = TRUE;
  if($rowHost['mailTLS'] == 1){
		$mail->SMTPSecure = "tls";
	}elseif($rowHost['mailTLS'] == 2){
		$mail->SMTPSecure = "ssl";
	}
  $mail->Port = $rowHost[ 'mailPort' ];
  $mail->Host = $rowHost[ 'mailHost' ]; // Specify main and backup SMTP servers 
  $mail->Username = $rowHost[ 'mailUsername' ]; // SMTP username
  $mail->Password = $rowHost[ 'mailPassword' ]; // SMTP password
  $mail->IsHTML( true );
  $mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFromName']);
$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);

  $mail->addAddress( $requestemail, $requestname ); // Add a recipient
  if ( $provisionemail != "" ) {
    $mail->addAddress( $provisionemail, $provisionname );
  }

  $mail->isHTML( true ); // Set email format to HTML
  $asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Solicitud de pago rechazada.') . "?=");	
  $mail->Subject = $asuto;
  $mail->MsgHTML( $message );
  //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  if ( !$mail->send() ) {
    #echo 'Message could not be sent.';
    #echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
    #echo 'Message has been sent';
  }

}

?>