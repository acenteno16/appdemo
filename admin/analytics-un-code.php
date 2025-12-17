<?php 

include("sessions.php");

$company = $_POST['company'];
$from1 = $_POST['from'];
$from = date("Y-m-d", strtotime($from1));
$to1 = $_POST['to'];
$to = date("Y-m-d", strtotime($to1)); 
$currency = $_POST['currency'];

echo "<p style='font-size:14px;'>";

$queryunit = "select * from units where code = '$company'";
$resultunit = mysqli_query($con, $queryunit);
$rowunit = mysqli_fetch_array($resultunit);

switch($currency){
		case 1:
		$cur = "Córdobas";
		break;
		case 2:
		$cur = "Dólares";
		break;
		case 3:
		$cur = "Euros";
		break;
		case 4:
		$cur = "Yenes";
		break;
}
echo "<strong>UN:</strong> ".$rowunit['code']." | ".$rowunit['name']."<br>
<strong>Moneda:</strong> ".$cur; 
$sql1 = " and payments.currency = '1'";

	
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

$sql = $sql1.$sql2.$sql3;
 

$querytype = "select bills.ammount, bills.type, payments.currency, bills.currency, bills.nioammount, bills.tc from bills inner join times on bills.payment = times.payment inner join payments on bills.payment = payments.id inner join categories on categories.id = bills.type  inner join units on (payments.route = units.code or payments.route = units.code2) where times.stage = '14.00' and categories.parentcat = '1'".$sql." group by bills.id";
$resulttype = mysqli_query($con, $querytype);   
$numtype = mysqli_num_rows($resulttype);

while($rowtype=mysqli_fetch_array($resulttype)){
									
	//Si el pago esta en NIO
	if($rowtype[2] == 1){
		//Si la factura esta en NIO
		if($rowtype[3] == 2){
			$billammount[$rowtype[1]]+=$rowtype[0]*$rowtype[5];
			
		}
		//Si no esta en NIO convertimos a la taza de cambio
		else{
			$billammount[$rowtype[1]]+=$rowtype[0]; 
		} 
	}
	else{
		$billammount[$rowtype[1]]+=$rowtype[0]; 
	}
 
} 

arsort($billammount);
$presidentconceptss = "";
foreach ($billammount as $container => $value){
	// echo "$indice = $valor<br>"; 
		
	$queryname = "select * from categories where id = '$container'";
	$resultname = mysqli_query($con, $queryname);
	$rowname = mysqli_fetch_array($resultname); 
	
	$thevalue = $value; 
	$thevalue2 = $pre.str_replace('.00','',number_format($value,2));
		
    $presidentconceptss .= '["<a onClick='."'showCategories(".$container.");'".'>'.$rowname['name'].'<br>'.$thevalue2.'</a>", '.$thevalue.'],'; 

 
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
			},
			colors: ["#26afe4"],
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
    <br>

<h3>Tios:</h3>  <br>       
   <div class="demo-container">
			<div id="placeholder" class="demo-placeholder"></div>
		</div> 