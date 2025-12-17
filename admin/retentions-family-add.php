<? 

include('sessions.php'); 

$name = $_POST['name'];
$today = date('Y-m-d');

if($name == ""){
	echo "<script>alert('Debe de proporcionar un nombre.');history.go(-1);</script>";
	exit(); 
}

$query = "insert into retfamily (name, today, userid) values ('$name', '$today', '$_SESSION[userid]')";
$result = mysqli_query($con, $query);
$id = mysqli_insert_id($con);

header('location: retentions-family-content.php?id='.$id); 

?>