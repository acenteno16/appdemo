<?php include("sessions.php");

$name = $_POST['name'];
$comments = $_POST['comments'];
$userid = $_SESSION['userid'];

$today = date('Y-m-d');

$query = "insert into templates (name, today, userid, comments) values ('$name', '$today', '$userid', '$comments')";
$result = mysqli_query($con, $query); 
$id = mysqli_insert_id($con);      

header("location: templates-view.php?id=".$id);     

?>