<? 

include("sessions.php");

$query =  "select * from payments where status > 0 and approved != '2' and status < '14'";
$result = mysqli_query($con, $query);
echo 'Total: '.$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$rowp = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
	
	if(($row['status'] == 2) and ($row['approved'] == 1)){
		echo '<br>'.$row['id'];
		$p++;
	}
	if(($row['status'] == 3) and ($row['approved'] == 1)){
		echo '<br>'.$row['id'];
		$p++;
	}
	if(($row['status'] == 4) and ($row['approved'] == 1)){
		echo '<br>'.$row['id'];
		$p++;
	}
	echo ' - '.$rowp['name'];
}

echo '<br>P: '.$p; 

?>