<?php
  
header('Content-Type: text/html; charset=utf-8');

session_start();

if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 'active') or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active') or ($_SESSION['pipReport'] == 'active')){ 
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noadmin,nofinancemanager,noretentionmanager");	 
}

// Include PhpSpreadsheet's autoloader
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

include('function-beneficiary.php');

$now = date('Y-m-d'); 
$expiration = "";
$xlsRow = 2;
$today = date('Y-m-d'); 

$query = array();
$etapa = array(); 

#visto bueno
$query[] = "select * from payments where approved = '0' and status = '1' and arequest = '0' order by expiration desc"; 
$etapa[] = "Visto Bueno";
#aprobado1
$query[] = "select * from payments where approved = '0' and status = '1' and arequest = '1' order by expiration desc"; 
$etapa[] = "Aprobado1";
#aprobado2
$query[] = "select * from payments where approved = '0' and status = '2' and arequest = '1' order by expiration desc";  
$etapa[] = "Aprobado2";
#aprobado3
$query[] = "select * from payments where approved = '0' and status = '3' and arequest = '1' order by expiration desc";  
$etapa[] = "Aprobado3";
#provision
$query[] = "select * from payments where approved = '1' and (status = '2' or status = '3' or status = '4') order by expiration desc"; 
$etapa[] = "Provisión";
#liberacion
$query[] = "select * from payments where status = '8' and aprovision = '1' and approved = '1' order by expiration desc"; 
$etapa[] = "Liberacion"; 
#cc
#$query[] = "select * from payments where approved = '1' and sent = '3' and status != '2' and status < '14' order by expiration desc"; 
#$etapa[] = "Control de Calidad";
#vobo de grupo
$query[] = "select payments.* from payments inner join schedulecontent on payments.id = schedulecontent.payment inner join schedule on schedulecontent.schedule = schedule.id where payments.status = '12' and payments.approved != '3' and payments.approved != '2' and payments.approved = '1' and schedule.vo = '0' order by expiration desc";
$etapa[] = "Vobo Grupo";
#programacion
$query[] = "select * from payments where approved = '1' and (sent_approve = '1' or d_approve = '1') and (status = '9' or status = '13.02' or status = '13.03') order by expiration desc";
$etapa[] = "Programacion";
#aprobacion de programacion
$query[] = "select payments.* from payments inner join schedulecontent on payments.id = schedulecontent.payment inner join schedule on schedulecontent.schedule = schedule.id where payments.status = '12' and payments.approved != '3' and schedule.vo = '1' order by payments.expiration desc"; 
$etapa[] = "A. Programacion";
#cancelación
$query[] = "select * from payments where approved = '1' and status = '13' order by expiration desc";
$etapa[] = "Cancelacion";

// Add some data to the spreadsheet
$sheet->setCellValue('A1', 'IDS');
$sheet->setCellValue('B1', 'UN');
$sheet->setCellValue('C1', 'Moneda');
$sheet->setCellValue('D1', 'Monto');
$sheet->setCellValue('E1', 'Beneficiario');
$sheet->setCellValue('F1', 'Vencimiento');
$sheet->setCellValue('G1', 'Compañía');
$sheet->setCellValue('H1', 'Etapa');
$sheet->setCellValue('I1', 'Solicitante');
$sheet->setCellValue('J1', 'Factura mas antigua');
$sheet->setCellValue('K1', 'Ultima transaccion');
$sheet->setCellValue('L1', 'Plazo de credito');
$sheet->setCellValue('M1', 'Internacional');
$sheet->setCellValue('N1', 'VIP');
$sheet->setCellValue('O1', 'Provisionaror(es)');
$thisUnit = array();
for($i=0;$i<sizeof($query);$i++){
    
    $result = mysqli_query($con, $query[$i]); 
    while($row=mysqli_fetch_array($result)){
        
        if($thisUnit[$row['routeid']] == ''){
			$queryunit = "select * from units where id = '$row[routeid]'";
	    	$resultunit = mysqli_query($con, $queryunit);
        	$rowunit = mysqli_fetch_array($resultunit);
        	if($row['ncatalog'] == 1){
            	$thisUnit[$row['routeid']] = "$rowunit[newCode] | $rowunit[companyName] $rowunit[lineName] $rowunit[locationName]";
        	}else{
	       		$thisUnit[$row['routeid']] = $rowunit['code'].' | '.$rowunit['name']; 
			}
		}
		
		if($thisRequest[$row['userid']] == ''){
        
        $queryRequest = "select code, first, last from workers where code = '$row[userid]'";
        $resultRequest = mysqli_query($con, $queryRequest);
        $rowRequest = mysqli_fetch_array($resultRequest);
        
        $thisRequest[$row['userid']] = "$rowRequest[code] | $rowRequest[first] $rowRequest[last]";
        
    	}
		
        $querycompany = "select name from companies where id = '$row[company]'";
        $resultcompany = mysqli_query($con, $querycompany);
        $rowcompany = mysqli_fetch_array($resultcompany);
        $company = $rowcompany['name'];
        
        $queryTransaction = "select today from times where payment = '$row[id]' order by id desc limit 1";
	    $resultTransaction = mysqli_query($con, $queryTransaction);
	    $rowTransaction = mysqli_fetch_array($resultTransaction);
	    $ltransaction = date("d-m-Y", strtotime($rowTransaction['today']));
		
		$queryBill = "select billdate from bills where payment = '$row[id]' and billdate != '0000-00-00' order by billdate asc limit 1";
    	$resultBill = mysqli_query($con, $queryBill);
    	$rowBill = mysqli_fetch_array($resultBill);   
	
	    $rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
	    $expiration = date("d-m-Y", strtotime($row['expiration']));
		
	    if($provisionerArr[$row['routeid']] == ''){
			
       		$queryroute = "select workers.code, workers.first, workers.last, workers.email from workers inner join routes on workers.code = routes.worker where routes.unitid = '$row[routeid]' and routes.type = '5'";
	   		$resultroute = mysqli_query($con, $queryroute);
			$contadores = "";
	   		while($rowroute = mysqli_fetch_array($resultroute)){
		  	$contadores.=$rowroute['code'].' | '.$rowroute['first']." ".$rowroute['last'].' / '; 
	   		} 
       		$provisionerArr[$row['routeid']] = $contadores;
			
         }
		
		$benArr = explode(',,,',getBeneficiary($row['id'],'term'));
		$inter = 'No';
		if($benArr[2] == 1){
			$inter = 'Si';
		}
		$vip = 'No';
		if($benArr[3] == 1){
			$vip = 'Si';
		}
		
		
	    $sheet->setCellValue('A'.$xlsRow, $row['id']);
	    $sheet->setCellValue('B'.$xlsRow, $thisUnit[$row['routeid']]);
        $sheet->setCellValue('C'.$xlsRow, $rowcurrency['pre']);
        $sheet->setCellValue('D'.$xlsRow, $row['payment']);
        $sheet->setCellValue('E'.$xlsRow, $benArr[0]);
        $sheet->setCellValue('F'.$xlsRow, $expiration);
        $sheet->setCellValue('G'.$xlsRow, $company);
        $sheet->setCellValue('H'.$xlsRow, $etapa[$i]);
        $sheet->setCellValue('I'.$xlsRow, $thisRequest[$row['userid']]); 
		$sheet->setCellValue('J'.$xlsRow, $rowBill['billdate']); 
		$sheet->setCellValue('K'.$xlsRow, $ltransaction); 
		$sheet->setCellValue('L'.$xlsRow, $benArr[1]);
		$sheet->setCellValue('M'.$xlsRow, $inter);
		$sheet->setCellValue('N'.$xlsRow, $vip);
		$sheet->setCellValue('O'.$xlsRow, $provisionerArr[$row['routeid']]);
        $cletter = 78; 
        
        $queryplans = "select * from providers_plans where provider = '$row[provider]'";
		$resultplans = mysqli_query($con, $queryplans);
		while($rowplans=mysqli_fetch_array($resultplans)){
            
            $querybank= "select name from banks where id = '$rowplans[bank]'";
			$resultbank = mysqli_query($con, $querybank);
			$rowbank = mysqli_fetch_array($resultbank);
			$bank = $rowbank['name'];
				
			$queryplan= "select * from plans where id = '$rowplans[plan]'";
			$resultplan = mysqli_query($con, $queryplan);
			$rowplan = mysqli_fetch_array($resultplan);
				
            $querycompany2= "select name from companies where id = '$rowplan[company]'";
			$resultcompany2 = mysqli_query($con, $querycompany2);
			$rowcompany2 = mysqli_fetch_array($resultcompany2);
			$company2 = $rowcompany2['name'];
				
			$querybank2= "select name from banks where id = '$rowplan[bank]'";
            $resultbank2 = mysqli_query($con, $querybank2);
			$rowbank2 = mysqli_fetch_array($resultbank2);
			$bank2 = $rowbank2['name'];
				
			$querycurrency2= "select name from currency where id = '$rowplan[currency]'";
			$resultcurrency2 = mysqli_query($con, $querycurrency2);
			$rowcurrency2 = mysqli_fetch_array($resultcurrency2);
			$currency2 = $rowcurrency2['name'];
				
			$plan = $company2.'/'.$bank2.'/'.$currency2.'/'.$rowplan['account'];
			if($plan == "///"){
				$plan = "";
			}
	
	
			$cletter++; 
            $cletter_value = chr($cletter); 
			$sheet->setCellValue($cletter_value.$xlsRow, $plan); 
				
				
        }
        
    	$sheet->getStyle('E'.$xlsRow)->getNumberFormat()->setFormatCode('#,##0.00');      
		$xlsRow++; 
	
    }
	
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pendientes-generales.xlsx"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

exit;

?>