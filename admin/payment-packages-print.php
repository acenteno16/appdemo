<?php 

#ini_set('display_errors', 1); 
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("session-remission.php");
include("functions.php");

$immediate = 0;
class EnLetras
{
	
  var $Void = "";
  var $SP = " ";
  var $Dot = ".";
  var $Zero = "0";
  var $Neg = "Menos";
  
function ValorEnLetras($x, $Moneda = null) 
{
    $s="";
    $Ent="";
    $Frc="";
    $Signo="";
        
    if(floatVal($x) < 0)
     $Signo = $this->Neg . " ";
    else
     $Signo = "";
    
    if(intval(number_format($x,2,'.','') )!=$x) //<- averiguar si tiene decimales
      $s = number_format($x,2,'.','');
    else
      $s = number_format($x,0,'.','');
       
    $Pto = strpos($s, $this->Dot);
        
    if ($Pto === false)
    {
      $Ent = $s;
      $Frc = $this->Void;
    }
    else
    {
      $Ent = substr($s, 0, $Pto );
      $Frc =  substr($s, $Pto+1);
    }

    if($Ent == $this->Zero || $Ent == $this->Void)
       $s = "Cero ";
    elseif( strlen($Ent) > 7)
    {
       $s = $this->SubValLetra(intval( substr($Ent, 0,  strlen($Ent) - 6))) . 
             "Millones " . $this->SubValLetra(intval(substr($Ent,-6, 6)));
    }
    else
    {
      $s = $this->SubValLetra(intval($Ent));
    }

    if (substr($s,-9, 9) == "Millones " || substr($s,-7, 7) == "Millón ")
       $s = $s . "de ";

    $s = $s . $Moneda;

    if($Frc != $this->Void)
    {
       $s = $s . " Con " . $this->SubValLetra(intval($Frc)) . "Centavos";
       //$s = $s . " " . $Frc . "/100";
    }
    return ($Signo . $s . ""); 
   
}


function SubValLetra($numero) 
{
    $Ptr="";
    $n=0;
    $i=0;
    $x ="";
    $Rtn ="";
    $Tem ="";

    $x = trim("$numero");
    $n = strlen($x);

    $Tem = $this->Void;
    $i = $n;
    
    while( $i > 0)
    {
       $Tem = $this->Parte(intval(substr($x, $n - $i, 1). 
                           str_repeat($this->Zero, $i - 1 )));
       If( $Tem != "Cero" )
          $Rtn .= $Tem . $this->SP;
       $i = $i - 1;
    }

    
    //--------------------- GoSub FiltroMil ------------------------------
    $Rtn=str_replace(" Mil Mil", " Un Mil", $Rtn );
    while(1)
    {
       $Ptr = strpos($Rtn, "Mil ");       
       If(!($Ptr===false))
       {
          If(! (strpos($Rtn, "Mil ",$Ptr + 1) === false ))
            $this->ReplaceStringFrom($Rtn, "Mil ", "", $Ptr);
          Else
           break;
       }
       else break;
    }

    //--------------------- GoSub FiltroCiento ------------------------------
    $Ptr = -1;
    do{
       $Ptr = strpos($Rtn, "Cien ", $Ptr+1);
       if(!($Ptr===false))
       {
          $Tem = substr($Rtn, $Ptr + 5 ,1);
          if( $Tem == "M" || $Tem == $this->Void)
             ;
          else          
             $this->ReplaceStringFrom($Rtn, "Cien", "Ciento", $Ptr);
       }
    }while(!($Ptr === false));

    //--------------------- FiltroEspeciales ------------------------------
    $Rtn=str_replace("Diez Un", "Once", $Rtn );
    $Rtn=str_replace("Diez Dos", "Doce", $Rtn );
    $Rtn=str_replace("Diez Tres", "Trece", $Rtn );
    $Rtn=str_replace("Diez Cuatro", "Catorce", $Rtn );
    $Rtn=str_replace("Diez Cinco", "Quince", $Rtn );
    $Rtn=str_replace("Diez Seis", "Dieciseis", $Rtn );
    $Rtn=str_replace("Diez Siete", "Diecisiete", $Rtn );
    $Rtn=str_replace("Diez Ocho", "Dieciocho", $Rtn );
    $Rtn=str_replace("Diez Nueve", "Diecinueve", $Rtn );
    $Rtn=str_replace("Veinte Un", "Veintiun", $Rtn );
    $Rtn=str_replace("Veinte Dos", "Veintidos", $Rtn );
    $Rtn=str_replace("Veinte Tres", "Veintitres", $Rtn );
    $Rtn=str_replace("Veinte Cuatro", "Veinticuatro", $Rtn );
    $Rtn=str_replace("Veinte Cinco", "Veinticinco", $Rtn );
    $Rtn=str_replace("Veinte Seis", "Veintiseís", $Rtn );
    $Rtn=str_replace("Veinte Siete", "Veintisiete", $Rtn );
    $Rtn=str_replace("Veinte Ocho", "Veintiocho", $Rtn );
    $Rtn=str_replace("Veinte Nueve", "Veintinueve", $Rtn );

    //--------------------- FiltroUn ------------------------------
    If(substr($Rtn,0,1) == "M") $Rtn = "Un " . $Rtn;
    //--------------------- Adicionar Y ------------------------------
    for($i=65; $i<=88; $i++)
    {
      If($i != 77)
         $Rtn=str_replace("a " . Chr($i), "* y " . Chr($i), $Rtn);
    }
    $Rtn=str_replace("*", "a" , $Rtn);
    return($Rtn);
}


function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr)
{
  $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr);
}


function Parte($x)
{
    $Rtn='';
    $t='';
    $i='';
    Do
    {
      switch($x)
      {
         Case 0:  $t = "Cero";break;
         Case 1:  $t = "Un";break;
         Case 2:  $t = "Dos";break;
         Case 3:  $t = "Tres";break;
         Case 4:  $t = "Cuatro";break;
         Case 5:  $t = "Cinco";break;
         Case 6:  $t = "Seis";break;
         Case 7:  $t = "Siete";break;
         Case 8:  $t = "Ocho";break;
         Case 9:  $t = "Nueve";break;
         Case 10: $t = "Diez";break;
         Case 20: $t = "Veinte";break;
         Case 30: $t = "Treinta";break;
         Case 40: $t = "Cuarenta";break;
         Case 50: $t = "Cincuenta";break;
         Case 60: $t = "Sesenta";break;
         Case 70: $t = "Setenta";break;
         Case 80: $t = "Ochenta";break;
         Case 90: $t = "Noventa";break;
         Case 100: $t = "Cien";break;
         Case 200: $t = "Doscientos";break;
         Case 300: $t = "Trescientos";break;
         Case 400: $t = "Cuatrocientos";break;
         Case 500: $t = "Quinientos";break;
         Case 600: $t = "Seiscientos";break;
         Case 700: $t = "Setecientos";break;
         Case 800: $t = "Ochocientos";break;
         Case 900: $t = "Novecientos";break;
         Case 1000: $t = "Mil";break;
         Case 1000000: $t = "Millón";break;
      }

      If($t == $this->Void)
      {
        $i = $i + 1;
        $x = $x / 1000;
        If($x== 0) $i = 0;
      }
      else
         break;
           
    }while($i != 0);
   
    $Rtn = $t;
    Switch($i)
    {
       Case 0: $t = $this->Void;break;
       Case 1: $t = " Mil";break;
       Case 2: $t = " Millones";break;
       Case 3: $t = " Billones";break;
    }
    return($Rtn . $t);
}

}
ob_start();

$id = $_GET['id'];
require('../assets/fpdf/fpdf.php');
  
$pdf=new FPDF();
  
//Start remision
$id = $_GET['id'];
$query = "select * from packages where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
  
$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
$rowunit = mysqli_fetch_array(mysqli_query($con, "select * from units where code = '$rowuser[unit]'"));
    	   
$pdf->AddPage();
$pdf->SetMargins(10,10,10);
$pdf->SetAutoPageBreak(true, 10);
  
//get the company
$querypc = "select companies.* from packagescontent inner join payments on packagescontent.payment = payments.id inner join units on payments.routeid = units.id inner join companies on units.companyCode = companies.code where package = '$row[id]' limit 1";
$resultpc = mysqli_query($con, $querypc);
$rowpc = mysqli_fetch_array($resultpc);
//Print the Company logo
$pdf->Image($rowpc['imgroute'],10,20,$rowpc['img_w'],$rowpc['img_h'],'',''); 
//Print the barcode	 
$barcode = 'http://172.17.17.22/admin/barcode.php?text=r'.$id.'&size=40';
#$barcode = 'http://172.17.17.22/admin/barcode.php?text=Hola&size=40';
$pdf->Image($barcode,170,20,20,10,'PNG');
  

$x=10;
$y=$pdf->GetY()+25; 

//Date
$pdf->SetXY($x,$y);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,utf8_decode('Detalle de la Remisión'));
  
$y=$pdf->GetY()+10;
  
$pdf->SetXY($x,$y);
$pdf->SetFont('Arial','B',9);
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,utf8_decode('ID de la Remisión: '.$id));
$y=$pdf->GetY()+4;
$pdf->SetXY($x,$y);
$pdf->Write(3,utf8_decode('Fecha de generación: '.date('d-m-Y',strtotime($row['today']))));

$y=$pdf->GetY()+10;

$pdf->SetXY($x,$y);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,'Solicitudes adjuntas: ');
$y=$pdf->GetY()+10;
$pdf->SetXY($x,$y);
$pdf->SetFont('Arial','B',9);
$pdf->SetTextColor(0,0,0);
$pdf->Write(3,'ID de pago');
$pdf->SetXY(35,$y);
$pdf->Write(3,'Beneficiario');
  
  $i = 0;
  //while 
  $querypayments = "select * from packagescontent where package = '$_GET[id]' order by id asc";
  $resultpayments = mysqli_query($con, $querypayments);
  $numpayments = mysqli_num_rows($resultpayments);
  while($rowpayments=mysqli_fetch_array($resultpayments)){
	  
	  $rowpayment = mysqli_fetch_array(mysqli_query($con, "select * from payments where id = '$rowpayments[payment]'"));
	  $ben_name = getBen2($rowpayment['parent'], $rowpayment['btype'], $rowpayment['provider'], $rowpayment['collaborator'], $rowpayment['intern'], $rowpayment['client']); 
	  
	 
	  if($rowpayment['immediate'] == 1){
		  $immediate = 1;
	  }
	  $y = $pdf->GetY()+4;
	  
	  $pdf->SetXY(10,$y);
	  $pdf->Write(3,$rowpayments['payment']);
	  $pdf->SetXY(35,$y);
	  $pdf->Write(3,$ben_name);
	  
	  $i++; 
	  
	   if($rowpayment['parent'] > 10){
	
		$querypaymentchilds = "select * from payments where child = '$rowpayment[id]'";
		$resultpaymentchilds = mysqli_query($con, $querypaymentchilds);
		while($rowpaymentchilds=mysqli_fetch_array($resultpaymentchilds)){
		
			$rowpayment2b = mysqli_fetch_array(mysqli_query($con, "select * from payments where id = '$rowpaymentchilds[id]'"));
	  		//$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$rowpayment[provider]'"));
	  
	  		if($rowpayment2b['btype'] == 1){
	  			$rowprovider2b = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$rowpayment2[provider]'"));
				$providerchain2b = $rowprovider2b['name'];
	  		}
	  		elseif($rowpayment2b['btype'] == 2){
	  			$rowprovider2b = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$rowpayment2b[collaborator]'"));
				$providerchain2b = $rowprovider2b['first']." ".$rowprovider2b['last'];
	  		}elseif($rowpayment2b['btype'] == 3){
	  			$rowprovider2b = mysqli_fetch_array(mysqli_query($con, "select * from interns where code = '$rowpayment2b[intern]'"));
				$providerchain2b = $rowprovider2b['first']." ".$rowprovider2b['last'];
	  		}
	  
	  		if($rowpayment2b['immediate'] == 1){
		  		$immediate2 = 1;
	  		} 
	  		$y=$pdf->GetY()+4; 
	  
	  		$pdf->SetXY(10,$y); 
	  		$pdf->Write(3,$rowpaymentchilds[id]);
	  		$pdf->SetXY(35,$y);
	  		$pdf->Write(3,$rowprovider2b['code'].' | '.$providerchain2b);
	  
	  		$i++; 
	}
		
		
		
		
	  
	  }
	  
	  
  
  } //end while
  
  if(($immediate == 1)){
	  $pdf->Image('../images/inmediato-rojo-incluye.jpg',132,50,60,26,'','');  
  }
  
  $y = $pdf->GetY()+10; 
  
  $pdf->SetXY($x,$y);
  $pdf->SetFont('Arial','B',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('Solicitante'));
  $y = $pdf->GetY()+4;
  $pdf->SetFont('Arial','B',9);
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Nombre: '.$rowuser['first']." ".$rowuser['last']));
  $y = $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Código: '.$rowuser['code']));
  $y = $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  #$pdf->Write(3,utf8_decode('Unidad de Negocio: '.$rowuser['unit']));
  
  $y= $pdf->GetY()+10;
  
  $pdf->SetXY(10,$y);
  $pdf->SetFont('Arial','B',9);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode($rowpc['cname']));
  $y = $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode($rowpc['address']));
  $y = $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,'Managua, Nicaragua');
  $y = $pdf->GetY()+4;
  $pdf->SetXY(10,$y);
  $pdf->Write(3,utf8_decode('Teléfono: '.$rowpc['phone']));   
  
  //end Remission
  $y= $pdf->GetY()+10;

  $pdf->SetXY($x,$y); 
  $pdf->SetFont('Arial','',11);
  $pdf->SetTextColor(0,0,0);
  $pdf->Write(3,utf8_decode('Nota: No es necesario sello y firma de recibo en recepción.'));
  
  
  $newfilename='remisiones-'.date('d-m-Y').'.pdf';
  $pdf->Output($newfilename, 'D');
  ob_end_flush();
  
 
?>
<script>
alert('Recuerde imprimir este documento en hojas tamaño legal.');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script> 
