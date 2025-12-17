<?php 

include("session-routes.php");
include('functions.php');

#catalog
$thisUserType = array();
$querytype = "select * from usertype";
$resulttype = mysqli_query($con, $querytype);
while($rowtype = mysqli_fetch_array($resulttype)){
	$thisUserType[$rowtype['id']] = $rowtype['name'];
}

$thisRoute = array();
$queryRoute = "select * from units";
$resultRoute = mysqli_query($con, $queryRoute);
while($rowRoute = mysqli_fetch_array($resultRoute)){
	$thisRoute[$rowRoute['id']] = $rowRoute['newCode'].' | '.$rowRoute['companyName'].' '.$rowRoute['lineName'].' '.$rowRoute['locationName'];
}

$thisHeadship = array();
$queryHeadship = "select * from units";
$resultHeadship = mysqli_query($con, $queryHeadship);
while($rowHeadship = mysqli_fetch_array($resultHeadship)){
	$thisHeadship[$rowHeadship['id']] = $rowHeadship['name'];
}

$worker = isset($_GET['worker']) ? sanitizeInput($_GET['worker'], $con) : '';
$type = isset($_GET['type']) ? sanitizeInput($_GET['type'], $con) : ''; 

$sql = '';
if($worker != ''){
	$sql.=" and worker = '$worker'";
}
if($type != ''){
	$sql.=" and type = '$type'";
}

$query = "select * from routes where id > '0'$sql order by type";
$result = mysqli_query($con, $query);

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





<!-- END THEME STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>


<!-- END PAGE LEVEL STYLES -->

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

					Rutas de pago <small>Usuarios</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Opciones</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                            	<li>

							<a href="routes.php">Rutas</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                            <li>

							<a href="#">Usuarios</a></li>
                           
						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">
                	<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

							Agregar Usuarios
							</div>

							<div class="actions">

								<a href="routes-add.php?unit=<?php echo $_GET['unit']; ?>" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Agregar Usuario</span>

								</a>

								
							</div>

						</div>

						

					</div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <div class="note note-regular"> 
						  <div class="portlet-body form">

										<!-- BEGIN FORM-->
							  
							  <? if($_GET['echo'] == 1){
	echo $query;
} ?>

										<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="horizontal-form" method="get" enctype="multipart/form-data">

											<div class="form-body">

												<h3 class="form-section">Filtro: </h3>

												<div class="row"><!--/span-->

												  <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Colaborador: <a href="javascript:loadWorkers('load');" id="workerCharge" >[Cargar Filtro]</a></label>

						
															<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar..." disabled>

																<option value="">Todos los Colaboradores</option>
                                               
															</select>
                                                         
                                                          <script>
                                                          function loadWorkers(value){
                                                              if(value == 'load'){
                                                                  $("#workerCharge").css("display", "none");
                                                                  $("#worker").select2('data', { id:"", text: "Cargando Colaboradores..."});
                                                                  $.post("reloadContent.php", { type: 'workersMenuCode' }, function(data){
                                                                    document.getElementById("worker").innerHTML = data;
                                                                      $("#worker").select2('data', { id:"", text: "Todos los Colaboradores"});
                                                                      $("#worker").prop('disabled', false);
                                                                  }); 
                                                              }
                                                          }
                                                          </script>
                                                          
													  </div>

													</div>
													
													<div class="col-md-3"> 
<label class="control-label">Etapa:</label>
<select name="type" class="form-control" id="type">
<option value="">Todas las etapas</option>
<?php 
$getStage = isset($_GET['type']) ? intval($_GET['type']) : 0;
$querystage = "select id, name from usertype";
$resultstage = mysqli_query($con, $querystage);
while($rowstage=mysqli_fetch_array($resultstage)){
?>
<option value="<?php echo $rowstage['id']; ?>" <?php if($getStage == $rowstage['id']) echo 'selected'; ?>><?php echo $rowstage['name']; ?></option>
<?php } ?> 

													  </select>
</div>
													
													

													<!--/span-->

												</div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

											<!--/row--><!--/row--></div>


											<div class="form-actions left">


												<button type="button" onClick="cleanThis();" class="btn red"><i class="fa fa-trash-o"></i> Limpiar</button>
												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Buscar</button>
												<script>
												function cleanThis(){
													window.location = 'routes-view.php';
												}
												</script>

											</div>

										</form>

										<!-- END FORM-->

									</div>
								
									 
					 </div>
                         	<div class="tab-pane" id="tab_1">
<div class="row"><!--/span-->


													<div class="col-md-12">
                           
        
        <?php //start?>
 	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">


									<th width="3%">ID</th>
									
									<th width="15%">Nombre</th>

									<th width="15%">Email</th>

									<th width="10%">Tipo</th>
									<th width="25%">UN</th>
									<th width="8%">Opciones</th>

								</tr>

								</thead>

								<tbody>

                                	<?php 
									
									
									while($row=mysqli_fetch_array($result)){
										
										$rowworker = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[worker]'"));
									?>

								
								
                                <tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>" id="R-<? echo $row['id']; ?>">
                                  <td class="sorting_1"> <? echo $row['id']; ?> </td>
								  <td><?php echo $rowworker["first"]." ".$rowworker["last"]; ?></td><td><?php echo $rowworker["email"]; ?></td>
                                  <td><?php echo $thisUserType[$row['type']]; ?></td>
									<td><?php echo $thisRoute[$row['unitid']]; 
										if($row['headship'] > 0){
											echo '<br><span style="color:gray;">/'.$thisHeadship[$row['headship']].'</span>';
										}
										?></td> 
									
                                  
                                    
                                <td>
                                    <a href="routes-edit.php?id=<?php echo $row['id']; ?>&unit=<?php echo $_GET['unit']; ?>"><span class="label label-primary">

								  <i class="fa fa-edit"></i> Editar </span></a>    &nbsp;
                                    <a href="javascript:deleteRoute(<?php echo $row['id']; ?>);"><span class="label label-danger">

								  <i class="fa fa-trash-o"></i> Eliminar </span></a>
                                  </td></tr>
                                
                                
                                
                                
                                
                                
                                <?php } //while ?>
                                </tbody>

								</table>
                      

</div></div>

</div>


							

							

							

					<?php //table } ?>		

							

							

					

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

<!-- BEGIN CORE PLUGINS -->

<!--[if lt IE 9]>

<script src="../assets/global/plugins/respond.min.js"></script>

<script src="../assets/global/plugins/excanvas.min.js"></script> 

<![endif]-->

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

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="../assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>

<!-- END PAGE LEVEL PLUGINS -->
<?php ?> 
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/clockface/js/clockface.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<?php ?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/components-dropdowns.js"></script>

<script src="../assets/admin/pages/scripts/components-pickers.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->


<script>
jQuery(document).ready(function() {       
// initiate layout and plugins
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
ComponentsPickers.init();
ComponentsDropdowns.init();
});   
</script>
<script>
function deleteRoute(id){
		if (confirm("Usted desea eliminar este Usuario\n- Si usted no desea eliminar el Usuario presione cancelar.")==true){
			//window.location="routes-delete.php?id="+id;
			 $.post("routes-view-delete.php", { id: id }, function(data){
				 alert(data);
				 $("#R-"+id).css("display", "none"); 
			 });
			
		}
	}
</script>
<!-- END JAVASCRIPTS --
</body>
<!-- END BODY -->
</html>