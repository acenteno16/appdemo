<?php 

include("session-admin.php");

$id = $_POST['id'];
$name = $_POST['name'];
$company = $_POST['company'];
$bank = $_POST['bank'];
$currency = $_POST['currency'];
$inc = $_POST['inc'];

if($id == 0){
	$queryInsert = "insert into bankspaymentplans (inc) values ('$inc')";
	$resultInsert = mysqli_query($con, $queryInsert);
	$id = mysqli_insert_id($con);
}

$query = "update bankspaymentplans set name='$name', company='$company', bank='$bank', currency='$currency' where id = '$id'";
$result = mysqli_query($con, $query); 
$id = mysqli_insert_id($con);      

header("location: banks-payment-plans.php");     

?>