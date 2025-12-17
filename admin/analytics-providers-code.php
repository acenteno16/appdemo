<?php 

include("sessions.php"); 

$today = date('Y-m-d');

$from = $_POST['from'];
$to = $_POST['to'];
$company = $_POST['type'];
$sqldatea = 0;

$sqlfrom = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sqlfrom = " and times.today >= '$from'";
	$sqldatea = 1;
}
$sqlto = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sqlto = " and times.today <= '$to'";
	$sqldatea = 1;
}

$sqldate = $sqlfrom.$sqlto;


echo "<p style='font-size:14px;'>";
switch($company){
	case 0:
	echo "Todas las compañías (NIO)";
	$sql = " and payments.currency = '1'";
	break;
	case 1:
	echo "Todas las compañías (USD)";
	$sql = " and payments.currency = '2'";
	break;
	case 2:
	echo "Todas las compañías (EUR)";
	$sql = " and payments.currency = '3'";
	break;
	case 3:
	echo "Todas las compañías (YEN)";
	$sql = " and payments.currency = '4'";
	break;
	case 4:
	echo "Casa Pellas (NIO)";
	$sql = " and payments.currency = '1' and payments.company = '1'";
	break;
	case 5:
	echo "Casa Pellas (USD)";
	$sql = " and payments.currency = '2' and payments.company = '1'";
	break;
	case 6:
	echo "Casa Pellas (EUR)";
	$sql = " and payments.currency = '3' and payments.company = '1'";
	break;
	case 7:
	echo "Casa Pellas (YEN)";
	$sql = " and payments.currency = '4' and payments.company = '1'";
	break;
	case 8:
	echo "Alpesa (NIO)";
	$sql = " and payments.currency = '1' and payments.company = '2'";
	break;
	case 9:
	echo "Alpesa (USD)";
	$sql = " and payments.currency = '2' and payments.company = '2'";
	break;
	case 10:
	echo "Alpesa (EUR)";
	$sql = " and payments.currency = '3' and payments.company = '2'";
	break;
	case 11:
	echo "Alpesa (YEN)";
	$sql = " and payments.currency = '4' and payments.company = '2'";
	break;
	case 12:
	echo "Velosa (NIO)";
	$sql = " and payments.currency = '1' and payments.company = '3'";
	break;
	case 13:
	echo "Velosa (USD)";
	$sql = " and payments.currency = '2' and payments.company = '3'";
	break;
	case 14:
	echo "Velosa (EUR)";
	$sql = " and payments.currency = '3' and payments.company = '3'";
	break;
	case 15:
	echo "Velosa (YEN)";
	$sql = " and payments.currency = '4' and payments.company = '3'";
	break;
	case 16:
	echo "Otras Compañías (NIO)";
	$sql = " and payments.currency = '1' and payments.company > '3'";
	break;
	case 17:
	echo "Otras Compañías (USD)";
	$sql = " and payments.currency = '2' and payments.company > '3'";
	break;
	case 18:
	echo "Otras Compañías (EUR)";
	$sql = " and payments.currency = '3' and payments.company > '3'";
	break;
	case 19:
	echo "Otras Compañías (YEN)";
	$sql = " and payments.currency = '4' and payments.company > '3'";
	break; 
}
echo '<br><a href="analytics-providers-code-export.php?type='.$company.'&from='.$from.'&to='.$to.'&provider='.$pro.'" target="blank">[Exportar Solicitudes]</a> <a href="analytics-providers-code-export2.php?type='.$company.'&from='.$from.'&to='.$to.'&provider='.$pro.'&limit=500" target="blank">[Exportar Global]</a> <a href="analytics-providers-code-export3.php?type='.$company.'&from='.$from.'&to='.$to.'&provider='.$pro.'" target="blank">[Exportar Categorizado]</a>';  
echo "</p><br>";

 
$today = date('Y-m-d');
$querypresidentprovider1 = "select sum(payments.payment), payments.provider, payments.currency from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on (payments.route = units.code or payments.route = units.code2) where payments.btype = '1' and times.stage = '14'".$sql.$sqldate." group by payments.provider order by sum(payments.payment) desc limit 10";
$querypresidentprovider1 = "select sum(payments.payment), payments.provider, payments.currency from payments inner join times on payments.id = times.payment where payments.btype = '1' and times.stage = '14'".$sql.$sqldate." group by payments.provider order by sum(payments.payment) desc limit 10"; 

$resultpresidentprovider1 = mysqli_query($con, $querypresidentprovider1);  
$numpresidentprovider1 = mysqli_num_rows($resultpresidentprovider1);
while($rowpresidentprovider1=mysqli_fetch_array($resultpresidentprovider1)){
									
$querypresidentprovider2 = "select * from providers where id = '$rowpresidentprovider1[1]'";
$resultpresidentprovider2 = mysqli_query($con, $querypresidentprovider2);
$rowpresidentprovider2 = mysqli_fetch_array($resultpresidentprovider2);
$querypresidentprovider3 = "select * from currency where id = $rowpresidentprovider1[2]";
$resultpresidentprovider3 = mysqli_query($con, $querypresidentprovider3);
$rowpresidentprovider3 = mysqli_fetch_array($resultpresidentprovider3);

$presidentproviders .= '["<a onClick='."'providersTable(".$rowpresidentprovider2['id'].");'".'>'.$rowpresidentprovider2['name'].'<br>'.str_replace('.00','',number_format($rowpresidentprovider1[0],2)).'</a>", '.str_replace('.00','',$rowpresidentprovider1[0]).'],'; 

 
} 
 $presidentproviders = substr($presidentproviders, 0,-1);
?>
<script type="text/javascript">

	$(function() {

		var data = [ <?php echo $presidentproviders; ?> ];

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
			},
			colors: ["#26afe4"],
		});

		// Add the Flot version string to the footer

		//$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});

	</script>
   <div class="demo-container">
			<div id="placeholder" class="demo-placeholder"></div>
</div>