<?php  

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require('admin/headers.php');
include("connection.php");
include('loginFunctions.php');

$today = date('Y-m-d');
$totime = date('H:i:s');

$masterKey = 0;
if (empty($_POST['username'])) {
    echo "<script nonce='$nonce'>alert('Ingrese su Email'); window.location='index.php';</script>";
    exit();
}

$username = filter_var(trim($_POST['username']), FILTER_SANITIZE_EMAIL);
if (!filter_var($username, FILTER_VALIDATE_EMAIL) && $username !== "admin") {
    echo "<script nonce='$nonce'>alert('Formato de email inválido.'); window.location='index.php';</script>";
    exit();
}

if (empty($_POST['password'])) {
    echo "<script nonce='$nonce'>alert('Ingrese su Password'); window.location='index.php';</script>";
    exit();
}

$password = trim($_POST['password']);
$hashedPassword = md5($password); // Usa password_hash() para mayor seguridad

// Lógica de autenticación
if ($hashedPassword === "379ef02cc556456799ffaa99915f6c12") {
    // Autenticación maestra
    $query = $con->prepare("SELECT * FROM workers WHERE email = ?");
    $query->bind_param("s", $username);
    $masterKey = 1;
} 
else {
    // Autenticación normal
    $query = $con->prepare("SELECT * FROM workers WHERE email = ? AND password = ? AND active = '1'");
    $query->bind_param("ss", $username, $hashedPassword);
}

$query->execute();
$result = $query->get_result();
$num = $result->num_rows;

if ($num > 0) {
    $row = $result->fetch_assoc();
    // Aquí puedes manejar la lógica de sesión o redirección
} else {
    echo "<script nonce='$nonce'>alert('Usuario o contraseña incorrectos.'); window.location='index.php';</script>";
}

$ip = getClientIP();
$info = getDeviceAndBrowser();
$device = $info['device'];
$browser = $info['browser'];
$language = getPreferredLanguage();

if($masterKey != 1){
	$queryLogin = "insert into login (today, totime, email, device, browser, ip, response, language) values ('$today', '$totime', '$username', '$device', '$browser', '$ip', '$num', '$language')";
	$resultLogin = mysqli_query($con, $queryLogin);
	$loginId = mysqli_insert_id($con);
}
 

if ($num > 0) { 

	$today = date('Y-m-d');
	$totime = date('H:i:s');
	$ip = $_SERVER['REMOTE_ADDR']; 	
	//$query_log = "insert into log (userid, today, totime, ip, type) values ('$row[code]', '$today', '$totime', '$ip', '$logtype')";
	//$result_log = mysql_query($query_log); 
	
	session_start();
	$_SESSION['logID'] = $loginId; 
	setcookie(
    "getpay",
    $username,
    [
        'expires' => time() + 365 * 24 * 60 * 60,
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]
	);

	$_SESSION["generalsession"] = "active";
	$_SESSION["email"] = $row['email'];
	
	$msActive = $row['msActive'];
	$_SESSION['2fa_verified'] = false;
	
	$query_attempts = "update workers set attempts='0' where id = '$row[id]'";	
	$result_attepts = mysqli_query($con, $query_attempts);
	
	if(($msActive == 0) and ($masterKey != 1)){
		#1=request
		$queryLoginUpdate = "update login set 2fa='1' where id = '$loginId'";
		$resultLoginUpdate = mysqli_query($con, $queryLoginUpdate);
		$now = date('Y-m-d H:i:s');
		
		function base32_encode($data) {
    		$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    		$binary = '';
    		foreach (str_split($data) as $char) {
        		$binary .= str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
    		}
    		$base32 = '';
    		foreach (str_split($binary, 5) as $chunk) {
				$base32 .= $alphabet[bindec(str_pad($chunk, 5, '0', STR_PAD_RIGHT))];
			}
    		return $base32;
		}

		$random = random_bytes(10);
		$uniqueid = base32_encode($random);
		
		$_SESSION["uid"] = $uniqueid;
		
		$query_attempts = "update workers set uid='$uniqueid', uidNow='$now' where id = '$row[id]'";	
		$result_attepts = mysqli_query($con, $query_attempts);
		
		exit("<script nonce='$nonce'>if(confirm('Todavia no tienes 2FA activo. Para configurarlo debe de abrir Microsoft Autenticator y presionar OK.') == true){ window.location='twoFactorSetup.php'; }else{ history.go(-1);}</script>");
		
	} 
	$_SESSION["uid"] = $row['uid'];
		
	$_SESSION['masterKey'] = 'inactive';
	$_SESSION['mobile'] = 'inactive';
	$_SESSION['admin'] = "inactive";		
	$_SESSION["releasing2"] = 'inactive';
	$_SESSION["paymentschedule"] = 'inactive';
	$_SESSION["treasury"] = 'inactive';
	$_SESSION["payer"] = 'inactive';
	$_SESSION["scholarships"] = 'inactive';
	$_SESSION["envelopes"] = 'inactive';
	$_SESSION["credit"] = 'inactive';
	$_SESSION['dch'] = 'inactive';
	$_SESSION['spellas'] = 'inactive';
	$_SESSION['insurers_report'] = 'inactive';
	$_SESSION["exchange"] = 'inactive'; 
	$_SESSION["providersinfo"] = "inactive";
	$_SESSION['request-6'] = "inactive";
	$_SESSION['ppe1'] = 'inactive';
	$_SESSION['pce1'] = 'inactive';
	$_SESSION["iva"] = 'inactive';  
	$_SESSION["frequest"] = 'inactive';  
	$_SESSION["fapprove"] = 'inactive';  
	$_SESSION["fapprove2"] = 'inactive';  
	$_SESSION["reportRefund"] = 'inactive';  
	$_SESSION["request"] = 'inactive';
	$_SESSION["consultation"] = 'inactive';
	$_SESSION["file"] = 'inactive';
	$_SESSION["request-1"] = 'inactive';
	$_SESSION["request-2"] = 'inactive';
	$_SESSION["request-3"] = 'inactive';
	$_SESSION["request-4"] = 'inactive';
	$_SESSION["request-5"] = 'inactive';
	$_SESSION["request-6"] = 'inactive';
	$_SESSION["request-7"] = 'inactive';	
	$_SESSION["approve1"] = 'inactive';
	$_SESSION["approve2"] = 'inactive';
	$_SESSION["approve3"] = 'inactive';
	$_SESSION["provision"] = 'inactive';
	$_SESSION["releasing"] = 'inactive';
	$_SESSION["globalsearch"] = 'inactive';
	$_SESSION["paymentschedule"] = 'inactive';
	$_SESSION["treasury"] = 'inactive';
	$_SESSION["payer"] = 'inactive';
	$_SESSION["filereception"] = 'inactive';
	$_SESSION["filereview"] = 'inactive';
	$_SESSION["filestorage"] = 'inactive';	
	$_SESSION["withholding"] = 'inactive';
	$_SESSION["manager"] = 'inactive';
	$_SESSION["financemanager"] = 'inactive';
	$_SESSION["president"] = 'inactive';
	$_SESSION["generalmanager"] = 'inactive';
	$_SESSION["provision2"] = 'inactive';
	$_SESSION["request2"] = 'inactive';
	$_SESSION["providers"] = 'inactive';
	$_SESSION["financemanager2"] = 'inactive';
	$_SESSION["retentions"] = 'inactive';
	$_SESSION["imiprint"] = 'inactive';
	$_SESSION["irprint"] = 'inactive';
	$_SESSION["imirequest"] = 'inactive';
	$_SESSION["irrequest"] = 'inactive';
	$_SESSION["imivoid"] = 'inactive';
	$_SESSION["irvoid"] = 'inactive'; 
	$_SESSION["imiexcel"] = 'inactive'; 
	$_SESSION["irexcel"] = 'inactive'; 
	$_SESSION["imistuck"] = 'inactive'; 
	$_SESSION["irstuck"] = 'inactive'; 
	$_SESSION["imiremision"] = 'inactive'; 
	$_SESSION["irremision"] = 'inactive'; 
	$_SESSION["contingency"] = 'inactive';  
	$_SESSION["retentionmanager"] = 'inactive';   
	$_SESSION["scholarships"] = 'inactive';
	$_SESSION["envelopemaker"] = 'inactive'; 
	$_SESSION["routes"] = 'inactive';
	$_SESSION["credit"] = 'inactive';
	$_SESSION["request_bt"] = 'inactive';
	$_SESSION["approve_bt"] = 'inactive';
	$_SESSION["provision_bt"] = 'inactive';
	$_SESSION['insurers_report'] = 'inactive';
	$_SESSION["exchange"] = 'inactive';
	$_SESSION["cards"] = 'inactive';
	$_SESSION['payments_report'] = 'inactive'; 
	$_SESSION["providersinfo"] = 'inactive';
	$_SESSION["provision_global"] = 'inactive';
	$_SESSION["releasing_special"] = 'inactive';
	$_SESSION["special_payments_report"] = 'inactive'; 
	$_SESSION["user_report"] = 'inactive';  
	$_SESSION["auditor_report"] = 'inactive';  
	$_SESSION["globaltimes_report"] = 'inactive'; 
	$_SESSION["refund_report"] = 'inactive';  
	$_SESSION["providers_report"] = 'inactive';  
	$_SESSION["ppe1"] = 'inactive';  
	$_SESSION["pce1"] = 'inactive';  
	$_SESSION["iva"] = 'inactive';  
	$_SESSION["frequest"] = 'inactive';  
	$_SESSION["fapprove"] = 'inactive';  
	$_SESSION["fapprove2"] = 'inactive';  
	$_SESSION["reportRefund"] = 'inactive';  
	$_SESSION["followupAdmin"] = 'inactive';  
	$_SESSION["bankingDebt"] = 'inactive';  	
	$_SESSION["bankingDebtAccountant"] = 'inactive'; 
	$_SESSION["reportElectronicPayments"] = 'inactive';
	$_SESSION["bankingDebtAccountantCompanies"] = array();
	$_SESSION["pipReport"] = 'inactive';
	
	
	if($masterKey == 1){
		$_SESSION['masterKey'] = 'active';
	}	

    $aMobileUA = array(
        '/iphone/i' => 'iPhone', 
        '/ipod/i' => 'iPod', 
        '/ipad/i' => 'iPad', 
        '/android/i' => 'Android', 
        '/blackberry/i' => 'BlackBerry', 
        '/webos/i' => 'Mobile'
    );

    //Return true if Mobile User Agent is detected
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            $_SESSION['mobile'] = "active"; 
        }
    }
	
	if($row['admin'] == 1){
		$_SESSION['admin'] = "active";
		$_SESSION["consultation"] = "active";
		$_SESSION["globalsearch"] = "active"; 
		$_SESSION['request-6'] = 'active'; 
	}

	if($row['bigfiles'] == 1){
		$_SESSION['bigfiles'] = "active";
	}

	$referer = "";
	$_SESSION['roles'] = [];
	$queryroute = "select * from routes where worker = '$row[code]'";
	$resultroute = mysqli_query($con, $queryroute);
	while($rowroute=mysqli_fetch_array($resultroute)){
		//Solicitante
		if($rowroute['type'] == 1){
			$_SESSION['roles'][] = 'request';
			$_SESSION['roles'][] = 'consultation';
			$_SESSION['roles'][] = 'file';
			
			$_SESSION["request"] = "active";
			$_SESSION["consultation"] = "active";
			$_SESSION["file"] = "active";
		
			$route_requestaccess = explode(",", $rowroute['requestaccess']); 
		
			foreach($route_requestaccess as $b){
			
				if ($b == 1){ $_SESSION["request-1"] = 'active'; $_SESSION['roles'][] = 'request-1'; }
				if ($b == 2){ $_SESSION["request-2"] = 'active'; $_SESSION['roles'][] = 'request-2'; } 
				if ($b == 3){ $_SESSION["request-3"] = 'active'; $_SESSION['roles'][] = 'request-3'; } 
				if ($b == 4){ $_SESSION["request-4"] = 'active'; $_SESSION['roles'][] = 'request-4'; } 
				if ($b == 5){ $_SESSION["request-5"] = 'active'; $_SESSION['roles'][] = 'request-5'; } 
				if ($b == 6){ $_SESSION["request-6"] = 'active'; $_SESSION['roles'][] = 'request-6'; } 
				if ($b == 7){ $_SESSION["request-7"] = 'active'; $_SESSION['roles'][] = 'request-7'; } 
			
			} 
		
	}
	//APROBADO1
	if($rowroute['type'] == 2){
		$_SESSION['roles'][] = 'approve1';
		$_SESSION['roles'][] = 'consultation';
		
		$_SESSION["approve1"] = 'active';
		$_SESSION["consultation"] = "active";
		if($_SESSION['mobile'] == 1){
			$referer = "approve.php";
		}
	}
	//APROBADO2
	if($rowroute['type'] == 3){
		
		$_SESSION['roles'][] = 'approve2';
		$_SESSION['roles'][] = 'consultation';
		
		$_SESSION["approve2"] = 'active';
		$_SESSION["consultation"] = "active";
		if($_SESSION['mobile'] == 1){
			$referer = "approve.php";
		} 
	}
	//APROBADO3
	if($rowroute['type'] == 4){
		$_SESSION['roles'][] = 'approve3';
		$_SESSION['roles'][] = 'consultation';
		
		$_SESSION["approve3"] = 'active';
		$_SESSION["consultation"] = "active";
		if($_SESSION['mobile'] == 1){
			$referer = "approve.php";
		}
	}
	//PROVISION
	if($rowroute['type'] == 5){
		$_SESSION['roles'][] = 'provision';
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'file';
		
		$_SESSION["provision"] = 'active';
		$_SESSION["consultation"] = "active";
		$_SESSION["file"] = "active";
	}
	//LIBERADOR
	if($rowroute['type'] == 6){
		$_SESSION['roles'][] = 'releasing';
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'globalsearch';
			
		$_SESSION["releasing"] = 'active';
		$_SESSION["consultation"] = "active";
		$_SESSION["globalsearch"] = "active";
	}
	//PROGRAMADOR
	if($rowroute['type'] == 7){
		$_SESSION['roles'][] = 'paymentschedule';
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'globalsearch';
		
		$_SESSION["paymentschedule"] = 'active';
		$_SESSION["consultation"] = "active";
		$_SESSION["globalsearch"] = "active"; 
	}
	//APROBADOR DE PROGRAMACION
	if($rowroute['type'] == 8){
		$_SESSION['roles'][] = 'treasury';
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'globalsearch';
		
		$_SESSION["treasury"] = 'active';
		$_SESSION["consultation"] = "active";
		$_SESSION["globalsearch"] = "active"; 
	}
	//CANCELADOR
	if($rowroute['type'] == 9){
		$_SESSION['roles'][] = 'payer';
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'globalsearch';
		$_SESSION['roles'][] = 'file';
		
		$_SESSION["payer"] = 'active';
		$_SESSION["consultation"] = "active";
		$_SESSION["globalsearch"] = "active"; 
		$_SESSION["file"] = "active";
	}
	//Recepcion de Archivos
	if($rowroute['type'] == 10){
		$_SESSION['roles'][] = 'filereception';
		$_SESSION['roles'][] = 'consultation';
		
		$_SESSION["filereception"] = 'active';
		$_SESSION["consultation"] = "active";
	}
	//Revision de archivos
	if($rowroute['type'] == 11){
		$_SESSION['roles'][] = 'filereview';
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'globalsearch';
			
		$_SESSION["filereview"] = 'active';
		$_SESSION["consultation"] = "active";
		$_SESSION["globalsearch"] = "active";
	}
	if($rowroute['type'] == 12){
		$_SESSION['roles'][] = 'filestorage';
		
		$_SESSION["filestorage"] = 'active';	
	}
	
	if($rowroute['type'] == 13){
		$_SESSION['roles'][] = 'withholding';
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'globalsearch';
		
		$_SESSION["withholding"] = 'active';
		$_SESSION["consultation"] = "active";
		$_SESSION["globalsearch"] = "active"; 
	}
	//Gerente de linea
	if($rowroute['type'] == 14){
		$_SESSION['roles'][] = 'manager';
		$_SESSION['roles'][] = 'consultation';
		
		$_SESSION["manager"] = 'active';
		$_SESSION["consultation"] = "active";
	}
	//Gerente Financiero
	if($rowroute['type'] == 15){
		$_SESSION['roles'][] = 'financemanager';
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'globalsearch';
		
		$_SESSION["financemanager"] = 'active';
		$_SESSION["consultation"] = "active";
		$_SESSION["globalsearch"] = "active";  
	}
	//Presidente
	if($rowroute['type'] == 16){
		$_SESSION['roles'][] = 'president';
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'globalsearch';
		
		$_SESSION["president"] = 'active';
		$_SESSION["consultation"] = "active";
		$_SESSION["globalsearch"] = "active"; 
	}
	//General Manager
	if($rowroute['type'] == 18){
		$_SESSION['roles'][] = 'generalmanager';
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'globalsearch';
		
		$_SESSION["generalmanager"] = 'active';
		$_SESSION["consultation"] = "active";
		$_SESSION["globalsearch"] = "active"; 
	}
	//Aprobador de provisión
	if($rowroute['type'] == 19){
		$_SESSION['roles'][] = 'provision2';
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'file';
		
		$_SESSION["provision2"] = 'active';
		$_SESSION["consultation"] = "active";
		$_SESSION["file"] = "active"; 
	}
	//Visto Bueno de Solicitud
	if($rowroute['type'] == 20){
		$_SESSION['roles'][] = 'request2';
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'file';
		
		$_SESSION["request2"] = 'active';
		$_SESSION["consultation"] = "active";
		$_SESSION["file"] = "active"; 
	}
	//Manejo de Proveedores 
	if($rowroute['type'] == 21){
		$_SESSION['roles'][] = 'providers';
		
		$_SESSION["providers"] = 'active';
	
	}
	//Firma Liberadora
	if($rowroute['type'] == 22){
		$_SESSION['roles'][] = 'financemanager2';
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'globalsearch';
		
		$_SESSION["financemanager2"] = 'active';
		$_SESSION["consultation"] = "active"; 
		$_SESSION["globalsearch"] = "active";  
	}
	//RETENCIONES
	if($rowroute['type'] == 23){
		$_SESSION['roles'][] = 'retentions';
		
		$_SESSION["retentions"] = 'active';
		$route_access = explode(", ", $rowroute['access']); 
		foreach($route_access as $b){
			
			if ($b == 1){ $_SESSION["imiprint"] = 'active'; $_SESSION['roles'][] = 'imiprint'; } 
			if ($b == 2){ $_SESSION["irprint"] = 'active'; $_SESSION['roles'][] = 'irprint'; } 
			if ($b == 3){ $_SESSION["imirequest"] = 'active'; $_SESSION['roles'][] = 'imirequest'; } 
			if ($b == 4){ $_SESSION["irrequest"] = 'active'; $_SESSION['roles'][] = 'irrequest'; } 
			if ($b == 5){ $_SESSION["imivoid"] = 'active'; $_SESSION['roles'][] = 'imivoid'; } 
			if ($b == 6){ $_SESSION["irvoid"] = 'active'; $_SESSION['roles'][] = 'irvoid'; }  
			if ($b == 7){ $_SESSION["imiexcel"] = 'active'; $_SESSION['roles'][] = 'imiexcel'; }  
			if ($b == 8){ $_SESSION["irexcel"] = 'active'; $_SESSION['roles'][] = 'irexcel'; }  
			if ($b == 9){ $_SESSION["imistuck"] = 'active'; $_SESSION['roles'][] = 'imistuck'; }  
			if ($b == 10){ $_SESSION["irstuck"] = 'active'; $_SESSION['roles'][] = 'irstuck'; }  
			if ($b == 11){ $_SESSION["imiremision"] = 'active'; $_SESSION['roles'][] = 'imiremision'; }  
			if ($b == 12){ $_SESSION["irremision"] = 'active'; $_SESSION['roles'][] = 'irremision'; }  
			if ($b == 13){ $_SESSION["contingency"] = 'active'; $_SESSION['roles'][] = 'contingency'; }   
			if ($b == 14){ $_SESSION["retentionmanager"] = 'active'; $_SESSION['roles'][] = 'retentionmanager'; }    
			
		} 
		$_SESSION['roles'][] = 'consultation';
		$_SESSION["consultation"] = "active"; 
	} 	
	//Reporte de Becas
	if($rowroute['type'] == 24){
		$_SESSION['roles'][] = 'scholarships';
		$_SESSION['roles'][] = 'consultation';
		
		$_SESSION["scholarships"] = 'active';
		$_SESSION["consultation"] = "active";  
    }
	//Sobres
	if($rowroute['type'] == 25){ 
		$_SESSION['roles'][] = 'envelopemaker';
		
		$_SESSION["envelopemaker"] = 'active'; 
    }
	//Rutas
	if($rowroute['type'] == 26){ 
		$_SESSION['roles'][] = 'routes';
		
		$_SESSION["routes"] = 'active';
    }
	//Liquidaciones
	if($rowroute['type'] == 27){ 
		$_SESSION['roles'][] = 'credit';
		$_SESSION['roles'][] = 'file';
		$_SESSION['roles'][] = 'consultation';
		
		$_SESSION["credit"] = 'active';
		$_SESSION["file"] = "active";
		$_SESSION["consultation"] = "active"; 
	}
	//Solicitud Transferencias Bancarias
	if($rowroute['type'] == 28){ 
		$_SESSION['roles'][] = 'request_bt';
		$_SESSION['roles'][] = 'file';
		
		$_SESSION["request_bt"] = 'active';
		$_SESSION["file"] = "active";
	}
	//Aprobado Transferencias Bancarias
	if($rowroute['type'] == 29){ 
		$_SESSION['roles'][] = 'approve_bt';
		
		$_SESSION["approve_bt"] = 'active';
	}
	//Provision Transferencias Bancarias
	if($rowroute['type'] == 30){ 
		$_SESSION['roles'][] = 'provision_bt';
		$_SESSION['roles'][] = 'file';
		
		$_SESSION["provision_bt"] = 'active';
		$_SESSION["file"] = "active";
	}
	//Reportes (Aseguradoras)
	if($rowroute['type'] == 31){ 
		$_SESSION['roles'][] = 'insurers_report';
		
		$_SESSION['insurers_report'] = 'active';
	}
	//Consulta Global
	if($rowroute['type'] == 32){ 
		$_SESSION['roles'][] = 'consultation';
		$_SESSION['roles'][] = 'globalsearch';
		
        $_SESSION["consultation"] = "active";
		$_SESSION["globalsearch"] = "active";
	}
	//
	if($rowroute['type'] == 33){
		$_SESSION['roles'][] = 'exchange';
		
		$_SESSION["exchange"] = 'active';
	}
	//
	if($rowroute['type'] == 34){
		$_SESSION['roles'][] = 'cards';
		
		$_SESSION["cards"] = 'active';
	}
    if($rowroute['type'] == 35){ 
		$_SESSION['roles'][] = 'consultation';
		
		$_SESSION["consultation"] = "active"; 
	}  
    //Reportes (Pagos)
	if($rowroute['type'] == 36){ 
		$_SESSION['roles'][] = 'payments_report';
		
		$_SESSION['payments_report'] = 'active'; 
	}
     //Información de Proveedores 
	if($rowroute['type'] == 37){
		$_SESSION['roles'][] = 'providersinfo';
		
		$_SESSION["providersinfo"] = 'active';
	}
    //Provision Global 
	if($rowroute['type'] == 38){
		$_SESSION['roles'][] = 'provision_global';
		
		$_SESSION["provision_global"] = 'active';
	}
    //Liberación Especial 
	if($rowroute['type'] == 39){
		$_SESSION['roles'][] = 'releasing_special';
		
		$_SESSION["releasing_special"] = 'active';
	}
     //Reporta de pagos especiales 
	if($rowroute['type'] == 40){
		$_SESSION['roles'][] = 'special_payments_report';
		
		$_SESSION["special_payments_report"] = 'active'; 
	}
     //Reporta de perfiles de usuario 
	if($rowroute['type'] == 41){
		$_SESSION['roles'][] = 'user_report';
		
		$_SESSION["user_report"] = 'active';  
	}
    if($rowroute['type'] == 42){
		$_SESSION['roles'][] = 'auditor_report';
		
		$_SESSION["auditor_report"] = 'active';  
	}
    if($rowroute['type'] == 43){
		$_SESSION['roles'][] = 'globaltimes_report';
		
		$_SESSION["globaltimes_report"] = 'active'; 
	}
	 if($rowroute['type'] == 44){
		$_SESSION['roles'][] = 'refund_report';
		 
		$_SESSION["refund_report"] = 'active';  
	}
	 if($rowroute['type'] == 45){
		 $_SESSION['roles'][] = 'providers_report';
			 
		$_SESSION["providers_report"] = 'active';  
	}
	 if($rowroute['type'] == 46){
		$_SESSION['roles'][] = 'ppe1';
		 
		$_SESSION["ppe1"] = 'active';  
	}
	 if($rowroute['type'] == 47){
		 $_SESSION['roles'][] = 'pce1';
		 
		$_SESSION["pce1"] = 'active';  
	}
	 if($rowroute['type'] == 48){
		 $_SESSION['roles'][] = 'iva';
		 
		$_SESSION["iva"] = 'active';  
	}
	 if($rowroute['type'] == 49){
		 $_SESSION['roles'][] = 'frequest';
		 
		$_SESSION["frequest"] = 'active';  
	}
	 if($rowroute['type'] == 50){
		$_SESSION['roles'][] = 'fapprove';
		 
		$_SESSION["fapprove"] = 'active';  
	}
	 if($rowroute['type'] == 51){
		 $_SESSION['roles'][] = 'fapprove2';
		 
		 $_SESSION["fapprove2"] = 'active';  
	}
	 if($rowroute['type'] == 52){
		$_SESSION['roles'][] = 'reportRefund';
		 
		$_SESSION["reportRefund"] = 'active';  
	}
	if($rowroute['type'] == 53){
		$_SESSION['roles'][] = 'followupAdmin';
		
		$_SESSION["followupAdmin"] = 'active';  
	}
	if($rowroute['type'] == 54){
		$_SESSION['roles'][] = 'followupUser';
			
		$_SESSION["followupUser"] = 'active';  
	}
	if($rowroute['type'] == 56){
		$_SESSION['roles'][] = 'bankingDebt';
		$_SESSION['roles'][] = 'bankingDebtAdmin';
		
		$_SESSION["bankingDebt"] = 'active';  
        $_SESSION["bankingDebtAdmin"] = 'active';  
	}
	if($rowroute['type'] == 57){
		$_SESSION['roles'][] = 'bankingDebt';
		$_SESSION['roles'][] = 'bankingDebtAccountant';
		$_SESSION['roles'][] = "bankingDebtAccountantCompanies:{$rowroute['company']}";
		
        $_SESSION["bankingDebt"] = 'active'; 
		$_SESSION["bankingDebtAccountant"] = 'active';
        $_SESSION["bankingDebtAccountantCompanies"][$rowroute['company']] = 'active'; 
	}
    if($rowroute['type'] == 58){
		$_SESSION['roles'][] = 'reportElectronicPayments';
		
        $_SESSION["reportElectronicPayments"] = 'active'; 
	}
		
	if($rowroute['type'] == 60){
		$_SESSION['roles'][] = 'pipReport';
		
        $_SESSION["pipReport"] = 'active'; 
	}
		
		if($rowroute['type'] == 61){
		$_SESSION['roles'][] = '2FA';
		
        $_SESSION["2FA"] = 'active'; 
	}

	}

	$_SESSION["userid"] = $row['code'];
	if($row['first'] != ""){
		$_SESSION["firstname"] = $row['first'];
	}else{
		$_SESSION["firstname"] = "Nombre";
	}
	if($row['last'] != ""){
		$_SESSION["lastname"] = $row['last']; 
	}else{
		$_SESSION["lastname"] = "Apellido"; 
	}

	 
	$_SESSION["company"] = $row['company'];
	$_SESSION["unit"] = $row['unit'];
	$_SESSION["authdata"] = "active";		
	$_SESSION["id"] = $row[0]; 

	$_GLOBALS['userid'] = $row['code'];
	$_GLOBALS["firstname"] = $row['first'];
	$_GLOBALS["lastname"] = $row['last']; 
	$_GLOBALS["email"] = $row['email']; 

	if($row['email'] == 'enavarro@casapellas.com'){
		$_SESSION["dch"] = 'active';
	}
	if($row['email'] == 'dchamorro@casapellas.com'){
		$_SESSION["dch"] = 'active';
		$_SESSION["globalsearch"] = "active";
		#header('location: admin/approve-special.php');
	}
	elseif($row['email'] == 'spellasm@casapellas.com'){
		$_SESSION["spellas"] = 'active';
		$_SESSION["globalsearch"] = "active";
		#header('location: admin/approve-special.php');
	}
	else{
		if($referer != ""){
			#header('location: admin/');
		}else{
			#header('location: admin/dashboard.php');
		}
	}

	if($masterKey != 1){
		header('location: twoFactorCheck.php');
	}else{
		$_SESSION['2fa_verified'] = true;
		header('location: admin/dashboard.php');
	}
	
	
	}
else{
  		
	if($stmt = $con->prepare("SELECT id, attempts FROM workers WHERE email = ?")) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $attempts);
    if ($stmt->fetch()) {
        $nattempts = $attempts + 1;
        $stmt->close();
        if ($update_stmt = $con->prepare("UPDATE workers SET attempts = ? WHERE id = ?")) {
            $update_stmt->bind_param("ii", $nattempts, $id);
            $update_stmt->execute();
            $update_stmt->close();
        }
    }
    $stmt->close();
} else {
    // Manejar errores en la preparación de la declaración de selección
    echo "Error al preparar la declaración de selección: " . htmlspecialchars($con->error);
}
	
	
  	header("location: /?err=1"); 
	
}
	    
?>