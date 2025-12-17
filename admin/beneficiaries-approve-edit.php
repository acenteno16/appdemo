<?php include("sessions.php"); 

$id = $_GET['id'];

$query = "select * from beneficiaries where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$queryprovider = "select * from providers where id = '$row[provider]'";
$resultprovider = mysqli_query($con, $queryprovider);
$rowprovider = mysqli_fetch_array($resultprovider);

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

			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

				<div class="modal-dialog">

					<div class="modal-content">

						<div class="modal-header">

							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

							<h4 class="modal-title">Modal title</h4>

						</div>

						<div class="modal-body">

							 Widget settings form goes here

						</div>

						<div class="modal-footer">

							<button type="button" class="btn blue">Save changes</button>

							<button type="button" class="btn default" data-dismiss="modal">Close</button>

						</div>

					</div>

					<!-- /.modal-content -->

				</div>

				<!-- /.modal-dialog -->

			</div>

			<!-- /.modal -->

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN STYLE CUSTOMIZER -->

			

			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Beneficiarios <small>Agregar beneficiarios</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="beneficiaries.php">Beneficiarios</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							Agregar Beneficiarios

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

										<form action="beneficiaries-approve-edit-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" onsubmit="return validateForm();">  

											<div class="form-body">

												<h3 class="form-section">Información del proveedor</h3>

												<div class="row">

									<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

			<input name="name" type="text" class="form-control" id="name" value="<?php echo $rowprovider['code']." | ".$rowprovider['name']; ?>" readonly>		
											

															
													  </div>

													</div>
                                                   <div class="col-md-12">
                                                   <h4>Lista de beneficiarios:</h4>
</div>
<div id="beneficiaries" class="col-md-12">
<?php $query2 = "select * from beneficiaries where active = 1";
$result2 = mysqli_query($con, $query2);
$num2 = mysqli_num_rows($result2);
if($num2 > 0){
while($row2 = mysqli_fetch_array($result2)){
	echo '&bull '.$row2['name']."<br>";
 } }else{ ?>
 No se encontró ningun beneficiario.
 <?php } ?>
</div>
													<!--/span-->
</div>
		<br>
<br>
<h3 class="form-section">Información del beneficiario</h3>
        <div class="row">
      
	
								<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Nombre:</label>
	<input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" readonly>
													  </div>

													</div>
                                                    <div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Comentarios:</label>
	
	
    <textarea name="comments" readonly class="form-control" id="comments"><?php echo $row['comments1']; ?></textarea>
													  </div>

													</div>

													<!--/span-->

												</div>
	<br>

<h3 class="form-section">Aprobación del beneficiario</h3>
<div class="row">

<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">Aprobar</label>
															<select name="active" class="form-control" id="active" onChange="javascript:approve(this.value);">
																<option value="0">Seleccionar</option>
																<option value="1">Si</option>
<option value="2">No</option>
															</select>
															
						  </div>
													</div>
</div>
<div class="row" id="divcomments" style=" display:none;">
<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Comentarios:</label>
	
	
    <textarea name="comments2"  class="form-control" id="comments2"></textarea>
													  </div>

													</div>
</div>
												<!--/row--><!--/row-->

												

												<!--/row-->

												<div class="row"></div>

										    <!--/row--></div>

											<div class="form-actions right">

<input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>">												<button type="button" class="btn default">Cancelar</button>

												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Actualizar</button> 

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

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimeout.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimer.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script>
jQuery(document).ready(function() {    
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
});


function approve(value){
	var active = document.getElementById("active").value;
	
	if(active == 1){
		document.getElementById("divcomments").style.display = 'none';
	}
	if(active == 2){
		document.getElementById("divcomments").style.display = 'block';
	}
	
}

function validateForm(value){
	var active = document.getElementById("active").value;
	var comments = document.getElementById("comments2").value;
	if(active == 0){
		alert('Debe de seleccionar una opcion en el campo aprobar.');
		return false;
	}
	if((active == 2) && (comments == '')){
		alert('Para negar esta solicitud, usten necesita justificar en el campo de comentarios.');
		return false;
	}
	
}
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>