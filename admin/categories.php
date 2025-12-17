<?php

require('headers.php');
$allowedRoles = ['admin'];
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
<?php loadCSS($requiredFiles, $nonce); ?>
<body class="page-header-fixed page-quick-sidebar-over-content ">
<?php include("header.php"); ?>
<div class="clearfix"></div>
<div class="page-container">
<?php include("side.php"); ?>
	
	<div class="page-content-wrapper">

		<div class="page-content">

			<!-- BEGIN PAGE HEADER-->		

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Categorias <?php //<small>Ordenes de pago</small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li><a href="#">Categorias</a></li>

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">

					<?php /*<div class="note note-danger">

						<p>

							NOTE: The below datatable is not connected to a real database so the filter and sorting is just simulated for demo purposes only.

						</p>

					</div>*/ ?>

					<!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Lista de Categorias</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								<div class="table-actions-wrapper">

									<span>

									</span>

									<select class="table-group-action-input form-control input-inline input-small input-sm">

										<option value="">Seleccionar...</option>

										<option value="delete">Eliminar</option>

										
									</select>

									<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Procesar</button>

								</div>

								<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="15%">

										 Nombre</th>

									<th width="10%">

										 Opciones</th>

								</tr>

								</thead>

							<tbody>
<?php $query = "select * from categories where parentcat = 0";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
?>
								<tr role="row" class="odd"><td><?php echo $row['name']; ?></td><td><a href="categories-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                
                                <?php } ?> 
                                </tbody>

								</table>

							</div>

						</div>

					</div>

					<!-- End: life time stats -->

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