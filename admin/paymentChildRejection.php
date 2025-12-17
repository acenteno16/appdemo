<?  

include('sessions.php');

$id = $_GET['id'];

$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);

exit('<script>alert("Esperando desactivar beta para afectar las tablas de la base de datos de produccion."); history.go(-1);</script>');

?>