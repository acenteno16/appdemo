<?php

exit();

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=CasaPellasGetPay.xls"); 
header("Content-Transfer-Encoding: binary ");

if(!isset($_SESSION)){ 
	session_start(); 
}

if(($_SESSION["generalsession"] == "active") or ($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['spellas'] == "active")){
	include("../connection.php"); 
}else{
	if(isset($_SESSION)){ 
		session_destroy();
	}
	header("location: ../?err=nosession_sessions");	  
} 


// ----- begin of function library ----- 
// Excel begin of file header 
function xlsBOF() { 
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);  
    return; 
} 
// Excel end of file footer 
function xlsEOF() { 
    echo pack("ss", 0x0A, 0x00); 
    return; 
} 
// Function to write a Number (double) into Row, Col 
function xlsWriteNumber($Row, $Col, $Value) { 
    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0); 
    echo pack("d", $Value); 
    return; 
} 
// Function to write a label (text) into Row, Col 
function xlsWriteLabel($Row, $Col, $Value ) { 
    $L = strlen($Value); 
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L); 
    echo $Value; 
return; 
} 
// ----- end of function library ----- 

xlsBOF();

xlsWriteLabel(0,0,"No RUC");
xlsWriteLabel(0,1,"Nombres y Apellidos o Razon Social");
xlsWriteLabel(0,2,"Ingresos Brutos Mensuales");
xlsWriteLabel(0,3,"Valor Cotizacion INSS");
xlsWriteLabel(0,4,"Valor Fondo Pensiones Ahorro");
xlsWriteLabel(0,5,"Base Imponible");
xlsWriteLabel(0,6,"Valor Retenido");
xlsWriteLabel(0,7,"Alicuota de Retencion");
xlsWriteLabel(0,8,"Codigo de Renglon");
xlsWriteLabel(0,9,"IDS");
xlsWriteLabel(0,10,"No");
xlsWriteLabel(0,11,"Documento");
xlsWriteLabel(0,12,"Fecha Documento");
xlsWriteLabel(0,13,"Anulada");
xlsWriteLabel(0,14,"Unidad");
xlsWriteLabel(0,15,"Batch"); 
 

$xlsRow = 1; 

$id = $_POST['theid'];
$idsize = sizeof($id);
for($r0=0;$r0<$idsize;$r0++){

	$queryret = "select * from irretention where id = '$id[$r0]'";
  	$resultret = mysqli_query($con, $queryret);
  	$rowret = mysqli_fetch_array($resultret);
	
	$query = "select * from payments where id = '$rowret[payment]'";
	$result = mysqli_query($con, $query);
	$row=mysqli_fetch_array($result);
	
	$acp = $row['acp2'];
	$today = $row['today'];
	$ruc = ""; 
	if($row['btype'] == 1){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
		$provider = $rowprovider['name'];
		$ruc = $rowprovider['ruc'];
		
	}
	else{
		$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'")); 
		$provider = $rowcollaborator['first']." ".$rowcollaborator['last'];
		$ruc = $rowcollaborator['nid'];
	}
	
	  $billnumbers = "";
	  $querybills = "select * from bills where payment = '$row[id]' and ret2a > '0'"; 
	  $resultbills = mysqli_query($con, $querybills);
	  $billdate = "";
	  $totalbills = 0;
	  $totalrets = 0;
	  $billstotal = 0;
	  while($rowbills=mysqli_fetch_array($resultbills)){
	  
	  
	  
		  $billnumber = $rowbills['number'];
		  $billdate = date('d-m-Y',strtotime($rowbills['billdate']));
		  
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
	
	xlsWriteLabel($xlsRow,0,cleanString($ruc));
	xlsWriteLabel($xlsRow,1,cleanString($provider));
	
	$totalbills = number_format($totalbills,2);
	$totalbills = str_replace(',','',$totalbills);
	
	$totalrets = number_format($totalrets,2);
	$totalrets = str_replace(',','',$totalrets);
	
	xlsWriteNumber($xlsRow,7,$row['ret2']);
	xlsWriteNumber($xlsRow,8,$retcode);
	xlsWriteLabel($xlsRow,9,$rowret['payment']);
	xlsWriteLabel($xlsRow,10,$rowret['number']);
	
	if($rowret['void'] == 1){
		//Si
		xlsWriteNumber($xlsRow,5,"0",2);
		xlsWriteNumber($xlsRow,6,"0"); 
		xlsWriteLabel($xlsRow,13,"Si");
		
	}else{
		//No 
		xlsWriteNumber($xlsRow,5,$totalbills,2);
		xlsWriteNumber($xlsRow,6,$totalrets); 
		xlsWriteLabel($xlsRow,13,"No");
	}
	
	xlsWriteLabel($xlsRow,11, $billnumber);
	xlsWriteLabel($xlsRow,12, $billdate);
	
	$queryroute = "select * from units where code = '$row[route]' or code2 = '$row[route]'";
	$resulroute = mysqli_query($con, $queryroute);
	$rowroute = mysqli_fetch_array($resulroute);
	
	xlsWriteLabel($xlsRow,14,$row['route']." ".$rowroute['name']);
	
	$batchs = "";
	$querybatch = "select * from batch where payment = '$row[id]'";
	$resultbatch = mysqli_query($con, $querybatch);
	while($rowbatch = mysqli_fetch_array($resultbatch)){
		$batchs.=$rowbatch['nobatch'].', '; 
	}
	$batchs = substr($batchs, 0, -2);
	xlsWriteLabel($xlsRow,15,$batchs);
	
		
	$gtotalrets += $totalrets;   
	$xlsRow++; 
	
	}

}

xlsWriteLabel($xlsRow,5,'TOTAL');
xlsWriteNumber($xlsRow,6,$gtotalrets);  


xlsEOF();
exit();

function cleanString($string){ 
	
	return $result = preg_replace("/[^A-Za-z0-9?![:space:]]/", "", $string);
	
}
	

?>