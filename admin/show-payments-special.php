<?php 

session_start();

if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active')){ 
	include("../connection.php");
}else{
		session_destroy();
		header("location: ../?err=noadmin,nofinancemanager,noretentionmanager");	 
}

include('function-beneficiary.php');


function getCategory($id){
    
    $queryCategory = "select * from categories where id = '$id'";
    $resultCategory = mysqli_query($con, $queryCategory);
    $rowCategory = mysqli_fetch_array($resultCategory);
    
    return($rowCategory['account']." | ".$rowCategory['name']);
    
}

$now = date('Y-m-d'); 
$expiration = "";

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
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

$query = array();
$etapa = array();

if(!$_GET['sql']){
    
    #provision
    $query[] = "select * from payments where approved = '1' and (status = '2' or status = '3' or status = '4') and d_approve = '1' order by expiration desc"; 
    $etapa[] = "Provisión";
    #liberacion
    $query[] = "select * from payments where status = '8' and aprovision = '1' and approved = '1' and d_approve = '1' order by expiration desc"; 
    $etapa[] = "Liberacion"; 
    #cc
    $query[] = "select * from payments where approved = '1' and sent = '3' and status != '2' and status < '14' and d_approve = '1' order by expiration desc"; 
    $etapa[] = "Control de Calidad";
    #vobo de grupo
    $query[] = "select payments.* from payments inner join schedulecontent on payments.id = schedulecontent.payment inner join schedule on schedulecontent.schedule = schedule.id where payments.status = '12' and payments.approved != '3' and schedule.vo = '0' and d_approve = '1' order by expiration desc";
    $etapa[] = "Vobo Grupo";
    #programacion
    $query[] = "select * from payments where approved = '1' and d_approve = '1' and (status = '9' or status = '13.02' or status = '13.03') order by expiration desc";
    $etapa[] = "Programacion";
    #aprobacion de programacion
    $query[] = "select payments.* from payments inner join schedulecontent on payments.id = schedulecontent.payment inner join schedule on schedulecontent.schedule = schedule.id where payments.status = '12' and payments.approved != '3' and schedule.vo = '1' and payments.d_approve = '1' order by payments.expiration desc"; 
    $etapa[] = "A. Programacion";
    $query[] = "select payments.* from payments inner join schedulecontent on payments.id = schedulecontent.payment inner join schedule on schedulecontent.schedule = schedule.id where payments.status = '13' and payments.approved != '3' and payments.d_approve = '1' order by payments.expiration desc"; 
    $etapa[] = "Cancelacion";
    
}else{
    
    $sql = $_GET[sql];
    if($sql == "blank"){
        $sql = "";   
    }
    
    $query[] = "select payments.id,payments.route, payments.company, payments.currency, payments.expiration from payments".$_GET[inner]." where payments.child = '0' and payments.d_approve = '1'".$sql." group by payments.id order by payments.expiration"; 
    
}

 

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IDS')
			->setCellValue('B1', 'UN')
			->setCellValue('C1', 'Moneda')
			->setCellValue('D1', 'Monto')
			->setCellValue('E1', 'Proveedor/Colaborador')
			->setCellValue('F1', 'Vencimiento')
			->setCellValue('G1', 'Compañía')
            ->setCellValue('H1', 'Etapa');

$cletterValue = 72; 

if($_GET['cats'] == 1){
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('I1', 'Tipo')
			->setCellValue('J1', 'Concepto')
			->setCellValue('K1', 'Categoria');
    $cletterValue = 75;
}

for($i=0;$i<sizeof($query);$i++){
    $result = mysqli_query($con, $query[$i]);  
    while($row=mysqli_fetch_array($result)){

	$queryunit = "select * from units where code = '$row[route]' or code2 = '$row[route]'";
	$resultunit = mysqli_query($con, $queryunit);
	$rowunit = mysqli_fetch_array($resultunit);
	$unit = $row['route']." | ".$rowunit['name'];
	
	$querycompany = "select name from companies where id = '$row[company]'";
	$resultcompany = mysqli_query($con, $querycompany);
	$rowcompany = mysqli_fetch_array($resultcompany);
	$company = $rowcompany['name'];
	
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
	$expiration = date("d-m-Y", strtotime($row['expiration']));
	
	$thisStage = $etapa[$i];
    if(isset($_GET['sql'])){
        $rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
        if(($rowstatus['stage2'] != "0.00") and ($rowstatus['stage2'] != "")){
			$thisStage = strip_tags($rowstatus['stage2']);
        }else{
            $querystage = "select * from stages where id = '$rowstatus[stage]'";
			$resultstage = mysqli_query($con, $querystage);
			$rowstage = mysqli_fetch_array($resultstage);
			$thisStage = strip_tags($rowstage['content']); 
        }
    }
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0) 
				->setCellValue('A'.$xlsRow, $row['id'])
				->setCellValue('B'.$xlsRow, $unit)
				->setCellValue('C'.$xlsRow, $rowcurrency['pre'])
				->setCellValue('D'.$xlsRow, $row['payment'])
				->setCellValue('E'.$xlsRow, getBeneficiary($row['id'],'min'))
				->setCellValue('F'.$xlsRow, $expiration)
				->setCellValue('G'.$xlsRow, $company)
                ->setCellValue('H'.$xlsRow, $thisStage); 
    
        
    if($_GET['cats'] == 1){
        
        $queryBill = "select type, concept, concept2 from bills where payment = '$row[id]'";
        $resultBill = mysqli_query($con, $queryBill);
        $rowBill = mysqli_fetch_array($resultBill); 
        
        $type = getCategory($rowBill['type']);
        $concept = getCategory($rowBill['concept']);
        $concept2 = getCategory($rowBill['concept2']);
        
        $objPHPExcel->setActiveSheetIndex(0) 
				->setCellValue('I'.$xlsRow, $type)
				->setCellValue('J'.$xlsRow, $concept)
				->setCellValue('K'.$xlsRow, $concept2); 
        
    }
        
    			
				$cletter = $cletterValue; 
				
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
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue($cletter_value.$xlsRow, $plan); 
				
				
				}
	
	$objPHPExcel->getActiveSheet()->getStyle('E'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++; 

//}
	
}
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pendientes-especiales.xlsx"');
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
