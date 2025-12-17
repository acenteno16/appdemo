<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('includes.php');
$requiredFiles = ['general', 'select2'];

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

					Categorias <small>Editor de Sub Elementos</small></h3>

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
                            	<i class="fa fa-angle-right"></i></li>

						<li>Editor de Sub Elementos

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

										<form action="categories-edit2-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 

										  <div class="form-body">

												<h3 class="form-section">Editor de Sub Elementos</h3>

												<div class="row">
													<div class="col-md-6 ">
													  <div class="form-group">
														<label>Nombre del Sub Elemento:</label> 
														  <input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>">
						
                                                          
                   
                                                      <!--/row--></div>
                                                          <br>
                       

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
													</div> <div class="col-md-4 ">
													  <div class="form-group">
														<label>Nombre A:</label> 
														  <input name="aname" type="text" class="form-control" id="aname" value="<?php echo $row['aname']; ?>">
						
                                                          
                   
                                                      <!--/row--></div>
                                                          <br>
                       

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
													</div> 
                                                    
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Usar en filtro:</label>
														<select name="searchable" class="form-control" id="searchable">
														 
                                                         <option value="0" <?php if($row['searchable'] == 0) echo 'selected'; ?>>No</option>
                                                         <option value="1" <?php if($row['searchable'] == 1) echo 'selected'; ?>>Si</option>
                                                         
													    </select>
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
                                                          
                                                        <div class="row"></div>
													</div>
                                                    
													<? /*
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Tipo de Cuenta:</label>
														<select name="atype" class="form-control" id="atype">
														 
                                                         <option value="0" <?php if($row['atype'] == 0) echo 'selected'; ?>>Resultado</option>
                                                         <option value="1" <?php if($row['atype'] == 1) echo 'selected'; ?>>Balance</option>
                                                         
													    </select>
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
                                                          
                                                        <div class="row"></div>
													</div> 
													*/ ?>
													<div class="col-md-4 ">
													  <div class="form-group">
														<label>Auxiliar/Cobjeto:</label> 
														  <input name="aux" type="text" class="form-control" id="aux" value="<?php echo $row['aux']; ?>">
						
                                                          
                   
                                                      <!--/row--></div>
                                                          <br>
                       

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
													</div>
                                                    <div class="col-md-2">
                                                    <div class="form-group">
                                                    <label>Solicitar fecha</label>
                                                    <select name="askdate" id="askdate" class="form-control">
                                                    <option value="0" <?php if($row['askdate'] == 0) echo 'selected';?>>Si</option>
                                                    <option value="1" <?php if($row['askdate'] == 1) echo 'selected'; ?>>No</option>  
                                                    </select><br></div>
                                                    <div class="row"></div>
                                                    </div>
                                                    
                                                    <div class="col-md-2">
                                                    <div class="form-group">
                                                    <label>Bloquear a usuarios?</label>
                                                    <select name="userblock" id="userblock" class="form-control">
                                                    <option value="0" selected>No</option>
                                                    <option value="1" <?php if($row['userblock'] == 1) echo 'selected'; ?>>Si</option>  
                                                    </select><br></div>
                                                    <div class="row"></div>
                                                    </div>
                                                    <div class="col-md-2">
                                                    <div class="form-group">
                                                    <label>VIP?</label>
                                                    <select name="vip" id="vip" class="form-control">
                                                    <option value="0" selected>No</option>
                                                    <option value="1" <?php if($row['vip'] == 1) echo 'selected'; ?>>Si</option>   
                                                    </select><br></div>
                                                    <div class="row"></div>
                                                    </div>
                                                    
   <div class="col-md-12 ">                                                 <div class="form-actions right">
                                                          
                                                          <button type="submit" class="btn blue"><i class="fa fa-save"></i> Guardar</button>
                                                          <input name="id" type="hidden" id="id" value="<?php echo $row['id']; ?>">
                                                        </div>
                                                    
												</div></div>


										    <!--/row--></div>
										</form>
                                        
                                        

										<!-- END FORM-->
                                        	
									</div>  
                                    
                                    

								</div>

							</div> 
                            
                            
                            <div class="tab-pane" id="tab_1">

								<div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

											<?php //Form Sample ?>

										</div>

										

									</div>

									<div class="portlet-body form">

						 				<!-- BEGIN FORM-->

										
                                        
                                        <form action="categories-edit-code2.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers" onSubmit="return validateForm();"> 
                                        <input name="unit" type="hidden" id="unit" value="<?php echo $_GET['unit']; ?>"> 

										  <div class="form-body">

											<h3 class="form-section">Usuarios autorizados</h3>
                                            
											  <?php
											  $queryusers = "select * from categoriesusers where category = '$row[id]'"; 
											  $resultusers = mysqli_query($con, $queryusers);
											  $numusers = mysqli_num_rows($resultusers);
											  if($numusers > 0){  ?>                                        <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="30%">

										 Nombre</th>

									<th width="25%">

										 Email</th>

									<th width="13%">Agregado</th>

									

									
									<th width="17%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>

                                <?php while($rowusers=mysqli_fetch_array($resultusers)){
												  
										$rowworker = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$rowusers[worker]'"));
								?>

								
								
                                <tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>">
                                  <td class="sorting_1"><?php echo $rowworker["first"]." ".$rowworker["last"]; ?></td><td><?php echo $rowworker["email"]; ?></td>
                                  <td><?php echo $rowusers['today']; ?></td>
                                  
                                    
                                <td>
                                   
                                    <a class="btnDeleteUser" data-id="<?= $rowusers['id']; ?>"><span class="label label-danger">

								  <i class="fa fa-trash-o"></i> Eliminar </span></a>
                                  </td></tr>
                                
                                
                                
                                
                                
                                
                                <?php } //while ?>
                                </tbody>

								</table>
                                
                               
                                
                                <br><br> <?php } ?>

												<div class="row">
					
                    <div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

						
											<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar...">

												<option value=""></option>
<?php $queryworkers = "select * from workers";
$resultworkers = mysqli_query($con, $queryworkers);
while($rowworkers=mysqli_fetch_array($resultworkers)){
?>
												<option value="<?php echo $rowworkers['code']; ?>"><?php echo $rowworkers['code']." | ".$rowworkers['first']." ".$rowworkers['last']; ?></option>
                                                <?php } ?>

												

											</select>

																										  </div>

													</div>
                                                    
                                                    								<div class="col-md-12 ">
													                                       
                      
           <input type="hidden" name="category" id="category" value="<?php echo $_GET['id']; ?>">                        
                                                        <div class="form-actions right">
                                                          
                                                          <button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar</button>
                                                          <p>
                                                            <input name="referer" type="hidden" id="referer" value="routes-by-unit-view.php?unit=<?php echo $_GET['unit']; ?>">
                                                            <input name="unit" type="hidden" id="unit" value="<?php echo $_GET['unit']; ?>">
                                                            <input name="id" type="hidden" id="id" value="<?php echo $row['id']; ?>">
                                                          </p>
                                                     
                                                        </div>
                                                      </div>
													</div>
                                                    
												</div>


										    <!--/row-->
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

	<!-- END CONTENT -->

	<!-- BEGIN QUICK SIDEBAR -->

<?php include("sidebar.php"); ?>
</div>
<?php include("footer.php"); loadJS($requiredFiles, $nonce); ?>
</body>
</html>
<script nonce="<?= $nonce ?>">
	
	function deleteUser(id){
		if (confirm("Usted desea eliminar este Usuario\n- Si usted no desea eliminar el Usuario presione cancelar.")==true){
			window.location="categories-user-delete.php?id="+id;	
		}
	}
	document.querySelectorAll('.btnDeleteUser').forEach(function(el) {
    	el.addEventListener('click', function(e) {
        	e.preventDefault();
        	var id = this.getAttribute('data-id');
        	deleteUser(id);
		});
	});	
	
</script>
    