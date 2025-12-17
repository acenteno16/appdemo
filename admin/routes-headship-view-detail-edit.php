<?php include("sessions.php"); 

$id = $_GET['id'];
$unit = $_GET['unit'];
$query = "select * from routes where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result); 
 
$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[worker]'")); 
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

					Rutas <small>Editor de usuarios</small></h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Opciones</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>

							<a href="routes.php">Rutas</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>Editor de usuarios

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

																			</div>

									<div class="portlet-body form">

						 				<!-- BEGIN FORM-->

									 <form action="routes-headship-view-detail-edit-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 

											<div class="form-body">

												<h3 class="form-section">Informacion Empresarial</h3>

												<div class="row">

													<div class="col-md-12">

													  <div class="form-group">

															<label class="control-label">Usuario:</label> 

														  <input name="user" type="text" disabled class="form-control" id="firstName" value="<?php echo $rowuser['first']." ".$rowuser['last']; ?>" readonly>

	

														</div>

													</div>

													<!--/span-->

													<?php $readonly = "readonly";
$placeholder = "No necesario para este usuario.";
	if(($row['type'] == 2) or ($row['type'] == 3) or ($row['type'] == 4)){
		$readonly = '';
		$placeholder = 'Ej: 2000.00'; 
	}
	
	?>
                                                    
                                                    <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Monto limite: (Cordobas) </label>
	<input name="ammount1" type="text" class="form-control" id="ammount1" placeholder="<?php echo $placeholder; ?>" onkeypress="return justNumbers(event);" value="<?php if($row['ammount1'] != 0.00) echo $row['ammount1']; ?>" <?php echo $readonly; ?>>
	<div title="Page 5">
						 									  <div>
															    <div>
															
														        </div>
														      </div>
													    </div>
													  </div>

													</div> <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Monto limite: (Dólares) </label>
	<input name="ammount2" type="text" class="form-control" id="ammount2" placeholder="<?php echo $placeholder; ?>" onkeypress="return justNumbers(event);" value="<?php if($row['ammount2'] != 0.00) echo $row['ammount2']; ?>" <?php echo $readonly; ?>>
	<div title="Page 5">
						 									  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div> <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Monto limite: (Euros)</label>
	<input name="ammount3" type="text" class="form-control" id="ammount3" placeholder="<?php echo $placeholder; ?>" onkeypress="return justNumbers(event);" value="<?php if($row['ammount3'] != 0.00) echo $row['ammount3']; ?>" <?php echo $readonly; ?>>
	<div title="Page 5">
						 									  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div> <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Monto limite: (Yenes)</label>
	<input name="ammount4" type="text" class="form-control" id="ammount4" placeholder="<?php echo $placeholder; ?>" onkeypress="return justNumbers(event);" value="<?php if($row['ammount4'] != 0.00) echo $row['ammount4']; ?>" <?php echo $readonly; ?>>
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

												<!--/row--><!--/row-->

												

												<!--/row-->

												<div class="row"></div>

										    <!--/row--></div>

											<div class="form-actions right">

												<button type="button" class="btn default">Cancelar</button>

											  <button type="submit" class="btn blue"><i class="fa fa-check"></i> Editar</button>
												<input name="id" type="hidden" id="id" value="<?php echo $row['id']; ?>">
                                                <input name="route" type="hidden" id="route" value="<?php echo $_GET['route']; ?>">

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

          

        });   

function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }
		
    </script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>