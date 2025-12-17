<? 

include("sessions.php");


$query = "select * from providers group by code having count(*)>=2"; 
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	echo "Code: ".$row['code']."<br>".$row['name']."<br>_______<br>";
}

?>