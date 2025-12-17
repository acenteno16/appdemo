<?php

#ini_set( 'display_errors', 1 );
#ini_set( 'display_startup_errors', 1 );
#error_reporting( E_ALL );

require '/var/www/html/connection.php';
require '/var/www/html/admin/fn-pending.php';
require '/var/www/html/assets/PHPMailer/PHPMailerAutoload.php'; 

$queryHost = "select * from mailer where active = '1'"; 
$resultHost = mysqli_query($con, $queryHost );
$rowHost = mysqli_fetch_array( $resultHost );

//Notificaciones a Vistos buenos.
$queryvobo = "select * from routes where type = '20' group by worker";
$resultvobo = mysqli_query($con, $queryvobo );
$numvobo = mysqli_num_rows( $resultvobo );
while ( $rowvobo = mysqli_fetch_array( $resultvobo ) ) {

  $queryworkervobo = "select * from workers where code = '$rowvobo[worker]'";
  $resultworkervobo = mysqli_query($con, $queryworkervobo );
  $rowworkervobo = mysqli_fetch_array( $resultworkervobo );
  $workernamevobo = $rowworkervobo[ 'first' ] . " " . $rowworkervobo[ 'last' ];
  $workeremailvobo = $rowworkervobo[ 'email' ];

  $queryuvobo = "select * from routes where worker = '$rowvobo[worker]' and type = '20'";
  $resultuvobo = mysqli_query($con, $queryuvobo );
  $numuvobo = mysqli_num_rows( $resultuvobo );

  if ( $numuvobo > 0 ) {
    $firstuvobo = 1;
    while ( $rowuvobo = mysqli_fetch_array( $resultuvobo ) ) {
      $rowutypevobo = intval( $rowuvobo[ 'type' ] );
      $rowutypevobo = $rowutypevobo - 1;

      if ( $firstuvobo == 1 ) { //First
        $sqluvobo = " and (((payments.route = '$rowuvobo[unit]') and (payments.headship = '$rowuvobo[headship]'))";
        if ( $numuvobo == 1 ) {
          $sqluvobo .= ")";
        }
        $firstuvobo++;
      } elseif ( $firstuvobo == $numuvobo ) { //Last
        $sqluvobo .= " or ((payments.route = '$rowuvobo[unit]') and (payments.headship = '$rowuvobo[headship]')))";
        $firstuvobo++;
      } else { //Middle
        $sqluvobo .= " or ((payments.route = '$rowuvobo[unit]') and (payments.headship = '$rowuvobo[headship]'))";
        $firstuvobo++;
      }
    }

    $querybefore1vobo = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.child='0' and payments.status = '1' and payments.approved = '0' and payments.arequest = '0'" . $sqluvobo . " order by payments.expiration desc";

    $resultbefore1vobo = mysqli_query($con, $querybefore1vobo );
    $numbefore1vobo = mysqli_num_rows( $resultbefore1vobo );
    $idsvobo = "";
    $numbefore2vobo = 0;
    if ( $numbefore1vobo > 0 ) {
      while ( $rowbefore1vobo = mysqli_fetch_array( $resultbefore1vobo ) ) {

        if ( $rowbefore1vobo[ 'route' ] > 0 ) {
          $idsvobo .= $rowbefore1vobo[ 0 ] . ', ';
          $numbefore2vobo++;
        }

      }
      if ( $numbefore2vobo > 0 ) { 

        fnPendingvobo( $workernamevobo, $workeremailvobo, $numbefore1vobo, $con);

      }


    }
  }

}

$todayday = date( 'd' );
$date = date( 'Y-m-d', strtotime( '+1 month', strtotime( date( 'Y-m-1' ) ) ) );

switch ( date( 'm' ) ) {
  case 1:
    $nmonth = "Febrero";
    break;
  case 2:
    $nmonth = "Marzo";
    break;
  case 3:
    $nmonth = "Abril";
    break;
  case 4:
    $nmonth = "Mayo";
    break;
  case 5:
    $nmonth = "Junio";
    break;
  case 6:
    $nmonth = "Julio";
    break;
  case 7:
    $nmonth = "Agosto";
    break;
  case 8:
    $nmonth = "Septiembre";
    break;
  case 9:
    $nmonth = "Octubre";
    break;
  case 10:
    $nmonth = "Noviembre";
    break;
  case 11:
    $nmonth = "Diciembre";
    break;
  case 12:
    $nmonth = "Enero";
    break;
}

if ( $todayday > 25 ) {

  $querytc = "select * from tc where today > '$date'";
  $resulttc = mysqli_query($con, $querytc );
  $numtc = mysqli_num_rows( $resulttc );

  if ( $numtc == 0 ) {
    //Notification

    //Get Users
    $querytce = "select * from routes where type = '33'";
    $resulttce = mysqli_query($con, $querytce );
    while ( $rowtce = mysqli_fetch_array( $resulttce ) ) {

      //User Information    
      $querynot = "select * from workers where code = '$rowtce[worker]'";
      $resultnot = mysqli_query($con, $querynot );
      $rownot = mysqli_fetch_array( $resultnot );

      $notname = $rownot[ 'first' ] . " " . $rownot[ 'last' ];
      $notemail = $rownot[ 'email' ];

      $message = "";
      $message .= '<!doctype html>
				    <html><head><meta charset="UTF-8"><title>GET PAY</title></head>
				    <style>body{ border:0px; background: #f6f6f6; }</style>
				    <body bgcolor="#f6f6f6">
				    <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin:0px auto;"> 
  				    <tbody>
    			    <tr bgcolor="#24355c"><td><img src="http://multitechserver.com/getpay/images/gcp-white.png" height="20"  style="padding:15px;"></td></tr>
				    <tr>
      			    <td style="padding:15px;">
				    <p>Estimad@ <a href="mailto:' . $notemail . '">' . $notname . '</a></p>
        		    <p>Se le informa que los tipos de cambio del mes de ' . $nmonth . ' enstán pendientes de cargarse en getPay.</p>
                    <p>Recuerde que esta información es requerida para el buen funcionamiento del sistema.</p>
                    <p>Saludos.<br>
                    Centro de notificaciones GetPay.</p>
                    </td>
   	 			    </tr>
    			    <tr bgcolor="#18bff1">
      		 		<td><img src="http://multitechserver.com/getpay/images/getpay-white-h.png" height="30" style="padding:15px;"></td>
    		 		</tr>
  				    </tbody>
				    </table>
				    </body>
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
		
      $mail->addAddress( $notemail, $notname ); 
     
	  $asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Alerta GetPay - Ingresar tipos de cambio de '.$nmonth) . "?=");
      $mail->Subject = $asunto;
      $mail->MsgHTML($message);
      
      if ( !$mail->send() ) {
        #echo 'Message could not be sent.';
        #echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
        #echo '<br>Message has been sent';
      }
    }

  }

}

?>