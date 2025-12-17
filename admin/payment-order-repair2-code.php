<?php 
/*
include("session-request.php");
#require '/var/www/html/assets/PHPMailer/PHPMailerAutoload.php'; 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$querymain = "SELECT * FROM payments WHERE id = ?";
$stmtmain = $con->prepare($querymain);
$stmtmain->bind_param("i", $id); // "i" porque se asume que $id es un entero
$stmtmain->execute();
$resultmain = $stmtmain->get_result();
$rowmain = $resultmain->fetch_assoc(); // Obtener una fila como un arreglo asociativo
$stmtmain->close();




$user = sanitizeInput($_SESSION['userid'], $con); // Sanitizar la variable de sesión
$newbutton = isset($_POST['newbutton']) ? sanitizeInput($_POST['newbutton'], $con) : null;
$notes = isset($_POST['notes']) ? sanitizeInput(addslashes($_POST['notes']), $con) : null;
$dspayment = isset($_POST['dspayment']) ? sanitizeInput($_POST['dspayment'], $con) : null;
$type = isset($_POST['type']) ? sanitizeInput($_POST['type'], $con) : null;
$concept = isset($_POST['concept']) ? sanitizeInput($_POST['concept'], $con) : null;
$concept2 = isset($_POST['concept2']) ? sanitizeInput($_POST['concept2'], $con) : null;
$description = isset($_POST['description']) ? sanitizeInput(addslashes($_POST['description']), $con) : null;
$monitor = isset($_POST['monitor']) ? sanitizeInput($_POST['monitor'], $con) : null;


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
$immediate = $_POST['immediate'];
//Bill Insurer
$ipolicy = $_POST['ipolicy'];
$iquotaqq = $_POST['iquotaqq'];
$iquotano = $_POST['iquotano'];
$iquotaexpiration = $_POST['iquotaexpiration'];

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
$retainer4 = $_POST['retainer4'];

$modrettype = $_POST['modrettype'];
$modrettoday = $_POST['modrettoday'];
$modretno = $_POST['modretno'];
$modretprovider = $_POST['modretprovider'];
$modretaddress = $_POST['modretaddress'];
$modretruc = $_POST['modretruc'];
$modretnid = $_POST['modretnid'];
$modretphone = $_POST['modretphone'];
$modretconcept = $_POST['modretconcept'];
$modretbills = $_POST['modretbills'];
$modrettotalbill = $_POST['modrettotalbill'];
$modretpercent = $_POST['modretpercent'];
$modrettotalretention = $_POST['modrettotalretention'];
$modretelaborator = $_POST['modretelaborator'];
$cc = $_POST['cc'];
$solvency = date("Y-m-d", strtotime($_POST['solvency']));
$ncatalog = $_POST['ncatalog'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$distributable = $_POST['distributable'];
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
if(($description == "") and ($newbutton == "save")){ ?>
<script> 
alert('Usted debe de ingresar una descripcion. (CODE)');
history.go(-1);
</script>
<?php exit();
}
if(($payment <= 0) and ($newbutton == "save")){ ?>
<script> 
alert('El monto no puede ser igual a cero. (CODE)');
history.go(-1);
</script>
<?php exit();
}
//Comprobar facturas
if(($provider > 0) and ($newbutton == "save")){
    
    $billErr = 0;
    $billErrStr = "";
    
    for($tb=0;$tb<sizeof($bill);$tb++){
        
        $queryThisBill = "select payments.id from bills inner join payments on bills.payment = payments.id where payments.provider = '$provider' and bills.number = '$bill[$tb]' and payments.id != '$id' and payments.status > '0' and payments.approved != '2'";
        $resultThisBill = mysqli_query($con, $queryThisBill);
        $numThisBill = mysqli_num_rows($resultThisBill);
        if($numThisBill > 0){
            $rowThisBill = mysqli_fetch_array($resultThisBill);
            $billErr++;
            $billErrStr.= " Documento No. $bill[$tb] en IDS: $rowThisBill[0], "; 
        }
        
    }
    
    if($billErr > 0){
        $billErrStr = substr($billErrStr,0,-2);
        exit("<script>alert('Error con Documento(s) repetidos: $billErrStr (CODE)');history.go(-1);</script>");
    }
   
}

$querymain = "select * from payments where id = '$id'";
$resultmain = mysqli_query($con, $querymain);
$rowmain = mysqli_fetch_array($resultmain);

//Delete distribution
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
			
			$unitInfo = explode(',', $dunit[$c]);
			$thisunit = $unitInfo[0];
			$thisunitid = $unitInfo[1]; 
			
			if($did[$c] == 0){
				$querydistribution = "insert into distribution (payment, unit, unitid, percent, total, ddelete) values ('$id', '$thisunit', '$thisunitid', '$dpercent[$c]', '$dtotal[$c]', '0')";
			} 
			else{
				$querydistribution = "update distribution set unit='$thisunit', unitid='$thisunitid', percent='$dpercent[$c]', total='$dtotal[$c]', ddelete='0' where id = '$did[$c]'"; 
			} 
			$resultdistribution = mysqli_query($con, $querydistribution);
			 
		}	
	}
}
else{
	
	$querydistribution = "select * from distribution where payment = '$id'"; 
	$resultdistribution = mysqli_query($con, $querydistribution);
	$numdistribution = mysqli_num_rows($resultdistribution);
	if($numdistribution == 0){
		$querydistribution = "insert into distribution (payment, unitid, percent, total)o values ('$id', '$route', '100', '$_POST[stotalbill]')"; 
		$resultdistribution = mysqli_query($con, $querydistribution);
	} 
	
	
}
$querydd2 = "delete from distribution where payment = '$id' and ddelete = '1'";
$resultdd2 = mysqli_query($con, $querydd2);  

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

//Get the Company (Route based)
$querycompany = "select companies.id from companies inner join units on companies.code = units.companyCode where units.id = '$rowmain[route]'"; 
$resultcompany = mysqli_query($con, $querycompany);
$rowcompany = mysqli_fetch_array($resultcompany);
$company = $rowcompany['id'];

//get the mgmp
$mgmp = 4;
//Cordobas-Cordobas
if(($floatcurrency == 1) and ($currency == 1)){
	$mgmp = "1";
}
//Dolares-Dolares
if(($floatcurrency == 2) and ($currency == 2)){
	$mgmp = "2";
}
//Dolares-Cordobas
if(($floatcurrency == 1) and ($currency == 2)){
	$mgmp = "3";
}

$query = "update payments set today='$today', btype='$dspayment', provider='$provider', collaborator='$collaborator', description='$description', ammount='$nftotalbill', ammount2='$ammount2', currency='$floatcurrency', ret1='$ret1', ret1a='$nfret1a', ret2='$ret2', ret2a='$nfret2a', payment='$nfpayment', paymentnio='$nfpayment2', userid='$_SESSION[userid]', beneficiarie='$beneficiarie', retainer='$retainer', notes='$notes', distribution='$distributable', distributable='$distributable', acp='$retainer2', acp2='$retainer3', stotal='$gstotald', manualrets='$retainer4', cut='$cut', immediate='$immediate', mgmp='$mgmp', cc='$cc', monitor='$monitor', solvencyExpiration='$solvency', ncatalog='$ncatalog' where id = '$id'";
$result = mysqli_query($con, $query);    

//Start Billing write or Update
$ammount = $_POST['ammount'];
$stotal2 = $_POST['stotal2'];
$dtype = $_POST['dtype'];
$billId = $_POST['billId'];

$querydeletebill = "update bills set ddelete='1' where payment = '$id'";
$resultdeletebill = mysqli_query($con, $querydeletebill);

for($c = 0; $c < sizeof($ammount); $c++){
    
    $thisBillId = $billId[$c];
    
    $billdate[$c] = date("Y-m-d", strtotime($billdate[$c]));
	$billdate2[$c] = date("Y-m-d", strtotime($billdate2[$c]));
	$iquotaexpiration[$c] = date("Y-m-d", strtotime($iquotaexpiration[$c]));
    		
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
			
			
	$thebillc = addslashes($bill[$c]); 
    
    if($thisBillId > 0){
        
        $query1 = "update bills set  number='$thebillc', ammount='$nfammount', letters='$letters[$c]', stotal='$nfstotal', stotal2='$nfstotal2', tax='$nftax', intur='$nfintur', inturammount='$nfinturammount', exempt'$nfexempt', exempt2='$nfexempt2', type='$type[$c]', concept='$concept[$c]', concept2='$concept2[$c]', billdate='$billdate[$c]', billdate2='$billdate2[$c]', ret1='$ret1', ret1a='$nfftotal1', ret2='$ret2', ret2a='$nfftotal2', currency='$currency', tc='$tc', nioammount='$nfnioammount', niostotal='$nfniostotal', niotax='$nfniotax', niointur='$nfniointurammount', niobillpayment='$nfniobillpayment', cut='$billcut', nd='$nd[$c]', dtype='$dtype[$c]', ipolicy='$ipolicy[$c]', iquotaqq='$iquotaqq[$c]', iquotano='$iquotano[$c]', iquotaexpiration='$iquotaexpiration[$c]', ncatalog='$ncatalog', ddelete='0' where id = '$thisBillId'";
        $result1 = mysqli_query($con, $query1);
        
    }else{
        
        $query1 = "insert into bills (payment, number, ammount, letters, stotal, stotal2, tax, intur, inturammount, exempt, exempt2, type, concept, concept2, billdate, billdate2, ret1, ret1a, ret2, ret2a, currency, tc, nioammount, niostotal, niotax, niointur, niobillpayment, cut, nd, dtype, ipolicy, iquotaqq, iquotano, iquotaexpiration, ncatalog, ddelete) values ('$id', '$thebillc', '$nfammount', '$letters[$c]', '$nfstotal', '$nfstotal2', '$nftax', '$nfintur', '$nfinturammount', '$nfexempt', '$nfexempt2', '$type[$c]', '$concept[$c]', '$concept2[$c]', '$billdate[$c]', '$billdate2[$c]', '$ret1', '$nfftotal1', '$ret2', '$nfftotal2', '$currency', '$tc', '$nfnioammount', '$nfniostotal', '$nfniotax', '$nfniointurammount', '$nfniobillpayment', '$billcut', '$nd[$c]', '$dtype[$c]', '$ipolicy[$c]', '$iquotaqq[$c]', '$iquotano[$c]', '$iquotaexpiration[$c]', '$ncatalog', '0')";
        $result1 = mysqli_query($con, $query1);  
    
    }
    
    
			
}

$querydeletebill2 = "delete from bills where payment = '$id' and ddelete='1'";
#$resultdeletebill = mysqli_query($con, $querydeletebill2);
	
//Start Manual retentions
$querydeleteretentions = "delete from manualretentions where payment = '$id'";
$resultdeleteretentions = mysqli_query($con, $querydeleteretentions);
if($retainer4 == 1){
	for($c = 0; $c < sizeof($modrettype); $c++){
		
		$thetoday[$c] = date("Y-m-d", strtotime($modrettoday[$c]));  
		
		$queryrets = "insert into manualretentions (payment, type, today, number, provider, address, ruc, nid, phone, concept, bills, totalbill, percent, totalretention, elaborator) values ('$id', '$modrettype[$c]', '$thetoday[$c]', '$modretno[$c]', '$modretprovider[$c]', '$modretaddress[$c]', '$modretruc[$c]', '$modretnid[$c]', '$modretphone[$c]', '$modretconcept[$c]', '$modretbills[$c]', '$modrettotalbill[$c]', '$modretpercent[$c]', '$modrettotalretention[$c]', '$modretelaborator[$c]')";  
		$resultrets = mysqli_query($con, $queryrets);   
		
		
  	}
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
	$nuevafecha = strtotime ( '+5 day' , strtotime ( $fecha ) ) ;
	$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
	$expiration = $nuevafecha; 
}

#$queryexp = "update payments set expiration='$expiration' where id = '$id'";
#$resultexp = mysqli_query($con, $queryexp);  

//End expiration

//Files
$fileid = $_POST['fileid'];
$file = $_POST['file'];
$querydeletef = "update files set deletefile = 1 where payment = '$id'";
$resultdeletef=mysqli_query($con, $querydeletef);
for($c=0;$c<sizeof($fileid);$c++) {
 
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

#Solvencies
$solvencyArr = explode(',',$_POST['solvencyfile']);
$solvencyfile = $solvencyArr[0];
$solvencylid = $solvencyArr[1];
$solvencyid = $solvencyArr[2];
$querydeletes = "update paymentsSolvency set deletefile = 1 where payment = '$id'";
$resultdeletes=mysqli_query($con, $querydeletes);
 
	//If the user doesnt pick a file. 
	if($solvencyfile != ""){
		
		if($solvencyid == 0){
			$query33 = "insert into paymentsSolvency (today, payment, link, linkid, expiration, deletefile) values ('$today', '$id', '$solvencyfile', '$solvencylid', '$solvency', '0')";
		}else{
			$query33 = "update paymentsSolvency set link='$solvencyfile', linkid='$solvencylid', expiration='$solvency', deletefile='0' where id = '$solvencyid'";
		}
		$result33 = mysqli_query($con, $query33); 
	}
	
$querydeletef2 = "delete from paymentsSolvency where payment = '$id' and deletefile = '1'";
$resultdeletef2=mysqli_query($con, $querydeletef2);
#End Solvencies


$thestage = $rowmain['status'];
$query2 = "insert into times (payment, today, now, now2, userid, stage, comment, stage2) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '$thestage', '$_POST[notesrep]', 'Pago reparado')"; 
$result2 = mysqli_query($con, $query2);   


//function getNext($payment, $unit, $headship, $stage, $userid)	
header("location: payment-order-view.php?id=".$id); 
    


function numberFormat($unformatedNumber){ 
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}

*/ 

?>