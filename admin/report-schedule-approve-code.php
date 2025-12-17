<?php

if(!isset($_SESSION)){ 
	session_start(); 
}

if(($_SESSION["generalsession"] == "active")){
	include("../connection.php"); 
}else{
	if(isset($_SESSION)){ 
		session_destroy();
	}
	header("location: ../?err=nosession_sessions");	  
} 

$today = "";
if(isset($_POST['today'])){
	if($_POST['today'] != ""){
		$today = $_POST['today'];
		$today = date("Y-m-d", strtotime($today));
	}
}

if($today == ""){
	echo "<script>alert('Ingrese la fecha.'); history.go(-1);</script>";
	exit(); 
}


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


//$objPHPExcel->getActiveSheet()->freezePane('P1');
$objPHPExcel->getActiveSheet()->freezePane('A2');

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IDS')
            ->setCellValue('B1', 'Tipo')
			->setCellValue('C1', 'Beneficiario')
			->setCellValue('D1', 'Internacional')
            ->setCellValue('E1', 'Tipo')
			->setCellValue('F1', 'Concepto')
			->setCellValue('G1', 'Categoria')
			->setCellValue('H1', 'Moneda')
			->setCellValue('I1', 'Monto')
			->setCellValue('J1', 'Banco')
			->setCellValue('K1', 'Compañía');  

$xlsRow = 2;

$query = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '13' and times.today = '$today'";    
$result = mysqli_query($con, $query);  
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$ben_name = "";
	$ben_type = "";
		
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select pre from currency where id = '$row[currency]'"));
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
		$queryprovider = "select code, first, last from interns where id = '$row[intern]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
		$ben_type = "Pasante";
		break;
		case 4:
		$queryprovider = "select code, first, last from cliets where id = '$row[client]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$ben_name = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
		$ben_type = "Cliente";
		break;
	}
	
	$querybank = "select name from banks where id = '$row[bank]'";
	$resultbank = mysqli_query($con, $querybank);
	$rowbank = mysqli_fetch_array($resultbank);
	$bank = $rowbank['name'];
	
	/*$queryschedule = "select banks.name from banks inner join schedule on banks.id = schedule.bank inner join schedulecontent on schedule.id = schedulecontent.schedule where schedulecontent.payment = '$row[id]'";
	$resultschedule = mysqli_query($con, $queryschedule);
	$rowschedule = mysqli_fetch_array($resultschedule);
	$schedulebank = $rowschedule['name'];*/
	
	$querybills = "select type, concept, concept2 from bills where payment = '$row[id]' limit 1";
	$resultbills = mysqli_query($con, $querybills);
	$rowbills = mysqli_fetch_array($resultbills);
	
	$querybills1 = "select name from categories where id = '$rowbills[type]'";
	$resultbills1 = mysqli_query($con, $querybills1);
	$rowbills1 = mysqli_fetch_array($resultbills1);
	
	$querybills2 = "select name from categories where id = '$rowbills[concept]'";
	$resultbills2 = mysqli_query($con, $querybills2);
	$rowbills2 = mysqli_fetch_array($resultbills2);
	
	$querybills3 = "select name from categories where id = '$rowbills[concept2]'";
	$resultbills3 = mysqli_query($con, $querybills3);
	$rowbills3 = mysqli_fetch_array($resultbills3);
	
	$querycompany = "select name from companies where id = '$row[company]'";
	$resultcompany = mysqli_query($con, $querycompany);
	$rowcompany = mysqli_fetch_array($resultcompany);
	$company = $rowcompany['name'];
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
            	->setCellValue('A'.$xlsRow, $row['id'])
				->setCellValue('B'.$xlsRow, $ben_type)
				->setCellValue('C'.$xlsRow, $ben_name)
				->setCellValue('D'.$xlsRow, $international)
				->setCellValue('E'.$xlsRow, $rowbills1['name'])
				->setCellValue('F'.$xlsRow, $rowbills2['name'])
				->setCellValue('G'.$xlsRow, $rowbills3['name'])
				->setCellValue('H'.$xlsRow, $rowcurrency[pre])
				->setCellValue('I'.$xlsRow, $row[payment])
				->setCellValue('J'.$xlsRow, $bank)
				->setCellValue('K'.$xlsRow, $company); ; 
	
	$objPHPExcel->getActiveSheet()->getStyle('I'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++;
	
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ingreso-a-banco.xlsx"');
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