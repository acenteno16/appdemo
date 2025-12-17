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

xlsWriteLabel(0,0,"ID");
xlsWriteLabel(0,1,"Solicitante");
xlsWriteLabel(0,2,"Estado");
xlsWriteLabel(0,3,"Usuario");
xlsWriteLabel(0,4,"Fecha");
xlsWriteLabel(0,5,"Motivo");
xlsWriteLabel(0,6,"Comentario"); 

$xlsRow = 1; 

$query = "select * from payments where approved = '2' order by id desc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);  


while($row=mysqli_fetch_array($result)){
							
								
								
								$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc")); 
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								$rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowuser2 = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$rowstatus[userid]'"));
								$rowreason = mysqli_fetch_array(mysqli_query($con, "select * from reason where id = '$row[reason]'"));
								
								$reason = $row['reason']."|".$rowreason['name'];
								
								if(($rowstatus['stage2'] != "0.00") and ($rowstatus['stage2'] != "")){  
								$color == "yellow";
								if($rowstatus['color'] != ""){
									$color = $rowstatus['color']; 
								}
								echo '<button type="button" class="btn '.$color.'">'.$rowstatus['stage2'].'</button>';
							}else{    
							$querystage = "select * from stages where id = '$rowstatus[stage]'";
								$resultstage = mysqli_query($con, $querystage);
								$rowstage = mysqli_fetch_array($resultstage);
							
							}
							
							
							$fecha = date('d-m-Y',strtotime($rowstatus['today']));
								
	xlsWriteLabel($xlsRow,0,$row['id']);
	xlsWriteLabel($xlsRow,1,$rowuser['first']." ".$rowuser['last']);
	xlsWriteLabel($xlsRow,2,$rowstage['name']);
	xlsWriteLabel($xlsRow,3,$rowuser2['first']." ".$rowuser2['last']);
	xlsWriteLabel($xlsRow,4,$fecha);
	xlsWriteLabel($xlsRow,5,$reason);
	xlsWriteLabel($xlsRow,6,$rowstatus['reason']); 
	
	$xlsRow++; 

}



xlsEOF();
exit();

function cleanString($string){ 
	
	return $result = preg_replace("/[^A-Za-z0-9?![:space:]]/", "", $string);
	
}
	

?>