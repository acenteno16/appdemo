<?php 

include("session-admin.php"); 

$id = $_GET['id'];

$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if($_SESSION['admin'] != "active"){
	header('location: dashboard.php');
	exit();
}

$typeinc = 0;
	
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

										<form name="porder" id="porder" action="payment-order-repair-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        

											<?php 
											
									include("stage-main.php");
									include("stage-status.php"); 
									 
									?>
                                                                                            <div id="row"><div class="col-md-12 ">
													  <div class="form-group">
														<label>Notas del Solicitante:</label>
                                                        <textarea name="notes" rows="2" class="form-control" id="notes"><?php echo $rowpconfirm['notes']; ?></textarea>
	
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        
                                                      <!--/row--></div>
													</div></div>
                                                    <div id="row"><div class="col-md-12 ">
													  <div class="form-group">
														<label>Notas de reparación de solicitud:</label>
                                                        <textarea name="notesrep" rows="2" class="form-control" id="notes"></textarea>
	
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        
                                                      <!--/row--></div>
													</div></div> 

<br><br><br><br><br>
											<div class="form-actions right" style=" margin-top:100px;">

												<button type="button" class="btn default" onClick="javascript:cancelAction();"><i class="fa fa-undo"></i> Retornar</button>

										 <?php /*<button name="draft" id="draft" type="button" class="btn blue" onClick="javascript:saveDraft();"><i class="fa fa-save"></i> Guardar Borrador</button>*/ ?> 
                                              <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Reparar</button>
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


function reloadsconcept(nid,i){		
	$.post("reload-sconcepts.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept_"+i).innerHTML = data;
	});
	reloadsconcept2(0,i);
}

function reloadsconcept2(nid,i){		
	$.post("reload-sconcepts2.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept2_"+i).innerHTML = data;
	});
	
}



function help1(){
	alert('Si el monto no coinside con la cantidad en letras utilize esta opción.');
}


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

function clear1(){
	document.getElementById("retention1").value = ""; 
}
function clear2(){
	document.getElementById("retention2").value = "";
}



function deleteRow(id){
	//document.getElementById("distribution"+id).style.display = 'none';
	var node = document.getElementById("distribution"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}


function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}


function validateForm(){ 

reloadNumbers();
	
	var provider = document.getElementById("provider").value;
	var recipient = document.getElementById("dspayment").value; 
	var collaborator = document.getElementById("collaborator").value; 

if(recipient == 0){
	document.getElementById("dspayment").focus(); 
	alert('Usted debe de seleccionar el tipo de beneficiario.');
	return false;
}
if(recipient == 1){ 

	if(provider == 0){
		document.getElementById("provider").focus();
		alert('Usted debe de seleccionar un proveedor.');
		return false;
	} 

}
if(recipient == 2){
	
	if(collaborator == 0){
		document.getElementById("collaborator").focus();
		alert('Usted debe de seleccionar un colaborador.');
		return false;
	} 
	
}
		
		var description = document.getElementById("description").value;
		if(description == ""){
		document.getElementById("description").focus();
		alert('Usted debe de ingresar una descripcion del pago.');
		return false;
		}
	
		i=0;
		for (var obj in document.getElementsByName('type[]')){
 		if (i<document.getElementsByName('type[]').length){
		currenttype =  document.getElementsByName('type[]')[i].value;
		
		if(currenttype == 0){
			document.getElementsByName('type[]')[i].focus();
			alert('Usted debe de seleccionar un tipo de pago.');
			return false;
		}
		//
		currentconcept =  document.getElementsByName('concept[]')[i].value;
		if(currentconcept == 0){
			document.getElementsByName('concept[]')[i].focus();
			alert('Usted debe de seleccionar un concepto de pago.');
			return false;
		}
		
		//
		currentconcept2 =  document.getElementsByName('concept2[]')[i].value;
		if(currentconcept2 == 0){
			document.getElementsByName('concept2[]')[i].focus();
			alert('Usted debe de seleccionar una categoria de pago.');
			return false;
		}
}
i++;
}
 
		
		i=0;
		for (var obj in document.getElementsByName('bill[]')){
 		if (i<document.getElementsByName('ammount[]').length){
		cbill =  document.getElementsByName('bill[]')[i].value;
		
		if(recipient == 1){
			if(cbill == ""){
				document.getElementsByName('bill[]')[i].focus();
				alert('Usted debe de ingresar el numero de Documento.');
				return false;
			}
		}
		
		cammount =  document.getElementsByName('ammount[]')[i].value;
		if(cammount == ""){
			document.getElementsByName('ammount[]')[i].focus();
			alert('Usted debe de ingresar el monto de cada Documento.');
			return false;
		}

		cbilldate =  document.getElementsByName('billdate[]')[i].value;
		//Aca necesito la funcion 
		currentconceopt = document.getElementsByName('concept[]')[i].value;
		
		if((cbilldate == "") && (currentconcept != 216)){
			document.getElementsByName('billdate[]')[i].focus();
			alert('Usted debe de ingresar la fecha de cada Documento.');
			return false;
		}


		if(cammount == 0){
			alert('El monto del Documento no puede ser cero.');
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
		
		
		var payment = document.getElementById("payment").value;
	if(payment <= 0){
		alert('No se puede agregar un pago con un monto de 0.00.');
		return false;
		}
		
		//Aqui agregamos una orden que no permita pagar pagos menores que 1001 cordobas 
		var floatpaymentnio = document.getElementById("floatpaymentnio").value;
		/*if((currency <= 2) && (floatpaymentnio < 1001)){
			alert('La solicitu de pago debe de ser mayor a 1001 cordobas o su equivalente en otra moneda.'); 
			return false;
		}*/ 
		
		var retention1 = document.getElementById("retention1").value;
	if(retention1 == ""){
		alert('Ingrese el valor cero si no hay retencion de Alcaldia.');
		return false;
		}
		
		var retention2 = document.getElementById("retention2").value;
	if(retention2 == ""){
		alert('Ingrese el valor cero si no hay retencion de IR');
		return false;
		} 
		
	var i=0;
	var i2=0;
	var i3=0; 
		for (var obj in document.getElementsByName('file[]')){
 		if (i<document.getElementsByName('file[]').length){
		file =  document.getElementsByName('file[]')[i].value;
		
		
		if(!/visor.php/.test(file)){
	
		}else{
			var i2=i2+1;
		}
		
		
	}
	
	i++;
}
if(i2 == 0){
	alert('Usted debe proporcionar al menos un archivo en cada solicitud.');
	return false;
}

		var distributable = document.getElementById('distributable').value;
		var tpercent = 0;
		var tptotal = 0;
		if(distributable == 1){
			i=0; 
			for (var obj in document.getElementsByName('dunit[]')){
 			if (i<document.getElementsByName('dunit[]').length){
		
		
			var vunit =  document.getElementsByName('dunit[]')[i].value;
		
			//Obligar el ingreso de una unidad de negocio
			if(vunit == ''){
				document.getElementsByName('dunit[]')[i].focus();
				alert('Usted debe de ingresar una unidad de negocio.');
				return false; 
			}
			
			//
			var vpercent =  document.getElementsByName('dpercent[]')[i].value;
			var vpercentd =  document.getElementsByName('dpercent[]')[i].readOnly;
			if(vpercentd == false){
			if(vpercent == ''){
			document.getElementsByName('dpercent[]')[i].focus();
			alert('Usted debe de ingresar un porcentaje.');
			return false; 
			}
			} //end false
		
		
			//
			var vtotal =  document.getElementsByName('dtotal[]')[i].value;
			
			var vtotald =  document.getElementsByName('dtotal[]')[i].readOnly;
			if(vtotald == false){
				if(vtotal == ''){
				document.getElementsByName('dtotal[]')[i].focus();
				alert('Usted debe de ingresar un monto.');
				return false;
			}
			} //end flse
		
			var tpercent = parseFloat(tpercent)+parseFloat(vpercent);
			tptotal+=parseFloat(vtotal);
		
		
}
i++;
}

var gstotald = document.getElementById('stotalbill').value;
var gstotald = gstotald.replace(",", "");
var gstotald = parseFloat(gstotald); 
var tptotal = tptotal.toFixed(2)
if(gstotald == tptotal){
	//Do nothing
	
}else{
	var ddiference = parseFloat(gstotald)-parseFloat(tptotal);
	var ddiference = ddiference*-1;
	alert('La distribucion debe de ser sobre el subtotal. Se enconto una diferencia de '+ddiference)
	return false;
}

}

//ROUTES
var theroute = document.getElementById("theroute").value; 

if(theroute == 0){
	document.getElementById("theroute").focus();
	alert('Usted debe de seleccionar una ruta de pago.');
	return false;
}

}

function divRetention(){
	if(document.getElementById('retainer').checked == true){
		document.getElementById('retention1').value = 0; 	
		document.getElementById('retention1ammount').value = 0.00;
		document.getElementById('retention1').readOnly = true;
		document.getElementById('retention2').value = 0;
		document.getElementById('retention2ammount').value = 0.00;
		document.getElementById('retention2').readOnly = true;
		var p1 = 0;
		var p2 = 0; 
	}else{
	document.getElementById('retention1').readOnly = false;
	document.getElementById('retention2').readOnly = false;
	
	
	}
}


function changePertot(onoff){
	i=0; 
		for (var obj in document.getElementsByName('dpercent[]')){
 		if (i<document.getElementsByName('dpercent[]').length){
			
	if(onoff == 2){
	
		document.getElementsByName('dpercent[]')[i].readOnly = true;
		document.getElementsByName('dtotal[]')[i].readOnly = false;
	}
	if(onoff == 1){
		
		document.getElementsByName('dtotal[]')[i].readOnly = true;
		document.getElementsByName('dpercent[]')[i].readOnly = false;
	}
		}
		i++;
		}
}


var distributioni = <?php if($distributioni > 0){ echo $distributioni; } else{ echo '1'; } ?>;


function addDistribution(){
	
	//var account = document.getElementsByName('accounts[]')[0].value;
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

   var distributionboxadd = '<div class="row" id="distribution'+distributioni+'"><div class="col-md-6 "><select name="dunit[]" class="form-control  select2me" id="dunit[]" data-placeholder="Seleccionar..."><option value=""></option><?php $queryproviders = "select * from units";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?><option value="<?php echo $rowproviders['code']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['name']; ?></option><?php } ?></select></div><div class="col-md-2 "><div class="form-group"><input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value=""  onKeyUp="javascript:calculateTheTotal(1);" '+readOnly1+'></div></div> <div class="col-md-2 "><div class="form-group"><input name="dtotal[]" type="text" class="form-control" id="dtotal[]" value="" '+readOnly2+' onKeyUp="javascript:calculateTheTotal(2);" onkeypress="return justNumbers(event);"></div></div> <div class="col-md-2 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+distributioni+');">-</button></div></div><input type="hidden" name="did[]" id="did[]" value="0"></div>'; 
     distributioni++; 
	 $("#distributionwaiter").append(distributionboxadd);  
	 
	 Metronic.init(); 
	 
	 //init metronic core components
	
  
}
 

</script>
<script>
	
	function calculateTheTotal(mySelector,myOutput){ 
	
	
	var mytotalstotal = numberFormat(document.getElementById('stotalbill').value);		

	if(mySelector == 1){
		i=0;
		for (var obj in document.getElementsByName('dpercent[]')){
			if (i<document.getElementsByName('dpercent[]').length){
				thepercent = document.getElementsByName('dpercent[]')[i].value;
				thetotal1 = thepercent/100;
				var thetotal = parseFloat(mytotalstotal)*parseFloat(thetotal1);
				document.getElementsByName('dtotal[]')[i].value = thetotal.toFixed(2); 
				document.getElementsByName('dtotal[]')[i].value = thetotal;   
			} 
			i++;
		    var thetotalpercent = parseFloat(thetotalpercent)+parseFloat(thepercent);	
		}
		if(thetotalpercent > 100){
			alert('La distribucion no puede ser mayor a 100%.');
		}
	}
		
	if(mySelector == 2){
		i=0;
		for (var obj in document.getElementsByName('dpercent[]')){
			if (i<document.getElementsByName('dpercent[]').length){
				theammount = document.getElementsByName('dtotal[]')[i].value;
				
				var thepercent1 = theammount*100;
				var thepercent = thepercent1/mytotalstotal;
				var thepercentround = Math.round(thepercent * 100) / 100; 
				document.getElementsByName('dpercent[]')[i].value = thepercentround;
			}
  			i++;
		}
}
			
}
			
</script>

<?php include('fn-reloadnumbers.php'); ?>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
 <script type="application/javascript">
  
  function reloadRouteView(){
	
	var myroute = document.getElementById('theroute').value; 
   $.post("reload-route.php", { myvariable: myroute, }, function(data){
	
  //alert(data); 
  document.getElementById('routeFill').innerHTML = data;
   
}); 
} 
  </script>
  
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