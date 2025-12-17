<?php 

include("session-request.php"); 

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$id = $_GET['id'];

$query = "select status, userid from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$reason = '';
$reason2 = '';

$permit = 0;
if(isset($_SESSION['admin'])){
	if($_SESSION['admin'] == "active"){ $permit = 1; }
}
if($_SESSION["userid"] == $row['userid']){
	$permit = 1; 
}

if(($row['status'] == 0) and ($permit == 1)){
	
	$querypayment = "update payments set status = '7.14', approved = '2' where id = '$id'";
	$resultpayment = mysqli_query($con, $querypayment);
	
	$gcomments = "El pago ha sido anulado en borrador.";	
	$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '7.14', '$gcomments', '$reason', '$reason2')"; 
	$resulttime = mysqli_query($con, $querytime); 
	
	header("location: ".$_SERVER['HTTP_REFERER']);
}else{
	?>
    <script>
	alert('No se ha podido anular el pago. Consulte con el administrador del sistema.');
	history.go(-1);
	</script>
    <?php }

?>