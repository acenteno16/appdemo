<? 
/*
include('sessions.php');


$query = "select userid, COUNT(*) as cc from payments where approved = '1' and today > '2021-01-01' group by userid order by COUNT(*) desc";
$result = mysqli_query($con, $query);
echo 'NUM:'.$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	$query2 = "select * from workers where code = '$row[userid]'";
	$result2 = mysqli_query($con, $query2);
	$row2 = mysqli_fetch_array($result2);
	
	echo "<br><br><strong>Código:</strong> $row2[code]<br>
		<strong>Nombre:</strong> $row2[first] $row2[last] <br>
<strong>Email:</strong> $row2[email]  <br>
<strong>Solicitudes 2021:</strong> $row[cc]";
	#echo "<br>-$row[code] | $row[first] $row[last] ($row[email]) $row[4]";
}
*/
?>