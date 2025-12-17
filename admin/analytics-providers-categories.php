<? 


include("sessions.php"); 

$today = date('Y-m-d'); 
$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

	 
$company = $_POST['type'];
$from = $_POST['from'];
$to = $_POST['to'];
$provider = $_POST['provider'];
$queryprovider = "select * from providers where id = '$provider'";
$resultprovider = mysqli_query($con, $queryprovider);
$rowprovider = mysqli_fetch_array($resultprovider);

switch($company){
	case 0:
	$sql1 = " and payments.currency = 1";
	break;
	case 1:
	$sql1 = " and payments.currency = 2";
	break;
	case 2:
	$sql1 = " and payments.currency = 3";
	break;
	case 3:
	$sql1 = " and payments.currency = 4";
	break;
	case 4:
	$sql1 = " and payments.currency = 1 and units.company = 1";
	break;
	case 5:
	$sql1 = " and payments.currency = 2 and units.company = 1";
	break;
	case 6:
	$sql1 = " and payments.currency = 3 and units.company = 1";
	break;
	case 7:
	$sql1 = " and payments.currency = 4 and units.company = 1";
	break;
	case 8:
	$sql1 = " and payments.currency = 1 and units.company = 2";
	break;
	case 9:
	$sql1 = " and payments.currency = 2 and units.company = 2";
	break;
	case 10:
	$sql1 = " and payments.currency = 3 and units.company = 2";
	break;
	case 11:
	$sql1 = " and payments.currency = 4 and units.company = 2";
	break;
	case 12:
	$sql1 = " and payments.currency = 1 and units.company = 3";
	break;
	case 13:
	$sql1 = " and payments.currency = 2 and units.company = 3";
	break;
	case 14:
	$sql1 = " and payments.currency = 3 and units.company = 3";
	break;
	case 15:
	$sql1 = " and payments.currency = 4 and units.company = 3";
	break;
	case 16:
	$sql1 = " and payments.currency = 1 and units.company > 3";
	break;
	case 17:
	$sql1 = " and payments.currency = 2 and units.company > 3";
	break;
	case 18:
	$sql1 = " and payments.currency = 3 and units.company > 3";
	break;
	case 19:
	$sql1 = " and payments.currency = 4 and units.company > 3";
	break;
}

$sql2 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql2 = " and times.today >= '$from'";
}
$sql3 = "";
if($to != ""){ 
	$to = date("Y-m-d", strtotime($to));
	$sql3 = " and times.today <= '$to'";
}
$sql4 = "";
if($provider != ""){
	$sql4 = " and payments.provider = '$provider'";
}
$sql = $sql1.$sql2.$sql3.$sql4;


echo '<div class="portlet"><div class="portlet-title"><div class="caption">Rubros de gastos</div></div></div>'; 

$querypresidentconcepts1 = "select bills.ammount, bills.concept from bills inner join payments on bills.payment = payments.id where payments.provider = '$provider' group by bills.concept";       
$resultpresidentconcepts1 = mysqli_query($con, $querypresidentconcepts1);  
echo '<br>Num: '.$numpresidentconcepts1 = mysqli_num_rows($resultpresidentconcepts1);
while($rowpresidentconcepts1=mysqli_fetch_array($resultpresidentconcepts1)){
									
$querypresidentconcepts2 = "select * from categories where id = '$rowpresidentconcepts1[concept]'";
$resultpresidentconcepts2 = mysqli_query($con, $querypresidentconcepts2);
$rowpresidentconcepts2 = mysqli_fetch_array($resultpresidentconcepts2);

$presidentconceptss .= '["'.$rowpresidentconcepts2['name'].'", '.str_replace('.00','',$rowpresidentconcepts1[0]).'],';

 
} 
 $presidentconceptss = substr($presidentconceptss, 0,-1);
?>
    <script type="text/javascript">
	$(function() {

		var data = [ <?php echo $presidentconceptss; ?> ];

		$.plot("#providers_categories2", [ data ], {
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

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});
	</script>
   
   <div class="demo-container">
<div id="providers_categories2" class="demo-placeholder"></div>
</div></div>
