<h1>Pagos aprobados SENT=0</h1>
<? 
include("sessions.php"); 
$query = "select id from payments where sent = '0' and approved = '1'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
echo "Numero de coincidencias: ".$num;

while($row=mysqli_fetch_array($result)){
	echo "<br>".$row[0];
}

?>