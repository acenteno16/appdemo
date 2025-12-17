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

$querypresidentconcepts1 = "select sum(payments.payment), payments.concept2 from payments inner join workers on payments.userid = workers.code where payments.concept = '27' and payments.status = '14'".$sql." group by payments.concept2 order by sum(payments.payment) desc limit 10";
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