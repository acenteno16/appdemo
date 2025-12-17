<?php 

//Global
//$now = date('Y-m-d H:i:s');
$now = date('Y-m-d');

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=Reporte-Proveedores-".$now.".xls"); 
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



$today = date('Y-m-d'); 
$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$company = $_GET['type'];
$from = $_GET['from'];
$to = $_GET['to'];

$sqldatea = 0;

$sqldate = $sqlfrom.$sqlto;

	xlsWriteLabel(0,0,"#");
	xlsWriteLabel(0,1,"Codigo Proveedor");
	xlsWriteLabel(0,2,"Nombre Proveedor");
	xlsWriteLabel(0,3,"RUC Proveedor");
	xlsWriteLabel(0,4,"Rubro");
	xlsWriteLabel(0,5,"Ciudad");
	xlsWriteLabel(0,6,"Pais");
	xlsWriteLabel(0,7,"Actualizado");
	xlsWriteLabel(0,8,"VIP");
	xlsWriteLabel(0,9,"Internacional");
	xlsWriteLabel(0,10,"Moneda de pago");
	xlsWriteLabel(0,11,"Pagos en Curso");
	xlsWriteLabel(0,12,"Nombre Contacto");
	xlsWriteLabel(0,13,"Cargo Contacto");
	xlsWriteLabel(0,14,"Telefono Contacto");
	xlsWriteLabel(0,15,"Email Contacto");
	xlsWriteLabel(0,16,"Nombre Contacto");
	xlsWriteLabel(0,17,"Cargo Contacto");
	xlsWriteLabel(0,18,"Telefono Contacto");
	xlsWriteLabel(0,19,"Email Contacto");
	xlsWriteLabel(0,20,"Nombre Contacto");
	xlsWriteLabel(0,21,"Cargo Contacto");
	xlsWriteLabel(0,22,"Telefono Contacto");
	xlsWriteLabel(0,23,"Email Contacto");
	xlsWriteLabel(0,24,"Nombre Contacto");
	xlsWriteLabel(0,25,"Cargo Contacto");
	xlsWriteLabel(0,26,"Telefono Contacto");
	xlsWriteLabel(0,27,"Email Contacto");

$xlsRow = 1;

$theposition = 1;
 
$querypresidentprovider2 = "select * from providers order by id";
$resultpresidentprovider2 = mysqli_query($con, $querypresidentprovider2);
while($rowpresidentprovider2 = mysqli_fetch_array($resultpresidentprovider2)){
	
$the_provider_code = $rowpresidentprovider2['code'];
$the_provider_name = $rowpresidentprovider2['name'];
$the_provider_ruc = $rowpresidentprovider2['ruc']; 
	
	
	if($rowpresidentprovider2['updated'] == 0){
		$is_updated = "No";
	}else{
		$is_updated = "Si"; 
	}
	
	
	if($rowpresidentprovider2['flag'] == 0){
		$is_vip = "No";
	}else{
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
	
	
	$query_payments = "select id from payments where provider = '$rowpresidentprovider2[id]' and approved != '2' and status < '14'";
	$result_payments = mysqli_query($con, $query_payments);
	$num_payments = mysqli_num_rows($result_payments);
	
	
	xlsWriteNumber($xlsRow,0,$theposition);
	xlsWriteLabel($xlsRow,1,$the_provider_code);
	xlsWriteLabel($xlsRow,2,$the_provider_name);
	xlsWriteLabel($xlsRow,3,$the_provider_ruc);
	xlsWriteLabel($xlsRow,4,$rowpresidentprovider2['course']);
	xlsWriteLabel($xlsRow,5,$rowpresidentprovider2['city']);
	xlsWriteLabel($xlsRow,6,$rowpresidentprovider2['country']);
	xlsWriteLabel($xlsRow,7,$is_updated); 
	xlsWriteLabel($xlsRow,8,$is_vip);
	xlsWriteLabel($xlsRow,9,$international);
	xlsWriteLabel($xlsRow,10,$currency);
	xlsWriteLabel($xlsRow,11,$num_payments);
	
	$column = 12;
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