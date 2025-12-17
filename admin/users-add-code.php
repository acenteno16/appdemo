<?php include("sessions.php");

$password = "";
$longitud = 6; 
for ($i=1; $i<=$longitud; $i++){
	//$letra = chr(rand(97,122));
	$letra = rand(0,9);
	$password .= $letra;  
} 
$password = md5($codigo);

$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$compay = $_POST['company'];
$code = $_POST['code'];
$unit = $_POST['unit'];
$nid = $_POST['nid'];
$unitid = $_POST['unitid']; 

$queryf = "select * from workers where code = '$_POST[code]'";
$resultf = mysqli_query($con, $queryf);
$numf = mysqli_num_rows($resultf);

if($numf == 0){
	
	$query = "insert into workers (first, last, email, company, unit, code, password, currency, nid) values ('$first', '$last', '$email', '$compay', '$unit', '$code', '$password', '2', '$nid')"; 
	$result = mysqli_query($con, $query);
	$id = mysqli_insert_id($con);

	header("location: users-edit.php?id=".$id);
	
}else{ ?>
<script type="text/javascript">
alert('Ya existe un colaborador agregado con el codigo <?php echo $_POST['code']; ?>.');
history.go(-1);
</script>    
<?php } ?>