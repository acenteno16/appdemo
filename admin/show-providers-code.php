<?php 

session_start();
if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active')){ 
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
$sqldate = $sqlfrom.$sqlto;

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '#')
			->setCellValue('B1', 'Codigo Proveedor')
			->setCellValue('C1', 'Nombre Proveedor')
            ->setCellValue('D1', 'RUC Proveedor')
			->setCellValue('E1', 'Rubro')
			->setCellValue('F1', 'Ciudad')
			->setCellValue('G1', 'Pais')
			->setCellValue('H1', 'Actualizado')
			->setCellValue('I1', 'VIP')
			->setCellValue('J1', 'Internacional')
			->setCellValue('K1', 'Moneda de pago')
			->setCellValue('L1', 'Pagos en Curso')
			->setCellValue('M1', 'Nombre Contacto')
			->setCellValue('N1', 'Cargo Contacto')
			->setCellValue('O1', 'Telefono Contacto')
			->setCellValue('P1', 'Email Contacto')
			->setCellValue('Q1', 'Nombre Contacto')
			->setCellValue('R1', 'Cargo Contacto')
			->setCellValue('S1', 'Telefono Contacto')
			->setCellValue('T1', 'Email Contacto')
			->setCellValue('U1', 'Nombre Contacto')
			->setCellValue('V1', 'Cargo Contacto')
			->setCellValue('W1', 'Telefono Contacto')
			->setCellValue('X1', 'Email Contacto')
			->setCellValue('Y1', 'Nombre Contacto')
			->setCellValue('Z1', 'Cargo Contacto')
			->setCellValue('AA1', 'Telefono Contacto')
			->setCellValue('AB1', 'Email Contacto');

$theposition = 1;
 
$querypresidentprovider2 = "select * from providers order by id";
$resultpresidentprovider2 = mysqli_query($con, $querypresidentprovider2);
while($rowpresidentprovider2 = mysqli_fetch_array($resultpresidentprovider2)){   
	
	$the_provider_code = $rowpresidentprovider2['code'];
	$the_provider_name = $rowpresidentprovider2['name'];
	$the_provider_ruc = $rowpresidentprovider2['ruc']; 
		
	if($rowpresidentprovider2['updated'] == 0){
		$is_updated = "No";
	}else{
		$is_updated = "Si"; 
	}	
	if($rowpresidentprovider2['flag'] == 0){
		$is_vip = "No";
	}else{
		$is_vip = "Si"; 
	}	
	switch($rowpresidentprovider2['international']){
		case 0:
		$international = "No";
		break;
		case 1:
		$international = "Si";
		break;
	}	
	switch($rowpresidentprovider2['currency']){
		case 1:
		$currency = "Cordobas";
		break;
		case 2:
		$currency = "Dolares";
		break;
	}
	
	$query_payments = "select id from payments where provider = '$rowpresidentprovider2[id]' and approved != '2' and status < '14'";
	$result_payments = mysqli_query($con, $query_payments);
	$num_payments = mysqli_num_rows($result_payments);


	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $theposition)
				->setCellValue('B'.$xlsRow, $the_provider_code)
				->setCellValue('C'.$xlsRow, $the_provider_name)
				->setCellValue('D'.$xlsRow, $the_provider_ruc)
				->setCellValue('E'.$xlsRow, $rowpresidentprovider2['course'])
				->setCellValue('F'.$xlsRow, $rowpresidentprovider2['city'])
				->setCellValue('G'.$xlsRow, $rowpresidentprovider2['country'])
				->setCellValue('H'.$xlsRow, $is_updated)
				->setCellValue('I'.$xlsRow, $is_vip)
				->setCellValue('J'.$xlsRow, $international)
				->setCellValue('K'.$xlsRow, $currency)
				->setCellValue('L'.$xlsRow, $num_payments);
	
	$column = explode(',','M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AB,AC,AD,AE,AF,AG,AH,AI,AJ,AK');
	$inc = 0;
	$query_pcontact = "select * from providerscontacts where provider = '$rowpresidentprovider2[id]' limit 4";
	$result_pcontact = mysqli_query($con, $query_pcontact);
	while($row_pcontact=mysqli_fetch_array($result_pcontact)){
		
		// Miscellaneous glyphs, UTF-8
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($column[$inc++].$xlsRow, $row_pcontact['cname'])
					->setCellValue($column[$inc++].$xlsRow, $row_pcontact['cjob'])
					->setCellValue($column[$inc++].$xlsRow, $row_pcontact['cphone'])
					->setCellValue($column[$inc++].$xlsRow, $row_pcontact['cemail']);
	}
	
	$objPHPExcel->getActiveSheet()->getStyle('E'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$xlsRow++; 

}

$objPHPExcel->getActiveSheet()->setTitle('Simple');
$objPHPExcel->setActiveSheetIndex(0);

$now = date('Y-m-d');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte-Proveedores-'.$now.'.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>