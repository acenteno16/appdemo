<?php include('session-provision.php');

$id = $_POST['id'];
$userid = $_SESSION['userid'];
$ptype = $_POST['ptype'];
$distributiontype = $_POST['distributiontype'];
$internationalno = $_POST['internationalno'];
$internationallink = $_POST['internationallink'];

//Arrays
$unit = $_POST['unit'];
if($unit[0] == ""){ ?>
<script>
alert('Ingrese el numero de Unidad.');
history.go(-1);
</script>
<?php exit();
}
$percent = $_POST['percent'];
if($percent[0] == ""){ ?>
<script>
alert('Ingrese el valor porcentaje.');
history.go(-1);
</script>
<?php exit();
}
$total = $_POST['total'];
if($total[0] == ""){ ?>
<script>
alert('Ingrese un total.');
history.go(-1);
</script>
<?php exit();
}
$accounts = $_POST['accounts'];
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

$querypayment = "select * from payments where id = '$id'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);
$preturn = $rowpayment['preturn'];

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


$queryapprove = "update payments set status = '8', distribution = '$distributiontype', ptype='$ptype', internationalno='$internationalno', internationallink='$internationallink', aprovision='$aprovision' where id = '$id'";
$resultapprove = mysqli_query($con, $queryapprove);
$gcomments = "Enhorabuena, el pago ha sido provisionado.".$aprovision2; 

//

    for($c = 0; $c < sizeof($unit); $c++){
    if(($unit[$c] != "") and ($unit[$c] != 0)){
	 $percentstr = str_replace('%','',$percent[$c]);
	 
	 $nftotal = numberFormat($total[$c]); 
	 $query1 = "insert into distribution (payment, unit, percent, total, account, preturn) values ('$id', '$unit[$c]', '$percentstr', '$nftotal', '$accounts[$c]', '$preturn')"; 
	 $result1 = mysqli_query($con, $query1);   
	 } 
    }

/*
if($distributiontype == 2){
	$template = $_POST['template'];
	$query2 = "select * from templatescontent where template = '$template'";
	$result2 = mysqli_query($con, $query2);
	while($row2=mysqli_fetch_array($result2)){
		$ctotal = $rowpayment['payment']*($row2['percent']/100);
		$query3 = "insert into distribution (payment, unit, percent, total, account, preturn) values ('$id', '$row2[unit]', '$row2[percent]', '$ctotal', '$row2[account]', '$preturn')";
		$result3 = mysqli_query($con, $query3); 
	}
}
*/

for($c = 0; $c < sizeof($nobatch); $c++){
	 $query4 = "insert batch  (payment, nobatch, linkbatch, nodocument, linkdocument, preturn) values ('$id', '$nobatch[$c]', '$linkbatch[$c]', '$nodocument[$c]', '$linkdocument[$c]', '$preturn')"; 
	 $result4 = mysqli_query($con, $query4); 
}  
	 
$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

//time stage
$querytime = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '8', '$gcomments')"; 
$resulttime = mysqli_query($con, $querytime);
 

header("location: provision.php");

function numberFormat($unformatedNumber){
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}    

?>