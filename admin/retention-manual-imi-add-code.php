<?php

include("sessions.php"); 

$number = $_POST['number'];
$today = date('Y-m-d');
$today2 = date("Y-m-d", strtotime($_POST['today2']));
$provider = $_POST['provider'];
$description = $_POST['description'];
$totalbill = $_POST['totalbill'];
$percent = $_POST['percent'];
$totalretention = $_POST['totalretention'];

$query = "insert into retentionimi (number, today, today2, provider, description, totalbill, percent, totalretention) values ('$number', '$today', '$today2', '$provider', '$description', '$totalbill', '$percent', '$totalretention')"; 
$result = mysqli_query($con, $query);

header('location: retention-manual-imi.php');

?>