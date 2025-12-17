<?php 

#ini_set('display_errors', 1); 
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("sessions.php");

ob_start();
require('mc-table.php');
$pdf=new PDF_MC_Table();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$queryPayment = $con->prepare("select * from payments where id  = ?");
$queryPayment->bind_param("i", $id);
$queryPayment->execute();
$resultPayment = $queryPayment->get_result();
$rowPayment = mysqli_fetch_array($resultPayment);

if($rowPayment['child'] > 0){
	$rowPayment = mysqli_fetch_array(mysqli_query($con, "select * from payments where id = '$rowPayment[child]'"));
}

if($rowPayment['approved'] == 0){
	exit('<script>alert("La solicitud de pago debe de ser aprobada para utilizar esta opcion."); history.go(-1); </script>');
}

if($rowPayment['approved'] == 2){
	exit('<script>alert("No se puede imprimir este documento si la solicitud de pago fue rechazada"); history.go(-1); </script>'); 
}
 
$theplans = '';
$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$rowPayment[userid]'"));
if($rowPayment['btype'] == 1){
	$ben_type = "Proveedor";
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$rowPayment[provider]'"));
	$providerchain = $rowprovider['name'];
	$international = "";
	if($rowprovider['international'] == 1){ 
		$international = " | INTERNACIONAL";
	}
	$thebanks = "";
	
	$queryplans = "select * from providers_plans where provider = '$rowPayment[provider]'";
	$resultplans = mysqli_query($con, $queryplans);
	while($rowplans = mysqli_fetch_array($resultplans)){
	
		$querybanks = "select name from banks where id = '$rowplans[bank]'";
		$resultbanks = mysqli_query($con, $querybanks);
		$rowbanks = mysqli_fetch_array($resultbanks);
		$thebanks.= $rowbanks['name'].", ";
		
		//$queryplan = "select account from palns where id = '$rowplans[plan]'";
		//$resultplan = mysqli_query($con, $queryplan);
		//$rowplan = mysqli_fetch_array($resultplan);
		$theplans.= $rowplans['account'].", ";
	}
	
	$thebanks = substr($thebanks,0,-2);
	$theplans = substr($theplans,0,-2);
	
}
elseif($rowPayment['btype'] == 2){
	$ben_type = "Colaborador";
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$rowPayment[collaborator]'"));
	$providerchain = $rowprovider['first']." ".$rowprovider['last'];
	
	$bank = "BAC";
}	
elseif($rowPayment['btype'] == 4){
	$ben_type = "Cliente";
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from clients where code = '$rowPayment[client]'"));
	if($rowprovider['type'] == 1){
		$providerchain = $rowprovider['first']." ".$rowprovider['last'];
	}elseif($rowprovider['type'] == 2){
		$providerchain = $rowprovider['name'];
	}
	
	
	//$bank = "BAC";
}	
								
$rowtime = mysqli_fetch_array(mysqli_query($con, "select * from packagestimes where package = '$rowPayment[id]' and stage = 1"));
  
$pdf->AddPage();
$pdf->SetMargins(10,10,10); 
$pdf->SetAutoPageBreak(true, 10);

$querycompany = "select companies.id from companies inner join units on companies.code = units.companyCode where units.id = '$rowPayment[routeid]'"; 
$resultcompany = mysqli_query($con, $querycompany);
$rowcompany = mysqli_fetch_array($resultcompany);
$thecompany = $rowcompany['id'];

$querycurrency = "select * from currency where id = '$rowPayment[currency]'"; 
$resultcurrency = mysqli_query($con, $querycurrency);
$rowcurrency = mysqli_fetch_array($resultcurrency); 

$thecurrency = $rowcurrency['name'];

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
  
$barcode2 = '/var/www/html/admin/barcode.php?text='.$rowPayment['id'].'&size=40';
#$pdf->Image($barcode2,170,20,20,10,'PNG');  

//Banco
$pdf->SetXY(150,40);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0,0,0);
//$pdf->Write(3,utf8_decode('Banco(s): '.$thebanks));
$pdf->Cell( 40, 0, utf8_decode('Banco(s): '.$thebanks), 0, 0, 'R' ); 
$ry = $pdf->GetY();
$ry = $ry+5;
$pdf->SetXY(150,$ry);
$pdf->Cell( 40, 0, utf8_decode("Moneda: ".$thecurrency), 0, 0, 'R' ); 
$ry = $pdf->GetY();
$ry = $ry+5;
$pdf->SetXY(150,$ry);
$pdf->Cell( 40, 0, utf8_decode("CTA: ".$theplans), 0, 0, 'R' ); 

if($rowPayment['cc'] > 0){
	$querycc = "select number from creditcards where id = '$rowPayment[cc]'";
	$resultcc = mysqli_query($con, $querycc);
	$rowcc = mysqli_fetch_array($resultcc);
	$tc_info = "xxxx-".$rowcc['number']; 
	$ry = $ry+5;
	$pdf->SetXY(150,$ry);
	$pdf->Cell( 40, 0, utf8_decode("TC: ".$tc_info), 0, 0, 'R' ); 
}

if(($rowPayment['immediate'] == 1)){
	  $pdf->Image('../images/inmediato-rojo.jpg',132,55,60,26,'','');   
  }

//if($_SESSION['email'] == 'jairovargasg@gmail.com'){ 
	//$bankimage = "banks/".$bank.".jpg";
	
	
	//if(file_exists($bankimage)){
		//$pdf->Image($bankimage,170,40,20,10,'',''); 
	//}
//}

$y = 40;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial','B',31);
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,utf8_decode($rowPayment['id']));


$y = 50;
//Solicitante
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('Solicitante'));
  $y= $pdf->GetY()+4;
  $pdf->SetFont('Arial','B',9);
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Nombre: '.$rowuser['first']." ".$rowuser['last']));
  $y= $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Código: '.$rowuser['code']));
  #$y= $pdf->GetY()+4;
  #$pdf->SetXY(10,$y);
  #$pdf->Write(3,utf8_decode('Unidad de Negocio: '.$rowuser['unit']));

  
  $y= $pdf->GetY()+8;
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('Detalles de la solicitud'));

  
if(($rowPayment['parent'] > 0) or ($rowPayment['child'] > 0)){
  
 $queryfiles = "select * from bills inner join payments on bills.payment = payments.id where bills.payment = '$id' or payments.child = '$id'";
  	
 $y= $pdf->GetY()+8;
 $pdf->SetXY(10,$y);
 $pdf->SetFont('Arial','B',9);
 $pdf->SetWidths(array(20,95,40,15));
 srand(microtime()*1000000);
 for($i=0;$i<1;$i++){
    $pdf->Row(array('IDS','Beneficiario','Monto')); 
 }
 
 
 if($rowPayment['child'] > 0){
		$querychild = "select id, btype, collaborator, intern, payment from payments where id = '$rowPayment[child]' or child='$rowPayment[child]' order by id asc";
	}						
	else{
		$querychild = "select id, btype, collaborator, intern, payment from payments where id = '$rowPayment[id]' or child='$rowPayment[id]' order by id asc";
	}
 
 
 
 
   
 $resultchild = mysqli_query($con, $querychild); 
 while($rowchild=mysqli_fetch_array($resultchild)){
 	
	if($rowchild['btype'] == 2){
		$queryben = "select * from workers where id = '$rowchild[collaborator]'";
	}elseif($rowchild['btype'] == 3){
		$queryben = "select * from interns where code = '$rowchild[intern]'";
	}
	$resultben = mysqli_query($con, $queryben);
	$rowben = mysqli_fetch_array($resultben);
	
	$ben_name = $rowben['code']." | ".$rowben['first']." ".$rowben['last']; 
	
	$pdf->SetX(10);
	$pdf->Row(array($rowchild['id'],utf8_decode($ben_name),$rowcurrency['pre'].' '.$rowcurrency['symbol'].$rowchild['payment']));  	
 }
	
//End Parent or childs  
}
else{

  $queryfiles = "select * from bills where payment = '$id'"; 

  $y= $pdf->GetY()+10;	 
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode("Información del ".$ben_type));
  $y= $pdf->GetY()+4;
  $pdf->SetFont('Arial','B',9);
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Nombre: '.$providerchain." ".$international));
  $y= $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Código: '.$rowprovider['code']));
  
 
  if($rowprovider['ruc'] != ""){
  	$y= $pdf->GetY()+4;
  	$pdf->SetXY(10,$y);
	$pdf->Write(3,utf8_decode('RUC: '.$rowprovider['ruc']));
  }
  
  if(isset($rowprovider['nid']) and $rowprovider['nid'] != ""){
  	$y= $pdf->GetY()+4;
  	$pdf->SetXY(10,$y);
	$pdf->Write(3,utf8_decode('Cédula: '.$rowprovider['nid']));
  }

  if($rowprovider['course'] != ""){
	$y= $pdf->GetY()+4;
  	$pdf->SetXY(10,$y);
  	$pdf->Write(3,utf8_decode('Giro: '.$rowprovider['course']));
  }

  $y= $pdf->GetY()+4;
  $pdf->SetFont('Arial','B',9);
  $y= $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('ID: '.$rowPayment['id']));

//End no parent or no child

}
  //If cascade payment
  if($rowPayment['globalpayment'] > 0){
  	$topay = $rowPayment['globalpayment'];
  }else{
  	$topay = $rowPayment['payment'];
  }
  
  $y =$pdf->GetY();
  $y= $pdf->GetY()+4; 
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Monto a pagar: '.$rowcurrency['pre'].' '.$rowcurrency['symbol'].$topay.' '.$rowcurrency['name']));
  
  $y= $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Vencimiento: '.$pdate = date('d-m-Y',strtotime($rowPayment['expiration']))));
  
  $y= $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Concepto: '.$rowPayment['description']));
   
  if($rowPayment['notes'] != ""){
  	$y= $pdf->GetY()+4; 
  	$pdf->SetXY(10,$y);
  	$pdf->Write(3,utf8_decode('Notas del Solicitante: '.$rowPayment['notes']));
  }

  if($rowPayment['parent'] == 0){
  
  $y = $pdf->GetY(); 
  
  $y= $pdf->GetY()+10;
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);

  $pdf->Write(3,utf8_decode('Documentos:'));
  $y= $pdf->GetY()+8;
  
  $resultfiles = mysqli_query($con, $queryfiles);
  $numfiles = mysqli_num_rows($resultfiles);
  $i = 1;
  $string = "";
  while($rowfiles=mysqli_fetch_array($resultfiles)){
							
	  $string.= ''.$rowfiles['number'].', '; 
 							
  }
						
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->SetXY(10,$y);
  //Aqui el checkbox
  //$pdf->Image('../images/checkbox.jpg',10,$y,3,3,'','');
  //$pdf->SetXY(15,$y);
  $pdf->Write(3,utf8_decode($string));
  $y= $pdf->GetY()+4;
  }
  
  
  if($rowPayment['btype'] == 4){
  
  $y = $pdf->GetY(); 
  
  $y= $pdf->GetY()+10;
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);

  $pdf->Write(3,utf8_decode('Recibos Oficiales de Caja / Facturas :'));
  $y= $pdf->GetY()+8;
  
  $queryfiles = "select * from clientsdocuments where payment = '$rowPayment[id]'";
  $resultfiles = mysqli_query($con, $queryfiles);
  $numfiles = mysqli_num_rows($resultfiles);
  $i = 1;
  $string = "";
  while($rowfiles=mysqli_fetch_array($resultfiles)){
							
	  $string.= ''.$rowfiles['number'].', '; 
 							
  }
						
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->SetXY(10,$y);
  //Aqui el checkbox
  //$pdf->Image('../images/checkbox.jpg',10,$y,3,3,'','');
  //$pdf->SetXY(15,$y);
  $pdf->Write(3,utf8_decode($string));
  $y= $pdf->GetY()+4;
  }
  
  $y = $y+10;
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('Estado'));
  $y= $pdf->GetY()+8;
  $pdf->SetXY(10,$y);

  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->SetXY(10,$y);
												
	//Table with 20 rows and 4 columns
	$pdf->SetWidths(array(20,25,60,70));
	#srand(microtime()*1000000);
    srand((int)(microtime(true) * 1000000));
	$pdf->SetX(10);
	$pdf->Row(array('Fecha','Hora','Accion','Usuario')); 
	
	$querystatus = "select * from times where payment = '$rowPayment[id]' order by id asc";
	$resultstatus = mysqli_query($con, $querystatus);
	$i=0;
	while($rowstatus=mysqli_fetch_array($resultstatus)){
		if($i == 0){
			$day1 = $rowstatus['today'];
		}
	$i++;
											
	$pdate = date('d-m-Y',strtotime($rowstatus['today']));
	$ptime = date('h:i:s a', strtotime($rowstatus['now2']));
	$querystage = "select * from stages where id = '$rowstatus[stage]'";
	$resultstage = mysqli_query($con, $querystage);
	$rowstage = mysqli_fetch_array($resultstage);
	$paction = $rowstage['name'];
								
	$queryuser = "select * from workers where code = '$rowstatus[userid]'";
	$resultuser = mysqli_query($con, $queryuser);
	$rowuser = mysqli_fetch_array($resultuser);
	$puser =$rowuser['first']." ".$rowuser['last'];
									
	$pdf->SetX(10);
	$pdf->Row(array($pdate,$ptime,$paction,utf8_decode($puser))); 		
}
  
  $y = $pdf->GetY();
  $y= $pdf->GetY()+8;
  $pdf->SetXY(10,$y); 
  $pdf->SetFont('Arial','',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('Nota: No es necesario sello y firma de recibo en recepción.'));
  
  //End packages cicle
  
  $newfilename='remisiones-'.date('d-m-Y').'.pdf';
  $pdf->Output($newfilename, 'D');
  ob_end_flush();
  
?>
<script>
alert('Recuerde imprimir este documento en hojas tamaño legal.');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script> 
