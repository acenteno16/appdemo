<?php 

include("session-retentions.php"); 

ob_start();

$id = $_GET['id']; 

$query = "select * from irremission where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);  


require('mc-table.php');
$pdf=new PDF_MC_Table();

$pdf->AddPage();
$pdf->SetMargins(10,10,10,10);
$pdf->SetAutoPageBreak(false);


$pdf->Image('../images/grupo-casa-pellas.jpg',10,10,90,10,'','');

$barcode2 = 'https://getpaycp.com/admin/barcode.php?text='.$rowpayment['id'].'&size=40';
$pdf->Image($barcode2,171,10,20,10,'PNG');  

$pdf->SetXY(150,25);  
$pdf->SetFont('Arial','B',14); 
$pdf->SetTextColor(0,0,0);
//$pdf->Write(3,utf8_decode('Banco(s): '.$thebanks));
$pdf->Cell( 40, 0, utf8_decode('ID: '.$row['id']), 0, 0, 'R' ); 

$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
$queryfiles = "select irretention.number, payments.id, payments.ret2a, payments.btype, payments.provider, payments.collaborator from irremissioncontent inner join irretention on irremissioncontent.irretention = irretention.id inner join payments on irretention.payment = payments.id where irremissioncontent.irremission = '$id'";
$resultfiles = mysqli_query($con, $queryfiles); 
$numfiles = mysqli_num_rows($resultfiles); 
  
  $pdf->SetXY(150,40);

  $y = 30;
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('REMISION DE RETENCIONES IR'));
  $y+=12;
  $yinicio = $y;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Remision'));
  $y+=4;
  
  $pdf->SetFont('Arial','B',9);
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('No. de retenciones: '.$numfiles)); 
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Fecha: '.date('d-m-Y',strtotime($row['today']))));
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Hora: '.date('h:i:s a', strtotime($row['totime']))));
  
  $y+=12;
  $yfin1 = $y;
  
  $y = $yinicio;
  $pdf->SetXY(60,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->Write(3,utf8_decode('Usuario'));
  $y+=4;
  $pdf->SetFont('Arial','B',9);
  $pdf->SetXY(60,$y);
  $pdf->Write(3,utf8_decode('Nombre: '.$rowuser['first']." ".$rowuser['last']));
  $y+=4;
  $pdf->SetXY(60,$y);
  $pdf->Write(3,utf8_decode('Código: '.$rowuser['code']));
  $y+=12; 
  $yfin2 = $y;
  
  if($yfin1 > $yfin2){
  	$y = $yfin1;
  }else{
  	$y= $yfin2;
  }
  
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('Retenciones:'));
  $y+=8;
  
  
  $i = 1;
 
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->SetXY(10,$y); 
    
  //Table with 20 rows and 4 columns
  $pdf->SetWidths(array(10,15,78,25,60));   
  srand(microtime()*1000000); 
  for($i=0;$i<1;$i++){
    $pdf->Row(array(' ','No.','Proveedor','Valor Retenido','Factura')); 
  }
  $i=0;
  $i2 = 1;
  $pdf->SetFont('Arial','',9);
  while($rowfiles=mysqli_fetch_array($resultfiles)){
  
  	if($rowfiles['btype'] == 1){
		$queryproviders = "select * from providers where id = '$rowfiles[provider]'";
		$resultproviders = mysqli_query($con, $queryproviders);
		$rowproviders = mysqli_fetch_array($resultproviders);
		$name_provider = $rowproviders['name'];
	}else{
		$queryproviders = "select * from workers where code = '$rowfiles[collaborator]'";
		$resultproviders = mysqli_query($con, $queryproviders);
		$rowproviders = mysqli_fetch_array($resultproviders);
		$name_provider = $rowproviders['first'].' '.$rowproviders['last'];
	}
	
	$querybills = "select number from bills where payment = '$rowfiles[id]'";
	$resultbill = mysqli_query($con, $querybills);
	$bills = "";
	while($rowbills = mysqli_fetch_array($resultbill)){
		$bills.= $rowbills['number'].', ';
	}
	$bills = substr($bills,0,-2);
	$amount = $rowfiles['ret2a']; 
  
  	//$pdf->Image('../images/checkbox.jpg',10,$y,3,3,'','');
  	//$pdf->SetXY(15,$y);
  	//$pdf->Write(3,utf8_decode($rowfiles['number'])); 
  	//$y+=4;
	
	$pdf->SetX(10);
	$pdf->Row(array($i2,$rowfiles['number'],$name_provider,$amount,$bills)); 
	$i2++;
	
  } 
   
  $newfilename='remision-de-retenciones-ir-'.$id.'.pdf';
  $pdf->Output($newfilename, 'D');
  ob_end_flush();
  
?>
<script>
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script> 
