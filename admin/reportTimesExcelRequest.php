<?php

#error_reporting(E_ALL);
#ini_set('display_errors', TRUE);
#ini_set('display_startup_errors', TRUE);

session_start();

if(($_SESSION["globaltimes_report"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION["special_payments_report"] == 'active')){
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

$thisCategory = array();
$queryCategory = "select id, name from accountingCategories";
$resultCategory = mysqli_query($con, $queryCategory);
while($rowCategory = mysqli_fetch_array($resultCategory)){ 
	$thisCategory[$rowCategory['id']] = $rowCategory['name'];
}

$thisCurrency = array();
$queryCurrency = "select id, name from currency";
$resultCurrency = mysqli_query($con, $queryCurrency);
while($rowCurrency = mysqli_fetch_array($resultCurrency)){ 
	$thisCurrency[$rowCurrency['id']] = $rowCurrency['name'];
}

$thisCompany = array();
$queryCompany = "select id, name from companies";
$resultCompany = mysqli_query($con, $queryCompany);
while($rowCompany = mysqli_fetch_array($resultCompany)){	
	$thisCompany[$rowCompany['id']] = $rowCompany['name'];
} 

            $sheet->setCellValue('A1', 'ID Solicitud');
            $sheet->setCellValue('B1', 'Solicitante');
            $sheet->setCellValue('C1', 'Compañía');
            $sheet->setCellValue('D1', 'UN');
			$sheet->setCellValue('E1', 'Beneficiario');
			$sheet->setCellValue('F1', 'Tipo');
			$sheet->setCellValue('G1', 'Giro');
			$sheet->setCellValue('H1', 'Nac/Internac');
			$sheet->setCellValue('I1', 'Monto');
			$sheet->setCellValue('J1', 'Moneda');
			$sheet->setCellValue('K1', 'Fecha_de_Docuemnto');
			$sheet->setCellValue('L1', 'Recibido_de_Documento');
			$sheet->setCellValue('M1', 'Fecha_de_Solicitud');
			$sheet->setCellValue('N1', 'Hora_Solicitud');
			$sheet->setCellValue('O1', 'Vobo');
			$sheet->setCellValue('P1', 'Fecha_de_Vobo');
			$sheet->setCellValue('Q1', 'Hora_Vobo');
			$sheet->setCellValue('R1', 'Aprobado1');
			$sheet->setCellValue('S1', 'Fecha_de_Aprobado1');
			$sheet->setCellValue('T1', 'Hora_Aprobado1');
			$sheet->setCellValue('U1', 'Aprobado2');
			$sheet->setCellValue('V1', 'Fecha_de_Aprobado2');
			$sheet->setCellValue('W1', 'Hora_Aprobado2');
			$sheet->setCellValue('X1', 'Aprobado3');
			$sheet->setCellValue('Y1', 'Fecha_de_Aprobado3');
			$sheet->setCellValue('Z1', 'Hora_Aprobado3');
			$sheet->setCellValue('AA1', 'Provisionador');
			$sheet->setCellValue('AB1', 'Fecha_de_Provisión');
			$sheet->setCellValue('AC1', 'Hora_en_Provisión');
			$sheet->setCellValue('AD1', 'Fecha_Recibido_Provision');
			$sheet->setCellValue('AE1', 'Hora_Recibido_provision');
			$sheet->setCellValue('AF1', 'Liberador');
			$sheet->setCellValue('AG1', 'Fecha_de_Liberación');
			$sheet->setCellValue('AH1', 'Hora_en_Liberación');;
			$sheet->setCellValue('AI1', 'Programador');
			$sheet->setCellValue('AJ1', 'Fecha_de_Programación');
			$sheet->setCellValue('AK1', 'Hora_de_Programacion');
			$sheet->setCellValue('AL1', 'Ingreso_a_banco');
			$sheet->setCellValue('AM1', 'Fecha_de_Ingreso_a_banco');
			$sheet->setCellValue('AN1', 'Hora_de_Ingreso_a_banco');
			$sheet->setCellValue('AO1', 'Cancelador');
			$sheet->setCellValue('AP1', 'Fecha_de_Cancelación');
			$sheet->setCellValue('AQ1', 'Hora_Cancelación');
			$sheet->setCellValue('AR1', 'Vencimiento_de_Solvencia');
			$sheet->setCellValue('AS1', 'Tipo');
			$sheet->setCellValue('AT1', 'Concepto');
			$sheet->setCellValue('AU1', 'Categoria');
            $sheet->setCellValue('AV1', 'Plazo Proveedor');
            $sheet->setCellValue('AW1', 'Cancelacion Vencido'); 

$xlsRow = 2;
$join = $_POST['join'];
$sql = $_POST['sql'];

$thisUnitname = array();

$query = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.userid, payments.company, payments.routeid, payments.payment, payments.expiration, payments.solvencyExpiration from payments".$join." where payments.status >= '14'".$sql.' group by payments.id order by payments.id desc';   
$result = mysqli_query($con, $query); 
#$err = mysqli_error();
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$beneficiaryType = '';
	$beneficiaryCourse = 'na';
	$beneficiaryInt = 'na';
	if($row['btype'] == 1){ 
		$beneficiaryType = 'Proveedor';
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select code, name, course, international, term from providers where id = '$row[provider]'"));
		$beneficiary = $rowprovider['code']." | ".$rowprovider['name'];
		$beneficiaryCourse = $rowprovider['course'];
		if($rowprovider['international'] == 0){
			$int = 'Nacional';
		}else{
			$int = 'Internacional';
		}
		$beneficiaryInt = $int; 
	}
	elseif($row['btype'] == 2){
		$beneficiaryType = 'Colaborador';
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select code, first, last from workers where id = '$row[collaborator]'"));
		$beneficiary = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
	}
	elseif($row['btype'] == 3){
			$beneficiaryType = 'Pasante';
			$queryBen = "select * from interns where code = '$row[intern]'";
			$resultBen = mysqli_query($con, $queryBen);
			$rowBen=mysqli_fetch_array($resultBen);
			$beneficiary  = "$rowBen[code] | $rowBen[first] $rowBen[first2] $rowBen[last] $rowBen[last2]";
	}
	elseif($row['btype'] == 4){
		$beneficiaryType = 'Cliente';
		$queryBen = "select * from clients where code = '$row[client]'"; 
		$resultBen = mysqli_query($con, $queryBen);
		$rowBen=mysqli_fetch_array($resultBen);
		if($rowBen['type'] == 1){
			$beneficiary = "$rowBen[code] | $rowBen[first] $rowBen[last]";
		}elseif($row['type'] == 2){
			$beneficiary = "$rowBen[code] | $rowBen[name]"; 
		} 
	}
		
	if(!isset($thisUnitname[$row['routeid']])){
		$queryunit = "select newCode, companyName, lineName, locationName from units where id = '$row[routeid]'"; 
		$resultunit = mysqli_query($con, $queryunit);
		$rowunit = mysqli_fetch_array($resultunit);
		$thisUnitname[$row['routeid']] = $rowunit['newCode']." | $rowunit[companyName] $rowunit[lineName] $rowunit[locationName]"; 
	}
	
	$requestUser = '';
	$requestdate = '';
	$requesttime = '';			
	$voboUser = '';
	$vobodate = '';
	$vobotime = '';			
	$aprobado1User = '';	
	$approve1date = '';
	$approve1time = '';		
	$aprobado2User = '';
	$approve2date = '';
	$approve2time = '';			
	$aprobado3User = '';	
	$approve3date = '';
	$approve3time = '';			
	$provisionUser= '';		
	$provisiondate = '';
	$provisiontime = '';		
	$releasingUser= '';	
	$releasingdate = '';
	$releasingtime = '';	
	$scheduleUser= '';	
	$scheduledate = '';
	$scheduletime = '';	
	$bankUser= '';
	$bankdate = '';
	$banktime = '';	
	$cancellationUser= '';
	$cancellationdate = '';
	$cancellationtime = ''; 
	
	$query2 = "select stage, today, now2, userid from times where payment = $row[id] order by stage asc";
	$result2 = mysqli_query($con, $query2);
	$num2 = mysqli_num_rows($result2);		
	while($row2=mysqli_fetch_array($result2)){
		if(!isset($thisUser[$row2['userid']])){
			$rowuser= mysqli_fetch_array(mysqli_query($con, "select id, code, first, last from workers where code = '$row2[userid]'"));
			$thisUser[$row2['userid']] = "$rowuser[code] | $rowuser[first] $rowuser[last]"; 
		}
		
		switch($row2['stage']){
			case "1":
			$requestUser = $thisUser[$row2['userid']];
			$requestdate = $row2['today'];
			$requesttime = $row2['now2'];
			break;
			case "1.01":
			$voboUser = $thisUser[$row2['userid']];
			$vobodate = $row2['today'];
			$vobotime = $row2['now2'];
			break;
			case "2":
			$aprobado1User = $thisUser[$row2['userid']];	
			$approve1date = $row2['today'];
			$approve1time = $row2['now2'];
			break;
			case "3":
			$aprobado2User = $thisUser[$row2['userid']];
			$approve2date = $row2['today'];
			$approve2time = $row2['now2'];
			break;
			case "4":
			$aprobado3User = $thisUser[$row2['userid']];	
			$approve3date = $row2['today'];
			$approve3time = $row2['now2'];
			break; 
			case "8":
			$provisionUser= $thisUser[$row2['userid']];		
			$provisiondate = $row2['today'];
			$provisiontime = $row2['now2'];
			break;
			case "8.01":
			$provisionUser=$thisUser[$row2['userid']];	
			$provisiondate = $row2['today'];
			$provisiontime = $row2['now2'];
			break;
            case "8.04":
			$provisionUser= $thisUser[$row2['userid']];
			$provisiondate = $row2['today'];
			$provisiontime = $row2['now2'];
			break;
			case "8.05":
			$provisionUser= $thisUser[$row2['userid']];	
			$provisiondate = $row2['today'];
			$provisiontime = $row2['now2'];
			break;
			case "8.06":
			$provisionUser= $thisUser[$row2['userid']];
			$provisiondate = $row2['today'];
			$provisiontime = $row2['now2'];
			break;
			case "8.07":
			$provisionUser= $thisUser[$row2['userid']];
			$provisiondate = $row2['today'];
			$provisiontime = $row2['now2'];
			break;
			case "8.08":
			$provisionUser= $thisUser[$row2['userid']];
			$provisiondate = $row2['today'];
			$provisiontime = $row2['now2'];
			break;
			case "9":
			if($row2['userid'] == 'GETPAY'){
				$releasingUser= 'Liberación automática';
			}else{
				$releasingUser= $thisUser[$row2['userid']];
			}	
			
			$releasingdate = $row2['today'];
			$releasingtime = $row2['now2'];	
			break;
			case "12":
			$scheduleUser= $thisUser[$row2['userid']];	
			$scheduledate = $row2['today'];
			$scheduletime = $row2['now2'];	
			break;
			case "13":
			$bankUser= $thisUser[$row2['userid']];
			$bankdate = $row2['today'];
			$banktime = $row2['now2'];	
			break;
			case "14":
			$cancellationUser= $thisUser[$row2['userid']];
			$cancellationdate = $row2['today'];
			$cancellationtime = $row2['now2']; 
			break;
		}
	} 
	
	$queryBill = "select billdate, billdate2, type, concept, concept2 from bills where payment = '$row[id]' order by billdate asc limit 1";
	$resultBill = mysqli_query($con, $queryBill);
	$rowBill = mysqli_fetch_array($resultBill); 
	
	if($requestdate != ""){
		$solicitud = date('d-m-Y',strtotime($requestdate));
	}
	else{
		$solicitud = "-";
	}
	
	if($requesttime != ""){
		$solicitudt = date('H:i:s',strtotime($requesttime));
	}
	else{
		$solicitudt = "";
	}
	
	if($vobodate != ""){
		$vobo = date('d-m-Y',strtotime($vobodate));
	}
	else{
		$vobo = "-";
	}
	
	if($vobotime != ""){
		$vobot = date('H:i:s',strtotime($vobotime));
	}
	else{
		$vobot = "-";
	}
	
	if($approve1date != ""){
		$aprobado1 = date('d-m-Y',strtotime($approve1date));
	}
	else{
		$aprobado1 = "-";
	}
	
	if($approve1time != ""){
		$aprobado1t = date('H:i:s',strtotime($approve1time));
	}
	else{
		$aprobado1t = "-";
	}
	
	if($approve2date != ""){
		$aprobado2 = date('d-m-Y',strtotime($approve2date));
	}
	else{
		$aprobado2 = "-";
	}
	
	if($approve2time != ""){
		$aprobado2t = date('H:i:s',strtotime($approve2time)); 
	}
	else{
		$aprobado2t = "-";
	}
	
	if($approve3date != ""){
		$aprobado3 = date('d-m-Y',strtotime($approve3date));
	}
	else{
		$aprobado3 = "-";
	}
	
	if($approve3time != ""){
		$aprobado3t = date('H:i:s',strtotime($approve3time));
	}
	else{
		$aprobado3t = "-";
	}
	
	if($provisiondate != ""){
		$provision = date('d-m-Y',strtotime($provisiondate));
	}
	else{
		$provision = "-";
	}
	
	if($provisiontime != ""){
		$provisiont = date('H:i:s',strtotime($provisiontime));
	}
	else{
		$provisiont = "-";
	}
	
	if($releasingdate != ""){
		$releasing = date('d-m-Y',strtotime($releasingdate));
	}
	else{
		$releasing = "-";
	}
	
	if($releasingtime != ""){
		$releasingt = date('H:i:s',strtotime($releasingtime));
	}
	else{
		$releasingt = "-";
	}
	
	if($scheduledate){
		$schedule = date('d-m-Y',strtotime($scheduledate));
	}
	else{
		$schedule = "-";
	}
	
	if($scheduletime){
		$schedulet = date('H:i:s',strtotime($scheduletime));
	}
	else{
		$schedulet = "-";
	}
	
	if($bankdate != ""){
		$bank = date('d-m-Y',strtotime($bankdate));
	}
	else{
		$bank = "-";
	}
	
	if($banktime != ""){
		$bankt = date('H:i:s',strtotime($banktime));
	}
	else{
		$bankt = "-";
	}
	
	if($cancellationdate != ""){
		$cancellation = date('d-m-Y',strtotime($cancellationdate));
	}
	else{
		$cancellation = "-";
	}
	
	if($cancellationtime != ""){
		$cancellationt = date('H:i:s',strtotime($cancellationtime));
	}
	else{
		$cancellationt = "-";
	}
	
	$billDate= date('d-m-Y',strtotime($rowBill['billdate']));
	$billDate2 = date('d-m-Y',strtotime($rowBill['billdate2']));

	$querystatus = "select today, now2 from provisionfilestimes where payment = '$row[id]'";   
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
	
	$solvency = '-';
	if(($row['solvencyExpiration'] != '0000-00-00') and ($row['solvencyExpiration'] != '1969-12-31')){
		$solvency = date('d-m-Y',strtotime($row['solvencyExpiration'])); 
	}
    
    $expired = 'En tiempo';
    if($cancellationdate > $row['expiration']){
        $expired = 'Vencido';
    }
	
				
            	$sheet->setCellValue('A'.$xlsRow, $row['id']);
            	$sheet->setCellValue('B'.$xlsRow, $requestUser);
				$sheet->setCellValue('C'.$xlsRow, $thisCompany[$row['company']]);
				$sheet->setCellValue('D'.$xlsRow, $thisUnitname[$row['routeid']]);
				$sheet->setCellValue('E'.$xlsRow, $beneficiary);
				$sheet->setCellValue('F'.$xlsRow, $beneficiaryType);
				$sheet->setCellValue('G'.$xlsRow, $beneficiaryCourse);
				$sheet->setCellValue('H'.$xlsRow, $beneficiaryInt);
				$sheet->setCellValue('I'.$xlsRow, $row['payment']);
				$sheet->setCellValue('J'.$xlsRow, $thisCurrency[$row['currency']]);
				$sheet->setCellValue('K'.$xlsRow, $billDate);
				$sheet->setCellValue('L'.$xlsRow, $billDate2);
				$sheet->setCellValue('M'.$xlsRow, $solicitud);
				$sheet->setCellValue('N'.$xlsRow, $solicitudt);
				$sheet->setCellValue('O'.$xlsRow, $voboUser);
				$sheet->setCellValue('P'.$xlsRow, $vobo);
				$sheet->setCellValue('Q'.$xlsRow, $vobot);
				$sheet->setCellValue('R'.$xlsRow, $aprobado1User);
				$sheet->setCellValue('S'.$xlsRow, $aprobado1);
				$sheet->setCellValue('T'.$xlsRow, $aprobado1t);
				$sheet->setCellValue('U'.$xlsRow, $aprobado2User);
				$sheet->setCellValue('V'.$xlsRow, $aprobado2);
				$sheet->setCellValue('W'.$xlsRow, $aprobado2t);
				$sheet->setCellValue('X'.$xlsRow, $aprobado3User);
				$sheet->setCellValue('Y'.$xlsRow, $aprobado3);
				$sheet->setCellValue('Z'.$xlsRow, $aprobado3t);
				$sheet->setCellValue('AA'.$xlsRow, $provisionUser);
				$sheet->setCellValue('AB'.$xlsRow, $provision);
				$sheet->setCellValue('AC'.$xlsRow, $provisiont);
				$sheet->setCellValue('AD'.$xlsRow, $rprov);
				$sheet->setCellValue('AE'.$xlsRow, $rprovt);
				$sheet->setCellValue('AF'.$xlsRow, $releasingUser);
				$sheet->setCellValue('AG'.$xlsRow, $releasing);
				$sheet->setCellValue('AH'.$xlsRow, $releasingt);
				$sheet->setCellValue('AI'.$xlsRow, $scheduleUser);
				$sheet->setCellValue('AJ'.$xlsRow, $schedule);
				$sheet->setCellValue('AK'.$xlsRow, $schedulet);
				$sheet->setCellValue('AL'.$xlsRow, $bankUser);
				$sheet->setCellValue('AM'.$xlsRow, $bank);
				$sheet->setCellValue('AN'.$xlsRow, $bankt);
				$sheet->setCellValue('AO'.$xlsRow, $cancellationUser);
				$sheet->setCellValue('AP'.$xlsRow, $cancellation);
				$sheet->setCellValue('AQ'.$xlsRow, $cancellationt);
				$sheet->setCellValue('AR'.$xlsRow, $solvency);
				$sheet->setCellValue('AS'.$xlsRow, $thisCategory[$rowBill['type']]);
				$sheet->setCellValue('AT'.$xlsRow, $thisCategory[$rowBill['concept']]);
				$sheet->setCellValue('AU'.$xlsRow, $thisCategory[$rowBill['concept2']]);
                $sheet->setCellValue('AV'.$xlsRow, $rowprovider['term']);
                $sheet->setCellValue('AW'.$xlsRow, $expired);
    
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