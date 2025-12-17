<?php include("session-request.php"); ?>
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

			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

				<div class="modal-dialog">

					<div class="modal-content">

						<div class="modal-header">

							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

							<h4 class="modal-title">Modal title</h4>

						</div>

						<div class="modal-body">

							 Widget settings form goes here

						</div>

						<div class="modal-footer">

							<button type="button" class="btn blue">Save changes</button>

							<button type="button" class="btn default" data-dismiss="modal">Close</button>

						</div>

					</div>

					<!-- /.modal-content -->

				</div>

				<!-- /.modal-dialog -->

			</div>

			<!-- /.modal -->

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN STYLE CUSTOMIZER -->

			

			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Pagos <small>Solicitud de Pago</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="payments.php">Pagos</a></li>
                             <i class="fa fa-angle-right"></i>

						<li>

							<a href="#">Solicitudes de pagos</a>

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

										<form action="payment-order-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">

											<div class="form-body">

												<h3 class="form-section">Información del Proveedor</h3>

												<div class="row"><!--/span-->

													<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value=""></option>
<?php $queryproviders = "select * from providers";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?>
												<option value="<?php echo $rowproviders['id']; ?>"><?php echo $rowproviders['code']." | ".$rowproviders['name']; ?></option>
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

													<!--/span-->

												</div>

												<!--/row--><!--/row-->
		<h3 class="form-section">Concepto de Pago</h3>
        
												<div class="row">

													
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Tipo:</label>
<?php $queryt = "select * from categories where type = 1";
$resultt = mysqli_query($con, $queryt);
$numt = mysqli_num_rows($resultt);
$rowt = mysqli_fetch_array($resultt);
?>
															<select name="type" class="form-control" id="type" onChange="javascript:reloadsconcept(this.value);">
<option value="0" selected>Seleccionar</option>
<?php $queryt1 = "select * from categories where parentcat = $rowt[id]";
$resultt1 = mysqli_query($con, $queryt1);
while($rowt1=mysqli_fetch_array($resultt1)){
?>														<option value="<?php echo $rowt1['id']; ?>"><?php echo $rowt1['name']; ?></option>
<?php } ?>
															</select>

													  </div>

													</div>                                                    
                                                    
                                                    <div class="col-md-4">

													  <div class="form-group">

															<label class="control-label">Concepto:</label>
															<select name="concept" class="form-control" id="concept" onChange="javascript:reloadsconcept2(this.value);">

<option value="0">Esperando la selección de tipo para cargar la lista</option>
															</select>

													  </div>

													</div>

													<!--/span-->

												  <div class="col-md-4">

													<div class="form-group">

											 				<label class="control-label">Sub Categoria:</label>

													  <select name="concept2" class="form-control" id="concept2">
													 
                                                        <option value="0">Esperando la selección de concepto para cargar la lista</option>

													  </select>
												    </div> 

												  </div>
                                                    <div class="col-md-12 ">
													  <div class="form-group">
														<label>Descripcion:</label>
                                                        <textarea name="description" rows="2" class="form-control" id="description"></textarea>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <?php //start bill ?>
                                                    <div id="bill">
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Factura No:</label>
                                                        <input name="bill[]" type="text" class="form-control" id="bill[]" value="">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div><div class="col-md-2 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="ammount[]" type="text" class="form-control" id="ammount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers(this.value);">
						
                      
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div><div class="col-md-3 ">
													  <div class="form-group">
														<label>Cantidad en letras:</label> 
                                                        <input name="letters[]" type="text" class="form-control" id="letters[]" value="" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Sub-total:</label>
                                                        <input name="stotal[]" type="text" class="form-control" id="stotal[]" value="" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>IVA:</label>
                                                        <input name="tax[]" type="text" class="form-control" id="tax[]" value="" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-1 ">
													  <div class="form-group">
														<label>Exento:</label>
                                                        <input type="checkbox" name="exempt[]" id="exempt[]" onChange="javascript:reloadNumbers();">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
 <div class="col-md-6 ">
													  <div class="form-group">
														<label>Link:</label>
                                                        <input name="file[]" type="text" class="form-control" id="file[]" value="">
						
                                                          
                       <br>

    
                                                      <!--/row--></div>
													</div>  
                                                    <div class="col-md-6 ">
													  <div class="form-group">
														<label>Nombre:</label>
                                                        <input name="filename[]" type="text" class="form-control" id="filename[]" value="Factura 1">
						
                                                          
                       <br>

    
                                                      <!--/row--></div>
													</div>   
 </div>
 <?php //end bill ?>  
          
   <script type="text/javascript">
  var bill = 1; 
function addBill(){
	
   var billinfo1 = '<div class="col-md-2 "><div class="form-group"><label>Factura No:</label><input name="bill[]" type="text" class="form-control" id="bill[]" value=""><br></div></div>';
     $("#bill").append(billinfo1);
   var billinfo2 = '<div class="col-md-2 "><div class="form-group"><label>Monto:</label><input name="ammount[]" type="text" class="form-control" id="ammount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers(this.value);"><br></div></div>';
     $("#bill").append(billinfo2);
   var billinfo3 = '<div class="col-md-3 "><div class="form-group"><label>Cantidad en letras:</label><input name="letters[]" type="text" class="form-control" id="letters[]" value="" readonly> <br></div></div>';
     $("#bill").append(billinfo3);
	 
	 var billinfo3a = '<div class="col-md-2 "><div class="form-group"><label>Sub-total:</label><input name="stotal[]" type="text" class="form-control" id="stotal[]" value="" readonly><br> <div class="row"></div></div></div>';
     $("#bill").append(billinfo3a);
	 var billinfo3b = '<div class="col-md-2 "><div class="form-group"><label>IVA:</label><input name="tax[]" type="text" class="form-control" id="tax[]" value="" readonly><br><div class="row"></div></div></div>';
     $("#bill").append(billinfo3b);
	 var billinfo3c = '<div class="col-md-1 "><div class="form-group"><label>Exento:</label><input type="checkbox" name="exempt[]" id="exempt[]" onChange="javascript:reloadNumbers();"><br><div class="row"></div></div></div>';
     $("#bill").append(billinfo3c);
	 
   bill++;
   var billinfo4 = '<div class="col-md-6 "><div class="form-group"><label>Link:</label><input name="file[]" type="text" class="form-control" id="file[]" value=""><br></div></div><div class="col-md-6 "><div class="form-group"><label>Nombre:</label><input name="filename[]" type="text" class="form-control" id="filename[]" value="Factura '+bill+'"><br></div></div>';
     $("#bill").append(billinfo4);
  
}
</script>  
          <div class="col-md-4 ">
                                                   
														<label>&nbsp;</label>
                                                    <button type="button" class="btn blue icn-only" onclick="addBill();"><i class="fa fa-plus"></i> Agregar Factura</button>
             </div> 
               <div class="row"></div><br><br><br>
             <div class="col-md-2 ">
													  <div class="form-group">
														<label>Sub-total Factura(s):</label>
                                                        <input name="stotalbill" type="text" class="form-control" id="stotalbill" value="" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>IVA Factura(s):</label>
                                                        <input name="totaltax" type="text" class="form-control" id="totaltax" value="" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Total Factura(s):</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 
                                                    
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Moneda:</label>
														<select name="currency" class="form-control" id="currency">
														  <option value="0">Seleccionar</option>
<?php $querycurrency = "select * from currency";
$resultcurrency = mysqli_query($con, $querycurrency);
while($rowcurrency=mysqli_fetch_array($resultcurrency)){
?>                                                         <option value="<?php echo $rowcurrency['id']; ?>"><?php echo $rowcurrency['name']; ?></option>
<?php } ?>													    </select>
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>      
      
 
 </div>                                           
                                                    <h3 class="form-section">Retenciones</h3>
                                                    	<div class="row">
                                                    
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														<label>Alcaldia:</label>
                                                        <input name="retention1" type="text" class="form-control" id="retention1" value="" placeholder="%" onKeyUp="javascript:calculate1(this.value);" onkeypress="return justNumbers(event);">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														
           <label>&nbsp;</label>                                             <input name="retention1ammount" type="text" class="form-control" id="retention1ammount" placeholder="Monto" value="" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                                 
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														<label>IR:</label>
                                                        <input name="retention2" type="text" class="form-control" id="retention2" value="" placeholder="%" onKeyUp="javascript:calculate2(this.value);" onkeypress="return justNumbers(event);" onsubmit="return validateForm();">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-3 ">
													  <div class="form-group">
			    <label>&nbsp;</label>											
                                                        <input name="retention2ammount" type="text" class="form-control" id="retention2ammount" placeholder="Monto" value="" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    

													<!--/span-->

												</div>
                                                  <h3 class="form-section">Pago a Proveedor</h3>
                                                  
                                              <div class="row"><!--/span-->
                                                <div class="col-md-3 ">
													  <div class="form-group">
			    <label>Monto a Pagar</label>
			    :											
                                                        <input name="payment" type="text" class="form-control" id="payment" placeholder="Calculo automático" value="" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
												</div>  
                                                  </div>
                                                  
                                                       <h3 class="form-section"><a id="files"></a>Archivos </h3>
                                                  
                                                  <div class="row"><!--/span--> 
                                                  
                                                  <div id="emails">
                                                    
                                                     <div class="col-md-5 ">
													  <div class="form-group">
													    <input name="file[]" type="text" class="form-control" id="file[]"  placeholder="Ej: http://www.ejemplo.com" value=""><br><div class="row"></div></div></div> 
                                                        <div class="col-md-5 ">
													  <div class="form-group">
													    <input name="filename[]" type="text" class="form-control" id="filename[]"  placeholder="Ej: Factura" value="">
						
                                                          
                       <br>
                       
                     

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>  
                                                    </div>
              <div class="col-md-2 "><button type="button" class="btn blue icn-only" onclick="agregar();"><i class="fa fa-plus"></i></button>
             </div>                        
                                                     
                                   
                                                     
<script type="text/javascript">
var bill = 1;
function agregar(){ 
	
    campo = '<div class="col-md-5 "><div class="form-group"><input name="file[]" type="text" class="form-control" id="file[]"  placeholder="Ej: http://www.ejemplo.com" value=""><br><div class="row"></div></div></div><div class="col-md-5 "><div class="form-group"><input name="filename[]" type="text" class="form-control" id="filename[]"  placeholder="Ej: Factura" value=""><br><div class="row"></div></div></div>'; 
    $("#emails").append(campo);
	
}
</script>
                                              </div>
                                                  

											<!--/row--><!--/row--></div>


											<div class="form-actions right">

												<button type="button" class="btn default" onClick="javascript:cancelAction();">Cancelar</button>

												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Ingresar</button>

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
</script>

    
<script type="text/javascript">
function reloadsconcept(nid){	

	$.post("reload-sconcepts.php", { variable: nid }, function(data){
		$("#concept").html(data);
		
});			
}

function reloadsconcept2(nid){	

	$.post("reload-sconcepts2.php", { variable: nid }, function(data){
		$("#concept2").html(data);
		
});			
}

function reloadNumbers(thenumber){	

	
	var gtotal=0;
	var gstotal=0;
	var gtax = 0;
	var data = 0;
	var ndata = 0;
	var cammount = 0;
	i=0;
	for (var obj in document.getElementsByName('letters[]')){
	if (i<document.getElementsByName('ammount[]').length){
 
   cammount = document.getElementsByName('ammount[]')[i].value;
   
   if(document.getElementsByName('exempt[]')[i].checked == true){
   
   tax = 0;
   stotal = cammount;
   
   document.getElementsByName('tax[]')[i].value = 'n/a';
   document.getElementsByName('stotal[]')[i].value = 'n/a';
   
   }else{
   
   
   stotal = cammount/1.15;
   tax = cammount-stotal;
   
   document.getElementsByName('tax[]')[i].value = tax.toFixed(2);
   document.getElementsByName('stotal[]')[i].value = stotal.toFixed(2);
   }
   
  $.post("reload-numberstoletters.php", { variable: cammount }, function(string){
	 
	 
	 document.getElementsByName('letters')[i].value = string;
   
}); 

  
  gtotal += parseFloat(cammount);
  gstotal += parseFloat(stotal);
  gtax += parseFloat(tax);
 
  }
  i++;
  }
   
  document.getElementById("totalbill").value = gtotal.toFixed(2);
  document.getElementById("totaltax").value = gtax.toFixed(2);
  document.getElementById("stotalbill").value = gstotal.toFixed(2);

}

function help1(){
	alert('Si el monto no coinside con la cantidad en letras utilize esta opción.');
}


function cancelAction(){
	if (confirm("Esta Seguro de cancelar este ingreso?\n")==true){
			window.location = 'payments.php';
		}
}

function calculate1(p1){
	
var ammount=document.getElementById("totalbill").value;
	if(ammount == 0){
		alert('El monto debe de contener una cantidad');
		document.getElementsByName("ammount[]").focus();
		document.getElementById("retention1").value = "";
		 
	}else{
	var ammount1 = ammount*(p1/100);
	document.getElementById("retention1ammount").value = ammount1.toFixed(2);
	document.getElementById("ammount").readOnly = true; 
	var ammount1 = document.getElementById("retention1ammount").value;
	var ammount2 = document.getElementById("retention2ammount").value;
	var payment = ammount-ammount1-ammount2;
	document.getElementById("payment").value = payment.toFixed(2);
	}
	
	
}
function calculate2(p2){
	var ammount=document.getElementById("totalbill").value;
	if(ammount == 0){
		alert('El monto debe de contener una cantidad');
		document.getElementById("retention2").value = ""; 
		document.getElementByName("ammount[]").focus();
		
	}else{
	var ammount2 = ammount*(p2/100); 
	document.getElementById("retention2ammount").value = ammount2.toFixed(2);
	document.getElementsByName("ammount[]").readOnly = true;
	var ammount1 = document.getElementById("retention1ammount").value;
	var ammount2 = document.getElementById("retention2ammount").value;
	var payment = ammount-ammount1-ammount2;
	document.getElementById("payment").value = payment.toFixed(2);
	}
}

						function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }


function validateForm(){
	var provider = document.getElementById("provider").value;
	if(provider == 0){
		alert('Usted debe de seleccionar un proveedor.');
		return false;
		}
		var type = document.getElementById("type").value;
	if(type == 0){
		alert('Usted debe de seleccionar un tipo de pago.');
		return false;
		}
		var concept = document.getElementById("concept").value;
	if(concept == 0){
		alert('Usted debe de seleccionar un concepto de pago.');
		return false;
		}
		var concept2 = document.getElementById("concept2").value;
	if(concept2 == 0){
		alert('Usted debe de seleccionar una sub categoria.');
		return false;
		}
		var description = document.getElementById("description").value;
	if(description == 0){
		alert('Usted debe de ingresar una descripcion del pago.');
		return false;
		}
		
		i=0;
for (var obj in document.getElementsByName('bill[]')){
 if (i<document.getElementsByName('ammount[]').length){
cbill =  document.getElementsByName('bill[]')[i].value;
if(cbill == ""){
	alert('Usted debe de ingresar el numero de factura.');
	return false;
}
cammount =  document.getElementsByName('ammount[]')[i].value;
if(cammount == ""){
	alert('Usted debe de ingresar el monto de cada factura.');
	return false;
}

  }
  i++;
}
		
		var totalbill = document.getElementById("totalbill").value;
	if(totalbill == 0){
		alert('Usted debe de ingresar un monto.');
		return false;
		}
		var currency = document.getElementById("currency").value;
	if(currency == 0){
		alert('Usted debe de seleccionar una moneda.');
		return false;
		}
		var currency = document.getElementById("currency").value;
	if(currency == 0){
		alert('Usted debe de seleccionar una moneda.');
		return false;
		}
		var payment = document.getElementById("payment").value;
	if(payment == 0){
		alert('No se puede agregar un pago con un monto de 0.00.');
		return false;
		}
		
}

						</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>