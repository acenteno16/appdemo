<?php 

include("session-frequest.php");  

if(!$_GET['id']){
	$id = 0;
}else{
	$id = $_GET['id'];
}

$queryFunds = "select * from funds where id = '$id'";
$resultFunds = mysqli_query($con, $queryFunds);
$rowFunds = mysqli_fetch_array($resultFunds);

if($rowFunds['status'] != 0){
	//header('location: dashboard.php');
	echo "<script>alert('La solicitud se encuentra en otra etapa.'); window.location='funds-confirmation.php';</script>";
	exit();
} 

if(($rowFunds['userid'] != $_SESSION['userid'])){
	echo "<script>alert('No se reconoce el Usuario.'); window.location='funds-confirmation.php';</script>";
	exit();
} 

$queryclient = "select * from clients where code = '$rowFunds[client]'";
$resultclient = mysqli_query($con, $queryclient);
$rowclient = mysqli_fetch_array($resultclient);

	
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
	if(file.type == 'application/jpg'){
		//  
	}else{ 
		//alert('El archivo debe de ser .jpg. ('+file.type+')'); 
		//return; 
	}
 
	var formdata = new FormData();
    var fileid = "<? echo $id; ?>";
	formdata.append("file1", file);
    formdata.append("fileid", fileid); 
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "funds-confirmation-add-image-upload.php");
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
	
	$.post("funds-confirmation-add-image-reload.php", { fileid: '<? echo $id; ?>' }, function(data){
		
			_("myfiles").innerHTML = data;  
		document.getElementById('dShow').style.display = 'block';
		document.getElementById('dUploader').style.display = 'none';
		
});	
	
}
function errorHandler(event){
	_("status").innerHTML = "Carga de archivo fallida";
}
function abortHandler(event){
	_("status").innerHTML = "Carga de archivo cancelada";
}


</script>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="clientTypeAuto();"> 
	
	<script>
	function clientTypeAuto(){
		var ctype = document.getElementById('clienttype').value;
		
		clientType(ctype);
		
	}
	</script>

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

					Fondos <small>Solicitud de confirmación de fondos</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="funds-confirmation.php">Cofirmacion de fondos</a>
                             <i class="fa fa-angle-right"></i>
                             </li>

						<li>

							<a href="#">Solicitudes de confirmación de fondos</a>

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

										<form name="porder" id="porder" action="funds-confirmation-order-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        

											<div class="form-body">

												<h3 class="form-section">Información General</h3> 
                                                <div class="row">
                                                <!--/span-->

													<div class="col-md-2">

													  <div class="form-group">

	<label class="control-label">ID de Pago:</label>
										
											  <input name="id" type="text" class="form-control" id="id" value="<?php if($id > 0) echo $rowFunds['id']; else echo 'AUTO'; ?>" readonly>  
								
															<div title="Page 5">
															  <div>
															    <div></div>
														      </div>
													    </div>
													  </div>

													</div> 
                                                    
                                                   
                                                    
                                                    

													<!--/span-->

												</div>
												
												<h3  class="form-section">Información del Cliente</h3> 

<div class="row">
                                                   
<div class="col-md-12">
<div class="note note-success">Nota: Los campos Nombres y Apellidos tienes que ser exactos a como aparecen en el documento de identidad presentado.</div>
</div></div>
                                                  
                                                  <div id="client-stage">

                                                  <div class="row">
                                                   
<div class="col-md-4">

<div class="form-group">
<label class="control-label">Tipo de cliente</label>
<select name="clienttype" class="form-control" id="clienttype" onChange="javascript:clientType(this.value);">
<option value="0" selected>Seleccionar</option>
<option value="1" <? if($rowclient['type'] == 1) echo "selected"; ?>>Persona Natural</option> 
<option value="2" <? if($rowclient['type'] == 2) echo "selected"; ?>>Persona Jurídica</option> 
</select>
                                                            

													  </div>

													</div>                                                                     
<div class="row"></div>                                                  
<div id="ct_personal" style="display: none;">
<div class="col-md-2 ">
<div class="form-group">
<label>Código:</label>
<div class="input-group">
<input name="ccode" type="text" class="form-control" id="ccode" value="<? echo $rowclient['code']; ?>" >
<span class="input-group-addon">
<a href="javascript:benType(1);"><i class="icon-reload"></i></a>
											</span> </div>
</div>
</div>
<div class="col-md-5 ">
<div class="form-group">
<label>Nombres:</label>
<input name="cfirst" type="text" class="form-control" id="cfirst" value="" readonly > 
</div>
</div>
<div class="col-md-5 ">
<div class="form-group">
<label>Apellidos:</label>
<input name="clast" type="text" class="form-control" id="clast" value="" readonly > 
</div>
</div>
<div class="col-md-8 ">
<div class="form-group">
<label>Dirección:</label>
<input name="caddress" type="text" class="form-control" id="caddress" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Ciudad:</label>
<input name="ccity" type="text" class="form-control" id="ccity" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Cédula:</label>
<input name="cnid" type="text" class="form-control" id="cnid" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Email:</label>
<input name="cemail" type="text" class="form-control" id="cemail" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Teléfono:</label>
<input name="cphone" type="text" class="form-control" id="cphone" value="" readonly > 
</div>
</div>
</div>
<div id="ct_business" style="display: none;">
<div class="col-md-2 ">
<div class="form-group">
<label>Código:</label>
<div class="input-group">
<input name="ccode2" type="text" class="form-control" id="ccode2" value="<? echo $rowclient['code']; ?>">
<span class="input-group-addon">
<a href="javascript:benType(2);"><i class="icon-reload"></i></a>
											</span> </div>
 
</div>
</div>
<div class="col-md-10 ">
<div class="form-group">
<label>Nombre de la Empresa:</label>
<input name="cname" type="text" class="form-control" id="cname" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>No. RUC:</label>
<input name="cruc" type="text" class="form-control" id="cruc" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Email:</label>
<input name="cemail2" type="text" class="form-control" id="cemail2" value="" readonly > 
</div>
</div>

<div class="col-md-4 ">
<div class="form-group">
<label>Teléfono:</label>
<input name="cphone2" type="text" class="form-control" id="cphone2" value="" readonly > 
</div>
</div>

<div class="col-md-8 ">
<div class="form-group">
<label>Dirección:</label>
<input name="caddress2" type="text" class="form-control" id="caddress2" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Ciudad:</label>
<input name="ccity2" type="text" class="form-control" id="ccity2" value="" readonly > 
</div>
</div>


<div class="col-md-12"><h4>Información del Representante Legal</h4></div>

<div class="col-md-6 ">
<div class="form-group">
<label>Nombres:</label>
<input name="crfirst" type="text" class="form-control" id="crfirst" value="" readonly > 
</div>
</div>
<div class="col-md-6 ">
<div class="form-group">
<label>Apellidos:</label>
<input name="crlast" type="text" class="form-control" id="crlast" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Cédula:</label>
<input name="crnid" type="text" class="form-control" id="crnid" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Email:</label>
<input name="cremail" type="text" class="form-control" id="cremail" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Teléfono:</label>
<input name="crphone" type="text" class="form-control" id="crphone" value="" readonly > 
</div>
</div>

</div>
<br>
</div>
</div>
<div class="row"></div> 

											  <div class="row">


<div class="col-md-12 ">   
<h3 class="form-section">Detalle de fondos</h3></div>
        

<div class="col-md-2 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="amount" type="text" class="form-control" id="amount" value="<? if($rowFunds['amount'] > 0){ echo $rowFunds['amount']; } ?>" onkeypress="return justNumbers(event);">
                                                       

                                                      <!--/row--></div>
													</div>

<div class="col-md-9 "> 	
<div class="form-group"> <label>Moneda:</label>
<div class="radio-list" style="margin-left:30px;">
<?php 

$querycurrency = "select * from currency limit 2"; 
$resultcurrency = mysqli_query($con, $querycurrency);
$checked = 1;
while($rowcurrency=mysqli_fetch_array($resultcurrency)){

?>
                                            <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input name="currency" type="radio" id="currency" value="<?php echo $rowcurrency['id']; ?>" <? if($rowFunds['currency'] == $rowcurrency['id']) echo "checked"; ?> ></span></div> <?php echo $rowcurrency['name']; ?></label>
											                                           <?php } ?> 
											
										</div>
									</div> </div>


													 
 
									


<div class="row"></div>
												  <div class="col-md-2 ">
													  <div class="form-group">
														<label>Fecha del depósito:</label>
                                                        <input name="depositdate" type="text" class="form-control form-control-inline date-picker" id="depositdate" value="<? if($rowFunds['depositdate'] != '0000-00-00'){ echo  date("j-n-Y", strtotime($rowFunds['depositdate'])); } ?>" readonly>
                                                       

                                                      <!--/row--></div>
													</div>

												  
												  <? /*<div class="col-md-2 ">
													  <div class="form-group">
														<label>Forma de Pago:</label>
                                                        <select name="method" class="form-control" id="method" onChange="showorhide(this.value);">
<option value="0" selected>Seleccionar</option>

<option value="1" <? if($rowrefund['method'] == 1) echo "selected"; ?>>Efectivo</option> 
<option value="2" <? if($rowrefund['method'] == 2) echo "selected"; ?>>Tarjeta de Crédito/Débito</option> 
<option value="3" <? if($rowrefund['method'] == 3) echo "selected"; ?>>Transferencia Bancaria</option>

</select>                                                        
		
		</div></div>*/ ?>
												  
												  <div class="col-md-2 ">
													  <div class="form-group">
														<label>Compañía:</label>
                                                        <select name="company" class="form-control" id="company">
<option value="0" selected>Seleccionar</option>
<? 
$queryCompaies = "select * from companies order by name";
$resultCompaies = mysqli_query($con, $queryCompaies);
while($rowCompaies=mysqli_fetch_array($resultCompaies)){ ?>
<option value="<? echo $rowCompaies['id']; ?>" <? if($rowFunds['bank'] == $rowCompaies['id']) echo "selected"; ?>><? echo $rowCompaies['name']; ?></option> 
<? } ?>
</select>                                                        
		
             </div>
													</div>
												  
												  <div class="col-md-2 ">
													  <div class="form-group">
														<label>Banco:</label>
                                                        <select name="bank" class="form-control" id="bank">
<option value="0" selected>Seleccionar</option>
<? 
$querybanks = "select * from banks order by name";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){ ?>
<option value="<? echo $rowbanks['id']; ?>" <? if($rowFunds['bank'] == $rowbanks['id']) echo "selected"; ?>><? echo $rowbanks['name']; ?></option> 
<? } ?>
</select>                                                        
		
             </div>
													</div>

												  
												  <div class="row"></div>
												        <div class="col-md-12 ">
													  <div class="form-group">
														<label>Comentarios:</label>
                                                        <textarea name="comments" rows="2" class="form-control" id="comments"><?php echo $rowFunds['comments']; ?></textarea> 
	
                                                          
                   </div>
													</div>
                                    
												  
												     
     
 </div>    
 	
                                            
                                                       
                                                     <? //  <h3 class="form-section"><a id="files"></a>Archivos</h3> ?>
												<? 
												
												$imageDisplay = "block";
												$imageDisplay2 = "none";
												if(file_exists('../../funds/'.$id.'.jpg')){
													$imageDisplay = "none";
													$imageDisplay2 = "block";
												}
												?>
												
												
												<div class="row" id="dUploader" style="display: <? echo $imageDisplay; ?>;">
                                                       
													  <div class="col-md-3">
													  <div class="form-group">
														<label>Imágen:</label>
                                                  <input name="file1" type="file" class="form-control" id="file1" value="">
                                                  <input name="product" type="hidden" id="product" value="<? echo $row[0]; ?>">
                                                  <br>
                                                   <progress id="progressBar" value="0" max="100" style="width:300px;"></progress><br>
                                             
                      </div>
													</div>
													
													
												
												<div class="row"></div>
													<div class="col-md-2">							
														<button type="button" class="btn blue" onclick="uploadFile()"><i class="fa fa-file"> </i>  Subir imágen</button>  
													</div>   
												</div>
												
												<div class="row" id="dShow" style="display: <? echo $imageDisplay2; ?>;">
													
  <div class="col-md-12" >
  <p id="status"></p>
  <p id="loaded_n_total"></p>  
  <p id="myfiles" >
	<? if(file_exists('../../funds/'.$id.'.jpg')){ ?>
   <a href="javascript:deleteImage(<? echo $rowimages['id']; ?>);" style="color:#F2070B;">[Remplazar imágen]</a> <br>
  <img src="eimage.php?key=<? echo base64_encode($id); ?>" width="500px;"> 
  <? } ?>

  </p>
													</div>
                               
													
													
													
												</div>
                                                  
                                                
                                              
                                              
<script>
	function deleteImage(){
		if(confirm('Desea remplazar la imagen? una vez que esta imagen se eliminado podra subir una nueva.') == true){
			$.post("funds-confirmation-image-delete.php", { id: <? echo $id; ?> }, function(data){
				
				document.getElementById('myfiles').innerHTML = "";
				if(data == 1){
					alert('La imagen ha sido eliminada, puede subir una nueva imagen.');
					document.getElementById('dUploader').style.display = 'block';
					document.getElementById('dShow').style.display = 'none';
					document.getElementById('file1').value = '';
				}
				if(data == 2){
					alert('No se encontro la imagen a elimianr.');
					document.getElementById('dUploader').style.display = 'block';
					document.getElementById('dShow').style.display = 'none';
					document.getElementById('file1').value = '';
				}
				if(data == 3){
					alert('ha ocurrido un problema se servicios.');
				}
				
			});
		}
	}
	
											</script>
<div class="row"></div><br>



											<div class="form-actions right" style=" margin-top:100px;">

												<div style="margin-right: 10px;">
												
												
												<button type="button" class="btn default" onClick="javascript:cancelAction();" style="margin-right: 10px;"><i class="fa fa-undo"></i> Retornar</button>
												<? //<button name="draft" id="draft" type="button" class="btn blue" onClick="javascript:saveDraft();"><i class="fa fa-save"></i> Guardar Borrador</button> ?>
													
											  <button name="draft" id="draft" type="submit" class="btn blue"><i class="fa fa-save"></i> Guardar Borrador</button>
                                              
                                              <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Ingresar</button>
											  </div>
											    
											    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
											  
											</div>

										</form>

										<!-- END FORM-->

									</div>

								</div>

							</div>

							

					<? /*<script>
			function saveDraft(){
			document.getElementById('newbutton').value = "draft";
			alert("Para Guardar borrador primero se validan todos loc campos del cliente.");
			var resultDraft = validateClient();
			if(resultDraft == false){
				//Do nothing
			}else{
				document.forms['porder'].submit();
			}
			
			}
			
			</script>*/ ?>
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

});
</script>

    
<script type="text/javascript"> 

function cancelAction(){
	if (confirm("Esta Seguro de cancelar este ingreso?\n")==true){
			window.location = 'funds-confirmation.php';
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
			
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>

<script>
function validateForm(){ 
	
	validateClient();
	
	var currency = 0;
	var radios_currency = document.getElementsByName('currency');

	for(i=0;i<radios_currency.length;i++){
 		if (radios_currency[i].checked){
  			currency = radios_currency[i].value;
  			break;
 		}
	}	
	
	if(currency == 0){
		alert('Usted debe de seleccionar una moneda.');
		return false;
	}

	var amount = document.getElementById("amount").value;
	if((amount == 0) || (amount == '')){
		alert('Usted debe de ingresar un monto.');
		document.getElementById("amount").focus();
		return false;
	}
	
	
	var depositdate = document.getElementById("depositdate").value;
	if((depositdate == '') || (depositdate == '00-00-0000')){
		alert('Usted debe de ingresar una fecha de deposito.');
		document.getElementById("depositdate").focus();
		return false;
	}
	
	var company = document.getElementById("company").value; 
	if(company == 0){
		alert('Usted debe de seleccionar una compañia.');
		document.getElementById("company").focus();
		return false;
	}
	
	var bank = document.getElementById("bank").value;
	if(bank == 0){
		alert('Usted debe de seleccionar un banco.');
		document.getElementById("bank").focus();
		return false;
	}
	

} 

function validateClient(){
	var clienttype = document.getElementById("clienttype").value; 

	if(clienttype == 0){
		document.getElementById("clienttype").focus(); 
		alert('Usted debe de seleccionar el tipo de cliente.');
		return false;
	}	
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
		
		if(ccode == ""){
			document.getElementById("ccode").focus(); alert('Ingrese C\u00F3digo de Cliente.'); return false;
		}
		if(cfirst == ""){
			document.getElementById("cfirst").focus(); alert('Ingrese Nombre del Cliente.'); return false;
		}
		if(clast == ""){
			document.getElementById("clast").focus(); alert('Ingrese Apellido del Cliente.'); return false;
		}
		if(caddress == ""){
			document.getElementById("caddress").focus(); alert('Ingrese Direcci\u00F3n del Cliente.'); return false;
		}
		if(cnid == ""){
			document.getElementById("cnid").focus(); alert('Ingrese C\u00E9dula del Cliente.'); return false;
		}
		if(ccity == ""){
			document.getElementById("ccity").focus(); alert('Ingrese Ciudad del Cliente.'); return false;
		}
		if(cemail == ""){
			document.getElementById("cemail").focus(); alert('Ingrese email del Cliente.'); return false;
		}
		if(cphone == ""){
			document.getElementById("cphone").focus(); alert('Ingrese Tel\u00E9fono del Cliente.'); return false;
		}
		
		//End Persona Natural
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
		
		if(ccode2 == ""){
			document.getElementById("ccode2").focus(); alert('Ingrese C\u00F3digo del Cliente.'); return false;
		}
		if(cname == ""){
			document.getElementById("cname").focus(); alert('Ingrese el Nombre de la Empresa.'); return false;
		}
		if(cruc == ""){
			document.getElementById("cruc").focus(); alert('Ingrese RUC del Cliente.'); return false;
		}
		if(cemail2 == ""){
			document.getElementById("cemail2").focus(); alert('Ingrese email del Cliente.'); return false;
		}
		if(cphone2 == ""){
			document.getElementById("cphone2").focus(); alert('Ingrese T\u00E9lefono del Cliente.'); return false;
		}
		if(caddress2 == ""){
			document.getElementById("caddress2").focus(); alert('Ingrese Direcci\u00F3n del Cliente.'); return false;
		}
		if(ccity2 == ""){
			document.getElementById("ccity2").focus(); alert('Ingrese Ciudad del Cliente.'); return false;
		}
		if(crfirst == ""){
			document.getElementById("crfirst").focus(); alert('Ingrese Nombres del Representante Legal.'); return false;
		}
		if(crlast == ""){
			document.getElementById("crlast").focus(); alert('Ingrese Apellidos del Representante Legal.'); return false;
		}
		if(crnid == ""){
			document.getElementById("crnid").focus(); alert('Ingrese C\u00E9dula del Representante Legal.'); return false;
		}
		/*if(cremail == 0){
			document.getElementById("cremail").focus(); alert('Ingrese Email del Representante Legal.'); return false;
		}*/
		if(crphone == ""){
			document.getElementById("crphone").focus(); alert('Ingrese T\u00E9lefono del Representante Legal.'); return false;
		}
		
		//End Persona Juridica 
	}
}

function clientType(ctype){

	if(ctype == "load"){
		ctype = document.getElementById('clienttype').value;
	}

	if(ctype == 1){
		document.getElementById('ct_personal').style.display = 'block';
		document.getElementById('ct_business').style.display = 'none'; 
		
		//Clean values
		document.getElementById('cfirst').value = "";
		document.getElementById('clast').value = "";
		document.getElementById('caddress').value = "";
		document.getElementById('ccity').value = "";
		document.getElementById('cnid').value = "";
		document.getElementById('cemail').value = "";
		document.getElementById('cphone').value = "";
		
		document.getElementById('cname').value = "";
		document.getElementById('cruc').value = "";
		document.getElementById('cemail2').value = "";
		document.getElementById('cphone2').value = "";
		document.getElementById('caddress2').value = "";
		document.getElementById('ccity2').value = "";
		document.getElementById('crfirst').value = "";
		document.getElementById('crlast').value = "";
		document.getElementById('crnid').value = "";
		document.getElementById('cremail').value = "";
		document.getElementById('crphone').value = "";
	}
	if(ctype == 2){
		document.getElementById('ct_business').style.display = 'block';
		document.getElementById('ct_personal').style.display = 'none';
		
		//Clean values
		document.getElementById('cfirst').value = "";
		document.getElementById('clast').value = "";
		document.getElementById('caddress').value = "";
		document.getElementById('ccity').value = "";
		document.getElementById('cnid').value = "";
		document.getElementById('cemail').value = "";
		document.getElementById('cphone').value = "";
		
		document.getElementById('cname').value = "";
		document.getElementById('cruc').value = "";
		document.getElementById('cemail2').value = "";
		document.getElementById('cphone2').value = "";
		document.getElementById('caddress2').value = "";
		document.getElementById('ccity2').value = "";
		document.getElementById('crfirst').value = "";
		document.getElementById('crlast').value = "";
		document.getElementById('crnid').value = "";
		document.getElementById('cremail').value = "";
		document.getElementById('crphone').value = "";
	
	}
	if(ctype == 0){
		document.getElementById('ct_business').style.display = 'none';
		document.getElementById('ct_personal').style.display = 'none';
		
		//Clean values
		document.getElementById('cfirst').value = "";
		document.getElementById('clast').value = "";
		document.getElementById('caddress').value = "";
		document.getElementById('ccity').value = "";
		document.getElementById('cnid').value = "";
		document.getElementById('cemail').value = "";
		document.getElementById('cphone').value = "";
		
		document.getElementById('cname').value = "";
		document.getElementById('cruc').value = "";
		document.getElementById('cemail2').value = "";
		document.getElementById('cphone2').value = "";
		document.getElementById('caddress2').value = "";
		document.getElementById('ccity2').value = "";
		document.getElementById('crfirst').value = "";
		document.getElementById('crlast').value = "";
		document.getElementById('crnid').value = "";
		document.getElementById('cremail').value = "";
		document.getElementById('crphone').value = "";
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
	
function benType2(type){

document.getElementById('client-stage').innerHTML = '<div id="client-stage"><div class="row"><div class="col-md-4"><div class="form-group"><label class="control-label">Tipo de cliente</label><select name="clienttype" class="form-control" id="clienttype" onChange="javascript:clientType(this.value);"><option value="0" selected>Seleccionar</option><option value="1">Persona Natural</option> <option value="2">Persona Jurídica</option> </select></div></div><div class="row"></div><div id="ct_personal" style="display: none;"><div class="col-md-2 "><div class="form-group"><label>Código:</label><div class="input-group"><input name="ccode" type="text" class="form-control" id="ccode" value="" ><span class="input-group-addon"><a href="javascript:benType(1);"><i class="icon-reload"></i></a></span> </div></div></div><div class="col-md-5 "><div class="form-group"><label>Nombres:</label><input name="cfirst" type="text" class="form-control" id="cfirst" value="" readonly > </div></div><div class="col-md-5 "><div class="form-group"><label>Apellidos:</label><input name="clast" type="text" class="form-control" id="clast" value="" readonly > </div></div><div class="col-md-8 "><div class="form-group"><label>Dirección:</label><input name="caddress" type="text" class="form-control" id="caddress" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Ciudad:</label><input name="ccity" type="text" class="form-control" id="ccity" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Cédula:</label><input name="cnid" type="text" class="form-control" id="cnid" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Email:</label><input name="cemail" type="text" class="form-control" id="cemail" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Teléfono:</label><input name="cphone" type="text" class="form-control" id="cphone" value="" readonly > </div></div></div><div id="ct_business" style="display: none;"><div class="col-md-2 "><div class="form-group"><label>Código:</label><div class="input-group"><input name="ccode2" type="text" class="form-control" id="ccode2" value=""><span class="input-group-addon"><a href="javascript:benType(2);"><i class="icon-reload"></i></a></span></div> </div></div><div class="col-md-10 "><div class="form-group"><label>Nombre de la Empresa:</label><input name="cname" type="text" class="form-control" id="cname" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>No. RUC:</label><input name="cruc" type="text" class="form-control" id="cruc" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Email:</label><input name="cemail2" type="text" class="form-control" id="cemail2" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Teléfono:</label><input name="cphone2" type="text" class="form-control" id="cphone2" value="" readonly > </div></div><div class="col-md-8 "><div class="form-group"><label>Dirección:</label><input name="caddress2" type="text" class="form-control" id="caddress2" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Ciudad:</label><input name="ccity2" type="text" class="form-control" id="ccity2" value="" readonly > </div></div><div class="col-md-12"><h4>Información del Representante Legal</h4></div><div class="col-md-6 "><div class="form-group"><label>Nombres:</label><input name="crfirst" type="text" class="form-control" id="crfirst" value="" readonly > </div></div><div class="col-md-6 "><div class="form-group"><label>Apellidos:</label><input name="crlast" type="text" class="form-control" id="crlast" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Cédula:</label><input name="crnid" type="text" class="form-control" id="crnid" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Email:</label><input name="cremail" type="text" class="form-control" id="cremail" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Teléfono:</label><input name="crphone" type="text" class="form-control" id="crphone" value="" readonly > </div></div></div><br></div></div>';
if(type == 1){
	alert('Puede ingresar de nuevo el codigo del Cliente.');
}
if(type == 2){
	alert('Debe de ingresar un codigo.');
}

}

(function() {
   //Document.ready equivalent
	//reloadRequirements("load");
	<? if($rowFunds['client'] != 0){ ?>
	clientType("load");
	benType(<? echo $rowclient['type']; ?>);
	
	<? } ?>
})();

</script>