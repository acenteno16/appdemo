<?php 

include("session-admin.php");

$id = $_GET['id']; 

$query = "select * from halls where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<script src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

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

					Sucursales <?php /*<small>+Agregar Plantillas</small>*/ ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						

					  <li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="halls.php">Sucursales</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							Editor de Alcaldías

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

								<div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

											<?php //Form Sample ?>

									  </div>

										

									</div>

									<div class="portlet-body form"> 

										<!-- BEGIN FORM-->

										<form action="halls-edit-code.php" method="post" enctype="multipart/form-data" class="horizontal-form">  

											<div class="form-body">

												<h3 class="form-section">Informacion de la Sucursal</h3>

												<div class="row">

													

													<!--/span-->

													<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Nombre de la sucursal:</label> 
	<select name="company" class="form-control" id="company"  style="width:300px;">
	  <option value="0" selected>Seleccionar</option>
	  <? 
$querycompany = "select * from companies";
$resultcompany = mysqli_query($con, $querycompany);
while($rowcompany=mysqli_fetch_array($resultcompany)){
?>
	  <option value="<? echo $rowcompany['id']; ?>" <? if($row['company'] == $rowcompany['id']) echo "selected"; ?>><? echo $rowcompany['name']; ?></option>
	  <? } ?>
	  </select>
	<input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>">
													  </div>


  
                                                      
                                                      </div>

												

													
                                                  

													<!--/span-->

												</div>
                                                
                                               <div class="row">

													

													<!--/span-->

													<div style="display: none;"><div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Unidades de Negocio:</label> 
  
                                            
                                 <?php 
								 
								 $queryroutes = "select * from units where code > '0' order by code";
$resultroutes = mysqli_query($con, $queryroutes);
$numroutes = mysqli_num_rows($resultroutes);
if($numroutes > 0){
	

?>
	 


  <script type="application/javascript">
  
  function reloadHeadship(id){
	
   $.post("reload-headships.php", { variable: id }, function(data){
	
  alert(id+" data: "+data); 
  document.getElementById('headship').innerHTML = data;
   
}); 
} 
  </script> 

										

															<select name="theroute" class="form-control" id="theroute" onchange="javascript:reloadHeadship(this.value)" style="width:300px;"> 
                                                  
<option value="0" selected>Seleccionar</option> 
<?php while($rowroutes=mysqli_fetch_array($resultroutes)){ ?>
<option value="<?php if($rowroutes['code2'] > 0){ $thecode = $rowroutes['code2']; } else{ $thecode = $rowroutes['code']; } echo $thecode; ?>" <?php if($thecode == $row['route']) echo 'selected'; ?>><?php echo $rowroutes['code']." | ".$rowroutes['name']; ?></option> 
<?php } ?>
															</select>

	
<br>

											

															<select name="headship" class="form-control" id="headship" style="width:300px;"> 
                                                  
<?php if($row['route'] > 0){ 
$queryheadship = "select * from headship where id = '$row[headship]'";
$resultheadship = mysqli_query($con, $queryheadship);
$rowheadship = mysqli_fetch_array($resultheadship);
?>
<option value="<?php echo $rowheadship['id']; ?>"><?php if($rowheadship['name'] != ''){ echo $rowheadship['name']; }else{ echo 'Primaria'; }?></option>
<?php } ?>
<option value="0">Seleccionar Ruta</option>

															</select>

													 
                                             
                                                    
                                                    

   
                                                
                                                    
                                                 
                                                    
                                                 
                                                 
  
                                                    
                                                
<?php } ?> 
                                 
                                                
                                                
                                                </div></div></div>
                                                
                                                </div>
                                                
                    <div class="row"> 
                     <div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Compañía:</label></div></div>
                        
                    <div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Alcaldía activa?</label>                      <select name="active" class="form-control" id="active" style="width:300px;"> 
                                                  
<option value="0" selected>No</option> 

<option value="1" <? if($row['active']) echo "selected"; ?>>Si</option> 

					</select></div></div>
                       
                        <div class="col-md-12"> 
							
							<div class="form-group">

	<label class="control-label">Archivo: (1072X546px) <br>
    <span style="color: blue">Subir un nuevo archivo, crea una nueva version del formato de retenciones que se activara a partir de terminada la actualización.</span></label> 
	<input name="file" type="file" class="form-control" id="file" value="">
	</div>
                                                      
    <?php
                            #Buscamos si hay una version
                          
                            if($row['version'] == 0){
                               $address = "halls/".$_GET['id']."/".$_GET['id'].".jpg";
                            }else{
                                $address = "halls/".$_GET['id']."/".$_GET['id']."v$row[version].jpg";
                            }
                            
                            echo $address;
                            
                            
													  if(file_exists($address)){
													  ?>
                                                      <img src="<?php echo $address; ?>" width="50%">    
                                                      <?php } ?>
                                                            </div>
                                                             </div>
                                                            
                                                            
                                                            
                                                
                                                <div class="row">

													

													<!--/span-->

													<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Unidades de Negocio:</label> 
	
    <table width="100%">
                    <?php  
     $numcolumnas = 8;  
     $consulta = mysqli_query($con, "SELECT code FROM units order by code");  
     $total_resultados = mysqli_num_rows($consulta);  
     
	 if ($total_resultados>0) {  
     echo "<tr><td colspan=\"$numcolumnas\"></td></tr>";  
     $i = 1;  
     
	  while($fila = mysqli_fetch_array($consulta)){  
  
  $check = "";
  $units = ($row['units']); 
  $aunits = explode(", ", $units); 
  foreach($aunits as $b){   
  if ($b ==  $fila['code']) $check = "checked";
  
  $disable = "";
  $style = "";
  $queryinner = "select id from halls where units like '%$fila[code]%' and id != '$_GET[id]'";
  $resultinner = mysqli_query($con, $queryinner);
  $numinner = mysqli_num_rows($resultinner);
  if($numinner > 0){
	  $disable = 'disabled="disabled"';
	  $style = 'style="color:red;"'; 
  }
  
   }
  $resto = ($i % $numcolumnas);    
    if($resto == 1){ 
	//si es el primer elemento creamos una nueva fila 
    echo "<tr>";   
     }  
    echo '<td '.$style.'>  <input name="ckunits[]" type="checkbox" id="ckunits[]" value="'. $fila['code'] .'" '. $check .' '.$disable.'>'.$fila['code']."</td>"; 
	//mostramos el valor del campo especificado  
     if($resto == 0){
		 //cerramos la fila 
     echo "</tr>";  
     }  
     $i++;  
     }  
    if($resto != 0){
		//Si en la &uacute;ltima fila sobran columnas, creamos celdas vac&iacute;as  
     for ($j = 0; $j < ($numcolumnas - $resto); $j++){  
     echo "<td></td>";  
     }  
     echo "</tr>";  
     }  
    }else{  
     echo "<tr><td>0 elementos encontrados</td></tr> ";  
     } 
	  
     ?>
                  </table>
     
													  </div>

													</div>

													<!--/span-->

												</div>
                                                <div class="row">

													

													<!--/span-->

													

													<!--/span-->

												</div>

												<!--/row--><!--/row-->

												

												<!--/row-->

												<div class="row"></div>

										    <!--/row--></div>

											<div class="form-actions right">

												<button type="button" class="btn default" onClick="javascript:goHome();">Cancelar</button>
                                                <script>
												function goHome(){
													window.location = "halls.php"; 
												}
												</script>

												<button type="submit" class="btn blue" name="update"><i class="fa fa-check"></i> Guardar y regresar</button>
                                                <button type="submit" class="btn blue" name="save"><i class="fa fa-check" ></i> Guardar y salir</button>
												<input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>"> 

											</div>

										</form>

										<!-- END FORM-->

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

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/form-samples.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>

jQuery(document).ready(function() {    

   // initiate layout and plugins

   Metronic.init(); // init metronic core components

Layout.init(); // init current layout

QuickSidebar.init() // init quick sidebar

   FormSamples.init();

});

</script>


<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/clockface/js/clockface.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>

        jQuery(document).ready(function() {       

           // initiate layout and plugins

           Metronic.init(); // init metronic core components

Layout.init(); // init current layout

QuickSidebar.init() // init quick sidebar

           ComponentsPickers.init();

        });   

    </script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>