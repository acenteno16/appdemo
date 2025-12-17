   <ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>
                            
                            	<i class="fa fa-angle-right"></i>

						</li>

<li>

					

							<a href="#">Gerente Financiero</a>

						</li>

						


					</ul>
                    

            
                        <div class="portlet-title">

							<div class="caption">

								<h4>Gastos de pagos cancelados por gerente de linea</h4>

							</div>

							

						</div><br><br>

	<div class="portlet-body">
    
    
    

							<div class="row">
                            
<?php //$querycammountbefore = "select sum(payments.payment), workers.unit from payments inner join workers on payments.userid = workers.code where payments.status = '14' group by workers.unit limit 12";
$querycammountbefore = "select sum(payments.payment), workers.unit from payments inner join workers on payments.userid = workers.code where payments.status = '14' group by workers.unit";
$resultcammountbefore = mysqli_query($con, $querycammountbefore);
while($rowcammountbefore=mysqli_fetch_array($resultcammountbefore)){
	$total += $rowcammountbefore[0];
}


//$querycammount = "select sum(payments.payment), workers.unit from payments inner join workers on payments.userid = workers.code where payments.status = '14' group by workers.unit limit 12";
$querycammount = "select sum(payments.payment), workers.unit from payments inner join workers on payments.userid = workers.code where payments.status = '14' and payments.currency='1' group by workers.unit limit 12";
$resultcammount = mysqli_query($con, $querycammount);
$numcammount = mysqli_num_rows($resultcammount);
while($rowcammount=mysqli_fetch_array($resultcammount)){

$querylmanager0 = "select * from routes where type='14' and unit = '$rowcammount[1]'";
$resultlmanager0 = mysqli_query($con, $querylmanager0);
$rowlmanager0 = mysqli_fetch_array($resultlmanager0);

$querylmanager1 = "select * from workers where code = '$rowlmanager0[worker]'";
$resultlmanager1 = mysqli_query($con, $querylmanager1);
$numlmanager1 = mysqli_num_rows($resultlmanager1);
$rowlmanager1 = mysqli_fetch_array($resultlmanager1);

$percent = ($rowcammount[0]*100)/$total;
$percent = number_format($percent, 2);
$percent = str_replace('.00','',$percent)

?>
								<div class="col-md-3">

									<div class="easy-pie-chart">

										<div class="number <?php if($percent <= 33) echo "visits";
										if(($percent > 33) and ($percent <= 66)) echo "transactions";
										if($percent > 66) echo "bounce";
									 
										?>" data-percent="<?php echo $percent; ?>">

											<span>

											<?php echo $percent; ?>%</span>


										</div>

						<br>

										<?php echo 'NIO C$'.str_replace('.00','',number_format($rowcammount[0],2)); ?><br>
<?php if($numlmanager1 != 0){
	echo $rowlmanager1['first']." ".$rowlmanager1['last']."<br>"; 
}
	echo $rowcammount[1]; 	


?> 					
									</div>

								</div>

								
<?php } ?>
								</div>

								

								

								
                                
                                

							</div><br><br><br>
                            
                               <div class="portlet-title">

							

							<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								10 proveedores más importantes 

						  </div>
<div class="actions">

							
                                
                                <?php $querycurrency = "select * from currency";
								$resultcurrency = mysqli_query($con, $querycurrency);
								while($rowcurrency = mysqli_fetch_array($resultcurrency)){
								?> 
								
								<a href="javascript:reloadfmproviders(<?php echo $rowcurrency['id']; ?>);" class="btn default blue-stripe">

							

								<span class="hidden-480">

								<?php echo $rowcurrency['name']; ?></span>

								</a>
								
								<?php } ?>

							

							</div>
							

						</div>

						<div class="portlet-body">

							<div class="table-container" id="fmproviders">

								

								<?php $today = date('Y-m-d'); 
								$querypresidentprovider1 = "select sum(payment), provider, currency from payments where status = '14' and currency = '1' and WEEK('$today') group by provider order by sum(payment) desc limit 10";
								$resultpresidentprovider1 = mysqli_query($con, $querypresidentprovider1);  
								$numpresidentprovider1 = mysqli_num_rows($resultpresidentprovider1);
								if($numpresidentprovider1 > 0){ 
								
								
								
								?>
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 Código</th>

									<th width="20%">

										 Nombre</th>

									<th width="7%">

										 Monto</th>

									

									
									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($rowpresidentprovider1=mysqli_fetch_array($resultpresidentprovider1)){
									
									$querypresidentprovider2 = "select * from providers where id = '$rowpresidentprovider1[1]'";
								$resultpresidentprovider2 = mysqli_query($con, $querypresidentprovider2);
								$rowpresidentprovider2 = mysqli_fetch_array($resultpresidentprovider2);
								$querypresidentprovider3 = "select * from currency where id = $rowpresidentprovider1[2]";
									$resultpresidentprovider3 = mysqli_query($con, $querypresidentprovider3);
									$rowpresidentprovider3 = mysqli_fetch_array($resultpresidentprovider3);
									
								
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowpresidentprovider2['code']; ?></td>
                                <td><?php echo $rowpresidentprovider2['name']; ?></td>
                                <td><?php echo $rowpresidentprovider3['pre'].' '.$rowpresidentprovider3['symbol'].$rowpresidentprovider1[0]; ?></td>
                            		<td><a href="#" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td>
                            </tr>
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

			</div>

						</div><br><br>

						</div><br>


    <script>
	  function reloadfmproviders(provider){
	 
  $.post("reload-fmproviders.php", { variable: provider }, function(data){
		$("#fmproviders").html(data);
	
});
	  }
	</script>        
            
           <div class="portlet-title">

							

							<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Historial de pago por proveedor 

						  </div>

							

						</div>
                        
                        	<div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

										

										</div>

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="" class="horizontal-form" method="get" enctype="multipart/form-data"> 

											<div class="form-body">

											

												<div class="row"><!--/span-->

												  <div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value=""></option>
<?php $queryproviders = "select * from providers";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?>
												<option value="<?php echo $rowproviders['id']; ?>"><?php echo $rowproviders['code']." | ".$rowproviders['name']; ?></option>
                                                <?php } ?>

												

											</select>

															<div title="Page 5">
															  <div>
															    <div>
															     <span class="help-block">

															 Ingrese código, nombre o parte de el para filtar los resultados.</span>
														        </div>
														      </div>
													    </div>
													  </div>

													</div>
                                                    <div class="col-md-4">
                                                    <label class="control-label">Rango de Fechas:</label>

											<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">

												<input type="text" class="form-control" name="vfrom" placeholder="desde" id="vfrom">

												<span class="input-group-addon">

												<i class="fa fa-angle-double-right"></i></span>

												<input type="text" class="form-control" name="vto" placeholder="hasta" id="vto">

											</div>

											<!-- /input-group -->

											
										</div>  

													<!--/span-->

												</div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

											<!--/row--><!--/row--></div>


											<div class="form-actions right">


												<button type="button" onClick="javascript:fmphistory();" class="btn blue"><i class="fa fa-check"></i> Buscar</button>

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div>

	<script>
	  function fmphistory(page){ 
		  var vprovider=document.getElementById("provider").value;
		  var vfrom=document.getElementById("vfrom").value;
		  var vto=document.getElementById("vto").value;
		  
		$.post("reload-fmphistory.php", { vprovider: vprovider, vfrom: vfrom, vto: vto, page: page, }, function(data){
		$("#paymenthistory").html(data);
	
});


	  }
	</script>  
    	
					<div id="paymenthistory">
                    
                  </div>
                    
						

					<!-- End: life time stats -->

				</div>

			</div>

						</div><br><br>

						</div>
                        
                <div class="portlet-title">

							

							<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

					Tiempo  de cancelación global

						  </div>

							

						</div>
                        
                        	

 <?php $querygctime = "select payments.* from payments inner join times on payments.id = times.payment where times.stage = '14' and week('$today')";
$resultgctime = mysqli_query($con, $querygctime);
$numgctime = mysqli_num_rows($resultgctime);
 while($rowgctime=mysqli_fetch_array($resultgctime)){
	 $querygctimea = "select * from times where payment = '$rowgctime[id]' and stage = '1'";
	 $resultgctimea = mysqli_query($con, $querygctimea);
	 $rowgctimea = mysqli_fetch_array($resultgctimea);
	 $datea = $rowgctimea['today'];
	 
	 $querygctimeb = "select * from times where payment = '$rowgctime[id]' and stage = '14'";
	 $resultgctimeb = mysqli_query($con, $querygctimeb);
	 $rowgctimeb = mysqli_fetch_array($resultgctimeb);
	 $dateb = $rowgctimeb['today'];
	 
	 $dias	= (strtotime($datea)-strtotime($dateb))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	$alldays += $dias; 
	 
 }
 $globalctime =  $alldays/$numgctime;
 ?>
    	
						<div class="col-md-12">

									<div class="easy-pie-chart">

										<div class="number bounce" data-percent="100">

											<span style="margin-left:-10px;">
<?php echo  $globalctime; ?>d
											</span>

											

										</div>

						
                                    <a href="javascript:showtimes();">Ver unidades de negocio</a> </div>

								</div>

					<!-- End: life time stats -->

				</div>
    <div class="row">
    <br>
<br>
<br>
</div>            
              
<?php /*<div class="row">
 <?php $queryfmtimes = "select payments.id, workers.unit from payments inner join workers on payments.userid = workers.code where payments.status='14' and week('$today') group by workers.unit";
	$resultfmtimes = mysqli_query($con, $queryfmtimes);
	echo $numfmtimes = mysqli_num_rows($resultfmtimes);
	while($rowfmtimes = mysqli_fetch_array($resultfmtimes)){
		
	 $querygctimea = "select * from times where payment = '$rowfmtimes[0]' and stage = '1'";
	 $resultgctimea = mysqli_query($con, $querygctimea);
	 $rowgctimea = mysqli_fetch_array($resultgctimea);
	 $datea = $rowgctimea['today'];
	 
	 $querygctimeb = "select * from times where payment = '$rowfmtimes[0]' and stage = '14'";
	 $resultgctimeb = mysqli_query($con, $querygctimeb);
	 $rowgctimeb = mysqli_fetch_array($resultgctimeb);
	 $dateb = $rowgctimeb['today'];
	 
	 $dias	= (strtotime($datea)-strtotime($dateb))/86400;
	 $dias 	= abs($dias); 
	 $dias = floor($dias);		
 
		
	
	?> 
                <div class="col-md-3">

									<div class="easy-pie-chart">

										<div class="number bounce" data-percent="100">

											<span style="margin-left:-10px;">
<?php echo  $dias; ?>d
											</span>

											

										</div>

						
                                    <?php echo $rowfmtimes[1]; ?></div>

								</div>
                                <?php } ?>
                </div>*/ ?>

			</div>

						</div><br><br>

						</div>
                        
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
	#fmplaceholder {
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
		$query = "select count(*) as GroupAmount, status from payments where (status = '1' or status = '2' or status = '3' or status = '4' or status = '8' or status = '9' or status = '12' or status = '13') group by status";
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
		$query = "select count(*) as GroupAmount, status from payments inner join times on payments.id = times.payment where times.stage = '14' and YEARWEEK(times.today) = YEARWEEK(CURRENT_DATE) group by times.stage";
		$result = mysqli_query($con, $query); 
		while($row=mysqli_fetch_array($result)){
			
			$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$row[1]'"));
		?>
			data[<?php echo $inc; $inc++; ?>] = {
				label: "<?php echo $rowstage['name']; ?>",
				data: <?php echo $row['GroupAmount']; ?>,
			} 
		<?php } ?>
		
		
			

		var placeholder = $("#fmplaceholder");

		
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

<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos segun etapa 

						  </div>

							

						</div>
                        </div>
<div class="row">
	<div class="col-md-2">
    &nbsp;
    </div>
    <div class="col-md-3">

		<div class="demo-container" style="text-align:center">
			<div id="fmplaceholder" class="demo-placeholder"></div>
		
		</div>

 <div class="col-md-3">
    &nbsp;
    </div>
</div></div>
 