<?php

exit();

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
	//include('fn-logout.php');
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

switch($company){
	case 0:
	$sql1 = " and payments.currency = '1'";
	break;
	case 1:
	$sql1 = " and payments.currency = '2'";
	break;
	case 2:
	$sql1 = " and payments.currency = '3'";
	break;
	case 3:
	$sql1 = " and payments.currency = '4'";
	break;
	case 4:
	$sql1 = " and payments.currency = '1' and payments.company = '1'";
	break;
	case 5:
	$sql1 = " and payments.currency = '2' and payments.company = '1'";
	break;
	case 6:
	$sql1 = " and payments.currency = '3' and payments.company = '1'";
	break;
	case 7:
	$sql1 = " and payments.currency = '4' and payments.company = '1'";
	break;
	case 8:
	$sql1 = " and payments.currency = '1' and payments.company = '2'";
	break;
	case 9:
	$sql1 = " and payments.currency = '2' and payments.company = '2'";
	break;
	case 10:
	$sql1 = " and payments.currency = '3' and payments.company = '2'";
	break;
	case 11:
	$sql1 = " and payments.currency = '4' and payments.company = '2'";
	break;
	case 12:
	$sql1 = " and payments.currency = '1' and payments.company = '3'";
	break;
	case 13:
	$sql1 = " and payments.currency = '2' and payments.company = '3'";
	break;
	case 14:
	$sql1 = " and payments.currency = '3' and payments.company = '3'";
	break;
	case 15:
	$sql1 = " and payments.currency = '4' and payments.company = '3'";
	break;
	case 16:
	$sql1 = " and payments.currency = '1' and payments.company > '3'";
	break;
	case 17:
	$sql1 = " and payments.currency = '2' and payments.company > '3'";
	break;
	case 18:
	$sql1 = " and payments.currency = '3' and payments.company > '3'";
	break;
	case 19:
	$sql1 = " and payments.currency = '4' and payments.company > '3'";
	break; 
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

	xlsWriteLabel(0,0,"#");
	xlsWriteLabel(0,1,"Codigo Proveedor");
	xlsWriteLabel(0,2,"Nombre Proveedor");
	xlsWriteLabel(0,3,"RUC Proveedor");
	xlsWriteLabel(0,4,"Rubro");
	xlsWriteLabel(0,5,"Ciudad");
	xlsWriteLabel(0,6,"Pais");
	xlsWriteLabel(0,7,"Moneda");
	xlsWriteLabel(0,8,"Monto");
	xlsWriteLabel(0,9,"Actualizado");
	
	xlsWriteLabel(0,10,"Nombre Contacto");
	xlsWriteLabel(0,11,"Cargo Contacto");
	xlsWriteLabel(0,12,"Telefono Contacto");
	xlsWriteLabel(0,13,"Email Contacto");
	
	xlsWriteLabel(0,14,"Nombre Contacto");
	xlsWriteLabel(0,15,"Cargo Contacto");
	xlsWriteLabel(0,16,"Telefono Contacto");
	xlsWriteLabel(0,17,"Email Contacto");
	
	xlsWriteLabel(0,18,"Nombre Contacto");
	xlsWriteLabel(0,19,"Cargo Contacto");
	xlsWriteLabel(0,20,"Telefono Contacto");
	xlsWriteLabel(0,21,"Email Contacto");
	
	xlsWriteLabel(0,22,"Nombre Contacto");
	xlsWriteLabel(0,23,"Cargo Contacto");
	xlsWriteLabel(0,24,"Telefono Contacto");
	xlsWriteLabel(0,25,"Email Contacto");

$xlsRow = 1;

$theposition = 1;
$querypresidentprovider1 = "select sum(payments.payment), payments.provider, payments.currency from payments inner join times on payments.id = times.payment where payments.btype = '1' and times.stage >= '14'".$sql." group by payments.provider order by sum(payments.payment) desc limit 500";   
$resultpresidentprovider1 = mysqli_query($con, $querypresidentprovider1);  
$numpresidentprovider1 = mysqli_num_rows($resultpresidentprovider1);
while($rowpresidentprovider1=mysqli_fetch_array($resultpresidentprovider1)){
	
$provider = $rowpresidentprovider1[1];

$querypresidentprovider2 = "select * from providers where id = '$rowpresidentprovider1[1]'";
$resultpresidentprovider2 = mysqli_query($con, $querypresidentprovider2);
$rowpresidentprovider2 = mysqli_fetch_array($resultpresidentprovider2);

$querypresidentprovider3 = "select * from currency where id = $rowpresidentprovider1[2]";
$resultpresidentprovider3 = mysqli_query($con, $querypresidentprovider3);
$rowpresidentprovider3 = mysqli_fetch_array($resultpresidentprovider3);
	
$the_provider_code = $rowpresidentprovider2['code'];
$the_provider_name = $rowpresidentprovider2['name'];
$the_provider_ruc = $rowpresidentprovider2['ruc']; 
	
	$today = date("d-m-Y", strtotime($row['today']));
	
	if($rowpresidentprovider2['updated'] == 0){
		$is_updated = "No";
	}else{
		$is_updated = "Si"; 
	}
	
	
	
	xlsWriteNumber($xlsRow,0,$theposition);
	xlsWriteLabel($xlsRow,1,$the_provider_code);
	xlsWriteLabel($xlsRow,2,$the_provider_name);
	xlsWriteLabel($xlsRow,3,$the_provider_ruc);
	xlsWriteLabel($xlsRow,4,$rowpresidentprovider2['course']);
	xlsWriteLabel($xlsRow,5,$rowpresidentprovider2['city']);
	xlsWriteLabel($xlsRow,6,$rowpresidentprovider2['country']);
	xlsWriteLabel($xlsRow,7,$rowpresidentprovider3['pre']);
	xlsWriteNumber($xlsRow,8,$rowpresidentprovider1[0]); 
	xlsWriteLabel($xlsRow,9,$is_updated); 
	$column = 10;
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