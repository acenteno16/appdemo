<?php include("session-request.php"); 

$id = $_POST['variable'];

$query = "select * from beneficiaries where provider = '$id'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);      
if($num > 0){ ?>
<option value="0"><?php if($id == 0){?> 
Seleccionar Beneficiario
<?php }
elseif($num == 0){ 
?>Sin Beneficiario<?php } else{ ?>Sin beneficiario <?php } ?></option>
    <?php if($id != 0){
	while($row=mysqli_fetch_array($result)){
		?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option> 
	<?php }}
	
} 
?>