<?php 

include("session-schedule.php");
require '../assets/PHPMailer/PHPMailerAutoload.php';  

$id = intval($_POST['id']);

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$userid = $_SESSION['userid'];
$schedule = $_POST['schedule'];

$reason = $_POST['reason'];
$reason2 = $_POST['reason2'];

if($schedule == 0){ ?>
	
    <script>
	alert('Debe de seleccionar una opcion.');
	history.go(-1);
	</script>
    
<?php }

elseif($schedule == 1){
	
	$querylasttime = "select * from times where stage >= '2' and stage <= '4' and payment = '$id' order by stage desc";
	$resultlasttime = mysqli_query($con, $querylasttime);
	$rowlasttime=mysqli_fetch_array($resultlasttime);

	$laststatus = $rowlasttime['stage'];

	$queryapprove = "update payments set status = '$laststatus', preturn = preturn + 1 where id = '$id'";
	$resultapprove = mysqli_query($con, $queryapprove);
	
	$gcomments = "El pago ha sido regresado a provisiÃ³n.";

	//time stage
	$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '11.01', '$gcomments', '$reason')"; 
	$resulttime = mysqli_query($con, $querytime);  

	//Enviar notificación y correo al provisionador.
	include('fn-provision.php');
	fnProvision($id,$_SESSION['userid']);  
	
}

elseif($schedule == 2){
	
	$query = "update payments set approved='2', status='7.03', reason='$reason2' where id = '$id'";
	$result = mysqli_query($con, $query);
	$gcomments = "Rechazado en Programación.";

	//time stage
	$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '7.03', '$gcomments', '$reason')";  
	$resulttime = mysqli_query($con, $querytime); 

	include('fn-rejection.php');
	fnReject($id,$_SESSION['userid']);  
	
}

header("location: payment-schedule.php");  

?>