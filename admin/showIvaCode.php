<?php 

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

$xlsRow = 2;
$today = date('Y-m-d');  
$from = $_POST['from'];
$to = $_POST['to'];
$company = $_POST['company'];

$sql1 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql1 = " and times.today >= '$from'";
	$param++;
}else{
	exit('<script>alert("Favor ingrese la fecha de inicio.");history.go(-1);</script>');
}
$sql2 = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sql2 = " and times.today <= '$to'";
	$param++;
}else{
	exit('<script>alert("Favor ingrese la fecha de finalizacion.");history.go(-1);</script>');
}

$sql3 = '';
if($company > 0){
	$sql3 = " and payments.company = '$company'";
}else{
	exit('<script>alert("Favor ingrese la compañia.");history.go(-1);</script>');
}

$sql = $sql1.$sql2; 

$xlsRow = 2;
$query = "select payments.id, payments.description, payments.provider, payments.currency, bills.number, bills.stotal, bills.ammount, bills.tax, bills.billdate, times.userid from bills inner join payments on bills.payment = payments.id inner join times on payments.id = times.payment where payments.approved = '1' and bills.tax > 0 and payments.btype = '1' and (times.stage = '8.00' or times.stage = '8.04' or times.stage = '8.05' or times.stage = '8.06') and (payments.currency = '1' or payments.currency = '2')$sql group by bills.id";
$result = mysqli_query($con, $query); 

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
          
while($row=mysqli_fetch_array($result)){
	
	$queryProvider = "select ruc, name from providers where id = '$row[provider]'";
	$resultProvider = mysqli_query($con, $queryProvider);
	$rowProvider = mysqli_fetch_array($resultProvider);
	
	$queryProvisioner = "select code, first, last from workers where code = '$row[userid]'";
	$resultProvisioner = mysqli_query($con, $queryProvisioner);
	$rowProvisioner = mysqli_fetch_array($resultProvisioner);
	$thisProvisioner = $rowProvisioner['code'].' | '.$rowProvisioner['first'].' '.$rowProvisioner['last'];
	
	$billDate = date('d-m-Y',strtotime($row['billdate']));
	
	$thisTax = $row['tax'];
	$thisAmount = $row['stotal'];
	$thisAmount2 = $row['ammount'];
	if($row['currency'] == 2){
		
		$queryTc = "select tc from tc where today = '$row[billdate]'";
		$resultTc = mysqli_query($con, $queryTc);
		$rowTc = mysqli_fetch_array($resultTc);
		
		$thisTax = $thisTax*$rowTc['tc'];
		$thisAmount = $thisAmount*$rowTc['tc'];
		$thisAmount2 = $thisAmount2*$rowTc['tc'];
		
	}
	
	$a = '-';    
	
	// Miscellaneous glyphs, UTF-8
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$xlsRow, $rowProvider['ruc'])
				->setCellValue('B'.$xlsRow, $rowProvider['name'])
				->setCellValue('C'.$xlsRow, $row['number'])
				->setCellValue('D'.$xlsRow, $row['description'])
				->setCellValue('E'.$xlsRow, $billDate)
				->setCellValue('F'.$xlsRow, $thisAmount)
				->setCellValue('G'.$xlsRow, $thisTax)
				->setCellValue('H'.$xlsRow, $a)
				->setCellValue('I'.$xlsRow, $row['id'])
				->setCellValue('J'.$xlsRow, $thisProvisioner)
				->setCellValue('K'.$xlsRow, $row['currency']) 
				->setCellValue('L'.$xlsRow, $thisAmount2);
	
	//$objPHPExcel->getActiveSheet()->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xlsRow++; 

//}
	
}

$objPHPExcel->getActiveSheet()->setTitle('Simple');
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteIVA.xlsx"');
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
<?php 
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