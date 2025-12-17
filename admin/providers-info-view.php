<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("sessions.php"); 
require 'functions.php';

$id = isset($_GET['id']) ? sanitizeInput(intval($_GET['id']), $con) : 0;

$query = "select * from providers where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc(); 
 
?>
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

<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/clockface/css/clockface.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

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

			<!-- BEGIN STYLE CUSTOMIZER -->

			

			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Información de Proveedores <small>Visor</small></h3>

					<ul class="page-breadcrumb breadcrumb">

						<?php /*<li class="btn-group">

							<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">

							<span>Actions</span><i class="fa fa-angle-down"></i>

							</button>

							<ul class="dropdown-menu pull-right" role="menu">

								<li>

									<a href="#">Action</a>

								</li>

								<li>

									<a href="#">Another action</a>

								</li>

								<li>

									<a href="#">Something else here</a>

								</li>

								<li class="divider">

								</li>

								<li>

									<a href="#">Separated link</a>

								</li>

							</ul>

						</li>*/ ?>

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="providers.php">Información de Proveedores</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>Visor

						</li>

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">

					<div class="tabbable tabbable-custom boxless tabbable-reversed">

						

					

							

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

									<div class="portlet-body form">

						 				<!-- BEGIN FORM-->

										<form action="#" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 

											<div class="form-body">

												<h3 class="form-section">Informacion Empresarial</h3>

												<div class="row">

													<div class="col-md-3">

														<div class="form-group">

															<label class="control-label">Código:</label>

															<input name="code" type="text" class="form-control" id="firstName" value="<?php echo sanitizedOutput($row['code']); ?>" readonly>

	

														</div>

													</div>

													<div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Nombre:</label>
	<input name="name" type="text" class="form-control" id="name" placeholder="Ej: Casa Pellas S.A." value="<?php echo sanitizedOutput($row['name']); ?>" readonly>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
														      </div>
													    </div>
														</div>

													</div>
                                                    
                                                    <div class="col-md-3">

														<div class="form-group">

															<label class="control-label">RUC:</label>

															<input name="ruc" type="text" class="form-control" id="ruc" placeholder="Ej: J03100000002371" value="<?php echo sanitizedOutput($row['ruc']); ?>" readonly>

														</div>

													</div>

													<!--/span-->

												</div>

												<!--/row-->

												<div class="row">

													
                                                    
                                                    <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">VIP/Bandera:</label>

														  <select name="flag" class="form-control" id="flag" disabled>
                                                          <option value="0" selected>No</option>
                                                          <option value="1" <?php if($row['flag'] == 1) echo 'selected'; ?>>Si</option> 
                                                          
													
														</select>
	

													  </div>

													</div>
                                                    
                                                    <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Nac/Internac:</label>

														  <select name="international" class="form-control" id="international" disabled>
                                                          <option value="0" selected>Nacional</option>
                                                          <option value="1" <?php if($row['international'] == 1) echo 'selected'; ?>>Internacional</option> 
                                                          
													
														</select>
	

													  </div>

													</div>

													<!--/span-->
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Moneda de pago:</label>
	<select name="currency" class="form-control" id="currency" disabled>
							  <option value="0" selected>Seleccionar</option>
                                                            <option value="1" <?php if($row['currency'] == 1) echo 'selected'; ?>>Cordobas</option>
<option value="2" <?php if($row['currency'] == 2) echo 'selected'; ?>>Dolares</option>
<option value="3" <?php if($row['currency'] == 3) echo 'selected'; ?>>Euros</option>
<option value="4" <?php if($row['currency'] == 4) echo 'selected'; ?>>Yenes</option>

														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>
                                                    
                                                    <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Activo:</label>
	<select name="active" class="form-control" id="active" disabled>
	<option value="0" selected>No</option>
    <option value="1" <?php if($row['active'] == 1) echo 'selected'; ?>>Si</option>



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
                                                
                                                
                                                <div class="row">
                                                
                                                <div class="col-md-3">

														<div class="form-group">

															<label class="control-label">Vencimiento:</label>

															<input name="term" type="text" class="form-control form-control-inline " id="term" placeholder="Ej: 30" value="<?php echo sanitizedOutput($row['term']); ?>" size="16" readonly/>

															

														</div>

													</div>
                                                    <div class="col-md-3">

													  <div class="form-group">
 
	<label class="control-label">Regimen:</label>
	<select name="regime" class="form-control" id="regime" disabled>
	<option value="0" selected>Seleccionar</option> 
    <option value="1" <?php if($row['regime'] == 1) echo 'selected'; ?>>General</option>
    <option value="2" <?php if($row['regime'] == 2) echo 'selected'; ?>>Cuota Fija</option>



														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>
                                                   <div class="col-md-3">

													  <div class="form-group">
 
	<label class="control-label">Exo 1%:</label> 
	<select name="exo1" class="form-control" id="exo1" disabled>
	<option value="0" selected>No</option> 
    <option value="1" <?php if($row['imi'] == 1) echo 'selected'; ?>>Si</option>
  



														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>

<div class="col-md-3">

													  <div class="form-group">
 
	<label class="control-label">Exo 2%:</label>
	<select name="exo2" class="form-control" id="exo2" disabled>
	<option value="0" selected>No</option> 
    <option value="1" <?php if($row['ir'] == 1) echo 'selected'; ?>>Si</option>
   



														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>   
                                               
                                                        <div class="col-md-3">

														<div class="form-group">

														  <label>Giro</label>
															<input name="course" type="text" class="form-control" id="course" value="<?php echo sanitizedOutput($row['course']); ?>" readonly>
														</div>

													</div>
												  
												  <div class="col-md-3">

														<div class="form-group">

														  <label>Teléfono</label>
															<input name="phone" type="text" class="form-control" id="phone" value="<?php echo sanitizedOutput($row['phone']); ?>" readonly>
														</div>

													</div>
														
														
														<div class="col-md-3">

														<div class="form-group">

														  <label>Ciudad</label>
															<input name="city" type="text" class="form-control" id="city" value="<?php echo sanitizedOutput($row['city']); ?>" readonly>
														</div>

													</div>
												  
												  <div class="col-md-3">

														<div class="form-group">

														  <label>País</label>
															<input name="country" type="text" class="form-control" id="country" value="<?php echo sanitizedOutput($row['country']); ?>" readonly> 
														</div>

													</div>
													  
													    <div class="col-md-9 ">

													  <div class="form-group">

														<label>Dirección</label>

													    <input name="address" type="text" class="form-control" id="address" placeholder="Ej: Rotonda El Gueguense 300mts al sur 2c abajo. Contiguo a PBS. Managua, Nicaragua." value="<?php echo sanitizedOutput($row['address']); ?>" readonly>

														</div>

													</div>   
                                               
                                                   <div class="col-md-3">

													<div class="form-group"> 

									 				  <label class="control-label">Última Actualización:</label>
									 				 <select name="updated" class="form-control" id="updated" disabled>
    													<option value="0" selected>No</option> 
    													<option value="1" <? if($row['updated'] == 1) echo 'selected'; ?>>Si</option> 
													 </select>
													</div> 
                                                    

												  </div> 
                                               
                                                    <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Grupo Casa Pellas:</label>

														  <select name="gcp" class="form-control" id="gcp">
                                                          <option value="0" selected>No</option>
                                                          <option value="1" <?php if($row['gcp'] == 1) echo 'selected'; ?>>Si</option> 
                                                          
													
														</select>
	

													  </div>

													</div>
                                               
                                                                                                                            <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Es Aseguradora?</label>

														  <select name="insurers" class="form-control" id="insurers">
                                                          <option value="0" selected>No</option>
                                                          <option value="1" <?php if($row['insurers'] == 1) echo 'selected'; ?>>Si</option> 
                                                          
													
														</select>
	

													  </div>

													</div>      
													
													 <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Activar pago de TC?</label>

														  <select name="cc" class="form-control" id="cc">
                                                          <option value="0" selected>No</option>
                                                          <option value="1" <?php if($row['cc'] == 1) echo 'selected'; ?>>Si</option> 
                                                          
													
														</select>
	

													  </div>

													</div>   
                                                    
                                                     <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Es una Alcaldía?</label>

														  <select name="hall" class="form-control" id="hall" disabled>
                                                          <option value="0" selected>No</option>
                                                          <option value="1" <?php if($row['hall'] == 1) echo 'selected'; ?>>Si</option> 
                                                          
													
														</select>
	

													  </div>

													</div>   
													
													
                                                </div>
                                                <? /*
                                                <div class="row">
                                                <div class="col-md-3">

													  <div class="form-group">
 
	<label class="control-label">Banco:</label>
	<select name="bank" class="form-control" id="bank">
    <option value="0" selected>Seleccionar</option> 
                                                          
<?php $querybank = "select * from banks";
$resultbank = mysqli_query($con, $querybank);
while($rowbank=mysqli_fetch_array($resultbank)){
?>																<option value="<?php echo $rowbank['id']; ?>" <? if($rowbank['id'] == $row['bank']) echo 'selected'; ?>><?php echo $rowbank['name']; ?></option>
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

														<label class="control-label">Cuenta:</label>  

														  <input name="account" type="text" class="form-control" id="account" placeholder="" value="<?php echo $row['account']; ?>">

														</div>

													</div>
                                                    <div class="col-md-5">

													  <div class="form-group">
 
	<label class="control-label">Plan de Pago:</label>
	<select name="plan" class="form-control" id="plan">
    <option value="0" selected>Seleccionar</option> 
                                                          
<?php $querybank = "select * from plans";
$resultbank = mysqli_query($con, $querybank);
while($rowbank=mysqli_fetch_array($resultbank)){
	
	$querybank2 = "select * from banks where id = '$rowbank[bank]'";
	$resultbank2 = mysqli_query($con, $querybank2);
	$rowbank2=mysqli_fetch_array($resultbank2);

	$querycompany = "select * from companies where id = '$rowbank[company]'";
	$resultcompany = mysqli_query($con, $querycompany);
	$rowcompany=mysqli_fetch_array($resultcompany);

	$querycurrency = "select * from currency where id = '$rowbank[currency]'";
	$resultcurrency = mysqli_query($con, $querycurrency);
	$rowcurrency = mysqli_fetch_array($resultcurrency); 
		
	?>																	<option value="<?php echo $rowbank['id']; ?>" <? if($rowbank['id'] == $row['plan']) echo 'selected'; ?>><?php echo $rowcompany['name']."/".$rowbank2['name']."/".$rowcurrency['name']."/".$rowbank['account']; ?></option>
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
                                                </div>
												*/ ?>

												<!--/row-->

												

												<!--/row-->

												<h3 class="form-section">Información de Contacto</h3>

												<div class="row"></div>
                                               <? 
												$queryc = "select * from providerscontacts where provider = '$row[id]'";
												$resultc = mysqli_query($con, $queryc); 
												$iba = 1;
												$numc = mysqli_num_rows($resultc);
												while($rowc=mysqli_fetch_array($resultc)){
												?>
                                                <div id="contact_<? echo $iba; ?>">
 
												<input type="hidden" name="cid[]" value="<? echo $rowc['id']; ?>">
												<div class="col-md-4">

														<div class="form-group">

														  <label>Nombre:</label>

															<input name="cname[]" type="text" class="form-control" id="cname[]" value="<?php echo sanitizedOutput($rowc['cname']); ?>" readonly>

														</div>

													</div>
												<div class="col-md-4">

														<div class="form-group"> 

														  <label>Cargo:</label>

															<input name="cjob[]" type="text" class="form-control" id="cjob[]" value="<?php echo sanitizedOutput($rowc['cjob']); ?>" readonly> 

														</div>

													</div>
												<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Correo:</label>
														<input name="cemail[]" type="text" class="form-control" id="cemail[]" placeholder="ejemplo@compañia.com" value="<?php echo sanitizedOutput($rowc['cemail']); ?>" readonly>
													  </div>

													</div>
												<div class="col-md-4">

													<div class="form-group">

									 				  <label class="control-label">Teléfono:</label>
									 				  <input name="cphone[]" type="text" class="form-control" id="cphone[]" placeholder="Ej: +505 2248 0120." value="<?php echo sanitizedOutput($rowc['cphone']); ?>" readonly>
													</div> 
                                                    

												  </div>
                                                <div class="col-md-4">

													<div class="form-group">

									 				  <label class="control-label">Celular:</label>
									 				  <input name="cmobile[]" type="text" class="form-control" id="cmobile[]" placeholder="Ej: +505 2248 0120." value="<?php echo sanitizedOutput($rowc['cmobile']); ?>" readonly>
													</div> 
                                                    

												  </div>
                                               
                                              <div class="col-md-4">

													<div class="form-group">

									 				  <label class="control-label">Notificaciones:</label>
									 				 <select name="cnot[]" class="form-control" id="cnot[]" disabled>
    													<option value="0" selected>No</option>
    													<option value="1" <? if($rowc['cnot'] == 1) echo 'selected'; ?>>Si</option> 
													 </select>
													</div> 
                                                    

												  </div>
                                              <div class="col-md-4">

													<div class="form-group">

									 				  <label class="control-label">Retenciones:</label>
									 				 <select name="cret[]" class="form-control" id="cret[]" disabled>
    													<option value="0" selected>No</option>
    													<option value="1" <? if($rowc['cret'] == 1) echo 'selected'; ?>>Si</option>
													 </select>
													</div> 
                                                    

												  </div>
                                              
                                               
                                               
													<div class="row"></div>
												  <hr>

												  <!--/span-->
                                                
												</div>
												<? 
												$iba++;
												} 
												?>
											
												
												<br><br>
							
												
												<h3 class="form-section">Planes de pago</h3>
												<div class="row"></div>
												<? 
												$queryba = "select * from providers_plans where provider = '$row[id]'"; 
												$resultba = mysqli_query($con, $queryba);
												$numba = mysqli_num_rows($resultba);
												$iba = 1; 
												while($rowba=mysqli_fetch_array($resultba)){
												?>
												
												<div class="row" id="bank_<? echo $iba; ?>">
                                               <input type="hidden" name="baid[]" value="<? echo $rowba['id']; ?>">
                                                <div class="col-md-3">

													  <div class="form-group">
 
	<label class="control-label">Banco:</label>
	<select name="bank[]" class="form-control" id="bank[]" disabled>
    <option value="0" selected>Seleccionar</option> 
                                                          
<?php $querybank = "select * from banks";
$resultbank = mysqli_query($con, $querybank);
while($rowbank=mysqli_fetch_array($resultbank)){
?>																<option value="<?php echo $rowbank['id']; ?>" <? if($rowbank['id'] == $rowba['bank']) echo 'selected'; ?>><?php echo $rowbank['name']; ?></option>
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

														<label class="control-label">Cuenta:</label>  

														  <input name="account[]" type="text" class="form-control" id="account[]" placeholder="" value="<?php echo sanitizedOutput($rowba['account']); ?>" readonly>

														</div>

													</div>
                                                <div class="col-md-4">

													  <div class="form-group">
 
	<label class="control-label">Plan de Pago:</label>
	<select name="plan[]" class="form-control" id="plan[]" disabled>
    <option value="0" selected>Seleccionar</option> 
                                                          
<?php $querybank = "select * from plans";
$resultbank = mysqli_query($con, $querybank);
while($rowbank=mysqli_fetch_array($resultbank)){ 
	
	$querybank2 = "select * from banks where id = '$rowbank[bank]'";
	$resultbank2 = mysqli_query($con, $querybank2);
	$rowbank2=mysqli_fetch_array($resultbank2);

	$querycompany = "select * from companies where id = '$rowbank[company]'";
	$resultcompany = mysqli_query($con, $querycompany);
	$rowcompany=mysqli_fetch_array($resultcompany);

	$querycurrency = "select * from currency where id = '$rowbank[currency]'";
	$resultcurrency = mysqli_query($con, $querycurrency);
	$rowcurrency = mysqli_fetch_array($resultcurrency); 
		
	?>																	<option value="<?php echo $rowbank['id']; ?>" <? if($rowbank['id'] == $rowba['plan']) echo 'selected'; ?>><?php echo $rowcompany['name']."/".$rowbank2['name']."/".$rowcurrency['name']."/".$rowbank['account']; ?></option>
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
												</div>
                                                <? 
													$iba++;
													} 
												?>
											
												<script>
													var cbank = parseInt(<?php echo $numba+1; ?>);  
													function addRow(){ 
														var str_row  = '<br><input type="hidden" name="baid[]" value="0"><div class="row"><div class="col-md-3"><select name="bank[]" class="form-control" id="bank"><option value="0" selected>Banco</option> <?php $querybank = "select * from banks";
$resultbank = mysqli_query($con, $querybank); while($rowbank=mysqli_fetch_array($resultbank)){ ?><option value="<?php echo $rowbank['id']; ?>"><?php echo $rowbank['name']; ?></option><?php } ?></select></div><div class="col-md-4"><input name="account[]" type="text" class="form-control" id="account" placeholder="Cuenta" value=""></div><div class="col-md-4"><select name="plan[]" class="form-control" id="plan"><option value="0" selected>Plan de pago</option><?php $querybank = "select * from plans"; $resultbank = mysqli_query($con, $querybank); while($rowbank=mysqli_fetch_array($resultbank)){ $querybank2 = "select * from banks where id = '$rowbank[bank]'"; $resultbank2 = mysqli_query($con, $querybank2); $rowbank2=mysqli_fetch_array($resultbank2); $querycompany = "select * from companies where id = '$rowbank[company]'"; $resultcompany = mysqli_query($con, $querycompany); $rowcompany=mysqli_fetch_array($resultcompany); $querycurrency = "select * from currency where id = '$rowbank[currency]'"; $resultcurrency = mysqli_query($con, $querycurrency); $rowcurrency = mysqli_fetch_array($resultcurrency); ?><option value="<?php echo $rowbank['id']; ?>" <? if($rowbank['id'] == $row['plan']) echo 'selected'; ?>><?php echo $rowcompany['name']."/".$rowbank2['name']."/".$rowcurrency['name']."/".$rowbank['account']; ?></option><?php } ?></select> </div><div class="col-md-1"><button type="button" class="btn red icn-only" onclick="deleteBank('+cbank+')"><i class="fa fa-trash-o"></i>-</button></div></div>';
														
														//alert(str_row);
														$("#banks").append('<div id="bank_'+cbank+'">'+str_row+'</div>');
														cbank++;
													}
													
													var ccontact = parseInt(<? echo $numc+1; ?>);
													function addRow2(){
														var str_row2 = '<input type="hidden" name="cid[]" value="0"><div class="col-md-4"><div class="form-group"><label>Nombre:</label><input name="cname[]" type="text" class="form-control" id="cname" value=""></div></div><div class="col-md-4"><div class="form-group"><label>Cargo:</label><input name="cjob[]" type="text" class="form-control" id="cjob[]" value=""></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Correo:</label><input name="cemail[]" type="text" class="form-control" id="cemail[]" placeholder="ejemplo@compañia.com" value=""></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Teléfono:</label><input name="cphone[]" type="text" class="form-control" id="cphone[]" placeholder="Ej: +505 2248 0120." value=""></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Celular:</label><input name="cmobile[]" type="text" class="form-control" id="cmobile[]" placeholder="Ej: +505 2248 0120." value=""></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Notificaciones:</label><select name="cnot[]" class="form-control" id="cnot[]"><option value="0" selected>No</option><option value="1">Si</option></select></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Retenciones:</label><select name="cret[]" class="form-control" id="cret[]"><option value="0" selected>No</option><option value="1">Si</option></select></div></div><div class="col-md-2"><div class="form-group"><label class="control-label">Opciones:</label><button type="button" class="btn red icn-only" onclick="deleteContact('+ccontact+');"><i class="fa fa-trash-o"></i>Eliminar</button></div></div>'; 
														
														$("#contacts").append('<div id="contact_'+ccontact+'">'+str_row2+'<div class="row"></div><hr></div>'); 
														ccontact++;
													}
													
													function deleteBank(id){ 
	 													$('#bank_'+id).remove();  
													}
													function deleteContact(id){  
	 													$('#contact_'+id).remove();  
													} 
													
												</script>	

											</div>

											<div class="form-actions right">

												<button type="button" class="btn default" onClick="goProviders();"><i class="fa fa-reply"> </i> Regresar</button>
                                                <script>
												function goProviders(){
													window.location = "providers-info.php";
												}
												</script>

											

											</div>

										</form>

										<!-- END FORM-->



									</div>  

								</div>

							</div>
                            
                            
                          <? //Buscar en banks form ?>
						  <div class="">
						  <h3>LOG de actualizaciones</h3> 
						  
						  <? 
						  
						  $querylog = "select * from providerstimes where provider = '$row[id]'";
						  $resultlog = mysqli_query($con, $querylog);
						  $numlog = mysqli_num_rows($resultlog);
						  if($numlog > 0){
						  ?> 
						  
						  
						  <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 TID</th>

									<th width="13%">

										 Fecha y Hora</th>

									<th width="11%">Usuario</th>

								  </tr>

								</thead>

								<tbody>
                                <?php while($rowlog=mysqli_fetch_array($resultlog)){
								
									$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$rowlog[userid]'")); 
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowlog['id']; ?></td>
                                  <td><? echo date('d-m-Y',strtotime($rowlog['today'])); ?> @<? echo date('h:i:s a', strtotime($rowlog['now2'])); ?>                            </td><td><? echo $rowcollaborator['first']." ".$rowcollaborator['last']; ?></td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
						  <? }
						  else{ 
						  ?>
						  <div class="note note-regular">
						  NOTA: No se encontró ningún registro.
						  </div>
						  <? } ?>
						  </div>
							

							

							

							

							

							

					

					</div>

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

<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>


<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/form-samples.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>

jQuery(document).ready(function() {    

   // initiate layout and plugins

 Metronic.init(); // init metronic core components

Layout.init(); // init current layout

QuickSidebar.init() // init quick sidebar

   FormSamples.init();

});

</script>






<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
<script>
function Eliminar(id){
	if (confirm("Usted desea eliminar esta cuenta?\n- Si usted no desea eliminar esta cuenta presione cancelar.")==true){
	window.location="providers-account-delete.php?id="+id+"&id2=<?php echo $row['id']; ?>";		
	}
}

function Favorita(id){
	window.location="providers-account-favorite.php?id="+id+"&id2=<?php echo $row['id']; ?>"; 
}
</script>