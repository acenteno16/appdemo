<?php $today = date("Y-m-d");
$thisweek = ">= CURDATE() - INTERVAL CASE WEEKDAY(CURDATE()) WHEN 6 THEN -1 ELSE WEEKDAY(CURDATE()) END + 1 DAY";
$thisyear = ">= MAKEDATE(YEAR(CURDATE()), 1)";  

?>
<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>
                            
                            	<i class="fa fa-angle-right"></i>

						</li>

<li>

					

							<a href="#">Gerente de Financiero</a>

						</li>

						


					</ul>
                    

            

                        
                        <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos Cancelados

						  </div>

							<div class="actions">

								<?php ?>
                             
													  
                                            
                           	  <div style="float:left""><div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy" style="margin-top:-20px; margin-bottom:0px;">
								<input type="text" class="form-control" name="from" value="<?php echo date("j-n-Y",strtotime('monday this week', strtotime('-1 week'))); ?>" id="cancellationfrom" onchange="javascript:reloadCancellation();">
												<span class="input-group-addon">
												hasta </span>
								<input type="text" class="form-control" name="to" value="<?php echo $today = date('j-n-Y'); ?>" id="cancellationto" onchange="javascript:reloadCancellation();">
											</div></div>
                               	<?php //end?> 
                                
                           
                                
                               <script>
                                function reloadCancellation(){	

	

	var from = document.getElementById('cancellationfrom').value;
	var to= document.getElementById('cancellationto').value;
	
	$.post("dashboard-financemanager-cancellation.php", { from: from, to: to }, function(data){
		$("#rcancellation").html(data);  
		
});			
}

	</script>						

							</div>

						</div>
</div><br><br>
<div id="rcancellation">
<div class="portlet-body">
    
    
    

							<div class="row">
                            
<?php //PAGOS CANCELADOS

//Casa Pellas
$querymcancellation1 = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '14' and times.today ".$thisweek;
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 1";
// and WEEK('$today')
$resultmcancellation2 = mysqli_query($con, $querymcancellation2);
while($rowmcancellation2 = mysqli_fetch_array($resultmcancellation2)){
	$ammountnio += $rowmcancellation2['ammount'];
}
$nummcancellation2 = mysqli_num_rows($resultmcancellation2);

$mcancellationnio = ($nummcancellation2*100)/$nummcancellation1;
$mcancellationnio = number_format($mcancellationnio, 2);
$mcancellationnio = str_replace('.00','',$mcancellationnio);
?>
<div class="col-md-3">

									<div class="easy-pie-chart">
                                    Casa Pellas

										<div class="number <?php if($mcancellationnio < 61) echo "bounce";
										if(($mcancellationnio > 60) and ($mcancellationnio <= 86)) echo "transactions";
										if($mcancellationnio > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationnio."%"; ?>">

											<span>

											<?php echo $mcancellationnio; ?>%</span>


										</div> 
                                         

						<br>

<?php $rownio=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 1 and currency = 1"));
$ammountnio = $rownio[0];

$rowusd=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 1 and currency = 2"));
$ammountusd = $rowusd[0];

$roweur=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 1 and currency = 3"));
$ammounteur = $roweur[0];

$rowyen=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 1 and currency = 4"));
$ammountyen = $rowyen[0];
?>									
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"><?php echo str_replace('.00','',number_format($ammountnio,2)); ?></td>
  </tr>
  <tr>
    <td align="right">U$ &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountusd,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&euro; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammounteur,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&yen; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountyen,2)); ?></td>
  </tr>
</table>

	  </div>

							  </div>
                                
<?php //Velosa
$querymcancellation1 = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '14' and times.today ".$thisweek;
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 3";
// and WEEK('$today')
$resultmcancellation2 = mysqli_query($con, $querymcancellation2);
while($rowmcancellation2 = mysqli_fetch_array($resultmcancellation2)){
	$ammountnio += $rowmcancellation2['ammount'];
}
$nummcancellation2 = mysqli_num_rows($resultmcancellation2);

$mcancellationnio = ($nummcancellation2*100)/$nummcancellation1;
$mcancellationnio = number_format($mcancellationnio, 2);
$mcancellationnio = str_replace('.00','',$mcancellationnio);
?>
<div class="col-md-3">

									<div class="easy-pie-chart">
                                    Velosa

										<div class="number <?php if($mcancellationnio < 61) echo "bounce";
										if(($mcancellationnio > 60) and ($mcancellationnio <= 86)) echo "transactions";
										if($mcancellationnio > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationnio."%"; ?>">

											<span>

											<?php echo $mcancellationnio; ?>%</span>


										</div> 
                                         

						<br>

<?php $rownio=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 3 and currency = 1"));
$ammountnio = $rownio[0];

$rowusd=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 3 and currency = 2"));
$ammountusd = $rowusd[0];

$roweur=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 3 and currency = 3"));
$ammounteur = $roweur[0];

$rowyen=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 3 and currency = 4"));
$ammountyen = $rowyen[0];
?>									
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"><?php echo str_replace('.00','',number_format($ammountnio,2)); ?></td>
  </tr>
  <tr>
    <td align="right">U$ &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountusd,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&euro; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammounteur,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&yen; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountyen,2)); ?></td>
  </tr>
</table>

	  </div>

							  </div>

<?php //Alpesa
$querymcancellation1 = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '14' and times.today ".$thisweek."";
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 2";
// and WEEK('$today')
$resultmcancellation2 = mysqli_query($con, $querymcancellation2);
while($rowmcancellation2 = mysqli_fetch_array($resultmcancellation2)){
	$ammountnio += $rowmcancellation2['ammount'];
}
$nummcancellation2 = mysqli_num_rows($resultmcancellation2);

$mcancellationnio = ($nummcancellation2*100)/$nummcancellation1;
$mcancellationnio = number_format($mcancellationnio, 2);
$mcancellationnio = str_replace('.00','',$mcancellationnio);
?>
<div class="col-md-3">

									<div class="easy-pie-chart">
                                    Alpesa

										<div class="number <?php if($mcancellationnio < 61) echo "bounce";
										if(($mcancellationnio > 60) and ($mcancellationnio <= 86)) echo "transactions";
										if($mcancellationnio > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationnio."%"; ?>">

											<span>

											<?php echo $mcancellationnio; ?>%</span>


										</div> 
                                         

						<br>

<?php $rownio=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 2 and currency = 1"));
$ammountnio = $rownio[0];

$rowusd=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 2 and currency = 2"));
$ammountusd = $rowusd[0];

$roweur=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 2 and currency = 3"));
$ammounteur = $roweur[0];

$rowyen=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 2 and currency = 4"));
$ammountyen = $rowyen[0];
?>									
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"><?php echo str_replace('.00','',number_format($ammountnio,2)); ?></td>
  </tr>
  <tr>
    <td align="right">U$ &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountusd,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&euro; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammounteur,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&yen; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountyen,2)); ?></td>
  </tr>
</table>

	  </div>

							  </div>
                                
<?php //Otras compañías
$querymcancellation1 = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '14' and times.today ".$thisweek."";
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id > 3";
// and WEEK('$today')
$resultmcancellation2 = mysqli_query($con, $querymcancellation2);
while($rowmcancellation2 = mysqli_fetch_array($resultmcancellation2)){
	$ammountnio += $rowmcancellation2['ammount'];
}
$nummcancellation2 = mysqli_num_rows($resultmcancellation2);

$mcancellationnio = ($nummcancellation2*100)/$nummcancellation1;
$mcancellationnio = number_format($mcancellationnio, 2);
$mcancellationnio = str_replace('.00','',$mcancellationnio);
?>
<div class="col-md-3">

									<div class="easy-pie-chart">
                                    Otras Compañías

										<div class="number <?php if($mcancellationnio < 61) echo "bounce";
										if(($mcancellationnio > 60) and ($mcancellationnio <= 86)) echo "transactions";
										if($mcancellationnio > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationnio."%"; ?>">

											<span>

											<?php echo $mcancellationnio; ?>%</span>


										</div> 
                                         

						<br>

<?php $rownio=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id > 3 and currency = 1"));
$ammountnio = $rownio[0];

$rowusd=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id > 3 and currency = 2"));
$ammountusd = $rowusd[0];

$roweur=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id > 3 and currency = 3"));
$ammounteur = $roweur[0];

$rowyen=mysqli_fetch_array(mysqli_query($con, "select sum(payments.ammount) from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id > 3 and currency = 4"));
$ammountyen = $rowyen[0];
?>									
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="right">C$ &nbsp;</td>
    <td width="50%" align="left"><?php echo str_replace('.00','',number_format($ammountnio,2)); ?></td>
  </tr>
  <tr>
    <td align="right">U$ &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountusd,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&euro; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammounteur,2)); ?></td>
  </tr>
  <tr>
    <td align="right">&yen; &nbsp;</td>
    <td align="left"><?php echo str_replace('.00','',number_format($ammountyen,2)); ?></td>
  </tr>
</table>

	  </div>

							  </div>


                             

                             
                             

								

  </div>

								

								

								
                                
                                

							</div>
</div>                            
                        <br>
<br><br><br>
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
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->


<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos pendientes de cancelar 

						  </div>

							

						</div>
</div>
<div class="row">

<div class="col-md-3">
Casa Pellas
<script type="text/javascript">

	$(function() {

		var data = [];
		<?php $inc = 0;
		$querysub = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 1 and payments.status < 5 and companies.id = 1";
		$resultsub = mysqli_query($con, $querysub);  
		$numsub = mysqli_num_rows($resultsub);
		$rowsub=mysqli_fetch_array($resultsub);
			
			
		//SUM Stage
			$stage = $rowsub['status'];
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '8'"));
			
?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']; ?>",
				data: <?php echo $numsub; ?>,
			} 
		
				
		<?php $today = date('Y-m-d');
		$query = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 4 and payments.status < 14 and companies.id = 1 group by payments.status";
	
		$result = mysqli_query($con, $query);  
		$num = mysqli_num_rows($result);
		while($row=mysqli_fetch_array($result)){
			
			$query2 = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and companies.id = 1 and payments.status = '$row[status]'";
		
			$result2 = mysqli_query($con, $query2);
			$num2 = mysqli_num_rows($result2);
			
			//SUM Stage
			$stage = $row['status']; 
			switch($stage){ 
				case 8:
				$stage = 9;
				break;
				case 9:
				$stage = 12;
				break;
				case 12:
				$stage = 13;
				break;	
			}
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$stage'"));
		?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']; ?>",
				data: <?php echo $num2; ?>,
			} 
		<?php }
		
		
		
	
		if(($num == 0) and ($numsub == 0)){ ?>
			data[0] = {
				label: "Sin Movimientos",
				data: 100,
				color: '#44a75a'
			} 
		<?php } ?>

		var placeholder = $("#fmppc1");

		
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
			<div id="fmppc1" class="demo-placeholder"></div>
		 <?php $rowppcfmnio= 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 1 and payments.currency = 1";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmnio += $rowppcfm['payment'];
		 }
		 $rowppcfmnio = number_format($rowppcfmnio, 2);
		 $rowppcfmnio = str_replace('.00','',$rowppcfmnio);
		 
		 $rowppcfmusd = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 1 and payments.currency = 2";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmusd += $rowppcfm['payment'];
		 }
		 $rowppcfmusd = number_format($rowppcfmusd, 2);
		 $rowppcfmusd = str_replace('.00','',$rowppcfmusd);
		 
		 $rowppcfmeur = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 1 and payments.currency = 3";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmeur += $rowppcfm['payment'];
		 }
		 $rowppcfmeur = number_format($rowppcfmeur, 2);
		 $rowppcfmeur = str_replace('.00','',$rowppcfmeur);
		 
		 $rowppcfmyen = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 1 and payments.currency = 4";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmyen += $rowppcfm['payment'];
		 }
		 $rowppcfmyen = number_format($rowppcfmyen, 2);
		 $rowppcfmyen = str_replace('.00','',$rowppcfmyen);
		 
		 ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td width="50%" align="right">C$ &nbsp;</td>
             <td width="50%" align="left"><?php echo $rowppcfmnio; ?></td>
           </tr>
           <tr>
             <td align="right">U$ &nbsp;</td>
             <td align="left"><?php echo $rowppcfmusd; ?></td>
           </tr>
           <tr>
             <td align="right">&euro; &nbsp;</td>
             <td align="left"><?php echo $rowppcfmeur; ?></td>
           </tr>
           <tr>
             <td align="right">&yen; &nbsp;</td>
             <td align="left"><?php echo $rowppcfmyen; ?></td>
           </tr>
      </table>
    </div>
<br><br><br>
</div>

<div class="col-md-3">
Velosa
<script type="text/javascript">

	$(function() {

		var data = [];
		<?php $inc = 0;
		$querysub = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 1 and payments.status < 5 and companies.id = 3";
		$resultsub = mysqli_query($con, $querysub);  
		$numsub = mysqli_num_rows($resultsub);
		$rowsub=mysqli_fetch_array($resultsub);
			
			
		//SUM Stage
			$stage = $rowsub['status'];
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '8'"));
			
?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']; ?>",
				data: <?php echo $numsub; ?>,
			} 
		
				
		<?php $today = date('Y-m-d');
		$query = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 4 and payments.status < 14 and companies.id = 3 group by payments.status";
	
		$result = mysqli_query($con, $query);  
		$num = mysqli_num_rows($result);
		while($row=mysqli_fetch_array($result)){
			
			$query2 = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and companies.id = 3 and payments.status = '$row[status]'";
		
			$result2 = mysqli_query($con, $query2);
			$num2 = mysqli_num_rows($result2);
			
			//SUM Stage
			$stage = $row['status']; 
			switch($stage){ 
				case 8:
				$stage = 9;
				break;
				case 9:
				$stage = 12;
				break;
				case 12:
				$stage = 13;
				break;	
			}
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$stage'"));
		?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']; ?>",
				data: <?php echo $num2; ?>,
			} 
		<?php }
		
		
		
	
		if(($num == 0) and ($numsub == 0)){ ?>
			data[0] = {
				label: "Sin Movimientos",
				data: 100,
				color: '#44a75a'
			} 
		<?php } ?>

		var placeholder = $("#fmppc2");

		
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
	  <div id="fmppc2" class="demo-placeholder"></div>
		 <?php $rowppcfmnio = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 3 and payments.currency = 1";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmnio += $rowppcfm['payment'];
		 }
		 $rowppcfmnio = number_format($rowppcfmnio, 2);
		 $rowppcfmnio = str_replace('.00','',$rowppcfmnio);
		 
		 $rowppcfmusd = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 3 and payments.currency = 2";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmusd += $rowppcfm['payment'];
		 }
		 $rowppcfmusd = number_format($rowppcfmusd, 2);
		 $rowppcfmusd = str_replace('.00','',$rowppcfmusd);
		 
		 $rowppcfmeur = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 3 and payments.currency = 3";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmeur += $rowppcfm['payment'];
		 }
		 $rowppcfmeur = number_format($rowppcfmeur, 2);
		 $rowppcfmeur = str_replace('.00','',$rowppcfmeur);
		 
		 $rowppcfmyen = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 3 and payments.currency = 4";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmyen += $rowppcfm['payment'];
		 }
		 $rowppcfmyen = number_format($rowppcfmyen, 2);
		 $rowppcfmyen = str_replace('.00','',$rowppcfmyen);
		 
		 ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td width="50%" align="right">C$ &nbsp;</td>
             <td width="50%" align="left"><?php echo $rowppcfmnio; ?></td>
           </tr>
           <tr>
             <td align="right">U$ &nbsp;</td>
             <td align="left"><?php echo $rowppcfmusd; ?></td>
           </tr>
           <tr>
             <td align="right">&euro; &nbsp;</td>
             <td align="left"><?php echo $rowppcfmeur; ?></td>
           </tr>
           <tr>
             <td align="right">&yen; &nbsp;</td>
             <td align="left"><?php echo $rowppcfmyen; ?></td>
           </tr>
      </table>
    
</div>

</div>
<div class="col-md-3">
Alpesa
<script type="text/javascript">

	$(function() {

		var data = [];
		<?php $inc = 0;
		$querysub = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 1 and payments.status < 5 and companies.id = 2";
		$resultsub = mysqli_query($con, $querysub);  
		$numsub = mysqli_num_rows($resultsub);
		$rowsub=mysqli_fetch_array($resultsub);
			
			
		//SUM Stage
			$stage = $rowsub['status'];
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '8'"));
			
?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']; ?>",
				data: <?php echo $numsub; ?>,
			} 
		
				
		<?php $today = date('Y-m-d');
		$query = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 4 and payments.status < 14 and companies.id = 2 group by payments.status";
	
		$result = mysqli_query($con, $query);  
		$num = mysqli_num_rows($result);
		while($row=mysqli_fetch_array($result)){
			
			$query2 = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and companies.id = 2 and payments.status = '$row[status]'";
		
			$result2 = mysqli_query($con, $query2);
			$num2 = mysqli_num_rows($result2);
			
			//SUM Stage
			$stage = $row['status']; 
			switch($stage){ 
				case 8:
				$stage = 9;
				break;
				case 9:
				$stage = 12;
				break;
				case 12:
				$stage = 13;
				break;	
			}
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$stage'"));
		?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']; ?>",
				data: <?php echo $num2; ?>,
			} 
		<?php }
		
		
		
	
		if(($num == 0) and ($numsub == 0)){ ?>
			data[0] = {
				label: "Sin Movimientos",
				data: 100,
				color: '#44a75a'
			} 
		<?php } ?>

		var placeholder = $("#fmppc3");

		
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
			<div id="fmppc3" class="demo-placeholder"></div>
		 <?php $rowppcfmnio = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 2 and payments.currency = 1";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmnio += $rowppcfm['payment'];
		 }
		 $rowppcfmnio = number_format($rowppcfmnio, 2);
		 $rowppcfmnio = str_replace('.00','',$rowppcfmnio);
		 
		 $rowppcfmusd = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 2 and payments.currency = 2";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmusd += $rowppcfm['payment'];
		 }
		 $rowppcfmusd = number_format($rowppcfmusd, 2);
		 $rowppcfmusd = str_replace('.00','',$rowppcfmusd);
		 
		 $rowppcfmeur = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 2 and payments.currency = 3";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmeur += $rowppcfm['payment'];
		 }
		 $rowppcfmeur = number_format($rowppcfmeur, 2);
		 $rowppcfmeur = str_replace('.00','',$rowppcfmeur);
		 
		 $rowppcfmyen = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id = 2 and payments.currency = 4";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmyen += $rowppcfm['payment'];
		 }
		 $rowppcfmyen = number_format($rowppcfmyen, 2);
		 $rowppcfmyen = str_replace('.00','',$rowppcfmyen);
		 
		 ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td width="50%" align="right">C$ &nbsp;</td>
             <td width="50%"><?php echo $rowppcfmnio; ?></td>
           </tr>
           <tr>
             <td align="right">U$ &nbsp;</td>
             <td><?php echo $rowppcfmusd; ?></td>
           </tr>
           <tr>
             <td align="right">&euro; &nbsp;</td>
             <td><?php echo $rowppcfmeur; ?></td>
           </tr>
           <tr>
             <td align="right">&yen; &nbsp;</td>
             <td><?php echo $rowppcfmyen; ?></td>
           </tr>
      </table>
      <br>
      <br>
      <br>
</div>

</div>

<div class="col-md-3">
Otras compañías
<script type="text/javascript">

	$(function() {

		var data = [];
		<?php $inc = 0;
		$querysub = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 1 and payments.status < 5 and companies.id > 3";
		$resultsub = mysqli_query($con, $querysub);  
		$numsub = mysqli_num_rows($resultsub);
		$rowsub=mysqli_fetch_array($resultsub);
			
			
		//SUM Stage
			$stage = $rowsub['status'];
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '8'"));
			
?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']; ?>",
				data: <?php echo $numsub; ?>,
			} 
		
				
		<?php $today = date('Y-m-d');
		$query = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status > 4 and payments.status < 14 and companies.id > 3 group by payments.status";
	
		$result = mysqli_query($con, $query);  
		$num = mysqli_num_rows($result);
		while($row=mysqli_fetch_array($result)){
			
			$query2 = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and companies.id > 3 and payments.status = '$row[status]'";
		
			$result2 = mysqli_query($con, $query2);
			$num2 = mysqli_num_rows($result2);
			
			//SUM Stage
			$stage = $row['status']; 
			switch($stage){ 
				case 8:
				$stage = 9;
				break;
				case 9:
				$stage = 12;
				break;
				case 12:
				$stage = 13;
				break;	
			}
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$stage'"));
		?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name2']; ?>",
				data: <?php echo $num2; ?>,
			} 
		<?php }
		
		
		
	
		if(($num == 0) and ($numsub == 0)){ ?>
			data[0] = {
				label: "Sin Movimientos",
				data: 100,
				color: '#44a75a'
			} 
		<?php } ?>

		var placeholder = $("#fmppc4");

		
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
	  <div id="fmppc4" class="demo-placeholder"></div>
		 <?php $rowppcfmnio = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id > 3 and payments.currency = 1";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmnio += $rowppcfm['payment'];
		 }
		 $rowppcfmnio = number_format($rowppcfmnio, 2);
		 $rowppcfmnio = str_replace('.00','',$rowppcfmnio);
		 
		 $rowppcfmusd = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id > 3 and payments.currency = 2";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmusd += $rowppcfm['payment'];
		 }
		 $rowppcfmusd = number_format($rowppcfmusd, 2);
		 $rowppcfmusd = str_replace('.00','',$rowppcfmusd);
		 
		 $rowppcfmeur = 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id > 3 and payments.currency = 3";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmeur += $rowppcfm['payment'];
		 }
		 $rowppcfmeur = number_format($rowppcfmeur, 2);
		 $rowppcfmeur = str_replace('.00','',$rowppcfmeur);
		 
		 $rowppcfmyen= 0;
		 $queryppcfm = "select * from payments inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where payments.approved = 1 and payments.status < 14 and companies.id > 3 and payments.currency = 4";
		 $resultppcfm = mysqli_query($con, $queryppcfm);
		 $numppcfm = mysqli_num_rows($resultppcfm );
		 while($rowppcfm = mysqli_fetch_array($resultppcfm)){
			 $rowppcfmyen += $rowppcfm['payment'];
		 }
		 $rowppcfmyen = number_format($rowppcfmyen, 2);
		 $rowppcfmyen = str_replace('.00','',$rowppcfmyen);
		 
		 ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td width="50%" align="right">C$ &nbsp;</td>
             <td width="50%" align="left"><?php echo $rowppcfmnio; ?></td>
           </tr>
           <tr>
             <td align="right">U$ &nbsp;</td>
             <td align="left"><?php echo $rowppcfmusd; ?></td>
           </tr>
           <tr>
             <td align="right">&euro; &nbsp;</td>
             <td align="left"><?php echo $rowppcfmeur; ?></td>
           </tr>
           <tr>
             <td align="right">&yen; &nbsp;</td>
             <td align="left"><?php echo $rowppcfmyen; ?></td>
           </tr>
      </table>
      <br>
      <br>
      <br>
</div>

</div>
</div>
<br><br><br>&nbsp;

<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Proveedores más importantes 

						  </div>

							<div class="actions">

								<?php ?>
                             
													  
                                            
                                            	<div style="float:left""><div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy" style="margin-top:-20px; margin-bottom:0px;">
												<input type="text" class="form-control" name="providersfrom" value="1-1-<?php echo date("Y")?>" id="providersfrom" onchange="javascript:reloadProviders();">
												<span class="input-group-addon">
												hasta </span>
												<input type="text" class="form-control" name="providersto" value="<?php echo $today = date('j-n-Y'); ?>" id="timesto" onchange="javascript:reloadProviders();">
											</div></div>
                                            <div style="float:right"><div class="form-group" style="margin-top:-20px; margin-bottom:0px;">

												
															<select name="type" class="form-control" id="providerstype" onchange="javascript:reloadProviders();">
														<option value="0">Todas las compañias (NIO)</option>
														<option value="1">Todas las compañias (USD)</option>
														<option value="2">Todas las compañias (EUR)</option>
														<option value="3">Todas las compañias (YEN)</option>
                                                  <option value="4">Casa Pellas (NIO)</option>
														<option value="5">Casa Pellas (USD)</option>
														<option value="6">Casa Pellas (EUR)</option>
														<option value="7">Casa Pellas (YEN)</option>
                                                  <option value="8">Alpesa (NIO)</option>
														<option value="9">Alpesa (USD)</option>
														<option value="10">Alpesa (EUR)</option>
														<option value="11">Alpesa (YEN)</option>
                                                  <option value="12">Velosa (NIO)</option>
														<option value="13">Velosa (USD)</option>
														<option value="14">Velosa (EUR)</option>
														<option value="15">Velosa (YEN)</option>
                                                  <option value="16">Otras compañias (NIO)</option>
														<option value="17">Otras compañias (USD)</option>
														<option value="18">Otras compañias (EUR)</option>
														<option value="19">Otras compañiad (YEN)</option>
													
	 														</select>

													  </div></div>

												
                                <?php //end?> 
                                
                              <?php /*  <a href="javascript:reloadProviders(0);" class="btn default blue-stripe">
								Todas </a> 
                                	 <a href="javascript:reloadProviders(1);" class="btn default blue-stripe">
								Casa Pellas </a> <a href="javascript:reloadProviders(2);" class="btn default blue-stripe">
								Alpesa </a> <a href="javascript:reloadProviders(3);" class="btn default blue-stripe">
								Velosa </a> <a href="javascript:reloadProviders(4);" class="btn default blue-stripe">
								Otras </a>*/ ?>
                                
                               <script>
                                function reloadProviders(){	

	
	var type = document.getElementById('providerstype').value;
	var from = document.getElementById('providersfrom').value;
	var to= document.getElementById('providersto').value;
	
	$.post("dashboard-president-providers.php", { type: type, from: from, to: to }, function(data){
		$("#rproviders").html(data); 
		
});			
}

	</script>						

							</div>

						</div>
</div>
<div id="rproviders">
<p style='font-size:14px;'>Todas las compañías (NIO)</p>
<?php $today = date('Y-m-d');
$querypresidentprovider1 = "select sum(payments.payment), payments.provider, payments.currency from payments inner join times on payments.id = times.payment where times.stage = '14' and payments.currency = '1' and times.today ".$thisyear."group by payments.provider order by sum(payments.payment) desc limit 10";  
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
</div>
 
    <br><br><br>
   
 

<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Tiempo Solicitud/Cancelación
						  </div>

							<div class="actions">

								<?php ?>
                             
													  
                                            
                                            	<div style="float:left""><div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy" style="margin-top:-20px; margin-bottom:0px;">
												<input type="text" class="form-control" name="from" value="<?php echo date("j-n-Y",strtotime('monday this week', strtotime('-1 week'))); ?>" id="timesfrom" onchange="javascript:reloadTimes();">
												<span class="input-group-addon">
												hasta </span>
												<input type="text" class="form-control" name="to" value="<?php echo $today = date('j-n-Y'); ?>" id="providersto" onchange="javascript:reloadTimes();">
											</div></div>
                                            <div style="float:right"><div class="form-group" style="margin-top:-20px; margin-bottom:0px;">

												
															<select name="type" class="form-control" id="timestype" onchange="javascript:reloadTimes();">
														<option value="0">Todas las compañias (NIO)</option>
														<option value="1">Todas las compañias (USD)</option>
														<option value="2">Todas las compañias (EUR)</option>
														<option value="3">Todas las compañias (YEN)</option>
                                                  <option value="4">Casa Pellas (NIO)</option>
														<option value="5">Casa Pellas (USD)</option>
														<option value="6">Casa Pellas (EUR)</option>
														<option value="7">Casa Pellas (YEN)</option>
                                                  <option value="8">Alpesa (NIO)</option>
														<option value="9">Alpesa (USD)</option>
														<option value="10">Alpesa (EUR)</option>
														<option value="11">Alpesa (YEN)</option>
                                                  <option value="12">Velosa (NIO)</option>
														<option value="13">Velosa (USD)</option>
														<option value="14">Velosa (EUR)</option>
														<option value="15">Velosa (YEN)</option>
                                                  <option value="16">Otras compañias (NIO)</option>
														<option value="17">Otras compañias (USD)</option>
														<option value="18">Otras compañias (EUR)</option>
														<option value="19">Otras compañiad (YEN)</option>
													
	 														</select>

													  </div></div>

												
                                <?php //end?> 
                                
                           
                                
                               <script>
                                function reloadTimes(){	

	
	var type = document.getElementById('timestype').value;
	var from = document.getElementById('timesfrom').value;
	var to= document.getElementById('timesto').value;
	
	$.post("dashboard-financemanager-times.php", { type: type, from: from, to: to }, function(data){
		$("#rtimes").html(data);  
		
});			
}

	</script>						

							</div>

						</div>
</div>
<div id="rtimes"><?php /*tiempos de compañias
$globalctime1 = 0.01;
$globalctime2 = 0.01;
$globalctime3 = 0.01;
$globalctime4 = 0.01;
*/ 

$querygctime = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 1";
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
 
 
 $querygctime = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 2";
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
 
 $querygctime = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id = 3";
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
 
$querygctime = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code inner join units on workers.unit = units.code inner join companies on units.company = companies.id where times.stage = '14' and times.today ".$thisweek." and companies.id > 3";
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
		$query = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '14' and times.today ".$thisweek;
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
				 
			//SUM Stage
			/*$stage = $row['status']; 
			switch($stage){ 
				case 8:
				$stage = 9;
				break;
				case 9:
				$stage = 12;
				break;
				case 12:
				$stage = 13;
				break;	
			}
			//$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$stage'"));
			*/
			
		?>
		<?php } 
		
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
</div></div> 
