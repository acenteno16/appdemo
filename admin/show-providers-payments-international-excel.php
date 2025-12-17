<?php
/*
$now = date('Y-m-d');

include('../connection.php');

$sql = "";

$from = $_POST['from'];
$sql1 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql1 = " and times.today >= '$from'";
}

$to = $_POST['to'];
$sql2 = "";
if($to != ""){ 
	$to = date("Y-m-d", strtotime($to));
	$sql2 = " and times.today <= '$to'"; 
	
} 

$type = $_POST['type'];
$sql3 = "";
if($type > 0){
	switch($type){
		case 1:
		$type_value = 1;
		case 2:
		$type_value = 0;
		break;
	}
	$sql3 = " and international = '$type_value'";
}

$sql = $sql1.$sql2;

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

//Include PHPExcel 
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()
			->setCreator("MultiTech Labs")
			->setLastModifiedBy("MultiTech Labs")
			->setTitle("GetPay")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Test result file");

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Rango:')
			->setCellValue('B1', $from)
			->setCellValue('C1', $to)
			->setCellValue('A2', 'Proveedor')
			->setCellValue('B2', 'Internacional')
			->setCellValue('C2', 'Cantidad de Facturas')
            ->setCellValue('D2', 'Monto Pagado en NIO')
			->setCellValue('E2', 'Monto Pagado en USD')
			->setCellValue('F2', 'Monto Pagado en EUR')
            ->setCellValue('G2', 'Monto Pagado en YEN'); 



$i = 0;

$query = "select payments.id, payments.provider, payments.payment, payments.currency from payments inner join times on payments.id = times.payment where payments.btype = '1' and times.stage = '14'".$sql." group by payments.id"; 
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){ 

	$querybills = "select id from bills where payment = '$row[0]'";
	$resultbills = mysqli_query($con, $querybills);
	$numbills = mysqli_num_rows($resultbills);
	
	$providers[$i] = "$row[1]";
	$provider_bills[$row[1]]+= $numbills;
	$provider_amount[$row[1]][$row[3]]+= $row[2];
	
	$i++;
	
}


$providers = array_unique($providers);
$providers = array_filter($providers);

$xlsRow = 3;

for($c=0;$c<sizeof($providers);$c++){ 
	
	
	if($providers[$c] > 0){
	//Desde aqui
	$query_providers = "select code, name, international from providers where id = '$providers[$c]'";
	$result_providers = mysqli_query($con, $query_providers);
	$row_providers = mysqli_fetch_array($result_providers);
	$the_provider = $row_providers['code']." | ".$row_providers['name'];
	$international = $row_providers['international'];
	
	switch($international){
		case 0:
		$the_international = "Nacional";
		break;
		case 1:
		$the_international = "Internacional";
		break;
	}
	
	$bills_qq = $provider_bills[$providers[$c]];
	
	//Miscellaneous glyphs, UTF-8 
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $the_provider)
				->setCellValue('B'.$xlsRow, $the_international)
				->setCellValue('C'.$xlsRow, $bills_qq)
				->setCellValue('D'.$xlsRow, $provider_amount[$providers[$c]][1])
				->setCellValue('E'.$xlsRow, $provider_amount[$providers[$c]][2])
				->setCellValue('F'.$xlsRow, $provider_amount[$providers[$c]][3])
				->setCellValue('G'.$xlsRow, $provider_amount[$providers[$c]][4]); 
	
	$objPHPExcel->getActiveSheet()
				->getStyle('D'.$xlsRow)
				->getNumberFormat()
				->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$objPHPExcel->getActiveSheet()
				->getStyle('E'.$xlsRow)
				->getNumberFormat()
				->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$objPHPExcel->getActiveSheet()
				->getStyle('F'.$xlsRow)
				->getNumberFormat()
				->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$objPHPExcel->getActiveSheet()
				->getStyle('G'.$xlsRow)
				->getNumberFormat()
				->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			
	$xlsRow++; 
	
	}

}

//Hasta aqui


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="proveedores-nac-internac.xlsx"');
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

*/ ?>
