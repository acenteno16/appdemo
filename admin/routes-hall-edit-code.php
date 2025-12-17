<? 

include("session-admin.php");

$id = $_POST['id'];

$worker = $_POST['worker'];
$unit = $_POST['unit'];
$company = $_POST['company'];

$sql_access = "";
$access = $_POST['access'];
if ($access != ""){
    for($c = 0; $c < sizeof($access); $c++) {
      $access1.="$access[$c], "; 
    }
	$sql_access = ", access = '$access1'";
}

$query = "update routes set worker='$worker', unit='$unit', company='$company'".$sql_access." where id = '$id'";
$result = mysqli_query($con, $query); 

header('location: routes-hall.php'); 

?>