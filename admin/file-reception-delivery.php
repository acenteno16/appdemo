<?php include("session-reception.php");

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

					Remisiones <small>Entrega de remisiones</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="file-reception.php">Remisiones</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                             

						<li>

							<a href="#"> Entrega de remisiones</a>

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

								
								<?php ?>
                                    <div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

										

										</div>

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="file-reception-delivery-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">

											<div class="form-body">

												<h3 class="form-section">Entrega de remisiones</h3>
                                                

												<div class="row"><!--/span-->

<div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

						
											<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar..." onChange="setFocus();">

												<option value=""></option>
<?php $queryroute = "select * from routes where type = '11'";
$resultroute = mysqli_query($con, $queryroute);
while($rowroute=mysqli_fetch_array($resultroute)){
	
	$queryworkers = "select * from workers where code = '$rowroute[worker]'";
	$resultworkers = mysqli_query($con, $queryworkers);
	$rowworkers=mysqli_fetch_array($resultworkers);
?>
												<option value="<?php echo $rowworkers['code']; ?>"><?php echo $rowworkers['code']." | ".$rowworkers['first']." ".$rowworkers['last']; ?></option>
                                                <?php } ?>

												

											</select>

															<div title="Page 5">
															  <div>
															    <div>
															     <span class="help-block">

															 Ingrese código, nombre o parte de el para filtar los resultados.</span>
														        </div>
														      </div>
													    </div>
													  </div>

													</div>												  
                                                    <div class="col-md-6 ">
													  <div class="form-group">
														<label>ID de la remisión:</label> 
                                                        <input name="id" type="text" class="form-control" id="id" value="" <?php /*onChange="javascript:this.form.submit;"*/ ?>> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
												  </div>
                                                  
                                                  

													<!--/span-->

											  </div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

										  <!--/row--><!--/row--></div>


											<div class="form-actions right">

												<button type="button" class="btn default" onClick="javascript:cancelAction();">Cancelar</button>

												<button type="submit" class="btn blue"><i class="fa fa-share-square-o"></i> Entregar</button>

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div>
            
             		<br>
<br>
<br>
<div class="row">
				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">Remisiones entregadas</div>
<div class="actions">

								<a href="file-reception-delivery-records.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Ver historial</span>

								</a>

							

							</div>
							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							<?php 
								
								
								$query = "select * from packagestimes where stage = '3' order by id desc limit 25";
								$result = mysqli_query($con, $query); 
								$num = mysqli_num_rows($result);
								if($num > 0){
								?>

								                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 ID</th>

									<th width="10%">

										 Fecha</th>

									<th width="10%">

										 Hora</th>

									<th width="15%">

										 Estado

									</th>

									<th width="20%">

										Entregado por</th>
                                         	<th width="20%">

										 Entregado a</th>

								</tr>

								</thead>

								<tbody>
                                                                
                                <?php while($rowtime=mysqli_fetch_array($result)){
									
									
									$row = mysqli_fetch_array(mysqli_query($con, "select * from packages where id = '$rowtime[package]'"));
									$rowuser1 = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$rowtime[userid]'"));
									$rowuser2 = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[worker]'"));
						
						$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from packagesstages where id = '$rowtime[stage]'"));
								?>
                                <tr role="row" class="odd">
                                <td class="sorting_1"><?php echo $row['id']; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($rowtime['today'])); ?> </td>
                                <td><?php echo date('h:i:s a', strtotime($rowtime['now'])); ?></td>
                                <td><button type="button" class="btn blue"><?php echo $rowstage['name']; ?></button> 
									</td>
                                    <td><?php echo $rowuser1['first'].' '.$rowuser1['last']; ?> </td>
                                    <td><?php echo $rowuser2['first'].' '.$rowuser2['last']; ?> </td>
                                    </tr>
                                    <?php } ?>
                                    
                                                                </tbody>

								</table>
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay remisiones entregadas.

						</p>

					</div>
                                <?php } ?>

							</div>

						</div>

					</div>

					<!-- End: life time stats -->

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

function setFocus(){
	
	document.getElementById("id").focus();
	
}

function validateForm(){
	var worker = document.getElementById("worker").value;
	if(worker == 0){
		alert('Usted debe de seleccionar el trabajdor que esta recibiendo el documento.');
		return false;
		}
		var id = document.getElementById("id").value;
	if(id == ""){
		alert('Usted debe de ingresar el ID de la remision.');
		return false;
		}
}
</script>

    

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>