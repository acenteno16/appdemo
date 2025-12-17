   <ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>
                            
                            	<i class="fa fa-angle-right"></i>

						</li>

<li>

					

							<a href="#">Presidente</a>

						</li>

						


					</ul>
                    
<?php /*<div class="row">

				<div class="col-md-12 col-sm-12">

					<!-- BEGIN PORTLET-->

					<div class="portlet solid bordered grey-cararra">

						<div class="portlet-title">

							<div class="caption">

								<i class="fa fa-bar-chart-o"></i>Monto gastado en pagos cancelados

							</div>

							<div class="tools">

								<div class="btn-group" data-toggle="buttons">

									<label class="btn grey-steel btn-sm active">

									<input type="radio" name="options" class="toggle" id="option1">Cordobas</label>

									<label class="btn grey-steel btn-sm">

									<input type="radio" name="options" class="toggle" id="option2">Dolares</label>

								</div>

							</div>

						</div>

						<div class="portlet-body">

							<div id="site_statistics_loading">

								<img src="../assets/admin/layout/img/loading.gif" alt="loading"/>

							</div>

							<div id="site_statistics_content" class="display-none">

								<div id="site_statistics" class="chart">

								</div>

							</div>

						</div>

					</div>

					<!-- END PORTLET-->

				</div>

				

			</div>*/ ?>
            
                        <div class="portlet-title">

							<div class="caption">

								<h4>Pagos cancelados por linea</h4>

							</div>

							

						</div><br><br>

	<div class="portlet-body">
    
    
    

							<div class="row">
                            
<?php $querycammountbefore = "select sum(payments.payment), workers.unit from payments inner join workers on payments.userid = workers.code where payments.status = '14' group by workers.unit limit 12";
//$querycammountbefore = "select sum(payments.payment), workers.unit from payments inner join workers on payments.userid = workers.code group by workers.unit limit 12";
$resultcammountbefore = mysqli_query($con, $querycammountbefore);
while($rowcammountbefore=mysqli_fetch_array($resultcammountbefore)){
	$total += $rowcammountbefore[0];
}

$querycammount = "select sum(payments.payment), workers.unit from payments inner join workers on payments.userid = workers.code where payments.status = '14' group by workers.unit limit 12";
//$querycammount = "select sum(payments.payment), workers.unit from payments inner join workers on payments.userid = workers.code group by workers.unit limit 12";
$resultcammount = mysqli_query($con, $querycammount);
$numcammount = mysqli_num_rows($resultcammount);
while($rowcammount=mysqli_fetch_array($resultcammount)){

$querylmanager0 = "select * from routes where type='14' and unit = '$rowcammount[1]'";
$resultlmanager0 = mysqli_query($con, $querylmanager0);
$rowlmanager0 = mysqli_fetch_array($resultlmanager0);

$querylmanager1 = "select * from workers where code = '$rowlmanager0[worker]'";
$resultlmanager1 = mysqli_query($con, $querylmanager1);
$rowlmanager1 = mysqli_fetch_array($resultlmanager1);

$percent = ($rowcammount[0]*100)/$total;
$percent = number_format($percent, 2);
$percent = str_replace('.00','',$percent)

?>
								<div class="col-md-3">

									<div class="easy-pie-chart">

										<div class="number transactions" data-percent="<?php echo $percent; ?>">

											<span>

											<?php echo $percent; ?>%</span>

											

										</div>

						<br>

										<?php echo 'NIO C$'.str_replace('.00','',$rowcammount[0]); ?><br>
<?php echo $rowlmanager1['first']." ".$rowlmanager1['last']; ?> 					
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

								10 proveedores más importantes (Cordobas)

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

								<?php $querypresidentprovider1 = "select sum(payment), provider from payments where status = '14' and currency='1' group by provider order by sum(payment) desc limit 10";
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

									<th width="5%">

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
								
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowpresidentprovider2['code']; ?></td>
                                <td><?php echo $rowpresidentprovider2['name']; ?></td>
                                <td><?php echo $rowpresidentprovider1[0]; ?></td>
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

						</div>




<?php //////////////////////
//////////////////////
//////////////////////
//////////////////////
////////////////////////////////////////////
////////////////////// ?>





                    
<?php /*<div class="row">

				<div class="col-md-12 col-sm-12">

					<!-- BEGIN PORTLET-->

					<div class="portlet solid bordered grey-cararra">

						<div class="portlet-title">

							<div class="caption">

								<i class="fa fa-bar-chart-o"></i>Monto gastado en pagos cancelados

							</div>

							<div class="tools">

								<div class="btn-group" data-toggle="buttons">

									<label class="btn grey-steel btn-sm active">

									<input type="radio" name="options" class="toggle" id="option1">Cordobas</label>

									<label class="btn grey-steel btn-sm">

									<input type="radio" name="options" class="toggle" id="option2">Dolares</label>

								</div>

							</div>

						</div>

						<div class="portlet-body">

							<div id="site_statistics_loading">

								<img src="../assets/admin/layout/img/loading.gif" alt="loading"/>

							</div>

							<div id="site_statistics_content" class="display-none">

								<div id="site_statistics" class="chart">

								</div>

							</div>

						</div>

					</div>

					<!-- END PORTLET-->

				</div>

				

			</div>*/ ?>
            
                        <div class="portlet-title">

							<div class="caption">

								<h4>Pagos cancelados por linea</h4>

							</div>

							

						</div><br><br>

	<div class="portlet-body">
    
    
    

							<div class="row">
                            
<?php $querycammountbefore = "select sum(payments.payment), workers.unit from payments inner join workers on payments.userid = workers.code where payments.status = '14' group by workers.unit limit 12";
//$querycammountbefore = "select sum(payments.payment), workers.unit from payments inner join workers on payments.userid = workers.code group by workers.unit limit 12";
$resultcammountbefore = mysqli_query($con, $querycammountbefore);
while($rowcammountbefore=mysqli_fetch_array($resultcammountbefore)){
	$total += $rowcammountbefore[0];
}

$querycammount = "select sum(payments.payment), workers.unit from payments inner join workers on payments.userid = workers.code where payments.status = '14' group by workers.unit limit 12";
//$querycammount = "select sum(payments.payment), workers.unit from payments inner join workers on payments.userid = workers.code group by workers.unit limit 12";
$resultcammount = mysqli_query($con, $querycammount);
$numcammount = mysqli_num_rows($resultcammount);
while($rowcammount=mysqli_fetch_array($resultcammount)){

$querylmanager0 = "select * from routes where type='14' and unit = '$rowcammount[1]'";
$resultlmanager0 = mysqli_query($con, $querylmanager0);
$rowlmanager0 = mysqli_fetch_array($resultlmanager0);

$querylmanager1 = "select * from workers where code = '$rowlmanager0[worker]'";
$resultlmanager1 = mysqli_query($con, $querylmanager1);
$rowlmanager1 = mysqli_fetch_array($resultlmanager1);

$percent = ($rowcammount[0]*100)/$total;
$percent = number_format($percent, 2);
$percent = str_replace('.00','',$percent)

?>
								<div class="col-md-3">

									<div class="easy-pie-chart">

										<div class="number transactions" data-percent="<?php echo $percent; ?>">

											<span>

											<?php echo $percent; ?>%</span>

											

										</div>

						<br>

										<?php echo 'NIO C$'.str_replace('.00','',$rowcammount[0]); ?><br>
<?php echo $rowlmanager1['first']." ".$rowlmanager1['last']; ?> 					
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

								10 proveedores más importantes (Cordobas)

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

								<?php $querypresidentprovider1 = "select sum(payment), provider from payments where status = '14' and currency='1' group by provider order by sum(payment) desc limit 10";
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

									<th width="5%">

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
								
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowpresidentprovider2['code']; ?></td>
                                <td><?php echo $rowpresidentprovider2['name']; ?></td>
                                <td><?php echo $rowpresidentprovider1[0]; ?></td>
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

						</div>


            
            
           
            
            
           