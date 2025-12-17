<?php include("session-withholding.php"); ?>
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

					Retenciones <small>IR</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Retenciones</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>

							<a href="#">IR</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

			<?php /*<div class="col-md-12">
														<div class="dashboard-stat blue">
															<div class="visual">
																<i class="fa fa-money"></i>
															</div>
															<div class="details">
		<?php $totaltax = 0;
		 $query1 = "select * from payments where status = '14' and irstage = '0'";
								$result1 = mysqli_query($con, $query1);
								while($row1=mysqli_fetch_array($result1)){
									$totaltax += $row1['ret1a'];
								}
								?>
<input type="hidden" id="balance" name="balance" value="<?php echo $totaltax; ?>">	
<input type="hidden" id="cbalance" name="cbalance" value="">	
													<div class="number" id="thenumber">
																	 C$<?php echo $totaltax; ?>															</div>
																<div class="desc">
																	Total retenciones IR
																</div>
															</div>
															
														</div>
													</div>*/ ?>
                                                    
                                                    
                  <div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Retenciones IR

							</div>
                            <div class="actions">

					<div class="col-md-12">

													  <div class="form-group">

									
															<select name="mayorstage" class="form-control" id="mayorstage" onChange="javascript:changer(this.value)">
                                                  
<option value="0" <?php if(!isset($_GET['irstage']) or ($_GET['irstage'] == 0)) echo 'selected'; ?>>Pendientes de cancelación</option>
<option value="1" <?php if($_GET['irstage'] == 1) echo 'selected'; ?>>En proceso</option>
<option value="2" <?php if($_GET['irstage'] == 2) echo 'selected'; ?>>Cancelar</option>
<option value="3" <?php if($_GET['irstage'] == 3) echo 'selected'; ?>>Cancelado</option>					</select>

<script>
function changer(value){
	window.location = "withholding-income-tax.php?irstage="+value;
}
</script>

													  </div>

													</div>
                                

						

							</div>
<div class="row">

				<div class="col-md-12">
                
                   <div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

										

										</div>

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="withholding-income-tax.php" class="horizontal-form" method="get" enctype="multipart/form-data" >

											<div class="form-body">

												<h3 class="form-section">Filtrar por fechas</h3>

												<div class="row"><!--/span-->

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
                                        <div class="col-md-4">
 <label class="control-label">Estado:</label>
													  <div class="form-group">

									
															<select name="mayorstage" class="form-control" id="mayorstage" onChange="javascript:changer(this.value)">
                                                  
<option value="0" <?php if(!isset($_GET['irstage']) or ($_GET['irstage'] == 0)) echo 'selected'; ?>>Pendientes de cancelación</option>
<option value="1" <?php if($_GET['irstage'] == 1) echo 'selected'; ?>>En proceso</option>
<option value="2" <?php if($_GET['irstage'] == 2) echo 'selected'; ?>>Cancelar</option>
<option value="3" <?php if($_GET['irstage'] == 3) echo 'selected'; ?>>Cancelado</option>					</select>

<script>
function changer(value){
	window.location = "withholding-income-tax.php?irstage="+value;
}
</script>

													  </div>

													</div> 

													<!--/span-->

												</div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

											<!--/row--><!--/row--></div>
                                            


											<div class="form-actions right">


												<button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button>
                                                <input type="hidden" name="irstage" id="irstage" value="4">
                                                

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div>
                                
                
				</div>

			</div>

						</div>

					<?php if(!isset($_GET['irstage']) or ($_GET['irstage'] == 0)){ ?>	
                    <div class="portlet-body">

							<form action="withholding-income-tax-request-code.php" method="post" enctype="multipart/form-data"><div class="table-container">

								

							

								<?php $irstage = 0;
								if(isset($_GET['irstage'])){
									$mayorstage = $_GET['irstage'];
								} 
								 
								$query = "select * from payments where status = '14' and irstage = '$irstage'";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								
							
								if($num > 0){ ?>
                                
                                	<div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">
                                    <input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
                                
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
								
							   $nioammount = $row['ret2a'];	
								if($row['currency'] == 2){
									
									$query2 = "select * from tc where today = '$row[schedule]'";
									$result2 = mysqli_query($con, $query2);
									$row2 = mysqli_fetch_array($result2);
									$num2 = mysqli_num_rows($result2);
									
									$nioammount = $row['ret2a']*$row2['tc']; 
								}
								if($nioammount > 1){
								if($row['ret2a'] > 0){
									
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"> <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>
                                  <td><?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td>
                                  <td><?php echo $rowprovider['name']; ?></td>
                                  <td><?php if($row['currency'] == 1){
								  echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)); 
								  }
								  if($row['currency'] == 2){
									  echo '<span style="text-decoration:line-through;">'.$rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)).'</span>';
									  echo '<br>NIO C$'.str_replace('.00','',number_format($nioammount, 2));
								  }
								  ?><br>

</td><td><?php echo $rowprovider['term']; ?> días</td>
                                
                                <td><?php if($row['irstage'] == 0){
									echo "Pendiente de cancelación";
								}else{
								$queryirstage = "select * from withholdingstages where id = '$row[irstage]'";
								$resultirstage = mysqli_query($con, $queryirstage);
								$rowirstage = mysqli_fetch_array($resultirstage);
								echo $rowirstage['name']; 
								}
								?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } } }
								
								?>
                                   </tbody>

								</table>
                                </div>
                                
                                <?php //Pagination ?>
                                <div class="form-actions right">


											    	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Solicitar pago</button>
                                                

                                                              

							</div>
                                
                                <?php /* PAGINATION <div>
								<ul class="pagination pagination-lg">
									<li>
										<a href="#">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
									<li>
										<a href="#">
										1 </a>
									</li>
									<li>
										<a href="#">
										2 </a>
									</li>
									<li>
										<a href="#">
										3 </a>
									</li>
									<li>
										<a href="#">
										4 </a>
									</li>
									<li>
										<a href="#">
										5 </a>
									</li>
									<li>
										<a href="#">
										6 </a>
									</li>
									<li>
										<a href="#">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
								</ul>
							</div> */ ?>
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna retención de IR por pagar.

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div></form>

					</div>
                    <?php } if($_GET['irstage'] == 1){ 
					//En Proceso ?>
                    <div class="portlet-body">

							<div class="table-container">

								

							

								<?php $query = "select * from payments where status = '14' and irstage >= '1' and irstage <= '3'";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								
							
								if($num > 0){ ?>
                                
                                	<div class="table-scrollable">
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
								
							   $nioammount = $row['ret2a'];	
								if($row['currency'] == 2){
									
									$query2 = "select * from tc where today = '$row[schedule]'";
									$result2 = mysqli_query($con, $query2);
									$row2 = mysqli_fetch_array($result2);
									$num2 = mysqli_num_rows($result2);
									
									$nioammount = $row['ret2a']*$row2['tc']; 
								}
								if($nioammount > 1){
								if($row['ret2a'] > 0){
									
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"> <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                 <?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td>
                                  <td><?php echo $rowprovider['name']; ?></td>
                                  <td><?php if($row['currency'] == 1){
								  echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)); 
								  }
								  if($row['currency'] == 2){
									  echo '<span style="text-decoration:line-through;">'.$rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)).'</span>';
									  echo '<br>NIO C$'.str_replace('.00','',number_format($nioammount, 2));
								  }
								  ?><br>

</td><td><?php echo $rowprovider['term']; ?> días</td>
                                
                                <td><?php if($row['irstage'] == 0){
									echo "Generado";
								}else{
								$queryirstage = "select * from irstages where id = '$row[irstage]'";
								$resultirstage = mysqli_query($con, $queryirstage);
								$rowirstage = mysqli_fetch_array($resultirstage);
								echo $rowirstage['name']; 
								}
								?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } } }
								
								?>
                                   </tbody>

								</table>
                                </div>
                                
                                
                                
                                
                                <?php /* PAGINATION <div>
								<ul class="pagination pagination-lg">
									<li>
										<a href="#">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
									<li>
										<a href="#">
										1 </a>
									</li>
									<li>
										<a href="#">
										2 </a>
									</li>
									<li>
										<a href="#">
										3 </a>
									</li>
									<li>
										<a href="#">
										4 </a>
									</li>
									<li>
										<a href="#">
										5 </a>
									</li>
									<li>
										<a href="#">
										6 </a>
									</li>
									<li>
										<a href="#">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
								</ul>
							</div> */ ?>
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna retención de IR en proceso de pago.

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div>

					</div>
                   <?php } if($_GET['irstage'] == 2){ 
				   //Cancelar
				   ?>
                   <div class="portlet-body">

							<form action="withholding-income-tax-cancelation.php" method="post" enctype="multipart/form-data"><div class="table-container">

								

							

								<?php $irstage = 2;
								if(isset($_GET['irstage'])){
									$mayorstage = $_GET['irstage'];
								} 
								 
								$query = "select * from payments where status = '14' and irstage >= '1' and irstage <= '3'";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								
							
								if($num > 0){ ?>
                                
                                	<div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">
                                    <input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
                                
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
								
							   $nioammount = $row['ret2a'];	
								if($row['currency'] == 2){
									
									$query2 = "select * from tc where today = '$row[schedule]'";
									$result2 = mysqli_query($con, $query2);
									$row2 = mysqli_fetch_array($result2);
									$num2 = mysqli_num_rows($result2);
									
									$nioammount = $row['ret2a']*$row2['tc']; 
								}
								if($nioammount > 1){
								if($row['ret2a'] > 0){
									
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"> <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>
                                  <td><?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td>
                                  <td><?php echo $rowprovider['name']; ?></td>
                                  <td><?php if($row['currency'] == 1){
								  echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)); 
								  }
								  if($row['currency'] == 2){
									  echo '<span style="text-decoration:line-through;">'.$rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)).'</span>';
									  echo '<br>NIO C$'.str_replace('.00','',number_format($nioammount, 2));
								  }
								  ?><br>

</td><td><?php echo $rowprovider['term']; ?> días</td>
                                
                                <td><?php if($row['irstage'] == 0){
									echo "Generado";
								}else{
								$queryirstage = "select * from irstages where id = '$row[irstage]'";
								$resultirstage = mysqli_query($con, $queryirstage);
								$rowirstage = mysqli_fetch_array($resultirstage);
								echo $rowirstage['name']; 
								}
								?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } } }
								
								?>
                                   </tbody>

								</table>
                                </div>
                                
                                <?php //Pagination ?>
                                <div class="form-actions right">


											    	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Cancelar</button>
                                                

                                                              

							</div>
                                
                                <?php /* PAGINATION <div>
								<ul class="pagination pagination-lg">
									<li>
										<a href="#">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
									<li>
										<a href="#">
										1 </a>
									</li>
									<li>
										<a href="#">
										2 </a>
									</li>
									<li>
										<a href="#">
										3 </a>
									</li>
									<li>
										<a href="#">
										4 </a>
									</li>
									<li>
										<a href="#">
										5 </a>
									</li>
									<li>
										<a href="#">
										6 </a>
									</li>
									<li>
										<a href="#">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
								</ul>
							</div> */ ?>
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna retención por cancelar.

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div></form>

					</div>
                   <?php } if($_GET['irstage'] == 3){ ?>
                   <div class="portlet-body">

							<div class="table-container">

								

							

								<?php $query = "select * from payments where status = '14' and irstage = '4'";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								
							
								if($num > 0){ ?>
                                
                                	<div class="table-scrollable">
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
								
							   $nioammount = $row['ret2a'];	
								if($row['currency'] == 2){
									
									$query2 = "select * from tc where today = '$row[schedule]'";
									$result2 = mysqli_query($con, $query2);
									$row2 = mysqli_fetch_array($result2);
									$num2 = mysqli_num_rows($result2);
									
									$nioammount = $row['ret2a']*$row2['tc']; 
								}
								if($nioammount > 1){
								if($row['ret2a'] > 0){
									
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"> <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                 <?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td>
                                  <td><?php echo $rowprovider['name']; ?></td>
                                  <td><?php if($row['currency'] == 1){
								  echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)); 
								  }
								  if($row['currency'] == 2){
									  echo '<span style="text-decoration:line-through;">'.$rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)).'</span>';
									  echo '<br>NIO C$'.str_replace('.00','',number_format($nioammount, 2));
								  }
								  ?><br>

</td><td><?php echo $rowprovider['term']; ?> días</td>
                                
                                <td><?php if($row['irstage'] == 0){
									echo "Generado";
								}else{
								$queryirstage = "select * from irstages where id = '$row[irstage]'";
								$resultirstage = mysqli_query($con, $queryirstage);
								$rowirstage = mysqli_fetch_array($resultirstage);
								echo $rowirstage['name']; 
								}
								?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } } }
								
								?>
                                   </tbody>

								</table>
                                </div>
                                
                                
                                
                                
                                <?php /* PAGINATION <div>
								<ul class="pagination pagination-lg">
									<li>
										<a href="#">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
									<li>
										<a href="#">
										1 </a>
									</li>
									<li>
										<a href="#">
										2 </a>
									</li>
									<li>
										<a href="#">
										3 </a>
									</li>
									<li>
										<a href="#">
										4 </a>
									</li>
									<li>
										<a href="#">
										5 </a>
									</li>
									<li>
										<a href="#">
										6 </a>
									</li>
									<li>
										<a href="#">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
								</ul>
							</div> */ ?>
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna retención de IR cancelado.

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div>

					</div><?php } 
					if($_GET['irstage'] == 4){ 
					//Imprimir ?>
                    
                    <div class="portlet-body">

							<form action="withholding-income-tax-pdf.php" method="post" enctype="multipart/form-data"><div class="table-container">

								

							

								<?php $sql1 = "";
								$from = $_GET['from'];
								if($from != ""){
									$from = date("Y-m-d", strtotime($from));
									$sql1 = " and schedule >= '$from'";
								}
								$sql2 = "";
								$to = $_GET['to'];
								if($to != ""){
									$to = date("Y-m-d", strtotime($to));
									$sql2 = " and schedule <= '$to'";
								}
								$sql = $sql1.$sql2;
								
								
								$query = "select * from payments where status = '14' and irstage >= '1'".$sql;
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result); 
								
							
								if($num > 0){ ?>
                                
                                	<div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">
                                    <input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
                                
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
								
							   $nioammount = $row['ret2a'];	
								if($row['currency'] == 2){
									
									$query2 = "select * from tc where today = '$row[schedule]'";
									$result2 = mysqli_query($con, $query2);
									$row2 = mysqli_fetch_array($result2);
									$num2 = mysqli_num_rows($result2);
									
									$nioammount = $row['ret2a']*$row2['tc']; 
								}
								if($nioammount > 1){
								if($row['ret2a'] > 0){
									
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"> <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>
                                  <td><?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td>
                                  <td><?php echo $rowprovider['name']; ?></td>
                                  <td><?php if($row['currency'] == 1){
								  echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)); 
								  }
								  if($row['currency'] == 2){
									  echo '<span style="text-decoration:line-through;">'.$rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)).'</span>';
									  echo '<br>NIO C$'.str_replace('.00','',number_format($nioammount, 2));
								  }
								  ?><br>

</td><td><?php echo $rowprovider['term']; ?> días</td>
                                
                                <td><?php if($row['irstage'] == 0){
									echo "Generado";
								}else{
								$queryirstage = "select * from irstages where id = '$row[irstage]'";
								$resultirstage = mysqli_query($con, $queryirstage);
								$rowirstage = mysqli_fetch_array($resultirstage);
								echo $rowirstage['name']; 
								}
								?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } } }
								
								?>
                                   </tbody>

								</table>
                                </div>
                                
                                <?php //Pagination ?>
                                <div class="form-actions right">


											    	<button type="submit" class="btn blue"><i class="fa fa-print"></i> Imprimir</button>
                                                

                                                              

							</div>
                                
                                <?php /* PAGINATION <div>
								<ul class="pagination pagination-lg">
									<li>
										<a href="#">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
									<li>
										<a href="#">
										1 </a>
									</li>
									<li>
										<a href="#">
										2 </a>
									</li>
									<li>
										<a href="#">
										3 </a>
									</li>
									<li>
										<a href="#">
										4 </a>
									</li>
									<li>
										<a href="#">
										5 </a>
									</li>
									<li>
										<a href="#">
										6 </a>
									</li>
									<li>
										<a href="#">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
								</ul>
							</div> */ ?>
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna retención de IR por pagar.

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div></form>

					</div>
                   <?php } ?>

					<!-- End: life time stats -->

				</div>

			</div><br><br>
            
               	<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos en espera de tipo de cambio

							</div>

							

						</div>

						<div class="portlet-body">

								<?php $query = "select * from payments where status = '14' and irstage = '0'";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								
							
								if($num > 0){ ?>
                                
                                	<div class="table-scrollable">
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
								
							  
								$err = 0;
								if($row['currency'] == 2){
									$query2 = "select * from tc where today = '$row[schedule]'";
									$result2 = mysqli_query($con, $query2);
									$num2 = mysqli_fetch_array($result2);
									if($num2 == 0){
										$err = 1;
									}
								}
								
								if($err == 1){ 
									
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"> 
                                <td class="sorting_1" id="maintheid<?php echo $table; ?>"><?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td>
                                  <td><?php echo $rowprovider['name']; ?></td>
                                  <td><?php if($row['currency'] == 1){
								  echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)); 
								  }
								  if($row['currency'] == 2){
									  echo '<span style="text-decoration:line-through;">'.$rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)).'</span>';
								  }
								  ?><br>

</td><td><?php echo $rowprovider['term']; ?> días</td>
                                
                                <td><?php if($row['irstage'] == 0){
									echo "Generado";
								}else{
								$queryirstage = "select * from irstages where id = '$row[irstage]'";
								$resultirstage = mysqli_query($con, $queryirstage);
								$rowirstage = mysqli_fetch_array($resultirstage);
								echo $rowirstage['name']; 
								}
								?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } } 
								
								?>
                                   </tbody>

								</table>
                                </div>
                                
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay pagos en espera de tipo de cambio.

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div>

					</div>

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

<!-- END PAGE LEVEL SCRIPTS -->


<script src="../assets/admin/pages/scripts/components-pickers.js"></script>

<script src="../assets/admin/pages/scripts/table-managed.js"></script>


<script>

jQuery(document).ready(function() {    
 Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar 
ComponentsPickers.init();
TableManaged.init();


        });



						</script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>