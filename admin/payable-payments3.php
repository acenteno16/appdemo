<?php include("session-payer.php"); ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en" >

<!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

<meta charset="utf-8"/>

<title>Aplicación de Pagos | Casa Pellas S.A.</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta content="width=device-width, initial-scale=1.0" name="viewport"/>

<meta content="" name="description"/>

<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/select2/select2.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content ">

<!-- BEGIN HEADER -->

<?php include("header.php"); ?>

<!-- END HEADER -->

<div class="clearfix">

</div>

<!-- BEGIN CONTAINER -->

<div class="page-container">

	<!-- BEGIN SIDEBAR -->

	<?php include("side.php"); ?>

	<!-- END SIDEBAR -->

	<!-- BEGIN CONTENT -->

	<div class="page-content-wrapper">

		<div class="page-content">

	
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->


			<!-- BEGIN PAGE HEADER-->		



			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB--> 

					<h3 class="page-title">

					Cancelación de pagos <?php /*<small>Aprobación de programación</small> */ ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						

					
                        <li>

							<a href="#">Cancelación de pagos
</a>
							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>
            
            <div class="note note-regular">
<div class="row">
<div class="col-md-12">

<form id="ungrouped" name="ungrouped" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
<input name="form" type="hidden" id="form" value="1">

							
<h4 style="margin-left:15px;">Filtro:</h4><br>

<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Proveedor:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value="">Todos los Proveedores</option>
 <?php $queryproviders = "select * from providers order by name";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <?php if($rowproviders["id"] == $_GET['provider']) echo 'selected'; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option>
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

												<option value="">Todos los Colaboradores</option>
 <?php $queryproviders = "select * from workers order by first,last";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <?php if($rowproviders["id"] == $_GET['worker']) echo 'selected'; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
<?php /*                                                    
<div class="col-md-4">
                                                    <label class="control-label">Rango de Fechas:</label>

											<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">

												<input type="text" class="form-control" name="from" placeholder="desde">

												<span class="input-group-addon">

												<i class="fa fa-angle-double-right"></i></span>

												<input type="text" class="form-control" name="to" placeholder="hasta">

											</div>

											<!-- /input-group -->

											
										</div>
<div class="row"></div>
*/ ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>No. de Solicitud:</label>
                                                        <input name="request" type="text" class="form-control" id="request" value="<?php echo $_GET['request']; ?>">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
<div class="col-md-2 ">
													  <div class="form-group">
														<label> No. de Factura:</label>
                                                        <input name="bill" type="text" class="form-control" id="bill" value="<?php echo $_GET['bill']; ?>">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>




                             
<div class="row"></div>

<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button> <button type="button" class="btn red" onClick="resetFilter();"><i class="fa fa-filter"></i> Quitar Filtro</button>  <script>
                            function resetFilter(){
                            
                            window.location = "payable-payments.php";
							
                            }
                            </script>
												
                 </div>                               
 </form>
</div>
</div>
</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				
                <div class="col-md-12">

					

					<!-- Begin: life time stats -->

					<?php if($_GET['form'] == 1){ ?>
                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<i class="icon-wallet"></i>Resultados de la busqueda</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								<div class="table-actions-wrapper">

									<span>

									</span>

								

			
								</div>

							<?php $sql1 = "";
if($_GET['provider'] != ""){
$sql1 = " and payments.provider = '$_GET[provider]'";
}
$sql2 = "";
if($_GET['worker'] != ""){
$sql2 = " and payments.collaborator = '$_GET[worker]'";
}
$sql3 = "";
if($_GET['request'] != ""){
$sql3 = " and payments.id = '$_GET[request]'";
}
$sql4 = "";
if($_GET['bill'] != ""){
$sql4 = " and bills.number = '$_GET[bill]'";
}
/*$sql4 = "";
if($_GET['from'] != ""){
$from = date("Y-m-d", strtotime($_GET['from']));
$sql4 = " and times.today >= '$from'";
}
$sql5 = "";
if($_GET['to'] != ""){
$to = date("Y-m-d", strtotime($_GET['to']));
$sql5 = " and times.today <= '$to'";
}
*/

$sql = $sql0.$sql1.$sql2.$sql3.$sql4.$sql5;
							
							$today = date("Y-m-d");
							$query = "select payments.* from payments inner join bills on payments.id = bills.payment where payments.status = '13'".$sql." order by payments.schedule asc"; 
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								if($num > 0){ ?> 	
                            
                                	<form id="payable" name="payable" enctype="multipart/form-data" method="post" action="payable-payments-cancellation.php">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="3%">	<input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
                                
                                  <script>
    function checkAll(){
	 var checkall = document.getElementById('checkall');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('theid[]');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
      </script>
</th>
               
                                <th width="4%">

										 ID</th>

									<th width="5%">

										 Código</th>

									<th width="18%">

										 Nombre</th>

									<th width="10%">Total Pagar</th>

									<th width="10%">

										 Vencimiento

									</th>

									<th width="14%">

										 Cancelar el

									</th>

									<th width="16%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
								if($row['btype'] == 1){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								}
								else{
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
								}
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                               
                                <tr role="row" class="odd">
                                  <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php echo $rowprovider['code']; ?></td><td><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; if($row['btype'] == 1){ echo $rowprovider['name'];
								}else{
									echo $rowprovider['first']." ".$rowprovider['last']; } ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.number_format($row['payment'], 2); ?></td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	

?></td><td> <?php $date1 = date("Y-m-d");
	
	echo $date2 = date('d-m-Y',strtotime($row['schedule']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.abs($dias).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.abs($dias).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.-1*abs($dias).")</span>"; 
	
	
 ?> 	
									
							
								
							</td><td><a href="payable-payments-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } ?>
                                
                                   </tbody>

								</table>
                              <div class="form-actions right">

<input type="hidden" id="currency" name="currency" value="1">
											    	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Cancelar pago</button>
                                                    </div>
                                               
</form>
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay pagos para cancelar.

						</p>

					</div>
                                <?php } ?>
                              

							</div>

						</div>
                        
                     

					</div>
                    
                  <?php }else{ ?>  
                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<i class="icon-wallet"></i>Lista de pagos a cancelar</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								<div class="table-actions-wrapper">

									<span>

									</span>

								

			
								</div>

							<?php $today = date("Y-m-d");
							$query = "select * from payments where status = '13' and schedule <= '$today' order by schedule asc"; 
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								if($num > 0){ ?> 	
                            
                                	<form id="payable" name="payable" enctype="multipart/form-data" method="post" action="payable-payments-cancellation.php">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="3%">	<input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
                                
                                  <script>
    function checkAll(){
	 var checkall = document.getElementById('checkall');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('theid[]');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
      </script>
</th>
               
                                <th width="4%">

										 ID</th>

									<th width="5%">

										 Código</th>

									<th width="18%">

										 Nombre</th>

									<th width="10%">Total Pagar</th>

									<th width="10%">

										 Vencimiento

									</th>

									<th width="14%">

										 Cancelar el

									</th>

									<th width="16%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
								if($row['btype'] == 1){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								}
								else{
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
								}
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                               
                                <tr role="row" class="odd">
                                  <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php echo $rowprovider['code']; ?></td><td><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; if($row['btype'] == 1){ echo $rowprovider['name'];
								}else{
									echo $rowprovider['first']." ".$rowprovider['last']; } ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.number_format($row['payment'], 2); ?></td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	

?></td><td> <?php $date1 = date("Y-m-d");
	
	echo $date2 = date('d-m-Y',strtotime($row['schedule']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	
	
 ?> 	
									
							
								
							</td><td><a href="payable-payments-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } ?>
                                
                                   </tbody>

								</table>
                              <div class="form-actions right">

<input type="hidden" id="currency" name="currency" value="1">
											    	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Cancelar pago</button>
                                                    </div>
                                               
</form>
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay pagos para cancelar.

						</p>

					</div>
                                <?php } ?>
                              

							</div>

						</div>
                        
                     

					</div>
                    
                    <?php //NEXT ?>
                     <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<i class="icon-wallet"></i>Lista de pagos próximos a cancelar</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								<div class="table-actions-wrapper">

									<span>

									</span>

								

			
								</div>

							<?php $query = "select * from payments where status = '13' and schedule > '$today' order by schedule asc"; 
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								if($num > 0){ ?> 	
                            
                                	<form id="payable" name="payable" enctype="multipart/form-data" method="post" action="payable-payments-cancellation.php">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="3%">	<input type="checkbox" class="group-checkable" id="checkall2" onChange="javascript:checkAll2();" /> 
                                
                                  <script>
    function checkAll2(){
	 var checkall = document.getElementById('checkall2');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('theid2[]');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
      </script>
</th>
               
                                <th width="4%">

										 ID</th>

									<th width="5%">

										 Código</th>

									<th width="18%">

										 Nombre</th>

									<th width="10%">Total Pagar</th>

									<th width="10%">

										 Vencimiento

									</th>

									<th width="14%">

										 Cancelar el

									</th>

									<th width="16%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
								if($row['btype'] == 1){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								}
								else{
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
								}
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                               
                                <tr role="row" class="odd">
                                  <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid2[]" type="checkbox" id="theid2[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php echo $rowprovider['code']; ?></td><td><?php if($row['btype'] == 1){ echo $rowprovider['name'];
								}else{
									echo $rowprovider['first']." ".$rowprovider['last']; }?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.number_format($row['payment'], 2); ?></td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
?></td><td><?php $date1 = date("Y-m-d");
	
	echo $date2 = date('d-m-Y',strtotime($row['schedule']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	
	
 ?></td><td><a href="payable-payments-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } ?>
                                
                                   </tbody>

								</table>
                              <div class="form-actions right">

<input type="hidden" id="currency" name="currency" value="1">
											    	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Cancelar pago</button>
                                                    </div>
                                               
</form>
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay pagos próximos a cancelar.

						</p>

					</div>
                                <?php } ?>
                              

							</div>

						</div>
                        
                     

					</div>
                    <?php //END NEXT ?>
<?php } ?>
					<!-- End: life time stats -->

				</div>

			</div>

			<!-- END PAGE CONTENT-->

		</div>

	</div>

	<!-- END CONTENT --> 

	<!-- BEGIN QUICK SIDEBAR -->

    <?php include("sidebar.php"); ?>

<!-- END QUICK SIDEBAR -->

</div>

<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->

<?php include("footer.php"); ?>

<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<!--[if lt IE 9]>

<script src="../assets/global/plugins/respond.min.js"></script>

<script src="../assets/global/plugins/excanvas.min.js"></script> 

<![endif]-->

<script src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>

<?php /*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ ?>

<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>


<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/table-managed.js"></script> 

<!-- END PAGE LEVEL SCRIPTS -->

<script>
jQuery(document).ready(function() {    
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
TableManaged.init(); 
});


</script> 

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>