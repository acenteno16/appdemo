<?php 

session_start();

function hasAccess($roles) {
    foreach ($roles as $role) {
        if (isset($_SESSION[$role]) && $_SESSION[$role] === "active") {
            return true;
        }
    }
    return false;
}

$allowedRoles = ["admin", "providers"];

if(hasAccess($allowedRoles)){
    include("../connection.php");
}else{
    session_destroy();
    header("Location: ../?err=noproviders_provider_export");
    exit;
} 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0; 

$query = $con->prepare("select * from providers where id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$num = $result->num_rows;
$row = mysqli_fetch_array($result);
 
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

			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			

			<!-- /.modal -->

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN STYLE CUSTOMIZER -->

			

			<!-- END STYLE CUSTOMIZER -->

			

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

										<form action="providers-add-code.php" class="horizontal-form"> 

											<div class="form-body">

												<h3 class="form-section">Información Empresarial</h3>

												<div class="row">

													<div class="col-md-6">

														<div class="form-group">

															<label class="control-label">Código:</label>

															<input name="code" type="text" disabled class="form-control" id="firstName" value="<?php echo $row['code'];  ?>" readonly>

															

														</div>

													</div>

													<!--/span-->

													<div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Nombre:</label>
	<input name="name" type="text" disabled class="form-control" id="name" placeholder="Ej: Casa Pellas S.A." value="<?php echo $row['name'];  ?>" readonly> 
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

													<div class="col-md-3">

														<div class="form-group">

															<label class="control-label">Vencimiento:</label>

															<input name="term" type="text" disabled="disabled" class="form-control form-control-inline " id="term" placeholder="Ej: 30" value="<?php echo $row['term']; ?>" size="16" readonly/>

															<span class="help-block">

															Plazo en dias.</span>

														</div>

													</div>
                                                    <div class="col-md-3">

														<div class="form-group">

															<label class="control-label">Bandera:</label>

															<input name="term" type="text" disabled="disabled" class="form-control form-control-inline " id="term" value="<?php if($row['flag'] == 1) echo "Si"; else echo "No"; ?>" size="16" readonly/>


														</div>

													</div>
                                                    <div class="col-md-3">

														<div class="form-group">

															<label class="control-label">Internacional:</label>

															<input name="term" type="text" disabled="disabled" class="form-control form-control-inline " id="term" value="<?php if($row['international'] == 1) echo "Si"; else echo "No"; ?>" size="16" readonly/>


														</div>

													</div>

													<!--/span-->

													<div class="col-md-3">

														<div class="form-group">

															<label class="control-label">RUC:</label>

															<input name="ruc" type="text" disabled="disabled" class="form-control" id="ruc" placeholder="Ej: J03100000002371" value="<?php echo $row['ruc']; ?>" readonly>

														</div>

													</div>

													<!--/span-->

												</div>

												<!--/row-->

												

												<!--/row-->

												<h3 class="form-section">Información de Contacto</h3>

												<div class="row"></div> 
                                                <div class="row">

													<div class="col-md-6">

													  <div class="form-group">

														<label class="control-label">Correo:</label>
														<input name="email" type="text" disabled="disabled" class="form-control" id="email" placeholder="ejemplo@compañia.com" value="<?php echo $row['email']; ?>" readonly>
													  </div>

													</div>

													<!--/span-->

												  <div class="col-md-6">

													<div class="form-group">

									 				  <label class="control-label">Teléfono:</label>
									 				  <input name="phone" type="text" disabled="disabled" class="form-control" id="phone" placeholder="Ej: +505 2248 0120." value="<?php echo $row['phone']; ?>" readonly>
													</div> 
                                                    

												  </div>
                                                    <div class="col-md-12 ">

													  <div class="form-group">

														<label>Dirección</label>

													    <input name="address" type="text" disabled="disabled" class="form-control" id="address" placeholder="Ej: Rotonda El Gueguense 300mts al sur 2c abajo. Contiguo a PBS. Managua, Nicaragua." value="<?php echo $row['address']; ?>" readonly>

														</div>

													</div>
                                                    

												  <!--/span-->

												</div>

												<div class="row">

													<div class="col-md-6">

														<div class="form-group">

															<label>Nombre de la Empresa</label>

															<input name="cname" type="text" disabled="disabled" class="form-control" id="cname" value="<?php echo $row['cname']; ?>" readonly>

														</div>

													</div>

													<!--/span-->

													<div class="col-md-6">

														<div class="form-group">

															<label>Nombre Jurídico</label>

															<input name="jname" type="text" disabled="disabled" class="form-control" id="jname" value="<?php echo $row['jname']; ?>" readonly>

														</div>

													</div>

													<!--/span-->

												</div>

												<!--/row-->

												<div class="row">

													<div class="col-md-6">

														<div class="form-group">

															<label>Contacto</label>

															<input name="contact" type="text" disabled="disabled" class="form-control" id="contact" value="<?php echo $row['contact']; ?>" readonly>

														</div>

													</div>

													<!--/span-->

													<div class="col-md-6">

														<div class="form-group">

															<label>Giro</label>
															<input name="course" type="text" disabled="disabled" class="form-control" id="course" value="<?php echo $row['course']; ?>" readonly>
														</div>

													</div>

													<!--/span-->

												</div>

											</div>

											<div class="form-body">

												<h3 class="form-section">Información De Cuentas</h3>
												<?php 
												$queryaccounts = "select * from providersaccount where provider = '$row[id]'";
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
								<th class="numeric">
									 Favorita
								</th>
                                <th width="20%">
									 Banco</th>
								<th>
									 Moneda</th>
								<th class="numeric">
									 No. de Cuenta
								</th>
                              </tr>
							</thead>
							<tbody>
							
                            <?php while($rowaccounts=mysqli_fetch_array($resultaccounts)){ ?>
								<tr>
									<td class="numeric">
									   <?php if($row['account'] == $rowaccounts['id']) echo '<i class="fa fa-check"></i> '; ?>
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
									 }	?>
									</td>
									<td class="numeric">
										<?php echo $rowaccounts['number']; ?>
							    	</td>
                                </tr>
                              <?php } ?>
							</tbody>
							</table>
						</div>
              
              <?php } ?>
												<div class="row"></div>

										    <!--/row--></div>

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

Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
ComponentsPickers.init();
});   

function deleteProvider(id){
	if (confirm("Usted desea eliminar este proveedor\n- Si usted no desea eliminar este proveedor presione cancelar.")==true){
			window.location="providers-delete.php?id="+id;	
	} 
}

    </script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>