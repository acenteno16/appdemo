<?php 

//show-payments-requested-export.php

session_start();

if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active')){ 
	include("../connection.php");
	}else{
		session_destroy();
		header("location: ../?err=noadmin,nofinancemanager,noretentionmanager");	 
}

//include('functions.php');

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

$query = "select payments.id, times.today, times.userid, payments.route, payments.parent, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client from payments inner join times on payments.id = times.payment where payments.approved != '2' and times.stage = '8'".$sql." order by payments.expiration desc";
$result = mysqli_query($con, $query); 
//echo '<br>Num: '.$num = mysqli_num_rows($result);


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
            ->setCellValue('A1', 'IDS')
			->setCellValue('B1', 'Beneficiario')
            ->setCellValue('C1', 'Fecha de Provision')
			->setCellValue('D1', 'UN')
			->setCellValue('E1', 'Provisionador'); 
          
while($row=mysqli_fetch_array($result)){

	//$queryunit = "select * from units where code = '$row[route]' or code2 = '$row[route]'";
	//$resultunit = mysqli_query($con, $queryunit);
	//$rowunit = mysqli_fetch_array($resultunit);
	
	$billdate = date("d-m-Y", strtotime($row[1]));
	
	$queryuser = "select * from workers where code = '$row[2]'";
	$resultuser = mysqli_query($con, $queryuser);
	$rowuser = mysqli_fetch_array($resultuser);
	$username = $rowuser['first']." ".$rowuser['last'];
	
	switch($row['btype']){
		case 1:
		//Provider
		$queryben = "select code, name from providers where id = '$row[provider]'";
		$resultben = mysqli_query($con, $queryben);
		$rowben = mysqli_fetch_array($resultben);
		$ben_name = $rowben['code']." | ".$rowben['name'];
		break;
		case 2:
		//Colaborador
		$queryben = "select code, first, last from workers where id = '$row[collaborator]'";
		$resultben = mysqli_query($con, $queryben);
		$rowben = mysqli_fetch_array($resultben);
		$ben_name = $rowben['code']." | ".$rowben['first']." ".$rowben['last'];
		break;
		case 3:
		//intern
		$queryben = "select first, last from workers where code = '$row[intern]'";
		$resultben = mysqli_query($con, $queryben);
		$rowben = mysqli_fetch_array($resultben);
		$ben_name = $row['intern']." | ".$rowben['first']." ".$rowben['last'];
		break;
		case 4:
		//CLIENT
		$queryben = "select type, code, first, last, name from clients where code = '$row[client]'";
		$resultben = mysqli_query($con, $queryben);
		$rowben = mysqli_fetch_array($resultben);
		if($rowben['type'] == 1){
			$ben_name = $rowben['code']." | ".$rowben['first']." ".$rowben['last'];
		}else{
			$ben_name = $rowben['code']." | ".$rowben['name']; 
		}
		
		break;
	}
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $row[0])
				->setCellValue('B'.$xlsRow, $ben_name)
				->setCellValue('C'.$xlsRow, $billdate)
				->setCellValue('D'.$xlsRow, $row[3])
				->setCellValue('E'.$xlsRow, $username);
	
	//$objPHPExcel->getActiveSheet()->getStyle('E'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++; 
	
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="cantidad-de-provisiones.xlsx"');
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