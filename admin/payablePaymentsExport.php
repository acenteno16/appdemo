<?php

#error_reporting(E_ALL);
#ini_set('display_errors', TRUE);
#ini_set('display_startup_errors', TRUE);

session_start();

if(($_SESSION['admin'] == 'active') or ($_SESSION["payer"] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noPayer");	 
}

$today = date('Y-m-d'); 


// Include PhpSpreadsheet's autoloader
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

include('function-beneficiary.php');
$sheet->setCellValue('A1', 'Ingreso a Banco');
$sheet->setCellValue('B1', 'GID');
$sheet->setCellValue('C1', 'WID');
$sheet->setCellValue('D1', 'IDS');
$sheet->setCellValue('E1', 'Beneficiario');
$sheet->setCellValue('F1', 'Monto');
$sheet->setCellValue('G1', 'Moneda');
#$sheet->setCellValue('H1', 'Edo. Provision');
$sheet->setCellValue('H1', 'Compañia');
$sheet->setCellValue('I1', 'Banco');

$xlsRow = 2;

$theBank = array();
$queryBank = "select id, name from banks";
$resultBank = mysqli_query($con, $queryBank);
while($rowBank=mysqli_fetch_array($resultBank)){
	$theBank[$rowBank['id']] = $rowBank['name'];
}

$theCurrency = array();
$queryCurrency = "select id, pre from currency";
$resultCurrency = mysqli_query($con, $queryCurrency);
while($rowCurrency=mysqli_fetch_array($resultCurrency)){
	$theCurrency[$rowCurrency['id']] = $rowCurrency['pre'];
}

$theCompany = array();
$queryCompany = "select id, name from companies";
$resultCompany = mysqli_query($con, $queryCompany);
while($rowCompany=mysqli_fetch_array($resultCompany)){
	$theCompany[$rowCompany['id']] = $rowCompany['name'];
}


$query = "select payments.* from payments inner join schedulecontent on payments.id = schedulecontent.payment inner join schedule on schedulecontent.schedule = schedule.id where payments.status = '13' and payments.approved != '3' and (schedule.status = '3' or schedule.status = '5') order by payments.expiration desc";   
$result = mysqli_query($con, $query);  
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){ 
	
	/*
	
	$ben_name = "";
	$ben_type = "";
	
	#ingreso a banco
		
	
	$international = "No";
	
	switch($row['btype']){
		case 1:
		$queryprovider = "select code, name, international from providers where id = '$row[provider]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		if($rowprovider['international'] == 1){
			$international = "Si";
		}
		$ben_name = $rowprovider['code']." | ".$rowprovider['name'];
		$ben_type = "Proveedor";
		break;
		case 2:
		$queryprovider = "select code, first, last from workers where id = '$row[collaborator]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
		$ben_type = "Colaborador";
		break;
		case 3:
		$queryprovider = "select code, first, last from interns where id = '$row[intern]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
		$ben_type = "Pasante";
		break;
		case 4:
		$queryprovider = "select type, code, first, last, name from clients where code = '$row[client]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider); 
		if($rowprovider['type'] == 1){
			$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
		}else{
			$ben_name = $rowprovider['code']." | ".$rowprovider['name'];
		}
		
		$ben_type = "Cliente";
		break;
	} 
	
	
	

	
	if($row['ppe1'] == 0){
		$thisProvision = 'Normal';
	}elseif($row['ppe1'] == 1){
		$thisProvision = 'Pendiente E1';
	}elseif($row['ppe1'] == 2){
		$thisProvision = 'Completo E1';
	}
	
*/
	$row13 = mysqli_fetch_array(mysqli_query($con, "select today from times where payment = '$row[id]' and stage = '13' order by id desc limit 1"));
	$thisDay =  date('d-m-Y',strtotime($row13['today']));
	
	#$querySchedule = "select schedule.id, schedule.code, schedule.bank from schedule inner join schedulecontent on schedule.id = schedulecontent.schedule where schedulecontent.payment = '$row[id]'";
	#$resultSchedule = mysqli_query($con, $querySchedule);
	#$rowSchedule = mysqli_fetch_array($resultSchedule);
	
	$queryGroup = "select schedule from schedulecontent where payment = '$row[id]' order by id desc limit 1";
	$resultGroup = mysqli_query($con, $queryGroup);
	$rowGroup = mysqli_fetch_array($resultGroup);
	
	$querySchedule = "select id, code, bank from schedule where id = '$rowGroup[schedule]'";
	$resultSchedule = mysqli_query($con, $querySchedule);
	$rowSchedule = mysqli_fetch_array($resultSchedule);
	
	
	
	
    $sheet->setCellValue('A'.$xlsRow, $thisDay);
	$sheet->setCellValue('B'.$xlsRow, $rowSchedule['id']);
	$sheet->setCellValue('C'.$xlsRow, $rowSchedule['code']);
	$sheet->setCellValue('D'.$xlsRow, $row['id']);
	$sheet->setCellValue('E'.$xlsRow, getBeneficiary($row['id'],'min'));
	$sheet->setCellValue('F'.$xlsRow, $row['payment']);
	$sheet->setCellValue('G'.$xlsRow, $theCurrency[$row['currency']]);
	#$sheet->setCellValue('H'.$xlsRow, $thisProvision);
	$sheet->setCellValue('H'.$xlsRow, $theCompany[$row['company']]);
	$sheet->setCellValue('I'.$xlsRow, $theBank[$rowSchedule['bank']]); 
	
	$sheet->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode('#,##0.00'); 

	$xlsRow++;
	
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