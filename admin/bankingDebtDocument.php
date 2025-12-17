<?php 

include('session-bankingDebtAdmin.php');  

$id = $_GET['id']; 

$query = "select bankingDebt.*, bankingDebtContracts.bank, bankingDebtContracts.company, bankingDebtContracts.currency from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where bankingDebt.id = '$id'";
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
	//alert(file.name+" | "+file.size+" | "+file.type);
	var lastTransaction = Date.now();
	_('ltransaction').value = lastTransaction;
	if((file.type == 'application/pdf') || (file.type == 'application/kswps')){
		//  
	}
	else{ 
		//alert('El archivo debe de ser PDF. ('+file.type+')'); 
		//return; 
	}
	//2015444
	<? if($_SESSION['bigfiles'] == 'active'){ ?>
		//12 MB 
		if(file.size > '10077220'){
		// 8,061,776
		alert('El archivo debe de ser menor que 10 MB.');
		return;  
		}
	<? }else{ ?>
		//6MB
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
	if(theFile == 'amortization'){
		ajax.upload.addEventListener("progress", progressHandler1, false);
		ajax.addEventListener("load", completeHandler1, false);
		ajax.addEventListener("error", errorHandler1, false);
		ajax.addEventListener("abort", abortHandler1, false);
	}else if(theFile == 'bankingmovement'){
		ajax.upload.addEventListener("progress", progressHandler2, false);
		ajax.addEventListener("load", completeHandler2, false);
		ajax.addEventListener("error", errorHandler2, false);
		ajax.addEventListener("abort", abortHandler2, false);
	}
	ajax.open("POST", "files-upload.php");
	ajax.send(formdata);
}
function progressHandler1(event){
	_("loaded_n_total1").innerHTML = "Cargado "+event.loaded+" bytes de "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar1").value = Math.round(percent);
	_("status1").innerHTML = Math.round(percent)+"% Archivo cargado... por favor espere"; 
}
function completeHandler1(event){
	_("status1").innerHTML = event.target.responseText;
	_("progressBar1").value = 0;
	
	var ltransaction = _('ltransaction').value;
	
	$.post("reload-files-bankingDebt.php", { bdid: '<? echo $_GET['id']; ?>', ltransaction: ltransaction }, function(data){
		_('amortizationUrl').value = data;
		_('dAmortizationText').style.display = 'block';
		_('dAmortizationFile').style.display = 'none';

});		 
	
}
function errorHandler1(event){
	_("status1").innerHTML = "Carga de archivo fallida";
}
function abortHandler1(event){
	_("status1").innerHTML = "Carga de archivo cancelada";
}

function progressHandler2(event){
	_("loaded_n_total2").innerHTML = "Cargado "+event.loaded+" bytes de "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar2").value = Math.round(percent);
	_("status2").innerHTML = Math.round(percent)+"% Archivo cargado... por favor espere"; 
}
function completeHandler2(event){
	_("status2").innerHTML = event.target.responseText;
	_("progressBar2").value = 0;
	
	var ltransaction = _('ltransaction').value;

	$.post("reload-files-bankingDebt.php", { bdid: '<? echo $_GET['id']; ?>', ltransaction: ltransaction }, function(data){
		_('bankingmovementUrl').value = data;
		_('dBankingmovementText').style.display = 'block';
		_('dBankingmovementFile').style.display = 'none';
		
	});		 
	
}
function errorHandler2(event){
	_("status2").innerHTML = "Carga de archivo fallida";
}
function abortHandler2(event){
	_("status2").innerHTML = "Carga de archivo cancelada";
}
	
function showFile(val){
	if(val == 'amortization'){
		_('dAmortizationText').style.display = 'none';
		_('dAmortizationFile').style.display = 'block';
		_("status1").innerHTML = "";
		_("loaded_n_total1").innerHTML = "";
		_("amortization").value = "";
	 }
	if(val == 'bankingmovement'){
		_('dBankingmovementText').style.display = 'none';
		_('dBankingmovementFile').style.display = 'block';
		_("status2").innerHTML = "";
		_("loaded_n_total2").innerHTML = "";
		_("bankingmovement").value = "";
	 }
	
}
</script>
<style>
.input-group-btn:not(:first-child):not(:last-child) > .btn {
 width: 1%;
}
</style>	
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

						<li><a href="#">Registro</a></li>

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

										<form name="porder" id="porder" action="bankingDebtDocumentCode.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();"> 
        

											<div class="form-body">

												<h3  class="form-section">Información del desembolso</h3> 

                                                  <? include('bankingStageMain.php'); ?>
												
												 <? include('bankingStageHistory.php'); ?>
												
												<div class="row"></div>
												
												<h3  class="form-section">Documentación</h3> 

      
											  <div class="row">
													
												  <input type="hidden" id="ltransaction" name="ltransaction" value="">
												  
												  <div class="col-md-3">
													  <div class="form-group">
														  <label class="control-label">Tipo de Transacción</label> 
														  <select name="type" class="form-control" id="type" onChange="typeValidation(this.value);">
															  <option value="0" selected>Seleccionar</option>
															  <option value="1" <? if($rowpconfirm['type'] == 1) echo "selected"; ?>>Abono a principal</option>
															  <option value="2" <? if($rowpconfirm['type'] == 2) echo "selected"; ?>>Pago de interés</option>
															  <option value="3" <? if($rowpconfirm['type'] == 3) echo "selected"; ?>>Cancelación de principal</option>
															  <option value="4" <? if($rowpconfirm['type'] == 4) echo "selected"; ?>>Abono de principal + Interés</option>
															  <option value="5" <? if($rowpconfirm['type'] == 5) echo "selected"; ?>>Cancelación de principal e Interés</option>
														  </select> 
													  </div>

													</div>
												  <script>
													  function typeValidation(val){
														  if(val == 0){
															  document.getElementById('damount').readOnly = true;
															  document.getElementById('dinterest').readOnly = true;
														  }else if(val == 1){
															  document.getElementById('damount').readOnly = false;
															  document.getElementById('dinterest').readOnly = true;
															  document.getElementById('dinterest').value = '';
														  }else if(val == 2){
															  document.getElementById('damount').readOnly = true;
															  document.getElementById('damount').value = '';
															  document.getElementById('dinterest').readOnly = false;
														  }else if(val == 3){
															  document.getElementById('damount').readOnly = false;
															  document.getElementById('dinterest').readOnly = true;
															  document.getElementById('dinterest').value = '';
														  }else{
															  document.getElementById('damount').readOnly = false;
															  document.getElementById('dinterest').readOnly = false;
														  }
													  }
												  </script>
												  <div class="col-md-3">
													  <div class="form-group">
														  <label class="control-label">Principal</label> 
														 <input name="damount" type="text" class="form-control" id="damount" value="" readonly>  
													  </div>

													</div>
												  <div class="col-md-3">
													  <div class="form-group">
														  <label class="control-label">Interes</label> 
														 <input name="dinterest" type="text" class="form-control" id="dinterest" value="" readonly>  
													  </div>

													</div>
												  
												   <? #Fecha proximo pagp/Finalizacion ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de proximo pago:</label>
                                                        <input name="date2" type="text" class="form-control date-picker" id="date2" value="" readonly >
                                                        </div>
													</div>
												  
												  <div class="row"></div><br>
												  
												  <div class="col-md-3 ">
													  <div class="form-group">
														  <label>Tabla de amortización:</label>
														  
														  <div class="input-group" id="dAmortizationText" style="display: none;">
															  <input type="text" id="amortizationUrl" name="amortizationUrl" class="form-control" value="" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile('amortization');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														 
														  <div class="input-group" id="dAmortizationFile">
															  <input name="amortization" type="file" class="form-control" id="amortization" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('amortization');"><i class="fa fa-cloud-upload"></i></a>
															  </span>
														  </div><br>
														  
														  <progress id="progressBar1" value="0" max="100" style="width:100%;"></progress><br>
														  <span id="loaded_n_total1"></span><br>
														  <span id="status1"></span>
													  </div>
												  </div>
												  
												  <div class="col-md-3 ">
													  <div class="form-group">
														  <label>Movimiento bancario:</label> 

														   <div class="input-group" id="dBankingmovementText" style="display: none;">
															  <input type="text" id="bankingmovementUrl" name="bankingmovementUrl" class="form-control" value="" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile('bankingmovement');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														  
														  <div class="input-group" id="dBankingmovementFile">
															  <input name="bankingmovement" type="file" class="form-control" id="bankingmovement" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('bankingmovement');"><i class="fa fa-cloud-upload"></i></a>
															  </span> 
														  </div><br>
														  
														  <progress id="progressBar2" value="0" max="100" style="width:100%;"></progress><br>
														  <span id="loaded_n_total2"></span><br>
														  <span id="status2"></span>
													  </div>
												  </div>
												  
												  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Referencia:</label>
                                                        <input name="reference" type="text" class="form-control" id="reference" >
                                                        
                                                      <!--/row--></div>
													</div>
												  
												   <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha Banco:</label>
                                                        <input name="dateBank" type="text" class="form-control date-picker" id="dateBank" readonly>
                                                        
                                                      <!--/row--></div>
													</div>
												  
												</div>    </div>
                                                                                            
                                                                                            
                                                                                        


											<div class="form-actions right" style=" margin-top:10px;">

												<div style="margin-right: 10px;">
												
												
												<button type="button" class="btn default" onClick="javascript:cancelAction();" style="margin-right: 10px;"><i class="fa fa-undo"></i> Retornar</button>
												
										
										
                                              <? //<button name="draft" id="draft" type="button" class="btn blue" onClick="javascript:saveDraft();"><i class="fa fa-save"></i> Guardar Borrador</button> ?>
                                              <? /*<button type="button" class="btn blue" name="print" id="print" onClick="javascript:printLetter();"><i class="fa fa-print"></i> Imprimir Carta</button>
                                              <button type="button" class="btn blue" name="print" id="print" onClick="javascript:printLetter();"><i class="fa fa-print"></i> Imprimir Carta</button>*/ ?><button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Documentar</button>
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

<?php #include("sidebar.php"); ?>

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
	if (confirm("Esta Seguro de cancelar esta documentacion?\n")==true){
			window.location = 'bankingDebt.php';
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

function validateForm(){
	<? if($_SESSION['email'] != 'jairovargasg@gmail.com'){ ?>
	var type = _('type').value;
	if(type == 0){
		alert('Debe de seleccionar un tipo de documentacion.');
		return false;
	}
	var date2 = _('date2').value; 
	if((type == 3) || (type == 5)){
		/*DoNothing*/
	}else{
		if(date2 == ''){
			alert('Debe de ingresar fecha del proximo pago.');
			return false;
		}
	}
	var file1 = _('amortizationUrl').value;
	if(file1 == ''){
		alert('Debe de subir la tabla de amortizacion.');
		return false;
	}
	var file2 = _('bankingmovementUrl').value;
	if(file2 == ''){
		alert('Debe de subir el movimiento bancario.');
		return false;
	}
	var reference = _('reference').value;
	if(reference == ''){
		alert('Ingrese la referencia.');
		_('reference').focus();
		return false;
	}
	<? } ?>
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

<? /*
<script>
(function() {
   //Document.ready equivalent
	reloadRequirements("load");
	<? if($rowpconfirm['client'] != 0){ ?>
	clientType("load");
	benType(<? echo $rowclient['type']; ?>);
	
	<? } ?>
})();
</script>
*/ ?>