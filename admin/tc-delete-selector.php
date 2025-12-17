<?php 

include('sessions.php');

$month = $_GET['month'];
$year = $_GET['year'];

$firstday = $year.'-'.$month.'-1';
$lastday =  date("Y-m-d", strtotime("$firstday +1 month"));  

$query = "delete from tc where today >= '$firstday' and today < '$lastday'"; 
$result = mysqli_query($con, $query);
header('location: '.$_SERVER['HTTP_REFERER']);


?>