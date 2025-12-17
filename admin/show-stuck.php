<?php

include("../connection.php");

$queryrstuck = "select * from payments where status = '14' and mayorstage= '0'";
$resultrstuck = mysqli_query($con, $queryrstuck);
echo $numrstuck = mysqli_num_rows($resultrstuck);

?>