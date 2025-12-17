<?php 

include('session-bankingDebtAdmin.php');
require('functions.php');

	
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
<? 
	
$uploaders = array();
$uploaders[] = '1,bill';
?>	
function _(el){
	return document.getElementById(el);
}
function uploadFile(theFile){
	var file = _(theFile).files[0];
	//alert(file.name+" | "+file.size+" | "+file.type);
	var lastTransaction = Date.now();
	_('ltransaction'+theFile).value = lastTransaction;
	if((file.type == 'application/pdf') || (file.type == 'application/kswps')){
		//  
	}else{ 
		//alert('El archivo debe de ser PDF. ('+file.type+')'); 
		//return; 
	}
	//2015444
		//6MB
		if(file.size > '30231660'){
		alert('El archivo debe de ser menor que 30 MB.');
		return;  
		}
	
	var formdata = new FormData();
	formdata.append("file1", file);
	formdata.append("bdstage", lastTransaction);
	formdata.append("bdid", '<? echo $_GET['id']; ?>');
	
	var ajax = new XMLHttpRequest();
	
	<? for($i=0;$i<sizeof($uploaders);$i++){ $uArr = explode(",", $uploaders[$i]); ?>
	if(theFile == '<? echo $uArr[1]; ?>'){ 
		ajax.upload.addEventListener("progress", progressHandler<? echo $uArr[0]; ?>, false);
		ajax.addEventListener("load", completeHandler<? echo $uArr[0]; ?>, false);
		ajax.addEventListener("error", errorHandler<? echo $uArr[0]; ?>, false);
		ajax.addEventListener("abort", abortHandler<? echo $uArr[0]; ?>, false);
	}
	<? } ?>
	ajax.open("POST", "files-upload.php");
	ajax.send(formdata);
	document.getElementById('bill').value = null; 
}
<? for($i=0;$i<sizeof($uploaders);$i++){ $uArr = explode(",", $uploaders[$i]); ?>	
function progressHandler<? echo $uArr[0]; ?>(event){
	_("loaded_n_total<? echo $uArr[0]; ?>").innerHTML = "Cargado "+event.loaded+" bytes de "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar<? echo $uArr[0]; ?>").value = Math.round(percent);
	_("status<? echo $uArr[0]; ?>").innerHTML = Math.round(percent)+"% Archivo cargado... por favor espere"; 
}
function completeHandler<? echo $uArr[0]; ?>(event){
	_("status<? echo $uArr[0]; ?>").innerHTML = event.target.responseText;
	_("progressBar<? echo $uArr[0]; ?>").value = 0;
	
	var ltransaction = _('ltransaction<? echo $uArr[1]; ?>').value;
	
	$.post("reload-files-bankingDebt.php", { bdid: '<? echo $_GET['id']; ?>', ltransaction: ltransaction }, function(data){
		_('<? echo $uArr[1]; ?>Url').value = data;
		_('<? echo $uArr[1]; ?>Text').style.display = 'block';
		_('<? echo $uArr[1]; ?>File').style.display = 'none';

});		 
	
}
function errorHandler<? echo $uArr[0]; ?>(event){
	_("status<? echo $uArr[0]; ?>").innerHTML = "Carga de archivo fallida";
}
function abortHandler<? echo $uArr[0]; ?>(event){
	_("status<? echo $uArr[0]; ?>").innerHTML = "Carga de archivo cancelada";
}
function showFile<? echo $uArr[0]; ?>(val){
		_('<? echo $uArr[1]; ?>Text').style.display = 'none';
		_('<? echo $uArr[1]; ?>File').style.display = 'block';
		_("status<? echo $uArr[0]; ?>").innerHTML = "";
		_("loaded_n_total<? echo $uArr[0]; ?>").innerHTML = "";
		_("<? echo $uArr[1]; ?>").value = "";
}
<? } ?>	
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
						
						<li>

						<a href="bankingDebtContracts.php">Contatos</a>
                        <i class="fa fa-angle-right"></i>
                        </li>

						<li><a href="#">Agregar</a></li>

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

										<form name="porder" id="porder" action="bankingDebtContractCode.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();"> 
        

											<div class="form-body">
												
												

											
												<h3  class="form-section">Información del Contrato</h3> 


                                                  <div class="row">
													 
													  <div class="col-md-3"> 

<div class="form-group">
<label class="control-label">Tipo</label> 
<select name="type" class="form-control" id="type" onChange="showThis(this.value);">
<option value="0" selected>Seleccionar</option>
<option value="1" <? if($rowpconfirm['type'] == 1) echo "selected"; ?>>Linea de crédito revolvente</option>
<option value="2" <? if($rowpconfirm['type'] == 2) echo "selected"; ?>>Linea de crédito a largo plazo</option>
<option value="3" <? if($rowpconfirm['type'] == 3) echo "selected"; ?>>Carta de crédito</option>
<option value="4" <? if($rowpconfirm['type'] == 4) echo "selected"; ?>>Mixto</option>
</select> 
                                                            

													  </div>

													</div>
													  
													<?  /*  <div class="col-md-3 ">  <div class="form-group">
									 <label>Nuevo:</label>
                                     <select name="isNew" class="form-control" id="isNew" >
                                      <option value="0" selected>Si</option> 
										<option value="1">No</option> 
                                   
                                     </select>
	<script>
	function showThis(val){
		if(val == 1 || val == 2){
			document.getElementById('loansDiv').style.display = 'block';
			document.getElementById('lettersDiv').style.display = 'none';
		}
		else if((val == 3)){
			document.getElementById('lettersDiv').style.display = 'block';
			document.getElementById('loansDiv').style.display = 'none';
		}
		else{
			document.getElementById('loansDiv').style.display = 'none';
			document.getElementById('lettersDiv').style.display = 'none';
		}
	}
	</script>
                                             </div>
                                        
                                        </div> */ ?>
													  
													   <? #Titulo ?>
													  <div class="col-md-9 ">
													  <div class="form-group">
														<label>Titulo:</label>
                                                        <input name="title" typse="text" class="form-control" id="title" value="">
                                                        

                                                      <!--/row--></div>
													</div>
													  
													  <div class="row"></div>
	
													  <div id="general">
													  <? #Compañia ?>
													  <div class="col-md-3 ">  <div class="form-group">
									 <label>Compañía:</label>
                                     <select name="company" class="form-control" id="company">
                                      <option value="" selected>Seleccionar</option> 
                                     <?
									 	 
									 $querycompanys = "select * from companies where active = '1'";
									 $resultcompanys = mysqli_query($con, $querycompanys);
									 while($rowcompanys=mysqli_fetch_array($resultcompanys)){   
									 ?>
                                     <option value="<? echo $rowcompanys[0]; ?>" <? if($_GET['thecompany'] == $rowcompanys['id']) echo "selected"; ?>><? echo $rowcompanys['name']; ?></option>  
                                     <? } ?>
                                     </select>
                                             </div>
                                        
                                        </div>
													  <? #Banco ?>													                                                  
													  <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Banco:</label>

						
											<select name="bank" class="form-control" id="bank">

												<option value="">Todos los Bancos</option> 

                                            <? 
											
											$queryfbanks = "select * from banks order by name";
											$resultfbanks = mysqli_query($con, $queryfbanks);
											while($rowfbanks=mysqli_fetch_array($resultfbanks)){
											
											?>
                                            <option value="<? echo $rowfbanks['id']; ?>" <?php if($_GET['pbank'] == $rowfbanks['id']) echo 'selected'; ?>><? echo $rowfbanks['name']; ?></option> 
                                           <? } ?>

											</select>

														
													  </div>

													</div>
													  <? #Monto ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="amount" typse="text" class="form-control" id="amount" value="" onkeypress="return justNumbers(event);">
                                                        

                                                      <!--/row--></div>
													</div>
													  <? #Moneda ?>
													  <div class="col-md-3">

													  <div class="form-group">

													  <label class="control-label">Moneda:</label>

						
											<select name="currency" class="form-control" id="currency">

												<option value="2" selected>Dólares</option> 
												<option value="1">Córdobas</option> 
                                           

											</select>

														
													  </div>

													</div>
													  <? #Fecha de apertura ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de apertura:</label>
                                                        <input name="date1" type="text" class="form-control date-picker" id="date1" value="" readonly >
                                                        </div>
													</div>
													  <? #Fecha proximo pagp/Finalizacion ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de Finalizacion:</label>
                                                        <input name="date2" type="text" class="form-control date-picker" id="date2" value="" readonly >
                                                        </div>
													</div>
													  <? #Numero de prestamo ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. Prestamo/Crédito:</label>
                                                        <input name="number" type="text" class="form-control" id="number" value="" onkeypress="return justNumbers(event);">
                                                        
                                                      <!--/row--></div>
													</div>
														  
														  <div class="col-md-3 ">  <div class="form-group">
									 <label>Contrato Madre:</label>
                                     <select name="parent" class="form-control" id="parent">
                                      <option value="" selected>NA - Independiente</option> 
                                     <?
									 	 
									 $queryparent = "select * from bankingDebtContracts";
									 $resultparent = mysqli_query($con, $queryparent);
									 while($rowparent=mysqli_fetch_array($resultparent)){   
									 ?>
                                     <option value="<? echo $rowparent[0]; ?>"><? echo $rowparent['title'].' - '.$globalCompany[$rowparent['company']].' '.$globalBank[$rowparent['bank']].' '.$globalCurrencySymbol[$rowparent['currency']].number_format($rowparent['amount']); ?></option>  
                                     <? } ?>
                                     </select>
                                             </div>
                                        
                                        </div>
														  
														<div class="row"></div><br>
													    <? #Factura ?>
													    <div class="col-md-3 ">
													  <div class="form-group">
														  <label>PDF contrato:</label>
														  
														  <div class="input-group" id="billText" style="display: none;">
															  <input type="text" id="billUrl" name="billUrl" class="form-control" value="" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile1('bill');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														 
														  <div class="input-group" id="billFile">
															  <input name="bill" type="file" class="form-control" id="bill" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('bill');"><i class="fa fa-cloud-upload"></i></a>
															  </span>
														  </div><br>
														  
														  <progress id="progressBar1" value="0" max="100" style="width:100%;"></progress><br>
														  <span id="loaded_n_total1"></span><br>
														  <span id="status1"></span>
														  <input type="hidden" id="ltransactionbill" name="ltransactionbill">
													  </div>
												  </div>
												
														  
													  </div>
													  
													  
												</div>
											</div>
                                                                                            
                                                                                            
                                                                                        


											<div class="form-actions right" style=" margin-top:10px;">

												<div style="margin-right: 10px;">
												
												
												<button type="button" class="btn default" onClick="javascript:cancelAction();" style="margin-right: 10px;"><i class="fa fa-undo"></i> Retornar</button>
												
										
										
                                              <? //<button name="draft" id="draft" type="button" class="btn blue" onClick="javascript:saveDraft();"><i class="fa fa-save"></i> Guardar Borrador</button> ?>
                                              <? /*<button type="button" class="btn blue" name="print" id="print" onClick="javascript:printLetter();"><i class="fa fa-print"></i> Imprimir Carta</button>*/ ?>
                                              <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Ingresar</button>
											  </div>
											    <input name="newbutton" type="hidden" id="newbutton" value="save">
											    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
												<input type="hidden" name="uid" id="uid" value="<?php echo uniqid(); ?>">
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
	
	$.ajaxSetup({async:false}); 
	
	var type = _('type').value;
	if(type == 0){
		alert('Debe de seleccionar un tipo de contrato.');
		return false;
	}
	var title = _('title').value;
	if((title == '') || (title == ' ')){
		alert('Debe de ingresar un titulo.');
		_('title').focus();
		return false;
	}
	
	
	
	var company = _('company').value;
	if((company == 0)){
		alert('Debe de ingresar una compania.');
		return false;
	}
	
	var bank = _('bank').value;
	if((bank == '')){
		alert('Debe de ingresar un banco.');
		_('bank').focus();
		return false;
	}
	
	var amount = _('amount').value;
	if((amount == '') || (amount == '0') || (amount <= '0')){
		alert('Ingrese un monto.');
		_('amount').focus();
		return false; 
	}
	
	var currency = _('currency').value;
	if((currency == 0)){
		alert('Debe de ingresar una moneda.');
		_('currency').focus();
		return false;
	}
	
	var date1 = _('date1').value;
	if((date1 == '')){
		alert('Debe de ingresar fecha de apertura.');
		_('date1').focus();
		return false;
	}
	
	var date2 = _('date2').value;
	if((date2 == '')){
		alert('Debe de ingresar fecha de finalizacion.');
		_('date2').focus();
		return false;
	}
	var billUrl = _('billUrl').value;
	if((billUrl == '')){
		alert('Debe de ingresar PDF de contrato.');
		_('billUrl').focus();
		return false;
	}
	
	

	
	 $.ajaxSetup({async:true}); 
	
	<? } ?>
}	

		
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>




