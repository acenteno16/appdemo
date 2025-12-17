<ul class="page-breadcrumb breadcrumb">

						<li>
                        <i class="fa fa-home"></i>
                        <a href="dashboard.php">Inicio</a>
                        <i class="fa fa-angle-right"></i>
                      </li>
                      <li>
                      	<a href="#">Gerente de Línea</a>
                      </li>
</ul>

<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Últimos 10 pagos cancelados 

						  </div>
<div class="actions">

							
                                
                                <?php $querycurrency = "select * from currency";
								$resultcurrency = mysqli_query($con, $querycurrency);
								while($rowcurrency = mysqli_fetch_array($resultcurrency)){
								?> 
								
								<a href="javascript:reloadmcpayments(<?php echo $rowcurrency['id']; ?>);" class="btn default blue-stripe">

							

								<span class="hidden-480">

								<?php echo $rowcurrency['name']; ?></span>

								</a>
								
								<?php } ?>

							

							</div>
							

						</div>

						<div class="portlet-body">

							<div class="table-container" id="mcpayments">

								

								<?php $today = date('Y-m-d'); 
								$querymcpayment = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.status = '14' and payments.currency = '1' and workers.unit = '$_SESSION[unit]' limit 10";
								$resultmcpayment = mysqli_query($con, $querymcpayment);  
								$nummcpayment = mysqli_num_rows($resultmcpayment);
								if($nummcpayment > 0){  
								
								?>
                                
                               <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 ID</th>

									<th width="5%">

										 Código</th>

									<th width="17%">

										 Nombre</th>

									<th width="11%">Total Pagar</th>

									<th width="5%">

										 Vencimiento

									</th>

									<th width="14%">

										 Estado

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($rowmcpayment=mysqli_fetch_array($resultmcpayment)){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$rowmcpayment[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$rowmcpayment[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$rowmcpayment[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowmcpayment['id']; ?></td><td><?php echo $rowprovider['code']; ?></td><td><?php echo $rowprovider['name']; ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($rowmcpayment['payment'], 2)); ?></td><td><?php echo $rowprovider['term']; ?> días</td><td><?php echo $rowstage['content']; ?> 
									
							
								
							</td><td><a href="payment-view.php?id=<?php echo $rowmcpayment['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                               
                            
                                
								
								<?php }else{ ?>
                                <div class="note note-info">
No hay registros.</div>
<?php } ?>
                                   

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
                
 <script>
                
	  function reloadmcpayments(currency){ 
		  
		$.post("reload-mcpayments.php", { currency: currency }, function(data){
		$("#mcpayments").html(data); 
	
});


	  }
	
  
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
		height: 400px;
	}
	#placeholder {
		width: 550px;
	}
	#description {
		margin: 15px 10px 20px 10px;
	}
	</style>
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->

	<script type="text/javascript">

	$(function() {

		// Example Data

		//var data = [
		//	{ label: "Series1",  data: 10},
		//	{ label: "Series2",  data: 30},
		//	{ label: "Series3",  data: 90},
		//	{ label: "Series4",  data: 70},
		//	{ label: "Series5",  data: 80},
		//	{ label: "Series6",  data: 110}
		//];

		//var data = [
		//	{ label: "Series1",  data: [[1,10]]},
		//	{ label: "Series2",  data: [[1,30]]},
		//	{ label: "Series3",  data: [[1,90]]},
		//	{ label: "Series4",  data: [[1,70]]},
		//	{ label: "Series5",  data: [[1,80]]},
		//	{ label: "Series6",  data: [[1,0]]}
		//];

		//var data = [
		//	{ label: "Series A",  data: 0.2063},
		//	{ label: "Series B",  data: 38888}
		//];

		// Randomly Generated Data

		var data = [];
			

		<?php $today = date('Y-m-d');
		//$query = "select count(*) as GroupAmount, status from payments where (status = '1' or status = '2' or status = '3' or status = '4' or status = '8' or status = '9' or status = '12' or status = '13') group by status";
		$query = "select count(*) as GroupAmount, payments.status from payments inner join workers on payments.userid = workers.code where (payments.status = '1' or payments.status = '2' or payments.status = '3' or payments.status = '4' or payments.status = '8' or payments.status = '9' or payments.status = '12' or payments.status = '13') and workers.unit = '$_SESSION[unit]' group by payments.status";
		$result = mysqli_query($con, $query); 
		$inc = 0;
		while($row=mysqli_fetch_array($result)){
			
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$row[1]'"));
		?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name']; ?>",
				data: <?php echo $row['GroupAmount']; ?>,
			} 
		<?php } ?>
		<?php $today = date('Y-m-d');
		$query = "select count(*) as GroupAmount, status from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code where times.stage = '14' and YEARWEEK(times.today) = YEARWEEK(CURRENT_DATE) and workers.unit = '$_SESSION[unit]' group by times.stage";
		$result = mysqli_query($con, $query); 
		while($row=mysqli_fetch_array($result)){
			
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$row[1]'"));
		?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name']; ?>",
				data: <?php echo $row['GroupAmount']; ?>,
			} 
		<?php } ?>
		
		
			

		var placeholder = $("#placeholder");

		
			placeholder.unbind();

			$.plot(placeholder, data, {
				series: {
					pie: { 
						 innerRadius: 0.3,
						show: true,
						combine: {
                color: '#999',
                threshold: 0.05,
				label: 'Otras etapas'
            }
					}
				},
				legend: {
					show: false
				}
			});

			
		
	});

	// A custom label formatter used by several of the plots

	function labelFormatter(label, series) {
		return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
	}

	//
	</script>


                        
<div class="row">

<div class="col-md-6">
    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos según etapa 

						  </div>

							

						</div>
                        </div>
                        
                        

		<div class="demo-container" style="text-align:center">
			<div id="placeholder" class="demo-placeholder"></div>
		
		</div>

 
</div>

<div class="col-md-6">
<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Representación del gasto total:
                                
                                

						  </div>

							

						</div>
                        
                       
                        </div>  
<div class="portlet-body">
    
    
    <?php //Total expense Casa Pellas
	
	//NIO
	$querymbudget1a = "select sum(payments.payment) as totalpayment from payments inner join times on payments.id = times.payment where payments.currency = '1' and times.stage = '14' and YEARWEEK(times.today) = YEARWEEK(CURRENT_DATE)";
	$resultmbudget1a = mysqli_query($con, $querymbudget1a);
	$rowmbudget1a = mysqli_fetch_array($resultmbudget1a);
	$mtotalpaymenta = $rowmbudget1a['totalpayment'];
	//USD
	$querymbudget1b = "select sum(payments.payment) as totalpayment from payments inner join times on payments.id = times.payment where payments.currency = '2' and times.stage = '14' and YEARWEEK(times.today) = YEARWEEK(CURRENT_DATE)";
	$resultmbudget1b = mysqli_query($con, $querymbudget1b);
	$rowmbudget1b = mysqli_fetch_array($resultmbudget1b);
	$mtotalpaymentb = $rowmbudget1b['totalpayment'];
	//EUR
	$querymbudgetc = "select sum(payments.payment) as totalpayment from payments inner join times on payments.id = times.payment where payments.currency = '4' and times.stage = '14' and YEARWEEK(times.today) = YEARWEEK(CURRENT_DATE)";
	$resultmbudgetc = mysqli_query($con, $querymbudgetc);
	$rowmbudget1c = mysqli_fetch_array($resultmbudget1c);
	$mtotalpaymentc = $rowmbudget1c['totalpayment'];
	//YEN
	$querymbudget1d = "select sum(payments.payment) as totalpayment from payments inner join times on payments.id = times.payment where payments.currency = '4' and times.stage = '14' and YEARWEEK(times.today) = YEARWEEK(CURRENT_DATE)";
	$resultmbudget1d = mysqli_query($con, $querymbudget1d);
	$rowmbudget1d = mysqli_fetch_array($resultmbudget1d);
	$mtotalpaymentd = $rowmbudget1d['totalpayment'];
	
	//Current unit expenses
	//
	$querymbudget2a = "select sum(payments.payment) as totalpayment from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code where payments.currency = '1' and times.stage = '14' and YEARWEEK(times.today) = YEARWEEK(CURRENT_DATE) and workers.unit = '$_SESSION[unit]'";
	$resultmbudget2a = mysqli_query($con, $querymbudget2a);
	$rowmbudget2a = mysqli_fetch_array($resultmbudget2a);
	$munitpayment2a = $rowmbudget2a['totalpayment'];
	//
	$querymbudget2b = "select sum(payments.payment) as totalpayment from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code where payments.currency = '2' and times.stage = '14' and YEARWEEK(times.today) = YEARWEEK(CURRENT_DATE) and workers.unit = '$_SESSION[unit]'";
	$resultmbudget2b = mysqli_query($con, $querymbudget2b);
	$rowmbudget2b = mysqli_fetch_array($resultmbudget2b);
	$munitpayment2b = $rowmbudget2b['totalpayment'];
	//
	$querymbudget2c = "select sum(payments.payment) as totalpayment from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code where payments.currency = '3' and times.stage = '14' and YEARWEEK(times.today) = YEARWEEK(CURRENT_DATE) and workers.unit = '$_SESSION[unit]'";
	$resultmbudget2c = mysqli_query($con, $querymbudget2c);
	$rowmbudget2c = mysqli_fetch_array($resultmbudget2c);
	$munitpayment2c = $rowmbudget2c['totalpayment'];
	//
	$querymbudget2d = "select sum(payments.payment) as totalpayment from payments inner join times on payments.id = times.payment inner join workers on payments.userid = workers.code where payments.currency = '4' and times.stage = '14' and YEARWEEK(times.today) = YEARWEEK(CURRENT_DATE) and workers.unit = '$_SESSION[unit]'";
	$resultmbudget2d = mysqli_query($con, $querymbudget2d);
	$rowmbudget2d = mysqli_fetch_array($resultmbudget2d);
	$munitpayment2d = $rowmbudget2d['totalpayment']; 
	
	$mbudgeta = ($munitpayment2a/$mtotalpaymenta)*100; 
	$mbudgetb = ($munitpayment2b/$mtotalpaymentb)*100; 
	$mbudgetc = ($munitpayment2c/$mtotalpaymentc)*100; 
	$mbudgetd = ($munitpayment2d/$mtotalpaymentd)*100; 
	?>

                            
                           <div class="row">
                            <?php //NIO  ?>
                            <div class="col-md-2">

									<div class="easy-pie-chart">

										<div class="number <?php if($mbudgeta <= 33) echo "visits";
										if(($mbudgeta > 33) and ($mbudgeta <= 66)) echo "transactions";
										if($mbudgeta > 66) echo "bounce";
									 
										?>" data-percent="<?php echo $mbudgeta; ?>">

											<span>

											<?php echo $mbudgeta; ?>%</span>


										</div>

						<br>

										NIO					
									</div>

								</div> 
                            <?php //USD  ?>
                            <div class="col-md-2">

									<div class="easy-pie-chart">

										<div class="number <?php if($mbudgetb <= 33) echo "visits";
										if(($mbudgetb > 33) and ($mbudgetb <= 66)) echo "transactions";
										if($mbudgetb > 66) echo "bounce";
									 
										?>" data-percent="<?php echo $mbudgetb; ?>">

											<span>

											<?php echo $mbudgetb; ?>%</span>


										</div>

						<br>

										USD					
									</div>

								</div>
                             
							   <?php //EUR  ?>
                            <div class="col-md-2">

									<div class="easy-pie-chart">

										<div class="number <?php if($mbudgetc <= 33) echo "visits";
										if(($mbudgetc > 33) and ($mbudgetc <= 66)) echo "transactions";
										if($mbudgetc > 66) echo "bounce";
									 
										?>" data-percent="<?php echo $mbudgetc; ?>">

											<span>

											<?php echo $mbudgetc; ?>%</span>


										</div>

						<br>

										EUR					
									</div>

								</div>
                            <?php //YEN  ?>
                            <div class="col-md-2">

									<div class="easy-pie-chart">

										<div class="number <?php if($mbudgetd <= 33) echo "visits";
										if(($mbudgetd > 33) and ($mbudgetd <= 66)) echo "transactions";
										if($mbudgetd > 66) echo "bounce";
									 
										?>" data-percent="<?php echo $mbudgetd; ?>">

											<span>

											<?php echo $mbudgetd; ?>%</span>


										</div>

						<br>

										NIO					
									</div>

								</div>    
                            </div>
                            
                           </div> 
</div>
                           
</div>

