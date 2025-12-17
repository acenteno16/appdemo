<?php

##ini_set('display_errors', '1');
#ini_set('display_startup_errors', '1');
#error_reporting(E_ALL);

include("session-user-report.php"); 

/*
function stageInfo($id, $stage){
    
    
    $queryDate = "select today from times where stage = '$stage' and payment = '$id'";
    $resultDate = mysqli_query($con, $queryDate);
    $rowDate = mysqli_fetch_array($resultDate);
    
    #return $rowDate['today'];
    $a = "";
    return $a; 
    
}

/*
#Load currencies
$queryCurrency = "select id, name from currecy";
$resultCurrency = mysqli_query($con, $queryCurrency);
while($rowCurrency = mysqli_fetch_array($resultCurrency)){
    
    $thisCurrency[$rowCurrency['id']] = $rowCurrency['name'];

}
*/

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
#$objPHPExcel->getActiveSheet()->freezePane('A2');

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IDS')
			->setCellValue('B1', 'Fecha de Solicitud')
			->setCellValue('C1', 'Solicitante')
            ->setCellValue('D1', 'No. de Documento')
            ->setCellValue('E1', 'Fecha de Recibido')
            ->setCellValue('F1', 'Fecha de Factura')
            ->setCellValue('G1', 'Concepto')
            ->setCellValue('H1', 'Descripción')
            ->setCellValue('I1', 'Subtotal')
            ->setCellValue('J1', 'Compañia')
            ->setCellValue('K1', 'UN')
            ->setCellValue('L1', 'Beneficiario')
            ->setCellValue('M1', 'Monto')
            ->setCellValue('N1', 'Moneda')
            ->sNtCellValue('O1', 'Fecha de Cancelacion')
            ->setCellValue('P1', 'Banco')
            ->setCellValue('Q1', 'PK');



$type = $_GET['type'];
$sql = " and (type = 1) or (type = 5)";
if($type > 0){
    $sql = " and type = '$type'";
}

$from = '2020-08-11';
$to = '2020-08-11';
$xlsRow = 2;
$var = "";

$query = "select payments.id from payments inner join times on payments.id = times.payment where times.stage = '14' and times.today >= '$from' and times.today<= '$to'";
$result = mysqli_query($con, $query); 
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){ 
    
    #$requester = stageInfo($row['id'], 1);
    #$requestDate = stageInfo($row['id'], 1);
    #$cancellationDate = stageInfo($row['id'], 14);
    
    $queryBills = "select number from bills where payment = '$row[id]'";
    $resultBills = mysqli_query($con, $queryBills);
    while($rowBills = mysqli_fetch_array($resultBills)){
        
       
        #echo "<br>-".$row['id'].' ->'.$rowBills['number']; 
        
        
	   // Miscellaneous glyphs, UTF-8
	   $objPHPExcel->setActiveSheetIndex(0) 
				->setCellValue('A'.$xlsRow, $row['id'])
				->setCellValue('B'.$xlsRow, $requestDate)
				->setCellValue('C'.$xlsRow, $requester) 
				->setCellValue('D'.$xlsRow, $rowbills['document'])
                ->setCellValue('E'.$xlsRow, $rowBills['billdate2'])
                ->setCellValue('F'.$xlsRow, $rowBills['billdate'])
                ->setCellValue('G'.$xlsRow, $rowBills[''])
                ->setCellValue('H'.$xlsRow, $row['description'])
                ->setCellValue('I'.$xlsRow, $rowBills['stotal'])
                ->setCellValue('J'.$xlsRow, $rowBills['company'])
                ->setCellValue('K'.$xlsRow, $rowBills['route'])
                ->setCellValue('L'.$xlsRow, $beneficiary)
                ->setCellValue('M'.$xlsRow, $row['amount'])
                ->setCellValue('N'.$xlsRow, $thisCurrency[$row['currency']])
                ->setCellValue('O'.$xlsRow, $cancellationDate)
                ->setCellValue('P'.$xlsRow, $thisBank)
                ->setCellValue('Q'.$xlsRow, $row['pk']); 
				
				#$objPHPExcel->getActiveSheet()->getStyle('L'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
				
				$xlsRow++;
        
        
    }
    
    
				
}


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte-auditoria.xlsx"');
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