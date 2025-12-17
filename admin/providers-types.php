<?php
/*
//Solicitudes
//$now = date('Y-m-d H:i:s');
$now = date('Y-m-d');  

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=Proveedores-importantes-solicitudes-".$now.".xls"); 
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

xlsWriteLabel(0,0,"Clasificacion");
xlsWriteLabel(0,1,"Codigo Proveedor");
xlsWriteLabel(0,2,"Nombre Proveedor");
xlsWriteLabel(0,3,"Ruc Proveedor");


$xlsRow = 1;



$query = "select * from providers";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
	$letter = "X";
	
	$ruc = $row['ruc'];
	if(($ruc[0] == "j") or ($ruc[0] == "J")){
		$letter = "J";
	}
	if(($ruc[0] == "r") or ($ruc[0] == "R")){
		$letter = "R";
	}
	$cedula = $ruc;
	$cedula = str_replace('-','',$cedula);
	$cedula = str_replace(' ','',$cedula);
	
	if((strlen($cedula) == 14) and (isCedula($cedula) == true)){
		$letter = "N"; 
	}
	

	
	xlsWriteLabel($xlsRow,0,$letter);
	xlsWriteLabel($xlsRow,1,$row['code']);
	xlsWriteLabel($xlsRow,2,$row['name']); 
	xlsWriteLabel($xlsRow,3,$row['ruc']);  
	


	$xlsRow++;

}


xlsEOF();
exit();


function isCedula($val){
	
	$num = 0;
	
	if(is_numeric($val[0]) == true){ $num++; }
	if(is_numeric($val[1]) == true){ $num++; }
	if(is_numeric($val[2]) == true){ $num++; }
	if(is_numeric($val[3]) == true){ $num++; }
	if(is_numeric($val[4]) == true){ $num++; }
	if(is_numeric($val[5]) == true){ $num++; }
	if(is_numeric($val[6]) == true){ $num++; }
	if(is_numeric($val[7]) == true){ $num++; }
	if(is_numeric($val[8]) == true){ $num++; }
	if(is_numeric($val[9]) == true){ $num++; }
	if(is_numeric($val[10]) == true){ $num++; }
	if(is_numeric($val[11]) == true){ $num++; }
	if(is_numeric($val[12]) == true){ $num++; }
	if(is_string($val[13]) == true){ $num++; }
	
	if($num == 14){
		return true;
	}else{
		return false;
	}

}
*/

?>