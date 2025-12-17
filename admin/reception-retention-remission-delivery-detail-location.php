<? 

include("session-reception.php");

$btype = $_POST['btype'];
$ben = $_POST['ben'];
$location = $_POST['location'];
$referer_file = $_POST['referer_file'];

if($btype == 1){
	$query = "update providers set location='$location' where id = '$ben'";
	$result = mysqli_query($con, $query);
}
if($btype == 2){
	$query = "update workers set location='$location' where code = '$ben'";
	$result = mysqli_query($con, $query);
} 

$query_update = "update retentionenvelope set location = '$location' where provider='$ben' and type = '$btype' and status <= '1'";  
$result_update = mysqli_query($con, $query_update);

$referer_file = str_replace('&edit=1','',$_SERVER['HTTP_REFERER']);
header('location: '.$referer_file);    

?>