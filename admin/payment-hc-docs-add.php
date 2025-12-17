<?php 

include("session-request.php");  

$id = $_GET['id'];

$queryTemplate = "select * from hcTemplates where id = '$id'";
$resultTemplate = mysqli_query($con, $queryTemplate);
$rowTemplate = mysqli_fetch_array($resultTemplate);
	
?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en" >

<!--<![endif]-->

<!-- BEGIN HEAD --><head>

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

					Pagos <small>Solicitud de Pago CH</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="payments.php">Solicitudes de pago</a>
                             <i class="fa fa-angle-right"></i>
                             </li>

						<li>

							<a href="payment-hc-docs.php">Documentos de colaboradores</a>
							 <i class="fa fa-angle-right"></i>

						</li>
						<li>

							<a href="#">Agregar</a>

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

										<form name="porder" id="porder" action="payment-hc-docs-add-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        

											<div class="form-body">

												<h3 class="form-section">Información General</h3> 
                                                <div class="row">
                                                <!--/span-->

													 
                                                    
                                                   
                                                    
                            
                                                   
</div>
                                                  
                                                  
											<div class="row"></div> 
											<div class="row">												
											<? #Colaboradores ?>	
											<div class="col-md-8">

											<div class="form-group">

											<label class="control-label">Colaborador:</label>

											<select name="collaborator" class="form-control  select2me" id="collaborator" data-placeholder="Seleccionar..." > 

												<option value=""></option>
												<?php $queryworkers = "select * from workers";
												$resultworkers = mysqli_query($con, $queryworkers);
												while($rowworkers=mysqli_fetch_array($resultworkers)){
												?>
												<option value="<?php echo $rowworkers['id']; ?>"<?php if($rowpconfirm['collaborator'] == $rowworkers['id']) echo 'selected'; ?>><?php echo $rowworkers['code']." | ".$rowworkers['first']." ".$rowworkers['last']; ?></option>
                                                <?php } ?>  

												
											</select>
											  
											</div>
											</div>
											<? #URL ?>		
											<div class="col-md-8">
												<div class="form-group">
														  <label class="control-label">URL:</label>
															<input name="url" type="text" class="form-control" id="url" value="">  
												</div>
											</div>
												
													<? #URL ?>		
											<div class="col-md-8">
												<div class="form-group">
														  <label class="control-label">Title:</label>
															<input name="title" type="text" class="form-control" id="title" value="">  
												</div>
											</div>
</div>
</div>
											
	
                                                                                            
            							
											<div class="form-actions left" style=" margin-top:10px;">

												<div style="margin-right: 10px;">
												<button type="button" class="btn default" onClick="javascript:cancelAction();" style="margin-right: 10px;"><i class="fa fa-undo"></i> Retornar</button>
                                              	<button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Guardar</button>
											  	</div>
											    <input name="newbutton" type="hidden" id="newbutton" value="save">
											    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
											    <span class="form-actions right" style=" margin-top:100px;">
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
			window.location = 'payment-hc-docs.php';
		}
}

function justNumbers(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }

function commas(unformatedAmmount){
    
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
	
function deleteRow(id){
	//document.getElementById("roc"+id).style.display = 'none';
	var node = document.getElementById("roc"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}

var roci = <?php if($roci > 0){ echo $roci; } else{ echo '1'; } ?>;

function addroc(){
	
	var selectoR =  document.getElementsByName('pertot');
	for (var i = 0, length = selectoR.length; i < length; i++) {
		if (selectoR[i].checked) {
		if(selectoR[i].value == 1){
			var readOnly1 = "";
			var readOnly2 = "readonly";
		}else{
			var readOnly1 = "readonly";
			var readOnly2 = "";
		}
	}
	}   	 

    var rocboxadd = '<div class="row" id="roc'+roci+'"><div class="col-md-2 "><div class="form-group"><select name="hall[]" class="form-control" id="hall[]"><? echo $strHall; ?></select> </div></div><div class="col-md-2 "><div class="form-group"><input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="" '+readOnly1+'></div></div><div class="col-md-2 "><div class="form-group"><input name="roctoday[]" type="text" class="form-control date-picker" id="roctoday[]" value="" readonly></div></div><div class="col-md-2 "><div class="form-group"><input name="rocamount[]" type="text" class="form-control" id="rocamount[]" value=""  onKeyUp="javascript:calculateTheTotal();" onkeypress="return justNumbers(event);" '+readOnly1+'></div></div><div class="col-md-1"><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+roci+');">-</button></div></div><input type="hidden" name="did[]" id="did[]" value="0"></div>';
    roci++; 
	$("#rocwaiter").append(rocboxadd);  
	
	Metronic.init(); 
	ComponentsPickers.init();

}
 
function calculateTheTotal(){
	
	var tAmount = 0;
	var sizeOf = document.getElementsByName('rocamount[]').length;

	for(i=0;i<sizeOf;i++){
		tAmount += parseFloat(document.getElementsByName('rocamount[]')[i].value);
	}
	document.getElementById('totalbill').value = tAmount;  
  			
}
			
</script>

</body>

</html>
<script type="application/javascript">
	 
function benType2(type){

document.getElementById('client-stage').innerHTML = '<div id="client-stage"><div class="row"><div class="col-md-4"><div class="form-group"><label class="control-label">Tipo de cliente</label><select name="clienttype" class="form-control" id="clienttype" onChange="javascript:clientType(this.value);"><option value="0" selected>Seleccionar</option><option value="1">Persona Natural</option> <option value="2">Persona Jurídica</option> </select></div></div><div class="row"></div><div id="ct_personal" style="display: none;"><div class="col-md-2 "><div class="form-group"><label>Código:</label><div class="input-group"><input name="ccode" type="text" class="form-control" id="ccode" value="" ><span class="input-group-addon"><a href="javascript:benType(1);"><i class="icon-reload"></i></a></span> </div></div></div><div class="col-md-5 "><div class="form-group"><label>Nombres:</label><input name="cfirst" type="text" class="form-control" id="cfirst" value="" readonly > </div></div><div class="col-md-5 "><div class="form-group"><label>Apellidos:</label><input name="clast" type="text" class="form-control" id="clast" value="" readonly > </div></div><div class="col-md-8 "><div class="form-group"><label>Dirección:</label><input name="caddress" type="text" class="form-control" id="caddress" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Ciudad:</label><input name="ccity" type="text" class="form-control" id="ccity" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Cédula:</label><input name="cnid" type="text" class="form-control" id="cnid" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Email:</label><input name="cemail" type="text" class="form-control" id="cemail" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Teléfono:</label><input name="cphone" type="text" class="form-control" id="cphone" value="" readonly > </div></div></div><div id="ct_business" style="display: none;"><div class="col-md-2 "><div class="form-group"><label>Código:</label><div class="input-group"><input name="ccode2" type="text" class="form-control" id="ccode2" value=""><span class="input-group-addon"><a href="javascript:benType(2);"><i class="icon-reload"></i></a></span></div> </div></div><div class="col-md-10 "><div class="form-group"><label>Nombre de la Empresa:</label><input name="cname" type="text" class="form-control" id="cname" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>No. RUC:</label><input name="cruc" type="text" class="form-control" id="cruc" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Email:</label><input name="cemail2" type="text" class="form-control" id="cemail2" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Teléfono:</label><input name="cphone2" type="text" class="form-control" id="cphone2" value="" readonly > </div></div><div class="col-md-8 "><div class="form-group"><label>Dirección:</label><input name="caddress2" type="text" class="form-control" id="caddress2" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Ciudad:</label><input name="ccity2" type="text" class="form-control" id="ccity2" value="" readonly > </div></div><div class="col-md-12"><h4>Información del Representante Legal</h4></div><div class="col-md-6 "><div class="form-group"><label>Nombres:</label><input name="crfirst" type="text" class="form-control" id="crfirst" value="" readonly > </div></div><div class="col-md-6 "><div class="form-group"><label>Apellidos:</label><input name="crlast" type="text" class="form-control" id="crlast" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Cédula:</label><input name="crnid" type="text" class="form-control" id="crnid" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Email:</label><input name="cremail" type="text" class="form-control" id="cremail" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Teléfono:</label><input name="crphone" type="text" class="form-control" id="crphone" value="" readonly > </div></div></div><br></div></div>';
if(type == 1){
	alert('Puede ingresar de nuevo el codigo del Cliente.');
}
if(type == 2){
	alert('Debe de ingresar un codigo.');
}

}
	 
function benType(type){

if(type == 1){
	var clientcode = document.getElementById('ccode').value; 
}else if(type == 2){
	var clientcode = document.getElementById('ccode2').value; 
}

if(clientcode == ""){
	alert('Usted debe de ingresar un codigo.');
}else{

$.post("payment-order-refund-clients-reload.php", { thetype: type, thecode: clientcode }, function(data){
	//alert(data); 
    document.getElementById('client-stage').innerHTML = data;
   
});

}
	
}

</script>

<script>
function validateForm(){ 

} 

</script>