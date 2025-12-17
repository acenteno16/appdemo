<?php

#ini_set('display_errors', '1');
#ini_set('display_startup_errors', '1');
#error_reporting(E_ALL);

session_start();

function hasAccess($roles) {
    foreach ($roles as $role) {
        if (isset($_SESSION[$role]) && $_SESSION[$role] === "active") {
            return true;
        }
    }
    return false;
}

$allowedRoles = ["admin", "imiexcel"];

if(hasAccess($allowedRoles)){
    include("../connection.php");
}
else{
    session_destroy();
    header("Location: ../?err=noproviders_provider_export");
    exit;
} 

require('sanitize.php'); 

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Fecha_Retencion');
$sheet->setCellValue('B1', 'Numero_Retencion');
$sheet->setCellValue('C1', 'Serie');
$sheet->setCellValue('D1', 'Codigo');
$sheet->setCellValue('E1', 'Nombre_y_Apellido_o_Razon_Social');
$sheet->setCellValue('F1', 'Ruc');
$sheet->setCellValue('G1', 'Cedula');
$sheet->setCellValue('H1', 'Telefono');
$sheet->setCellValue('I1', 'Monto_Facturado');
$sheet->setCellValue('J1', 'Monto_Retenido');
$sheet->setCellValue('K1', 'Concepto');
$sheet->setCellValue('L1', 'Cheque');
$sheet->setCellValue('M1', 'Factura');
$sheet->setCellValue('N1', 'Estado');
$sheet->setCellValue('O1', 'Anulada');
$sheet->setCellValue('P1', 'Unidad');
$sheet->setCellValue('Q1', 'Batch');

$xlsRow = 2; 

$id = $_POST['theid'];

for($r0=0;$r0<sizeof($id);$r0++){
	
	$thisId = isset($id[$r0]) ? intval($id[$r0]) : 0;
	
	$querymain = "select payment, amount, billsid, created, void from hallsretention where id = ?";
	$stmtmain = $con->prepare($querymain);
	$stmtmain->bind_param("i", $thisId);
	$stmtmain->execute();
	$resultmain = $stmtmain->get_result();
	$rowmain = $resultmain->fetch_assoc();
	
	$queryret = "select number, serial from hallsretention where id = ?";
	$stmtret = $con->prepare($queryret);
	$stmtret->bind_param("i", $thisId);
	$stmtret->execute();
	$resultret = $stmtret->get_result();
	$rowret = $resultret->fetch_assoc();	
	
	$query = "select id, acp, today, btype, provider, collaborator, routeid, description, cnumber from payments where id = '$rowmain[payment]'";  
	$result = mysqli_query($con, $query);
	$row=mysqli_fetch_array($result);
	
	$acp = $row['acp'];
	
	//$today = date('d-m-Y',strtotime($row['today']));
	$today = $row['today'];
	
	$number = $rowret['number'];
	$serial = $rowret['serial'];
	if($row['btype'] == 1){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select name, code, ruc, phone from providers where id = '$row[provider]'"));
		$provider = $rowprovider['name'];
		$providerCode = $rowprovider['code'];
		$ruc = $rowprovider['ruc'];
		$phone = $rowprovider['phone'];
	}
	else{
		$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select first, last, nid from workers where id = '$row[collaborator]'")); 
		$provider = $rowcollaborator['first']." ".$rowcollaborator['last'];
		$nid = $rowcollaborator['nid'];
	}
	 
	  $billdata = "";
	  $totalbills = 0;
	  $totalrets = 0;
	  $billstotal = 0; 
	  $totalbills = 0;
	  $totalrets = 0;
	  $billnumbers = "";

	  if($rowmain['amount'] == 0){
	  	$sql = "";
	  }
	  else{
	  
	  //Caso mutiples retenciones por IDS
	  $bills = $rowmain['billsid'];
	  $bills_arr = explode(',',$bills);
	  $sql = "";
	  for($ib=0;$ib<sizeof($bills_arr);$ib++){
	  	if($ib == 0){
			$sql.= " and ((id = '$bills_arr[$ib]')";
		}else{
			$sql.= " or (id = '$bills_arr[$ib]')";
		}
		if($ib+1 == sizeof($bills_arr)){
			$sql.= ")";
		}
	 } //end for
							
	  //end caso multiples retenciones
	  }
	    
	  $querybills = "select ret1a, stotal, stotal2, exempt2, tc, ret1, number from bills where payment = '$row[id]'$sql";
	  $resultbills = mysqli_query($con, $querybills);
	  while($rowbills=mysqli_fetch_array($resultbills)){
		  
		 if($rowbills['ret1a'] > 0){
			  
			  $billstotal = 0;
			  $billstotal = ($rowbills['stotal']+$rowbills['stotal2']-$rowbills['exempt2'])*$rowbills['tc'];
			 
			  if($acp == 1){  
				  
				  //DONDE
				  //percent2acp el el % de incremento
				  //p2 es el porcentaje de la retencion (2% o el 10% usualmente)
				  //stotalbillnio es el subtotal que graba + el subtotal que no graba
				  //$percent2acp = (100-$rowbills['ret1'])/100;
				  //$p2acp =  $billstotal*($rowbills['ret1']/100);
				  //$basepr = $p2acp/$percent2acp;
				  
				  if($isbill == 1){
					  $basepr = $billstotal;
					  
				  }else{
					  $percent2acp = (100-$rowbills['ret1'])/100;
				  	  $p2acp =  $billstotal*($rowbills['ret1']/100);
				  	  $basepr1 = $p2acp/$percent2acp;
				  
				  	  $percentage = $rowbills['ret1']/100;
				  	  $percentage2 = (100-$rowbills['ret1'])/100; 
				  
				  	  $basepr = (($billstotal*$percentage)/$percentage2)+$billstotal;
					 
				  }
				   
				   
			  }else{
				  $basepr = $billstotal;  
			  } 
			  
			  
			  
			  	$billdata.= $rowbills['number'].",";
			  
			  
			  $billstotal = $basepr; 
			  
			  $totalbills += $billstotal;
			  $totalrets += $rowbills['ret1a'];
		  }
			  

		  
	  }
	
	$querycancellation = "select today from times where payment = '$row[id]' and stage = '14.00'";
    $resultcancellation = mysqli_query($con, $querycancellation);
    $rowcancellation = mysqli_fetch_array($resultcancellation);
	
	$today = $rowcancellation['today']; 
	
	#$queryretdate = "select scheduletimes.today from scheduletimes inner join schedulecontent on scheduletimes.schedule = schedulecontent.schedule where scheduletimes.stage = '3.00' and schedulecontent.payment = '$row[id]'"; 
	#$resultretdate = mysqli_query($con, $queryretdate);   
	#$rowretdate = mysqli_fetch_array($resultretdate);

	/*
	if($rowmain['created'] != "000-00-00"){

	}
	elseif($rowretdate['today'] >= '2017-01-23'){
		$today = $rowretdate['today'];  
	}
	else{

		//APROBAJO GF (Descontinuado)
		#$queryretdate2 = "select scheduletimes.today from scheduletimes inner join schedulecontent on scheduletimes.schedule = schedulecontent.schedule where scheduletimes.stage = '5.00' and schedulecontent.payment = '$row[id]'"; 
		#$resultretdate2 = mysqli_query($con, $queryretdate2);  
		#$rowretdate2 = mysqli_fetch_array($resultretdate2); 

  		#$today = $rowretdate2['today'];   
	}
	*/
	$today = $rowmain['created'];
  
	if($ruc == ""){
		$ruc =  $nid;
	}
	
	$billdata = substr($billdata,0,-1);
	if($row['status'] == 14){
		$status = "Finalizado (Tesoreria)";
	}else{
		$status = "Cancelado (CFO)";
	}
	
	if($rowmain['void'] == 1){
		$status2 = "Si";
		$thisBAmount = '0';
		$thisRAmount = '0';
		 
	}
	else{
		$status2 = "No";
		$totalbills = str_replace(',','',number_format($totalbills,2));
		$totalrets = str_replace(',','',number_format($totalrets,2));
		$thisBAmount = $totalbills;
		$thisRAmount = $totalrets;
	} 
	
	$queryRoute = "select code, newCode, companyName, lineName, locationName from units where id = '$row[routeid]'";
	$resultRoute = mysqli_query($con, $queryRoute);
	$rowRoute = mysqli_fetch_array($resultRoute);
	if($rowRoute['newCode'] > 0){
		$thisRoute = "$rowRoute[newCode] | $rowRoute[companyName] $rowRoute[lineName] $rowRoute[locationName]";
	}else{
		$thisRoute = "$rowRoute[code] | $rowRoute[name]";
	}
	
	
	$batchs = "";
	$querybatch = "select nobatch from batch where payment = '$row[id]'";
	$resultbatch = mysqli_query($con, $querybatch);
	while($rowbatch = mysqli_fetch_array($resultbatch)){
		$batchs.=$rowbatch['nobatch'].', '; 
	}
	$batchs = substr($batchs, 0, -2);
	
	$sheet->setCellValue('A'.$xlsRow, $today);
	$sheet->setCellValue('B'.$xlsRow, str_pad((int) $number,4,"0",STR_PAD_LEFT));
	$sheet->setCellValue('C'.$xlsRow, $serial);
	$sheet->setCellValue('D'.$xlsRow, $providerCode);
	$sheet->setCellValue('E'.$xlsRow, cleanString($provider));
	$sheet->setCellValue('F'.$xlsRow, cleanString($ruc));
	$sheet->setCellValue('G'.$xlsRow, '');
	$sheet->setCellValue('H'.$xlsRow, cleanString($phone));
	$sheet->setCellValue('I'.$xlsRow, $thisBAmount);
	$sheet->setCellValue('J'.$xlsRow, $thisRAmount);
	$sheet->setCellValue('K'.$xlsRow, cleanString($row['description']));
	$sheet->setCellValue('L'.$xlsRow, cleanString($row['cnumber']));
	$sheet->setCellValue('M'.$xlsRow, $billdata);
	$sheet->setCellValue('N'.$xlsRow, $status);
	$sheet->setCellValue('O'.$xlsRow, $status2);
	$sheet->setCellValue('P'.$xlsRow, $thisRoute);
	$sheet->setCellValue('Q'.$xlsRow, $batchs); 
	
	$xlsRow++;

}
	
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteImi.xlsx"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

function cleanString($string){
	
	return $result = preg_replace("/[^A-Za-z0-9?![:space:]]/", "", $string);
	
}
	
?>