<?php include("sessions.php");

$id = $_POST['variable'];

$sqlcusers = "";
$querycusers = "select * from categoriesusers where worker='$_SESSION[userid]'";
$resultcusers = mysqli_query($con, $querycusers);
while($rowcusers=mysqli_fetch_array($resultcusers)){
	$sqlcusers.= " or (id = '$rowcusers[category]')";
}
if($sqlcusers == ''){
	$sql1 = " and userblock = 0";
}else{
	$sql1 = " and ((userblock = 0) ".$sqlcusers.")"; 
}


$query = "select * from categories where parentcat = '$id'".$sql1." order by account asc";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);      
?>
<option value="0"><?php if($id == 0){?> 
Esperando la selección de concepto para cargar la lista
<?php }
elseif($num == 0){ 
?>No hay ninguna opción disponible.<?php } else{ ?>Seleccionar <?php } ?></option>
    <?php if($id != 0){
	while($row=mysqli_fetch_array($result)){
		?>
        <option value="<?php echo $row['id']; ?>"><?php if($row['account'] != "") echo $row['account']." | "; ?><?php echo $row['name']; ?></option> 
	<?php }}
	
	
?>
