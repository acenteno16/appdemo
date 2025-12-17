<? 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("session-reception.php");

$id = $_POST['id_envelope'];

$query_update = "update retentionenvelope set printed = '1' where id = '$id'";
$result_update = mysqli_query($con, $query_update);

require('fpdf-mctable.php');
ob_start();
//require('fpdf.php');
//$pdf=new FPDF();
#$pdf=new PDF_MC_Table('P','mm',array(240,100));  
$pdf = new PDF_MC_Table('P','mm','Letter');
  	
$query = "select * from retentionenvelope where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$pdf->AddPage();
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(false); 

$pdf->Image('../images/grupo-casa-pellas.jpg',10,10,90,10,'','');
  
$barcode2 = 'https://getpaycp.com/admin/barcode.php?text=e'.$row['id'].'&size=50';
$pdf->Image($barcode2,180,10,20,10,'PNG');

$id_number = $number = str_pad((int) $row['id'],3,"0",STR_PAD_LEFT);


if($row['type'] == 1){
	$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
	$providername = $rowuser['name'];
	$phone = $rowuser['phone'];
	$address = $rowuser['address'];
}else{
	$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[provider]'"));
	$providername = $rowuser['first'].' '.$rowuser['last'];
	$phone = $rowuser['phone'];
	$address = $rowuser['address'];
}

if($rowuser['location'] > 0){
$query_location = "select * from providerslocation where id = '$rowuser[location]'";
$result_location = mysqli_query($con, $query_location);
$row_location = mysqli_fetch_array($result_location);
$location = $row_location['name'];
$location_code = $row_location["code"];
}



$pdf->SetXY(160,27); 
$pdf->SetFont('Arial','B',22); 
$pdf->SetTextColor(0,0,0);


$pdf->Cell( 40, 0, utf8_decode($id_number), 0, 0, 'R' ); 
//$pdf->Write(3,utf8_decode($id_number), 'R');  
if($location_code != ""){
	$pdf->SetXY(160,37);
	$pdf->Cell( 40, 0, utf8_decode($location_code), 0, 0, 'R' );  
}





$y = 45;
//Remitente
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,utf8_decode($providername));

//$y = $y+3;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);

if($address != ""){
	$y = $y+4;
	$pdf->SetXY(10,$y);
	$pdf->Write(3,utf8_decode(''.$address)); 
}

if($phone != ""){
	$y = $y+4;
	$pdf->SetXY(10,$y);
	$pdf->Write(3,utf8_decode($phone)); 
}
$y = $y+20;
//Firma
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(10,$y);
$pdf->Write(3,'Grupo Casa Pellas.');
$y = $y+4;
$pdf->SetFont('Arial','',9);
$pdf->SetXY(10,$y);
$pdf->Write(3,utf8_decode('Rotonda El Gueguense 300 mts al Sur, 100 mts al Oeste.'));
$y = $y+4;
$pdf->SetXY(10,$y);
$pdf->Write(3,'Contiguo a PBS. Managua Nicaragua.');
$y = $y+4;
$pdf->SetXY(10,$y);
$pdf->Write(3,utf8_decode('2255-4444 Ext: 5380/5296'));
$y = $y+4;
$pdf->SetXY(10,$y);
$pdf->Write(3,'www.casapellas.com');  
  
$newfilename='sobre-'.$id.'.pdf';
$pdf->Output($newfilename, 'D'); 
//$filename="tosend/".$id.".pdf"; 
//$pdf->Output($filename,'F'); 
ob_end_flush();
 
//header('location: '.$_SERVER['HTTP_REFERER']);

?>