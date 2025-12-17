<?php

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=CasaPellasGetPay.xls"); 
header("Content-Transfer-Encoding: binary ");


include("../connection.php"); 


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
xlsWriteLabel(0,9,"Estado");
xlsWriteLabel(0,10,"No");

$xlsRow = 1; 

$id = $_POST['theid'];
$idsize = sizeof($id);
for($r0=0;$r0<$idsize;$r0++){
	
$query = "select * from payments where id = '$id[$r0]'";  
$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
	
	$acp = $row['retainer3'];
	$today = $row['today'];
	
	if($row['btype'] == 1){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
		$provider = $rowprovider['name'];
		$ruc = $rowprovider['ruc'];
		
	}
	else{
		$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'")); 
		$provider = $rowcollaborator['first']." ".$rowcollaborator['last'];
		$nid = $rowcollaborator['nid'];
	}
	
	  $billnumbers = "";
	  $querybills = "select * from bills where payment = '$row[id]'";
	  $resultbills = mysqli_query($con, $querybills);
	  $billdata = "";
	  $totalbills = 0;
	  $totalrets = 0;
	  $billstotal = 0;
	  while($rowbills=mysqli_fetch_array($resultbills)){
		  $billnumbers .= $rowbills['number'].', ';
		  $billdates.= date('d-m-Y',strtotime($rowbills['billdate'])).', ';
		  
		  if($rowbills['ret2a'] > 0){
			  
			  $billstotal = ($rowbills['stotal']+$rowbills['stotal2']-$rowbills['exempt'])*$rowbills['tc'];
			  
			  if($acp == 1){
				  
				  //DONDE
				  //percent2acp el el % de incremento
				  //p2 es el porcentaje de la retencion (2% o el 10% usualmente)
				  //stotalbillnio es el subtotal que graba + el subtotal que no graba
				  
				  $billstotal = 0;
				  $percent2acp = (100-$rowbills['ret2'])/100;
				  $p2acp = $billstotal*($rowbills['ret2']/100);
				  $basepr = $p2acp/$percent2acp;
				   
			  }else{
				  $basepr = $billstotal;  
			  }
			  
			  $billstotal = $basepr; 
			  //$billdata.="F#".$rowbills['number']." / C$".number_format($billstotal,2)." / C$".number_format($rowbills['ret1a'],2).",    ";
			  
			  $totalbills += $billstotal;
			  $totalrets += $rowbills['ret2a'];  
		  }
	  }
	 
	xlsWriteLabel($xlsRow,0,cleanString($ruc));
	xlsWriteLabel($xlsRow,1,cleanString($provider));
	
	$totalbills = number_format($totalbills,2);
	$totalbills = str_replace(',','',$totalbills);
	
	$totalrets = number_format($totalrets,2);
	$totalrets = str_replace(',','',$totalrets);
	
	xlsWriteNumber($xlsRow,5,$totalbills,2);
	xlsWriteNumber($xlsRow,6,$totalrets); 
	xlsWriteNumber($xlsRow,7,$row['ret2']);
	
	if($row['status'] == 14){
		$status = "Finalizado (Tesoreria)";
	}else{
		$status = "Cancelado (CFO)";
	}
	
	xlsWriteLabel($xlsRow,9,$status);
	
	$queryret = "select * from irretention where id = '$row[ret2id]'";
	$resultret = mysqli_query($con, $queryret);
	$rowret = mysqli_fetch_array($resultret); 
	
	xlsWriteLabel($xlsRow,10,$rowret['number']);
	
	$gtotalrets += $totalrets;  
	$xlsRow++; 


}

////////////
xlsWriteLabel($xlsRow,5,'TOTAL');
xlsWriteNumber($xlsRow,6,$gtotalrets);  



xlsEOF();
exit();

function cleanString($string){
	
	return $result = preg_replace("/[^A-Za-z0-9?![:space:]]/", "", $string);
	
}
	

?>