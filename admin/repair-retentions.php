<?php //Repair Retentions
/*
include("../connection.php"); 

$query = "select * from payments";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	$ammount = $row['ammount'];
	$ret1 = $row['ret1'];
	$ret2 = $row['ret2'];
		
	if($row['currency'] == 1){
		//Pagos en cordobas
		$ret1a = $ammount*($ret1/100);
		$payment2 = $ammount-$ret1a;
		echo "Pago: ".$row['id']." <br>Monto: ".$ammount." <br>Retencion: ".$ret1."<br>Retener: ".$ret1a." <br>Payment: ".$payment2."<br><br>";
	}
	elseif($row['currency'] == 2){
		//
	}
	
}*/

?>