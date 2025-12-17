<?php 

exit();

session_start();

if($_SESSION['email'] == 'jairovargasg@gmail.com'){ 
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noadmin,nofinancemanager,noretentionmanager");	 
}

$now = date('Y-m-d'); 

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("MultiTech Labs")
							 ->setLastModifiedBy("MultiTech Labs")
							 ->setTitle("GetPay")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$xlsRow = 2;
$today = date('Y-m-d'); 
$from = '2021-11-1';
$to  = '2021-11-30';  

$xlsRow = 2;
$query = "select payments.id, payments.route, payments.currency, payments.btype, payments.provider, payments.collaborator, payments.payment from payments inner join times on payments.id = times.payment where payments.status = '14' and payments.approved != '3' and times.today >= '$from' and times.today <= '$to' order by payments.expiration desc"; 
$query = "select payments.* from payments inner join times on payments.id = times.payment where payments.status = '14' and times.stage = '14' and times.today >= '$from' and times.today <= '$to' and payments.approved = '1' group by payments.id order by payments.expiration desc"; 
$result = mysqli_query($con, $query);   
$num = mysqli_num_rows($result);

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IDS')
			->setCellValue('B1', 'UN')
            ->setCellValue('C1', 'Compania')
			->setCellValue('D1', 'Moneda')
			->setCellValue('E1', 'Monto')
			->setCellValue('F1', 'Proveedor/Colaborador');
         

while($row=mysqli_fetch_array($result)){

	$queryunit = "select * from units where code = '$row[route]' or code2 = '$row[route]'";
	$resultunit = mysqli_query($con, $queryunit);
	$rowunit = mysqli_fetch_array($resultunit);
								
	$unit = $row['route']." | ".$rowunit['name'];
	
	$querycompany = "select name from companies where id = '$row[company]'";
	$resultcompany = mysqli_query($con, $querycompany);
	$rowcompany = mysqli_fetch_array($resultcompany);
		
	
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
	
	if($row['btype'] == 1){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
		$provider = $rowprovider['code']." | ".$rowprovider['name'];
	}else{
		$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
		$provider = $rowcollaborator['code']." | ".$rowcollaborator['first']." ".$rowcollaborator['last'];
	}

	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $row['id'])
				->setCellValue('B'.$xlsRow, $unit)
				->setCellValue('C'.$xlsRow, $rowcompany['name'])
				->setCellValue('D'.$xlsRow, $rowcurrency['pre'])
				->setCellValue('E'.$xlsRow, $row['payment'])
				->setCellValue('F'.$xlsRow, $provider); 
	
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
header('Content-Disposition: attachment;filename="Nov-2021.xlsx"');
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