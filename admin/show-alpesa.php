<? 

include('../connection.php');

/*
$query = "select * from providers where name like '%almacenadora pellas%'";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
    $ids.= $row['id'].","; 
    echo '<br>'.$row['id']." | ".$row['name'];
}

echo $ids;

-817279 | Aduanera Y Almacenadora Pellas S.a/alpesa
-365891 | Aduanera Y Almacenadora Pellas S.a/alpesa
-236591 | Aduanera Y Almacenadora Pellas S.a/alpesa
-236700 | Aduanera Y Almacenadora Pellas S.a/alpesa
-236603 | Aduanera Y Almacenadora Pellas S.a/alpesa
-236611 | Aduanera Y Almacenadora Pellas S.a/alpesa
-236620 | Aduanera Y Almacenadora Pellas S.a/alpesa
-236689 | Aduanera Y Almacenadora Pellas S.a/alpesa
-370124 | Aduanera Y Almacenadora Pellas S.a/alpesa
-236852 | Aduanera Y Almacenadora Pellas S.a/alpesa
-236582 | Aduanera Y Almacenadora Pellas S.a/alpesa
-2157792 | ADUANERA Y ALMACENADORA PELLAS S.A. / ALPESA
-236662 | ADUANERA Y ALMACENADORA PELLAS S.A. / ALPESA
-2114655 | Aduanera Y Almacenadora Pellas S.a/alpesa

By ID
516,1937,1938,1964,1939,1998,1997,2137,2175,2296,2297,2474,2483,2747,
516,1937,1938,1964,1939,1998,1997,2137,2175,2296,2297,2474,2483,2687,2747,2847,2848,2849,2850,2851,2852,3192

*/

$idStr = "516,1937,1938,1964,1939,1998,1997,2137,2175,2296,2297,2474,2483,2687,2747,2847,2848,2849,2850,2851,2852,3192";
$idrets = explode(',',$idStr);
for($i=0;$i<sizeof($idrets);$i++){
    if($i == 0){
        $str.=" and (";
    }else{
        $str.= " or ";
    }
    $str.="(payments.provider = '$idrets[$i]')";
    
    if($i==(sizeof($idrets)-1)){
        $str.=")"; 
    }
}

$today= date('Y-m-d');
$queryret = "select irretention.id from irretention inner join payments on irretention.payment = payments.id where irretention.id > '0' and irretention.today >= '2018-01-01' and irretention.today <= '$today'".$str."";
$resultret0 = mysqli_query($con, $queryret);
$numret = mysqli_num_rows($resultret);

$now = date('Y-m-d'); 

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

#Include PHPExcel
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
            ->setCellValue('A1', 'No RUC') 
            ->setCellValue('B1', 'Nombres y Apellidos o Razon Social')
            ->setCellValue('C1', 'Ingresos Brutos Mensuales')
            ->setCellValue('D1', 'Valor Cotizacion INSS')
			->setCellValue('E1', 'Valor Fondo Pensiondes de Ahorro')
			->setCellValue('F1', 'Número de Documento')
			->setCellValue('G1', 'Fecha de Documento')
			->setCellValue('H1', 'Base Imponible')
			->setCellValue('I1', 'Valor Retenido')
			->setCellValue('J1', 'Alicuota de Retención')
			->setCellValue('K1', 'Código de Retención')
			->setCellValue('L1', 'Número de Retención')
			->setCellValue('M1', 'ID de Solicitud')
			->setCellValue('N1', 'Anulada')
			->setCellValue('O1', 'Unidad')
			->setCellValue('P1', 'Batch');

$xlsRow = 2;

while($rowret0=mysqli_fetch_array($resultret0)){

	$queryret = "select * from irretention where id = '$rowret0[id]'";
  	$resultret = mysqli_query($con, $queryret);
  	$rowret = mysqli_fetch_array($resultret);
	
	$query = "select * from payments where id = '$rowret[payment]'";
	$result = mysqli_query($con, $query);
	$row=mysqli_fetch_array($result);
	
	$acp = $row['acp2'];
	$today = $row['today'];
	$ruc = ""; 
	if($row['btype'] == 1){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
		$provider = $rowprovider['name'];
		$ruc = $rowprovider['ruc'];
		
	}
	else{
		$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'")); 
		$provider = $rowcollaborator['first']." ".$rowcollaborator['last'];
		$ruc = $rowcollaborator['nid'];
	}
	
	$billnumbers = "";
	$querybills = "select * from bills where payment = '$row[id]' and ret2a > '0'"; 
	$resultbills = mysqli_query($con, $querybills);
	$billdate = "";
	$totalbills = 0;
	$totalrets = 0;
	$billstotal = 0;
	  
	while($rowbills=mysqli_fetch_array($resultbills)){
		  
	  $billnumber = $rowbills['number'];
	  $billdate = date('d/m/Y',strtotime($rowbills['billdate']));
		  
	  if($rowbills['ret2a'] > 0){
		$billstotal = ($rowbills['stotal']+$rowbills['stotal2']-$rowbills['exempt'])*$rowbills['tc'];
		if(($acp == 1) and ($rowbills['dtype'] == 7)){  
				  
			$percentage = $rowbills['ret2']/100;
			$percentage2 = (100-$rowbills['ret2'])/100;
			$basepr = (($billstotal*$percentage)/$percentage2)+$billstotal;
				   
		}else{
			$basepr = $billstotal;  
		}
			  
		$billstotal = $basepr; 
		$totalbills = $billstotal;
		$totalrets = $rowbills['ret2a'];  
	  }
	   
		switch($rowbills['ret2']){
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
			$base_imponible = number_format($totalbills,2);
			$valor_retenido = $totalrets; 
			$anulada = "No";
	 	}
		  
		switch($rowbills['ret2']){
			case 2:
			$retcode = 22;
			break;
			case 12:
			$retcode = 511;
			break;
			case 10:
			$retcode = 27;
			break;
			case 15:
			$retcode = 528;
			break;
            case 20:
            $retcode = 47;
            break;
		 
		} 
		  
	$batchs = "";
	$querybatch = "select * from batch where payment = '$row[id]'";
	$resultbatch = mysqli_query($con, $querybatch);
	while($rowbatch = mysqli_fetch_array($resultbatch)){
		$batchs.=$rowbatch['nobatch'].', '; 
	}
	$batchs = substr($batchs, 0, -2);
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
            	->setCellValue('A'.$xlsRow, cleanString($ruc))
            	->setCellValue('B'.$xlsRow, cleanString($provider))
				->setCellValue('C'.$xlsRow, '')
				->setCellValue('D'.$xlsRow, '')
				->setCellValue('E'.$xlsRow, '')
				->setCellValue('F'.$xlsRow, $billnumber)
				->setCellValue('G'.$xlsRow, $billdate)
				->setCellValue('H'.$xlsRow, $base_imponible)
				->setCellValue('I'.$xlsRow, $valor_retenido)
				->setCellValue('J'.$xlsRow, $row['ret2'])
				->setCellValue('K'.$xlsRow, $retcode)
				->setCellValue('L'.$xlsRow, $rowret['number'])
				->setCellValue('M'.$xlsRow, $rowret['payment'])
				->setCellValue('N'.$xlsRow, $anulada)
				->setCellValue('O'.$xlsRow, $row['route']." ".$rowroute['name'])
				->setCellValue('P'.$xlsRow, $batchs);
	
	$objPHPExcel->getActiveSheet()->getStyle('H'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$objPHPExcel->getActiveSheet()->getStyle('I'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++;

}
	
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte-de-retenciones-alpesa.xlsx"');
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

?>