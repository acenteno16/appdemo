<?php
/*
//Global
//$now = date('Y-m-d H:i:s');
$now = date('Y-m-d');

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=Proveedores-importantes-global-".$now.".xls"); 
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



$today = date('Y-m-d'); 

	xlsWriteLabel(0,0,"ID getPay");
	xlsWriteLabel(0,1,"Codigo Proveedor");
	xlsWriteLabel(0,2,"Nombre Proveedor");
	xlsWriteLabel(0,3,"RUC Proveedor");
	xlsWriteLabel(0,4,"Rubro");
	xlsWriteLabel(0,5,"Ciudad");
	xlsWriteLabel(0,6,"Pais");
	xlsWriteLabel(0,7,"Internacional");
	
	xlsWriteLabel(0,8,"Nombre Contacto");
	xlsWriteLabel(0,9,"Cargo Contacto");
	xlsWriteLabel(0,10,"Telefono Contacto");
	xlsWriteLabel(0,11,"Email Contacto");
	
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

$xlsRow = 1;
	
$theposition = 1;
$query = "select providers.* from providers inner join payments on payments.provider = providers.id where payments.btype = '1' and payments.status = '14' and ((payments.route = '1011') or (payments.route = '1046') or (payments.route = '1006')) group by payments.provider";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	if($row['international'] == 0){
		$is_updated = "No";
	}else{
		$is_updated = "Si"; 
	}
	
	xlsWriteNumber($xlsRow,0,$row[0]);
	xlsWriteLabel($xlsRow,1,$row['code']);
	xlsWriteLabel($xlsRow,2,cleanString($row['name']));
	xlsWriteLabel($xlsRow,3,$row['ruc']);
	xlsWriteLabel($xlsRow,4,cleanString($row['course']));
	xlsWriteLabel($xlsRow,5,$row['city']);
	xlsWriteLabel($xlsRow,6,$row['country']);
	xlsWriteLabel($xlsRow,7,$is_updated);
	$column = 8;
	$query_pcontact = "select * from providerscontacts where provider = '$row[id]' limit 4";
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
	
	//$theposition++;
	
	//xlsWriteLabel($xlsRow,9,cleanString($row['description']));
	//xlsWriteNumber($xlsRow,10,cleanString($row['cnumber']));

	$xlsRow++;
 
}

xlsEOF();
exit();


function cleanString($string){
	
	return $result = preg_replace("/[^A-Za-z0-9?![:space:]]/", "", $string);
	
}
*/	
?>