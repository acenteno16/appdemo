<?php 

include("sessions.php");
$id = $_POST['variable'];
$query = "select * from accountingCategories where parent = '$id' order by name asc";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);      
?>
<option value="0"><?php if($id == 0){?>
Esperando la selección de concepto para cargar la lista
<?php } elseif($num == 0){ ?> No hay ninguna opción disponible. <?php } else{ ?>Seleccionar<?php } ?>
</option>
<?php if($id != 0){ while($row=mysqli_fetch_array($result)){?>
<option value="<?php echo $row['id']; ?>"><?php if($row['account'] != "") echo $row['account']." | "; ?><?php echo ucfirst($row['name']); ?></option> 
<?php } } ?>