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
                                      <h3 class="form-section">Herramientas </h3>
                                        
                                    <div class="col-md-3 ">    
                                        <a href="javascript:recalculateRetention(1);" class="btn btn-xs default btn-editable" id="recalculate1"><i class="fa fa-retweet"></i> Recalcular Retenciones</a>
                                        <a href="javascript:recalculateRetention(2);" class="btn btn-xs default btn-editable" id="recalculate2" style="display:none;"><i class="fa fa-retweet"></i> No Recalcular Retenciones</a>
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

<div class="row">
<br>
</div>

<div id="recalculate5" style="display:none;">
<div class="row">
<div class="col-md-12 " ><br><br>

 </div>
 </div>
</div> 
 
<form action="provision-view-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
 <input type="hidden" name="mytotalstotal" id="mytotalstotal" value="<?php echo $mytotalstotal; ?>">
                                          <input type="hidden" name="myniostotal" id="myniostotal" value="<?php echo $myniototalstotal?>">
                                          <input type="hidden" name="mybillcurrency" id="mybillcurrency" value="<?php echo $mybillcurrency; ?>">
                                          <input type="hidden" name="mypaymentcurrency" id="mypaymentcurrency" value="<?php echo $row['currency']; ?>">
                                          
                                          
                              

							

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