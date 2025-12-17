<?php 

include("session-providers.php");  

$account = $_POST['account'];
$bank = $_POST['bank'];
$currency = $_POST['currency'];
$company = $_POST['company'];

$query = "insert into plans (account, bank, company, currency) values ('$account', '$bank', '$company', '$currency')";  
$result = mysqli_query($con, $query);

header("location: payment-plans.php");    

?>