<?php include("sessions.php"); 

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

		

		

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Rutas</h3>

					<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="routes.php">Rutas</a> <i class="fa fa-angle-right"></i></li>
                            
                            <li>

							<a href="#">Unidade de Negocio</a> <i class="fa fa-angle-right"></i></li>

						<li>Jefaturas</li>

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">

					<div class="tabbable tabbable-custom boxless tabbable-reversed">

						

					<div class="note note-regular">
									<p>
							<?php $queryunit = "select * from units where code = '$_GET[unit]'";
							$resultunit = mysqli_query($con, $queryunit);
							$rowunit = mysqli_fetch_array($resultunit);
							?>
                            <strong>Unidad de Negocio:</strong>	<?php echo $rowunit['name']; ?>	</p>
									 
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

										<form action="routes-headship-add-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers" onSubmit="return validateForm();"> 
                                        <input name="unit" type="hidden" id="unit" value="<?php echo $_GET['unit']; ?>">

										  <div class="form-body">

											<h3 class="form-section">Agregar Jefatura</h3>

												<div class="row">
					
                   
                                                    <div class="col-md-12">
														<div class="form-group">
															<label class="control-label">Nombre de la Jefatura:</label>

<input name="name" type="text" class="form-control" id="name" value="">															
															
</div>
</div>
                                                    								<div class="col-md-12 ">
													                                       
                      
                                   
                                                        <div class="form-actions right">
                                                          
                                                          <button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar</button>
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
					</div>
<div class="portlet-body form">
                                     <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						Jefaturas

							</div>

						</div>

						

					</div>
                                       <div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <?php ///// table ?>
                    <div class="tab-pane" id="tab_1">
<div class="row"><!--/span-->


													<div class="col-md-12">
                           
        
        <?php //start
		
$unit = $_GET['unit'];						
$query = "select * from headship where unit = '$unit'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
if($num > 0){
	
	?>
 	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="3%">

										 ID</th>

									<th width="62%">

										 Nombre</th>

									<th width="26%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>

                                <?php while($row=mysqli_fetch_array($result)){
?>

								
								
                                <tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>">
                                  <td class="sorting_1"><?php echo $row["id"]; ?></td><td><?php echo $row["name"]; ?></td>
                                  <td><a href="routes-headship-view-detail.php?id=<?php echo $row['id']; ?>">

									 <span class="label label-primary">
									<i class="fa fa-search"> </i>  Ver ruta </span></a>
                                    
                                    &nbsp; <span class="label label-danger">
									<i class="fa fa-trash-o"></i>  Eliminar </span>
                                   
                                  </td></tr>
                                
                                
                                
                                
                                
                                
                                <?php } //while ?>
                                </tbody>

								</table>
                                
                                <?php }  else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna Jefatura agregada a esta Unidad de Negocio.

						</p>

					</div>
                                <?php } ?>
                             
                      

</div></div>

</div>
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


function validateForm(){

var worker = document.getElementById("worker").value;
var type = document.getElementById("type").value;
if(worker == 0){
	alert('Seleccione un trabajador');
	return false;
}
if(type == 0){
	alert('Seleccione un roll');
	return false;
	}	
	
}

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>