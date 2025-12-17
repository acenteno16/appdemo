<?php include("session-reception.php");

$id = $_POST['id'];
$worker = $_POST['worker'];

if($id == ""){
	?>
     <script>
	alert('No se reconoce el id');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
    <?php }

if($id[0] != 'r'){
	?>
    <script>
	alert('Este codigo de barras no pertenece a una remisi\u00f3n.');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
    <?php }else{
	
	$id = str_replace('r','',$id);
	
	$query1 = "select * from packages where stage = '2' and id = '$id'";
	$result1 = mysqli_query($con, $query1);
	$num1 = mysqli_num_rows($result1);
	
	if($num1 == 0){
		
		$query1a = "select * from packages where id = '$id'";
	$result1a = mysqli_query($con, $query1a);
	$num1a = mysqli_num_rows($result1a);
	
	if($num1a == 0){
	
		?>
    <script>
	alert('No se encontro ninguna remisi\u00f3n con este codigo.');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
    <?php } else{ ?>
		  <script>
	alert('La remisi\u00f3n se encuentra en otra etapa.');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
	 <?php }
	}else{
	
	$query = "update packages set stage = '3', worker = '$worker' where id = '$id'";
	$result = mysqli_query($con, $query);
	
	$today = date("Y-m-d");
	$now = date('Y-m-d H:i:s');
	$now2 = date('H:i:s');
	$gcomments = "Enhorabuena, la remision ha sido entregada a revision."; 
	
	//Filestime stage
	$querytime = "insert into packagestimes (package, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '3', '$gcomments')"; 
	$resulttime = mysqli_query($con, $querytime); 
	
	//Enviar notificacion al solicitante

	?>
     <script>
	alert('La remisi\u00f3n ha sido entregada.');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
	<?php }
	
}
?>