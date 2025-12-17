<?php 

include("session-provision.php"); 
include('configuration.php'); 
if($rowConfig['cic'] == 0){
	header('location: dashboard.php');
	exit();
}

$id = intval($_GET['id']);

$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$themainroute = $row['route'];

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

					Provision CIC <small> E1</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="provisionE1.php">Provision CIC [E1]</a>
                            
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

								<i class="fa fa-search"></i>

								<span class="hidden-480">

								Vista sin achivos</span>

								</a>
                                <?php }else{ ?>
                                <a href="" class="btn default blue-stripe">

								<i class="fa fa-times"></i>

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

					   	<form action="provisionCICViewCode.php" name="provisionForm" id="provisionForm" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();"> 
									<?php 
									include("stage-main.php");
									include("stage-status.php"); 
									include("stage-provision.php"); 
									?>
                                    
                                    <h3 class="form-section"><a id="status"></a>Ruta de pago <?php echo $row['route']; if($row['headship2'] > 0) echo " (Jef. ".$row['headship2'].")"; ?>

<? 
										
$thisCompany = array();
$querycompany = "select id, name from companies";
$resultcompany = mysqli_query($con, $querycompany);
while($rowcompany = mysqli_fetch_array($resultcompany)){
	$thisCompany[$rowcompany['id']] = $rowcompany['name']; 
}
			
$queryUnit = "select * from units where code = '$row[route]' or code2 = '$row[route]'";
$resultUnit = mysqli_query($con, $queryUnit);
$rowUnit = mysqli_fetch_array($resultUnit);

echo $rowUnit['name'].' - '.$thisCompany[$rowUnit['company']];

?>
</h3>
							
							<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										Código</th>
                                        
                                        <th width="12%">

										Usuario</th>

									
                                    <th width="8%">

										 Email</th>
                                         
                                         <th width="5%">

										 Roll</th>

									
									
								
                                  

								  </tr>

								</thead>

								<tbody> 
                        
                        <?php 
						
						if($row['headship2'] > 0){
						
						$queryroute = "select * from routes where type > 1 and unit = '$row[route]' and headship = '$row[headship2]' order by type asc";
						$resultroute = mysqli_query($con, $queryroute);
						while($rowroute = mysqli_fetch_array($resultroute)){
							$queryroute2 = "select * from workers where code = '$rowroute[worker]'";
							$resultroute2 = mysqli_query($con, $queryroute2);
							$rowroute2 = mysqli_fetch_array($resultroute2);
							
							?>
                            
                            <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowroute2['code']; ?></td>
							<td><?php echo $rowroute2['first']." ".$rowroute2['last']; ?></td>
                            <td><?php echo $rowroute2['email']; ?></td>
                            <td><?php $querytype  = "select * from usertype where id = '$rowroute[type]'";
							$resulttype = mysqli_query($con, $querytype);
							$rowtype = mysqli_fetch_array($resulttype);
							echo $rowtype['name'];
							 ?></td> 
                               
                          </tr>
                          <?php }  } ?>
                          
                            <?php 
							
							$queryroute = "select * from routes where type > '1' and type < '23' and unit = '$row[route]' and headship = '0' order by type asc";
							
							$resultroute = mysqli_query($con, $queryroute);
							while($rowroute = mysqli_fetch_array($resultroute)){
							$queryroute2 = "select * from workers where code = '$rowroute[worker]'";
							$resultroute2 = mysqli_query($con, $queryroute2);
							$rowroute2 = mysqli_fetch_array($resultroute2);
							
							?>
                            
                            <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowroute2['code']; ?> <? //echo $rowroute['type']; ?></td>
							<td><?php echo $rowroute2['first']." ".$rowroute2['last']; ?></td>
                            <td><?php echo $rowroute2['email']; ?></td>
                            <td><?php $querytype  = "select * from usertype where id = '$rowroute[type]'";
							$resulttype = mysqli_query($con, $querytype);
							$rowtype = mysqli_fetch_array($resulttype);
							echo $rowtype['name'];
							 ?></td> 
                               
                          </tr>
                          <?php }  ?>
                                
                               
                                </tbody>

								</table>
							
                                    <input name="currency2pay" type="hidden" id="currency2pay" value="<?php 
									echo $pcurrency2pay;
									?>">
                                    <input name="currency2pay" type="hidden" id="currency2pay" value="<?php 
									echo $pcurrency2pay;
									?>">
                                     <input type="hidden" name="nochange" id="nochange" value="0" > 
                                    
                                    
                                        <div class="row"></div>
                                     

 <input type="hidden" name="mytotalstotal" id="mytotalstotal" value="<?php echo $mytotalstotal; ?>">
                                          <input type="hidden" name="myniostotal" id="myniostotal" value="<?php echo $myniototalstotal?>">
                                          <input type="hidden" name="mybillcurrency" id="mybillcurrency" value="<?php echo $mybillcurrency; ?>">
                                          <input type="hidden" name="billcurrency2" id="billcurrency2" value="<?php echo $myfloatcurrency2; ?>"> 
                                          
                                          
                                                    
                                         <div class="row"></div>
                                          <h3 class="form-section">Provisión CIC
</h3>
  <div id="ddistribucion0">

                                    
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
                                                   
	  
	  
	    <div class="row"> 
	  
	  <div class="col-md-3 ">
 <button type="button" class="btn blue" onClick="addBatch();">+</button>&nbsp;<button type="button" class="btn blue" onClick="openFiles();"><i class="fa fa-search"></i> Ver archivos</button>
 <script>
 function openFiles(){
	 window.open('files.php');
 }
 </script>
 <br><br>&nbsp;</div></div>
 
  <div class="row"></div> 
  <div class="row">
                                      
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

											<!--/row--><!--/row--></div>
							
							
							<div class="row">
                                                      
                                                    
  <div class="col-md-12 "><div class="form-actions right">

												
    <p>
                            
                            </p>
						   <? /* <button type="button" class="btn red" onClick="denyPayment();"><i class="fa fa-times"></i> Rechazar Pago</button> 
                          
                              
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
			window.location="provision-view-deny.php?id=<?php echo $_GET['id']; ?>&reason="+reason+"&reason2="+reason2+'&covid=1'; 
		}else{
			document.getElementById('cdiv').style.display = "none";
		}
				}
			}else{
				alert('Para rechazar esta solicitud, usted debera de llenar la información de rechzo.');
				document.getElementById('cdiv').style.display = "block";
			}
		
			}
			
			</script> */ ?>
                        
                            <button type="submit" class="btn blue"><i class="fa fa-check"></i> Provisionar</button> 
												<input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>">
                                                <input name="distributiontype" type="hidden" id="distributiontype" value="0">
  </div>
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
		
		isPending = document.getElementsById('ppe1').value;
		if(isPending == 1){
			
		}else{
			
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