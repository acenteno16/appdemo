<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sessions.php'); 

ob_start();

$id = $_POST['theid'];
if(!isset($_POST['theid'])){
	$id = $_GET['id'];
	$id = explode(',',$id); 
}

  //require('fpdf.php');
  require('fpdf-mctable.php'); 
  $pdf=new PDF_MC_Table();
  //$pdf=new FPDF();	  
 
  for($c=0;$c<sizeof($id);$c++){
  
  $retid = $id[$c];
	
	  $queryret = "select * from irretention where id = '$id[$c]'";
  	  $resultret = mysqli_query($con, $queryret);
  	  $rowret = mysqli_fetch_array($resultret);
	   
	  $query = "select * from payments where id = '$rowret[payment]'";
	  $result = mysqli_query($con, $query);
	  $row = mysqli_fetch_array($result);
	  
	  $acp = $row['acp2'];
	  
	if(($_SESSION["admin"] == "active") or ($_SESSION["withholding"] == "active")){
		//Do Nothing
	}else{
		//$queryupdate = "update payments set irprinted = '1' where id = '$rowret[payment]'";
		//$resultupdate = mysqli_query($con, $queryupdate);
	}
	  
	  if($row['sprovider'] > 0){
		  $queryprovider = "select * from providers where id = '$row[sprovider]'";
		  $resultprovider = mysqli_query($con, $queryprovider);
	  	  $rowprovider = mysqli_fetch_array($resultprovider);
		  $proname = $rowprovider['name'];
  		  $proaddress =  $rowprovider['address'];
          $proruc = $rowprovider['ruc'];
		  $pid = "";
	  }
	  else{ 
		  //Proveedores
		  if($row['btype'] == 1){ 
			  $queryprovider = "select * from providers where id = '$row[provider]'";
			  $resultprovider = mysqli_query($con, $queryprovider);
	  		  $rowprovider = mysqli_fetch_array($resultprovider);
			  $proname = $rowprovider['name'];
  			  $proaddress =  $rowprovider['address'];
              $proruc = $rowprovider['ruc'];
			  $pid = "";
			  
			  
		
		  }
		  //Colaboradores
		  else{
			  $querycollaborator = "select * from workers where id = '$row[collaborator]'";
			  $resultcollaborator = mysqli_query($con, $querycollaborator);
	  		  $rowcollaborator = mysqli_fetch_array($resultcollaborator);
			  $proname = $rowcollaborator['first']." ".$rowcollaborator['last'];
  			  //$proaddress =  $rowcollaborator['address'];
			  $proaddress = "";
			  $proruc = "";
			  $pid = $rowcollaborator['nid'];
			  
		  }
		  
		  
	  }
	
	  $billnumbers = "";
	  $id_arr = explode(',',$rowret['bills']); 
	  //Aqui vamos a meter los id de los documentos
	  for($binc=0;$binc<sizeof($id_arr);$binc++){
	  	if($binc == 0){
			$sqlbinc = " and ((id = '$id_arr[$binc]')";
		}else{
			$sqlbinc.= " or (id = '$id_arr[$binc]')";
		}
		if($binc == (sizeof($id_arr))-1){
			$sqlbinc.=")";
		}
	  }
	  
	  //Asegurando de que si la cadena no contiene nada no mande a llamar todos los bills
	  if($sqlbinc == ""){
	  	$sqlbinc = " and id = '0'";
	  }
	  
	  $querybills = "select * from bills where id > '0'".$sqlbinc;
	  $resultbills = mysqli_query($con, $querybills);
	  $numbills = mysqli_num_rows($resultbills);
	  $billdata = "";
	  $totalbills = 0;
	  $totalrets = 0;
	  $billstotal = 0;
	  while($rowbills=mysqli_fetch_array($resultbills)){
		  $billnumbers .= $rowbills['number'].', ';
		 
		if($rowbills['ret2a'] > 0){
			   $billstotal = ($rowbills['stotal']+$rowbills['stotal2']-$rowbills['exempt'])*$rowbills['tc'];
			  
			  
			   
			   if(($acp == 1) and ($rowbills['dtype'] == 7)){ 
				  
				  //DONDE
				  //percent2acp el el % de incremento
				  //p2 es el porcentaje de la retencion (2% o el 10% usualmente)
				  //stotalbillnio es el subtotal que graba + el subtotal que no graba
				  
				  //$billstotal = 0;
				  $percent2acp = (100-$rowbills['ret2'])/100;
				  $p2acp =  $billstotal*($rowbills['ret2']/100);
				  $basepr1 = $p2acp/$percent2acp;
				  
				  $percentage = $rowbills['ret2']/100;
				  $percentage2 = (100-$rowbills['ret2'])/100;
				 
				  
				  $basepr = (($billstotal*$percentage)/$percentage2)+$billstotal;
				   
			  }else{
				  $basepr = $billstotal;  
			  }  
			  $billstotal = $basepr;

			   if($numbills > 16){
				   $billdata.="F".$rowbills['number']."/".str_replace('.00','',number_format($billstotal,2))."/".str_replace('.00','',number_format($rowbills['ret2a'],2)).";";
			   }else{
				   $billdata.="F#".$rowbills['number']."/C$".number_format($billstotal,2)."/C$".number_format($rowbills['ret2a'],2)."&&";
			   }
			   $totalbills += $billstotal;
			   $totalrets += $rowbills['ret2a']; 
		 }
		  
	  }
   //Delete the last character of string billnumbers
 
    	   
  $pdf->AddPage();
  $pdf->SetMargins(0,0,0);
  $pdf->SetAutoPageBreak(false); 
      
  #retentionRendering
  $pdf->Image('retentions/'.$rowret['company'].'/'.$rowret['company'].'.jpg',0,0,210,100,'',''); 
 
  $x=10;
  $y=50;
  $w=40;
  $h=31;
  $space=45;
  $size = 14;
  $linea = 133; 
  //split
  
  $querycancellation = "select * from times where payment = '$rowret[payment]' and stage = '14.00'";
  $resultcancellation = mysqli_query($con, $querycancellation);
  $rowcancellation = mysqli_fetch_array($resultcancellation);
  $today = explode('-',$rowcancellation['today']); 
  
  $queryretdate = "select scheduletimes.* from scheduletimes inner join schedulecontent on scheduletimes.schedule = schedulecontent.schedule where scheduletimes.stage = '3.00' and schedulecontent.payment = '$rowret[payment]'"; 
  $resultretdate = mysqli_query($con, $queryretdate);  
  $rowretdate = mysqli_fetch_array($resultretdate); 
  if($rowretdate['today'] >= '2017-01-23'){	
  $today = explode('-',$rowretdate['today']);
  }else{
	  
	$queryretdate = "select scheduletimes.* from scheduletimes inner join schedulecontent on scheduletimes.schedule = schedulecontent.schedule where scheduletimes.stage = '5.00' and schedulecontent.payment = '$rowret[payment]'"; 
  	$resultretdate = mysqli_query($con, $queryretdate);  
  	$rowretdate = mysqli_fetch_array($resultretdate); 

  	$today = explode('-',$rowretdate['today']);
  } 
  
  if($rowret['void'] == 1){
	  $pdf->SetXY(133, 85);
  	  $pdf->SetFont('Arial','B',39);
  	  $pdf->SetTextColor(0,0,0);
      $pdf->Write(3,"ANULADA");
	  
	  $pdf->SetXY(133, 185);
      $pdf->Write(3,"ANULADA");
	  
	  $pdf->SetXY(133, 285);
      $pdf->Write(3,"ANULADA");   
   }
	  
  //Retention Authorization
  if($rowret['authorized'] > 0){      
    $queryauth = "select * from authorized where id = '$rowret[authorized]'";
    $resultauth = mysqli_query($con, $queryauth);
    $rowauth = mysqli_fetch_array($resultauth);
    $authorization = $rowauth['authorized']; 
    
    $pdf->SetXY(2, 24);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);
    $pdf->Write(3,$authorization);
   
  } 
  
  //Retention number
  $number = str_pad((int) $rowret['number'],4,"0",STR_PAD_LEFT);
  $pdf->SetXY(133, 14);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$number); 
  
  //Day
  $pdf->SetXY(138,20);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$today[2]);
  //Month
  $pdf->SetXY(149,20);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$today[1]);
  //Year
  $pdf->SetXY(157,20);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$today[0]);
  
  //payment id
  $pdf->SetXY(186,20); 
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$row['id']);
  
  //Route
  $pdf->SetXY(174,14);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$row['route']);
  
  //Cheque PK
  $pdf->SetXY(195,14);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$row['cnumber']);
  
  //Provider
  $pdf->SetXY(34,31);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode($proname));
  
  //Address
  $pdf->SetXY(34,35);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode($proaddress));
  
  //Cedula
  $pdf->SetXY(97,39);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$pid);  
  
  //Bills
  $pdf->SetXY(72,42);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  //$pdf->Write(3,$billnumbers); 
  
  //Provider RUC
  $pdf->SetXY(29,39);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$proruc);
  
  //% ret
  $pdf->SetXY(162,39);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$row['ret2']); 
  
  //description
  if(strlen($row['description']) > 100){
	  $description = ltrim(substr($row['description'], 0, 100)."...");  
  }else{
	  $description = ltrim($row['description']);
	  
  }

  //$description = $querybills;
  $description = preg_replace( "/\r|\n/", "", $description ); 
  
  
  
  if($row['ret2void'] == 1){
	  
	  $pdf->SetXY(150,85);
  	  $pdf->SetFont('Arial','B',30);
  	  $pdf->SetTextColor(242,12,12);
  	  $pdf->Write(3,"ANULADO");
	  $pdf->SetXY(150,185);
  	  $pdf->Write(3,"ANULADO");
	  $pdf->SetXY(150,285);
  	  $pdf->Write(3,"ANULADO"); 
	  
	  
  }
  
  $pdf->SetXY(18,43);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode($description));
  
  //Total Facturas
  $pdf->SetXY(184,54);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,number_format($totalbills, 2));
  
  //Total Rentencion
  $pdf->SetXY(184,63);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,number_format($totalrets, 2));
  
  //Cantidad en letras
  
  $enletras = toLetters($totalrets);
  $enletras = $enletras.utf8_decode(" Córdobas");   
  $pdf->SetXY(4,72);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,$enletras);
   
  if($numbills > 16){
	  $pdf->SetMargins(4,3,50); 
	  $pdf->SetFont('Arial','',6);
	  $pdf->SetXY(4,52);
	  $pdf->Write(3,$billdata); 
	  
  }else{
  $billdataarr = explode("&&", $billdata); 

  //Facturas
  $pdf->SetMargins(4,0,50);  
  $pdf->SetXY(4,51);
  $pdf->SetTextColor(0,0,0);
  if(sizeof($billdataarr) > 9){
	  $pdf->SetFont('Arial','B',7);
	  $pdf->Write(3,str_replace('&&','  ',$billdata));
  }else{
  $pdf->SetFont('Arial','B',9);
  $pdf->SetWidths(array(52,52,52));
  srand(microtime()*1000000);
  $rows = sizeof($billdataarr)/3; 
  $rows = intval($rows);
  $rows++;
    $a1 = 0;
	$b1 = 1;
	$c1 = 2;
	for($i=0;$i<$rows;$i++){
	  
    $pdf->Row(array($billdataarr[$a1],$billdataarr[$b1],$billdataarr[$c1]));
	$a1 = $a1+3;
	$b1 = $b1+3;
	$c1 = $c1+3; 
	
  }
  }
  //End of bills < 16
  }
  $pdf->SetMargins(0, 0, 0); 
  
  $retener = "";
  if(($row['acp'] == 1) or ($row['acp2'] == 1)){
	  $retener = "- RETENER";
  }
  
  //ORIGINAL/COPIA
  $pdf->SetFont('Arial','B',14);
  $pdf->SetXY(70,88);  
  $pdf->Write(3,"ORIGINAL ".$retener); 
  
  }
  
  $filename="//home/getpaycp/tosend/IR-".$retid.".pdf";  
  $pdf->Output($filename,'F');
  ob_end_flush();
 */

?>