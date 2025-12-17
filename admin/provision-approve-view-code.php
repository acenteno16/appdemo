<?php 

include("session-provision2.php");
include('functionTax.php');

$id = $_POST['id'];
$provision = $_POST['provision'];
$reason = $_POST['reason'];
$reason2 = $_POST['reason2'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

if($provision == 1){

$querypayment = "select * from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);
$preturn = $rowpayment['preturn'];    
    
#Reconocemos si es una compañía afiliada
$gcp = 0;
if($rowpayment['btype'] == 1){
    #Provider
    $queryprovider = "select gcp from providers where id = '$rowpayment[provider]'";
    $resultprovider = mysqli_query($con, $queryprovider);
    $rowprovider = mysqli_fetch_array($resultprovider);
    
    $gcp = $rowprovider['gcp'];
    
}    

$queryapprove = "update payments set aprovision = '1' where id = '$id'";
$resultapprove = mysqli_query($con, $queryapprove);
$gcomments = "Enhorabuena, la provisiÃ³n ha sido aprobada.";

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '8.01', '$gcomments')"; 
$resulttime = mysqli_query($con, $querytime);
    
if($gcp == 1){
    
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
		#getNext($id,'9');
	}
    
}    

}
if($provision == 2){

$querylasttime = "select * from times where stage >= '2' and stage <= '4' and payment = '$id' order by stage desc";
$resultlasttime = mysqli_query($con, $querylasttime);
$rowlasttime=mysqli_fetch_array($resultlasttime);

$laststatus = $rowlasttime['stage'];

$queryapprove = "update payments set status = '$laststatus', aprovision='0', preturn = preturn + 1 where id = '$id'";
$resultapprove = mysqli_query($con, $queryapprove);
taxCredit($id,2,$con); 

$gcomments = "El pago ha sido regresado a provisiÃ³n.";

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '8.02', '$gcomments', '$reason')"; 
$resulttime = mysqli_query($con, $querytime);

//Enviar notificación y correo al provisionador.

}
if($provision == 3){

$queryapprove = "update payments set approved='2', status = '7.08', reason='$reason2' where id = '$id'";
$resultapprove = mysqli_query($con, $queryapprove);
taxCredit($id,2,$con);
$gcomments = "Rechazado en aprobaciÃ³n de proviciÃ³n.";

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '7.08', '$gcomments', '$reason')";   
$resulttime = mysqli_query($con, $querytime);

//Enviar notificación y correo al provisionador.


}


header("location: ".$_SERVER['HTTP_REFERER']);

?>