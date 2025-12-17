<?php 

require('headers.php');
$allowedRoles = ['admin', 'request'];
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
</head>
<body class="page-header-fixed page-quick-sidebar-over-content ">
<?php include("header.php"); ?>
<div class="clearfix">
</div>
<div class="page-container">
<?php include("side.php"); ?>

	<div class="page-content-wrapper">

		<div class="page-content">

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Beneficiarios <?php //<small>Ordenes de pago</small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Beneficiarios</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Beneficiarios en espera de aprobación

							</div>

							<div class="actions">

								<a href="beneficiaries-add.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Agregar Beneficiario</span>

								</a>

							

							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

								<?php $query = "select * from beneficiaries where userid = '$_SESSION[userid]' and active = 0";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								if($num > 0){ ?>
                                
                                	<table width="90%" class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">
									<th width="15%">Fecha</th>
									<th width="33%">Nombre</th>
									<th width="33%">Proveedor</th>
									<th width="19%">Opciones</th>
								</tr>

								</thead>

								<tbody>
                                <?php 
								while($row=mysqli_fetch_array($result)){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								?>
                                
                                <tr role="row" class="odd">
                                <td class="sorting_1"><?php echo $row['today']; ?></td>
                                <td><?php echo $row['name']; ?></td><td><?php echo $rowprovider['name']; ?></td>
                                <td><a href="beneficiaries-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td>
                                </tr>
                                <?php } } else { ?>
                                
                                <div class="note note-danger">
									<p>NOTA: Usted no tiene ninguna peticion de beneficiario en proceso.</p>
								</div>
                                <?php } ?>
                                </tbody>

								</table>

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