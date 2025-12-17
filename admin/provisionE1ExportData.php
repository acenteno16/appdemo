<?php 

session_start();

if(($_SESSION["ppe1"] == 'active') or ($_SESSION['admin'] == 'active')){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noPpe1");	  
}

$now = date('Y-m-d');  

include('functions.php');

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');


require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("MultiTech Labs")
							 ->setLastModifiedBy("MultiTech Labs")
							 ->setTitle("GetPay")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


$today = date('Y-m-d'); 
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'VLEDTN')
			->setCellValue('B1', 'VLCO')
			->setCellValue('C1', 'VLAN8')
            ->setCellValue('D1', 'VLMCU')
			->setCellValue('E1', 'VLVINV')
			->setCellValue('F1', 'VLDIVJ')
			->setCellValue('G1', 'VLDDJ')
			->setCellValue('H1', 'VLDGJ')
			->setCellValue('I1', 'VLCRCD')
			->setCellValue('J1', 'VLCRR')
			->setCellValue('K1', 'VLAG')
			->setCellValue('L1', 'VLRMK')
			->setCellValue('M1', 'VLEXR1')
			->setCellValue('N1', 'VLTXA1')
			->setCellValue('O1', 'VLDOCM')
			->setCellValue('P1', 'VLGLBA')
			->setCellValue('A2', 'Transaction Number')
			->setCellValue('B2', 'Co')
			->setCellValue('C2', 'Address Number')
            ->setCellValue('D2', 'Business Unit')
			->setCellValue('E2', 'Invoice Number')
			->setCellValue('F2', 'Invoice Date')
			->setCellValue('G2', 'Due Date')
			->setCellValue('H2', 'G/L Date')
			->setCellValue('I2', 'Cur Cod')
			->setCellValue('J2', 'Exchange Rate')
			->setCellValue('K2', 'Gross Amount')
			->setCellValue('L2', 'Remark')
			->setCellValue('M2', 'Tx Ex')
			->setCellValue('N2', 'Tax Area')
			->setCellValue('O2', 'Payment/ Item')
			->setCellValue('P2', 'Bank Acct-G/L');

$objPHPExcel->createSheet(1);

$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A1', 'VNEDTN')
			->setCellValue('B1', 'VNANI')
			->setCellValue('C1', 'VNMCU')
            ->setCellValue('D1', 'VNOBJ')
			->setCellValue('E1', 'VNSUB')
			->setCellValue('F1', 'VNSBL')
			->setCellValue('G1', 'VNSBLT')
			->setCellValue('H1', 'VNAA')
			->setCellValue('A2', 'Transaction Number')
			->setCellValue('B2', 'Account Number')
			->setCellValue('C2', 'Businesa Unit')
            ->setCellValue('D2', 'Obj Acct')
			->setCellValue('E2', 'Sub')
			->setCellValue('F2', 'Sub-ledger')
			->setCellValue('G2', 'Sub Type')
			->setCellValue('H2', 'Amount');

$a = "-";
$xlsRow = 3;
$xlsRow2 = 3;
$query = "select payments.description, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.route, payments.currency, bills.id as billId, bills.stotal, bills.stotal2, bills.tax from payments inner join bills on payments.id = bills.payment where payments.ppe1 = '1' and payments.child='0' and payments.approved = '1' and ((payments.credit = 0) or (payments.credit = 2)) order by payments.expiration asc";
$result = mysqli_query($con, $query);   
$num = mysqli_num_rows($result);     
while($row=mysqli_fetch_array($result)){

	switch($row['currency']){
		case 1:
			$thisCurrency = "COR";
			break;
		case 2:
			$thisCurrency = "USD";
			break;
	}
	
	$thisStotal = $row['stotal']+$row['stotal2'];
	#$thisBen = getBenCode($row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']);
	$thisBen = '';
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $row['billId'])
				->setCellValue('B'.$xlsRow, $a)
				->setCellValue('C'.$xlsRow, $thisBen) 
				->setCellValue('D'.$xlsRow, $a)
				->setCellValue('E'.$xlsRow, $a)
				->setCellValue('F'.$xlsRow, $a)
				->setCellValue('G'.$xlsRow, $a)
				->setCellValue('H'.$xlsRow, $a)
				->setCellValue('I'.$xlsRow, $thisCurrency)
				->setCellValue('J'.$xlsRow, $a)
				->setCellValue('K'.$xlsRow, $a)
				->setCellValue('L'.$xlsRow, $row['description'])
				->setCellValue('M'.$xlsRow, $a)
				->setCellValue('N'.$xlsRow, $a)
				->setCellValue('O'.$xlsRow, $a)
				->setCellValue('P'.$xlsRow, $a);
	
	#stotal
	$objPHPExcel->setActiveSheetIndex(1)
				->setCellValue('A'.$xlsRow2, $row['billId'])
				->setCellValue('B'.$xlsRow2, $a)
				->setCellValue('C'.$xlsRow2, $a) 
				->setCellValue('D'.$xlsRow2, $a)
				->setCellValue('E'.$xlsRow2, $a)
				->setCellValue('F'.$xlsRow2, $a)
				->setCellValue('G'.$xlsRow2, $a)
				->setCellValue('H'.$xlsRow2, $thisStotal);
	$xlsRow2++;
	#iva
	if($row['tax'] > 0){
		$objPHPExcel->setActiveSheetIndex(1)
					->setCellValue('A'.$xlsRow2, $row['billId'])
					->setCellValue('B'.$xlsRow2, $a)
					->setCellValue('C'.$xlsRow2, $a) 
					->setCellValue('D'.$xlsRow2, $a)
					->setCellValue('E'.$xlsRow2, $a)
					->setCellValue('F'.$xlsRow2, $a)
					->setCellValue('G'.$xlsRow2, $a)
					->setCellValue('H'.$xlsRow2, $row['tax']);
		$xlsRow2++;
	}
		
	
	#$objPHPExcel->getActiveSheet()->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	
	

	$xlsRow++; 

//}
	
}


#$objPHPExcel->getActiveSheet()->setTitle('Simple');
#$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pendientesProvisionData.xlsx"');
header('Cache-Control: max-age=0');
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