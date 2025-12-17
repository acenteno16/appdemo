<?php include("session-review.php");

$id = $_POST['id'];
$id2 = $_POST['id2'];
$from = $_POST['from'];
$to = $_POST['to'];

if($id != ''){
	
	if(($id[0] == 'r')){
	?>
    <script>
	alert('Este codigo de barras no pertenece a un paquete.');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
    <?php }
	else{
	
	$query = "select * from payments where sent >= '2' and id = '$id'";
	$result = mysqli_query($con, $query);
	$num = mysqli_num_rows($result);
	
	if($num > 0){
	
	?>
    <script>
	window.location = "file-review-detail-check.php?id=<?php echo $id; ?>";
	</script>
    <?php }
		else{
		?>
    <script>
	alert('No se encontro el ID de pago en esta etapa.');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
    <?php }
		
}
}else{
	
	$from = $_POST['from'];
	$to = $_POST['to']; 
    header("location: file-review-detail.php?id=$id&id2=$id2&from=".$from.'&to='.$to);   
	
}

?>