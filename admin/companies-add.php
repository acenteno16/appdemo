<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('includes.php');
$requiredFiles = ['general']; 
 
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
<link rel="shortcut icon" href="favicon.ico"/>
<?php loadCSS($requiredFiles, $nonce); ?>
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


			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Compañías <small>Agregar</small></h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="companies.php">Compañías</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>Agregar

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

									<div class="portlet-title"></div>

			 						<div class="portlet-body form">

										<form action="companies-add-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 

											<div class="form-body">

												<div class="row">

													<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Nombre:</label>
	<input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>">
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
														      </div>
													    </div>
													  </div>

													</div>
                                                
												</div>

												<div class="row"></div>
											</div>

											<div class="form-actions right">

												<button type="button" class="btn default" id="btnGoCompanies">Regresar</button>
                                                <script nonce="<?= $nonce ?>">
                                                document.getElementById('btnGoCompanies').addEventListener('click', function() {
													window.location.href = "companies.php";
												});
                                                </script>

											  <button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar</button>
												

											</div>

										</form>

									</div>  

								</div>

							</div>

					</div>

				</div>

			</div>

		</div>

	</div>

<?php include("sidebar.php"); ?>
</div>
<?php 
	include("footer.php"); 
	loadJS($requiredFiles, $nonce);
?>
</body>
</html>
<? include('foot.php'); ?>