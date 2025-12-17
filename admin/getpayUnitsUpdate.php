<? 

include('sessions.php');

/*
$query = "select * from unitsDraft group by location order by location asc";
$result = mysqli_query($con, $query);
echo 'Num: '.$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	echo '<br>-'.$row['location'].' - '.$row['location2'];
	
	$queryInsert = "insert into locations (code, name) values ('$row[location]', '$row[location2]')";  
	#$resultInsert = mysqli_query($con, $queryInsert);
	
	$queryInsert = "insert into locations (code, name) values ('$row[location]', '$row[location2]')";  
	#$resultInsert = mysqli_query($con, $queryInsert);
	
}
*/

$query = "select * from unitsDraft";
$result = mysqli_query($con, $query);
echo 'Num: '.$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){

	echo '<br>'.$row['code'].' - '.$row['code2'];
	
	$query2 = "select * from units where code = '$row[code2]'"; 
	$result2 = mysqli_query($con, $query2);
	$num2 = mysqli_num_rows($result2);
	if($num2 > 0){
		
		$row2 = mysqli_fetch_array($result2);
		echo '<span style="color:green;"> '.$row2['name'].' vs </span> '.$row['line2'].'@'.$row['location2'];
		
	}else{
		echo '<span style="color:red;"> '.$row['line2'].'@'.$row['location2'].'</span>';
	}
	
	
}

?>