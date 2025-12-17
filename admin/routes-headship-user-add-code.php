<?php include("sessions.php");

$id = $_POST['id'];
$unitid = $_POST['unitid'];
$worker = $_POST['worker'];
$type = $_POST['type'];

$query = "insert into routes (worker, type, headship, unitid) values ('$worker', '$type', '$id', '$unitid')";
$result = mysqli_query($con, $query);

header('location: routes-managua-view.php?id='.$unitid);
 
?>