<?php 

include("session-review.php");

$payment = $_POST['payment'];
$okay = 1;
$pCancel = $_POST['pcancel'];
$stage2str = 'Control de Calidad';
if($pCancel == 1){
    $stage2str = 'Control de Calidad posterior';
}
$aorder = $_POST['aorder'];
if($aorder != 1){
	$okay = 0;
}

$aprovision = $_POST['aprovision'];
if($aorder != 1){
	$okay = 0;  
}


//Leemos la info del pago
$querypayment = "select * from payments where id = '$payment'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);

//Creamos el complemento del update del pago
$sqlu2 = ""; 
if($okay == 0){
	$sqlu2 = ", sent_complete='0', sent_approve='0'";
	$gcomments_conc0 = "E";
	$gcomments_conc = " y encontrado incompleto";
}
if($okay == 1){
	$sqlu2 = ", sent_complete='1', sent_approve='1'";
	$gcomments_conc0 = "Enhorabuena, e";
	$gcomments_conc = ", encontrado completo y aprobado";
}

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$query = "select * from filereview where payment = '$payment'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

if($num > 0){
	$row = mysqli_fetch_array($result);
	$id = $row['id'];
}
else{
	$query2 = "insert into filereview (payment) values ('$payment')";
	$result2 = mysqli_query($con, $query2);
	$id = mysqli_insert_id($con);
} 

$queryupdate = "update filereview set aorder='$aorder', aprovision='$aprovision' where id = '$id'";
$resultupdate = mysqli_query($con, $queryupdate);

$queryupdate2 = "update payments set sent='4'".$sqlu2." where id = '$payment'";
$resultupdate2 = mysqli_query($con, $queryupdate2);

$gcomments = $gcomments_conc0."l paquete ha sido revisado".$gcomments_conc.".";
$lstatus = $rowpayment['status'];

$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, stage2, color) values ('$payment', '$today', '$now', '$now2', '$_SESSION[userid]', '8.03', 'Control de Calidad', '$stage2str', 'green')";
$resulttime = mysqli_query($con, $querytime);

if($rowpayment['parent'] > 0){

	$querypaymentchilds = "select * from payments where child = '$rowpayment[id]'";
	$resultpaymentchilds = mysqli_query($con, $querypaymentchilds);
	while($rowpaymentchilds=mysqli_fetch_array($resultpaymentchilds)){
	
	
		//Creamos el complemento del update del pago
		$sqlu2cld = ""; 
		if($okaycld == 0){
			$sqlu2cld = ", sent_complete='0', sent_approve='0'";
			$gcomments_conc0cld = "E";
			$gcomments_conccld = " y encontrado incompleto";
		}
		if($okaycld == 1){
			$sqlu2cld = ", sent_complete='1', sent_approve='1'";
			$gcomments_conc0cld = "Enhorabuena, e";
			$gcomments_conccld = ", encontrado completo y aprobado";
		} 

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

		$gcommentscld = $gcomments_conc0cld."l paquete ha sido revisado".$gcomments_conccld.".";
		$lstatuscld = $rowpayment['status'];

		$querytimecld = "insert into times (payment, today, now, now2, userid, stage, comment, stage2, color) values ('$rowpaymentchilds[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '8.03', 'Control de Calidad', '$stage2str', 'green')";
		$resulttimecld = mysqli_query($con, $querytimecld);  
		
	}

}

header('location: file-review-detail.php');

?>