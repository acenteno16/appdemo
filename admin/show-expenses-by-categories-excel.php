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
            ->setCellValue('A1', 'IDS')
			->setCellValue('B1', 'Factura')
			->setCellValue('C1', 'Beneficiario')
            ->setCellValue('D1', 'Fecha Solicitud')
			->setCellValue('E1', 'Fecha Provision')
			->setCellValue('F1', 'Fecha Cancelacion')
            ->setCellValue('G1', 'Moneda')
            ->setCellValue('H1', 'Monto que Graba IVA')
			->setCellValue('I1', 'Monto excento de IVA')
			->setCellValue('J1', 'IVA')
			->setCellValue('K1', 'INTUR')
			->setCellValue('L1', 'Sub Total')
			->setCellValue('M1', 'Exento IMI')
			->setCellValue('N1', 'Exento IR')
			->setCellValue('O1', 'Base para retencion')
			->setCellValue('P1', 'Retencion IMI C$')
			->setCellValue('Q1', 'Retencion IR C$')
			->setCellValue('R1', 'Monto Pagar')
			->setCellValue('S1', 'Solicitante')
			->setCellValue('T1', 'Descripcion')
			->setCellValue('U1', 'Compañía')
			->setCellValue('V1', 'UN'); 

$xlsRow = 2;
$sql = $_GET['sql'];
$query = "select bills.number, bills.niobillpayment, times.today, payments.btype, payments.provider, payments.collaborator, payments.id, payments.description, payments.company, payments.route, payments.userid, bills.stotal, bills.stotal2, bills.currency, bills.exempt, bills.exempt2, bills.ret1a, bills.ret2a, bills.tax, bills.inturammount, bills.tc from bills inner join times on bills.payment = times.payment inner join payments on payments.id = bills.payment where times.stage > '13' and payments.approved = '1'".$sql." order by times.today desc";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){ 

if($row[3] == 1){
	//Providers
	$query_providers = "select * from providers where id = '$row[4]'";
	$result_providers = mysqli_query($con, $query_providers);
	$row_providers = mysqli_fetch_array($result_providers);
	
	$ben = $row_providers['code']." | ".$row_providers['name'];
}
elseif($row[3] == 2){
	//Collaborators
	$query_providers = "select * from workers where id = '$row[5]'";
	$result_providers = mysqli_query($con, $query_providers);
	$row_providers = mysqli_fetch_array($result_providers);
	
	$ben = $row_providers['code']." | ".$row_providers['first']." ".$row_providers['last']; 
}

$stotal1 = $row[11];
$stotal2 = $row[12];
$tax = $row[18];
$intur = $row[19];
$stotal = $stotal1+$stotal2+$tax+$intur;
$tc = $row[20];
$eimi = $row[14];
$eir = $row[15];

$rimi = $row[16];
$rir = $row[17];
$base = $stotal+$stotal2;

if($row[13] == 2){
	$rimi = $rimi/$tc;
	$rir = $rir/$tc; 
}

$tpagar = $stotal-$rimi-$rir;

$query_currency = "select name from currency where id = '$row[13]'";
$result_currency = mysqli_query($con, $query_currency);
$row_currency = mysqli_fetch_array($result_currency);
$the_currency = $row_currency['name'];

$query_drequest = "select today from times where stage = '1.00' and payment = '$row[6]'";
$result_drequest = mysqli_query($con, $query_drequest);
$row_drequest = mysqli_fetch_array($result_drequest);

$query_dprovision = "select today from times where stage = '8.00' and payment = '$row[6]'";
$result_dprovision = mysqli_query($con, $query_dprovision);
$row_dprovision = mysqli_fetch_array($result_dprovision);

$d_request =  date("d-m-Y", strtotime($row_drequest[0]));
$d_provision =  date("d-m-Y", strtotime($row_dprovision[0]));
$d_cancelation =  date("d-m-Y", strtotime($row[2]));

$query_request = "select code, first, last from workers where code = '$row[10]'";
$result_request = mysqli_query($con, $query_request);
$row_request = mysqli_fetch_array($result_request);
$requester = $row_request['code']." | ".$row_request['first']." ".$row_request['last'];

$query_company = "select name from companies where id = '$row[8]'"; 
$result_company = mysqli_query($con, $query_company);
$row_company = mysqli_fetch_array($result_company);
$the_company = $row_company['name'];

// Miscellaneous glyphs, UTF-8 
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$xlsRow, $row[6])
			->setCellValue('B'.$xlsRow, $row[0])
			->setCellValue('C'.$xlsRow, $ben)
			->setCellValue('D'.$xlsRow, $d_request)
			->setCellValue('E'.$xlsRow, $d_provision)
			->setCellValue('F'.$xlsRow, $d_cancelation)
			->setCellValue('G'.$xlsRow, $the_currency)
			->setCellValue('H'.$xlsRow, $stotal1) //Monto que graba IVA
			->setCellValue('I'.$xlsRow, $stotal2) //Monto excento de IVA
			->setCellValue('J'.$xlsRow, $tax) //IVA
			->setCellValue('K'.$xlsRow, $intur) //INTUR
			->setCellValue('L'.$xlsRow, $stotal) //Sub Total
			->setCellValue('M'.$xlsRow, $eimi) //Excento IMI
			->setCellValue('N'.$xlsRow, $eir) //Excento IR
			->setCellValue('O'.$xlsRow, $base) //Base para la retecnion
			->setCellValue('P'.$xlsRow, $rimi)
			->setCellValue('Q'.$xlsRow, $rir)
			->setCellValue('R'.$xlsRow, $tpagar)
			->setCellValue('S'.$xlsRow, $requester) 
			->setCellValue('T'.$xlsRow, $row[7]) 
			->setCellValue('U'.$xlsRow, $the_company)
			->setCellValue('V'.$xlsRow, $row[9]); 
	
$objPHPExcel->getActiveSheet()
			->getStyle('H'.$xlsRow)
			->getNumberFormat()
			->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$xlsRow++;

}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="gastos-por-categorias.xlsx"');
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
