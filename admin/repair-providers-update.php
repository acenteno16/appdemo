<? 

include('sessions.php');

$query = "select * from providerscontacts where provider = '0'";
$result = mysqli_query($con, $query);
echo $num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	echo '<br><br>'.$query2 = "select * from providerscontacts_update where cemail = '$row[cemail]'";
	$result2 = mysqli_query($con, $query2);
	$row2 = mysqli_fetch_array($result2);
	
	echo '<br>'.$query3 = "update providerscontacts set provider='$row2[provider]' where id = '$row[id]'";
	$result3 = mysqli_query($con, $query3); 
}

?>