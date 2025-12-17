<?php

$now = date('Y-m-d'); 

session_start();
if(($_SESSION["reportRefund"] == "active") or ($_SESSION['admin'] == 'active')){ 
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
            ->setCellValue('A1', 'Tipo')
            ->setCellValue('B1', 'ID')
            ->setCellValue('C1', 'Codigo cliente')
            ->setCellValue('D1', 'Nombre Cliente')
			->setCellValue('E1', 'Estado')
			->setCellValue('F1', 'Monto')
			->setCellValue('G1', 'Moneda')
			->setCellValue('H1', 'Fecha de reserva')
            ->setCellValue('I1', 'Unidad de Negocio')
            ->setCellValue('J1', 'Marca')
			->setCellValue('K1', 'Modelo')
			->setCellValue('L1', 'Vendedor')
            ->setCellValue('M1', 'Descripcion')
			->setCellValue('N1', 'Fecha ingreso')
            ->setCellValue('O1', 'Fecha Aprobado1')
			->setCellValue('P1', 'Fecha Aprobado2')
			->setCellValue('Q1', 'Fecha Aprobado3')
			->setCellValue('R1', 'Fecha Liquidacion')
			->setCellValue('S1', 'Fecha Provision')
            ->setCellValue('T1', 'Fecha Tesoreria')
            ->setCellValue('U1', 'Fecha Cancelacion');

$xlsRow = 2;

/*
#banks
$querybanks = "select id, name from banks";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){
  $thebank[$rowbanks['id']] = $rowbanks['name']; 
}*/
#status
$theStatus = array();
$queryStatus = "select id, name from stages";
$resultStatus = mysqli_query($con, $queryStatus);
while($rowStatus=mysqli_fetch_array($resultStatus)){
  $theStatus[$rowStatus['id']] = $rowStatus['name']; 
}
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

$query = "select payments.id, payments.btype, payments.provider, payments.client, payments.currency, payments.userid, payments.routeid, payments.payment, payments.status, payments.description from payments inner join times on payments.id = times.payment where payments.type = '4' and payments.status >= '14' and (times.stage = '14' and times.today >= '$from' and times.today <= '$to') group by payments.id order by payments.id desc";
$query = "select payments.id, payments.btype, payments.provider, payments.client, payments.currency, payments.userid, payments.routeid, payments.payment, payments.status, payments.description from payments inner join times on payments.id = times.payment where payments.type = '4' and payments.status >= '1' and ((payments.status >= '14' and (times.stage = '14' and times.today >= '$from' and times.today <= '$to')) or (payments.status < '14' and payments.approved != '2')) group by payments.id order by payments.id desc"; 
$result = mysqli_query($con, $query); 
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
    
    $queryRefund = "select devtype, rsvp, brand, model, seller from clientsrefund where payment = '$row[id]'";
    $resultRefund = mysqli_query($con, $queryRefund);
    $rowRefund = mysqli_fetch_array($resultRefund);
    
    if($rowRefund['seller'] != ''){
        if($thisSeller[$rowRefund['seller']] == ""){
            $querySeller = "select code, first, last from workers where code = '$rowRefund[seller]'";
    	   $resultSeller = mysqli_query($con, $querySeller);
		  $rowSeller = mysqli_fetch_array($resultSeller); 
		  $thisSeller[$rowRefund['seller']]  = $rowSeller['code'].' | '.$rowSeller['first'].' '.$rowSeller['last'];
	   }
    }
	else{
        $thisSeller[$rowRefund['seller']] = '-';
    }
    
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
	
	
	$thisType= '';
	switch($rowRefund['devtype']){
		case 1:
			$thisType = 'Primas';
			break;
		case 2:
			$thisType = 'Reservas';
			break;
		case 3:
			$thisType = 'Excedentes';
			break;
		case 4:
			$thisType = 'Seguros';
			break;
		case 5:
			$thisType = 'Producto';
			break;
		case 6:
			$thisType = 'PMP';
			break;
		case 7:
			$thisType = 'Leasing';
			break;
		case 8:
			$thisType = 'Autoflex';
			break;
		case 9:
			$thisType = 'Saldo a favor del Cliente';
			break;
		case 10:
			$thisType = 'FIDEM';
			break;
	}
	
	//Fecha de Request						
	$queryRequest = "select today from times where payment = $row[id] and stage = '1' order by id desc limit 1"; 
	$resultRequest = mysqli_query($con, $queryRequest);
    $rowRequest=mysqli_fetch_array($resultRequest);
	
	//Aprobado1	
	$queryApprove1 = "select today from times where payment = $row[id] and stage = '2' order by id desc limit 1"; 
	$resultApprove1 = mysqli_query($con, $queryApprove1);
    $rowApprove1 = mysqli_fetch_array($resultApprove1);
	
	//Aprobado2	
	$queryApprove2 = "select today from times where payment = $row[id] and stage = '3' order by id desc limit 1"; 
	$resultApprove2 = mysqli_query($con, $queryApprove2);
    $rowApprove2 = mysqli_fetch_array($resultApprove2);
	
	//Aprobado3	
	$queryApprove3 = "select today from times where payment = $row[id] and stage = '4' order by id desc limit 1"; 
	$resultApprove3 = mysqli_query($con, $queryApprove3);
    $rowApprove3=mysqli_fetch_array($resultApprove3);
	
	//Liquidation	
	$queryLiquidation = "select today from times where payment = $row[id] and stage = '4.10' order by id desc limit 1"; 
	$resultLiquidation = mysqli_query($con, $queryLiquidation);
    $rowLiquidation = mysqli_fetch_array($resultLiquidation);
	
	//Provision
	$queryProvision = "select today from times where payment = $row[id] and (stage = '8' or stage = '8.04' or stage = '8.05' or stage = '8.08') order by id desc limit 1"; 
	$resultProvision = mysqli_query($con, $queryProvision);
    $rowProvision = mysqli_fetch_array($resultProvision);
    
    //Fecha de Tesorería					
	$queryTreasury = "select today from times where payment = '$row[id]' and stage = '8.03' order by id desc limit 1"; 
	$resultTreasury = mysqli_query($con, $queryTreasury);
    $rowTreasury=mysqli_fetch_array($resultTreasury); 
    $treasuryDate = $rowTreasury['today'];
        
    //Fecha de Cancelación						
	$queryCancellation = "select today from times where payment = '$row[id]' and stage = '14' order by id desc limit 1"; 
	$resultCancellation = mysqli_query($con, $queryCancellation);
    $rowCancellation=mysqli_fetch_array($resultCancellation);
    
    if($unitName[$row['routeid']] == ""){
	   $queryUnit = "select newCode, companyName, lineName, locationName from units where id = '$row[routeid]'"; 
	   $resultUnit = mysqli_query($con, $queryUnit);
	   $rowUnit = mysqli_fetch_array($resultUnit);
       $unitName[$row['routeid']] = $rowUnit['newCode'].' | '.$rowUnit['companyName'].' '.$rowUnit['lineName'].' '.$rowUnit['locationName'];
    }
    
    if($rowRefund['brand'] != ''){
        $brand = $rowRefund['brand'];
    }else{
        $brand = '-';
    }
    if($rowRefund['model'] != ''){
        $model = $rowRefund['model'];
    }else{
        $model = '-';
    }
    if($rowRefund['rsvp'] != '0000-00-00'){
        $rsvp = $rowRefund['rsvp'];
    }else{
        $rsvp = '-';
    }
    
	// Miscellaneous glyphs, UTF-8
    $objPHPExcel->setActiveSheetIndex(0)
            	->setCellValue('A'.$xlsRow, $thisType)
            	->setCellValue('B'.$xlsRow, $row['id'])
				->setCellValue('C'.$xlsRow, $benCode)
				->setCellValue('D'.$xlsRow, $benName)
				->setCellValue('E'.$xlsRow, $theStatus[$row['status']])
				->setCellValue('F'.$xlsRow, $row['payment'])
				->setCellValue('G'.$xlsRow, $theCurrency[$row['currency']])
				->setCellValue('H'.$xlsRow, $rsvp)
                ->setCellValue('I'.$xlsRow, $unitName[$row['routeid']])
                ->setCellValue('J'.$xlsRow, $brand)
				->setCellValue('K'.$xlsRow, $model)
				->setCellValue('L'.$xlsRow, $thisSeller[$rowRefund['seller']])
				->setCellValue('M'.$xlsRow, $row['description'])
                ->setCellValue('N'.$xlsRow, $rowRequest['today'])
                ->setCellValue('O'.$xlsRow, $rowApprove1['today'])
                ->setCellValue('P'.$xlsRow, $rowApprove2['today'])
                ->setCellValue('Q'.$xlsRow, $rowApprove3['today'])
                ->setCellValue('R'.$xlsRow, $rowLiquidation['today'])
                ->setCellValue('S'.$xlsRow, $rowProvision['today'])
                ->setCellValue('T'.$xlsRow, $treasuryDate)
                ->setCellValue('U'.$xlsRow, $rowCancellation['today']);  
    
	$objPHPExcel->getActiveSheet()->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

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