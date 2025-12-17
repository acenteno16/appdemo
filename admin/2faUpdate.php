<? 

include('sessions.php');

$today = '2025-06-23';
/*
$query = "select email from login where today = '$today' group by email";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	echo '<br>'.$row['email'];
	$query2 = "select id, totime from login where today = '$today' and email = '$row[email]' order by id limit 1";
	$result2 = mysqli_query($con, $query2);
	$row2 = mysqli_fetch_array($result2);
	echo " <$row2[totime]>";
	
	$queryLoginUpdate = "update login set 2fa='1' where id = '$row2[id]'";
	$resultLoginUpdate = mysqli_query($con, $queryLoginUpdate);
	
	
	$query3 = "select id, totime from login where today = '$today' and email = '$row[email]' and id > '$row2[id]'";
	$result3 = mysqli_query($con, $query3);
	while($row3 = mysqli_fetch_array($result3)){
		$queryLoginUpdate = "update login set 2fa='4' where id = '$row3[id]'";
		$resultLoginUpdate = mysqli_query($con, $queryLoginUpdate);
	}
	echo " <$row3[totime]>";
	
	
	
	
}*/

#$query = "update login set 2fa=''";
#$result = mysqli_query($con, $query); 

?>