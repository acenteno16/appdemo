<?php

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("session-request.php");
require("functions.php");
require '../assets/PHPMailer/PHPMailerAutoload.php';  

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$querymain = $con->prepare("select * from payments where id = ?");
$querymain->bind_param("i", $id);
$querymain->execute();
$resultmain = $querymain->get_result();
$rowmain = $resultmain->fetch_assoc();

if($rowmain['status'] != 0){
	header('location: dashboard.php');
	exit();
}

$user = isset($_SESSION['userid']) ? intval($_SESSION['userid']) : null;
$theroute = explode(',',$_POST['theroute']); 
$route = isset($theroute[0]) ? sanitizeInput(intval($theroute[0]), $con) : 0;
$headship = isset($theroute[1]) ? sanitizeInput(intval($theroute[1]), $con) : 0;
$route = isset($theroute[0]) ? $theroute[0] : null;
$headship = isset($theroute[1]) ? $theroute[1] : null;
$newbutton = isset($_POST['newbutton']) ? sanitizeInput($_POST['newbutton'], $con) : null;
$notes = isset($_POST['notes']) ? sanitizeInput($_POST['notes'], $con) : null;
$dspayment = isset($_POST['dspayment']) ? floatval($_POST['dspayment']) : 0.0;

//System define
$type = isset($_POST['type']) ? sanitizeInput($_POST['type'], $con) : null;
$concept = isset($_POST['concept']) ? sanitizeInput($_POST['concept'], $con) : null;
$concept2 = isset($_POST['concept2']) ? sanitizeInput($_POST['concept2'], $con) : null;
$description = isset($_POST['description']) ? sanitizeInput($_POST['description'], $con) : null;

//Bill
$ammount = isset($_POST['ammount']) ? floatval($_POST['ammount']) : 0.0;
$totalbill = isset($_POST['totalbill']) ? floatval($_POST['totalbill']) : 0.0;
$payment = isset($_POST['totalbill']) ? floatval($_POST['totalbill']) : 0.0;
$currency = isset($_POST['currency']) ? intval($_POST['currency']) : 0;
$method = isset($_POST['method']) ? intval($_POST['method']) : 0;

//Clients
$clienttype = isset($_POST['clienttype']) ? intval($_POST['clienttype']) : 0;
$ccode = isset($_POST['ccode']) ? intval($_POST['ccode']) : 0;

$cfirst = isset($_POST['cfirst']) ? sanitizeInput($_POST['cfirst'], $con) : null;
$clast = isset($_POST['clast']) ? sanitizeInput($_POST['clast'], $con) : null;
$caddress = isset($_POST['caddress']) ? sanitizeInput($_POST['caddress'], $con) : null;
$ccity = isset($_POST['ccity']) ? sanitizeInput($_POST['ccity'], $con) : null;
$cnid = isset($_POST['cnid']) ? sanitizeInput($_POST['cnid'], $con) : null;
$cemail = isset($_POST['cemail']) ? sanitizeInput($_POST['cemail'], $con) : null;
$cphone = isset($_POST['cphone']) ? sanitizeInput($_POST['cphone'], $con) : null;

$ccode2 = isset($_POST['ccode2']) ? intval($_POST['ccode2']) : 0;
$cname = isset($_POST['cname']) ? sanitizeInput($_POST['cname'], $con) : null;
$cruc = isset($_POST['cruc']) ? sanitizeInput($_POST['cruc'], $con) : null;
$cemail2 = isset($_POST['cemail2']) ? sanitizeInput($_POST['cemail2'], $con) : null;
$cphone2 = isset($_POST['cphone2']) ? sanitizeInput($_POST['cphone2'], $con) : null;
$caddress2 = isset($_POST['caddress2']) ? sanitizeInput($_POST['caddress2'], $con) : null;
$ccity2 = isset($_POST['ccity2']) ? sanitizeInput($_POST['ccity2'], $con) : null;
$crfirst = isset($_POST['crfirst']) ? sanitizeInput($_POST['crfirst'], $con) : null;
$crlast = isset($_POST['crlast']) ? sanitizeInput($_POST['crlast'], $con) : null;
//

$crnid = cleanString($_POST['crnid']);
$cremail = cleanString($_POST['cremail']);
$crphone = cleanString($_POST['crphone']);

$credit = $_POST['credit'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

/*
if($rowmain['status'] != 0){
	echo "<script>
	alert('El ID de la solicitud ya fue creado.');
	window.location = 'payments.php';
	</script>";
	exit(); 
}*/


if(($description == "") and ($newbutton == "save")){ ?>
<script> 
alert('Usted debe de ingresar una descripcion. (CODE)');
history.go(-1);
</script>
<?php exit();
}
if(($theroute[0] == 0) and ($newbutton == "save")){ ?>
<script> 
alert('Usted debe de ingresar una ruta. (CODE)');
history.go(-1);
</script>
<?php exit();
}
if(($payment <= 0) and ($newbutton == "save")){ ?>
<script> 
alert('El monto no puede ser igual a cero. (CODE)');
history.go(-1);
</script>
<?php exit();
}

//Always UPDATE because payment has an id 
$floatammount2 = $_POST['floatammount2'];
$nftotalbill = numberFormat($totalbill);
$nfret1a= numberFormat($ret1a); 
$nfret2a= numberFormat($ret2a); 
$nfpayment=numberFormat($payment);
$nfpayment2=numberFormat($payment2);
$ammount2=numberFormat($floatammount2);

$gstotald = isset($_POST['stotalbill']) 
    ? sanitizeInput(str_replace(',', '', $_POST['stotalbill']), $con) 
    : 0;
$cut = isset($_POST['cut']) ? sanitizeInput($_POST['cut'], $con) : null;
$devtype = isset($_POST['devtype']) ? sanitizeInput($_POST['devtype'], $con) : null;

//Get the Company (Route based)
$querycompany = "select companies.id from companies inner join units on companies.code = units.companyCode where units.id = '$route'"; 
$resultcompany = mysqli_query($con, $querycompany);
$rowcompany = mysqli_fetch_array($resultcompany);
$company = $rowcompany['id'];

if($clienttype == 1){
	$client_code = $ccode;
}elseif($clienttype == 2){
	$client_code = $ccode2; 
}
$query_client = "select * from clients where code = '$client_code'";
$result_client = mysqli_query($con, $query_client);
$num_client = mysqli_num_rows($result_client);
if($num_client == 0){
	//Insert
	if($clienttype == 1){
		$query_client_insert = "insert into clients (type, code, first, last, address, city, nid, email, phone, userid) values ('$clienttype', '$ccode', '$cfirst', '$clast', '$caddress', '$ccity', '$cnid', '$cemail', '$cphone', '$_SESSION[userid]')";
	}elseif($clienttype == 2){
		$query_client_insert = "insert into clients (type, code, address, city, email, phone, name, ruc, rfirst, rlast, rnid, remail, rphone, userid) values ('$clienttype', '$ccode2', '$caddress2', '$ccity2', '$cemail2', '$cphone2', '$cname', '$cruc', '$crfirst', '$crlast', '$crnid', '$cremail', '$crphone', '$_SESSION[userid]')";
	}
	
	$result_client_insert = mysqli_query($con, $query_client_insert);
}

$query = "update payments set today='$today', btype='4', client='$client_code', description='$description', ammount='$nftotalbill', ammount2='$nftotalbill', currency='$currency', payment='$nftotalbill', paymentnio='$nfpayment2', userid='$_SESSION[userid]', routeid='$route', headship='$headship', headship2='$headship', notes='$notes', stotal='$nftotalbill', company='$company', mgmp='$currency', credit='$credit', ncatalog='1' where id = '$id'";
$result = mysqli_query($con, $query);

$roctype = $_POST['roctype'];
$rocnumber = $_POST['rocnumber'];
$roctoday = $_POST['roctoday'];

$rocamount = $_POST['rocamount'];
$roccurrency = $_POST['roccurrency'];

$query_cdocuments_delete = "delete from clientsdocuments where payment = '$id'";
$result_cdocuments_delete = mysqli_query($con, $query_cdocuments_delete);

for($r=0;$r<sizeof($roctype);$r++){
	if(($roctoday[$r] == "") or ($roctoday[$r] == "0000-00-00")){
		//Do Nothing
	}else{
		$roctoday[$r] = date('Y-m-d', strtotime($roctoday[$r]));
	}

	$query_cdocuments = "insert into clientsdocuments (payment, type, number, today, amount, currency) values ('$id', '$roctype[$r]', '$rocnumber[$r]', '$roctoday[$r]', '$rocamount[$r]', '$roccurrency[$r]')";
	$result_cdocuments = mysqli_query($con, $query_cdocuments);
}

$query_refund_delete = "delete from clientsrefund where payment = '$id'";
$result_refund_delete = mysqli_query($con, $query_refund_delete);

$devtype = $_POST['devtype'];
$cardholder = $_POST['cardholder'];
$bank = $_POST['cardbank'];
$account = $_POST['cardnumber'];
$cardexpiration = $_POST['cardexpiration'];
$rsvp = $_POST['rsvp'];
if(($rsvp == "") or ($rsvp == "0000-00-00")){
	//Do Nothing
}else{
	$rsvp = date('Y-m-d', strtotime($rsvp));
}
$model = $_POST['model'];
if($_POST['model2'] != ''){
	$model = $_POST['model2'];
}
$brand = $_POST['brand'];
if($_POST['brand2'] != ''){
	$brand = $_POST['brand2'];
}
$ncontract = $_POST['ncontract'];
$chasis = $_POST['chasis'];

$report = $_POST['report'];
$sfirst = $_POST['sfirst'];
$slast = $_POST['slast'];
$semail = $_POST['semail'];
$sphone = $_POST['sphone'];
$part_number = $_POST['part_number'];
$seller = $_POST['seller'];
$sellerphone = $_POST['sellerphone'];

$policy = $_POST['policy'];
$claim = $_POST['claim'];
$plate = $_POST['plate']; 

$bline = $_POST['bline'];  

$query_refund = "insert into clientsrefund (payment, devtype, cardholder, bank, account, expiration, rsvp, model, brand, report, seller_first, seller_last, seller_email, seller_phone, part_number, seller, policy, claim, plate, method, bline, chasis, ncontract) values ('$id', '$devtype', '$cardholder', '$bank', '$account', '$cardexpiration', '$rsvp', '$model', '$brand', '$report', '$sfirst', '$slast', '$semail', '$sellerphone', '$part_number', '$seller', '$policy', '$claim', '$plate', '$method', '$bline', '$chasis', '$ncontract')"; 
$result_refund = mysqli_query($con, $query_refund); 

//Start Billing write or Update
$ammount = $nftotalbill;
$stotal2 = $nftotalbill;
$dtype = $_POST['dtype'];

$querydeletebill = "delete from bills where payment = '$id'";
$resultdeletebill = mysqli_query($con, $querydeletebill);
$billdate = date("Y-m-d");
			
//Bills
$thebillc = $id;
$tc = '1.0000';
$nioammount = $nftotalbill;
if($currency == 2){
	$querytc = "select * from tc where today = '$billdate'";
	$resulttc = mysqli_query($con, $querytc);
	$rowtc = mysqli_fetch_array($resulttc); 
	$tc = $rowtc['tc']; 
	
	$nioammount = $nftotalbill*$tc;
}

$ammount_int = str_replace(',','',$ammount);

$enletras = toLetters($ammount_int);

//INSER BILL
switch($devtype){
		case 1:
		$concept2 = "232";
		break;
		case 2:
		$concept2 = "233";
		break;
		case 3:
		$concept2 = "234";
		break;
		case 4:
		$concept2 = "235";
		break;
		case 5:
		$concept2 = "236";
		break;
}

$query_bill = "insert into bills (payment, number, ammount, stotal2, type, concept, concept2, billdate, billdate2, currency, tc, nioammount, niobillpayment, cut, dtype, letters) values ('$id', '$thebillc', '$ammount', '$ammount', '3', '231', '$concept2', '$today', '$today', '$currency', '$tc', '$nioammount', '$nioammount', '$billcut', '2', '$enletras')"; 
$result_bill = mysqli_query($con, $query_bill);
	
//start expiration
$fecha = date('Y-m-d'); 
$nuevafecha = strtotime ( '+3 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$expiration = $nuevafecha; 

$queryexp = "update payments set expiration='$expiration' where id = '$id'";
$resultexp = mysqli_query($con, $queryexp);  
//End expiration

//Files
$fileid = $_POST['fileid'];
$file = $_POST['file'];
$querydeletef = "update files set deletefile = 1 where payment = '$id'";
$resultdeletef=mysqli_query($con, $querydeletef);
for($c=0;$c<sizeof($fileid);$c++) {
 
	//si el archivo no existe
	//echo $c.'-'.$file[$c].' <br>';
	if($file[$c] != ""){
		
		if($fileid[$c] == 0){
			$query32 = "insert into files (payment, link, deletefile) values ('$id', '$file[$c]', '0')";
		}else{
			$query32 = "update files set link='$file[$c]', deletefile='0' where id = '$fileid[$c]'";
		}
		$result32 = mysqli_query($con, $query32); 
	}
	
}
$querydeletef2 = "delete from files where payment = '$id' and deletefile = '1'";
$resultdeletef2=mysqli_query($con, $querydeletef2);

//Draft
if($newbutton == "draft"){
	header("location: payments.php");
}


//Save payment

if($newbutton == "save"){
	
	//Fiscal Cut
	$queryglobals = "select * from globals";
	$resultglobals =mysqli_query($con, $queryglobals);
	$rowglobals = mysqli_fetch_array($resultglobals);
	
	//Aqui revisamos si la ruta tiene aprobador de solicitud
	$queryroute = "select * from routes where unitid = '$route' and headship = '$headship' and type = '20'";
	$resultroute = mysqli_query($con, $queryroute); 
	$numroute = mysqli_num_rows($resultroute);

	$arequest = 1;
	$arequest2 = "";

	if(($numroute > 0)){
		$arequest = 0; 
		$arequest2 = " En espera de vobo.";  
	} 
	
$query1 = "update payments set status = '1', arequest='$arequest' where id = '$id'";
$result1 = mysqli_query($con, $query1);

//Times	
$query2 = "insert into times (payment, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '1', 'Pago Ingresado')";
$result2 = mysqli_query($con, $query2);   

$query4 = "update payments set sent='1' where id = '$id'";
$result4 = mysqli_query($con, $query4);

$gcomments = "Enhorabuena, el paquete ha sido creado.";
//insertamos la consulta time
$querytime = "insert into senttimes (package, today, now, now2, userid, stage, comment) values ('$id, '$today', '$now', '$now2', '$_SESSION[userid]', '1', '$gcomments')";
$resulttime = mysqli_query($con, $querytime);       

if($immediate == 1){ 
	include('function-getnext.php');
	getNext($id,'1'); 
}

header("location: payment-order-view.php?id=".$id);

}

function numberFormat($unformatedNumber){ 
	$formatednumber = str_replace(',','',$unformatedNumber);
	$formatednumber = floatval($formatednumber);
	return $formatednumber;
}

function cleanString($string){
	$newString = addslashes($string);
	return $newString;
}

?>