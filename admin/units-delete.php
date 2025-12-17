<?php include("sessions.php"); 

$id = $_GET['id'];

$query1 = "select * from units where id = '$id'";  
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_array($result1);

$orSql = "";
if($row1[code2] > 0){
    $orSql = "or unit = '$row1[code2]'";
}
$query2 = "select id from routes where unit = '$row1[code]'$orSql limit 1";
$result2 = mysqli_query($con, $query2);
$num2 = mysqli_num_rows($result2); 	

if($num2 == 0){
	$query3 = "delete from units where id = '$id'";
	$result3 = mysqli_query($con, $query3);
	header('location: '.$_SERVER['HTTP_REFERER']);
	
}else{
	while($row2=mysqli_fetch_array($result2)){
		$payments .= $row2['id']." | ";
	}
	?>
    <script>
	alert('La unidad de nogocio no se pudo eliminar debido a que posee algunos pagos vinculados. Referencia: <?php echo $payments; ?>');
	history.go(-1);
	</script>
    <?php }

?>