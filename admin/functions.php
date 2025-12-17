<?php

include_once('sessions.php');

$globalHall = array(); 
$queryGlobalHall= "select id, name from halls";
$resultGlobalHall = mysqli_query($con, $queryGlobalHall);
while($rowGlobalHall = mysqli_fetch_array($resultGlobalHall)){
	$globalHall[$rowGlobalHall['id']] = $rowGlobalHall['name'];
}

function getUnit($unitId, $ncatalog, $type){
	
	include('sessions.php'); 
	
	$queryUnit = "select code, name, newCode, companyName, lineName, locationName from units where id = '$unitId'";
	$resultUnit = mysqli_query($con, $queryUnit);
	$rowUnit = mysqli_fetch_array($resultUnit);
	$rowUnit['newCode'];
	
	#nuevo formato de unidades de negocio
	if($ncatalog == 1){
		
		if($type == 'name'){
			return "$rowUnit[companyName] $rowUnit[lineName] $rowUnit[locationName]";
		}elseif($type == 'code'){
			return $rowUnit['newCode'];
		}else{
			return "$rowUnit[newCode] | $rowUnit[companyName] $rowUnit[lineName] $rowUnit[locationName]";
		}
		
	}else{
		
		if($type == 'name'){
			return $rowUnit['name'];
		}elseif($type == 'code'){
			return $rowUnit['code'];
		}else{
			return "$rowUnit[code] | $rowUnit[name]";
		}
	}
	
}

function urlProcessor($furl,$fprocess,$fuser){

	switch($fprocess){
		case 1:
		//GET THE ZmlsZT0xJnVzZXJpZD1QQ1AwMDAx
		$farray = explode('/',$furl);
		$fsize = sizeof($farray);
		$fsize--;
		$furl = $farray[$fsize];
		$furl = str_replace('.pdf','',$furl);
		$furl = str_replace('.PDF','',$furl);
		$foutput = $furl;
		break;
		case 2:
		//GET THE FULL URL
		$foutput = 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$furl;
		break;
		case 3:
		$fchar = urlProcessor($furl, 1);
		$foutput = "files/folder_".$fuser."/".str_replace(' ','%20',$fchar).".pdf";
		break; 
	}
	
	return $foutput; 
}

function getBen($parent, $btype, $provider, $collaborator, $intern, $client){
	
	include('../connection.php');  
    $err = "";
    if($btype == ""){
        $err.= $btype."nobtype";
    }
    $err.= $btype;
    switch($btype){
		case 1:
		$query = "select * from providers where id = '$provider'";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		if($row['flag'] == 1){
			$ben = '<img src="../images/flag.png" width="13" alt=""/> '."$row[code] | $row[name]";
		}else{
			$ben = "$row[code] | $row[name]";
		}
		break;
		case 2:
			$query = "select * from workers where id = '$collaborator'";
			$result = mysqli_query($con, $query);
			$row=mysqli_fetch_array($result);
		$ben = "$row[code] | $row[first] $row[last]";
		break;
		case 3:
			$query = "select * from interns where code = '$intern'";
			$result = mysqli_query($con, $query);
		$row=mysqli_fetch_array($result);
		$ben = "$row[code] | $row[first] $row[first2] $row[last] $row[last2]";
		break; 
		case 4:
			$query = "select * from clients where code = '$client'";
			$result = mysqli_query($con, $query);
		$row=mysqli_fetch_array($result);
		if($row['type'] == 1){
			$ben = '<img src="../images/dev.png" width="15"> '."$row[code] | $row[first] $row[last]";
		}elseif($row['type'] == 2){
			$ben = '<img src="../images/dev.png" width="15"> '."$row[code] | $row[name]"; 
		}
		break;
		
	}
	
	if($parent == 1){
		$new_ben = '<i class="fa fa-users" title="'.$ben.'"></i> Pasantes Varios';
		$ben = $new_ben;
	}
    elseif($parent == 2){
		$new_ben = '<i class="fa fa-users" title="'.$ben.'"></i> Colaboradores Varios';
		$ben = $new_ben;
	}
	elseif($parent == 3){
		$new_ben = '<i class="fa fa-users" title="'.$ben.'"></i> Proveedores Varios';
		$ben = $new_ben;
	}
	
	return $ben;
}

function getBen2($parent, $btype, $provider, $collaborator, $intern, $client){
	
	include('../connection.php');  
	
	switch($btype){
		case 1:
			$query = "select * from providers where id = '$provider'";
			$result = mysqli_query($con, $query); 
			$row=mysqli_fetch_array($result);
		if($row['flag'] == 1){
			$ben = "$row[code] | $row[name] [VIP]";
		}else{
			$ben = "$row[code] | $row[name]";
		}
		
		break;
		case 2:
		$row=mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$collaborator'"));
		$ben = "$row[code] | $row[first] $row[last]";
		break;
		case 3:
		$row=mysqli_fetch_array(mysqli_query($con, "select * from interns where code = '$intern'"));
		$ben = "$row[code] | $row[first] $row[first2] $row[last] $row[last2]";
		break; 
		case 4:
		$row=mysqli_fetch_array(mysqli_query($con, "select * from clients where code = '$client'"));
		if($row['type'] == 1){
			$ben = "$row[code] | $row[first] $row[last]";
		}elseif($row['type'] == 2){
			$ben = "$row[code] | $row[name]"; 
		}
		break;
		
	}
	
	if($parent == 1){
		$new_ben = 'Pasantes Varios';
		$ben = $new_ben;
	}elseif($parent == 2){
		$new_ben = 'Colaboradores Varios';
		$ben = $new_ben;
	}
	
	return $ben;
}

function getBenCode($btype, $provider, $collaborator, $intern, $client){
	
	include('sessions.php');  
	
	switch($btype){
		case 1:
			$query = "select * from providers where id = '$provider'";
			$result = mysqli_query($con, $query); 
			$row=mysqli_fetch_array($result);
			$ben = $row['code'];
		break;
		case 2:
		$row=mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$collaborator'"));
		$ben = $row['code'];
		break;
		case 3:
		$row=mysqli_fetch_array(mysqli_query($con, "select * from interns where code = '$intern'"));
		$ben = $row['code'];
		break; 
		case 4:
		$row=mysqli_fetch_array(mysqli_query($con, "select * from clients where code = '$client'"));
		if($row['type'] == 1){
			$ben = $row['code'];
		}elseif($row['type'] == 2){
			$ben = $row['code']; 
		}
		break;
		
	}
	
	return $ben;
}

function convertAmount($amount, $fromcurrency, $tocurrency, $today){
	
	include('../connection.php');  
	$amount_new = 0;
	
	$query_tc = "select * from tc where today = '$today'";
	$result_tc = mysqli_query($con, $query_tc);
	$row_tc = mysqli_fetch_array($result_tc);
	$tc = $row_tc['tc']; 
	
	if(($fromcurrency == 1) and ($tocurrency == 2)){
		$amount_new = floatval($amount)/floatval($tc);
	}elseif(($fromcurrency == 2) and ($tocurrency == 1)){
		$amount_new = floatval($amount)*floatval($tc);  
	}
	
	  return $amount_new; 

}

function getUser($id){ 
	
	include('../connection.php');  
    $queryUser = "select first, last from workers where code = '$id'";
    $resultUser = mysqli_query($con, $queryUser);
    $rowUser = mysqli_fetch_array($resultUser);
    
    return "$rowUser[first] $rowUser[last]";
    
}

function toLetters($numero): string { 
	
	$numero = str_replace(',','',$numero);
	
    $unidades = ["", "Uno", "Dos", "Tres", "Cuatro", "Cinco", "Seis", "Siete", "Ocho", "Nueve"];
    $especiales = [11 => "Once", 12 => "Doce", 13 => "Trece", 14 => "Catorce", 15 => "Quince"];
    $decenas = ["", "", "Veinte", "Treinta", "Cuarenta", "Cincuenta", "Sesenta", "Setenta", "Ochenta", "Noventa"];
    $centenas = ["", "Cien", "Doscientos", "Trescientos", "Cuatrocientos", "Quinientos", "Seiscientos", "Setecientos", "Ochocientos", "Novecientos"];

    if ($numero == 0) {
        return "Cero";
    }

    if ($numero < 0) {
        return "Menos " . toLetters(abs($numero));
    }

    $texto = "";

    // Millones
    if ($numero >= 1_000_000) {
        $millones = intval($numero / 1_000_000);
        $texto .= toLetters($millones) . " Millón" . ($millones > 1 ? "es" : "");
        $numero %= 1_000_000;
    }

    // Miles
    if ($numero >= 1_000) {
        $miles = intval($numero / 1_000);
        $texto .= ($texto ? " " : "") . ($miles > 1 ? toLetters($miles) . " Mil" : "Mil");
        $numero %= 1_000;
    }

    // Centenas
    if ($numero >= 100) {
        $centena = intval($numero / 100);
        $texto .= ($texto ? " " : "") . ($centena == 1 && $numero % 100 == 0 ? "Cien" : $centenas[$centena]);
        $numero %= 100;
    }

    // Decenas y unidades
    if ($numero >= 20) {
        $decena = intval($numero / 10);
        $unidad = $numero % 10;
        $texto .= ($texto ? " " : "") . $decenas[$decena];
        if ($unidad > 0) {
            $texto .= " y " . $unidades[$unidad];
        }
    } elseif ($numero >= 11) {
        $texto .= ($texto ? " " : "") . $especiales[$numero];
    } elseif ($numero == 10 || $numero == 20) {
        $texto .= ($texto ? " " : "") . $decenas[$numero / 10]; // para 10 y 20
    } elseif ($numero > 0) {
        $texto .= ($texto ? " " : "") . $unidades[$numero];
    }

    // Corregir casos especiales "uno" y "un"
    $texto = preg_replace('/uno /', 'un ', $texto);  // Reemplazar "uno" por "un" si es necesario

    return $texto;
} 

$globalCurrencyPre = array();
$globalCurrencySymbol = array();
$globalCurrencyName = array();
$queryGlobalCurrency = "select id, pre, symbol, name from currency";
$resultGlobalCurrency = mysqli_query($con, $queryGlobalCurrency);
while($rowGlobalCurrency = mysqli_fetch_array($resultGlobalCurrency)){
	$globalCurrencyPre[$rowGlobalCurrency['id']] = $rowGlobalCurrency['pre'];
	$globalCurrencySymbol[$rowGlobalCurrency['id']] = $rowGlobalCurrency['symbol'];
	$globalCurrencyName[$rowGlobalCurrency['id']] = $rowGlobalCurrency['name'];
}

$globalCompany = array();
$queryGlobalCompany = "select id, name from companies";
$resultGlobalCompany = mysqli_query($con, $queryGlobalCompany);
while($rowGlobalCompany = mysqli_fetch_array($resultGlobalCompany)){
	$globalCompany[$rowGlobalCompany['id']] = $rowGlobalCompany['name'];
}

$globalBank = array();
$queryGlobalBank= "select id, name from banks";
$resultGlobalBank = mysqli_query($con, $queryGlobalBank);
while($rowGlobalBank = mysqli_fetch_array($resultGlobalBank)){
	$globalBank[$rowGlobalBank['id']] = $rowGlobalBank['name'];
}

$globalStatus = array();
$queryGlobalStatus= "select id, name from stages";
$resultGlobalStatus = mysqli_query($con, $queryGlobalStatus);
while($rowGlobalStatus = mysqli_fetch_array($resultGlobalStatus)){
	$globalStatus[$rowGlobalStatus['id']] = $rowGlobalStatus['name'];
}

function sanitizeInput($val, $con) {
    if (is_array($val)) {
        $sanitizedArray = [];
        foreach ($val as $key => $value) {
            if (is_array($value)) {
                // Llamada recursiva para sanitizar arrays multidimensionales
                $sanitizedArray[$key] = sanitizeInput($value, $con);
            } else {
                // Sanitizar valores individuales
                $sanitizedArray[$key] = is_string($value) 
                    ? mysqli_real_escape_string($con, trim($value)) 
                    : $value;
            }
        }
        return $sanitizedArray;
    } else {
        return is_string($val) 
            ? mysqli_real_escape_string($con, trim($val)) 
            : $val;
    }
}

function sanitizeCkeditorInput($value, $con) {
   
	$value = trim($value);
    // (Opcional) Limpiar párrafos vacíos tipo <p>\r\n\r\n</p>
    $value = preg_replace('/<p>\s*<\/p>/', '', $value);
    return $value;
}

function sanitizedOutput($val) {
    if (is_array($val)) {
        return array_map('sanitizedOutput', $val);
    }
    return is_string($val) 
        ? htmlspecialchars($val, ENT_QUOTES, 'UTF-8') 
        : $val;
}

function activeDomain($val){
	$val = str_replace('http://','',$val);
	$val = str_replace('https://','',$val);
	$val = str_replace('getpaycp.com/','',$val);
	$val = str_replace('admin/','',$val);
	#$val = str_replace('','',$val);
	return($val);
}
	
?>