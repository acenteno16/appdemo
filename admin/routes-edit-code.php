<?php include('session-admin.php');

$id = $_POST['id'];

$ammount1 = $_POST['ammount1'];
$ammount2 = $_POST['ammount2'];
$ammount3 = $_POST['ammount3'];
$ammount4 = $_POST['ammount4'];
$unit = $_POST['unit'];
$camount = $_POST['camount'];

$query = "update routes set ammount1 = '$ammount1', ammount2 = '$ammount2', ammount3 = '$ammount3', ammount4 = '$ammount4', camount = '$camount' where id = '$id'";  
$result = mysqli_query($con, $query);

$type = $_POST['type'];
if($type == 1){

	$requestaccess_str = "";
	$requestaccess = $_POST['requestaccess'];
	if ($requestaccess != ""){
    	for($c = 0; $c < sizeof($requestaccess); $c++) {
      		echo $requestaccess_str.="$requestaccess[$c], ";  
    	}
	}
	
	$query_update = "update routes set requestaccess = '$requestaccess_str' where id = '$id'";
	$result_update = mysqli_query($con, $query_update); 
}


header("location: routes-by-unit-view.php?unit=".$unit); 

?>