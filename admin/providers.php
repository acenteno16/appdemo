<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

session_start();

function hasAccess($roles) {
    foreach ($roles as $role) {
        if (isset($_SESSION[$role]) && $_SESSION[$role] === "active") {
            return true;
        }
    }
    return false;
}

$allowedRoles = ["admin", "providers", "providers_report"];

if(hasAccess($allowedRoles)){
    include("../connection.php");
}else{
    session_destroy();
    header("Location: ../?err=noproviders_provider_export");
    exit;
} 

function sanitizeInput($val, $con) {
    if (is_array($val)) {
        foreach ($val as &$value) {
            $value = mysqli_real_escape_string($con, $value);
        }
    } else {
        $val = mysqli_real_escape_string($con, $val);
    }
    return $val;
}

$code = isset($_GET['code']) ? sanitizeInput($_GET['code'], $con) : '';
$name = isset($_GET['name']) ? sanitizeInput($_GET['name'], $con) : '';
$international = isset($_GET['international']) ? $_GET['international'] : '';
$course = isset($_GET['course']) ? sanitizeInput($_GET['course'], $con) : '';
$gcp = isset($_GET['gcp']) ? $_GET['gcp'] : '';
$updated = isset($_GET['updated']) ? $_GET['updated'] : '';
$email = isset($_GET['email']) ? sanitizeInput($_GET['email'], $con) : '';

// Construcción dinámica con prepared statements
$query = "SELECT * FROM providers WHERE id > 0";
$params = [];
$types = '';

// Construir consulta dinámica
if (!empty($code)) {
    $query .= " AND code LIKE ?";
	$ch .= "&code=$code";
    $params[] = "%$code%";
    $types .= 's';
}
if (!empty($name)) {
    $query .= " AND name LIKE ?";
	$ch .= "&name=$name";
    $params[] = "%$name%";
    $types .= 's';
}
if (!empty($international)) {
    $international_val = $international === 'int' ? 1 : 0;
    $query .= " AND international = ?";
	$ch .= "&international=$international";
    $params[] = $international_val;
    $types .= 'i';
}
if (!empty($course)) {
    $query .= " AND course LIKE ?";
	$ch .= "&course=$course";
    $params[] = "%$course%";
    $types .= 's';
}
if (!empty($updated)) {
    $updated_val = $updated === 'yes' ? 1 : 0;
    $query .= " AND updated = ?";
	$ch .= "&updated=$updated";
    $params[] = $updated_val;
    $types .= 'i';
}
if (!empty($email)) {
    $query .= " AND email = ?";
	$ch .= "&email=$email";
    $params[] = $email;
    $types .= 's';
}
if (!empty($gcp)) {
    $gcp_val = $gcp === 'yes' ? 1 : 0;
    $query .= " AND gcp = ?";
	$ch .= "&gcp=$gcp";
    $params[] = $gcp_val;
    $types .= 'i';
}

// Ejecutar la consulta con prepared statements
$query = $con->prepare($query);
if($types){
	$query->bind_param($types, ...$params);
}
$query->execute();
$result = $query->get_result();
$num = $result->num_rows; 

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

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

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


			<!-- BEGIN PAGE HEADER-->		



			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Proveedores <?php //<small>Ordenes de pago</small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Proveedores</a>

							<i class="fa fa-angle-right"></i>

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="note note-regular">
<div class="row">
<div class="col-md-12">

<form id="ungrouped" name="ungrouped" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
<input name="form" type="hidden" id="form" value="1">

							
<h4 style="margin-left:15px;">Filtro:</h4><br>


                                                    
<div class="row"></div> 
<div class="col-md-3 ">
			    <div class="form-group">
				  <label> Código:</label>
                  <input name="code" type="text" class="form-control" id="code" value="<? echo $code; ?>">
                                             
                  

                  <!--/row-->
                    <!--/row-->
                    <!--/row-->
                                                     
                  <!--/row--></div>
			  </div>

<div class="col-md-3 ">
			    <div class="form-group">
				  <label> Nombre:</label>
                  <input name="name" type="text" class="form-control" id="name" value="<? echo $name; ?>">
                                             
                  

                  <!--/row-->
                    <!--/row-->
                    <!--/row-->
                                                     
                  <!--/row--></div>
			  </div>
                                                    
<div class="col-md-3 ">
			    <div class="form-group">
				  <label> Nac/Internac:</label>
                 	 <select name="international" class="form-control" id="international">
                                                          <option value="" selected>Seleccionar</option>
                                                          <option value="nac" <?php if($_GET['international'] == 'nac') echo 'selected'; ?>>Nacional</option>
                                                          <option value="int" <?php if($_GET['international'] == 'int') echo 'selected'; ?>>Internacional</option>  
                                                          
					</select>                            
                  </div>
</div>
    
    <div class="col-md-3 ">
			    <div class="form-group">
				  <label> Grupo Casa Pellas:</label>
                 	 <select name="gcp" class="form-control" id="gcp"> 
                                                          <option value="" selected>Seleccionar</option>
                                                          <option value="yes" <?php if($_GET['gcp'] == 'yes') echo 'selected'; ?>>Si</option>
                                                          <option value="no" <?php if($_GET['gcp'] == 'no') echo 'selected'; ?>>No</option>  
                                                          
					</select>                            
                  </div>
</div>
                            
<div class="col-md-3 ">
<div class="form-group">
<label> Rubro:</label>

                                    
     <input name="course" type="text" class="form-control" id="course" value="<? echo $course; ?>">                                                                   
                                                                                                                                                
</div>
</div>
                            
                            
                            <div class="col-md-3 ">
<div class="form-group">
<label> Email:</label>
                                    
     <input name="email" type="text" class="form-control" id="email" value="<? echo $email; ?>">                                                                   
                                                                                                                                                
</div>
</div>
                            
                            <div class="col-md-3 ">
			    <div class="form-group">
				  <label> Actualizado:</label>
                 	 <select name="updated" class="form-control" id="updated">
                                                          <option value="" selected>Seleccionar</option>
                                                          <option value="yes" <?php if($_GET['updated'] == 'yes') echo 'selected'; ?>>Si</option>
                                                          <option value="no" <?php if($_GET['updated'] == 'no') echo 'selected'; ?>>No</option>  
                                                          
					</select>                            
                  </div>
</div>
                             
<div class="row"></div>
<br>
<div class="col-md-4"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button> 
  <button type="button" class="btn red" onClick="resetFilter();"><i class="fa fa-filter"></i> Quitar Filtro</button>  <script>
                            function resetFilter(){
                            
                            window.location = "providers.php";
							
                            }
                            </script>
												
              </div>                               
 </form>
</div>
</div>
</div>

<div class="row">

				<div class="col-md-12">

					<!-- Begin: life time stats -->
                  
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<i class="fa fa-shopping-cart"></i><? echo $num; ?> Proveedores</div>

							<div class="actions">

								<? /*<a href="import-providers.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Importar Proveedores</span>

								</a>*/ ?>
								
								 <a href="providersDocs.php?id=0" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Tipos de documentos</span>

								</a>

<a href="providers-export.php?form=1<? echo $ch; ?>" class="btn default blue-stripe">

								<i class="fa fa-file-excel-o"></i>

								<span class="hidden-480">

								Exportar excel</span>

								</a>
                                <a href="providers-add.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Agregar Proveedor</span>

								</a>

							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								<div class="table-actions-wrapper">

									<span>

									</span>

								

									<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Procesar</button>

								</div>

								<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="1%">

										 Codigo</th>

									<th width="15%">

										 Nombre</th>

									<th width="10%">

										 RUC

									</th>

									<th width="10%">

										 Vencimiento</th>

									<th width="10%">

										 Última <br>
Actualización</th>

									<th width="10%">

										 Activo

									</th>
										 <th width="10%">

										 Opciones

									</th>

								</tr>

								</thead>

								<tbody>
                               <?
							   
									
									
								while($row=mysqli_fetch_array($result)){
							   ?> 
                                <tr role="row" class="odd <? if($row['active'] == 0) echo "danger"; ?>"><td><?php echo $row['code']; ?></td><td><?php echo $row['name']; ?></td><td><?php echo $row['ruc']; ?></td><td><?php echo $row['term']; ?> día(s)</td>
                                  <td><?php 
								   if($row['updated'] == 0) echo "No";
								   if($row['updated'] == 1) echo "Si"; 
								    ?></td>
									<td><? if($row['active'] == 1) echo "Si"; else echo "No"; ?></td>
								    <td><?php /*<a href="providers-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>*/ ?> <a href="providers-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><?php //<i class="fa fa-search"></i> ?> Editar</a></td></tr><?php } ?>

								</tbody>

								</table>
                              

							</div>

						</div>

					</div>

					<!-- End: life time stats -->

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

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>


<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>



<!-- END PAGE LEVEL SCRIPTS -->

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