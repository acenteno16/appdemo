<?php 

include("sessions.php");

$company = $_POST['company'];
$from1 = $_POST['from'];
$from = date("Y-m-d", strtotime($from1));
$to1 = $_POST['to'];
$to = date("Y-m-d", strtotime($to1)); 
$type = $_POST['type']; 

echo "<p style='font-size:14px;'>";
switch($company){
	case 0: 
	echo "<strong>Compañía:</strong> Todas las compañías <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1'";
	$pre = "C$";
	break;
	case 1:
	echo "<strong>Compañía:</strong> Todas las compañías <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2'";
	$pre = "U$";
	break;
	case 2:
	echo "<strong>Compañía:</strong> Todas las compañías <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3'";
	$pre = "&euro;";
	break;
	case 3:
	echo "<strong>Compañía:</strong> Todas las compañías <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4'";
	$pre = "&yen;";
	break;
	case 4:
	echo "<strong>Compañía:</strong> Casa Pellas <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1' and units.company = '1'";
	$pre = "C$";
	break;
	case 5:
	echo "<strong>Compañía:</strong> Casa Pellas <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2' and units.company = '1'";
	$pre = "U$";
	break;
	case 6:
	echo "<strong>Compañía:</strong> Casa Pellas <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3' and units.company = '1'";
	$pre = "&euro;";
	break;
	case 7:
	echo "<strong>Compañía:</strong> Casa Pellas <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4' and units.company = '1'";
	$pre = "&yen;";
	break;
	case 8:
	echo "<strong>Compañía:</strong> Alpesa <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1' and units.company = '2'";
	$pre = "C$";
	break;
	case 9:
	echo "<strong>Compañía:</strong> Alpesa <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2' and units.company = '2'";
	$pre = "U$";
	break;
	case 10:
	echo "<strong>Compañía:</strong> Alpesa <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3' and units.company = '2'";
	$pre = "&euro;";
	break;
	case 11:
	echo "<strong>Compañía:</strong> Alpesa <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4' and units.company = '2'";
	$pre = "&yen;";
	break;
	case 12:
	echo "<strong>Compañía:</strong> Velosa <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1' and units.company = '3'";
	$pre = "C$";
	break;
	case 13:
	echo "<strong>Compañía:</strong> Velosa <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2' and units.company = '3'";
	$pre = "U$";
	break;
	case 14:
	echo "<strong>Compañía:</strong> Velosa <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3' and units.company = '3'";
	$pre = "&euro;";
	break;
	case 15:
	echo "<strong>Compañía:</strong> Velosa <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4' and units.company = '3'";
	$pre = "&yen;";
	break;
	case 16:
	echo "<strong>Compañía:</strong> Otras Compañías <br><strong>Moneda:</strong> (NIO)";
	$sql1 = " and payments.currency = '1' and units.company > '3'";
	$pre = "C$";
	break;
	case 17:
	echo "<strong>Compañía:</strong> Otras Compañías <br><strong>Moneda:</strong> (USD)";
	$sql1 = " and payments.currency = '2' and units.company > '3'";
	$pre = "U$";
	break;
	case 18:
	echo "<strong>Compañía:</strong> Otras Compañías <br><strong>Moneda:</strong> (EUR)";
	$sql1 = " and payments.currency = '3' and units.company > '3'";
	$pre = "&euro;";
	break;
	case 19:
	echo "<strong>Compañía:</strong> Otras Compañías <br><strong>Moneda:</strong> (YEN)";
	$sql1 = " and payments.currency = '4' and units.company > '3'";
	$pre = "&yen;";
	break; 
}

$sql2 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql2 = " and times.today >= '$from'";
	//echo "<br><strong>Desde:</strong> ".$from1;
}
$sql3 = "";
if($to != ""){ 
	$to = date("Y-m-d", strtotime($to));
	$sql3 = " and times.today <= '$to'";
	//echo "<br><strong>Hasta:</strong> ".$to1;
}

$sql = $sql1.$sql2.$sql3;
 

//echo '<br><strong>Query:</strong> '.
$querytype2 = "select bills.ammount, bills.concept, payments.currency, bills.currency, bills.nioammount, bills.tc from bills inner join times on bills.payment = times.payment inner join payments on bills.payment = payments.id inner join categories on categories.id = bills.type  inner join units on (payments.route = units.code or payments.route = units.code2) where times.stage = '14.00' and bills.type = '$type'".$sql." group by bills.id";    
$resulttype2 = mysqli_query($con, $querytype2);   
//echo '<br><strong>Bills:</strong> '.
$numtype2 = mysqli_num_rows($resulttype2);
unset($billammount2);
$billammount2 = array();

while($rowtype2=mysqli_fetch_array($resulttype2)){
									
	//Si el pago esta en NIO
	if($rowtype2[2] == 1){
		//Si la factura esta en NIO
		if($rowtype2[3] == 2){
			$billammount2[$rowtype2[1]]+=$rowtype2[0]*$rowtype2[5];
			
		}
		//Si no esta en NIO convertimos a la taza de cambio
		else{
			$billammount2[$rowtype2[1]]+=$rowtype2[0]; 
		} 
	}
	else{
		$billammount2[$rowtype2[1]]+=$rowtype2[0]; 
	}
 
} 

arsort($billammount2);
//echo "<br><strong>Size of categories:</strong> ".sizeof($billammount2);
foreach ($billammount2 as $container => $value){
	// echo "$indice = $valor<br>"; 
		
	$queryname = "select * from categories where id = '$container'";
	$resultname = mysqli_query($con, $queryname);
	$rowname = mysqli_fetch_array($resultname); 
	
	$thevalue = $value;
	$thevalue2 = $pre.str_replace('.00','',number_format($value,2));
		
    $strcategories .= '["<a onClick='."'showCategories2(".$container.");'".'>'.$rowname['name'].'<br>'.$thevalue2.'</a>", '.$thevalue.'],'; 
	 if(++$i == 10) break;
 
} 
$strcategories = substr($strcategories, 0,-1); 


?>
 
	<script type="text/javascript"> 
	$(function() {

		var data = [ <?php echo $strcategories; ?> ];

		$.plot("#placeholder2", [ data ], {
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
	
	.demo-placeholder2 {
		width: 100%;
		height: 100%;
		font-size: 14px;
		line-height: 1.2em;
	}
	.demo-container2 {
		position: relative;
		height: 280px;
	}
	#description {
		margin: 15px 10px 20px 10px;
	}
	</style>  <br>


<h3>Conceptos:</h3>  <br>   
   <div class="demo-container2">
			<div id="placeholder2" class="demo-placeholder2"></div>
		</div> 
		
	




<script>
function showCategories2(id){
	var company = document.getElementById('categoriescompany').value;
	var from = document.getElementById('categoriesfrom').value;
	var to = document.getElementById('categoriesto').value;
	
	$("#rubros_concept2").html("Cargando información...");
	
	
	$.post("analytics-types-concept2.php", { type: id, company: company, from: from, to: to }, function(data){
		$("#rubros_concept2").html(data);
		
});			
}
</script>