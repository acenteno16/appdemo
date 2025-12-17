<?php $today = date("Y-m-d"); 

//Headship Reader





?>
   <ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>
                            
                            	<i class="fa fa-angle-right"></i>

						</li>

<li>

					

							<a href="#">Gerente de Linea</a>

						</li>

						


					</ul>
                    

            
<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos Cancelados 

						  </div>

							

						</div>
                        </div><br><br>

<div class="portlet-body">
    
    
    

							<div class="row">
                            
<?php //Cordobas
$querymcancellation1 = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.approved = '1' and payments.currency = '1' and workers.unit = '$_SESSION[unit]' and WEEK('$today')";
$resultmcancellation1 = mysqli_query($con, $querymcancellation1);
$rowmcancellation1 = mysqli_fetch_array($resultmcancellation1);
$nummcancellation1 = mysqli_num_rows($resultmcancellation1);

$querymcancellation2 = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.status = '14' and payments.currency = '1' and workers.unit = '$_SESSION[unit]' and WEEK('$today')";
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
                                    Cordobas

										<div class="number <?php if($mcancellationnio < 61) echo "bounce";
										if(($mcancellationnio > 60) and ($mcancellationnio <= 86)) echo "transactions";
										if($mcancellationnio > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationnio."%"; ?>">

											<span>

											<?php echo $mcancellationnio; ?>%</span>


										</div> 
                                         

						<br>

										C$<?php echo str_replace('.00','',number_format($ammountnio,2)); ?>
                                    <br>
Aprobados: <?php echo $nummcancellation1; ?><br>
Cancelados: <?php echo $nummcancellation2; ?>  
				
									</div>

								</div>
<?php //Dolares
$querymcancellation3 = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.approved = '1' and payments.currency = '2' and workers.unit = '$_SESSION[unit]' and WEEK('$today')";
$resultmcancellation3 = mysqli_query($con, $querymcancellation3);
$rowmcancellation3 = mysqli_fetch_array($resultmcancellation3);
$nummcancellation3 = mysqli_num_rows($resultmcancellation3);

$querymcancellation4 = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.status = '14' and payments.currency = '2' and workers.unit = '$_SESSION[unit]' and WEEK('$today')";
$resultmcancellation4 = mysqli_query($con, $querymcancellation4);
while($rowmcancellation4 = mysqli_fetch_array($resultmcancellation4)){
	$ammountusd += $rowmcancellation4['ammount'];
}
$nummcancellation4 = mysqli_num_rows($resultmcancellation4);

$mcancellationusd = ($nummcancellation4*100)/$nummcancellation3;
$mcancellationusd = number_format($mcancellationusd, 2);
$mcancellationusd = str_replace('.00','',$mcancellationusd);
?>
                             <div class="col-md-3">

									<div class="easy-pie-chart">
                                    Dolares

										<div class="number <?php if($mcancellationusd < 61) echo "bounce";
										if(($mcancellationusd > 60) and ($mcancellationusd <= 86)) echo "transactions";
										if($mcancellationusd > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationusd."%"; ?>">

											<span>

											<?php echo $mcancellationusd; ?>%</span>


										</div>

						<br>

										$<?php echo str_replace('.00','',number_format($ammountusd,2)); ?>
                                    <br>
Aprobados: <?php echo $nummcancellation3; ?><br>
Cancelados: <?php echo $nummcancellation4; ?>  
				
									</div>

								</div>
<?php //Euros 
$querymcancellation5 = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.approved = '1' and payments.currency = '3' and workers.unit = '$_SESSION[unit]' and WEEK('$today')";
$resultmcancellation5 = mysqli_query($con, $querymcancellation5);
$rowmcancellation5 = mysqli_fetch_array($resultmcancellation5);
$nummcancellation5 = mysqli_num_rows($resultmcancellation5);

$querymcancellation6 = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.status = '14' and payments.currency = '3' and workers.unit = '$_SESSION[unit]' and WEEK('$today')";
$resultmcancellation6 = mysqli_query($con, $querymcancellation6);
while($rowmcancellation6 = mysqli_fetch_array($resultmcancellation6)){
	$ammounteur += $rowmcancellation6['ammount'];
}
$nummcancellation6 = mysqli_num_rows($resultmcancellation6);

$mcancellationeur = ($nummcancellation6*100)/$nummcancellation5;
$mcancellationeur = number_format($mcancellationeur, 2);
$mcancellationeur = str_replace('.00','',$mcancellationeur);
?>
                             <div class="col-md-3">

									<div class="easy-pie-chart">
                                    Euros

										<div class="number <?php if($mcancellationeur < 61) echo "bounce";
										if(($mcancellationeur > 60) and ($mcancellationeur <= 86)) echo "transactions";
										if($mcancellationeur > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationeur."%"; ?>">

											<span>

											<?php echo $mcancellationeur; ?>%</span>


										</div>

						<br>

										 &euro;<?php echo str_replace('.00','',number_format($ammounteur,2)); ?>
                                    <br>
Aprobados: <?php echo $nummcancellation5; ?><br>
Cancelados: <?php echo $nummcancellation6; ?>  
				
									</div>

								</div>
<?php //Yenes
$querymcancellation7 = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.approved = '1' and payments.currency = '4' and workers.unit = '$_SESSION[unit]' and WEEK('$today')";
$resultmcancellation7 = mysqli_query($con, $querymcancellation7);
$rowmcancellation7 = mysqli_fetch_array($resultmcancellation7);
$nummcancellation7 = mysqli_num_rows($resultmcancellation7);

$querymcancellation8 = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.status = '14' and payments.currency = '4' and workers.unit = '$_SESSION[unit]' and WEEK('$today')";
$resultmcancellation8 = mysqli_query($con, $querymcancellation8);
while($rowmcancellation8 = mysqli_fetch_array($resultmcancellation8)){
	$ammountyen += $rowmcancellation8['ammount']; 
}
$nummcancellation8 = mysqli_num_rows($resultmcancellation8);

$mcancellationyen = ($nummcancellation8*100)/$nummcancellation7;
$mcancellationyen = number_format($mcancellationyen, 2);
$mcancellationyen = str_replace('.00','',$mcancellationyen);
?>  
                             <div class="col-md-3">

									<div class="easy-pie-chart">
                                   Yenes

										<div class="number <?php if($mcancellationyen < 61) echo "bounce";
										if(($mcancellationyen > 60) and ($mcancellationyen <= 86)) echo "transactions";
										if($mcancellationyen > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationyen."%"; ?>">

											<span>

											<?php echo $mcancellationyen; ?>%</span>


										</div>

						<br>

									 &yen;<?php echo str_replace('.00','',number_format($ammountyen,2)); ?>
                                    <br>
Aprobados: <?php echo $nummcancellation7; ?><br>
Cancelados: <?php echo $nummcancellation8; ?>  
				
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
	#fmplaceholdermpp1 {
	
		width:350px;
		
	}
	fmplaceholdermpp2 {
	
		width:350px;
		
	}
	fmplaceholdermpp3 {
		
		width:350px;
		
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

<div class="col-md-4">
Cordobas
<script type="text/javascript">

	$(function() {

		var data = [];
		<?php $currency = 1;
		$inc = 0;
		$querysub = "select * from payments where currency = '$currency' and approved = 1 and status > 1 and status < 5";
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
		$query = "select * from payments where currency = '$currency' and approved = 1 and status > 4 and status < 14 group by status";
		$result = mysqli_query($con, $query);  
		$num = mysqli_num_rows($result);
		while($row=mysqli_fetch_array($result)){
			
			$query2 = "select * from payments where currency = '$currency' and approved = 1 and status > 4 and status < 14 and status = '$row[status]'";
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
				label: "Cancelados",
				data: 100,
				color: '#44a75a'
			} 
		<?php } ?>

		var placeholder = $("#fmplaceholdermpp0");

		
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
			<div id="fmplaceholdermpp0" class="demo-placeholder"></div>
		
		</div>

</div>

<div class="col-md-4">
Dolares
<script type="text/javascript">

	$(function() {

		var data = [];
		<?php $currency = 2;
		$inc = 0;
		$querysub = "select * from payments where currency = '$currency' and approved = 1 and status > 1 and status < 5";
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
		$query = "select * from payments where currency = '$currency' and approved = 1 and status > 4 and status < 14 group by status";
		$result = mysqli_query($con, $query);  
		$num = mysqli_num_rows($result);
		while($row=mysqli_fetch_array($result)){
			
			$query2 = "select * from payments where currency = '$currency' and approved = 1 and status > 4 and status < 14 and status = '$row[status]'";
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
				label: "Cancelados",
				data: 100,
				color: '#44a75a'
			} 
		<?php } ?>

		var placeholder = $("#fmplaceholdermpp2");

		
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
			<div id="fmplaceholdermpp2" class="demo-placeholder"></div>
		
		</div>

</div>
<div class="col-md-4">
Otras Monedas
<script type="text/javascript">

	$(function() {

		var data = [];
		<?php $currency = 2;
		$inc = 0;
		$querysub = "select * from payments where (currency = 3 or currency = 4) and approved = 1 and status > 1 and status < 5";
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
		$query = "select * from payments where (currency = 3 or currency = 4) and approved = 1 and status > 4 and status < 14 group by status";
		$result = mysqli_query($con, $query);  
		$num = mysqli_num_rows($result);
		while($row=mysqli_fetch_array($result)){
			
			$query2 = "select * from payments where (currency = 3 or currency = 4) and approved = 1 and status > 4 and status < 14 and status = '$row[status]'";
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
				label: "Cancelados",
				data: 100,
				color: '#44a75a'
			} 
		<?php } ?>

		var placeholder = $("#fmplaceholdermpp3");

		
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
			<div id="fmplaceholdermpp3" class="demo-placeholder"></div>
		
		</div>

</div>
</div>
<br><br><br>
<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Proveedores más importantes 

						  </div>

							<div class="actions">

								<?php ?>
                             
													  <div class="form-group" style="margin-top:-20px; margin-bottom:0px;">

													
															<select name="type" class="form-control" id="type" onchange="javascript:reloadProviders(this.value);">
														<option value="0">Cordobas</option>
														<option value="1">Dolares</option>
														<option value="2">Euros</option>
														<option value="3">Yenes</option>
                                                  
													
	 														</select>

													  </div>

												
                                <?php //end?> 
                                
                              <?php /*  <a href="javascript:reloadProviders(0);" class="btn default blue-stripe">
								Todas </a> 
                                	 <a href="javascript:reloadProviders(1);" class="btn default blue-stripe">
								Casa Pellas </a> <a href="javascript:reloadProviders(2);" class="btn default blue-stripe">
								Alpesa </a> <a href="javascript:reloadProviders(3);" class="btn default blue-stripe">
								Velosa </a> <a href="javascript:reloadProviders(4);" class="btn default blue-stripe">
								Otras </a>*/ ?>
                                
                               <script>
                                function reloadProviders(id){	

	$.post("dashboard-manager-providers.php", { company: id }, function(data){
		$("#rproviders").html(data);
		
});			
}

	</script>						

							</div>

						</div>
                        </div>
<div id="rproviders">
<?php $today = date('Y-m-d');
$querypresidentprovider1 = "select sum(payments.payment), payments.provider, payments.currency from payments inner join workers on payments.userid = workers.code where payments.status = '14' and payments.currency = '1' and workers.unit = '$_SESSION[unit]' and WEEK('$today') group by payments.provider order by sum(payments.payment) desc limit 10";
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
			}, grid: {
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

								Número de solicitudes

						  </div>

							

						</div>
                        </div>
                        
                       <?php //No de solicitudes
//Todas las solicitudes
$querymrequests1 = "select * from payments where status = 14";
//$queryrequests1 = "select * from payments where status = 14 and WEEK('$today')";
$resultmrequests1 = mysqli_query($con, $querymrequests1);
$rowmrequests1 = mysqli_fetch_array($resultmrequests1);
$nummrequests1 = mysqli_num_rows($resultmrequests1);

//Solicitudes de esta jefatura
$sqlmrequests2 = "";
if(isset($_SESSION['headship'])){
	$sqlmrequests2 = "and route = '$_SESSION[headship]'";
}
	
$querymrequests2 = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.status = '14' and workers.unit = '$_SESSION[unit]'".$sqlmrequests2;

//$querymrequests2 = "select * from payments where status = '14' and WEEK('$today')";
$resultmrequests2 = mysqli_query($con, $querymrequests2);
while($rowmrequests2 = mysqli_fetch_array($resultmrequests2)){
	$ammountmrequests += $rowmrequests2['ammount'];
}
$nummrequests2 = mysqli_num_rows($resultmrequests2);

$mcancellationrequests = ($nummrequests2*100)/$nummrequests1;
$mcancellationrequests = number_format($mcancellationrequests, 2);
$mcancellationrequests = str_replace('.00','',$mcancellationrequests); 

?>
								<div class="col-md-3">

									<div class="easy-pie-chart">
                                    <?php //Cordobas ?>

										<div class="number <?php if($mcancellationrequests < 61) echo "bounce";
										if(($mcancellationrequests > 60) and ($mcancellationrequests <= 86)) echo "transactions";
										if($mcancellationrequests > 86) echo "visits";
									 
										?>" data-percent="<?php echo $mcancellationrequests."%"; ?>">

											<span>

											<?php echo $mcancellationrequests; ?>%</span>


										</div> 
                                         

						<br>

										C$<?php echo str_replace('.00','',number_format($ammountmrequests,2)); ?>
                                    <br>
Pagos totales: <?php echo $nummrequests1; ?><br>
Esta unidad: <?php echo $nummrequests2; ?>  
				
									</div>
<br><br><br>
								</div>
 
    <br><br><br>
<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Rubros más importantes 

						  </div>

							<div class="actions">

								<?php ?>
                             
													  <div class="form-group" style="margin-top:-20px; margin-bottom:0px;">

													
															<select name="type" class="form-control" id="type" onchange="javascript:reloadProviders(this.value);">
														<option value="0">Cordobas</option>
														<option value="1">Dolares</option>
														<option value="2">Euros</option>
														<option value="3">Yenes</option>
                                                  
													
	 														</select>

													  </div>

												
                                <?php //end?> 
                                
                              <?php /*  <a href="javascript:reloadProviders(0);" class="btn default blue-stripe">
								Todas </a> 
                                	 <a href="javascript:reloadProviders(1);" class="btn default blue-stripe">
								Casa Pellas </a> <a href="javascript:reloadProviders(2);" class="btn default blue-stripe">
								Alpesa </a> <a href="javascript:reloadProviders(3);" class="btn default blue-stripe">
								Velosa </a> <a href="javascript:reloadProviders(4);" class="btn default blue-stripe">
								Otras </a>*/ ?>
                                
                               <script>
                                function reloadProviders(id){	

	$.post("dashboard-manager-subjects.php", { company: id }, function(data){
		$("#rsubjects").html(data);
		
});			
}

	</script>						

							</div>

						</div>
                        </div>
                        <div id="rsubjects">
<?php $today = date('Y-m-d');
$querypresidentconcepts1 = "select sum(payments.payment), payments.concept2 from payments inner join workers on payments.userid = workers.code where payments.concept = '27' and payments.status = '14' and payments.currency = '1' group by payments.concept2 order by sum(payments.payment) desc limit 10";
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
        
        </div>