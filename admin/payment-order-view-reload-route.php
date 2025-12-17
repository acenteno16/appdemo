<?php include("session-request.php");

$id = $_POST['theid']; 
$theroute = explode(',',$_POST['theroute']); 
$route = $theroute[0];
$headship = $theroute[1]; 

$query = "update payments set route='$route', headship='$headship' where id = '$id'";
$result = mysqli_query($con, $query);

header('location: '.$_SERVER['HTTP_REFERER']);

?>