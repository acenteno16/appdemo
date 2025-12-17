<?php include("sessions.php");

$query = "select * from workers";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	    $password =  "";
		$longitud = 6;  
		for ($i=1; $i<=$longitud; $i++)
		{
		$letra = rand(0,9);
		$password .= $letra;
		} 
		$query2 = "update workers set password='$password' where id = '$row[id]'";
		$result2 = mysqli_query($con, $query2);
}


?>