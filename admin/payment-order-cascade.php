<?php 

require("session-request.php");  

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$querypconfirm = "select * from payments where id = ?";
$stmtpconfirm = $con->prepare($querypconfirm);
$stmtpconfirm->bind_param("i", $id);
$stmtpconfirm->execute();
$resultpconfirm = $stmtpconfirm->get_result();
$rowpconfirm = $resultpconfirm->fetch_assoc();


switch($rowpconfirm['type']){
	case 2:
		$pageTitle = 'Pasantes';
		break;
	case 5:
		$pageTitle= 'Colaboradores';
		break;
}

if($rowpconfirm['status'] != 0){
	header('location: dashboard.php');
	exit();
} 

if($rowpconfirm['userid'] != $_SESSION['userid']){
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
	ajax.open("POST", "payment-order-cascade-template-upload.php"); 
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
	var id = 1;
	$.post("paymentOrderCascadeTemplateReload.php", { id: <? echo $_GET['id']; ?> }, function(data){
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

							<a href="#">Solicitudes de pagos (<? echo $pageTitle; ?> Billetera movil)</a>

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

										<form name="porder" id="porder" action="payment-order-cascade-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        

											<div class="form-body">

												<h3 class="form-section">Información de <? echo $pageTitle; ?></h3> 
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
                                                    
<?php
$queryfilemain = "select * from files where payment = '$rowpconfirm[id]' and bill = '0' order by id asc limit 1"; 
$resultfilemain = mysqli_query($con, $queryfilemain);
$rowfilemain = mysqli_fetch_array($resultfilemain);

?>                                                    
                                                    
                                                    <div class="col-md-10 ">
													  <div class="form-group">
														<label>Archivo:</label>
														<input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfilemain['id']; ?>">
														<select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..."> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"<?php if(cleanLink($rowfilemain['link']) == $rowfbox['url']) echo 'selected'; ?>><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>
						
                                                          
                       

    
                                                      <!--/row--></div>
													</div>

													<!--/span-->

												</div>

<h3 class="form-section">Archivo de Plantilla </h3>
		
		<div class="row">  
		
		
		<div class="col-md-3">
													  <div class="form-group">
														<label>Archivo de Plantilla (.xlsx):</label>
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
                                                    
<?php //IVA ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>IVA:</label>
                                                        <input name="totaltax" type="text" class="form-control" id="totaltax" value="0" readonly> 
						
                                                          
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

$querycurrency = "select * from currency limit 1"; 
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
 	
                                                 
                                                 
                                                 
                                                 
                                                       <h3 class="form-section"><a id="files"></a>Archivos adicionales</h3>
                                                  
                                                  <div class="row"><!--/span--> 
                                                  
                                                  <div id="emails">
                                                    <?php 
													
	$queryfile2 = "select * from files where payment = '$rowpconfirm[id]' order by id asc";  
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


<h3  class="form-section">Distribucion del pago</h3> 

<div class="note note-regular">Nota: La distribución del pago es automática.</div>

<div class="row"></div>


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
	
                                                      </div>
													</div></div> 


											<div class="form-actions right" style=" margin-top:100px;">

												<div style="margin-right: 10px;">
													<button type="button" class="btn default" onClick="javascript:cancelAction();" style="margin-right: 10px;"><i class="fa fa-undo"></i> Retornar</button>
                                              		<button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Ingresar</button>
											  	</div>
											    <input name="newbutton" type="hidden" id="newbutton" value="save">
											    <input type="hidden" name="id" id="id" value="<?php echo $rowpconfirm['id']; ?>"> 
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
	
	var template_isset = document.getElementById("template_isset").value;
	if(template_isset != 1){
		alert('Primero debe de subir la plantilla.');
		return false;
	}
	
	var template_err = document.getElementById("template_err").value;
	if(template_err != 0){
		alert('La plantilla presenta errores. Favor corregir y volver a subir.');
		return false;
	}
	
	var description = document.getElementById("description").value;
	if(description == ""){
		document.getElementById("description").focus();
		alert('Usted debe de ingresar una descripcion del pago.');
		return false;
	}
	
	var stotalbill = document.getElementById("stotalbill").value;
	if((stotalbill == '') || (totalbill <= 0)){
		document.getElementById("stotalbill").focus();
		alert('El sub-total no puede ser igual a cero. Debe de subir un archivo para actualizar el monto.');
		return false;
	}
	
	var totalbill = document.getElementById("totalbill").value;
	if((totalbill == '') || (totalbill <= 0)){
		document.getElementById("totalbill").focus();
		alert('El total no debe de ser igual a cero. Debe de subir un archivo para actualizar el monto.');
		return false;
	}
	
	var theroute = document.getElementById("theroute").value; 
	if(theroute == 0){
		document.getElementById("theroute").focus();
		alert('Usted debe de seleccionar una ruta de pago.');
		return false;  
	}
	
	/*

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
		
	var floatpaymentnio = document.getElementById("floatpaymentnio").value;
		
	var retention1 = document.getElementById("retention1").value;
	if(retention1 == ""){
		alert('Ingrese el valor cero si no hay retencion de Alcaldia.');
		return false;
		}
		
		if(retention1 > 1){
		alert('Retencion de Alcaldia no puede ser mayor a 1%.');
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

		
		
		
		//Retenciones Manuales
		
		if(document.getElementById('retainer4').checked == true){
		
			var modrettypesize = document.getElementsByName('modrettype[]').length;
			
			for (i=0;i<=modrettypesize;i++){
 				
		
		
		current_modrettype =  document.getElementsByName('modrettype[]')[i].value;
		
		if(current_modrettype == ""){
			document.getElementsByName('modrettype[]')[i].focus();
			alert('Usted debe de seleccionar un tipo de retencion.');
			return false;
		}
		
		current_modrettoday =  document.getElementsByName('modrettoday[]')[i].value;
		
		if(current_modrettoday == 0){
			document.getElementsByName('modrettoday[]')[i].focus();
			alert('Usted debe de ingresar una fecha para la retencion.');
			return false;
		}
		
		current_modretno =  document.getElementsByName('modretno[]')[i].value;
		
		if(current_modretno == 0){
			document.getElementsByName('modretno[]')[i].focus();
			alert('Usted debe de ingresar un numero de retencion.');
			return false;
		}
		
		current_modretprovider =  document.getElementsByName('modretprovider[]')[i].value;
		
		if(current_modretprovider == 0){
			document.getElementsByName('modretprovider[]')[i].focus();
			alert('Usted debe de ingresar un proveedor para la retrencion.');
			return false;
		}
		
		current_modretaddress =  document.getElementsByName('modretaddress[]')[i].value;
		
		if(current_modretaddress == 0){
			document.getElementsByName('modretaddress[]')[i].focus();
			alert('Usted debe de ingresar una direccion para la retencion.');
			return false;
		}
		
		current_modretruc =  document.getElementsByName('modretruc[]')[i].value;
		
		if(current_modretruc == ""){
			document.getElementsByName('modretruc[]')[i].focus();
			alert('Usted debe de ingresar un RUC para l aretencion.');
			return false;
		}
		
		current_modretnid =  document.getElementsByName('modretnid[]')[i].value;
		
		if((current_modretruc == "") && (current_modretnid == "")){
			document.getElementsByName('modretnid[]')[i].focus();
			alert('Usted debe de ingresar una cedula para la retencion.');
			return false;
		}
		
		
		current_modretphone =  document.getElementsByName('modretphone[]')[i].value;
		
		if(current_modretphone == ""){
			document.getElementsByName('modretphone[]')[i].focus();
			alert('Usted debe de ingresar un no. de telefono para la retencion.');
			return false;
		}
		
		current_modretconcept =  document.getElementsByName('modretconcept[]')[i].value;
		
		if(current_modretconcept == ""){
			document.getElementsByName('modretconcept[]')[i].focus();
			alert('Usted debe de ingresar un concepto para la retencion.');
			return false;
		}
		
		current_modretbills =  document.getElementsByName('modretbills[]')[i].value;
		
		if(current_modretbills == ""){
			document.getElementsByName('modretbills[]')[i].focus();
			alert('Usted debe de ingresar las facturas para la retencion.');
			return false;
		}
		
		current_modrettotalbill =  document.getElementsByName('modrettotalbill[]')[i].value;
		
		if(current_modrettotalbill == ""){
			document.getElementsByName('modrettotalbill[]')[i].focus();
			alert('Usted debe de ingresar el total de las facturas para la retencion.');
			return false;
		}
		
		current_modretpercent =  document.getElementsByName('modretpercent[]')[i].value;
		
		if(current_modretpercent == ""){
			document.getElementsByName('modretpercent[]')[i].focus();
			alert('Usted debe de ingresar un porcentaje de la retencion.');
			return false;
		}
		
		current_modrettotalretention =  document.getElementsByName('modrettotalretention[]')[i].value;
		
		if(current_modrettotalretention == ""){
			document.getElementsByName('modrettotalretention[]')[i].focus();
			alert('Usted debe de ingresar el total de retenciones.');
			return false;
		}
		
		current_modretelaborator =  document.getElementsByName('modretelaborator[]')[i].value;
		
		if(current_modretelaborator == ""){
			document.getElementsByName('modretelaborator[]')[i].focus();
			alert('Usted debe de ingresar quien elaboro la retencion.');
			return false;
		}
		
		/*
		
		current_modret =  document.getElementsByName('modret[]')[i].value;
		
		if(current_modret == ""){
			document.getElementsByName('modret[]')[i].focus();
			alert('Usted debe de ingresar un.');
			return false;
		}
		
		*/ /*
		
		
		
}
			
		} //end manualrets
		
		
		*/
		
		
		//ROUTES
		
	

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