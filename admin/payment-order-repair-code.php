<?php 

include("session-admin.php"); 

/*
exit();

$notes = 'Segun correo de hgaitan@casapellas.com 16/Mayo/2024:
@Jairo Vargas revisamos el caso don Roberto Somarriba, y nos indica que procedamos a corregir los el concepto del pago, documentos digitales y el numero de factura.
Link del archivo que se necesita cambio: Aplicación de Pagos | Casa Pellas S.A. (getpaycp.com)
Link de pago con factura correcta: Aplicación de Pagos | Casa Pellas S.A. (getpaycp.com)
Por favor corregir numero de factura 0048 
También que el concepto solamente diga lo siguiente: Proyecto branding para distribuidor de vehículos 50% adelanto'; 
#$thestage = $rowmain['status'];
#$query2 = "insert into times (payment, today, now, now2, userid, stage, comment, stage2) values ('305877', '$today', '$now', '$now2', '$_SESSION[userid]', '14', '$_POST[notesrep]', 'Pago reparado')"; 
#$result2 = mysqli_query($con, $query2);  

*/

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$id = intval($_POST['id']);

$querymain = "select * from payments where id = '$id'";
$resultmain = mysqli_query($con, $querymain);
$rowmain = mysqli_fetch_array($resultmain);


if($_SESSION['admin'] != "active"){
	echo "<script>
	alert('Permission err.');
	window.location = 'dashboard.php';
	</script>";
	exit(); 
}


$updateBeneficiary = $_POST['updateBeneficiary'];
$updateType = $_POST['updateType'];
$updateDocumments = $_POST['updateDocumments'];
$updateFiles = $_POST['updateFiles'];
$updateDistribution = $_POST['updateDistribution'];
$updateRoute = $_POST['updateRoute'];

$theroute = explode(',',$_POST['theroute']); 
$route = $theroute[0];
$headship = $theroute[1];
$newbutton = $_POST['newbutton'];
$notes = $_POST['notes']; 

if(($route == 0) and ($newbutton == "save")){
?>
<script>
alert('Usted debe de seleccionar una ruta de pago. (CODE)');
history.go(-1);  
</script>
<?php exit(); 
}
$dspayment = $_POST['dspayment'];
if(($dspayment == 0) and ($newbutton == "save")){
?>
<script>
alert('Usted debe de seleccionar un tipo de beneficiario de pago. (CODE)');
history.go(-1) ; 
</script>
<?php exit(); 
}
if($dspayment == 1){
$provider = $_POST['provider'];
$collaborator = 0;

if(($provider == "") and ($newbutton == "save")){ ?>
		<script>
		alert('Usted debe de seleccionar un Proveedor. (CODE)');
		history.go(-1);
		</script>
		<?php exit();
}
$queryprovider = "select * from providers where id = '$provider'";
$resultprovider = mysqli_query($con, $queryprovider);
$rowprovider = mysqli_fetch_array($resultprovider);
	
//

}
if($dspayment == 2){
$collaborator = $_POST['collaborator'];
$provider = 0;  
if(($collaborator == "") and ($newbutton == "save")){ ?>
<script>
alert('Usted debe de seleccionar un Colaborador. (CODE)');
history.go(-1);
</script>
<?php exit();
}
}

$type = $_POST['type'];
$concept = $_POST['concept'];
$concept2 = $_POST['concept2'];

$description = $_POST['description'];
if(($description == "") and ($newbutton == "save")){ ?>
<script> 
alert('Usted debe de ingresar una descripcion. (CODE)');
history.go(-1);
</script>
<?php exit();
}
//Bill
$bill = $_POST['bill'];
$letters = $_POST['letters'];
$stotal = $_POST['stotal'];
$stotal2 = $_POST['stotal2'];
$tax = $_POST['tax'];
$exempt = $_POST['exempt'];
$exempt2 = $_POST['exempt2'];
$billdate = $_POST['billdate'];
$billdate2 = $_POST['billdate2'];
$ammount = $_POST['ammount'];
$billret1a = $_POST['ret1a'];
$billret2a = $_POST['ret2a'];
$inturammount = $_POST['inturammount'];
$inturammount2 = $_POST['inturammount2'];
$nd = $_POST['nd'];

//Globals
$ret1 = intval($_POST['retention1']);
$ret1a = numberFormat($_POST['retention1ammount']);
$ret2 = $_POST['retention2'];
$ret2a = numberFormat($_POST['retention2ammount']);
$totalbill = $_POST['totalbill']; 

//Float VARS
$payment = $_POST['floatpayment'];
$paymentnio = $_POST['floatpaymentnio']; 
$floatcurrency = $_POST['floatcurrency'];
$billid = $_POST['billid'];
$currency = $_POST['currency'];
$beneficiarie = $_POST['beneficiarie'];
$retainer = $_POST['retainer'];
$retainer2 = $_POST['retainer2'];
$retainer3 = $_POST['retainer3'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

if($updateDistribution == 1){

    $distributable = $_POST['distributable'];
    $querydd = "update distribution set ddelete='1' where payment = '$id'";
    $resultdd = mysqli_query($con, $querydd);  
    if($distributable == 1){
	   $dunit = $_POST['dunit'];
	   $dpercent = $_POST['dpercent'];
	   $dtotal = $_POST['dtotal'];
	   $did = $_POST['did'];
	   for($c=0;$c<sizeof($dpercent);$c++){
		  //Definimos que el pago se va a dristribuir
		  $wdistribute = 1;
		  //Si hace falta algun dato decimos que no ingresamos dicha distribucion
		  if(($dunit[$c] == '') and ($dpercent[$c] == '') and ($dtotal[$c] == '')){
			$wdistribute = 0;
		  }
		  //Si el pago se va a distribuir procedemos.
		  if($wdistribute == 1){
			if($did[$c] == 0){
				$querydistribution = "insert into distribution (payment, unit, percent, total, ddelete) values ('$id', '$dunit[$c]', '$dpercent[$c]', '$dtotal[$c]', '0')";
			}else{
                $querydistribution = "update distribution set unit='$dunit[$c]', percent='$dpercent[$c]', total='$dtotal[$c]', ddelete='0' where id = '$did[$c]'"; 
			}
			$resultdistribution = mysqli_query($con, $querydistribution);
			 
		}	
	   }
    }
    else{
	   $querydistribution = "select * form distribution where payment = '$id'"; 
	   $resultdistribution = mysqli_query($con, $querydistribution);
	   $numdistribution = mysqli_num_rows($resultdistribution);
	   if($numdistribution == 0){
           $querydistribution = "insert into distribution (payment, unit, percent, total) values ('$id', '$route', '100', '$_POST[stotalbill]')";
           $resultdistribution = mysqli_query($con, $querydistribution);
	   }
    }
    
    $querydd2 = "delete from distribution where payment = '$id' and ddelete = '1'";
    $resultdd2 = mysqli_query($con, $querydd2);  
       
}



if($updateDocumments == 1){
    
    //Always UPDATE because payment has an id 
    $floatammount2 = $_POST['floatammount2'];
    $nftotalbill = numberFormat($totalbill);
    $nfret1a= numberFormat($ret1a); 
    $nfret2a= numberFormat($ret2a); 
    $nfpayment=numberFormat($payment);
    $nfpayment2=numberFormat($payment2);
    $ammount2=numberFormat($floatammount2);

    $gstotald = str_replace(',','',$_POST['stotalbill']);
    $cut = $_POST['cut'];
    
    $query = "update payments set ammount='$nftotalbill', ammount2='$ammount2', currency='$floatcurrency', ret1='$ret1', ret1a='$nfret1a', ret2='$ret2', ret2a='$nfret2a', payment='$nfpayment', paymentnio='$nfpayment2', retainer='$retainer', acp='$retainer2', acp2='$retainer3', stotal='$gstotald' where id = '$id'";
    $result = mysqli_query($con, $query); 
    
    //Start Billing write or Update
    $ammount = $_POST['ammount'];
    $stotal2 = $_POST['stotal2'];
    $dtype = $_POST['dtype'];

    $querydeletebill = "delete from bills where payment = '$id'";
    $resultdeletebill = mysqli_query($con, $querydeletebill);
    for($c = 0; $c < sizeof($ammount); $c++){ 
			
			$billdate[$c] = date("Y-m-d", strtotime($billdate[$c]));
			$billdate2[$c] = date("Y-m-d", strtotime($billdate2[$c]));
			
			$tc = 1;
			if($currency == 2){
				$querytc = "select * from tc where today = '$billdate[$c]'";
				$resulttc = mysqli_query($con, $querytc);
				$rowtc = mysqli_fetch_array($resulttc); 
				$tc = $rowtc['tc']; 
			}
			
			//Bills
			
			$nfbillpayment = 0; 
			$nfammount = numberFormat($ammount[$c]); 
			$nfstotal = numberFormat($stotal[$c]);
			$nfstotal2 = numberFormat($stotal2[$c]);
			$nftax = numberFormat($tax[$c]);
			
			$nfintur = numberFormat($inturammount[$c]);
			$nfinturammount = numberFormat($inturammount2[$c]);
			$nfexempt = numberFormat($exempt[$c]);
			$nfexempt2 = numberFormat($exempt2[$c]);
			
			//Retentions
			$nfftotal1 = numberFormat($billret1a[$c]);
			$nfftotal2 = numberFormat($billret2a[$c]);
			
			$nfbillpayment = numberFormat($ammount[$c])-numberFormat($billret1a[$c])-numberFormat($billret2a[$c]);
			
			//NIO
			$nfnioammount = $nfammount*$tc;
			$nfniostotal = $nfstotal*$tc;
			$nfniostotal2 = $nfstotal2*$tc;
			$nfniotax = $nftax*$tc;
			$nfniointurammount = $nfinturammount*$tc;
			$nfniobillpayment = $nfbillpayment*$tc;
			
			$billcut = 0;
			if($billdate[$c] < $cut){
				$billcut = 1;
			}  
			
		
			 $query1 = "insert into bills (payment, number, ammount, letters, stotal, stotal2, tax, intur, inturammount, exempt, exempt2, type, concept, concept2, billdate, billdate2, ret1, ret1a, ret2, ret2a, currency, tc, nioammount, niostotal, niotax, niointur, niobillpayment, cut, nd, dtype) values ('$id', '$bill[$c]', '$nfammount', '$letters[$c]', '$nfstotal', '$nfstotal2', '$nftax', '$nfintur', '$nfinturammount', '$nfexempt', '$nfexempt2', '$type[$c]', '$concept[$c]', '$concept2[$c]', '$billdate[$c]', '$billdate2[$c]', '$ret1', '$nfftotal1', '$ret2', '$nfftotal2', '$currency', '$tc', '$nfnioammount', '$nfniostotal', '$nfniotax', '$nfniointurammount', '$nfniobillpayment', '$billcut', '$nd[$c]', '$dtype[$c]')"; 
			 $result1 = mysqli_query($con, $query1);
		
		
  	}

    //start expiration
    if($dspayment == 1){
	   $querybills = "select * from bills where payment = '$id' order by billdate asc limit 1";
	   $resultbills = mysqli_query($con, $querybills);
	   $rowbills = mysqli_fetch_array($resultbills);
	
	   $fecha = $rowbills['billdate'];
	   $nuevafecha = strtotime ( '+'.$rowprovider['term'].' day' , strtotime ( $fecha ) ) ;
	   $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
	
	   //$expiration = date('Y-m-d',strtotime('+'.$rowprovider['term'].' days', strtotime($datebill))); 
	   $expiration = $nuevafecha; 
	
    }
    elseif($dspayment == 2){
	   //$expiration = date('Y-m-d',strtotime('+30 days', strtotime(date('Y-m-d'))));
	   $fecha = date('Y-m-d');
	   $nuevafecha = strtotime ( '+7 day' , strtotime ( $fecha ) ) ;
	   $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
	   $expiration = $nuevafecha;  
    }

    $queryexp = "update payments set expiration='$expiration' where id = '$id'";
    $resultexp = mysqli_query($con, $queryexp); 
    //End expiration
    
}

#main
#$query = "update payments set today='$today', btype='$dspayment', provider='$provider', collaborator='$collaborator', description='$description', ammount='$nftotalbill', ammount2='$ammount2', currency='$floatcurrency', ret1='$ret1', ret1a='$nfret1a', ret2='$ret2', ret2a='$nfret2a', payment='$nfpayment', paymentnio='$nfpayment2', beneficiarie='$beneficiarie', route='$route', headship='$headship', headship2='$headship', retainer='$retainer', notes='$notes', distribution='$distributable', distributable='$distributable', acp='$retainer2', acp2='$retainer3', stotal='$gstotald', cut='$cut' where id = '$id'";
#$result = mysqli_query($con, $query);   

if($updateFiles == 1){
   //Files
    $fileid = $_POST['fileid'];
    $file = $_POST['file'];
    $querydeletef = "update files set deletefile = 1 where payment = '$id'";
    $resultdeletef=mysqli_query($con, $querydeletef);
    for($c=0;$c<sizeof($fileid);$c++){
 
	   //si el archivo no existe
	   //echo $c.'-'.$file[$c].' <br>';
	   if($file[$c] != ""){
           if($fileid[$c] == 0){
               $query32 = "insert into files (payment, link, deletefile) values ('$id', '$file[$c]', '0')";
           }else{
               $query32 = "update files set link='$file[$c]', deletefile='0' where id = '$fileid[$c]'";
           }
           $result32 = mysqli_query($con, $query32); 
	   }
    }

    $querydeletef2 = "delete from files where payment = '$id' and deletefile = '1'";
    $resultdeletef2=mysqli_query($con, $querydeletef2); 
    
}

$thestage = $rowmain['status'];
$query2 = "insert into times (payment, today, now, now2, userid, stage, comment, stage2) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '$thestage', '$_POST[notesrep]', 'Pago reparado')"; 
$result2 = mysqli_query($con, $query2);  

header('location: payment-order-view.php?id='.$id);

function numberFormat($unformatedNumber){ 
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}


?>