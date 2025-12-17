<?php 

/*
include("session-request.php"); 

$id = $_GET['id'];

$query1 = "select * from payments where id = '$id'";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_array($result1);

if($row1['status'] == 0){
	$query2 = "delete from payments where id = '$id'";
	$result2 = mysqli_query($con, $query2);
	header("location: ".$_SERVER['HTTP_REFERER']);
}else{
	?>
    <script>
	alert('No se ha podido eliminar el pago. Consulte con el administrador del sistema.');
	history.go(-1);
	</script>
    <?php }
*/

?>