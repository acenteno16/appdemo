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
include('online.php');

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

$from1 = $_POST['categoriesfrom'];
$from = date("Y-m-d", strtotime($from1));
$to1 = $_POST['categoriesto'];
$to = date("Y-m-d", strtotime($to1)); 
$currency = $_POST['currency'];
$unit = $_POST['categoriescompany'];

xlsBOF();

xlsWriteLabel(0,0,"Distribuciones de la UN: ".$unit." del: ".$from1." al: ".$to1);

xlsWriteLabel(1,0,"Tipo"); 
xlsWriteLabel(1,1,"Concepto");
xlsWriteLabel(1,2,"Categoria");
xlsWriteLabel(1,3,"Compañia");
xlsWriteLabel(1,4,"UN");
xlsWriteLabel(1,5,"Moneda");
xlsWriteLabel(1,6,"Monto");
xlsWriteLabel(1,7,"IDS");
xlsWriteLabel(1,8,"Fecha");
xlsWriteLabel(1,9,"Mes");
xlsWriteLabel(1,10,"Proveedor/Colaborador");
xlsWriteLabel(1,11,"Descripción");


$xlsRow = 2; 


if($from1 != ""){
	$sql1 = " and times.today >= '$from'";
}
if($to1 != ""){
	$sql2 = " and times.today <= '$to'";
}
if($unit != ""){
	$sql3 = " and payments.route = '$unit'";
}

$sql = $sql1.$sql2.$sql3;

$query = "select payments.id, payments.currency, times.today, payments.description, payments.btype, payments.provider, payments.collaborator from payments inner join times on payments.id = times.payment where payments.distributable = '1'".$sql." group by payments.id";   
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

while($row=mysqli_fetch_array($result)){
	
    //$rowtype = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = ''"));
	
	if($row[4] == 1){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[5]'"));
		$beneficiary = $rowprovider['name'];
	}elseif($row[4] == 2){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[6]'"));
		$beneficiary = $rowprovider['first']." ".$rowprovider['last'];
	}
	
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select currency.name from currency where id = '$row[1]'"));
	$currency = $rowcurrency['name'];
	unset($types);  
	$types = array();
	unset($concepts);  
	$concepts = array();
	unset($concepts2);  
	$concepts2 = array();  
	
	$querybills = "select * from bills where payment = '$row[0]'";
	$resultbills = mysqli_query($con, $querybills);
	while($rowbills = mysqli_fetch_array($resultbills)){ 
		$types[] = $rowbills['type'];
		$concepts[] = $rowbills['concept'];
		$concepts2[] = $rowbills['concept2'];
	}
	$types = array_unique($types);
	$concepts = array_unique($concepts);
	$concepts2 = array_unique($concepts2); 
	
	$types_str = '';	
	for($c=0;$c<sizeof($types); $c++){
		$querytypes = "select * from categories where id = '$types[$c]'";
		$resulttypes = mysqli_query($con, $querytypes);
		$rowtypes = mysqli_fetch_array($resulttypes);
		$types_str.= $rowtypes['name'].', ';
	}
	
	$concepts_str = '';	
	for($c=0;$c<sizeof($concepts); $c++){
		$queryconcepts = "select * from categories where id = '$concepts[$c]'";
		$resultconcepts = mysqli_query($con, $queryconcepts);
		$rowconcepts = mysqli_fetch_array($resultconcepts);
		$concepts_str.= $rowconcepts['name'].', ';
	}
		
	$concepts2_str = '';	
	for($c=0;$c<sizeof($concepts2); $c++){
		$queryconcepts2 = "select * from categories where id = '$concepts2[$c]'"; 
		$resultconcepts2 = mysqli_query($con, $queryconcepts2);
		$rowconcepts2 = mysqli_fetch_array($resultconcepts2);
		$concepts2_str.= $rowconcepts2['name'].', '; 
	}
	
	
	
	
	$querydistribution = "select * from distribution where payment = '$row[0]'"; 
	$resultdistribution = mysqli_query($con, $querydistribution);
	while($rowdistribution=mysqli_fetch_array($resultdistribution)){
	
	
	$rowunit = mysqli_fetch_array(mysqli_query($con, "select units.name, units.company from units where code = '$rowdistribution[unit]'"));
	$theunit = $rowdistribution['unit']." | ".$rowunit[0];  
	$rowcompany = mysqli_fetch_array(mysqli_query($con, "select companies.name from companies where id = '$rowunit[company]'"));
	
		
	$today = date("d-m-Y", strtotime($row[2]));
	$month = date("n", strtotime($row[2]));
		switch($month){
			case 1:
			$mes = "Enero";
			break;
			case 2:
			$mes = "Febrero";
			break;
			case 3:
			$mes = "Marzo";
			break;
			case 4:
			$mes = "Abril";
			break;
			case 5:
			$mes = "Mayo";
			break;
			case 6:
			$mes = "Junio";
			break;
			case 7:
			$mes = "Julio";
			break;
			case 8:
			$mes = "Agosto";
			break;
			case 9:
			$mes = "Septiembre";
			break;
			case 10:
			$mes = "Octubre";
			break;
			case 11:
			$mes = "Noviembre";
			break;
			case 12:
			$mes = "Diciembre"; 
			break;
		}
		
		
	xlsWriteLabel($xlsRow,0,cleanString($types_str)); 
	xlsWriteLabel($xlsRow,1,cleanString($concepts_str));
	xlsWriteLabel($xlsRow,2,cleanString($concepts2_str));   
	xlsWriteLabel($xlsRow,3,cleanString($rowcompany[0]));
	xlsWriteLabel($xlsRow,4,$theunit); 
	xlsWriteLabel($xlsRow,5,cleanString($currency));  
	xlsWriteNumber($xlsRow,6,$rowdistribution['total']);  
	xlsWriteNumber($xlsRow,7,$row[0]); 
	xlsWriteLabel($xlsRow,8,$today); 
	xlsWriteLabel($xlsRow,9,$mes);
	xlsWriteLabel($xlsRow,10,$beneficiary);  
	xlsWriteLabel($xlsRow,11,$row[3]); 
		
	$xlsRow++;
	
	}
	
	
	

}

xlsEOF();
exit();


function cleanString($cadena){
	
	//return $result = preg_replace("/[^A-Za-z0-9?![:space:]]/", "", $string);
	$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    return utf8_encode($cadena);
}
	
	
	
?>