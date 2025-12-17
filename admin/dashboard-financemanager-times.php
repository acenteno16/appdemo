<?php include("sessions.php"); 

$today = date('Y-m-d');
$thisweek = ">= CURDATE() - INTERVAL CASE WEEKDAY(CURDATE()) WHEN 6 THEN -1 ELSE WEEKDAY(CURDATE()) END + 1 DAY";
$thisyear = ">= MAKEDATE(YEAR(CURDATE()), 1)";

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

if($sqldatea == 0){
	$sqldate = " and times.today >= MAKEDATE(YEAR(CURDATE()), 1)";
}else{
	$sqldate = $sqlfrom.$sqlto;
}

echo "<p style='font-size:14px;'>";
switch($company){
	case 0:
	echo "Todas las compañías (NIO)";
	$sql = " and payments.currency = 1";
	$sql2 = " and payments.currency = 1";
	break;
	case 1:
	echo "Todas las compañías (USD)";
	$sql = " and payments.currency = 2";
	$sql2 = " and payments.currency = 2";
	break;
	case 2:
	echo "Todas las compañías (EUR)";
	$sql = " and payments.currency = 3";
	$sql2 = " and payments.currency = 3";
	break;
	case 3:
	echo "Todas las compañías (YEN)";
	$sql = " and payments.currency = 4";
	$sql2 = " and payments.currency = 4";
	break;
	case 4:
	echo "Casa Pellas (NIO)";
	$sql = " and payments.currency = 1 and units.company = 1";
	$sql2 = " and payments.currency = 1";
	break;
	case 5:
	echo "Casa Pellas (USD)";
	$sql = " and payments.currency = 2 and units.company = 1";
	$sql2 = " and payments.currency = 2";
	break;
	case 6:
	echo "Casa Pellas (EUR)";
	$sql = " and payments.currency = 3 and units.company = 1";
	$sql2 = " and payments.currency = 3";
	break;
	case 7:
	echo "Casa Pellas (YEN)";
	$sql = " and payments.currency = 4 and units.company = 1";
	$sql2 = " and payments.currency = 4";
	break;
	case 8:
	echo "Alpesa (NIO)";
	$sql = " and payments.currency = 1 and units.company = 2";
	$sql2 = " and payments.currency = 1";
	break;
	case 9:
	echo "Alpesa (USD)";
	$sql = " and payments.currency = 2 and units.company = 2";
	$sql2 = " and payments.currency = 2";
	break;
	case 10:
	echo "Alpesa (EUR)";
	$sql = " and payments.currency = 3 and units.company = 2";
	$sql2 = " and payments.currency = 3";
	break;
	case 11:
	echo "Alpesa (YEN)";
	$sql = " and payments.currency = 4 and units.company = 2";
	$sql2 = " and payments.currency = 4";
	break;
	case 12:
	echo "Velosa (NIO)";
	$sql = " and payments.currency = 1 and units.company = 3";
	$sql2 = " and payments.currency = 1";
	break;
	case 13:
	echo "Velosa (USD)";
	$sql = " and payments.currency = 2 and units.company = 3";
	$sql2 = " and payments.currency = 2";
	break;
	case 14:
	echo "Velosa (EUR)";
	$sql = " and payments.currency = 3 and units.company = 3";
	$sql2 = " and payments.currency = 3";
	break;
	case 15:
	echo "Velosa (YEN)";
	$sql = " and payments.currency = 4 and units.company = 3";
	$sql2 = " and payments.currency = 4";
	break;
	case 16:
	echo "Otras Compañías (NIO)";
	$sql = " and payments.currency = 1 and units.company > 3";
	$sql2 = " and payments.currency = 1";
	break;
	case 17:
	echo "Otras Compañías (USD)";
	$sql = " and payments.currency = 2 and units.company > 3";
	$sql2 = " and payments.currency = 2";
	break;
	case 18:
	echo "Otras Compañías (EUR)";
	$sql = " and payments.currency = 3 and units.company > 3";
	$sql2 = " and payments.currency = 3";
	break;
	case 19:
	echo "Otras Compañías (YEN)";
	$sql = " and payments.currency = 4 and units.company > 3";
	$sql2 = " and payments.currency = 4";
	break; 
}
echo "</p><br>";
 
$today = date('Y-m-d'); 

$querygctime = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate.$sql2." and companies.id = 1";
$resultgctime = mysqli_query($con, $querygctime);
$numgctime = mysqli_num_rows($resultgctime);
 while($rowgctime=mysqli_fetch_array($resultgctime)){
	 $querygctimea = "select * from times where payment = '$rowgctime[0]' and stage = '1'";
	 $resultgctimea = mysqli_query($con, $querygctimea);
	 $rowgctimea = mysqli_fetch_array($resultgctimea);
	 $datea = $rowgctimea['today'];
	 
	 $querygctimeb = "select * from times where payment = '$rowgctime[0]' and stage = '14'";
	 $resultgctimeb = mysqli_query($con, $querygctimeb);
	 $rowgctimeb = mysqli_fetch_array($resultgctimeb);
	 $dateb = $rowgctimeb['today'];
	 
	 $dias	= (strtotime($datea)-strtotime($dateb))/86400;
	 $dias 	= abs($dias); $dias = floor($dias);		
	 $alldays += $dias; 
	 
 }
 $globalctime1 =  $alldays/$numgctime;
 
 
 $querygctime = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate.$sql2." and companies.id = 2";
$resultgctime = mysqli_query($con, $querygctime);
$numgctime = mysqli_num_rows($resultgctime);
 while($rowgctime=mysqli_fetch_array($resultgctime)){
	 $querygctimea = "select * from times where payment = '$rowgctime[0]' and stage = '1'";
	 $resultgctimea = mysqli_query($con, $querygctimea);
	 $rowgctimea = mysqli_fetch_array($resultgctimea);
	 $datea = $rowgctimea['today'];
	 
	 $querygctimeb = "select * from times where payment = '$rowgctime[0]' and stage = '14'";
	 $resultgctimeb = mysqli_query($con, $querygctimeb);
	 $rowgctimeb = mysqli_fetch_array($resultgctimeb);
	 $dateb = $rowgctimeb['today'];
	 
	 $dias	= (strtotime($datea)-strtotime($dateb))/86400;
	 $dias 	= abs($dias); $dias = floor($dias);		
	 $alldays += $dias; 
	 
 }
 $globalctime2 =  $alldays/$numgctime;
 
 $querygctime = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate.$sql2." and companies.id = 3";
$resultgctime = mysqli_query($con, $querygctime);
$numgctime = mysqli_num_rows($resultgctime);
 while($rowgctime=mysqli_fetch_array($resultgctime)){
	 $querygctimea = "select * from times where payment = '$rowgctime[0]' and stage = '1'";
	 $resultgctimea = mysqli_query($con, $querygctimea);
	 $rowgctimea = mysqli_fetch_array($resultgctimea);
	 $datea = $rowgctimea['today'];
	 
	 $querygctimeb = "select * from times where payment = '$rowgctime[0]' and stage = '14'";
	 $resultgctimeb = mysqli_query($con, $querygctimeb);
	 $rowgctimeb = mysqli_fetch_array($resultgctimeb);
	 $dateb = $rowgctimeb['today'];
	 
	 $dias	= (strtotime($datea)-strtotime($dateb))/86400;
	 $dias 	= abs($dias); $dias = floor($dias);		
	 $alldays += $dias; 
	 
 }
 $globalctime3 =  $alldays/$numgctime;
 
$querygctime = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sqldate.$sql2." and companies.id > 3";
$resultgctime = mysqli_query($con, $querygctime); 
$numgctime = mysqli_num_rows($resultgctime);
 while($rowgctime=mysqli_fetch_array($resultgctime)){
	 $querygctimea = "select * from times where payment = '$rowgctime[0]' and stage = '1'";
	 $resultgctimea = mysqli_query($con, $querygctimea);
	 $rowgctimea = mysqli_fetch_array($resultgctimea);
	 $datea = $rowgctimea['today'];
	 
	 $querygctimeb = "select * from times where payment = '$rowgctime[0]' and stage = '14'";
	 $resultgctimeb = mysqli_query($con, $querygctimeb);
	 $rowgctimeb = mysqli_fetch_array($resultgctimeb);
	 $dateb = $rowgctimeb['today'];
	 
	 $dias	= (strtotime($datea)-strtotime($dateb))/86400;
	 $dias 	= abs($dias); $dias = floor($dias);		
	 $alldays += $dias; 
	 
 }
 $globalctime4 =  $alldays/$numgctime;
?>
<script type="text/javascript">
	$(function() {

		var data = [ ['Casa Pellas',<?php echo $globalctime1+0; ?>], ['Velosa', <?php echo $globalctime3+0; ?>], ['Alpesa',<?php echo $globalctime2+0; ?>], ['Otras compañias', <?php echo $globalctime4+0; ?>] ];

	
	
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
				tickLength: 0,
		
			},
			grid: {
				borderColor: "#FFFFFF"
			}
			
		});

		// Add the Flot version string to the footer

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});
	</script>
   <div class="col-md-6"><div class="demo-container">
			<div id="concepts2" class="demo-placeholder"></div>
</div></div>
<div class="col-md-6">
<?php //Dias por etapa ?>
<script type="text/javascript">

	$(function() {

		var data = [];
		<?php $inc = 0; 
		$stage = array();
		$today = date('Y-m-d');
		$query = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14'".$sql.$sqldate;  
		$result = mysqli_query($con, $query);  
		$num = mysqli_num_rows($result); 
		while($row=mysqli_fetch_array($result)){
			
			$query2 = "select * from times where payment = $row[id] order by stage asc";
			$result2 = mysqli_query($con, $query2);
			$num2 = mysqli_num_rows($result2);
			
			while($row2=mysqli_fetch_array($result2)){	
				$stage[$row[0]][$row2['stage']] = $row2['today'];
			} 
			
			//Approve1 Times
			$datea = $stage[$row['id']][1]; //Request date
			$dateb = $stage[$row['id']][2]; //Approve1 date
			$dias = (strtotime($datea)-strtotime($dateb))/86400;
			$dias = abs($dias); $dias = floor($dias);
			$tapprove1 += $dias; 
			
			//Approve2
			
			if(isset($stage[$row['id']][3])){
				$datea = $stage[$row['id']][2]; //Approve1 date
				$dateb = $stage[$row['id']][3]; //Approve2 date
				
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove2 += $dias;
				$approve2 = 1;
			}
			//Approve3
			//If approve3 isset
			if(isset($stage[$row['id']][4])){
				$datea = $stage[$row['id']][3]; //Aprobado2
				$dateb = $stage[$row['id']][4]; //Aprpbado3
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove3 += $dias; 
				$approve3 = 1;
			}
			//Provision
			if(isset($stage[$row['id']][8])){
				if(isset($stage[$row['id']][4])){
					//dateb == approve3
					$dateb = $stage[$row['id']][4]; //Aprpbado3
				}elseif(isset($stage[$row['id']][3])){
					//dateb = apprve2
					$dateb = $stage[$row['id']][3]; //Aprpbado3
				}else{
					//dateb = approve1
					$dateb = $stage[$row['id']][2]; //Aprpbado3
				}
				$datea = $stage[$row['id']][8]; //Provision
				//Load dateb
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tprovission += $dias; 
				
			}
			//
			//Releasing
			if(isset($stage[$row['id']][9])){
				$datea = $stage[$row['id']][8]; //Provision date
				$dateb = $stage[$row['id']][9]; //releasing date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$treleasing += $dias;
				
			}
			//Schedule
			if(isset($stage[$row['id']][12])){
				$datea = $stage[$row['id']][9]; //Releasing
				$dateb = $stage[$row['id']][12]; //Schedule
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tschedule += $dias;
				
			}
			
			//Schedule Approve
			if(isset($stage[$row['id']][13])){
				$datea = $stage[$row['id']][12]; //Schedule
				$dateb = $stage[$row['id']][13]; //Schedule Approve
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tschedulea += $dias;
				
			}
			
			//Cancellation
			if(isset($stage[$row['id']][14])){
				$datea = $stage[$row['id']][13]; //Schedule Approve
				$dateb = $stage[$row['id']][14]; //Cancellation
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tcancellation += $dias;
			}
			
			} 
		
		?>
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Aprobado1 - <?php echo $tapprove1/$num; ?> dias",
				data: <?php echo $tapprove1; ?>,
			}
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Aprobado2 - <?php echo $tapprove2/$num; ?> dias",
				data: <?php echo $tapprove2+1; ?>,
			} 
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Aprobado3 - <?php echo $tapprove3/$num; ?> dias",
				data: <?php echo $tapprove3+1; ?>,
			}
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Provision - <?php echo $tprovission/$num; ?> dias",
				data: <?php echo $tprovission+1; ?>,
			} 
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Liberacion - <?php echo $treleasing/$num; ?> dias",
				data: <?php echo $treleasing+1; ?>,
			} 
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Programacion - <?php echo $tschedule/$num; ?> dias",
				data: <?php echo $tschedule+1; ?>,
			}
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Aprobado Prog. - <?php echo $tschedulea/$num; ?> dias",
				data: <?php echo $tschedulea+1; ?>,
			}
		data[<?php echo $inc; $inc++; ?>] = {
				label: "Cancelacion - <?php echo $tcancellation/$num; ?> dias",
				data: <?php echo $tcancellation+1; ?>,
			} 

		var placeholder = $("#fmdpe1");

		
			placeholder.unbind();

			$.plot(placeholder, data, {
				series: {
					 pie: {
			 innerRadius: 0.3,
            show: true,	
            radius: 1,
            label: {
                show: true,
                radius: 1,
                formatter: function(label, series) {
                    return '<div style="font-size:11px; text-align:center; padding:2px; color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                },
                background: {
                    opacity: 0.8,
                    color: '#444'
                }
            }
        }
    },
				
				legend: {
					show: false
				}
			});

			
		
	});

	// A custom label formatter used by several of the plots

	

	//
</script>
<div class="demo-container">
			<div id="fmdpe1" class="demo-placeholder"></div>
		 
	</div>
</div>