<?php 

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include('session-provision.php');
require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$id = $_POST['id'];
$userid = $_SESSION['userid'];
$ptype = $_POST['ptype'];

$querypayment = "select * from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);
$preturn = $rowpayment['preturn'];
$file = $_POST['file'];

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

$batch = $_POST['batch'];
$document = $_POST['document'];
$tableid = $_POST['tableid'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

//Checker
for($c=0;$c<sizeof($tableid);$c++){

if($batch[$c] == ""){
	echo "<script>alert('Favor rellene los Batch.');history.go(-1);</script>";
	exit();
}
if($document[$c] == ""){
	echo "<script>alert('Favor rellene los Documentos.');history.go(-1);</script>";
	exit();
}
}

//Writer
for($c=0;$c<sizeof($tableid);$c++){

	$queryapprove = "update payments set status = '8', ptype='$ptype', aprovision='$aprovision' where id = '$tableid[$c]'";
	$resultapprove = mysqli_query($con, $queryapprove);
	$gcomments = "Enhorabuena, el pago ha sido provisionado.".$aprovision2;

	$documentarr= explode(',',$document[$c]);
	$documentarr = str_replace(' ','',$documentarr);
	for($c2=0;$c2<sizeof($documentarr);$c2++){
	 	$query4 = "insert into batch (payment, nobatch, nodocument, linkdocument, preturn) values ('$tableid[$c]', '$batch[$c]', '$documentarr[$c2]', '$file', '$preturn')"; 
	 	$result4 = mysqli_query($con, $query4); 
	 }
	 
	 //time stage
	$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$tableid[$c]', '$today', '$now', '$now2', '$_SESSION[userid]', '8', '$gcomments')"; 
	$resulttime = mysqli_query($con, $querytime);
	}  

	if(($rowpayment['immediate'] == 1)){
		include('function-getnext.php');
		getNext($id,'8'); 
	}

header("location: provision.php");

function numberFormat($unformatedNumber){
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}    

?>