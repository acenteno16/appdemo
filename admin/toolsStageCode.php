<?php 

include("session-admin.php");
require('fnMissingPayment.php');

#ini_set('display_errors', '1');
#ini_set('display_startup_errors', '1');
#error_reporting(E_ALL);

$stage = $_POST['stage'];

if($stage == 13){

	if(isset($_POST['idStr'])) {
	
	$paymentIds = $_POST['idStr'];
	
    $forceRetention = isset($_POST['retention']) ? $_POST['retention'] : 0;
	$forceToday = isset($_POST['forceToday']) ? $_POST['forceToday'] : 0;
	$tToday = isset($_POST['tToday']) ? $_POST['tToday'] : 0;
	
	if(($paymentIds == 0) or ($paymentIds == '')){
		exit("<script>alert('Favor ingrese un ID de solicutud..'); history.go(-1);</script>");
	}
	if(($tToday == 1) and (($forceToday == '') or ($forceToday == 0))){
		exit("<script>alert('No se ha seleccionado una fecha.'); history.go(-1);</script>");
	}
	
	if($forceToday != 0){
		$forceToday = date("Y-m-d", strtotime($forceToday));
	}
	if($tToday == 0){
		$forceToday = 0;
	}

    $paymentIds = str_replace(' ','', $paymentIds);
	$paymentIds = explode(',', $paymentIds); 

    foreach ($paymentIds as $id) {
        $id = intval($id);
        if ($id > 0) {
            missingPayment($id, $forceRetention, $forceToday);
			#echo "<br>($id, $forceRetention, $forceToday)";
        }
    }
	
	$referer = $_SERVER['HTTP_REFERER'];
    exit("<script>alert('¡Listo!'); window.location='$referer';</script>");
}else{
		echo 'No se encontro idStr';
	}
	
}else{
	exit("<script>alert('No se ha seleccionado un estado.'); history.go(-1);</script>");
}
	 
?>