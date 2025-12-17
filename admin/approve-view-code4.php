<?php 
/*
include('session-approve.php');

//Get vars
$userid = $_SESSION['userid'];
$id = $_GET['id'];
$approve = $_GET['approve'];
$comments = $_GET['reason'];
$reason = $_GET['reason2'];
$atype = $_GET['atype'];

//El pago debe de tener aprobado o reprobado
if($approve == 0){
	exit("<script>alert('Debe de seleccionar una opcion de aprobado.')</script>");
}

//For para aprobar varios pagos (Array de pagos)
for($c=0;$c<sizeof($id);$c++){ 


//Seleccionamos el pago
$querypayment = "select * from payments where id = '$id[$c]'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);
//Leemos el estado del pago
$status = $rowpayment['status']; 
$gcomments2 = 0;

//if(($status != '5') or ($status != '6') or ($status != '7') or ($status != '7.01') or ($status != '7.02') or ($status != '7.03') or ($status != '7.04') or ($status != '7.05') or ($rowpayment['approved'] != '1')){ 

//Si el pago no es aprobado
//Reprobar pago
if($approve[$c] == 2){ 
		
	switch($status){
	case 1:
	$newstatustime = 5;
	break;
	case 2:
	$newstatustime = 6;
	break;
	case 3:
	$newstatustime = 7;
	break;
} 
	$query = "update payments set status = '$newstatustime', reason='$reason', approved='$approve' where id = '$id[$c]'";
    $result = mysqli_query($con, $query);
	$gcomments = $comments;	

} 
//Si el pago es aprobado
else{

	
switch($atype){
	case 1:
	$usertype = 2;
	break;
	case 2:
	$usertype = 3;
	break;
	case 3:
	$usertype = 4;
	break;
}

$newstatustime = $status+1; 

//Seleccionamos la ruta especifica del trabajador que inicio session
//Ruta maxima del trabajador
$queryroute = "select * from routes where worker = '$_SESSION[userid]' and type = '$usertype' and unit = '$rowpayment[route]' and headship = '$rowpayment[headship]' order by type desc limit 1"; //here we add the headship 
$queryroute = "select * from routes where worker = '$_SESSION[userid]' and type >= '2' and type <= '4' and unit = '$rowpayment[route]' and headship = '$rowpayment[headship]' order by type desc limit 1"; //here we add the headship 
$resultroute = mysqli_query($con, $queryroute);
$rowroute = mysqli_fetch_array($resultroute); 
 
$routetype = $rowroute['type'];

//maxroute here
$queryroute2 = "select * from routes where unit = '$rowpayment[route]' and type >= '2' and type <= '4' and headship = '$rowpayment[headship]'"; 
$resultroute2 = mysqli_query($con, $queryroute2);
while($rowroute2 = mysqli_fetch_array($resultroute2)){
	if($rowroute2['type'] > $maxroutetype){
		$maxroutetype = $rowroute2['type'];
	}
}

switch($rowpayment['currency']){
	case 1:
	//NIO
	$today = date("Y-m-d"); 
	echo $querytc = "select * from tc where today = '$today'";
	$resulttc = mysqli_query($con, $querytc);
	$rowtc = mysqli_fetch_array($resulttc);
	$todaytc = $rowtc['tc'];  
	if($todaytc > 0){
	$ammount = $rowroute['ammount2']*$todaytc;
	}
	break;
	case 2:
	//USD
	$ammount = $rowroute['ammount2'];
	break;
	case 3:
	//EUR
	$ammount = $rowroute['ammount3'];
	break;
	case 4:
	//YEN
	$ammount = $rowroute['ammount4'];
	break; 
}


$paymentammount = $rowpayment['ammount']; 

//Si el monto de la ruta es mayor que el monto a pagar, aprobamos el pago.
if($ammount >= $paymentammount){
	$queryapprove = "update payments set status = '$newstatustime', approved = '1' where id = '$id[$c]'";
	$resultapprove = mysqli_query($con, $queryapprove);
	$gcomments = "Enhorabuena, el pago ha sido aprobado.";

}else{

if($maxroutetype == $routetype){
 	$queryapprove = "update payments set status = '$newstatustime', approved = '1' where id = '$id[$c]'";
	$resultapprove = mysqli_query($con, $queryapprove);
	$gcomments = "Enhorabuena, el pago ha sido aprobado.";

}else{
	
	$queryapprove = "update payments set status = '$newstatustime' where id = '$id[$c]'";
	$resultapprove = mysqli_query($con, $queryapprove);
	$gcomments = "Esperando la siguiente aprobaci&oacute;n.";
}		
}
}

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id[$c]', '$today', '$now', '$now2', '$_SESSION[userid]', '$newstatustime', '$gcomments')"; 
$resulttime = mysqli_query($con, $querytime); 

//Retentions
if($rowpayment['provider'] == 993){
	$querymayor = "update payments set mayorstage = '2' where id = '$id[$c]'";
	$resultmayor = mysqli_query($con, $querymayor);
}
if($rowpayment['provider'] == 994){
	$queryir = "update payments set irstage = '2' where id = '$id[$c]'";
	$resultir = mysqli_query($con, $queryir); 
}

//End stage
//}

}

header("location: approve.php");  
*/
?>