<?php 
 
require('admin/headers.php');

session_start();
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    header("Location: /?error=token_expirado");
	exit;
}

include("connection.php"); 
include('loginFunctions.php');

$today = date('Y-m-d');
$totime = date('H:i:s');

function sanitizeInput($val, $con){
    if (is_array($val)) {
        $sanitizedArray = [];
        foreach ($val as $key => $value) {
            $sanitizedArray[$key] = is_string($value) 
                ? mysqli_real_escape_string($con, trim($value)) 
                : $value;
        }
        return $sanitizedArray;
    } else {
        return is_string($val) 
            ? mysqli_real_escape_string($con, trim($val)) 
            : $val;
    }
}

$email = isset($_POST['username']) ? sanitizeInput($_POST['username'], $con) : '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	header("Location: /?error=correo_invalido $email");
	exit;	
}

$query = "select * from workers where email = ?"; 
$stmt = $con->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$num = $result->num_rows;
$stmt->close();

$ip = getClientIP();
$info = getDeviceAndBrowser();
$device = $info['device'];
$browser = $info['browser'];
$language = getPreferredLanguage();

$queryLogin = "INSERT INTO forget (today, totime, email, device, browser, ip, response, language) 
               VALUES (?, ?, ?, ?, ?, ?, 0, ?)";
$stmtLogin = $con->prepare($queryLogin);
$stmtLogin->bind_param("sssssss", $today, $totime, $email, $device, $browser, $ip, $language);
$stmtLogin->execute();
$idLogin = $con->insert_id;

if($num > 0){
	
	if ($row['attempts2'] >= 5) {
		header("Location: /?error=limite_excedido");
		exit;
    }
	
		$queryHost = "SELECT * FROM mailer WHERE active = ?";
		$stmtHost = $con->prepare($queryHost);
		$activeVal = 1;
		$stmtHost->bind_param("i", $activeVal);
		$stmtHost->execute();
		$resultHost = $stmtHost->get_result();
		$rowHost = $resultHost->fetch_array();
	
		#$cadena = $row['code'].$row['id'].rand(1,9999999).date('Y-m-d');
		#$token = sha1($cadena);
		$token = bin2hex(random_bytes(32)); // 64 caracteres aleatorios y seguros

	
		if (isset($token, $email)) {
			$queryUpdate = "UPDATE workers SET token = ? WHERE email = ?";
    		$stmtUpdate = $con->prepare($queryUpdate);
			$stmtUpdate->bind_param("ss", $token, $email); 
			$stmtUpdate->execute();
    		$stmtUpdate->close();
		}
	
		$queryLogin2 = "UPDATE forget SET response = ?, token = ? WHERE id = ?";
		$stmtLogin2 = $con->prepare($queryLogin2);
		$responseVal = 1;
		$stmtLogin2->bind_param("isi", $responseVal, $token, $idLogin);
		$stmtLogin2->execute();
	
		$message = '<!doctype html>
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
				<p>Para reestablecer su contrase&ntilde;a usted deber&aacute; de dar click en la direcci&oacute;n que aparece a continuaci&oacute;n o bien copiar el siguiente link y pegarlo en su navegador de preferencia.</p>
	            <p><a href="https://getpay.casapellas.com.ni/password-reset.php?token='.$token.'">https://getpay.casapellas.com.ni/password-reset.php?token='.$token.'</a></p>
      			</td>
   	 			</tr>
    			<tr bgcolor="#24355c">
      			<td><img src="https://getpay.casapellas.com.ni/images/casa-pellas.png" height="20" style="padding:15px;"></td>
    			</tr>
  				</tbody>
				</table>
				</body>
				</html>';

	require('/var/www/html/assets/PHPMailer/PHPMailerAutoload.php');    

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
	$mail->Host = $rowHost['mailHost']; 
	$mail->Username = $rowHost['mailUsername']; 
	$mail->Password = $rowHost['mailPassword'];
	$mail->IsHTML(true);
	$mail->SetFrom($rowHost['mailFrom'], $rowHost['mailFromName']);
	$mail->AddReplyTo($rowHost['mailFrom'], $rowHost['mailFromName']);	
	
	$username = $row[1]." ".$row[2];	
	$mail->addAddress($row['email'], $username);     // Add a recipient
	$asunto = utf8_encode("=?UTF-8?B?" . base64_encode('Recuperación de contraseña.') . "?=");    
	$mail->Subject = $asunto;  
	$mail->MsgHTML($message);
	 
	if(!$mail->send()) {
		header("Location: /?error=mailer_error");
		exit();
    	#echo 'Mailer Error: '. $mail->ErrorInfo;   
	} else {
		header("Location: /?error=exito");
		exit();
	}

}
else{
	header("Location: /?error=sin_coinsidencia");
	exit();
}

?> 