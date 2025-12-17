<?php

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL); 

session_start();
if(($_SESSION["payments_report"] == "active") or ($_SESSION['admin'] == 'active')){ 
	include("../connection.php"); 
}else{
	session_destroy();
	header("location: ../?err=noPaymentsReport");  	 
}	

$now = date('Y-m-d');
$company = $_POST['company'];
$route = $_POST['route'];
$from = $_POST['from'];
$to = $_POST['to'];
$provider = $_POST['provider'];
$request = $_POST['request'];
$requester = $_POST['requester'];
$rtype = $_POST['rtype'];

require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("MultiTech Labs")
							 ->setLastModifiedBy("MultiTech Labs")
							 ->setTitle("GetPay")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
	

$theCompany = array();
$queryCompany = "select id, name from companies";
$resultCompany = mysqli_query($con, $queryCompany);
while($rowCompany=mysqli_fetch_array($resultCompany)){
   	$theCompany[$rowCompany['id']] = $rowCompany['name'];
}

if($rtype == 0){ exit('<script>alert("Debe de seleccionar un tipo de reporte."); history.go(-1);</script>'); }
#Solicitantes por rango de fecha
if($rtype == 1){
    
    
	$sql = '';
	if($from != ""){
		$from = date("Y-m-d", strtotime($from));
		$sql.= " and today >= '$from'";
	}else{
        exit('<script>alert("Debe de ingresar una fecha de inicio.");</script>');
    }	
	if($to != ""){
		$to = date("Y-m-d", strtotime($to));
		$sql.= " and today <= '$to'";
	}else{
        exit('<script>alert("Debe de ingresar una fecha de finalizacion.");</script>');
    }
	
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Compania')
            ->setCellValue('B1', 'UN')
            ->setCellValue('C1', 'Solicitante')
            ->setCellValue('D1', 'Activo')
			->setCellValue('E1', 'Solicitudes')
			->setCellValue('F1', 'Email');

	$theUser = array();
	$theUserEmail = array();
    $theUserActive = array();
    $theUnit = array();
	
	$xlsRow = 2;
	#$query = "select routes.unitid as theUnit, routes.worker, units.company from routes inner join units on (routes.unit = units.code or routes.unit = units.code2) where routes.type = '1' group by routes.unit, routes.worker order by unit asc";
    #$query = "select unitid, worker from routes where routes.type = '1'";
    $query = "select routes.unitid, routes.worker, count(payments.id) as npayments from routes inner join payments on routes.worker = payments.userid where routes.type = '1'$sql group by payments.routeid, payments.userid order by routes.company";
    #$query = "select unitid, worker from routes where routes.type = '1'";
    $result = mysqli_query($con, $query); 
    $num = mysqli_num_rows($result);
	while($row=mysqli_fetch_array($result)){ 
		
		if($theUser[$row['worker']] == ''){
			$rowUser = mysqli_fetch_array(mysqli_query($con, "select code, first, last, active, email from workers where code = '$row[worker]'"));
			$theUser[$row['worker']] = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
            $theUserEmail[$row['worker']] = $rowUser['email'];
            $theUserActive[$row['worker']] = $rowUser['active']; 
            
		}
        if($theUnit[$row['unitid']] == ''){
            
            $queryUnit = "select id, newCode, companyName, lineName, locationName, code, name, company from units where id = '$row[unitid]'";
            $resultUnit = mysqli_query($con, $queryUnit);
            $rowUnit=mysqli_fetch_array($resultUnit);
            $theUnit[$row['unitid']] = "$rowUnit[newCode] | $rowUnit[companyName] $rowUnit[lineName] $rowUnit[locationName]"; 
            if($rowUnit['newCode'] == '0') $theUnit[$row['unitid']] = "$rowUnit[code] | $rowUnit[name]"; 
            $thisCompany[$row['unitid']] = $rowUnit['companyName'];
            if($rowUnit['newCode'] == '0') $thisCompany[$row['unitid']] = $theCompany[$rowUnit['company']]; 
            
        }
          
		if($theUserActive[$row['worker']] == 1){
			$thisActive = 'Si';
		}else{
			$thisActive = 'No'; 
		}
        
		$objPHPExcel->setActiveSheetIndex(0)
            		->setCellValue('A'.$xlsRow, $thisCompany[$row['unitid']])
            		->setCellValue('B'.$xlsRow, $theUnit[$row['unitid']])
					->setCellValue('C'.$xlsRow, $theUser[$row['worker']])
					->setCellValue('D'.$xlsRow, $thisActive)
					->setCellValue('E'.$xlsRow, $row['npayments'])
					->setCellValue('F'.$xlsRow, $theUserEmail[$row['worker']]); 
                    
                    
    
		/*$objPHPExcel->getActiveSheet()->getStyle('E'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);*/

		$xlsRow++;

	}
	
	$fileTitle = 'Solicitantes por UN';
	$fileName = 'SolicitantesPorRutaDePago.xlsx';
	
}
if($rtype == 2){
	
	#Facturas Grupo Casa Pellas
	$theUser = array();
	$active = array();
	
	$sql = '';
	if($from != ""){
		$from = date("Y-m-d", strtotime($from));
		$sql.= " and times.today >= '$from'";
	}	
	if($to != ""){
		$to = date("Y-m-d", strtotime($to));
		$sql.= " and times.today <= '$to'";
	}
	
	$xlsRow = 2;
	
	$query = "select payments.id, payments.userid, payments.route, payments.btype, payments.provider, payments.collaborator, payments.client, payments.intern, payments.company, times.today from payments inner join times on payments.id = times.payment where times.stage='14'$sql";
	$result = mysqli_query($con, $query);
	$num = mysqli_num_rows($result);
	
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IDS')
            ->setCellValue('B1', 'Solicitante')
            ->setCellValue('C1', 'Compania')
            ->setCellValue('D1', 'UN')
			->setCellValue('E1', 'Beneficiario')
			->setCellValue('F1', '# Factura')
			->setCellValue('G1', 'Monto')
			->setCellValue('H1', 'Moneda')
			->setCellValue('I1', 'Provisionador')
			->setCellValue('J1', 'Fecha Aprobado')
			->setCellValue('K1', 'Hora Aprobado')
			->setCellValue('L1', 'Fecha Recibido Provision')
			->setCellValue('M1', 'Hora Recibido Provision')
			->setCellValue('N1', 'Fecha Provision')
			->setCellValue('O1', 'Hora Provision')
			->setCellValue('P1', 'Fecha Cancelacion'); 
	
	$na = '-';
	
	while($row=mysqli_fetch_array($result)){ 
		
		#Aprobado
		$queryApprove = "select today, now2 from times where payment = $row[id] and ((stage = '2') or (stage = '3') or (stage = '4')) order by id desc limit 1"; 
		$resultApprove = mysqli_query($con, $queryApprove);
		$rowApprove=mysqli_fetch_array($resultApprove);
		
		#Recibido en provision
		$queryReceived = "select today, now2 from provisionfilestimes where payment = '$row[id]'";   
		$resultReceived= mysqli_query($con, $queryReceived);
		$rowReceived = mysqli_fetch_array($resultReceived);
	
		$rprov = "-";
		if($rowReceived['today'] != ""){
			#$rprov = date('d-m-Y',strtotime($rowstatus['today']));
			$rprov = $rowReceived['today'];
		}
		$rprovt = "-";
		if($rowReceived['now2'] != ""){
			#$rprovt  = date('H:i:s',strtotime($rowstatus['now2']));
			$rprovt  = $rowReceived['now2'];
		}
		
		#Provision
		$queryProvision = "select userid, today, now2 from times where payment = $row[id] and ((stage = '8') or (stage = '8.01') or (stage = '8.04') or (stage = '8.05') or (stage = '8.06') or (stage = '8.07') or (stage = '8.08')) order by id desc limit 1"; 
		$resultProvision = mysqli_query($con, $queryProvision);
		$rowProvision=mysqli_fetch_array($resultProvision);
		
		if(!isset($theUser[$row['userid']])){
			
			$rowUser = mysqli_fetch_array(mysqli_query($con, "select code, first, last, active from workers where code = '$row[userid]'"));
			$theUser[$row['userid']] = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			$active[$row['userid']] = $rowUser['active'];
			
		}
		if(!isset($theUser[$rowProvision['userid']])){
			
			$rowUser = mysqli_fetch_array(mysqli_query($con, "select code, first, last, active from workers where code = '$rowProvision[userid]'"));
			$theUser[$rowProvision['userid']] = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			$active[$rowProvision['userid']] = $rowUser['active'];
			
		}
		
		if($row['btype'] == 1){
			
			$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
			$beneficiary = $rowprovider['code']." | ".$rowprovider['name'];
			
		}
		elseif($row['btype'] == 2){
			
			$rowprovider = mysqli_fetch_array(mysqli_query($con, "select code, first, last from workers where id = '$row[collaborator]'"));
			$beneficiary = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
			
		}
		elseif($row['btype'] == 3){
			
			$queryBen = "select * from interns where code = '$row[intern]'";
			$resultBen = mysqli_query($con, $queryBen);
			$rowBen=mysqli_fetch_array($resultBen);
			$beneficiary  = "$rowBen[code] | $rowBen[first] $rowBen[first2] $rowBen[last] $rowBen[last2]";	
			
		}
		elseif($row['btype'] == 4){
			
			$queryBen = "select * from clients where code = '$row[client]'";
			$resultBen = mysqli_query($con, $queryBen);
			$rowBen=mysqli_fetch_array($resultBen);
			if($rowBen['type'] == 1){
				$beneficiary = "$rowBen[code] | $rowBen[first] $rowBen[last]";
			}elseif($row['type'] == 2){
				$beneficiary = "$rowBen[code] | $rowBen[name]"; 
			}	
			
		} 
		
		$queryBills = "select * from bills where payment = '$row[id]'";
		$resultBills = mysqli_query($con, $queryBills);
		while($rowBills=mysqli_fetch_array($resultBills)){
			
			$thisCurrency = 'Otro';
			if($rowBills['currency'] == 1){
				$thisCurrency = 'Cordobas';
			}elseif($rowBills['currency'] == 2){  
				$thisCurrency = 'Dolares';  
			}

			
		$objPHPExcel->setActiveSheetIndex(0)
            		->setCellValue('A'.$xlsRow, $row['id'])
            		->setCellValue('B'.$xlsRow, $theUser[$row['userid']])
					->setCellValue('C'.$xlsRow, $theCompany[$row['company']])
					->setCellValue('D'.$xlsRow, $row['route'])
					->setCellValue('E'.$xlsRow, $beneficiary)
					->setCellValue('F'.$xlsRow, $rowBills['number'])
					->setCellValue('G'.$xlsRow, $rowBills['ammount']) 
					->setCellValue('H'.$xlsRow, $thisCurrency )
					->setCellValue('I'.$xlsRow, $theUser[$rowProvision['userid']])
					->setCellValue('J'.$xlsRow, $rowApprove['today'])
					->setCellValue('K'.$xlsRow, $rowApprove['now2'])
					->setCellValue('L'.$xlsRow, $rprov)
					->setCellValue('M'.$xlsRow, $rprovt) 
					->setCellValue('N'.$xlsRow, $rowProvision['today'])
					->setCellValue('O'.$xlsRow, $rowProvision['now2'])
					->setCellValue('P'.$xlsRow, $row['today']);   
    
		/*$objPHPExcel->getActiveSheet()->getStyle('E'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);*/

		$xlsRow++;
		
		}

	}
		
	$fileTitle = 'Documentos GCP';
	$fileName = 'documentos-gpc.xlsx';

}
if($rtype == 3){
	
	#Facturas Grupo Casa Pellas
	$theUser = array();
	$active = array();
	
	$sql = '';
	if($from != ""){
		$from = date("Y-m-d", strtotime($from));
		$sql.= " and times.today >= '$from'";
	}	
	if($to != ""){
		$to = date("Y-m-d", strtotime($to));
		$sql.= " and times.today <= '$to'";
	}
	
	$xlsRow = 2;
	 
	
	$query = "select payments.id, payments.userid, payments.route, payments.btype, payments.provider, payments.collaborator, payments.client, payments.intern, payments.company, times.today as ptoday, times.now2 as pnow2, times.userid as puserid from payments inner join times on payments.id = times.payment where ((times.stage='8') or (times.stage='8.01') or (times.stage='8.04') or (times.stage='8.05') or (times.stage='8.06') or (times.stage='8.07') or (times.stage='8.08')) $sql group by payments.id";
	$result = mysqli_query($con, $query);
	$num = mysqli_num_rows($result);  
	
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IDS')
            ->setCellValue('B1', 'Solicitante')
            ->setCellValue('C1', 'Compania')
            ->setCellValue('D1', 'UN')
			->setCellValue('E1', 'Beneficiario')
			->setCellValue('F1', '# Factura')
			->setCellValue('G1', 'Monto')
			->setCellValue('H1', 'Moneda')
			->setCellValue('I1', 'Provisionador')
			->setCellValue('J1', 'Fecha Aprobado')
			->setCellValue('K1', 'Hora Aprobado')
			->setCellValue('L1', 'Fecha Recibido Provision')
			->setCellValue('M1', 'Hora Recibido Provision')
			->setCellValue('N1', 'Fecha Provision')
			->setCellValue('O1', 'Hora Provision')
			->setCellValue('P1', 'Fecha Cancelacion'); 
	
	$na = '-';
	
	while($row=mysqli_fetch_array($result)){ 
		
		#Aprobado
		$queryApprove = "select today, now2 from times where payment = $row[id] and ((stage = '2') or (stage = '3') or (stage = '4')) order by id desc limit 1"; 
		$resultApprove = mysqli_query($con, $queryApprove);
		$rowApprove=mysqli_fetch_array($resultApprove);
		
		#Recibido en provision
		$queryReceived = "select today, now2 from provisionfilestimes where payment = '$row[id]'";   
		$resultReceived= mysqli_query($con, $queryReceived);
		$rowReceived = mysqli_fetch_array($resultReceived);
	
		$rprov = "-";
		if($rowReceived['today'] != ""){
			#$rprov = date('d-m-Y',strtotime($rowstatus['today']));
			$rprov = $rowReceived['today'];
		}
		$rprovt = "-";
		if($rowReceived['now2'] != ""){
			#$rprovt  = date('H:i:s',strtotime($rowstatus['now2']));
			$rprovt  = $rowReceived['now2'];
		}
		
		###
		
		if(!isset($theUser[$row['userid']])){
			
			$rowUser = mysqli_fetch_array(mysqli_query($con, "select code, first, last, active from workers where code = '$row[userid]'"));
			$theUser[$row['userid']] = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			$active[$row['userid']] = $rowUser['active'];
			
		}
		if(!isset($theUser[$row['puserid']])){
			
			$rowUser = mysqli_fetch_array(mysqli_query($con, "select code, first, last, active from workers where code = '$row[puserid]'"));
			$theUser[$rowProvision['userid']] = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			$active[$rowProvision['userid']] = $rowUser['active'];
			
		}
		
		if($row['btype'] == 1){
			
			$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
			$beneficiary = $rowprovider['code']." | ".$rowprovider['name'];
			
		}
		elseif($row['btype'] == 2){
			
			$rowprovider = mysqli_fetch_array(mysqli_query($con, "select code, first, last from workers where id = '$row[collaborator]'"));
			$beneficiary = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
			
		}
		elseif($row['btype'] == 3){
			
			$queryBen = "select * from interns where code = '$row[intern]'";
			$resultBen = mysqli_query($con, $queryBen);
			$rowBen=mysqli_fetch_array($resultBen);
			$beneficiary  = "$rowBen[code] | $rowBen[first] $rowBen[first2] $rowBen[last] $rowBen[last2]";	
			
		}
		elseif($row['btype'] == 4){
			
			$queryBen = "select * from clients where code = '$row[client]'";
			$resultBen = mysqli_query($con, $queryBen);
			$rowBen=mysqli_fetch_array($resultBen);
			if($rowBen['type'] == 1){
				$beneficiary = "$rowBen[code] | $rowBen[first] $rowBen[last]";
			}elseif($row['type'] == 2){
				$beneficiary = "$rowBen[code] | $rowBen[name]"; 
			}	
			
		} 
		
		$queryBills = "select * from bills where payment = '$row[id]'";
		$resultBills = mysqli_query($con, $queryBills);
		while($rowBills=mysqli_fetch_array($resultBills)){
			
			$thisCurrency = 'Otro';
			if($rowBills['currency'] == 1){
				$thisCurrency = 'Cordobas';
			}elseif($rowBills['currency'] == 2){  
				$thisCurrency = 'Dolares';  
			}

			
		$objPHPExcel->setActiveSheetIndex(0)
            		->setCellValue('A'.$xlsRow, $row['id'])
            		->setCellValue('B'.$xlsRow, $theUser[$row['userid']])
					->setCellValue('C'.$xlsRow, $theCompany[$row['company']])
					->setCellValue('D'.$xlsRow, $row['route'])
					->setCellValue('E'.$xlsRow, $beneficiary)
					->setCellValue('F'.$xlsRow, $rowBills['number'])
					->setCellValue('G'.$xlsRow, $rowBills['ammount']) 
					->setCellValue('H'.$xlsRow, $thisCurrency )
					->setCellValue('I'.$xlsRow, $theUser[$rowProvision['userid']])
					->setCellValue('J'.$xlsRow, $rowApprove['today'])
					->setCellValue('K'.$xlsRow, $rowApprove['now2'])
					->setCellValue('L'.$xlsRow, $rprov)
					->setCellValue('M'.$xlsRow, $rprovt) 
					->setCellValue('N'.$xlsRow, $row['ptoday'])
					->setCellValue('O'.$xlsRow, $row['pnow2']);  
    
		/*$objPHPExcel->getActiveSheet()->getStyle('E'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);*/

		$xlsRow++;
		
		}

	}
		
	$fileTitle = 'Documentos GCP';
	$fileName = 'documentos-gpc.xlsx';

}
#Solicitantes por UN
if($rtype == 4){
    

	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Compania')
            ->setCellValue('B1', 'UN')
            ->setCellValue('C1', 'Solicitante')
            ->setCellValue('D1', 'Activo')
			->setCellValue('E1', 'Email');

	$theUser = array();
	$theUserEmail = array();
    $theUserActive = array();
    $theUnit = array();
	
	$xlsRow = 2;
    $query = "select unitid, worker from routes where routes.type = '1'";
    $result = mysqli_query($con, $query); 
    $num = mysqli_num_rows($result);
	while($row=mysqli_fetch_array($result)){ 
		
		if($theUser[$row['worker']] == ''){
			$rowUser = mysqli_fetch_array(mysqli_query($con, "select code, first, last, active, email from workers where code = '$row[worker]'"));
			$theUser[$row['worker']] = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
            $theUserEmail[$row['worker']] = $rowUser['email'];
            $theUserActive[$row['worker']] = $rowUser['active']; 
            
		}
        if($theUnit[$row['unitid']] == ''){ 
            $queryUnit = "select id, newCode, companyName, lineName, locationName, code, name, company from units where id = '$row[unitid]'";
            $resultUnit = mysqli_query($con, $queryUnit);
            $rowUnit=mysqli_fetch_array($resultUnit);
            $theUnit[$row['unitid']] = "$rowUnit[newCode] | $rowUnit[companyName] $rowUnit[lineName] $rowUnit[locationName]"; 
            if($rowUnit['newCode'] == '0') $theUnit[$row['unitid']] = "$rowUnit[code] | $rowUnit[name]"; 
            $thisCompany[$row['unitid']] = $rowUnit['companyName'];
            if($rowUnit['newCode'] == '0') $thisCompany[$row['unitid']] = $theCompany[$rowUnit['company']]; 
        }
        
		if($theUserActive[$row['worker']] == 1){
			$thisActive = 'Si';
		}else{
			$thisActive = 'No'; 
		}
        
		$objPHPExcel->setActiveSheetIndex(0)
            		->setCellValue('A'.$xlsRow, $thisCompany[$row['unitid']])
            		->setCellValue('B'.$xlsRow, $theUnit[$row['unitid']])
					->setCellValue('C'.$xlsRow, $theUser[$row['worker']])
					->setCellValue('D'.$xlsRow, $thisActive)
					->setCellValue('E'.$xlsRow, $theUserEmail[$row['worker']]); 
            
		/*$objPHPExcel->getActiveSheet()->getStyle('E'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);*/

		$xlsRow++;

	}
	
	$fileTitle = 'Solicitantes por UN';
	$fileName = 'SolicitantesPorRutaDePago.xlsx';
	
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($fileTitle);
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$fileName.'"');
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