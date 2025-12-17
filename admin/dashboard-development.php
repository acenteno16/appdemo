<? 
$invalid = '';
?>
<div class="row">
<div class="col-md-12">

   <ul class="page-breadcrumb breadcrumb" style="background-color:#9eca41;">

						<li>

							<i class="fa fa-code" style="color:#FFFFFF;"></i>

							<a href="dashboard.php" style="color:#FFFFFF;">Desarrollo</a>
                            
                     

						</li>



						


					</ul>
        
       
           <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

						<div class="caption">Últimos requerimientos</div> 
							
						<div class="actions">

								<a href="development-add.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Nuevo requerimiento</span>

								</a>

							

							</div>
							</div>
						

						<div class="portlet-body">

							<div class="table-container">

								

								<?php 
								
								include_once("sessions.php");
								
								
								$queryDevelopment = "select * from development order by status asc, id desc limit 5";
								$resultDevelopment = mysqli_query($con, $queryDevelopment);  
								$numDevelopment = mysqli_num_rows($resultDevelopment); 
								if($numDevelopment > 0){ ?>
                                
                                <style type="text/css">
								@-webkit-keyframes invalid {
  from { background-color: #1ec0f1; }
  to { background-color: inherit; }
}
@-moz-keyframes invalid {
  from { background-color: #1ec0f1; }
  to { background-color: inherit; }
}
@-o-keyframes invalid {
  from { background-color: #1ec0f1; }
  to { background-color: inherit; }
}
@keyframes invalid {
  from { background-color: #1ec0f1; }
  to { background-color: inherit; }
}
.invalid {
  -webkit-animation: invalid 2s infinite; /* Safari 4+ */
  -moz-animation:    invalid 2s infinite; /* Fx 5+ */
  -o-animation:      invalid 2s infinite; /* Opera 12+ */
  animation:         invalid 2s infinite; /* IE 10+ */
}		
								</style>

						<div class="table-scrollable">
								<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									
									
                                         <th width="5%">

										 Fecha</th>
                                         <th width="17%">

										 Titulo</th>
										  <th width="5%">

										 Prioridad</th>
										 
										 <th width="5%">

										 Estado</th>
										 
										 <th width="5%">

										 Usuario</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
								while($rowDevelopment=mysqli_fetch_array($resultDevelopment)){
								
								$querydu = "select first, last from workers where code = '$rowDevelopment[userid]'";
								$resultdu = mysqli_query($con, $querydu);
								$rowdu = mysqli_fetch_array($resultdu);
								$devusername = $rowdu['first']." ".$rowdu['last'];
								
								switch($rowDevelopment['status']){
									   case  0:
												$status_name = "Pendiente";
												$status_color = "";
												break;
											case 1:
												$status_name = "Rechazado";
												$status_color = "danger";
												break;
											case 2:
												$status_name = "Solucionado";
												$status_color = "active";
											
												break;
											case 3:
												$status_name = "En desarrollo";
												$status_color = "warning";
												break;
											case 4:
												$status_name = "Finalizado";
												$status_color = "success";
												break;
										} 
									
								?>
                                
                                <tr role="row" class="odd <? echo $status_color; ?>"> 
                                <td <? echo $invalid; ?>><?php echo $rowDevelopment['today']; ?></td>
                                <td <? echo $invalid; ?>><?php echo $rowDevelopment['name']; ?></td>
                                <td <? echo $invalid; ?>><? 
									//echo $row['priority'];
									switch($rowDevelopment['priority']){
									case 0:
									echo "Baja";
									break;
									case 1:
									echo "Media";
									break;
									case 2:
									echo "Alta";
									break;
									case 3:
									echo "Máxima";
									break;
								}
									?></td>
                               <td <? echo $invalid; ?>><? echo $status_name;
									?></td>
									<td><? echo $devusername; ?></td>
                                <td <? echo $invalid; ?>><a href="development-view.php?id=<?php echo $rowDevelopment['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } ?>
                                </tbody>

								</table>
								</div>
								<p><a href="development.php">Ver requerimientos</a></p> 
                               
                               <? /*<hr>
								<p><a href="email-cancellation.php" target="_blank">Ver Correo Ejemplo</p>
                               <hr>*/ ?>
                                
								
								<?php }else{ ?>
                                <div class="note note-success">
No hay requerimientos.</div>
<?php } ?>
                                   

						</div>

					</div>

					<!-- End: life time stats -->

				</div>

			</div> 

			<!-- END PAGE CONTENT-->

		</div>
     
	
	<ul class="page-breadcrumb breadcrumb" style="background-color:#000000;">

						<li>

							<i class="fa fa-code" style="color:#FFFFFF;"></i>

							<a href="dashboard.php" style="color:#FFFFFF;">Mod Seguridad</a>
                            
                     

						</li>



						


					</ul>
	
	<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

						<div class="caption">Ususarios </div> 
							
						
							</div>
						

						<div class="portlet-body">

							<div class="table-container">

								

								<?php 
								
							
								
								$querySecurity = "select * from paymentsRecords order by id desc limit 5";
								$resultSecurity = mysqli_query($con, $querySecurity);  
								$numSecurity = mysqli_num_rows($resultSecurity); 
								if($numSecurity > 0){ ?>
                                
                                

						<div class="table-scrollable">
								<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									
									
                                         <th width="5%">

										 Fecha</th>
                                         <th width="5%">

										 Hora</th>
										  <th width="30%">

										Usuario</th>
										 
										 <th width="5%">

										 Pago</th>
										 
									
										 
										

									

								</tr>

								</thead>

								<tbody>
                                <?php 
								while($rowSecurity=mysqli_fetch_array($resultSecurity)){
								
								$querydu = "select first, last from workers where code = '$rowSecurity[userid]'";
								$resultdu = mysqli_query($con, $querydu);
								$rowdu = mysqli_fetch_array($resultdu);
								$devusername = $rowdu['first']." ".$rowdu['last'];
								
								
									
								?>
                                
                                <tr role="row" class="odd <? echo $status_color; ?>"> 
                                <td><?php echo $rowSecurity['today']; ?></td>
                                <td><?php echo $rowSecurity['totime']; ?></td>
                                <td><? echo $devusername; ?></td>
									<td><? echo $rowSecurity['payment']; ?></td>
                               <? /* <td <? echo $invalid; ?>><a href="development-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td>
									*/ ?></tr>
                                <?php } ?>
                                </tbody>

								</table>
								</div>
						<a href="precords.php">Ver más</a>
                               
                               <? /*<hr>
								<p><a href="email-cancellation.php" target="_blank">Ver Correo Ejemplo</p>
                               <hr>*/ ?>
                                
								
								<?php }else{ ?>
                                <div class="note note-success">
No hay requerimientos.</div>
<?php } ?>
                                   

						</div>

					</div>

					<!-- End: life time stats -->

				</div>

			</div> 

			<!-- END PAGE CONTENT-->

		</div>
         
        </div>
        </div>
        <div class="row"></div>