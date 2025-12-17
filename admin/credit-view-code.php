<?php 

#312923
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

include('session-credit.php');
require '../assets/PHPMailer/PHPMailerAutoload.php';  
require 'sanitize.php';

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$userid = sanitizeInput($_SESSION['userid'], $con);
$ple1 = sanitizeInput($_POST['ple1'], $con);
$nobatch = sanitizeInput($_POST['nobatch'], $con);
$nodocument = sanitizeInput($_POST['nodocument'], $con);
$linkdocument = sanitizeInput($_POST['linkdocument'], $con); 

$querypayment = $con->prepare("select * from payments where id = ?");
$querypayment->bind_param("i", $id);
$querypayment->execute();
$resultpayment = $querypayment->get_result();
$rowpayment = $resultpayment->fetch_assoc();

$preturn = $rowpayment['preturn'];

$thisStage = "4.10";
$gcomments = "Enhorabuena, el pago ha sido procesado por crédito."; 

function showAlertAndGoBack($message) {
    echo "<script> 
            alert('$message'); 
            window.history.back(); // Redirige a la página anterior
          </script>";
    exit(); 
}

if(empty($nobatch)){
	showAlertAndGoBack('Ingrese el numero de batch.');
}
if(empty($nodocument)){
    showAlertAndGoBack('Ingrese el numero de documento.');
}
if(empty($linkdocument)){
    showAlertAndGoBack('Ingrese el link del documento.');
}

$querySettlement = $con->prepare("update payments set credit='2', creditbatch = ?, creditdocument = ?, creditlink = ? where id = ?");
$querySettlement->bind_param("sssi", $nobatch,$nodocument,$linkdocument,$id);
$querySettlement->execute();
 
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$queryTime = $con->prepare("insert into times (payment, today, now, now2, userid, stage, comment) values (?, ?, ?, ?, ?, ?, ?)");
$queryTime->bind_param("issssss", $id,$today,$now,$now2,$_SESSION['userid'],$thisStage,$gcomments);
$queryTime->execute();

if(($rowpayment['immediate'] == 1)){
	include('function-getnext.php');
	getNext($id,'4.10'); 
}

header("location: credit.php"); 

?>