<?php include("session-globaltimes-report.php"); ?> 
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

					Reportes <?php  //<small>Ordenes de pago</small> ?> 
					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

				
                        <li>
							<a href="#">Reportes</a>
						
						</li>
                        
                       
                       

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			
           
            <div class="row">

				<div class="col-md-12">
					<form id="ungrouped" name="ungrouped" action="reportsCode.php" enctype="multipart/form-data" method="post">
						<div class="note note-regular">
							<div class="row">
                             <h4 style="margin-left:15px;">Filtro:</h4><br>
									
									<div class="col-md-3" >
										<label class="control-label">Rango de Fechas:</label>
										<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
											<input type="text" class="form-control" name="from" placeholder="desde" value="<? echo $_GET['from']; ?>" readonly> 
											<span class="input-group-addon">
											<i class="fa fa-angle-double-right"></i></span>
											<input type="text" class="form-control" name="to" placeholder="hasta"  value="<? echo $_GET['to']; ?>" readonly>
										</div>
									</div>
								<? /*<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Compañía:</label>
											<select name="company" class="form-control  select2me" id="company" data-placeholder="Seleccionar...">
												<option value="">Todas las compañias</option>
												<?php $querycompany = "select * from companies order by id";
												$resultcompany = mysqli_query($con, $querycompany);
												while($rowcompany = mysqli_fetch_array($resultcompany)){ ?>
												<option value="<?php echo $rowcompany["id"]; ?>" <? if($_GET['company'] == $rowcompany['id'])echo 'selected'; ?>><?php echo $rowcompany["name"]; ?></option>
                                            	<?php } ?>
											</select>
										</div>
									</div>
								
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Ruta:</label>
											<select name="route" class="form-control  select2me" id="route" data-placeholder="Seleccionar...">
												<option value="">Todas las rutas</option>
												<?php
												$queryroutes = "select code, code2, name from units order by code";
												$resultroutes = mysqli_query($con, $queryroutes);
												while($rowroutes = mysqli_fetch_array($resultroutes)){ ?>
												<option value="<?php if($rowroutes['code2'] > 0){ echo $rowroutes['code2']; }else{ echo $rowroutes["code"]; } ?>"><?php  echo $rowroutes["code"].' | '.$rowroutes["name"]; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									
                                    
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Proveedor:</label>
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">
												<option value="">Todos los Proveedores</option>
												<?php $queryproviders = "select * from providers order by name";
												$resultproviders = mysqli_query($con, $queryproviders);
												while($rowproviders = mysqli_fetch_array($resultproviders)){ ?>
												<option value="<?php echo $rowproviders["id"]; ?>" <? if($_GET['provider'] == $rowproviders['id']) echo 'selected'; ?> ><?php echo $rowproviders["code"]." | ".$rowproviders["name"]; ?></option>  
                                            	<?php } ?>
											</select>
										</div>
									</div>
									
									<div class="col-md-3 ">
										<div class="form-group">
											<label>No. de Solicitud:</label>
											<input name="request" type="text" class="form-control" id="request" value="<? echo $_GET['request']; ?>">
										</div>
									</div>
								
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Solicitante:</label>
											<select name="requester" class="form-control  select2me" id="requester" data-placeholder="Seleccionar...">
												<option value="">Todos los Colaboradores</option>
												<?php $queryproviders = "select id, code, first, last from workers order by first,last";
												$resultproviders = mysqli_query($con, $queryproviders);
												while($rowproviders = mysqli_fetch_array($resultproviders)){ ?>
												<option value="<?php echo $rowproviders["code"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
												<?php } ?>
											</select>
										</div>
									</div> 
									
									<? /*<div class="col-md-3 " >
										<div class="form-group">
											<label> No de resultados:</label>
											<select name="pagination" class="form-control" id="pagination">
												<option value="100000" selected>Todas</option>
												<option value="50" <?php if($_GET['pagination'] == 50) echo 'selected'; ?>>50</option>
												<option value="100" <?php if($_GET['pagination'] == 100) echo 'selected'; ?>>100</option>
												<option value="500" <?php if($_GET['pagination'] == 500) echo 'selected'; ?>>500</option>
											</select>
										</div>
									</div>*/ ?>
									
									<? /*<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pago inmediato:</label><br>
											<input type="checkbox" value="1" name="immediate" id="immediate">
										</div> 
									</div>*/ ?>
									
									<?php //Hasta aqui ?>
							</div>
							<div class="row">
								
								<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tipo de reporte:</label>
											<select name="rtype" class="form-control  select2me" id="rtype" data-placeholder="Seleccionar...">
												<option value="">Seleccionar</option>
												<option value="1">Solicitantes por Rango de fechas</option>
												<option value="2">Facturas GCP</option>
                                            	<option value="3">Provisiones GCP</option>
                                                <option value="4">Solicitantes por UN</option>
											</select>
										</div>
									</div>
								
							</div>
							<div class="row">
								<br><br>
								<div class="col-md-4">
									<input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button>  <button type="button" class="btn red" onClick="clearFilter();"> <i class="fa fa-filter"></i> Limpiar filtro</button> 
									<script>
										function clearFilter(){
											window.location = "reports.php";
										}
									</script>
								</div>       
							</div>
						</div>
					</form>
                                
             
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

<?php /*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ ?>

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


<script src="../assets/admin/pages/scripts/components-pickers.js"></script>

<script src="../assets/admin/pages/scripts/table-managed.js"></script>


<script>

jQuery(document).ready(function() {    
 Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar 
ComponentsPickers.init();
TableManaged.init();


        });



</script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>
<script>
function reloadsconcept(nid){		
	$.post("reload-sconcepts.php", { variable: nid }, function(data){ 
	 document.getElementById("concept").innerHTML = data;
	});
	reloadsconcept2(0);
}

function reloadsconcept2(nid){		
	$.post("reload-sconcepts2.php", { variable: nid }, function(data){ 
	 document.getElementById("concept2").innerHTML = data;
	});
	
}

</script>