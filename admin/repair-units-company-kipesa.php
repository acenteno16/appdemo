<? 
/*
include('sessions.php');

$query_route = "select * from units where company = '10' group by code2";
$result_route = mysqli_query($con, $query_route);
while($row_route = mysqli_fetch_array($result_route)){
	$the_route = $row_route['code2'];
	$query = "select payments.id, payments.company from payments where route = '$the_route'";
	//$query = "select payments.id from payments where company = '4'";
	$result = mysqli_query($con, $query);
	$num = mysqli_num_rows($result);
	if(($num > 0) and ($the_route > 0)){
		echo '<br>ROUTE: '.$the_route;
		while($row=mysqli_fetch_array($result)){
			echo "<br>-".$row[0]." (".$row[1].")";
			
			echo '<br>'.$query_update = "update payments set company = '10' where id = '$row[0]'"; 
			//$result_update = mysqli_query($con, $query_update); 
		} 
	}
	

}

*/

?>