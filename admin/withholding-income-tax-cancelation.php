<?php include("session-withholding.php"); 

$id = $_POST['theid'];

for($c=0;$c<sizeof($id);$c++){
	
	$query = "update payments set irstage='4' where id = '$id[$c]'";
	$result = mysqli_query($con, $query); 
	
}

header('location: withholding-income-tax.php?irstage=3'); 

?>