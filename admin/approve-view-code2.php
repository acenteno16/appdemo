<?php /*include('session-approve.php');

//Get vars
$userid = $_SESSION['userid'];
$id = $_GET['id'];
$approve = $_GET['approve'];
$comments = $_GET['reason'];
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
/*$newstatus = $status+1; //newstatus = 2
;*/

/*/*
$gcomments2 = 0;

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
	$query = "update payments set status = '$newstatustime', approved='$approve' where id = '$id[$c]'";
    $result = mysqli_query($con, $query);
	$gcomments = $comments;	

} 
//Si el pao es aprobado
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

//leemos la unidad de negocio del usuario
/*$queryunit = "select * from units where code = '$_SESSION[unit]'";
$resultunit = mysqli_query($con, $queryunit);
$rowunit = mysqli_fetch_array($resultunit);*/

/*/*

$queryunit = "select units.code from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code where payments.id = '$id[$c]'";
$resultunit = mysqli_query($con, $queryunit);
$rowunit = mysqli_fetch_array($resultunit);


//Seleccionamos la ruta especifica del trabajador que inicio session
$queryroute = "select * from routes where worker = '$_SESSION[userid]' and type = '$usertype' and unit = '$rowunit[0]' and headship = '$rowpayment[route]'"; //here we add the headship 
$resultroute = mysqli_query($con, $queryroute);
$rowroute = mysqli_fetch_array($resultroute);

$routetype = $rowroute['type'];
$maxroutetype = $routetype;

//maxroute here
$queryroute2 = "select * from routes where unit = '$rowunit[0]' and type >= '2' and type <= '4' and headship = '$rowpayment[route]'"; 
$resultroute2 = mysqli_query($con, $queryroute2);
while($rowroute2 = mysqli_fetch_array($resultroute2)){
	if($rowroute2['type'] > $maxroutetype){
		$maxroutetype = $rowroute2['type'];
	}
}

switch($rowpayment['currency']){
	case 1:
	$ammount = $rowroute['ammount1'];
	break;
	case 2:
	$ammount = $rowroute['ammount2'];
	break;
	case 3:
	$ammount = $rowroute['ammount3'];
	break;
	case 4:
	$ammount = $rowroute['ammount4'];
	break; 
}

//echo $ammount;

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
	//$gcomments2 = 1;
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

if($rowpayment['provider'] == 993){
	$querymayor = "update payments set mayorstage = '2' where id = '$id[$c]'";
	$resultmayor = mysqli_query($con, $querymayor);
}
if($rowpayment['provider'] == 994){
	$queryir = "update payments set irstage = '2' where id = '$id[$c]'";
	$resultir = mysqli_query($con, $queryir); 
}

/*if($gcomments2 == 1){
	$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id[$c]', '$today', '$now', '$now2', '$_SESSION[userid]', '10', 'Monto mayor a la ruta de aprobaci&oacute;n.')"; 
	$resulttime = mysqli_query($con, $querytime);  
}*/

//End for 

/*/*
}

header("location: approve.php");  
*/
?>