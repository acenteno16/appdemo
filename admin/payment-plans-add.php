<?php

include("session-providers.php");  

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

					Planes de Pago <small>+Agregar</small>

					</h3>

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

							<a href="payment-plans.php">Planes de pago</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

						Agregar </li>

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

										<form action="payment-plans-add-code.php" method="post" enctype="multipart/form-data" class="horizontal-form">  

											<div class="form-body">

												<h3 class="form-section">Información </h3>

												<div class="row">

													<div class="col-md-6">

														<div class="form-group">

															<label class="control-label">Cuenta:</label>

															<input name="account" type="text" class="form-control" id="firstName">

															<? /*<span class="help-block">

															This is inline help </span>*/ ?>

														</div>

													</div>
                                                    
                                                    <div class="col-md-6">

														<div class="form-group">

															<label class="control-label">Compañía:</label> 

														  <select name="company" class="form-control" id="company">
                                                            <? 
															$querybanks = "select * from companies";
															$resultbanks = mysqli_query($con, $querybanks);
															while($rowbanks=mysqli_fetch_array($resultbanks)){
															?>
                                                            <option value="<? echo $rowbanks['id']; ?>" <? if($row['company'] == $rowbanks['id']) echo 'selected'; ?>><? echo $rowbanks['name']; ?></option>
                                                            <? } ?>
                                                            </select>

															<? /*<span class="help-block">

															This is inline help </span>*/ ?>

														</div>

													</div>
                                                    <div class="col-md-6">

														<div class="form-group">

															<label class="control-label">Banco:</label> 

														  <select name="bank" class="form-control" id="bank">
                                                            <? 
															$querybanks = "select * from banks order by name";
															$resultbanks = mysqli_query($con, $querybanks);
															while($rowbanks=mysqli_fetch_array($resultbanks)){
															?>
                                                            <option value="<? echo $rowbanks['id']; ?>" <? if($row['bank'] == $rowbanks['id']) echo 'selected'; ?>><? echo $rowbanks['name']; ?></option>
                                                            <? } ?>
                                                            </select>

															<? /*<span class="help-block">

															This is inline help </span>*/ ?>

														</div>

													</div>
                                                    <div class="col-md-6">

													  <div class="form-group">

														<label class="control-label">Moneda:</label> 

													    <select name="currency" class="form-control" id="currency">
                                                          <? 
															$querybanks = "select * from currency";
															$resultbanks = mysqli_query($con, $querybanks);
															while($rowbanks=mysqli_fetch_array($resultbanks)){
															?>
                                                          <option value="<? echo $rowbanks['id']; ?>" <? if($row['currency'] == $rowbanks['id']) echo 'selected'; ?>><? echo $rowbanks['name']; ?></option>
                                                          <? } ?>
                                                          </select>

														  <? /*<span class="help-block">

															This is inline help </span>*/ ?>

														</div>

													</div>

													<!--/span-->

<? /*<div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Nombre:</label>
	<input name="name" type="text" class="form-control" id="name" placeholder="Ej: Casa Pellas S.A.">
	<div title="Page 5">
															  <div>
															    <div>
															 <span class="help-block">

															 Razón social del proveedor o bien nombre de la empresa o entidad </span>
														        </div>
														      </div>
													    </div>
														</div>

													</div>
                                                    
                                                    <div class="col-md-2">

														<div class="form-group">

															<label class="control-label">Vencimiento:</label>

															<input name="term" type="text" class="form-control form-control-inline " id="term" placeholder="Ej: 30" value="" size="16"/>

															<span class="help-block">

															Plazo en dias.</span>

														</div>

													</div>

													<!--/span-->

													<div class="col-md-2">

														<div class="form-group">

															<label class="control-label">RUC:</label>

															<input name="ruc" type="text" class="form-control" id="ruc" placeholder="Ej: J03100000002371">

														</div>

													</div>*/ ?>

													<!--/span-->

												</div>

												<!--/row-->

												

													

													<!--/span-->

											

												<!--/row-->

												

												<!--/row-->

												<?php /* 
                                                <h3 class="form-section">Información de Contacto</h3>

												<div class="row"></div>
                                                <div class="row">

													<div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Correo:</label>
														<input name="email" type="text" class="form-control" id="email" placeholder="ejemplo@compañia.com">
													  </div>

													</div>

													<!--/span-->

												  <div class="col-md-3">

													<div class="form-group">

									 				  <label class="control-label">Teléfono:</label>
									 				  <input name="phone" type="text" class="form-control" id="phone" placeholder="Ej: +505 2248 0120.">
													</div> 
                                                    

												  </div>
                                                    <div class="col-md-6 ">

													  <div class="form-group">

														<label>Dirección</label>

													    <input name="address" type="text" class="form-control" id="address" placeholder="Ej: Rotonda El Gueguense 300mts al sur 2c abajo. Contiguo a PBS. Managua, Nicaragua.">

														</div>

													</div>
                                                    

												  <!--/span-->

												</div>

												<div class="row">

													<div class="col-md-3">

														<div class="form-group">

															<label>Nombre de la Empresa</label>

															<input name="cname" type="text" class="form-control" id="cname">

														</div>

													</div>

													<!--/span-->

													<div class="col-md-3">

														<div class="form-group">

															<label>Nombre Jurídico</label>

															<input name="jname" type="text" class="form-control" id="jname">

														</div>

													</div>

													<!--/span-->

											

													<div class="col-md-3">

														<div class="form-group">

															<label>Contacto</label>

															<input name="contact" type="text" class="form-control" id="contact">

														</div>

													</div>

													<!--/span-->

													<div class="col-md-3">

														<div class="form-group">

															<label>Giro</label>
															<input name="course" type="text" class="form-control" id="course">
														</div>

													</div>

													<!--/span-->

												</div>
                                                
                                                						<h3 class="form-section">Información de Geográfica</h3>

												<div class="row"></div>
                                                <div class="row">

													<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Internacional:</label>


															<select name="international" class="form-control" id="international">
<option value="0" selected>No</option>
<option value="1" <?php if($row['international'] == 1){ echo 'selected'; ?>>Si</option>
 
</select>
																								

													</div>
                                               
                                               </div>

											</div>
*/ ?>
											<div class="form-actions right">

												<button type="button" class="btn default" onClick="javascript:goBack();">Cancelar</button>
                                                <script type="text/javascript">
												function goBack(){
													window.location = "<?php echo $_SERVER['HTTP_REFERER']; ?>"; 
												}
                                                </script>

												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar</button>

											</div>

										</form>

										<!-- END FORM-->

									</div>

								</div>

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

<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

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


<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/clockface/js/clockface.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>

        jQuery(document).ready(function() {       

           // initiate layout and plugins

           Metronic.init(); // init metronic core components

Layout.init(); // init current layout

QuickSidebar.init() // init quick sidebar

           ComponentsPickers.init();

        });   

    </script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>