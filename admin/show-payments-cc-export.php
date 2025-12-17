<?php 

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
$query = "select * from payments where approved = '1' and sent = '3' and status != '2' and status < '14' order by expiration desc";    
$result = mysqli_query($con, $query);   

// Add some data
$sheet->setCellValue('A1', 'IDS');
$sheet->setCellValue('B1', 'UN');
$sheet->setCellValue('C1', 'Aprobado 1');
$sheet->setCellValue('D1', 'Moneda');
$sheet->setCellValue('E1', 'Monto');
$sheet->setCellValue('F1', 'Beneficiario');
          
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
	
	$queryroute = "select workers.code, workers.first, workers.last, workers.email from workers inner join routes on workers.code = routes.worker where routes.type = '11'";
	$resultroute = mysqli_query($con, $queryroute); 
	$contadores = "";
	while($rowroute = mysqli_fetch_array($resultroute)){
		$contadores.=$rowroute['code'].' | '.$rowroute['first']." ".$rowroute['last'].' / '; 
	}
	
	
	// Miscellaneous glyphs, UTF-8
	$sheet->setCellValue('A'.$xlsRow, $row['id']);
	$sheet->setCellValue('B'.$xlsRow, $unit);
	$sheet->setCellValue('C'.$xlsRow, $contadores);
	$sheet->setCellValue('D'.$xlsRow, $thisCurrency[$row['currency']]);
	$sheet->setCellValue('E'.$xlsRow, $row['payment']);
	$sheet->setCellValue('F'.$xlsRow, getBeneficiary($row['id'],'min')); 
	
	$sheet->getStyle('E'.$xlsRow)->getNumberFormat()->setFormatCode('#,##0.00');

	$xlsRow++; 
	
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pendientes-de-cc.xlsx"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>