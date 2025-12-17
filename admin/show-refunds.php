<?php 

session_start();
if(($_SESSION['refund_report'] == "active") or ($_SESSION['admin'] == 'active')){
	include("../connection.php");
}else{
	session_destroy();
	header("location: ../?err=noRefundReport");  	 
}

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

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

					Reportes <small>Devoluciones</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Reportes</a>

							<i class="fa fa-angle-right"></i>

						</li>
						<li>

							<a href="#">Devoluciones</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
                
               
<form id="ungrouped" name="ungrouped" action="show-refunds-code.php" enctype="multipart/form-data" method="post">
<input name="form" type="hidden" id="form" value="1">
<div class="note note-regular">
<div class="row">
<h4 style="margin-left:15px;">Filtro:</h4><br>

<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Cliente:</label>

						
											<select name="client" class="form-control  select2me" id="client" data-placeholder="Seleccionar..."> 

											<option value="">Todos los Clientes</option>
 											<?php $queryclients = "select id, type, code, first, last, name from clients order by first, last";
											$resultclients = mysqli_query($con, $queryclients);
											
											while($rowclients = mysqli_fetch_array($resultclients)){
											
											$the_client = "";
											
											if($rowclients['type'] == 1){
												$the_client = $rowclients["code"].' | '.$rowclients["first"]." ".$rowclients["last"];
											}else{
												$the_client = $rowclients["code"].' | '.$rowclients['name'];
											}
										
											?>
                                            <option value="<?php echo $rowclients["code"]; ?>"><?php echo $the_client; ?></option> 
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>

<div class="col-md-3"> 
<label class="control-label">Estado de rango:</label>
<select name="stage" class="form-control" id="stage" <? //onChange="fnRange(this.value);" ?>>
<option value="0" selected>Todas</option>  
<option value="1" <?php if($_GET['stage'] == '1') echo 'selected'; ?>>Solicitadas entre</option>
<option value="14" <?php if($_GET['stage'] == '14') echo 'selected'; ?>>Canceladas Entre</option>
</select></div>
                                                  <script>
												  /*function fnRange(stage){
												  
												  	if(stage == 0){
														document.getElementById("from").disabled = true;
														document.getElementById("to").disabled = true;
													}else{
														document.getElementById("from").disabled = false;
														document.getElementById("to").disabled = false;
													}
												  }*/
												  </script>
                                                   
<div class="col-md-3" > 
                                                    <label class="control-label">Rango de Fechas: (Estado)</label>

											<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">

												<input type="text" class="form-control" name="from" id="from" placeholder="desde" <? //if((!$_GET['stage']) or ($_GET['stage'] == 0)) echo 'disabled'; ?>>

												<span class="input-group-addon">

												<i class="fa fa-angle-double-right"></i></span>

												<input type="text" class="form-control" name="to" placeholder="hasta" id="to" <? //if((!$_GET['stage']) or ($_GET['stage'] == 0)) echo 'disabled'; ?> >

											</div>

											<!-- /input-group -->

											
										</div>
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">UN:</label>
                                        <select name="route" class="form-control  select2me" id="route" data-placeholder="Seleccionar...">

												<option value="">Todas las rutas</option>
 <?php 										$queryroutes = "select code, code2, name from units order by code";
											$resultroutes = mysqli_query($con, $queryroutes);
											
											while($rowroutes = mysqli_fetch_array($resultroutes)){ 
										
											?>
                                            <option value="<?php if($rowroutes['code2'] > 0){ echo $rowroutes['code2']; }else{ echo $rowroutes["code"]; } ?>"><?php  echo $rowroutes["code"].' | '.$rowroutes["name"]; ?></option> 
                                            <?php }
											?> 
												

											</select>
                                            	<div title="Page 5"></div>
													  </div>

													</div>

<div class="row"></div>

<div class="col-md-3"> 
<label class="control-label">Compañía:</label>
<select name="company" class="form-control" id="company">
<option value="">Todas las compañías</option>
<?php 

$querycompany = "select * from companies";
$resultcompany = mysqli_query($con, $querycompany);
while($rowcompany=mysqli_fetch_array($resultcompany)){
?>
<option value="<?php echo $rowcompany['id']; ?>" <?php if($_GET['company'] == $rowcompany['id']) echo 'selected'; ?>><?php echo $rowcompany['name']; ?></option>
<?php } ?> 

													  </select>
</div>
													 
<div class="col-md-3"> 
<label class="control-label">Estado de solicitud:</label>
<select name="status" class="form-control" id="status">
<option value="0" selected>Todas</option>  

<option value="1" <?php if($_GET['status'] == '1') echo 'selected'; ?>>Canceladas</option>
<option value="2" <?php if($_GET['status'] == '2') echo 'selected'; ?>>Pendientes</option>


													  </select>
</div>

													 
</div>                     
<div class="row">
</div>
<div class="row">

<br><br>
						<div class="col-md-2">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-search"></i> Consultar</button> 
												
                 </div> <div class="col-md-2">							

						    
						<button type="button" class="btn blue" onClick="goBack();"><i class="fa fa-repeat"></i> Regresar</button>
                           
							<script>
							function goBack(){
								window.location = "show-refunds.php";
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
