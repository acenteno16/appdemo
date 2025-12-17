<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("session-payer.php");
require('functions.php');

$theid = isset($_POST['theid']) ? sanitizeInput($_POST['theid'], $con) : [];
$link = isset($_POST['link']) ? sanitizeInput($_POST['link'], $con) : '';
$linkArr = explode(':::', $link);
#$number = isset($_POST['number']) ? sanitizeInput($_POST['number'], $con) : '';
$number= $_POST['number'];
$reference = isset($_POST['reference']) ? sanitizeInput($_POST['reference'], $con) : '';
$bank = isset($_POST['bank']) ? sanitizeInput($_POST['bank'], $con) : '';
$pce1 = isset($_POST['pce1']) ? sanitizeInput($_POST['pce1'], $con) : '';

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
		$gcomments = "Enhorabuena, el pago ha sido cancelado."; 
		if($pce1 == 1){
			$makecancellation = 1;
			$thisStage = '14.01';
			$gcomments = "Enhorabuena, el pago ha sido cancelado. [Pendiente E1]"; 
		}
	
		if($makecancellation == 1){
			
			$thisId = intval($theid[$c]);
			$querypayment = "select * from payments where id = '$thisId'";
			$resultpayment = mysqli_query($con, $querypayment);
			$rowpayment = mysqli_fetch_array($resultpayment);
        
			//UPDATE DEL PAGO 
			#$queryapprove = "update payments set status = '14', cnumber = '$number[$c]', clinkid='$linkArr[0]', clink='$linkArr[1]', reference='$reference', bank='$bank', pce1='$pce1' where id = '$thisId'"; 
			#$resultapprove = mysqli_query($con, $queryapprove);
			$thisstatus = 14; 
    		$thiscnumber = isset($number[$c]) ? $number[$c] : null;
    		$thisclinkid = isset($linkArr[0]) ? $linkArr[0] : null;
    		$thisclink = isset($linkArr[1]) ? $linkArr[1] : null;
    		$thisreference = isset($reference) ? $reference : null;
    		$thisbank = isset($bank) ? $bank : null;
    		$thispce1 = isset($pce1) ? $pce1 : null;
    		$thisid = intval($thisId);
			
			$queryapprove = "UPDATE payments 
                     SET status = ?, 
                         cnumber = ?, 
                         clinkid = ?, 
                         clink = ?, 
                         reference = ?, 
                         bank = ?, 
                         pce1 = ? 
                     WHERE id = ?";
    		$stmt = $con->prepare($queryapprove);
			$stmt->bind_param("issssssi", $thisstatus, $thiscnumber, $thisclinkid, $thisclink, $thisreference, $thisbank, $thispce1, $thisid);
			$stmt->execute();
			$stmt->close();
			
			#$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$thisId', '$today', '$now', '$now2', '$_SESSION[userid]', '$thisStage', '$gcomments')"; 
			#$resulttime = mysqli_query($con, $querytime);
			
			$userid = $_SESSION['userid'];
			$querytime = "INSERT INTO times (payment, today, now, now2, userid, stage, comment) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
    		$stmttime = $con->prepare($querytime);
			$stmttime->bind_param("isssiss", $thisId, $today, $now, $now2, $userid, $thisStage, $gcomments);
			$stmttime->execute();
        
        	if($rowpayment['provider'] > 0){ 
            	$queryProviderTime = "update providers set lastTransaction='$today' where id = '$thisId'";
            	$resultProviderTime = mysqli_query($con, $queryProviderTime);
        	}

		}

	}

//Recogemos el ID del grupo 
$group = isset($_POST['group']) ? sanitizeInput($_POST['group'], $con) : '';
//Marcamos el grupo como cancelado porque hasta no demostrar que falta un pago queda como cancelado
$groupcancel = 1;
//Mandamos a llamar todos los pagos dentro del grupo de cancelación 
$querymain = "SELECT * FROM schedulecontent WHERE schedule = ?";
$stmt = $con->prepare($querymain);
$stmt->bind_param("s", $group); // 's' indica que el parámetro es una cadena
$stmt->execute();
$resultmain = $stmt->get_result();
$nummain = $resultmain->num_rows;
while ($rowmain = $resultmain->fetch_assoc()) {    
	//Si el pago no esta cancelado marcamos el grupo como incompleto
    if($rowmain['payment'] > 0){
        //Leemos la informacion de cada pago para verificar que este cancelado
        $querypaymentc = "select status from payments where id = '$rowmain[payment]'";
        $resultpaymentc = mysqli_query($con, $querypaymentc);
        $rowpaymentc = mysqli_fetch_array($resultpaymentc);
        
        if($rowpaymentc['status'] < 14){
		  $groupcancel = 0;
	    }  
    }
	else{
        $querydelete = "delete from schedulecontent where id = '$rowmain[id]'";
        $resultdelete = mysqli_query($con, $querydelete); 
    }
}

//Si el grupo esta compoletamente cancelado, lo marcamos como cancelado
if($groupcancel == 1){
	#$queryupdategroup = "update schedule set status='6' where id = '$group'";
	#$resultupdategroup = mysqli_query($con, $queryupdategroup); 
	$status = 6;
    $thisGroup = intval($group);
	$queryupdategroup = "UPDATE schedule SET status = ? WHERE id = ?";
    $stmtupdategroup = $con->prepare($queryupdategroup);
	$stmtupdategroup->bind_param("ii", $status, $thisGroup); // 'ii' indica dos enteros
    $stmtupdategroup->execute();
		
	#$queryupdategrouptimes = "insert into scheduletimes (schedule, today, now, now2, userid, stage, comment) values ('$group', '$today', '$now', '$now2', '$_SESSION[userid]', '6', 'Enhorabuena, el grupo de pagos ha sido cancelado.')";
	#$resultupdategrouptimes = mysqli_query($con, $queryupdategrouptimes);
	$stage = 6;
    $comment = "Enhorabuena, el grupo de pagos ha sido cancelado.";
	$userid = $_SESSION['userid'];
	$queryupdategrouptimes = "INSERT INTO scheduletimes 
                              (schedule, today, now, now2, userid, stage, comment) 
                              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtupdategrouptimes = $con->prepare($queryupdategrouptimes);
	$stmtupdategrouptimes->bind_param("ssssiss", $group, $today, $now, $now2, $userid, $stage, $comment);
	$stmtupdategrouptimes->execute(); 
}

header("location: payable-payments.php");

?> 