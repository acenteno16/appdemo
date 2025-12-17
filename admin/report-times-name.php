<?php

#error_reporting(E_ALL);
#ini_set('display_errors', TRUE);
#ini_set('display_startup_errors', TRUE);

session_start();

if(($_SESSION["globaltimes_report"] == "active") or ($_SESSION['admin'] == "active")){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=no_globaltimes_report");	 
}

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$now = date('Y-m-d'); 
$xlsRow = 2;

$join = $_POST['join'];
$sql = $_POST['sql'];

$query = "select payments.id from payments".$join." where payments.status >= '14'".$sql.' group by payments.id order by payments.id desc';   
$result = mysqli_query($con, $query); 
#$err = mysqli_error();
$num = mysqli_num_rows($result);

$sheet->setCellValue('A1', 'ID Solicitud');
$sheet->setCellValue('B1', 'Solicitante');
$sheet->setCellValue('C1', 'Visto Bueno');
$sheet->setCellValue('D1', 'Aprobado1');
$sheet->setCellValue('E1', 'Aprobado2');
$sheet->setCellValue('F1', 'Aprobado3');
$sheet->setCellValue('G1', 'Provisionador');
$sheet->setCellValue('H1', 'Liberador');
$sheet->setCellValue('I1', 'Programacion');
$sheet->setCellValue('J1', 'Ingreso a banco');
$sheet->setCellValue('K1', 'Cancelacion');

while($row=mysqli_fetch_array($result)){
				
	$query2 = "select stage, userid from times where payment = $row[id] order by stage asc";
	$result2 = mysqli_query($con, $query2);
	$num2 = mysqli_num_rows($result2);
	
	$requestUser = '-';
	$voboUser = '-';
	$approve1User = '-';
	$approve2User = '-';
	$approve3User = '-';
	$provisionUser = '-';
	$releasingUser = '-';
	$scheduleUser = '-';
	$cancellationUser = '-';		
			
	while($row2=mysqli_fetch_array($result2)){
		switch($row2['stage']){
			case "1":
			$queryUser = "select * from workers where code = '$row2[userid]'";
			$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);
			$requestUser = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			break;
			case "1.01":
			$queryUser = "select * from workers where code = '$row2[userid]'";
			$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);
			$voboUser =$rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			break;
			case "2":
			$queryUser = "select * from workers where code = '$row2[userid]'";
			$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);	
			$approve1User= $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			break;
			case "3":
			$queryUser = "select * from workers where code = '$row2[userid]'";
			$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);	
			$approve2User = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			break;
			case "4":
			$queryUser = "select * from workers where code = '$row2[userid]'";
			$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);	
			$approve3User = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			break; 
			case "8":
			$queryUser = "select * from workers where code = '$row2[userid]'";
			$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);	
			$provisionUser = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			break;
			case "8.01":
			$queryUser = "select * from workers where code = '$row2[userid]'";
			$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);
			$provisionUser = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			break;
			case "8.04":
			$queryUser = "select * from workers where code = '$row2[userid]'";
			$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);	
			$provisionUser = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			break;
            case "8.05":
			$queryUser = "select * from workers where code = '$row2[userid]'";
			$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);	
			$provisionUser = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			break;
			case "9":
			$queryUser = "select * from workers where code = '$row2[userid]'";
			$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);	
			$releasingUser = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			break;
			case "12":
			$queryUser = "select * from workers where code = '$row2[userid]'";
			$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);	
			$scheduleUser = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			break;	
			case "13":
			$queryUser = "select * from workers where code = '$row2[userid]'";
			$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);	
			$bankUser = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			break; 
			case "14":
			$queryUser = "select * from workers where code = '$row2[userid]'";
			$resultUser = mysqli_query($con, $queryUser);
			$rowUser = mysqli_fetch_array($resultUser);	
			$cancellationUser = $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last'];
			break;  
		}
	}  
			
	$sheet->setCellValue('A'.$xlsRow, $row['id']);
    $sheet->setCellValue('B'.$xlsRow, $requestUser);
	$sheet->setCellValue('C'.$xlsRow, $voboUser);
	$sheet->setCellValue('D'.$xlsRow, $approve1User);
	$sheet->setCellValue('E'.$xlsRow, $approve2User);
	$sheet->setCellValue('F'.$xlsRow, $approve3User);
	$sheet->setCellValue('G'.$xlsRow, $provisionUser);
	$sheet->setCellValue('H'.$xlsRow, $releasingUser);
	$sheet->setCellValue('I'.$xlsRow, $scheduleUser);
	$sheet->setCellValue('J'.$xlsRow, $bankUser);
	$sheet->setCellValue('K'.$xlsRow, $cancellationUser);  

	$xlsRow++;

}

function getUser($uId){
	
	$queryUser = "select * from workers where code = '$uId'";
	$resultUser = mysqli_query($con, $queryUser);
	$rowUser = mysqli_fetch_array($resultUser);
	
	return $queryUser.'-'.$rowUser['first'];
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="tiempos-global.xlsx"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');


$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>
