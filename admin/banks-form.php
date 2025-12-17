  <div class="tab-pane" id="tab_1">

								<div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

											<?php //Form Sample ?>

										</div>

										<?php /*<div class="tools">

											<a href="javascript:;" class="collapse">

											</a>

											<a href="#portlet-config" data-toggle="modal" class="config">

											</a>

											<a href="javascript:;" class="reload">

											</a>

											<a href="javascript:;" class="remove">

											</a>

										</div>*/ ?>

									</div> 	

									<? /*<div class="portlet-body form">

						 				<!-- BEGIN FORM-->

										<form action="providers-accounts-add.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 

										  <div class="form-body">

												<h3 class="form-section">Informacion De Cuentas</h3>
<?php $queryaccounts = "select * from providersaccount where provider = '$row[id]'";
	$resultaccounts = mysqli_query($con, $queryaccounts);
	$numaccounts = mysqli_num_rows($resultaccounts);
	if($numaccounts == 0){										
											 
?>   
                                            <p>El Proveedor no tiene ninguna cuenta vinculada a su perfil</p><br>&nbsp;<br>
              <?php }else{ ?>
              
              <div class="portlet-body flip-scroll">
							<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
							<tr>
								<th class="numeric" width="2%">
									 Favorita
								</th>
                                <th width="20%">
									 Banco</th>
								<th>
									 Moneda</th>
								<th class="numeric">
									 No. de Cuenta
								</th>
                             
                                <th class="numeric">
									 Opciones</th>
							  </tr>
							</thead>
							<tbody>
							
                            <?php while($rowaccounts=mysqli_fetch_array($resultaccounts)){ ?><tr>
								   <td class="numeric"><?php if($row['account'] == $rowaccounts['id']) echo '<i class="fa fa-dot-circle-o"></i> '; else echo '<i class="fa fa-circle-o"></i>'; ?>
								  
							    </td>
                                <td>
									<?php $querybank2 = "select * from banks where id =  '$rowaccounts[name]'";
									$resultbank2 = mysqli_query($con, $querybank2);
									$rowbank2 = mysqli_fetch_array($resultbank2);
									echo $rowbank2['name'];  ?>
								</td>
								<td>
									 <?php switch($rowaccounts['currency']){
										 case 1:
										 echo "Cordobas";
										 break;
										 case 2:
										 echo "Dolares";
										 break;
										 case 3:
										 echo "Euros";
										 break;
									 }?>
								</td>
								<td class="numeric"><?php echo $rowaccounts['number']; ?>
								  
							    </td>
                             
                                	<td><div class="btn-group">
									<a class="btn btn-sm blue" href="#" data-toggle="dropdown">
									 Opciones<i class="fa fa-angle-down "></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="javascript:Favorita(<?php echo $rowaccounts['id']; ?>);">
											<i class="fa fa-pencil"></i> Favorita</a>
										</li>
										<li>
											<a href="javascript:Eliminar(<?php echo $rowaccounts['id']; ?>);">
											<i class="fa fa-trash-o"></i> Eliminar</a>
										</li>
									</ul>
								</div>
								  
							    </td>
							  </tr>
                              <?php } ?>
							</tbody>
							</table>
						</div>
              
              <?php }?>                                  
                                                
                                                				<h3 class="form-section">Agregar Cuentas</h3>

												<div class="row">

													<div class="col-md-6">

													  <div class="form-group">

														<label class="control-label">Banco:</label>

														  <select name="name" class="form-control" id="name">
                                                          <option value="0" selected>Seleccionar</option>
                                                          
<?php $querybank = "select * from banks";
$resultbank = mysqli_query($con, $querybank);
while($rowbank=mysqli_fetch_array($resultbank)){
?>																<option value="<?php echo $rowbank['id']; ?>"><?php echo $rowbank['name']; ?></option>
<?php } ?>																
														</select>
	

													  </div>

													</div>

													<!--/span-->

													<div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Moneda:</label>
	<select name="currency" class="form-control" id="currency">
							  <option value="0" selected>Seleccionar</option>
                                                            <option value="1">Cordobas</option>
<option value="2">Dolares</option>
<option value="3">Euros</option>

														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>

													<!--/span-->

												</div>

												<!--/row-->

										    <div class="row">

											  <div class="col-md-6">

												<div class="form-group">

															<label class="control-label">No. de Cuenta:</label>

													<input name="number" type="text" class="form-control form-control-inline " id="number" placeholder="" size="16"/>

															

												  </div>

													</div>

													<!--/span--><!--/span-->

											  </div>

												<!--/row-->

												

												<!--/row-->

											  <div class="row"></div>

										    <!--/row--></div>

											<div class="form-actions right">

												<button type="button" class="btn default">Cancelar</button>

											  <button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar Cuenta</button>
												<input name="id" type="hidden" id="id" value="<?php echo $row['id']; ?>">

											</div>

										</form>

										<!-- END FORM-->



									</div>  */ ?>

								</div>

							</div>