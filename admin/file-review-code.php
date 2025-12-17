<?php include("session-review.php");

$id = $_POST['id'];

if($id == ""){
?>
<script>
alert('No se reconoce el id');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script>
<?php exit();
}

if($id[0] != 'r'){
	?>
    <script>
	alert('Este codigo de barras no pertenece a una remisi\u00f3n.');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
    <?php exit();
}
	
$id = str_replace('r','',$id);
	
$query2 = "select * from packages where stage < '3' and id = '$id'";
$result2 = mysqli_query($con, $query2);
$num2 = mysqli_num_rows($result2);
	
if($num2 > 0){
?>
<script>
alert('La remisi\u00f3n se encuentra en otra etapa anterior.');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script>
<?php exit();
}

$query1 = "select * from packages where stage = '4' and id = '$id'";
$result1 = mysqli_query($con, $query1);
$num1 = mysqli_num_rows($result1);
	
if($num1 > 0){
?>
<script>
alert('La remisi\u00f3n no. <?php echo $id; ?> ya ha sido ingresada.');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script>
<?php exit();
}

$query1b = "select * from packages where id = '$id'";
$result1b = mysqli_query($con, $query1b);
$num1b = mysqli_num_rows($result1b);
	
if($num1b == 0){
		?>
<script>
alert('No se encontro ninguna remisi\u00f3n con este codigo.');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script>
<?php exit();
}
	
	//Aquí indicamos que la remisión fue ingresada a revisión
	//Esta es la ultima etapa de la remisión ya que se convierte en 
	//paquetes de archivos de pagos especificos
	
	$querymain = "select * from packages where stage = '3' and id = '$id'";
	$resultmain = mysqli_query($con, $querymain);
	$nummain = mysqli_num_rows($resultmain);
	if($nummain > 0){
	
	$query = "update packages set stage = '4' where id = '$id'";
	$result = mysqli_query($con, $query);
	
	$today = date("Y-m-d");
	$now = date('Y-m-d H:i:s');
	$now2 = date('H:i:s');
	$gcomments = "Enhorabuena, la remisi&oacute;n ha sido ingresada a revisi&oacute;n."; 
	
	//Filestime stage
	$querytime = "insert into packagestimes (package, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '4', '$gcomments')"; 
	$resulttime = mysqli_query($con, $querytime); 
	
	//Enviar notificacion al solicitante
	
	
	//Update file status
	$querypc = "select * from packagescontent where package = '$id'";
	$resultpc = mysqli_query($con, $querypc);
	while($rowpc=mysqli_fetch_array($resultpc)){
		
		//Aca marcamos el pago (que esta dentro de una remisión) como ingresado a revisión
		$querysent = "update payments set sent='3' where id = '$rowpc[payment]'";
		$resultsent = mysqli_query($con, $querysent); 
		
		//Creamos los datos para la consulta time
		$today = date("Y-m-d");
		$now = date('Y-m-d H:i:s');
		$now2 = date('H:i:s');
		$gcomments = "Enhorabuena, el paquete ha sido ingresado a revisi&oacute;n.";
		
		//insertamos la consulta time
		$querytime = "insert into senttimes (package, today, now, now2, userid, stage, comment) values ('$rowpc[payment]', '$today', '$now', '$now2', '$_SESSION[userid]', '3', '$gcomments')";
		$resulttime = mysqli_query($con, $querytime);  
		
		
		//Empezamos a jugar con los archivos
		//Aca hacemos la selección de los 
		$queryfiles = "select * from files where payment = '$rowpc[id]'";
		$resultfiles = mysqli_query($con, $queryfiles);
		while($rowfiles=mysqli_fetch_array($resultfiles)){
			//Aqui ponemos todos los archivos dentro del paquete como "En espera de revisión"
			$queryuf = mysqli_query($con, "update files set status='2' where id = '$rowfiles[id]'");
			
		}
	}

	?>
    
     <script>
	alert('La remisi\u00f3n fue agregada exitosamente.');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
<?php } ?>   