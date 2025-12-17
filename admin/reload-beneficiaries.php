<?php include("sessions.php");

$id = $_POST['variable'];

$query = "select * from beneficiaries where provider = '$id'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);      
?>
<?php if($id == 0){?> 
Esperando que selección un proveedor.
<?php }
elseif($num == 0){ 
?>No hay ninguna beneficiario agregado a este proveedor.<?php } 
   
	if($id != 0){
	while($row=mysqli_fetch_array($result)){
		?>
        <?php echo $row['name']; ?><br>
	<?php }}
	
	
?> 

