<?php

/*

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s'); 
$now2 = date('H:i:s');

include('sessions.php');

$query = "select payments.* from payments inner join schedulecontent on payments.id = schedulecontent.payment inner join schedule on schedulecontent.schedule = schedule.id where payments.status > '13' and schedule.status>'5' and payments.ret2a > '0' and payments.ret2id = '0'";
$result = mysqli_query($con, $query);
echo "Number of rows: ".$num = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){
	
	$sqlret = "";
		
		if($row['ret2a'] > 0){
			
			$queryret = "insert into irretention (today, now, payment) values ('$today', '$now', '$row[payment]')";
			$resultret = mysqli_query($con, $queryret); 
			$idret = mysqli_insert_id($con);
			$sqlret = ", irstage = '1'";	
			
			//UPDATE DEL PAGO 
			echo "<br>".$queryapprove = "update payments set ret2id='$idret', irstage = '1' where id = '$row[id]'"; 
			$resultapprove = mysqli_query($con, $queryapprove); 
		
		}else{
			$idret = 0;
		}
			 
	
} 

*/

?>