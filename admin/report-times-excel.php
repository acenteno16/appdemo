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

include('function-beneficiary.php');

$now = date('Y-m-d'); 

$sheet->setCellValue('A1', 'ID Solicitud');
$sheet->setCellValue('B1', 'Solicitante');
$sheet->setCellValue('C1', 'Compania');
$sheet->setCellValue('D1', 'UN');
$sheet->setCellValue('E1', 'Proveedor_Colaborador');
$sheet->setCellValue('F1', 'Monto');
$sheet->setCellValue('G1', 'Moneda');
$sheet->setCellValue('H1', 'Fecha_de_Solicitud');
$sheet->setCellValue('I1', 'Fecha_de_Vobo');
$sheet->setCellValue('J1', 'Tiempo_Vobo_dias');
$sheet->setCellValue('K1', 'Fecha_de_Aprobado1');
$sheet->setCellValue('L1', 'Tiempo_Aprobado1_dias');
$sheet->setCellValue('M1', 'Fecha_de_Aprobado2');
$sheet->setCellValue('N1', 'Tiempo_Aprobado2_dias');
$sheet->setCellValue('O1', 'Fecha_de_Aprobado3');
$sheet->setCellValue('P1', 'Tiempo_Aprobado3_dias');
$sheet->setCellValue('Q1', 'Fecha_de_Provisión');
$sheet->setCellValue('R1', 'Tiempo_en_Provisión_dias');
$sheet->setCellValue('S1', 'Fecha_de_Liberación');
$sheet->setCellValue('T1', 'Tiempo_en_Liberación_dias');
$sheet->setCellValue('U1', 'Fecha_de_Programación');
$sheet->setCellValue('V1', 'Tiempo_de_Programacion_dias');
$sheet->setCellValue('W1', 'Fecha_de_Ingreso_a_banco');
$sheet->setCellValue('X1', 'Tiempo_de_Ingreso_a_banco');
$sheet->setCellValue('Y1', 'Fecha_de_Cancelación');
$sheet->setCellValue('Z1', 'Tiempo_en_Cancelación_dias');
$sheet->setCellValue('AA1', 'Tiempo_total_del_pago_dias');
$sheet->setCellValue('AB1', 'Recibido_en_provision_fecha');
$sheet->setCellValue('AC1', 'Recibido_en_provision_hora');

$xlsRow = 2;

$join = $_POST['join'];
$sql = $_POST['sql'];

$query = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.currency, payments.userid, payments.company, payments.routeid, payments.payment from payments".$join." where payments.status >= '14'".$sql.' group by payments.id order by payments.id desc';   
$result = mysqli_query($con, $query); 
$num = mysqli_num_rows($result);

$thisCurrency = array();
$queryCurrency = "select id, pre from currency";
$resultCurrency = mysqli_query($con, $queryCurrency);
while($rowCurrency = mysqli_fetch_array($resultCurrency)){
    $thisCurrency[$rowCurrency['id']] = $rowCurrency['pre'];
}

while($row=mysqli_fetch_array($result)){
	
	
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select name from currency where id = '$row[currency]'"));
	#$rowtype= mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[type]'"));
	#$rowconcept= mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept]'"));
	#$rowconcept2= mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept2]'"));
	$rowuser= mysqli_fetch_array(mysqli_query($con, "select first, last from workers where code = '$row[userid]'"));
	$rowcompany= mysqli_fetch_array(mysqli_query($con, "select name from companies where id = '$row[company]'"));
	#$rowmanager = mysqli_fetch_array(mysqli_query($con, "select workers.* from routes inner join workers on routes.worker = workers.code where routes.unit='$rowuser[unit]' and routes.type = '14'"));
								
	
	//TIMES
								
	$query2 = "select stage, today, now2 from times where payment = $row[id] order by stage asc";
	$result2 = mysqli_query($con, $query2);
	$num2 = mysqli_num_rows($result2);
	
    $queryunit = "select * from units where id = '$row[routeid]'";
	$resultunit = mysqli_query($con, $queryunit);
	$rowunit = mysqli_fetch_array($resultunit);
    if($row['ncatalog'] == 1){
	   $unit = "$rowunit[newCode] | $rowunit[companyName] $rowunit[lineName] $rowunit[locationName]";
    }
    else{
	   $unit = $rowunit['code'].' | '.$rowunit['name']; 
    }
			
	$requestdate = 0;
	$approve1date = 0;
	$approve2date = 0;
	$approve3date = 0;
	$provisiondate = 0;
	$releasingdate = 0;
	$bankdate = 0;
	$cancellationdate = 0;
			
	while($row2=mysqli_fetch_array($result2)){
		
		$vobodate = 0;
		
		
		switch($row2['stage']){
			case "1":
			$requestdate = $row2['today'];
			$requestdateTime = $row2['now2'];
			break;
			case "1.01":
			$vobodate = $row2['today'];
			$vobodateTime = $row2['now2'];
			break;
			case "2":
			$approve1date = $row2['today'];
			$approve1dateTime = $row2['now2'];
			break;
			case "3":
			$approve2date = $row2['today'];
				$approve2dateTime = $row2['now2'];
			break;
			case "4":
			$approve3date = $row2['today'];
				$approve3dateTime = $row2['now2'];
			break; 
			case "8":
			$provisiondate = $row2['today'];
				$provisiondateTime = $row2['now2'];
			break;
			case "8.01":
			$provisiondate = $row2['today'];
				$provisiondateTime = $row2['now2'];
			break;
			case "8.04":
			$provisiondate = $row2['today'];
				$provisiondateTime = $row2['now2'];
			break;
            case "8.05":
			$provisiondate = $row2['today'];
				$provisiondateTime = $row2['now2'];
			break;
			case "9":
			$releasingdate = $row2['today'];
				$releasingdateTime = $row2['now2'];
			break;
			case "12":
			$scheduledate = $row2['today'];
				$scheduledateTime = $row2['now2'];
			break;	
			case "13":
			$bankdate = $row2['today'];
				$bankdateTime = $row2['now2'];
			break; 
			case "14":
			$cancellationdate = $row2['today'];
				$cancellationdateTime = $row2['now2'];
			break;  
				}
	} 
			
			
			//Global time
			if($cancellationdate != 0){
				$datea = $requestdate; //Request date
				$dateb = $cancellationdate; //Approve1 date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tglobal = $dias;
			}
            else{
				$tglobal = "NA";
			}
	
			//Vobo Times
			$haveVobo = 0;
			if($vobodate  != 0){
				$datea = $requestdate; //Request date
				$dateb = $vobodate ; //Vobo date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tvobo = $dias;
				$haveVobo = 1;
			}
            else{
				$tvobo = "NA"; 
			}
	
			//Approve1 Times
			if($approve1date != 0){
				if($haveVobo == 0){
					$datea = $requestdate; //Request date
				}else{
					$datea = $vobodate; //vobo date
				}
				
				$dateb = $approve1date; //Approve1 date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove1 = $dias;
			}
            else{
				$tapprove1 = "NA";
			}
			
			//Approve2
			
			if($approve2date != 0){
				$datea = $approve1date; //Approve1 date
				$dateb = $approve2date; //Approve2 date
				
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove2 = $dias;
				$approve2 = 1; 
			}
            else{
				$tapprove2 = 'NA';
			}
			//Approve3
			//If approve3 isset
			if($approve3date != 0){
				$datea = $approve2date; //Aprobado2
				$dateb = $approve3date; //Aprpbado3
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove3 = $dias; 
				
			}
            else{
				$tapprove3 = "NA";
			}
			
			//Provision
			$scheduleuser = "NA";
			if($provisiondate != 0){
				
				$queryschedule1 = "select userid from times where payment = '$row[id]' and stage = '12.00'";
				$resultschedule1 = mysqli_query($con, $queryschedule1);
				$numschedule1 = mysqli_num_rows($resultschedule1);
				$rowschedule1 = mysqli_fetch_array($resultschedule1);
				 
				$scheduleuserid = $rowschedule1['userid'];
				
				$queryschedule = "select first, last from workers where code = '$scheduleuserid'";
				$resultschedule = mysqli_query($con, $queryschedule);
				$rowschedule = mysqli_fetch_array($resultschedule);
				
				$scheduleuser = $rowschedule['first'].' '.$rowschedule['last'];
				if($numschedule1 == 0){
					$scheduleuser = "NA";
				}
				
				if($approve1date != 0){
					$datea = $approve1date;
				}
				if($approve2date != 0){
					$datea = $approve2date;
				}
				if($approve3date != 0){
					$datea = $approve3date; 
				}
				$dateb = $provisiondate; //Provision
				
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tprovission = $dias; 
				
			}
			else{
				$tprovission = "NA"; 
			}
				
			// 
			
			//Releasing
			if($releasingdate != 0){
				$datea = $provisiondate; //Provision date
				$dateb = $releasingdate; //releasing date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$treleasing = $dias;
				
			}
            else{
				echo "NA";
			}
			//Schedule
			if($scheduledate != 0){
				$datea = $releasingdate; //Releasing
				$dateb = $scheduledate; //Schedule 
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tschedule = $dias;
				
			}
			
			/*//Schedule Approve
			if(isset($stage[$row['id']][13])){
				$datea = $stage[$row['id']][12]; //Schedule
				$dateb = $stage[$row['id']][13]; //Schedule Approve
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tschedulea = $dias;
				$tbank = $dias;
				
			}*/
	
			//Bank
			if($bankdate != 0){
				$datea = $scheduledate; //Schedule 
				$dateb = $bankdate; //Bank
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tbank = $dias;
				
			}
			
			//Cancellation 
			if($cancellationdate != 0){
				$datea = $bankdate; //Schedule Approve
				$dateb = $cancellationdate; //Cancellation
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tcancellation = $dias;
				
			}
	
	
	
	$solicitud = "";
	$solicitudTime = "";
	if($requestdate != ""){
		$solicitud = date('d-m-Y',strtotime($requestdate)).' '.$requestdateTime;
	}
	$vobo = "-";
	if($vobodate != ""){
		if($vobo > '2005-01-01'){
			$vobo = date('d-m-Y',strtotime($vobodate)).' '.$vobodateTime;
		}
	}
	$aprobado1 = "-";
	if($approve1date != ""){
		$aprobado1 = date('d-m-Y',strtotime($approve1date)).' '.$approve1dateTime;
	}
	$aprobado2 = "-";
	if($approve2date != ""){
		if($approve2date > '2005-01-01'){
			$aprobado2 = date('d-m-Y',strtotime($approve2date)).' '.$approve2dateTime;
		}
	}
	$aprobado3 = "-";
	if($approve3date != ""){  
		if($approve3date > '2005-01-01'){
			$aprobado3 = date('d-m-Y',strtotime($approve3date)).' '.$approve3dateTime; 
		}
	}
	$provision = "-";
	if($provisiondate != ""){
		$provision = date('d-m-Y',strtotime($provisiondate)).' '.$provisiondateTime;
	}
	$releasing = "-";
	if($releasingdate != ""){
		$releasing = date('d-m-Y',strtotime($releasingdate)).' '.$releasingdateTime;
	}
	$schedule = "-";
	if($scheduledate){
		$schedule = date('d-m-Y',strtotime($scheduledate)).' '.$scheduledateTime;
	}
	$bank = "-";
	if($scheduledate){
		$bank = date('d-m-Y',strtotime($bankdate)).' '.$bankdateTime;
	}
	$cancellation = "-";
	if($cancellationdate != ""){
		$cancellation = date('d-m-Y',strtotime($cancellationdate)).' '.$cancellationdateTime; 
	}
	
	$querystatus = "select today, now2 from provisionfilestimes where payment = '$row[payment]'";   
	$resultstatus = mysqli_query($con, $querystatus);
	$rowstatus = mysqli_fetch_array($resultstatus);
	
	$rprov = "-";
	if($rowstatus['today'] != ""){
		$rprov = date('d-m-Y',strtotime($rowstatus['today']));
	}
	$rprovt = "-";
	if($rowstatus['now2'] != ""){
		$rprovt  = date('H:i:s',strtotime($rowstatus['now2']));
	}
	
	$sheet->setCellValue('A'.$xlsRow, $row['id']);
    $sheet->setCellValue('B'.$xlsRow, $rowuser['first']." ".$rowuser['last']);
	$sheet->setCellValue('C'.$xlsRow, $rowcompany[0]);
	$sheet->setCellValue('D'.$xlsRow, $unit);
	$sheet->setCellValue('E'.$xlsRow, getBeneficiary($row['id'],'min'));
	$sheet->setCellValue('F'.$xlsRow, $row['payment']);
	$sheet->setCellValue('G'.$xlsRow, $thisCurrency[$row['currency']]);
	$sheet->setCellValue('H'.$xlsRow, $solicitud);
	$sheet->setCellValue('I'.$xlsRow, $vobo);
	$sheet->setCellValue('J'.$xlsRow, $tvobo);
	$sheet->setCellValue('K'.$xlsRow, $aprobado1);
	$sheet->setCellValue('L'.$xlsRow, $tapprove1);
	$sheet->setCellValue('M'.$xlsRow, $aprobado2);
	$sheet->setCellValue('N'.$xlsRow, $tapprove2);
	$sheet->setCellValue('O'.$xlsRow, $aprobado3);
	$sheet->setCellValue('P'.$xlsRow, $tapprove3);
	$sheet->setCellValue('Q'.$xlsRow, $provision);
	$sheet->setCellValue('R'.$xlsRow, $tprovission);
	$sheet->setCellValue('S'.$xlsRow, $releasing);
	$sheet->setCellValue('T'.$xlsRow, $treleasing);
	$sheet->setCellValue('U'.$xlsRow, $schedule);
	$sheet->setCellValue('V'.$xlsRow, $tschedule);
	$sheet->setCellValue('W'.$xlsRow, $bank);
	$sheet->setCellValue('X'.$xlsRow, $tbank);
	$sheet->setCellValue('Y'.$xlsRow, $cancellation);
	$sheet->setCellValue('Z'.$xlsRow, $tcancellation);
	$sheet->setCellValue('AA'.$xlsRow, $tglobal);
	$sheet->setCellValue('AB'.$xlsRow, $rprov);
	$sheet->setCellValue('AC'.$xlsRow, $rprovt);
	
	$sheet->getStyle('F'.$xlsRow)->getNumberFormat()->setFormatCode('#,##0.00'); 
	$xlsRow++;

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