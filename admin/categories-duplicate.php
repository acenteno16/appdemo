<?php 

include("session-admin.php");

$id = $_GET['id'];
$query = "select * from categories where id = '$id'";
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

		
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN STYLE CUSTOMIZER -->

			

			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Categorias <small>Elementos de categorías</small></h3>

					<ul class="page-breadcrumb breadcrumb">

						<?php /*<li class="btn-group">

							<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">

							<span>Actions</span><i class="fa fa-angle-down"></i>

							</button>

							<ul class="dropdown-menu pull-right" role="menu">

								<li>

									<a href="#">Action</a>

								</li>

								<li>

									<a href="#">Another action</a>

								</li>

								<li>

									<a href="#">Something else here</a>

								</li>

								<li class="divider">

								</li>

								<li>

									<a href="#">Separated link</a>

								</li>

							</ul>

						</li>*/ ?>

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="categories.php">Categorias</a>
                            	<i class="fa fa-angle-right"></i>
                                </li>

						<li>Elementos de Categorias</li>

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

										<form action="categories-add-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 

										  <div class="form-body">

												<h3 class="form-section">Agregar a la Categoría</h3>

												<div class="row">
													<div class="col-md-12 ">
													  <div class="form-group">
														<label>Nombre de la Categoría:</label> 
														  <input name="cat" type="text" disabled class="form-control" id="cat" value="<?php echo $row['name']; ?>" readonly>
						
                                                          
                       <br>
                                   
                                                        <div class="form-group">
                                                          <label>Nombre del Elemento:</label>
                                                          <input name="name" type="text" class="form-control" id="name">
                                                        </div>

                                                            <div class="form-group">
                                                              <label class="control-label">Parent:</label>
                                                              <select name="parentcat" class="form-control" id="parentcat">
                                                                <option value="<?php echo $row['id']; ?>">Principal</option>
                                                                <?php $query2 = "select * from categories where level > '0' and level < '3'";
$result2 = mysqli_query($con, $query2);
while($row2=mysqli_fetch_array($result2)){
?>
                                                                <option value="<?php echo $row2['id']; ?>"><?php echo $row2['name'].' (Nivel '.$row2['level'].')';; ?></option>
                                                                <?php } ?>
                                                              </select>
                                                            </div>
                                                      
                                                          <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                          <!--/row-->
                                                       
                                                        <div class="form-actions right">
                                                          
                                                          <button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar</button>
                                                          <input name="id" type="hidden" id="id" value="<?php echo $row['id']; ?>">
                                                        </div>
                                                      </div>
													</div>
                                                    
												</div>


										    <!--/row--></div>
										</form>
                                        
                                        	

										<!-- END FORM-->
                                        	
						
                        			</div>  

								</div>

							</div> 
<div class="portlet">
<br>
<div class="portlet-title">

							<div class="caption">

								Lista de Categorías

							</div>

							<div class="actions">

								<a href="categories-replicate.php" class="btn default blue-stripe"> 

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Replicar categorías</span>

								</a>

							

							</div>

						</div>
                        
                        </div>
  

<?php $query = "select * from categories where parentcat = '$_GET[id]'"; 
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
?>
					
								  <li role="treeitem" aria-expanded="true" id="j1_1" class="jstree-node  jstree-open" aria-selected="false"><i class="jstree-icon jstree-ocl"></i><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom"></i>
										<?php echo $row['name']; if($row['account'] != '') echo ' | '.$row['account']; ?> <a href='categories-edit2.php?id=<?php echo $row['id']; ?>' style="color: blue;">[Editar]</a> <a href='javascript:deleteCat(<?php echo $row['id']; ?>);' style="color: red;">[Eliminar]</a>  
										<?php $queryscat = "select * from categories where parentcat = '$row[id]'";
								$resultscat = mysqli_query($con, $queryscat);
								$numscat = mysqli_num_rows($resultscat);
								if($numscat > 0){ 
								?>
										<ul role="group" class="jstree-children">
                                        
                                        <?php while($rowscat=mysqli_fetch_array($resultscat)){ ?>
										
                                        <li role="treeitem" data-jstree="{ &quot;selected&quot; : true }" id="j1_2" class="jstree-node  jstree-leaf" aria-selected="false"><i class="jstree-icon jstree-ocl"></i><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom"></i>
										<?php echo $rowscat['name'];  if($rowscat['account'] != '') echo ' | '.$rowscat['account']; ?> <a href='categories-edit2.php?id=<?php echo $rowscat['id']; ?>' style="color: blue;">[Editar]</a> <a href='javascript:deleteCat(<?php echo $rowscat['id']; ?>);' style="color: red;">[Eliminar]</a>
                                        
                                        <?php $queryscat2 = "select * from categories where parentcat = '$rowscat[id]'";
								$resultscat2 = mysqli_query($con, $queryscat2);
								$numscat2 = mysqli_num_rows($resultscat2);
								if($numscat2 > 0){ 
										?>
                                        <ul>
                                        <?php while($rowscat2=mysqli_fetch_array($resultscat2)){ ?>
                                        <li role="treeitem" data-jstree="{ &quot;selected&quot; : true }" id="j1_2" class="jstree-node  jstree-leaf" aria-selected="false"><i class="jstree-icon jstree-ocl"></i><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom"></i><?php echo $rowscat2['name']; if($rowscat2['account'] != '') echo ' | '.$rowscat2['account']; ?> <a href='categories-edit2.php?id=<?php echo $rowscat2['id']; ?>' style="color: blue;">[Editar]</a> <a href='javascript:deleteCat(<?php echo $rowscat2['id']; ?>);' style="color: red;">[Eliminar]</a></li>
                                        <?php } ?>
                                        </ul>
                                        <?php } ?>
                                        
                                        </li> <?php } ?></ul></li>
                                        <?php } ?>
                               
                                <?php } ?> 
                               
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


</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>