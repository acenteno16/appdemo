<?php

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("session-reception.php");

ob_start();

$id = $_GET['id'];
require('mc-table.php');
$pdf=new PDF_MC_Table();

$pdf->AddPage();
$pdf->SetMargins(10,10,10,10); 
$pdf->SetAutoPageBreak(false);
$pdf->Image('../images/grupo-casa-pellas.jpg',10,10,90,10,'','');

$barcode2 = 'https://getpaycp.com/admin/barcode.php?text=d'.$id.'&size=40';
$pdf->Image($barcode2,170,10,20,10,'PNG');


$querymain = "select * from retentionenveloperemission where id = '$id'";
$resultmain = mysqli_query($con, $querymain);
$rowmain = mysqli_fetch_array($resultmain);

$querycollector = "select * from collector where id = '$rowmain[collector]'";
$resultcollector = mysqli_query($con, $querycollector);
$rowcollector = mysqli_fetch_array($resultcollector);
$name_collector = $rowcollector['first']." ".$rowcollector['last'];

$queryuser = "select * from workers where code = '$rowmain[userid]'"; 
$resultuser = mysqli_query($con, $queryuser);
$rowuser = mysqli_fetch_array($resultuser);
$name_user = $rowuser['first']." ".$rowuser['last'];

$querylocation = "select * from providerslocation where id = '$rowmain[location]'"; 
$resultlocation = mysqli_query($con, $querylocation);
$rowlocation = mysqli_fetch_array($resultlocation);
$name_location = $rowlocation['name'];

$y = 30;
//Solicitante
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('Remisión de Retenciones IMI/IR.'));
  $y+=4;
  $pdf->SetFont('Arial','B',9);
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Fecha de creación: '.$rowmain['today']." @".$rowmain['now']));
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Usuario: '.$name_user));
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Colector: '.$name_collector));
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Sector: '.$name_location));
  $y+=10;
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','',8); 
  $pdf->SetTextColor(0,0,0);
  
  
//Table with 20 rows and 4 columns
$pdf->SetWidths(array(10,10,22,73,22,25,25));   
#srand(microtime()*1000000);
for($i=0;$i<1;$i++){
    $pdf->Row(array('No. Sobre','Tipo','No. Retencion','Proveedor','Valor Retenido','Factura', 'Recibido')); 
}
$i=0;
$query = "select * from retentionenveloperemissioncontent where enveloperemission = '$id'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$i++;
	
	#$pdate = date('d-m-Y',strtotime($rowstatus['today']));
	#$ptime = date('h:i:s a', strtotime($rowstatus['now2']));
	
	$queryenvelope = "select * from retentionenvelope where id = '$row[envelope]'"; 
	$resultenvelope = mysqli_query($con, $queryenvelope);
	$rowenvelope = mysqli_fetch_array($resultenvelope);
	if($rowenvelope['type'] == 1){
		$queryprovider = "select * from providers where id = '$rowenvelope[provider]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$name_provider = $rowprovider['name'];
	}else{
		$queryprovider = "select * from workers where code = '$rowenvelope[provider]'";
		$resultprovider = mysqli_query($con, $queryprovider);
		$rowprovider = mysqli_fetch_array($resultprovider);
		$name_provider = $rowprovider['first']." ".$rowprovider['last'];
	}
	
	
	
	$queryenvelopecontent = "select * from retentionenvelopecontent where envelope = '$rowenvelope[id]'";
	$resultenvelopecontent = mysqli_query($con, $queryenvelopecontent);
	while($rowenvelopecontent = mysqli_fetch_array($resultenvelopecontent)){
		//No se reconoce el tipo de retencion
		$type = "ERR1";
		$number = "";
		$envelope = $rowenvelopecontent['envelope'];
		//IMI
		if($rowenvelopecontent['type'] == 1){
			$type = "IMI";
			$querynum = "select hallsretention.serial, hallsretention.number, payments.ret1a, payments.id from hallsretention inner join payments on hallsretention.payment = payments.id where hallsretention.id = '$rowenvelopecontent[retention]'";
			$resultnum = mysqli_query($con, $querynum);
			$rownum = mysqli_fetch_array($resultnum);
			$number = $rownum['serial'].'-'.$rownum['number'];
			$amount = $rownum['ret1a']; 
		}
		//IR
		if($rowenvelopecontent['type'] == 2){
			$type = "IR";
			$querynum = "select irretention.number, payments.ret2a, payments.id from irretention inner join payments on irretention.payment = payments.id where irretention.id = '$rowenvelopecontent[retention]'";
			$resultnum = mysqli_query($con, $querynum);
			$rownum = mysqli_fetch_array($resultnum);
			$number = $rownum['number'];
			$amount = $rownum['ret2a'];
			
			
		}
		
		$querybills = "select number from bills where payment = '$rownum[id]'";
		$resultbill = mysqli_query($con, $querybills);
		$bills = "";
		while($rowbills = mysqli_fetch_array($resultbill)){
			$bills.= $rowbills['number'].', ';
		}
		$bills = substr($bills,0,-2);
			
			
		$pdf->SetX(10);
		$pdf->Row(array($envelope,$type,$number,$name_provider,$amount,$bills,'')); 
	}
}


$newfilename='remisione-retenciones-imi-ir-'.$id.'.pdf'; 
$pdf->Output($newfilename, 'D');
ob_end_flush();
  
?>