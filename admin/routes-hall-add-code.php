<?php 

include("session-admin.php");

$worker = $_POST['worker'];
$unit = $_POST['unit'];
$company = $_POST['company'];
$type = $_POST['type'];
$headship = "";
if(isset($_POST['headship'])){
	$headship = $_POST['headship'];
}

$sql_access = "";
$access = $_POST['access'];
if ($access != ""){
    for($c = 0; $c < sizeof($access); $c++) {
      $access1.="$access[$c], "; 
    }
	$sql_access = " access = '$access1'";
}

$query = "insert into routes (worker, unit, company, type) values ('$worker', '$unit', '$company', '23')";
$result = mysqli_query($con, $query);
$id = mysqli_insert_id($con);

$query2 = "update routes set ".$sql_access." where id = '$id'";
$result2 = mysqli_query($con, $query2);

header('location: routes-hall-edit.php?id='.$id); 










?>




