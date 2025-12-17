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




if($row['btype'] == 1){
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
}else{
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

										

									<?php include("stage-main.php");
									include("stage-status.php"); 
									 
									?>
                                    <input name="currency2pay" type="hidden" id="currency2pay" value="<?php echo $rowprovider['currency']; ?>">
                                    
                                    
                                        <div class="row"></div>
                                      <h3 class="form-section">Herramientas Pre-Provisión</h3>
                                        
                                    <div class="col-md-3 ">    <a href="javascript:recalculateRetention(1);" class="btn btn-xs default btn-editable" id="recalculate1"><i class="fa fa-retweet"></i> Recalcular Retenciones</a>
                                        <a href="javascript:recalculateRetention(2);" class="btn btn-xs default btn-editable" id="recalculate2" style="display:none;"><i class="fa fa-retweet"></i> No Recalcular Retenciones</a>
     </div>                                  
<script>

function recalculateRetention(mainoption){
	
	
	if(mainoption == 1){ 
		document.getElementById("recalculate0").style.display = "block";
		document.getElementById("recalculate1").style.display = "none";
		document.getElementById("recalculate2").style.display = "block";
	}
	else if(mainoption == 2){
		document.getElementById("recalculate0").style.display = "none";
		document.getElementById("recalculate2").style.display = "none";
		document.getElementById("recalculate1").style.display = "block"; 
	}
}

</script>       
                                        
                                        
                                        
<div id="recalculate0" style="display:none;">
<form action="provision-retention-repair.php" method="post" enctype="multipart/form-data">                                        
<div class="row"></div>
                                         
<h3 class="form-section">Ajustar Retenciones</h3>
                                         
<div class="row">
                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Alcaldía C$:</label>
                                                        <input name="retention1new" type="text" class="form-control" id="retention1new" value="" placeholder="%" onKeyUp="javascript:reloadNumbers();" onkeypress="return justNumbers(event);" ><span class="input-group-addon bootstrap-touchspin-postfix">%</span>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<div class="col-md-3 ">
													  <div class="form-group">
														
           <label>&nbsp;</label>                                             <input name="retention1ammountnew" type="text" class="form-control" id="retention1ammountnew" placeholder="Monto" value="" readonly>
						
                                                          
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
                                                        <input name="retention2new" type="text" class="form-control" id="retention2new" value="" placeholder="%" onKeyUp="javascript:reloadNumbers();" onkeypress="return justNumbers(event);" ><span class="input-group-addon bootstrap-touchspin-postfix">%</span>
                                                        
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
                                                        <input name="retention2ammountnew" type="text" class="form-control" id="retention2ammountnew" placeholder="Monto" value="<?php echo $rowpconfirm['ret2a']; ?>" readonly> 
						
                                                          
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
                                                        <input name="retainernew" type="checkbox" id="retainernew" onClick="javascript:reloadNumbers();" value="1"> 
                                                         
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
					  </div>                                              </div>
<script>
function reloadNumbers(){ 



	//Vars
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
	var stotal = 0;
	
	
	i=0;
	
	
	var c2pay = document.getElementById('currency2pay').value;

	
	for (var obj in document.getElementsByName('ammount[]')){
	if (i<document.getElementsByName('ammount[]').length){
   //Monto total de la factura
   cammount = document.getElementsByName('ammount[]')[i].value;
   cammount = numberFormat(cammount);
  
	
   //monto libre de impuestos
   nammount = document.getElementsByName('nammount[]')[i].value;
   nammount = numberFormat(nammount);
  
   //monto libre de ir
   nammountb = document.getElementsByName('nammountb[]')[i].value;
   nammountb = numberFormat(nammountb);
   
   
 
   //monto libre de IR
   
   //hay que hacerlo

   
   
   //Si el checkbox de cuota fija esta activado
  //alert(document.getElementsByName('exempt[]')[i].checked); 
   if(document.getElementsByName('exempt[]')[i].checked == true){
	   tax = 0; 
	   var stotal = cammount;
	   document.getElementsByName('tax[]')[i].value = 'n/a';
	   document.getElementsByName('stotal[]')[i].value = 'n/a';
	}else{
   

   if(nammount == ""){
	   //subtotal va a ser igual al monto corriente menos el iva
	   var stotal = cammount/1.15; 
	   //iva va a aser igual al monto corriente menos el subtotal
	   var tax = cammount-stotal;
   }else{
	   var stotal = (cammount-nammount)/1.15; 
	   var tax =  cammount-stotal-nammount; 
   }
  
    
	document.getElementsByName('tax[]')[i].value = commas(tax);
   document.getElementsByName('stotal[]')[i].value = commas(stotal);
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
  //alert(gstotalmay1000);
  //gtax = gtax-nammount;
    //alert(nammount);
   
    if(gtotal > 0){
		document.getElementById("totalbill").value = commas(gtotal);
	}else{
		document.getElementById("totalbill").value = '0.00';
	}
		
    document.getElementById("totaltax").value = commas(gtax);
    document.getElementById("stotalbill").value = commas(gstotal);
    //new
    document.getElementById("stotalbillmen1000").value = commas(gstotalmen1000);
    document.getElementById("stotalbillmay1000").value = commas(gstotalmay1000);
  
  
	var currency = document.getElementsByName('currency');

	
divRetention();
	
var p1 = document.getElementById("retention1new").value;
var p2 = document.getElementById("retention2new").value; 
//alert(p1);	
var bcurrency = document.getElementById('bcurrencynew').value;	 
var payment = gstotal;
       
	   //Retenciones en cordobas 
		
		
		
		if(bcurrency == 1){
			
			if((p1 != "") || (p2 != "")){
				if(gstotal == 0){
				document.getElementById("retention1new").value = 0;
				document.getElementById("retention2new").value = 0;
				//document.getElementByName("ammount[]").focus();
				alert('El monto debe de contener una cantidad');
			}else{ 
				if(p1 != ""){
			var p1ammount = gstotalmay1000*(p1/100);
			document.getElementById("retention1ammountnew").value = commas(p1ammount);
			var payment = parseFloat(payment)-parseFloat(p1ammount);
		}
		if(p2 != ""){
			var p2ammount = gstotalmay1000*(p2/100);
			document.getElementById("retention2ammountnew").value = commas(p2ammount);
			var payment = parseFloat(payment)-parseFloat(p2ammount); 
		} 
		var payment = payment+gtax;
		
		if(gnammount > 0){
			var payment = parseFloat(payment)+parseFloat(gnammount);   
		}
		
		payment = parseFloat(payment).toFixed(2);
		
		document.getElementById("floatpaymentnew").value = payment;
		document.getElementById("floatcurrencynew").value = 1;
		var newpayment = commas(payment)+" Córdobas";
		
		document.getElementById("paymentnew").value = commas(payment);
			}
			}
		}
       
	   
	   
	   //Retenciones en dolares
	   else if(bcurrency == 2){
		   
		   if((p1 != "") || (p2 != "")){
				if(gstotal == 0){
				document.getElementById("retention1new").value = 0;
				document.getElementById("retention2new").value = 0;
				//document.getElementByName("ammount[]").focus();
				alert('El monto debe de contener una cantidad');
			}else{ 
				

	//Read bills to convert
				
	var usdgstotalmay1000 = 0;
	var payment = 0;
	var inc = 0;
	var inc2 = 0;
	var inc3 = 0;
	var inc4 = 0;
	var inc5 = 0;
	var inc6 = 0;
	var usdammount = 0;
	var usdbilldate = 0;
	var usdbilltax = 0;
	var currency2pay = 0;
	 
	
	i=0;
	for(var obj in document.getElementsByName('ammount[]')){
		if(i<document.getElementsByName('ammount[]').length){
			
			var usdammount = document.getElementsByName('ammount[]')[i].value;
			usdammount = numberFormat(usdammount);
			var usdbilldate = document.getElementsByName('billdate[]')[i].value;
			usdbilldate = numberFormat(usdbilldate);
			var usdbilltax = document.getElementsByName('tax[]')[i].value;
			usdbilltax = numberFormat(usdbilltax);
			
			if(usdammount == ""){
				document.getElementsByName('ammount[]')[i].focus();
				//divRetention()
				alert('Ingrese la el monto de la factura');
			}
			if(usdbilldate == ""){
				document.getElementsByName('billdate[]')[i].focus();
				//divRetention()
				alert('Ingrese la fecha de la factura');
			} 
			
			//var usdgstotalmay1000 = usdgstotalmay1000+getConversions(usdammount,usdbilldate);
			
			//Subtotal ret (NIO)
			
			
			var inc = getConversions(usdammount,usdbilltax,usdbilldate,1);
			var inc2 = parseFloat(inc2)+parseFloat(inc);
			
			//IVA (NIO)
			var inc3 = getConversions(usdbilltax,0,usdbilldate,2);
			var inc4 = parseFloat(inc4)+parseFloat(inc3);
			
			//Subtotal ret (USD)
			var inc5 = getConversions(usdammount,usdbilltax,usdbilldate,4);
			var inc6 = parseFloat(inc6)+parseFloat(inc5);
			
			
			
		
			
		}
		i++
	} 
				
				
				var payment = inc2;
				var paymentusd = inc6;
			
				
				if(p1 >= 0){
				
				var p1ammount = inc2*(p1/100);
				var p1ammount2 = inc6*(p1/100);
				
				document.getElementById("retention1ammountnew").value = commas(p1ammount);
				var payment = payment-p1ammount;
				var paymentusd =  paymentusd-p1ammount2;
				}else{
					document.getElementById("retention1new").value = 0;
				}
				
				if(p2 >= 0){
				
				var p2ammount = inc2*(p2/100);
				var p2ammount2 = inc6*(p2/100);
				
				
				
				document.getElementById("retention2ammountnew").value = commas(p2ammount);
				var payment = payment-p2ammount;
				var paymentusd =  paymentusd-p2ammount2;
				}else{
					document.getElementById("retention2new").value = 0;
				}
				
				var totaltaxusd = document.getElementById("totaltax").value;
				totaltaxusd = commas(totaltaxusd);
				
				
				if(c2pay == 1){
					var paymentusd =parseFloat(payment)+parseFloat(inc4); 
					paymentusd = paymentusd.toFixed(4);
					//check here if needs commas
					document.getElementById("floatpaymentnew").value = paymentusd;
					document.getElementById("floatcurrencynew").value = 1;
					paymentusd = "NIO C$"+commas(paymentusd)+" Córdobas"; 
				}
				else if(c2pay == 2){
					var paymentusd = parseFloat(paymentusd)+parseFloat(totaltaxusd);
					paymentusd = paymentusd.toFixed(4);
					document.getElementById("floatpaymentnew").value = paymentusd;
					document.getElementById("floatcurrencynew").value = 2;
					paymentusd = commas(paymentusd)+" Dólares"; 
				}
				
				
				document.getElementById("paymentnew").value = paymentusd;
		
			
			}
			}
		}
		
		
		//Euros 
		else if(bcurrency == 3){
			document.getElementById('retainernew').checked = true;
			divRetention();
			var payment = document.getElementById('totalbill').value;
			document.getElementById("floatpayment").value = payment;
			document.getElementById("floatcurrency").value = 3;
			payment = payment+" Euros";
			document.getElementById("payment").value = commas(paymentusd);
			
		}
		
		//Yenes
		else if(bcurrency == 4){
			document.getElementById('retainernew').checked = true;
			divRetention();
			var payment = document.getElementById('totalbill').value;
			document.getElementById("floatpayment").value = payment;
			document.getElementById("floatcurrency").value = 4;
			payment = payment+" Yenes";
			document.getElementById("payment").value = commas(payment);
			
		}
      
	  
    
 
	
}


function getConversions(usdammount,usdbilltax,usdbilldate,processid) {
    $.ajaxSetup({async:false});  //execute synchronously

    var returnData = null;  //define returnData outside the scope of the callback function

    $.post("reload-booktc3.php", { ammount: usdammount, billtax: usdbilltax, billdate: usdbilldate, process: processid }, function(data5) {

        returnData = data5; 

    });

    $.ajaxSetup({async:true});  //return to default setting

    return returnData;

}

function divRetention(){
	if(document.getElementById('retainernew').checked == true){
		document.getElementById('retention1new').value = 0; 	
		document.getElementById('retention1ammountnew').value = 0.00;
		document.getElementById('retention1new').readOnly = true;
		document.getElementById('retention2new').value = 0;
		document.getElementById('retention2ammountnew').value = 0.00;
		document.getElementById('retention2new').readOnly = true;
		var p1 = 0;
		var p2 = 0; 
	}else{
	document.getElementById('retention1new').readOnly = false;
	document.getElementById('retention2new').readOnly = false;
	
	
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
                                                        <input name="paymentnew" type="text" class="form-control" id="paymentnew" placeholder="Calculo automático" value="0.00" readonly>
                                                        <input name="floatpaymentnew" type="hidden" id="floatpaymentnew">
                                                        <input name="floatcurrencynew" type="hidden" id="floatcurrencynew">
                                                          <input name="floatpayment" type="hidden" id="floatpayment">
                                                        <input name="floatcurrency" type="hidden" id="floatcurrency">
 						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
          <button type="submit" class="btn blue"><i class="fa fa-check"></i> Ajustar Retenciones</button>
          <input name="paymentadj" type="hidden" id="paymentadj" value="<?php echo $_GET['id']; ?>"> 
          
                                                                                      <div class="row"></div>                                                                          
                                                   
                                                
                                                      <!--/row--></div>
												</div>  
                                                  </div>

 </form>                                         
</div>
<form action="provision-view-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
 <input type="hidden" name="mytotalstotal" id="mytotalstotal" value="<?php echo $mytotalstotal; ?>">
                                          <input type="hidden" name="myniostotal" id="myniostotal" value="<?php echo $myniototalstotal?>">
                                          <input type="hidden" name="mybillcurrency" id="mybillcurrency" value="<?php echo $mybillcurrency; ?>">
                                          <input type="hidden" name="mypaymentcurrency" id="mypaymentcurrency" value="<?php echo $row['currency']; ?>">
                                          
                                          
                                                    
                                         <div class="row"></div>
                                          <h3 class="form-section">Provisión 
</h3>
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

thetotal = <?php echo $totalpro; ?>*thetotal1;
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
     
<div id="ddistribucion3" style="display:none;"><div class="row">
<div class="col-md-2 ">
</div>
<div class="col-md-2 ">
</div>                                                    
<div class="col-md-2 "><input type="radio" name="pertot" id="pertot" value="1" checked="" onChange="changePertot(this.value);">
</div>
<div class="col-md-2 "><input type="radio" name="pertot" id="pertot" value="2" onChange="changePertot(this.value);">
</div>
</div>                                        									<div class="row">
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
			
			var mytotalstotal = document.getElementById('mytotalstotal').value;
			var myniostotal = document.getElementById('myniostotal').value;
			var mybillcurrency = document.getElementById('mybillcurrency').value;
			var mypaymentcurrency = document.getElementById('mypaymentcurrency').value;

			
			i=0;
for (var obj in document.getElementsByName('percent[]')){
 if (i<document.getElementsByName('percent[]').length){
thepercent = document.getElementsByName('percent[]')[i].value;
thetotal1 = thepercent/100;

if((mypaymentcurrency == 1) && (mybillcurrency == 1)){
	var thetotal = mytotalstotal*thetotal1;
}
if((mypaymentcurrency == 2) && (mybillcurrency == 2)){
	var thetotal = mytotalstotal*thetotal1;
}
if((mypaymentcurrency == 1) && (mybillcurrency == 2)){
	var thetotal = myniostotal*thetotal1;
}

//document.getElementsByName('total[]')[i].value = commas(thetotal);
document.getElementsByName('total[]')[i].value = thetotal;
  }
  i++;
}
			}
			
			
			function calculateTotal2(){ 
			
			var mytotalstotal = document.getElementById('mytotalstotal').value;
			var mytotalstotal = numberFormat(mytotalstotal); 
			var myniostotal = document.getElementById('myniostotal').value;
			var myniostotal = numberFormat(myniostotal);
			var mybillcurrency = document.getElementById('mybillcurrency').value;
			var mypaymentcurrency = document.getElementById('mypaymentcurrency').value;
			
			
			i=0;
for (var obj in document.getElementsByName('percent[]')){
 if (i<document.getElementsByName('percent[]').length){
theammount = document.getElementsByName('total[]')[i].value;

var thepercent1 = theammount*100;

if((mypaymentcurrency == 1) && (mybillcurrency == 1)){
	var thepercent = thepercent1/mytotalstotal;
}
if((mypaymentcurrency == 2) && (mybillcurrency == 2)){
	var thepercent = thepercent1/mytotalstotal;
}
if((mypaymentcurrency == 1) && (mybillcurrency == 2)){
	var thepercent = thepercent1/myniostotal;
}
 
document.getElementsByName('percent[]')[i].value = thepercent.toFixed(2); 

  }
  i++;
}
			}
			
			</script>	
             </div>
													</div> <div class="col-md-2 ">
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="total[]" type="text" class="form-control" id="total[]" value="" onKeyUp="javascript:calculateTotal2();" readonly onkeypress="return justNumbers(event);">
						
                                                          
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
														  
                                                          <?php $querytemplate = "select * from templates where userid = '$_SESSION[userid]'";
   $resulttemplate = mysqli_query($con, $querytemplate);
   $numtemplate = mysqli_num_rows($resulttemplate);
   if($numtemplate > 0){
	   ?>
                                                          <option value="0">Seleccionar</option>
   <?php while($rowtemplate=mysqli_fetch_array($resulttemplate)){
   ?>                                                      <option value="<?php echo $rowtemplate['id']; ?>"><?php echo $rowtemplate['name']; ?></option>
                                                         <?php } }else{ ?>
                                                         <option value="0">Ninguna plantilla previamente agregada</option>

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

	var mytotalstotal = document.getElementById('mytotalstotal').value;
	var mytotalstotal = numberFormat(mytotalstotal); 
	var myniostotal = document.getElementById('myniostotal').value;
	var myniostotal = numberFormat(myniostotal);
	var mybillcurrency = document.getElementById('mybillcurrency').value;
	var mypaymentcurrency = document.getElementById('mypaymentcurrency').value;
	
	if((mypaymentcurrency == 1) && (mybillcurrency == 1)){
		var myammount = mytotalstotal;
	}
	if((mypaymentcurrency == 2) && (mybillcurrency == 2)){
		var myammount = mytotalstotal;
	}
	if((mypaymentcurrency == 1) && (mybillcurrency == 2)){
		var myammount = myniostotal;
	}		
	
	$.post("reload-template.php", { variable: id, variable2: myammount }, function(data){ 
		$("#templateinfo").html(data);		
});			
}

var distributioni = 1;


function addDistribution(){
	//document.getElementsByName('accounts[]')[0].disabled = true;
	var account = document.getElementsByName('accounts[]')[0].value;
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
	 

   var distributionboxadd = '<div class="row" id="distribution'+distributioni+'"><div class="col-md-2 "><div class="form-group"><input name="unit[]" type="text" class="form-control" id="unit[]" value=""></div></div><div class="col-md-2 "><div class="form-group"><input name="accounts[]" type="text" class="form-control" id="accounts[]" value=""></div></div><div class="col-md-2 "><div class="form-group"><input name="percent[]" type="text" class="form-control" id="percent[]" value=""  onKeyUp="javascript:calculateTotal1();" '+readOnly1+'></div></div> <div class="col-md-2 "><div class="form-group"><input name="total[]" type="text" class="form-control" id="total[]" value="" '+readOnly2+' onKeyUp="javascript:calculateTotal2();"></div></div> <div class="col-md-2 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+distributioni+');">-</button></div></div></div>';
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
	var addtodiv6 = '<div id="ddistribucion6inner"><?php $queryaccountmaker = "select * from bills where payment = '$_GET[id]'"; 
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
	
	
	
	//Si el pago es en Cordobas o si es en dolares y se paga en dolares
	if(($rowaccountmaker['currency'] == 1) or (($rowaccountmaker['currency'] == 2) and ($row[currency] == 2))){ 
	
	if($rowaccountmaker['stotal'] > 0){
		$mystotal = $rowaccountmaker['stotal'];
	}else{
		$mystotal = $rowaccountmaker['ammount']; 
	}
	
	$percent = ($mystotal*100)/$mytotalstotal;
	
	
	}
	//Si el pago es en dolares y se paga en cordobas
	if(($rowaccountmaker['currency'] == 2) and ($row[currency] == 1)){
		if($rowaccountmaker['stotal'] > 0){
			$mystotal = $rowaccountmaker['niostotal'];
		}else{
			$mystotal = $rowaccountmaker['nioammount']; 
		}
		$percent = ($mystotal*100)/$myniototalstotal; 
		
	}

$userunit = $row['route'];
	
?><div class="row"><div class="col-md-2 "><div class="form-group"><label>Unidad:</label><input name="unit[]" type="text" class="form-control" id="unit[]" value="<?php echo $userunit; ?>" readonly></div></div><div class="col-md-2 "><div class="form-group"><label>Cuenta:</label><input name="accounts[]" type="text" class="form-control" id="accounts[]" value="<?php echo $generalaccount; ?>" readonly></div></div><div class="col-md-2 "><div class="form-group"><label>Porcentaje:</label><input name="percent[]" type="text" class="form-control" id="percent[]" onKeyUp="javascript:calculateTotal1();" value="<?php echo number_format($percent,2); ?>" readonly></div></div><div class="col-md-2 "><div class="form-group"><label>Total:</label><input name="total[]" type="text" class="form-control" id="total[]" value="<?php echo number_format($mystotal,2); ?>" readonly></div></div></div><?php } ?></div>';
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
                                    <div class="col-md-3 ">
									  <div class="form-group">
			    <label>No. Batch:</label>
			    											
                                        <input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
												
												<?php /*<div class="col-md-3 ">
												  <div class="form-group">
			    <label>Link del Batch:</label>
			    											
                                                    <input name="linkbatch[]" type="text" class="form-control" id="linkbatch[]" placeholder="" value="">
						
                                                          
              </div>
												</div>*/ ?>
                                                 <div class="col-md-3 ">
									  <div class="form-group">
			    <label>No. Documento:</label>
			    											
                                        <input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value="">
						
                                                          
              </div>
												</div><div class="col-md-6 ">
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
                                                    <div class="col-md-3 ">
 <button type="button" class="btn blue" onClick="addBatch();">+</button>&nbsp;<button type="button" class="btn blue" onClick="openFiles();"><i class="fa fa-search"></i> Ver archivos</button>
 <script>
 function openFiles(){
	 window.open('files.php');
 }
 </script>
 <br><br>&nbsp;</div>

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
												</div><div class="col-md-6 ">
									  <div class="form-group">
			    <label>Link:</label>
			    											
                                        <input name="internationallink" type="text" class="form-control" id="internationallink" placeholder="" value="">
						
                                                          
              </div>
												</div>
<?php } ?> 

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
   var newBatch = '<div class="row" id="batch'+noBatch+'"><div class="col-md-3"><div class="form-group"><input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value=""></div></div><div class="col-md-3 "><div class="form-group"><input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value=""></div></div><div class="col-md-5 "><div class="form-group"><input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value=""></div></div><div class="col-md-1 "><div class="form-group"><button type="button" class="btn red" onclick="javascript:deleteRowBatch('+noBatch+');">-</button></div></div></div>';
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

												
    <p>
                            
                            </p>
						    <button type="button" class="btn red" onClick="denyPayment();"><i class="fa fa-check"></i> Rechazar Pago</button> 
                            
                              
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

function validateForm(){
	
	
	/*var ctype = document.getElementById("currencytype").value;
	if(ctype == 2){
	
	if(tc == "ND"){
		alert('No se puede provisionar un pago en USD sin la taza de cambio actualizada.');
		return false;
	}
}*/

	<?php /*
	var currencyp = <?php echo $row['currency']; ?>;
	if(currencyp == 2){
		var tc = document.getElementById("tc").value;
		if(tc > 0){
		}else{
		alert('No se puede provisionar un pago en USD sin la taza de cambio actualizada.');
		return false;
	}
	}
	*/ ?>
	
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
/*varlinkbatch = document.getElementsByName('linkbatch[]')[i].value;
if(varlinkbatch == ''){
	alert('El campo "Link del batch" no puede estar en blanco');
	document.getElementsByName('linkbatch[]')[i].focus();
	return false;
}
if(!/http/.test(varlinkbatch)){
	alert('Asegurese de que el link cuente con el protocolo http:// o https://');
	document.getElementsByName('linkbatch[]')[i].focus();
	return false;
}*/ 
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

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html> 