<?php 

include("session-provision.php");
exit();

$id = intval($_GET['id']);

require('fn-relative.php');

if(fnRelative2($_GET['id']) == true){
	//echo "Relative payment";
}else{
	?> 
    <script> 
	alert('No relative payment.');
	window.location = 'approve.php';
	</script> 
	<?php 
	exit(); 
} 

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
	case 8:
	?><script> alert('Este pago ya fue provisionado.'); window.location = 'provision.php'; </script><?php break;
	
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


if($row['btype'] == 1){
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
	$pcurrency2pay = $rowprovider['currency'];
}else{
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
	$pcurrency2pay = 2;
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
                                <a href="?id=<? echo $_GET["id"]; ?>" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Vista sin achivos</span>

								</a>
                                <?php }else{ ?>
                                <a href="?id=<? echo $_GET["id"]; ?>&visor=1" class="btn default blue-stripe">

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

					   	<form action="provision-view-code.php" name="provisionForm" id="provisionForm" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
									<?php include("stage-main.php");
									include("stage-status.php"); 
									 
									?>
                                    
                                    <h3 class="form-section"><a id="status"></a>Ruta de pago <?php echo $row['route']; if($row['headship2'] > 0) echo " (Jef. ".$row['headship2'].")"; ?>

<? 

$querycompany = "select * from units where code = '$row[route]'";
$resultcompany = mysqli_query($con, $querycompany);
$rowcompany = mysqli_fetch_array($resultcompany);

switch($rowcompany['company']){
	default:
	echo "Otras compañias";
	break;
	case 1:
	echo "Casa Pellas";
	break;
	case 2: 
	echo "Alpesa";
	break;
	case 3:
	echo "Velosa";
	break;
}

?>
</h3>
                                    <input name="currency2pay" type="hidden" id="currency2pay" value="<?php 
									echo $pcurrency2pay;
									?>">
                                    <input name="currency2pay" type="hidden" id="currency2pay" value="<?php 
									echo $pcurrency2pay;
									?>">
                                     <input type="hidden" name="nochange" id="nochange" value="0" > 
                                    
                                    
                                        <div class="row"></div>
                                      <h3 class="form-section">Herramientas Pre-Provisión</h3>
                                        
                                    <div class="col-md-3 ">    
                                        <a href="javascript:recalculateRetention(1);" class="btn btn-xs default btn-editable" id="recalculate1"><i class="fa fa-retweet"></i> Recalcular Retenciones</a>
                                        <a href="javascript:recalculateRetention(2);" class="btn btn-xs default btn-editable" id="recalculate2" style="display:none;"><i class="fa fa-retweet"></i> No Recalcular Retenciones</a>
                                        </div>
                                    <div class="col-md-9 ">
                                        
                                         <a href="javascript:recalculateRetention(3);" class="btn btn-xs default btn-editable" id="recalculate3"><i class="fa fa-retweet"></i> Notas de crédito</a> * Nota de crédito emitida por el proveedor es un débito en el código del proveedor (Pasivo).
          
                                           <a href="javascript:recalculateRetention(4);" class="btn btn-xs default btn-editable" id="recalculate4" style="display:none;"><i class="fa fa-retweet"></i> Cancelar notas de débito</a>
     </div>                                  
<script>

function recalculateRetention(mainoption){
	
	
	if(mainoption == 1){ 
		document.getElementById("recalculate0").style.display = "block";
		document.getElementById("recalculate1").style.display = "none";
		document.getElementById("recalculate2").style.display = "block";
		document.getElementById("recalculate3").style.display = "none";
		document.getElementById("recalculate4").style.display = "none";
		document.getElementById("recalculate5").style.display = "none";
	}
	else if(mainoption == 2){
		document.getElementById("recalculate0").style.display = "none";
		document.getElementById("recalculate2").style.display = "none";
		document.getElementById("recalculate1").style.display = "block";
		document.getElementById("recalculate3").style.display = "block";
		document.getElementById("recalculate4").style.display = "none";
		document.getElementById("recalculate5").style.display = "none";
		 
	}
	else if(mainoption == 3){
		document.getElementById("recalculate0").style.display = "none";
		document.getElementById("recalculate2").style.display = "none";
		document.getElementById("recalculate1").style.display = "none";
		document.getElementById("recalculate3").style.display = "none";
		document.getElementById("recalculate4").style.display = "block";
		document.getElementById("recalculate5").style.display = "block";  
	}
	else if(mainoption == 4){
		document.getElementById("recalculate0").style.display = "none";
		document.getElementById("recalculate2").style.display = "none";
		document.getElementById("recalculate1").style.display = "block";
		document.getElementById("recalculate3").style.display = "block";
		document.getElementById("recalculate4").style.display = "none";
		document.getElementById("recalculate5").style.display = "none"; 
	}
}

</script>        
                                        
                                        
                                        
<div id="recalculate0" style="display:none;">
                                     
<div class="row"></div>
                                         
<h3 class="form-section">Ajustar Retenciones </h3>
                                         
<div class="row">
                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Alcaldía C$:</label>
                                                        <input name="retention1" type="text" class="form-control" id="retention1" value="" placeholder="%" onKeyUp="javascript:reloadNumbers();" onkeypress="return justNumbers(event);" ><span class="input-group-addon bootstrap-touchspin-postfix">%</span>
						
                                                          
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
</div>                                              </div>
<script>


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


</script>

<div class="row"></div>

<h3 class="form-section">Pago a Proveedor en Cordobas</h3>
                                                  
<?php //Monto a pagar ?>
<div class="row" ><!--/span-->
                                                 <div class="col-md-3 " > 
													  <div class="form-group" >
			    <label>Monto a Pagar C$</label>
			    :											
                                                        <input name="payment" type="text" class="form-control" id="payment" placeholder="Calculo automático" value="0.00" readonly>
                                                        <input name="floatpaymentnio" type="hidden" id="floatpaymentnio">
                                                        <input name="floatpayment" type="hidden" id="floatpayment">
                                                        
                                                                 <input type="hidden" name="floatammount2" id="floatammount2">
                                                                 
                                                                 
                                                        <input name="floatcurrency" type="hidden" id="floatcurrency" value="">
 						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                   <div class="row"></div>
          <button type="button" class="btn blue" id="recalculateButton"><i class="fa fa-check"></i> Ajustar Retenciones</button>
          <input name="paymentadj" type="hidden" id="paymentadj" value="<?php echo $_GET['id']; ?>">
          <input name="provisionbillcurrency" type="hidden" id="provisionbillcurrency" value="<?php echo $rowbills['currency']; ?>">
          
         
		  
          
          <script>
		 $('#recalculateButton').click(function(){
   			$('#provisionForm').attr('action', 'provision-retention-repair.php');
			$('#provisionForm').attr('onsubmit', 'return validateForm2();');
			$( "#provisionForm").submit(); 
		 }); 
		  </script>
		  
           
           
           
          
                                                                                      <div class="row"></div>                                                                          
                                                   
                                                
                                                      <!--/row--></div>
												</div>  
                                                  </div>

 
                                         
</div>








<div class="row">
<br>
</div>

<div id="recalculate5" style="display:none;">
<div class="row">
<div class="col-md-12 " ><br><br>

 <div class="row" ><!--/span-->
 
 <div class="col-md-12 " >
   <h3 class="form-section">Ingresar notas de débito</h3>
   <p>- Las notas de débito deben de ser un valor positivo.
     <br>
<br>
</p>
 </div>
 

  
<div class="col-md-2 " > 
													  <div class="form-group" >
			 
			    										
                                                        <input name="notenumber[]" type="text" class="form-control" id="notenumber[]" placeholder="No. de nota"> 
                                                        <br>

                </div>
												</div> 

<div class="col-md-2 " > 
													  <div class="form-group" >
			 
			    										
                                                        <input name="noteammount[]" type="text" class="form-control" id="noteammount[]" placeholder="Monto" onkeypress="return justNumbers(event);">
                                                        <br>

                </div>
												</div>

<div class="col-md-2 ">
													  <div class="form-group">
														
                                                        <select name="notecurrency[]" class="form-control" id="notecurrency[]">
<option value="0" selected>Seleccionar</option>
<option value="1">Córdobas</option>
<option value="2">Dólares</option> 
</select>                                                        
		
             </div>
													</div>

<div class="col-md-2 ">
<div class="form-group"> 
													
<input name="notetoday[]" type="text" class="form-control date-picker" id="notetoday[]" value="" readonly>                                                        	
</div>
</div>                                               	
                                                
<div class="col-md-4 " > 
													  <div class="form-group" >
			   
			    										
                                                        <input name="notereason[]" type="text" class="form-control" id="notereason[]" placeholder="Commentarios">
                                                        <br>

                </div> 
												</div>
                                                
                                                
                                                <div id="notewaiter">
                                                
                                                </div>
                                                
                                                 <script type="text/javascript">
var noNote = 1;
function addNote(){
   var newNote = '<div class="row" id="note'+noNote+'"><div class="col-md-12 " ><div class="col-md-2 " ><div class="form-group" ><input name="notenumber[]" type="text" class="form-control" id="notenumber[]" placeholder="No. de nota"><br></div></div><div class="col-md-2 " ><div class="form-group" ><input name="noteammount[]" type="text" class="form-control" id="noteammount[]" placeholder="Monto" onkeypress="return justNumbers(event);"><br></div></div><div class="col-md-2 "><div class="form-group"><select name="notecurrency[]" class="form-control" id="notecurrency[]"><option value="0" selected>Seleccionar</option><option value="1">Córdobas</option><option value="2">Dólares</option></select></div></div><div class="col-md-2 "><div class="form-group"><input name="notetoday[]" type="text" class="form-control date-picker" id="notetoday[]" value="" readonly></div></div><div class="col-md-4 " ><div class="form-group" ><input name="notereason[]" type="text" class="form-control" id="notereason[]" placeholder="Commentarios"><br></div></div><div class="col-md-1 "><div class="form-group"><button type="button" class="btn red" onclick="javascript:deleteRowNote('+noNote+');">-</button></div></div></div></div>';  
     noNote++;
	 $("#notewaiter").append(newNote);  
	    
	Metronic.init(); // init metronic core components
	ComponentsPickers.init();

  
}

function deleteRowNote(id){

	var node = document.getElementById("note"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
} 
</script>  
                                                
                                                <div class="col-md-1 " > 
                                                   
													<button type="button" class="btn blue" onClick="addNote();">+</button> 
												</div>
                                                
                                                       <div class="row"></div><br><br>
          <div class="col-md-3 " >  <button type="button" class="btn blue" id="notesButton"><i class="fa fa-check"></i> Ingresar notas de debito</button> 
          
           <script>
		 $('#notesButton').click(function(){
   			$('#provisionForm').attr('action', 'provision-notes-add.php');
			$('#provisionForm').attr('onsubmit', 'return validateForm3();');
			$( "#provisionForm").submit(); 
			
		 }); 
		  </script>
          
          
          
          <input name="paymentadj2" type="hidden" id="paymentadj2" value="<?php echo $_GET['id']; ?>"> </div>
          
          <div class="col-md-3 " >  <button type="button" class="btn red" id="notesButton2"><i class="fa fa-times"></i> Eliminar notas de debito</button> 
          
           <script>
		 $('#notesButton2').click(function(){
   			
			window.location = "provision-notes-delete.php?id=<?php echo $_GET['id']; ?>";
			
		 }); 
		  </script>
          
          
          
          <input name="paymentadj2" type="hidden" id="paymentadj2" value="<?php echo $_GET['id']; ?>"> </div>
                                                                                      <div class="row"></div> 
                                                
                                                 
                                                  </div>

 
 
 
 
 
 
 
 </div>
 </div>
</div> 
 

 <input type="hidden" name="mytotalstotal" id="mytotalstotal" value="<?php echo $mytotalstotal; ?>">
                                          <input type="hidden" name="myniostotal" id="myniostotal" value="<?php echo $myniototalstotal?>">
                                          <input type="hidden" name="mybillcurrency" id="mybillcurrency" value="<?php echo $mybillcurrency; ?>">
                                          <input type="hidden" name="billcurrency2" id="billcurrency2" value="<?php echo $myfloatcurrency2; ?>"> 
                                          
                                          
                                                    
                                         <div class="row"></div>
                                          <h3 class="form-section">Provisión 
</h3>
  <div id="ddistribucion0">

 
 <div class="row">
<div class="col-md-12"> 

<div class="form-group" style="margin-left:30px;">
										<label><h4>Tipo de pago:</h4></label>
										<div class="radio-list">
											<label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2"><input type="radio" name="ptype" id="optionsRadios4" value="1" checked=""></span></div> 
										 Transferencia electrónica</label>
											<label class="radio-inline">
											<div class="radio1" ><span><input type="radio" name="ptype" id="optionsRadios5" value="2"></span></div> 
											Cheque </label>
                                            <label class="radio-inline"> 
											<div class="radio1" ><span><input type="radio" name="ptype" id="optionsRadios5" value="3"></span></div> 
											Tarjeta de crédito </label>
                                            <label class="radio-inline">
											<div class="radio1" ><span><input type="radio" name="ptype" id="optionsRadios5" value="4"></span></div> 
											Telepagos </label>
                                            <label class="radio-inline">
											<div class="radio1" ><span><input type="radio" name="ptype" id="optionsRadios5" value="5"></span></div> 
											Internet Banking  </label>                                            
											
										</div>
									</div> </div> </div>
                                    
                                    <div class="row">
                                    <br><br><br>
                                    </div>
                                    
                                     <div class="row">
                                     
<?php //no batch ?>
<div class="col-md-3 ">
									  <div class="form-group">
			    <label>No. Batch:</label>
			    											
                                        <input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
<?php //no documento ?>                                                 <div class="col-md-3 ">
									  <div class="form-group">
			    <label>No. Documento:</label>
			    											
                                        <input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
<?php //link documento ?>                                                <div class="col-md-6 ">
												  <div class="form-group">
			    <label>Link del Documento:</label>
			    											
                                                    <?php /*<input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value="">*/ ?>
                                                    <select name="linkdocument[]" class="form-control  select2me" id="linkdocument[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>
						
                                                          
              </div>
												</div>
                                    
 
 </div>

  <div id="batchwaiter">
                                                    </div>
                                                    <div class="col-md-3 ">
 <button type="button" class="btn blue" onClick="addBatch();">+</button>&nbsp;<button type="button" class="btn blue" onClick="openFiles();"><i class="fa fa-search"></i> Ver archivos</button>
 <script>
 function openFiles(){
	 window.open('files.php');
 }
 </script>
 <br><br>&nbsp;</div>
 
  <div class="row"></div> 
  <div class="row">
  
 <?php /*
 <div class="col-md-6 ">
													  <div class="form-group">
														<label>Aprobado Danilo Chamorro:</label>
														<input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfilemain['id']; ?>">
														<select name="adch" class="form-control  select2me" id="adch" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>
						
                                                          
                       <br> 

    
                                                      <!--/row--></div>
													</div>
 
 <div class="col-md-6 ">
									  <div class="form-group">
			    <label>Aprobado Danilo Chamorro:</label>
			    											
                                        <input name="adch" type="text" class="form-control" id="adch" placeholder="" value="">
						<br>
                        * <strong>Nota:</strong> Adjuntar link del archivo de correo de Don Danilo Chamorro. 
                                                          
              </div>
												</div>
 */ ?>
                                      
</div>
<?php $queryprovider2 = "select * from providers where id = '$row[provider]'";
$resultproviders2 = mysqli_query($con, $queryprovider2);
$rowproviders2 = mysqli_fetch_array($resultproviders2);

if($rowproviders2['international'] == 1){
?>
   <div class="row"></div>
                                          <h3 class="form-section">Proveedores Internacionales</h3>
 <div class="col-md-6 ">
									  <div class="form-group">
			    <label>No. de Solicitud:</label>
			    											
                                        <input name="internationalno" type="text" class="form-control" id="internationalno" placeholder="" value=""> 
						
                                                          
              </div>
												</div>
                      <div class="col-md-6 ">
									  <div class="form-group">
			    <label>Link:</label> 
			    											
                                        <input name="internationallink" type="text" class="form-control" id="internationallink" placeholder="" value="">
						
                                                          
              </div>
												</div>
<?php }  

//Alcaldías
if($row['ret1a'] > 0){
    
$querygcompany = "select * from units where code = '$themainroute' or code2 = '$themainroute'";
$resultgcompany = mysqli_query($con, $querygcompany); 
$rowgcompany = mysqli_fetch_array($resultgcompany);

$queryhalls0 = "select * from halls where units like '%$theroute%'";
$queryhalls0 = "select * from halls where FIND_IN_SET('$theroute',unit) > 0";
$resulthalls0 = mysqli_query($con, $queryhalls0);
$rowhalls0=mysqli_fetch_array($resulthalls0);

//echo $hallid = $rowhalls0['id'];

$queryhalls = "select * from halls where company = '$rowgcompany[company]'"; 
$resulthalls = mysqli_query($con, $queryhalls);
$numhalls = mysqli_num_rows($resulthalls);
if($numhalls > 0){

?>
<div class="row"></div>
<h3 class="form-section">Retenciones <span style="font-size:12px;">En caso de que el producto sea recibido en otra sucursal, seleccionar sucursal que corresponda</span></h3>
<? //  <div class="note note-regular">En caso de que el producto sea recibido en otra sucursal, seleccionar sucursal que corresponda.</div> ?>
                     
 
  <select name="hall" class="form-control" id="hall">
  <option value="0" selected>Seleccionar sucursal</option> 

<?php 


//echo "Hallid: ".$hallid;

//Get the payment company

while($rowhalls=mysqli_fetch_array($resulthalls)){
?>
<option value="<?php echo $rowhalls['id']; ?>" <?php if($rowhalls['id'] == $hallid) echo "selected"; ?>><?php echo $rowhalls['name']; ?></option> 
<?php } ?>

													  </select>
                                                
<?php } } ?> 

<?php //Rechazo ?>
<div class="col-md-12 " style="display:none;" id="cdiv">
													  <div class="form-group">
															<label class="control-label">Razón:</label>

													  <select name="reason2" class="form-control" id="reason2">
<option value="0">Otro</option>
<?php $queryreason = "select * from reason";
$resultreason = mysqli_query($con, $queryreason);
while($rowreason=mysqli_fetch_array($resultreason)){
?>
<option value="<?php echo $rowreason['id']; ?>"><?php echo $rowreason['name']; ?></option>
<?php } ?>

													  </select><br>
<br>

<label>Comentarios:</label>
                                                        <textarea name="reason" rows="2" class="form-control" id="reason" placeholder="Comente por que no aprueba esta solicitud de pago."></textarea>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                        
                                                      <!--/row--></div>
													</div>
                                                    
                                                    
   <script type="text/javascript">
var noBatch = 1;
function addBatch(){
   var newBatch = '<div class="row" id="batch'+noBatch+'"><div class="col-md-3"><div class="form-group"><input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value=""></div></div><div class="col-md-3 "><div class="form-group"><input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value=""></div></div><div class="col-md-5 "><div class="form-group"><select name="linkdocument[]" class="form-control  select2me" id="linkdocument[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"><option value=""></option><?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?><option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option><?php } ?></select></div></div><div class="col-md-1 "><div class="form-group"><button type="button" class="btn red" onclick="javascript:deleteRowBatch('+noBatch+');">-</button></div></div></div>';
     noBatch++; 
	 $("#batchwaiter").append(newBatch);
	 
	 Metronic.init(); 
  
}

function deleteRowBatch(id){
	//document.getElementById("distribution"+id).style.display = 'none';
	var node = document.getElementById("batch"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}
</script>  
  
  <div class="row">
                                                      
                                                    
  <div class="col-md-12 "><div class="form-actions right">

												
    <p>
                            
                            </p>
						    <button type="button" class="btn red" onClick="denyPayment();"><i class="fa fa-times"></i> Rechazar Pago</button> 
                          
                              
            <script>
			
			function denyPayment(){
				
			var divdeny = document.getElementById('cdiv').style.display; 
			
			if(divdeny == 'block'){
				
				var okay = 1;
				
				//combo
				var reason2 = document.getElementById('reason2').value;
				//Comments
				var reason = document.getElementById('reason').value;
				
				if((reason2 == 0) && (reason == "")){
					var okay = 0;
					alert('Necesita sopordar la razon con un comentario.');
				}
					
				
				
				
				if(okay == 1){
				
				if (confirm("Esta usted seguro de querer rechazar esta solicitud?\n- Si usted no desea rechazar presione cancelar.")==true){
			window.location="provision-view-deny.php?id=<?php echo $_GET['id']; ?>&reason="+reason+"&reason2="+reason2; 
		}else{
			document.getElementById('cdiv').style.display = "none";
		}
				}
			}else{
				alert('Para rechazar esta solicitud, usted debera de llenar la información de rechzo.');
				document.getElementById('cdiv').style.display = "block";
			}
		
			}
			
			</script>
                        
                            <button type="submit" class="btn blue"><i class="fa fa-check"></i> Provisionar</button> 
												<input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>">
                                                <input name="distributiontype" type="hidden" id="distributiontype" value="0">
  </div>
                                            </div>
                                            
                                                                                          

                                                   </div>
                                            
                                            
                                            
                                                  

											<!--/row--><!--/row--></div>


							

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

function validateForm2(){
	if(confirm('Esta a punto de re-cacular las retenciones. Para aceptar estos nuevos calculos presione aceptar.') != true){
		return false;
	}
}


function validateForm3(){
	if(confirm('Esta a punto de ingresar una o varias notas de debito. Para continuar pulse aceptar.') != true){
		return false;
	}
}


function validateForm(){

i=0;
for (var obj in document.getElementsByName('nobatch[]')){
	if (i<document.getElementsByName('nobatch[]').length){
		varnobatch = document.getElementsByName('nobatch[]')[i].value;
		if(varnobatch == ''){
			alert('El campo "no batch" no puede estar en blanco');
			document.getElementsByName('nobatch[]')[i].focus();
			return false;
		}

		varnodocument = document.getElementsByName('nodocument[]')[i].value;
		if(varnodocument == ''){
			alert('El campo "no documento" no puede estar en blanco');
			document.getElementsByName('nodocument[]')[i].focus();
			return false;
		}

		varlinkdocument = document.getElementsByName('linkdocument[]')[i].value;
		if(varlinkdocument == ''){
			alert('El campo "Link del documento" no puede estar en blanco');
			document.getElementsByName('linkdocument[]')[i].focus();
			return false;
		}
		if(!/visor.php/.test(varlinkdocument)){
			alert('Asegurese de que el link sea valido.');
			document.getElementsByName('linkdocument[]')[i].focus();
			return false;
		}
  }
  i++;
}	

<?php
if(($row['ret1a'] > 0) or ($row['ret2a'] > 0)){
?>
thehall = document.getElementById('hall').value;
 
if(thehall == '0'){
	alert('Debe de seleccionar una alcaldia');
	document.getElementById('hall').focus();
	return false; 
}

if(thehall == 0){
	alert('Debe de seleccionar una alcaldia');
	document.getElementById('hall').focus();
	return false; 
}

<?php } ?> 
	
}

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
<?php include('fn-reloadnumbers.php'); ?> 
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY --> 

</html>  