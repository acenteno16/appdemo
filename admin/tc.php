<?php include("sessions.php");
	 
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

					Tipos de cambio<small></small></h3>

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

							<a href="#">Tipos de cambio</a> 
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

										<form action="tc-add-code.php" class="horizontal-form" method="post" enctype="multipart/form-data">

											<div class="form-body">

												<h3 class="form-section">Ingresar tipo de cambio</h3>

												<div class="row"><!--/span-->
													
													 <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Tipo de ingreso:</label>
														  
														   <select name="submitType" class="form-control" id="submitType" onChange="sType(this.value);">
                                                                 
															   <option value="0">Por fecha</option>
															   <option value="1">Por rango de fecha</option>

															</select>
															<script>
														  function sType(val){
															  if(val == 0){
																  document.getElementById('theDate').style.display = 'block';
																  document.getElementById('theRange').style.display = 'none';
															  }else if(val == 1){
																   document.getElementById('theDate').style.display = 'none';
																  document.getElementById('theRange').style.display = 'block';
															  }
														  }
														  </script>

													  </div>

													</div>
													
													
													
													<div class="row"></div>

												  <div class="col-md-3 " style="" id="theDate">
													  <div class="form-group">
														<label>Fecha:</label>
                                                        <input name="today" type="text" class="form-control form-control-inline date-picker" id="schedule[]" value="">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 
													
													<div class="col-md-3" style="display: none;" id="theRange"> 
                                                    <label class="control-label">Rango de Fechas:</label>

											<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">

												<input type="text" class="form-control" name="from" placeholder="desde">

												<span class="input-group-addon">

												<i class="fa fa-angle-double-right"></i></span>

												<input type="text" class="form-control" name="to" placeholder="hasta" >

											</div>

											<!-- /input-group -->

											
										</div>
													
													
													<div class="col-md-3 ">
													  <div class="form-group">
														<label>TC:</label>
                                                        <input name="tc" type="text" class="form-control" id="tc" value="" onkeypress="return justNumbers(event);">
						
                                                          
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

						Lista de tipos de cambio

							</div>
                            <div class="actions">

								<a href="tc-import.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Importar Excel</span>

								</a>

								                                
                                

							</div>

						</div>

						

					</div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <?php ///// table ?>
                         	<div class="tab-pane" id="tab_1">
<div class="row"><!--/span-->


													<div class="col-md-12">
                           
<?php 

$today = date('Y-m-d'); 



if(isset($_GET['filemonth'])){
	$month = $_GET['filemonth'];
}else{
	$month = date('m');
}
if(isset($_GET['fileyear'])){
	$year = $_GET['fileyear'];
}else{
	$year = date('Y');
}

$firstdate = $year.'-'.$month.'-1';
$lastdate = $year.'-'.$month.'-31';
 
$query = "select * from tc where today >= '$firstdate' and today <= '$lastdate' order by today desc"; 
$result = mysqli_query($con, $query);



		
		//start?>
        
      <div class="row"><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" enctype="multipart/form-data">  
      
      
      <div class="col-md-2">

													  <div class="form-group">

														<label class="control-label">Mes:</label>

															
													  </div>

													</div>
                                                    
                                                    <div class="col-md-2">

													  <div class="form-group">

														<label class="control-label">Año:</label>

															

													  </div>

													</div>
                                                    
                                 
                                                    
                                                    <div class="row"></div>
                                                       <div class="col-md-2">

													  <div class="form-group">

							

															<select name="filemonth" class="form-control" id="filemonth" onChange="this.form.submit();">
                                                            
                                                            <?php
															
															$tm = date('m');
															
															?>

<option value="1" <?php if($_GET['filemonth'] == 1) echo 'selected'; if((!isset($_GET['filemonth'])) and ($tm == 1)) echo "selected"; ?>>Enero</option>
<option value="2" <?php if($_GET['filemonth'] == 2) echo 'selected'; if((!isset($_GET['filemonth'])) and ($tm == 2)) echo "selected"; ?>>Febrero</option>
<option value="3" <?php if($_GET['filemonth'] == 3) echo 'selected';  if((!isset($_GET['filemonth'])) and ($tm == 3)) echo "selected";?>>Marzo</option>
<option value="4" <?php if($_GET['filemonth'] == 4) echo 'selected'; if((!isset($_GET['filemonth'])) and ($tm == 4)) echo "selected"; ?>>Abril</option>
<option value="5" <?php if($_GET['filemonth'] == 5) echo 'selected'; if((!isset($_GET['filemonth'])) and ($tm == 5)) echo "selected"; ?>>Mayo</option>
<option value="6" <?php if($_GET['filemonth'] == 6) echo 'selected';  if((!isset($_GET['filemonth'])) and ($tm == 6)) echo "selected";?>>Junio</option>
<option value="7" <?php if($_GET['filemonth'] == 7) echo 'selected'; if((!isset($_GET['filemonth'])) and ($tm == 7)) echo "selected"; ?>>Julio</option>
<option value="8" <?php if($_GET['filemonth'] == 8) echo 'selected'; if((!isset($_GET['filemonth'])) and ($tm == 8)) echo "selected"; ?>>Agosto</option>
<option value="9" <?php if($_GET['filemonth'] == 9) echo 'selected'; if((!isset($_GET['filemonth'])) and ($tm == 9)) echo "selected"; ?>>Septiembre</option>
<option value="10" <?php if($_GET['filemonth'] == 10) echo 'selected'; if((!isset($_GET['filemonth'])) and ($tm == 10)) echo "selected"; ?>>Octubre</option>
<option value="11" <?php if($_GET['filemonth'] == 11) echo 'selected'; if((!isset($_GET['filemonth'])) and ($tm == 11)) echo "selected"; ?>>Noviembre</option>
<option value="12" <?php if($_GET['filemonth'] == 12) echo 'selected'; if((!isset($_GET['filemonth'])) and ($tm == 12)) echo "selected"; ?>>Diciembre</option>

															</select>
                                                            
                                                            <?php /*
															<select name="filemonth" class="form-control" id="filemonth">
                                                            
                                                            <?php
															
															$myfilemonth = date('m');
															
															?>

<option value="1" <?php if($_GET['filemonth'] == 1) echo 'selected'; if(($_GET['filemonth'] != 1) and ($myfilemonth == 1)) echo 'selected'; ?>>Enero</option>
<option value="2" <?php if($_GET['filemonth'] == 2) echo 'selected'; if(($_GET['filemonth'] != 2) and ($myfilemonth == 2)) echo 'selected'; ?>>Febrero</option>
<option value="3" <?php if($_GET['filemonth'] == 3) echo 'selected'; if(($_GET['filemonth'] != 3) and ($myfilemonth == 3)) echo 'selected'; ?>>Marzo</option>
<option value="4" <?php if($_GET['filemonth'] == 4) echo 'selected'; if(($_GET['filemonth'] != 4) and ($myfilemonth == 4)) echo 'selected'; ?>>Abril</option>
<option value="5" <?php if($_GET['filemonth'] == 5) echo 'selected'; if(($_GET['filemonth'] != 5) and ($myfilemonth == 5)) echo 'selected'; ?>>Mayo</option>
<option value="6" <?php if($_GET['filemonth'] == 6) echo 'selected'; if(($_GET['filemonth'] != 6) and ($myfilemonth == 6)) echo 'selected'; ?>>Junio</option>
<option value="7" <?php if($_GET['filemonth'] == 7) echo 'selected'; if(($_GET['filemonth'] != 7) and ($myfilemonth == 7)) echo 'selected'; ?>>Julio</option>
<option value="8" <?php if($_GET['filemonth'] == 8) echo 'selected'; if(($_GET['filemonth'] != 8) and ($myfilemonth == 8)) echo 'selected'; ?>>Agosto</option>
<option value="9" <?php if($_GET['filemonth'] == 9) echo 'selected'; if(($_GET['filemonth'] != 9) and ($myfilemonth == 9)) echo 'selected'; ?>>Septiembre</option>
<option value="10" <?php if($_GET['filemonth'] == 10) echo 'selected'; if(($_GET['filemonth'] != 10) and ($myfilemonth == 10)) echo 'selected'; ?>>Octubre</option>
<option value="11" <?php if($_GET['filemonth'] == 11) echo 'selected'; if(($_GET['filemonth'] != 11) and ($myfilemonth == 11)) echo 'selected'; ?>>Noviembre</option>
<option value="12" <?php if($_GET['filemonth'] == 12) echo 'selected'; if(($_GET['filemonth'] != 12) and ($myfilemonth == 12)) echo 'selected'; ?>>Diciembre</option>

															</select>
															*/ ?>

													  </div>

													</div>
                                                    
                                                    <div class="col-md-2">

													  <div class="form-group">

										
															<?php $thisyear = date('Y'); ?>
                                       
                                                            
                                                                                             <select name="fileyear" class="form-control" id="fileyear" onChange="this.form.submit();">
                                                                                              <?php $firstyear = $thisyear-1; 
															$lastyear = $firstyear+10;
	for($i=$firstyear;$i<=$lastyear;$i++){ 
	
	?>
                          
<option value="<?php echo $i; ?>" <?php if($_GET['fileyear'] == $i){ echo 'selected';  $cancell = 1; } elseif(($thisyear == $i) and ($cancell!= 1)) echo 'selected'; ?>><?php echo $i; ?></option>

<?php } ?> 


															</select>

													  </div>

													</div>
                                                    
                                                    <div class="col-md-2">
                                                   <input type="submit" name="enviar" value="Filtrar"></div>
                                                    
                                                    </form>
        </div>
 	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="12%">

										 Fecha</th>

									<th width="62%">

										 TC</th>

									<th width="26%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>

                                <?php 
								
								while($row=mysqli_fetch_array($result)){
									
								?>

								
								
                                <tr role="row" class="odd">
                                  <td class="sorting_1"><?php echo $row["today"]; ?></td><td><?php echo $row["tc"]; ?></td>
                                  <td><a href="tc-view.php?id=<?php echo $row['id']; ?>">

									 <span class="label label-primary">
									<i class="fa fa-search"> </i> Ver </span></a> 
                                    
                                    &nbsp; <a href="javascript:deleteUnit(<?php echo $row['id']; ?>);"><span class="label label-danger">
									<i class="fa fa-trash-o"></i>  Eliminar </span></a>
                                   
                                  </td></tr>
                                
                                
                                
                                
                                
                                
                                <?php } //while ?>
                                </tbody>

								</table>
                                
                                
                                <? //START CLEANER ?>
                                
                                  <input type="button" name="enviar" value="Eliminar" onClick="deleteMonth();"> 
                                  <script> 
								  function deleteMonth(){
									  
									  var sMonth = document.getElementById('filemonth').value;
									  var sYear = document.getElementById('fileyear').value;
									  
		if (confirm("Usted desea eliminar los tipos de cambios del mes "+sMonth+" y año "+sYear+"\n- Si usted no desea eliminar presione cancelar.")==true){
			window.location="tc-delete-selector.php?month="+sMonth+"&year="+sYear;	 
	} 
}  
								  </script>
                                
                                <? //END ?>
                                
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