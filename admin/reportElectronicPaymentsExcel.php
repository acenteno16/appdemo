<?php

#error_reporting(E_ALL);
#ini_set('display_errors', TRUE);
#ini_set('display_startup_errors', TRUE);

session_start();

if(($_SESSION["reportElectronicPayments"] == "active") or ($_SESSION['admin'] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=no_reportElectronicPayments");	 
}

$today = date('Y-m-d'); 
$sql = $_POST['sql'];
$join = $_POST['join'];

require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("MultiTech Labs")
							 ->setLastModifiedBy("MultiTech Labs")
							 ->setTitle("GetPay")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Ingreso a Banco')
            ->setCellValue('B1', 'GID')
			->setCellValue('C1', 'WID')
			->setCellValue('D1', 'IDS')
            ->setCellValue('E1', 'Beneficiario')
			->setCellValue('F1', 'Monto')
			->setCellValue('G1', 'Moneda')
			->setCellValue('H1', 'Compañia')
			->setCellValue('I1', 'Banco')
            ->setCellValue('J1', 'PK')
            ->setCellValue('K1', 'Referencia');


$xlsRow = 2; 

$theBank = array();
$queryBank = "select id, name from banks";
$resultBank = mysqli_query($con, $queryBank);
while($rowBank=mysqli_fetch_array($resultBank)){
	$theBank[$rowBank['id']] = $rowBank['name'];
}

$theCurrency = array();
$queryCurrency = "select id, pre from currency";
$resultCurrency = mysqli_query($con, $queryCurrency);
while($rowCurrency=mysqli_fetch_array($resultCurrency)){
	$theCurrency[$rowCurrency['id']] = $rowCurrency['pre'];
}

$theCompany = array();
$queryCompany = "select id, name from companies";
$resultCompany = mysqli_query($con, $queryCompany);
while($rowCompany=mysqli_fetch_array($resultCompany)){
	$theCompany[$rowCompany['id']] = $rowCompany['name'];
}

$query = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.currency, payments.payment, payments.company, payments.cnumber, payments.reference from payments$join where payments.status >= '14'$sql group by payments.id order by payments.id desc";   
$result = mysqli_query($con, $query);  
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){  
	
	$ben_name = "";
	$ben_type = "";
    
	$row13 = mysqli_fetch_array(mysqli_query($con, "select today from times where payment = '$row[id]' and stage = '13' order by id desc limit 1"));
		
	
	$international = "No";
	switch($row['btype']){
		case 1:
		$queryprovider = "select code, name, international from providers where id = '$row[provider]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		if($rowprovider['international'] == 1){
			$international = "Si";
		}
		$ben_name = $rowprovider['code']." | ".$rowprovider['name'];
		$ben_type = "Proveedor";
		break;
		case 2:
		$queryprovider = "select code, first, last from workers where id = '$row[collaborator]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
		$ben_type = "Colaborador";
		break;
		case 3:
		$queryprovider = "select code, first, last from interns where code = '$row[intern]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$ben_name = "$rowprovider[code] | $rowprovider[first] $rowprovider[first2] $rowprovider[last] $rowprovider[last2]";
		$ben_type = "Pasante";
		break;
		case 4:
		$queryprovider = "select type, code, first, last, name from clients where code = '$row[client]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider); 
		if($rowprovider['type'] == 1){
			$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
		}else{
			$ben_name = $rowprovider['code']." | ".$rowprovider['name'];
		}
		
		$ben_type = "Cliente";
		break;
	}
	
	$queryschedule = "select schedule.id, schedule.code, schedule.bank, schedule.thebank, schedule.thebank2 from schedule inner join schedulecontent on schedule.id = schedulecontent.schedule where schedulecontent.payment = '$row[id]'";
	$resultschedule = mysqli_query($con, $queryschedule);
	$rowschedule = mysqli_fetch_array($resultschedule);

    $thisDay =  date('d-m-Y',strtotime($row13['today']));
	
	$objPHPExcel->setActiveSheetIndex(0)
            	->setCellValue('A'.$xlsRow, $thisDay)
				->setCellValue('B'.$xlsRow, $rowschedule['id'])
				->setCellValue('C'.$xlsRow, $rowschedule['code'])
				->setCellValue('D'.$xlsRow, $row['id'])
				->setCellValue('E'.$xlsRow, $ben_name)
				->setCellValue('F'.$xlsRow, $row['payment'])
				->setCellValue('G'.$xlsRow, $theCurrency[$row['currency']])
				->setCellValue('H'.$xlsRow, $theCompany[$row['company']])
				->setCellValue('I'.$xlsRow, $theBank[$rowschedule['bank']])
                ->setCellValue('J'.$xlsRow, $row['cnumber'])
                ->setCellValue('K'.$xlsRow, $row['reference']);
	
	$objPHPExcel->getActiveSheet()->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++;
	
} 

$objPHPExcel->getActiveSheet()->setTitle('Reporte');
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reportePendientesCancelacion.xlsx"');
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