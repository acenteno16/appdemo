<?php include("sessions.php");

$billammount = str_replace(',','',$_POST['ammount']);
$usdbilltax = str_replace(',','',$_POST['billtax']);
$today = date("Y-m-d", strtotime($_POST['billdate']));
$process = $_POST['process']; 


$query = "select * from tc where today = '$today'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
      
if($num > 0){
	$row = mysqli_fetch_array($result);
	$tc = $row['tc'];
	
	
		
	
		switch($process){
			case 1:
			//Subtototal en cordobas que se puede retener
			//Convierte el monto a la tasa de cambio
			$ammount = $billammount*$tc;
			
			if($ammount >= 1000){
				//Convierte el tax a la tasa de cambio
				//$tax = $usdbilltax*$tc;
				//regala el subtotal
				//Como ahora lo que recoibimos es el Sub-total ya no necesitamos
				//$ammount2 = $ammount-$tax;
				echo str_replace(',','',number_format($ammount,2)); 
				//$usdbilltax;
			}else{
				echo 0;
			}
			break;
			case 2:
			//Subtotal en cordobas global
			//Convierte el monto a la tasa de cambio
			$ammount = $billammount*$tc;
			//Convierte el tax a la tasa de cambio
			$tax = $usdbilltax*$tc;
			//regala el subtotal
			$ammount2 = $ammount-$tax;
			echo str_replace(',','',number_format($ammount2,4));
			break;
			case 3:
			//Solo convierte el monto a la tasa de cambio
			$ammount = $billammount*$tc; 
			echo str_replace(',','',number_format($ammount,4));
			break;
			case 4: 
			//Subtototal en dólares que se puede retener
			//Convierte el monto a la tasa de cambio
			$ammount = $billammount*$tc;
			if($ammount >= 1000){
				//Convierte el tax a la tasa de cambio
				//$tax = $usdbilltax*$tc;
				//regala el subtotal
				//$ammount2 = $ammount-$tax;
				$ammount2 = $ammount/$tc;
				echo str_replace(',','',number_format($ammount2,4)); 
				//$usdbilltax;
			}else{
				echo 0;
			}
			break;
			
		} 
		

	

}else{
	
	echo "0";
	
}