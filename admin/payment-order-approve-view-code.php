<?php 

include('session-request2.php');
require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$err_count = 0;

//Get vars 
$userid = $_SESSION['userid'];
$id = $_GET['id'];
$approve = $_GET['approve'];
$comments = $_GET['reason'];
$reason = $_GET['reason2'];

//El pago debe de tener aprobado o reprobado
if($approve == 0){
	exit("<script>alert('Debe de seleccionar una opcion de aprobado.')</script>");
}

//For para aprobar varios pagos (Array de pagos)
for($c=0;$c<sizeof($id);$c++){ 

$id_int = intval($id[$c]); 

//Last User	
$querylasttime = "select * from times where payment = '$id_int' order by id desc limit 1";
$resultlasttime = mysqli_query($con, $querylasttime);
$rowlasttime = mysqli_fetch_array($resultlasttime);

if($rowlasttime['userid'] != $_SESSION['userid']){ 
	
	//Seleccionamos el pago
	$querypayment = "select * from payments where id = '$id_int'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);

	//Leemos el estado del pago 
	$status = $rowpayment['status']; 
	$gcomments2 = 0;
	$atype = $rowpayment['status'];
	
	if(($rowpayment['approve'] > 0) or ($rowpayment['arequest'] > 0)){
		#doNothing
	}else{

		//Si no es aprobado (Reprobar solicitúd)
		if($approve == 2){   
		$is_approved = 0;	
		$query = "update payments set status = '7.09', reason='$reason', approved='2' where id = '$id_int'";
    	$result = mysqli_query($con, $query);
		$nstage = "7.09"; 
		$gcomments = $comments;
	
		$today = date("Y-m-d");
		$now = date('Y-m-d H:i:s');
		$now2 = date('H:i:s');

		//time stage 
		$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$id_int', '$today', '$now', '$now2', '$_SESSION[userid]', '$nstage', '$gcomments', '$reason', '$reason2')"; 
		$resulttime = mysqli_query($con, $querytime); 

	}
		//Si es aprobado (Aprobar solicitúd)
		else{

		$is_approved = 1;
		$queryapprove = "update payments set arequest = '1', headship='0' where id = '$id_int'"; 
		$resultapprove = mysqli_query($con, $queryapprove);
		$nstage = "1.01"; 
		$gcomments = "Enhorabuena, el pago tiene el visto bueno."; 
	
		$today = date("Y-m-d");
		$now = date('Y-m-d H:i:s');
		$now2 = date('H:i:s');

		//time stage 
		$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id_int', '$today', '$now', '$now2', '$_SESSION[userid]', '$nstage', '$gcomments')"; 
		$resulttime = mysqli_query($con, $querytime); 
	
		if(($is_approved == 1) and ($rowpayment['immediate'] == 1) and ($rowpayment['chil'] == '')){
			include('function-getnext.php');
			getNext($id_int,$nstage);
		}
	

	}
		
	}
	
}
else{
	$err_ids.= "$id_int, ";
	$err_count++;
}
}

$message = "";
if($err_count > 0){
	$message = "?message=La(s) solicitud(es) $err_ids no fueron procesadas debido a que fueron ingresadas por usted.";
} 

header("location: payment-order-approve.php".$message);

?>