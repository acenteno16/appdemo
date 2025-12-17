<?php  

include("session-request.php");

$id = intval($_GET['id']);	 
$today = date("Y-m-d"); 

error_reporting(E_ALL);
ini_set('display_errors', 1);


//PAYMENT
$query = "SELECT * FROM payments WHERE id = '$id'"; 
$result = mysqli_query($con, $query); 
$row=mysqli_fetch_array($result);

if($row['approved'] != 2){
	echo "<script>alert('El pago debe de estar rechazado para poder utilizar esta opcion.'); history.go(-1);</script>";
	exit();
}

if($row['parentof'] != 0){
	
	echo "<script>alert('Esta solicitud de pago ya se encuentra vinculada con el ID#".$row['parentof']."'); history.go(-1);</script>";
	exit(); 
	
}

$description = addslashes($row['description']);
$notes = addslashes($row['notes']);

$query2 = "INSERT INTO payments (today, type, btype, provider, collaborator, description, ammount, ammount2, currency, ret1, ret1a, ret2, ret2a, payment, paymentnio, userid, beneficiarie, route, headship, headship2, retainer, notes, distribution, distributable, acp, acp2, stotal, cut, manualrets, arequest, expiration) values ('$today', '$row[type]', '$row[btype]', '$row[provider]', '$row[collaborator]', '$description', '$row[ammount]', '$row[ammount2]', '$row[currency]', '$row[ret1]', '$row[ret1a]', '$row[ret2]', '$row[ret2a]', '$row[payment]', '$row[paymentnio]', '$_SESSION[userid]', '$row[beneficiarie]', '$row[route]', '$row[headship]', '$row[headship2]', '$row[retainer]', '$notes', '$row[distribution]', '$row[distributable]', '$row[acp]', $row[acp2], '$row[stotal]', '$row[cut]', '$row[manualrets]', '$row[arequest]', '$row[expiration]')"; 
$result2 = mysqli_query($con, $query2); 
$new_id = mysqli_insert_id($con);

//BILLS
$querybills = "select * from bills where payment = '$id'";
$resultbills = mysqli_query($con, $querybills);
while($rowbills=mysqli_fetch_array($resultbills)){
	
	$querybills2 = "insert into bills (payment, number, ammount, letters, stotal, stotal2, tax, intur, inturammount, exempt, exempt2, type, concept, concept2, billdate, billdate2, ret1, ret1a, ret2, ret2a, currency, tc, nioammount, niostotal, niotax, niointur, niobillpayment, cut, nd) values ('$new_id', '$rowbills[number]', '$rowbills[ammount]', '$rowbills[letters]', '$rowbills[stotal]', '$rowbills[stotal2]', '$rowbills[tax]', '$rowbills[intur]', '$rowbills[inturammount]', '$rowbills[exempt]', '$rowbills[exempt2]', '$rowbills[type]', '$rowbills[concept]', '$rowbills[concept2]', '$rowbills[billdate]', '$rowbills[billdate2]', '$rowbills[ret1]', '$rowbills[ret1a]', '$rowbills[ret2]', '$rowbills[ret2a]', '$rowbills[currency]', '$rowbills[tc]', '$rowbills[nioammount]', '$rowbills[niostotal]', '$rowbills[niotax]', '$rowbills[niointur]', '$rowbills[niobillpayment]', '$rowbills[cut]', '$rowbills[nd]')"; 
	$resultbills2 = mysqli_query($con, $querybills2);      
	
}

//FILES 
$queryfiles = "select * from files where payment = '$id'";
$resultfiles = mysqli_query($con, $queryfiles);
while($rowfiles=mysqli_fetch_array($resultfiles)){
	
	$queryfiles2 = "INSERT INTO files (payment, link, deletefile) values ('$new_id', '$rowfiles[link]', '0')";
	$resultfiles2 = mysqli_query($con, $queryfiles2);  
	
}

//DISTRIBUTION 
$querydistribution = "select * from distribution where payment = '$id'";
$resultdistribution = mysqli_query($con, $querydistribution);
while($rowdistribution=mysqli_fetch_array($resultdistribution)){
	
	$querydistribution2 = "insert into distribution (payment, unit, percent, total) values ('$new_id', '$rowdistribution[unit]', '$rowdistribution[percent]', '$rowdistribution[total]')"; 
	$resultdistribution2 = mysqli_query($con, $querydistribution2);
	
}

//MANUAL RETENTIONS
$querymretentions = "select * from manualretentions where payment = '$id'";
$resultmretentions = mysqli_query($con, $querymretentions);
while($rowmretentions=mysqli_fetch_array($resultmretentions)){
	$querymretentions2 = "insert into manualretentions (payment, type, today, number, provider, address, ruc, nid, phone, concept, bills, totalbill, percent, totalretention, elaborator) values ('$new_id', '$rowmretentions[type]', '$rowmretentions[today]', '$rowmretentions[number]', '$rowmretentions[provider]', '$rowmretentions[address]', '$rowmretentions[ruc]', '$rowmretentions[nid]', '$rowmretentions[phone]', '$rowmretentions[concept]', '$rowmretentions[bills]', '$rowmretentions[totalbill]', '$rowmretentions[percent]', '$rowmretentions[totalretention]', '$rowmretentions[elaborator]')";
	
	$resultmretentions2 = mysqli_query($con, $querymretentions2);
}

header("location: payment-order.php?id=".$new_id);   

?>