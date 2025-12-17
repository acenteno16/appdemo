<?php include("session-admin.php");

$id = $_POST['id'];
$active = $_POST['active'];
$comments2 = $_POST['comments2'];
 
$query = "update beneficiaries set active='$active', comments2='$comments2' where id = '$id'";
$result = mysqli_query($con, $query);

//Notifications

$query1 = "select * from beneficiaries where id = '$id'";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_array($result1);

if($active == 1){
	$message = 'La solicitud de '.$row1['name'].' fue aprobada por '.$_SESSION['firstname']." ".$_SESSION['lastname'];
}
if($active == 2){
	$message = 'La solicitud de '.$row1['name'].' fue denegada por '.$_SESSION['firstname']." ".$_SESSION['lastname'];
}
$today = date("Y-m-d"); 
$query2 = "insert into notifications (userid, today, notification, link) values ('$row1[userid]', '$today', '$message', '')";
$result2 = mysqli_query($con, $query2);

header("location: beneficiaries-approve.php");
 
?>