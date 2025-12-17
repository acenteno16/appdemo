<?php 

include('session-bankingDebtAccountant.php');    

$id = $_GET['id']; 

$query = "select bankingDebt.*, bankingDebtContracts.bank, bankingDebtContracts.currency, bankingDebtContracts.company from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where bankingDebt.id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result); 
	
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

<script>
function _(el){
	return document.getElementById(el);
}
	
function uploadFile(theFile){
	var file = _(theFile).files[0];
	var lastTransaction = Date.now();
	_('ltransaction').value = lastTransaction;
	if((file.type == 'application/pdf') || (file.type == 'application/kswps')){
		//  
	}else{ 
		//alert('El archivo debe de ser PDF. ('+file.type+')'); 
		//return; 
	}
	<? if($_SESSION['bigfiles'] == 'active'){ ?>
		if(file.size > '10077220'){
		alert('El archivo debe de ser menor que 10 MB.');
		return;  
		}
	<? }else{ ?>
		if(file.size > '6046332'){
		alert('El archivo debe de ser menor que 6 MB.');
		return;  
		}
	<? } ?> 
	var formdata = new FormData();
	formdata.append("file1", file);
	formdata.append("bdstage", lastTransaction);
	formdata.append("bdid", '<? echo $_GET['id']; ?>');
	
	var ajax = new XMLHttpRequest();
	
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	
	ajax.open("POST", "files-upload.php");
	ajax.send(formdata);
}
function progressHandler(event){
	_("loaded_n_total").innerHTML = "Cargado "+event.loaded+" bytes de "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% Archivo cargado... por favor espere"; 
}
function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
	_("progressBar").value = 0;
	
	var ltransaction = _('ltransaction').value;
	
	$.post("reload-files-bankingDebt.php", { bdid: '<? echo $_GET['id']; ?>', ltransaction: ltransaction }, function(data){
		_('nofileUrl').value = data;
		_('nofileText').style.display = 'block';
		_('nofileFile').style.display = 'none';
		_('theBar').style.display = 'none';
});		 
	
}
function errorHandler(event){
	_("status").innerHTML = "Carga de archivo fallida";
}
function abortHandler(event){
	_("status").innerHTML = "Carga de archivo cancelada";
}
function showFile(val){
	_('nofileText').style.display = 'none';
	_('nofileFile').style.display = 'block';
	_("status").innerHTML = "";
	_("loaded_n_total").innerHTML = "";
	_("nofile").value = "";
	_('theBar').style.display = 'block';
}
</script>
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

					Deuda Bancaria

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

						<a href="bankingDebt.php">Deuda Bancaria</a>
                        <i class="fa fa-angle-right"></i>
                        </li>

						<li><a href="#">Contabilización</a></li>

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

										<form name="porder" id="porder" action="bankingDebtRecordCode.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();"> 
        

											<div class="form-body">

											
												
												<h3  class="form-section">Información del desembolso</h3> 
												
												<? include('bankingStageMain.php'); ?>
												
												<div class="row"></div> 

												
														<h3  class="form-section">Documentación</h3> 
												
												<? include('bankingStageDocument.php'); ?>
												
												
												<div>
													<br>
													<h3>Opciones</h3>
													
													<div class="row">
													<div class="col-md-3">

													<div class="form-group">

											 				<label class="control-label">Opción:</label>

													  <select name="sOption" class="form-control" id="sOption" onChange="javascript:divShow(this.value);">
												
														  <option value="1" selected>Contabilizar</option>
														  <? if($row['status2'] == 1.10){ ?>
														  <option value="2">Regresar a Documentación</option>
														  <? }
														  if($row['status2'] == 1){
														  ?> 
														  <option value="3">Anular Desembolso</option>
														  <? } ?>

													  </select>
			
														<script>
															function divShow(approve){
																
																if((approve == 2) || (approve == 3)){
																	document.getElementById("cdiv").style.display = 'block';
																	document.getElementById("ddiv").style.display = 'none';
																}else{
																	document.getElementById("cdiv").style.display = 'none';
																	document.getElementById("ddiv").style.display = 'block';
																}
															}
	
		   												</script>	
														
														
													</div> 
														
														
												  </div>
													</div>
													<div class="row"></div>

												
												</div>
												
												<div id="ddiv">
												
												<h3  class="form-section">Contabilización</h3> 
        
											    <div class="row">
													
												  
 												   <div class="col-md-3 ">
													  <div class="form-group">
														<label>Batch</label>
                                                       <input name="nobatch[]" type="text" class="form-control" id="batch[]" >
													   </div>
													</div>
												  
												   <div class="col-md-3 ">
													  <div class="form-group">
														<label>Documento(s):</label>
                                                        <input name="nodocument[]" type="text" class="form-control" id="document[]" >
													   </div>
													</div>
												  
												    <div class="col-md-4 ">
													  <div class="form-group">
														  <label>Archivo:</label>
														  
														  <div class="input-group" id="nofileText" style="display: none;">
															  <input type="text" id="nofileUrl" name="nofileUrl[]" class="form-control" value="" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile('nofile');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														 
														  <div class="input-group" id="nofileFile">
															  <input name="nofile" type="file" class="form-control" id="nofile" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('nofile');"><i class="fa fa-cloud-upload"></i></a> 
															  </span>
														  </div><br>
														  <div id="theBar">
														  <progress id="progressBar" value="0" max="100" style="width:100%;"></progress><br>
														  <span id="loaded_n_total"></span><br>
														  <span id="status"></span>
														  <input type="hidden" id="ltransaction" name="ltransaction" value="">
														  </div>
													  </div>
												  </div>
												  
												  <div class="col-md-12">
												  <div id="batchwaiter"></div>
												  </div>
												  
												  <div class="row"></div>
												  
												  <div class="col-md-3 ">

													   <button type="button" class="btn blue" onClick="addBatch();">+</button>
													   
												  </div>
											
												  <script type="text/javascript">
var noBatch = 1;
function addBatch(){
	
	var newScript = '<script>function uploadFile'+noBatch+'(theFile){ var file = _(theFile).files[0]; var lastTransaction = Date.now(); _("ltransaction'+noBatch+'").value = lastTransaction; if(file.size > "6046332"){ alert("El archivo debe de ser menor que 6 MB."); return; } var formdata = new FormData(); formdata.append("file1", file); formdata.append("bdstage", lastTransaction); formdata.append("bdid", "<? echo $_GET['id']; ?>"); var ajax = new XMLHttpRequest(); ajax.upload.addEventListener("progress", progressHandler'+noBatch+', false); ajax.addEventListener("load", completeHandler'+noBatch+', false); ajax.addEventListener("error", errorHandler'+noBatch+', false); ajax.addEventListener("abort", abortHandler'+noBatch+', false); ajax.open("POST", "files-upload.php"); ajax.send(formdata); } function progressHandler'+noBatch+'(event){ _("loaded_n_total'+noBatch+'").innerHTML = "Cargado "+event.loaded+" bytes de "+event.total; var percent = (event.loaded / event.total) * 100; _("progressBar'+noBatch+'").value = Math.round(percent); _("status'+noBatch+'").innerHTML = Math.round(percent)+"% Archivo cargado... por favor espere"; } function completeHandler'+noBatch+'(event){ _("status'+noBatch+'").innerHTML = event.target.responseText; _("progressBar'+noBatch+'").value = 0; var ltransaction = _("ltransaction'+noBatch+'").value; $.post("reload-files-bankingDebt.php", { bdid: "<? echo $_GET['id']; ?>", ltransaction: ltransaction }, function(data){ _("nofileUrl'+noBatch+'").value = data;_("nofileText'+noBatch+'").style.display = "block"; _("nofileFile'+noBatch+'").style.display = "none"; _("theBar'+noBatch+'").style.display = "none"; }); }function errorHandler'+noBatch+'(event){ _("status'+noBatch+'").innerHTML = "Carga de archivo fallida"; } function abortHandler'+noBatch+'(event){ _("status'+noBatch+'").innerHTML = "Carga de archivo cancelada"; } function showFile'+noBatch+'(val){ _("nofileText'+noBatch+'").style.display = "none"; _("theBar'+noBatch+'").style.display = "block"; _("nofileFile'+noBatch+'").style.display = "block"; _("status'+noBatch+'").innerHTML = ""; _("loaded_n_total'+noBatch+'").innerHTML = ""; _("nofile'+noBatch+'").value = ""; }<\/script>';
	
	
   var newBatch = '<div class="row" id="batch'+noBatch+'"><div class="col-md-3"><div class="form-group"><input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value=""></div></div><div class="col-md-3 "><div class="form-group"><input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value=""></div></div><div class="col-md-4 "><div class="form-group"> <div class="input-group" id="nofileText'+noBatch+'" style="display: none;"> <input type="text" id="nofileUrl'+noBatch+'" name="nofileUrl[]" class="form-control" value="" readonly> <span class="input-group-addon"> <a href="javascript:showFile'+noBatch+'(\'nofile'+noBatch+'\');"><i class="fa fa-times"></i></a> </span> </div> <div class="input-group" id="nofileFile'+noBatch+'"> <input name="nofile" type="file" class="form-control" id="nofile'+noBatch+'" value=""> <span class="input-group-addon"> <a href="javascript:uploadFile'+noBatch+'(\'nofile'+noBatch+'\');"><i class="fa fa-cloud-upload"></i></a> </span> </div><br> <div id="theBar'+noBatch+'"><progress id="progressBar'+noBatch+'" value="0" max="100" style="width:100%;"></progress><br> <span id="loaded_n_total'+noBatch+'"></span><br> <span id="status'+noBatch+'"></span>  </div> </div> </div><div class="col-md-1 "><div class="form-group"><button type="button" class="btn red" onclick="javascript:deleteRowBatch('+noBatch+');">-</button></div></div>'+newScript+'</div> <input type="hidden" id="ltransaction'+noBatch+'" name="ltransaction'+noBatch+'" value="">';
   
	
	
     noBatch++; 
	 $("#batchwaiter").append(newBatch);

	$("#batchwaiter").append(newScript);
	 Metronic.init(); 
  
}

function deleteRowBatch(id){
	//document.getElementById("distribution"+id).style.display = 'none';
	var node = document.getElementById("batch"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}
</script> 
         

 </div>    
 	
                                                <div class="row"></div>
										 		</div>
												
												<div style="display:none;" id="cdiv">
													
													<h3  class="form-section">Motivo</h3> 
													
													  <div class="form-group">
														<label>Comentarios:</label>
                                                        <textarea name="reason" rows="2" class="form-control" id="reason" placeholder=""></textarea>
														
                                                        <div class="row"></div>
                                                        
                                                      <!--/row--></div>
													</div>
												
												
												</div>
										
											
											
											
											
                                            
											<div class="form-actions right" style=" margin-top:50px;">

											<div style="margin-right: 10px;">
												
												
												<button type="button" class="btn default" onClick="javascript:cancelAction();" style="margin-right: 10px;"><i class="fa fa-times"></i> Cancelar</button>
												<button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-save"></i> Guardar</button>
												
										 	</div>
											<input name="newbutton" type="hidden" id="newbutton" value="save">
											<input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
											</div>

										</form>

										<!-- END FORM-->

									</div>

								</div>

							</div>

							

			<script> 
				
				function cancelAction(){
					if(confirm("Esta Seguro de cancelar?\n")==true){
						window.location = 'bankingDebt.php';
					}
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

function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}
	
	

function validateForm(){
	<? if($_SESSION['email'] != 'jairovargasg@gmail.com'){ ?>
	var sOption = document.getElementById('sOption').value;
	if(sOption == 1){
		for (var i = 0; i < document.getElementsByName('nobatch[]').length; i++) {
		
		batch = document.getElementsByName('nobatch[]')[i].value;	
		if(batch == ''){
			alert('Debe de ingresar el No. Batch.');
			return false;
		}
		nodocument = document.getElementsByName('nodocument[]')[i].value;	
		if(nodocument == ''){
			alert('Debe de ingresar el No. de Documento.');
			return false;
		}
		nofile = document.getElementsByName('nofileUrl[]')[i].value;	
		if(nofile == ''){
			alert('Debe de adjuntar el archivo.');
			return false;
		}
		
	}
	}
	else{
		var reason = document.getElementById('reason').value;
		if(reason.length < 10){
			alert('Los comentarios deben de contener al menos 10 caracteres.');
			return false;
		}
	}
	<? } ?>
	
	
}			
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>