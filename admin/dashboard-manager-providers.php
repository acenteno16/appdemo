<?php include("sessions.php"); 

$today = date('Y-m-d');

$company = $_POST['company'];
echo "<p style='font-size:14px;'>";
switch($company){
	case 0:
	echo "Cordobas";
	$sql = " and payments.currency = '1'";
	break;
	case 1:
	echo "Dólares";
	$sql = " and payments.currency = '2'";
	break;
	case 2:
	echo "Euros";
	$sql = " and payments.currency = '3'";
	break;
	case 3:
	echo "Yenes";
	$sql = " and payments.currency = '4'";
	break;
}
echo "</p><br>";
 
$today = date('Y-m-d'); 
$querypresidentprovider1 = "select sum(payments.payment), payments.provider, payments.currency from payments inner join workers on payments.userid = workers.code where payments.status = '14'".$sql." and workers.unit = '$_SESSION[unit]' and WEEK('$today') group by provider order by sum(payment) desc limit 10";
$resultpresidentprovider1 = mysqli_query($con, $querypresidentprovider1);  
$numpresidentprovider1 = mysqli_num_rows($resultpresidentprovider1);
while($rowpresidentprovider1=mysqli_fetch_array($resultpresidentprovider1)){
									
$querypresidentprovider2 = "select * from providers where id = '$rowpresidentprovider1[1]'";
$resultpresidentprovider2 = mysqli_query($con, $querypresidentprovider2);
$rowpresidentprovider2 = mysqli_fetch_array($resultpresidentprovider2);
$querypresidentprovider3 = "select * from currency where id = $rowpresidentprovider1[2]";
$resultpresidentprovider3 = mysqli_query($con, $querypresidentprovider3);
$rowpresidentprovider3 = mysqli_fetch_array($resultpresidentprovider3);

$presidentproviders .= '["'.$rowpresidentprovider2['name'].'", '.str_replace('.00','',$rowpresidentprovider1[0]).'],';

 
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
			}
		});

		// Add the Flot version string to the footer

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});

	</script>
   <div class="demo-container">
			<div id="placeholder" class="demo-placeholder"></div>
		</div>
  