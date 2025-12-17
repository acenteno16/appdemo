<? 

include('session-admin.php');

$query = "select * from units where company = 1 order by code asc";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	echo $row['code']." ".ucfirst(strtolower($row['name'])).', ';
}
	
	

?>