<?php 

include("session-treasury.php");     
	
$id = intval($_POST['id']);

$querymain = "select * from payments where id = '$id'";
$resultmain = mysqli_query($con, $querymain);
$rowmain = mysqli_fetch_array($resultmain);

$totalbill = $_POST['totalbill'];
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

$floatammount2 = $_POST['floatammount2']; 
$nftotalbill = numberFormat($totalbill);
$floatpaymentnio = numberFormat($paymentnio);
$nfret1a= numberFormat($ret1a); 
$nfret2a= numberFormat($ret2a); 
$nfpayment=numberFormat($payment);
$nfpayment2=numberFormat($payment2);
$ammount2=numberFormat($floatammount2);
$notesrep = $_POST['notesrep'];

if($notesrep == ""){
	echo "<script>alert('Favor comente la razon de reparacion de la solicitud.');history.go(-1);</script>";
	exit();
} 

$gstotald = str_replace(',','',$_POST['stotalbill']);  
$cut = $_POST['cut'];

$query = "update payments set ammount='$nftotalbill', ammount2='$ammount2', currency='$floatcurrency', payment='$nfpayment', paymentnio='$floatpaymentnio', stotal='$gstotald' where id = '$id'";  
$result = mysqli_query($con, $query);   

$thestage = $rowmain['status'];
$query2 = "insert into times (payment, today, now, now2, userid, stage, comment, stage2) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '$thestage', '$notesrep', 'Pago reparado')"; 
$result2 = mysqli_query($con, $query2);    

header("location: payment-order-view.php?id=".$id);  


function numberFormat($unformatedNumber){ 
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}

?>