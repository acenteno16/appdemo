<?php include("sessions.php");

$today = $_POST['variable'];

$query = "select * from tc where today = '$today'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);      
?>
<?php if($num == 0){?> 
0
<?php }

   
	if($num > 0){
	
		?>
        <?php $row = mysqli_fetch_array($result);
		echo $row['tc']; ?>
	<?php }
	
	
?> 

