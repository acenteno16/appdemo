<? 

include('session-admin.php');

$queryroute = "select * from routes where unit = '2402' and headship = '$headship' and type = '20'";
	$resultroute = mysqli_query($con, $queryroute); 
	echo $numroute = mysqli_num_rows($resultroute);


?>