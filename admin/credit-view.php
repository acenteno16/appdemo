<?php 

include("session-credit.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = $con->prepare("select * from payments where id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$row = mysqli_fetch_array($result);

$themainroute = $row['route'];

function showAlertAndRedirect($message) {
    echo "<script> alert('$message'); window.location = 'credit.php'; </script>";
}

switch($row['status']) { 
    case 1:
        showAlertAndRedirect('Este pago no ha sido aprobado.');
        break;
    case 2:
    case 3:
    case 4:
        if ($row['approved'] == 0) {
            showAlertAndRedirect('Este pago se encuentra en la ruta de aprobacion.');
        }
        break;
    case 5:
        showAlertAndRedirect('Este pago fue rechazado en la etapa 1.');
        break;
    case 6:
        showAlertAndRedirect('Este pago fue rechazado en la etapa 2.');
        break;
    case 7:
        showAlertAndRedirect('Este pago fue rechazado en la etapa 3.');
        break;
    case 8:
        showAlertAndRedirect('Este pago ya fue provisionado.');
        break;
}



$queryb = $con->prepare("select * from bills where payment = ?");
$queryb->bind_param("i", $id);
$queryb->execute();
$resultb = $queryb->get_result();
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

$queryaccountmaker0 = $con->prepare("select * from bills where payment = ?");
$queryaccountmaker0->bind_param("i", $id);
$queryaccountmaker0->execute();
$resultaccountmaker0 = $queryaccountmaker0->get_result();
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

					Crédito <? // <small>Provisionar pagos.</small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="credit.php">Liquidaciones</a>
                            
                            <i class="fa fa-angle-right"></i>
                            
                            </li>
                            

						<li>

							<a>Liquidar pagos</a>

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

								Liquidaciones

							</div>

							<div class="actions">

							
								<?php if($_GET['visor'] == 1){ ?>
                                <a href="?id=<? echo $_GET['id']; ?>" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Vista sin achivos</span>

								</a>
                                <?php }else{ ?>
                                <a href="?id=<? echo $_GET['id']; ?>&visor=1" class="btn default blue-stripe">

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

					   	<form action="credit-view-code.php" name="provisionForm" id="provisionForm" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
									<?php include("stage-main.php");
									include("stage-status.php"); 
									 
									?>
                                    
                                    <h3 class="form-section"><a id="status"></a>Ruta de pago <?php echo $row['route']; if($row['headship2'] > 0) echo " (Jef. ".$row['headship2'].")"; ?>

<? 
                                        
                                        
$queryRouteName = "select * from units where id = '$row[routeid]'";
$resultRouteName = mysqli_query($con, $queryRouteName);
$rowRouteName = mysqli_fetch_array($resultRouteName);
if($row['ncatalog'] == 1){
	echo "$rowRouteName[newCode] | $rowRouteName[companyName] $rowRouteName[lineName] $rowRouteName[locationName]";
}else{
	echo $rowRouteName['code'].' | '.$rowRouteName['name']; if($row['headship2'] > 0) echo " (Jef. ".$row['headship2'].")"; 
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
                  
                                          
                                          
                                                    
                                         <div class="row"></div>
                                          <h3 class="form-section">Crédito 
</h3>
  <div id="ddistribucion0">


                                    
                                 
                                    
                                     <div class="row">
                                     
<?php //no batch ?>
<div class="col-md-3 ">
								  
									  <div class="form-group">
			    <label>No. Batch:</label>
			    											
                                        <input name="nobatch" type="text" class="form-control" id="nobatch" placeholder="" value="">
						
                                                          
              </div>
												</div>
<?php //no documento ?>                                                 
<div class="col-md-3 ">
									  <div class="form-group">
			    <label>No. Documento:</label>
			    											
                                        <input name="nodocument" type="text" class="form-control" id="nodocument" placeholder="" value="">
						
                                                          
              </div>
												</div>
<?php //link documento ?>                                                
<div class="col-md-6 ">
												  <div class="form-group">
			    <label>Link del Documento:</label>
			    											
                                                    <?php /*<input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value="">*/ ?>
                                                    <select name="linkdocument" class="form-control  select2me" id="linkdocument" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

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
	  
	  
	          <? /* <div class="row"></div>
                                          <h3 class="form-section">Pendiente E1 </h3>
							
							<p>Marque la siguiente casilla si el pago se gurdará como Pendiente de Liquidación en E1</p>
							
							  <input name="ple1" type="checkbox" id="ple1" value="1" <?php if($rowpconfirm['ple1'] == 1) echo 'checked'; ?>>  Pendiente de Liquidación en E1

  
                                              
                                                    
 */ ?>
  <div class="row"></div> 



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
			window.location="credit-view-deny.php?id=<?php echo $_GET['id']; ?>&reason="+reason+"&reason2="+reason2; 
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
                        
                            <button type="submit" class="btn blue"><i class="fa fa-check"></i> Liquidar</button> 
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


		varnobatch = document.getElementById('nobatch').value;
		if(varnobatch == ''){
			alert('El campo "no batch" no puede estar en blanco');
			document.getElementById('nobatch').focus();
			return false; 
		}

		varnodocument = document.getElementById('nodocument').value;
		if(varnodocument == ''){
			alert('El campo "no documento" no puede estar en blanco');
			document.getElementById('nodocument').focus();
			return false;
		}

		varlinkdocument = document.getElementById('linkdocument').value;
		if(varlinkdocument == ''){
			alert('El campo "Link del documento" no puede estar en blanco');
			document.getElementById('linkdocument').focus();
			return false;
		}
		
		/*if(!/visor.php/.test(varlinkdocument)){
			alert('Asegurese de que el link sea valido.');
			document.getElementById('linkdocument[]')[i].focus();
			return false;
		}*/
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