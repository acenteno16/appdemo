<?php

#http://192.168.1.193/admin/report-provisions-by-range.php
if(!isset($_SESSION)){ 
	session_start(); 
}

if(($_SESSION["generalsession"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['spellas'] == "active")){
	include("../connection.php"); 
}else{
	if(isset($_SESSION)){ 
		session_destroy();
	}
	header("location: ../?err=nosession_sessions");	  
} 

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


//$objPHPExcel->getActiveSheet()->freezePane('P1');
$objPHPExcel->getActiveSheet()->freezePane('A2');

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IDS')
			->setCellValue('B1', 'Beneficiario')
			->setCellValue('C1', 'Moneda')
			->setCellValue('D1', 'Monto')
			->setCellValue('E1', 'Usuario')
			->setCellValue('F1', 'Fecha');  

$xlsRow = 2;


$query = "select payments.id, payments.payment, payments.currency, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, times.today, times.userid as makerid from payments inner join times on payments.id = times.payment where (times.stage = '8' or times.stage = '8.05') and times.today >= '2021-10-01' and times.today <= '2021-11-30' and ((times.userid = '32646') or (times.userid = '3510782'))";   
$result = mysqli_query($con, $query);  
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){

		
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select pre from currency where id = '$row[currency]'"));
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
		$queryprovider = "select code, first, last from cliets where id = '$row[client]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
		$ben_type = "Cliente";
		break;
	}
	

				
	$queryUser = "select first, last from workers where code = '$row[makerid]'"; 
	$resultUser = mysqli_query($con, $queryUser);
	$rowUser = mysqli_fetch_array($resultUser);
				
	$thisUser = $rowUser['first'].' '.$rowUser['last'];

	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
            	->setCellValue('A'.$xlsRow, $row['id'])
				->setCellValue('B'.$xlsRow, $ben_name)
				->setCellValue('C'.$xlsRow, $rowcurrency[pre])
				->setCellValue('D'.$xlsRow, $row[payment])
				->setCellValue('E'.$xlsRow, $thisUser) 
				->setCellValue('F'.$xlsRow, $row['today']); 
	
	$objPHPExcel->getActiveSheet()->getStyle('D'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++;
	
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="provisiones-noviembre.xlsx"');
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

?>