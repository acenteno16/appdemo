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

xlsWriteLabel(0,0,"Fecha_Retencion");
xlsWriteLabel(0,1,"Numero_Retencion");
xlsWriteLabel(0,2,"Serie");
xlsWriteLabel(0,3,"Nombre_y_Apellido_o_Razon_Social");
xlsWriteLabel(0,4,"Ruc");
xlsWriteLabel(0,5,"Cedula");
xlsWriteLabel(0,6,"Telefono");
xlsWriteLabel(0,7,"Monto_Facturado");
xlsWriteLabel(0,8,"Monto_Retenido");
xlsWriteLabel(0,9,"Concepto");
xlsWriteLabel(0,10,"Cheque");
xlsWriteLabel(0,11,"Factura");

$xlsRow = 1; 

$id = $_POST['theid'];
$idsize = sizeof($id);
for($r0=0;$r0<$idsize;$r0++){
$querymain = "select * from mayorcontent where package = '$id[$r0]'";
$resultmain = mysqli_query($con, $querymain);
while($rowmain=mysqli_fetch_array($resultmain)){
	
	$query = "select * from payments where id = '$rowmain[payment]'";
	$result = mysqli_query($con, $query);
	$row=mysqli_fetch_array($result);
	
	//$today = date('d-m-Y',strtotime($row['today']));
	$today = $row['today'];
	$rowret = mysqli_fetch_array(mysqli_query($con, "select * from hallsretention where id = '$row[ret1id]'"));
	$number = $rowret['number'];
	$serial = $rowret['serial'];
	if($row['btype'] == 1){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
		$provider = $rowprovider['name'];
		$ruc = $rowprovider['ruc'];
		$phone = $rowprovider['phone'];
	}else{
		$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'")); 
		$provider = $rowcollaborator['first']." ".$rowcollaborator['last'];
		$nid = $rowcollaborator['nid'];
	}
	 
	/* $querybank = "select * from banks where id = '$row[bank]'";
	 $resultbank = mysqli_query($con, $querybank);
	 $rowbank = mysqli_fetch_array($resultbank);
	 $bank = $rowbank['name'];
	 */
	 
	  $totalbills = 0;
	  $totalrets = 0;
	  $billnumbers = "";
	  $querybills = "select * from bills where payment = '$row[id]'";
	  $resultbills = mysqli_query($con, $querybills);
	  while($rowbills=mysqli_fetch_array($resultbills)){
		  
		  if($rowbills['ret1a'] > 0){
			  if($totalbills == 0){
				  $billdata=$rowbills['number'];
			  }
			  $billstotal = ($rowbills['stotal']+$rowbills['stotal2'])*$rowbills['tc'];
			  $totalbills += $billstotal;
			  $totalrets += $rowbills['ret1a']; 
		  }
		  
	  }
	
	$querycancellation = "select * from times where payment = '$row[id]' and stage = '14.00'";
    $resultcancellation = mysqli_query($con, $querycancellation);
    $rowcancellation = mysqli_fetch_array($resultcancellation);
	
	$today = $rowcancellation['today']; 
  
	xlsWriteLabel($xlsRow,0,$today);
	xlsWriteLabel($xlsRow,1,str_pad((int) $number,4,"0",STR_PAD_LEFT));
	xlsWriteLabel($xlsRow,2,$serial); 
	//xlsWriteLabel($xlsRow,2,);
	xlsWriteLabel($xlsRow,3,cleanString($provider));
	
	if($ruc != ""){
		if(($ruc[0] == 'j') or ($ruc[0] == "J")){
			xlsWriteLabel($xlsRow,4,cleanString($ruc));
		}else{
			xlsWriteLabel($xlsRow,5,cleanString($ruc));
		}
	}else{
		xlsWriteLabel($xlsRow,5,cleanString($nid));
	}  
	
	xlsWriteLabel($xlsRow,6,cleanString($phone));
	xlsWriteNumber($xlsRow,7,$totalbills);
	xlsWriteNumber($xlsRow,8,$totalrets); 
	xlsWriteLabel($xlsRow,9,cleanString($row['description']));
	xlsWriteNumber($xlsRow,10,cleanString($row['cnumber']));
	xlsWriteNumber($xlsRow,11,$billdata);  
		
	$xlsRow++;

}
	
}

xlsEOF();
exit();


function cleanString($string){
	
	return $result = preg_replace("/[^A-Za-z0-9?![:space:]]/", "", $string);
	
}
	
	
	
?>