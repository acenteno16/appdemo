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

/*error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');*/

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
$query = "select * from tProvision where status = '0'";
$result = mysqli_query($con, $query);       
while($row=mysqli_fetch_array($result)){
	
	$queryBill = "select * from bills where id = '$row[bill]'";
	$resultBill = mysqli_query($con, $queryBill);
	$rowBill = mysqli_fetch_array($resultBill);
	
	$queryMain = "select currency, btype, provider, collaborator, intern, client, route from payments where id = '$row[payment]'";
	$resultMain = mysqli_query($con, $queryMain);
	$rowMain = mysqli_fetch_array($resultMain);
		

	switch($rowMain['currency']){
		case 1:
			$thisCurrency = "COR";
			break;
		case 2:
			$thisCurrency = "USD";
			break;
	}
	
	switch($rowMain['btype']){
		case 1:
			$query = "select * from providers where id = '$rowMain[provider]'";
			$result = mysqli_query($con, $query); 
			$row=mysqli_fetch_array($result);
			$thisBen = $row['code'];
		break;
		case 2:
		$row=mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$collaborator'"));
		$thisBen = $rowMain['code'];
		break;
		case 3:
		$row=mysqli_fetch_array(mysqli_query($con, "select * from interns where code = '$intern'"));
		$thisBen = $rowMain['code'];
		break; 
		case 4:
		$row=mysqli_fetch_array(mysqli_query($con, "select * from clients where code = '$client'"));
		if($row['type'] == 1){
			$thisBen = $rowMain['code'];
		}elseif($row['type'] == 2){
			$thisBen = $rowMain['code']; 
		}
		break;
		
	}
	 
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $row['id'])
				->setCellValue('B'.$xlsRow, $row['company'])
				->setCellValue('C'.$xlsRow, $thisBen) 
				->setCellValue('D'.$xlsRow, $rowMain['route'])
				->setCellValue('E'.$xlsRow, $rowBill['number'])
				->setCellValue('F'.$xlsRow, $rowBill['billdate'])
				->setCellValue('G'.$xlsRow, $a)
				->setCellValue('H'.$xlsRow, $row['todayLM'])
				->setCellValue('I'.$xlsRow, $thisCurrency)
				->setCellValue('J'.$xlsRow, $row['tc'])
				->setCellValue('K'.$xlsRow, $row['amount'])
				->setCellValue('L'.$xlsRow, "ID #$row[payment]")
				->setCellValue('M'.$xlsRow, 'E')
				->setCellValue('N'.$xlsRow, 'EXE')
				->setCellValue('O'.$xlsRow, '')
				->setCellValue('P'.$xlsRow, '');
	
	
	$queryContent= "select * from tProvisionContent where provision = '$row[id]'";
	$resultContent = mysqli_query($con, $queryContent);
	while($rowContent=mysqli_fetch_array($resultContent)){
	$objPHPExcel->setActiveSheetIndex(1)
				->setCellValue('A'.$xlsRow2, $rowContent['provision'])
				->setCellValue('B'.$xlsRow2, $rowContent['account'])
				->setCellValue('C'.$xlsRow2, '') 
				->setCellValue('D'.$xlsRow2, '')
				->setCellValue('E'.$xlsRow2, '')
				->setCellValue('F'.$xlsRow2, $rowContent['aux'])
				->setCellValue('G'.$xlsRow2, $rowContent['auxType'])
				->setCellValue('H'.$xlsRow2, $rowContent['amount']);
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
header('Content-Disposition: attachment;filename="provisionGetpayData.xlsx"');
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