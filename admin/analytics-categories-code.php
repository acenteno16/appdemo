<?php 

include("sessions.php");

$company = $_POST['company'];
$from1 = $_POST['from'];
$from = date("Y-m-d", strtotime($from1));
$to1 = $_POST['to'];
$to = date("Y-m-d", strtotime($to1)); 



echo "<p style='font-size:14px;'>";
switch($company){
	case 0: 
	echo "<strong>Compañía:</strong> Todas las compañías <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1'";
	break;
	case 1:
	echo "<strong>Compañía:</strong> Todas las compañías <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2'";
	break;
	case 2:
	echo "<strong>Compañía:</strong> Todas las compañías <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3'";
	break;
	case 3:
	echo "<strong>Compañía:</strong> Todas las compañías <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4'";
	break;
	case 4:
	echo "<strong>Compañía:</strong> Casa Pellas <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1' and units.company = '1'";
	break;
	case 5:
	echo "<strong>Compañía:</strong> Casa Pellas <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2' and units.company = '1'";
	break;
	case 6:
	echo "<strong>Compañía:</strong> Casa Pellas <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3' and units.company = '1'";
	break;
	case 7:
	echo "<strong>Compañía:</strong> Casa Pellas <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4' and units.company = '1'";
	break;
	case 8:
	echo "<strong>Compañía:</strong> Alpesa <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1' and units.company = '2'";
	break;
	case 9:
	echo "<strong>Compañía:</strong> Alpesa <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2' and units.company = '2'";
	break;
	case 10:
	echo "<strong>Compañía:</strong> Alpesa <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3' and units.company = '2'";
	break;
	case 11:
	echo "<strong>Compañía:</strong> Alpesa <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4' and units.company = '2'";
	break;
	case 12:
	echo "<strong>Compañía:</strong> Velosa <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1' and units.company = '3'";
	break;
	case 13:
	echo "<strong>Compañía:</strong> Velosa <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2' and units.company = '3'";
	break;
	case 14:
	echo "<strong>Compañía:</strong> Velosa <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3' and units.company = '3'";
	break;
	case 15:
	echo "<strong>Compañía:</strong> Velosa <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4' and units.company = '3'";
	break;
	case 16:
	echo "<strong>Compañía:</strong> Otras Compañías <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1' and units.company > '3'";
	break;
	case 17:
	echo "<strong>Compañía:</strong> Otras Compañías <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2' and units.company > '3'";
	break;
	case 18:
	echo "<strong>Compañía:</strong> Otras Compañías <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3' and units.company > '3'";
	break;
	case 19:
	echo "<strong>Compañía:</strong> Otras Compañías <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4' and units.company > '3'";
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
if($provider != ""){
	$sql4 = " and payments.provider = '$provider'";
}
$sql = $sql1.$sql2.$sql3.$sql4;


$querypresidentconcepts1 = "select sum(bills.ammount), bills.concept from bills inner join times on bills.payment = times.payment inner join payments on payments.id = bills.payment inner join units on (payments.route = units.code or payments.route = units.code2) where bills.id > '0'".$sql." group by bills.concept order by sum(bills.ammount) desc limit 10";  

$resultpresidentconcepts1 = mysqli_query($con, $querypresidentconcepts1);  
$numpresidentconcepts1 = mysqli_num_rows($resultpresidentconcepts1);
while($rowpresidentconcepts1=mysqli_fetch_array($resultpresidentconcepts1)){ 
									
$querypresidentconcepts2 = "select * from categories where id = '$rowpresidentconcepts1[1]'";
$resultpresidentconcepts2 = mysqli_query($con, $querypresidentconcepts2);
$rowpresidentconcepts2 = mysqli_fetch_array($resultpresidentconcepts2);

$presidentconceptss .= '["'.$rowpresidentconcepts2['name'].'", '.str_replace('.00','',$rowpresidentconcepts1[0]).'],';

 
} 
 $presidentconceptss = substr($presidentconceptss, 0,-1);
?>
 
	<script type="text/javascript"> 
	$(function() {

		var data = [ <?php echo $presidentconceptss; ?> ];

		$.plot("#placeholder", [ data ], {
			series: {
				bars: {
					show: true,
					barWidth: 0.6,
					align: "center"
				}
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			},
			grid: {
				borderColor: "#FFFFFF"
			}
		});

		// Add the Flot version string to the footer

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});
	</script>
    <style type="text/css"> 
	
	.demo-placeholder {
		width: 100%;
		height: 100%;
		font-size: 14px;
		line-height: 1.2em;
	}
	.demo-container {
		position: relative;
		height: 280px;
	}
	#description {
		margin: 15px 10px 20px 10px;
	}
	</style>        
   <div class="demo-container">
			<div id="placeholder" class="demo-placeholder"></div>
		</div>