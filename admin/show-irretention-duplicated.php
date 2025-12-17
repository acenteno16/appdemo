<? 

include('session-admin.php');


$query = "select * from irretention group by payment";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	$query2 = "select * from irretention where payment = '$row[payment]'";
	$result2 = mysqli_query($con, $query2);
	$num2 = mysqli_num_rows($result2);
	if($num2 > 1){
		echo "<p>Payment: ".$row['payment']."<br>";
		while($row2=mysqli_fetch_array($result2)){
			if($row2['void'] == 1) $void = " (Anulada)"; else $void = "";
			if($row['payment'] == 0) $void = " (Anulada)";
			echo $row2['id'].$void."<br>";
		}
		echo "</p>";
	}
}

?>