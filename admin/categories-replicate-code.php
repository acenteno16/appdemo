<?php 

include("session-admin.php");

$id = $_POST['cid'];
$write = $_POST['write'];
 
for($c=0;$c<sizeof($id);$c++){
	$name = "";
	$account = "";
	$query1 = "select * from categories where id = '$id[$c]'";
	$result1 = mysqli_query($con, $query1);
	$row1 = mysqli_fetch_array($result1);
	$name = $row1['name'];
	$account = $row1['account'];
	
	$query2 = "insert into categories (name, account, parentcat) values ('$name', '$account', '$write')";
	$result2 = mysqli_query($con, $query2);
}

header("location: ".$_SERVER['HTTP_REFERER']);

?>