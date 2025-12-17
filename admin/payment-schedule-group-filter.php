 <form id="ungrouped" name="ungrouped" action="<? echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">  
<div class="note note-regular">
 

                             
<div class="row">
<br>
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Procesador de pago:</label>

						
											<select name="blocked" class="form-control  select2me" id="blocked" data-placeholder="Seleccionar...">

												<option value="" selected>Todos los Procesadores</option>
 <?php
 /*
 $queryprocessor0 = "select * from schedule group by userid";
 $resultprocessor0 = mysqli_query($con, $queryprocessor0);
 while($rowprocessor0=mysqli_fetch_array($resultprocessor0)){

 $rowprocessor = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$rowprocessor0[userid]'")); 

 ?>
 <option value="<?php echo $rowprocessor["code"]; ?>" <? if($_GET['blocked'] == $rowprocessor["code"]) echo 'selected'; ?>><?php echo $rowprocessor["code"].' | '.$rowprocessor["first"]." ".$rowprocessor["last"]; ?></option>
 <?php }*/
											?>
												
												<?php
 
													/*$queryprocessor0 = "select blockschedule from payments where blockschedule != '' group by blockschedule";
 												$resultprocessor0 = mysqli_query($con, $queryprocessor0);
 												$numprocessor0 = mysqli_num_rows($resultprocessor0); 
												
 while($rowprocessor0=mysqli_fetch_array($resultprocessor0)){
	 
 if($rowprocessor0['blockschedule'] != ""){
 $rowprocessor = mysqli_fetch_array(mysqli_query($con, "select code, first, last from workers where code = '$rowprocessor0[blockschedule]'"));
 
 ?>
 <option value="<?php echo $rowprocessor["code"]; ?>"><?php echo $rowprocessor["code"].' | '.$rowprocessor["first"]." ".$rowprocessor["last"]; ?></option>
 <?php } }
											*/ $querypp = "select * from routes where type = '7' group by worker";
									$resultpp = mysqli_query($con, $querypp);
									$numpp = mysqli_num_rows($resultpp);
									while($rowpp = mysqli_fetch_array($resultpp)){
										
											$queryProcessorUser= "select code, first, last from workers where code = '$rowpp[worker]'";
											$resultProcessorUser = mysqli_query($con, $queryProcessorUser); 
											$rowProcessorUser = mysqli_fetch_array($resultProcessorUser);
										
										?>
												 <option value="<?php echo $rowProcessorUser["code"]; ?>"><?php echo $rowProcessorUser["code"].' | '.$rowProcessorUser["first"]." ".$rowProcessorUser["last"]; ?></option>
												<?
												
									   }
												?> 
												

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>                      
													  
													  <div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Proveedor:</label> 

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value="" selected>Todos los Proveedores</option>
 											<?php 
											$queryproviders = "select id, code, name from providers order by name";
											$resultproviders = mysqli_query($con, $queryproviders);
											while($rowproviders = mysqli_fetch_array($resultproviders)){
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <? if($_GET['provider'] == $rowproviders["id"]) echo 'selected'; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
											<div class="col-md-4">

													  <div class="form-group">

											<label class="control-label">Colaborador:</label>

											<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar...">

											<option value="" selected>Todos los Colaboradores</option>
 											<?php 
											$queryWorkers = "select id, code, first, last from workers order by first,last";
											$resultWorkers = mysqli_query($con, $queryWorkers);
											
											while($rowWorkers = mysqli_fetch_array($resultWorkers)){
										
											?>
                                            <option value="<?php echo $rowWorkers["id"]; ?>" <? if($_GET['worker'] == $rowWorkers["id"]) echo 'selected'; ?>><?php echo $rowWorkers["code"].' | '.$rowWorkers["first"].' '.$rowWorkers["last"]; ?></option>
                                            <?php }
											?>
											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
													
													
</div>
<div class="row">

<div class="col-md-4">

													  <div class="form-group">
													  <label class="control-label">Asignado a:</label>
											<select name="pp" class="form-control  select2me" id="pp" data-placeholder="Seleccionar...">

												<option value="">Todos los procesadores</option>
 										<?php  /*
											$querypp = "select * from routes where type = '7' group by worker";
									   		$resultpp = mysqli_query($con, $querypp);
									   		
											while($rowpp = mysqli_fetch_array($resultpp)){
										
											$queryPWorkers = "select code, first, last from workers where code = '$rowpp[worker]'";
											$resultPWorkers = mysqli_query($con, $queryPWorkers); 
											$rowPWorkers = mysqli_fetch_array($resultPWorkers);
											?>
                                            <option value="<?php echo $rowPWorkers["code"]; ?>"><?php echo $rowPWorkers["code"].' | '.$rowPWorkers["first"].' '.$rowPWorkers["last"]; ?></option> 
                                            <?php  } */
											?>
												
												<?php
 
													/*$queryprocessor0 = "select blockschedule from payments where blockschedule != '' group by blockschedule";
 												$resultprocessor0 = mysqli_query($con, $queryprocessor0);
 												$numprocessor0 = mysqli_num_rows($resultprocessor0); 
												
 while($rowprocessor0=mysqli_fetch_array($resultprocessor0)){
	 
 if($rowprocessor0['blockschedule'] != ""){
 $rowprocessor = mysqli_fetch_array(mysqli_query($con, "select code, first, last from workers where code = '$rowprocessor0[blockschedule]'"));
 
 ?>
 <option value="<?php echo $rowprocessor["code"]; ?>"><?php echo $rowprocessor["code"].' | '.$rowprocessor["first"]." ".$rowprocessor["last"]; ?></option>
 <?php } }
										*/	?>
												
												 <?php
								
									$querypp = "select * from routes where type = '7' group by worker";
									$resultpp = mysqli_query($con, $querypp);
									$numpp = mysqli_num_rows($resultpp);
									while($rowpp = mysqli_fetch_array($resultpp)){
										
											$queryProcessorUser= "select code, first, last from workers where code = '$rowpp[worker]'";
											$resultProcessorUser = mysqli_query($con, $queryProcessorUser); 
											$rowProcessorUser = mysqli_fetch_array($resultProcessorUser);
										
										?>
												 <option value="<?php echo $rowProcessorUser["code"]; ?>"><?php echo $rowProcessorUser["code"].' | '.$rowProcessorUser["first"]." ".$rowProcessorUser["last"]; ?></option>
												<? 
												
									   }
												?>

												

											</select>

															<div title="Page 5"></div>
				    </div>

										  </div>
                                                 <div class="col-md-4 ">
													  <div class="form-group">
														<label>ID de Solicitud:</label>
                                                        <input name="request" type="text" class="form-control" id="request" value="<? echo $_GET['request']; ?>">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
													
													
													   <div class="col-md-4 ">
													  <div class="form-group">
														<label>ID de Grupo:</label>
                                                        <input name="groupid" type="text" class="form-control" id="groupid" value="<? echo $_GET['groupid']; ?>">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
													</div>
<div class="row">
													
													<div class="col-md-4">

													  <div class="form-group">
													  <label class="control-label">Estado</label>
											<select name="pro" class="form-control  select2me" id="pro" data-placeholder="Seleccionar...">

											<option value="0" selected>Todos</option>
                                            <option value="1" <? if($_GET['pro'] == '1') echo 'selected'; ?>>Visto Bueno</option> 
                                            <option value="2" <? if($_GET['pro'] == '2') echo 'selected'; ?>>Pendientes</option> 
                                           

												

											</select>

															<div title="Page 5"></div>
				    </div>

										  </div>
	
	
	
	
	<div class="col-md-4">

													  <div class="form-group">
													  <label class="control-label">Banco</label>
											<select name="bank" class="form-control  select2me" id="bank" data-placeholder="Seleccionar...">

												<option value="" selected>Todos</option>
 								 
										<?  
										
										$querybanks = "select * from banks order by name";
										$resultbanks = mysqli_query($con, $querybanks);
										while($rowbanks = mysqli_fetch_array($resultbanks)){ 
										 
										?>	
                                        <option value="<? echo $rowbanks['id']; ?>"  <? if($_GET['bank'] == $rowbanks['id']) echo 'selected'; ?>><? echo $rowbanks['name']; ?></option> 
                                        <? } ?> 
                                           

												

											</select>

															<div title="Page 5"></div>
				    </div>

										  </div>
</div>
<div class="row">

<br><br>
						<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1">
							<button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button>
							<button type="button" class="btn grey" onClick="cleanFilter();"><i class="fa fa-eraser"></i>Limpiar Filtro</button>
							
							
												
                 </div>                               
  
</div>
						
								</div>
                                
                                </form>
                           