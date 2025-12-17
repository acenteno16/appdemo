<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('includes.php');
$requiredFiles = ['general'];

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = $con->prepare("select * from accountingCategories where id = ?");
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
<body class="page-header-fixed page-quick-sidebar-over-content ">
<?php include("header.php"); ?>
<div class="clearfix">
</div>
<div class="page-container">

	<!-- BEGIN SIDEBAR -->

	<?php include("side.php"); ?>

	<!-- END SIDEBAR -->

	<!-- BEGIN CONTENT -->

	<div class="page-content-wrapper">

		<div class="page-content">

			<div class="row">

				<div class="col-md-12">

					<h3 class="page-title">

					Categorias <small>Elementos de categorías</small></h3>

					<ul class="page-breadcrumb breadcrumb">

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

				</div>

			</div>

			<div class="row">

				<div class="col-md-12">

					<div class="tabbable tabbable-custom boxless tabbable-reversed">

						

					

							

							<div class="tab-pane" id="tab_1">

								<div class="portlet box blue">

									<div class="portlet-title">

										
									</div>

									<div class="portlet-body form">

						 				<!-- BEGIN FORM-->

										<form action="categories-add-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 

										  <div class="form-body">

												<h3 class="form-section">Agregar a la Categoría</h3>

												<div class="row">
													<div class="col-md-12 ">
													  <div class="form-group">
														<? /*
														<label>Nombre de la Categoría:</label> 
														<input name="cat" type="text" disabled class="form-control" id="cat" value="<?php echo $row['name']; ?>" readonly>
														<br>
                                                        */ ?>
                       
                                   
                                                        <div class="form-group">
                                                          <label>Nombre del Elemento:</label>
                                                          <input name="name" type="text" class="form-control" id="name"> 
                                                        </div>

                                                            <div class="form-group">
                                                              <label class="control-label">Parent:</label>
                                                              <select name="parentcat" class="form-control select2me" id="parentcat"  data-placeholder="Seleccionar...">
                                                                <option value="<?php echo $row['id']; ?>">Principal</option>
                                                                <?php 
																  $query2 = "select * from accountingCategories where level > '0' and level < '3'";
																  $query2 = "select * from accountingCategories where level = '1'";
																  $result2 = mysqli_query($con, $query2);
																  while($row2=mysqli_fetch_array($result2)){ 
?>
                                                                <option value="<?php echo $row2['id']; ?>">├<?php echo $row2['id'].') '.strtoupper($row2['name']); ?></option>
                                                                <?php 
																  $query2s = "select * from accountingCategories where parent = '$row2[id]'";
																  $result2s = mysqli_query($con, $query2s);
																  while($row2s=mysqli_fetch_array($result2s)){ ?>
																  <option value="<?php echo $row2s['id']; ?>"><?php echo '│  ├ '.$row2s['id'].') '.ucfirst($row2s['name']); ?></option>
																  <? } } ?>
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
								<a href="categories-duplicate.php" class="btn default blue-stripe"> 
									<i class="fa fa-list"></i> <span class="hidden-480">Duplicar</span>
								</a>
								<a href="categories-export.php" class="btn default blue-stripe"> 
									<i class="fa fa-file-excel-o"></i> <span class="hidden-480">Exportar</span>
								</a>
							</div>

						</div>
                        
                        </div>
  

<?php $query = "select * from accountingCategories where parent = '0'"; 
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){ 
?>
					
								  <li role="treeitem" aria-expanded="true" id="j1_1" class="jstree-node  jstree-open" aria-selected="false"><i class="jstree-icon jstree-ocl"></i><i class="jstree-icon jstree-themeicon fa fa-folder-open icon-state-warning icon-lg jstree-themeicon-custom"></i>
										<?php echo $row['id'].") ".$row['name']; if($row['account'] != '') echo ' | '.$row['account']; ?> <a href='categories-edit2.php?id=<?php echo $row['id']; ?>' class="active">[Editar]</a> <? /*<a href='javascript:deleteCat(<?php echo $row['id']; ?>);' style="color: red;">[Eliminar]</a> */ ?> 
										<?php $queryscat = "select * from accountingCategories where parent = '$row[id]'";
								$resultscat = mysqli_query($con, $queryscat);
								$numscat = mysqli_num_rows($resultscat);
								if($numscat > 0){ 
								?>
										<ul role="group" class="jstree-children">
                                        
                                        <?php while($rowscat=mysqli_fetch_array($resultscat)){ ?>
										
                                        <li role="treeitem" data-jstree="{ &quot;selected&quot; : true }" id="j1_2" class="jstree-node  jstree-leaf" aria-selected="false"><i class="jstree-icon jstree-ocl"></i><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom"></i>
										<?php echo $rowscat['id'].') '.$rowscat['name'];  if($rowscat['account'] != '') echo ' | '.$rowscat['account']; ?> <a href='categories-edit2.php?id=<?php echo $rowscat['id']; ?>' class="active">[Editar]</a> <? /*<a href='javascript:deleteCat(<?php echo $rowscat['id']; ?>);' style="color: red;">[Eliminar]</a>*/ ?>
                                        
                                        <?php $queryscat2 = "select * from accountingCategories where parent = '$rowscat[id]'";
								$resultscat2 = mysqli_query($con, $queryscat2);
								$numscat2 = mysqli_num_rows($resultscat2);
								if($numscat2 > 0){ 
										?>
                                        <ul>
                                        <?php while($rowscat2=mysqli_fetch_array($resultscat2)){ ?>
                                        <li role="treeitem" data-jstree="{ &quot;selected&quot; : true }" id="j1_2" class="jstree-node  jstree-leaf" aria-selected="false"><i class="jstree-icon jstree-ocl"></i><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom"></i><?php echo $rowscat2['id'].') '.$rowscat2['name']; if($rowscat2['account'] != '') echo ' | '.$rowscat2['account']; ?> <a href='categories-edit2.php?id=<?php echo $rowscat2['id']; ?>' class="active">[Editar]</a> <? /*<a href='javascript:deleteCat(<?php echo $rowscat2['id']; ?>);' style="color: red;">[Eliminar]</a>*/ ?></li>
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
<?php include("sidebar.php"); ?>
</div>
<?php include("footer.php"); loadJS($requiredFiles, $nonce); ?>
</body>
</html>