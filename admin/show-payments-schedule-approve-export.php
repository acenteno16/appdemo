<?php 

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

session_start();

if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active')){ 
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noadmin,nofinancemanager,noretentionmanager");	 
}

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

include('function-beneficiary.php');

function getExpiration($expiration){
	
	
	
	$date1 = date("Y-m-d");
	$date2 = $expiration;
	$date3 = date('d-m-Y',strtotime($expiration)); 
	if($date2 == "0000-00-00"){
		$date2 = date("Y-m-d"); 
		$date3 = date('d-m-Y',strtotime($date2)); 
	}

	$dias = (strtotime($date1)-strtotime($date2))/86400;
	
	if($dias < 0) $parentesis = intval(abs($dias));
	elseif($dias > 0) $parentesis = intval(-1*abs($dias));
	else $parentesis = $dias;
	
	return($parentesis); 
	
}

$now = date('Y-m-d'); 
$xlsRow = 2;
$today = date('Y-m-d'); 
$sql = $sql1.$sql2.$sql3;

$query = "select payments.* from payments inner join schedulecontent on payments.id = schedulecontent.payment inner join schedule on schedulecontent.schedule = schedule.id where payments.status = '12' and payments.approved != '3' and schedule.vo = '1' order by payments.expiration desc";   
$result = mysqli_query($con, $query);   

$sheet->setCellValue('A1', 'IDS');
$sheet->setCellValue('B1', 'UN');
$sheet->setCellValue('C1', 'Ingreso a Banco');
$sheet->setCellValue('D1', 'Moneda');
$sheet->setCellValue('E1', 'Monto');
$sheet->setCellValue('F1', 'Proveedor/Colaborador');
$sheet->setCellValue('G1', 'Banco');
$sheet->setCellValue('H1', 'Comapnia');
$sheet->setCellValue('I1', 'Vencimiento');
$sheet->setCellValue('J1', 'Dias');
$sheet->setCellValue('K1', 'Descripcion');
 
$thisCompany = array();
$queryCompany = "select id, name from companies";
$resultCompany = mysqli_query($con, $queryCompany);
while($rowCompany = mysqli_fetch_array($resultCompany)){
    $thisCompany[$rowCompany['id']] = $rowCompany['name'];
}
$thisBank = array();
$queryBank = "select id, name from banks";
$resultBank = mysqli_query($con, $queryBank);
while($rowBank = mysqli_fetch_array($resultBank)){
    $thisBank[$rowBank['id']] = $rowBank['name'];
}
$thisCurrency = array();
$queryCurrency = "select id, pre from currency";
$resultCurrency = mysqli_query($con, $queryCurrency);
while($rowCurrency = mysqli_fetch_array($resultCurrency)){
    $thisCurrency[$rowCurrency['id']] = $rowCurrency['pre'];
}

while($row=mysqli_fetch_array($result)){

	$queryunit = "select * from units where id = '$row[routeid]'";
	$resultunit = mysqli_query($con, $queryunit);
	$rowunit = mysqli_fetch_array($resultunit);
    if($row['ncatalog'] == 1){
	   $unit = "$rowunit[newCode] | $rowunit[companyName] $rowunit[lineName] $rowunit[locationName]";
    }
    else{
	   $unit = $rowunit['code'].' | '.$rowunit['name']; 
    }
	
	$queryroute = "select workers.code, workers.first, workers.last from workers inner join routes on workers.code = routes.worker where routes.type = '9'";
	$resultroute = mysqli_query($con, $queryroute);
	$contadores = "";
	while($rowroute = mysqli_fetch_array($resultroute)){
		$contadores.=$rowroute['code'].' | '.$rowroute['first']." ".$rowroute['last'].' / '; 
	}
	
	$expiration = date('d-m-Y', strtotime($row['expiration']));	
	$days = getExpiration($row['expiration']);
	
	$sheet->setCellValue('A'.$xlsRow, $row['id']);
	$sheet->setCellValue('B'.$xlsRow, $unit);
	$sheet->setCellValue('C'.$xlsRow, $contadores);
	$sheet->setCellValue('D'.$xlsRow, $thisCurrency[$row['currency']]);
	$sheet->setCellValue('E'.$xlsRow, $row['payment']);
	$sheet->setCellValue('F'.$xlsRow, getBeneficiary($row['id'],'min'));
	$sheet->setCellValue('G'.$xlsRow, $thisBank[$row['bank']]);
	$sheet->setCellValue('H'.$xlsRow, $thisCompany[$row['company']]);
	$sheet->setCellValue('I'.$xlsRow, $expiration);
	$sheet->setCellValue('J'.$xlsRow, $days); 
	$sheet->setCellValue('K'.$xlsRow, $row['description']); 
	
	$sheet->getStyle('E'.$xlsRow)->getNumberFormat()->setFormatCode('#,##0.00');

	$xlsRow++; 

}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pendientes-de-aprobado-de-programacion.xlsx"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>