<?php 

require("session-request.php");   

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$querypconfirm = "SELECT * FROM payments WHERE id = ?";
$stmtpconfirm = $con->prepare($querypconfirm);
$stmtpconfirm->bind_param("i", $id);
$stmtpconfirm->execute();
$resultpconfirm = $stmtpconfirm->get_result();
$rowpconfirm = $resultpconfirm->fetch_assoc();
$stmtpconfirm->close();

if($rowpconfirm['status'] != 0){
	header('location: dashboard.php');
	exit();
} 

if($rowpconfirm['userid'] != $_SESSION['userid']){
	header('location: dashboard.php');
	exit();
} 

$typeinc = 0;
$global_limit = 25;
if($_SESSION['email'] == "iespinoza@casapellas.com.ni"){
	$global_limit = 100;
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

<link rel="shortcut icon" href="favicon.ico"/>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<? 

if(($rowpconfirm['btype'] == 1) and ($rowpconfirm['provider'] != '')){
	$ccFunction = "loadCreditcardInfo($rowpconfirm[provider]),";
}
	
?>

<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:<? echo $ccFunction; ?>reloadNumbers(),reloadRouteView()"> 

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
                                                    
<?php
													
$queryfilemain = "SELECT * FROM files WHERE payment = ? AND bill = 0 ORDER BY id ASC LIMIT 1";
$stmtfilemain = $con->prepare($queryfilemain);
$stmtfilemain->bind_param("i", $id);
$stmtfilemain->execute();
$resultfilemain = $stmtfilemain->get_result();
$rowfilemain = $resultfilemain->fetch_assoc();											
													
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

												
                                               
                                               <div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Tipo de Beneficiario:</label>


															<select name="dspayment" class="form-control" id="dspayment" onChange="javascript:selectRecipient(),loadInsurerInfoCaller(this.value);">
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
                                              
											<? if($_SESSION['company'] == 2){ ?>
                                               <div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Pago inmediato:</label>


															<select name="immediate" class="form-control" id="immediate">
<option value="0" selected>No</option>
<option value="1" <?php if($rowpconfirm['immediate'] == 1) echo 'selected'; ?>>Si</option> 
</select>
																										

													</div>
                                               
                                               </div>
                                            <? } ?>
                                               
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

												<span class="form-group">
												<input type="hidden" name="currency2pay" id="currency2pay" value="1">  
                                                <input type="hidden" name="nochange" id="nochange" value="0" >
                                                <input type="hidden" name="isInsurer" id="isInsurer" value="0" > 
												<input type="hidden" name="isCreditcard" id="isCreditcard" value="0" > 
                                                    
												</span><!--/row--><!--/row-->
												<? 
												if(($rowpconfirm['cc'] != '') and ($rowpconfirm['cc'] > 0)){
													$iscreditcard = 1;
												}			
												/*if($ro){
													#
												}*/
												?>
												<div style="display: <? if($iscreditcard == 1) echo "block"; else echo "none"; ?>;" id="dCreditcard" class="dCreditcard">
													
<div class="row"></div>
<div class="row">
<?php //No Poliza ?>
<div class="col-md-6 ">
<div class="form-group">
<label>Tarjeta de Crédito:</label> 
	<select name="cc" class="form-control  select2me" id="cc" data-placeholder="Seleccionar Tarjeta de Credito si aplica..."> 

												<option value="0" selected></option>
<?php $querycreditcards = "select * from creditcards";
$resultcreditcards = mysqli_query($con, $querycreditcards);
while($rowcreditcards=mysqli_fetch_array($resultcreditcards)){
?>
												<option value="<?php echo $rowcreditcards['id']; ?>"<?php if($rowpconfirm['cc'] == $rowcreditcards['id']) echo 'selected'; ?>><?php echo "XXXX-".$rowcreditcards['number']." | ".$rowcreditcards['assigned']; ?></option>
                                                <?php } ?>  

												
											</select>
<div class="row"></div>
	<div>
															     <span class="help-block">

															 Seleccionar TC solo si la solicitud es para pago de Estado de cuenta.</span>
														        </div>
</div>
	</div></div>
													<div class="row"></div>
												</div>												
													
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
<div class="row"></div>
</div>
</div>
													
<?php //start bill 													
			
	$querybill = "SELECT * FROM bills WHERE payment = ?";
	$stmtbill = $con->prepare($querybill);
	$stmtbill->bind_param("i", $id);
	$stmtbill->execute();
	$resultbill = $stmtbill->get_result();
	$numbill = $resultbill->num_rows;
	if($numbill > 0){	
		while ($rowbill = $resultbill->fetch_assoc()) {
			
			$billCurrency = $rowbill['currency'];
	
																								
?>

<div id="bill_<?php echo $typeinc; ?>">
<?php //Tipo ?>  
<div class="col-md-4">
<div class="form-group">
<label class="control-label">Tipo:</label>
<?php 
#$queryt = "select * from accountingCategories where type = 1";
#$resultt = mysqli_query($con, $queryt);
#$numt = mysqli_num_rows($resultt);
#$rowt = mysqli_fetch_array($resultt);
?>
<select name="type[]" class="form-control" id="type_<?php echo $typeinc; ?>" onChange="javascript:reloadCategories(this.value,<?php echo $typeinc; ?>);">

<option value="0" <?php if($rowbill['type'] == 0){ echo 'selected'; } ?>>Seleccionar</option>
<?php $queryt1 = "select * from accountingCategories where parent = '0' order by name asc";
$resultt1 = mysqli_query($con, $queryt1);
while($rowt1=mysqli_fetch_array($resultt1)){
?>														<option value="<?php echo $rowt1['id']; ?>" <?php if($rowbill['type'] == $rowt1['id']) echo 'selected'; ?>><?php echo ucfirst($rowt1['name']); ?></option>

<?php } ?>
	 														</select>

													  </div>

													</div>                                                    
<?php //Concepto ?>                                                    
<div class="col-md-4">

													  <div class="form-group">

															<label class="control-label">Concepto:</label>
															<select name="concept[]" class="form-control" id="concept_<?php echo $typeinc; ?>" onChange="javascript:reloadCategories2(this.value,<?php echo $typeinc; ?>);">
<?php if($rowbill['concept'] == 0){
?>
<option value="0">Esperando la selección de tipo para cargar la lista</option>
<?php }else{ 
$queryconcept = "select * from accountingCategories where parent= '$rowbill[type]' order by name asc";
$resultconcept = mysqli_query($con, $queryconcept);
while($rowconcept=mysqli_fetch_array($resultconcept)){
?>
<option value="<?php echo $rowconcept['id']; ?>" <?php if($rowbill['concept'] == $rowconcept['id']) echo 'selected'; ?>><?php if($rowconcept['account'] != ""){ echo $rowconcept['account']." | "; } echo ucfirst($rowconcept['name']); ?></option>
<?php } } ?>															</select>

												       
												      </div>
                                                    </div>                                               
<?php //Categoria ?>                                                    
<div class="col-md-4"> 
	
<?
$queryconcept2 = "select * from accountingCategories where parent = '$rowbill[concept]' order by name asc";
$resultconcept2 = mysqli_query($con, $queryconcept2);
$numconcept2 = mysqli_num_rows($resultconcept2);
if($numconcept2 == 0){
	$concept2Val = '0';
}else{
	$concept2Val = 'NULL';
}		
?>	
                                                      <div class="form-group">
     <label class="control-label">Categoría:</label>

												        <select name="concept2[]" class="form-control" id="concept2_<?php echo $typeinc; ?>">
													          
	<?php if($rowbill['concept2'] == 0){
	?>											          <option value="<? echo $concept2Val; ?>">Esperando la selección de concepto para cargar la lista</option>
			<?php }else{ 
			
			while($rowconcept2=mysqli_fetch_array($resultconcept2)){
			?>									          <option value="<?php echo $rowconcept2['id']; ?>" <?php if($rowbill['concept2'] == $rowconcept2['id']) echo 'selected="selected"'; ?>><?php echo ucfirst($rowconcept2['name']); ?></option>
			<?php } } ?> 					            </select>                                                  </div>
                                                    </div>
                                                 
<?php /*<input type="hidden" id="billid[]" name="billid[]" value="<?php echo $rowbill['id']; ?>">   */ ?>                                            

<?php //Tipo ?>
<div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Tipo de Documento:</label>

															<select name="dtype[]" class="form-control" id="dtype[]">
<?php 
$querydtype = "select * from documenttype";
$resultdtype = mysqli_query($con, $querydtype);
while($rowdtype=mysqli_fetch_array($resultdtype)){
	
																?>
    <option value="<?php echo $rowdtype['id']; ?>" <?php if($rowdtype['id'] == $rowbill['dtype']){ echo "selected"; }?>><?php echo $rowdtype['name']; ?></option> 
    <?php
 } 
 
 ?>

</select>
																									

													</div>
                                               
                                               </div>
<?php //Factura No ?>
<div class="col-md-3 ">
<div class="form-group">
	<label>Documento No:</label>
	<input name="bill[]" type="text" class="form-control" id="bill[]" value="<?php echo $rowbill['number']; ?>" onChange="javascript:validateFirst(),validateBill();">
	
							
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //Recibido de Factura ?> 
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Recibido de Documento:</label> 
                                                        <input name="billdate2[]" type="text" class="form-control form-control-inline date-picker" id="billdate2[]" value="<?php 

if($rowbill['billdate2'] != "0000-00-00"){
	if($rowbill['billdate2'] != "1969-12-31"){
		$billdate2 = strtotime($rowbill['billdate2']);
		echo date('j-n-Y', $billdate2); 
	}
} 
?>" onChange="javascript:reloadNumbers();" readonly>
						
                                                          
                       

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>
<?php //Fecha de Factura ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de Documento:</label> 
                                                        <input name="billdate[]" type="text" class="form-control form-control-inline date-picker" id="billdate[]" value="<?php 
	if($rowbill['billdate'] != "0000-00-00"){
		if($rowbill['billdate2'] != "1969-12-31"){
			$billdate = strtotime($rowbill['billdate']);
			echo date('j-n-Y', $billdate);
		}
	}
														 ?>" onChange="javascript:reloadNumbers();" readonly>
						
                                                          
                       

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>
<div class="row"></div>                                                    
<?php //Subtotal que graba ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Sub-total (que graba IVA):</label>
                                                        <input name="stotal[]" type="text" class="form-control" id="stotal[]" value="<?php echo $rowbill['stotal']; ?>" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers(this.value);">
</div>
</div>
<?php //Sub total que no graba?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Sub-total (Exento de IVA):</label>
                                                        <input name="stotal2[]" type="text" class="form-control" id="stotal2[]" value="<?php echo $rowbill['stotal2']; ?>" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers(this.value);">
						
                      
                </div>
													</div> 
<?php //Monto alojamiento ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Monto Alojamiento:</label>
                                                        <input name="inturammount[]" type="text" class="form-control" id="inturammount[]" value="<?php echo $rowbill['intur']; ?>" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers(this.value);">
						
                      
                   </div>
													</div>
<?php //Monto INTUR ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Monto INTUR:</label>
                                                        <input name="inturammount2[]" type="text" class="form-control" id="inturammount2[]" value="<?php echo $rowbill['inturammount']; ?>" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers(this.value);" readonly>
						
                      
                                                          
               </div>
													</div>
<?php //StOTAL ?>                                                     
<div class="col-md-3 "> 
						    <div class="form-group">
							  <label>Subtotal:</label>
                              <input name="bstotal[]" type="text" class="form-control" id="bstotal[]" value="0.00" onkeypress="return justNumbers(event);" readonly>  
						 
                      
                                                          
                      </div>
													</div>
<?php //IVA ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label><a href="javascript:getCalculator();">IVA:</a></label>
                                                        <input name="tax[]" type="text" class="form-control" id="tax[]" value="<?php echo $rowbill['tax']; ?>" readonly>
						
                </div>
													</div>
<?php //Total ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="ammount[]" type="text" class="form-control" id="ammount[]" value="<?php echo $rowbill['ammount']; ?>" readonly>
						
          </div>
													</div>
<?php //TC ?>                                       
<div class="col-md-3 "> 
													  <div class="form-group">
														<label>TC:</label>
                                                        <input name="btc[]" type="text" class="form-control" id="btc[]" value="N/A" onkeypress="return justNumbers(event);" readonly>  
						 
                      
                                                          
                      </div>
													</div> 

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
	
<div id="billDistribution_<? ?>">
<div class="row"></div>	
	<div class="col-md-3">
		<label>Distribuir este documento?</label>
	</div>
<div class="row"></div>		
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

 
<?php //tipo ?>
<div class="col-md-4">
<div class="form-group">
<label class="control-label">Tipo:</label>
<select name="type[]" class="form-control" id="type_<?php echo $typeinc; ?>" onChange="javascript:reloadCategories(this.value,<?php echo $typeinc; ?>);">
<option value="0" selected>Seleccionar</option>
<?php
$queryt1 = "select * from accountingCategories where parent = '0' order by name asc";
$resultt1 = mysqli_query($con, $queryt1);
while($rowt1=mysqli_fetch_array($resultt1)){ ?>
<option value="<?php echo $rowt1['id']; ?>"><?php echo ucfirst($rowt1['name']); ?></option>
<?php } ?>
</select>
</div>
</div>                                                    
<?php //concepto ?>
<div class="col-md-4">
<div class="form-group"> 
<label class="control-label">Concepto:</label>
<select name="concept[]" class="form-control" id="concept_<?php echo $typeinc; ?>" onChange="javascript:reloadCategories2(this.value,<?php echo $typeinc; ?>);">
<option value="0">Esperando la selección de tipo para cargar la lista</option>															
</select>
</div>
</div>                                                   
<?php //categoria ?>
<div class="col-md-4"> 
<div class="form-group">
<label class="control-label">Categoría:</label>
<select name="concept2[]" class="form-control" id="concept2_<?php echo $typeinc; ?>">
<option value="0">Esperando la selección de concepto para cargar la lista</option>
</select>
</div>
</div>
<?php //Tipo de documento ?>
<div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Tipo de Documento:</label>

															<select name="dtype[]" class="form-control" id="dtype[]">
<?php 
$querydtype = "select * from documenttype";
$resultdtype = mysqli_query($con, $querydtype);
while($rowdtype=mysqli_fetch_array($resultdtype)){
	?>
    <option value="<?php echo $rowdtype['id']; ?>" <?php if($rowdtype['id'] == $row['dtype']){ echo "selected"; }?>><?php echo $rowdtype['name']; ?></option>
    <?php
 } 
 
 ?>

</select>
																									

													</div>
                                               
                                               </div>
<?php //No factura ?>                                                    
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
	alert('Primero debe de seleccionar el tipo de beneficiario.');	
}
if(recipient == 1){ 	
	if(provider == ''){
		document.getElementById('provider').focus();
		alert('Primero debe de seleccionar el proveedor.');
	}else{
		document.getElementById('provider').readOnly = true; 
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
<?php //Bill date Rec ?>                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Recibido de Documento:</label> 
                                                        <input name="billdate2[]" type="text" class="form-control form-control-inline date-picker" id="billdate2[]" value="" onChange="javascript:reloadNumbers();" readonly>
						
                                                          
                       

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>
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


<div class="row"></div>
<?php //Monto que graba iva ?> 
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Sub-total (que graba IVA):</label>
                                                        <input name="stotal[]" type="text" class="form-control" id="stotal[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();">
						
                      
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                                    
<?php //Monto Exento de iva ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Sub-total (exento de IVA):</label>
                                                        <input name="stotal2[]" type="text" class="form-control" id="stotal2[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();">
						
                      
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                         
<?php //INTUR ?>
<div class="col-md-3 " id="dintur2[]" name="dintur2[]"> 
													  <div class="form-group">
														<label>Monto Alojamiento:</label>
                                                        <input name="inturammount[]" type="text" class="form-control" id="inturammount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();">  
						
                      
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                                
<?php //Monto INTUR ?>
<div class="col-md-3 " id="dintur2[]" name="dintur3[]"> 
													  <div class="form-group">
														<label>Monto INTUR:</label>
                                                        <input name="inturammount2[]" type="text" class="form-control" id="inturammount2[]" value="" readonly >   
						
                      
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>

<div class="row"></div> 
<?php //Subtotal ?> 
<div class="col-md-3 "> 
						    <div class="form-group">
							  <label>Subtotal:</label>
                              <input name="bstotal[]" type="text" class="form-control" id="bstotal[]" value="0.00" onkeypress="return justNumbers(event);" readonly>  
						 
                      
                                                          
                      </div>
													</div>
<?php //IVA ?>                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label><a href="javascript:getCalculator();">IVA:</a></label>
                                                        <input name="tax[]" type="text" class="form-control" id="tax[]" value="" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 
<?php //Total ?>                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="ammount[]" type="text" class="form-control" id="ammount[]" value="" readonly>
						
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                                                        
<?php //TC ?> 
<div class="col-md-3 "> 
													  <div class="form-group">
														<label>TC:</label>
                                                        <input name="btc[]" type="text" class="form-control" id="btc[]" value="N/A" onkeypress="return justNumbers(event);" readonly>  
						 
                      
                                                          
                      </div>
													</div> 
                                                    
                                                   
<div class="row"></div>
<?php //IMI ?>
<div class="col-md-3 "> 
													  <div class="form-group">
														<label>IMI: (C$ Córdobas)</label>
                                                        <input name="bimi[]" type="text" class="form-control" id="bimi[]" value="0.00" onkeypress="return justNumbers(event);" readonly>  
						 
                      
                                                          
                      </div>
													</div>
<?php //Exento IMI ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Exento IMI:</label> 
                                                        <input name="exempt2[]" type="text" class="form-control" id="exempt2[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();"> 
						
                                                          
                    

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                                  
<?php //IR ?>
<div class="col-md-3 "> 
													  <div class="form-group">
														<label>IR: (C$ Córdobas)</label>
                                                        <input name="bir[]" type="text" class="form-control" id="bir[]" value="0.00" onkeypress="return justNumbers(event);" readonly>  
						 
                      
                                                          
                      </div>
													</div> 
 <?php //Exento IR ?>
<div class="col-md-3 ">
<div class="form-group">
<label>Exento IR:</label>
	<input name="exempt[]" type="text" class="form-control" id="exempt[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();"> 
<div class="row"></div>
</div>
</div>	 
<? #finclude('payment-order-new-distribution.php'); ?>											
<div style="display: <? if($isinsurers == 1) echo "block"; else echo "none"; ?>;" id="dInsurers" class="dInsurers">
<div class="row"></div>
<?php //No Poliza ?>
<div class="col-md-3 ">
<div class="form-group">
<label>No. de Póliza:</label> 
<input name="ipolicy[]" type="text" class="form-control" id="ipolicy[]" value=""> 
<div class="row"></div>
</div>
</div>
<?php //Cantidad de Cuotas totales ?>
<div class="col-md-3 ">
<div class="form-group">
<label>Cant. de Cuotas:</label> 
<input name="iquotaqq[]" type="text" class="form-control" id="iquotaqq[]" value=""> 
<div class="row"></div>
</div>
</div>
<?php //No de Cuota ?>
<div class="col-md-3 ">
<div class="form-group">
<label>No. de Cuota:</label> 
<input name="iquotano[]" type="text" class="form-control" id="iquotano[]" value=""> 
<div class="row"></div>
</div>
</div>
<?php //Fecha de Vencimiento de la cuota corriente ?>
<div class="col-md-3 ">
<div class="form-group">
<label>Vencimiento Cuota corriente:</label> 
<input name="iquotaexpiration[]" type="text" class="form-control form-control-inline date-picker" id="iquotaexpiration[]" value=""> 
<div class="row"></div>
</div>
</div>
</div> 												
 
<input type="hidden" name="fileid[]" id="fileid[]" value="0">
<input type="hidden" name="ret1a[]" id="ret1a[]" value="0">
<input type="hidden" name="ret2a[]" id="ret2a[]" value="0">
                                                  
<div id="row">
                                                    <div class="col-md-12 "> &nbsp;</div>
                                                    </div>

</div>
<?php $typeinc++; ?>
<?php }  ?>
													
<div id="bill"></div>         
<script type="text/javascript">
  var bill = 1; 
  var cbill = parseInt(<?php echo $typeinc; ?>); 
	function addBill(){
	
	var sametype = document.getElementById("sametype").checked;
	
	if(sametype == true){
		
	var lastlen = document.getElementsByName('type[]').length;
	var i = lastlen-1;
	var lasttype = document.getElementsByName('type[]')[i].value;
	var lastconcept = document.getElementsByName('concept[]')[i].value;
	var lastconcept2 = document.getElementsByName('concept2[]')[i].value; 
	var sel = document.getElementsByName('type[]')[i];
	var lasttypen = sel.options[sel.selectedIndex].text;
	var sel2 = document.getElementsByName('concept[]')[i];
	var lastconceptn = sel2.options[sel2.selectedIndex].text;
	var sel3 = document.getElementsByName('concept2[]')[i];
	var lastconcept2n = sel3.options[sel3.selectedIndex].text;
	var billinfo0 = '<div id="bill_'+cbill+'">';
   
   var billinfo01 = '<div class="row"></div><div class="col-md-12"><hr><br></div><div class="row"></div><div class="col-md-4"><div class="form-group"><label class="control-label">Tipo:</label><select name="type[]" class="form-control" id="type_'+cbill+'"><option value="'+lasttype+'" selected>'+lasttypen+'</option></select></div></div>';
    
	    var billinfo02 = '<div class="col-md-4"><div class="form-group"><label class="control-label">Concepto:</label><select name="concept[]" class="form-control" id="concept_'+cbill+'"><option value="'+lastconcept+'">'+lastconceptn+'</option></select></div></div>';
	 
	    var billinfo03 = '<div class="col-md-4"><div class="form-group"><label class="control-label">Categoría:</label><select name="concept2[]" class="form-control" id="concept2_'+cbill+'">><option value="'+lastconcept2+'">'+lastconcept2n+'</option></select></div></div>';
    
	 
	 

	}
	else{
		
   var billinfo0 = '<div id="bill_'+cbill+'">';
   //$("#bill").append(billinfo0);
   
   var billinfo01 = '<div class="row"></div><div class="col-md-12"><hr><br></div><div class="row"></div><div class="col-md-4"><div class="form-group"><label class="control-label">Tipo:</label><?php 
   $queryt = "select * from categories where type = 1";
   $resultt = mysqli_query($con, $queryt);
   $numt = mysqli_num_rows($resultt);
   $rowt = mysqli_fetch_array($resultt);
?><select name="type[]" class="form-control" id="type_'+cbill+'" onChange="javascript:reloadCategories(this.value,'+cbill+');"><option value="0" selected>Seleccionar</option><?php 
		$queryt1 = "select * from accountingCategories where parent = '0' order by name asc";
		$resultt1 = mysqli_query($con, $queryt1);
		while($rowt1=mysqli_fetch_array($resultt1)){ 
?><option value="<?php echo $rowt1['id']; ?>"><?php echo ucfirst($rowt1['name']); ?></option><?php } ?></select></div></div>';
     //$("#bill").append(billinfo01);
	 <?php /*
	 
                                                    
	 */ ?>
	 
	    var billinfo02 = '<div class="col-md-4"><div class="form-group"><label class="control-label">Concepto:</label><select name="concept[]" class="form-control" id="concept_'+cbill+'" onChange="javascript:reloadCategories2(this.value,'+cbill+');"><?php if($rowpconfirm['concept'] == 0){
?><option value="0">Esperando la selección de tipo para cargar la lista</option><?php }else{ 
$queryconcept = "select * from accountingCategories where parent = '$rowpconfirm[type]' order by name asc";
$resultconcept = mysqli_query($con, $queryconcept);
while($rowconcept=mysqli_fetch_array($resultconcept)){
?><option value="<?php echo $rowconcept['id']; ?>"><?php echo ucfirst($rowconcept['name']); ?></option>
<?php } } ?></select></div></div>';
     //$("#bill").append(billinfo02);
	 
	    var billinfo03 = '<div class="col-md-4"><div class="form-group"><label class="control-label">Categoría:</label><select name="concept2[]" class="form-control" id="concept2_'+cbill+'"><?php if($rowpconfirm['concept2'] == 0){
	?><option value="0">Esperando la selección de concepto para cargar la lista</option><?php }else{ 
			$queryconcept2 = "select * from accountingCategories where parent = '$rowpconfirm[concept]' order by name asc";
			$resultconcept2 = mysqli_query($con, $queryconcept2);
			while($rowconcept2=mysqli_fetch_array($resultconcept2)){
			?><option value="<?php echo $rowconcept2['id']; ?>"><?php echo ucfirst($rowconcept2['name']); ?></option><?php } } ?></select></div></div>';
     //$("#bill").append(billinfo03);
	 
	 
	} 
	
var billinfo1 = '<div class="col-md-3"><div class="form-group"><label class="control-label">Tipo de Documento:</label><select name="dtype[]" class="form-control" id="dtype[]"><?php 
$querydtype = "select * from documenttype";
$resultdtype = mysqli_query($con, $querydtype);
while($rowdtype=mysqli_fetch_array($resultdtype)){ ?><option value="<?php echo $rowdtype['id']; ?>" <?php if($rowdtype['id'] == $row['dtype']){ echo "selected"; }?>><?php echo $rowdtype['name']; ?></option><?php } ?></select><br><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Documento No:</label><input name="bill[]" type="text" class="form-control" id="bill[]" value="" onChange="javascript:validateBill();" onFocus="validateProvider();"><br><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Recibido de Documento:</label><input name="billdate2[]" type="text" class="form-control form-control-inline date-picker" id="billdate2[]" value="" onChange="javascript:reloadNumbers();" readonly></div></div><div class="col-md-3"><div class="form-group"><label>Fecha de Documento:</label><input name="billdate[]" type="text" class="form-control form-control-inline date-picker" id="billdate[]" value="" onChange="javascript:reloadNumbers();" readonly></div></div><div class="row"></div><div class="col-md-3 "><div class="form-group"><label>Sub-total (que graba IVA):</label><input name="stotal[]" type="text" class="form-control" id="stotal[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();"><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Sub-total (exento de IVA):</label><input name="stotal2[]" type="text" class="form-control" id="stotal2[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();"><div class="row"></div></div></div><div class="col-md-3 " id="dintur2[]" name="dintur2[]"><div class="form-group"><label>Monto Alojamiento:</label><input name="inturammount[]" type="text" class="form-control" id="inturammount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();"><div class="row"></div></div></div><div class="col-md-3 " id="dintur2[]" name="dintur3[]"><div class="form-group"><label>Monto INTUR:</label><input name="inturammount2[]" type="text" class="form-control" id="inturammount2[]" value="" readonly ><div class="row"></div></div></div><div class="row"></div><div class="col-md-3 "><div class="form-group"><label>Sub-total:</label><input name="bstotal[]" type="text" class="form-control" id="bstotal[]" value="" readonly></div></div><div class="col-md-3 "><div class="form-group"><label><a href="javascript:getCalculator();">IVA:</a></label><input name="tax[]" type="text" class="form-control" id="tax[]" value="" readonly></div></div><div class="col-md-3 "><div class="form-group"><label>Total:</label><input name="ammount[]" type="text" class="form-control" id="ammount[]" value="" readonly><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>TC:</label><input name="btc[]" type="text" class="form-control" id="btc[]" value="N/A" readonly><div class="row"></div></div></div><div class="row"></div><div class="col-md-3 "><div class="form-group"><label>IMI: (C$ Córdobas)</label><input name="bimi[]" type="text" class="form-control" id="bimi[]" value="" readonly><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Exento IMI:</label><input name="exempt2[]" type="text" class="form-control" id="exempt2[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();"> <div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>IR: (C$ Córdobas)</label><input name="bir[]" type="text" class="form-control" id="bir[]" value="" readonly><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Exento IR:</label><input name="exempt[]" type="text" class="form-control" id="exempt[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:reloadNumbers();"> <div class="row"></div></div></div><input type="hidden" name="ret1a[]" id="ret1a[]" value="0"><input type="hidden" name="ret2a[]" id="ret2a[]" value="0">'; 
	 
	 //
	 //rearea
 
   var billinfo2 = '<div id="row"><div class="col-md-12 "> &nbsp;</div></div><div class="col-md-12"><button type="button" class="btn red icn-only" onclick="deleteBill('+cbill+'),reloadNumbers();"><i class="fa fa-trash-o"></i> Eliminar Documento</button></div>'; 
   
   var isInsurer = document.getElementById('isInsurer').value;
   if(isInsurer == 1){
   	var billinfo3 = '<div style="display:block;" id="dInsurers" class="dInsurers"><div class="col-md-3 "><div class="form-group"><label>No. de Póliza:</label><input name="ipolicy[]" type="text" class="form-control" id="ipolicy[]" value=""><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Cant. de Cuotas:</label> <input name="iquotaqq[]" type="text" class="form-control" id="iquotaqq[]" value=""> <div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>No. de Cuota:</label> <input name="iquotano[]" type="text" class="form-control" id="iquotano[]" value=""> <div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Vencimiento Cuota corriente:</label> <input name="iquotaexpiration[]" type="text" class="form-control form-control-inline date-picker" id="iquotaexpiration[]" value=""> <div class="row"></div></div></div></div>';
   }else{
   	var billinfo3 = '<div style="display:none;" id="dInsurers" class="dInsurers"><div class="col-md-3 "><div class="form-group"><label>No. de Póliza:</label><input name="ipolicy[]" type="text" class="form-control" id="ipolicy[]" value=""><div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Cant. de Cuotas:</label> <input name="iquotaqq[]" type="text" class="form-control" id="iquotaqq[]" value=""> <div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>No. de Cuota:</label> <input name="iquotano[]" type="text" class="form-control" id="iquotano[]" value=""> <div class="row"></div></div></div><div class="col-md-3 "><div class="form-group"><label>Vencimiento Cuota corriente:</label> <input name="iquotaexpiration[]" type="text" class="form-control form-control-inline date-picker" id="iquotaexpiration[]" value=""> <div class="row"></div></div></div></div>';
   }
    
	 billunion = billinfo01+billinfo02+billinfo03+billinfo1+billinfo3+billinfo2;
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
               
<div class="col-md-12 ">   
<h3 class="form-section">Totales de documentos</h3></div>
<?php //SUBNTOTAL ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Subtotal:</label>
                                                        <input name="stotalbill" type="text" class="form-control" id="stotalbill" value="" readonly>
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
                                                        <input name="totaltax" type="text" class="form-control" id="totaltax" value="" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                                    
<?php //INTUR ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>INTUR:</label>
                                                        <input name="totalintur" type="text" class="form-control" id="totalintur" value="" readonly> 
						
                                                          
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
                                                        <input name="retstotal" type="hidden" id="retstotal" value="0">
<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>													
<?php //EXENTO ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Exento IMI:</label>
                                                        <input name="gexempt2" type="text" class="form-control" id="gexempt2" value="" readonly>  
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 
<?php //EXENTO ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Exento IR:</label>
                                                        <input name="gexempt" type="text" class="form-control" id="gexempt" value="" readonly>  
						
                                                          
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
<?php 
	

	$querycurrency = "select * from currency";
	$resultcurrency = mysqli_query($con, $querycurrency);
	$checked = 1;
	while($rowcurrency=mysqli_fetch_array($resultcurrency)){ ?>
	
	<label class="radio-inline">
		<div class="radio1" id="uniform-optionsRadios4">
			<span class="checked2">
				<input type="radio" name="currency" id="currency" onClick="javascript:reloadNumbers();" value="<?php echo $rowcurrency['id']; ?>" <?php if(($billCurrency == $rowcurrency['id']) or (($billCurrency == '') and ($rowcurrency['id'] == 1))){ echo ' checked'; } ?>></span></div> 
				<?php echo $rowcurrency['name']; ?></label>
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
														<label>Alcaldía (NIO C$):</label>
                                                        <input name="retention1" type="text" class="form-control" id="retention1" value="<?php if($rowpconfirm['ret1'] != 0){ echo $rowpconfirm['ret1']; } ?>" placeholder="%" onKeyUp="javascript:reloadNumbers();" onkeypress="return justNumbers(event);"><span class="input-group-addon bootstrap-touchspin-postfix">%</span> 
						
                                                          
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
														<label>IR (NIO C$):</label>
                                                        <input name="retention2" type="text" class="form-control" id="retention2" value="<?php if($rowpconfirm['ret2'] != 0){ echo $rowpconfirm['ret2']; } ?>" placeholder="%" onKeyUp="javascript:reloadNumbers();" onkeypress="return justNumbers(event);"><span class="input-group-addon bootstrap-touchspin-postfix">%</span>
						
                                                          
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
                                                 
<div class="col-md-3 ">												  <div class="form-group">No retenedor/Exento
													    <label>:</label>
                                                        <input name="retainer" type="checkbox" id="retainer" onChange="javascript:reloadNumbers();" value="1" <?php if($rowpconfirm['retainer'] == 1) echo 'checked'; ?>> 
                                                         
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
</div>
<div class="col-md-3 " <? if(($_SESSION['email'] == 'jairovargasg@gmail.com1') or ($username == 'jairovargasg@gmail.com1')){ 
	 echo 'style="display: none; "';      
 }?>>												  <div class="form-group">Asume GCP (IMI).
													    <label>:</label>
                                                        <input name="retainer2" type="checkbox" id="retainer2" onChange="javascript:reloadNumbers();" value="1" <?php if($rowpconfirm['acp'] == 1) echo 'checked'; ?>> 
                                                         
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
</div>
<div class="col-md-3 " <? if(($_SESSION['email'] == 'jairovargasg@gmail.com1') or ($username == 'jairovargasg@gmail.com1')){ 
	 echo 'style="display: none; "';      
 }?>>												  <div class="form-group">Asume GCP (IR).
						    <label>:</label>
                                                        <input name="retainer3" type="checkbox" id="retainer3" onChange="javascript:reloadNumbers();" value="1" <?php if($rowpconfirm['acp2'] == 1) echo 'checked'; ?>> 
                                                         
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
</div>
<div class="col-md-3 ">												  <div class="form-group">Rets. Manuales
													    <label>:</label>
                                                        <input name="retainer4" type="checkbox" id="retainer4" onChange="javascript:reloadManualRets();" value="1" <?php if($rowpconfirm['manualrets'] == 1) echo 'checked'; ?>>   
                                       <script>
                                       function reloadManualRets(){
										   if(document.getElementById('retainer4').checked == true){
											   document.getElementById('manualretentions').style.display = "block";
											}else{
												document.getElementById('manualretentions').style.display = "none";
											}
											   
									   }
                                       </script>                  
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
</div>                                              </div>
                                                
                                                 
                                                 
                                                 
<div id="manualretentions" style=" display:<?php if($rowpconfirm['manualrets'] == 1){ echo 'block;'; }else{ echo "none;"; } ?>">                                                 
<h3 class="form-section">Retenciones Manuales</h3>
  
<?php
$querymodret = "select * from manualretentions where payment = '$rowpconfirm[id]'";
$resultmodret = mysqli_query($con, $querymodret);
$nummodret = mysqli_num_rows($resultmodret);
if($nummodret > 0){
while($rowmodret=mysqli_fetch_array($resultmodret)){ ?>

<?php //type ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Tipo:</label> 

									<select name="modrettype[]" class="form-control" id="modrettype[]">
<option value="1">IMI</option>
<option value="2">IR</option> 

</select>
																									

													</div>
                                               
                                               </div>
<?php //today?>                                            
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Fecha:</label> 

									  <input name="modrettoday[]" type="text" class="form-control form-control-inline date-picker" id="modrettoday[]" value="<?php 
	if($rowmodret['today'] != "0000-00-00"){
		if($rowmodret['today'] != "1969-12-31"){
			$modrettoday= strtotime($rowmodret['today']);
			echo date('d-m-Y', $modrettoday);
		}
	}
														 ?>"> 
																									

													</div>
                                               
                                               </div>
<?php //Number ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">No:</label> 

									  <input name="modretno[]" type="text" class="form-control" id="modretno[]" value="<?php echo $rowmodret['number']; ?>"> 
																									

													</div>
                                               
                                               </div>               
<?php //Proveedor ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Nombre del retenido:</label> 

									  <input name="modretprovider[]" type="text" class="form-control" id="modretprovider[]" value="<?php echo $rowmodret['provider']; ?>">
																									

													</div>
                                               
                                               </div>
<?php //Direccion ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Dirección:</label> 

									  <input name="modretaddress[]" type="text" class="form-control" id="modretaddress[]" value="<?php echo $rowmodret['address']; ?>">
																									

													</div>
                                               
                                               </div>
<?php //Ruc ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">RUC:</label> 

									  <input name="modretruc[]" type="text" class="form-control" id="modretruc[]" value="<?php echo $rowmodret['ruc']; ?>">
																									

													</div>
                                               
                                               </div>
<?php //Ruc ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Cédula:</label> 

									  <input name="modretnid[]" type="text" class="form-control" id="modretnid[]" value="<?php echo $rowmodret['nid']; ?>" >
																									

													</div>
                                               
                                               </div>
 <?php //Telefono ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Teléfono:</label> 

									  <input name="modretphone[]" type="text" class="form-control" id="modretphone[]" value="<?php echo $rowmodret['phone']; ?>">
																									

													</div>
                                               
                                               </div>
<?php //Direccion ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Concepto de pago:</label> 

									  <input name="modretconcept[]" type="text" class="form-control" id="modretconcept[]" value="<?php echo $rowmodret['concept']; ?>">
																									

													</div>
                                               
                                               </div>
<div class="row"></div>
<?php //Facturas ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Facturas:</label> 

									  <input name="modretbills[]" type="text" class="form-control" id="modretbills[]" value="<?php echo $rowmodret['bills']; ?>">
																									

													</div>
                                               
                                               </div> 
<?php //Total facturas ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Total Facturas (C$):</label>

									  <input name="modrettotalbill[]" type="text" class="form-control" id="modrettotalbill[]" value="<?php echo $rowmodret['totalbill']; ?>">
																									

													</div>
                                               
                                               </div>
<?php //% de retencion ?> 
<div class="col-md-4 ">
													  <div class="form-group">
														<label>% de retención:  </label>
                                                        <input name="modretpercent[]" type="text" class="form-control" id="modretpercent[]" value="<?php echo $rowmodret['percent']; ?>"></div>
													</div>                          
<?php //Total retencion ?>                                                
<div class="col-md-4 ">
						  <div class="form-group">
							<label>Total retención (C$):</label> 
                                                                                  <input name="modrettotalretention[]" type="text" class="form-control" id="modrettotalretention[]" value="<?php echo $rowmodret['totalretention']; ?>"> 
						
                            <!--/row--></div>
													</div>
                                                    <div class="col-md-12 ">
						  <div class="form-group">
							<label>Elaborado por:</label> 
                                                                                  <input name="modretelaborator[]" type="text" class="form-control" id="modretelaborator[]" value="<?php echo $rowmodret['elaborator']; ?>"> 
						
                            <!--/row--></div>
													</div>
                                                 
<?php } ?>

<?php 
}
else{  ?>


<?php //today ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Tipo:</label> 

									<select name="modrettype[]" class="form-control" id="modrettype[]">
<option value="0">Seleccionar</option>
<option value="1">IMI</option>
<option value="2">IR</option> 

</select>
																									

													</div>
                                               
                                               </div>
<?php //today ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Fecha:</label> 

									  <input name="modrettoday[]" type="text" class="form-control form-control-inline date-picker" id="modrettoday[]" value="<?php if($rowmodret['today'] == "0000-00-00") echo ""; else echo "";?>"> 
																									

													</div>
                                               
                                               </div>
<?php //today ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">No:</label> 

									  <input name="modretno[]" type="text" class="form-control" id="modretno[]" value=""> 
																									

													</div>
                                               
                                               </div>               
<?php //Proveedor ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Nombre del retenido:</label> 

									  <input name="modretprovider[]" type="text" class="form-control" id="modretprovider[]" value="">
																									

													</div>
                                               
                                               </div>
<?php //Direccion ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Dirección:</label> 

									  <input name="modretaddress[]" type="text" class="form-control" id="modretaddress[]" value="">
																									

													</div>
                                               
                                               </div>
<?php //Ruc ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">RUC:</label> 

									  <input name="modretruc[]" type="text" class="form-control" id="modretruc[]" value="">
																									

													</div>
                                               
                                               </div>
<?php //Ruc ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Cédula:</label> 

									  <input name="modretnid[]" type="text" class="form-control" id="modretnid[]" value="" >
																									

													</div>
                                               
                                               </div>
 <?php //Telefono ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Teléfono:</label> 

									  <input name="modretphone[]" type="text" class="form-control" id="modretphone[]" value="">
																									

													</div>
                                               
                                               </div>
<?php //Direccion ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Concepto de pago:</label> 

									  <input name="modretconcept[]" type="text" class="form-control" id="modretconcept[]" value="">
																									

													</div>
                                               
                                               </div>
<div class="row"></div>
<?php //Facturas ?>
<div class="col-md-12">

													  <div class="form-group">

														<label class="control-label">Facturas:</label> 

									  <input name="modretbills[]" type="text" class="form-control" id="modretbills[]" value="">
																									

													</div>
                                               
                                               </div> 
<?php //Total facturas ?>
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Total Facturas (C$):</label>

									  <input name="modrettotalbill[]" type="text" class="form-control" id="modrettotalbill[]" value="">
																									

													</div>
                                               
                                               </div>
<?php //% de retencion ?> 
<div class="col-md-4 ">
													  <div class="form-group">
														<label>% de retención:  </label>
                                                        <input name="modretpercent[]" type="text" class="form-control" id="modretpercent[]" value=""></div>
													</div>                          
<?php //Total retencion ?>                                                
<div class="col-md-4 ">
						  <div class="form-group">
							<label>Total retención (C$):</label> 
                                                                                  <input name="modrettotalretention[]" type="text" class="form-control" id="modrettotalretention[]" value=""> 
						
                            <!--/row--></div>
													</div>
                                            <div class="col-md-12 ">
						  <div class="form-group">
							<label>Elaborado por:</label> 
                                                                                  <input name="modretelaborator[]" type="text" class="form-control" id="modretelaborator[]" value=""> 
						
                            <!--/row--></div>
													</div>
                                                    
                                                  
<?php } ?> 
                                                 
<div class="row"></div> 
<div id="rets"></div>
<div class="row"></div> 
<div class="col-md-12"> 
                                         
 <button type="button" class="btn blue icn-only" onclick="addRet();"><i class="fa fa-plus"></i> Agregar Retención</button></div>
 
 <script>
 var tret = 1;
 function addRet(){    
	
	campo2 = '<div id="tretid_'+tret+'"><div class="col-md-12"><hr></div><div class="col-md-4"><div class="form-group"><label class="control-label">Tipo:</label><select name="modrettype[]" class="form-control" id="modrettype[]"><option value="0">Tipo</option><option value="1">IMI</option><option value="2">IR</option></select></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Fecha:</label><input name="modrettoday[]" type="text" class="form-control form-control-inline date-picker" id="modrettoday[]" value=""></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">No:</label><input name="modretno[]" type="text" class="form-control" id="modretno[]" value=""></div></div><div class="col-md-12"><div class="form-group"><label class="control-label">Nombre del retenido:</label><input name="modretprovider[]" type="text" class="form-control" id="modretprovider[]" value=""  ></div></div><div class="col-md-12"><div class="form-group"><label class="control-label">Dirección:</label> <input name="modretaddress[]" type="text" class="form-control" id="modretaddress[]" value=""  ></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">RUC:</label> <input name="modretruc[]" type="text" class="form-control" id="modretruc[]" value="" ></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Cédula:</label><input name="modretnid[]" type="text" class="form-control" id="modretnid[]" value="" ></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Teléfono:</label><input name="modretphone[]" type="text" class="form-control" id="modretphone[]" value="" ></div></div><div class="col-md-12"><div class="form-group"><label class="control-label">Concepto de pago:</label><input name="modretconcept[]" type="text" class="form-control" id="modretconcept[]" value="" ></div></div><div class="col-md-12"><div class="form-group"><label class="control-label">Facturas:</label><input name="modretbills[]" type="text" class="form-control" id="modretbills[]" value=""  ></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Total Facturas:</label><input name="modrettotalbill[]" type="text" class="form-control" id="modrettotalbill[]" value=""  ></div></div><div class="col-md-4 "><div class="form-group"><label>% de retención:</label><input name="modretpercent[]" type="text" class="form-control" id="modretpercent[]" value=""  ></div></div><div class="col-md-4 "><div class="form-group"><label>Total retención:</label><input name="modrettotalretention[]" type="text" class="form-control" id="modrettotalretention[]" value=""></div></div><div class="col-md-12 "><div class="form-group"><label>Elaborado por:</label><input name="modretelaborator[]" type="text" class="form-control" id="modretelaborator[]" value=""><!--/row--></div></div><div class="row"></div><div class="col-md-2 "><button type="button" class="btn red icn-only" onclick="eliminarRet('+tret+');">-</button></div><div class="row"></div><br></div>';
    $("#rets").append(campo2); 
	tret++;
	
	ComponentsPickers.init();
	
}

function eliminarRet(tretid){
	 $('#tretid_'+tretid).remove(); 
}

 </script>
 
     <div class="row"></div><br>
<br>
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
                                                  
                                                       
												
												
												
												<h3 class="form-section"><a id="solvency"></a>Solvencia Fiscal</h3>
												
												<div class="row">
													
													<div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Expiración de la Solvencia:</label>
                                                        <?
                                                        $solvencyDate = "";
                                                        if ( $rowpconfirm[ 'solvencyExpiration' ] != "0000-00-00" ) {
                                                          if ( $rowpconfirm[ 'solvencyExpiration' ] != "1969-12-31" ) {
															  if ( $rowpconfirm[ 'solvencyExpiration' ] != "1970-01-01" ) {
                                                            	$solvencyDate = strtotime( $rowpconfirm[ 'solvencyExpiration' ] );
                                                            	$solvencyDate = date( 'j-n-Y', $solvencyDate );
                                                          	}
														  }
                                                        }
                                                        ?>

									  <input name="solvency" type="text" class="form-control form-control-inline date-picker" id="solvency" value="<?php echo $solvencyDate; ?>" readonly> 
																									

													</div>
                                               
                                               </div>
													
													<div class="row"></div>
													
													   <div id="solvency">
    
                                                
                                                     <div class="col-md-10 ">
													  <div class="form-group">
                                                        <?

                                                        $querysolvency = "select * from paymentsSolvency where payment = '$rowpconfirm[id]' order by id desc limit 1";
                                                        $resultsolvency = mysqli_query($con, $querysolvency);
                                                        $numsolvency = mysqli_num_rows($resultsolvency);
                                                        if ( $numsolvency > 0 ) {
                                                          $rowsolvency = mysqli_fetch_array( $resultsolvency );
                                                          $solvencyId = $rowsolvency[ 'id' ];
														  $solvencyLid = $rowsolvency[ 'linkid' ];
                                                        } else {
                                                          $solvencyId = 0;
															$solvencyLid = 0;
                                                        }
													
                                                        ?>
													    <select name="solvencyfile" class="form-control  select2me" id="solvencyfile" data-placeholder="Seleccionar..."> 
															
															
													
                                           

											  <option value=""></option>
															
											
<?php 
											
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
	<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'].','.$rowfbox['id'].','.$solvencyId;  ?>" <? if($solvencyLid == $rowfbox['id']) echo 'selected'; ?>><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
<?php } ?>

												

											</select><br>
														  <div class="row"></div>
														</div></div> 
                                                      
                                                    </div>
              <? /*<div class="col-md-2 "><button type="button" class="btn blue icn-only" onclick="agregar();"><i class="fa fa-plus"></i></button>
             </div>   */ ?>                     
												
												
													
												</div>
												
										
												<h3 class="form-section"><a id="files"></a>Archivos adicionales</h3>
                                                  
                                                  <div class="row"><!--/span--> 
                                                  
                                                  <div id="emails">
												
                                                    <?php 
													  
													  

													  $queryfile2 = "SELECT * FROM files WHERE payment = ? ORDER BY id ASC";
													  $stmtfile2 = $con->prepare($queryfile2);
													  $stmtfile2->bind_param("i", $id);
													  $stmtfile2->execute();
													  $resultfile2 = $stmtfile2->get_result();
													  $filecount = 0;
													  while ($rowfile2 = $resultfile2->fetch_assoc()){
		
														  $filecount++;
														  if($filecount > 1){
		
	?>
                                                     <div id="fid<? echo $filecount; ?>"> 
													 <div class="col-md-10 ">
													  <div class="form-group">
														  <input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfile2['id']; ?>">
														  <select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..."> 
                                           

											  <option value=""></option>
												<?php 
	
												$queryfbox = "SELECT * FROM filebox WHERE user = ? ORDER BY id DESC LIMIT ?";
												$stmtfbox = $con->prepare($queryfbox);
												$stmtfbox->bind_param("ii", $_SESSION['userid'], $global_limit);
												$stmtfbox->execute();
												$resultfbox = $stmtfbox->get_result();
												while ($rowfbox = $resultfbox->fetch_assoc()) { ?>
													<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"<?php if(cleanLink($rowfile2['link']) == $rowfbox['url']) echo 'selected'; ?>><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>   
                                            
											<div class="row"></div></div></div> 
													  
													 <div class="col-md-2 "><button type="button" class="btn red icn-only" onclick="eliminarFile(<? echo $filecount; ?>);">-</button></div> 
													 </div>
													
                                            <?php 
												//End while
												}
											//End if
											}
 											?>
													 <? if($filecount == 0){ ?> 
                                                     <input type="hidden" name="fileid[]" id="fileid[]" value="0">	
                                                     <div class="col-md-10 ">
													  <div class="form-group">
													    <select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select><br><div class="row"></div></div></div> 
													  
													  <? } ?>
                                                      
                                                    </div>
													  
												  <? if($filecount > 0){ echo '<div class="row"></div>'; } ?>   
              									  <div class="col-md-2 ">
													  <button type="button" class="btn blue icn-only" onclick="agregar();"><i class="fa fa-plus"></i></button>
             									  </div>                        
                                                     
                                   
                                                     

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

$querydistributable0 = "select * from distribution where payment = '$rowpconfirm[id]'";
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

$querydistributable = "select * from distribution where payment = '$rowpconfirm[id]'";
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
				$queryproviders = "select * from units where active = '1'";
				$resultproviders = mysqli_query($con, $queryproviders);
				while($rowproviders=mysqli_fetch_array($resultproviders)){ ?>
				<option value="<?php echo $rowproviders['newCode'].','.$rowproviders['id']; ?>"<?php if($rowdistributable['unit'] == $rowproviders['newCode']) echo 'selected'; ?>><?php echo $rowproviders['newCode']." | $rowproviders[companyName] $rowproviders[lineName] $rowproviders[locationName]"; ?></option>
                <?php } ?>
			</select>
		</div>
	</div>
	<?php //PERCENT ?>
	<div class="col-md-2 ">
			<div class="form-group">
				<input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value="<?php echo $rowdistributable['percent']; ?>" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal(1, this);"> 
             </div>
		</div> 
	<?php //Total ?>
	<div class="col-md-2 ">
		<div class="form-group">
			<input name="dtotal[]" type="text" class="form-control" id="dtotal[]" value="<?php echo $rowdistributable['total']; ?>"readonly onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal(2, this);">
		</div>
	</div> 
	<?php //Delete Distribution ?>
	<div class="col-md-2 ">
		<div class="form-group">
			<label>&nbsp;</label>
			<button type="button" class="btn red" onClick="javascript:deleteRow(<?php echo $distributioni; ?>);">-</button>  
		</div>
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
	}
else{
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
<?php $queryproviders = "select * from units where active = '1'";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?>
												<option value="<?php echo $rowproviders['newCode'].','.$rowproviders['id']; ?>"><?php echo $rowproviders['newCode']." | $rowproviders[companyName] $rowproviders[lineName] $rowproviders[locationName]"; ?></option>
                                                <?php } ?>

												

											</select>
						
           </div>
													</div>
<?php //PERCENT ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Porcentaje:</label>
                                                        <input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value="" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal(1, this);">                                                        
		
             </div>
													</div> 
<?php //TOTAL ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="dtotal[]" type="text" class="form-control" id="dtotal[]" value="" readonly onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal(2, this)"> 
						
                                                          
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
$queryroutes = "select units.id, units.newCode, units.companyName, units.lineName, units.locationName, routes.headship from routes inner join units on routes.unitid = units.id where routes.worker = '$_SESSION[userid]' and routes.type = '1' and units.active = '1' order by routes.unit";
$resultroutes = mysqli_query($con, $queryroutes);
$numroutes = mysqli_num_rows($resultroutes);
if($numroutes == 9999999){ 
												
												?> 

  <h3 class="form-section"><a id="route"></a>Ruta de pago</h3> 
   <div class="row">
   <div class="col-md-12" id="routeFill" onLoad="javascript:reloadRouteView();"> 
   
   <select name="theroute" class="form-control" id="theroute" style="display: none;"> 
                                                  
	<?php while($rowroutes=mysqli_fetch_array($resultroutes)){ 
		
	$thename = $rowroutes['companyName'].' '.$rowroutes['lineName'].' '.$rowroutes['locationName'];
	$thecode = $rowroutes['id'];
	
	if($rowroutes['headship'] > 0){
		$queryheadship = "select * from headship where id = '$rowroutes[headship]' and deleted = '0'";
		$resultheadship = mysqli_query($con, $queryheadship);
		$rowheadship = mysqli_fetch_array($resultheadship);
	}
	
?>
<option value="<?php echo $thecode; ?>,<?php echo $rowroutes['headship']; ?>" class="<?php echo $rowpconfirm['route']; ?>" <?php if($thecode == $rowpconfirm['routeid']) echo 'selected'; ?>><?php echo $rowroutes['newCode']." | ".$thename; if($rowroutes['headship'] > 0){ echo ' > '.$rowheadship['name']; } ?></option>
<?php } ?>
															</select> 
	   
	   <p><? echo $thename; ?></p>
	   </div>
    </div>
	<?php
}
elseif($numroutes > 0){ ?>
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
		$queryheadship = "select * from headship where id = '$rowroutes[headship]' and deleted = '0'";
		$resultheadship = mysqli_query($con, $queryheadship);
		$rowheadship = mysqli_fetch_array($resultheadship);
	}
	
?>
<option value="<?php echo $thecode; ?>,<?php echo $rowroutes['headship']; ?>" class="<?php echo $rowpconfirm['route']; ?>" <?php if($thecode == $rowpconfirm['routeid']) echo 'selected'; ?>><?php echo $thename; if($rowroutes['headship'] > 0){ echo ' > '.$rowheadship['name']; } ?></option>
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
                                                                                            
                                                                                            
                                                      <div id="row">
														  <div class="col-md-12 ">
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
											    <input type="hidden" name="id" id="id" value="<?php echo $rowpconfirm['id']; ?>">
												<input type="hidden" name="monitor" id="monitor" value="1">
												<input type="hidden" name="ncatalog" id="ncatalog" value="1">
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


function reloadCategories(nid,i){		
	$.post("reload-categories.php", { variable: nid, type: 1 }, function(data){ 
	 document.getElementById("concept_"+i).innerHTML = data;
	});
	reloadCategories2(0,i);
}

function reloadCategories2(nid,i){		
	$.post("reload-categories.php", { variable: nid, type: 2 }, function(data){ 
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

	validateBill();
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
		if(currentconcept2 == 'NULL'){
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
/*
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
}*/
			
			
// Parser robusto que soporta "1,120.50" y "1.120,50", con o sin símbolo de moneda
function parseMoney(input) {
  let s = String(input).trim();

  // quitar moneda, espacios y otros símbolos comunes
  s = s.replace(/[^\d.,\-]/g, '');

  const hasComma = s.indexOf(',') !== -1;
  const hasDot   = s.indexOf('.') !== -1;

  if (hasComma && hasDot) {
    // Si hay ambos, asumimos que el separador decimal es el último que aparece
    const lastComma = s.lastIndexOf(',');
    const lastDot   = s.lastIndexOf('.');
    if (lastComma > lastDot) {
      // decimal = coma -> quitar puntos de miles y cambiar coma por punto
      s = s.replace(/\./g, '').replace(',', '.');
    } else {
      // decimal = punto -> quitar comas de miles
      s = s.replace(/,/g, '');
    }
  } else if (hasComma && !hasDot) {
    // Solo coma: tratarla como decimal (estilo "1.120,50" o "1120,50")
    s = s.replace(/\./g, '').replace(',', '.');
  } else {
    // Solo punto o solo dígitos: quitar separadores de miles por si acaso
    s = s.replace(/,/g, '');
  }

  const n = Number(s);
  return isNaN(n) ? 0 : n;
}

// Mantén estos helpers si quieres trabajar en centavos:
function _toCents(v){ return Math.round(parseMoney(v) * 100); }
function _fmt(n){ return (Number(n) || 0).toLocaleString('en-US',{minimumFractionDigits:2, maximumFractionDigits:2}); }

// 1) Sumar distribuido desde dtotal[]
var tptotal = 0;
var _els = document.getElementsByName('dtotal[]');
for (var i = 0; i < _els.length; i++) {
  tptotal += parseMoney(_els[i].value); // <— usa el parser robusto
}

// 2) Leer subtotal y comparar en centavos
var gstotald = document.getElementById('stotalbill').value; // e.g. "1,120,000.00" o "1.120.000,00"
var gstotaldos = gstotald;

var gstotald_cents = _toCents(gstotald);
var tptotal_cents  = _toCents(tptotal);
tptotal = tptotal_cents / 100;

if(Math.abs(gstotald_cents - tptotal_cents) <= 100) {
  // Ok
} else {
  var ddiference_cents = tptotal_cents - gstotald_cents;
  var ddiference = ddiference_cents / 100;

  alert(
    '*La distribucion debe de ser sobre el subtotal.\n' +
    'Diferencia: ' + _fmt(ddiference) + '\n' +
    'Subtotal:   ' + _fmt(gstotald_cents / 100) + '\n' +
    'Distribuido:' + _fmt(tptotal_cents / 100)
  );
  return false;
}
			
			//EndCH

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

   var distributionboxadd = '<div class="row" id="distribution'+distributioni+'"><div class="col-md-6 "><select name="dunit[]" class="form-control  select2me" id="dunit[]" data-placeholder="Seleccionar..."><option value=""></option><?php $queryproviders = "select * from units where active = '1'";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?><option value="<?php echo $rowproviders['newCode'].','.$rowproviders['id']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['newCode']." | $rowproviders[companyName] $rowproviders[lineName] $rowproviders[locationName]"; ?></option><?php } ?></select></div><div class="col-md-2 "><div class="form-group"><input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value=""  onKeyUp="javascript:calculateTheTotal(1, this);" '+readOnly1+'></div></div> <div class="col-md-2 "><div class="form-group"><input name="dtotal[]" type="text" class="form-control" id="dtotal[]" value="" '+readOnly2+' onKeyUp="javascript:calculateTheTotal(2, this);" onkeypress="return justNumbers(event);"></div></div> <div class="col-md-2 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+distributioni+');">-</button></div></div><input type="hidden" name="did[]" id="did[]" value="0"></div>'; 
     distributioni++; 
	 $("#distributionwaiter").append(distributionboxadd);  
	 
	 Metronic.init(); 
	 //init metronic core components
	
}

function toNumber(v){ return Number(String(v).replace(/[^0-9.\-]/g,'')) || 0; }
function formatNumber(n){ return n.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2}); }

function calculateTheTotal(mode, el){
  const total = toNumber(document.getElementById('stotalbill').value);
  const percEls  = document.getElementsByName('dpercent[]');
  const totalEls = document.getElementsByName('dtotal[]');
	
	// Para todos los %: formatear SOLO en blur
percEls.forEach(el => {
  el.addEventListener('blur', () => {
    const v = toNumber(el.value);
    el.value = Number.isFinite(v) ? v.toFixed(2) : '';
  });
});

// Para todos los montos: formatear SOLO en blur
totalEls.forEach(el => {
  el.addEventListener('blur', () => {
    const v = toNumber(el.value);
    el.value = Number.isFinite(v) ? formatNumber(v) : '';
  });
});

  // índice del campo actualmente editado
  let activeIdx = -1;
  if (el) {
    // ¿está en la lista de porcentajes?
    activeIdx = Array.prototype.indexOf.call(percEls, el);
    if (activeIdx === -1) {
      // si no, quizá es uno de montos
      activeIdx = Array.prototype.indexOf.call(totalEls, el);
    }
  }

  if (mode === 1) {
    let sumPercent = 0;
    for (let i = 0; i < percEls.length; i++) {
      const p = toNumber(percEls[i].value);
      sumPercent += p;

      // Si se pasa, avisar y limpiar el campo editado
      if (sumPercent > 100.05) { 
        alert('La distribución no puede ser mayor a 100%.');
        if (activeIdx >= 0 && percEls[activeIdx]) {
          percEls[activeIdx].value = '';
          if (totalEls[activeIdx]) totalEls[activeIdx].value = '';
          percEls[activeIdx].focus();
        }
        return; // detener aquí, no sigas recalculando
      }

      const amount = total * (p / 100);
      totalEls[i].value = formatNumber(amount); // muestra formateado
    }
    // opcional: formatea el total visual
    document.getElementById('stotalbill').value = formatNumber(total);
  }

  if (mode === 2) {
  let sumPercent = 0;

  for (let i = 0; i < totalEls.length; i++) {
    const amount = toNumber(totalEls[i].value);
    const p = total ? (amount / total * 100) : 0;
    const pRound = Math.round(p * 100) / 100;

    // 1) NO pisar el % si ese input está en edición
    const pctHasFocus = document.activeElement === percEls[i];
    if (!pctHasFocus) {
      // escribe con 2 decimales SOLO si no está enfocado
      percEls[i].value = Number.isFinite(pRound) ? pRound.toFixed(2) : '';
    }

    sumPercent += Number.isFinite(pRound) ? pRound : 0;

    // 2) NO formatear el monto si ese input está en edición
    const amtHasFocus = document.activeElement === totalEls[i];
    if (!amtHasFocus) {
      totalEls[i].value = formatNumber(amount);
    }
  }

  // 3) Feedback suave; NO bloquear ni limpiar campos en medio de la edición
  const EPS = 0.00001;
  if (sumPercent > 100 + EPS) {
    // muestra aviso en pantalla en lugar de alert + reset
    showDistWarning('La distribución supera 100%. Ajusta los valores.'); // implementa este UI
  } else {
    clearDistWarning(); // limpia el aviso si usas uno
  }

  // 4) Mantén subtotal formateado (esto no interfiere con inputs)
  document.getElementById('stotalbill').value = formatNumber(total);
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
	var myroute2 = document.getElementById('theroute'); 
	var newcode = myroute2.options[myroute2.selectedIndex].text; 
    $.post("reload-route.php", { myvariable: myroute, newcode: newcode }, function(data){
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
<script type="text/javascript">
<? $filecount++; ?>	
var tfile = <? echo $filecount; ?>;
function agregar(){
	
    campo = '<div id="fid'+tfile+'"><div class="col-md-10"><input type="hidden" name="fileid[]" id="fileid[]" value="0"><select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"><option value=""></option><?php $queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit"; $resultfbox = mysqli_query($con, $queryfbox); while($rowfbox=mysqli_fetch_array($resultfbox)){ ?><option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option><?php } ?></select></div><div class="col-md-2 "><button type="button" class="btn red icn-only" onclick="eliminarFile('+tfile+');">-</button></div><div class="row"></div></div><br>';  
	
    $("#emails").append(campo);

	
	tfile++;
	Metronic.init();
	
	
}
function eliminarFile(fid){
	$('#fid'+fid).remove();
}

function validateBill(){
			var provider = document.getElementById('provider').value;	
			loadBeneficiaries2(provider);
			var recipient = document.getElementById("dspayment").value;
			
			if(recipient == 1){ 
        		var bills = []; 
        		var duplicates = [];
        		var elements = document.getElementsByName('bill[]');

				for (var i = 0; i < elements.length; i++) {
					var billnumber = elements[i].value;
					if (bills.includes(billnumber)) {
                		if (!duplicates.includes(billnumber)) {
                     		elements[i].value = ""; // Limpiar el campo duplicado
                			alert(`El número de documento "${billnumber}" ya está siendo utilizado en esta solicitud.`);
                		}
            		} else {
                		bills.push(billnumber);
            		}
					cleanBill(billnumber,provider,i);
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
			$.post("validate-bill.php", { variable: billnumber, variable2: provider, payment: '<?php echo $rowpconfirm['id']; ?>' }, function(data){
				if(data == 0){
					//
				}else{
					alert(data);
					document.getElementsByName('bill[]')[i].value = "";
					document.getElementsByName('bill[]')[i].focus();
				}
			});	
		}
	

document.getElementById('porder').addEventListener('submit', () => { 
  const els = document.getElementsByName('dtotal[]');
  for (let i = 0; i < els.length; i++) {
    els[i].value = unformatNumber(els[i].value).toFixed(2); // "224000.00"
  }
});

	</script>