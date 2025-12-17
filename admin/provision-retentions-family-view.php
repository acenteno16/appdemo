<?php include("session-provision.php");

$id = intval($_GET['id']);

require('fn-relative.php');
/*
if((fnRelative3($_GET['id']) == true) or ($_SESSION['admin'] == "active")){
	//echo "Relative payment";
}else{ 
	?> 
    <script> 
	alert('No relative payment.');
	history.go(-1); 
	</script> 
	<?php 
	exit(); 
} 
*/
$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$themainroute = $row['route'];

switch($row['status']){ 
	case 1:
	?><script> alert('Este pago no ha sido aprobado.'); window.location = 'provision.php'; </script><?php break;
	case 2:
	if($row['approved'] == 0){ ?><script> alert('Este pago se ecuentra en la ruta de aprobacion.'); window.location = 'provision.php'; </script><?php } 
	break;
	case 3:
	if($row['approved'] == 0){ ?><script> alert('Este pago se ecuentra en la ruta de aprobacion.'); window.location = 'provision.php'; </script><?php } 
	break;
	case 4:
	if($row['approved'] == 0){ ?><script> alert('Este pago se ecuentra en la ruta de aprobacion.'); window.location = 'provision.php'; </script><?php } 
	break;
	case 5:
	?><script> alert('Este pago fue rechazado en la etapa 1.'); window.location = 'provision.php'; </script><?php break;
	case 6:
	?><script> alert('Este pago fue rechazado en la etapa 2.'); window.location = 'provision.php'; </script><?php break;
	case 7:
	?><script> alert('Este pago fue rechazado en la etapa 3.'); window.location = 'provision.php'; </script><?php break;
}

$queryb = "select * from bills where payment = '$id'";
$resultb = mysqli_query($con, $queryb);
while($rowb=mysqli_fetch_array($resultb)){
	
	
	if($rowb['ammount'] >= 1000){
		
		if($rowb['exempt'] == 1){
			$subtotal = $rowb['ammount'];
		}else{
			$subtotal = $rowb['ammount']/1.15;
			$iva = $rowb['ammount']-$subtotal;
		}
		
		$nsubtotal = $subtotal;
		if($row['ret1'] > 0){
			$ret1 = $row['ret1']/100;
			$ret1 = $subtotal*$ret1;
			$nsubtotal = $nsubtotal-$ret1;
		}
		if($row['ret2'] > 0){
			$ret2 = $row['ret2']/100;
			$ret2 = $subtotal*$ret2;
			$nsubtotal = $nsubtotal-$ret2;
		}
		if($iva > 0){
			$nsubtotal = $nsubtotal+$iva;
		}
			
		
	}
	
	//$nsubtotal = number_format($nsubtotal,2);
	$querybrepair2 = "update bills set billpayment = '$nsubtotal' where id = '$rowb[id]'"; 
	$resultbrepair2 = mysqli_query($con, $querybrepair2);
	
	$myfloatcurrency2 = $rowb['currency']; 
	
}

$pcurrency2pay = 2;
if($row['btype'] == 1){
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
	$pcurrency2pay = $rowprovider['currency']; 
}elseif($row['btype'] == 2){
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
}

								
$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));



$querypro = "select * from bills where payment = '$row[id]'";
$resultpro = mysqli_query($con, $querypro);
while($rowpro=mysqli_fetch_array($resultpro)){
	if($rowpro['niostotal'] == "0.00"){
		$totalpro+=$rowpro['stotal'];
	}else{
		$totalpro+=$rowpro['niostotal'];
	}
}


$queryaccountmaker0 = "select * from bills where payment = '$_GET[id]'"; 
	$resultaccountmaker0 = mysqli_query($con, $queryaccountmaker0);
	while($rowaccountmaker0=mysqli_fetch_array($resultaccountmaker0)){
		if($rowaccountmaker0['stotal'] > 0){
			$mytotalstotal+= $rowaccountmaker0['stotal'];
		}else{
			$mytotalstotal+= $rowaccountmaker0['ammount'];  
		}
		if($rowaccountmaker0['niostotal'] > 0){
			$myniototalstotal+= $rowaccountmaker0['niostotal'];
		}else{
			$myniototalstotal+= $rowaccountmaker0['nioammount'];  
		}
		
		$mybillcurrency = $rowaccountmaker0['currency'];
		 
	}
	

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

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

<!-- END THEME STYLES -->

<script src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<link rel="shortcut icon" href="favicon.ico"/>

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

		

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Provision <small>Provisionar pagos.</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="provision.php">Provision</a>
                            
                            <i class="fa fa-angle-right"></i>
                            
                            </li>
                            

						<li>

							<a>Provisionar pagos</a>

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

						

					

							                     <div class="portlet"><div class="portlet-title">

							<div class="caption">

								Provisión

							</div>

							<div class="actions">

							
								<?php if($_GET['visor'] == 1){ ?>
                                <a href="" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Vista sin achivos</span>

								</a>
                                <?php }else{ ?>
                                <a href="" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Vista con achivos</span>

								</a>
                                <?php } ?>

							

							</div>

						</div>
</div>

							<div class="tab-pane" id="tab_1">

								<div class="portlet box blue">

									<div class="portlet-title">

										

									</div> 

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

					   	<form action="provision-retentions-family-view-code.php" name="provisionForm" id="provisionForm" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
									<?php 
									
									include("stage-main.php");
									include("stage-status.php");
									if($row['status'] >= 8){
										include("stage-provision.php");
									}
									
									?>
                                    
                                  <? /*  <h3 class="form-section"><a id="status"></a>Ruta de pago <?php echo $row['route']; if($row['headship2'] > 0) echo " (Jef. ".$row['headship2'].")"; ?>

<? 

$querycompany = "select * from companies where id = '$row[company]'";
$resultcompany = mysqli_query($con, $querycompany);
$rowcompany = mysqli_fetch_array($resultcompany);

echo $rowcompany['name']; 

?>
</h3>*/ ?>
                                  
                                  
                                  
<div class="row" style="display: none;"> 
<div class="row">
                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Alcaldía C$:</label>
                                                        <input name="retention1" type="text" class="form-control" id="retention1" value="<? echo $row['ret1']; ?>" placeholder="%" onKeyUp="javascript:reloadNumbers();" onkeypress="return justNumbers(event);" ><span class="input-group-addon bootstrap-touchspin-postfix">%</span>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<div class="col-md-3 ">
													  <div class="form-group">
														
           <label>&nbsp;</label>                                             <input name="retention1ammount" type="text" class="form-control" id="retention1ammount" placeholder="Monto" value="" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                                 
<div class="col-md-3 ">
													  <div class="form-group">
														<label>IR C$:</label>
                                                        <input name="retention2" type="text" class="form-control" id="retention2" value="" placeholder="%" onKeyUp="javascript:reloadNumbers();" onkeypress="return justNumbers(event);" ><span class="input-group-addon bootstrap-touchspin-postfix">%</span>
                                                        
  <?php ?>                                                      
						
                                                         
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
</div>                                       	
<div class="row">
<div class="col-md-3 ">												  <div class="form-group">No retenedor/Exento
													    <label>:</label>
                                                        <input name="retainer" type="checkbox" id="retainer" onChange="javascript:reloadNumbers();" value="1" <?php if($row['retainer'] == 1) echo 'checked'; ?>> 
                                                         
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
</div>
<?php //Asume CP (IMI) ?>
<div class="col-md-3 ">												  <div class="form-group">Asume GCP (IMI).
													    <label>:</label>
                                                        <input name="retainer2" type="checkbox" id="retainer2" onChange="javascript:reloadNumbers();" value="1" <?php if($row['acp'] == 1) echo 'checked'; ?>> 
                                                         
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
</div>
<?php //Asume CP (IR) ?>
<div class="col-md-3 ">												  <div class="form-group">Asume GCP (IR).
						    <label>:</label>
                                                        <input name="retainer3" type="checkbox" id="retainer3" onChange="javascript:reloadNumbers();" value="1" <?php if($row['acp2'] == 1) echo 'checked'; ?>> 
                                                         
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
</div> 

<div class="col-md-3 ">												  <div class="form-group">Rets. Manuales<label>:</label>
                                                        <input name="retainer4" type="checkbox" id="retainer4" onChange="javascript:reloadManualRets();" value="1" <?php if($rowpconfirm['manualrets'] == 1) echo 'checked'; ?>>   
                                       <script>
                                       function reloadManualRets(){
										   if(document.getElementById('retainer4').checked == true){
											   //document.getElementById('manualretentions').style.display = "block";
											}else{
												//document.getElementById('manualretentions').style.display = "none";
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
<?php //Asume CP (IMI) ?>
<div class="col-md-3 ">												  <div class="form-group">Asume GCP (IMI).
													    <label>:</label>
                                                        <input name="retainer2" type="checkbox" id="retainer2" onChange="javascript:reloadNumbers();" value="1" <?php if($rowpconfirm['acp'] == 1) echo 'checked'; ?>> 
                                                         
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
</div>
<?php //Asume CP (IR) ?>
<div class="col-md-3 ">												  <div class="form-group">Asume GCP (IR).
						    <label>:</label>
                                                        <input name="retainer3" type="checkbox" id="retainer3" onChange="javascript:reloadNumbers();" value="1" <?php if($rowpconfirm['acp2'] == 1) echo 'checked'; ?>> 
                                                         
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
</div> 
<div class="col-md-3 ">												  <div class="form-group">Rets. Manuales<label>:</label>
                                                        <input name="retainer4" type="checkbox" id="retainer4" onChange="javascript:reloadManualRets();" value="1" <?php if($rowpconfirm['manualrets'] == 1) echo 'checked'; ?>>   
                                       <script>
                                       function reloadManualRets(){
										   if(document.getElementById('retainer4').checked == true){
											   //document.getElementById('manualretentions').style.display = "block";
											}else{
												//document.getElementById('manualretentions').style.display = "none";
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

</div>
                                   
								   <h3 class="form-section">Código de retención <small><a href="#">[Abrir visor de archivos]</a></small></h3>   
								   <input name="currency2pay" type="hidden" id="currency2pay" value="<?php echo $pcurrency2pay; ?>">
                                   <input type="hidden" name="nochange" id="nochange" value="0" > 
                                   <input type="hidden" name="retention1" id="retention1" value="<? echo $row['ret1']; ?>" > 
                                   <input type="hidden" name="retention1ammount" id="retention1ammount" value="<? echo $row['ret1a']; ?>" > 
                                   <input type="hidden" name="retention2" id="retention2" value=""> 
                                   <input type="hidden" name="retention2ammount" id="retention2ammount" value="0" >
                                   
                                   
                                    
                                     
                                   <input name="paymentadj" type="hidden" id="paymentadj" value="<?php echo $_GET['id']; ?>">
								   <input name="provisionbillcurrency" type="hidden" id="provisionbillcurrency" value="<?php echo $rowbills['currency']; ?>">

<? 
$payed = 0;
if(($row['status'] == 13) or ($row['status'] == 14)){
$payed = 1;
?>
 <div class="note note-warning">Nota: Esta solicitúd ya fue pagada al proveedor, la(s) alicuota(s) deben de coincidir con el <? echo str_replace('.00','',$row['ret2']); ?>% seleccionado anteriormente, ya que el monto a pagar no puede ser modificado.</div>	
<? } ?>
<input type="hidden" name="payed" id="payed" value="<? echo $payed; ?>" > 
<div class="row">
<div class="col-md-2">
<span>No. Documento</span>
</div>
<div class="col-md-2"> 
<span>Monto</span>	
</div>
<div class="col-md-6">
<span>Código de retención</span>	
</div>

<div class="row"></div>  <br>
<? 
$querybillret = "select * from bills where payment = '$_GET[id]'"; 
$resultbillret = mysqli_query($con, $querybillret); 
while($rowbillret=mysqli_fetch_array($resultbillret)){
?>
<div class="col-md-2">
	<input type="text" class="form-control" value="<? echo $rowbillret['number'] ?>" readonly>
</div>
<div class="col-md-2"> 
	<input type="text" class="form-control" value="<? echo $rowbillret['ammount'] ?>" readonly>
</div>
<div class="col-md-6" id="repairThis">
	<select name="billrettype[]" id="billrettype[]" class="form-control select2me" onChange="inactivate();">
	<option value="0">Seleccionar</option> 
	<? 
	$queryrtype = "select * from retfamily order by id";
	$resultrtype = mysqli_query($con, $queryrtype);
	while($rowrtype=mysqli_fetch_array($resultrtype)){
	?>
	<optgroup label="<? echo $rowrtype['name']; ?>"> 
	<? 
	$queryrtypec = "select * from retfamilycontent where family = '$rowrtype[id]'";
	$resultrtypec = mysqli_query($con, $queryrtypec);
	while($rowrtypec=mysqli_fetch_array($resultrtypec)){
	?>
	<option value="<? echo $rowrtypec['id'].","; ?><? echo $rowrtypec['percentage']; ?>"><? echo $rowrtypec['code']." | ".str_replace('.00','',$rowrtypec['percentage'])."%"." - ".$rowrtypec['name']; ?></option>
	<? } ?>
	</optgroup>
	<? } ?>
	</select>
</div>  
<input name="billretid[]" id="billretid[]" value="<? echo $rowbillret['id']; ?>" type="hidden">
<div class="row"></div>  <br>
                                                                
<? } ?>


<div class="col-md-3">
<div class="form-group" >
<label>Monto a Pagar:</label>
<input name="paymentold" type="text" class="form-control" id="paymentold" placeholder="" value="<? echo number_format($row['payment'],2)." ".$rowcurrency['name']; ?>" readonly>
</div>                                                     
</div>
<div class="col-md-3 "> 
<div class="form-group" >
<label>Nuevo Monto a Pagar:</label>
<input name="payment" type="text" class="form-control" id="payment" placeholder="Calculo automático" value="0.00" readonly>
<input name="floatpaymentnio" type="hidden" id="floatpaymentnio">
<input name="floatpayment" type="hidden" id="floatpayment">
<input type="hidden" name="floatammount2" id="floatammount2">
<input name="floatcurrency" type="hidden" id="floatcurrency" value="">
</div>
</div>   
                                                 
<div class="col-md-12 "><div class="form-actions right">

	
				
                        
                            <button type="submit" class="btn blue" id="btnSubmit"><i class="fa fa-spinner"></i> Calcular</button> 
							<input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>">
                           <input name="ready" type="hidden" id="ready" value="0">
                           <input name="ready2" type="hidden" id="ready2" value="0">
                            </div>
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


function justNumbers(e)
        {
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


</script>
<?php include('fn-reloadnumbers-advanced.php'); ?> 
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY --> 

</html>  
<script>
function validateForm(){ 

	reloadNumbers();
	
	var payed = document.getElementById("payed").value;
	var ready = document.getElementById("ready").value;
	var ready2 = document.getElementById("ready2").value;
	/*var oldpayment = document.getElementById("oldpayment").value; 
	var payment = document.getElementById("oldpayment").value; 

	if((payed == 1) && (oldpayment != payment)){
		//document.getElementById("dspayment").focus(); 
		alert('Usted debe de seleccionar el tipo de beneficiario.');
		return false;
	}*/ 
	
	if(ready == 0){
		alert('Por motivos de seguridad debe de revisar que toda la informacion proporcionada es correcta. Una vez este seguro de esto puede presionar confirmar.');
		document.getElementById("ready").value = 1;
		document.getElementById("ready2").value = 1;
		document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-check"></i> Confirmar';
		return false; 
	}
	
} //End ValidateForm

function inactivate(){
	var ready2 = document.getElementById("ready2").value;
	if(ready2 == 1){
		document.getElementById('btnSubmit').innerHTML = '<i class="fa fa-spinner"></i> Volver a calcular';
	}
	document.getElementById("ready").value = 0;
}

$( "#repairThis" ).mousemove(function( event ) {
  Metronic.init();
});


</script>