<?php

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

if(($_SESSION["generalsession"] == "active")){
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

xlsWriteLabel(2,0,"IDS");
xlsWriteLabel(2,1,"Ingreso a Tesoreria");
xlsWriteLabel(2,2,"Cancelacion");
xlsWriteLabel(2,3,"Dias");

$xlsRow = 3;
$from1 = $_GET['from'];
$from = date("Y-m-d", strtotime($from1)); 

$to1 = $_GET['to'];
$to = date("Y-m-d", strtotime($to1)); 								
								
$i=0;

$query = "select payments.id, times.today from payments inner join times on payments.id = times.payment where times.stage = '14.00' and times.today >= '$from' and times.today <= '$to' group by times.payment";   
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result); 

xlsWriteLabel(1,0,'Solicitudes:');
xlsWriteNumber(1,1,$num);

while($row=mysqli_fetch_array($result)){
	$query1a = "select today from times where stage = '9.00' and payment = '$row[0]' order by id desc limit 1";
	$result1a = mysqli_query($con, $query1a);
	$row1a = mysqli_fetch_array($result1a);
	$today1a = $row1a['today'];
	
	//Fecha 1b (Contros de calidad)
	$query1b = "select today from times where stage = '8.03' and payment = '$row[0]' order by id desc limit 1";
	$result1b = mysqli_query($con, $query1b);
	$row1b = mysqli_fetch_array($result1b);
	$today1b = $row1b['today'];
	
	//Fecha mas alta
	if($today1a > $today1b){
		$today1 = $today1a;
	}else{
		$today1 = $today1b; 
	}
	$today2 = $row[1];
	$days = (strtotime($today2)-strtotime($today1))/86400;

	xlsWriteNumber($xlsRow,0,$row[0]);
	xlsWriteLabel($xlsRow,1,$today1);
	xlsWriteLabel($xlsRow,2,$today2);
	xlsWriteNumber($xlsRow,3,$days);
	
	$sumdays+= $days;
	$i++;	 
	$xlsRow++;

}
xlsWriteLabel(0,0,'PROM:');
xlsWriteNumber(0,1,number_format($sumdays/$i,2));  


xlsEOF();
exit();	

?>