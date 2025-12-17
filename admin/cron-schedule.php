<?php 

require '../connection.php';

$query = "update payments set blockschedule = ''";
$result = mysqli_query($con, $query);

?>