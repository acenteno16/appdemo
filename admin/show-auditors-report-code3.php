<?php

#include("session-auditor-report.php"); 
#ini_set('memory_limit', '2048M');
include('../connection.php');

$sql1 = "";
$provider = $_GET['provider'];
if($provider != ''){
    $sql1 = " and payments.provider = '$provider'";
}
$sql2 = "";
$from = $_GET['from'];
if($from != ''){
    $from = date("Y-m-d", strtotime($from));
    $sql2 = " and times.today >= '$from'";
}else{
    exit('<script>alert("Usted debe ingresar una fecha de inicio de rango.");history.go(-1);</script>');
}
$sql3 = "";
$to = $_GET['to'];
if($to != ''){
    $to = date("Y-m-d", strtotime($to));
    $sql3 = " and times.today <= '$to'";
}else{
    exit('<script>alert("Usted debe ingresar una fecha de fin de rabgo.");history.go(-1);</script>');
}

$fecha = date($from);
if($provider != ""){
    $nuevafecha = strtotime ( '+12 month' , strtotime ( $fecha ) ) ;
    $message = "Periodo maximo de 12 mes";
}else{
    $nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
    $message = "Periodo maximo de 1 mes";
}
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

if($nuevafecha <= $to){ 
	echo "<script>alert('$message');history.go(-1);</script>";
	exit();
}
$sql4 = "";
$un = $_GET['un'];
if($un != ''){
    $sql4 = " and payments.route = '$un'";
}
$sql5 = "";
$company = $_GET['company'];
if($company != ''){
    $sql5 = " and payments.company = '$company'";
}

$sql = $sql1.$sql2.$sql3.$sql4.$sql5;

$xlsRow = 2;
$var = ""; 

$query = "select payments.id, payments.description, payments.stotal, payments.company, payments.route, payments.cnumber, payments.bank, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.userid from payments inner join times on payments.id = times.payment where times.stage = '14'".$sql; 
$result = mysqli_query($con, $query);
$thisRequester = array();
$thisBen = array();



$thisBank = array();
$queryBanks = "select id, name from banks";
$resultBanks = mysqli_query($con, $queryBanks);
while($rowBanks=mysqli_fetch_array($resultBanks)){
    
    $thisBank[$rowBanks['id']] = $rowBanks['name'];
    
}

$thisCurrency = array();
$queryCurrency = "select id, name from currency";
$resultCurrency = mysqli_query($con, $queryCurrency);
while($rowCurrency=mysqli_fetch_array($resultCurrency)){
    
    $thisCurrency[$rowCurrency['id']] = $rowCurrency['name'];
    
}

$thisCompany = array();
$queryCompany = "select id, name from companies";
$resultCompany = mysqli_query($con, $queryCompany);
while($rowCompany=mysqli_fetch_array($resultCompany)){
    
    $thisCompany[$rowCompany['id']] = $rowCompany['name'];
    
}

$thisConcept = array();
$queryConcept = "select id, name from categories where level = '2'";
$resultConcept = mysqli_query($con, $queryConcept);
while($rowConcept=mysqli_fetch_array($resultConcept)){
    
    $thisConcept[$rowConcept['id']] = $rowConcept['name'];
    
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
#$objPHPExcel->getActiveSheet()->freezePane('A2');

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IDS')
            ->setCellValue('B1', 'Fecha Solicitud')
            ->setCellValue('C1', 'Solicitante')
            ->setCellValue('D1', 'No. de Documento')
            ->setCellValue('E1', 'Fecha recibido')
            ->setCellValue('F1', 'Fecha de documento')
            ->setCellValue('G1', 'Concepto')
            ->setCellValue('H1', 'Descripcion')
            ->setCellValue('I1', 'Subtotal')
            ->setCellValue('J1', 'Compania')
            ->setCellValue('K1', 'UN')
            ->setCellValue('L1', 'Beneficiario')
            ->setCellValue('M1', 'Monto')
            ->setCellValue('N1', 'Moneda')
            ->setCellValue('O1', 'Fecha cancelacion')
            ->setCellValue('P1', 'Banco')
            ->setCellValue('Q1', 'PK');   


$xlsRow = 2;

while($row=mysqli_fetch_array($result)){ 
    
	$queryStage = "select today from times where stage = '1' and payment = '$id' order by id desc limit 1";
    $resultStage = mysqli_query($con, $queryStage);
    $rowStage = mysqli_fetch_array($resultStage);
        
    $requestDate = $rowStage['today']; 
	
    
	$queryStage2 = "select today from times where stage = '14' and payment = '$row[id]' order by id desc limit 1";
    $resultStage2 = mysqli_query($con, $queryStage2);
    $rowStage2 = mysqli_fetch_array($resultStage2);
        
    $cancellationDate = $rowStage2['today']; 
  
	$requester = '';
	if($thisRequester[$row['userid']] != ""){
		$requester = $thisRequester[$row['userid']];
	}else{
		$queryUser = "select code, first, last from workers where code = '$row[userid]'";
    	$resultUser = mysqli_query($con, $queryUser);
		$rowUser = mysqli_fetch_array($resultUser);
		$requester = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last']; 
		$thisRequester[$row['userid']] = $requester;
	}

	$beneficiary = '';
	if($row['btype'] == 1){
		#providers
		if($thisProvider[$row['provider']] != ""){
			$beneficiary = $thisProvider[$row['provider']];
		}else{
			$queryProvider = "select code, name from providers where id = '$row[provider]'";
    		$resultProvider = mysqli_query($con, $queryProvider);
			$rowProvider = mysqli_fetch_array($resultProvider);
			$beneficiary = $rowProvider['code'].' | '.$rowProvider['name']; 
			$thisProvider[$row['provider']] = $beneficiary;
		}
	}
	elseif($row['btype'] == 2){
		#workers
		if($thisRequester[$row['collaborator']] != ""){
			$beneficiary = $thisRequester[$row['collaborator']];
		}else{
			$queryUser = "select code, first, last from workers where id = '$row[collaborator]'";
    		$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);
			$beneficiary = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last']; 
			$thisRequester[$row['collaborator']] = $beneficiary;
		}
	}
	elseif($row['btype'] == 3){
		#interns
		if($thisIntern[$row['intern']] != ""){
			$beneficiary = $thisIntern[$row['intern']];
		}else{
			$queryUser = "select code, first, first2, last, last2 from interns where code = '$row[intern]'";
    		$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);
			$beneficiary = $rowUser['code'].' '.$rowUser['first'].' '.$rowUser['first2'].' '.$rowUser['last'].' '.$rowUser['last2']; 
			$thisIntern[$row['intern']] = $beneficiary;
		}
	}
	elseif($row['btype'] == 4){
		#clients
		if($thisClient[$row['client']] != ""){
			$beneficiary = $thisClient[$row['client']];
		}else{
			$queryUser = "select type, code, first, last, name from clients where code = '$row[client]'";
    		$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);
			if($rowUser['type'] == 1){
				$beneficiary = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last']; 
			}else{
				$beneficiary = $rowUser['code'].' | '.$rowUser['name']; 
			}
			
			$thisClientr[$row['client']] = $beneficiary;
		}
	}
	
    $queryBills = "select number, billdate2, billdate, ammount, currency, concept from bills where payment = '$row[id]'";
    $resultBills = mysqli_query($con, $queryBills);
    while($rowBills = mysqli_fetch_array($resultBills)){
        
        // Miscellaneous glyphs, UTF-8
	    $objPHPExcel->setActiveSheetIndex(0)
				    ->setCellValue('A'.$xlsRow, $row['id'])
                    ->setCellValue('B'.$xlsRow, $requestDate)
                    ->setCellValue('C'.$xlsRow, $requester)
                    ->setCellValue('D'.$xlsRow, $rowBills['number'])
                    ->setCellValue('E'.$xlsRow, $rowBills['billdate2'])
                    ->setCellValue('F'.$xlsRow, $rowBills['billdate'])
                    ->setCellValue('G'.$xlsRow, $thisConcept[$rowBills['concept']])
                    ->setCellValue('H'.$xlsRow, $row['description'])
                    ->setCellValue('I'.$xlsRow, $row['stotal'])
                    ->setCellValue('J'.$xlsRow, $thisCompany[$row['company']])
                    ->setCellValue('K'.$xlsRow, $row['route'])
                    ->setCellValue('L'.$xlsRow, $beneficiary)
                    ->setCellValue('M'.$xlsRow, $rowBills['ammount'])
                    ->setCellValue('N'.$xlsRow, $thisCurrency[$rowBills['currency']])
                    ->setCellValue('O'.$xlsRow, $cancellationDate)
                    ->setCellValue('P'.$xlsRow, $thisBank[$row['bank']])
                    ->setCellValue('Q'.$xlsRow, $row['cnumber']); 
      
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
header('Content-Disposition: attachment;filename="reporte-auditores.xlsx"');
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