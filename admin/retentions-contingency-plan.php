<?php 

include("session-retentions.php");  
	
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


<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

<!-- END THEME STYLES -->



<link rel="shortcut icon" href="favicon.ico"/>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:reloadNumbers(),reloadRouteView()"> 

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

					Retenciones <small>Módulo de contingencia</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="retentions-home.php">Retenciones</a></li> 
                             <i class="fa fa-angle-right"></i>

						<li>

							<a href="#">Módulo de contingencia</a>

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

										

										</div>

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form name="porder" id="porder" action="retentions-contingency-plan-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        

										        
                                                 
                                                 
                                                 
<div id="manualretentions">    
<div class="col-md-12">                                             
	<h3 class="form-section">Retenciones Manuales</h3></div>
  
<?php
$querymodret = "select * from manualretentions where payment = '$_GET[id]'";
$resultmodret = mysqli_query($con, $querymodret);
$nummodret = mysqli_num_rows($resultmodret);
if($nummodret > 0){
while($rowmodret=mysqli_fetch_array($resultmodret)){ ?>

<?php //type ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Tipo:</label> 

									<select name="modrettype[]" class="form-control" id="modrettype[]">
<option value="1">IMI</option>
<option value="2">IR</option> 

</select>
																									

													</div>
                                               
                                               </div>
<?php //today?>                                            
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Fecha:</label> 

									  <input name="modrettoday[]" type="text" class="form-control form-control-inline date-picker" id="modrettoday[]" value="<?php 
	if($rowmodret['today'] != "0000-00-00"){
		if($rowmodret['today'] != "1969-12-31"){
			$modrettoday= strtotime($rowmodret['today']);
			echo date('d-m-Y', $modrettoday);
		}
	}
														 ?>"> 
																									

													</div>
                                               
                                               </div>
<?php //Number ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">No:</label> 

									  <input name="modretno[]" type="text" class="form-control" id="modretno[]" value="<?php echo $rowmodret['number']; ?>"> 
																									

													</div>
                                               
                                               </div>               
<?php //Proveedor ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Nombre del retenido:</label> 

									  <input name="modretprovider[]" type="text" class="form-control" id="modretprovider[]" value="<?php echo $rowmodret['provider']; ?>">
																									

													</div>
                                               
                                               </div>
<?php //Direccion ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Dirección:</label> 

									  <input name="modretaddress[]" type="text" class="form-control" id="modretaddress[]" value="<?php echo $rowmodret['address']; ?>">
																									

													</div>
                                               
                                               </div>
<?php //Ruc ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">RUC:</label> 

									  <input name="modretruc[]" type="text" class="form-control" id="modretruc[]" value="<?php echo $rowmodret['ruc']; ?>">
																									

													</div>
                                               
                                               </div>
<?php //Ruc ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Cédula:</label> 

									  <input name="modretnid[]" type="text" class="form-control" id="modretnid[]" value="<?php echo $rowmodret['nid']; ?>" >
																									

													</div>
                                               
                                               </div>
 <?php //Telefono ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Teléfono:</label> 

									  <input name="modretphone[]" type="text" class="form-control" id="modretphone[]" value="<?php echo $rowmodret['phone']; ?>">
																									

													</div>
                                               
                                               </div>
<?php //Direccion ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Concepto de pago:</label> 

									  <input name="modretconcept[]" type="text" class="form-control" id="modretconcept[]" value="<?php echo $rowmodret['concept']; ?>">
																									

													</div>
                                               
                                               </div>
<div class="row"></div>
<?php //Facturas ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Facturas:</label> 

									  <input name="modretbills[]" type="text" class="form-control" id="modretbills[]" value="<?php echo $rowmodret['bills']; ?>">
																									

													</div>
                                               
                                               </div> 
<?php //Total facturas ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Total Facturas (C$):</label>

									  <input name="modrettotalbill[]" type="text" class="form-control" id="modrettotalbill[]" value="<?php echo $rowmodret['totalbill']; ?>">
																									

													</div>
                                               
                                               </div>
<?php //% de retencion ?> 
<div class="col-md-4 ">
													  <div class="form-group">
														<label>% de retención:  </label>
                                                        <input name="modretpercent[]" type="text" class="form-control" id="modretpercent[]" value="<?php echo $rowmodret['percent']; ?>"></div>
													</div>                          
<?php //Total retencion ?>                                                
<div class="col-md-4 ">
						  <div class="form-group">
							<label>Total retención (C$):</label> 
                                                                                  <input name="modrettotalretention[]" type="text" class="form-control" id="modrettotalretention[]" value="<?php echo $rowmodret['totalretention']; ?>"> 
						
                            <!--/row--></div>
													</div>
<div class="col-md-12 ">
						  <div class="form-group">
							<label>Elaborado por:</label> 
                                                                                  <input name="modretelaborator[]" type="text" class="form-control" id="modretelaborator[]" value="<?php echo $rowmodret['elaborator']; ?>"> 
						
                            <!--/row--></div>
													</div>
                                                 
<?php } ?>

<?php 
}
else{  ?>


<?php //today ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Tipo:</label> 

									<select name="modrettype[]" class="form-control" id="modrettype[]">
<option value="0">Seleccionar</option>
<option value="1">IMI</option>
<option value="2">IR</option> 

</select>
																									

													</div>
                                               
                                               </div>
<?php //today ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Fecha:</label> 

									  <input name="modrettoday[]" type="text" class="form-control form-control-inline date-picker" id="modrettoday[]" value="<?php if($rowmodret['today'] == "0000-00-00") echo ""; else echo "";?>"> 
																									

													</div>
                                               
                                               </div>
<?php //today ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">No:</label> 

									  <input name="modretno[]" type="text" class="form-control" id="modretno[]" value=""> 
																									

													</div>
                                               
                                               </div>               
<?php //Proveedor ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Nombre del retenido:</label> 

									  <input name="modretprovider[]" type="text" class="form-control" id="modretprovider[]" value="">
																									

													</div>
                                               
                                               </div>
<?php //Direccion ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Dirección:</label> 

									  <input name="modretaddress[]" type="text" class="form-control" id="modretaddress[]" value="">
																									

													</div>
                                               
                                               </div>
<?php //Ruc ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">RUC:</label> 

									  <input name="modretruc[]" type="text" class="form-control" id="modretruc[]" value="">
																									

													</div>
                                               
                                               </div>
<?php //Ruc ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Cédula:</label> 

									  <input name="modretnid[]" type="text" class="form-control" id="modretnid[]" value="" >
																									

													</div>
                                               
                                               </div>
 <?php //Telefono ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Teléfono:</label> 

									  <input name="modretphone[]" type="text" class="form-control" id="modretphone[]" value="">
																									

													</div>
                                               
                                               </div>
<?php //Direccion ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Concepto de pago:</label> 

									  <input name="modretconcept[]" type="text" class="form-control" id="modretconcept[]" value="">
																									

													</div>
                                               
                                               </div>
<div class="row"></div>
<?php //Facturas ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Facturas:</label> 

									  <input name="modretbills[]" type="text" class="form-control" id="modretbills[]" value="">
																									

													</div>
                                               
                                               </div> 
<?php //Total facturas ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Total Facturas (C$):</label>

									  <input name="modrettotalbill[]" type="text" class="form-control" id="modrettotalbill[]" value="">
																									

													</div>
                                               
                                               </div>
<?php //% de retencion ?> 
<div class="col-md-4 ">
													  <div class="form-group">
														<label>% de retención:  </label>
                                                        <input name="modretpercent[]" type="text" class="form-control" id="modretpercent[]" value=""></div>
													</div>                          
<?php //Total retencion ?>                                                
<div class="col-md-4 ">
						  <div class="form-group">
							<label>Total retención (C$):</label> 
                                                                                  <input name="modrettotalretention[]" type="text" class="form-control" id="modrettotalretention[]" value=""> 
						
                            <!--/row--></div>
													</div>
                                            <div class="col-md-12 ">
						  <div class="form-group">
							<label>Elaborado por:</label> 
                                                                                  <input name="modretelaborator[]" type="text" class="form-control" id="modretelaborator[]" value=""> 
						
                            <!--/row--></div>
													</div>
                                                    
                                                  
<?php } ?> 
                                                 
<div class="row"></div> 
<div id="rets"></div>
<div class="row"></div> 
<div class="col-md-12"> 
                                         
 <button type="button" class="btn blue icn-only" onclick="addRet();"><i class="fa fa-plus"></i> Agregar Retención</button></div>
 
 <script>
 var tret = 1;
 function addRet(){    
	
	campo2 = '<div id="tretid_'+tret+'"><div class="col-md-12"><hr><br><hr><br><hr></div><div class="col-md-4"><div class="form-group"><label class="control-label">Tipo:</label><select name="modrettype[]" class="form-control" id="modrettype[]"><option value="0">Tipo</option><option value="1">IMI</option><option value="2">IR</option></select></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Fecha:</label><input name="modrettoday[]" type="text" class="form-control form-control-inline date-picker" id="modrettoday[]" value=""></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">No:</label><input name="modretno[]" type="text" class="form-control" id="modretno[]" value=""></div></div><div class="col-md-12"><div class="form-group"><label class="control-label">Nombre del retenido:</label><input name="modretprovider[]" type="text" class="form-control" id="modretprovider[]" value=""  ></div></div><div class="col-md-12"><div class="form-group"><label class="control-label">Dirección:</label> <input name="modretaddress[]" type="text" class="form-control" id="modretaddress[]" value=""  ></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">RUC:</label> <input name="modretruc[]" type="text" class="form-control" id="modretruc[]" value="" ></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Cédula:</label><input name="modretnid[]" type="text" class="form-control" id="modretnid[]" value="" ></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Teléfono:</label><input name="modretphone[]" type="text" class="form-control" id="modretphone[]" value="" ></div></div><div class="col-md-12"><div class="form-group"><label class="control-label">Concepto de pago:</label><input name="modretconcept[]" type="text" class="form-control" id="modretconcept[]" value="" ></div></div><div class="col-md-12"><div class="form-group"><label class="control-label">Facturas:</label><input name="modretbills[]" type="text" class="form-control" id="modretbills[]" value=""  ></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Total Facturas:</label><input name="modrettotalbill[]" type="text" class="form-control" id="modrettotalbill[]" value=""  ></div></div><div class="col-md-4 "><div class="form-group"><label>% de retención:</label><input name="modretpercent[]" type="text" class="form-control" id="modretpercent[]" value=""  ></div></div><div class="col-md-4 "><div class="form-group"><label>Total retención:</label><input name="modrettotalretention[]" type="text" class="form-control" id="modrettotalretention[]" value=""></div></div><div class="col-md-12 "><div class="form-group"><label>Elaborado por:</label><input name="modretelaborator[]" type="text" class="form-control" id="modretelaborator[]" value=""><!--/row--></div></div><div class="row"></div><div class="col-md-2 "><button type="button" class="btn red icn-only" onclick="eliminarRet('+tret+');">-</button></div><div class="row"></div><br></div>';
    $("#rets").append(campo2); 
	tret++;
	
	ComponentsPickers.init();
	
}

function eliminarRet(tretid){
	 $('#tretid_'+tretid).remove(); 
}

 </script>
 
     <div class="row"></div><br>
<br>
 </div>
                                                    


                                                 
                                                 
                                                 
  
                                           
                                                 
                                                 
                                                 
                                                 
                                                  
                                                  
                                                  <div><!--/span--> 
                                                  
                                                  
              
                                    
                                                     
                                   
                                                     

                                              </div>
                                              
                                              
                                         
                               
                                                        
     
                                                           


											<div class="form-actions right" style=" margin-top:100px;">

												<button type="button" class="btn default" onClick="javascript:cancelAction();"><i class="fa fa-undo"></i> Retornar</button>
                                               <script type="text/javascript">
												  function cancelAction(){
													  history.go(-1);
												  }
												</script>

                                              <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Ingresar</button>
											    <input name="newbutton" type="hidden" id="newbutton" value="save">
											    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
											    <span class="form-actions right" style=" margin-top:100px;">
											    <input type="hidden" name="cut" id="cut" value="<?php echo $rowpconfirm['cut']; ?>">
											    </span>
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


<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script src="../assets/admin/pages/scripts/components-pickers.js"></script>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


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

    
<script type="text/javascript"> 


function cancelAction(){
	if (confirm("Esta Seguro de cancelar este ingreso?\n")==true){
			window.location = 'retentions-home.php';
		}
}

function justNumbers(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }

function commas(unformatedAmmount) {
    
	var floatAmmount = parseFloat(unformatedAmmount);
	var floatAmmount2 = floatAmmount.toFixed(2); 
	
	var parts = floatAmmount2.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
	var parts2 = parts.join(".");
	return parts2;  
}

function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}



function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}


			
</script>

<?php //include('fn-reloadnumbers.php'); ?>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>

  
<?php 

function cleanLink($dirtyurl){ 

	$levels = explode('/', $dirtyurl);
	$levelsize = sizeof($levels);
	$levelsize = $levelsize-1;
	$cleanurl = $levels[$levelsize];
	$cleanurl = str_replace('visor.php?key=','',$cleanurl);
	
	return $cleanurl;
}



?>