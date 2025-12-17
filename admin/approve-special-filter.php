   <div class="col-md-12"><!-- Begin: life time stats -->
					<form id="ungrouped" name="ungrouped" 
action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
<input name="form" type="hidden" id="form" value="1">
<div class="note note-regular">
<div class="row">
<h4 style="margin-left:15px;">Filtro:</h4><br>
<?php //desde aqui ?>


<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Solicitante:</label>

						
					
                                        <select name="requester" class="form-control  select2me" id="requester" data-placeholder="Seleccionar...">

												<option value="">Todos los Colaboradores</option>
 <?php 
 
 $queryproviders = "select code, first, last from workers where code != '' order by first,last";
 $resultproviders = mysqli_query($con, $queryproviders);
 while($rowproviders = mysqli_fetch_array($resultproviders)){ 
										
											?>
                                            <option value="<?php echo $rowproviders["code"]; ?>" <?php if($rowproviders["code"] == $_GET['requester']) echo 'selected'; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
                                            <?php } ?>

											</select>
                                            
                                           

															<div title="Page 5"></div>
													  </div>

													</div>
                                                                             <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Gerente:</label> 

						
					
                                        <select name="approver" class="form-control  select2me" id="approver" data-placeholder="Seleccionar...">

<option value="">Todos los Gerentes</option>  
<?php 
 
 $queryproviders0 = "select * from routes where ((type = '2') or (type = '3')) group by worker"; 
 $resultproviders0 = mysqli_query($con, $queryproviders0);
 while($rowproviders0 = mysqli_fetch_array($resultproviders0)){ 
 
 $queryWorkers = "select code, first, last from workers where code = '$rowproviders0[worker]'";
 $resultWorkers = mysqli_query($con, $queryWorkers);
 $rowWorkers = mysqli_fetch_array($resultWorkers);
										
											?>
                                            <option value="<?php echo $rowWorkers["code"]; ?>" <?php if($_GET['approver'] == $rowWorkers["code"]) echo "selected"; ?>><?php echo $rowWorkers["code"].' | '.$rowWorkers["first"].' '.$rowWorkers["last"]; ?></option>
                                            <?php } ?>

											</select>
                                            
                                           

															<div title="Page 5"></div>
													  </div>

													</div>
                                        
<div class="col-md-3 ">
													  <div class="form-group">
														<label>ID de Solicitud:</label>
                                                        <input name="idpayment" type="text" class="form-control" id="idpayment" value="">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                   <div class="col-md-3 ">
												     <div class="form-group">
													   <label>Unidad de Negocio:</label>
                                                      <select name="unit" class="form-control  select2me" id="unit" data-placeholder="Seleccionar...">

<option value="">Todas las unidades</option>  
<?php 
 
 $queryunits = "select * from units order by code"; 
 $resultunits = mysqli_query($con, $queryunits); 
 while($rowunits = mysqli_fetch_array($resultunits)){ 
 

										
											?>
                                            <option value="<?php echo $rowproviders0["code"]; ?>" <?php if($_GET['unit'] == $rowunits["code"]) echo "selected"; ?>><?php echo $rowunits["code"].' | '.$rowunits["name"]; ?></option>
                                            <?php } ?>

											</select>
                                             
                      

                       <!--/row-->
                                                         <!--/row-->
                                                         <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                    
                                                    
                                                    

</div>            
                                                    
<div class="row"></div>


                                        

<?php /*if($_SESSION['admin'] == "active"){ ?>
                                                   
                                                    <div class="col-md-2 " style="margin-left:50px;">
													  <div class="form-group">
														<label>Buscar como administrador:</label>
                                                    <input name="asadmin" type="checkbox" id="asadmin" value="1"> 
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                    
                                                    
                                                   <?php } */ ?>
                             
<div class="row">
</div>
<div class="row">

<br><br>
						<div class="col-md-6">	
						

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i>  Filtrar</button> <button type="button" class="btn red" onClick="javascript:deleteFilter();"><i class="fa fa-times"></i></i> Eliminar filtro</button> 
                            <script>
							function deleteFilter(){
								window.location = "approve-special.php"; 
							}
							</script>
												
                 </div>                               
  
</div>
						
								</div>
                                </form> 	 
				</div>