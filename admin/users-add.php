<?php include("sessions.php"); 

$id = $_GET['id'];

$query = "select * from workers where id = '$id'"; 
$result = mysqli_query($con, $query);
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
	
<link rel="stylesheet" type="text/css" href="../assets/global/plugins/select2/select2.css"/>	

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link href="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>

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

		

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Usuarios <small>Editor de Usuarios</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="users.php">Usuarios</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							Editor de Usuarios

						</li>

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row profile">

				<div class="col-md-12">

					<!--BEGIN TABS-->

					<div class="tabbable tabbable-custom tabbable-full-width">

						

						<div class="tab-content">

							

							<!--tab_1_2-->

							<div class="tab-pane active" id="tab_1_3">

								<div class="row profile-account">

									

									<div class="col-md-12">

										<div class="tab-content">

											<div id="tab_1-1" class="tab-pane active">

												<form role="form" action="users-add-code.php" enctype="multipart/form-data" method="post" >
												  <div class="col-md-4">												<div class="form-group">

														<label class="control-label">Nombre</label>

														<input name="first" type="text" class="form-control" id="first"  value="<?php echo $row['first']; ?>"/>

													</div></div>

													<div class="col-md-4"><div class="form-group">

														<label class="control-label">Apellido</label>

														<input name="last" type="text" class="form-control" id="last"  value="<?php echo $row['last']; ?>"/>

													</div></div>

		<div class="col-md-4">											<div class="form-group">

														<label class="control-label">Email</label>

														<input name="email" type="text" class="form-control" id="email"  value="<?php echo $row['email']; ?>"/>

													</div></div>
                                                    
                                                    <div class="col-md-4">											<div class="form-group">

														<label class="control-label">Cédula</label>

														<input name="nid" type="text" class="form-control" id="nid"  value=""/>

													</div></div>

													

													

													
                                                    
                                                    <div class="col-md-4"><div class="form-group">

														<label class="control-label">Compañía</label>
														<select name="company" class="form-control" id="company">
														<option value="0" selected>Seleccionar</option>
<?php $queryunit = "select * from companies";
$resultunit = mysqli_query($con, $queryunit);
while($rowunit=mysqli_fetch_array($resultunit)){
?>          <option value="<?php echo $rowunit['id']; ?>"><?php echo $rowunit['name']; ?></option>   
<?php } ?>													  </select>
													</div></div>
														
														<div class="col-md-4"><div class="form-group">

														<label class="control-label">Unidad de Negocio</label>
														<select name="unitid" class="form-control select2me" id="unitid" data-placeholder="Seleccionar...">
														  <option value="0" selected>Seleccionar</option>
<?php $queryunit = "select * from units where active = '1'";
$resultunit = mysqli_query($con, $queryunit);
while($rowunit=mysqli_fetch_array($resultunit)){
?>          <option value="<?php echo $rowunit['id']; ?>" <?php if($row['unitid'] == $rowunit['id']) echo 'selected'; ?>><?php echo $rowunit['newCode']." | ".$rowunit['companyName'].' '.$rowunit['lineName'].' '.$rowunit['locationName']; ?></option>   
<?php } ?>													  </select> 
													</div></div>
                                                    
                                                    
                                                    <div class="col-md-4">											<div class="form-group">

														<label class="control-label">Código</label>

														<input name="code" type="text" class="form-control" id="code"  value=""/>

													</div></div>
                                                    					
                                                    
												<div class="col-md-12"><br>

													<button type="submit" class="btn blue"><i class="fa fa-check"></i> Actualizar</button>

												  </div>

												</form>

											</div>
										</div>

									</div>

									<!--end col-md-9-->

								</div>

							</div>

							<!--end tab-pane-->

							

							<!--end tab-pane-->

							

							<!--end tab-pane-->

						</div>

					</div>

					<!--END TABS-->

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

<script type="text/javascript" src="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script> 

jQuery(document).ready(function() {       
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar

});

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>