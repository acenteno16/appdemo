<?php 

include("session-releasing-special.php"); 
include('functionTax.php');
require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$id = $_POST['id'];
$release = $_POST['release'];
$reason = $_POST['reason'];
$reason2 = $_POST['reason2'];
$notes = $_POST['notes'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$querypayment = "select * from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);

if($release == 1){
	
	//Get the last transaction User
	$querylasttime = "select * from times where payment = '$id' and stage = '8.00' order by id desc limit 1";
	$resultlasttime = mysqli_query($con, $querylasttime);
	$rowlasttime = mysqli_fetch_array($resultlasttime);
		
	//Cancel action if is the same user
	if(($rowlasttime['userid'] == $_SESSION['userid'])){  
	?>
	<script>
    alert('No se puede realizar la liberacion debido a que usted ha realizado la provision.');
	history.location(-1);
    </script>
	<?php exit(); 
	}

    $queryapprove = "update payments set status = '9' where id = '$id'";
    $resultapprove = mysqli_query($con, $queryapprove);
    $gcomments = "Enhorabuena, el pago ha sido Liberado (Especial).";

    //time stage
    $querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '9.02', '$gcomments')";
    $resulttime = mysqli_query($con, $querytime);

    if($rowpayment['parent'] > 0){
	   $querypaymentchilds = "select * from payments where child = '$id'";
	   $resultpaymentchilds = mysqli_query($con, $querypaymentchilds);
	   while($rowpaymentchilds=mysqli_fetch_array($resultpaymentchilds)){
	
		  $queryapprovecld = "update payments set status = '9', releasingnotes='$notes' where id = '$rowpaymentchilds[id]'";
		  $resultapprovecld = mysqli_query($con, $queryapprovecld);
		  $gcommentscld = "Enhorabuena, el pago ha sido Liberado (Especial)."; 

		  //time stage
		  $querytimecld = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$rowpaymentchilds[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '9.02', '$gcomments')"; 
		  $resulttimecld = mysqli_query($con, $querytimecld);
	
	   }
    } 
 
    if(($rowpayment['immediate'] == 1)){
		include('function-getnext.php');
		getNext($id,'9'); 
    }

}
if($release == 2){

$querylasttime = "select * from times where stage >= '2' and stage <= '4' and payment = '$id' order by stage desc";
$resultlasttime = mysqli_query($con, $querylasttime);
$rowlasttime=mysqli_fetch_array($resultlasttime);

$laststatus = $rowlasttime['stage'];

$queryapprove = "update payments set status = '$laststatus', preturn = preturn + 1 where id = '$id'";
$resultapprove = mysqli_query($con, $queryapprove);	
if(!$resultapprove){
	?>
 <script>
 alert('No se pudo');
 </script>   
    <?php }
taxCredit($id,2,$con);	
$gcomments = "El pago ha sido regresado a provisiÃ³n.";

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '11', '$gcomments', '$reason')"; 
$resulttime = mysqli_query($con, $querytime);

if($rowpayment['parent'] > 0){
	$querypaymentchilds = "select * from payments where child = '$id'";
	$resultpaymentchilds = mysqli_query($con, $querypaymentchilds);
	while($rowpaymentchilds=mysqli_fetch_array($resultpaymentchilds)){
	
		$queryapprove = "update payments set status = '$laststatus', preturn = preturn + 1 where id = '$rowpaymentchilds[id]'";
		$resultapprove = mysqli_query($con, $queryapprove);
		
		$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$rowpaymentchilds[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '11', '$gcomments', '$reason')"; 
		$resulttime = mysqli_query($con, $querytime);
	
	
	}
	
}

//Enviar notificación y correo al provisionador.
include('fn-provision.php');
fnProvision($id,$_SESSION['userid']);  

}
if($release == 3){

$queryapprove = "update payments set approved='2', status = '7.02', reason='$reason2' where id = '$id'";
$resultapprove = mysqli_query($con, $queryapprove);
if(!$resultapprove){
	?>
 <script>
 alert('No se pudo rechazar el pago');
 </script>   
    <?php }
taxCredit($id,2,$con);	
$gcomments = "Rechazado en LiberaciÃ³n.";

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '7.02', '$gcomments', '$reason', '$reason2')"; 
$resulttime = mysqli_query($con, $querytime);

if($rowpayment['parent'] > 0){
	$querypaymentchilds = "select * from payments where child = '$id'";
	$resultpaymentchilds = mysqli_query($con, $querypaymentchilds);
	while($rowpaymentchilds=mysqli_fetch_array($resultpaymentchilds)){
		
		$queryapprove = "update payments set approved='2', status = '7.02', reason='$reason2' where id = '$rowpaymentchilds[id]'";
		$resultapprove = mysqli_query($con, $queryapprove);
		
		//time stage
		$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason, reason2) values ('$rowpaymentchilds[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '7.02', '$gcomments', '$reason', '$reason2')"; 
		$resulttime = mysqli_query($con, $querytime);

	}
	
}


//Enviar notificación y correo al provisionador.
include('fn-rejection.php');
fnReject($id,$_SESSION['userid']); 

}
if($release == 4){

$querylasttime = "select * from times where stage >= '2' and stage <= '4' and payment = '$id' order by stage desc";
$resultlasttime = mysqli_query($con, $querylasttime);
$rowlasttime=mysqli_fetch_array($resultlasttime);

$laststatus = $rowlasttime['stage'];

$queryapprove = "update payments set status = '$laststatus', credit = '1', preturn = preturn + 1 where id = '$id'";
$resultapprove = mysqli_query($con, $queryapprove);
if(!$resultapprove){
	?>
 <script>
 alert('No se pudo');
 </script>   
    <?php }
$gcomments = "El pago ha sido regresado a loquidaciÃ³n.";

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '11.10', '$gcomments', '$reason')"; 
$resulttime = mysqli_query($con, $querytime);

if($rowpayment['parent'] > 0){
	$querypaymentchilds = "select * from payments where child = '$id'";
	$resultpaymentchilds = mysqli_query($con, $querypaymentchilds);
	while($rowpaymentchilds=mysqli_fetch_array($resultpaymentchilds)){
	
		$queryapprove = "update payments set status = '$laststatus', preturn = preturn + 1 where id = '$rowpaymentchilds[id]'";
		$resultapprove = mysqli_query($con, $queryapprove);
		
		$querytime = "insert into times (payment, today, now, now2, userid, stage, comment, reason) values ('$rowpaymentchilds[id]', '$today', '$now', '$now2', '$_SESSION[userid]', '11', '$gcomments', '$reason')"; 
		$resulttime = mysqli_query($con, $querytime);
	
	
	}
	
}

//Enviar notificación y correo al provisionador.
include('fn-provision.php');
fnProvision($id,$_SESSION['userid']);  


}

header("location: ".$_SERVER['HTTP_REFERER']);

?>