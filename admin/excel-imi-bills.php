<?php

#exit();
#set_time_limit(0);

if(!isset($_SESSION)){ 
	session_start();  
}

if(($_SESSION["generalsession"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['spellas'] == "active")){
	include("../connection.php"); 
	//include('fn-logout.php');
}else{
	if(isset($_SESSION)){ 
		session_destroy();
	}
	header("location: ../?err=nosession_sessions");	  
} 

$now = date('Y-m-d'); 
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli') die('This example should only be run from a Web Browser');
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()
            ->setCreator("MultiTech Labs")
			->setLastModifiedBy("MultiTech Labs")
			->setTitle("GetPay")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Test result file");

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No RUC') 
            ->setCellValue('B1', 'Codigo')
			->setCellValue('C1', 'Nombres y Apellidos o Razon Social')
            ->setCellValue('D1', 'Ingresos Brutos Mensuales')
            ->setCellValue('E1', 'Valor Cotizacion INSS')
			->setCellValue('F1', 'Valor Fondo Pensiondes de Ahorro')
			->setCellValue('G1', 'Número de Documento')
			->setCellValue('H1', 'Fecha de Documento')
			->setCellValue('I1', 'Base Imponible')
			->setCellValue('J1', 'Valor Retenido')
			->setCellValue('K1', 'Alicuota de Retención')
			->setCellValue('L1', 'Código de Retención')
			->setCellValue('M1', 'Número de Retención')
			->setCellValue('N1', 'ID de Solicitud')
			->setCellValue('O1', 'Anulada')
			->setCellValue('P1', 'Unidad')
			->setCellValue('Q1', 'Batch')
			->setCellValue('R1', 'Serie')
			->setCellValue('S1', 'Municipalidad');

$xlsRow = 2;


$thisProvider = array();
$thisUnit = array();
$thisHall = array();
$paymentArr = array();

$id = $_POST['theid']; 
$idsize = sizeof($id);
for($r0=0;$r0<$idsize;$r0++){
	
	#retentionData
	$queryret = "select payment, number, serial, void, billsid from hallsretention where id = '$id[$r0]'";
  	$resultret = mysqli_query($con, $queryret);
  	$rowret = mysqli_fetch_array($resultret);
	
	#paymentData
	$query = "select acp, today, btype, provider, collaborator, id, ret1, routeid, hall from payments where id = '$rowret[payment]'";
	$result = mysqli_query($con, $query);
	$row=mysqli_fetch_array($result);
	
	#providerData
	if($thisProvider[$row['provider']] == ''){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select name, code, ruc from providers where id = '$row[provider]'"));
		$thisProvider[$row['provider']] = $rowprovider['name'];
		$thisProviderRuc[$row['provider']] = $rowprovider['ruc'];
		$thisProviderCode[$row['provider']] = $rowprovider['code'];
	}
	
	#unitData
	if($thisUnit[$row['routeid']] == ''){
		
		$queryUnit = "select code, name, newCode, companyName, lineName, locationName from units where id = '$row[routeid]'";
		$resultUnit = mysqli_query($con, $queryUnit);
		$rowUnit = mysqli_fetch_array($resultUnit);
									
		$thisUnit[$row['routeid']] = $rowUnit['newCode'].' | '.$rowUnit['companyName'].' '.$rowUnit['lineName'].' '.$rowUnit['locationName']; 
	}
	
	#hallData
	if($thisHall[$row['hall']] == ''){ 
		$queryhallss = "select name from halls where id = '$row[hall]'";
		$resulthallss = mysqli_query($con, $queryhallss);
		$rowhallss=mysqli_fetch_array($resulthallss);
		$thisHall[$row['hall']] = $rowhallss['name'];
			
	}

	$bills = $rowret['billsid'];
	$bills_arr = explode(',',$bills);
	$sql = "";
	for($ib=0;$ib<sizeof($bills_arr);$ib++){ 
		if($ib == 0){
			$sql.= " and ((id = '$bills_arr[$ib]')";
		}else{
			$sql.= " or (id = '$bills_arr[$ib]')";
		}
		if($ib+1 == sizeof($bills_arr)){
			$sql.= ")";
		}
	} 
	  
	$billnumbers = "";
	$querybills = "select number, billdate, ret1a, stotal, stotal2, exempt, tc, dtype, ret1 from bills where payment = '$row[id]' and ret1a > '0'$sql";
	$resultbills = mysqli_query($con, $querybills);
	$billdate = "";
	$totalbills = 0;
	$totalrets = 0;
	$billstotal = 0;
	  
	while($rowbills=mysqli_fetch_array($resultbills)){
		  
	  $billnumber = $rowbills['number'];
	  $billdate = date('d/m/Y',strtotime($rowbills['billdate']));
		  
	  if($rowbills['ret1a'] > 0){
		$billstotal = ($rowbills['stotal']+$rowbills['stotal2']-$rowbills['exempt'])*$rowbills['tc'];
		if(($acp == 1) and ($rowbills['dtype'] == 7)){  
				  
			$percentage = $rowbills['ret1']/100;
			$percentage2 = (100-$rowbills['ret1'])/100;
			$basepr = (($billstotal*$percentage)/$percentage2)+$billstotal;
		
				   
		}else{
			$basepr = $billstotal;  
			
		}
			  
		$billstotal = $basepr; 
		$totalbills = $billstotal;
		$totalrets = $rowbills['ret1a'];  
	  }
	  switch($rowbills['ret1']){
		case 2:
		$retcode = 22;
		break;
		case 7:
		$retcode = 511;
		break;
		case 10:
		$retcode = 27;
		break;
		case 15:
		$retcode = 528;
		break;
		 
	} 
		  
	  if($rowret['void'] == 1){
		  $base_imponible = 0.00;
		  $valor_retenido = 0.00; 
		  $anulada = "Si";
		}else{
			//No 
			$base_imponible = $totalbills;
			$valor_retenido = $totalrets; 
			$anulada = "No";
	 	}
		   
		  
	$batchs = "";
	$querybatch = "select nobatch from batch where payment = '$row[id]'";
	$resultbatch = mysqli_query($con, $querybatch);
	while($rowbatch = mysqli_fetch_array($resultbatch)){
		$batchs.=$rowbatch['nobatch'].', '; 
	}
	$batchs = substr($batchs, 0, -2);
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
            	->setCellValue('A'.$xlsRow, cleanString($thisProviderRuc[$row['provider']]))
            	->setCellValue('B'.$xlsRow, cleanString($thisProviderCode[$row['provider']]))
				->setCellValue('C'.$xlsRow, cleanString($thisProvider[$row['provider']]))
				->setCellValue('D'.$xlsRow, '')
				->setCellValue('E'.$xlsRow, '')
				->setCellValue('F'.$xlsRow, '')
				->setCellValue('G'.$xlsRow, $billnumber)
				->setCellValue('H'.$xlsRow, $billdate)
				->setCellValue('I'.$xlsRow, $base_imponible)
				->setCellValue('J'.$xlsRow, $valor_retenido)
				->setCellValue('K'.$xlsRow, $row['ret1'])
				->setCellValue('L'.$xlsRow, $retcode)
				->setCellValue('M'.$xlsRow, $rowret['number'])
				->setCellValue('N'.$xlsRow, $rowret['payment'])
				->setCellValue('O'.$xlsRow, $anulada)
				->setCellValue('P'.$xlsRow, $thisUnit[$row['routeid']])
				->setCellValue('Q'.$xlsRow, $batchs)
				->setCellValue('R'.$xlsRow, $rowret['serial'])
				->setCellValue('S'.$xlsRow, $thisHall[$row['hall']])
				->setCellValue('T'.$xlsRow, 'B'.$basepr);
	
	$objPHPExcel->getActiveSheet()->getStyle('I'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$objPHPExcel->getActiveSheet()->getStyle('J'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++;

	}
		
	
	
	ob_flush(); 
    flush(); 
	
	
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte-de-retenciones.xlsx"');
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

function cleanString($string){ 
	
	return $result = preg_replace("/[^A-Za-z0-9?![:space:]]/", "", $string);
	
}
