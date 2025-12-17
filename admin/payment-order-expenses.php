<?php 

include("session-request.php"); 
require 'functions.php';

$id = isset($_GET['id']) ? sanitizeInput(intval($_GET['id']), $con) : 0;

$querypconfirm = "select * from payments where id = ?";
$stmtpconfirm = $con->prepare($querypconfirm);
$stmtpconfirm->bind_param("i", $id);
$stmtpconfirm->execute();
$resultpconfirm = $stmtpconfirm->get_result();
$rowpconfirm = $resultpconfirm->fetch_assoc();

if($rowpconfirm['status'] != 0){
	//header('location: dashboard.php');
	echo "<script>alert('La solicitud se encuentra en otra etapa.'); window.location='payments.php';</script>";
	exit();
} 

if($rowpconfirm['userid'] != $_SESSION['userid']){
	//header('location: dashboard.php');
	echo "<script>alert('No se reconoce el Usuario.'); window.location='payments.php';</script>";
	exit();
} 

if($rowpconfirm['type'] != '3'){
	//header('location: dashboard.php');
	echo "<script>alert('No se reconoce el tipo de solicitud.'); window.location='payments.php';</script>";
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
<script>
/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	var file = _("file1").files[0];
	//alert(file.name+" | "+file.size+" | "+file.type);
	if((file.type == 'application/pdf') || (file.type == 'application/kswps')){
		//  
	}else{ 
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
		// 8,061,776
		alert('El archivo debe de ser menor que 6 MB.');
		return;  
		}
	<? } ?> 
	var formdata = new FormData();
	formdata.append("file1", file);
	formdata.append("id", <? echo $_GET['id']; ?>);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "payment-order-expenses-template-upload.php"); 
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
	//_("upload_form").reset();
	$.post("payment-order-expenses-template-reload.php?id=<? echo $_GET['id']; ?>", { id: '<? echo $_GET['id']; ?>' }, function(data){ 
		_("templatewaiter").innerHTML = data;  
	});	
	setTimeout(function() { fill_amount(); }, 1000); 
	
	
}
function errorHandler(event){
	_("status").innerHTML = "Carga de archivo fallida";
}
function abortHandler(event){
	_("status").innerHTML = "Carga de archivo cancelada";
}

function fill_amount(){
var template_stotalbill = document.getElementById('template_stotal').value;
	var template_totalbill = document.getElementById('template_total').value;
	//
	document.getElementById('floatstotalbill').value = template_stotalbill;
	document.getElementById('floattotalbill').value = template_totalbill;
	//Float info
	document.getElementById('stotalbill').value = commas(template_stotalbill);
	document.getElementById('totalbill').value = commas(template_totalbill);
}
</script>
</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:reloadRouteView()"> 

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

							<a href="payments.php">Pagos</a>
                             <i class="fa fa-angle-right"></i>
                             </li>

						<li>

							<a href="#">Solicitudes de pagos (Viaticos cuenta bancaria)</a>

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

										<form name="porder" id="porder" action="payment-order-expenses-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        

											<div class="form-body">

												<h3 class="form-section">Información General</h3> 
                                                <div class="row">
                                                <!--/span-->

													<div class="col-md-2">

													  <div class="form-group">

	<label class="control-label">ID de Pago:</label>
										
											  <input name="id" type="text" class="form-control" id="id" value="<?php echo $rowpconfirm['id']; ?>" readonly>  
								
															<div title="Page 5">
															  <div>
															    <div></div>
														      </div>
													    </div>
													  </div>

													</div> 
                                                    
                                                   
                                                    
                                                    

													<!--/span-->

												</div>
												
												<h3  class="form-section">Informacion de Colaboradores</h3> 
<div class="row">

	
	
	
	
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Plantilla</label>

															<select name="template" class="form-control" id="template" onChange="javascript:makeDistributable();">
<option value="0" selected>Seleccionar</option>
<option value="new" <?php if($rowpconfirm['distributable'] == 1) echo 'selected'?>>Nueva Plantilla</option> 
<? 
$query_templates = "select * from templatesexpenses where userid = '$_SESSION[userid]'";
$result_templates = mysqli_query($con, $query_templates);
$inct = 1;
while($row_templates=mysqli_fetch_array($result_templates)){
?>
<option value="<? echo $row_templates['id']; ?>"><? echo $inct." | ".$row_templates['name']; ?></option> 
<?
$inct++;
} ?>
</select> 
                                                            

													  </div>

													</div>
	
	<? /*<div class="col-md-4">

													  <div class="form-group">
														  	<label class="control-label">Incluir montos</label>

														  <input type="checkbox" value="1" name="showAmount" id="showAmount" class="form-control" onChange="javascript:makeDistributable();">
		</div></div>*/ ?> 
	
	<script>
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

   var distributionboxadd = '<div class="row" id="distribution'+distributioni+'"><div class="col-md-6 "><select name="collaborator[]" class="form-control  select2me" id="collaborator[]" data-placeholder="Seleccionar..."><option value=""></option><?php $queryproviders = "select * from workers order by first, last";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?><option value="<?php echo $rowproviders['id']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['first']." ".$rowproviders['last']; ?></option><?php } ?></select></div><div class="col-md-3 "><div class="form-group"><input name="collaborator_ammount[]" type="text" class="form-control" id="collaborator_ammount[]" value=""  onkeypress="return justNumbers(event);" onKeyUp="javascript:calculateTheTotal();" '+readOnly1+'></div></div> <div class="col-md-3 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+distributioni+');">-</button></div></div><input type="hidden" name="did[]" id="did[]" value="0"></div>'; 
     distributioni++; 
	 $("#distributionwaiter").append(distributionboxadd);  
	 
	 Metronic.init(); 
	 
	 //init metronic core components
	
  
}
		
	function makeDistributable(){
	
	var svalue = document.getElementById('template').value;
	var showAmount = 0;
		/*
	if(document.getElementById('showAmount').checked == true){
		//showAmount = 1; 
	}*/ 
	
		//Aqui hacemos el AJAX 
   		$.post("payment-order-expenses-get-template.php", { idt: svalue, showAmount: showAmount }, function(data){
		//alert(data); 
  		document.getElementById('dtemplate').innerHTML = data;
		calculateTheTotal();
		
   		});
	
		
		
		setTimeout(function(){ Metronic.init(); ComponentsPickers.init(); }, 500);
		
}
	


 
function calculateTheTotal(){ 
	
	
	var mytotalstotal = numberFormat(document.getElementById('stotalbill').value);		

		var theammount = 0;
		var thisammount = 0;
		
		for(i=0;i<document.getElementsByName('collaborator_ammount[]').length;i++){
		
				theammount += parseFloat(document.getElementsByName('collaborator_ammount[]')[i].value);
			
			
			
		}
	
		if(theammount > 0){
			//
		}else{
			theammount = 0;
		}
	
		
		document.getElementById('stotalbill').value = theammount;
		document.getElementById('totalbill').value = theammount; 
  			
}
	</script>
                                                 
</div>
<div id="dtemplate">

</div>

<br>
<?php //END OF DISTRIBUTION ?>
<div class="row"></div>



<h3 class="form-section">Archivo de Soporte</h3>
		
		<div class="row">  
		
		
		<div class="col-md-3">
													  <div class="form-group">
														<label>Archivo de Soporte (.xlsx):</label>
                                                  <input name="file1" type="file" class="form-control" id="file1" value=""><br>
                                                   <progress id="progressBar" value="0" max="100" style="width:300px;"></progress><br>
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>											
<div class="row"></div>

						<div class="col-md-2">							
<button type="button" class="btn blue" onclick="uploadFile()"><i class="fa fa-file"> </i>  Cargar archivo de plantilla</button>  
												
                 </div>  
				 <div class="row"></div>
                 <div class="col-md-12">	
                        <h3 id="status"></h3>
  						<p id="loaded_n_total"></p> 
						</div>                              
  


<div class="col-md-12 table-container">
<div class="table-scrollable" id="templatewaiter" name="templatewaiter">
Esperando carga de archivo...<input type="hidden" name="template_isset" id="template_isset" value="0">
                        </div></div>
<div class="row"></div>
<? /*
<div id="ptemplate" class="col-md-12" style="display:block;">
<div class="row">
                                                        
<?php //UNIT ?>
<div class="col-md-6 ">
													  <div class="form-group">
														<label>Colaborador:</label>
                                                       <select name="tcollaborator[]" class="form-control  select2me" id="tcollaborator[]" data-placeholder="Seleccionar..."> 
                                           

											  <option value=""></option>
<?php $queryproviders = "select * from workers order by first, last";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?>
												<option value="<?php echo $rowproviders['code']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['first']; ?></option>
                                                <?php } ?>

												

											</select>
						
           </div>
													</div>
<?php //PERCENT ?>                                                    
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="tammount[]" type="text" class="form-control" id="tammount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal2(1);">                                                        
		
             </div>
													</div> 
<?php //DELETE ?>
<? /*
<div class="col-md-2 "> 
                                                    <div class="form-group">
                                                   		<label>&nbsp;</label><br>
                                                        <button type="button" class="btn red" onClick="javascript:deleteRow(1);">-</button>  </div>
                                                        </div>
*/ ?> 
<? /*
<input type="hidden" name="did[]" id="did[]" value="0"> 
</div>
<div class="row">
<div id="templaterowwaiter"></div>
</div>
<div class="row">
<div class="col-md-1 ">
<button type="button" class="btn blue" onClick="addTemplateRow();">+</button>
 <br><br>&nbsp;
 </div>                         
</div>	
		</div>									</div>									
<script>

var templaterowi = <?php if($templaterowi > 0){ echo $templaterowi; } else{ echo '1'; } ?>;
function addTemplateRow(){
	
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

   var templaterowboxadd = '<div class="" id="templaterow'+templaterowi+'"><div class="col-md-6 "><select name="dunit[]" class="form-control  select2me" id="dunit[]" data-placeholder="Seleccionar..."><option value=""></option><?php $queryproviders = "select * from workers order by first, last";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?><option value="<?php echo $rowproviders['code']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['first']." ".$rowproviders['last']; ?></option><?php } ?></select></div><div class="col-md-2 "><div class="form-group"><input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value=""  onKeyUp="javascript:calculateTheTotal(1);" '+readOnly1+'></div></div> <div class="col-md-2 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteTemplateRow('+templaterowi+');">-</button></div></div><input type="hidden" name="did[]" id="did[]" value="0"></div>'; 
     templaterowi++; 
	 $("#templaterowwaiter").append(templaterowboxadd);  
	 
	 Metronic.init(); 
	 
	 //init metronic core components
	
  
}


function deleteTemplateRow(id){
	//document.getElementById("templaterow"+id).style.display = 'none';
	var node = document.getElementById("templaterow"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}

</script>
      */ ?>
	  </div>
      <? //<h3 class="form-section">Concepto de Pago</h3> ?>
        
												<div class="row">

													

                                    <div class="col-md-12 ">
													  <div class="form-group">
														<label>Descripción:</label>
                                                        <textarea name="description" rows="2" class="form-control" id="description" onFocus="validateFirst();"><?php echo $rowpconfirm['description']; ?></textarea>
<script>
function validateFirst(){
	var recipient = document.getElementById("dspayment").value;
	var provider = document.getElementById("provider").value;
	var collaborator = document.getElementById("collaborator").value;	
	if(recipient == 0){
	document.getElementById("dspayment").focus(); 
	alert('Usted debe de seleccionar el tipo de beneficiario.');
	}
	if((recipient == 1) && (provider == "")){
		document.getElementById("provider").focus(); 
		alert('Usted debe de seleccionar un Proveedor.');
		return false;
	}
	if((recipient == 2) && (collaborator == "")){
		document.getElementById("collaborator").focus(); 
		alert('Usted debe de seleccionar un Colaborador.');
		return false;
	}
}
                    </script>	
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                    

 
 
       
   
          
<div class="row"></div>
                                                   
<?php //MONEDA ?>                                                      
<br>
<div class="col-md-12 ">   <h3 class="form-section">Totales de documentos</h3></div>
<?php //SUBNTOTAL ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Subtotal:</label>
                                                        <input name="stotalbill" type="text" class="form-control" id="stotalbill" value="" readonly>
                                                        <input type="hidden" name="floatstotalbill" id="floatstotalbill" value="">
                                                        <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>             
                                                    

                                                    

                                                    
<?php //TOTAL PAGAR?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="" readonly>
                                                        <input name="floattotalbill" type="hidden" id="floattotalbill" value="">
<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
													<div class="col-md-12"> 
												
 <h3 class="form-section">Moneda</h3>
 
<div class="form-group"> <?php //<label>Moneda:</label> ?>
<div class="radio-list" style="margin-left:30px;">
<?php 

$querycurrency = "select * from currency limit 2"; 
$resultcurrency = mysqli_query($con, $querycurrency);
$checked = 1;
while($rowcurrency=mysqli_fetch_array($resultcurrency)){

?>
                                            <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input type="radio" name="currency" id="currency" onClick="javascript:reloadNumbers();" value="<?php echo $rowcurrency['id']; ?>" <?php if($rowpconfirm['currency'] == 0){ if($checked == 1){ echo 'checked=""'; $checked++; }}else{ 
										  if($rowpconfirm['currency'] == $rowcurrency['id']){
											  echo ' checked';
										  }
										  }?>></span></div> <?php echo $rowcurrency['name']; ?></label>
											                                           <?php } ?> 
											
										</div>
									</div> </div> 
 
 </div>    
 	
                                     
<div class="row"></div>           
                                                 
                                                 
                                                 
                                                       <h3 class="form-section"><a id="files"></a>Archivos adicionales</h3>
                                                  
                                                  <div class="row"><!--/span--> 
                                                  
                                                  <div id="emails">
                                                    <?php 
													
	$queryfile2 = "select * from files where payment = '$_GET[id]' order by id asc";  
	$resultfile2 = mysqli_query($con, $queryfile2);
	$filecount = 0;
	while($rowfile2 = mysqli_fetch_array($resultfile2)){
	$filecount++;
	if($filecount > 1){
		
	?>
                                                     <div class="col-md-10 ">
													  <div class="form-group">
	<input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfile2['id']; ?>">
<select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"<?php if(cleanLink($rowfile2['link']) == $rowfbox['url']) echo 'selected'; ?>><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>   
                                            
<div class="row"></div></div></div> 
                                                        
<?php 
//End while

}
//End if
}
 
?>
                                                     <input type="hidden" name="fileid[]" id="fileid[]" value="0">	
                                                     <div class="col-md-10 ">
													  <div class="form-group">
													    <select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select><br><div class="row"></div></div></div> 
                                                      
                                                    </div>
              <div class="col-md-2 "><button type="button" class="btn blue icn-only" onclick="agregar();"><i class="fa fa-plus"></i></button>
             </div>                        
                                                     
                                   
                                                     
<script type="text/javascript">
var tfile = 1;
function agregar(){ 
	
    campo = '<div id="fid_'+tfile+'"><div class="col-md-10"><input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfile2['id']; ?>"><select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"><option value=""></option><?php $queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc"; $resultfbox = mysqli_query($con, $queryfbox); while($rowfbox=mysqli_fetch_array($resultfbox)){ ?><option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option><?php } ?></select></div><div class="col-md-2 "><button type="button" class="btn red icn-only" onclick="eliminarFile('+tfile+');">-</button></div><div class="row"></div></div><br><br>';  
	
    $("#emails").append(campo);
	tfile++;
	Metronic.init(); 
	
}

function eliminarFile(fid){
	 $('#fid_'+fid).remove(); 
}
</script>
                                              </div>
                                              
                                              
                                         
                                              
                                              
   <div id="dbeneficiarie" style="display:none;">                                              
  <h3 class="form-section"><a id="beneficiaries"></a>Beneficiarios</h3>
  
  <div class="row">
  <div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Lista de Beneficiarios:</label>

															<select name="beneficiarie" class="form-control" id="beneficiarie">
<option value="0" selected>Seleccionar Proveedor</option>
															</select>

													  </div>

													</div>
                                                    </div>
</div>

<div class="row"></div>
<?php 
/*
$queryroutes = "select routes.* from routes inner join usertype on routes.type = usertype.id where routes.worker = '$_SESSION[userid]' and routes.type = 1 order by routes.unit";
//group by routes.unit
$resultroutes = mysqli_query($con, $queryroutes);
$numroutes = mysqli_num_rows($resultroutes);



if($numroutes == 1){
	$rowroutes = mysqli_fetch_array($resultroutes);
	if(strlen($rowroutes['unit']) == 4){
		
		$queryrname = "select * from units where code = '$rowroutes[unit]'";
		$resultrname = mysqli_query($con, $queryrname);
		$rowrname = mysqli_fetch_array($resultrname);
		$thename = $rowrname['name'];
		$thecode = $rowrname['code'];
	
	}else{
	
		$queryrname = "select * from units where code2 = '$rowroutes[unit]'";
		$resultrname = mysqli_query($con, $queryrname);
		while($rowrname = mysqli_fetch_array($resultrname)){
		$thename.=$rowrname['name'];
		$thecode = $rowrname['code2'];
		}
		
		
	
	}
	
	if($rowroutes['headship'] > 0){
		$queryheadship = "select * from headship where id = '$rowroutes[headship]'";
	$resultheadship = mysqli_query($con, $queryheadship);
	$rowheadship = mysqli_fetch_array($resultheadship);
	}
	
	
	//
	?> 

  <h3 class="form-section"><a id="route"></a>Ruta de pago</h3> 
  <p><?php echo $thecode." | ".$thename; if($rowroutes['headship'] > 0){ echo ' > '.$rowheadship['name']; } ?></p>
   <div class="row">
   <div class="col-md-12" id="routeFill" onLoad="javascript:reloadRouteView();"> 
   </div>
   <input name="theroute" type="hidden" id="theroute" value="<?php echo $thecode; ?>,<?php echo $rowroutes['headship']; ?>">  
    </div>
	<?php
}
elseif($numroutes > 1){
	

?>
	  <h3 class="form-section"><a id="route"></a>Ruta de pago</h3>

<div class="row">
 
  <div class="col-md-4">
 

													  <div class="form-group">

														<label class="control-label">Lista de Rutas:</label>  

															<select name="theroute" class="form-control" id="theroute" onchange="javascript:reloadRouteView();"> 
                                                  
<option value="0" selected>Seleccionar</option> 
<?php while($rowroutes=mysqli_fetch_array($resultroutes)){ 
	
	//Special maded 29/Sept 2017
	
	$queryrname = "select * from units where code2 = '$rowroutes[unit]'";
	$resultrname = mysqli_query($con, $queryrname);
	$numrname = mysqli_num_rows($resultrname);
	if($numrname == 0){
		$queryrname = "select * from units where code = '$rowroutes[unit]'";
		$resultrname = mysqli_query($con, $queryrname);
	}
	$thename = "";
	while($rowrname = mysqli_fetch_array($resultrname)){
		$thename.=$rowrname['name']."/";
		$thecode = $rowrname['code2'];
		if($numrname == 0){
			$thecode = $rowrname['code'];
		}
		
	}
	
	$thename = substr($thename,0,-1);
	
	//End Special 
	
	/* Commented 27/Sept 2017
	if(strlen($rowroutes['unit']) == 4){
	
	$queryrname = "select * from units where code = '$rowroutes[unit]'";
	$resultrname = mysqli_query($con, $queryrname);
	$rowrname = mysqli_fetch_array($resultrname);
	$thename = $rowrname['name'];
	$thecode = $rowrname['code'];
		
		
	}
	else{
	
	
		$queryrname = "select * from units where code2 = '$rowroutes[unit]'";
		$resultrname = mysqli_query($con, $queryrname);
		while($rowrname = mysqli_fetch_array($resultrname)){
			$thename.=$rowrname['name']."/";
			$thecode = $rowrname['code2'];
		}		
	}
	*//*
	
	if($rowroutes['headship'] > 0){
		$queryheadship = "select * from headship where id = '$rowroutes[headship]'";
		$resultheadship = mysqli_query($con, $queryheadship);
		$rowheadship = mysqli_fetch_array($resultheadship);
	}
	
?>
<option value="<?php echo $thecode; ?>,<?php echo $rowroutes['headship']; ?>" class="<?php echo $rowpconfirm['route']; ?>" <?php if($thecode == $rowpconfirm['route']) echo 'selected'; ?>><?php echo $thecode." | ".$thename; if($rowroutes['headship'] > 0){ echo ' > '.$rowheadship['name']; } ?></option>
<?php } ?>
															</select>

													  </div>

												
                                                    
 
<br>

												

													</div>
                                             
                                                    
                                                    
  <div class="col-md-8" id="routeFill">
  
  
  </div>
   
                                                
                                                    
                                                    </div>
                                                    
                                                 
                                                 
  
                                                    
                                                
<?php } */ ?>   

<?php 
$queryroutes = "select units.id, units.newCode, units.companyName, units.lineName, units.locationName, routes.headship from routes inner join units on routes.unitid = units.id where routes.worker = '$_SESSION[userid]' and routes.type = '1' and units.active = '1' order by routes.unit";
$resultroutes = mysqli_query($con, $queryroutes);
$numroutes = mysqli_num_rows($resultroutes);
if($numroutes == 1){ ?> 

  <h3 class="form-section"><a id="route"></a>Ruta de pago</h3> 
   <div class="row">
   <div class="col-md-12" id="routeFill" onLoad="javascript:reloadRouteView();"> 
   </div>
   <select name="theroute" class="form-control" id="theroute" style="display: none;"> 
                                                  
	<?php while($rowroutes=mysqli_fetch_array($resultroutes)){ 
		
	$thename = $rowroutes['companyName'].' '.$rowroutes['lineName'].' '.$rowroutes['locationName'];
	$thecode = $rowroutes['id'];
	
	if($rowroutes['headship'] > 0){
		$queryheadship = "select * from headship where id = '$rowroutes[headship]'";
		$resultheadship = mysqli_query($con, $queryheadship);
		$rowheadship = mysqli_fetch_array($resultheadship);
	}
	
?>
<option value="<?php echo $thecode; ?>,<?php echo $rowroutes['headship']; ?>" class="<?php echo $rowpconfirm['route']; ?>" <?php if($thecode == $rowpconfirm['routeid']) echo 'selected'; ?>><?php echo $rowroutes['newCode']." | ".$thename; if($rowroutes['headship'] > 0){ echo ' > '.$rowheadship['name']; } ?></option>
<?php } ?>
															</select> 
    </div>
	<?php
}
elseif($numroutes > 1){ ?>
<h3 class="form-section"><a id="route"></a>Ruta de pago</h3>
<div class="row">
 
  <div class="col-md-4">
 

													  <div class="form-group">

														<label class="control-label">Lista de Rutas:</label>  

															<select name="theroute" class="form-control" id="theroute" onchange="javascript:reloadRouteView();"> 
                                                  
<option value="0" selected>Seleccionar</option> 
<?php while($rowroutes=mysqli_fetch_array($resultroutes)){ 
	
	$thename = $rowroutes['newCode'].' | '.$rowroutes['companyName'].' '.$rowroutes['lineName'].' '.$rowroutes['locationName'];
	$thecode = $rowroutes['id'];
	
	if($rowroutes['headship'] > 0){ 
		$queryheadship = "select * from headship where id = '$rowroutes[headship]'";
		$resultheadship = mysqli_query($con, $queryheadship);
		$rowheadship = mysqli_fetch_array($resultheadship);
	}
	
?>
<option value="<?php echo $thecode; ?>,<?php echo $rowroutes['headship']; ?>" class="<?php echo $rowpconfirm['route']; ?>" <?php if($thecode == $rowpconfirm['route']) echo 'selected'; ?>><?php echo $thename; if($rowroutes['headship'] > 0){ echo ' > '.$rowheadship['name']; } ?></option>
<?php } ?>
															</select>

													  </div>

												
                                                    
 
<br>

												

													</div>
                                             
                                                    
                                                    
  <div class="col-md-8" id="routeFill">
  
  
  </div>
   
                                                
                                                    
                                                    </div>
<?php } ?>   
												

                                                       										<!--/row--><!--/row--></div>
                                                                                            
                                                                                            
                                                                                            <div id="row"><div class="col-md-12 ">
													  <div class="form-group">
														<label>Notas del Solicitante:</label>
                                                        <textarea name="notes" rows="2" class="form-control" id="notes"><?php echo $rowpconfirm['notes']; ?></textarea>
	
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        
                                                      <!--/row--></div>
													</div></div> 


											<div class="form-actions right" style=" margin-top:100px;">

												<div style="margin-right: 10px;">
												
												<button type="button" class="btn default" onClick="javascript:cancelAction();" style="margin-right: 10px;"><i class="fa fa-undo"></i> Retornar</button>

										 <? /*<button name="draft" id="draft" type="button" class="btn blue" onClick="javascript:saveDraft();"><i class="fa fa-save"></i> Guardar Borrador</button>*/ ?>
                                              <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Ingresar</button>
											  </div>
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
			window.location = 'payments.php';
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





			
</script>

<?php include('fn-reloadnumbers.php'); ?>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
<script type="application/javascript">
  function reloadRouteView(){
	var myroute = document.getElementById('theroute').value; 
	var myroute2 = document.getElementById('theroute'); 
	var newcode = myroute2.options[myroute2.selectedIndex].text; 
    $.post("reload-route.php", { myvariable: myroute, newcode: newcode }, function(data){
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
<script>
													function templateFn(val){
														if(val == 1){
															document.getElementById('template_name').readOnly = false;
														}else if(val == 0){
															document.getElementById('template_name').readOnly = true;
															document.getElementById('template_name').value = "";
														}
													}
													</script>