<?php 
exit();
include("sessions.php"); 

$description = $_POST['description'];
$ammount = $_POST['ammount'];
$ammount = str_replace(',','',$ammount);
$ammount = str_replace('_','',$ammount);
$ammount = str_replace('€','',$ammount); 
$currency = $_POST['currency'];
$company = $_POST['company'];

$today = date("Y-m-d");
$now = date('H:i:s');
$type = "nc";

$query1 = "select * from balance where currency = '$currency' and company='$company' order by id desc limit 1";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_array($result1);

$balance = $row1['balance']+$ammount;

$query = "insert into balance (today, now, type, description, ammount, balance, currency, company) values ('$today', '$now', '$type', '$description', '$ammount', '$balance', '$currency', '$company')";
$result =  mysqli_query($con, $query);  

header('location: balance-view.php?company='.$company); 

?>