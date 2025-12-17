<? 

include('session-admin.php'); 

$id = $_GET['id'];
$name = $_GET['name'];

if($name == ''){
	exit('<script>alert("Ingrese un nombre."); history.go(-1);</script>');
}

$query = "update headship set name='$name' where id = '$id'";
$result = mysqli_query($con, $query);

header('location: '.$_SERVER['HTTP_REFERER']);

?>