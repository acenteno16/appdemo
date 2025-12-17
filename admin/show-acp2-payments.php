<? 

include("sessions.php");

$query = "select * from payments where acp2 = '1' and status < 14";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	echo '<br>'.$row['id']; 
}


?>