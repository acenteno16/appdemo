<?php 

require("session-admin.php");
require('functions.php');	

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

					Usuarios <?php //<small>Solicitud de Pago</small> ?>

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

							<a href="#">Usuarios</a></li>
                           
						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">
                	
                    
                    <div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

										

										</div>

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="horizontal-form" method="get" enctype="multipart/form-data">

											<div class="form-body">

												<h3 class="form-section">Buscar Usuarios</h3>

												<div class="row"><!--/span-->

												  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Código:</label>
                                                        <input name="code" type="text" class="form-control" id="code" value="">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> <div class="col-md-3 ">
													  <div class="form-group">
														<label>Nombre:</label>
                                                        <input name="name" type="text" class="form-control" id="name" value="">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> <div class="col-md-3 ">
													  <div class="form-group">
														<label>Email:</label>
                                                        <input name="email" type="text" class="form-control" id="email" value="">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-3"><div class="form-group">

														<label class="control-label">Unidad de Negocio</label>
														<select name="unitid" class="form-control select2me" id="unitid" data-placeholder="Seleccionar...">
														  <option value="0" selected>Seleccionar</option>
															<?php 
															$thisUnit = array();
															$queryunit = "select * from units where active = '1'";
															$resultunit = mysqli_query($con, $queryunit);
															while($rowunit=mysqli_fetch_array($resultunit)){ 
																$thisUnit[$rowunit['id']] = $rowunit['newCode'].' | '.$rowunit['companyName'].' '.$rowunit['lineName'].' '.$rowunit['locationName'];
															?>          
															<option value="<?php echo $rowunit['id']; ?>" <?php if($row['unitid'] == $rowunit['id']) echo 'selected'; ?>><?php echo $rowunit['newCode']." | ".$rowunit['companyName'].' '.$rowunit['lineName'].' '.$rowunit['locationName']; ?></option>   
															<?php } ?>
														</select> 
													</div></div>

													<!--/span-->

												</div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

											<!--/row--><!--/row--></div>


											<div class="form-actions right">

<input type="hidden" name="form" id="form" value="1">
												<button type="button" class="btn red" onClick="cleanThis();"><i class="fa fa-times"></i> Eliminar busqueda</button>
                                                <script>
                                                function cleanThis(){
                                                    window.location = "users.php";
                                                }
                                                </script>
                                                <button type="submit" class="btn blue"><i class="fa fa-check"></i> Buscasr</button>

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div><br>
                              
                              
                              <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

							Lista de Administradores
							</div>
							<? /*<div class="actions">

								<a href="import-workers.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Importar Usuarios</span>

								</a>
                                <a href="users-add.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Agregar Usuario</span>

								</a>

								
							</div>*/ ?>

						</div>

						

					</div>
                              
                              <div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <?php ///// table ?>
                         	<div class="tab-pane" id="tab_1">
<div class="row"><!--/span-->


													<div class="col-md-12">
                           
        
        <?php //start?>
 	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="48"> 

										 Código</th>
                                         <th width="78">

										 Nombre</th>

									<th width="40">

										 Email</th>

									<th width="50">Unidad</th>

									<th width="221">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                
                                
                                
                                
                               
                                <? 
								$query = "select * from workers where admin = '1'";
								$result = mysqli_query($con, $query);
								while($row=mysqli_fetch_array($result)){
								?>
                                
                                
                                
                                <tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>">
                                  <td class="sorting_1" width="48"><?php echo $row['code']; ?></td><td><?php echo sanitizedOutput($row["first"])." ".sanitizedOutput($row["last"]); ?></td><td><?php echo sanitizedOutput($row["email"]); ?></td>
                                  <td>
                                 <?php echo sanitizedOutput($thisUnit[$row['unitid']]); ?>
                                 </td>
                                  <td><a href="user-routes.php?id=<?php echo $row['id']; ?>"><span class="label bg-blue"> 

									<i class="fa fa-codepen"></i> Rutas</span></a>
                                    
                                    <a href="users-edit.php?id=<?php echo $row['id']; ?>"><span class="label label-warning">

									<i class="fa fa-edit"></i> Editar</span></a>
                                    <a href="javascript:deleteUser(<?php echo $row['id']; ?>);"><span class="label label-danger">

								  <i class="fa fa-trash-o"></i> Eliminar </span></a>
                                  </td></tr>
                                
                                <? } ?>
                                
        </tbody>

								</table>
                      

</div></div>

</div>

                        
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

							Lista de Usuarios
							</div>

							<div class="actions">

								<? if(($_GET['show'] == 1) or ($_GET['form'] == 1)){ }else{ ?>
                                <a href="?show=1" class="btn default blue-stripe">

								<i class="fa fa-eye"></i>

								<span class="hidden-480">

								Mostrar Usuarios</span>

								</a>
                                <? } ?>
                                <a href="import-workers.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Importar Usuarios</span>

								</a>
                                <a href="users-add.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Agregar Usuario</span>

								</a>

								
							</div>

						</div>

						

					</div>
                    

                    <? if(($_GET['show'] == 1) or ($_GET['form'] == 1)){ ?>              
                                  
					<div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <?php ///// table ?>
                         	<div class="tab-pane" id="tab_1">
<div class="row"><!--/span-->


													<div class="col-md-12">
                           
        
        <?php //start?>
 	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="48"> 

										 Código</th>
                                         <th width="78">

										 Nombre</th>

									<th width="40">

										 Email</th>

									<th width="50">Unidad</th>

									<th width="221">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                
                                
                                
                                
                                
                               

                                <?php 
																		
/*																		
$code = $_GET['code'];
$name = $_GET['name'];
$email = $_GET['email'];
$unit = $_GET['unit'];
						
$sql1 = "";
if($code != ""){
	$sql1 = " and code like '%$code%'";
}
$sql2 = "";
if($name != ""){
	$sql2 = " and (first like '%$name%' or last like '%$name%')";
}
$sql3 = "";
if($email != ""){
	$sql3 = " and email like '%$email%'";
}
$sql4 = "";
if($unit != ""){
	$sql4 = " and unit like '%$unit%'";
}

$sql = $sql1.$sql2.$sql3.$sql4;

$query = "select * from workers where id > 0 ".$sql;
$result = mysqli_query($con, $query);

while($row=mysqli_fetch_array($result)){*/

$code = isset($_GET['code']) ? sanitizeInput($_GET['code'], $con) : '';
$name = isset($_GET['name']) ? sanitizeInput($_GET['name'], $con) : '';
$email = isset($_GET['email']) ? sanitizeInput($_GET['email'], $con) : '';
$unit = isset($_GET['unit']) ? sanitizeInput($_GET['unit'], $con) : '';

$sqlConditions = [];
$sqlParams = [];
$paramTypes = '';

if ($code !== '') {
    $sqlConditions[] = "code LIKE ?";
    $sqlParams[] = "%$code%";
    $paramTypes .= 's';
}
if ($name !== '') {
    $sqlConditions[] = "(first LIKE ? OR last LIKE ?)";
    $sqlParams[] = "%$name%";
    $sqlParams[] = "%$name%";
    $paramTypes .= 'ss';
}
if ($email !== '') {
    $sqlConditions[] = "email LIKE ?";
    $sqlParams[] = "%$email%";
    $paramTypes .= 's';
}
if ($unit !== '') {
    $sqlConditions[] = "unit = ?";
    $sqlParams[] = "%$unit%";
    $paramTypes .= 'i';
}

$sql = implode(' AND ', $sqlConditions);
$query = "SELECT * FROM workers WHERE id > 0" . ($sql ? " AND $sql" : "");
$stmt = $con->prepare($query);
if (!empty($sqlParams)) {
    $stmt->bind_param($paramTypes, ...$sqlParams);
}
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {

?>

								
								
                                <tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>">
                                  <td class="sorting_1" width="48"><?php echo $row['code']; ?></td>
								  <td><?php echo $row["first"]." ".$row["last"]; ?></td>
								  <td><?php echo $row["email"]; ?></td>
                                  <td>
                                 <?php echo $thisUnit[$row['unitid']]; ?>
                                 </td>
                                  <td><a href="user-routes.php?id=<?php echo $row['id']; ?>"><span class="label bg-blue"> 

									<i class="fa fa-codepen"></i> Rutas</span></a>
                                    
                                    <a href="users-edit.php?id=<?php echo $row['id']; ?>"><span class="label label-warning">

									<i class="fa fa-edit"></i> Editar</span></a>
                                    <a href="javascript:deleteUser(<?php echo $row['id']; ?>);"><span class="label label-danger">

								  <i class="fa fa-trash-o"></i> Eliminar </span></a>
                                  </td></tr>
                                
                                
                                
                                
                                
                                
                                <?php } //while ?>
                                </tbody>

								</table>
                      

</div></div>

</div>


							

							

							

					<?php //table } ?>		

							

							

					

					</div>
                                  
                    <? }else{ ?>    
                        
                    <div class="note note-regular">
                                  
                                  NOTA: Para mostrar los Usuarios, debe de pulsar el boton mostrar o aplicar algun filtro.
                                  
                                  </div>              
                                  
                    <? } ?>
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
function deleteUser(id){
		if (confirm("Usted desea eliminar este Usuario\n- Si usted no desea eliminar el Usuario presione cancelar.")==true){
			window.location="users-delete.php?id="+id;
			
		}
	
	}

</script>
<!-- END JAVASCRIPTS --



</body>

<!-- END BODY -->

</html>