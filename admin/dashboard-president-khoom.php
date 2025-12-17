<?php include("sessions.php");

//$today = date('Y-m-d');
//$thisweek = ">= CURDATE() - INTERVAL CASE WEEKDAY(CURDATE()) WHEN 6 THEN -1 ELSE WEEKDAY(CURDATE()) END + 1 DAY";
//$thisyear = ">= MAKEDATE(YEAR(CURDATE()), 1)";

$company = $_POST['company'];

$from = $_POST['from'];
$from = date("Y-m-d", strtotime($from));
$to = $_POST['to'];
$to = date("Y-m-d", strtotime($to)); 



echo "<p style='font-size:14px;'>";
switch($company){
	case 0: 
	echo "Todas las compañías (NIO)";
	$sql = " and payments.currency = 1";
	break;
	case 1:
	echo "Todas las compañías (USD)";
	$sql = " and payments.currency = 2";
	break;
	case 2:
	echo "Todas las compañías (EUR)";
	$sql = " and payments.currency = 3";
	break;
	case 3:
	echo "Todas las compañías (YEN)";
	$sql = " and payments.currency = 4";
	break;
	case 4:
	echo "Casa Pellas (NIO)";
	$sql = " and payments.currency = 1 and units.company = 1";
	break;
	case 5:
	echo "Casa Pellas (USD)";
	$sql = " and payments.currency = 2 and units.company = 1";
	break;
	case 6:
	echo "Casa Pellas (EUR)";
	$sql = " and payments.currency = 3 and units.company = 1";
	break;
	case 7:
	echo "Casa Pellas (YEN)";
	$sql = " and payments.currency = 4 and units.company = 1";
	break;
	case 8:
	echo "Alpesa (NIO)";
	$sql = " and payments.currency = 1 and units.company = 2";
	break;
	case 9:
	echo "Alpesa (USD)";
	$sql = " and payments.currency = 2 and units.company = 2";
	break;
	case 10:
	echo "Alpesa (EUR)";
	$sql = " and payments.currency = 3 and units.company = 2";
	break;
	case 11:
	echo "Alpesa (YEN)";
	$sql = " and payments.currency = 4 and units.company = 2";
	break;
	case 12:
	echo "Velosa (NIO)";
	$sql = " and payments.currency = 1 and units.company = 3";
	break;
	case 13:
	echo "Velosa (USD)";
	$sql = " and payments.currency = 2 and units.company = 3";
	break;
	case 14:
	echo "Velosa (EUR)";
	$sql = " and payments.currency = 3 and units.company = 3";
	break;
	case 15:
	echo "Velosa (YEN)";
	$sql = " and payments.currency = 4 and units.company = 3";
	break;
	case 16:
	echo "Otras Compañías (NIO)";
	$sql = " and payments.currency = 1 and units.company > 3";
	break;
	case 17:
	echo "Otras Compañías (USD)";
	$sql = " and payments.currency = 2 and units.company > 3";
	break;
	case 18:
	echo "Otras Compañías (EUR)";
	$sql = " and payments.currency = 3 and units.company > 3";
	break;
	case 19:
	echo "Otras Compañías (YEN)";
	$sql = " and payments.currency = 4 and units.company > 3";
	break; 
}
echo "</p><br>";
$querypresidentconcepts1 = "select sum(payments.payment), payments.concept2 from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on payments.route = units.code where payments.concept = 27 and times.stage = '14' and payments.currency = '1' and times.today ".$thisweek.$sql." group by payments.concept2 order by sum(payments.payment) desc limit 10"; 

$querypresidentconcepts1 = "select sum(bills.ammount), bills.concept2 from bills inner join times on bills.payment = times.payment inner join payments on payments.id = bills.payment inner join units on payments.route = units.code where times.today >= '$from' and times.today <= '$to' ".$sql." group by bills.concept2 order by sum(bills.ammount) desc limit 10";   

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

		$.plot("#concepts2", [ data ], {
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
   <div class="demo-container">
			<div id="concepts2" class="demo-placeholder"></div>
		</div>