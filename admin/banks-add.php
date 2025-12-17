<?php

require('headers.php');
$allowedRoles = ['admin', 'banks', 'bankingDebt'];
require("sessionCheck.php"); 
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
<?php loadCSS($requiredFiles); ?>	
</head>
<body class="page-header-fixed page-quick-sidebar-over-content ">
<?php include("header.php"); ?>
<div class="clearfix"></div>
<div class="page-container">
<?php include("side.php"); ?>
<div class="page-content-wrapper">
	<div class="page-content">

			<div class="row">

				<div class="col-md-12">

					<h3 class="page-title">Bancos <small>+Agregar Bancos</small></h3>

					<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="banks.php">Bancos</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							Agregar Bancos</li>

					</ul>

				</div>

			</div>

			<div class="row">

				<div class="col-md-12">

					<div class="tabbable tabbable-custom boxless tabbable-reversed">

							<div class="tab-pane" id="tab_1">

								<div class="portlet box blue">

									<div class="portlet-title"></div>

									<div class="portlet-body form"> 

										<!-- BEGIN FORM-->

										<form action="banks-add-code.php" method="post" enctype="multipart/form-data" class="horizontal-form">  

											<div class="form-body">

												<div class="row">

													<div class="col-md-2">

														<div class="form-group">

															<label class="control-label">ID:</label>

															<input name="id" type="text" disabled="disabled" class="form-control" id="id" placeholder="Auto" readonly>

														</div>

													</div>

													<!--/span-->

													<div class="col-md-10">

													  <div class="form-group">
														  <label class="control-label">Nombre:</label>
														  <input name="name" type="text" class="form-control" id="name" placeholder="Ej: BAC">
													  </div>

													</div>
												</div>
												<div class="row"></div>
											</div>
											<div class="form-actions right">
												


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
<?php include("footer.php"); loadJS($requiredFiles, $nonce); ?>
</body>
</html>
<script nonce="<?= $nonce ?>">
	document.getElementById('btnGoBack').addEventListener('click', function() {
		window.location.href = "banks.php";
	});
</script>