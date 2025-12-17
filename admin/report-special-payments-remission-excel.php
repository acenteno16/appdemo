<?php 

session_start();

if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active')){ 
	include("../connection.php");
}else{
		session_destroy();
		header("location: ../?err=noadmin,nofinancemanager,noretentionmanager");	 
}

include('functions.php');
include('function-beneficiary.php');


function getCategory($id){
    
    $queryCategory = "select * from categories where id = '$id'";
    $resultCategory = mysqli_query($con, $queryCategory);
    $rowCategory = mysqli_fetch_array($resultCategory);
    
    return($rowCategory['account']." | ".$rowCategory['name']);
    
}

$now = date('Y-m-d'); 
$expiration = "";

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

$query = "select * from payments where payments.child = '0' and payments.d_approve = '1' and payments.sent < '2' group by payments.id order by payments.expiration asc";

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IDS')
			->setCellValue('B1', 'UN')
			->setCellValue('C1', 'Moneda')
			->setCellValue('D1', 'Monto')
			->setCellValue('E1', 'Proveedor/Colaborador')
			->setCellValue('F1', 'Vencimiento')
			->setCellValue('G1', 'Compañía')
            ->setCellValue('H1', 'Etapa')
            ->setCellValue('I1', 'Solicitante')
            ->setCellValue('J1', 'Contador')
            ->setCellValue('K1', 'Fecha Prov.');




    $result = mysqli_query($con, $query);  
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
	

        $rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
        if(($rowstatus['stage2'] != "0.00") and ($rowstatus['stage2'] != "")){
			$thisStage = strip_tags($rowstatus['stage2']);
        }else{
            $querystage = "select * from stages where id = '$rowstatus[stage]'";
			$resultstage = mysqli_query($con, $querystage);
			$rowstage = mysqli_fetch_array($resultstage);
			$thisStage = strip_tags($rowstage['content']);
        }
        
        $queryProvision = "select userid, today from times where payment = '$row[id]' and stage = '8.05' order by id desc limit 1";
        $resultProvision = mysqli_query($con, $queryProvision);
        $rowProvision = mysqli_fetch_array($resultProvision); 
                                    
        $requester = getUser($row['userid']);
        $accountant = getUser($rowProvision['userid']);  
        $provisionDate = date('d-m-Y',strtotime($rowProvision['today']));
     
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0) 
				->setCellValue('A'.$xlsRow, $row['id'])
				->setCellValue('B'.$xlsRow, $unit)
				->setCellValue('C'.$xlsRow, $rowcurrency['pre'])
				->setCellValue('D'.$xlsRow, $row['payment'])
				->setCellValue('E'.$xlsRow, getBeneficiary($row['id'],'min'))
				->setCellValue('F'.$xlsRow, $expiration)
				->setCellValue('G'.$xlsRow, $company)
                ->setCellValue('H'.$xlsRow, $thisStage)
                ->setCellValue('I'.$xlsRow, $requester)
                ->setCellValue('J'.$xlsRow, $accountant)
                ->setCellValue('K'.$xlsRow, $provisionDate); 
    
    
	$objPHPExcel->getActiveSheet()->getStyle('D'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++; 
	
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pagos-especiales-pendientes-remision.xlsx"');
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
