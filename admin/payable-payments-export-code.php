<?php

#error_reporting(E_ALL);
#ini_set('display_errors', TRUE);
#ini_set('display_startup_errors', TRUE);

session_start();

if($_SESSION["payer"] == "active"){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=9");	 
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
$sheet->setCellValue('H1', 'Edo. Provision');
$sheet->setCellValue('I1', 'Compañia');
$sheet->setCellValue('J1', 'Banco');


$xlsRow = 2;

$from = $_POST['from'];
$to = $_POST['to'];
$company = $_POST['company'];

$sql1 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql1 = " and times.today >= '$from'";
	$param++;
}else{
	exit('<script>alert("Favor ingrese la fecha de inicio.");history.go(-1);</script>');
}
$sql2 = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sql2 = " and times.today <= '$to'";
	$param++;
}else{
	exit('<script>alert("Favor ingrese la fecha de finalizacion.");history.go(-1);</script>');
}

$sql = $sql1.$sql2;

$theBank = array();
$queryBank = "select id, name from banks";
$resultBank = mysqli_query($con, $queryBank);
while($rowBank=mysqli_fetch_array($resultBank)){
	$theBank[$rowBank['id']] = $rowBank['name'];
}

$query = "select payments.*, times.today as thisToday from payments inner join times on payments.id = times.payment where times.stage = '13'$sql";    
$result = mysqli_query($con, $query);  
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){ 
	
	$ben_name = "";
	$ben_type = "";
		
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select currency.pre from currency where id = '$row[currency]'"));
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
	
	$queryschedule = "select schedule.id, schedule.code,  schedule.bank, schedule.thebank, schedule.thebank2 from schedule inner join schedulecontent on schedule.id = schedulecontent.schedule where schedulecontent.payment = '$row[id]'";
	$resultschedule = mysqli_query($con, $queryschedule);
	$rowschedule = mysqli_fetch_array($resultschedule);

	
	if($row['ppe1'] == 0){
		$thisProvision = 'Normal';
	}elseif($row['ppe1'] == 1){
		$thisProvision = 'Pendiente E1';
	}elseif($row['ppe1'] == 2){
		$thisProvision = 'Completo E1';
	}
	
	$thisBank = $theBank[$rowschedule['bank']];
	
	$querycompany = "select name from companies where id = '$row[company]'";
	$resultcompany = mysqli_query($con, $querycompany);
	$rowcompany = mysqli_fetch_array($resultcompany);
	$company = $rowcompany['name'];
	
	$thisDay =  date('d-m-Y',strtotime($row['thisToday']));
	

    $sheet->setCellValue('A'.$xlsRow, $thisDay);
	$sheet->setCellValue('B'.$xlsRow, $rowschedule['id']);
	$sheet->setCellValue('C'.$xlsRow, $rowschedule['code']);
	$sheet->setCellValue('D'.$xlsRow, $row['id']);
	$sheet->setCellValue('E'.$xlsRow, getBeneficiary($row['id'],'min'));
	$sheet->setCellValue('F'.$xlsRow, $row['payment']);
	$sheet->setCellValue('G'.$xlsRow, $rowcurrency['pre']);
	$sheet->setCellValue('H'.$xlsRow, $thisProvision);
	$sheet->setCellValue('I'.$xlsRow, $company);
	$sheet->setCellValue('J'.$xlsRow, $thisBank); 
	
	#$objPHPExcel->getActiveSheet()->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$sheet->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode('#,##0.00');   
	$xlsRow++;
	
} 

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reportePendientesCancelacion.xlsx"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');

// Save the spreadsheet to the output stream (PHP will prompt the file download)
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Terminate script execution to avoid further output
exit;

?> 