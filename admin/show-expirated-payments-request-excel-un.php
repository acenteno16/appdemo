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

xlsWriteLabel(0,0,"UN");
xlsWriteLabel(0,1,"No. Solicitudes");
xlsWriteLabel(0,2,"Vencidas");
xlsWriteLabel(0,3,"Aprobado 1");



$xlsRow = 1; 

$sql = $_GET['sql']; 
	

$query = "select payments.route, payments.headship from payments inner join times on payments.id = times.payment where times.stage = '1.00'".$sql." group by payments.route order by payments.route";   
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result); 

while($row=mysqli_fetch_array($result)){ 
								
	//Numero de pagos por UN
	$npayments = 0;
	$queryp = "select payments.id from payments inner join times on payments.id = times.payment where payments.route = '$row[route]' and times.stage = '1.00'".$sql;   
	$resultp = mysqli_query($con, $queryp);
	while($rowp=mysqli_fetch_array($resultp)){
		$npayments++;
	}
	//Pagos vencidos por UN
	$nexpirated = 0;
	$queryp = "select payments.id from payments inner join times on payments.id = times.payment where payments.route = '$row[route]' and times.stage = '1.00'".$sql." and payments.expiration <= times.today";   
	$resultp = mysqli_query($con, $queryp);
	while($rowp=mysqli_fetch_array($resultp)){
		$nexpirated++;
	}
									
	$rowunit = mysqli_fetch_array(mysqli_query($con, "select * from units where ((code = '$row[route]') or (code2 = '$row[route]')) "));
	
	xlsWriteLabel($xlsRow,0,cleanString($row['route']." | ".$rowunit['name'])); 
	xlsWriteNumber($xlsRow,1,$npayments); 
	xlsWriteNumber($xlsRow,2,$nexpirated);
	
	$queryroute = "select * from routes where unit = '$row[route]' and type = '2' group by worker"; 
	$resultroute = mysqli_query($con, $queryroute); 
	$numroute = mysqli_num_rows($resultroute);
		
	if($numroute > 0){
		$ap1 = "";
		while($rowroute = mysqli_fetch_array($resultroute)){
			$queryuser2 = "select * from workers where code = '$rowroute[worker]'"; 
			$resultuser2 = mysqli_query($con, $queryuser2);
			$rowuser2 = mysqli_fetch_array($resultuser2);
	
			$ap1.= $rowuser2['first']." ".$rowuser2['last'].' - ';
		}
		$ap1_str = substr($ap1,0,-2);
		xlsWriteLabel($xlsRow,3,cleanString($ap1_str));
	} 
		
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