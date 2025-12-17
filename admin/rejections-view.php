<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('functions.php');
require('includes.php');
$requiredFiles = ['general'];

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = $con->prepare("select * from reason where id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$num = $result->num_rows;
$row = $result->fetch_assoc();

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

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Rechazos <small>Editor de Rechazos</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="rejections.php">Rechazos</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>Visor de  Rechazos

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

									

										

									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="#" class="horizontal-form"> 

											<div class="form-body">

												<h3 class="form-section">Informacion General</h3>

												<div class="row">

													<div class="col-md-2">

														<div class="form-group">

															<label class="control-label">ID:</label>

															<input name="id" type="text" disabled class="form-control" id="firstName" value="<?php echo $row['id'];  ?>" readonly>

															

														</div>

													</div>

													<!--/span-->

													<div class="col-md-10">

													  <div class="form-group">

	<label class="control-label">Nombre:</label>
	<input name="name" type="text" disabled class="form-control" id="name" placeholder="Ej: Casa Pellas S.A." value="<?php echo $row['name'];  ?>" readonly> 
	
															    <div>
															
														        </div>
														      </div>
													    </div>
				
                
                

													</div>
                                                    <div class="row">
                                                      
                                                    
  <div class="col-md-12 "><div class="form-actions right">

												
    <p>
                            
                            </p>
						   <a href="rejections-edit.php?id=<?= $row['id']; ?>"> <button type="button" class="btn blue"><i class="fa fa-edit"></i> Editar Rechazo</button> </a>
                            
                              
          
                             
												<input name="id" type="hidden" id="id" value="<?= $row['id']; ?>">
  </div>
                                            </div>                                                   </div>

													
												</div>

										
										</form>

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