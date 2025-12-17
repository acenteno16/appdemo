
<form id="ungrouped" name="ungrouped" action="payment-schedule.php" enctype="multipart/form-data" method="get">  
<div class="note note-regular">
								<div class="row">
                             <h4 style="margin-left:15px;">Filtro de pagos:</h4><br>
<?php //Forma de pago ?>
<div class="col-md-2">







										<label><strong>Forma de pago</strong></label>
										<div class="checkbox-list">
											<label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="1" <? if(in_array('1', $ptype_values)) echo 'checked'; ?>></span> Transf. elect.<?php //echo $filter1[1]; ?> </label>
                                            <label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="2" <? if(in_array('2', $ptype_values)) echo 'checked'; ?>></span> Cheque </label>
                                            <label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="3" <? if(in_array('3', $ptype_values)) echo 'checked'; ?>></span> TC </label>
                                            <label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="4" <? if(in_array('4', $ptype_values)) echo 'checked'; ?>></span> Telepagos </label>
                                            <label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="5" <? if(in_array('5', $ptype_values)) echo 'checked'; ?>></span> Internet </label>
											
									
									</div>
</div>
<?php //Moneda ?>
<div class="col-md-2">


										<label><strong>Moneda</strong></label>
										<div class="checkbox-list">
											<label>
											<span class=""><input name="currency[]" type="checkbox" id="currency[]" value="1" <? if(in_array('1', $currency_values)) echo 'checked'; ?>></span> Cordobas </label>
                                            <label>
											<span class=""><input name="currency[]" type="checkbox" id="currency[]" value="2" <? if(in_array('2', $currency_values)) echo 'checked'; ?>></span> Dolares </label>
                                            <label>
											<span class=""><input name="currency[]" type="checkbox" id="currency[]" value="3" <? if(in_array('3', $currency_values)) echo 'checked'; ?>></span> Euros </label>
                                            <label>
											<span class=""><input name="currency[]" type="checkbox" id="currency[]" value="4" <? if(in_array('4', $currency_values)) echo 'checked'; ?>></span> Yenes </label>
                                           
									</div>
</div>
<?php //Vencimineto/Vips ?>
<div class="col-md-2">


										<label><strong>Vencimiento</strong></label>
										<div class="checkbox-list">
											<label>
											<span class=""><input name="expiration1" type="checkbox" id="expiration1" value="1" <? if(in_array('1', $expiration1_values)) echo 'checked'; ?> onClick="expirationFn();"></span> Por vencerse</label>
                                            <label>
											<span class=""><input name="expiration2" type="checkbox" id="expiration2" value="1" <? if(in_array('1', $expiration2_values)) echo 'checked'; ?> onClick="expirationFn();"></span> Vencidos</label>
                                            <label>
											<span class=""><input name="expiration3" type="checkbox" id="expiration3" value="1" <? if(in_array('1', $expiration3_values)) echo 'checked'; ?> onClick="expirationFn();"></span>  No vencidos</label>
                                           
									
									</div>
                                    <label><strong>VIPs</strong></label>
										<div class="checkbox-list">
											<label>
											<span class=""><input name="gcp" type="checkbox" id="gcp" value="1" <?php if($gcp == 1) echo 'checked'; ?>>
											</span> Grupo Casa Pellas</label>
                                            <label>
											<span class=""><input name="vip" type="checkbox" id="vip" value="1" <?php if($vip == 1) echo 'checked'; ?>></span> VIPs externos</label>
                                            
                                               <label>
											<span class=""><input name="international" type="checkbox" id="international" value="1" <?php if($international == 1) echo 'checked'; ?>></span> Internacionales</label>  
                                           
                                           
									
									</div>
</div> 
<?php //Tipo ?>
<div class="col-md-2">
<label><strong>Tipo</strong></label>
<div class="checkbox-list">
  <?php $queryt = "select * from accountingCategories where level = '1' and searchable = '1'";
$resultt = mysqli_query($con, $queryt);
while($rowt=mysqli_fetch_array($resultt)){ 
?>
	
	
	
<label><span class=""><input name="type1[]" type="checkbox" id="type1[]" value="<?php echo $rowt['id']; ?>" <? if(in_array($rowt['id'], $type1_values)) echo 'checked'; ?>></span> <?php echo ucfirst($rowt['name']); ?></label>
<?php } ?>
</div>
</div>
<?php //Concepto ?>
<div class="col-md-2">


										<label><strong>Concepto</strong></label>
									    <div class="checkbox-list">
											
                                          <?php $queryt = "select * from accountingCategories where level = '2' and searchable = '1'";
$resultt = mysqli_query($con, $queryt);
while($rowt=mysqli_fetch_array($resultt)){ 
?>
<label><span class=""><input name="type2[]" type="checkbox" id="type2[]" value="<?php echo $rowt['id']; ?>" <? if(in_array($rowt['id'], $type2_values)) echo 'checked'; ?>></span> <?php echo ucfirst($rowt['name']); ?></label>
<?php } ?>
    </div>
   
    </div>
<?php //Sub-categoria ?>
<div class="col-md-2">


										<label><strong>Categoría</strong></label>
									<div class="checkbox-list">
											  <?php $queryt = "select * from accountingCategories where level = '3' and searchable = '1'";
$resultt = mysqli_query($con, $queryt);
while($rowt=mysqli_fetch_array($resultt)){ 
?>
<label><span class=""><input name="type3[]" type="checkbox" id="type3[]" value="<?php echo $rowt['id']; ?>" <? if(in_array($rowt['id'], $type3_values)) echo 'checked'; ?>></span> <?php echo ucfirst($rowt['name']); ?></label>
<?php } ?>
                                       
    </div>
   
    </div> 
    

                                
</div> 

                             
<div class="row">
<br>
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Bloqueado por:</label>

												<? 
												
												$queryprocessor0 = "select blockschedule from payments where blockschedule != '' group by blockschedule";
 												$resultprocessor0 = mysqli_query($con, $queryprocessor0);
 												$numprocessor0 = mysqli_num_rows($resultprocessor0); ?>
														  
														  
						
											<select name="blocked" class="form-control  select2me" id="blocked" data-placeholder="Seleccionar...">

												
												
									
												<option value="">Todos los Procesadores</option>
 <?php
 
 while($rowprocessor0=mysqli_fetch_array($resultprocessor0)){
	 
 if($rowprocessor0['blockschedule'] != ""){
 $rowprocessor = mysqli_fetch_array(mysqli_query($con, "select code, first, last from workers where code = '$rowprocessor0[blockschedule]'"));
 
 ?>
 <option value="<?php echo $rowprocessor["code"]; ?>"><?php echo $rowprocessor["code"].' | '.$rowprocessor["first"]." ".$rowprocessor["last"]; ?></option>
 <?php } }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>                      
	
	
	
	<? /*<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Proveedor:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value="">Todos los Proveedores</option>
 <?php $queryproviders = "select id, code, name from providers order by name";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>*/ ?>
	
	<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Proveedor: <a href="javascript:loadProviders('load');" id="providerCharge" >[Cargar Filtro]</a></label>
        <select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar..." disabled>
            <option value="">Todos los Proveedores</option>
            <? 
				$getProvider = isset($_GET['provider']) ? intval($_GET['provider']) : 0;
				if($getProvider > 0){ 
                $rowThisProvider = mysqli_fetch_array(mysqli_query($con, "select code, name from providers where code > '0' order by name"));
            ?>
            <option value="<? echo $getProvider; ?>"><? echo $rowThisProvider['code'].' | '.$rowThisProvider['name']; ?></option>
            <? } ?>
        </select>
                                                     
                                                          <script>                                            
                                                          function loadProviders(value){
                                                              if(value == 'load'){
                                                                  $("#provider").select2('data', { id:"", text: "Cargando Proveedores..."});
                                                                  $("#providerCharge").css("display", "none");
                                                                  $.post("reloadContent.php", { type: 'providersMenu' }, function(data){
                                                                      document.getElementById("provider").innerHTML = data;
                                                                      $("#provider").select2('data', { id:"", text: "Todos los Proveedores"});
                                                                      $("#provider").prop('disabled', false);
                                                                  });
                                                              }
                                                          }  
                                                          </script>
                                                          
                                                          
											
	</div>

													</div>
<? /*<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Colaborador:</label>

						
											<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar...">

												<option value="">Todos los Colaboradores</option>
 <?php $queryproviders = "select * from workers order by first,last";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>*/ ?>
	
	<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Colaborador: <a href="javascript:loadWorkers('load');" id="workerCharge" >[Cargar Filtro]</a></label>

						
											<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar..." disabled>

												<option value="">Todos los Colaboradores</option>
                                               
											</select>
                                                         
                                                          <script nonce="<?= $nonce ?>">
                                                          function loadWorkers(value){
                                                              if(value == 'load'){
                                                                  $("#workerCharge").css("display", "none");
                                                                  $("#worker").select2('data', { id:"", text: "Cargando Colaboradores..."});
                                                                  $.post("reloadContent.php", { type: 'workersMenu' }, function(data){
                                                                    document.getElementById("worker").innerHTML = data;
                                                                      $("#worker").select2('data', { id:"", text: "Todos los Colaboradores"});
                                                                      $("#worker").prop('disabled', false);
                                                                  }); 
                                                              }
                                                          }
                                                          </script>
                                                          
                                                          

													  </div>

													</div>
	
	
</div>
<div class="row">

<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Compañia:</label>

						
											<select name="company" class="form-control  select2me" id="company" data-placeholder="Seleccionar...">

												<option value="">Todas las compañias</option>

                                            <? 
											
											$queryfcompanies = "select id, name from companies";
											$resultfcompanies = mysqli_query($con, $queryfcompanies);
											while($rowfcompanies=mysqli_fetch_array($resultfcompanies)){
											
											?>
                                            <option value="<? echo $rowfcompanies['id']; ?>" <?php if($_GET['company'] == $rowfcompanies['id']) echo 'selected'; ?>><? echo $rowfcompanies['name']; ?></option>
                                           <? } ?>
                                          

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
                                                    
                                                    <div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Banco:</label>

						
											<select name="pbank" class="form-control  select2me" id="pbank" data-placeholder="Seleccionar...">

												<option value="">Todos los Bancos</option> 

                                            <? 
											
											$queryfbanks = "select * from banks order by name";
											$resultfbanks = mysqli_query($con, $queryfbanks);
											while($rowfbanks=mysqli_fetch_array($resultfbanks)){
											
											?>
                                            <option value="<? echo $rowfbanks['id']; ?>" <?php if($_GET['pbank'] == $rowfbanks['id']) echo 'selected'; ?>><? echo $rowfbanks['name']; ?></option> 
                                           <? } ?>

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
                                                   <div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Beneficiario:</label>

						
											<select name="beneficiary" class="form-control  select2me" id="beneficiary" data-placeholder="Seleccionar...">

												<option value="">Proveedor/Colaborador</option>

                                           
                                            <option value="1" <?php if($_GET['beneficiary'] == 1) echo 'selected'; ?>>Proveedores</option>
                                            
                                            <option value="2" <?php if($_GET['beneficiary'] == 2) echo 'selected'; ?>>Colaboradores</option>
                                           
                                          

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
                                                    <div class="col-md-4 ">
													  <div class="form-group">
														<label>No. de Solicitud:</label>
                                                        <input name="request" type="text" class="form-control" id="request" value="">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                    
                                                    <div class="col-md-4">

													  <div class="form-group">
 
	<label class="control-label">Plan de Pago:</label>
	<select name="plan" class="form-control" id="plan">
    <option value="" selected>Seleccionar</option> 
                                                          
<?php 
		
		$querypplan = "select * from plans";
		$resultpplan = mysqli_query($con, $querypplan); 
		while($rowpplan=mysqli_fetch_array($resultpplan)){ 
	
	$querybplan = "select * from banks where id = '$rowpplan[bank]'";
	$resultbplan = mysqli_query($con, $querybplan);
	$rowbplan=mysqli_fetch_array($resultbplan);

	$querypcompany = "select * from companies where id = '$rowpplan[company]'";
	$resultpcompany = mysqli_query($con, $querypcompany);
	$rowpcompany=mysqli_fetch_array($resultpcompany);

	$querypcurrency = "select * from currency where id = '$rowpplan[currency]'";
	$resultpcurrency = mysqli_query($con, $querypcurrency);
	$rowpcurrency = mysqli_fetch_array($resultpcurrency); 
		
	?>																	<option value="<?php echo $rowpplan['id']; ?>" <? if($rowpplan['id'] == $_GET['plan']) echo 'selected'; ?>><?php echo $rowpcompany['name']."/".$rowbplan['name']."/".$rowpcurrency['name']."/".$rowpplan['account']; ?></option>
<?php } ?>														
   



														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>
													
													
													<div class="col-md-4">

													  <div class="form-group">
 
	<label class="control-label">MG/MP:</label>
	<select name="mgmp" class="form-control" id="mgmp">
    <option value="" selected>Seleccionar</option> 
    <option value="1" <? if($_GET['mgmp'] == 1) echo "selected"; ?>>Córdobas - Córdobas</option>
	<option value="2" <? if($_GET['mgmp'] == 2) echo "selected"; ?>>Dólares - Dólares</option>
	<option value="3" <? if($_GET['mgmp'] == 3) echo "selected"; ?>>Dólares - Córdobas</option>
													
   



														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>
													<div class="col-md-4">

													  <div class="form-group">
 
	<label class="control-label">No. de Resultados:</label>
	<select name="no" class="form-control" id="no">
    <option value="50" selected>50</option> 
    <option value="100" <? if($_GET['no'] == 100) echo 'selected'; ?>>100</option>
	<option value="150" <? if($_GET['no'] == 150) echo 'selected'; ?>>150</option>
	<option value="200" <? if($_GET['no'] == 200) echo 'selected'; ?>>200</option>
	<option value="300" <? if($_GET['no'] == 300) echo 'selected'; ?>>300</option>
	<option value="400" <? if($_GET['no'] == 400) echo 'selected'; ?>>400</option>
	<option value="500" <? if($_GET['no'] == 500) echo 'selected'; ?>>500</option>
	<option value="1000" <? if($_GET['no'] == 1000) echo 'selected'; ?>>1,000</option> 
	<option value="100000" <? if($_GET['no'] == 100000) echo 'selected'; ?>>Todos</option>   
												

														</select>
	
													  </div>

													</div>
													<div class="col-md-4">

													  <div class="form-group">
 
	<label class="control-label">Tipo de Pago:</label>
	<select name="paymenttype" class="form-control" id="paymenttype">
    <option value="0" selected>Todos</option>  
    <option value="1" <? if($_GET['paymenttype'] == 1) echo 'selected'; ?>>Pagos Tradicionales</option>
	<option value="2" <? if($_GET['paymenttype'] == 2) echo 'selected'; ?>>Pasantes (Billetera Movil)</option>
	<option value="3" <? if($_GET['paymenttype'] == 3) echo 'selected'; ?>>Viaticos (Cuenta Bancaria)</option>
	<option value="4" <? if($_GET['paymenttype'] == 4) echo 'selected'; ?>>Viaticos (Billetera Movil)</option>
	<option value="5" <? if($_GET['paymenttype'] == 5) echo 'selected'; ?>>Devoluciones</option>
    <option value="covid" <? if($_GET['paymenttype'] == 'covid') echo 'selected'; ?>>Contingencia COVID-19</option> 
	   
												

														</select>
	
													  </div>

													</div>
	
	<div class="col-md-4">

													  <div class="form-group">
 
	<label class="control-label">Tipo de Provisión:</label>
	<select name="ppe1" class="form-control" id="ppe1">
    <option value="0" selected>Todos</option> 
    <option value="1" <? if($_GET['paymenttype'] == 1) echo 'selected'; ?>>Pendiente de E1</option>
	<option value="2" <? if($_GET['paymenttype'] == 2) echo 'selected'; ?>>Normal</option>
	   
												

														</select>
	
													  </div>

													</div>
	
													
</div>
<div class="row">

<br><br>
						<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button><input type="button" class="btn blue" style="margin-left:5px;" onClick="javascript:goSchedule();" value="Limpiar Filtro"> 
							<script>
							function goSchedule(){
								window.location='payment-schedule.php';
							}
							</script>
												
                 </div>                               
  
</div>
						
								</div>
                                
                                </form>
                           