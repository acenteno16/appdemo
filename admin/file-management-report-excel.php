<?php 

exit();

session_start();

if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION["filestorage"] == "active")){ 
	include("../connection.php");
	include('functions.php');
	}else{
		session_destroy();
		header("location: ../?err=nostorage");	 
}

$now = date('Y-m-d'); 

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
$today = date('Y-m-d'); 

$sql = $sql1.$sql2.$sql3;

$xlsRow = 2;
$query = "select payments.* from schedule inner join schedulecontent on schedule.id = schedulecontent.schedule inner join payments on schedulecontent.payment = payments.id where schedule.status = '6'"; 
$query = "select schedule.id, scheduletimes.userid, scheduletimes.today from schedule inner join scheduletimes on schedule.id = scheduletimes.schedule where schedule.status = '6' and scheduletimes.stage = '6'";
$result = mysqli_query($con, $query);   

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IDG')
			->setCellValue('B1', 'Fecha de cancelacion')
            ->setCellValue('D1', 'Cancelado por');
          

while($row=mysqli_fetch_array($result)){
	
	
							
	
	$queryroute = "select code, first, last,email from workers where code = '$row[userid]'";
	$resultroute = mysqli_query($con, $queryroute);  
	$rowroute = mysqli_fetch_array($resultroute);
	$contadores=$rowroute['code'].' | '.$rowroute['first']." ".$rowroute['last']; 
	 
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $row['id'])
				->setCellValue('B'.$xlsRow, $row['today'])
				->setCellValue('C'.$xlsRow, $contadores); 
	
	$objPHPExcel->getActiveSheet()->getStyle('E'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++; 

//}
	
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pendientes-de-almacenamiento.xlsx"');
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
