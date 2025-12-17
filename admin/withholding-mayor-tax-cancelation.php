<?php include("session-withholding.php"); 

$id = $_POST['theid'];


for($c=0;$c<sizeof($id);$c++){
	
	$query = "update payments set mayorstage='4' where id = '$id[$c]'";
	$result = mysqli_query($con, $query); 
	
}

header('location: withholding-mayor-tax.php?mayorstage=3'); 

?>