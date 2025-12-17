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
$today = date('Y-m-d'); 
$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$company = $_GET['type'];
$from = $_GET['from'];
$to = $_GET['to'];

$sqldatea = 0;

$sqlfrom = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sqlfrom = " and times.today >= '$from'";
	$sqldatea = 1;
}
$sqlto = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sqlto = " and times.today <= '$to'";
	$sqldatea = 1;
}

$sqldate = $sqlfrom.$sqlto;

/*switch($company){ 
	case 0:
	$sql1 = " and payments.currency = '1'";
	$currency = 1;
	break;
	case 1:
	$sql1 = " and payments.currency = '2'";
	$currency = 2;
	break;
	case 2:
	$sql1 = " and payments.currency = '3'";
	$currency = 3;
	break;
	case 3:
	$sql1 = " and payments.currency = '4'";
	$currency = 4;
	break;
	case 4:
	$sql1 = " and payments.currency = '1' and payments.company  = '1'";
	$currency = 1;
	break;
	case 5:
	$sql1 = " and payments.currency = '2' and payments.company  = '1'";
	$currency = 2;
	break;
	case 6:
	$sql1 = " and payments.currency = '3' and payments.company  = '1'";
	$currency = 3;
	break;
	case 7:
	$sql1 = " and payments.currency = '4' and payments.company  = '1'";
	$currency = 4;
	break;
	case 8:
	$sql1 = " and payments.currency = '1' and payments.company  = '2'";
	$currency = 1;
	break;
	case 9:
	$sql1 = " and payments.currency = '2' and payments.company  = '2'";
	$currency = 2;
	break;
	case 10:
	$sql1 = " and payments.currency = '3' and payments.company  = '2'";
	$currency = 3;
	break;
	case 11:
	$sql1 = " and payments.currency = '4' and payments.company  = '2'";
	$currency = 4;
	break;
	case 12:
	$sql1 = " and payments.currency = '1' and payments.company  = '3'";
	$currency = 1;
	break;
	case 13:
	$sql1 = " and payments.currency = '2' and payments.company  = '3'";
	$currency = 2;
	break;
	case 14:
	$sql1 = " and payments.currency = '3' and payments.company  = '3'";
	$currency = 3;
	break;
	case 15:
	$sql1 = " and payments.currency = '4' and payments.company  = '3'";
	$currency = 4;
	break;
	case 16:
	$sql1 = " and payments.currency = '1' and payments.company  > '3'";
	$currency = 1;
	break;
	case 17:
	$sql1 = " and payments.currency = '2' and payments.company  > '3'";
	$currency = 2;
	break;
	case 18:
	$sql1 = " and payments.currency = '3' and payments.company  > '3'";
	$currency = 3;
	break;
	case 19:
	$sql1 = " and payments.currency = '4' and payments.company  > '3'";
	$currency = 4;
	break; 
}*/

$sql1 = "";

$sql2 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql2 = " and times.today >= '$from'";
}
$sql3 = "";
if($to != ""){ 
	$to = date("Y-m-d", strtotime($to));
	$sql3 = " and times.today <= '$to'";
}

$sql = $sql1.$sql2.$sql3;

$xlsRow = 2; 
//$query = "select bills.ammount, bills.currency, bills.nioammount, payments.provider, payments.currency, bills.type, bills.concept, bills.concept2 from bills inner join payments on bills.payment = payments.id inner join times on times.payment = bills.payment where payments.btype = '1' and times.stage = '14'".$sql; 

	
	/*
	//Si el pago es en cordobas y la moneda de la factura es Cordobas
	if(($row[4] == 1) and ($row[1] == 1)){
		$arr[$provider][$concept.','.$category]+=$row[2];	
	}
	//Si el pago es en cordobas y la moneda de la factura es en dolares
	elseif(($row[4] == 1) and ($row[1] == 2)){
		$arr[$provider][$concept.','.$category]+=$row[2];	
	}
	*/
	
//}

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Código Proveedor')
            ->setCellValue('B1', 'Nombre Proveedor')
            ->setCellValue('C1', 'Unidad')
            ->setCellValue('D1', 'Monto CS')
			->setCellValue('E1', 'Monto US')
			->setCellValue('F1', 'Compartido')
			->setCellValue('G1', 'Unidad'); 

$query = "select provider, route from payments where btype = '1' and ((route = '1006') or (route = '1011') or (route = '1046') or (route = '27')) group by provider";   
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$query_provider = "select * from providers where id = '$row[provider]'"; 
	$result_provider = mysqli_query($con, $query_provider);
	$row_provider = mysqli_fetch_array($result_provider);
	
	$the_provider_code = $row_provider['code'];
	$the_provider_name = $row_provider['name'];
	
	$units = "";
	$query2 = "select route from payments where btype = '1' and route != '1006' and route != '1011' and route != '1046' and route != '27' and provider = '$row[provider]' group by route";     
	$result2 = mysqli_query($con, $query2);
	$num2 = mysqli_num_rows($result2);
	while($row2=mysqli_fetch_array($result2)){
		$units.=$row2['route'].', ';
	}
	
	if($num2 == 0){ $shared = 'No'; }else{ $shared = 'Si'; } 
	
	$nioammount = 0;
	$usdammount = 0;
	
	$query3 = "select currency, ammount from payments where btype = '1' and ((route = '1006') or (route = '1011') or (route = '1046') or (route = '27')) and provider = '$row[provider]'";   
	$result3 = mysqli_query($con, $query3);
	$num3 = mysqli_num_rows($result3);
	while($row3=mysqli_fetch_array($result3)){
		if($row3['currency'] == 1){
			$nioammount+=$row3['ammount'];
		}elseif($row3['currency'] == 2){
			$usdammount+=$row3['ammount'];
		}
	}
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $the_provider_code)
				->setCellValue('B'.$xlsRow, $the_provider_name)
				->setCellValue('C'.$xlsRow, $row['route'])
				->setCellValue('D'.$xlsRow, $nioammount)
				->setCellValue('E'.$xlsRow, $usdammount)
				->setCellValue('F'.$xlsRow, $shared)
				->setCellValue('G'.$xlsRow, $units);
	
	$objPHPExcel->getActiveSheet()->getStyle('H'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++; 
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="PMI-categorizado.xlsx"');
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
