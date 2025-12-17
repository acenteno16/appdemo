<? 

include("sessions.php");  

$query = "select * from payments where hall = '0' and ((ret1a > '0') or (ret2a > 0))";
$result = mysqli_query($con, $query);
echo "Numero de registros sin alcaldía definida: ".$num = mysqli_num_rows($result);



?>