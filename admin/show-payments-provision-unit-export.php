<?php 

#General Export
  
header('Content-Type: text/html; charset=utf-8');

session_start();
if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 'active') or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active') or ($_SESSION["provision_global"] == "active") ){ 
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

$thisCategory = array();
$queryCategory = "select id, name from accountingCategories";
$resultCategory = mysqli_query($con, $queryCategory);
while($rowCategory = mysqli_fetch_array($resultCategory)){
	$thisCategory[$rowCategory['id']] = $rowCategory['name']; 
}
$thisCompany = array();
$queryThisCompany = "select id, name from companies";
$resultThisCompany = mysqli_query($con, $queryThisCompany);
while($rowThisCompany = mysqli_fetch_array($resultThisCompany)){
	$thisCompany[$rowThisCompany['id']] = $rowThisCompany['name'];
}
$thisStatus = array();
$queryThisStatus= "select id, name from stages"; 
$resultThisStatus = mysqli_query($con, $queryThisStatus);
while($rowThisStatus = mysqli_fetch_array($resultThisStatus)){
	$thisStatus[$rowThisStatus['id']] = $rowThisStatus['name'];
}
$thisReceived = array();
$thisReceived[0] = 'No';
$thisReceived[1] = 'Si';

$query = array();
$query[] = "select * from payments where approved = '1' and (status = '2' or status = '3' or status = '4') and child = '0' order by expiration desc"; 

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
$sheet->setCellValue('L1', 'Tipo');
$sheet->setCellValue('M1', 'Concepto');
$sheet->setCellValue('N1', 'Categoria');
$sheet->setCellValue('O1', 'Recibido Prov.');
$sheet->setCellValue('P1', 'Provisionaror(es)');
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
    
        $queryTransaction = "select today from times where payment = '$row[id]' order by id desc limit 1";
	    $resultTransaction = mysqli_query($con, $queryTransaction);
	    $rowTransaction = mysqli_fetch_array($resultTransaction);
	    $ltransaction = date("d-m-Y", strtotime($rowTransaction['today']));
		
		$queryBill = "select billdate, type, concept, concept2 from bills where payment = '$row[id]' and billdate != '0000-00-00' order by billdate asc limit 1";
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
		
	
	    $sheet->setCellValue('A'.$xlsRow, $row['id']);
	    $sheet->setCellValue('B'.$xlsRow, $thisUnit[$row['routeid']]);
        $sheet->setCellValue('C'.$xlsRow, $rowcurrency['pre']);
        $sheet->setCellValue('D'.$xlsRow, $row['payment']);
        $sheet->setCellValue('E'.$xlsRow, getBeneficiary($row['id'],'min'));
        $sheet->setCellValue('F'.$xlsRow, $expiration);
        $sheet->setCellValue('G'.$xlsRow, $thisCompany[$row['company']]);
        $sheet->setCellValue('H'.$xlsRow, $thisStatus[$row['status']]);
        $sheet->setCellValue('I'.$xlsRow, $thisRequest[$row['userid']]); 
		$sheet->setCellValue('J'.$xlsRow, $rowBill['billdate']); 
		$sheet->setCellValue('K'.$xlsRow, $ltransaction); 
		$sheet->setCellValue('L'.$xlsRow, $thisCategory[$rowBill['type']]); 
		$sheet->setCellValue('M'.$xlsRow, $thisCategory[$rowBill['concept']]); 
		$sheet->setCellValue('N'.$xlsRow, $thisCategory[$rowBill['concept2']]); 
		$sheet->setCellValue('O'.$xlsRow, $thisReceived[$row['fprovision']]); 
		$sheet->setCellValue('P'.$xlsRow, $provisionerArr[$row['routeid']]); 
        $cletter = 80;
        
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


#$sheet->getStyle('A1:C1')->getFont()->setBold(true);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pendientes-generales.xlsx"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');

// Save the spreadsheet to the output stream (PHP will prompt the file download)
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Terminate script execution to avoid further output
exit;





/*


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=""');
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
exit;*/


/*

Provision Export
session_start();

if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active')){ 
	include("../connection.php");
	}else{
		session_destroy();
		header("location: ../?err=noadmin,nofinancemanager,noretentionmanager");	 
}

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

include('function-beneficiary.php'); 

$now = date('Y-m-d'); 
$xlsRow = 2;
$today = date('Y-m-d'); 
$sql = $sql1.$sql2.$sql3;

$xlsRow = 2;
$query = "select * from payments where approved = '1' and (status = '2' or status = '3' or status = '4') and child = '0' order by expiration desc"; 
#$query = "select payments.* from payments inner join times on payments.id = times.payment where payments.approved = '1' and (payments.status = '2' or payments.status = '3' or payments.status = '4') and (times.stage = '2' or times.stage = '3' or times.stage = '4') and times.today >= '2022-07-01' and times.today <= '2022-07-31' and payments.child = '0' group by times.payment order by times.today asc"; 
$result = mysqli_query($con, $query);   

$sheet->setCellValue('A1', 'IDS');
$sheet->setCellValue('B1', 'UN');
$sheet->setCellValue('C1', 'Ultima Transaccion');
$sheet->setCellValue('D1', 'Procesador de pago');
$sheet->setCellValue('E1', 'Moneda');
$sheet->setCellValue('F1', 'Monto');
$sheet->setCellValue('G1', 'Beneficiario');

$thisCurrency = array();
$queryCurrency = "select id, pre from currency";
$resultCurrency = mysqli_query($con, $queryCurrency);
while($rowCurrency = mysqli_fetch_array($resultCurrency)){
    $thisCurrency[$rowCurrency['id']] = $rowCurrency['pre'];
}
$thisUsers = array();

while($row=mysqli_fetch_array($result)){

	$queryunit = "select * from units where id = '$row[routeid]'";
	$resultunit = mysqli_query($con, $queryunit);
	$rowunit = mysqli_fetch_array($resultunit);
    if($row['ncatalog'] == 1){
	   $unit = "$rowunit[newCode] | $rowunit[companyName] $rowunit[lineName] $rowunit[locationName]";
    }
    else{
	   $unit = $rowunit['code'].' | '.$rowunit['name']; 
    }
	
	$queryTransaction = "select today from times where payment = '$row[id]' order by id desc limit 1";
	$resultTransaction = mysqli_query($con, $queryTransaction);
	$rowTransaction = mysqli_fetch_array($resultTransaction);
	$ltransaction = date("d-m-Y", strtotime($rowTransaction['today']));
								
	
    if($thisUsers[$row['routeid']] == ""){
       $users = '';
       $queryroute = "select workers.code, workers.first, workers.last from workers inner join routes on workers.code = routes.worker where routes.unitid = '$row[routeid]' and routes.type = '5'";
	   $resultroute = mysqli_query($con, $queryroute);
	   while($rowroute = mysqli_fetch_array($resultroute)){
		  $users.=$rowroute['code'].' | '.$rowroute['first']." ".$rowroute['last'].' / '; 
	   } 
        $thisUsers[$row['routeid']] = $users;
    }
	
	// Miscellaneous glyphs, UTF-8
	$sheet->setCellValue('A'.$xlsRow, $row['id']);
	$sheet->setCellValue('B'.$xlsRow, $unit);
	$sheet->setCellValue('C'.$xlsRow, $ltransaction);
	$sheet->setCellValue('D'.$xlsRow, $thisUsers[$row['routeid']]);
	$sheet->setCellValue('E'.$xlsRow, $thisCurrency[$row['currency']]);
	$sheet->setCellValue('F'.$xlsRow, $row['payment']);
	$sheet->setCellValue('G'.$xlsRow, getBeneficiary($row['id'],'min')); 
	
	$sheet->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode('#,##0.00');

	$xlsRow++; 

//}
	
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pendientes-de-provision.xlsx"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');


$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

/*
session_start();

if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active')){ 
	include("../connection.php");
	}else{
		session_destroy();
		header("location: ../?err=noadmin,nofinancemanager,noretentionmanager");	 
}

$now = date('Y-m-d'); 

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
/*
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






$xlsRow = 2;
$today = date('Y-m-d'); 
$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$company = $_GET['type'];
$from = $_GET['from'];
$to = $_GET['to'];

$sqldatea = 0;

$sqlfrom = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sqlfrom = " and times.today >= '$from'";
	$sqldatea = 1;
}
$sqlto = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sqlto = " and times.today <= '$to'";
	$sqldatea = 1;
}

$sqldate = $sqlfrom.$sqlto;

switch($company){ 
	case 0:
	$sql1 = " and payments.currency = '1'";
	break;
	case 1:
	$sql1 = " and payments.currency = '2'";
	break;
	case 2:
	$sql1 = " and payments.currency = '3'";
	break;
	case 3:
	$sql1 = " and payments.currency = '4'";
	break;
	case 4:
	$sql1 = " and payments.currency = '1' and payments.company  = '1'";
	break;
	case 5:
	$sql1 = " and payments.currency = '2' and payments.company  = '1'";
	break;
	case 6:
	$sql1 = " and payments.currency = '3' and payments.company  = '1'";
	break;
	case 7:
	$sql1 = " and payments.currency = '4' and payments.company  = '1'";
	break;
	case 8:
	$sql1 = " and payments.currency = '1' and payments.company  = '2'";
	break;
	case 9:
	$sql1 = " and payments.currency = '2' and payments.company  = '2'";
	break;
	case 10:
	$sql1 = " and payments.currency = '3' and payments.company  = '2'";
	break;
	case 11:
	$sql1 = " and payments.currency = '4' and payments.company  = '2'";
	break;
	case 12:
	$sql1 = " and payments.currency = '1' and payments.company  = '3'";
	break;
	case 13:
	$sql1 = " and payments.currency = '2' and payments.company  = '3'";
	break;
	case 14:
	$sql1 = " and payments.currency = '3' and payments.company  = '3'";
	break;
	case 15:
	$sql1 = " and payments.currency = '4' and payments.company  = '3'";
	break;
	case 16:
	$sql1 = " and payments.currency = '1' and payments.company  > '3'";
	break;
	case 17:
	$sql1 = " and payments.currency = '2' and payments.company  > '3'";
	break;
	case 18:
	$sql1 = " and payments.currency = '3' and payments.company  > '3'";
	break;
	case 19:
	$sql1 = " and payments.currency = '4' and payments.company  > '3'"; 
	break; 
}

$sql2 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql2 = " and times.today >= '$from'";
}
$sql3 = "";
if($to != ""){ 
	$to = date("Y-m-d", strtotime($to));
	$sql3 = " and times.today <= '$to'";
}

$sql = $sql1.$sql2.$sql3;

$xlsRow = 2;
$query = "select route, count(id) as numids, sum(payment), currency, btype, provider, collaborator from payments where approved = '1' and (status = '2' or status = '3' or status = '4') group by route order by count(id) desc";    
$result = mysqli_query($con, $query);   

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'UN')
            ->setCellValue('B1', 'Solicitudes')
            ->setCellValue('C1', 'Contador')
			->setCellValue('D1', 'Moneda')
			->setCellValue('E1', 'Monto')
			->setCellValue('F1', 'Proveedor/Colaborador');
          

while($row=mysqli_fetch_array($result)){

	$queryunit = "select * from units where code = '$row[route]' or code2 = '$row[route]'";
	$resultunit = mysqli_query($con, $queryunit);
	$rowunit = mysqli_fetch_array($resultunit);
								
	$unit = $row['route']." | ".$rowunit['name'];
	
	$queryroute = "select workers.code, workers.first, workers.last, workers.email from workers inner join routes on workers.code = routes.worker where routes.unit = '$row[route]' and routes.headship = '$row[headship]' and routes.type = '5'";
	$resultroute = mysqli_query($con, $queryroute);
	$contadores = "";
	while($rowroute = mysqli_fetch_array($resultroute)){
		$contadores.=$rowroute['code'].' | '.$rowroute['first']." ".$rowroute['last'].' / '; 
	}
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[3]'"));
	
	if($row['btype'] == 1){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
		$provider = $rowprovider['code']." | ".$rowprovider['name'];
	}else{
		$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
		$provider = $rowcollaborator['code']." | ".$rowcollaborator['first']." ".$rowcollaborator['last'];
	}
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $unit)
				->setCellValue('B'.$xlsRow, $row['numids'])
				->setCellValue('C'.$xlsRow, $contadores)
				->setCellValue('D'.$xlsRow, $rowcurrency[pre])
				->setCellValue('E'.$xlsRow, $row[2])
				->setCellValue('F'.$xlsRow, $provider);  
	
	$objPHPExcel->getActiveSheet()->getStyle('G'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++; 

//}
	
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pendientes-de-provision.xlsx"');
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


*/ 

?>