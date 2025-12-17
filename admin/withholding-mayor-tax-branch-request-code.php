<?php 
include("session-withholding.php"); 
 
$id = $_POST['theid'];
$hall = $_POST['hall'];

//LEEMOS LAS VARIABLES GLOBALES
$queryconfig = "select * from config where id = '1'";
$resultconfig = mysqli_query($con, $queryconfig);
$rowconfig = mysqli_fetch_array($resultconfig); 

if(sizeof($id)>0){
	
	$today = date("Y-m-d");
	$now = date('Y-m-d H:i:s');
	$now2 = date('H:i:s'); 
	
	//INSERTAMOS EL GRUPO DE CANCELACION
	$query = "insert into mayor (userid, today, now, now2, hall) values ('$_SESSION[userid]', '$today', '$now', '$now2', '$hall')";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	//ID DEL GRUPO DE CANCELACION
	$mayorid = mysqli_insert_id();
	
	$gcomments = "Enhorabuena, se ha creado la solicitud de pago Alcald\u00eda para el conjunto de retenciones no.".$mayorid; 
	//CONSTULTA TIMES
	$query2 = "insert into mayortimes (package, today, now, now2, userid, stage, comment) values ('$mayorid', '$today', '$now', '$now2', '$_SESSION[userid]', '2', '$gcomments')";
	$result2 = mysqli_query($con, $query2);
//CICLO DE SOLOCOTUDES INCLUIDAS	

for($c=0;$c<sizeof($id);$c++){
	
	//INFORMACION DEL PAGO
	$queryp = "select * from payments where id = '$id[$c]'";
	$resultp = mysqli_query($con, $queryp);
	$rowp = mysqli_fetch_array($resultp);
	
	//
	$rammount = $rowp['ret1a'];
	$calculatedAmmount += $rammount;
	
	
	$query3 = "insert into mayorcontent (package, payment) values ('$mayorid', '$id[$c]')";
	$result3 = mysqli_query($con, $query3);
	$ids3[] = mysqli_insert_id();
	
	$query4 = "update payments set mayorstage='2' where id = '$id[$c]'"; 
	$result4 = mysqli_query($con, $query4); 
	
} 

$includedpayments = implode(", ", $id);
$user = $_SESSION['userid'];

$provider = $rowconfig['imiprovider'];

$type = $rowconfig['imitype'];
$concept = $rowconfig['imiconcept'];
$concept2 = $rowconfig['imiconcept2'];

//Esto saldrá de la tabla de alcaldías (Halls)
$queryhall = "select * from halls where id = '$hall'";
$resulthall = mysqli_query($con, $queryhall);
$rowhall = mysqli_fetch_array($resulthall);

$route = $rowhall['route'];
$headship = $rowhall['headship'];

$description = "Pago de retenciones IMI solicitado el ".$today.". Solicitudes de pagos incluidas: ".$includedpayments;
$bill = ""; 

$bill = ""; 

//Calculate ammount
$stotal = $calculatedAmmount;
$ammount = $calculatedAmmount;
$payment = $calculatedAmmount;  
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
$query1 = "insert into payments (today) values ('$today')";
$result1 = mysqli_query($con, $query1);
$id1 = mysqli_insert_id(); 

$query2 = "update payments set today='$today', btype='1', provider='$provider', description='$description', ammount='$ammount', currency='1', ret1='0', ret1a='0', ret2='0', ret2a='0', payment='$payment', userid='$_SESSION[userid]', route='$route', headship='$headship', status = '2', approved='1', arequest='1', expiration='$expiration' where id = '$id1'";    
$result2 = mysqli_query($con, $query2); 

$query1b = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id1', '$today', '$now', '$now2', '$_SESSION[userid]', '1', 'Pago Ingresado')";
$result1b = mysqli_query($con, $query1b);

$querybill = "insert into bills (payment, number, ammount, letters, stotal, stotal2, tax, intur, inturammount, exempt, type, concept, concept2, billdate, billdate2, ret1, ret1a, ret2, ret2a, currency, tc, nioammount, niostotal, niotax, niointur, niobillpayment) values ('$id1', '$mayorid', '$ammount', '$letters', '0', '$ammount', '0', '0', '0', '0', '$type', '$concept', '$concept2', '$today', '$today', '0', '0', '0', '0', '1', '0', '$ammount', '$ammount', '0', '0', '$ammount')";
$resultbill = mysqli_query($con, $querybill);  

for($d=0;$d<sizeof($ids3);$d++){
	$queryd = "update mayorcontent set payment2='$id1' where id = '$ids3[$d]'";
	$resultd = mysqli_query($con, $queryd); 
}

?>
<script> 
alert('El pago de las retenciones Alcald\u00eda se ha solicitado con \u00e9xito. Usted ser\u00e1 notificado cuando el pago est\u00e9 aceptado.');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script>
<?php }else{ ?>
<script>
alert('Debe de seleccionar al menos un pago.');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>"; 
</script>
<?php } ?> 