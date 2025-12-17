<?php include('session-admin.php');

$id = $_POST['id'];
$ammount1 = $_POST['ammount1'];
$ammount2 = $_POST['ammount2'];
$ammount3 = $_POST['ammount3'];
$ammount4 = $_POST['ammount4'];
$route = $_POST['route'];

$query = "update routes set ammount1 = '$ammount1', ammount2 = '$ammount2', ammount3 = '$ammount3', ammount4 = '$ammount4' where id = '$id'";  
$result = mysqli_query($con, $query);

header("location: routes-headship-view-detail.php?id=".$route); 

?>