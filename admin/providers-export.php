<?php 

#error_reporting(E_ALL);
#ini_set('display_errors', TRUE);
#ini_set('display_startup_errors', TRUE);

session_start();

function hasAccess($roles) {
    foreach ($roles as $role) {
        if (isset($_SESSION[$role]) && $_SESSION[$role] === "active") {
            return true;
        }
    }
    return false;
}

$allowedRoles = ["admin", "providers", "providers_report"];

if(hasAccess($allowedRoles)){
    include("../connection.php");
}else{
    session_destroy();
    header("Location: ../?err=noproviders_provider_export");
    exit;
}

$todaydate=date("r");

function sanitizeInput($val, $con) {
    if (is_array($val)) {
        foreach ($val as &$value) {
            $value = mysqli_real_escape_string($con, $value);
        }
    } else {
        $val = mysqli_real_escape_string($con, $val);
    }
    return $val;
}

$code = isset($_GET['code']) ? sanitizeInput($_GET['code'], $con) : '';
$name = isset($_GET['name']) ? sanitizeInput($_GET['name'], $con) : '';
$international = isset($_GET['international']) ? $_GET['international'] : '';
$course = isset($_GET['course']) ? sanitizeInput($_GET['course'], $con) : '';
$gcp = isset($_GET['gcp']) ? $_GET['gcp'] : '';
$updated = isset($_GET['updated']) ? $_GET['updated'] : '';
$email = isset($_GET['email']) ? sanitizeInput($_GET['email'], $con) : '';

// Construcción dinámica con prepared statements
$query = "SELECT * FROM providers WHERE id > 0";
$params = [];
$types = '';

if (!empty($code)) {
    $query .= " AND code LIKE ?";
    $params[] = "%$code%";
    $types .= 's';
}
if (!empty($name)) {
    $query .= " AND name LIKE ?";
    $params[] = "%$name%";
    $types .= 's';
}
if (!empty($international)) {
    $international_val = $international === 'int' ? 1 : 0;
    $query .= " AND international = ?";
    $params[] = $international_val;
    $types .= 'i';
}
if (!empty($course)) {
    $query .= " AND course LIKE ?";
    $params[] = "%$course%";
    $types .= 's';
}
if (!empty($updated)) {
    $updated_val = $updated === 'yes' ? 1 : 0;
    $query .= " AND updated = ?";
    $params[] = $updated_val;
    $types .= 'i';
}
if (!empty($email)) {
    $query .= " AND email = ?";
    $params[] = $email;
    $types .= 's';
}
if (!empty($gcp)) {
    $gcp_val = $gcp === 'yes' ? 1 : 0;
    $query .= " AND gcp = ?";
    $params[] = $gcp_val;
    $types .= 'i';
}

$query = $con->prepare($query);
if($types){
	$query->bind_param($types, ...$params);
}
$query->execute();
$result = $query->get_result();

$thisCurrency = array();
$querycurrency = "select * from currency";
$resultcurrency = mysqli_query($con, $querycurrency);
while($rowcurrency = mysqli_fetch_array($resultcurrency)){
	$thisCurrency[$rowcurrency['id']] = $rowcurrency['name'];
}

$thisBank = array();
$querybank = "select id, name from banks";
$resultbank = mysqli_query($con, $querybank); 
while($rowbank=mysqli_fetch_array($resultbank)){
	$thisBank[$rowbank['id']] = $rowbank['name'];
}

$thisCompany = array();
$querycompany = "select id, name from companies";
$resultcompany = mysqli_query($con, $querycompany);
while($rowcompany=mysqli_fetch_array($resultcompany)){
	$thisCompany[$rowcompany['id']] = $rowcompany['name'];
}
		
$theBank = '';
$companyName = '';
$thisAccount  = '';

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Proveedores Grupo Casa Pellas');
$sheet->setCellValue('A2', $todaydate);
$sheet->setCellValue('A3', cleanString("Código"));
$sheet->setCellValue('B3', cleanString("Nombre"));
$sheet->setCellValue('C3', cleanString("Plazo"));
$sheet->setCellValue('D3', cleanString("RUC"));
$sheet->setCellValue('E3', cleanString("Dirección"));
$sheet->setCellValue('F3', cleanString("Telefono"));
$sheet->setCellValue('G3', cleanString("Rubro"));
$sheet->setCellValue('H3', cleanString("Activo"));
$sheet->setCellValue('I3', cleanString("Internacional"));
$sheet->setCellValue('J3', cleanString("VIP"));
$sheet->setCellValue('K3', cleanString("GCP"));
$sheet->setCellValue('L3', cleanString("Creacion en getPay"));
$sheet->setCellValue('M3', cleanString("Última cancelación"));
$sheet->setCellValue('AP3', cleanString("Ciudad"));
$sheet->setCellValue('AQ3', cleanString("Pais"));
$sheet->setCellValue('AR3', cleanString("Correo"));

$xlsRow = 4;
while($row=mysqli_fetch_array($result)){
	
	$thisToday = '';
	if($row['today'] != '0000-00-00'){
		$thisToday = $row['today'];
	}
    
    $thisToday2 = '';
	if($row['lastTransaction'] != '0000-00-00'){
		$thisToday2 = $row['lastTransaction']; 
	}
	
	$city = $row['city'];
	$country = $row['country'];
	$email = $row['email'];

	$sheet->setCellValue('A'.$xlsRow, cleanString($row['code']));
	$sheet->setCellValue('B'.$xlsRow, cleanString($row['name']));
	$sheet->setCellValue('C'.$xlsRow, cleanString($row['term']));
	$sheet->setCellValue('D'.$xlsRow, cleanString($row['ruc']));
	$sheet->setCellValue('E'.$xlsRow, cleanString($row['address']));
	$sheet->setCellValue('F'.$xlsRow, cleanString($row['phone']));
	$sheet->setCellValue('G'.$xlsRow, cleanString($row['course']));
	$sheet->setCellValue('H'.$xlsRow, cleanString($row['active']));
	$sheet->setCellValue('I'.$xlsRow, cleanString($row['international']));
	$sheet->setCellValue('J'.$xlsRow, cleanString($row['vips']));
	$sheet->setCellValue('K'.$xlsRow, cleanString($row['gcp']));
	$sheet->setCellValue('L'.$xlsRow, $thisToday);
	$sheet->setCellValue('M'.$xlsRow, $thisToday2);
	$sheet->setCellValue('AP'.$xlsRow, $city);
	$sheet->setCellValue('AQ'.$xlsRow, $country);
	$sheet->setCellValue('AR'.$xlsRow, $email);
   
	$xlsColumn = explode(',','A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AB,AC,AD,AE,AF,AG,AH,AI,AJ,AK');
    $inc = 13;
	
	$queryba = "select * from providers_plans where provider = '$row[id]'"; 
	$resultba = mysqli_query($con, $queryba);
	$numba = mysqli_num_rows($resultba);
	if($numba > $maxPlans){
        $maxPlans = $numba;
    }
	
	while($rowba=mysqli_fetch_array($resultba)){
    
    	$queryplan = "select company, currency from plans where id = '$rowba[plan]'";
    	$resultplan = mysqli_query($con, $queryplan);
    	$rowplan=mysqli_fetch_array($resultplan);
    
		$companyName = '';
		if($rowplan['company'] != ''){
			$companyName = cleanString($thisCompanu[$rowplan['company']]);
		}
		$theBank = '';
		if($rowba['bank'] != ''){
			$theBank = cleanString($thisBank[$rowba['bank']]);
		}
		$theAccount = '';
		if($rowba['account'] != ''){
			$theAccount = cleanString($rowba['account']);
		}
		$theCurrency = '';
		if($rowplan['currency'] > 0){
			$theCurrency = $thisCurrency[$rowplan['currency']];
		}
	
		$sheet->setCellValue($xlsColumn[$inc].$xlsRow, $companyName);
		$sheet->setCellValue($xlsColumn[$inc++].$xlsRow, $theBank);
		$sheet->setCellValue($xlsColumn[$inc++].$xlsRow, $theAccount);
		$sheet->setCellValue($xlsColumn[$inc++].$xlsRow, $theCurrency);
		
	}
	
	$xlsRow++;

} 

$inc2 = 13;
for($ip=1;$ip<=$maxPlans;$ip++){
	
	$sheet->setCellValue($xlsColumn[$inc2].'3', cleanString("Compañía $ip"));
	$sheet->setCellValue($xlsColumn[$inc2++].'3', "Banco $ip");
	$sheet->setCellValue($xlsColumn[$inc2++].'3', "Cuenta $ip");
	$sheet->setCellValue($xlsColumn[$inc2++].'3', "Moneda $ip"); 
	
} 

function cleanString($cadena){
	
	//return $result = preg_replace("/[^A-Za-z0-9?![:space:]]/", "", $string);
	$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    return utf8_encode($cadena);
}
	
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reportePendientesCancelacion.xlsx"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>