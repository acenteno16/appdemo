<?php 

include("sessions.php");  

$id = $_GET['id'];
	
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

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Retenciones <small>IR</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Retenciones manuales IR</a></li>
                             <i class="fa fa-angle-right"></i>

						<li>

							<a href="#">Agregar Retención</a>

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

										<form name="porder" id="porder" action="retention-manual-ir-add-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        

											<div class="form-body">

												<h3 class="form-section">Retenciones manuales IR</h3> 
                                                <div class="row"><!--/span-->

													<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">No. de retención:</label>

						
										
											  <input name="number" type="text" class="form-control" id="number" value="<?php echo $rowpconfirm['id']; ?>">  
								
															<div title="Page 5">
															  <div>
															    <div></div>
														      </div>
													    </div>
													  </div>

													</div> 
                                                    
                                                    <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Fecha:</label>

														 <input name="today2" type="text" class="form-control form-control-inline date-picker" id="today2" value="" readonly>
																									

													</div>
                                               
                                               </div>
                                               
                                              
                                                    
                                                  
                                                    
                                                    

													<!--/span-->

												</div>

											
                                                

												<!--/row-->
	
        
												<div class="row">

													

                                                    <div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Proveedor/Colaborador:</label>

									  <input name="provider" type="text" class="form-control" id="provider" value="" > 
																									

													</div>
                                               
                                               </div>
                                               
                                               <div class="col-md-12 ">
													  <div class="form-group">
														<label>Descripción:</label>
                                                        <textarea name="description" rows="2" class="form-control" id="description"><?php echo $rowpconfirm['description']; ?></textarea> 

                                                      <!--/row--></div>
													</div>
                                                    

 
 

 
   
 <input type="hidden" id="billid[]" name="billid[]" value="0">
 <div id="bill_<?php echo $typeinc; ?>">
<?php 
 
$typeinc++; 
 
?>
 


<?php //Tipo de documento ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Total Facturas:</label>

									  <input name="totalbill" type="text" class="form-control" id="totalbill" value="" onKeyUp="javascript:calculateTotal();" onKeyPress="return justNumbers(event);">
																									

													</div>
                                               
                                               </div>
<?php //No factura ?>                                                    
<div class="col-md-4 ">
													  <div class="form-group">
														<label>% de retención:  </label>
                                                        <input name="percent" type="text" class="form-control" id="percent" value="" onKeyUp="javascript:calculateTotal();" onKeyPress="return justNumbers(event);"></div>
													</div>
                                                    
<?php //Bill date Rec ?>                                                    
<div class="col-md-4 ">
													  <div class="form-group">
														<label>Total retención:</label> 
                                                                                                              <input name="totalretention" type="text" class="form-control" id="totalretention" value="" readonly> 
						
                                                      <!--/row--></div>
													</div>
                                                                            



                                                    
                                                   
<div class="row"></div>
<?php //Cantidad en letras ?>
<div class="col-md-12 ">
													  <div class="form-group">
														<label>Cantidad en letras:</label> 
                                                        <input name="letters" type="text" class="form-control" id="letters" value="" readonly> 
						
                                                          
                    

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 

                                                  
</div>
 
 
 </div>                                           

                                                
                                              
                                                  
                                                                
                                         
 

                                                       										<!--/row--><!--/row--></div>
                                                                                            

											<div class="form-actions right" style=" margin-top:10px;">

												<button type="button" class="btn default" onClick="javascript:cancelAction();"><i class="fa fa-undo"></i> Retornar</button>

										
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

							

			<script>
			function saveDraft(){
			document.getElementById('newbutton').value = "draft"; 
			document.forms['porder'].submit();
			}
			
			</script>
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
			window.location = 'payments.php';
		}
}

	function justNumbers(e)
        {
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

function calculateTotal(){
	var uno = document.getElementById('totalbill').value;
	var dos = document.getElementById('percent').value;
	var tres = uno*(dos/100);
	if((uno > 0) && (dos > 0)){
		document.getElementById('totalretention').value = tres;
		justLetters(tres); 
	}else{
		document.getElementById('totalretention').value = 0;
	}
}

function justLetters(cammount){
	
   $.post("reload-numberstoletters.php", { variable: cammount }, function(data){
	 
  document.getElementById('letters').value = data;
   
}); 
} 

</script>


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