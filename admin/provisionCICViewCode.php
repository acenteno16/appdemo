<?php 

include('session-provision.php');

include('configuration.php');
if($rowConfig['cic'] == 0){
	header('location: dashboard.php');
	exit();
}

require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$id = $_POST['id'];
$userid = $_SESSION['userid'];
$ptype = $_POST['ptype'];
$distributiontype = $_POST['distributiontype'];
$internationalno = $_POST['internationalno'];
$internationallink = $_POST['internationallink'];
$hall = $_POST['hall'];
$ppe1 = $_POST['ppe1'];
$nobatch = $_POST['nobatch'];
$linkbatch = $_POST['linkbatch'];
$nodocument = $_POST['nodocument'];
$linkdocument = $_POST['linkdocument'];

$querypayment = "select * from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);
$preturn = $rowpayment['preturn']; 

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
<?php exit();
}

if($linkdocument[0] == ""){ ?>
<script>
alert('Ingrese el link del documento.');
history.go(-1);
</script>
<?php exit(); 
}

$queryUpdate = "update payments set ppe1 = '2' where id = '$id'";
$resultUpdate = mysqli_query($con, $queryUpdate);
$gcomments = "Enhorabuena, el pago ha sido Provisionado. (CIC)"; 

for($c = 0; $c < sizeof($nobatch); $c++){
	 $query4 = "insert into batch (payment, nobatch, linkbatch, nodocument, linkdocument, preturn, cic) values ('$id', '$nobatch[$c]', '$linkbatch[$c]', '$nodocument[$c]', '$linkdocument[$c]', '$preturn', '1')"; 
	 $result4 = mysqli_query($con, $query4); 
}  
 
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '8.07', '$gcomments')";
$resulttime = mysqli_query($con, $querytime);


header("location: provisionCIC.php");

function numberFormat($unformatedNumber){
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}    

?>