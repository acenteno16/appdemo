<?php 

include('session-provision.php');
include('functionTax.php');
require '../assets/PHPMailer/PHPMailerAutoload.php'; 


$id = $_POST['id'];
$userid = $_SESSION['userid'];
$ptype = $_POST['ptype'];
$distributiontype = $_POST['distributiontype'];
$internationalno = $_POST['internationalno'];
$internationallink = $_POST['internationallink'];
$hall = $_POST['hall'];
$ppe1 = $_POST['ppe1'];

$querypayment = "select * from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);
$preturn = $rowpayment['preturn']; 


if(($hall == 0) and (($rowpayment['ret1a'] > 0))){ ?>
    <script>
        alert('Seleccionar la Sucursal.');
        history.go(-1);
    </script>
<?php exit(); }

$nobatch = $_POST['nobatch'];
$linkbatch = $_POST['linkbatch'];
$nodocument = $_POST['nodocument'];
$linkdocument = $_POST['linkdocument'];
$tProvision = $_POST['tProvision'];
$pkind = '8.08';
$pgp = 0;
if($tProvision == 1){ 

	if($nobatch[0] == ""){ ?>
	<script>
		alert('Ingrese el numero de batch.');
		history.go(-1);
	</script>
	<?php exit();
	}

	if($nodocument[0] == ""){ ?>
	<script>
alert('Ingrese el numero de documento.');
history.go(-1);
</script>
	<?php exit(); }

	if($linkdocument[0] == ""){ ?>
	<script>
alert('Ingrese el link del documento.');
history.go(-1);
</script>
<?php exit(); 
}
//End Arrays
}
else{
	
	#manuales.
	$pgp = 1;
	
}

#Reconocemos si es una compañía afiliada
$gcp = 0;
if($rowpayment['btype'] == 1){
    #Provider
    $queryprovider = "select gcp from providers where id = '$rowpayment[provider]'";
    $resultprovider = mysqli_query($con, $queryprovider);
    $rowprovider = mysqli_fetch_array($resultprovider);
    
    $gcp = $rowprovider['gcp'];
    
}

$adch = $_POST['adch'];

//Aqui revisamos si la ruta tiene aprobador de provisión
$queryroute = "select * from routes where unit = '$rowpayment[route]' and headship = '$rowpayment[headship]' and type = '19'";
$resultroute = mysqli_query($con, $queryroute);
$numroute = mysqli_num_rows($resultroute);

$aprovision = 1;
$aprovision2 = "";

if($numroute > 0){
	$aprovision = 0; 
	$aprovision2 = " En espera de aprobado de provision";
}

$queryapprove = "update payments set status = '8', distribution = '$distributiontype', ptype='$ptype', internationalno='$internationalno', internationallink='$internationallink', aprovision='$aprovision', adch='$adch', hall='$hall', d_approve='1', pgp='$pgp' where id = '$id'";
$resultapprove = mysqli_query($con, $queryapprove); 

taxCredit($id,1,$con);

$gcomments = "Enhorabuena, el pago ha sido Provisionado. (COVID)$pendientee1".$aprovision2; 

if($tProvision == 1){
	for($c = 0; $c < sizeof($nobatch); $c++){
		$query4 = "insert into batch (payment, nobatch, linkbatch, nodocument, linkdocument, preturn) values ('$id', '$nobatch[$c]', '$linkbatch[$c]', '$nodocument[$c]', '$linkdocument[$c]', '$preturn')"; 
		$result4 = mysqli_query($con, $query4); 
	}  
}else{
	
	$pBills = $_POST['pBills'];
	for($i=0;$i<sizeof($pBills);$i++){
		$thisBill = $pBills[$i];
		$pCompany = $_POST['pCompany'.$pBills[$i]][0];
		$pLMDate = $_POST['pLMDate'.$pBills[$i]][0];
		if($pLMDate != ''){
			$pLMDate = date("Y-m-d", strtotime($pLMDate));
		}else{
			$pLMDate = date('Y-m-d');
		}
		$pCurrency = $_POST['pCurrency'.$pBills[$i]][0];
		$pBillTc = $_POST['pBillTc'.$pBills[$i]][0];
		$pBillPayment = $_POST['pBillPayment'.$pBills[$i]][0];
	
		$queryInsertProvision = "insert into tProvision (payment, bill, company, todayLM, amount) values ('$id', '$thisBill', '$pCompany', '$pLMDate', '$pBillPayment')";
		$resultInsertProvision = mysqli_query($con,$queryInsertProvision);
		$provisionId = mysqli_insert_id($con);
	
		$pAccount = $_POST['pAccount'.$pBills[$i]];
		$pAux = $_POST['pAux'.$pBills[$i]];
		$pAuxType = $_POST['pAuxType'.$pBills[$i]];
		$pAmount = $_POST['pAmount'.$pBills[$i]];
		$pLabel = $_POST['pLabel'.$pBills[$i]];
		$pTc = $_POST['pTc'.$pBills[$i]];
	
		for($i2=0;$i2<sizeof($pAccount);$i2++){
		
			$queryInsertProvisionContent = "insert into tProvisionContent (provision, payment, bill, account, aux, auxType, amount, ref, tc) values ('$provisionId', '$id', '$thisBill', '$pAccount[$i2]', '$pAux[$i2]', '$pAuxType[$i2]', '$pAmount[$i2]', '$pLabel[$i2]', '$pTc[$i2]')";
			$resultInsertProvisionContent = mysqli_query($con, $queryInsertProvisionContent);
		
		}
	
	}
	
}
 
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '$pkind', '$gcomments')";
$resulttime = mysqli_query($con, $querytime);

	if(($rowpayment['immediate'] == 1)){
		include('function-getnext.php');
		getNext($id,'8'); 
	}

if(($gcp == 1) and ($aprovision == 1)){
    
    $now = date('Y-m-d H:i:s');
    $now2 = date('H:i:s');
    
    $queryapprove2 = "update payments set status = '9' where id = '$id'";
    $resultapprove2 = mysqli_query($con, $queryapprove2);
    $gcomments = "Enhorabuena, liberación automática por Sistema Getpay (Compañías afiliadas)."; 
    
    //time stage
    $querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', 'GETPAY', '9', '$gcomments')"; 
    $resulttime = mysqli_query($con, $querytime);
    
    $queryinsert = "insert into autoreleasing (payment, today, now, now2) values ('$id', '$today', '$now', '$now2')"; 
    $resultinsert = mysqli_query($con, $queryinsert);
    
    if(($rowpayment['immediate'] == 1)){ 
		getNext($id,'9');
	}
	/*
	if($rowpayment['blockrelease'] != ''){
		include('function-email-release.php');
		getRelease($id);
	}
	*/


    
}

header("location: provisionE1.php");

function numberFormat($unformatedNumber){
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}    


?>