<? 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("session-request.php");

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$id = $_GET['id'];

$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

if($num == 0){
	echo "<script>alert('No se encontro el IDS.'); history.go(-1);</script>";
	exit();
}

if($row['userid'] != $_SESSION['userid']){
	echo "<script>alert('El pago se encuentra bajo otro solicitante.'); history.go(-1);</script>";
	exit();
}

if($row['status'] != 1){
	echo "<script>alert('El pago se encuentra en una etapa avanzada.'); history.go(-1);</script>";
	exit();
}


/*if($row['arequest'] != 0){
	echo "<script>alert('El pago se encuentra en una etapa avanzada.'); history.go(-1);</script>";
	exit();
}*/

$query_update = "update payments set status = '0' where id = '$id'";
$result_update = mysqli_query($con, $query_update);

$reason = "";
$reason2 = "";
$gcomments = "Regresado a Borrador.";

$query_times = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '0.04', '$gcomments', '$reason', '$reason2')";
$result_times = mysqli_query($con, $query_times);

if($row['hc'] == 1){
	header("location: payments-hc.php");
}else{
	header("location: payments.php");
}


?>