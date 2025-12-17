<?php

$now = date('Y-m-d'); 
include('../connection.php');

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("MultiTech Labs")
							 ->setLastModifiedBy("MultiTech Labs")
							 ->setTitle("GetPay")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$xlsRow = 2;

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Compañía')
            ->setCellValue('B1', 'Proveedor')
            ->setCellValue('C1', 'ID')
            ->setCellValue('D1', 'Documentos')
			->setCellValue('E1', 'Ingreso a Banco')
			->setCellValue('F1', 'IR')
			->setCellValue('G1', 'Monto IR')
			->setCellValue('H1', 'IDG');  



$query = "select payments.id, payments.ret2a, payments.ret2, times.today, payments.company, payments.provider from payments inner join times on payments.id = times.payment where payments.ret2a > '0' and payments.ret2id = '0' and payments.status >= '13' and times.stage = '13' order by payments.company"; 
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){


$queryschedule = "select * from schedulecontent where payment = '$row[id]'";
	$resultschedule = mysqli_query($con, $queryschedule);
	$rowschedule = mysqli_fetch_array($resultschedule);
	
	$querycompany = "select name from companies where id = '$row[company]'";
	$resultcompany = mysqli_query($con, $querycompany);
	$rowcompany = mysqli_fetch_array($resultcompany);
	$companyname = $rowcompany['name'];
	
	$queryprovider = "select name from providers where id = '$row[provider]'";
	$resultprovider = mysqli_query($con, $queryprovider);
	$rowprovider = mysqli_fetch_array($resultprovider);
	$providername = $rowprovider['name'];
	
	$documents = "";
	$querydocuments = "select * from bills where payment = '$row[id]'";
	$resultdocuments = mysqli_query($con, $querydocuments);
	while($rowdocuments = mysqli_fetch_array($resultdocuments)){
		$documents.=$rowdocuments['number'].', '; 
	}
	
	
		// Miscellaneous glyphs, UTF-8
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $companyname)
				->setCellValue('B'.$xlsRow, $providername)
				->setCellValue('C'.$xlsRow, $row['id'])
				->setCellValue('D'.$xlsRow, $documents)
				->setCellValue('E'.$xlsRow, $row['today'])
				->setCellValue('F'.$xlsRow, $row['ret2'])
				->setCellValue('G'.$xlsRow, $row['ret2a'])
				->setCellValue('H'.$xlsRow, $rowschedule['schedule']);
	
		$objPHPExcel->getActiveSheet()->getStyle('G'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

		$xlsRow++; 
	}
		


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="casos-retenciones-160.xlsx"'); 
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
