<?php 

#error_reporting(E_ALL);
#ini_set('display_errors', TRUE);
#ini_set('display_startup_errors', TRUE);

header('Content-Type: text/html; charset=utf-8');

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

$now = date('Y-m-d');

include('function-beneficiary.php'); 

$xlsRow = 2;
$today = date('Y-m-d');
$sql = $sql1.$sql2.$sql3;

$xlsRow = 2;
$query = "select * from payments where status = '1' and arequest = '1' and approved = '0' and payments.child='0' order by expiration desc";    
$result = mysqli_query($con, $query);   

// Add some data
$sheet->setCellValue('A1', 'IDS');
$sheet->setCellValue('B1', 'UN');
$sheet->setCellValue('C1', 'Ultima Transaccion');
$sheet->setCellValue('D1', 'Aprobado(s) 1');
$sheet->setCellValue('E1', 'Moneda');
$sheet->setCellValue('F1', 'Monto');
$sheet->setCellValue('G1', 'Beneficiario');

$thisCurrency = array();
$queryCurrency = "select id, pre from currency";
$resultCurrency = mysqli_query($con, $queryCurrency);
while($rowCurrency = mysqli_fetch_array($resultCurrency)){
    $thisCurrency[$rowCurrency['id']] = $rowCurrency['pre'];
}

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
	
    $users = "";
	$queryroute = "select workers.code, workers.first, workers.last from workers inner join routes on workers.code = routes.worker where routes.unitid = '$row[routeid]' and routes.type = '2'";
	$resultroute = mysqli_query($con, $queryroute);
	while($rowroute = mysqli_fetch_array($resultroute)){
		$users.=$rowroute['code'].' | '.$rowroute['first']." ".$rowroute['last'].' / '; 
	}

	$sheet->setCellValue('A'.$xlsRow, $row['id']);
	$sheet->setCellValue('B'.$xlsRow, $unit);
	$sheet->setCellValue('C'.$xlsRow, $ltransaction);
	$sheet->setCellValue('D'.$xlsRow, $users); 
	$sheet->setCellValue('E'.$xlsRow, $thisCurrency[$row['currency']]);
	$sheet->setCellValue('F'.$xlsRow, $row['payment']);
	$sheet->setCellValue('G'.$xlsRow, getBeneficiary($row['id'],'min'));
	
	$sheet->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode('#,##0.00'); 
	$xlsRow++; 
	
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pendientes-de-aprobado1.xlsx"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');


$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>