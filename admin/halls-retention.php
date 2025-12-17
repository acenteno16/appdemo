<?php 

include("session-admin.php");
	 
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

					Retenciones Alcaldía <small> Talonarios</small></h3>

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

							<a href="retentions-home.php">Retenciones</a> 
                             <i class="fa fa-angle-right"></i>
                                </li>
                           
                             <li>

							<a href="#">Talonarios</a> 
                                </li>
                           
						

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

										<form action="halls-retention-add-code.php" class="horizontal-form" method="post" enctype="multipart/form-data">

											<div class="form-body">

												<h3 class="form-section">Ingresar talonario</h3> 

												<div class="row"><!--/span-->
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Alcaldía:</label>
													<select name="hall" class="form-control" id="hall">
														  <option value="0">Seleccionar</option>
                                                         <?php $queryhalls = "select * from halls order by name asc";
														 $resulthalls = mysqli_query($con, $queryhalls);
														 while($rowhalls=mysqli_fetch_array($resulthalls)){
														 ?>
                                                         <option value="<?php echo $rowhalls['id']; ?>"><?php echo $rowhalls['name']; ?></option>
                                                         <?php } ?>
                                                         													    </select>
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
												  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Serie:</label>
														<input name="serial" type="text" class="form-control" id="serial" value="">
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														<label>Inicio:</label>
                                                        <input name="retention1" type="text" class="form-control" id="retention1" value="" onkeypress="return justNumbers(event);">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fin:</label>
                                                        <input name="retention2" type="text" class="form-control" id="retention2" value="" onkeypress="return justNumbers(event);">
						
                                                          
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


												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar</button>

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div><br>
                                
                	<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						Lista de tipos de talonarios

							</div>
                            
                            <div class="actions">

								<a href="halls-retention-notifications.php" class="btn default blue-stripe">

								<i class="icon-settings"></i>

								<span class="hidden-480">

								Notificaciones</span>

								</a>

								
							</div>
                            

						</div>

						

					</div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <?php ///// table ?>
                         	<div class="tab-pane" id="tab_1">
<div class="row"><!--/span-->


													<div class="col-md-12">
                           
        
        <?php $today = date('Y-m-d'); 
$tampagina = 100;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}


$query = "select * from hallsbook order by id desc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);
                                                        
                                                        
                                                        if($_GET['echo'] == 1){
                                                            echo $query;
                                                        }

$query1 = "select * from hallsbook order by id desc limit ".$inicio.",".$tampagina; 
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;	
		
		
		//start?>
        
 	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="12%">

										 Fecha</th>

									<th width="62%">

										 Alcaldía</th>
                                         
                                         
                                         <th width="2%">

										 Serie</th>

<th width="2%">

										 Inicio</th>
                                         <th width="2%">

										 Fin</th>

									<th width="14%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>

                                <?php while($row=mysqli_fetch_array($result1)){
	
	$rowhalls2 = mysqli_fetch_array(mysqli_query($con, "select * from halls where id = '$row[hall]'"));

?>

								
								
                                <tr role="row" class="odd <? if($row['void'] == 1) echo 'danger'; ?>">
                                  <td class="sorting_1"><?php echo date('d-m-Y',strtotime($row['today'])); ?></td>
                                  
                                  <td><?php echo $rowhalls2["name"]; ?></td>
                                  <td><?php echo $row["serial"]; ?></td>
                                  <td><?php echo $row["start"]; ?></td>
                                  <td><?php echo $row["end"]; ?></td> 
                                  <td><a href="halls-retention-view.php?id=<?php echo $row['id']; ?>"> 

									 <span class="label label-primary">
									<i class="fa fa-search"> </i> Ver </span></a>
                                    
                                    &nbsp; <a href="javascript:deleteHallsRetention(<?php echo $row['id']; ?>);"><span class="label label-danger">
									<i class="fa fa-trash-o"></i>  Eliminar </span></a>
                                      
                                     <? if($row['void'] == 0){ ?> &nbsp; <a href="javascript:voidHallsRetention(<?php echo $row['id']; ?>);"><span class="label label-danger">
									<i class="fa fa-times"></i>  Anular </span></a> <? } ?>
                                   
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
				function deleteHallsRetention(id){
		if (confirm("Usted desea eliminar este talonario?\n- Si usted no desea eliminar presione cancelar.")==true){
			window.location="halls-retention-delete.php?id="+id; 	
	} 
}
                
                function voidHallsRetention(id){
		if (confirm("Usted desea anular este talonario?\n- Si usted no desea anular presione cancelar.")==true){
			window.location="halls-retention-void.php?id="+id; 	
	} 
}
			</script>				

							

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
function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }

</script>
<!-- END JAVASCRIPTS --



</body>

<!-- END BODY -->

</html>