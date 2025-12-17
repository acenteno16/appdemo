<? 

$query_logout = "select email from workers where logout = '1'";
$result_logout = mysqli_query($con, $query_logout);
while($row_logout=mysqli_fetch_array($result_logout)){
	if($_SESSION['email'] == $row_logout['email']){
		session_destroy();
		echo "<script>alert('Permisos denegados. Favor ponerse en contacto con el Administrador de GetPay.'); window.location='/';</script>";
		exit(); 
	}
} 

?>