<script>
alert('En prueba!');
history.go(-1); 
</script>
<?php 
exit();


include('session-provision.php');
require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$id = $_POST['id'];
$userid = $_SESSION['userid'];
$ptype = $_POST['ptype'];
$distributiontype = $_POST['distributiontype'];
$internationalno = $_POST['internationalno'];
$internationallink = $_POST['internationallink'];
$hall = $_POST['hall'];

$querypayment = "select * from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);
$preturn = $rowpayment['preturn'];

if(($hall == 0) and (($rowpayment['ret1a'] > 0))){
?>
<script>
alert('Seleccionar la Sucursal.');
history.go(-1);
</script>
<?php exit();
}
//Arrays
/*
$nobatch = $_POST['nobatch'];
if($nobatch[0] == ""){ ?>
<script>
alert('Ingrese el numero de batch.');
history.go(-1);
</script>
<?php exit();
}
$linkbatch = $_POST['linkbatch'];
$nodocument = $_POST['nodocument'];
if($nodocument[0] == ""){ ?>
<script>
alert('Ingrese el numero de documento.');
history.go(-1);
</script>
<?php exit();
}
$linkdocument = $_POST['linkdocument'];
if($linkdocument[0] == ""){ ?>
<script>
alert('Ingrese el link del documento.');
history.go(-1);
</script>
<?php exit(); 
}
//End Arrays
*/

$adch = $_POST['adch'];

//Aqui revisamos si la ruta tiene aprobador de provisión
$queryroute = "select * from routes where unit = '$rowpayment[route]' and headship = '$rowpayment[headship]' and type = '19'";
$resultroute = mysqli_query($con, $queryroute);
$numroute = mysqli_num_rows($resultroute);

$aprovision = 1;
$aprovision2 = "";

if($numroute > 0){
	$aprovision = 0; 
	$aprovision2 = " En espera de aprobado de provision";
}

$queryapprove = "update payments set status = '8', distribution = '$distributiontype', ptype='$ptype', internationalno='$internationalno', internationallink='$internationallink', aprovision='$aprovision', adch='$adch', hall='$hall' where id = '$id'";
//$resultapprove = mysqli_query($con, $queryapprove);
$gcomments = "Enhorabuena, el pago ha sido provisionado.".$aprovision2; 


$querydocuments = "select * from bills where payment = '$id'";
$resultdocuments = mysqli_query($con, $querydocuments);
while($rowdocuments =mysqli_fetch_array($resultdocuments)){
	//VARS
	
	//${'nobatch_' . $rowdocuments['id']} = $_POST['nobatch_'.$rowdocuments['id']];
	$nobatch = $_POST['nobatch_'.$rowdocuments['id']];
	$nodocument = $_POST['nodocument_'.$rowdocuments['id']]; 
	$linkdocument = $_POST['linkdocument_'.$rowdocuments['id']];
	
	for($c=0;$c<sizeof($nobatch);$c++){
		echo '<br>'.$query4 = "insert batch (payment, bill, nobatch, linkbatch, nodocument, linkdocument, preturn) values ('$id', '$rowdocuments[id]', $nobatch[$c]', '$linkbatch[$c]', '$nodocument[$c]', '$linkdocument[$c]', '$preturn')"; 
	 	//$result4 = mysqli_query($con, $query4); 
	}  
	
}

 
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '8', '$gcomments')"; 
//$resulttime = mysqli_query($con, $querytime);

	if(($rowpayment['immediate'] == 1)){
		include('function-getnext.php');
		getNext($id,'8'); 
	}

//header("location: provision.php");

function numberFormat($unformatedNumber){
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}    

?>