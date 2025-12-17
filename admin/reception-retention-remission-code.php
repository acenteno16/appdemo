<?php 

include("session-reception.php");

$id = $_POST['id'];
$id_r = $id;
if($id == ""){
	?>
    <script>
	alert('No se reconoce el id');
	history.go(-1);
	</script>
    <?php }

//Decalramos Okay a cero
$okay = 0;

//Validamos okay si coincide 
if($id[0] == 'i'){
	$okay = 1;
	$tablename_main = "irremission";
	$tablename_times = "irremissiontimes";
	$campo = "irremission";
}
if($id[0] == 'h'){
	$okay = 1;
	$tablename_main = "hallsremission";
	$tablename_times = "hallsremissiontimes";
	$campo = "hallsremission";
}

if($okay == 0){
	?>
    <script>
	alert('Este codigo de barras no pertenece a una remision de retenciones.');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
    <?php }else{
	
	$id = str_replace('i','',$id);
	$id = str_replace('h','',$id);
	
	$query1 = "select * from $tablename_main where status = '1' and id = '$id'";
	$result1 = mysqli_query($con, $query1);
	$num1 = mysqli_num_rows($result1);
	
	if($num1 == 0){
		$query1a = "select * from $tablename_main where id = '$id'";
		$result1a = mysqli_query($con, $query1a);
		$num1a = mysqli_num_rows($result1a);
		if($num1a == 0){ 
		?>
   
    		<script>
			alert('No se encontro ninguna remision con este codigo.');
			window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
			</script>
    	<?php }
		else{
		?> 
		<script>
		alert('La remisi\u00f3n se encuentra en otra etapa.');
		window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
		</script>
		<?php }
	}
	else{
	
	$today = date("Y-m-d");
	$now = date('Y-m-d H:i:s');
	$now2 = date('H:i:s');
	$gcomments = "Enhorabuena, la remisi\u00f3n ha sido recibida en recepci\u00f3n."; 
	
	
	
	#######################
	
	//Update de las tablas
	if($id_r[0] == 'i'){
	
		$query = "update irremission set status = '2' where id = '$id'";
		$result = mysqli_query($con, $query);
	
		$query_update = "select * from irremissioncontent where irremission = '$id'";
		$result_update = mysqli_query($con, $query_update);
		while($row_update=mysqli_fetch_array($result_update)){
			$query_update2 = "update irretention set remissionstatus = '2', delivery = '2' where id = '$row_update[irretention]'";
			$result_update2= mysqli_query($con, $query_update2);
		}
		
		//Filestime stage
		$querytime = "insert into irremissiontimes (irremission, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '2', '$gcomments')"; 
		$resulttime = mysqli_query($con, $querytime);
	
	
	}
	if($id_r[0] == 'h'){
		$query = "update hallsremission set status = '2' where id = '$id'";
		$result = mysqli_query($con, $query);
	
		$query_update = "select * from hallsremissioncontent where hallsremission = '$id'";
		$result_update = mysqli_query($con, $query_update);
		while($row_update=mysqli_fetch_array($result_update)){
			$query_update2 = "update hallsretention set remissionstatus = '2', delivery = '2' where id = '$row_update[hallsretention]'"; 
			$result_update2= mysqli_query($con, $query_update2); 
		}
		//Filestime stage
		$querytime = "insert into hallsremissiontimes (hallsremission, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '2', '$gcomments')"; 
		$resulttime = mysqli_query($con, $querytime);
	}
	
	
	######################
	
	
	?>
	<script>
	alert('La remisi\u00f3n fue agregada exitosamente.');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
	<?php }
	
}

?>