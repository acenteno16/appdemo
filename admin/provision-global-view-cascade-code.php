<? 

#provision-global-view-cascade-code.php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require('session-provision.php');
require('functionTax.php');
require('functions.php');
require('../assets/PHPMailer/PHPMailerAutoload.php'); 

$id = isset($_POST['id']) ? sanitizeInput(intval($_POST['id']), $con) : [];
$userid = $_SESSION['userid'];
$ptype = $_POST['ptype'];
$ppe1 = $_POST['ppe1'];
$afiles = $_POST['afiles'];
$tableid = isset($_POST['tableid']) ? sanitizeInput($_POST['tableid'], $con) : [];

$querypayment = "select preturn, immediate, route, headship, hc, btype, provider from payments where id = ?";
$stmtpayment = $con->prepare($querypayment);
$stmtpayment->bind_param("i", $id);
$stmtpayment->execute();
$resultpayment = $stmtpayment->get_result();
$rowpayment = $resultpayment->fetch_assoc();

$gcp = 0;
if($rowpayment['btype'] == 1){
    #Provider
    $queryprovider = "select gcp from providers where id = '$rowpayment[provider]'";
    $resultprovider = mysqli_query($con, $queryprovider);
    $rowprovider = mysqli_fetch_array($resultprovider);
    
    $gcp = $rowprovider['gcp'];
    
}

$preturn = $rowpayment['preturn'];
$file = $_POST['file'];


$aprovision = 1;
$aprovision2 = "";

$batch = isset($_POST['batch']) ? sanitizeInput($_POST['batch'], $con) : [];
$document = isset($_POST['document']) ? sanitizeInput($_POST['document'], $con) : [];
$linkdocument = isset($_POST['linkdocument']) ? sanitizeInput($_POST['linkdocument'], $con) : [];
$linkbatch = isset($_POST['linkbatch']) ? sanitizeInput($_POST['linkbatch'], $con) : []; 

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$pendientee1 = '';
$pkind = '8.05';
if($ppe1 == 1){
	$pendientee1 = ' [Pendiente E1]';
	$pkind = '8.06';
}else{
	//Checker 
	for($b=0;$b<sizeof($batch);$b++){
		if($batch[$b] == ""){
			exit("<script>alert('Favor rellene los Batch.');history.go(-1);</script>");
		}
		if($document[$b] == ""){
			exit("<script>alert('Favor rellene los Documentos.');history.go(-1);</script>");
		}
	}
}

//Writer
for($c=0;$c<sizeof($tableid);$c++){
	
	#Aqui actualizamos el pago en cascada
	$queryapprove = "update payments set status = '8', ptype='$ptype', aprovision='$aprovision', d_approve='1' where id = '$tableid[$c]'";
	$resultapprove = mysqli_query($con, $queryapprove);
	taxCredit($tableid[$c],1,$con);
	$gcomments = "Enhorabuena, el pago ha sido Provisionado. (GLOBAL)$pendientee1".$aprovision2;
	
	
	#explotamos los documentos del id especifico (comma separados)
	$documentsArr = explode(",", $document[$c]);
	
	#Guadamnos la provisión
	for($d=0;$d<sizeof($documentsArr);$d++){
		
		if($documentsArr[$d] != ''){
			$query4 = "insert into batch (payment, nobatch, linkbatch, nodocument, linkdocument, preturn) values ('$tableid[$c]', '$batch[$c]', '$linkbatch[$c]', '$documentsArr[$d]', '$linkdocument[$c]', '$preturn')"; 
			$result4 = mysqli_query($con, $query4); 	
		}
		
	}  

	//time stage
	$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$tableid[$c]', '$today', '$now', '$now2', '$_SESSION[userid]', '$pkind', '$gcomments')";
	$resulttime = mysqli_query($con, $querytime);
	
	if($gcp == 1){
    
    	$queryapprove2 = "update payments set status = '9' where id = '$tableid[$c]'";
    	$resultapprove2 = mysqli_query($con, $queryapprove2);
    	$gcomments = "Enhorabuena, liberación automática por Sistema Getpay (Capital Humano)."; 
    
    	//time stage
    	$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$tableid[$c]', '$today', '$now', '$now2', 'GETPAY', '9', '$gcomments')"; 
    	$resulttime = mysqli_query($con, $querytime);
    
		$queryinsert = "insert into autoreleasing (payment, today, now, now2) values ('$tableid[$c]', '$today', '$now', '$now2')";  
		$resultinsert = mysqli_query($con, $queryinsert);
    
	}
	
}  

if(($rowpayment['immediate'] == 1)){
	include('function-getnext.php');
	getNext($id,'8'); 
}

include('function-notify-covid.php');
notifyUserCovid($id, $con);  

header("location: provision-covid.php");

function numberFormat($unformatedNumber){
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}    

?>