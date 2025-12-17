<?php 

include("session-withholding.php"); 
ob_start();


$id = $_POST['theid'];


  require('fpdf.php');
  $pdf=new FPDF();	  
 
  for($c=0;$c<sizeof($id);$c++){
  
	  $query = "select * from payments where id = '$id[$c]'";
	  $result = mysqli_query($con, $query);
	  $row = mysqli_fetch_array($result);
	  
	  $queryprovider = "select * from providers where id = '$row[provider]'";
	  $resultprovider = mysqli_query($con, $queryprovider);
	  $rowprovider = mysqli_fetch_array($resultprovider);
	  
	  $billnumbers = "";
	  $querybills = "select * from bills where payment = '$id[$c]'";
	  $resultbills = mysqli_query($con, $querybills);
	  while($rowbills=mysqli_fetch_array($resultbills)){
		  $billnumbers .= $rowbills['number'].', ';
	  }
    	   
  $pdf->AddPage();
  $pdf->SetMargins(0,0,0);
  $pdf->SetAutoPageBreak(false); 
  $pdf->Image('fpdf/alcaldia.jpg',0,0,210,100,'','');
  $pdf->Image('fpdf/alcaldia.jpg',0,100,210,100,'','');
  $pdf->Image('fpdf/alcaldia.jpg',0,200,210,100,'','');
  
 //Copy 1
  //Date
  $pdf->SetXY(138,23); 
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,date('d'));
  $pdf->SetXY(148,23);
  $pdf->Write(3,date('m'));
  $pdf->SetXY(159,23);
  $pdf->Write(3,date('Y'));
  
  //Provider
  $pdf->SetXY(58,38);
  $pdf->Write(3,$rowprovider['name']);
  
  //RUC
  $pdf->SetXY(44,44);
  $pdf->Write(3,$rowprovider['ruc']);
  
  //Cedula
  $pdf->SetXY(113,44);
  $pdf->Write(3,$rowprovider['ruc']);
  
  //Cedula
  $pdf->SetXY(165,44);
  $pdf->Write(3,$rowprovider['ruc']);
  
  //Total factura
  $pdf->SetXY(59,50);
  $pdf->Write(3,$row['ammount']);
  
  //Monto retenido Alcaldía
  $pdf->SetXY(138,50);
  $pdf->Write(3,$row['ret1a']);
  
  //% retenido
  $pdf->SetXY(64,56);
  $pdf->Write(3,$row['ret1']);
  
  //Concepto
  $pdf->SetXY(54,63);
  $pdf->Write(3,$row['description']);
 //Copy 2
  //Date
  $pdf->SetXY(158,130);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,date('d'));
  $pdf->SetXY(170,130);
  $pdf->Write(3,date('m'));
  $pdf->SetXY(178,130);
  $pdf->Write(3,date('Y'));
  
  //Provider
  $pdf->SetXY(58,138);
  $pdf->Write(3,$rowprovider['name']);
  
  //RUC
  $pdf->SetXY(44,144);
  $pdf->Write(3,$rowprovider['ruc']);
  
  //Cedula
  $pdf->SetXY(113,144);
  $pdf->Write(3,$rowprovider['ruc']);
  
  //Cedula
  $pdf->SetXY(165,144);
  $pdf->Write(3,$rowprovider['ruc']);
  
  //Total factura
  $pdf->SetXY(59,150);
  $pdf->Write(3,$row['ammount']);
  
  //Monto retenido Alcaldía
  $pdf->SetXY(138,150);
  $pdf->Write(3,$row['ret1a']);
  
  //% retenido
  $pdf->SetXY(64,156);
  $pdf->Write(3,$row['ret1']);
  
  //Concepto
  $pdf->SetXY(54,163);
  $pdf->Write(3,$row['description']);
 //Copy 3
  //Date
  $pdf->SetXY(158,230);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,date('d'));
  $pdf->SetXY(170,230);
  $pdf->Write(3,date('m'));
  $pdf->SetXY(178,230);
  $pdf->Write(3,date('Y'));
  
  //Provider
  $pdf->SetXY(58,238);
  $pdf->Write(3,$rowprovider['name']);
  
  //RUC
  $pdf->SetXY(44,244);
  $pdf->Write(3,$rowprovider['ruc']);
  
  //Cedula
  $pdf->SetXY(113,244);
  $pdf->Write(3,'N/A');
  
  //Telefono
  $pdf->SetXY(165,244);
  $pdf->Write(3,$rowprovider['phone']);
  
  //Total factura
  $pdf->SetXY(59,250);
  $pdf->Write(3,$row['ammount']);
  
  //Monto retenido Alcaldía
  $pdf->SetXY(138,250);
  $pdf->Write(3,$row['ret1a']);
  
  //% retenido
  $pdf->SetXY(64,256);
  $pdf->Write(3,$row['ret1']);
  
  //Concepto
  $pdf->SetXY(54,263);
  $pdf->Write(3,$row['description']);
  
  /*
  //Error
  $pdf->SetXY(10,60);
  $pdf->SetFont('Arial','B',14);
  $pdf->SetTextColor(255,0,0);
  $pdf->Write(3,'Fetching timed out. Your connection is very low. Please optimize the output file.');
  */
  
  
  }
  
  $newfilename='retenciones-alcaldia.pdf';
  $pdf->Output($newfilename, 'D');
  ob_end_flush(); 
 
?>
<script>
alert('Recuerde imprimir este documento en hojas tamaño legal.');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script>