<?php

header("Pragma: public"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=CasaPellasGetPayVencidos.xls"); 
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

xlsWriteLabel(0,0,"IDS");
xlsWriteLabel(0,1,"UN");
xlsWriteLabel(0,2,"Proveedor/Colaborador");
xlsWriteLabel(0,3,"Total pagar");
xlsWriteLabel(0,4,"Ingreso");
xlsWriteLabel(0,5,"Vencimiento");
xlsWriteLabel(0,6,"Dias");
xlsWriteLabel(0,7,"Ingresado por");
xlsWriteLabel(0,8,"Aprobado1");


$xlsRow = 1; 

$sql = $_GET['sql']; 
	
 $query = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.payment, payments.bank, payments.status, payments.reference, payments.cnumber, times.today, payments.expiration, payments.userid, payments.route from payments inner join times on payments.id = times.payment where times.stage = '1.00'".$sql.' and payments.expiration <= times.today group by payments.id';  
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
 

while($row=mysqli_fetch_array($result)){ 
								
							
							
									
								if($row['btype'] == 1){
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$providercollaborator = $rowprovider['code']." | ".$rowprovider['name'];
								}else{
									$queryprovider = "select * from workers where id = '$row[collaborator]'";
									$rowprovider = mysqli_fetch_array(mysqli_query($con, $queryprovider));
								$providercollaborator = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
								} 
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								$rowworker = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
								$rowunit = mysqli_fetch_array(mysqli_query($con, "select name from units where (code = '$row[route]' or code2='$row[route]')"));
								$theunit = $row['route']." | ".$rowunit['name'];
	
	//Aprobado1
	//$rowta1 = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' and stage = '2.00'"));
	$rowta1 = mysqli_fetch_array(mysqli_query($con, "select worker from routes where unit = '$row[route]' and type = '2'"));
	$rowa1 = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$rowta1[worker]'"));  
	
	
	
	
	
	xlsWriteLabel($xlsRow,0,$row[id]);
	xlsWriteLabel($xlsRow,1,$theunit);
	xlsWriteLabel($xlsRow,2,$providercollaborator); 
	
	xlsWriteLabel($xlsRow,3,cleanString($rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2))));
	xlsWriteLabel($xlsRow,4,date("d-m-Y", strtotime($row[10]))); 
	xlsWriteLabel($xlsRow,5,date("d-m-Y", strtotime($row[11])));
	xlsWriteLabel($xlsRow,6,getExpiration($row[10],$row[11])); 
	xlsWriteLabel($xlsRow,7,$rowworker['first']." ".$rowworker['last']); 
	xlsWriteLabel($xlsRow,8,$rowa1['first']." ".$rowa1['last']);   
	
	
	
		
	$xlsRow++;

}

xlsEOF();
exit();


function cleanString($string){
	
	return $result = preg_replace("/[^A-Za-z0-9?![:space:]]/", "", $string);
	
}
function getExpiration($date1,$date2){
	
	$dias = (strtotime($date1)-strtotime($date2))/86400;
	
	if($dias <= -8) $parentesis = intval(abs($dias));
	if(($dias <= 0) and ($dias >= -7)) $parentesis =  intval(abs($dias));
	elseif($dias > 0) $parentesis = intval(-1*abs($dias));
	
	$vencimiento = $date3." ".$parentesis; 
	return($vencimiento); 
	
}	
	
	
?>