<?php include("session-admin.php"); 
 
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

<?php include("head.php"); ?>

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

		

		

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Retenciones Alcaldía <small>Talonarios</small></h3>

					<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="routes.php">Opciones</a> <i class="fa fa-angle-right"></i></li>

                        <li><a href="retentions-home.php">Retenciones</a> <i class="fa fa-angle-right"></i></li>
                        <li><a href="halls-retention.php">Talonarios</a> <i class="fa fa-angle-right"></i></li>
                        <li><a href="#">Notificaciones</a></li>

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

										<form action="halls-retention-notifications-add.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 
                                        

										  <div class="form-body">

											<h3 class="form-section">Agregar usuario</h3>

												<div class="row">
					
                    <div class="col-md-8">

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
                                                   
                                                        <div class="col-md-3">
														<div class="form-group">
															<label class="control-label">Compañía:</label>
															<select class="form-control" name="company" id="company">
																<option value="">Seleccionar</option>
<?php $querytype = "select * from companies order by name";
$resulttype = mysqli_query($con, $querytype);
while($rowtype=mysqli_fetch_array($resulttype)){
?>																<option value="<?php echo $rowtype['id']; ?>"><?php echo $rowtype['name']; ?></option>
<?php } ?>															</select>
															
</div>
</div>
                                                    								<div class="col-md-12 ">
													                                       
                      
                                   
                                                        <div class="form-actions right">
                                                          
                                                          <button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar</button>
                                                          
       <input name="referer" type="hidden" id="referer" value="routes-global.php">
       <input name="id" type="hidden" id="id" value="<?php echo $row['id']; ?>">
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
                        
                       <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						Usuarios configurados

							</div>
                            
                            
                            

						</div>

						

					</div>
                        
                        
                        <div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <?php ///// table ?>
                         	<div class="tab-pane" id="tab_1">
<div class="row"><!--/span-->


													<div class="col-md-12">
                           
        

        
 	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									

									<th width="50%">

										 Usuario</th>
                                         
                                         
                                         <th width="30%">

										 Compañía</th>


                                        

									<th width="20%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>

                                <?php 
                                    
                                    
                                    $query = "select * from hallsbooknotifications order by id desc";
                                    $result = mysqli_query($con, $query);
                                    while($row=mysqli_fetch_array($result)){
	
	                                   $rowUser = mysqli_fetch_array(mysqli_query($con, "select first, last from workers where code = '$row[userid]'"));
                                       $rowCompany = mysqli_fetch_array(mysqli_query($con, "select name from companies where id = '$row[company]'"));

                                    ?>

								
                                <tr role="row" class="odd">
                                 <td><?php echo $rowUser["first"]." ".$rowUser['last']; ?></td>
                                  <td><?php echo $rowCompany["name"]; ?></td>
                                  <td>
                                    &nbsp; <a href="javascript:deleteThis(<?php echo $row['id']; ?>);"><span class="label label-danger">
									<i class="fa fa-trash-o"></i>  Eliminar </span></a>
                                   
                                  </td></tr>
                                
                                
                                
                                
                                
                                
                                <?php } //while ?>
                                </tbody>

								</table>
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="tc.php?page=<?php echo $previous; ?>">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i .'</a></li>';  
		}else{
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
		  echo '<li><a href="tc.php?page='.$i .'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="tc.php?page=<?php echo $next; ?>);">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                      

</div></div>

</div>


							

			<script>
				function deleteThis(id){
		if (confirm("Usted desea eliminar esta notificacion?\n- Si usted no desea eliminar presione cancelar.")==true){
			window.location="halls-retention-notifications-delete.php?id="+id; 	
	} 
}
			</script>				

							

					<?php //table } ?>		

							

							

					

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