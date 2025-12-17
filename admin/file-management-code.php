<?php 

include("session-storage.php");

$id = $_POST['id'];

if($id == ""){
	?>
    <script>
	alert('No se reconoce el id');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
    <?php }

if($id[0] != 'a'){ 
	?>
    <script>
	alert('Este codigo de barras no pertenece a una remision de archivo.');
	window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
	</script>
<?php }

$id = str_replace('a','',$id); 

$query1 = "select * from schedule where id = '$id'";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_array($result1);

if($row1['status'] < 6){ ?>
<script>
alert('Este grupo de pagos no se ha cancelado. Favor remitirlo a tesoreria. <?php echo $row1['status']; ?>');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script> 
<?php exit();
} 

if($row1['status'] == 7){ ?> 
<script>
alert('Este ya se encuentra almacenada.');
window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
</script> 
<?php exit();
} 

$query2 = "update schedule set status='7' where id = '$id'";
$result2 = mysqli_query($con, $query2);

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$gcomments = "Enhorabuena, la remisión ha sido archivada";

$querytime = "insert into scheduletimes (schedule, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '7', '$gcomments')";  
$resulttime = mysqli_query($con, $querytime);  
	
header("location: ".$_SERVER['HTTP_REFERER']);   

?>