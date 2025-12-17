<?php include("session-withholding.php"); 

//LEEMOS LAS VARIABLES GLOBALES
$queryconfig = "select * from config where id = '1'";
$resultconfig = mysqli_query($con, $queryconfig);
$rowconfig = mysqli_fetch_array($resultconfig);
 
$id = $_POST['theid'];

//Condicional de si existe al menos un pago en el grupo de cancelación
if(sizeof($id)>0){
	
	$today = date("Y-m-d");
	$now = date('Y-m-d H:i:s');
	$now2 = date('H:i:s');
	$gcomments = "Enhorabuena, se ha creado la solicitud de pago para el conjunto de retenciones no.".$irid; 
	
	//GRUPO DE CANCELACION
	//insertamos en la tabla de los grupos de cancelacion el usuario y fecha de creacion del grupo de cancelacion
	$query = "insert into ir (userid, today, now, now2) values ('$_SESSION[userid]', '$today', '$now', '$now2')";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	//Numero de grupo de cancelación
	$irid = mysqli_insert_id($con);
	
	//TIME GRUPO DE CANCELACION
	//insertamos el registro de la operacion
	//el stage es 1 y esta vinclulado con el estado de la solicitud
	//donde 1. solicitado 2. cancelado
	$query2 = "insert into irtimes (package, today, now, now2, userid, stage, comment) values ('$irid', '$today', '$now', '$now2', '$_SESSION[userid]', '1', '$gcomments')"; 
	$result2 = mysqli_query($con, $query2);

//For de pagos incluidos en el grupo de cancelacion	
for($c=0;$c<sizeof($id);$c++){
	
	//Leemos la informacion del pago especifico
	$queryp = "select * from payments where id = '$id[$c]'";
	$resultp = mysqli_query($con, $queryp);
	$rowp = mysqli_fetch_array($resultp);
	
	$rammount = $rowp['ret2a'];
	$calculatedAmmount += $rammount;
	
	$query3 = "insert into ircontent (package, payment) values ('$irid', '$id[$c]')";
	$result3 = mysqli_query($con, $query3);
	$ids3[] = mysqli_insert_id($con);
	
	//El irstage esta vinculado con la tabla irstage
	//donde 1. generado 2. solicitado 3.Cancelado
	$query4 = "update payments set irstage='2' where id = '$id[$c]'";
	$result4 = mysqli_query($con, $query4);
	 
	
} 

//CON EL IMPLODE HACEMOS LA CADENA CONTENEDORA DE LAS SOLICITUDES DE PAGO INCLUIDAS
$includedpayments = implode(", ", $id);
$user = $_SESSION['userid'];
$provider = $rowconfig['irprovider'];
$type = $rowconfig['irtype'];
$concept = $rowconfig['irconcept'];
$concept2 = $rowconfig['irconcept2'];
$route = $rowconfig['route2'];
$headship = $rowconfig['headship2'];
$description = "Pago de retenciones IR solicitado el ".$today.". Solicitudes de pagos incluidas: ".$includedpayments;
$bill = ""; 

//Calculate ammount
$ammount = $calculatedAmmount;
$mreturn = 1;
include('reload-numberstoletters.php');  
$tax = 0;
$exempt = 1;
$currency = 1;
$ret1 = 0;
$ret1a = 0;
$ret2 = 0;
$ret2a = 0;
$expiration = date('Y-m-d',strtotime('+1 day',strtotime($today)));
//Calculate
$payment = $calculatedAmmount;   

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$expiration = date('Y-m-d',strtotime('+1 days', strtotime($today)));

//Aqui insertamos el pago solo para agarrrar el id y actualizarlo  en el siguiente query
$query1 = "insert into payments (today) values ('$today')";
$result1 = mysqli_query($con, $query1);
$id1 = mysqli_insert_id();

$query2 = "update payments set today='$today', btype='1', provider='$provider', description='$description', ammount='$ammount', currency='1', ret1='0', ret1a='0', ret2='0', ret2a='0', payment='$payment', userid='$_SESSION[userid]', route='$route', headship='$headship', status = '1', arequest='1', expiration='$expiration', retroute='1' where id = '$id1'";   
$result2 = mysqli_query($con, $query2); 

$query1b = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id1', '$today', '$now', '$now2', '$_SESSION[userid]', '1', 'Pago Ingresado')";
$result1b = mysqli_query($con, $query1b);  

//metemos la factura que incluye los montos
$querybill = "insert into bills (payment, number, ammount, letters, stotal, stotal2, tax, intur, inturammount, exempt, type, concept, concept2, billdate, billdate2, ret1, ret1a, ret2, ret2a, currency, tc, nioammount, niostotal, niotax, niointur, niobillpayment) values ('$id1', '$irid', '$ammount', '$letters', '0', '$ammount', '0', '0', '0', '0', '$type', '$concept', '$concept2', '$today', '$today', '0', '0', '0', '0', '1', '0', '$ammount', '$ammount', '0', '0', '$ammount')";
$resultbill = mysqli_query($con, $querybill);   

//$ids3 es el array que guards todos los pagos que estamos procesando
//Lo que hacemos en este for es que a cada pago le decimos el id de la solicitud para cancelar la retencion.

for($d=0;$d<sizeof($ids3);$d++){
	$queryd = "update ircontent set payment2='$id1' where id = '$ids3[$d]'";
	$resultd = mysqli_query($con, $queryd);  
}

?>
<script>
alert('El pago de las retenciones IR se ha solicitado con \u00e9xito. Usted ser\u00e1 notificado cuando el pago este aceptado.');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script>
<?php }else{ ?>
<script>
alert('Debe de seleccionar al menos un pago.');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script>
<?php } ?>