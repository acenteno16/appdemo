<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("session-reception.php"); 
include("fn-received.php"); 

$id = $_POST['id'];
if($id == 'hola'){ ?>
	 <script>
	alert('Error en la impresion de la remision. Favor digite para ingresar.');
	history.go(-1);
	</script>
<? }
if($id == ""){
	?>
     <script>
	alert('No se reconoce el id');
	history.go(-1);
	</script>
    <?php }

if($id[0] != 'r'){
	?>
    <script>
	alert('Este codigo de barras no pertenece a una remision.'); 
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
    <?php }
else{
	
	$id = str_replace('r','',$id);
	
	$query1 = "select * from packages where stage = '1' and id = '$id'";
	$result1 = mysqli_query($con, $query1);
	$num1 = mysqli_num_rows($result1);
	
	if($num1 == 0){
		$query1a = "select * from packages where id = '$id'";
	$result1a = mysqli_query($con, $query1a);
	$num1a = mysqli_num_rows($result1a);
		if($num1a == 0){ ?>
   
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
	
	$query = "update packages set stage = '2' where id = '$id'";
	$result = mysqli_query($con, $query);
	
	$today = date("Y-m-d");
	$now = date('Y-m-d H:i:s');
	$now2 = date('H:i:s');
	$gcomments = "Enhorabuena, la remisi\u00f3n ha sido recibida en recepci\u00f3n."; 
	
	//Filestime stage
	$querytime = "insert into packagestimes (package, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '2', '$gcomments')"; 
	$resulttime = mysqli_query($con, $querytime);
	
	fnReceived($id, $con); 
	
	//Enviar notificacion al solicitante
	$immediate = 0;	
	$querypayments = "select payments.immediate from payments inner join packagescontent on payments.id = packagescontent.payment where packagescontent.package = '$id'";
	$resultpayments = mysqli_query($con, $querypayments);
	while($rowpayments=mysqli_fetch_array($resultpayments)){
		if($rowpayments['immediate'] == 1){
			$immediate = 1;
		}
	}
	if(($immediate == 1)){
		//include('function-getnext.php');
		//getNext($id,'FileReception'); 
	}


	?>
	<script>
	alert('La remisi\u00f3n fue agregada exitosamente.');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
	<?php }
	
}
?>