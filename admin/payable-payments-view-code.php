<?php include("session-releasing.php"); 

$id = $_POST['id'];
$number = $_POST['cnumber'];
$link = $_POST['clink'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$queryapprove = "update payments set status = '14', cnumber = '$number', clink='$link' where id = '$id'"; 
$resultapprove = mysqli_query($con, $queryapprove);
$gcomments = "Enhorabuena, el pago ha sido cancelado.";

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '14', '$gcomments')"; 
$resulttime = mysqli_query($con, $querytime);

//Withholding
$querypayment = "select * from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);

if($rowpayment['provider'] == 993){
	$querymayor = "select * from mayorcontent where payment2 = '$id'";
	$resultmayor = mysqli_query($con, $querymayor);
	while($rowmayor=mysqli_fetch_array($resultmayor)){
		$querymayor2 = "update payments set mayorstage = '3' where id = '$rowmayor[payment]'";
		$resultmayor2 = mysqli_query($con, $querymayor2);
	} 
}
if($rowpayment['provider'] == 994){ 
	
	$queryir = "select * from ircontent where payment2 = '$id'";
	$resultir = mysqli_query($con, $queryir);
	while($rowir=mysqli_fetch_array($resultir)){
		$queryir2 = "update payments set irstage = '3' where id = '$rowir[payment]'"; 
		$resultir2 = mysqli_query($con, $queryir2);
	} 
} 

header("location: payable-payments.php"); 

?>