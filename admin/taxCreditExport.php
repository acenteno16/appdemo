<?

session_start();

if(($_SESSION["treasury"] == "active") or ($_SESSION['admin'] == 1) or ($_SESSION['financemanager'] == 'active')  or ($_SESSION['retentionmanager'] == 'active')){ 
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noAdmin,noIVA");	 
}

$now = date('Y-m-d'); 

include('functions.php');

require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("MultiTech Labs")
							 ->setLastModifiedBy("MultiTech Labs")
							 ->setTitle("GetPay")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'RUC')
			->setCellValue('B1', 'Nombre')
			->setCellValue('C1', 'No de fctura')
            ->setCellValue('D1', 'Descripcion de pago')
			->setCellValue('E1', 'Fecha Factura')
			->setCellValue('F1', 'Monto')
			->setCellValue('G1', 'Impuesto')
			->setCellValue('H1', 'Codigo R formulario')
			->setCellValue('I1', 'ID Solicitud')
			->setCellValue('J1', 'Provisionador')
			->setCellValue('K1', 'Moneda')
			->setCellValue('L1', 'Monto total'); 

$id = $_POST['id'];
$xlsRow = 2;

for($c=0;$c<=sizeof($id);$c++){
	
	$queryMain = "select taxCredit.bill, taxCredit.payment, taxCredit.userid, taxCredit.type, taxCredit.status from taxCredit inner join payments on taxCredit.payment = payments.id where taxCredit.id = '$id[$c]'";  
	$resultMain = mysqli_query($con, $queryMain); 	
	$rowMain = mysqli_fetch_array($resultMain);
	
	
	$query = "select provider, description, currency from payments where id = '$rowMain[payment]'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
					
	$queryBill = "select number, billdate, stotal, tax, ammount from bills where id = '$rowMain[bill]'";
	$resultBill = mysqli_query($con, $queryBill);
	$rowBill = mysqli_fetch_array($resultBill);
					
	$queryProvider = "select ruc, name from providers where id = '$row[provider]'";
	$resultProvider = mysqli_query($con, $queryProvider);
	$rowProvider = mysqli_fetch_array($resultProvider);
					
	$queryUser = "select code, first, last from workers where code = '$rowMain[userid]'";
	$resultUser = mysqli_query($con, $queryUser);
	$rowUser = mysqli_fetch_array($resultUser);
					
	$thisCurrency = '';
	switch($row['currency']){
		case 1:
		$thisCurrency = 'COR';
		break;
		case 2:
		$thisCurrency = 'USD';
		break;
	}
	
	$thisTax = $rowBill['tax'];
	$thisAmount = $rowBill['stotal'];
	$thisAmount2 = $rowBill['ammount'];
	if($row['currency'] == 2){
		
		$queryTc = "select tc from tc where today = '$rowBill[billdate]'";
		$resultTc = mysqli_query($con, $queryTc);
		$rowTc = mysqli_fetch_array($resultTc);
		
		$thisTax = $thisTax*$rowTc['tc'];
		$thisAmount = $thisAmount*$rowTc['tc'];
		$thisAmount2 = $thisAmount2*$rowTc['tc'];
		
	}
	$billDate = date('d-m-Y',strtotime($rowBill['billdate']));
	
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $rowProvider['ruc'])
				->setCellValue('B'.$xlsRow, $rowProvider['name'])
				->setCellValue('C'.$xlsRow, $rowBill['number'])
				->setCellValue('D'.$xlsRow, $row['description'])
				->setCellValue('E'.$xlsRow, $billDate)
				->setCellValue('F'.$xlsRow, $thisAmount)
				->setCellValue('G'.$xlsRow, $thisTax)
				->setCellValue('H'.$xlsRow, $a)
				->setCellValue('I'.$xlsRow, $rowMain['payment'])
				->setCellValue('J'.$xlsRow, $thisProvisioner)
				->setCellValue('K'.$xlsRow, $thisCurrency) 
				->setCellValue('L'.$xlsRow, $thisAmount2);
	
	#$objPHPExcel->getActiveSheet()->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++; 	
	
}

$objPHPExcel->getActiveSheet()->setTitle('GetPay - Credito Fiscal');
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="creditoFiscal.xlsx"');
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