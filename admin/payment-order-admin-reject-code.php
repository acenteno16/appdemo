<? 

include("session-admin.php");

require '../assets/PHPMailer/PHPMailerAutoload.php'; 
include('fn-rejection.php');

$id = $_POST['id'];

$today = date('Y-m-d');
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s'); 
$reason = $_POST['reason']; 

if($reason == ""){
	echo "<script>alert('Favor indicar motivo de rechazo.');history.go(-1);</script>";
	exit();
}

//Reprobar pago
$queryreject = "update payments set status = '7.12', approved='2' where id = '$id'";
$resultreject = mysqli_query($con, $queryreject); 

$gcomments = "La solicitud ha sido rechazada por Administrador.";	
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '7.12', '$gcomments', '$reason', '$reason2')"; 
$resulttime = mysqli_query($con, $querytime); 
				
fnReject($id,$_SESSION['userid']); 

header('location: payment-management.php'); 

?>