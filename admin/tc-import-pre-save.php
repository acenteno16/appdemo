<? 

include('sessions.php');

$query = "select * from tcDraft";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
	$queryInsert = "insert into tc (today, tc) values ('$row[today]', '$row[tc]')";
	$resultInsert = mysqli_query($con, $queryInsert); 
	
}

$queryDelete = "delete from tcDraft";
$resultDelete = mysqli_query($con, $queryDelete);

header('location: tc.php');

?>