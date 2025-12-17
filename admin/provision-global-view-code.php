<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include('session-provision-global.php');
include('functionTax.php');
require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$id = $_POST['id'];
$userid = $_SESSION['userid'];
$ptype = $_POST['ptype'];
$distributiontype = $_POST['distributiontype'];
$internationalno = $_POST['internationalno'];
$internationallink = $_POST['internationallink'];
$hall = $_POST['hall'];
$pdescription = addslashes($_POST['pdescription']);

$querypayment = "select * from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);
$preturn = $rowpayment['preturn'];

if(($hall == 0) and (($rowpayment['ret1a'] > 0))){
?>
    <script>
        alert('Seleccionar la Sucursal.');
        history.go(-1);
    </script>
<?php exit();
}
//Arrays
$nobatch = $_POST['nobatch'];
if($nobatch[0] == ""){ ?>
    <script>
        alert('Ingrese el numero de batch.');
        history.go(-1);
    </script>
<?php exit();
}
$linkbatch = $_POST['linkbatch'];
$nodocument = $_POST['nodocument'];
if($nodocument[0] == ""){ ?>
<script>
alert('Ingrese el numero de documento.');
history.go(-1);
</script>
<?php exit();
}
$linkdocument = $_POST['linkdocument'];
if($linkdocument[0] == ""){ ?>
<script>
alert('Ingrese el link del documento.');
history.go(-1);
</script>
<?php exit(); 
}
//End Arrays


#Reconocemos si es una compañía afiliada
$gcp = 0;
if($rowpayment['btype'] == 1){
    #Provider
    $queryprovider = "select gcp from providers where id = '$rowpayment[provider]'";
    $resultprovider = mysqli_query($con, $queryprovider);
    $rowprovider = mysqli_fetch_array($resultprovider);
    
    $gcp = $rowprovider['gcp'];
    
}

$aprovision = 1;
$aprovision2 = "";

$queryapprove = "update payments set status = '8', distribution = '$distributiontype', ptype='$ptype', internationalno='$internationalno', internationallink='$internationallink', aprovision='$aprovision', hall='$hall', d_approve='1' where id = '$id'";
$resultapprove = mysqli_query($con, $queryapprove);
taxCredit($id,1,$con);

$querypupdate = "update payments set pdescription = '$pdescription' where id = '$id'";
$resultpupdate = mysqli_query($con, $querypupdate);

$gcomments = "Enhorabuena, el pago ha sido Provisionado (Global).".$aprovision2; 

for($c = 0; $c < sizeof($nobatch); $c++){
	 $query4 = "insert batch  (payment, nobatch, linkbatch, nodocument, linkdocument, preturn) values ('$id', '$nobatch[$c]', '$linkbatch[$c]', '$nodocument[$c]', '$linkdocument[$c]', '$preturn')"; 
	 $result4 = mysqli_query($con, $query4); 
}  
 
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '8.04', '$gcomments')"; 
$resulttime = mysqli_query($con, $querytime);

	if(($rowpayment['immediate'] == 1)){
		include('function-getnext.php');
		getNext($id,'8'); 
	}
   
    include('function-notify-covid.php');
	notifyUserCovid($id, $con);  
	


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

header("location: provision-global.php");

function numberFormat($unformatedNumber){
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}    

?>