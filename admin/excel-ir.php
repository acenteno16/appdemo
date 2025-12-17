<?php

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

session_start();

function hasAccess($roles) {
    foreach ($roles as $role) {
        if (isset($_SESSION[$role]) && $_SESSION[$role] === "active") {
            return true;
        }
    }
    return false;
}

$allowedRoles = ["admin", "irexcel"];

if(hasAccess($allowedRoles)){
    include("../connection.php");
}
else{
    session_destroy();
    header("Location: ../?err=noRetentions");
    exit();
}

require('sanitize.php'); 

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$now = date('Y-m-d'); 

$sheet->setCellValue('A1', 'No RUC'); 
$sheet->setCellValue('B1', 'Codigo');
$sheet->setCellValue('C1', 'Nombres y Apellidos o Razon Social');
$sheet->setCellValue('D1', 'Ingresos Brutos Mensuales');
$sheet->setCellValue('E1', 'Valor Cotizacion INSS');
$sheet->setCellValue('F1', 'Valor Fondo Pensiondes de Ahorro');
$sheet->setCellValue('G1', 'Número de Documento');
$sheet->setCellValue('H1', 'Fecha de Documento');
$sheet->setCellValue('I1', 'Base Imponible');
$sheet->setCellValue('J1', 'Valor Retenido');
$sheet->setCellValue('K1', 'Alicuota de Retención');
$sheet->setCellValue('L1', 'Código de Retención');
$sheet->setCellValue('M1', 'Número de Retención');
$sheet->setCellValue('N1', 'ID de Solicitud');
$sheet->setCellValue('O1', 'Anulada');
$sheet->setCellValue('P1', 'Unidad');
$sheet->setCellValue('Q1', 'Batch');

$xlsRow = 2;
 
$id = $_POST['theid'];
$idsize = sizeof($id);
for($r0=0;$r0<$idsize;$r0++){
	
	$thisId = isset($id[$r0]) ? intval($id[$r0]) : 0;
	
	$queryret = "select payment, void, number from irretention where id = ?";
	$stmtret = $con->prepare($queryret);
	$stmtret->bind_param("i", $thisId);
	$stmtret->execute();
	$resultret = $stmtret->get_result();
	$rowret = $resultret->fetch_assoc();
	
	$query = "select acp2, today, btype, provider, collaborator, id, ret2, routeid from payments where id = '$rowret[payment]'";
	$result = mysqli_query($con, $query);
	$row=mysqli_fetch_array($result);
	
	$acp = $row['acp2'];
	$today = $row['today'];
	$ruc = ""; 
	if($row['btype'] == 1){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select name, code, ruc from providers where id = '$row[provider]'"));
		$provider = $rowprovider['name'];
		$providerCode = $rowprovider['code'];
		$ruc = $rowprovider['ruc'];
		
	}
	else{
		$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select first, last, nid from workers where id = '$row[collaborator]'")); 
		$provider = $rowcollaborator['first']." ".$rowcollaborator['last'];
		$ruc = $rowcollaborator['nid'];
	}
	
	$billnumbers = "";
	$querybills = "select number, billdate, ret2a, stotal, stotal2, exempt, tc, dtype, ret2 from bills where payment = '$row[id]' and ret2a > '0'"; 
	$resultbills = mysqli_query($con, $querybills);
	$billdate = "";
	$totalbills = 0;
	$totalrets = 0;
	$billstotal = 0;
	
	$queryRoute = "select code, newCode, companyName, lineName, locationName from units where id = '$row[routeid]'";
	$resultRoute = mysqli_query($con, $queryRoute);
	$rowRoute = mysqli_fetch_array($resultRoute);
	if($rowRoute['newCode'] > 0){
		$thisRoute = "$rowRoute[newCode] | $rowRoute[companyName] $rowRoute[lineName] $rowRoute[locationName]";
	}else{
		$thisRoute = "$rowRoute[code] | $rowRoute[name]";
	}
	  
	while($rowbills=mysqli_fetch_array($resultbills)){
		  
	  $billnumber = $rowbills['number'];
	  $billdate = date('d/m/Y',strtotime($rowbills['billdate']));
		  
	  if($rowbills['ret2a'] > 0){
		$billstotal = ($rowbills['stotal']+$rowbills['stotal2']-$rowbills['exempt'])*$rowbills['tc'];
		if(($acp == 1) and ($rowbills['dtype'] == 7)){  
				  
			$percentage = $rowbills['ret2']/100;
			$percentage2 = (100-$rowbills['ret2'])/100;
			$basepr = (($billstotal*$percentage)/$percentage2)+$billstotal;
				   
		}else{
			$basepr = $billstotal;  
		}
			  
		$billstotal = $basepr; 
		$totalbills = $billstotal;
		$totalrets = $rowbills['ret2a'];  
	  }
	   
		switch($rowbills['ret2']){
		case 2:
		$retcode = 22;
		break;
		case 7:
		$retcode = 511;
		break;
		case 10:
		$retcode = 27;
		break;
		case 15:
		$retcode = 528;
		break;
		 
	} 
		  
		if($rowret['void'] == 1){
		
			$base_imponible = 0.00;
			$valor_retenido = 0.00; 
			$anulada = "Si";
		
		}
		else{
			//No 
			$base_imponible = number_format($totalbills,2);
			$valor_retenido = $totalrets; 
			$anulada = "No";
	 	}
		  
		switch($rowbills['ret2']){
			case 2:
			$retcode = 22;
			break;
			case 12:
			$retcode = 511;
			break;
			case 10:
			$retcode = 27;
			break;
			case 15:
			$retcode = 528;
			break;
            case 20:
            $retcode = 47;
            break;
		 
		} 
		  
	$batchs = "";
	$querybatch = "select nobatch from batch where payment = '$row[id]'";
	$resultbatch = mysqli_query($con, $querybatch);
	while($rowbatch = mysqli_fetch_array($resultbatch)){
		$batchs.=$rowbatch['nobatch'].', '; 
	}
	$batchs = substr($batchs, 0, -2);
	
	$sheet->setCellValue('A'.$xlsRow, cleanString($ruc));
    $sheet->setCellValue('B'.$xlsRow, cleanString($providerCode));
	$sheet->setCellValue('C'.$xlsRow, cleanString($provider));
	$sheet->setCellValue('D'.$xlsRow, '');
	$sheet->setCellValue('E'.$xlsRow, '');
	$sheet->setCellValue('F'.$xlsRow, '');
	$sheet->setCellValue('G'.$xlsRow, $billnumber);
	$sheet->setCellValue('H'.$xlsRow, $billdate);
	$sheet->setCellValue('I'.$xlsRow, $base_imponible);
	$sheet->setCellValue('J'.$xlsRow, $valor_retenido);
	$sheet->setCellValue('K'.$xlsRow, $row['ret2']);
	$sheet->setCellValue('L'.$xlsRow, $retcode);
	$sheet->setCellValue('M'.$xlsRow, $rowret['number']);
	$sheet->setCellValue('N'.$xlsRow, $rowret['payment']);
	$sheet->setCellValue('O'.$xlsRow, $anulada);
	$sheet->setCellValue('P'.$xlsRow, $thisRoute);
	$sheet->setCellValue('Q'.$xlsRow, $batchs);
	
	
	$xlsRow++;

	}
	
}
	
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReporteIR.xlsx"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

function cleanString($string){ 
	
	return $result = preg_replace("/[^A-Za-z0-9?![:space:]]/", "", $string);
	
}
