<?php 

include("session-request.php");  
include('functions.php');

if(($_SESSION['request-7'] == 'active') or ($_SESSION['admin'] == 'active')){ 
	#doNothing
}else{
	exit('<script>alert("Error de persimos. Contactar al administrador."); window.location = "dashboard.php";</script>');
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$id = sanitizeInput($id, $con);
$userId = sanitizeInput($_SESSION['userid'], $con);

$querypconfirm = "select * from payments where id = ?";
$stmtpconfirm = $con->prepare($querypconfirm);
$stmtpconfirm->bind_param("i", $id);
$stmtpconfirm->execute();
$resultpconfirm = $stmtpconfirm->get_result();
$rowpconfirm = $resultpconfirm->fetch_assoc();

if($rowpconfirm['status'] > 0){
	exit('<script>alert("Pago se encuentra en otra etapa."); window.location="payments.php";</script>');
}

$queryHC = "select * from payments where id = ?";
$stmtHC = $con->prepare($queryHC);
$stmtHC->bind_param("i", $id);
$stmtHC->execute();
$resultHC = $stmtHC->get_result();
$rowHC = $resultHC->fetch_assoc();

$typeinc = 0;
	
?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en" >

<!--<![endif]-->

<!-- BEGIN HEAD --><head>

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
	
<? 
$distributionJs = ''; 
if($rowpconfirm['distributable'] == 1){
	$distributionJs = ',checkTheTotal(1)';
}
	
$templateJs = '';
$loadtemplateJs = '';	
if(($rowHC['hctype'] == 2) or ($rowHC['hctype'] == 3)){  
		
	if($rowHC['uTemplate'] == 1){
		$templateJs = ",sType2($rowHC[uTemplate])";
	} 	
	if($rowHC['template'] > 0){
		$loadtemplateJs = ",loadTemplate($rowHC[template])";
	} 
}
$calculateTheTotalJs = '';
if(($rowHC['hctype'] == 5) or ($rowHC['hctype'] == 7)){ 
	$calculateTheTotalJs = ',calculateTheTotal()';
}	
	
?>	

<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:reloadRouteView(),sType(<? echo $rowHC['hctype']; ?>)<? echo $distributionJs.$templateJs.$loadtemplateJs.$calculateTheTotalJs; ?>;">  	

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

					Pagos <small>Solicitud de Pago CH</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="payments-hc.php">Solicitudes CH</a>
                             <i class="fa fa-angle-right"></i>
                             </li>

						<li>

							<a href="#">Agregar</a>

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

										<form name="porder" id="porder" action="payment-order-hc-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        

											<div class="form-body">

												<h3 class="form-section">Información General</h3> 
                                                <div class="row">
                                                <!--/span-->

													<div class="col-md-2">

													  <div class="form-group">

	<label class="control-label">ID de Pago:</label>
										
											  <input name="id" type="text" class="form-control" id="id" value="<? echo $_GET['id']; ?>" readonly>  
								
															<div title="Page 5">
															  <div>
															    <div></div>
														      </div>
													    </div>
													  </div>

													</div> 
                                                    
                                                   
                                                    
                            
                                                   
</div>
                                                  
                                                  <div id="client-stage">

                                                  <div class="row">
                                                   
<div class="col-md-4">

<div class="form-group">
<label class="control-label">Tipo de solicitud</label>
<select name="stype" class="form-control" id="stype" onChange="sType(this.value),fnCleanup();">
	<option value="0" selected>Seleccionar</option>
	<option value="1" <? if($rowHC['hctype'] == 1) echo "selected"; ?>>Ayudas economicas</option> 
	<option value="2" <? if($rowHC['hctype'] == 2) echo "selected"; ?>>Embargo judicial</option> 
	<option value="3" <? if($rowHC['hctype'] == 3) echo "selected"; ?>>Pension alimenticia</option>
	<option value="4" <? if($rowHC['hctype'] == 4) echo "selected"; ?>>IR Laboral</option>
	<option value="5" <? if($rowHC['hctype'] == 5) echo "selected"; ?>>INSS Labora/Patronal</option>
	<option value="7" <? if($rowHC['hctype'] == 7) echo "selected"; ?>>INATEC</option>
	<option value="8" <? if($rowHC['hctype'] == 8) echo "selected"; ?>>Comisiones</option>
	<option value="9" <? if($rowHC['hctype'] == 9) echo "selected"; ?>>Horas extras</option>
	<option value="10" <? if($rowHC['hctype'] == 10) echo "selected"; ?>>Bonos</option>
	<option value="11" <? if($rowHC['hctype'] == 11) echo "selected"; ?>>Vacaciones</option>
	<option value="12" <? if($rowHC['hctype'] == 12) echo "selected"; ?>>Aguinaldo</option>
	<option value="13" <? if($rowHC['hctype'] == 13) echo "selected"; ?>>Prestamos</option>
	<option value="14" <? if($rowHC['hctype'] == 14) echo "selected"; ?>>Liquidacion de colaboradores</option>
	<option value="15" <? if($rowHC['hctype'] == 15) echo "selected"; ?>>Salarios</option>
</select>
                                                            

</div>
</div>
													  
<div class="col-md-2"  id="dTemplate" style="display: none;">
<div class="form-group">
<label class="control-label">Usar plantilla</label>
<select name="uTemplate" class="form-control" id="uTemplate" onChange="sType2(this.value),fnCleanup();">
	<option value="0" selected>No</option>
	<option value="1" <? if($rowHC['uTemplate'] == 1) echo "selected"; ?>>Si</option>

</select>

</div>
</div>
<br>
</div>
</div>
<div class="row"></div> 
<div class="row">	
<div id="dTemplate2" style="display: none;">
<div class="col-md-4">
<div class="form-group">
<label class="control-label">Plantilla</label>
<select name="template" class="form-control" id="template" onChange="loadTemplate(this.value);">
	<option value="0" selected>Seleccionar</option>
	<? 
	$queryTemplates = "select * from hcTemplates";
	$resultTemplates = mysqli_query($con, $queryTemplates);
	while($rowTemplates=mysqli_fetch_array($resultTemplates)){
	?>
	<option value="<? echo $rowTemplates['id']; ?>" <? if($rowHC['template'] == $rowTemplates['id']) echo "selected"; ?>><? echo $rowTemplates['name']; ?></option> 
	<? } ?>
</select>

</div>
</div>

	
	<div id="tContent"></div>
	
</div>		
	
<? #Colaboradores ?>	
<div class="col-md-12" id="dCollaborator" style="display: none;">

													  <div class="form-group">

	<label class="control-label">Colaborador:</label>

						
											<select name="collaborator" class="form-control  select2me" id="collaborator" data-placeholder="Seleccionar..." > 

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

															 Ingrese código, nombre o parte de el para filtar los resultados. <i style=" color:#FF0004;">Si no le aparece un Colaborador, consulte con el area de Tesorería</i></span>
														        </div>
														      </div>
													    </div>
													  </div>

													</div>
<? #Proveedores?>	
<div class="col-md-12" id="dProviders" style="display: none;">

													  <div class="form-group">

	<label class="control-label">Beneficiario:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar..." onChange="" >  
                                           
                                           

											  <option value=""></option>  
<?php $queryproviders = "select * from providers where hc = '1'";
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
<? #DGI ?>													  
<div class="col-md-12" id="dDGI" style="display: none;">
  <div class="form-group">
	  <label class="control-label">Código | Nombre:</label>
	  <input type="text" class="form-control" value="90425 | Dirección General de Ingresos" readonly>
	</div>
</div>
<? #INSS ?>												
<div class="col-md-12" id="dINSS" style="display: none;">
  <div class="form-group">
	  <label class="control-label">Código | Nombre:</label>
	  <input type="text" class="form-control" value="240435 | Instituto Nicaraguense de Seguridad Social" readonly>
	</div>
</div>
<? #INATEC ?>																																	  
<div class="col-md-12" id="dINATEC" style="display: none;">
  <div class="form-group">
	  <label class="control-label">Código | Nombre:</label>
	  <input type="text" class="form-control" value="240991 | Instituto Nacional Tecnologico" readonly>
	</div>
</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group">
			<label>Descripción:</label>
            <textarea name="description" rows="2" class="form-control" id="description"><?php echo $rowpconfirm['description']; ?></textarea> 
	 		<div class="row"></div>
         </div>
</div>       
    
<div class="row"></div>
                                                   

	<div id="dBills" style="display: none;">								
<div class="col-md-12 ">   
<h3 class="form-section">Factura(s)</h3></div>
<div class="col-md-12 "> 									
<div >

						<div class="row">

<?php //tipo ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Unidad de Negocio:</label>
                                                                    
		
             </div>
													</div>
<?php //No ROC ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Número:</label>
                                                                                                               
		
             </div>
													</div>
<?php //Fecha ?>                                                    
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Fecha de doc:</label>
                                                                                                              
		
             </div>
													</div>
<?php //Monto ?>                                                    
<div class="col-md-2 ">
	<div class="form-group">
														<label>Monto:</label>
                                                                                                               
		
             </div>
													</div> 												

</div>

<div id="billwaiter">
<? //End of labels ?>

<? 
$querybills = "select * from bills where payment = '$rowpconfirm[id]'";
$resultbills = mysqli_query($con, $querybills);
$numbills = mysqli_num_rows($resultbills);
$billi = 0;
if($numbills > 0){
while($rowbills=mysqli_fetch_array($resultbills)){
?>
<div class="row" class="bill<? echo $billi; ?>" id="bill<? echo $billi; ?>">

<?php //tipo ?>
<div class="col-md-2 ">
													  <div class="form-group">
														
                                                        <select name="billunits[]" class="form-control" id="billunits[]">
															<option value="0" selected>Seleccionar</option>
															<? 
															$queryUnits = "select * from units where active = '1'";
															$resultUnits = mysqli_query($con, $queryUnits);
															while($rowUnits=mysqli_fetch_array($resultUnits)){
															?>															
															<option value="<? echo $rowUnits['id']; ?>" <? if($rowUnits['id'] == $rowbills['unit']) echo "selected"; ?>><? echo $rowUnits['newCode']." $rowUnits[companyName] $rowUnits[lineName] $rowUnits[locationName]"; ?></option>
															<? } ?>
</select>                                                        
		
             </div>
													</div>
<?php //No ROC ?>
<div class="col-md-2 ">
													  <div class="form-group">
														
                                                        <input name="billnumber[]" type="text" class="form-control" id="billnumber[]" value="<? echo $rowbills['number']; ?>" <? //onkeypress="return justNumbers(event);" ?>>                                                        
		
             </div>
													</div>
<?php //Fecha ?>                                                    
<div class="col-md-2 ">
													  <div class="form-group">
													 
                                                        <input name="billtoday[]" type="text" class="form-control date-picker" id="billtoday[]" value="<? if(($rowbills['billdate'] != "0000-00-00") and ($rowbills['billdate'] != "") and ($rowbills['billdate'] != '1969-12-31')) echo date('j-n-Y', strtotime($rowbills['billdate'])); ?>" readonly> <?  ?>                                                    
		
             </div>
													</div>
<?php //Monto ?>                                                    
<div class="col-md-2 ">
	<div class="form-group">
													
                                                        <input name="billamount[]" type="text" class="form-control" id="billamount[]" value="<? echo $rowbills['ammount']; ?>" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal();">                                                        
		
             </div>
													</div> 

<div class="col-md-1"><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('<? echo $billi; ?>');">-</button></div></div>
											
<?php //DELETE ?>
<input type="hidden" name="bid[]" id="bid[]" value="0"> 
</div> 
<? 
$billi++;
	
} }else{ ?>
<div class="row">

<?php //tipo ?>
<div class="col-md-2 ">
	<div class="form-group">
		<select name="billunits[]" class="form-control" id="billunits[]">
			<option value="0" selected>Seleccionar sucursal</option> 

<? 
															$queryUnits = "select * from units where active = '1'";
															$resultUnits = mysqli_query($con, $queryUnits);
															while($rowUnits=mysqli_fetch_array($resultUnits)){
															?>															
<option value="1" <? if($rowUnits['id'] == $rowbills['unit']) echo "selected"; ?>><? echo $rowUnits['code'].' | '.$rowUnits['name']; ?></option>
															<? } ?>
</select>                                                        
</div>
</div>
<?php //No ROC ?>
<div class="col-md-2 ">
													  <div class="form-group">
														
                                                        <input name="billnumber[]" type="text" class="form-control" id="billnumber[]" value="" <? //onkeypress="return justNumbers(event);" ?>>                                                        
		
             </div>
													</div>
<?php //Fecha ?>                                                    
<div class="col-md-2 ">
													  <div class="form-group">
													
                                                        <input name="billtoday[]" type="text" class="form-control date-picker" id="billtoday[]" value="" readonly>                                                        
		
             </div>
													</div>
<?php //Monto ?>                                                    
<div class="col-md-2 ">
	<div class="form-group">
		<input name="billamount[]" type="text" class="form-control" id="billamount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal();">
	</div>
</div> 											
<?php //DELETE ?>
<input type="hidden" name="bid[]" id="bid[]" value="0"> 
</div>
<? } ?>             

</div>

<div class="col-md-1 ">
<button type="button" class="btn blue" onClick="addbill();">+</button><br>&nbsp;
</div>                                          
        </div>
		</div>
</div>
	
	
<br>
<div class="col-md-12 ">   
<h3 class="form-section">Monto</h3></div>
        

<div class="col-md-3 ">
	
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? if($rowpconfirm['payment'] > 0){ echo $rowpconfirm['payment']; } ?>" onkeypress="return justNumbers(event);" <?php if($rowpconfirm['distributable'] == 1) echo 'readonly="readonly"'; ?>>
                                                       <input name="floattotalbill" type="hidden" id="floattotalbill" value="">
<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
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
                                          <input name="currency" type="radio" id="currency" value="<?php echo $rowcurrency['id']; ?>" <? if($rowpconfirm['currency'] == $rowcurrency['id']) echo "checked"; ?> ></span></div> <?php echo $rowcurrency['name']; ?></label>
											                                           <?php } ?> 
											
										</div><br>
									</div> </div>
	

	

												 
									     
     
 </div>    
<? #Distribution Start ?>
<h3  class="form-section">Distribucion del pago</h3>
<div class="row">
<input type="hidden" name="distributable" id="distributable" value="1">
</div>
<div id="ddistribucion3"><br>
  <div class="row">
    <div class="col-md-6 "> &nbsp; </div>
    <div class="col-md-2 ">
      <input type="radio" name="pertot" id="pertot" value="1" checked="" onChange="changePertot(this.value);">
    </div>
    <div class="col-md-2 ">
      <input type="radio" name="pertot" id="pertot" value="2" onChange="changePertot(this.value);">
    </div>
	  <script>
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
	  </script>
  </div>
	<div class="row">
    <div class="col-md-6 ">
      <div class="form-group">
        <label>Unidad de negocio:</label>
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
        <label>&nbsp;</label>
        <br>
      </div>
    </div>
  </div>
 

	
	
	
  <div id="distributionwaiter">
	<?php //UNIT  $distributioni = 0;
	  
	  $querydistributable = "select * from distribution where payment = '$rowpconfirm[id]'";
	  $resultdistributable = mysqli_query( $con, $querydistributable );
	  $numdistributable = mysqli_num_rows($resultdistributable);
	  
	  if($numdistributable == 0){
	  ?>
	<div class="row">
    <div class="col-md-6 ">
      <div class="form-group">
        <select name="dunit[]" class="form-control  select2me" id="dunit[]" data-placeholder="Seleccionar...">
          <option value=""></option>
          <?php
          $queryproviders = "select * from units";
          $resultproviders = mysqli_query( $con, $queryproviders );
          while ( $rowproviders = mysqli_fetch_array( $resultproviders ) ) {
            ?>
          <option value="<?php echo $rowproviders['newCode'].','.$rowproviders['id']; ?>"<?php if($rowdistributable['unit'] == $rowproviders['code']) echo 'selected'; ?>><?php echo $rowproviders['newCode']." | $rowproviders[companyName] $rowproviders[lineName] $rowproviders[locationName]"; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <?php //PERCENT ?>
    <div class="col-md-2 ">
      <div class="form-group">
        <input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value="<?php echo $rowdistributable['percent']; ?>" onkeypress="return justNumbers(event);" onKeyUp="checkTheTotal(1);">
      </div>
    </div>
    <?php //Total ?>
    <div class="col-md-2 ">
      <div class="form-group">
        <input name="dtotal[]" type="text" class="form-control" id="dtotal[]" value="<?php echo $rowdistributable['total']; ?>"readonly onkeypress="return justNumbers(event);" onKeyUp="checkTheTotal(2);">
      </div>
    </div>
	</div>
	<?php
	  
	  }
	  
  	  $distributioni = 1;
  	  while ( $rowdistributable = mysqli_fetch_array( $resultdistributable ) ) {

    ?>
  <div class="row" id="distribution<?php echo $distributioni; ?>">
    <?php //UNIT ?>
    <div class="col-md-6 ">
      <div class="form-group">
        <select name="dunit[]" class="form-control  select2me" id="dunit[]" data-placeholder="Seleccionar...">
          <option value=""></option>
          <?php
          $queryproviders = "select * from units";
          $resultproviders = mysqli_query( $con, $queryproviders );
          while ( $rowproviders = mysqli_fetch_array( $resultproviders ) ) {
            ?>
          <option value="<?php echo $rowproviders['newCode'].''.$rowproviders['id']; ?>"<?php if($rowdistributable['unit'] == $rowproviders['code']) echo 'selected'; ?>><?php echo $rowproviders['newCode']." | $rowproviders[companyName] $rowproviders[lineName] $rowproviders[locationName]"; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <?php //PERCENT ?>
    <div class="col-md-2 ">
      <div class="form-group">
        <input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value="<?php echo $rowdistributable['percent']; ?>" onkeypress="return justNumbers(event);" onKeyUp="checkTheTotal(1);">
      </div>
    </div>
    <?php //Total ?>
    <div class="col-md-2 ">
      <div class="form-group">
        <input name="dtotal[]" type="text" class="form-control" id="dtotal[]" value="<?php echo $rowdistributable['total']; ?>"readonly onkeypress="return justNumbers(event);" onKeyUp="checkTheTotal(2);">
      </div>
    </div>
    <?php //Delete Distribution ?>
    <div class="col-md-2 ">
      <div class="form-group">
        <label>&nbsp;</label>
        <button type="button" class="btn red" onClick="javascript:deleteDistribution(<?php echo $distributioni; ?>);">-</button>
      </div>
    </div>
    <input type="hidden" name="did[]" id="did[]" value="<?php echo $rowdistributable['id']; ?>">
  </div>
  <?php $distributioni++; } ?>
	</div>
	
	 
	
	<div class="row">
  <div class="col-md-1 ">
    <button type="button" class="btn blue" onClick="addDistribution();">+</button>
    <br>
    <br>
    &nbsp; </div>
</div></div>	

<script>
	var distributioni = <?php if($distributioni > 0){ echo $distributioni; } else{ echo '1'; } ?>;
	function addDistribution(){
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
?><option value="<?php echo $rowproviders['newCode'].','.$rowproviders['id']; ?>"<?php if($rowpconfirm['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['newCode']." | $rowproviders[companyName] $rowproviders[lineName] $rowproviders[locationName]"; ?></option><?php } ?></select></div><div class="col-md-2 "><div class="form-group"><input name="dpercent[]" type="text" class="form-control" id="dpercent[]" value="" onkeypress="return justNumbers(event);" onKeyUp="javascript:checkTheTotal(1);" '+readOnly1+'></div></div> <div class="col-md-2 "><div class="form-group"><input name="dtotal[]" type="text" class="form-control" id="dtotal[]" value="" '+readOnly2+' onKeyUp="javascript:checkTheTotal(2);" onkeypress="return justNumbers(event);"></div></div> <div class="col-md-2 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteDistribution('+distributioni+');">-</button></div></div><input type="hidden" name="did[]" id="did[]" value="0"></div>'; 
     distributioni++; 
	 $("#distributionwaiter").append(distributionboxadd);  
	 Metronic.init(); 
}
</script>
<? #End distribution ?>
												
												
												
												
												
												
												
												
												
												
												
												
<div class="row"></div>           

                                                      



                                                       
                                                       <h3 class="form-section"><a id="files"></a>Archivos</h3>
                                                       
													  
                                                  
                                                  <div class="row"><!--/span--> 
                                                  
                                                  <div id="dFiles">
                                                    <?php 
													
	$queryfile2 = "select * from files where payment = '$rowpconfirm[id]' order by id asc";  
	$resultfile2 = mysqli_query($con, $queryfile2);
	$inc_files = 0;
	$filecount = 0;
	while($rowfile2 = mysqli_fetch_array($resultfile2)){
	$filecount++;
	if($filecount > 0){
		
	?>
                                                     <div class="col-md-10 ">
													  <div class="form-group">
														<input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfile2['id']; ?>">
														<select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
	
$queryfbox = "select * from filebox where user = '$userId' order by id desc";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"<?php if(cleanLink($rowfile2['link']) == $rowfbox['url']) echo 'selected'; ?>><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>   
                                            
</div></div> 
                                                        
<?php 
//End while
$inc_files++;
}
//End if
}
 
?>
             <input type="hidden" name="fileid[]" id="fileid[]" value="0">	
             <div id="fid_<? echo $inc_files; ?>"><div class="col-md-10 ">
													  <div class="form-group">
													    <select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$userId' order by id desc";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

</select><div class="row"></div></div></div>
             <div class="col-md-2 "><button type="button" class="btn red icn-only" onclick="eliminarFile(<? echo $inc_files; ?>);">-</button></div>
             </div> 
                                                      
                                                    </div>
                                                    <div class="row"></div>
             
              <div class="col-md-2 "><button type="button" class="btn blue icn-only" onclick="agregar();"><i class="fa fa-plus"></i></button>
             </div>                        
                                                     
             <? $inc_files++; ?>                      
                                                     

                                              </div>
                                              
                                              
                                         
                                            
                                              
   <? /*

<div class="row"></div><br>
<div class="row">
<div class="col-md-12 ">   
<h3 class="form-section">Linea de Negocio</h3></div>  

<div class="col-md-4 ">
													  <div class="form-group">
														
                                                        <select name="bline" class="form-control" id="bline">
<option value="0" selected>Seleccionar</option>
<? 
$querylines = "select * from blines order by name";
$resultlines = mysqli_query($con, $querylines);
while($rowlines = mysqli_fetch_array($resultlines)){
?>
<option value="<? echo $rowlines['id']; ?>" <? if($rowrefund['line'] == $rowlines['id']) echo "selected"; ?>><? echo $rowlines['name']; ?></option> 
<? } ?>
</select>                                                        
		
		</div></div>
		</div>*/ ?>
		
		<div class="row"></div>

<?php 
$queryroutes = "select units.id, units.newCode, units.companyName, units.lineName, units.locationName, routes.headship from routes inner join units on routes.unitid = units.id where routes.worker = '$userId' and routes.type = '1' and units.active = '1' order by routes.unit";
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
</div>
                                                                                            
            								<div id="row"><div class="col-md-12 ">
													  <div class="form-group">
														<label>Notas del Solicitante:</label>
                                                        <textarea name="notes" rows="2" class="form-control" id="notes"><?php echo $rowpconfirm['notes']; ?></textarea>
	
                                             </div>
													</div></div> 


											<div class="form-actions right" style=" margin-top:100px;">

												<div style="margin-right: 10px;">
												<button type="button" class="btn default" onClick="javascript:cancelAction();" style="margin-right: 10px;"><i class="fa fa-undo"></i> Retornar</button>
												<button name="draft" id="draft" type="button" class="btn blue" onClick="javascript:saveDraft();"><i class="fa fa-save"></i> Guardar Borrador</button>
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
	
function reloadRouteView(){
	var myroute = document.getElementById('theroute').value; 
	if(myroute != ''){ 
   	$.post("reload-route.php", { myvariable: myroute, }, function(data){
		document.getElementById('routeFill').innerHTML = data;
    }); 
	}
} 

function sType(val){
	
	hideAll();
	hideAll2();

	if((val == 1) || (val == 2) || (val == 3) || (val == 8) || (val == 9) || (val == 10) || (val == 11) || (val == 12) || (val == 13) || (val == 14) || (val == 15)){
		document.getElementById('dCollaborator').style.display = 'block'; 
		if((val == 2) || (val == 3)){
			document.getElementById('dProviders').style.display = 'block';
			document.getElementById('dTemplate').style.display = 'block';
		}
	}
	if(val == 4){
		document.getElementById('dDGI').style.display = 'block'; 
	}
	if((val == 5)){
		document.getElementById('dINSS').style.display = 'block'; 
		document.getElementById('dBills').style.display = 'block';
		document.getElementById('totalbill').readOnly = 'true';
		document.getElementById('totalbill').value = '';
	}
	if(val == 7){
		document.getElementById('dINATEC').style.display = 'block'; 
		document.getElementById('dBills').style.display = 'block';
	}
}

function fnCleanup(){
	document.getElementById('totalbill').value = '';
	document.getElementById('notes').value = '';
	document.getElementById('description').value = '';
	document.getElementById('billwaiter').innerHTML = '';
	document.getElementById('tContent').innerHTML = '';
	document.getElementById('distributionwaiter').innerHTML = ''; 
	document.getElementById('dFiles').innerHTML = '';
	document.getElementById('uTemplate').selectedIndex = 0;
	document.getElementById('theroute').selectedIndex = 0;
	document.getElementById('template').selectedIndex = 0;
	$("#collaborator").select2("val", "");
	$("#provider").select2("val", "");
	
	reloadRouteView();
	
	/*document.getElementById('uTemplate').value = '0';
	document.getElementById('template').value = '0';*/
}	
	
function hideAll(){
	document.getElementById('dCollaborator').style.display = 'none';
	document.getElementById('dProviders').style.display = 'none';
	document.getElementById('dDGI').style.display = 'none';
	document.getElementById('dINSS').style.display = 'none';
	document.getElementById('dINATEC').style.display = 'none';
	document.getElementById('dBills').style.display = 'none';
	document.getElementById('dTemplate').style.display = 'none';
	document.getElementById('totalbill').readOnly = false;
	document.getElementById('dTemplate2').style.display = 'none'; 
	
}
	
function hideAll2(){
	document.getElementById('dCollaborator').style.display = 'none';
	document.getElementById('dProviders').style.display = 'none';
	document.getElementById('dDGI').style.display = 'none';
	document.getElementById('dINSS').style.display = 'none';
	document.getElementById('dINATEC').style.display = 'none';
	document.getElementById('dBills').style.display = 'none';
	document.getElementById('totalbill').readOnly = false;
	document.getElementById('dTemplate2').readOnly = false;
	
}
	
function sType2(val){
	var uTemplate = document.getElementById('uTemplate').value;
	if(uTemplate == 1){
		hideAll2();
		document.getElementById('dTemplate2').style.display = 'block'; 
		document.getElementById('totalbill').readOnly = true;
		document.getElementById('totalbill').value = '';
	}else{
		document.getElementById('dTemplate2').style.display = 'none'; 
		document.getElementById('totalbill').readOnly = false;
		document.getElementById('dCollaborator').style.display = 'block'; 
		document.getElementById('dProviders').style.display = 'block';
		document.getElementById('dTemplate').style.display = 'block';
		document.getElementById('totalbill').value = '';
		
	}
}
	
function calculateTotal(){
	
	var i = 0;
	var thisTotal = 0;
	var theTotal = 0;
	for (i=0;i<document.getElementsByName('sAmount[]').length;i++){
		thisTotal = document.getElementsByName('sAmount[]')[i].value;
		if(thisTotal > 0){
			theTotal = parseFloat(thisTotal)+parseFloat(theTotal);
		}
 	}
	document.getElementById('totalbill').value = commas(theTotal);
	
}
	
function calculateTotalDelayed(){


    setTimeout(calculateTotal(), 8000);
	
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
	
function loadTemplate(val){
	<? if($rowHC['template'] != ''){ ?>
	document.getElementById('totalbill').value = '';	
	<? } ?>
	$.post("payment-order-hc-templates-reload.php", { id: val, hc: <? echo $_GET['id']; ?> }, function(data){
		var newItem = data; 
		$("#tContent").html(newItem);
		calculateTotal();
	}); 
}

var tfile = <? echo $inc_files; ?>;
function agregar(){ 
	setTimeout(reloadTemplate, 1500);
	$.post("payment-order-refund-reload-files.php", { variable: tfile }, function(data){ 
		$("#dFiles").append(data);
	});
	
	tfile++;
	 
	
}

function reloadTemplate(){
	Metronic.init();
}
	
function eliminarFile(fid){
	 $('#fid_'+fid).remove(); 
}

function saveDraft(){
	document.getElementById('newbutton').value = "draft";
	document.forms['porder'].submit();
}	
	
function cancelAction(){
	if (confirm("Esta Seguro de cancelar este ingreso?\n")==true){
			window.location = 'payments-hc.php';
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
	var node = document.getElementById("bill"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}
	
function deleteDistribution(id){
	//document.getElementById("roc"+id).style.display = 'none';
	var node = document.getElementById("distribution"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}	

var billi = <?php if($billi > 0){ echo $billi; } else{ echo '1'; } ?>;
 
<?php 

$strUnits = '<option value="0" selected>Seleccionar sucursal</option>';
$queryUnits = "select * from units where active = '1'"; 
$resultUnits = mysqli_query($con, $queryUnits);
$numUnits = mysqli_num_rows($resultUnits);
while($rowUnits=mysqli_fetch_array($resultUnits)){
	$strUnits.= '<option value="'.$rowUnits['id'].'">'.$rowUnits['newCode'].'  '.$rowUnits['companyName'].' '.$rowUnits['lineName'].' '.$rowUnits['locationName'].'</option>'; 
 } ?>
	
function addbill(){
	
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

    var billboxadd = '<div class="row" id="bill'+billi+'"><div class="col-md-2 "><div class="form-group"><select name="billunits[]" class="form-control" id="billunits[]"><? echo $strUnits; ?></select> </div></div><div class="col-md-2 "><div class="form-group"><input name="billnumber[]" type="text" class="form-control" id="billnumber[]" value="" '+readOnly1+'></div></div><div class="col-md-2 "><div class="form-group"><input name="billtoday[]" type="text" class="form-control date-picker" id="billtoday[]" value="" readonly></div></div><div class="col-md-2 "><div class="form-group"><input name="billamount[]" type="text" class="form-control" id="billamount[]" value=""  onKeyUp="javascript:calculateTheTotal();" onkeypress="return justNumbers(event);" '+readOnly1+'></div></div><div class="col-md-1"><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+billi+');">-</button></div></div><input type="hidden" name="bid[]" id="bid[]" value="0"></div>';
    billi++; 
	$("#billwaiter").append(billboxadd);  
	
	Metronic.init(); 
	ComponentsPickers.init();

}
 
function calculateTheTotal(){
	
	var tAmount = 0;
	var sizeOf = document.getElementsByName('billamount[]').length;

	for(i=0;i<sizeOf;i++){
		if(document.getElementsByName('billamount[]')[i].value > 0){
			tAmount += parseFloat(document.getElementsByName('billamount[]')[i].value);
		}
		
	}
	document.getElementById('totalbill').value = tAmount;  
  			
}

function checkTheTotal(){ 
	
	var mytotalstotal = numberFormat(document.getElementById('totalbill').value);
	var run = 0;
	
	var thisPercent = document.getElementsByName('dpercent[]');
	var thisTotal = document.getElementsByName('dtotal[]');
	
	
	for(var i=0;i<thisPercent.length;i++){
	
		if ((thisPercent[i].value != '') || (thisTotal[i].value != ''))  {
			run = 1;
		}
	}
	
	if((mytotalstotal > 0) && (run == 1)){
		
		var mySelector = document.getElementsByName('pertot'); 
		document.getElementById('totalbill').readOnly = true;
	
		for (var i = 0; i < mySelector.length; i++) {
			if (mySelector[i].checked) {
				var sRadio = mySelector[i].value;
				break; 
			}
		}
	
		

		if(sRadio == 1){
			i=0;
			for (var obj in document.getElementsByName('dpercent[]')){
				if (i<document.getElementsByName('dpercent[]').length){
					thepercent = document.getElementsByName('dpercent[]')[i].value; 
					thetotal1 = thepercent/100;
					var thetotal = parseFloat(mytotalstotal)*parseFloat(thetotal1);
					document.getElementsByName('dtotal[]')[i].value = thetotal.toFixed(2); 
					/*document.getElementsByName('dtotal[]')[i].value = thetotal;*/
				} 
				i++;
				var thetotalpercent = parseFloat(thetotalpercent)+parseFloat(thepercent);	
			}
			if(thetotalpercent > 100){
				alert('La distribucion no puede ser mayor a 100%.');
			}
		}
		
		else if(sRadio == 2){
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
	else{
		if((run == 1)){
			alert('Para distribuir la solicitud de pago, el monnto debe de ser mayor a cero.');
		}
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
			document.getElementById('client-stage').innerHTML = data;
		});
	}
}
	 
function validateForm(){ 
	
	var stype = document.getElementById('stype').value;
	if(stype == 0){
		document.getElementById("stype").focus();
		alert('Debe de seleccionar un tipo de solicitud');
		return false;
	}

	var currency = 0;
	var radios_currency = document.getElementsByName('currency');

	for(i=0;i<radios_currency.length;i++){
 		if (radios_currency[i].checked){
  			currency = radios_currency[i].value;
  			break;
 		}
	}	

	var description = document.getElementById("description").value;
	if(description == ""){
		document.getElementById("description").focus();
		alert('Usted debe de ingresar una descripcion del pago.');
		return false;
	}

	if((stype == 5) || (stype == 7)){
		
		var billunits = document.getElementsByName('billunits[]');
		var currentunit = 0;
		var currentnumber = 0;
		var currenttoday = '';
		var currentamount = 0;
		
		for(i=0;i<billunits.length;i++){ 
		
			currentunit =  document.getElementsByName('billunits[]')[i].value;
			if(currentunit == 0){
				document.getElementsByName('billunits[]')[i].focus();
				alert('Usted debe de seleccionar una UN.');
				return false;
			}
			currentnumber = document.getElementsByName('billnumber[]')[i].value;
			if(currentnumber == ""){
				document.getElementsByName('billnumber[]')[i].focus();
				alert('Usted debe de ingresar un numero de factura.');
				return false;
			}
			
			currenttoday = document.getElementsByName('billtoday[]')[i].value;
			if(currenttoday == ""){
				document.getElementsByName('billtoday[]')[i].focus();
				alert('Usted debe de seleccionar una fecha de factura.');
				return false;
			}
			
			currentamount = document.getElementsByName('billamount[]')[i].value;
			if((currentamount == 0)){
				document.getElementsByName('billamount[]')[i].focus();
				alert('Usted debe de seleccionar una monto de documento.');
				return false; 
			}
		
		} 
		
		
	}
	
	var totalbill = document.getElementById("totalbill").value;
	if(totalbill == 0){
		document.getElementById("totalbill").focus();
		alert('Usted debe de ingresar un monto.');
		return false;
	}
	
	if(currency == 0){
		alert('Seleccionar la moneda.');
		return false;
	}
	
	
	
		var selectoR =  document.getElementsByName('pertot');
		for (var i = 0, length = selectoR.length; i < length; i++) {
			if (selectoR[i].checked) {
				if(selectoR[i].value == 1){
					var pertot = 1;
				}else{
					var pertot = 2;
				}
			}
		}

		if(pertot == 1){
			var thepercent = 0;	
			var dpercent =  document.getElementsByName('dpercent[]');
			for (var i = 0, length = dpercent.length; i < length; i++) {
				if(document.getElementsByName('dpercent[]')[i].value > 0){
					thepercent = parseFloat(thepercent)+parseFloat(document.getElementsByName('dpercent[]')[i].value); 
				}
			}
			if(thepercent != 100){
				alert('Los porcentajes de la distribucion deben de sumar el 100%. (Porcentaje actual: '+thepercent+'%)');
				return false;
			}
		}
		else if(pertot == 2){
			var theTotal = 0;
			var dtotal =  document.getElementsByName('dtotal[]');
			for (var i = 0, length = dtotal.length; i < length; i++) {
				theTotal = parseFloat(theTotal)+parseFloat(document.getElementsByName('dtotal[]')[i].value);
			}	
			if(theTotal != totalbill){
				alert('El monto de distribucion ('+theTotal+') debe de ser exacto al monto de solicitud ('+totalbill+'). ');
				return false;
			}
		}
	
	
	var i=0;
	var i2=0;
	var i3=0; 
	for(var obj in document.getElementsByName('file[]')){
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

	//ROUTES
	var theroute = document.getElementById("theroute").value; 
	if(theroute == 0){
		document.getElementById("theroute").focus();
		alert('Usted debe de seleccionar una ruta de pago.');
		return false;
	}

} 	
	
</script>

</body>

</html>
 <script type="application/javascript">
  

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
