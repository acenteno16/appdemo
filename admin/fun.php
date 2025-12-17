<? 

/*
include('sessions.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "select * from bills where retfamily = '$id' limit 1";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

if($num == 0){
	$querydelete = "delete from retfamilycontent where id = '$id'";
	$resultdelete = mysqli_query($con, $querydelete);
	
	header('location: '.$_SERVER['HTTP_REFERER']);
	
}else{
	echo "<script>alert('No se puede eliminar un tipo que ha sido utilizado en un documento.'); history.go(-1);</script>";
	exit(); 
} 
*/

?>