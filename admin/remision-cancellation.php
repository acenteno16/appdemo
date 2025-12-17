<?php 

#ini_set('display_errors', 1); 
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL); 

include("session-payer.php");
include("functions.php");

ob_start();
require('mc-table.php');
$pdf=new PDF_MC_Table(); 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$print = isset($_GET['print']) ? intval($_GET['print']) : 0;
$scheduleContent = 0;
  
$query = $con->prepare("SELECT * FROM schedule WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$row = mysqli_fetch_array($result);
  
$querytimes = "select * from scheduletimes where stage = '6'";
$resulttimes = mysqli_query($con, $querytimes);
$numtimes = mysqli_num_rows($resulttimes);
if($numtimes > 0){
  	$rowtimes = mysqli_fetch_array($resulttimes);
	$cancellationday = $rowtimes['today'];
}
else{
	  
      $scheduleContent = 1;
	  $querysec = "select * from schedulecontent where schedule = '$id' limit 1";
	  $resultsec = mysqli_query($con, $querysec);
	  $rowsec = mysqli_fetch_array($resultsec);
	  
	  $querytimex = "select * from times where payment = '$rowsec[payment]' and stage = '14' order by id desc limit 1";
	  $resulttimex = mysqli_query($con, $querytimex);
	  $rowtimex = mysqli_fetch_array($resulttimex); 
	  $cancellationday = $rowtimex['today'];
	  
}

$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid3]'"));
$rowunit = mysqli_fetch_array(mysqli_query($con, "select * from units where code = '$rowuser[unit]'"));
    	   
$pdf->AddPage();
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(false); 

$barcode = 'http://172.17.17.22/admin/barcode.php?text=a'.$id.'&size=40';
$pdf->Image($barcode,170,20,20,10,'PNG');   
  
$x=10;
$y=50;
$w=40;
$h=31;
$space=45;
$size = 14;
$linea = 133;
 
//Date
$pdf->SetXY(10,50);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,utf8_decode('Detalle de la Remisión'));
  

$thecurrency = $globalCurrencyPre[$row['currency']];

if($row['bank'] != ""){
      $bank = $globalBank[$row['bank']];
}
else{
	if($scheduleContent == 0){
		$querysec = "select * from schedulecontent where schedule = '$id' limit 1";
        $resultsec = mysqli_query($con, $querysec);
        $rowsec = mysqli_fetch_array($resultsec);
     }
	$queryFirstPayment = "select bank from payments where id = '$rowsec[payment]'";
    $resultFirstPayment = mysqli_query($con, $queryFirstPayment);
	$rowFirstPayment = mysqli_fetch_array($resultFirstPayment);
	$bank = $globalBank[$rowFirstPayment['bank']];
	
}
  
  
$y = 65;
$pdf->SetXY(10,$y);
$y = $y+4;
$pdf->SetFont('Arial','B',9);
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,utf8_decode('ID de la Remisión: '.$id));
if($bank != ""){
  $pdf->SetXY(10,$y); 
  $y = $y+4;
  $pdf->Write(3,utf8_decode('Banco: '.$bank)); 
}
$pdf->SetXY(10,$y);
$pdf->SetXY(10,$y); 
$y = $y+4;
$pdf->Write(3,utf8_decode('Moneda: '.$thecurrency));
$pdf->SetXY(10,$y);
$y = $y+4;
$pdf->Write(3,utf8_decode('Procesado el: '.date('d-m-Y',strtotime($row['today']))));
$pdf->SetXY(10,$y);
$y = $y+4;
$pdf->Write(3,utf8_decode('Acreditado el: '.date('d-m-Y',strtotime($cancellationday))));
$pdf->SetXY(10,$y); 
$pdf->Write(3,utf8_decode('Webid: '.$row['code']));
  
$y = $y+10;
  
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,'Solicitudes adjuntas: ');
$y += 10;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial','B',9);
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,'PK'); 
$pdf->SetXY(35,$y);
$pdf->Write(3,'IDS');
$pdf->SetXY(60,$y); 
$pdf->Write(3,'Beneficiario');
  
$querypayments = $con->prepare("SELECT * from schedulecontent where schedule = ?");
$querypayments->bind_param("i", $id);
$querypayments->execute();
$resultpayments = $querypayments->get_result();
$numpayments = $resultpayments->num_rows;
while($rowpayments=mysqli_fetch_array($resultpayments)){
    
    $rowpayment = mysqli_fetch_array(mysqli_query($con, "select * from payments where id = '$rowpayments[payment]'"));
	$ben_name = getBen2($rowpayment['parent'], $rowpayment['btype'], $rowpayment['provider'], $rowpayment['collaborator'], $rowpayment['intern'], $rowpayment['client']);
    
    $querypk = "select cnumber from payments where id = '$rowpayments[payment]'";
    $resultpk = mysqli_query($con, $querypk);
	$rowpk = mysqli_fetch_array($resultpk); 
    $y+=4;
	  
	$pdf->SetXY(10,$y);
	$pdf->Write(3,$rowpk['cnumber']);
	$pdf->SetXY(35,$y);
	$pdf->Write(3,$rowpayments['payment']);
	$pdf->SetXY(60,$y);
	$pdf->Write(3,$ben_name);  
      
    $thecompany = $rowpayment['company']; 
  
} //end while

    if($thecompany == 1){
	   $pdf->Image('../images/casa-pellas-blue.jpg',10,20,90,10,'','');   
    }elseif($thecompany == 2){
	   $pdf->Image('../images/alpesa-logo.jpg',10,20,40,15,'','');
    }elseif($thecompany == 3){
	   $pdf->Image('../images/velosa-color.jpg',10,20,90,10,'','');
    }elseif($thecompany == 10){
	   $pdf->Image('../images/kipesa.jpg',10,20,90,10,'','');
    }elseif($thecompany == 11){
	   $pdf->Image('../images/capesa.jpg',10,20,90,10,'','');
    }elseif($thecompany == 12){
	   $pdf->Image('../images/fidem.jpg',10,20,90,10,'','');
    }else{
	   $pdf->Image('../images/grupo-casa-pellas.jpg',10,20,90,10,'','');
    }


  $y+=15; 
  
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('Procesador de pagos'));
  $y+=4;
  $pdf->SetFont('Arial','B',9);
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Nombre: '.$rowuser['first']." ".$rowuser['last']));
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Código: '.$rowuser['code']));
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Unidad de Negocio: '.$rowuser['unit']));
  
   $y+=10;
  
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,'Casa Pellas S.A.');
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Plaza españa. Contiguo a PBS'));
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,'Managua, Nicaragua');
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Teléfono: 2255.4444'));  
  
  //end Remission
  
  //Packages cicle
  
  if($print == 2){  
  
  $querypayments = "select * from packagescontent where package = '$_GET[id]'";
  $resultpayments = mysqli_query($con, $querypayments);
  $numpayments = mysqli_num_rows($resultpayments);
  while($rowpayments=mysqli_fetch_array($resultpayments)){
	  $rowpayment = mysqli_fetch_array(mysqli_query($con, "select * from payments where id = '$rowpayments[payment]'"));
	  //$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$rowpayment[provider]'"));
	  
	  if($rowpayment['btype'] == 1){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$rowpayment[provider]'"));
								$providerchain = $rowprovider['name'];
								}
								else{
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$rowpayment[collaborator]'"));
									$providerchain = $rowprovider['first']." ".$rowprovider['last'];
								}
								
								
								
  $rowtime = mysqli_fetch_array(mysqli_query($con, "select * from packagestimes where package = '$_GET[id]' and stage = 1"));
  
  $pdf->AddPage();
  $pdf->SetMargins(0,0,0);
  $pdf->SetAutoPageBreak(false);
  $pdf->Image('../images/casa-pellas-blue.jpg',10,20,90,10,'','');
  
  $barcode2 = 'http://pagoscp.com/admin/barcode.php?text='.$rowpayment['id'].'&size=40';
  $pdf->Image($barcode2,170,20,20,10,'PNG');   


  $y = 50;
  //Solicitante
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('Solicitante'));
  $y+=4;
  $pdf->SetFont('Arial','B',9);
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Nombre: '.$rowuser['first']." ".$rowuser['last']));
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Código: '.$rowuser['code']));
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Unidad de Negocio: '.$rowuser['unit']));
  $y+=10;
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);
  
  //Proveedor
  $pdf->Write(3,utf8_decode('Proveedor'));
  $y+=4;
  $pdf->SetFont('Arial','B',9);
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Nombre: '.$providerchain));
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Código: '.$rowprovider['code']));
  $y+=4;
  $pdf->SetXY(10,$y);
  
  $theruc = "NA";
  if($rowprovider['ruc'] != ""){
	  $theruc = $rowprovider['ruc'];
  }
  $pdf->Write(3,utf8_decode('RUC: '.$theruc));
  $y+=4;
  $pdf->SetXY(10,$y);
  $thecourse = "NA";
  if($rowprovider['course'] != ""){
	  $thecourse = $rowprovider['course'];
  }
  $pdf->Write(3,utf8_decode('Giro: '.$thecourse));
  
  $y+=10;
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('Detalle del paquete'));
  $y+=4;
  $pdf->SetFont('Arial','B',9);
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('ID de la Remisión: r'.$row['id']));
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('ID de pago: '.$rowpayment['id']));
  $y+=4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Fecha de generación: '.date('d-m-Y',strtotime(  $rowtime['today']))));
  

  }
  
  //End packages cicle
  
  } 
   
  $newfilename='remisiones-'.date('d-m-Y').'.pdf';
  $pdf->Output($newfilename, 'D');
  ob_end_flush();
  
 
?>
<script>
alert('Recuerde imprimir este documento en hojas tamaño legal.');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script> 
