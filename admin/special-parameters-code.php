<?php include("sessions.php");

$mayor = $_POST['mayor'];
$income = $_POST['income'];

$query = "update parameters set mayor='$mayor', income='$income' where id='1'";
$result = mysqli_query($con, $query);      

header("location: special-parameters.php");

?>