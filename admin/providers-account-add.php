<?php include("sessions.php");

$id = $_POST['id'];
$currency = $_POST['currency'];
$name = $_POST['name'];
$number = $_POST['number'];

$query = "insert into providersaccount (provider, name, currency, number) values ('$id', '$name', '$currency', '$number')";
$result = mysqli_query($con, $query);      

header("location: providers-edit.php?id=".$id."&changes=1");

?>