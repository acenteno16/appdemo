<? 

include("session-bankingDebtAdmin.php");  

$id = $_GET['id'];

$query = "select * from bankingDebtContracts where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$edit = 0;

$queryDetail = "select id from bankingDebt where contract = '$id'";
$resultDetail = mysqli_query($con, $queryDetail);
$numDetail = mysqli_num_rows($resultDetail);

if($numDetail == 0){
    $edit = 1; 
}

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

						<li><a href="bankingDebtContracts.php">Contratos</a>
						<i class="fa fa-angle-right"></i></li>
                        
                        <li><a href="bankingDebtContractView.php?id=<? echo $row['id']; ?>">Contrato <? echo $row['number']; ?></a>
						<i class="fa fa-angle-right"></i></li>
						
						<li><a href="#">Editor</a></li>

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->
            
            <? if($edit == 0){ ?>

			<div class="row">

				<div class="col-md-12">
                    
                    <div class="portlet">
                    
                    <div class="portlet-title">

							<div class="caption">

								Información del Contrato
							</div>

							<? /*<div class="actions">
								<a href="bankingDebtContractEdit.php" class="btn default blue-stripe">
								<i class="fa fa-edit"></i>
								<span class="hidden-480">
								Editar</span> 
								</a>
							</div>*/ ?>

						</div>
                    
                    </div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">

							<div class="tab-pane" id="tab_1">

											<div class="form-body">
                                              
												

                                                  <div class="row">
													 
													  <div class="col-md-3"> 

<div class="form-group">
<label class="control-label">Tipo</label> 

<?
	
if($row['type'] == 1){
	$type = 'Linea de crédito revolvente';
}
if($row['type'] == 2){
	$type = 'Linea de crédito a largo plazo';
}
if($row['type'] == 3){
	$type = 'Carta de crédito';
}
if($row['type'] == 4){
	$type = 'Mixto';
}
	
?>
	 <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $type; ?>" readonly>

                                                            

													  </div>

													</div>
													  
								
													  
													    <div class="col-md-9">  <div class="form-group">
									 <label>Titulo:</label>
														
                                    
	 <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $row['title']; ?>" readonly>
                                             </div>
                                        
                                        </div>
													  
													  <div class="row"></div>
	
													  <div id="general">
													  <? #Compañia ?>
													  <div class="col-md-3 ">  <div class="form-group">
									 <label>Compañía:</label>
														  <?
									 	 
									 $querycompanys = "select * from companies where id = '$row[company]'";
									 $resultcompanys = mysqli_query($con, $querycompanys);
									 $rowcompanys=mysqli_fetch_array($resultcompanys);
									 ?>
                                   <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $rowcompanys['name']; ?>" readonly>
                                             </div>
                                        
                                        </div>
													  <? #Banco ?>													                                                  
													  <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Banco:</label>
 <? 
											
											$queryfbanks = "select * from banks where id = '$row[bank]'";
											$resultfbanks = mysqli_query($con, $queryfbanks);
											$rowfbanks=mysqli_fetch_array($resultfbanks);
														  
														  			 if ( $row[ 'currency' ] == 1 ) {
       $thisCurrency = 'Córdobas';
						 $pre = 'C$';
      } elseif ( $row[ 'currency' ] == 2 ) {
        $thisCurrency = 'Dólares';
						 $pre = 'U$';
      }
											
											?>
						 <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $rowfbanks['name']; ?>" readonly>
											

														
													  </div>

													</div>
													  <? #Monto ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $pre.str_replace('.00','',number_format($row['amount'],2)); ?>" readonly>
                                                        

                                                      <!--/row--></div>
													</div>
													  <? #Moneda ?>
													  <div class="col-md-3">

													  <div class="form-group">

													  <label class="control-label">Moneda:</label>

						
											<input name="amount" typse="text" class="form-control" id="amount" value="<? echo $thisCurrency; ?>" readonly >

														
													  </div>

													</div>
													  <? #Fecha de apertura ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de apertura:</label>
                                                        <input name="date1" type="text" class="form-control " id="date1" value="<? echo date("d-m-Y", strtotime($row['date1'])); ?>" readonly >
                                                        </div>
													</div>
													  <? #Fecha proximo pagp/Finalizacion ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de Finalizacion:</label>
                                                        <input name="date2" type="text" class="form-control " id="date2" value="<? echo date("d-m-Y", strtotime($row['date2'])); ?>" readonly >
                                                        </div>
													</div>
													  <? #Numero de prestamo ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. Prestamo/Crédito:</label>
                                                        <input name="number" type="text" class="form-control" id="number" value="<? echo $row['number']; ?>" readonly>
                                                        
                                                      <!--/row--></div>
													</div>
														  
														<div class="row"></div><br>
													    <? #Factura ?>
													    <div class="col-md-3 ">
													  <div class="form-group">
														  <label>PDF contrato:</label>
														  
														  <div class="input-group" >
															  <input type="text" id="billUrl" name="billUrl" class="form-control" value="<? echo $row['contract']; ?>" readonly>
															  <span class="input-group-addon">
																  <a href="<? echo $row['contract']; ?>" target="_blank"><i class="fa fa-search"></i></a>
															  </span>
														  </div>
														 
														 
														  
													  </div>
												  </div>
												
														  
													  </div>
													  
													  
												</div>
                                                
                                                
                                             
											</div>
                                                                                            
                                                                                            
                                                                                        


										

								<div class="form-body">
												
												

											
										
													  
													  
								

								

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
            
            <div class="row">

				<div class="col-md-12">
                    
                    <div class="portlet">
                    
                    <div class="portlet-title">

							<div class="caption">

								Extenciones
							</div>

							<? /*<div class="actions">
								<a href="#" class="btn default blue-stripe">
								<i class="fa fa-edit"></i>
								<span class="hidden-480">
								Agregar extención</span> 
								</a>
							</div>*/ ?>

						</div>
                    
                    </div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">

							<div class="tab-pane" id="tab_1">

											<div class="form-body">
                                              
												<div class="note note-regular">
<div class="row">
<div class="col-md-12">
<form id="ungrouped" name="ungrouped" action="bankingDebtContractExtension.php" enctype="multipart/form-data" method="post" onsubmit="return validateFormExt();">
<input name="form" type="hidden" id="form" value="1">
							
<h4 style="margin-left:15px;">Filtro:</h4><br>

<div class="col-md-3 ">
    <div class="form-group">
        <label>Monto:</label>
        <input name="amount" type="text" class="form-control" id="eAmount" value="<?php //echo $row['amount'];  ?>">
    </div>
</div>
    
<div class="col-md-3 ">
    <div class="form-group">
        <label>Fecha de finalización:</label>
        <input name="date2" type="text" class="form-control date-picker" id="date2" value="<? //if(($row['date2'] != '') and ($row['date2'] != '0000-00-00')) echo date("j-n-Y", strtotime($row['date2'])); ?>" readonly >
    </div>
</div>
    
<div class="col-md-6">
    <div class="form-group">
        <label>Comentarios:</label>
        <input name="comments" type="text" class="form-control" id="eComments" value="">
    </div>
</div>

                             
<div class="row"></div>

<div class="col-md-4">							

	<input type="hidden" id="id" name="id" value="<? echo $id; ?>">
    <button type="submit" class="btn blue"><i class="fa fa-plus"></i> Agregar extensión</button><script>
                            function resetFilter(){
                            
                            window.location = "bankingDebtContracts.php";
							
                            }
                            </script>
												
                 </div>                               
 </form>
</div>
</div>
</div>

                                                  <div class="form-body">
												
												

											
												<h3  class="form-section">Información de extensiones</h3> 


                                              
								
								
								<? 
										$queryDetail = "select * from bankingDebtContractExtensions where bankingDebtContract = '$id'";
										$resultDetail = mysqli_query($con, $queryDetail);
										$numDetail = mysqli_num_rows($resultDetail);
										if($numDetail > 0){ 
										?>
										<table class="table table-striped table-bordered table-hover" id="datatable_orders" style=" width: 100%">
										<thead>
										<tr role="row" class="heading">
										    <th>TID</th>
										    <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Fecha finalización (anterior)</th>
                                            <th>Fecha finalización</th>
                                            <th>Monto (anterior)</th>
                                            <th>Monto</th>
										</tr>
                                        </thead>	
										<? while($rowDetail=mysqli_fetch_array($resultDetail)){ ?>	
										<tr class="">
											<td><? echo $rowDetail['id']; ?></td>
											<td><? echo date("d-m-Y", strtotime($rowDetail['today'])); ?></td>
											<td><? echo date("h:i A", strtotime($rowDetail['totime'])); ?></td>
											<td><? if($rowDetail['date2'] != '0000-00-00') echo date("d-m-Y", strtotime($rowDetail['date2old'])); else echo 'na'; ?></td>
                                            <td><? if($rowDetail['date2'] != '0000-00-00') echo date("d-m-Y", strtotime($rowDetail['date2'])); else echo 'na'; ?></td>
											<td><? if($rowDetail['amount'] != 0) echo $pre.str_replace('.00','',number_format($rowDetail['amountold'],2)); else echo 'na'; ?></td>
                                            <td><? if($rowDetail['amount'] != 0) echo $pre.str_replace('.00','',number_format($rowDetail['amount'],2)); else echo 'na'; ?></td>
										</tr>
                                        <tr>
                                            <td colspan="7"><? echo $rowDetail['comments']; ?></td>
                                        </tr>    
										<? } ?>
										</table>
										
										<? }else{ ?> 
                                                      
                                                      <div class="note note-danger">Nota: No se encontraron extensiones.</div>
                                                      
                                                      
                                                      <? } ?>
													  
													  
								

								

							</div>
                                                
                                                
                                             
											</div>
                                                                                            
                                                                                            
                                                                                        


										

								<div class="form-body">
												
												

											
										
													  
													  
								

								

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
            
            <? }else{ ?>
            
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

										<form name="porder" id="porder" action="bankingDebtContractEditCode.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">  
        

											<div class="form-body">
												
												

											
												<h3  class="form-section">Información del Contrato</h3> 


                                                  <div class="row">
													 
													  <div class="col-md-3"> 

<div class="form-group">
<label class="control-label">Tipo</label> 
<select name="type" class="form-control" id="type" onChange="showThis(this.value);">
<option value="0" selected>Seleccionar</option>
<option value="1" <? if($row['type'] == 1) echo "selected"; ?>>Linea de crédito revolvente</option>
<option value="2" <? if($row['type'] == 2) echo "selected"; ?>>Linea de crédito a largo plazo</option>
<option value="3" <? if($row['type'] == 3) echo "selected"; ?>>Carta de crédito</option>
<option value="4" <? if($row['type'] == 4) echo "selected"; ?>>Mixto</option>
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
                                                        <input name="title" typse="text" class="form-control" id="title" value="<? echo $row['title']; ?>">
                                                        

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
                                     <option value="<? echo $rowcompanys[0]; ?>" <? if($row['company'] == $rowcompanys['id']) echo "selected"; ?>><? echo $rowcompanys['name']; ?></option>  
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
                                            <option value="<? echo $rowfbanks['id']; ?>" <?php if($row['bank'] == $rowfbanks['id']) echo 'selected'; ?>><? echo $rowfbanks['name']; ?></option> 
                                           <? } ?>

											</select>

														
													  </div>

													</div>
													  <? #Monto ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $row['amount']; ?>" onkeypress="return justNumbers(event);">
                                                        
                                                      <!--/row--></div>
													</div>
													  <? #Moneda ?>
													  <div class="col-md-3">

													  <div class="form-group">

													  <label class="control-label">Moneda:</label>

						
											<select name="currency" class="form-control" id="currency">

												<option value="2" selected>Dólares</option> 
												<option value="1" <? if($row['currency'] == 1) echo 'selected'; ?>>Córdobas</option> 
                                           

											</select>

														
													  </div>

													</div>
													  <? #Fecha de apertura ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de apertura:</label>
                                                        <input name="date1" type="text" class="form-control date-picker" id="date1" value="<? if(($row['date1'] != '') and ($row['date1'] != '0000-00-00')) echo date("j-n-Y", strtotime($row['date1'])); ?>" readonly >
                                                        </div>
													</div>
													  <? #Fecha proximo pagp/Finalizacion ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de Finalizacion:</label>
                                                        <input name="date2" type="text" class="form-control date-picker" id="date2" value="<? if(($row['date2'] != '') and ($row['date2'] != '0000-00-00')) echo date("j-n-Y", strtotime($row['date2'])); ?>" readonly >
                                                        </div>
													</div>
													  <? #Numero de prestamo ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. Prestamo/Crédito:</label>
                                                        <input name="number" type="text" class="form-control" id="number" value="<? echo $row['number']; ?>" onkeypress="return justNumbers(event);">
                                                        
                                                      <!--/row--></div>
													</div>
														  
														  <div class="col-md-3 ">  <div class="form-group">
									 <label>Contrato Madre:</label>
                                     <select name="parent" class="form-control" id="parent">
                                      <option value="0" selected>NA - Independiente</option> 
                                     <?
									 	 
									 $queryparent = "select * from bankingDebtContracts";
									 $resultparent = mysqli_query($con, $queryparent);
									 while($rowparent=mysqli_fetch_array($resultparent)){   
									 ?>
                                     <option value="<? echo $rowparent[0]; ?>" <? if($row['parent'] == $rowparent[0]) echo 'selected'; ?>><? echo $rowparent['title'].' - '.$globalCompany[$rowparent['company']].' '.$globalBank[$rowparent['bank']].' '.$globalCurrencySymbol[$rowparent['currency']].number_format($rowparent['amount']); ?></option>  
                                     <? } ?>
                                     </select>
                                             </div>
                                        
                                        </div>
														  
														<div class="row"></div><br>
													    <? #Factura ?>
													    <div class="col-md-3 ">
													  <div class="form-group">
														  <label>PDF contrato:</label>
														  <? if($row['contract'] != ''){ echo $vis1 = 'block'; $vis2 = 'none'; }else{ $vis1 = 'none'; $vis2 = 'block'; } ?>
														  <div class="input-group" id="billText" style="display: <? echo $vis1; ?>;">
															  <input type="text" id="billUrl" name="billUrl" class="form-control" value="<? echo $row['contract']; ?>" readonly>
															  <span class="input-group-addon">
																  <a href="javascript:showFile1('bill');"><i class="fa fa-times"></i></a>
															  </span>
														  </div>
														 
														  <div class="input-group" id="billFile" style="display: <? echo $vis2; ?>">
															  <input name="bill" type="file" class="form-control" id="bill" value="">
															  <span class="input-group-addon">
																  <a href="javascript:uploadFile('bill');"><i class="fa fa-cloud-upload"></i></a>
															  </span>
														  </div><br>
														  
														  <progress id="progressBar1" value="0" max="100" style="width:100%;display: <? echo $vis2; ?>"></progress><br>
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
                                              <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-edit"></i> Editar</button>
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
            
            <? } ?>

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
	
			window.location = 'bankingDebtContractView.php?id=<? echo $_GET['id']; ?>';	
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

function clear1(){
	document.getElementById("retention1").value = ""; 
}

function clear2(){
	document.getElementById("retention2").value = "";
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

function printLetter(){

	var clienttype = document.getElementById("clienttype").value;
	
	var description = document.getElementById("description").value;
	var totalbill = document.getElementById("totalbill").value;
	
	var i = 0;
	var devtype = 0;
	var radios_devtype = document.getElementsByName('devtype');

	for(i=0;i<radios_devtype.length;i++){
 		if (radios_devtype[i].checked){
  			devtype = radios_devtype[i].value;
  			break;
 		}
	}

	var currency = 0;
	var radios_currency = document.getElementsByName('currency');

	for(i=0;i<radios_currency.length;i++){
 		if (radios_currency[i].checked){
  			currency = radios_currency[i].value;
  			break;
 		}
	}


	var strdocuments = "";
	var currenttype = "";
	var currentnumber = "";
	var currenttoday = "";
	var currentamount = "";
	var currentcurrency = "";
	
	var types = "";
	var numbers = "";
	var todays = "";
	var amounts = "";
	var currencys = "";
	
	var rocnumber =  document.getElementsByName('rocnumber[]');

	for(i=0;i<rocnumber.length; i++) { 
		//Reading Values
		currenttype =  document.getElementsByName('roctype[]')[i].value;
		currentnumber = document.getElementsByName('rocnumber[]')[i].value;
		currenttoday = document.getElementsByName('roctoday[]')[i].value;
		currentamount = document.getElementsByName('rocamount[]')[i].value;
		currentcurrency = document.getElementsByName('roccurrency[]')[i].value;
		//Making the vars
		types = types+currenttype+"|||";
		numbers = numbers+currentnumber+"|||";
		todays = todays+currenttoday+"|||";
		amounts= amounts+currentamount+"|||";
		currencys= currencys+currentcurrency+"|||";	
	} 
	 
	strdocuments = "&roctype="+encodeURIComponent(types)+"&rocnumber="+encodeURIComponent(numbers)+"&roctoday="+encodeURIComponent(todays)+"&rocamount="+encodeURIComponent(amounts)+"&roccurrency="+encodeURIComponent(currencys); 
	var theroute = document.getElementById("theroute").value;

	if(clienttype == 1){
		//Si es persona natural
		var ccode = document.getElementById("ccode").value;
		var cfirst = document.getElementById("cfirst").value;
		var clast = document.getElementById("clast").value;
		var caddress = document.getElementById("caddress").value;
		var cnid = document.getElementById("cnid").value;
		var ccity = document.getElementById("ccity").value;
		var cemail = document.getElementById("cemail").value;
		var cphone = document.getElementById("cphone").value; 
		
		window.location = "payment-order-refund-pdf.php?clienttype="+encodeURIComponent(clienttype)+"&ccode="+encodeURIComponent(ccode)+"&cfirst="+encodeURIComponent(cfirst)+"&clast="+encodeURIComponent(clast)+"&caddress="+encodeURIComponent(caddress)+"&cnid="+encodeURIComponent(cnid)+"&ccity="+encodeURIComponent(ccity)+"&cemail="+encodeURIComponent(cemail)+"&cphone="+encodeURIComponent(cphone)+"&devtype="+encodeURIComponent(devtype)+"&description="+encodeURIComponent(description)+"&totalbill="+encodeURIComponent(totalbill)+"&currency="+encodeURIComponent(currency)+"&theroute="+encodeURIComponent(theroute)+strdocuments; 
	}
	if(clienttype == 2){
		//Si es persona juridica
		var ccode2 = document.getElementById("ccode2").value;
		var cname = document.getElementById("cname").value;
		var cruc = document.getElementById("cruc").value;
		var cemail2 = document.getElementById("cemail2").value;
		var cphone2 = document.getElementById("cphone2").value;
		var caddress2 = document.getElementById("caddress2").value;
		var ccity2 = document.getElementById("ccity2").value;
		var crfirst = document.getElementById("crfirst").value;
		var crlast = document.getElementById("crlast").value;
		var crnid = document.getElementById("crnid").value;
		var cremail = document.getElementById("cremail").value;
		var crphone = document.getElementById("crphone").value;
		
		window.location = "payment-order-refund-pdf-enterprise.php?clienttype="+encodeURIComponent(clienttype)+"&ccode2="+encodeURIComponent(ccode2)+"&cname="+encodeURIComponent(cname)+"&cruc="+encodeURIComponent(cruc)+"&cemail2="+encodeURIComponent(cemail2)+"&cphone2="+encodeURIComponent(cphone2)+"&caddress2="+encodeURIComponent(caddress2)+"&ccity2="+encodeURIComponent(ccity2)+"&crfirst="+encodeURIComponent(crfirst)+"&crlast="+encodeURIComponent(crlast)+"&crnid="+encodeURIComponent(crnid)+"&cremail="+encodeURIComponent(cremail)+"&crphone="+encodeURIComponent(crphone)+"&devtype="+encodeURIComponent(devtype)+"&description="+encodeURIComponent(description)+"&totalbill="+encodeURIComponent(totalbill)+"&currency="+encodeURIComponent(currency)+"&theroute="+encodeURIComponent(theroute)+strdocuments;  
	}

	
	
//End of function printLetter() 
}



var roci = <?php if($roci > 0){ echo $roci; } else{ echo '1'; } ?>;
function addroc(){
	
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

   var rocboxadd = '<div class="row" id="roc'+roci+'"><div class="col-md-2 "><div class="form-group"><select name="roctype[]" class="form-control" id="roctype[]"><option value="0" selected>Seleccionar</option><option value="1">ROC</option><option value="2">Factura</option> </select> </div></div><div class="col-md-2 "><div class="form-group"><input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="" onKeyUp="javascript:calculateTheTotal();" '+readOnly1+'></div></div><div class="col-md-2 "><div class="form-group"><input name="roctoday[]" type="text" class="form-control date-picker" id="roctoday[]" value=""  onKeyUp="javascript:calculateTheTotal();" readonly></div></div><div class="col-md-2 "><div class="form-group"><input name="rocamount[]" type="text" class="form-control" id="rocamount[]" value=""  onKeyUp="javascript:calculateTheTotal();" onkeypress="return justNumbers(event);" '+readOnly1+'></div></div><div class="col-md-2 "><div class="form-group"><select name="roccurrency[]" class="form-control" id="roccurrency[]"><option value="0" selected>Seleccionar</option><option value="1">Córdobas</option><option value="2">Dólares</option> </select></div></div><div class="col-md-1 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+roci+');">-</button></div></div><input type="hidden" name="did[]" id="did[]" value="0"></div>'; 
     roci++; 
	 $("#rocwaiter").append(rocboxadd);  
	 
	 Metronic.init(); 
	 ComponentsPickers.init();
	 //init metronic core components
	
  
}
 
		
</script>
    
    
<script>
    
    function validateFormExt(){
        
        var comments = document.getElementById('eComments').value;
        var amount = document.getElementById('eAmount').value;
        
        if(amount < 0){
            if(confirm('Esta ingresando in monto negativo que reducira el techo del contrato. Si es correcto click en aceptar.') == true){
                
            }else{
                return false;
            }
        }
        
        if(comments == ''){
            alert('Debe de ingresar comentarios para grabar la extension.');
            document.getElementById('eComments').focus();
            return false;
        }
        
    }
    
</script>    

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>




