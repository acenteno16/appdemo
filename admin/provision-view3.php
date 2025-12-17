<?php include("session-request.php"); 

$id = $_GET['id'];

$querypconfirm = "select * from payments where id = '$id'";
$resultpconfirm = mysqli_query($con, $querypconfirm);
$rowpconfirm = mysqli_fetch_array($resultpconfirm);

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

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:reloadNumbers()"> 

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

										<form name="porder" id="porder" action="payment-order-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">

											<div class="form-body">

												<h3 class="form-section">Información del Proveedor/Colaborador</h3> 
                                                <div class="row"><!--/span-->

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

												<div class="row"><!--/span-->

												
                                               
                                               <div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Tipo de Beneficiario:</label>


															<select name="dspayment" class="form-control" id="dspayment" onChange="javascript:selectRecipient();" disabled>
<option value="0">Seleccionar</option>
<option value="1" <?php if($rowpconfirm['btype'] == 1) echo 'selected'; ?>>Proveedores</option>
<option value="2" <?php if($rowpconfirm['btype'] == 2) echo 'selected'; ?>>Colaboradores</option>  
</select>

<script type="text/javascript">
function selectRecipient(){
	
	var recipient = document.getElementById("dspayment").value;
	if(recipient == 0){
		document.getElementById("dproviders").style.display = "none";
		document.getElementById("dworkers").style.display = "none";
		document.getElementById("provider").value = "";
		document.getElementById("collaborator").value = "";
	}if(recipient == 1){
		document.getElementById("dproviders").style.display = "block";
		document.getElementById("dworkers").style.display = "none";
		document.getElementById("collaborator").value = "";
	}if(recipient == 2){
		document.getElementById("dproviders").style.display = "none";
		document.getElementById("dworkers").style.display = "block";
		document.getElementById("provider").value = "";
	}
	
}
</script>													

													</div>
                                               
                                               </div>
                                           </div>
                                                    
                                                    
                                                    <div class="row" id="dproviders" style="display:<?php if($rowpconfirm['btype'] == 1) echo 'block'; else echo 'none'; ?>"><!--/span-->

													<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar..." onChange="javascript:validateBill();" disabled>

												<option value=""></option>
<?php $queryproviders = "select * from providers";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?>
												<option value="<?php echo $rowproviders['id']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['name']; ?></option>
                                                <?php } ?>

												

											</select>

															<div title="Page 5">
															  <div>
															    <div>
															     <span class="help-block">

															 Ingrese código, nombre o parte de el para filtar los resultados.</span>
														        </div>
														      </div>
													    </div>
													  </div>

													</div>

													<!--/span-->

												</div>
                                                
                                                <div class="row" id="dworkers" style="display:<?php if($rowpconfirm['btype'] == 2) echo 'block'; else echo 'none'; ?>;"><!--/span-->

													<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

						
											<select name="collaborator" class="form-control  select2me" id="collaborator" data-placeholder="Seleccionar..." onChange="javascript:validateBill();"> 

												<option value=""></option>
<?php $queryworkers = "select * from workers";
$resultworkers = mysqli_query($con, $queryworkers);
while($rowworkers=mysqli_fetch_array($resultworkers)){
?>
												<option value="<?php echo $rowworkers['id']; ?>"<?php if($rowpconfirm['collaborator'] == $rowworkers['id']) echo 'selected'; ?>><?php echo $rowworkers['code']." | ".$rowworkers['first']." ".$rowworkers['last']; ?></option>
                                                <?php } ?>  

												

											</select>

															<div title="Page 5">
															  <div>
															    <div>
															     <span class="help-block">

															 Ingrese código, nombre o parte de el para filtar los resultados.</span>
														        </div>
														      </div>
													    </div>
													  </div>

													</div>

													<!--/span-->

												</div>

												<!--/row--><!--/row-->
		<h3 class="form-section">Concepto de Pago</h3>
        
												<div class="row">

													

                                                    <div class="col-md-12 ">
													  <div class="form-group">
														<label>Descripción:</label>
                                                        <textarea name="description" rows="2" class="form-control" id="description" onFocus="validateFirst();" readonly><?php echo $rowpconfirm['description']; ?></textarea>
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
                                                    <?php //start bill 
													
	
	$querybill = "select * from bills where payment = '$_GET[id]'";
	$resultbill = mysqli_query($con, $querybill);
	$numbill = mysqli_num_rows($resultbill);	
	if($numbill > 0){	
	while($rowbill=mysqli_fetch_array($resultbill)){
		
																							
  ?>
  
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Tipo:</label>
<?php $queryt = "select * from categories where type = 1";
$resultt = mysqli_query($con, $queryt);
$numt = mysqli_num_rows($resultt);
$rowt = mysqli_fetch_array($resultt);
?>
															<select name="type[]" class="form-control" id="type_<?php echo $typeinc; ?>" onChange="javascript:reloadsconcept(this.value,<?php echo $typeinc; ?>);">

<option value="0" <?php if($rowbill['type'] == 0){ echo 'selected'; } ?>>Seleccionar</option>
<?php $queryt1 = "select * from categories where parentcat = $rowt[id] order by name asc";
$resultt1 = mysqli_query($con, $queryt1);
while($rowt1=mysqli_fetch_array($resultt1)){
?>														<option value="<?php echo $rowt1['id']; ?>" <?php if($rowbill['type'] == $rowt1['id']) echo 'selected'; ?>><?php echo $rowt1['name']; ?></option>

<?php } ?>
	 														</select>

													  </div>

													</div>                                                    <div class="col-md-4">

													  <div class="form-group">

															<label class="control-label">Concepto:</label>
															<select name="concept[]" class="form-control" id="concept_<?php echo $typeinc; ?>" onChange="javascript:reloadsconcept2(this.value,<?php echo $typeinc; ?>);">
<?php if($rowbill['concept'] == 0){
?>
<option value="0">Esperando la selección de tipo para cargar la lista</option>
<?php }else{ 
$queryconcept = "select * from categories where parentcat = '$rowbill[type]' order by account asc";
$resultconcept = mysqli_query($con, $queryconcept);
while($rowconcept=mysqli_fetch_array($resultconcept)){
?>
<option value="<?php echo $rowconcept['id']; ?>" <?php if($rowbill['concept'] == $rowconcept['id']) echo 'selected'; ?>><?php if($rowconcept['account'] != ""){ echo $rowconcept['account']." | "; } echo $rowconcept['name']; ?></option>
<?php } } ?>															</select>

												       
												      </div>
                                                    </div>
                                                    <div class="col-md-4"> 
                                                      <div class="form-group">
     <label class="control-label">Categoría:</label>

												        <select name="concept2[]" class="form-control" id="concept2_<?php echo $typeinc; $typeinc++; ?>">
													          
	<?php if($rowbill['concept2'] == 0){
	?>											          <option value="NULL">Esperando la selección de concepto para cargar la lista</option>
			<?php }else{ 
			$queryconcept2 = "select * from categories where parentcat = '$rowbill[concept]' order by account asc";
			$resultconcept2 = mysqli_query($con, $queryconcept2);
			while($rowconcept2=mysqli_fetch_array($resultconcept2)){
			?>									          <option value="<?php echo $rowconcept2['id']; ?>" <?php if($rowbill['concept2'] == $rowconcept2['id']) echo 'selected="selected"'; ?>><?php echo $rowconcept2['name']; ?></option>
			<?php } } ?>					            </select>                                                  </div>
                                                    </div>
                                                    
    <input type="hidden" id="billid[]" name="billid[]" value="<?php echo $rowbill['id']; ?>">                                                <div id="bill">
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Factura No:</label>
                                                        <input name="bill[]" type="text" class="form-control" id="bill[]" value="<?php echo $rowbill['number']; ?>" onChange="javascript:validateFirst(),validateBill();" readonly>
<script>

function validateBill(){

loadBeneficiaries2(provider);

var recipient = document.getElementById("dspayment").value;
if(recipient == 1){ 

var provider = document.getElementById('provider').value;			
i=0;
for (var obj in document.getElementsByName('bill[]')){
//

billnumber = document.getElementsByName('bill[]')[i].value;
document.getElementsByName('filename[]')[i].value = "Factura "+billnumber;
//  
if (i<document.getElementsByName('bill[]').length){


billnumber = document.getElementsByName('bill[]')[i].value;
		
		cleanBill(billnumber,provider,i);

  }
  i++;
}
}

}

function loadBeneficiaries2(id){
	$.post("reload-beneficiaries2.php", { variable: id }, function(data){
		if(data.length > 1){
			document.getElementById('dbeneficiarie').style.display = "block";
			$("#beneficiarie").html(data);
		}else{
			document.getElementById('dbeneficiarie').style.display = "none"; 
			document.getElementById('dbeneficiarie').value = 0;
		}
		
});		
}
 
 
function cleanBill(billnumber,provider,i){
	$.post("validate-bill.php", { variable: billnumber, variable2: provider, payment: '<?php echo $_GET['id']; ?>' }, function(data){
	
		if(data == 0){
			
		}else{
				
			alert(data);
			document.getElementsByName('bill[]')[i].value = "";
			document.getElementsByName('bill[]')[i].focus();
			
		}
	
		
});	
}

</script>						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div><div class="col-md-2 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="ammount[]" type="text" class="form-control" id="ammount[]" value="<?php echo $rowbill['ammount']; ?>" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers(this.value);" readonly>
						
                      
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div><div class="col-md-3 ">
													  <div class="form-group">
														<label>Cantidad en letras:</label> 
                                                        <input name="letters[]" type="text" class="form-control" id="letters[]" value="<?php echo $rowbill['letters'];?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Sub-total:</label>
                                                        <input name="stotal[]" type="text" class="form-control" id="stotal[]" value="" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>IVA:</label>
                                                        <input name="tax[]" type="text" class="form-control" id="tax[]" value="" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-1 ">
													  <div class="form-group">
														<label>Exento:</label>
                                                        <input name="exempt[]" type="checkbox" id="exempt[]"  value="1" <?php if($rowbill['exempt'] == 1) echo 'checked'; ?> readonly>  
                                                         
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <?php $queryfile = "select * from files where bill = '$rowbill[id]'"; 
	$resultfile = mysqli_query($con, $queryfile);
	$rowfile = mysqli_fetch_array($resultfile);
	?><input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfile['id']; ?>">	
 <?php //Bill date?>
 <div class="col-md-4 ">
													  <div class="form-group">
														<label>Fecha de Factura:</label> 
                                                        <input name="billdate[]" type="text" class="form-control form-control-inline date-picker" id="billdate[]" value="<?php $billdate = strtotime($rowbill['billdate']);
														echo date('d-m-Y', $billdate); ?>" readonly>
						
                                                          
                       

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>
 <?php //Bill Link ?>
 
 <div class="col-md-4 ">
													  <div class="form-group">
														<label>Link:</label>
                                                        <input name="file[]" type="text" class="form-control" id="file[]" value="<?php echo $rowfile['link']; ?>" readonly>
						
                                                          
                       <br>

    
                                                      <!--/row--></div>
													</div>  
 <?php //Bill Name ?>  
 <div class="col-md-4 ">
													  <div class="form-group">
														<label>Nombre:</label>
                                                        <input name="filename[]" type="text" class="form-control" id="filename[]" value="<?php echo $rowfile['name']; ?>" readonly>
                                                        <input name="filebill[]" type="hidden" id="filebill[]" value="<?php echo $rowbill['id']; ?>">
                                                        
                                                        
<br>

    
                                                      <!--/row--></div>
													</div>
                                                    
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Factura multiple:&nbsp; &nbsp; <br>
</label>
                                                      <div style="margin-top:10px;">  <input name="mretainer[]" type="checkbox" id="mretainer[]" onClick="javascript:reloadNumbers();" value="1" readonly> <a href="javascript:help4();">?</a></div>
<script>
function help4(){
alert('Active esta opcion para facturas que contienen articulos exentos de iva y no exentos de iva. Esta opcion le abrira un campo para ingresar el monto exento.'); 
}
</script>                                                      
                                                         
						
                                                          
                   

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-2 " id="dnammount[]" name="dnammount[]" style="display:none;"> 
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="nammount[]" type="text" class="form-control" id="nammount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();" placeholder="Monto Excento" readonly> 
						
                      
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div id="row">
                                                    <div class="col-md-12 "> &nbsp;</div>
                                                    </div>   
 </div>
 <?php } 
 ?>
 
 <div id="dbill" style="display:none">
<input id="clickMe" type="button" value="clickme" onclick="reloadBills();" />
</div>
 
 <?php } else{ //end bill ?>
 
   
  <input type="hidden" id="billid[]" name="billid[]" value="0">
 <div id="bill">
 <div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Tipo:</label>
<?php $queryt = "select * from categories where type = 1";
$resultt = mysqli_query($con, $queryt);
$numt = mysqli_num_rows($resultt);
$rowt = mysqli_fetch_array($resultt);
?> 
															<select name="type[]" class="form-control" id="type_<?php echo $typeinc; ?>" onChange="javascript:reloadsconcept(this.value,<?php echo $typeinc; ?>);">
<option value="0" selected>Seleccionar</option>
<?php $queryt1 = "select * from categories where parentcat = $rowt[id] order by name asc";
$resultt1 = mysqli_query($con, $queryt1);
while($rowt1=mysqli_fetch_array($resultt1)){
?>														<option value="<?php echo $rowt1['id']; ?>" <?php if($rowpconfirm['type'] == $rowt1['id']) echo 'selected'; ?>><?php echo $rowt1['name']; ?></option>
<?php } ?>
	 														</select>

													  </div>

													</div>                                                    <div class="col-md-4">

													  <div class="form-group">

															<label class="control-label">Concepto:</label>
															<select name="concept[]" class="form-control" id="concept_<?php echo $typeinc; ?>" onChange="javascript:reloadsconcept2(this.value,<?php echo $typeinc; ?>);">
<?php if($rowpconfirm['concept'] == 0){
?>
<option value="0">Esperando la selección de tipo para cargar la lista</option>
<?php }else{ 
$queryconcept = "select * from categories where parentcat = '$rowpconfirm[type]' order by account asc";
$resultconcept = mysqli_query($con, $queryconcept);
while($rowconcept=mysqli_fetch_array($resultconcept)){
?>
<option value="<?php echo $rowconcept['id']; ?>" <?php if($rowpconfirm['concept'] == $rowconcept['id']) echo 'selected'; ?>><?php echo $rowconcept['name']; ?></option>
<?php } } ?>															</select>

												       
												      </div>
                                                    </div>
                                                    <div class="col-md-4"> 
                                                      <div class="form-group">
     <label class="control-label">Categoría:</label>

												        <select name="concept2[]" class="form-control" id="concept2_<?php echo $typeinc; $typeinc++; ?>">
													          
	<?php if($rowpconfirm['concept2'] == 0){
	?>											          <option value="0">Esperando la selección de concepto para cargar la lista</option>
			<?php }else{ 
			$queryconcept2 = "select * from categories where parentcat = '$rowpconfirm[concept]' order by account asc";
			$resultconcept2 = mysqli_query($con, $queryconcept2);
			while($rowconcept2=mysqli_fetch_array($resultconcept2)){
			?>									          <option value="<?php echo $rowconcept2['id']; ?>" <?php if($rowpconfirm['concept2'] == $rowconcept2['id'])?>><?php echo $rowconcept2['account']." ".$rowconcept2['name']; ?></option>
			<?php } } ?>					            </select>                                                  </div>
                                                    </div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Factura No:</label>
                                                        <input name="bill[]" type="text" class="form-control" id="bill[]" value="" onChange="javascript:validateBill();" onFocus="validateProvider();">
<script>
function validateProvider(){
var provider = document.getElementById('provider').value;			
var recipient = document.getElementById("dspayment").value;

if(recipient == 0){
	document.getElementById('dspayment').focus();
	alert('Primero seleccionar el tipo de beneficiario.');	
}
if(recipient == 1){ 	
	if(provider == ''){
		document.getElementById('provider').focus();
		alert('Primero seleccionar el proveedor #000X001.');
	}else{
		document.getElementById('provider').readOnly = true; 
	} 
}
}

function validateBill(){
		provider = document.getElementById('provider').value;
		loadBeneficiaries2(provider);
		
var recipient = document.getElementById("dspayment").value;
if(recipient == 1){ 			
i=0;	
for (var obj in document.getElementsByName('bill[]')){
//
billnumber = document.getElementsByName('bill[]')[i].value;
document.getElementsByName('filename[]')[i].value = "Factura "+billnumber;
// 
if (i<document.getElementsByName('bill[]').length){
billnumber = document.getElementsByName('bill[]')[i].value;
		
		cleanBill(billnumber,provider,i);

  }
  i++;
}
}
}

function loadBeneficiaries2(id){
	$.post("reload-beneficiaries2.php", { variable: id }, function(data){
		if(data.length > 1){
			document.getElementById('dbeneficiarie').style.display = "block";
			$("#beneficiarie").html(data);
		}else{
			document.getElementById('dbeneficiarie').style.display = "none"; 
			document.getElementById('dbeneficiarie').value = 0;
		}
		
});		
}


function cleanBill(billnumber,provider,i){
	$.post("validate-bill.php", { variable: billnumber, variable2: provider }, function(data){
	
		if(data == 0){
			
		}else{
				
			alert(data);
			document.getElementsByName('bill[]')[i].value = "";
			document.getElementsByName('bill[]')[i].focus();
			
		}
	
		
});	
}

</script>						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div><div class="col-md-2 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="ammount[]" type="text" class="form-control" id="ammount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers(this.value);">
						
                      
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div><div class="col-md-3 ">
													  <div class="form-group">
														<label>Cantidad en letras:</label> 
                                                        <input name="letters[]" type="text" class="form-control" id="letters[]" value="" readonly> 
						
                                                          
                    

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Sub-total:</label>
                                                        <input name="stotal[]" type="text" class="form-control" id="stotal[]" value="" readonly>
						
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>IVA:</label>
                                                        <input name="tax[]" type="text" class="form-control" id="tax[]" value="" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-1 ">
													  <div class="form-group">
														<label>Cuota Fija:</label>
                                                        <input name="exempt[]" type="checkbox" id="exempt[]" onChange="javascript:reloadNumbers();" value="1"> 
                                                         
						
                                                          
                   

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>
 
                                                    <?php //Bill date?>
                                                    <div class="col-md-4 ">
													  <div class="form-group">
														<label>Fecha de Factura:</label> 
                                                        <input name="billdate[]" type="text" class="form-control form-control-inline date-picker" id="billdate[]" value="" readonly>
						
                                                          
                       

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>
                                                    <input type="hidden" name="fileid[]" id="fileid[]" value="0">
                                                    <div class="col-md-4 ">
													  <div class="form-group">
														<label>Link:</label>
                                                        <input name="file[]" type="text" class="form-control" id="file[]" value="">
						
                                                          
                       

    
                                                      <!--/row--></div>
													</div>  
                                                    <div class="col-md-4 ">
													  <div class="form-group">
														<label>Nombre:</label>
                                                        <input name="filename[]" type="text" class="form-control" id="filename[]" value="Factura">
						
                                                          
                   
    
                                                      <!--/row--></div>
													</div>  
                                                    
                                                 
 <div class="col-md-2 ">
													  <div class="form-group">
														<label>Factura multiple:&nbsp; &nbsp; <br>
</label>
                                                      <div style="margin-top:10px;">  <input name="mretainer[]" type="checkbox" id="mretainer[]" onClick="javascript:reloadNumbers();" value="1"> <a href="javascript:help4();">?</a></div>
<script>
function help4(){
alert('Active esta opcion para facturas que contienen articulos exentos de iva y no exentos de iva. Esta opcion le abrira un campo para ingresar el monto exento.'); 
}
</script>                                                      
                                                         
						
                                                          
                   

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-2 " id="dnammount[]" name="dnammount[]" style="display:none;"> 
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="nammount[]" type="text" class="form-control" id="nammount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();"> 
						
                      
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div id="row">
                                                    <div class="col-md-12 "> &nbsp;</div>
                                                    </div>

 </div>
 
 <?php }  ?>
          
   <script type="text/javascript">
  var bill = 1; 
  var cbill = <?php echo $typeinc; ?> 
function addBill(){
	
   var billinfo0 = '<div id="bill'+cbill+'">';
   //$("#bill").append(billinfo0);
   
   var billinfo01 = '<div class="col-md-4"><div class="form-group"><label class="control-label">Tipo:</label><?php $queryt = "select * from categories where type = 1";
$resultt = mysqli_query($con, $queryt);
$numt = mysqli_num_rows($resultt);
$rowt = mysqli_fetch_array($resultt);
?><select name="type[]" class="form-control" id="type_'+cbill+'" onChange="javascript:reloadsconcept(this.value,'+cbill+');"><option value="0" selected>Seleccionar</option><?php $queryt1 = "select * from categories where parentcat = $rowt[id] order by name asc";
$resultt1 = mysqli_query($con, $queryt1);
while($rowt1=mysqli_fetch_array($resultt1)){
?><option value="<?php echo $rowt1['id']; ?>" <?php if($rowpconfirm['type'] == $rowt1['id']) echo 'selected'; ?>><?php echo $rowt1['name']; ?></option><?php } ?></select></div></div>';
     //$("#bill").append(billinfo01);
	 <?php /*
	 
                                                    
	 */ ?>
	 
	    var billinfo02 = '<div class="col-md-4"><div class="form-group"><label class="control-label">Concepto:</label><select name="concept[]" class="form-control" id="concept_'+cbill+'" onChange="javascript:reloadsconcept2(this.value,'+cbill+');"><?php if($rowpconfirm['concept'] == 0){
?><option value="0">Esperando la selección de tipo para cargar la lista</option><?php }else{ 
$queryconcept = "select * from categories where parentcat = '$rowpconfirm[type]' order by name asc";
$resultconcept = mysqli_query($con, $queryconcept);
while($rowconcept=mysqli_fetch_array($resultconcept)){
?><option value="<?php echo $rowconcept['id']; ?>" <?php if($rowpconfirm['concept'] == $rowconcept['id']) echo 'selected'; ?>><?php echo $rowconcept['name']; ?></option>
<?php } } ?></select></div></div>';
     //$("#bill").append(billinfo02);
	 
	    var billinfo03 = '<div class="col-md-4"><div class="form-group"><label class="control-label">Categoría:</label><select name="concept2[]" class="form-control" id="concept2_'+cbill+'"><?php if($rowpconfirm['concept2'] == 0){
	?><option value="0">Esperando la selección de concepto para cargar la lista</option><?php }else{ 
			$queryconcept2 = "select * from categories where parentcat = '$rowpconfirm[concept]' order by name asc";
			$resultconcept2 = mysqli_query($con, $queryconcept2);
			while($rowconcept2=mysqli_fetch_array($resultconcept2)){
			?><option value="<?php echo $rowconcept2['id']; ?>" <?php if($rowpconfirm['concept2'] == $rowconcept2['id'])?>><?php echo $rowconcept2['name']; ?></option><?php } } ?></select></div></div>';
     //$("#bill").append(billinfo03);
	 
	 
	 
	 var billinfo1 = '<div class="col-md-2 "><div class="form-group"><label>Factura No:</label><input name="bill[]" type="text" class="form-control" id="bill[]" value="" onChange="javascript:validateBill();" onFocus="validateProvider();"><br></div></div>';
     //$("#bill").append(billinfo1);
   var billinfo2 = '<div class="col-md-2 "><div class="form-group"><label>Monto:</label><input name="ammount[]" type="text" class="form-control" id="ammount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers(this.value);"><br></div></div>';
     //$("#bill").append(billinfo2);
   var billinfo3 = '<div class="col-md-3 "><div class="form-group"><label>Cantidad en letras:</label><input name="letters[]" type="text" class="form-control" id="letters[]" value="" readonly> <br></div></div>';
     //$("#bill").append(billinfo3);
	 
	 var billinfo3a = '<div class="col-md-2 "><div class="form-group"><label>Sub-total:</label><input name="stotal[]" type="text" class="form-control" id="stotal[]" value="" readonly><br> <div class="row"></div></div></div>';
     //$("#bill").append(billinfo3a);
	 var billinfo3b = '<div class="col-md-2 "><div class="form-group"><label>IVA:</label><input name="tax[]" type="text" class="form-control" id="tax[]" value="" readonly><br><div class="row"></div></div></div>';
     //$("#bill").append(billinfo3b);
	 var billinfo3c = '<div class="col-md-1 "><div class="form-group"><label>Cuota Fija:</label><input type="checkbox" name="exempt[]" id="exempt[]" onChange="javascript:reloadNumbers();" value="1"><br><div class="row"></div></div></div>';
     //$("#bill").append(billinfo3c);
	 
   //bill++;
   
   
													
	var billinfo4a = '<div class="col-md-4 "><div class="form-group"><label>Fecha de Factura:</label><input name="billdate[]" type="text" class="form-control form-control-inline date-picker" id="billdate[]" value="" readonly="readonly"></div></div>';
     //$("#bill").append(billinfo4a); 
							
   var billinfo4b = '<input type="hidden" name="fileid[]" id="fileid[]" value="0"><div class="col-md-4 "><div class="form-group"><label>Link:</label><input name="file[]" type="text" class="form-control" id="file[]" value=""><br></div></div><div class="col-md-4 "><div class="form-group"><label>Nombre:</label><input name="filename[]" type="text" class="form-control" id="filename[]" value="Factura"><br></div></div>';
   var billinfo4c = '<div class="col-md-2 "><div class="form-group"><label>Factura multiple:&nbsp; &nbsp; <br></label><div style="margin-top:10px;">  <input name="mretainer[]" type="checkbox" id="mretainer[]" onClick="javascript:reloadNumbers();" value="1"> <a href="javascript:help4();">?</a></div></div></div><div class="col-md-2 " id="dnammount[]" name="dnammount[]" style="display:none;"><div class="form-group"><label>Monto:</label><input name="nammount[]" type="text" class="form-control" id="nammount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();" placeholder="Monto Exento"><div class="row"></div></div></div><div id="row"><div class="col-md-12 "> &nbsp;</div></div><div class="col-md-12"><button type="button" class="btn red icn-only" onclick="deleteBill('+cbill+');"><i class="fa fa-trash-o"></i> Eliminar Factura</button></div>';
     //$("#bill").append(billinfo4b);
	 
	 billunion = billinfo01+billinfo02+billinfo03+billinfo1+billinfo2+billinfo3+billinfo3a+billinfo3b+billinfo3c+billinfo4a+billinfo4b+billinfo4c;
	 $("#bill").append('<div id="bill_'+cbill+'">'+billunion+'</div>');
	 
	 cbill++;
	 ComponentsPickers.init();
  
}

function deleteBill(id){ 
	 $('#bill_'+id).remove();
	  
}
</script>  
           
               <div class="row"></div><br><br><br>
             <div class="col-md-2 ">
													  <div class="form-group">
														<label>Subtotal Facturas:</label>
                                                        <input name="stotalbill" type="text" class="form-control" id="stotalbill" value="" readonly> <input id="stotalbillmen1000" name="stotalbillmen1000" type="hidden" value="">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>IVA Factura(s):</label>
                                                        <input name="totaltax" type="text" class="form-control" id="totaltax" value="" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Total Factura(s):</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="" readonly> 
						
                                                          
                                                        <input id="stotalbillmay1000" name="stotalbillmay1000" type="hidden" value="">
                                                        <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 
                                                    
                                                    <?php //Moneda
													/*<div class="col-md-2 ">
													  <div class="form-group">
														<label>Moneda:</label>
														<select name="currency" class="form-control" id="currency">
														  <option value="0">Seleccionar</option>
<?php $querycurrency = "select * from currency";
$resultcurrency = mysqli_query($con, $querycurrency);
while($rowcurrency=mysqli_fetch_array($resultcurrency)){
?>                                                         <option value="<?php echo $rowcurrency['id']; ?>"><?php echo $rowcurrency['name']; ?></option>
<?php } ?>													    </select>
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>*/ ?>      
     <div class="col-md-6"> 

<div class="form-group">
										<label>Moneda:</label>
										<div class="radio-list">
											<?php $querycurrency = "select * from currency";
$resultcurrency = mysqli_query($con, $querycurrency);
$checked = 1;
while($rowcurrency=mysqli_fetch_array($resultcurrency)){
?>
                                            <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input type="radio" name="currency" id="currency" onClick="javascript:reloadNumbers();" value="<?php echo $rowcurrency['id']; ?>" <?php if($rowpconfirm['currency'] == 0){ if($checked == 1){ echo 'checked=""'; $checked++; }}else{ 
										  if($rowpconfirm['currency'] == $rowcurrency['id']){
											  echo 'checked=""';
										  }
										  }?> readonly></span></div> <?php echo $rowcurrency['name']; ?></label>
											                                           <?php } ?> 
											
										</div>
									</div> </div> 
 
 </div>                                           
                                                    <h3 class="form-section">Retenciones</h3>
                                                    	<div class="note note-danger" id="ocurrency" style="display:none;"> 

						<p>

							NOTA: Pagos en otras monedas generan su retención con fecha de libro mayor al momento de la provisión. 

						</p> 

					</div><div class="row">
                                                    
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														<label>Alcaldía:</label>
                                                        <input name="retention1" type="text" class="form-control" id="retention1" value="<?php if($rowpconfirm['ret1'] != 0){ echo $rowpconfirm['ret1']; } ?>" placeholder="%" onKeyUp="javascript:reloadNumbers(this.value);" onkeypress="return justNumbers(event);" <?php /*onFocus="javascript:clear1();"*/ ?>><span class="input-group-addon bootstrap-touchspin-postfix">%</span>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														
           <label>&nbsp;</label>                                             <input name="retention1ammount" type="text" class="form-control" id="retention1ammount" placeholder="Monto" value="<?php echo $rowpconfirm['ret1a']; ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                                 
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														<label>IR:</label>
                                                        <input name="retention2" type="text" class="form-control" id="retention2" value="<?php if($rowpconfirm['ret2'] != 0){ echo $rowpconfirm['ret2']; } ?>" placeholder="%" onKeyUp="javascript:reloadNumbers();" onkeypress="return justNumbers(event);" <?php /*onFocus="javascript:clear2();"*/ ?>><span class="input-group-addon bootstrap-touchspin-postfix">%</span>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-3 ">
													  <div class="form-group">
			    <label>&nbsp;</label>											
                                                        <input name="retention2ammount" type="text" class="form-control" id="retention2ammount" placeholder="Monto" value="<?php echo $rowpconfirm['ret2a']; ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    

													<!--/span-->

												</div>
                                                 <div class="row">
                                                 
   <div class="col-md-3 ">
													  <div class="form-group">No retenedor/Exento
													    <label>:</label>
                                                        <input name="retainer" type="checkbox" id="retainer" onChange="javascript:reloadNumbers();" value="1" <?php if($rowpconfirm['retainer'] == 1) echo 'checked'; ?>> 
                                                         
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                              </div>
                                                
                                                  <h3 class="form-section">Pago a Proveedor</h3>
                                                  
                                              <div class="row"><!--/span-->
                                                <div class="col-md-3 "> 
													  <div class="form-group">
			    <label>Monto a Pagar</label>
			    :											
                                                        <input name="payment" type="text" class="form-control" id="payment" placeholder="Calculo automático" value="" readonly>
 						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
												</div>  
                                                  </div>
                                                  
                                                       <h3 class="form-section"><a id="files"></a>Archivos </h3>
                                                  
                                                  <div class="row"><!--/span--> 
                                                  
                                                  <div id="emails">
                                                    <?php $queryfile2 = "select * from files where payment = '$_GET[id]' and bill = '0'"; 
	$resultfile2 = mysqli_query($con, $queryfile2);
	while($rowfile2 = mysqli_fetch_array($resultfile2)){
	?>
                                                     <div class="col-md-5 ">
													  <div class="form-group">
	<input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfile2['id']; ?>">												    <input name="file[]" type="text" class="form-control" id="file[]"  placeholder="Ej: http://www.ejemplo.com" value="<?php echo $rowfile2['link']; ?>"><br><div class="row"></div></div></div> 
                                                        <div class="col-md-5 ">
													  <div class="form-group">
													    <input name="filename[]" type="text" class="form-control" id="filename[]"  placeholder="Ej: Factura" value="<?php echo $rowfile2['name']; ?>">
						
                                                          
                       <br>
                       
                     

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>  
                                                    <?php } ?>
                                                     <input type="hidden" name="fileid[]" id="fileid[]" value="0">	
                                                     <div class="col-md-5 ">
													  <div class="form-group">
													    <input name="file[]" type="text" class="form-control" id="file[]"  placeholder="Ej: http://www.ejemplo.com" value=""><br><div class="row"></div></div></div> 
                                                        <div class="col-md-5 ">
													  <div class="form-group">
													    <input name="filename[]" type="text" class="form-control" id="filename[]"  placeholder="Ej: Factura" value="">
						
                                                          
                       <br>
                       
                     

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>  
                                                    </div>
              <div class="col-md-2 "><button type="button" class="btn blue icn-only" onclick="agregar();"><i class="fa fa-plus"></i></button>
             </div>                        
                                                     
                                   
                                                     
<script type="text/javascript">
var bill = 1;
function agregar(){ 
	
    campo = '<div class="col-md-5 "><div class="form-group"><input name="file[]" type="text" class="form-control" id="file[]"  placeholder="Ej: http://www.ejemplo.com" value=""><br><div class="row"></div></div></div><div class="col-md-5 "><div class="form-group"><input name="filename[]" type="text" class="form-control" id="filename[]"  placeholder="Ej: Factura" value=""><br><div class="row"></div></div></div>'; 
    $("#emails").append(campo);
	
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
<?php $queryroutes = "select routes.* from routes inner join usertype on routes.type = usertype.id where routes.headship = 0 and routes.worker = '$_SESSION[userid]' and usertype.type = 1 group by routes.unit";
$resultroutes = mysqli_query($con, $queryroutes);
$numroutes = mysqli_num_rows($resultroutes);
if($numroutes > 0){
	

?>
	  <h3 class="form-section"><a id="route"></a>Ruta de pago</h3>

<div class="row">
  <div class="col-md-4">
  <script type="application/javascript">
  
  function reloadHeadship(id){
	
   $.post("reload-headships.php", { variable: id }, function(data){
	
  //alert(data); 
  document.getElementById('headship').innerHTML = data;
   
}); 
} 
  </script>

													  <div class="form-group">

														<label class="control-label">Lista de Rutas:</label>  

															<select name="route" class="form-control" id="route" onchange="javascript:reloadHeadship(this.value);"> 
                                                  
<option value="0" selected>Seleccionar</option> 
<?php while($rowroutes=mysqli_fetch_array($resultroutes)){ 
	
	if(strlen($rowroutes['unit']) == 2){
		$queryrname = "select * from units where code2 = '$rowroutes[unit]'";
		$resultrname = mysqli_query($con, $queryrname);
	while($rowrname = mysqli_fetch_array($resultrname)){
		$thename.=$rowrname['name'];
		$thecode = $rowrname['code2'];
	}
		
	}else{
		$queryrname = "select * from units where code = '$rowroutes[unit]'";
		$resultrname = mysqli_query($con, $queryrname);
	$rowrname = mysqli_fetch_array($resultrname);
	$thename = $rowrname['name'];
	$thecode = $rowrname['code'];
	}
	
	
	
?>
<option value="<?php echo $thecode; ?>"><?php echo $thecode." | ".$thename; ?></option>
<?php } ?>
															</select>

													  </div>

													</div>
                                                    
                                                    </div>
                                                    
                                                 
                                                    <div class="row">
  <div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Lista de Jefatura:</label>

															<select name="headship" class="form-control" id="headship"> 
                                                  

<option value="0">Seleccionar Ruta</option>

															</select>

													  </div>

													</div>
                                                    
                                                    </div>
<?php } ?>      										<!--/row--><!--/row--></div>


											<div class="form-actions right">

												<button type="button" class="btn default" onClick="javascript:cancelAction();">Cancelar</button>

										 <button name="draft" id="draft" type="button" class="btn blue" onClick="javascript:saveDraft();"><i class="fa fa-save"></i> Guardar Borrador</button>
                                              <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Ingresar</button>
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

/*
function makemenu(cammount,i){
	$.post("reload-sconcepts.php", { variable: cammount }, function(data){ 
	
	 document.getElementsByName("concept[]")[i].innerHTML = data;
	});	
}
 
  
  
  
  
function reloadsconcept2(nid,i){		
	var i = 0;
	imax = document.getElementsByName("concept[]").length;
	for(i=0;i<imax;i++){

	nid = document.getElementsByName('concept[]')[i].value;
	

	  makemenu2(nid,i);
}	
}

function makemenu2(cammount,i){
	$.post("reload-sconcepts2.php", { variable: cammount }, function(data){ 
	
	 document.getElementsByName("concept2[]")[i].innerHTML = data;
	});	
}
  
*/

function reloadNumbers(thenumber){	

	var gtotal=0;
	var gstotal=0;
	var gtax = 0;
	var data = 0;
	var ndata = 0;
	var cammount = 0;
	var gstotalmay1000 = 0;
	var gstotalmen1000 = 0;
	var p1 = 0;
	var p2 = 0;
	var currency = 0;
	var mretainer = 0;
	var nammount = 0;
	var gnammount = 0;
	
	i=0;
	for (var obj in document.getElementsByName('ammount[]')){
	if (i<document.getElementsByName('ammount[]').length){
 
   cammount = document.getElementsByName('ammount[]')[i].value;
   nammount = document.getElementsByName('nammount[]')[i].value;
   
   
	justLetters(cammount,i); 
 
   //start
   
   if(document.getElementsByName('mretainer[]')[i].checked == true){
	   document.getElementsByName('dnammount[]')[i].style.display = 'block'; 
   }else{
	   document.getElementsByName('dnammount[]')[i].style.display = 'none';
	   document.getElementsByName('nammount[]')[i].value = "";  
   }   
   
   //end
   
   if(document.getElementsByName('exempt[]')[i].checked == true){
	   
   
   tax = 0;
   stotal = cammount;
  
   
   document.getElementsByName('tax[]')[i].value = 'n/a';
   document.getElementsByName('stotal[]')[i].value = 'n/a';
   
   
   }else{
   
   if(nammount == ""){
	   //subtotal va a ser igual al monto corriente menos el iva
	   stotal = cammount/1.15; 
	   //iva va a aser icual al monto corriente menos el subtotal
	   tax = cammount-stotal;
   }else{
	   stotal = (cammount-nammount)/1.15; 
	   tax =  cammount-stotal-nammount; 
   }
   
   document.getElementsByName('tax[]')[i].value = tax.toFixed(2);
   document.getElementsByName('stotal[]')[i].value = stotal.toFixed(2);
   } 
   
   
  gtotal += parseFloat(cammount);
  gstotal += parseFloat(stotal);
  //New
  if(cammount >= 1000){
     gstotalmay1000 += parseFloat(stotal);
  }else{
	  gstotalmen1000 += parseFloat(stotal);
  }
  //end new
 
  gtax += parseFloat(tax);
  gnammount += parseFloat(nammount);
 
  }
  i++;
  }
  //gtax = gtax-nammount;
    //alert(nammount);
   
    if(gtotal > 0){
	document.getElementById("totalbill").value = gtotal.toFixed(2);
	}else{
		document.getElementById("totalbill").value = '0.00';
	}
		
    document.getElementById("totaltax").value = gtax.toFixed(2);
    document.getElementById("stotalbill").value = gstotal.toFixed(2);
    //new
    document.getElementById("stotalbillmen1000").value = gstotalmen1000.toFixed(2);
    document.getElementById("stotalbillmay1000").value = gstotalmay1000.toFixed(2);
  
  
	var currency = document.getElementsByName('currency');
	
	   var recipient = document.getElementById("dspayment").value;
   


<?php /*for (var i = 0, length = currency.length; i < length; i++) {
    
	if(recipient == 2){
	   //alert('Hola Mundo');
	   document.getElementsByName('exempt[]')[i].checked = true;
	} 
	
	
	if (currency[i].checked) {
        // do whatever you want with the checked radio
        if(currency[i].value != 1){
			document.getElementById('retainer').checked = true;
			document.getElementById('retainer').readOnly = true;
			document.getElementById('ocurrency').style.display = 'block';
		}else{
			document.getElementById('ocurrency').style.display = 'none';
		}
        // only one radio can be logically checked, don't check the rest
        break;
    }
}*/ ?>

	 
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
	
	var p1 = document.getElementById("retention1").value;
    var p2 = document.getElementById("retention2").value; 
	
	if((p1 != "") || (p2 != "")){
		
	 if(gstotal == 0){
		alert('El monto debe de contener una cantidad');
		//document.getElementById("retention2").value = ""; 
		//document.getElementByName("ammount[]").focus();
	}else{  
		
		var payment = gstotal;
		
		if(p1 != ""){
			var p1ammount = gstotalmay1000*(p1/100);
			document.getElementById("retention1ammount").value = p1ammount.toFixed(2);
			var payment = payment-p1ammount;
		}
		if(p2 != ""){
			var p2ammount = gstotalmay1000*(p2/100);
			document.getElementById("retention2ammount").value = p2ammount.toFixed(2);
			var payment = payment-p2ammount; 
		} 
		var payment = payment+gtax;
		
		if(gnammount > 0){
			var payment = payment+gnammount;   
		}
		
		document.getElementById("payment").value = (payment).toFixed(2);
	}	

  }
  
   
  
}

function justLetters(cammount,i){
	
   $.post("reload-numberstoletters.php", { variable: cammount }, function(data){
	 
  document.getElementsByName('letters[]')[i].value = data;
   
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


function validateForm(){ 

	var provider = document.getElementById("provider").value;
	var recipient = document.getElementById("dspayment").value; 

if(recipient == 0){
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
		if(description == ""){
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
				alert('Usted debe de ingresar el numero de factura.');
				return false;
			}
		}
		
		cammount =  document.getElementsByName('ammount[]')[i].value;
		if(cammount == ""){
			document.getElementsByName('ammount[]')[i].focus();
			alert('Usted debe de ingresar el monto de cada factura.');
			return false;
		}

		cbilldate =  document.getElementsByName('billdate[]')[i].value;
		if(cbilldate == ""){
			document.getElementsByName('billdate[]')[i].focus();
			alert('Usted debe de ingresar la fecha de cada factura.');
			return false;
		}


		if(cammount == 0){
			alert('El monto de la factura no puede ser cero.');
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
		var currency = document.getElementById("currency").value;
	if(currency == 0){
		alert('Usted debe de seleccionar una moneda.');
		return false;
		}
		var payment = document.getElementById("payment").value;
	if(payment == 0){
		alert('No se puede agregar un pago con un monto de 0.00.');
		return false;
		}
		
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
		
		
		if(!/http/.test(file)){
	
		}else{
			$i2++;
		}
		
		
	}
	
	i++;
}
if(i2 == 0){
	alert('Usted debe proporcionar al menos un archivo en cada solicitud.');
	return false;
}
		 	
}

function clear1(){
	document.getElementById("retention1").value = ""; 
}
function clear2(){
	document.getElementById("retention2").value = "";
}
						</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>