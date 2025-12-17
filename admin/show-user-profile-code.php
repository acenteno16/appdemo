<?php

require('config.php');

session_start();

if(($_SESSION["user_report"] == "active") or ($_SESSION["admin"] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=nouserreportsOrAdmin");	 
}

include('online.php');

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
            ->setCellValue('A1', 'Codigo')
			->setCellValue('B1', 'Nombre')
			->setCellValue('C1', 'Rol')
            ->setCellValue('D1', 'Activo')
			->setCellValue('E1', 'Ruta');  

$type = $_GET['type'];
$sql = " and (type = 1) or (type = 5)";
if($type > 0){
    $sql = " and type = '$type'";
}

$xlsRow = 2;

$query = "select worker, type, unitid from routes where id > 0$sql";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){ 
    
    $queryUser = "select first, last, code, active from workers where code = '$row[worker]'";
    $resultUser = mysqli_query($con, $queryUser);
    $rowUser = mysqli_fetch_array($resultUser);
	
	$queryUnit = "select code, name, newCode, companyName, lineName, locationName from units where id = '$row[unitid]'";
    $resultUnit = mysqli_query($con, $queryUnit);
    $numUnit = mysqli_num_rows($resultUnit);
	if($numUnit > 0){
		$rowUnit = mysqli_fetch_array($resultUnit);
		if($rowUnit['newCode'] == 0){
			$thisRoute = "[ANTIGUA] $rowUnit[code] | $rowUnit[name]";
		}else{
			$thisRoute = $rowUnit['newCode'].' | '.$rowUnit['companyName'].' '.$rowUnit['lineName'].' '.$rowUnit['locationName'];
		}
		
	}else{
		$thisRoute = '-';
	}
	

    switch($row['type']){
        case 1:
            $thisRole = "Solicitante";
            break;
        case 5:
            $thisRole = "Provisionador";
            break;
    }
	if($rowUser['active'] == 1){
		$thisActive = 'Si';
	}else{
		$thisActive = 'No'; 
	}
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				//IDS 
				->setCellValue('A'.$xlsRow, $rowUser['code']) //ok
				//Client type
				->setCellValue('B'.$xlsRow, $rowUser['first'].' '.$rowUser['last'])
				//Client Code and Name 
				->setCellValue('C'.$xlsRow, $thisRole) //ok
				//Company
				->setCellValue('D'.$xlsRow, $thisActive)
				//Active
				->setCellValue('E'.$xlsRow, $thisRoute);
				
				#$objPHPExcel->getActiveSheet()->getStyle('L'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
				
				$xlsRow++;
				
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte-perfiles-de-usuario.xlsx"');
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