<? 

include('sessions.php');


$query = "select * from providers";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
	$query2 = "select * from providers_plans where provider = '$row[id]'";
	$result2 = mysqli_query($con, $query2);
	$num2 = mysqli_num_rows($result2);
	
	if($num2 == 0){
		$num++;
		$str_providers.= '<br>'.$row['code']." | ".$row['name'];
	}
	
	
}
echo $num;
echo $str_providers;
?>