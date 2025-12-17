<?php 

include("session-review.php");
require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$id = intval($_GET['id']);

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$userid = $_SESSION['userid'];
$foption = $_GET['foption'];

//comments
$reason = $_GET['reason'];
//Selector
$reason2 = $_GET['reason2']; 

//Regresar a provisión
if($foption == 1){

	$querylasttime = "select * from times where stage >= '2' and stage <= '4' and payment = '$id' order by stage desc";
	$resultlasttime = mysqli_query($con, $querylasttime);
	$rowlasttime=mysqli_fetch_array($resultlasttime);

	$laststatus = $rowlasttime['stage'];

	$queryapprove = "update payments set status = '$laststatus', reason='$reason2', preturn = preturn + 1 where id = '$id'";
	$resultapprove = mysqli_query($con, $queryapprove);
	
	$gcomments = "El pago ha sido regresado a provisiÃ³n."; 

	//time stage
	$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '11.02', '$gcomments', '$reason', '$reason2')"; 
	$resulttime = mysqli_query($con, $querytime);

	//Enviar notificación y correo al provisionador.
	include('fn-provision.php');
	fnProvision($id,$_SESSION['userid']);  
	
	
}
//Rechazar solicitud
elseif($foption == 2){
	/*
	$query = "update payments set approved='2', status='7.07', reason='$reason2' where id = '$id'";
	$result = mysqli_query($con, $query);
	$gcomments = "Rechazado en Control de Calidad.";

	//time stage
	$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '7.07', '$gcomments', '$reason')";  
	$resulttime = mysqli_query($con, $querytime);

	include('fn-rejection.php');
	fnReject($id,$_SESSION['userid']);
	*/
	
	//Start
	$queryreject = "update payments set status = '7.07', reason='$reason2', approved='2' where id = '$id'";
    $resultreject = mysqli_query($con, $queryreject);
	$gcomments = $comments;	
	
	$gcomments = "Rechazado en Control de Calidad."; 
	
	
	$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '7.07', '$gcomments', '$reason', '$reason2')"; 
	$resulttime = mysqli_query($con, $querytime); 
	
	include('fn-rejection.php');
	fnReject($id,$_SESSION['userid']);  

	//END
	   
}
//Revision con Err.
elseif($foption == 3){
    
    $aorder = $_POST['aorder'];
    $aprovision = $_POST['aprovision'];
    //Leemos la info del pago
    $querypayment = "select * from payments where id = '$id'";
    $resultpayment = mysqli_query($con, $querypayment);
    $rowpayment = mysqli_fetch_array($resultpayment);

    //Creamos el complemento del update del pago
    $sqlu2 = ""; 
    
	$sqlu2 = ", sent_complete='0', sent_approve='0'";
    
    $queryF = "select * from filereview where payment = '$id'";
    $resultF = mysqli_query($con, $queryF);
    $numF = mysqli_num_rows($resultF);

    if($numF > 0){
	   $rowF = mysqli_fetch_array($resultF);
	   $idF = $rowF['id'];
    }
    else{
	   $query2 = "insert into filereview (payment) values ('$id')";
	   $result2 = mysqli_query($con, $query2);
	   $idF = mysqli_insert_id($con);
    } 

    $queryupdate = "update filereview set aorder='$aorder', aprovision='$aprovision' where id = '$idF'";
    $resultupdate = mysqli_query($con, $queryupdate);

    $queryupdate2 = "update payments set sent='4'".$sqlu2." where id = '$id'";
    $resultupdate2 = mysqli_query($con, $queryupdate2);

    $gcomments = "Control de calidad posterior";;
    $lstatus = $rowpayment['status'];

    $querytime = "insert into times (payment, today, now, now2, userid, stage, comment, stage2, color, reason, reason2) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '8.03', 'Control de Calidad', '$gcomments', 'red', '$reason', '$reason2')";
    $resulttime = mysqli_query($con, $querytime); 

    if($rowpayment['parent'] > 0){

	$querypaymentchilds = "select * from payments where child = '$rowpayment[id]'";
	$resultpaymentchilds = mysqli_query($con, $querypaymentchilds);
	while($rowpaymentchilds=mysqli_fetch_array($resultpaymentchilds)){
	
	
		//Creamos el complemento del update del pago
	
        $sqlu2cld = ", sent_complete='0', sent_approve='0'";
		$gcomments_conc0cld = "E";
		$gcomments_conccld = " y encontrado incompleto";
		
		$querycld = "select * from filereview where payment = '$rowpaymentchilds[id]'";
		$resultcld = mysqli_query($con, $querycld);
		$numcld = mysqli_num_rows($resultcld);

		if($numcld > 0){
			$rowcld = mysqli_fetch_array($resultcld);
			$idcld = $rowcld['id'];
		}
		else{
			$query2cld = "insert into filereview (payment) values ('$rowpaymentchilds[id]')";
			$result2cld = mysqli_query($con, $query2cld);
			$idcld = mysqli_insert_id($con);
		} 

		$queryupdatecld = "update filereview set aorder='$aorder', aprovision='$aprovision' where id = '$idcld'";
		$resultupdatecld = mysqli_query($con, $queryupdatecld);

		$queryupdate2cld = "update payments set sent='4'".$sqlu2cld." where id = '$rowpaymentchilds[id]'";
		$resultupdate2cld = mysqli_query($con, $queryupdate2cld);

		$gcommentscld = "Control de calidad posterior";
		$lstatuscld = $rowpayment['status']; 

		$querytimecld = "insert into times (payment, today, now, now2, userid, stage, comment, stage2, color, reason, reason2) values ('$rowpaymentchilds[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '8.03', 'Control de Calidad', '$gcommentscld', 'red', '$reason', '$reason2')"; 
		$resulttimecld = mysqli_query($con, $querytimecld);  
		
	}

}
    
}
else{
	echo "<script>alert('Debe de seleccionar una opcion.'); history.go(-1);</script>";
	exit();
} 
 


header("location: file-review-detail.php");   

?>