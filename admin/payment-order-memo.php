<?php 

include("session-request.php");
if($_SESSION['email'] != 'jairovargasg@gmail.com'){
	header('location: dashboard.php');
	exit(); 
}

$id = $_GET['id'];

$querypconfirm = "select * from payments where id = '$id'";
$resultpconfirm = mysqli_query($con, $querypconfirm);
$rowpconfirm = mysqli_fetch_array($resultpconfirm);


if($rowpconfirm['status'] != 0){
	header('location: dashboard.php');
	exit();
} 

if($rowpconfirm['userid'] != $_SESSION['userid']){
	header('location: dashboard.php');
	exit();
} 

if($rowpconfirm['type'] != '6'){
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

										<form name="porder" id="porder" action="payment-order-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        

											<div class="form-body">

												<h3 class="form-section">Información del Proveedor/Colaborador/Tercero</h3> 
                                                
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
                                                    
<?php
$queryfilemain = "select * from files where payment = '$_GET[id]' and bill = '0' order by id asc limit 1"; 
$resultfilemain = mysqli_query($con, $queryfilemain);
$rowfilemain = mysqli_fetch_array($resultfilemain);
$fileFound = 0;

?>                                                    
                                                    
                                                    <div class="col-md-10 ">
													  <div class="form-group"> 
														<label>Archivo:</label>
														<input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfilemain['id']; ?>">
														<select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." <? /*onChange="javascript:reloadNumbers(),validateBill();"*/?> > 
                                           

											  <option value="">Seleccionar</option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"<?php if((strlen($rowfilemain['link'] > 10)) and (cleanLink($rowfilemain['link']) == $rowfbox['url'])){ echo 'selected'; $fileFound = 1; } ?>><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
<?php } 
if($fileFound == 0){ 
					
	$theMainLink = cleanLink($rowfilemain['link']);
	if($theMainLink != ''){
	$queryfbox2 = "select * from filebox where url = '$theMainLink'";
	$resultfbox2 = mysqli_query($con, $queryfbox2);
	$rowfbox2=mysqli_fetch_array($resultfbox2);													
															?>
<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox2['url'];  ?>" selected><?php echo $rowfbox2['id']." | ".$rowfbox2['title']; ?></option>	
<? }			}												
															?>

												

											</select>
						
                                                          
                       <br> 

    
                                                      <!--/row--></div>
													</div>

													<!--/span-->

												</div>
												
													<div class="row"><!--/span-->

												<? 
														
														
														
														
												?>
												<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Tipo de Solicitúd:</label>


															<select name="dspayment" class="form-control" id="dspayment" onChange="javascript:selectRecipient();">
<option value="0">Seleccionar</option>
																<? 
																
																$queryRequestType = "select * from paymentsTypesMemos order by name";
																$resultRequestType = mysqli_query($con, $queryRequestType);
																while($rowRequestType=mysqli_fetch_array($resultRequestType)){
																
																?>
<option value="<? echo $rowRequestType['id']; ?>" <?php if($rowpconfirm['btype'] == 1) echo 'selected'; ?>><? echo $rowRequestType['name']; ?></option>
<? } ?>
</select>
<script type="text/javascript">
function selectRecipient(){
	
	var recipient = document.getElementById("dspayment").value;
	if(recipient == 1){
		document.getElementById("dproviders").style.display = "block";
		document.getElementById("dworkers").style.display = "none";
		document.getElementById("dinterns").style.display = "none";
		document.getElementById("collaborator").value = "";
		document.getElementById("intern").value = "";
	}else if(recipient == 2){
		document.getElementById("dproviders").style.display = "none";
		document.getElementById("dinterns").style.display = "none";
		document.getElementById("dworkers").style.display = "block";
		document.getElementById("provider").value = "";
		document.getElementById("intern").value = "";
	}else if(recipient == 3){
		document.getElementById("dproviders").style.display = "none";
		document.getElementById("dworkers").style.display = "none";
		document.getElementById("dinterns").style.display = "block";
		document.getElementById("provider").value = "";
		document.getElementById("collaborator").value = "";
	}else{
		document.getElementById("dproviders").style.display = "none";
		document.getElementById("dworkers").style.display = "none";
		document.getElementById("provider").value = "";
		document.getElementById("collaborator").value = "";
	}
	
}
</script>													

													</div>
                                               
                                               </div>
														
												</div>
  
                                                    
                                               <div class="row" id="dproviders" style="display:<?php if($rowpconfirm['btype'] == 1) echo 'block'; else echo 'none'; ?>">
														<!--/span-->

													<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar..." onChange="loadInsurerInfo(this.value),loadCreditcardInfo(this.value),loadcurrency2pay();" >  
                                            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
                                            <script>
												
											
	
											function loadcurrency2pay(){
		
												var dspayment = document.getElementById('dspayment').value;
												var provider = document.getElementById('provider').value;
												var nochange = document.getElementById('nochange').value;
												

												$.ajaxSetup({async:false});

												if(nochange == 0){	
													if(dspayment == '2'){ 
														$("#currency2pay").val(2);  
													}
													else{
		
														$.post("reload-currency2pay.php", { variable: provider }, function(data){
															$("#currency2pay").val(parseInt(data));
			
															document.getElementById('currency2pay').value = data;
																 
														});
													}
	
	  											$.ajaxSetup({async:true}); 
	
												}
											
												} 
											</script>
                                           

											  <option value=""></option>  
<?php $queryproviders = "select * from providers where active = '1'";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){ 
?>
												<option value="<?php echo $rowproviders['id']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['name']." (".$rowproviders['term']." días de plazo)"; ?></option> 
                                                <?php } ?>

												

											</select>
											<div title="Page 5">
											  <div>
															    <div>
															     <span class="help-block">

															 Ingrese código, nombre o parte de el para filtar los resultados. <i style=" color:#FF0004;">Si no le aparece un Proveedor o quiere verificar el plazo de crédito, consulte con el area de Tesorería.</i></span>
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

						
											<select name="collaborator" class="form-control  select2me" id="collaborator" data-placeholder="Seleccionar..." onChange="javascript:validateBill(),loadcurrency2pay();"> 

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

															 Ingrese código, nombre o parte de el para filtar los resultados. <i style=" color:#FF0004;">Si no le aparece un Colaborador, consulte con el area de Tesoría</i></span>
														        </div>
														      </div>
													    </div>
													  </div>

													</div>

													<!--/span-->

												</div>
												
												 <div class="row" id="dinterns" style="display:<?php if($rowpconfirm['btype'] == 3) echo 'block'; else echo 'none'; ?>">
														<!--/span-->

													<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

						
											<select name="intern" class="form-control  select2me" id="intern" data-placeholder="Seleccionar..." onChange="loadInsurerInfo(this.value),loadCreditcardInfo(this.value),loadcurrency2pay();" >  
                                          
                                           

											  <option value=""></option>  
<?php 
												$queryproviders = "select * from interns where active = '1'";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){ 
?>
												<option value="<?php echo $rowproviders['id']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo "$rowproviders[code] | $rowproviders[first] $rowproviders[first2] $rowproviders[last] $rowproviders[last2]"; ?> </option> 
                                                <?php } ?>

												

											</select>
											<div title="Page 5">
											  <div>
															    <div>
															     <span class="help-block">

															 Ingrese código, nombre o parte de el para filtar los resultados. <i style=" color:#FF0004;">Si no le aparece un Pasante, consulte con el area de Tesorería.</i></span>
														        </div>
														      </div>
													    </div>
													  </div>

													</div>

													<!--/span-->

												</div>

												<span class="form-group">
												<input type="hidden" name="currency2pay" id="currency2pay" value="1">  
                                                <input type="hidden" name="nochange" id="nochange" value="0" >
                                                <input type="hidden" name="isInsurer" id="isInsurer" value="0" > 
												<input type="hidden" name="isCreditcard" id="isCreditcard" value="0" > 
                                                    
												</span><!--/row--><!--/row-->
												
																							
													
												<h3 class="form-section">Concepto de Pago</h3>
        
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
		/*alert('Usted debe de seleccionar el tipo de beneficiario.');*/
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

<div id="bill_<?php echo $typeinc; ?>" >
                                                 
<script>

function validateBill(){

loadBeneficiaries2(provider);
//loadcurrency2pay(provider);


var recipient = document.getElementById("dspayment").value;
if(recipient == 1){ 

var provider = document.getElementById('provider').value;			
i=0;
for (var obj in document.getElementsByName('bill[]')){
//

//var billnumber = document.getElementsByName('bill[]')[i].value;
document.getElementsByName('filename[]')[i].value = "Documento "+billnumber;
//  
if (i<document.getElementsByName('bill[]').length){


		var billnumber = document.getElementsByName('bill[]')[i].value;
		
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
                                          



<div class="row"></div> 

<?php //IMI ?>
<div class="col-md-3 "> 
													  <div class="form-group">
														<label>IMI: (C$ Córdobas)</label>
                                                        <input name="bimi[]" type="text" class="form-control" id="bimi[]" value="0.00" onkeypress="return justNumbers(event);" readonly>  
						 
                      
                                                          
                      </div>
													</div>
<?php //Excento IMI ?>                                                    
<div class="col-md-3 " id="dnammount[]" name="dnammount[]"> 
													  <div class="form-group">
														<label>Exento IMI:</label>
                                                        <input name="exempt2[]" type="text" class="form-control" id="exempt2[]" value="<?php if($rowbill['exempt2'] > 0) echo $rowbill['exempt2']; ?>" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();" placeholder=""> 
						 
                      
                                                          
                      </div>
													</div>                                     
													<?php //IR ?>                                       
												    <div class="col-md-3 "> 
													  <div class="form-group">
														<label>IR: (C$ Córdobas)</label>
                                                        <input name="bir[]" type="text" class="form-control" id="bir[]" value="0.00" onkeypress="return justNumbers(event);" readonly>  
						 
                      
                                                          
													</div>
													</div> 
<?php //Excento IR ?>                                                    
<div class="col-md-3 " id="dnammount[]" name="dnammount[]"> 
													  <div class="form-group">
														<label>Exento IR:</label>
                                                        <input name="exempt[]" type="text" class="form-control" id="exempt[]" value="<?php if($rowbill['exempt'] > 0) echo $rowbill['exempt']; ?>" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();" placeholder=""> 
						 
                      
                                                          
                      </div>
													</div>

<div style="display: <? if($isinsurers == 1) echo "block"; else echo "none"; ?>;" id="dInsurers" class="dInsurers">
<div class="row"></div>

<?php //No Poliza ?>
<div class="col-md-3 ">
<div class="form-group">
<label>No. de Póliza:</label> 
<input name="ipolicy[]" type="text" class="form-control" id="ipolicy[]" value="<?php echo $rowbill['ipolicy']; ?>"> 
<div class="row"></div>
</div>
</div>
<?php //Cantidad de Cuotas totales ?>
<div class="col-md-3 ">
<div class="form-group">
<label>Cant. de Cuotas:</label> 
<input name="iquotaqq[]" type="text" class="form-control" id="iquotaqq[]" value="<?php echo $rowbill['iquotaqq']; ?>"> 
<div class="row"></div>
</div>
</div>
<?php //No de Cuota ?>
<div class="col-md-3 ">
<div class="form-group">
<label>No. de Cuota:</label> 
<input name="iquotano[]" type="text" class="form-control" id="iquotano[]" value="<?php echo $rowbill['iquotano']; ?>"> 
<div class="row"></div>
</div>
</div>
<?php //Fecha de Vencimiento de la cuota corriente ?>
<div class="col-md-3 ">
<div class="form-group">
<label>Vencimiento Cuota corriente:</label> 
<input name="iquotaexpiration[]" type="text" class="form-control form-control-inline date-picker" id="iquotaexpiration[]" value="<?php echo $rowbill['iquotaexpiration']; ?>"> 
<div class="row"></div>
</div>
</div>
</div>                                     
   
<input type="hidden" name="ret1a[]" id="ret1a[]" value="0">
<input type="hidden" name="ret2a[]" id="ret2a[]" value="0">
    
    
   <?php if($typeinc > 0){ ?> 
	
	<div id="row"><div class="col-md-12 "> &nbsp;</div></div>
	<div class="col-md-12">
		<button type="button" class="btn red icn-only" onclick="deleteBill(<?php echo $typeinc; ?>),reloadNumbers();"><i class="fa fa-trash-o"></i> Eliminar Documento</button>
	</div> 
    <?php } ?>
    
    <div id="row">
                                                    <div class="col-md-12 "> &nbsp;</div>
                                                    </div> 
 
 
 </div> 
 <?php 
 
 $typeinc++; 
 
 } 
 
 ?>
 
<div id="dbill" style="display:none">
<input id="clickMe" type="button" value="clickme" onclick="reloadBills();" />
</div>
 
 <?php } //end bill
 
 
 else{  ?>
 
   
 <input type="hidden" id="billid[]" name="billid[]" value="0">
 <div id="bill_<?php echo $typeinc; ?>">
<?php 
 
$typeinc++; 
 
?>
 

<?php //Workers ?>
<div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

						
											<select name="collaborator" class="form-control  select2me" id="collaborator" data-placeholder="Seleccionar..." onChange="javascript:validateBill(),loadcurrency2pay();"> 

												<option value=""></option>
<?php $queryworkers = "select * from workers";
$resultworkers = mysqli_query($con, $queryworkers);
while($rowworkers=mysqli_fetch_array($resultworkers)){
?>
												<option value="<?php echo $rowworkers['id']; ?>"<?php if($rowpconfirm['collaborator'] == $rowworkers['id']) echo 'selected'; ?>><?php echo $rowworkers['code']." | ".$rowworkers['first']." ".$rowworkers['last']; ?></option>
                                                <?php } ?>  

												
											</select>

															
													  </div>

													</div>
<?php //Amount ?>                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Documento No:</label>
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
	
	var provider = document.getElementById('provider').value;
	loadBeneficiaries2(provider);
	
	var recipient = document.getElementById("dspayment").value;
	if(recipient == 1){
		i=0;	
		for (var obj in document.getElementsByName('bill[]')){
			
			if (i<document.getElementsByName('bill[]').length){
			
			
				//
			billnumber = document.getElementsByName('bill[]')[i].value;
			/*document.getElementsByName('filename[]')[i].value = "Factura "+billnumber;*/ 
			//
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
													</div>                                                   
<? if(1 == 2){ ?>}
<?php //Bill date ?>                                                     
<div class="col-md-3 ">
<div class="form-group">
														<label>Fecha de Documento:</label> 
                                                        <input name="billdate[]" type="text" class="form-control form-control-inline date-picker" id="billdate[]" value="" onChange="javascript:reloadNumbers();" readonly>
						
                                                          
                       

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>
<? } ?> 





                                     
<div class="row"></div>
<?php //Cantidad en letras ?>
<?php /*<div class="col-md-4 ">
													  <div class="form-group">
														<label>Cantidad en letras:</label> 
                                                        <input name="letters[]" type="text" class="form-control" id="letters[]" value="" readonly> 
						
                                                          
                    

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>*/ ?> 

																								
 
<input type="hidden" name="fileid[]" id="fileid[]" value="0">
<input type="hidden" name="ret1a[]" id="ret1a[]" value="0">
<input type="hidden" name="ret2a[]" id="ret2a[]" value="0">
                                                  
<div id="row">
                                                    <div class="col-md-12 "> &nbsp;</div>
                                                    </div>

</div>
 
<?php }  ?>
													
 <div id="bill"></div>         
   <script type="text/javascript">
  var bill = 1; 
  var cbill = parseInt(<?php echo $typeinc; ?>); 
	function addBill(){
	
	var sametype = document.getElementById("sametype").checked;

		
   var billinfo0 = '<div id="bill_'+cbill+'">';
   //$("#bill").append(billinfo0);
   
   var billinfo01 = '<div class="row"></div><div class="col-md-12"><hr><br></div><div class="row"></div><div class="col-md-4"><div class="form-group"><label class="control-label">Tipo:</label><?php $queryt = "select * from categories where type = 1";
$resultt = mysqli_query($con, $queryt);
$numt = mysqli_num_rows($resultt);
$rowt = mysqli_fetch_array($resultt);
?><select name="type[]" class="form-control" id="type_'+cbill+'" onChange="javascript:reloadsconcept(this.value,'+cbill+');"><option value="0" selected>Seleccionar</option><?php $queryt1 = "select * from categories where parentcat = $rowt[id] order by name asc";
$resultt1 = mysqli_query($con, $queryt1);
while($rowt1=mysqli_fetch_array($resultt1)){
?><option value="<?php echo $rowt1['id']; ?>" <?php if($rowpconfirm['type'] == $rowt1['id']) echo 'selected'; ?>><?php echo $rowt1['name']; ?></option><?php } ?></select></div></div>';
 	
	
var billinfo1 = '<div class="col-md-3"><div class="form-group"><label class="control-label">Tipo de Documento:</label><select name="dtype[]" class="form-control" id="dtype[]"><?php 
$querydtype = "select * from documenttype";
$resultdtype = mysqli_query($con, $querydtype);
while($rowdtype=mysqli_fetch_array($resultdtype)){ ?><option value="<?php echo $rowdtype['id']; ?>" <?php if($rowdtype['id'] == $row['dtype']){ echo "selected"; }?>><?php echo $rowdtype['name']; ?></option><?php } ?></select><br><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Documento No:</label><input name="bill[]" type="text" class="form-control" id="bill[]" value="" onChange="javascript:validateBill();" onFocus="validateProvider();"><br><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Recibido de Documento:</label><input name="billdate2[]" type="text" class="form-control form-control-inline date-picker" id="billdate2[]" value="" onChange="javascript:reloadNumbers();" readonly></div></div><div class="col-md-3"><div class="form-group"><label>Fecha de Documento:</label><input name="billdate[]" type="text" class="form-control form-control-inline date-picker" id="billdate[]" value="" onChange="javascript:reloadNumbers();" readonly></div></div><div class="row"></div><div class="col-md-3 "><div class="form-group"><label>Sub-total (que graba IVA):</label><input name="stotal[]" type="text" class="form-control" id="stotal[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();"><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Sub-total (exento de IVA):</label><input name="stotal2[]" type="text" class="form-control" id="stotal2[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();"><div class="row"></div></div></div><div class="col-md-3 " id="dintur2[]" name="dintur2[]"><div class="form-group"><label>Monto Alojamiento:</label><input name="inturammount[]" type="text" class="form-control" id="inturammount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();"><div class="row"></div></div></div><div class="col-md-3 " id="dintur2[]" name="dintur3[]"><div class="form-group"><label>Monto INTUR:</label><input name="inturammount2[]" type="text" class="form-control" id="inturammount2[]" value="" readonly ><div class="row"></div></div></div><div class="row"></div><div class="col-md-3 "><div class="form-group"><label>Sub-total:</label><input name="bstotal[]" type="text" class="form-control" id="bstotal[]" value="" readonly></div></div><div class="col-md-3 "><div class="form-group"><label><a href="javascript:getCalculator();">IVA:</a></label><input name="tax[]" type="text" class="form-control" id="tax[]" value="" readonly></div></div><div class="col-md-3 "><div class="form-group"><label>Total:</label><input name="ammount[]" type="text" class="form-control" id="ammount[]" value="" readonly><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>TC:</label><input name="btc[]" type="text" class="form-control" id="btc[]" value="N/A" readonly><div class="row"></div></div></div><div class="row"></div><div class="col-md-3 "><div class="form-group"><label>IMI: (C$ Córdobas)</label><input name="bimi[]" type="text" class="form-control" id="bimi[]" value="" readonly><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Exento IMI:</label><input name="exempt2[]" type="text" class="form-control" id="exempt2[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();"> <div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>IR: (C$ Córdobas)</label><input name="bir[]" type="text" class="form-control" id="bir[]" value="" readonly><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Exento IR:</label><input name="exempt[]" type="text" class="form-control" id="exempt[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();"> <div class="row"></div></div></div><input type="hidden" name="ret1a[]" id="ret1a[]" value="0"><input type="hidden" name="ret2a[]" id="ret2a[]" value="0">'; 
	 
	 //
	 //rearea
 
   var billinfo2 = '<div id="row"><div class="col-md-12 "> &nbsp;</div></div><div class="col-md-12"><button type="button" class="btn red icn-only" onclick="deleteBill('+cbill+'),reloadNumbers();"><i class="fa fa-trash-o"></i> Eliminar Documento</button></div>'; 
   
    
	 billunion = billinfo01+billinfo1+billinfo2;
	 $("#bill").append('<div id="bill_'+cbill+'">'+billunion+'</div>');
	 
	 cbill++;
	 ComponentsPickers.init();
  
}

function deleteBill(id){ 
	 $('#bill_'+id).remove();
	 reloadNumbers();
	  
}
</script>  
          <div class="col-md-12" style=""><br><br>
          
          <label>Mismo tipo?</label>
          <input name="sametype" type="checkbox" id="sametype">
                                                   
														<label>&nbsp;</label>
                                                    <button type="button" class="btn blue icn-only" onclick="addBill();"><i class="fa fa-plus"></i> Agregar Documento</button>
             </div> 
               <div class="row"></div><br><br><br>
               
             <div class="col-md-12 ">   <h3 class="form-section">Totales de documentos</h3></div>

                                                    
<?php //TOTAL PAGAR?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="" readonly>
                                                        <input name="retstotal" type="hidden" id="retstotal" value="0">
<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
													

                    
<?php //MONEDA ?>                                                      
<div class="col-md-12"> 

 <h3 class="form-section">Moneda</h3>
 
<div class="form-group"> <?php //<label>Moneda:</label> ?>
<div class="radio-list" style="margin-left:30px;">
											<?php $querycurrency = "select * from currency";
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
                                                 
                                                    	
                                                 
                                                
                                                 
                                                 
                                                 

                                                    


                                                 
                                                 
                                                 
  
                                           
                                                 
                                                 
                                                 
                                                  <h3 class="form-section">Pago a Proveedor</h3>
                                                  
                                              <div class="row"><!--/span-->
                                                <div class="col-md-3 "> 
													  <div class="form-group">
			    <label>Monto a Pagar</label>
			    :											
                                                        <input name="payment" type="text" class="form-control" id="payment" value="" readonly>
 						
                                                          
                                                        <input type="hidden" name="floatpayment" id="floatpayment">
                                                        <input type="hidden" name="floatpaymentnio" id="floatpaymentnio">
                                                        <input type="hidden" name="floatammount2" id="floatammount2">
                                                        <input type="hidden" name="floatcurrency" id="floatcurrency">
                                                        <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
												</div>  
                                                  </div>
                                                  
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



$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit";
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
	
    campo = '<div id="fid_'+tfile+'"><div class="col-md-10"><input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfile2['id']; ?>"><select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"><option value=""></option><?php $queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit 25"; $resultfbox = mysqli_query($con, $queryfbox); while($rowfbox=mysqli_fetch_array($resultfbox)){ ?><option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option><?php } ?></select></div><div class="col-md-2 "><button type="button" class="btn red icn-only" onclick="eliminarFile('+tfile+');">-</button></div><div class="row"></div></div><br><br>';  
	
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
<div class="row">

<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Distribuir pago?</label>

															<select name="distributable" class="form-control" id="distributable" onChange="javascript:makeDistributable(this.value);">
<option value="0" selected>No</option>
<option value="1" <?php if($rowpconfirm['distributable'] == 1) echo 'selected'?>>Si</option> 
															</select>
                                                            
<script>
function makeDistributable(dvalue){
	if(dvalue == 1){
		document.getElementById('ddistribucion3').style.display = 'block';
	}else{
		document.getElementById('ddistribucion3').style.display = 'none';
	}
}
	
</script>
													  </div>

													</div>
                                                 
</div>
<div id="ddistribucion3" <?php if($rowpconfirm['distributable'] == 0){ ?>style="display:none;" <?php } ?>><br>
<div class="row">
<div class="col-md-6 ">
&nbsp;
</div>
                                                   
<div class="col-md-2 "><input type="radio" name="pertot" id="pertot" value="1" checked="" onChange="changePertot(this.value);">
</div>
<div class="col-md-2 "><input type="radio" name="pertot" id="pertot" value="2" onChange="changePertot(this.value);">
</div>
</div> 
<?php 

$querydistributable0 = "select * from distribution where payment = '$_GET[id]'";
$resultdistributable0 = mysqli_query($con, $querydistributable0);
$numdistributable0=mysqli_num_rows($resultdistributable0);
	
if(($rowpconfirm['distributable'] == 1) and ($numdistributable0 > 0)){  ?>
<div class="row" id="distribution<?php echo $distributioni; ?>">

<div class="col-md-6 ">
						    <div class="form-group">
														<label>Unidad:</label>
                                                       
						
           </div>
													</div>
                                                    
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Porcentaje:</label>
                                                                                                                
				
             </div>
													</div> 
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Total:</label>
                                                   
						
                                                          
               </div>
													</div> 
                                                   <div class="col-md-2 "> 
                                                    <div class="form-group">
                                                   		<label>&nbsp;</label><br>
                                         </div>
                                                        </div>
                                                        
     
                                                  
</div>
<?php

$querydistributable = "select * from distribution where payment = '$_GET[id]'";
$resultdistributable = mysqli_query($con, $querydistributable);
$distributioni = 1;
while($rowdistributable=mysqli_fetch_array($resultdistributable)){

?>
<div class="row" id="distribution<?php echo $distributioni; ?>">
<?php //UNIT ?>
<div class="col-md-6 ">
						    <div class="form-group">
														
                                                       <select name="dunit[]" class="form-control  select2me" id="dunit[]" data-placeholder="Seleccionar..."> 
                                           

							    <option value=""></option>
<?php 
$queryproviders = "select * from units";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?>
												<option value="<?php echo $rowproviders['code']; ?>"<?php if($rowdistributable['unit'] == $rowproviders['code']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['name']; ?></option>
                                                <?php } ?>

												

											</select>
						
           </div>
						  </div>
<?php //PERCENT ?>                                                    <div class="col-md-2 ">
													  <div class="form-group">
														
                                                        <input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value="<?php echo $rowdistributable['percent']; ?>" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal(1);">                                                        
	
             </div>
													</div> 
<?php //Total ?>                                                    <div class="col-md-2 ">
													  <div class="form-group">
														
                                                        <input name="dtotal[]" type="text" class="form-control" id="dtotal[]" value="<?php echo $rowdistributable['total']; ?>"readonly onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal(2);"> 
                                                        
						
                                                          
               </div>
													</div> 
<?php //Delete Distribution ?>
<div class="col-md-2 "> 
                                                    <div class="form-group">
                                                   		<label>&nbsp;</label>
                                                        <button type="button" class="btn red" onClick="javascript:deleteRow(<?php echo $distributioni; ?>);">-</button>  </div>
                                                        </div>
                                                        
<input type="hidden" name="did[]" id="did[]" value="<?php echo $rowdistributable['id']; ?>">      
                                                  
</div>

<?php $distributioni++; } ?>

<?php }else{ ?>
						<div class="row">
 <script>
function changePertot(onoff){
	i=0; 
		for (var obj in document.getElementsByName('percent[]')){
 		if (i<document.getElementsByName('percent[]').length){
			
	if(onoff == 2){
	
		document.getElementsByName('percent[]')[i].readOnly = true;
		document.getElementsByName('total[]')[i].readOnly = false;
	}
	if(onoff == 1){
		
		document.getElementsByName('total[]')[i].readOnly = true;
		document.getElementsByName('percent[]')[i].readOnly = false;
	}
		}
		i++;
		}
}
</script>
 <?php $account = "";
 
 if($rowconcept2['account'] != ""){
		$account = $rowconcept2['account'];
	}else{
		if($rowconcept['account'] != ""){
			$account = $rowconcept['account'];
		}else{
			if($rowtype['account'] != ""){
				$account = $rowtype['account'];
			}
		}
	}
														?>
                                                        
<?php //UNIT ?>
<div class="col-md-6 ">
													  <div class="form-group">
														<label>Unidad:</label>
                                                       <select name="dunit[]" class="form-control  select2me" id="dunit[]" data-placeholder="Seleccionar..."> 
                                           

											  <option value=""></option>
<?php $queryproviders = "select * from units";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?>
												<option value="<?php echo $rowproviders['code']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['name']; ?></option>
                                                <?php } ?>

												

											</select>
						
           </div>
													</div>
<?php //PERCENT ?>                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Porcentaje:</label>
                                                        <input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value="" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal(1);">                                                        
		
             </div>
													</div> 
<?php //TOTAL ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="dtotal[]" type="text" class="form-control" id="dtotal[]" value="" readonly onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal(2)"> 
						
                                                          
               </div>
													</div> 
<?php //DELETE ?>                                                   <div class="col-md-2 "> 
                                                    <div class="form-group">
                                                   		<label>&nbsp;</label><br>
                                                        <button type="button" class="btn red" onClick="javascript:deleteRow(1);">-</button>  </div>
                                                        </div>

<input type="hidden" name="did[]" id="did[]" value="0"> 
</div>
<?php } ?>               
                                                    <div id="distributionwaiter">
                                                    </div>
<div class="col-md-1 ">
<button type="button" class="btn blue" onClick="addDistribution();">+</button>
 <br><br>&nbsp;
 </div>                                          
        </div>

<br>
<?php //END OF DISTRIBUTION ?>
<div class="row"></div>


<?php 

$queryroutes = "select routes.* from routes inner join usertype on routes.type = usertype.id where routes.worker = '$_SESSION[userid]' and routes.type = 1 order by routes.unit";
//group by routes.unit
$resultroutes = mysqli_query($con, $queryroutes);
$numroutes = mysqli_num_rows($resultroutes);



if($numroutes == 1){
	$rowroutes = mysqli_fetch_array($resultroutes);
	if(strlen($rowroutes['unit']) >= 4){
		
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
	*/
	
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

												<button type="button" class="btn default" onClick="javascript:cancelAction();"><i class="fa fa-undo"></i> Retornar</button>

										 <button name="draft" id="draft" type="button" class="btn blue" onClick="javascript:saveDraft();"><i class="fa fa-save"></i> Guardar Borrador</button>
                                              <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Ingresar</button>
											    <input name="newbutton" type="hidden" id="newbutton" value="save">
											    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
												<input type="hidden" name="monitor" id="monitor" value="1">
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

function justNumbers(e){
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
    var iscreditcard = document.getElementById("isCreditcard").value;
    var creditcard = document.getElementById("cc").value;

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
    if((creditcard == "0") && (iscreditcard == 1)){
        document.getElementById("cc").focus();
		alert('Usted debe de seleccionar una tarjeta de credito.');
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
var gstotald = gstotald.replace(",", "");
var gstotaldos = gstotald;				
var gstotald = parseFloat(gstotald); 
var tptotal = tptotal.toFixed(2)
if(gstotald == tptotal){
	//Do nothing
	
}else{
	var ddiference = parseFloat(gstotald)-parseFloat(tptotal);
	var ddiference = ddiference*-1;
	alert('La distribucion debe de ser sobre el subtotal. Se enconto una diferencia de '+ddiference+'/'+gstotaldos+'/'+tptotal);
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
		
		*/
		
		
		
}
			
		} //end manualrets
		
		
		
		
		
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

<?php include('payment-request-functions.php'); ?> 

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

function getCalculator(){
	
	

	window.open("calculator-iva.php", "Calculadora", "width=200,height=300");
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