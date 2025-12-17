<?php 

//show-payments-requested-export.php

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

$xlsRow = 2;
$today = date('Y-m-d');
$from = $_POST['from'];
$to = $_POST['to'];
$company = $_POST['company'];

$nodates = 0;

$sql1 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql1 = " and times.today >= '$from'";
}else{
	echo "<script>alert('Debe de seleccionar inicio del periodo.');history.go(-1);</script>";
	exit();
}
	
$sql2 = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sql2 = " and times.today <= '$to'";
}else{
	echo "<script>alert('Debe de seleccionar fin del periodo.');history.go(-1);</script>";
	exit();
}

//3 MONTH VALIDATION
$fecha = date($from);
$nuevafecha = strtotime ( '+3 month' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

if($nuevafecha <= $to){ 
	echo "<script>alert('Periodo maximo de 3 meses.');history.go(-1);</script>";
	exit();
} 

$sql3 = "";
if($company != ""){
	$sql3 = " and payments.company = '$company'";
}

$sql = $sql1.$sql2.$sql3;

$inner = $inner1;

$xlsRow = 2; 

//$query = "select id from payments inner join ";
//$result = mysqli_query($con, $query);
//echo "Num: ".$num = mysqli_num_rows($result);

$query = "select payments.route, count(payments.id) as numids from payments inner join times on payments.id = times.payment where payments.approved != '2' and times.stage = '1'".$sql." group by payments.route order by count(payments.id) desc";
$result = mysqli_query($con, $query); 

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');


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
            ->setCellValue('A1', 'Codigo')
			->setCellValue('B1', 'Nombre')
            ->setCellValue('C1', 'Cantidad de Solicitudes');
          
while($row=mysqli_fetch_array($result)){

	$queryunit = "select * from units where code = '$row[route]' or code2 = '$row[route]'";
	$resultunit = mysqli_query($con, $queryunit);
	$rowunit = mysqli_fetch_array($resultunit);
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $row['route'])
				->setCellValue('B'.$xlsRow, $rowunit['name'])
				->setCellValue('C'.$xlsRow, $row['numids']); 
	
	//$objPHPExcel->getActiveSheet()->getStyle('E'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++; 
	
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="cantidad-de-solicitudes.xlsx"');
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