<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('sanitize.php');
require('includes.php');
$requiredFiles = ['general']; 

$id = isset($_GET['id']) ? sanitizeInput(intval($_GET['id']), $con) : 0;

$query = "select * from companies where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
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
<div class="clearfix">
</div>
<div class="page-container">
<?php include("side.php"); ?>
<div class="page-content-wrapper">
<div class="page-content">
<div class="row">

				<div class="col-md-12">
					<h3 class="page-title">Companies <small>Editor</small></h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="dashboard.php">Inicio</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="companies.php">Companies</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>Editor</li> 
					</ul>
				</div>

			</div>

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

										<form action="companies-edit-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 

											<div class="form-body">

											

												<div class="row">

													<div class="col-md-2">

													  <div class="form-group">

															<label class="control-label">ID:</label> 

														  <input name="id2" type="text" disabled class="form-control" id="firstName" value="<?php echo $row['id']; ?>" readonly>

	

														</div>

													</div>

													<!--/span-->

													
                                                    
                                                    <div class="col-md-2">

													  <div class="form-group">

															<label class="control-label">Activa:</label> 

														 <select class="form-control" name="active" id="active">
                                                          <option value="0" selected>No</option>  
                                                          <option value="1" <? if($row['active'] == 1) echo 'selected'; ?>>Si</option>
                                                          </select>

														</div>

													</div>
                                                    
                                                    <div class="col-md-9">

													  <div class="form-group">

	<label class="control-label">Nombre:</label>
	<input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>">
                                                          

													  </div>

													</div>
                                                    
                                                     <div class="col-md-3">

													  <div class="form-group"> 

	<label class="control-label">RUC:</label>
	<input name="ruc" type="text" class="form-control" id="ruc" value="<?php echo $row['ruc']; ?>">
                                                          

													  </div>

													</div>
                                                    
                                                    
                                                   <div class="row"></div>
                                                    <div class="col-md-3">

													 

												
                                                    <div class="form-group">

	<label class="control-label">Logo</label> 
	<input name="fileLogo" type="file" class="form-control" id="fileLogo" value="">
													  </div>
                                                      
                                                      
                                                      
                                                      </div>
													
													
													<div class="col-md-3">

													 

												
                                                    <div class="form-group">

	<label class="control-label">Logo (Emails)</label> 
	<input name="fileLogo2" type="file" class="form-control" id="fileLogo2" value="">
													  </div>
                                                      
                                                      
                                                      
                                                      </div>
													
													
													<div class="row"></div>
													
                                                    <div class="col-md-3">
                                                   <?php 
													  $addressLogo = "companies/".$_GET['id'].".png"; 
													  if(file_exists($addressLogo)){
													  ?> 
                                                    
                                                      <img src="<?php echo $addressLogo; ?>" width="100px">    
                                                      
                                                   
                                                    <?php } ?>
													 </div>
													
													<div class="col-md-3" style="min-height: 100px; background: #24355C;">
                                                   <?php 
													  $addressLogo2 = "companies/".$_GET['id']."-email.png"; 
													  if(file_exists($addressLogo2)){
													  ?> 
                                                    
                                                      <img src="<?php echo $addressLogo2; ?>" width="100%">    
                                                      
                                                   
                                                    <?php } ?>
													 </div>
													
													
													
													<div class="row"></div>
													
													
													<div class="col-md-2">

													  <div class="form-group">

															<label class="control-label">IR Activo:</label> 

														 <select class="form-control" name="iractive" id="iractive">
                                                          <option value="0" selected>No</option>   
                                                          <option value="1" <? if($row['iractive'] == 1) echo 'selected'; ?>>Si</option>
                                                          </select>

														</div>

													</div>
													
													<div class="col-md-10">

													 

												
                                                    <div class="form-group">

	<label class="control-label">Archivo Retención IR: (1072X546px)</label> 
	<input name="file" type="file" class="form-control" id="file" value="">
													  </div>
                                                      
                                                      
                                                      
                                                      </div>
                                                    
                                                   <?php 
													  $address = "/home/retentions/".$row['id']."/".$row['id'].".jpg"; 
													  if(file_exists($address)){ 
													  ?> <div class="col-md-12">
                                                      <img src="e-irretentionimage.php?id=<? echo $row['id']; ?>" width="80%">
                                                    </div>
                                                    <?php } ?>
                                                    

													<!--/span-->

												</div>

												<!--/row--><!--/row-->

												

												<!--/row-->

												<div class="row"></div>

										    <!--/row--></div>

											<div class="form-actions right">

												<a href="companies.php"><button type="button" class="btn default"><i class="fa fa-times"></i> Cancelar</button></a>

											  <button type="submit" class="btn blue"><i class="fa fa-check"></i> Editar</button>
												<input name="id" type="hidden" id="id" value="<?php echo $row['id']; ?>">

											</div>

										</form>

										<!-- END FORM-->

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