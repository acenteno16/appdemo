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
$expiration = "";
$xlsRow = 2;
$today = date('Y-m-d'); 

$query = "select * from payments where approved = '1' and (sent_approve = '1' or d_approve = 1) and (status = '9' or status = '13.02' or status = '13.03') order by expiration desc";    
$result = mysqli_query($con, $query);   

// Add some data
$sheet->setCellValue('A1', 'IDS');
$sheet->setCellValue('B1', 'UN');
$sheet->setCellValue('C1', 'Moneda');
$sheet->setCellValue('D1', 'Monto');
$sheet->setCellValue('E1', 'Proveedor/Colaborador');
$sheet->setCellValue('F1', 'Vencimiento');
$sheet->setCellValue('G1', 'Compañía');
	
$thisCompany = array();
$queryCompany = "select id, name from companies";
$resultCompany = mysqli_query($con, $queryCompany);
while($rowCompany = mysqli_fetch_array($resultCompany)){
    $thisCompany[$rowCompany['id']] = $rowCompany['name'];
}
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

	$expiration = date("d-m-Y", strtotime($row['expiration']));
	
	$sheet->setCellValue('A'.$xlsRow, $row['id']);
	$sheet->setCellValue('B'.$xlsRow, $unit);
	$sheet->setCellValue('C'.$xlsRow, $thisCurrency[$row['currency']]);
	$sheet->setCellValue('D'.$xlsRow, $row['payment']);
	$sheet->setCellValue('E'.$xlsRow, getBeneficiary($row['id'],'min'));
	$sheet->setCellValue('F'.$xlsRow, $expiration);
	$sheet->setCellValue('G'.$xlsRow, $thisCompany[$row['company']]);
	
	$cletter = 71; 
				
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
	
	$sheet->getStyle('D'.$xlsRow)->getNumberFormat()->setFormatCode('#,##0.00');

	$xlsRow++; 

//}
	
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pendientes-de-programacion.xlsx"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>