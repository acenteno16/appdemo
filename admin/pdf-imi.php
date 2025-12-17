<?php 

ob_start();

$id = $_POST['theid'];

  require('../assets/fpdf/fpdf.php');
  $pdf=new FPDF();	  
 
  for($c=0;$c<sizeof($id);$c++){
	  
	  include_once('sessions.php');  
   
	  $queryretention = "select * from hallsretention where id = '$id[$c]'"; 
	  $resultretention = mysqli_query($con, $queryretention);
	  $rowretention = mysqli_fetch_array($resultretention);
	  $number = str_pad((int) $rowretention['number'],4,"0",STR_PAD_LEFT); 
      
      #aqui definimos el archivo que se va a utilizar
      
	  
	  $retention = $rowretention['serial']."-".$number; 
	  
	  $query = "select * from payments where id = '$rowretention[payment]'";
	  $result = mysqli_query($con, $query);
	  $row = mysqli_fetch_array($result);
	  
	  $acp = $row['acp'];
	  
	  if(($_SESSION["admin"] == "active") or ($_SESSION["withholding"] == "active")){
		//Do Nothing
	  }else{
		$queryupdate = "update payments set imiprinted = '1' where id = '$row[id]'";
		$resultupdate = mysqli_query($con, $queryupdate);
	  }
	  
	  if($row['btype'] == 1){
		  	
			if($row['sprovider'] > 0){
				$queryprovider = "select * from providers where id = '$row[sprovider]'";
	  	  	}
		  	else{ 
				$queryprovider = "select * from providers where id = '$row[provider]'";
	  	  	}
			$resultprovider = mysqli_query($con, $queryprovider);
			$rowprovider = mysqli_fetch_array($resultprovider);
			$providername = $rowprovider['name'];
			$rucnumber = $rowprovider['ruc'];
			$idnumber = "";
		  }
		  else{
			  $queryprovider = "select * from workers where code = '$row[collaborator]'";
			 $resultprovider = mysqli_query($con, $queryprovider);
			 $rowprovider = mysqli_fetch_array($resultprovider);
			 $providername = $rowprovider['first']." ".$rowprovider['last'];
			 $rucnumber = "";
			 $idnumber = $rowprovider['nid'];
		  }

	  //New code 40 characters
	  
	  $sql = "";
		 
	  if($rowretention['amount'] > 0){
		  //Caso mutiples retenciones por IDS
		  $bills = $rowretention['billsid'];
		  $bills_arr = explode(',',$bills);
		  $sql = "";
		  for($ib=0;$ib<sizeof($bills_arr);$ib++){
			  if($ib == 0){
				  $sql.= " and ((id = '$bills_arr[$ib]')";
			  }else{
				  $sql.= " or (id = '$bills_arr[$ib]')";
			  }
			  if($ib+1 == sizeof($bills_arr)){
				  $sql.= ")";
			  }
		  } //end for
	  //end caso multiples retenciones
	  }
	  
	  $billnumbers = "";
	  $querybills = "select * from bills where payment = '$row[id]'$sql";
	  $resultbills = mysqli_query($con, $querybills);
	  $numbills = mysqli_num_rows($resultbills);
	  $billdata = "";
	  $totalbills = 0;
	  $totalrets = 0;
	  $billstotal = 0;
	  while($rowbills=mysqli_fetch_array($resultbills)){
		 
		  $billnumbers .= $rowbills['number'].', ';
		  $billdates.= date('d-m-Y',strtotime($rowbills['billdate'])).', ';
		  
		  if($rowbills['ret1a'] > 0){
			  
			  $billstotal = 0;
			  $billstotal = ($rowbills['stotal']+$rowbills['stotal2']-$rowbills['exempt2'])*$rowbills['tc'];
			 
			  if($acp == 1){  
				  
				  //DONDE
				  //percent2acp el el % de incremento
				  //p2 es el porcentaje de la retencion (2% o el 10% usualmente)
				  //stotalbillnio es el subtotal que graba + el subtotal que no graba
				  //$percent2acp = (100-$rowbills['ret1'])/100;
				  //$p2acp =  $billstotal*($rowbills['ret1']/100);
				  //$basepr = $p2acp/$percent2acp;
				  
				  if($isbill == 1){
					  $basepr = $billstotal;
					  
				  }else{
					  $percent2acp = (100-$rowbills['ret1'])/100;
				  	  $p2acp =  $billstotal*($rowbills['ret1']/100);
				  	  $basepr1 = $p2acp/$percent2acp;
				  
				  	  $percentage = $rowbills['ret1']/100;
				  	  $percentage2 = (100-$rowbills['ret1'])/100; 
				 
				  	  $basepr = (($billstotal*$percentage)/$percentage2)+$billstotal;
					 
				  }
				      
			  }
			  else{
				  $basepr = $billstotal;  
			  } 
			  
			  
			  if($numbills > 16){ 
				  $billdata.="F".$rowbills['number']."/".str_replace('.00','',number_format($basepr,2))."/C$".str_replace('.00','',number_format($rowbills['ret1a'],2)).";";
			  }else{
			  	$billdata.="F#".$rowbills['number']."/C$".number_format($basepr,2)."/C$".number_format($rowbills['ret1a'],2).",    ";
			  }
			  
			  $billstotal = $basepr; 
			  
			  $totalbills += $billstotal;
			  $totalrets += $rowbills['ret1a'];
		  }
	  }
	  

  $retener = "";
  if(($row['acp'] == 1) or ($row['acp2'] == 1)){ 
	  $retener = " - RETENER"; 
  }
	     
  $pdf->AddPage();
  $pdf->SetMargins(6,3,3);
  $pdf->SetAutoPageBreak(false);  
      
  $thisRetentionVer = $rowretention['hall'];
  if($rowretention['version'] > 0){
      $thisRetentionVer = $rowretention['hall']."v".$rowretention['version'];
  }
      
  $urlRetention = "/home/halls/$rowretention[hall]/$thisRetentionVer.jpg";
  if(!file_exists($urlRetention)){
	  exit('<script>alert("No se encontró el archivo de retención. '.$urlRetention.'"); history.go(-1);</script>');
  } 

  $pdf->Image($urlRetention,0,0,210,100,'','');
  $pdf->Image($urlRetention,0,100,210,100,'','');
  $pdf->Image($urlRetention,0,200,210,100,'','');  
  
  $ckpk = "0";
  if($row['cnumber'] != ""){
	  $ckpk = $row['cnumber']; 
  }
  
  //Copy 1
  
  $querycancellation = "select * from times where payment = '$row[id]' and stage = '14.00'";
  $resultcancellation = mysqli_query($con, $querycancellation);
  $rowcancellation = mysqli_fetch_array($resultcancellation);
  
//Ingreso a Banco
/* 		  
$queryretdate = "select scheduletimes.* from scheduletimes inner join schedulecontent on scheduletimes.schedule = schedulecontent.schedule where scheduletimes.stage = '3.00' and schedulecontent.payment = '$row[id]'"; 
$resultretdate = mysqli_query($con, $queryretdate);  
$rowretdate = mysqli_fetch_array($resultretdate);
	  
if($rowretention['created'] != "0000-00-00"){ 
	
}
elseif($rowretdate['today'] >= '2017-01-23'){
	//descontinuado (Solo funciona para retenciones viejas)
	$today = explode('-',$rowretdate['today']); 
	
}
else{
    //APROBAJO GF (Descontinuado) Solo funciona para retenciones viejas
    $queryretdate2 = "select scheduletimes.* from scheduletimes inner join schedulecontent on scheduletimes.schedule = schedulecontent.schedule where scheduletimes.stage = '5.00' and schedulecontent.payment = '$row[id]'"; 
    $resultretdate2 = mysqli_query($con, $queryretdate2);  
    $rowretdate2 = mysqli_fetch_array($resultretdate2); 
    $today = explode('-',$rowretdate2['today']);   
}*/ 
	  
$today = explode('-',$rowretention['created']);

$queryRoute = "select code, newCode from units where id = '$row[routeid]'";
$resultRoute = mysqli_query($con, $queryRoute);
$rowRoute = mysqli_fetch_array($resultRoute);
if($row['ncatalog'] == 1){
	$theroute = $rowRoute['newCode'];
}else{
	$theroute = $rowRoute['code'];
}	
	  
	  
  /*
  if($rowretention['void'] == 1){
	  $pdf->SetXY(133, 85);
  	  $pdf->SetFont('Arial','B',39);
  	  $pdf->SetTextColor(0,0,0);
      $pdf->Write(3,"ANULADA");
	  
	  $pdf->SetXY(133, 185);
      $pdf->Write(3,"ANULADA");
	  
	  $pdf->SetXY(133, 285);
      $pdf->Write(3,"ANULADA");    
   }
   */
   
   
  //Date
  $pdf->SetXY(179,23);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$today[2]);
  $pdf->SetXY(189,23);
  $pdf->Write(3,$today[1]);
  $pdf->SetXY(197,23);
  $pdf->Write(3,$today[0]);
  
  //retention number
  $pdf->SetXY(174,16);
  $pdf->Write(3,$retention); 
  
  //Unit 
  $pdf->SetXY(134,23);
  $pdf->Write(3,$theroute); 
  
  //CKPK
  $pdf->SetXY(154,23);
  $pdf->Write(3,$ckpk); 
  
  //Provider 
  $pdf->SetXY(35,34);
  $pdf->Write(3,utf8_decode($providername));
  
  //RUC
  $pdf->SetXY(29,41); 
  $pdf->Write(3,$rucnumber);
  
  //CEDULA
  $pdf->SetXY(105,41); 
  $pdf->Write(3,$idnumber);
  
  //Telefono
  $pdf->SetXY(165,41); 
  $pdf->Write(3,$rowprovider['phone']);
  
  //Solicitud
  $pdf->SetXY(145,16);
  $pdf->Write(3,$row['id']);
  
  //description
  if(strlen($row['description']) > 100){
	  $description = substr($row['description'], 0, 95)."...";  
  }else{
	  $description = $row['description'];
  }
  
   $description = preg_replace( "/\r|\n/", "", $description ); 

  //Concepto de pago
  $pdf->SetXY(33,48);
  $pdf->Write(3,utf8_decode($description));
  
  //Total facturas
  $pdf->SetXY(45,55);
  $pdf->Write(3,number_format($totalbills,2));
  
  //alicuota comunmente 1%
  $pdf->SetXY(112,55);
  $pdf->Write(3,$row['ret1']);
  
  //total retencion
  $pdf->SetXY(173,55);
  $pdf->Write(3,number_format($totalrets,2));
  
  //Concepto
  if($numbills > 16){
	  $pdf->SetFont('Arial','',6);
  }
  $pdf->SetXY(4,63); 
  //$pdf->Write(3,$row['description']); 
  $pdf->Write(3,$billdata); 

  //ORIGINAL/COPIA
  $pdf->SetFont('Arial','B',14);
  $pdf->SetTextColor(25,56,222);
  $pdf->SetXY(90,83);  
  $pdf->Write(3,"ORIGINAL".$retener); 
  
 
 
  //Copy 2
  //Date
  $pdf->SetXY(179,123);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$today[2]);
  $pdf->SetXY(189,123);
  $pdf->Write(3,$today[1]);
  $pdf->SetXY(197,123);
  $pdf->Write(3,$today[0]);
  
  //retention number 
  $pdf->SetXY(174,116);
  $pdf->Write(3,$retention); 
  
  //Unit 
  $pdf->SetXY(134,123);
  $pdf->Write(3,$theroute); 
  
  //CKPK
  $pdf->SetXY(154,123);
  $pdf->Write(3,$ckpk); 
  
  //Provider 
  $pdf->SetXY(35,134);
  $pdf->Write(3,utf8_decode($providername));
  
  //RUC
  $pdf->SetXY(29,141); 
  $pdf->Write(3,$rucnumber);
  
  //CEDULA
  $pdf->SetXY(105,141); 
  $pdf->Write(3,$idnumber);
  
  //Telefono
  $pdf->SetXY(165,141); 
  $pdf->Write(3,$rowprovider['phone']);
  
  //Solicitud
  $pdf->SetXY(145,116);
  $pdf->Write(3,$row['id']);
  
  //Concepto de pago
  $pdf->SetXY(33,148);
  $pdf->Write(3,utf8_decode($description));
  
  //Total Bill
  $pdf->SetXY(45,155);
  $pdf->Write(3,number_format($totalbills,2)); 
  
  //Total Bill
  $pdf->SetXY(112,155);
  $pdf->Write(3,$row['ret1']);
  
  //Total Rets
  $pdf->SetXY(173,155);
  $pdf->Write(3,number_format($totalrets,2));
  
  //Concepto
  if($numbills > 16){
	  $pdf->SetFont('Arial','',6);
  }
  $pdf->SetXY(4,163); 
  //$pdf->Write(3,$row['description']); 
  $pdf->Write(3,$billdata); 
  
  //ORIGINAL/COPIA
  $pdf->SetFont('Arial','B',14);
  $pdf->SetXY(90,183);  
  $pdf->Write(3,"COPIA 1".$retener); 
  
  
 
 
 //Copy 3
 //Date
  $pdf->SetXY(179,223);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$today[2]);
  $pdf->SetXY(189,223);
  $pdf->Write(3,$today[1]);
  $pdf->SetXY(197,223);
  $pdf->Write(3,$today[0]);
  
  //retention number 
  $pdf->SetXY(174,216);
  $pdf->Write(3,$retention); 
  
  //Unit 
  $pdf->SetXY(134,223);
  $pdf->Write(3,$theroute); 
  
  //CKPK
  $pdf->SetXY(154,223);
  $pdf->Write(3,$ckpk); 
  
  //Provider 
  $pdf->SetXY(35,234);
  $pdf->Write(3,utf8_decode($providername));
  
  //RUC
  $pdf->SetXY(29,241); 
  $pdf->Write(3,$rucnumber);
  
  //CEDULA
  $pdf->SetXY(105,241); 
  $pdf->Write(3,$idnumber);
  
  //Telefono
  $pdf->SetXY(165,241); 
  $pdf->Write(3,$rowprovider['phone']);
  
  //Solicitud
  $pdf->SetXY(145,216);
  $pdf->Write(3,$row['id']);
  
  //Concepto de pago
  $pdf->SetXY(33,248);
  $pdf->Write(3,utf8_decode($description));
  
  //Total Bill
  $pdf->SetXY(45,255);
  $pdf->Write(3,number_format($totalbills,2));
  
  //Total Bill
  $pdf->SetXY(112,255);
  $pdf->Write(3,$row['ret1']);
  
  //Total Rets
  $pdf->SetXY(173,255);
  $pdf->Write(3,number_format($totalrets,2));
  
  //Concepto
   if($numbills > 16){
	  $pdf->SetFont('Arial','',6);
  }
  $pdf->SetXY(4,263); 
  //$pdf->Write(3,$row['description']); 
  $pdf->Write(3,$billdata); 
  
  //ORIGINAL/COPIA
  $pdf->SetFont('Arial','B',14);
  $pdf->SetXY(90,283);  
  $pdf->Write(3,"COPIA 2".$retener); 
  
  
   //if($row['ret1void'] == 1){
if($rowretention['void'] == 1){
	 
	  $pdf->SetXY(150,85);
  	  $pdf->SetFont('Arial','B',30);
  	  $pdf->SetTextColor(242,12,12);
  	  $pdf->Write(3,"ANULADA");
	  $pdf->SetXY(150,185);
  	  $pdf->Write(3,"ANULADA");
	  $pdf->SetXY(150,285);
  	  $pdf->Write(3,"ANULADA"); 
	  
}
  
  
  
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