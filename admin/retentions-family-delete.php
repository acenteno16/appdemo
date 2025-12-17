<? 

include('sessions.php');

$id = $_GET['id'];

$query = "select * from retfamilycontent where family = '$id' limit 1";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

if($num == 0){
	$querydelete = "delete from retfamily where id = '$id'";
	$resultdelete = mysqli_query($con, $querydelete);
	
	header('location: '.$_SERVER['HTTP_REFERER']); 
	
}else{
	echo "<script>alert('No se puede eliminar una familia que tiene tipos agregados.'); history.go(-1);</script>";
	exit(); 
} 

?>