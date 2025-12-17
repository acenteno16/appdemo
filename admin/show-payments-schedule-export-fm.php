<?php 

session_start();

if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active')){ 
	include("../connection.php");
	}else{
		session_destroy();
		header("location: ../?err=noadmin,nofinancemanager,noretentionmanager");	 
}

$now = date('Y-m-d'); 
$expiration = "";

$Category = array();			
$queryCategories = "select * from categories";
$resultCategories = mysqli_query($con, $queryCategories);
while($rowCategories=mysqli_fetch_array($resultCategories)){
    $Categories[$rowCategories['id']] = $rowCategories['name']; 
}


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

$query = "select * from payments where approved = '1' and sent_approve = '1' and (status = '9' or status = '13.02' or status = '13.03') order by expiration desc";    
$result = mysqli_query($con, $query);   

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IDS')
			->setCellValue('B1', 'UN')
			->setCellValue('C1', 'Moneda')
			->setCellValue('D1', 'Monto')
			->setCellValue('E1', 'Proveedor/Colaborador')
			->setCellValue('F1', 'Vencimiento')
			->setCellValue('G1', 'Compañía')
            ->setCellValue('H1', 'Tipo')
            ->setCellValue('I1', 'Concepto')
            ->setCellValue('J1', 'Categoría');

while($row=mysqli_fetch_array($result)){

	$queryunit = "select * from units where code = '$row[route]' or code2 = '$row[route]'";
	$resultunit = mysqli_query($con, $queryunit);
	$rowunit = mysqli_fetch_array($resultunit);
	$unit = $row['route']." | ".$rowunit['name'];
	
	$querycompany = "select name from companies where id = '$row[company]'";
	$resultcompany = mysqli_query($con, $querycompany);
	$rowcompany = mysqli_fetch_array($resultcompany);
	$company = $rowcompany['name'];
	
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
	
	if($row['btype'] == 1){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
		$provider = $rowprovider['code']." | ".$rowprovider['name'];
	}else{
		$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
		$provider = $rowcollaborator['code']." | ".$rowcollaborator['first']." ".$rowcollaborator['last'];
	}
	
	$expiration = date("d-m-Y", strtotime($row['expiration']));
    
    $queryBills = "select type, concept, concept2 from bills where payment = '$row[id]'";
    $resultBills = mysqli_query($con, $queryBills);
	$rowBills = mysqli_fetch_array($resultBills);
    $thisType = $Categories[$rowBills['type']];
    $thisConcept = $Categories[$rowBills['concept']];  
    $thisCategory = $Categories[$rowBills['concept2']];
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $row['id'])
				->setCellValue('B'.$xlsRow, $unit)
				->setCellValue('C'.$xlsRow, $rowcurrency['pre'])
				->setCellValue('D'.$xlsRow, $row['payment'])
				->setCellValue('E'.$xlsRow, $provider)
				->setCellValue('F'.$xlsRow, $expiration)
				->setCellValue('G'.$xlsRow, $company)
                ->setCellValue('H'.$xlsRow, $thisType)
                ->setCellValue('I'.$xlsRow, $thisConcept)
                ->setCellValue('J'.$xlsRow, $thisCategory);
				
	$objPHPExcel->getActiveSheet()->getStyle('D'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++; 

//}
	
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pendientes-de-programacion.xlsx"');
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
