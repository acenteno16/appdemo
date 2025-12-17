<?php 

include('session-bankingDebt.php'); 

$id = $_GET['id']; 

$query = "select * from bankingDebt where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result); 


	
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



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:reloadRouteView()"> 

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

					Deuda Bancaria

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

						<a href="bankingDebtAccounting.php">Deuda Bancaria</a>
                        <i class="fa fa-angle-right"></i>
                        </li>

						<li><a href="#">Contabilización</a></li>

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

										<form name="porder" id="porder" action="bankingDebtOrderCode.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();"> 
        

											<div class="form-body">

												<h3 class="form-section">Información General</h3> 
                                                <div class="row">
                                                <!--/span-->

													<div class="col-md-2">

													  <div class="form-group">

												<label class="control-label">ID:</label>
										
											  <input name="theId" type="text" class="form-control" id="theId" value="<?php if($row['id'] > 0 ) echo $row['id']; else echo 'Auto'; ?>" readonly>  
								
															
													  </div>

													</div> 
                                              

												</div>
												
												<h3  class="form-section">Información del desembolso</h3> 


                                                  


                                                  <div class="row">
<div class="col-md-4"> 

<div class="form-group">
<label class="control-label">Tipo de Transacción</label> 
<select name="type" class="form-control" id="type" disabled>
<option value="0" selected>Seleccionar</option>
<option value="1" <? if($row['type'] == 1) echo "selected"; ?>>Cancelación</option>
<option value="2" <? if($row['type'] == 2) echo "selected"; ?>>Abono</option>
<option value="3" <? if($row['type'] == 3) echo "selected"; ?>>Pago de interés</option>
<option value="4" <? if($row['type'] == 4) echo "selected"; ?>>Desembolso</option>
</select> 
                                                            

													  </div>

													</div>
													  
<div class="col-md-4 ">  <div class="form-group">
									 <label>Compañía:</label>
                                     <select name="company" class="form-control" id="company" disabled>
                                      <option value="" selected>Seleccionar</option> 
                                     <?
									 	 
									 $querycompanys = "select * from companies where active = '1'";
									 $resultcompanys = mysqli_query($con, $querycompanys);
									 while($rowcompanys=mysqli_fetch_array($resultcompanys)){   
									 ?>
                                     <option value="<? echo $rowcompanys[0]; ?>" <? if($row['company'] == $rowcompanys['id']) echo "selected"; ?>><? echo $rowcompanys['name']; ?></option>  
                                     <? } ?>
                                     </select>
                                             </div>
                                        
                                        </div>
													                                                  
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Banco:</label>

						
											<select name="bank" class="form-control" id="bank" disabled>

												<option value="">Todos los Bancos</option> 

                                            <? 
											
											$queryfbanks = "select * from banks order by name";
											$resultfbanks = mysqli_query($con, $queryfbanks);
											while($rowfbanks=mysqli_fetch_array($resultfbanks)){
											
											?>
                                            <option value="<? echo $rowfbanks['id']; ?>" <?php if($row['bank'] == $rowfbanks['id']) echo 'selected'; ?>><? echo $rowfbanks['name']; ?></option> 
                                           <? } ?>

											</select>

														
													  </div>

													</div>
		
													  
													  <div class="col-md-4 ">
													  <div class="form-group">
														<label>No. prestamo:</label>
                                                        <input name="number" type="text" class="form-control" id="number" value="<? echo $row['lNumber']; ?>" onkeypress="return justNumbers(event);" readonly>
                                                        
                                                      <!--/row--></div>
													</div>
													  
													  <div class="col-md-4 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $row['amount']; ?>" onkeypress="return justNumbers(event);" readonly>
                                                        

                                                      <!--/row--></div>
													</div>
													  
													  <div class="col-md-4">

													  <div class="form-group">

													  <label class="control-label">Moneda:</label>

						
											<select name="currency" class="form-control" id="currency">

												<option value="2" selected>Dólares</option> 
												<option value="1">Córdobas</option> 
                                           

											</select>

														
													  </div>

													</div>
													  <div class="row"></div> 
													  
													  <div class="col-md-4 ">
													  <div class="form-group">
														<label>Fecha:</label>
                                                        <input name="date1" type="text" class="form-control date-picker" id="date1" value="<? echo $row['date1']; ?>" disabled>
                                                        </div>
													</div>

													                                                                  
</div>


												
														<h3  class="form-section">Documentación</h3> 

      
        
											  <div class="row">
													
												  
												  <div class="col-md-4"> 

<div class="form-group">
<label class="control-label">Tipo de Transacción</label> 
<select name="type" class="form-control" id="type" disabled>
<option value="0" selected>Seleccionar</option>
<option value="2" <? if($rowpconfirm['type'] == 2) echo "selected"; ?>>Abono</option>
<option value="3" <? if($rowpconfirm['type'] == 3) echo "selected"; ?> selected>Pago de interés</option>
<option value="4" <? if($rowpconfirm['type'] == 4) echo "selected"; ?>>Cancelación</option>
</select> 
                                                            

													  </div>

													</div>
												  
												  <div class="row"></div>
												  
									
 <div class="col-md-4 ">
													  <div class="form-group">
														<label>Tabla de amortizacion: (Excel)</label>
                                                        <input name="amount" type="text" class="form-control" id="amount" value="https://getpaycp.com/admin/visor.php?key=ZmlsZT0MTYmdXNlcmlkPTE0MzEzODE" readonly>
														  <a href="#" class="btn blue" target="new">
														<i class="fa fa-file-o"></i> &nbsp;Abrir</a>
                                                        

                                                      <!--/row--></div>
													</div>
												  
											
         
												   <div class="col-md-4 ">
													  <div class="form-group">
														<label>Movimiento bancario:</label>
                                                        <input name="amount" type="text" class="form-control" id="amount" value="https://getpaycp.com/admin/visor.php?key=ZmlsZT0MTYmdXNlcmlkPTE0MzEzODE" readonly>
														  <a href="#" class="btn blue" target="new">
											<i class="fa fa-file-o"></i> &nbsp;Abrir</a>
                                                        

                                                      <!--/row--></div>
													</div>
												  
										
         
												   <div class="col-md-4 ">
													  <div class="form-group">
														<label>Referencia:</label>
                                                        <input name="amount" type="text" class="form-control" value="90876543678" id="amount" readonly>
                                                        

                                                      <!--/row--></div>
													</div>
											
         

 </div>    
												
													<h3  class="form-section">Contabilización</h3> 
 	
        
                       
                                             

<div class="row">
												
												
												   <div class="col-md-4 ">
													  <div class="form-group">
														<label>Batch:</label>
                                                        <input name="batch" type="file" class="form-control" id="batch">
                                                        

                                                      <!--/row--></div>
													</div>
												  
										
         
												   <div class="col-md-4 ">
													  <div class="form-group">
														<label>No Batch:</label>  
                                                        <input name="nobatch" type="text" class="form-control" id="nobatch" >
                                                        

                                                      <!--/row--></div>
													</div>
												</div>



 

                                                       										<!--/row--><!--/row--></div>
                                                                                            
                                                                                            
                                                                                        


											<div class="form-actions right" style=" margin-top:100px;">

												<div style="margin-right: 10px;">
												
												
												<button type="button" class="btn default" onClick="javascript:cancelAction();" style="margin-right: 10px;"><i class="fa fa-undo"></i> Retornar</button>
												
										
										
                                              <? //<button name="draft" id="draft" type="button" class="btn blue" onClick="javascript:saveDraft();"><i class="fa fa-save"></i> Guardar Borrador</button> ?>
                                              <? /*<button type="button" class="btn blue" name="print" id="print" onClick="javascript:printLetter();"><i class="fa fa-print"></i> Imprimir Carta</button>
                                              <button type="button" class="btn blue" name="print" id="print" onClick="javascript:printLetter();"><i class="fa fa-print"></i> Imprimir Carta</button>*/ ?>
													<button type="submit" class="btn red" name="save" id="save"><i class="fa fa-reply"></i> Regresar a Documentacion</button>
													<button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Contabilizar</button>
											  </div>
											    <input name="newbutton" type="hidden" id="newbutton" value="save">
											    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
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

function cancelAction(){ 
	if (confirm("Esta Seguro de cancelar esta documentacion?\n")==true){
			window.location = 'bankingDebt.php';
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



function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}
		
</script>

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

function reloadaccount(selector,val){
	//Transsaction type (Tranferencia, Dolarizacion, Cordobización)
	var type = document.getElementById('transaction').value;
	//Si no se ha seleccionado el tipo,
	if(type == 0){ 
		alert('Debe de seleccionar un tipo de transaccion.');
		document.getElementById("account1").innerHTML = '<select name="clienttype" class="form-control" id="clienttype"><option value="0" selected>Seleccionar Tipo de Transacción</option></select>';
		document.getElementById("account2").innerHTML = '<select name="clienttype" class="form-control" id="clienttype"><option value="0" selected>Seleccionar Cuenta Origen</option></select>';
	}else{
		
		//alert('Type: '+type+' | Selector: '+selector+' | Val: '+val);
		if(selector == 2){
			document.getElementById("account2").innerHTML = '<select name="clienttype" class="form-control" id="clienttype"><option value="0" selected>Seleccionar Cuenta Origen</option></select>';
		}
		
		showTc(type);  
		
		$.post("fn-reloadaccounts.php", { type: type, selector: selector, val: val }, function(data){ 
	 		if(selector == 1){
	 			document.getElementById("account1").innerHTML = data;
				document.getElementById("account2").innerHTML = '<select name="clienttype" class="form-control" id="clienttype"><option value="0" selected>Seleccionar</option></select>';
	 		}
	 		if(selector == 2){
	 			document.getElementById("account2").innerHTML = data;
	 		}
		});
	}
	//reloadsconcept2(0,i);
}

 function showTc(theVal){
											  	//alert(theVal); 
												if((theVal == 2) || (theVal == 3)){
													document.getElementById('thetc').style.display = "block";
												}else{
													document.getElementById('thetc').style.display = "none";
												}
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

<? /*
<script>
(function() {
   //Document.ready equivalent
	reloadRequirements("load");
	<? if($rowpconfirm['client'] != 0){ ?>
	clientType("load");
	benType(<? echo $rowclient['type']; ?>);
	
	<? } ?>
})();
</script>
*/ ?>