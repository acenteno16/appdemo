<?php

#require('headers.php');
#require("session-bankingDebtAdmin.php");   
 
$allowedRoles = ['admin', 'banks', 'bankingDebt'];
require("sessionCheck.php"); 
require('includes.php');
$requiredFiles = ['general', 'select2', 'datepicker'];

$queryContracts = "select * from bankingDebtContracts order by id desc";
$resultContracts = mysqli_query($con, $queryContracts);
$numContracts = mysqli_num_rows($resultContracts);

if($numContracts == 0){ 
    exit('<script nonce="'.$nonce.'">alert("Debe de agregar al menos un contrato."); window.location = "bankingDebtContract.php";</script>');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Aplicación de Pagos | Casa Pellas S.A.</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link rel="shortcut icon" href="favicon.ico"/>
<?php loadCSS($requiredFiles, $nonce); ?>	
</head>
<script  nonce="<?= $nonce ?>">
<? 
	
$uploaders = array();
$uploaders[] = '1,bill';
$uploaders[] = '2,promissory';
$uploaders[] = '3,amortization';
$uploaders[] = '4,bankingmovement';
$uploaders[] = '5,proforma';
$uploaders[] = '6,swift1';
$uploaders[] = '7,swift2';
$uploaders[] = '8,swift3';
$uploaders[] = '9,commission';
$uploaders[] = '10,letter';
	
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
		alert('El archivo debe de ser PDF. ('+file.type+')'); 
		return; 
	}
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
	//formdata.append("xlsx", '1');  
	
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
    //
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
        document.getElementById('<? echo $uArr[1]; ?>').value = null; 

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
<body class="page-header-fixed page-quick-sidebar-over-content "> 
<?php include("header.php"); ?>
<div class="clearfix"></div>
<div class="page-container">
	<?php include("side.php"); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<h3 class="page-title">Deuda Bancaria</h3>
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
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="tabbable tabbable-custom boxless tabbable-reversed">
							<div class="tab-pane" id="tab_1">
								<div class="portlet box blue">
									<div class="portlet-title"></div>
									<div class="portlet-body form">
										<form name="porder" id="porder" action="bankingDebtOrderCode.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();"> 
											<div class="form-body">
												<h3  class="form-section">Información del desembolso</h3> 
                                                  <div class="row">
													  <div class="col-md-3"> 

<div class="form-group">
<label class="control-label">Contrato</label> 
<select name="contract" class="form-control" id="contract" onChange="getContractInfo(this.value);" disabled>
<option value="0" selected>Seleccionar</option>
<? 
	
	while($rowContracts=mysqli_fetch_array($resultContracts)){
	?>	
<option value="<? echo $rowContracts['id']; ?>"><? echo $rowContracts['id'].' | '.$rowContracts['number'].' | '.$rowContracts['title']; ?></option>
<? } ?>
</select> 
                                                            

													  </div>

													</div>
													  
													  <div class="col-md-3" id="debtType" style="display: none;"> 

<div class="form-group">
<label class="control-label">Tipo</label> 
<select name="type" class="form-control" id="type" onChange="showThis(this.value);">
<option value="0" selected>Seleccionar</option>
<option value="1" <? if($rowpconfirm['type'] == 1) echo "selected"; ?>>Linea de crédito revolvente</option>
<option value="3" <? if($rowpconfirm['type'] == 3) echo "selected"; ?>>Carta de crédito</option>
</select> 
                                                            

													  </div>

													</div>
													  
													  <div class="col-md-3 ">  <div class="form-group">
									 <label>Nuevo:</label>
                                     <select name="isNew" class="form-control" id="isNew" >
                                      <option value="0" selected>Si</option> 
										<option value="1">No</option> 
                                   
                                     </select>
	
                                             </div>
                                        
                                        </div>
													  
													   <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. Desembolso:</label>
                                                        <input name="number" typse="text" class="form-control" id="number" value="">
                                                        

                                                      <!--/row--></div>
													</div>
													  
													  <div class="row"></div>
	
													  <div id="general">
													  <? #Compañia ?>
													  <div class="col-md-3 " style="display: none;">  <div class="form-group">
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
													  <div class="col-md-3" style="display: none;">

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
													  <div class="col-md-3" style="display: none;">

													  <div class="form-group">

													  <label class="control-label">Moneda:</label>

						
											<select name="currency" class="form-control" id="currency">

												<option value="2" selected>Dólares</option> 
												<option value="1">Córdobas</option> 
                                           

											</select>

														
													  </div>

													</div>
													  <? #Fecha de apertura ?>
													  <div class="col-md-3 " style="display: none;">
													  <div class="form-group">
														<label>Fecha de apertura:</label>
                                                        <input name="date1" type="text" class="form-control date-picker" id="date1" value="" readonly >
                                                        </div>
													</div>
													  <? #Fecha proximo pagp/Finalizacion ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de proximo pago:</label>
                                                        <input name="date2" type="text" class="form-control date-picker" id="date2" value="" readonly >
                                                        </div>
													</div>
													  <? /*Numero de prestamo ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. Prestamo/Crédito:</label>
                                                        <input name="number" type="text" class="form-control" id="number" value="" onkeypress="return justNumbers(event);">
                                                        
                                                      <!--/row--></div>
													  </div>*/ ?>
														  
														<div class="row"></div><br>
													 
														<? #Pagare ?>
													    <div class="col-md-3 ">
													  <div class="form-group">
														  <label>Pagaré:</label>
														  
														  <div class="input-group" id="promissoryText" style="display: none;">
															  <input type="text" id="promissoryUrl" name="promissoryUrl" class="form-control" value="" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile2('promissory');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														 
														  <div class="input-group" id="promissoryFile">
															  <input name="promissory" type="file" class="form-control" id="promissory" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('promissory');"><i class="fa fa-cloud-upload"></i></a>
															  </span>
														  </div><br>
														  
														  <progress id="progressBar2" value="0" max="100" style="width:100%;"></progress><br>
														  <span id="loaded_n_total2"></span><br>
														  <span id="status2"></span>
														  <input type="hidden" id="ltransactionpromissory" name="ltransactionpromissory">
													  </div>
												  </div> 
														
														<? #Movimiento bancario ?>
														<div class="col-md-3 ">
													  <div class="form-group">
														  <label>Movimiento bancario:</label> 

														   <div class="input-group" id="bankingmovementText" style="display: none;">
															  <input type="text" id="bankingmovementUrl" name="bankingmovementUrl" class="form-control" value="" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile4('bankingmovement');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														  
														  <div class="input-group" id="bankingmovementFile">
															  <input name="bankingmovement" type="file" class="form-control" id="bankingmovement" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('bankingmovement');"><i class="fa fa-cloud-upload"></i></a>
															  </span> 
														  </div><br>
														  
														  <progress id="progressBar4" value="0" max="100" style="width:100%;"></progress><br>
														  <span id="loaded_n_total4"></span><br>
														  <span id="status4"></span>
														  <input type="hidden" id="ltransactionbankingmovement" name="ltransactionbankingmovement">
													  </div>
												  </div>
														  
														   <? #Referencia ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Referencia:</label>
                                                        <input name="reference" type="text" class="form-control" id="reference" value="">
                                                        
                                                      <!--/row--></div>
													</div>
														  
													  </div>
													  <div id="loansDiv" style="display: none;">
														  <div class="row"></div>
														  <? #Tabla de amortizacion?>
														 <div class="col-md-3 ">
													  <div class="form-group">
														  <label>Tabla de amortizacion:</label>
														  
														  <div class="input-group" id="amortizationText" style="display: none;">
															  <input type="text" id="amortizationUrl" name="amortizationUrl" class="form-control" value="" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile3('amortization');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														 
														  <div class="input-group" id="amortizationFile">
															  <input name="amortization" type="file" class="form-control" id="amortization" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('amortization');"><i class="fa fa-cloud-upload"></i></a>
															  </span>
														  </div><br>
														  
														  <progress id="progressBar3" value="0" max="100" style="width:100%;"></progress><br>
														  <span id="loaded_n_total3"></span><br>
														  <span id="status3"></span>
														  <input type="hidden" id="ltransactionamortization" name="ltransactionamortization">
													  </div>
												  </div> 
														  
													  </div>
													  <div id="lettersDiv" style="display: none;">
														  <div class="row"></div>
														   <div class="col-md-12"><hr></div>
														  
														 <? #proforma de proveedor ?>
														 <div class="col-md-3 ">
													  <div class="form-group">
														  <label>Proforma:</label>
														  
														  <div class="input-group" id="proformaText" style="display: none;">
															  <input type="text" id="proformaUrl" name="proformaUrl" class="form-control" value="" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile5('proforma');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														 
														  <div class="input-group" id="proformaFile">
															  <input name="proforma" type="file" class="form-control" id="proforma" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('proforma');"><i class="fa fa-cloud-upload"></i></a>
															  </span>
														  </div><br>
														  
														  <progress id="progressBar5" value="0" max="100" style="width:100%;"></progress><br>
														  <span id="loaded_n_total5"></span><br>
														  <span id="status5"></span>
														  <input type="hidden" id="ltransactionproforma" name="ltransactionproforma">
													  </div>
												  </div> 
														  
														 <? #swift1 ?>
														 <div class="col-md-3 ">
													  <div class="form-group">
														  <label>Swift de emisión:</label>
														  
														  <div class="input-group" id="swift1Text" style="display: none;">
															  <input type="text" id="swift1Url" name="swift1Url" class="form-control" value="" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile6('swift1');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														 
														  <div class="input-group" id="swift1File">
															  <input name="swift1" type="file" class="form-control" id="swift1" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('swift1');"><i class="fa fa-cloud-upload"></i></a>
															  </span>
														  </div><br>
														  
														  <progress id="progressBar6" value="0" max="100" style="width:100%;"></progress><br>
														  <span id="loaded_n_total6"></span><br>
														  <span id="status6"></span>
														  <input type="hidden" id="ltransactionswift1" name="ltransactionswift1">
													  </div>
												  </div> 
														  
														 <? #swift2 ?>
														 <div class="col-md-3 ">
													  <div class="form-group">
														  <label>Swift de confirmación:</label>
														  
														  <div class="input-group" id="swift2Text" style="display: none;">
															  <input type="text" id="swift2Url" name="swift2Url" class="form-control" value="" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile7('swift2');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														 
														  <div class="input-group" id="swift2File">
															  <input name="swift2" type="file" class="form-control" id="swift2" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('swift2');"><i class="fa fa-cloud-upload"></i></a>
															  </span>
														  </div><br>
														  
														  <progress id="progressBar7" value="0" max="100" style="width:100%;"></progress><br>
														  <span id="loaded_n_total7"></span><br>
														  <span id="status7"></span>
														  <input type="hidden" id="ltransactionswift2" name="ltransactionswift2">
													  </div>
												  </div> 
														 
														 <? #swift3 ?>
														 <div class="col-md-3 ">
													  <div class="form-group">
														  <label>Swift de aviso:</label>
														  
														  <div class="input-group" id="swift3Text" style="display: none;">
															  <input type="text" id="swift3Url" name="swift3Url" class="form-control" value="" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile8('swift3');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														 
														  <div class="input-group" id="swift3File">
															  <input name="swift3" type="file" class="form-control" id="swift3" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('swift3');"><i class="fa fa-cloud-upload"></i></a>
															  </span>
														  </div><br>
														  
														  <progress id="progressBar8" value="0" max="100" style="width:100%;"></progress><br>
														  <span id="loaded_n_total8"></span><br>
														  <span id="status8"></span>
														  <input type="hidden" id="ltransactionswift3" name="ltransactionswift3">
													  </div>
												  </div> 
														 
														 <? #Comisiones ?>
														 <div class="col-md-3 ">
													  <div class="form-group">
														  <label>Comisiones:</label>
														  
														  <div class="input-group" id="commissionText" style="display: none;">
															  <input type="text" id="commissionUrl" name="commissionUrl" class="form-control" value="" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile9('commission');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														 
														  <div class="input-group" id="commissionFile">
															  <input name="commission" type="file" class="form-control" id="commission" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('commission');"><i class="fa fa-cloud-upload"></i></a>
															  </span>
														  </div><br>
														  
														  <progress id="progressBar9" value="0" max="100" style="width:100%;"></progress><br>
														  <span id="loaded_n_total9"></span><br>
														  <span id="status9"></span>
														  <input type="hidden" id="ltransactioncommission" name="ltransactioncommission">
													  </div>
												  </div> 
														  
														 <? #letter ?>
														 <div class="col-md-3 ">
													  <div class="form-group">
														  <label>Carta de cancelación de crédito:</label>
														  
														  <div class="input-group" id="letterText" style="display: none;">
															  <input type="text" id="letterUrl" name="letterUrl" class="form-control" value="" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile10('letter');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														 
														  <div class="input-group" id="letterFile">
															  <input name="letter" type="file" class="form-control" id="letter" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('letter');"><i class="fa fa-cloud-upload"></i></a>
															  </span>
														  </div><br>
														  
														  <progress id="progressBar10" value="0" max="100" style="width:100%;"></progress><br>
														  <span id="loaded_n_total10"></span><br>
														  <span id="status10"></span>
														  <input type="hidden" id="ltransactionletter" name="ltransactionletter">
													  </div>
												  </div> 
														  
														 <div class="row"></div>
														 
														 <? #Proveedor ?>
														 <div class="col-md-3">
															  <div class="form-group">
																  <label class="control-label">Proveedor:</label>
																  <select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">
																	  <option value="">Todos los Proveedores</option>
																	  <?php $queryproviders = "select id, code, name from providers where code > '0' order by name";
																	  $resultproviders = mysqli_query($con, $queryproviders);
																	  while($rowproviders = mysqli_fetch_array($resultproviders)){ ?>
																	  <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option>
																	  <?php } ?>
																  </select>
															  </div>
														  </div>
														 
														 <? #Unidad de negocio?>
														 <div class="col-md-3">
															  <div class="form-group">
																  <label class="control-label">Unidad de negocio:</label>
																  <select name="route" class="form-control  select2me" id="route" data-placeholder="Seleccionar...">
																	  <option value="">Todas las rutas</option>
																	  <?php
																	  $queryroutes = "select code, code2, name from units order by code";
																	  $resultroutes = mysqli_query($con, $queryroutes);
																	  while($rowroutes = mysqli_fetch_array($resultroutes)){ ?>
																	  <option value="<?php if($rowroutes['code2'] > 0){ echo $rowroutes['code2']; }else{ echo $rowroutes["code"]; } ?>"><?php  echo $rowroutes["code"].' | '.$rowroutes["name"]; ?></option>
																	  <?php } ?>
																  </select>
															  </div>
														  </div>
                                                          
                                                           <div class="row"></div>  
                                                          
                                                           
													    
														  
													  </div>
                                                      
                                                      <div class="row"></div><br>
                                                      <div class="col-md-12">
                                                        <h3  class="form-section">Factura(s) y/o Documento(s)</h3> </div>
                                                      
                                                        <?/* #Factura ?>
													    <div class="col-md-3 ">
													  <div class="form-group">
														  <? //<label>Factura:</label> ?>
														  
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
                                                        */ ?>
                                                      
                                                      
                                                      <div class="col-md-12">
												  <div id="billWaiter"></div>
												  </div>
                                                      
                                                       <div class="row"></div>
												  
												  <div class="col-md-3 ">

													   <button type="button" class="btn blue" onClick="addBill();">+</button>
													   
												  </div>
                                                      <script nonce="<?= $nonce ?>" type="text/javascript">
                                                          var noBill = 10;
                                                          function addBill(){ 
                                                              
                                                              var newScript = '<script nonce="<?= $nonce ?>">function uploadFile'+noBill+'(theFile){ var file = _(theFile).files[0]; var lastTransaction = Date.now(); _("ltransaction'+noBill+'").value = lastTransaction; if(file.size > "6046332"){ alert("El archivo debe de ser menor que 6 MB."); return; } var formdata = new FormData(); formdata.append("file1", file); formdata.append("bdstage", lastTransaction); formdata.append("bdid", "<? echo $_GET['id']; ?>"); var ajax = new XMLHttpRequest(); ajax.upload.addEventListener("progress", progressHandler'+noBill+', false); ajax.addEventListener("load", completeHandler'+noBill+', false); ajax.addEventListener("error", errorHandler'+noBill+', false); ajax.addEventListener("abort", abortHandler'+noBill+', false); ajax.open("POST", "files-upload.php"); ajax.send(formdata); document.getElementById("nofile'+noBill+'").value = null;  } function progressHandler'+noBill+'(event){ _("loaded_n_total'+noBill+'").innerHTML = "Cargado "+event.loaded+" bytes de "+event.total; var percent = (event.loaded / event.total) * 100; _("progressBar'+noBill+'").value = Math.round(percent); _("status'+noBill+'").innerHTML = Math.round(percent)+"% Archivo cargado... por favor espere"; } function completeHandler'+noBill+'(event){ _("status'+noBill+'").innerHTML = event.target.responseText; _("progressBar'+noBill+'").value = 0; var ltransaction = _("ltransaction'+noBill+'").value; $.post("reload-files-bankingDebt.php", { bdid: "<? echo $_GET['id']; ?>", ltransaction: ltransaction }, function(data){ _("nofileUrl'+noBill+'").value = data;_("nofileText'+noBill+'").style.display = "block"; _("nofileFile'+noBill+'").style.display = "none"; _("theBar'+noBill+'").style.display = "none"; }); }function errorHandler'+noBill+'(event){ _("status'+noBill+'").innerHTML = "Carga de archivo fallida"; } function abortHandler'+noBill+'(event){ _("status'+noBill+'").innerHTML = "Carga de archivo cancelada"; } function showFile'+noBill+'(val){ _("nofileText'+noBill+'").style.display = "none"; _("theBar'+noBill+'").style.display = "block"; _("nofileFile'+noBill+'").style.display = "block"; _("status'+noBill+'").innerHTML = ""; _("loaded_n_total'+noBill+'").innerHTML = ""; _("nofile'+noBill+'").value = ""; }<\/script>';
                                                              
                                                              var newBill = '<div class="row" id="bill'+noBill+'"><div class="col-md-3"><div class="form-group"> <div class="input-group" id="nofileText'+noBill+'" style="display: none;"> <input type="text" id="nofileUrl'+noBill+'" name="nofileUrl[]" class="form-control" value="" readonly> <span class="input-group-addon"> <a href="javascript:showFile'+noBill+'(\'nofile'+noBill+'\');"><i class="fa fa-times"></i></a> </span> </div> <div class="input-group" id="nofileFile'+noBill+'"> <input name="nofile" type="file" class="form-control" id="nofile'+noBill+'" value=""> <span class="input-group-addon"> <a href="javascript:uploadFile'+noBill+'(\'nofile'+noBill+'\');"><i class="fa fa-cloud-upload"></i></a> </span> </div><br> <div id="theBar'+noBill+'"><progress id="progressBar'+noBill+'" value="0" max="100" style="width:100%;"></progress><br> <span id="loaded_n_total'+noBill+'"></span><br> <span id="status'+noBill+'"></span>  </div> </div> </div><div class="col-md-1 "><div class="form-group"><button type="button" class="btn red" onclick="javascript:deleteRowBill('+noBill+');">-</button></div></div>'+newScript+'</div> <input type="hidden" id="ltransaction'+noBill+'" name="ltransaction'+noBill+'" value="">';
                                                              
                                                              noBill++; 
                                                              $("#billWaiter").append(newBill);
                                                              $("#billWaiter").append(newScript);
                                                              Metronic.init(); 
                                                          }
                                                          function deleteRowBill(id){
                                                              //document.getElementById("distribution"+id).style.display = 'none';
                                                              var node = document.getElementById("bill"+id);
                                                              if (node.parentNode) {
                                                                  node.parentNode.removeChild(node);
                                                              }
                                                          }
                                                      </script>
                                                      
                                                      
												</div>
											</div>
                                                                                            
                                                                                            
                                                                                        


											<div class="form-actions right" style=" margin-top:10px;">

												<div style="margin-right: 10px;">
												
												
											  <a href="bankingDebt.php"><button type="button" class="btn default" style="margin-right: 10px;"><i class="fa fa-undo"></i> Retornar</button></a>
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

							

			<script nonce="<?= $nonce ?>">
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
<?php include("sidebar.php"); ?>
</div>
<?php include("footer.php"); loadJS($requiredFiles, $nonce); ?>
</body>
</html>
<?php include('foot.php'); ?>    
<script nonce="<?= $nonce ?>" type="text/javascript"> 

function getContractInfo(id){		
	$.post("bankingDebtEngine.php", { type: '1', id: id }, function(data){
       
		if(id == 0){
			document.getElementById('debtType').style.display = 'none';
			showThis(0);
		}else{
		if(data.includes("4")){
            showThis(3);
			document.getElementById('debtType').style.display = 'block';
		}else if(data.includes("3")){
			document.getElementById('debtType').style.display = 'none';
			showThis(3);
		}else{
			document.getElementById('debtType').style.display = 'none';
			showThis(1);
		}
		}
	});
	
}

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

function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}

function _(el){
	return document.getElementById(el);
}

function validateForm(){
	<? #if($_SESSION['email'] != 'jairovargasg@gmail.com2'){ ?>
	$.ajaxSetup({async:false}); 
	
	var contract = _('contract').value;
	if(contract == 0){
		alert('Debe de seleccionar un contrato.');
		return false;
	}
	
    var amount = _('amount').value;
	if((amount == 0) || (amount == '')){
		alert('Debe de ingresar un monto.');
		_('amount').focus();
		return false;
	}
	
	/*$.post("bankingDebtEngine.php", { type: 2, id: contract }, function(data){ 
		var thisBalance = parseFloat(data);
		if(amount > thisBalance){
			alert('El monto es mayor al balance del contrato. ('+amount+' > '+data+')');
            return false;
		}
	});*/
	
	
	var date2 = _('date2').value;
	if((date2 == '')){
		alert('Debe de ingresar una fecha.');
		_('date2').focus();
		return false;
	}
	
	/*$.post("bankingDebtEngine.php", { type: 3, id: contract, today: date2 }, function(data){ 
		if(data == 0){
			alert('La fecha es mayor a la vigencia del contrato.');
			_('date2').focus();
			return false;
		}
	});*/
	

	
	
	var file1 = _('promissoryUrl').value;
	if(file1 == ''){
		alert('Debe de subir el pagare.');
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

    
    var amortizationDiv = document.getElementById('loansDiv').style.display;
    if(amortizationDiv == 'block'){
	   var file1 = _('amortizationUrl').value;
	   if(file1 == ''){
		alert('Debe de subir la tabla de amortizacion.');
		return false;
	}
    }
    
    var lettersDiv = document.getElementById('lettersDiv').style.display;
    if(lettersDiv == 'block'){
        var file1 = _('proformaUrl').value;
        if(file1 == ''){
            alert('Debe de subir la proforma.');
            return false;
        }
        var file2 = _('swift1Url').value;
        if(file2 == ''){
            alert('Debe de subir el swift de emisión.');
            return false;
        }
        var file3 = _('swift2Url').value;
        if(file3 == ''){
            alert('Debe de subir el swift de confirmación.');
            return false;
        }
        var file4 = _('swift3Url').value;
        if(file4 == ''){
            alert('Debe de subir el swift de aviso.');
            return false;
        }
        var file5 = _('commissionUrl').value;
        if(file5 == ''){
            alert('Debe de subir el archivo de comisiones.');
            return false;
        }
        var file6 = _('letterUrl').value;
        if(file6 == ''){
            alert('Debe de subir la carta de cancelacion de credito.');
            return false;
        }
    }
    
    
     
    
    
    if(document.getElementsByName('nofileUrl[]').length == 0){
        alert('Debe de adjuntar un arvhivo.');
        return false;
    }
    for(var i=0;i<document.getElementsByName('nofileUrl[]').length;i++){
        
        var thisBill = document.getElementsByName('nofileUrl[]')[i];
        var thisBill2 = document.getElementsByName('nofile[]')[i];
        if(thisBill.value.length < 50){
            alert('Debe de adjuntar un arvhivo.');
            return false;
        }
    }
	
	 $.ajaxSetup({async:true}); 
	
	<? #} ?>
}	
	
function activateForm(){
    
    /*document.getElementById('contract').setAttribute("disabled","disabled");*/
    document.getElementById('contract').removeAttribute("disabled");
    
}	

document.addEventListener("DOMContentLoaded", function() {
    activateForm();
});
	
</script>