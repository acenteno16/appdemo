<?php

//http://192.168.1.193/admin/report-payments-e1-code.php
exit();

$now = date('Y-m-d'); 
include('../connection.php');

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);


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
							 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Compania')
            ->setCellValue('B1', 'ID del Pago')
            ->setCellValue('C1', 'Codigo del proveedor')
            ->setCellValue('D1', 'Nombre del Proveedor')
			->setCellValue('E1', 'Factura')
			->setCellValue('F1', 'Fecha Factura')
			->setCellValue('G1', 'Monto que graba IVA')
			->setCellValue('H1', 'Monto exento de IVA')
			->setCellValue('I1', 'IVA')
			->setCellValue('J1', 'INTUR')
			->setCellValue('K1', 'SubTotal')
			->setCellValue('L1', 'Exento IMI')
			->setCellValue('M1', 'Exento IR')
			->setCellValue('N1', 'Base para retencion')
			->setCellValue('O1', 'Retenciones IR')
			->setCellValue('P1', 'Retenciones IMI')
			->setCellValue('Q1', 'Monto a pagar')
			->setCellValue('R1', 'No Batch')
			->setCellValue('S1', 'No Documento')
			->setCellValue('T1', 'No Transaccion (CKPK)')
			->setCellValue('U1', 'Moneda')
			->setCellValue('V1', 'TC'); 

$xlsRow = 2;
// 
$query = "select bills.number, bills.billdate, bills.stotal, bills.stotal2, bills.tax, bills.inturammount, bills.exempt2, bills.exempt, bills.ret1a, bills.ret2a, bills.currency, bills.tc, bills.payment from bills inner join times on times.payment = bills.payment where times.stage = '14' and times.today = '2017-12-01' limit 1";  
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);			
while($row=mysqli_fetch_array($result)){
	
	$rowpayment = mysqli_fetch_array(mysqli_query($con, "select payments.company, payments.id, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.cnumber from payments where id = '$row[12]'"));
	
	$rowcompany = mysqli_fetch_array(mysqli_query($con, "select name from companies where id = '$rowpayment[0]'"));
	$company = $rowcompany['name']; 
	
	//Ben Type
	switch($rowpayment[2]){
		case 1:
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select code, name from providers where id = '$rowpayment[3]'"));
		$ben_code = $rowprovider['code'];
		$ben_name = $rowprovider['name'];
		break;
		case 2:
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select code, first, last from workers where id = '$rowpayment[4]'"));
		$ben_code = $rowprovider['code'];
		$ben_name = $rowprovider['first'].' '.$rowprovider['last'];
		break;
		case 3:
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select code, first, last from interns where code = '$rowpayment[5]'"));
		$ben_code = $rowprovider['code'];
		$ben_name = $rowprovider['first'].' '.$rowprovider['last'];
		break;
	}
	
	//Bill info
	$billdate = date('d-m-Y', strtotime($row[0]));
	
	//Base
	//$base = $stotal-exempt2 + $stotal2-$exempt;
	$base = $row[2]+$row[3]-$row[6]-$row[7];
	$pagar = $base-$row[8]-$row[9];
	
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select name from currency where id = '$row[10]'"));
	$currencyname = $rowcurrency['name']; 
	
	$batch = "";
	$document = "";
	$querybatch = "select * from batch where payment = '$row[12]'";
	$resultbatch = mysqli_query($con, $querybatch);
	while($rowbatch=mysqli_fetch_array($resultbatch)){
		$batch.=$rowbatch['nobatch'].',';
		$document.=$rowbatch['nodocument'].','; 
	}
	
	$batch_arr = array();
	unset($batch_arr);
	$batch_arr = explode(',', $batch);
	$batch_arr = array_unique($batch_arr);
	
	$amount = "-";
		// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				//Company
				->setCellValue('A'.$xlsRow, $company)
				//IDS
				->setCellValue('B'.$xlsRow, $row[12])
				//Provider Code
				->setCellValue('C'.$xlsRow, $ben_code)
				//Provider Name
				->setCellValue('D'.$xlsRow, $ben_name)
				//No. de Factura 
				->setCellValue('E'.$xlsRow, $row[0])
				//Fecha de Factura
				->setCellValue('F'.$xlsRow, $billdate)
				//Monto que graba IVA
				->setCellValue('G'.$xlsRow, $row[2])
				//Monto Exento de IVA
				->setCellValue('H'.$xlsRow, $row[3])
				//IVA
				->setCellValue('I'.$xlsRow, $row[4])
				//INTUR
				->setCellValue('J'.$xlsRow, $row[5])
				//Sub Total
				->setCellValue('K'.$xlsRow, $row[2]+$row[3])
				//Exento de IMI
				->setCellValue('L'.$xlsRow, $row[6])
				//Exento de IR
				->setCellValue('M'.$xlsRow, $row[7])
				//Base para la retencion
				->setCellValue('N'.$xlsRow, $base)
				//Retenciones IR
				->setCellValue('O'.$xlsRow, $row[8])
				//Retenciones IMI
				->setCellValue('P'.$xlsRow, $row[9])
				//Monto a Pagar
				->setCellValue('Q'.$xlsRow, $pagar)
				//Batch
				->setCellValue('R'.$xlsRow, implode(', ',$batch_arr))
				//Documento
				->setCellValue('S'.$xlsRow, $document)
				//PK
				->setCellValue('T'.$xlsRow, $rowpayment[6])
				//Currency
				->setCellValue('U'.$xlsRow, $currencyname)
				//TC
				->setCellValue('U'.$xlsRow, $row[11]);  
	
	/* 
	$objPHPExcel->getActiveSheet()->getStyle('H'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$objPHPExcel->getActiveSheet()->getStyle('I'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$objPHPExcel->getActiveSheet()->getStyle('J'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$objPHPExcel->getActiveSheet()->getStyle('K'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$objPHPExcel->getActiveSheet()->getStyle('L'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$objPHPExcel->getActiveSheet()->getStyle('M'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$objPHPExcel->getActiveSheet()->getStyle('N'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$objPHPExcel->getActiveSheet()->getStyle('O'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$objPHPExcel->getActiveSheet()->getStyle('P'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	*/

	$xlsRow++;
		
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="report-to-e1-diciembre.xlsx"');
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
