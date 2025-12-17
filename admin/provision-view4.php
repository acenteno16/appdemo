<?php include("session-provision.php");

$id = $_GET['id'];
$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

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

$queryb = "select * from bills where payment = '$_GET[id]'";
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
	
}


$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
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

<link rel="shortcut icon" href="favicon.ico"/>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="reloadNumbers();">

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

					Pagos <small>Aprobación de pagos.</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="provision.php">Pagos</a>
                            
                            <i class="fa fa-angle-right"></i>
                            
                            </li>
                            

						<li>

							<a>Aprobación de pagos</a>

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

										

									</div> 

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="provision-view-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">

									<?php include("stage-main.php");
									include("stage-status.php"); 
									 
									?>
                                    
                                    
                                         <?php if($row['currency'] == 2){
											 ?>
                                     <input type="hidden" value="2" id="currencytype" name="currencytype">    
										 <?php /*
										  $today = date('Y-m-d');
										  $querytc = "select * from tc where today = '$today'";
										  $resulttc = mysqli_query($con, $querytc);
										  $numtc = mysqli_num_rows($resulttc);
										  if($numtc == 0){
											  ?>
                                         <script>
											 alert('Favor actualizar la base de datos de Tazasde Cambio.');
                                             </script>
                                              <?php }
										  
										  */
										  ?>  
                                          
                                       
<h3 class="form-section">TC</h3>
<?php //Fecha de Libro ?>
<div class="col-md-3 ">
										    <div class="form-group">
											  <label>Fecha de Libro:</label> 
                                              <input name="bookdate" type="text" class="form-control form-control-inline date-picker" id="bookdate" value="<?php echo date('d-m-Y'); ?>" onChange="javascript:reloadNumbers();" readonly>
						
                                                          
                       

                       <!--/row-->
                                                <!--/row-->
                                                <!--/row-->
                                                      
                                              <!--/row--></div>
													</div>
<?php //TC ?>
<div class="col-md-2 ">
													  <div class="form-group">
			    <label>TC:</label>											
                                                        <input name="tc" type="text" class="form-control" id="tc" placeholder="Monto" value="" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                

<?php }else{ ?>
<input type="hidden" value="1" id="currencytype" name="currencytype">   
<?php } ?>
<?php if($row['currency'] == 2){ ?>       
<div>
<div class="row"></div>
<h3 class="form-section">Detalles de la conversión a Cordobas</h3>
                                                    
<?php //Subtotal Facturas ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Subtotal Facturas C$:</label>
                                                        <input name="stotalbillcs" type="text" class="form-control" id="stotalbillcs" value="" readonly> <input id="stotalbillmen1000" name="stotalbillmen1000" type="hidden" value="">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //Subtotal Facturas Retencion ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Monto sujeto a Ret.</label>
                                                        <input name="stotalbillcsr" type="text" class="form-control" id="stotalbillcsr" value="" readonly> <input id="stotalbillmen1000" name="stotalbillmen1000" type="hidden" value="">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //IVA Facturas ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>IVA Factura(s) C$:</label>
                                                        <input name="totaltaxcs" type="text" class="form-control" id="totaltaxcs" value="" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<?php //Total Facturas ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Total Factura(s) C$:</label>
                                                        <input name="totalbillcs" type="text" class="form-control" id="totalbillcs" value="" readonly> 
						
                                                          
                                                        <input id="stotalbillmay1000" name="stotalbillmay1000" type="hidden" value="">
                                                        <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 
</div>





                                        
<div class="row"></div>
                                         
<h3 class="form-section">Retenciones en Cordobas</h3>
                                         
<div class="row">
                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Alcaldía C$:</label>
                                                        <input name="retention1nio" type="text" class="form-control" id="retention1nio" value="<?php if($rowpconfirm['ret1'] != 0){ echo $rowpconfirm['ret1']; } ?>" placeholder="%" onKeyUp="javascript:reloadNumbers(this.value);" onkeypress="return justNumbers(event);" <?php /*onFocus="javascript:clear1();"*/ ?> readonly><span class="input-group-addon bootstrap-touchspin-postfix">%</span>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<div class="col-md-3 ">
													  <div class="form-group">
														
           <label>&nbsp;</label>                                             <input name="retention1ammountnio" type="text" class="form-control" id="retention1ammountnio" placeholder="Monto" value="<?php echo $rowpconfirm['ret1a']; ?>" readonly>
						
                                                          
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
                                                        <input name="retention2nio" type="text" class="form-control" id="retention2nio" value="<?php if($rowpconfirm['ret2'] != 0){ echo $rowpconfirm['ret2']; } ?>" placeholder="%" onKeyUp="javascript:reloadNumbers();" onkeypress="return justNumbers(event);" <?php /*onFocus="javascript:clear2();"*/ ?> readonly><span class="input-group-addon bootstrap-touchspin-postfix">%</span>
                                                        
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
                                                        <input name="retention2ammountnio" type="text" class="form-control" id="retention2ammountnio" placeholder="Monto" value="<?php echo $rowpconfirm['ret2a']; ?>" readonly> 
						
                                                          
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
                                                        <input name="retainernio" type="checkbox" id="retainernio" onClick="javascript:reloadNumbers();" value="1"> 
                                                         
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
					  </div>                                              </div>
<script>
function reloadNumbers(){

var cdate = document.getElementById('bookdate').value;
var billComma = document.getElementById('stotalbillcomma').value; 
var radioBox = $('input[name="pcurrency"]:checked').val();
var varcomma = document.getElementById("stotalbillcomma").value;
var varcomma2 = document.getElementById("stotalbillcomma2").value;
var varcomma3 = document.getElementById("stotalbillcomma3").value; 

$.post("reload-booktc.php", { variable: cdate, }, function(data){
document.getElementById('tc').value = data;
}); 
$.post("reload-booktc2.php", { comma: varcomma3, tchange: cdate, process: 2, }, function(data1){
document.getElementById('stotalbillcs').value = data1;
});
$.post("reload-booktc2.php", { comma: varcomma3, tchange: cdate, process: 1, }, function(data2){
document.getElementById('stotalbillcsr').value = data2;
}); 
$.post("reload-booktc2.php", { comma: varcomma2, tchange: cdate, process: 2, }, function(data3){
document.getElementById('totaltaxcs').value = data3;    
});
$.post("reload-booktc2.php", { comma: varcomma, tchange: cdate, process: 2, }, function(data4){ 
document.getElementById('totalbillcs').value = data4;    
});

var tc = document.getElementById('tc').value;

if(tc > 0){
		
		var p1 = document.getElementById("retention1nio").value;
    	var p2 = document.getElementById("retention2nio").value;
		var ndata1 = document.getElementById("stotalbillcs").value;
		var ndata2 = document.getElementById("stotalbillcsr").value;
		var ndata3 = document.getElementById("totaltaxcs").value;
	
	if(document.getElementById('retainernio').checked == true){
		
		document.getElementById('retention1nio').value = 0; 	
		document.getElementById('retention1ammountnio').value = 0.00;
		document.getElementById('retention1nio').readOnly = true;
		document.getElementById('retention2nio').value = 0;
		document.getElementById('retention2ammountnio').value = 0.00;
		document.getElementById('retention2nio').readOnly = true;
		
		//if(exempt == true)
		var varvalue1 = parseFloat(ndata2)+parseFloat(ndata3);
		
		if(radioBox == 0){
			//Cordobas
			document.getElementById('paymentnio').value = 0.00;
		}
		if(radioBox == 1){
			//Cordobas
			document.getElementById('paymentnio').value = varvalue1.toFixed(2);
		}
		if(radioBox == 2){
			//Cordobas
			document.getElementById('paymentnio').value = (parseFloat(varvalue1)/parseFloat(tc)).toFixed(2);
		}
	
	
	}else{
		
		//Calculando retenciones
	
		document.getElementById('retention1nio').readOnly = false;
		document.getElementById('retention2nio').readOnly = false;
		
		var newpaymentniodue = ndata2;
		
		var p1ammount = 0;
		if(p1 != ""){
			var p1ammount = ndata2*(p1/100);
			document.getElementById("retention1ammountnio").value = p1ammount.toFixed(2);
			
		}
		var p2ammount =0;
		if(p2 != ""){
			var p2ammount = ndata2*(p2/100);
			document.getElementById("retention2ammountnio").value = p2ammount.toFixed(2);
		} 
		
		//If exempt != checked
		var due = p1ammount+p2ammount;
		var newpayment = parseFloat(ndata1)+parseFloat(ndata3)-parseFloat(due);
		if(radioBox == 0){
			//Cordobas
			document.getElementById('paymentnio').value = 0.00;
		}
		if(radioBox == 1){
			//Cordobas
			document.getElementById('paymentnio').value = newpayment.toFixed(2);
		}
		if(radioBox == 2){
			//Dolares
			document.getElementById('paymentnio').value = (parseFloat(newpayment)/parseFloat(tc)).toFixed(2); 
		}
		
	}
		
		
	}else{
		
		//var radioBox = $('input[name="pcurrency"]:checked').val();
		
		//$('input[name="pcurrency"]:checked').val = 0;
		
		document.getElementById('pcurency').checked = true;
		
		document.getElementById('retainernio').checked = true;
		document.getElementById('retention1nio').value = 0; 	
		document.getElementById('retention1ammountnio').value = 0.00;
		document.getElementById('retention1nio').readOnly = true;
		document.getElementById('retention2nio').value = 0;
		document.getElementById('retention2ammountnio').value = 0.00;
		document.getElementById('retention2nio').readOnly = true;
		
		//document.getElementById("pcurrency1").checked = true; 
		
	}
	
	
}

</script>







 <div class="row"></div>                                                                                  <h3 class="form-section">Moneda de pago</h3>
<?php //Pagar en moneda ?>                                           
<div class="col-md-5 ">
													  <div class="form-group">
			    <label>Pagar en moneda:</label>	
                
                <div class="radio-list" style="margin-left:15px;">
											
                                           
											<label class="radio-inline">
											<input name="pcurrency" type="radio" id="pcurency" onSelect="" onChange="javascript:reloadNumbers();" value="0" checked="checked">
											Seleccionar</label>
                                            
                                            	<label class="radio-inline">
											<input name="pcurrency" type="radio" id="pcurency" onSelect="" onChange="javascript:reloadNumbers();" value="1">
											Cordobas</label>
                                            
                                         
                          <label class="radio-inline">
										  <input type="radio" name="pcurrency" id="pcurrency" value="2" onChange="javascript:reloadNumbers();">
										 Dólares</label>
                                            
                               
                                                                                       
											
										</div>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                                                                    
<div class="row"></div>

<h3 class="form-section">Pago a Proveedor en Cordobas</h3>
                                                  
<?php //Monto a pagar ?>
<div class="row"><!--/span-->
                                                <div class="col-md-3 "> 
													  <div class="form-group">
			    <label>Monto a Pagar C$</label>
			    :											
                                                        <input name="paymentnio" type="text" class="form-control" id="paymentnio" placeholder="Calculo automático" value="0.00" readonly>
 						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                        
                                                                                      <div class="row"></div>                                                                          
                                                   
                                                
                                                      <!--/row--></div>
												</div>  
                                                  </div>

                                          
<?php //End Display:none ?>
<?php } ?>

                                                    
                                         <div class="row"></div>
                                          <h3 class="form-section">Provisión</h3>
  <div id="ddistribucion0">

  <div id="ddistribucion1">
  <a href="javascript:distribuirPago0(1);" class="btn btn-xs default btn-editable"><i class="fa fa-retweet"></i> Distribución Automatica</a>
   <a href="javascript:distribuirPago(1);" class="btn btn-xs default btn-editable"><i class="fa fa-retweet"></i> Distribución Manual</a> <a href="javascript:distribuirPago2(1);" class="btn btn-xs default btn-editable"><i class="fa fa-retweet"></i> Distribución con plantilla</a></div>
   
   
    
  <div id="ddistribucion2" style="display:none;">
   <a href="javascript:distribuirPago(2);" class="btn btn-xs default btn-editable"><i class="fa fa-retweet"></i> No Distribuir Manualmente</a> 
   </div>
   
   <div id="ddistribucion7" style="display:none;">
   <a href="javascript:distribuirPago0(2);" class="btn btn-xs default btn-editable"><i class="fa fa-retweet"></i> No Distribuir automaticamente</a> 
   </div> 
   
   <div id="ddistribucion4" style="display:none;">
   <a href="javascript:distribuirPago2(2);" class="btn btn-xs default btn-editable"><i class="fa fa-retweet"></i> No Distribuir con plantilla</a> 
   </div>   <br>
<br>
                                       
	<script>
			function calculateTotal1(){ 
			i=0;
for (var obj in document.getElementsByName('percent[]')){
 if (i<document.getElementsByName('percent[]').length){
thepercent = document.getElementsByName('percent[]')[i].value;
thetotal1 = thepercent/100;
thetotal = <?php echo $row['payment']; ?>*thetotal1;
document.getElementsByName('total[]')[i].value = thetotal.toFixed(2);

  }
  i++;
}
			}
			</script>



</script>
  <div id="ddistribucion6" style="display:none;">

  </div>          
 
 <?php //Distribucion Manual ?>     
<div id="ddistribucion3" style="display:none;">                                        									<div class="row">
 
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
                                                        
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Unidad:</label>
                                                        <input name="unit[]" type="text" class="form-control" id="unit[]" value="">
						
           </div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Cuenta:</label> 
                                                        <input name="accounts[]" type="text" class="form-control" id="accounts[]" value="<?php if($account != ""){ echo $account; } ?>">
						
           </div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Porcentaje:</label>
                                                        <input name="percent[]" type="text" class="form-control" id="percent[]" value="" onKeyUp="javascript:calculateTotal1();" onkeypress="return justNumbers(event);">
                                                        
			<script>
			function calculateTotal1(){ 
			i=0;
for (var obj in document.getElementsByName('percent[]')){
 if (i<document.getElementsByName('percent[]').length){
thepercent = document.getElementsByName('percent[]')[i].value;
thetotal1 = thepercent/100;
thetotal = <?php echo $row['payment']; ?>*thetotal1;
document.getElementsByName('total[]')[i].value = thetotal.toFixed(2);

  }
  i++;
}
			}
			</script>			
             </div>
													</div> <div class="col-md-2 ">
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="total[]" type="text" class="form-control" id="total[]" value="" readonly>
						
                                                          
               </div>
													</div> 
                                                   <div class="col-md-2 "> 
                                                    <div class="form-group">
                                                   		<label>&nbsp;</label><br>
                                                        <button type="button" class="btn red" onClick="javascript:deleteRow(1);">-</button>  </div>
                                                        </div>
                                                    </div>
                                                   
                                                    <div id="distributionwaiter">
                                                    </div>
                                                    <div class="col-md-1 ">
 <button type="button" class="btn blue" onClick="addDistribution();">+</button>
 <br><br>&nbsp;
 </div>                                          
        </div>
<?php //Distribucion con plantilla ?>
<div id="ddistribucion5" style="display:none;">                                        									<div class="row">
 
 
<div class="col-md-4 ">
													  <div class="form-group">
														<label>Plantilla:</label>
														<select name="template" class="form-control" id="template" onChange="javascript:reloadtemplate(this.value);">
														  <option value="0">Seleccionar</option>
   <?php $querytemplate = "select * from templates";
   $resulttemplate = mysqli_query($con, $querytemplate);
   while($rowtemplate=mysqli_fetch_array($resulttemplate)){
   ?>                                                      <option value="<?php echo $rowtemplate['id']; ?>"><?php echo $rowtemplate['name']; ?></option>
                                                         <?php } ?>
													    </select>
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div> <div class="col-md-8 " id="templateinfo">
                                                    <p>Distribucion de la plantilla: </p>
                                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">Unidad</th>

									<th width="12%">

										Cuenta</th>

									<th width="12%">

										 Porcentaje</th>
                                         <th width="12%">

										 Total</th>

					
								
                                  

								  </tr>

								</thead>

								<tbody>
                                                               
                                <tr role="row" class="odd">
                                <td colspan="4">Esperando que seleccione una plantilla</td></tr></tbody></table>
                                                    </div>
  </div>
                                                   
                                                    <div id="distribution4waiter">
                                                    </div>
                                                                                              
        </div>         
        
<script type="text/javascript">
function reloadtemplate(id){	

	$.post("reload-template.php", { variable: id, variable2: '<?php echo $row['payment']; ?>' }, function(data){ 
		$("#templateinfo").html(data);		
});			
}

var distributioni = 1;


function addDistribution(){
	//document.getElementsByName('accounts[]')[0].disabled = true;
	var account = document.getElementsByName('accounts[]')[0].value; 
	
   var distributionboxadd = '<div class="row" id="distribution'+distributioni+'"><div class="col-md-2 "><div class="form-group"><input name="unit[]" type="text" class="form-control" id="unit[]" value=""></div></div><div class="col-md-2 "><div class="form-group"><input name="accounts[]" type="text" class="form-control" id="accounts[]" value=""></div></div><div class="col-md-2 "><div class="form-group"><input name="percent[]" type="text" class="form-control" id="percent[]" value=""  onKeyUp="javascript:calculateTotal1();"></div></div> <div class="col-md-2 "><div class="form-group"><input name="total[]" type="text" class="form-control" id="total[]" value="" readonly></div></div> <div class="col-md-2 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+distributioni+');">-</button></div></div></div>';
     distributioni++; 
	 $("#distributionwaiter").append(distributionboxadd);
	
  
}
</script>  
                                                   <script>
function deleteRow(id){
	//document.getElementById("distribution"+id).style.display = 'none';
	var node = document.getElementById("distribution"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}

	
}
function distribuirPago0(onoff){
	if(onoff == 1){
	document.getElementById("ddistribucion1").style.display = 'none';
	document.getElementById("ddistribucion6").style.display = 'block';
	document.getElementById("ddistribucion2").style.display = 'none';
	document.getElementById("ddistribucion3").style.display = 'none';
	document.getElementById("ddistribucion7").style.display = 'block';
	document.getElementById("distributiontype").value = 1;
	$("#ddistribucion6inner").remove(); 
	 var addtodiv6 = '<div id="ddistribucion6inner"><?php //$totalpayment = $row['payment'];
	 
	 
	 
	 $queryaccountmaker = "select * from bills where payment = '$_GET[id]'"; 
$resultaccountmaker = mysqli_query($con, $queryaccountmaker);
while($rowaccountmaker=mysqli_fetch_array($resultaccountmaker)){
	
	//$type = 0;
	$conceptid = $rowaccountmaker['type'];
	$queryconcept = "select * from categories where id = '$conceptid'";
	$resultconcept = mysqli_query($con, $queryconcept);
	$rowconcept = mysqli_fetch_array($resultconcept);
	$conceptaccount = $rowconcept['account']; 
	
	$concept1id = $rowaccountmaker['concept'];
	$queryconcept1 = "select * from categories where id = '$concept1id'";
	$resultconcept1 = mysqli_query($con, $queryconcept1);
	$rowconcept1 = mysqli_fetch_array($resultconcept1);
	$concept1account = $rowconcept1['account'];
	
	$concept2id = $rowaccountmaker['concept2'];
	$queryconcept2 = "select * from categories where id = '$concept2id'";
	$resultconcept2 = mysqli_query($con, $queryconcept2);
	$rowconcept2 = mysqli_fetch_array($resultconcept2);
	$concept2account = $rowconcept2['account'];
	
	//Creacion de la cta	
	$generalaccount = $conceptaccount.".".$concept1account;
	
	//Total Pagar
	$billpaymentvar1 = str_replace('.00','',number_format($row['payment'], 2));
	//Total
	echo $billpaymentvar2 = str_replace('.00','',number_format($rowaccountmaker['billpayment'],2));
	
	$userunit = $row['route'];
	
	$percent = ($billpaymentvar2*100)/$billpaymentvar1;
	$percentammount = "";
	 
	
?><div class="row"><div class="col-md-2 "><div class="form-group"><label>Unidad:</label><input name="unit[]" type="text" class="form-control" id="unit[]" value="<?php echo $userunit; ?>" readonly></div></div><div class="col-md-2 "><div class="form-group"><label>Cuenta:</label><input name="accounts[]" type="text" class="form-control" id="accounts[]" value="<?php echo $generalaccount; ?>" readonly></div></div><div class="col-md-2 "><div class="form-group"><label>Porcentaje:</label><input name="percent[]" type="text" class="form-control" id="percent[]" onKeyUp="javascript:calculateTotal1();" value="<?php echo number_format($percent,2); ?>" readonly></div></div><div class="col-md-2 "><div class="form-group"><label>Total:</label><input name="total[]" type="text" class="form-control" id="total[]" value="<?php echo $billpaymentvar2; ?>" readonly></div></div></div><?php } ?></div>';
$("#ddistribucion6").append(addtodiv6); 
	
	}
	if(onoff == 2){
	document.getElementById("ddistribucion1").style.display = 'block';
	document.getElementById("ddistribucion7").style.display = 'none';
	document.getElementById("ddistribucion6").style.display = 'none';
	document.getElementById("ddistribucion2").style.display = 'none';
	document.getElementById("ddistribucion3").style.display = 'none';
	document.getElementById("distributiontype").value = 0;
	$("#ddistribucion6inner").remove();
	
	/*i=0;
for (var obj in document.getElementsByName('unit[]')){
 if (i<document.getElementsByName('unit[]').length){
	 document.getElementsByName('unit[]')[i].value = '';
	 document.getElementsByName('percent[]')[i].value = '';
	 document.getElementsByName('total[]')[i].value = '';
	 document.getElementsByName('accounts[]')[i].value = '';
}
  i++;
}*/


	
	}
		
}
function distribuirPago(onoff){
	if(onoff == 1){
	document.getElementById("ddistribucion1").style.display = 'none';
	document.getElementById("ddistribucion6").style.display = 'none';
	document.getElementById("ddistribucion2").style.display = 'block';
	document.getElementById("ddistribucion3").style.display = 'block';
	document.getElementById("distributiontype").value = 1;
	
	}
	if(onoff == 2){
	document.getElementById("ddistribucion1").style.display = 'block';
	document.getElementById("ddistribucion6").style.display = 'none';
	document.getElementById("ddistribucion2").style.display = 'none';
	document.getElementById("ddistribucion3").style.display = 'none';
	document.getElementById("distributiontype").value = 0;
	
	
	i=0;
for (var obj in document.getElementsByName('unit[]')){
 if (i<document.getElementsByName('unit[]').length){
	 document.getElementsByName('unit[]')[i].value = '';
	 document.getElementsByName('percent[]')[i].value = '';
	 document.getElementsByName('total[]')[i].value = '';
	 document.getElementsByName('accounts[]')[i].value = '';
}
  i++;
}


	
	}
		
}
function distribuirPago2(onoff){
	if(onoff == 1){
	document.getElementById("ddistribucion1").style.display = 'none';
	document.getElementById("ddistribucion6").style.display = 'none';
	document.getElementById("ddistribucion4").style.display = 'block';
	document.getElementById("ddistribucion5").style.display = 'block';
	document.getElementById("distributiontype").value = 2;

	}
	if(onoff == 2){
	document.getElementById("ddistribucion1").style.display = 'block';
	document.getElementById("ddistribucion6").style.display = 'none';
	document.getElementById("ddistribucion4").style.display = 'none';
	document.getElementById("ddistribucion5").style.display = 'none';
	document.getElementById("template").value = 0;
	var datatable = '<p>Distribucion de la plantilla:</p><table class="table table-striped table-bordered table-hover" id="datatable_orders"><thead><tr role="row" class="heading"><th width="5%">Unidad</th><th width="12%">Cuenta</th><th width="12%">Porcentaje</th><th width="12%">Total</th></tr></thead><tbody><tr role="row" class="odd"><td colspan="4">Esperando que seleccione una plantilla</td></tr></tbody></table>';
$("#templateinfo").html(datatable);
document.getElementById("distributiontype").value = 0;
	

	}
		
}
</script>
 <?php //ACTIONS ?>                                                   
 

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
                                    <div class="col-md-2 ">
									  <div class="form-group">
			    <label>No. Batch:</label>
			    											
                                        <input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value="">
						
                                                          
              </div>
												</div><div class="col-md-3 ">
												  <div class="form-group">
			    <label>Link del Batch:</label>
			    											
                                                    <input name="linkbatch[]" type="text" class="form-control" id="linkbatch[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
                                                 <div class="col-md-2 ">
									  <div class="form-group">
			    <label>No. Documento:</label>
			    											
                                        <input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value="">
						
                                                          
              </div>
												</div><div class="col-md-3 ">
												  <div class="form-group">
			    <label>Link del Documento:</label>
			    											
                                                    <input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
                                    
 
 </div>
 <?php /*since ?>
 <div class="row">
                                    <div class="col-md-2 ">
									  <div class="form-group">
			  
			    											
                                        <input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value="">
						
                                                          
              </div>
												</div><div class="col-md-3 ">
												  <div class="form-group">
			   
			    											
                                                    <input name="linkbatch[]" type="text" class="form-control" id="linkbatch[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
                                                 <div class="col-md-2 ">
									  <div class="form-group">
			   
			    											
                                        <input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value="">
						
                                                          
              </div>
												</div><div class="col-md-3 ">
												  <div class="form-group">
			  
			    											
                                                    <input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value="">
						
                                                          
              </div>
												</div> <div class="col-md-2 "> 
                                                    <div class="form-group">
                                                <button type="button" class="btn red" onclick="javascript:deleteRow(1);">-</button>  </div>
                                                        </div>
                                    
 
 </div> 
 <?php end*/?>
  <div id="batchwaiter">
                                                    </div>
                                                    <div class="col-md-1 ">
 <button type="button" class="btn blue" onClick="addBatch();">+</button>
 <br><br>&nbsp;</div>
 
  
   <script type="text/javascript">
var noBatch = 1;
function addBatch(){
   var newBatch = '<div class="row" id="batch'+noBatch+'"><div class="col-md-2 "><div class="form-group"><input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value=""></div></div><div class="col-md-3 "><div class="form-group"><input name="linkbatch[]" type="text" class="form-control" id="linkbatch[]" placeholder="" value=""></div></div><div class="col-md-2 "><div class="form-group"><input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value=""></div></div><div class="col-md-3 "><div class="form-group"><input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value=""></div></div><div class="col-md-2 "><div class="form-group"><button type="button" class="btn red" onclick="javascript:deleteRowBatch('+noBatch+');">-</button></div></div></div>';
     noBatch++; 
	 $("#batchwaiter").append(newBatch);
  
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

												

						    <button type="submit" class="btn blue"><i class="fa fa-check"></i> Provisionar</button> 
												<input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>">
                                                <input name="distributiontype" type="hidden" id="distributiontype" value="0">
  </div>
                                            </div>                                                   </div>
                                            
                                            
                                            
                                                  

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

<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimeout.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimer.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>
<script src="../assets/admin/pages/scripts/components-pickers.js"></script>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>

jQuery(document).ready(function() {    

   Metronic.init(); // init metronic core components

Layout.init(); // init current layout

QuickSidebar.init() // init quick sidebar


ComponentsPickers.init();
});

</script>

    
    <script type="text/javascript">

function validateForm(){
	
	var ctype = document.getElementById("currencytype").value;
	if(ctype == 2){
	
	
	
	if(tc == "ND"){
		alert('No se puede provisionar un pago en USD sin la taza de cambio actualizada.');
		return false;
	}
}

	var currencyp = <?php echo $row['currency']; ?>;
	if(currencyp == 2){
		var tc = document.getElementById("tc").value;
		if(tc > 0){
		}else{
		alert('No se puede provisionar un pago en USD sin la taza de cambio actualizada.');
		return false;
	}
	}
	var dtype = document.getElementById("distributiontype").value;
	if(dtype == 0){
		alert('Debe de seleccionar un tipo de distribucion.');
		return false;
	}
	var tptotal = 0;
	distribution = document.getElementById("ddistribucion3");
	if(distribution.style.display == 'block'){
		//alert('la capa esta visible');
		//return false;
		//desd aqui
		i=0;
for (var obj in document.getElementsByName('unit[]')){
 if (i<document.getElementsByName('unit[]').length){
varunit = document.getElementsByName('unit[]')[i].value;
if(varunit == ''){
	alert('El campo unidad no puede estar en blanco');
	document.getElementsByName('unit[]')[i].focus();
	return false;
}
percent = document.getElementsByName('percent[]')[i].value;
if(percent == ''){
	alert('El campo porcentaje no puede estar en blanco');
	document.getElementsByName('percent[]')[i].focus();
	return false;
}
total = document.getElementsByName('total[]')[i].value;
if(total == ''){
	alert('El campo total no puede estar en blanco');
	document.getElementsByName('total[]')[i].focus();
	return false;
}
accounts = document.getElementsByName('accounts[]')[i].value;
if(accounts == ''){
	alert('El campo cuenta no puede estar en blanco');
	document.getElementsByName('accounts[]')[i].focus();
	return false;
}

if((percent != 0) && (percent != '')){
tptotal += parseFloat(percent); 
}

}
  i++; 
}
		//hasta aqui
		
if(tptotal != 100){
	alert('La distribucion del pago debe de sumar 100%');
	tptotal = 0;
	return false;
}

}


	
i=0;
for (var obj in document.getElementsByName('nobatch[]')){
 if (i<document.getElementsByName('nobatch[]').length){
varnobatch = document.getElementsByName('nobatch[]')[i].value;
if(varnobatch == ''){
	alert('El campo "no batch" no puede estar en blanco');
	document.getElementsByName('nobatch[]')[i].focus();
	return false;
}
varlinkbatch = document.getElementsByName('linkbatch[]')[i].value;
if(varlinkbatch == ''){
	alert('El campo "Link del batch" no puede estar en blanco');
	document.getElementsByName('linkbatch[]')[i].focus();
	return false;
}
if(!/http/.test(varlinkbatch)){
	alert('Asegurese de que el link cuente con el protocolo http:// o https://');
	document.getElementsByName('linkbatch[]')[i].focus();
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
if(!/http/.test(varlinkdocument)){
	alert('Asegurese de que el link cuente con el protocolo http:// o https://');
	document.getElementsByName('linkdocument[]')[i].focus();
	return false;
}
  }
  i++;
}	
	
}

function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
}
		
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html> 