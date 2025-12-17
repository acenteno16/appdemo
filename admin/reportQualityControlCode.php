<?php

$now = date('Y-m-d'); 

session_start();
if(($_SESSION['admin'] == 'active')){ 
	include("../connection.php"); 
}else{
	session_destroy();
	header("location: ../?err=noPaymentsReport");  	 
}	

$sql = '';
$from = $_POST[ 'from' ];
$to = $_POST[ 'to' ];

if(($from == '')){
	$err++;
	$errStr.= '-Debe de seleccionar una fecha de inicio.\n';
}
if(($to == '')){
	$err++;
	$errStr.= '-Debe de seleccionar una fecha de finalización.\n';
}
if(($from != '') and ($to != '')){
	$from = date("Y-m-d", strtotime($from));
	$to = date("Y-m-d", strtotime($to));
    
	
	$fecha = date($from);
	$nuevafecha = strtotime ( '+12 month' , strtotime ( $fecha ) ) ;
	$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
	if($nuevafecha <= $to){ 
		$errStr.='Periodo maximo de 1 año';
		$err++;
	}
}

if($err > 0){
	exit('<script>alert("Err.\n'.$errStr.'"); window.location = "reportRefunds.php";</script>');
}

require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("MultiTech Labs")
							 ->setLastModifiedBy("MultiTech Labs")
							 ->setTitle("GetPay")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Proveedor')
            ->setCellValue('C1', 'Compania')
            ->setCellValue('D1', 'Monto')
			->setCellValue('E1', 'Moneda')
			->setCellValue('F1', 'Fecha Cancelacion')
            ->setCellValue('G1', 'Descripcion');

$xlsRow = 2;

#currency
$theCurrency = array();
$querycurrency = "select id, name from currency";
$resultcurrency = mysqli_query($con, $querycurrency);
while($rowcurrency=mysqli_fetch_array($resultcurrency)){
    $theCurrency[$rowcurrency['id']] = $rowcurrency['name'];
}
#companies
$theCompany = array();    
$querycompany = "select id, name from companies";
$resultcompany = mysqli_query($con, $querycompany);
while($rowcompany = mysqli_fetch_array($resultcompany)){
    $theCompany[$rowcompany['id']] = $rowcompany['name'];
}  

$thisSeller = array();
$thisProvider = array();

$query = "SELECT 
    payments.id, 
    payments.btype, 
    payments.provider, 
    payments.client, 
    payments.currency, 
    payments.userid, 
    payments.payment, 
    payments.company, 
    payments.description 
FROM payments 
INNER JOIN times ON payments.id = times.payment 
WHERE 
    times.stage = '14' 
    AND times.today >= '$from' 
    AND times.today <= '$to'
    AND payments.id NOT IN (
        SELECT DISTINCT payment 
        FROM times 
        WHERE stage = '8.03'
    )
GROUP BY payments.id 
ORDER BY payments.id DESC;
"; 
$result = mysqli_query($con, $query); 
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
    
    
    #providers
    if($row['btype'] == 1){
       
	   if($thisProvider[$row['provider']] == ""){
        $queryProvider = "select code, name from providers where id = '$row[provider]'";
    	$resultProvider = mysqli_query($con, $queryProvider);
		$rowProvider = mysqli_fetch_array($resultProvider);
        
        $thisProviderCode[$row['provider']] = $rowProvider['code']; 
        $thisProvider[$row['provider']] = $rowProvider['name']; 
		
	   }
        
        $benCode = $thisProviderCode[$row['provider']];
        $benName = $thisProvider[$row['provider']];
        
    }
    else{
        #clients
	if($thisClient[$row['client']] == ""){
        $queryUser = "select type, code, first, last, name from clients where code = '$row[client]'";
    	$resultUser = mysqli_query($con, $queryUser);
		$rowUser = mysqli_fetch_array($resultUser);
		if($rowUser['type'] == 1){
			$thisClientCode[$row['client']] = $rowUser['code']; 
            $thisClient[$row['client']] = $rowUser['first'].' '.$rowUser['last']; 
		}else{
			$thisClientCode[$row['client']] = $rowUser['code']; 
            $thisClient[$row['client']] = $rowUser['name']; 
		}
	   }
        
        $benCode = $thisClientCode[$row['client']];
        $benName = $thisClient[$row['client']];
        
    }
	
    //Fecha de Cancelación						
	$queryCancellation = "select today from times where payment = '$row[id]' and stage = '14' order by id desc limit 1"; 
	$resultCancellation = mysqli_query($con, $queryCancellation);
    $rowCancellation=mysqli_fetch_array($resultCancellation);
    
	// Miscellaneous glyphs, UTF-8
    $objPHPExcel->setActiveSheetIndex(0)
            	->setCellValue('A'.$xlsRow, $row['id'])
            	->setCellValue('B'.$xlsRow, $benCode.' | '.$benName)
				->setCellValue('C'.$xlsRow, $theCompany[$row['company']])
				->setCellValue('D'.$xlsRow, $row['payment'])
				->setCellValue('E'.$xlsRow, $theCurrency[$row['currency']])
				->setCellValue('F'.$xlsRow, $rowCancellation['today'])
				->setCellValue('G'.$xlsRow, $row['description']);  
    
	$objPHPExcel->getActiveSheet()->getStyle('D'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++;

}

$objPHPExcel->getActiveSheet()->setTitle('Simple');
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteDevoluciones.xlsx"'); 
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