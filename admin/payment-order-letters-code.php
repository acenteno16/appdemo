<?php

include("session-request-bt.php");  

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');

$id = $_POST['id']; 
$transaction = $_POST['transaction'];
$account1 = $_POST['account1'];
$account2 = $_POST['account2'];
$description = $_POST['description'];
$amount = $_POST['amount'];
$tc = $_POST['tc'];
$notes = $_POST['notes'];

$newbutton = $_POST['newbutton'];

$query1 = "select company from banksaccounts where id = '$account1'";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_array($result1);

$query2 = "select company from banksaccounts where id = '$account2'";
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_array($result2);

if($row1['company'] != $row2['company']){
	$intercompany = 1;
}else{
	$intercompany = 0;
}

$query = "update letters set transaction='$transaction', account1='$account1', account2='$account2', description='$description', amount='$amount', tc='$tc', notes='$notes', company1='$row1[company]', company2='$row2[company]', intercompany='$intercompany' where id = '$id'";
$result = mysqli_query($con, $query); 


//Save Files
//$query_files = "";
//$result_files = mysqli_query($con, $query_files);

if($newbutton == "save"){

	$query_update = "update letters set status = '1' where id = '$id'";
	$result_update = mysqli_query($con, $query_update);
	
	$query_times = "insert into letterstimes (letter, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '1', 'Transferencia Ingresada')";
	$result_times = mysqli_query($con, $query_times);
 
}
	
header('location: letters.php');

?>