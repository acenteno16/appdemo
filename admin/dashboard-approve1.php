   <ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>
                            
                            	<i class="fa fa-angle-right"></i>

						</li>

<li>

					

							<a href="#">Aprobado 1</a>

						</li>

						


					</ul>
           <div class="row">

				  <?php //SOLICITADOS ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="icon-plus"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $query = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.status = 1 and payments.approved = 0".$sqlu." order by payments.expiration desc"; 
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								 echo $num;
								 ?>

							</div>

							<div class="desc">

								Pendientes</div>

						</div>

					

					</div>
                    

				</div>
                <?php //RECHAZADOS ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat red-intense">

						
                        <div class="visual">

							<i class="icon-trash"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $queryrequestrejected = "select payments.* from payments inner join times on payments.id = times.payment where payments.approved = '2' and payments.userid='$_SESSION[userid]' and (times.stage = '5' or times.stage='6' or times.stage='7') and YEAR(times.today) = '$year' and MONTH(times.today) = '$month'";
								 $resultrequestrejected = mysqli_query($con, $queryrequestrejected);
								 $numrequestrejected = mysqli_num_rows($resultrequestrejected);
								 echo $numrequestrejected;
								 ?>

							</div>

							<div class="desc">

								Rechazados</div>

						</div>

					

					</div>
                    

				</div>
                <?php //Prom de solicitudes ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="icon-calculator"></i>

						</div>

						<div class="details">

							<div class="number">

								 <?php $query = "select * from payments where userid = '$_SESSION[userid]' and YEAR(today) = '$year' and MONTH(today) = '$month'";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo number_format($num/date('d'), 2); 
								 
								 
								  
								 ?>

							</div>

							<div class="desc">

								PROM diario</div>

						</div>

					

					</div>
                    

				</div>
                
                <?php //Pagos cancelados ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue">

						
                        <div class="visual">

							<i class="fa fa-check"></i>

						</div>

						<div class="details">

							<div class="number">

							<?php $query = "select * from payments where userid = '$_SESSION[userid]' and YEAR(today) = '$year' and MONTH(today) = '$month' and status='14'";
								 $result = mysqli_query($con, $query);
								 $num = mysqli_num_rows($result);
								 echo $num; 
								 
								 
								  
								 ?>
							</div>

							<div class="desc">

								Liberados</div>

						</div>

					

					</div>
                    

				</div>
              
           </div>
          <br>
           <?php if($numrequestrejected > 0){ ?>
           <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos rechazados

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

								<?php $query = "select payments.* from payments inner join times on payments.id = times.payment where payments.approved = '2' and payments.userid='$_SESSION[userid]' and (times.stage = '5' or times.stage='6' or times.stage='7') and YEAR(times.today) = '$year' and MONTH(times.today) = '$month' limit 10";
								$result = mysqli_query($con, $query);  
								$num = mysqli_num_rows($result);
								if($num > 0){ ?>
                                
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
                                <?php while($row=mysqli_fetch_array($result)){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td><td><?php echo $rowprovider['name']; ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); ?></td><td><?php echo $rowprovider['term']; ?> días</td><td><?php echo $rowstage['content']; ?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
								
								<?php }else{ ?>
                                <div class="note note-info">
No hay devoluciones.</div>
<?php } ?>
                                   

						</div>

					</div>

					<!-- End: life time stats -->

				</div>

			</div> 

			<!-- END PAGE CONTENT-->

		</div>
        <?php } ?>
         <br>
           <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos pendientes por aprobar

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

								<?php $query = "select * from payments where userid = '$_SESSION[userid]' and approved='1' and status < '14'";
								$result = mysqli_query($con, $query);  
								$num = mysqli_num_rows($result);
								if($num > 0){ ?>
                                
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
                                <?php while($row=mysqli_fetch_array($result)){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td><td><?php echo $rowprovider['name']; ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); ?></td><td><?php echo $rowprovider['term']; ?> días</td><td><?php echo $rowstage['content']; ?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
								
								<?php }else{ ?>
                                <div class="note note-info">
No hay pagos pendientes por aprobar en esta etapa.</div>
<?php } ?>
                                   

						</div>

					</div>

					<!-- End: life time stats -->

				</div>

			</div>

			<!-- END PAGE CONTENT-->

		</div>