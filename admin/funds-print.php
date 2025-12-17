<?php 

include("sessions.php");

ob_start();

$id = $_GET['id'];
require('mc-table.php');
$pdf=new PDF_MC_Table();

$query = "select * from funds where id = '$id'";
$row = mysqli_fetch_array(mysqli_query($con, $query));

if($row['approved'] == 2){
	exit('<script>alert("No se puede imprimir este documento si la solicitud CDF fue rechazada"); history.go(-1); </script>'); 
}
$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
$rowuser2 = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid2]'"));
$rowClient = mysqli_fetch_array(mysqli_query($con, "select * from clients where code = '$row[client]'"));
if($rowClient['type'] == 1){
	$theClientName = $rowClient['first']." ".$rowClient['last'];
	
}
elseif($rowClient['type'] == 2){
	$theClientName = $rowClient['name'];
}
$theClientCode = $rowClient['code']; 

$rowcompany = mysqli_fetch_array(mysqli_query($con, "select * from companies where id = '$row[company]'"));
$theCompany = $rowcompany['name'];
				
//$rowtime = mysqli_fetch_array(mysqli_query($con, "select * from fundstimes where package = '$rowpayment[id]' and stage = 1"));
  
$pdf->AddPage();
$pdf->SetMargins(10,10,10); 
$pdf->SetAutoPageBreak(true, 10);

$thecompany = $row['company'];

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
 
$barcode2 = 'https://getpaycp.com/admin/barcode.php?text=RF'.$row['id'].'&size=40';
$pdf->Image($barcode2,170,20,20,10,'PNG');   

//Banco
$querybanks = "select name from banks where id = '$row[bank]'";
$resultbanks = mysqli_query($con, $querybanks);
$rowbanks = mysqli_fetch_array($resultbanks);
$theBank = $rowbanks['name'];

$querycurrency = "select * from currency where id = '$row[currency]'"; 
$resultcurrency = mysqli_query($con, $querycurrency);
$rowcurrency = mysqli_fetch_array($resultcurrency); 
$theCurrency = $rowcurrency['name'];

$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));



$y = 40;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial','B',31);
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,utf8_decode($rowpayment['id']));

$y = 50;
//Solicitante
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('Solicitante'));
  $y= $pdf->GetY()+4;
  $pdf->SetFont('Arial','B',9);
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Código: '.$rowuser['code']));
  $y= $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Nombre: '.$rowuser['first']." ".$rowuser['last']));
  $y= $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Unidad de Negocio: '.$rowuser['unit']));
  
  $y= $pdf->GetY()+8;
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('Detalles de la solicitud'));

  $queryfiles = "select * from bills where payment = '$id'"; 

  $y= $pdf->GetY()+10;	 
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode("Información del Cliente"));
  $y= $pdf->GetY()+6;
  $pdf->SetFont('Arial','B',9);
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Código: '.$theClientCode));
  $y= $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Nombre: '.$theClientName));
  
 
  if($rowClient['ruc'] != ""){
  	$y= $pdf->GetY()+4;
  	$pdf->SetXY(10,$y);
	$pdf->Write(3,utf8_decode('RUC: '.$rowClient['ruc']));
  }
  
  if($rowClient['nid'] != ""){
  	$y= $pdf->GetY()+4;
  	$pdf->SetXY(10,$y);
	$pdf->Write(3,utf8_decode('Cédula: '.$rowClient['nid']));
  }

  $y= $pdf->GetY()+10;	 
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->Write(3,utf8_decode("Información de la solicitud"));
  $y= $pdf->GetY()+6;
  $pdf->SetFont('Arial','B',9);
  $y= $pdf->GetY()+6;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('ID: '.$row['id']));

  //End no parent or no child

  $y =$pdf->GetY();
  $y= $pdf->GetY()+4; 
  $pdf->SetXY(10,$y);
$theAmount = str_replace('.00','',number_format($row['amount'],2));
  $pdf->Write(3,utf8_decode('Monto: '.$rowcurrency['pre'].' '.$rowcurrency['symbol'].$theAmount.' '.$rowcurrency['name']));
  
 $y= $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
$pdf->Write(3,utf8_decode('Banco: '.$rowbanks['name']));

  $y= $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Referencia bancaria: '.$row['bankreference']));

  $y= $pdf->GetY()+8;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Estado de cuenta: '));

  $y= $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode($row['statement']));

  $y = $pdf->GetY(); 
  $y = $y+10;
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);


	switch($row['status2']){
		case 1:
		$lTitle = 'FONDOS CONFIRMADOS';
		$pdf->Write(3,utf8_decode($lTitle));
		$y= $pdf->GetY()+8;
  		$pdf->SetXY(10,$y);
  		$pdf->SetFont('Arial','',9);
  		$pdf->SetTextColor(0,0,0);
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode('Estimado '.$rowuser['first'].' '.$rowuser['last']));
		$y = $y+8;
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode('Fondos confirmados en '.$theCompany.' '.$theBank.' '.$theCurrency));
		$y = $y+8;
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode('Saludos.'));
		$y = $y+4;
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode($rowuser2['first'].' '.$rowuser2['last']));
		break;
		case 2:
		$lTitle = 'FONDOS NO CONFIRMADOS (por no encontrarse en el estado de cuenta)';
		$pdf->Write(3,utf8_decode($lTitle));
		$y= $pdf->GetY()+8;
  		$pdf->SetXY(10,$y);
  		$pdf->SetFont('Arial','',9);
  		$pdf->SetTextColor(0,0,0);
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode('Estimado '.$rowuser['first'].' '.$rowuser['last']));
		$y = $y+8;
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode('Su solicitud no pudo ser confirmada ya que los fondos no se encuentran en la cuenta de '.$theCompany.' '.$theBank.' '.$theCurrency.''));
		$y = $y+8;
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode('Por favor ingresar nuevamente la solicitud una vez tenga la seguridad que su cliente hizo la transacción.'));
		$y = $y+8;
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode('Saludos.'));
		$y = $y+4;
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode($rowuser2['first'].' '.$rowuser2['last']));
		break;
		case 3:	
		$lTitle = 'FONDOS NO CONFIRMADOS (por encontrarse otra confirmación)';
		$pdf->Write(3,utf8_decode($lTitle));
		$y= $pdf->GetY()+8;
  		$pdf->SetXY(10,$y);
  		$pdf->SetFont('Arial','',9);
  		$pdf->SetTextColor(0,0,0);
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode('Estimado '.$rowuser['first'].' '.$rowuser['last']));
		$y = $y+8;
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode('Su solicitud ya fue confirmada el '.$today.' al SOLICITANTE con estos datos de confirmación: '.$row['statement']));
		$y = $y+8;
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode('Saludos.'));
		$y = $y+4;
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode($rowuser2['first'].' '.$rowuser2['last']));
		break;
		case 4:
		$lTitle = 'FONDOS NO CONFIRMADOS (POR NO HABER ARCHIVO)';
		$pdf->Write(3,utf8_decode($lTitle));
		$y= $pdf->GetY()+8;
  		$pdf->SetXY(10,$y);
  		$pdf->SetFont('Arial','',9);
  		$pdf->SetTextColor(0,0,0);
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode('Estimado '.$rowuser['first'].' '.$rowuser['last']));
		$y = $y+8;
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode('Su solicitud no fue confirmada porque no brindó el  soportes requerido.'));
		$y = $y+8;
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode('Saludos.'));
		$y = $y+4;
		$pdf->SetXY(10,$y);
		$pdf->Write(3,utf8_decode($rowuser2['first'].' '.$rowuser2['last']));
		break;
	}



  
  //End packages cicle
  
  $newfilename='CDF-'.$row['id'].'.pdf';
  $pdf->Output($newfilename, 'D');
  ob_end_flush();
  
?>
<script>
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script> 
