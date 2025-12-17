<?php 

include("session-frequest.php");  

$id = intval($_POST['id']);
$newbutton = $_POST['newbutton'];

$querymain = "select * from funds where id = '$id'";
$resultmain = mysqli_query($con, $querymain);
$rowmain = mysqli_fetch_array($resultmain);

if($rowmain['status'] != 0){
	echo "<script>
	alert('El ID de la solicitud ya fue creado.');
	window.location = 'funds-confirmation.php';
	</script>";
	exit(); 
}

if(($newbutton == 'save') and (!file_exists('../../funds/'.$id.'.jpg'))){ 	
	echo "<script>
	alert('Debe de igresar una imagen de soporte.');
	history.go(-1);
	</script>";
	exit(); 	
}
	

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$user = $_SESSION['userid'];
$amount = $_POST['amount'];
$currency = $_POST['currency'];
$depositdate = $_POST['depositdate'];
if($depositdate != ''){
	$depositdate = date("Y-m-d", strtotime($depositdate));
}
$company = $_POST['company'];
$bank = $_POST['bank'];
$comments = $_POST['comments'];

//Clients
$clienttype = $_POST['clienttype'];
$ccode = cleanString($_POST['ccode']);
$cfirst = cleanString($_POST['cfirst']);
$clast = cleanString($_POST['clast']);
$caddress = cleanString($_POST['caddress']);
$ccity = cleanString($_POST['ccity']);
$cnid = cleanString($_POST['cnid']);
$cemail = cleanString($_POST['cemail']);
$cphone = cleanString($_POST['cphone']);
//
$ccode2 = cleanString($_POST['ccode2']);
$cname = cleanString($_POST['cname']);
$cruc = cleanString($_POST['cruc']);
$cemail2 = cleanString($_POST['cemail2']);
$cphone2 = cleanString($_POST['cphone2']);
$caddress2 = cleanString($_POST['caddress2']);
$ccity2 = cleanString($_POST['ccity2']);
//
$crfirst = cleanString($_POST['crfirst']);
$crlast = cleanString($_POST['crlast']);
$crnid = cleanString($_POST['crnid']);
$cremail = cleanString($_POST['cremail']);
$crphone = cleanString($_POST['crphone']);

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

$queryUpdate = "update funds set amount='$amount', currency='$currency', depositdate='$depositdate', company='$company', bank='$bank', comments='$comments', client='$client_code' where id = '$id'";
$resultUpdate = mysqli_query($con, $queryUpdate);

if(isset($_POST['save'])){
	
	$querySave = "update funds set status = '1' where id = '$id'";
	$resultSave = mysqli_query($con, $querySave);
	
	$queryFtimes = "insert into fundstimes (fund, today, now, now2, userid, stage) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '1')";
	$resultFtimes = mysqli_query($con, $queryFtimes);
	
	header("location: funds-confirmation-view.php?id=".$id);
	
}else{
	
	header("location: funds-confirmation.php");
	
}

function cleanString($string){
	$newString = addslashes($string);
	return $newString;
}

?>