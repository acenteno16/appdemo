<?php

include("../connection.php");

$now = date('Y-m-d'); 

$provider = $_POST['provider'];
$from = $_POST['from'];
$to = $_POST['to'];
$route = $_POST['route'];
$company = $_POST['company'];

$sql = "";

$sql1 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql1 = " and times.today >= '$from'";
	$param++;
}else{
	echo "<script>alert('Debe de seleccionar inicio del periodo.');history.go(-1);</script>";
	exit();
}

$sql2 = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sql2 = " and times.today <= '$to'";
	$param++;
}else{
	echo "<script>alert('Debe de seleccionar fin del periodo.');history.go(-1);</script>";
	exit();
}

$sql3 = "";
if($route != ""){
	$sql3 = " and payments.route = '$route'";
}

$sql4 = "";
if($company != ""){
	$sql4 = " and payments.company = '$company'";
}

$sql5 = "";
if($provider != ""){
	$sql5 = " and payments.provider = '$provider'";
}else{
	echo "<script>alert('Debe de seleccionar proveedor.');history.go(-1);</script>";
	exit();
}

$fecha = date($from);
$nuevafecha = strtotime ( '+12 month' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

if($nuevafecha <= $to){ 
	echo "<script>alert('Periodo maximo de 3 meses.');history.go(-1);</script>";
	exit();
}

$sql = $sql1.$sql2.$sql3.$sql4.$sql5;

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
            ->setCellValue('A1', 'IDS')
            ->setCellValue('B1', 'Compañía')
            ->setCellValue('C1', 'UN')
            ->setCellValue('D1', 'Fecha')
			->setCellValue('E1', 'CKPK')
			->setCellValue('F1', 'No. Documento')
			->setCellValue('G1', 'Monto')
			->setCellValue('H1', 'Moneda')
			->setCellValue('I1', 'TC')
			->setCellValue('J1', 'Exento IMI')
			->setCellValue('K1', 'Base IMI C$')
			->setCellValue('L1', 'Alicuota IMI %')
			->setCellValue('M1', 'Monto Ret. IMI C$')
			->setCellValue('N1', 'No. Ret. IMI')
			->setCellValue('O1', 'Exento IR')
			->setCellValue('P1', 'Base IR C$')
			->setCellValue('Q1', 'Alicuota IR %')
			->setCellValue('R1', 'Monto Retenido IR C$')
			->setCellValue('S1', 'No. Ret IR')
			->setCellValue('T1', 'Batch')
			->setCellValue('U1', 'Documentos');


$xlsRow = 2;


$query = "select payments.company, payments.id, payments.route, payments.provider, bills.number, bills.stotal, bills.stotal2, bills.exempt2, bills.exempt, bills.ret1a, bills.ret2a, bills.currency, payments.cnumber, bills.tc, bills.tax, bills.ret1, bills.ret2 from bills inner join payments on bills.payment = payments.id inner join times on times.payment = bills.payment where times.stage = '14'".$sql; 
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);			
while($row=mysqli_fetch_array($result)){
	
	$rowcompany = mysqli_fetch_array(mysqli_query($con, "select name from companies where id = '$row[0]'"));
	$company = $rowcompany['name']; 
	
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select code, name from providers where id = '$row[3]'"));
	$ben_code = $rowprovider['code'];
	$ben_name = $rowprovider['name'];
	
	//Base
	$base_imi = ($row[5]+$row[6]-$row[7])*$row[13];
	$base_ir = ($row[5]+$row[6]-$row[8])*$row[13];
	
	$ret_imi = str_replace(',','',number_format($base_imi*($row[15]/100),2));
	$ret_ir = str_replace(',','',number_format($base_ir*($row[16]/100),2));
	
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select name from currency where id = '$row[11]'"));
	$currencyname = $rowcurrency['name'];
	
	$query_rettoday = "select today from irretention where payment = '$row[1]' and void = '0'";
	$result_rettoday = mysqli_query($con, $query_rettoday);
	$row_rettoday = mysqli_fetch_array($result_rettoday);
	$rettoday = date('d-m-Y', strtotime($row_rettoday[0]));
	
	
	//GET IMI NUMBER
	
	$queryretention = "select number, serial from hallsretention where payment = '$row[1]'"; 
	$resultretention = mysqli_query($con, $queryretention);
	$numretention = mysqli_num_rows($resultretention);
	if($numretention > 0){
		$rowretention = mysqli_fetch_array($resultretention);
		$number = str_pad((int) $rowretention['number'],4,"0",STR_PAD_LEFT); 
	  	$imi_no = $rowretention['serial']."-".$number;
	}else{
		$imi_no = "NA";
	}
	
	//GET IR NUMBER
	$ir_no = "";
	$queryret = "select number from irretention where payment = '$row[1]'";
  	$resultret = mysqli_query($con, $queryret);
  	while($rowret = mysqli_fetch_array($resultret)){
		$ir_no_formated = str_pad((int) $rowret['number'],4,"0",STR_PAD_LEFT);
		$ir_no.= $ir_no_formated.", ";
	}
	
	$ir_no = substr($ir_no, 0, -2);
	
	$documents = "";
	$querydocs = "select number from bills where payment = '$row[1]'";
  	$resultdocs = mysqli_query($con, $querydocs);
  	while($rowdocs = mysqli_fetch_array($resultdocs)){
		$documents.= $rowdocs['number'].", ";
	}
	$documents = substr($documents, 0, -2);
	
	$batch = "";
	$bdocuments = "";
	$querybatch = "select * from batch where payment = '$row[1]'";
  	$resultbatch = mysqli_query($con, $querybatch);
  	while($rowbatch = mysqli_fetch_array($resultbatch)){
		
		$batch.= $rowbatch["nobatch"]." <=> ";
		$bdocuments.= $rowbatch['nodocument']." <=> ";
	}
	$batch = substr($batch, 0, -4);
	$bdocuments = substr($bdocuments, 0, -4);
	
	
	$amount = "-";
	$a = "";
		// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				//IDS 
				->setCellValue('A'.$xlsRow, $row[1])
				//Company
				->setCellValue('B'.$xlsRow, $company)
				//UN
				->setCellValue('C'.$xlsRow, $row[2])
				//Fecha
				->setCellValue('D'.$xlsRow, $rettoday)
				//CKPK 
				->setCellValue('E'.$xlsRow, $row[12])
				//No Documento
				->setCellValue('F'.$xlsRow, $row[4])
				//Monto
				->setCellValue('G'.$xlsRow, $row[6])
				//Moneda
				->setCellValue('H'.$xlsRow, $currencyname)
				//TC
				->setCellValue('I'.$xlsRow, $row[13])
				//Exento IMI
				->setCellValue('J'.$xlsRow, $row[7])
				//Base IMI
				->setCellValue('K'.$xlsRow, $base_imi)
				//Alicuota IMI
				->setCellValue('L'.$xlsRow, $row[15])
				//Monto Retenido IMI
				->setCellValue('M'.$xlsRow, $ret_imi)
				//No. Ret IMI
				->setCellValue('N'.$xlsRow, $imi_no)
				//Exento IR
				->setCellValue('O'.$xlsRow, $row[8])
				//Base IR
				->setCellValue('P'.$xlsRow, $base_ir)
				//Alicuota IR
				->setCellValue('Q'.$xlsRow, $row[16])
				//Monto Retenido IR
				->setCellValue('R'.$xlsRow, $ret_ir)
				//No Ret IR
				->setCellValue('S'.$xlsRow, $ir_no)
				//Documentos
				->setCellValue('T'.$xlsRow, $batch)
				//Documentos
				->setCellValue('U'.$xlsRow, $bdocuments);

	$xlsRow++;
		
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte-pagos-a-proveedores.xlsx"');
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
