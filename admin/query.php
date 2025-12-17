<?php include("sessions.php"); 

$year = date('Y');
$month = date('m');
								 

$today = date('Y-m-d');
		echo $query = "select count() as GroupAmount from payments where currency = 2 and approved = 1 and status < 14";
		$result = mysqli_query($con, $query);  
		echo '<br>Num: '.$num = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
		
		
		echo '<br> Var: '.$row[2];
		?>