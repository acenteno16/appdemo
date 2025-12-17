<?php 

include("sessions.php");

$id = $_POST['id'];

$query = "delete from routes where id = '$id'";
$result = mysqli_query($con, $query);

echo 'Eliminado con exito!';

?>