<?

include("sessions.php");

$query = "select * from payments where ret2a='1747.33'";
$result = mysqli_query($con, $query);
echo $num = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){

	echo "<br>-".$row['id'];
	
}

 ?>