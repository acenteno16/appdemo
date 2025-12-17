<?php include("sessions.php");

$unit = $_POST['unit'];
$worker = $_POST['worker'];
$type = $_POST['type'];
$headship = 0;

$query = "insert into routes (worker, unit, type, headship) values ('$worker', '$unit', '$type', '$headship')";
$result = mysqli_query($con, $query);

header('location: routes-departments-view.php?unit='.$unit);

?>