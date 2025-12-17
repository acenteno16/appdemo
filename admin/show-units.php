<? 

include('sessions.php');

$query = "select * from units where company = '2'";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
	echo $row['code'].' '.$row['name'].', ';
	
}

?>