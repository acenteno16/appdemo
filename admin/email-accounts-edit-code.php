<?php

include("session-admin.php");

$id = $_POST['id'];
$mailHost = $_POST['mailHost'];
$mailUsername = $_POST['mailUsername'];
$mailPort = $_POST['mailPort'];
$mailTLS = $_POST['mailTLS'];
$mailFrom = $_POST['mailFrom'];
$mailFromName = $_POST['mailFromName'];

if($id == 0){
	$query0 = "insert into mailer () values ()";
	$result0 = mysqli_query($con, $query0);
	#echo mysqli_error($con);
	#	exit();
	$id = mysqli_insert_id($con);
}

$query = "update mailer set mailHost='$mailHost', mailUsername='$mailUsername', mailPort='$mailPort', mailTLS='$mailTLS', mailFrom='$mailFrom', mailFromName='$mailFromName' where id = '$id'";
$result = mysqli_query($con, $query);

$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

if(($password1 == $password2) and ($password1 != '')){
	
	$query2 = "update mailer set mailPassword='$password1' where id = '$id'";
	$result2 = mysqli_query($con, $query2);
	
}

header('location: email-accounts.php'); 

?>