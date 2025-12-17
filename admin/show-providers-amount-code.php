<?php

//Global 
//$now = date('Y-m-d H:i:s');

$now = date('Y-m-d');
$provider = $_POST['provider'];
$company = $_POST['company'];
$today = date('Y-m-d'); 
$from = $_POST['from'];
$to = $_POST['to'];

if($from == ""){
	echo "<script>alert('Seleccione fecha de inicio.');history.go(-1);</script>";
	exit();
}else{
	$from = date("Y-m-d", strtotime($from));
}
if($to == ""){
	echo "<script>alert('Seleccione fecha de fin.');history.go(-1);</script>";
	exit(); 
}else{
	$to = date("Y-m-d", strtotime($to));
} 


$sql0 = "";
if($provider != ""){
    $sql0 = " and id = '$provider'";
}
$sql1 = "";
if($company != ""){
	$sql1 = " and payments.company = '$company'";
}
$sql2 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql2 = " and times.today >= '$from'";
}
$sql3 = "";
if($to != ""){ 
	$to = date("Y-m-d", strtotime($to));
	$sql3 = " and times.today <= '$to'";
}

$sql = $sql1.$sql2.$sql3;

$companyname = "Todas";
if($copany != ""){
    $querycompany = "select name from companies where id = '$company'";
    $resultcompany = mysqli_query($con, $querycompany);
    $rowcompany = mysqli_fetch_array($resultcompany);
    $companyname = $rowcompany['name'];  
}


header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=Reporte-Proveedores-montos-".$now.".xls"); 
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



	xlsWriteLabel(0,0,"Compañía: ".$companyname); 
	xlsWriteLabel(2,0,"Monto en Dólares");
	xlsWriteLabel(2,1,"Monto en Córdobas");
	xlsWriteLabel(2,2,"Codigo Proveedor");
	xlsWriteLabel(2,3,"Nombre Proveedor");
	xlsWriteLabel(2,4,"RUC Proveedor");
	xlsWriteLabel(2,5,"Rubro");
	xlsWriteLabel(2,6,"Ciudad");
	xlsWriteLabel(2,7,"Pais");
	xlsWriteLabel(2,8,"Actualizado");
	xlsWriteLabel(2,9,"VIP");
	xlsWriteLabel(2,10,"Internacional");
	xlsWriteLabel(2,11,"Moneda de pago");
	xlsWriteLabel(2,12,"Pagos en Curso");
	xlsWriteLabel(2,13,"Nombre Contacto");
	xlsWriteLabel(2,14,"Cargo Contacto");
	xlsWriteLabel(2,15,"Telefono Contacto");
	xlsWriteLabel(2,16,"Email Contacto");
	xlsWriteLabel(2,17,"Nombre Contacto");
	xlsWriteLabel(2,18,"Cargo Contacto");
	xlsWriteLabel(2,19,"Telefono Contacto");
	xlsWriteLabel(2,20,"Email Contacto");
	xlsWriteLabel(2,21,"Nombre Contacto");
	xlsWriteLabel(2,22,"Cargo Contacto");
	xlsWriteLabel(2,23,"Telefono Contacto");
	xlsWriteLabel(2,24,"Email Contacto");
	xlsWriteLabel(2,25,"Nombre Contacto");
	xlsWriteLabel(2,26,"Cargo Contacto");
	xlsWriteLabel(2,27,"Telefono Contacto");
	xlsWriteLabel(2,28,"Email Contacto");

$xlsRow = 3;
$theposition = 1;

$querypresidentprovider2 = "select * from providers where id > 0".$sql0." order by id";
$resultpresidentprovider2 = mysqli_query($con, $querypresidentprovider2);
while($rowpresidentprovider2 = mysqli_fetch_array($resultpresidentprovider2)){
	
$the_provider_code = $rowpresidentprovider2['code'];
$the_provider_name = $rowpresidentprovider2['name'];
$the_provider_ruc = $rowpresidentprovider2['ruc'];  
	
	
	if($rowpresidentprovider2['updated'] == 0){
		$is_updated = "No";
	}
	else{
		$is_updated = "Si"; 
	}
	
	if($rowpresidentprovider2['flag'] == 0){
		$is_vip = "No";
	}
	else{
		$is_vip = "Si"; 
	}
	
	switch($rowpresidentprovider2['international']){
		case 0:
		$international = "No";
		break;
		case 1:
		$international = "Si";
		break;
	}
	
	switch($rowpresidentprovider2['currency']){
		case 1:
		$currency = "Cordobas";
		break;
		case 2:
		$currency = "Dolares";
		break;
	}
	
	
	$nioamount = 0;
	$usdamount = 0;
	$query_payments = "select payments.payment, payments.currency from payments inner join times on payments.id = times.payment where payments.provider = '$rowpresidentprovider2[id]' and payments.btype = '1' and times.stage = '14'".$sql;    
	$result_payments = mysqli_query($con, $query_payments); 
	while($row_payments=mysqli_fetch_array($result_payments)){
		if($row_payments['currency'] == 1){
			$nioamount+= $row_payments['payment'];
		}elseif($row_payments['currency'] == 2){
			$usdamount+= $row_payments['payment'];
		}
		
	}
	
	xlsWriteNumber($xlsRow,0,$usdamount);
	xlsWriteNumber($xlsRow,1,$nioamount);
	xlsWriteLabel($xlsRow,2,$the_provider_code);
	xlsWriteLabel($xlsRow,3,$the_provider_name);
	xlsWriteLabel($xlsRow,4,$the_provider_ruc);
	xlsWriteLabel($xlsRow,5,$rowpresidentprovider2['course']);
	xlsWriteLabel($xlsRow,6,$rowpresidentprovider2['city']);
	xlsWriteLabel($xlsRow,7,$rowpresidentprovider2['country']);
	xlsWriteLabel($xlsRow,8,$is_updated); 
	xlsWriteLabel($xlsRow,9,$is_vip);
	xlsWriteLabel($xlsRow,10,$international);
	xlsWriteLabel($xlsRow,11,$currency);
	xlsWriteLabel($xlsRow,12,$num_payments);
	
	$column = 13;
	$query_pcontact = "select * from providerscontacts where provider = '$rowpresidentprovider2[id]' limit 4";
	$result_pcontact = mysqli_query($con, $query_pcontact);
	while($row_pcontact=mysqli_fetch_array($result_pcontact)){
		
		xlsWriteLabel($xlsRow,$column,$row_pcontact['cname']);
		$column++;
		xlsWriteLabel($xlsRow,$column,$row_pcontact['cjob']);
		$column++;
		xlsWriteLabel($xlsRow,$column,$row_pcontact['cphone']);
		$column++;
		xlsWriteLabel($xlsRow,$column,$row_pcontact['cemail']);
		$column++;
	}
	
	$theposition++;
	
	//xlsWriteLabel($xlsRow,9,cleanString($row['description']));
	//xlsWriteNumber($xlsRow,10,cleanString($row['cnumber']));

	$xlsRow++;
 
}

xlsEOF();
exit();

function cleanString($string){
	
	return $result = preg_replace("/[^A-Za-z0-9?![:space:]]/", "", $string);
	
}
	
?>