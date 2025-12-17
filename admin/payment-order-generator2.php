<?php include("sessions.php");

$id = $_GET['id'];	 




$query = "INSERT INTO payments (btype, provider, collaborator, description, bill, ammount, letters, currency, ret1, ret1a, ret2, ret2a, payment, userid, ptype, expiration, beneficiarie, route, retainer, headship) SELECT btype, provider, collaborator, description, bill, ammount, letters, currency, ret1, ret1a, ret2, ret2a, payment, userid, ptype, expiration, beneficiarie, route, retainer, headship FROM payments WHERE id = '$id'";
$result = mysqli_query($con, $query); 
$new_id = mysqli_insert_id($con);

$querybills = "select * from bills where payment = '$id'";
$resultbills = mysqli_query($con, $querybills);
while($rowbills=mysqli_fetch_array($resultbills)){
	
	$querybills2 = "INSERT INTO bills (number, ammount, letters, stotal, stotal2, tax, exempt, type, concept, concept2, billdate, mretainer, nammount, intur) SELECT number, ammount, letters, stotal, stotal2, tax, exempt, type, concept, concept2, billdate, mretainer, nammount, intur FROM bills WHERE id = '$rowbills[id]'"; 
	$resultbills2 = mysqli_query($con, $querybills2);  
	
	$idbills2 = mysqli_insert_id($con);
	$queryupdate = "update bills set payment='$new_id' where id = '$idbills2'";
	$resultupdate = mysqli_query($con, $queryupdate); 
	

}

$queryfiles = "select * from files where payment = '$id'";
$resultfiles = mysqli_query($con, $queryfiles);
while($rowfiles=mysqli_fetch_array($resultfiles)){
	
	$queryfiles2 = "INSERT INTO files (bill, link, name) SELECT bill, link, name FROM files WHERE id = '$rowfiles[id]'";
	$resultfiles2 = mysqli_query($con, $queryfiles2);  
	
	$idfiles2 = mysqli_insert_id($con);
	$queryupdate2 = "update files set payment='$new_id' where id = '$idfiles2'"; 
	$resultupdate2 = mysqli_query($con, $queryupdate2); 

}


header("location: payment-order.php?id=".$new_id);  

//echo "payment-order.php?id=".$new_id;
?>