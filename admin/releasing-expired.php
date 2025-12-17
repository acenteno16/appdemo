<?
/*
include("sessions.php");

$querycount = "select payments.expiration from payments inner join providers on payments.provider = providers.id where payments.status = '8' and payments.aprovision = '1' and payments.approved = '1' group by payments.id"; 
   
$resultcount = mysqli_query($con, $querycount);
echo 'Global:'.$numcount = mysqli_num_rows($resultcount); 
while($rowcount=mysqli_fetch_array($resultcount)){
	
	$date1 = date("Y-m-d");
	$date2 = date('d-m-Y',strtotime($rowcount['expiration']));
							
	$dias = (strtotime($date1)-strtotime($date2))/86400;
	
	if($dias <= -10){
		$corrientes++;
	}
	if(($dias < 0) and ($dias >= -9)){
		$porvencerse++;
	}
	elseif($dias >= 0){
		$vencidos++;
	} 
	

	
}

echo "<br>
Vencidos: ".$vencidos."<br>
Por vencerse: ".$porvencerse."<br>
Sin vencerse: ".$corrientes;
*/ 
?>