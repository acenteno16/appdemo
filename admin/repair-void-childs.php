<?

//repair-void-childs.php
/*
include('sessions.php');

$query = "select id from payments where approved = '2' and (parent > '0' or child > '0')";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){

	echo "<br><br>-".$row['id']."";
	$query2 = "select id from payments where child = '$row[id]'";
	$result2 = mysqli_query($con, $query2);
	$num2 = mysqli_num_rows($result2);
	echo "($num2): ";
	while($row2=mysqli_fetch_array($result2)){
		echo "<br>".$row2['id'].": ";
		echo $query3 = "update payments set approved = '2' where id = '$row2[id]'";
		//$result3 = mysqli_query($con, $query3);
	}
	
	
	
}*/

?>