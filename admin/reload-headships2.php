<?php include("sessions.php");

$id = $_POST['variable']; 

$query = "select * from routes where headship > 0 and unit = '$id' group by headship";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);       
?>

<option value="0">Primaria</option><?php while($row=mysqli_fetch_array($result)){
	
	$queryname = "select * from headship where id = '$row[headship]'";
	$resultname = mysqli_query($con, $queryname);
	$rowname = mysqli_fetch_array($resultname); 
?>
<option value="<?php echo $row['headship']; ?>"><?php echo $rowname['name']; ?></option> 
<?php }
?> 

