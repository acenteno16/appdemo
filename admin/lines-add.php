<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('functions.php');
require('includes.php');
$requiredFiles = ['general'];

?>  
<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="utf-8"/>
<title>Aplicación de Pagos | Casa Pellas S.A.</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link rel="shortcut icon" href="favicon.ico"/>
<?php loadCSS($requiredFiles, $nonce); ?>	
</head>
<body class="page-header-fixed page-quick-sidebar-over-content ">
<?php include("header.php"); ?>
<div class="clearfix"></div>
<div class="page-container">
	<?php include("side.php"); ?>
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

					Líneas <small>+Agregar líneas</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						

					  <li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="lines.php">Líneas</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							Agregar Línea 

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

										<form action="lines-add-code.php" method="post" enctype="multipart/form-data" class="horizontal-form">  

											<div class="form-body">

												<h3 class="form-section">Informacion de la línea</h3>

												<div class="row">

													

													<!--/span-->

													<div class="col-md-2">

													  <div class="form-group">

	<label class="control-label">Código:</label> 
	<input name="code" type="text" class="form-control" id="code">
													  </div>

													</div>
													
													<div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Nombre:</label> 
	<input name="name" type="text" class="form-control" id="name">
													  </div>

													</div>

													<!--/span-->

												</div>
                                                <div class="row">

													

													<!--/span-->

													

													<!--/span-->

												</div>

												<!--/row--><!--/row-->

												

												<!--/row-->

												<div class="row"></div>

										    <!--/row--></div>

											<div class="form-actions right">

												<a href="lines.php"><button type="button" class="btn default">Cancelar</button></a>

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
<?php include("sidebar.php"); ?>
</div>
<?php include("footer.php"); loadJS($requiredFiles, $nonce); ?>
</body>
</html>
<?php include('foot.php'); ?> 