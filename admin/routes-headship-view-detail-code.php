<?php include("sessions.php");

$headship = $_POST['headship'];
$name = $_POST['name'];

$query = "update headship set name='$name' where id='$headship'"; 
$result = mysqli_query($con, $query);

header('location: '.$_SERVER['HTTP_REFERER']); 
 
?>