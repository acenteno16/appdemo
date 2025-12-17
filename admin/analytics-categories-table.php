<?php 

include("sessions.php");

$company = $_POST['company'];
$from1 = $_POST['from'];
$from = date("Y-m-d", strtotime($from1));
$to1 = $_POST['to'];
$to = date("Y-m-d", strtotime($to1)); 
$category = $_POST['category'];


echo "<p style='font-size:14px;'>";
switch($company){
	case 0: 
	echo "<strong>Compañía:</strong> Todas las compañías <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1'";
	$currency = 1;
	break;
	case 1:
	echo "<strong>Compañía:</strong> Todas las compañías <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2'";
	$currency = 2;
	break;
	case 2:
	echo "<strong>Compañía:</strong> Todas las compañías <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3'";
	$currency = 3;
	break;
	case 3:
	echo "<strong>Compañía:</strong> Todas las compañías <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4'";
	$currency = 4;
	break;
	case 4:
	echo "<strong>Compañía:</strong> Casa Pellas <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1' and units.company = '1'";
	$currency = 1;
	break;
	case 5:
	echo "<strong>Compañía:</strong> Casa Pellas <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2' and units.company = '1'";
	$currency = 2;
	break;
	case 6:
	echo "<strong>Compañía:</strong> Casa Pellas <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3' and units.company = '1'";
	$currency = 3;
	break;
	case 7:
	echo "<strong>Compañía:</strong> Casa Pellas <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4' and units.company = '1'";
	$currency = 4;
	break;
	case 8:
	echo "<strong>Compañía:</strong> Alpesa <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1' and units.company = '2'";
	$currency = 1;
	break;
	case 9:
	echo "<strong>Compañía:</strong> Alpesa <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2' and units.company = '2'";
	$currency = 2;
	break;
	case 10:
	echo "<strong>Compañía:</strong> Alpesa <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3' and units.company = '2'";
	$currency = 3;
	break;
	case 11:
	echo "<strong>Compañía:</strong> Alpesa <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4' and units.company = '2'";
	$currency = 4;
	break;
	case 12:
	echo "<strong>Compañía:</strong> Velosa <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1' and units.company = '3'";
	$currency = 1;
	break;
	case 13:
	echo "<strong>Compañía:</strong> Velosa <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2' and units.company = '3'";
	$currency = 2;
	break;
	case 14:
	echo "<strong>Compañía:</strong> Velosa <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3' and units.company = '3'";
	$currency = 3;
	break;
	case 15:
	echo "<strong>Compañía:</strong> Velosa <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4' and units.company = '3'";
	$currency = 4;
	break;
	case 16:
	echo "<strong>Compañía:</strong> Otras Compañías <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1' and units.company > '3'";
	$currency = 1;
	break;
	case 17:
	echo "<strong>Compañía:</strong> Otras Compañías <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2' and units.company > '3'";
	$currency = 2;
	break;
	case 18:
	echo "<strong>Compañía:</strong> Otras Compañías <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3' and units.company > '3'";
	$currency = 3;
	break;
	case 19:
	echo "<strong>Compañía:</strong> Otras Compañías <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4' and units.company > '3'";
	$currency = 4;
	break; 
}

$sql2 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql2 = " and times.today >= '$from'";
	echo "<br><strong>Desde:</strong> ".$from1;
}
$sql3 = "";
if($to != ""){ 
	$to = date("Y-m-d", strtotime($to));
	$sql3 = " and times.today <= '$to'";
	echo "<br><strong>Hasta:</strong> ".$to1;
}
$sql4 = "";
if($category != ""){
	$sql4 = " and bills.concept = '$category'";
}

$sql = $sql1.$sql2.$sql3.$sql4;


$querypresidentconcepts1 = "select bills.ammount, bills.payment, bills.billdate, bills.currency, bills.nioammount from bills inner join times on bills.payment = times.payment inner join payments on payments.id = bills.payment inner join units on (payments.route = units.code or payments.route = units.code2) where times.stage = '14.00'".$sql;  

$resultpresidentconcepts1 = mysqli_query($con, $querypresidentconcepts1);  
$numpresidentconcepts1 = mysqli_num_rows($resultpresidentconcepts1); 

echo '<br><strong>Numero de facturas:</strong> '.number_format($numpresidentconcepts1,0);
while($rowpresidentconcepts1=mysqli_fetch_array($resultpresidentconcepts1)){
	if(($currency == 1) and ($rowpresidentconcepts1['currency'] == 2)){
		
		$ammount0+=$rowpresidentconcepts1[4]; 
		$ammount1+=$rowpresidentconcepts1[4]; 
		$fdollars++; 
	}else{
		$ammount0+=$rowpresidentconcepts1[0]; 
	}
} 
	
echo '<br><strong>Monto:</strong> '.str_replace('.00','',number_format($ammount0,2));
if($ammount1 > 0){
	echo '<br><strong>Facturas en dólares pagadas en cordobas:</strong> '.$fdollars; 
	echo '<br><strong>Monto U$ pagado en C$:</strong> '.str_replace('.00','',number_format($ammount1,2));
}

?>
<script>
function getTc(today) {
    $.ajaxSetup({async:false}); 

    var returnData = null;

    $.post("payment-order-tc.php", { today: today }, function(data) {

        returnData = data; 

    });

    $.ajaxSetup({async:true}); 
	return returnData;

} 
</script>