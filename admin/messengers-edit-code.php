<?php 

include("session-reception.php");

$id = $_POST['id'];
$first = $_POST['first'];
$last = $_POST['last'];
$nid = $_POST['nid'];
$company = $_POST['company'];
$phone = $_POST['phone'];

$query = "update collector set first='$first', last = '$last', nid='$nid', company='$company', phone='$phone' where id='$id'"; 
$result = mysqli_query($con, $query);
 
header("location: messengers.php");

?>