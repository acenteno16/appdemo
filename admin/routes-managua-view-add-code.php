<?php 

include("sessions.php");

$id = $_POST['id'];
$worker = $_POST['worker'];
$type = $_POST['type'];
$headship = 0;
if(isset($_POST['headship'])){
	$headship = $_POST['headship'];
}
$referer = $_POST['referer'];

$query = "insert into routes (worker, unitid, type, headship) values ('$worker', '$id', '$type', '$headship')";
$result = mysqli_query($con, $query);

header('location: routes-managua-view.php?id='.$id);
 
?>