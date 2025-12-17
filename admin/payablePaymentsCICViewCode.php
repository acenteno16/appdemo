<?php 


include("session-payer.php");
include('configuration.php'); 
if($rowConfig['cic'] == 0){
	header('location: dashboard.php');
	exit();
}

$theid = $_POST['theid'];
$link = $_POST['link'];
$number = $_POST['number'];
$reference = $_POST['reference'];
$bank = $_POST['bank'];
$pce1 = $_POST['pce1'];
$linkArr = explode(':::', $link);
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$queryconfig = "select * from config where id = '1'";
$resultconfig = mysqli_query($con, $queryconfig);
$rowconfig = mysqli_fetch_array($resultconfig);

for($c=0;$c<sizeof($theid);$c++){
	
	$makecancellation = 1;
	
	if($link == "") $makecancellation = 0; 
	if($number[$c] == "") $makecancellation = 0;
	if($reference == "") $makecancellation = 0;
	if($bank == 0) $makecancellation = 0;	
	
	$thisStage = 14;
	$gcomments = "Enhorabuena, el pago ha sido cancelado. (CIC)"; 
	
	if($makecancellation == 1){
		
		//UPDATE DEL PAGO 
		$queryapprove = "update payments set status = '14', cnumber = '$number[$c]', clinkid='$linkArr[0]', clink='$linkArr[1]', reference='$reference', bank='$bank', pce1='2' where id = '$theid[$c]'	"; 
		$resultapprove = mysqli_query($con, $queryapprove);

		//time stage DEL PAGO
		$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$theid[$c]', '$today', '$now', '$now2', '$_SESSION[userid]', '14.02', '$gcomments')"; 
		$resulttime = mysqli_query($con, $querytime);

	}

}

//Recogemos el ID del grupo 
$group = $_POST['group'];
//Marcamos el grupo como cancelado porque hasta no demostrar que falta un pago queda como cancelado
$groupcancel = 1;

//Mandamos a llamar todos los pagos dentro del grupo de cancelación 
$querymain = "select * from schedulecontent where schedule = '$group'";
$resultmain = mysqli_query($con, $querymain);
$nummain = mysqli_num_rows($resultmain);
while($rowmain=mysqli_fetch_array($resultmain)){
    
	//Si el pago no esta cancelado marcamos el grupo como incompleto
    if($rowmain['payment'] > 0){
        //Leemos la informacion de cada pago para verificar que este cancelado
        $querypayment = "select status from payments where id = '$rowmain[payment]'";
        $resultpayment = mysqli_query($con, $querypayment);
        $rowpayment = mysqli_fetch_array($resultpayment);
        
        if($rowpayment['status'] < 14){
		  $groupcancel = 0;
	    }  
    }else{
        
        $querydelete = "delete from schedulecontent where id = '$rowmain[id]'";
        $resultdelete = mysqli_query($con, $querydelete); 
    }	
	
}

//Si el grupo esta compoletamente cancelado, lo marcamos como cancelado
if($groupcancel == 1){
	$queryupdategroup = "update schedule set status='6' where id = '$group'";
	$resultupdategroup = mysqli_query($con, $queryupdategroup); 
	
	$queryupdategrouptimes = "insert into scheduletimes (schedule, today, now, now2, userid, stage, comment) values ('$group', '$today', '$now', '$now2', '$_SESSION[userid]', '6', 'Enhorabuena, el grupo de pagos ha sido cancelado.')";
	$resultupdategrouptimes = mysqli_query($con, $queryupdategrouptimes); 
}

header("location: payable-payments.php");

?> 