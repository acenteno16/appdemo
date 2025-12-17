<?php 

include("session-approve-bt.php");  

$id = $_GET['id']; 

$querypconfirm = "select * from letters where id = '$id'";
$resultpconfirm = mysqli_query($con, $querypconfirm);
$rowpconfirm = mysqli_fetch_array($resultpconfirm);

	
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

					Solcitudes <small>Aprobar Solicitudes</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Transferencias Bancarias</a>
                             <i class="fa fa-angle-right"></i>
                             </li>

						<li>

							<a href="#">Aprobar</a>

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

										<form name="porder" id="porder" action="approve-view-letters-code.php" class="horizontal-form" method="get" enctype="multipart/form-data" onsubmit="return validateForm();">
        

											<div class="form-body">
												
												
<h3 class="form-section">Información del Solicitante</h3>
<div class="row"><!--/span-->

           <? include('stage-main-letters.php'); ?>                                                                                 
                                                                                            
                                                                                             
													
													
													<div class="col-md-12">
														<?
//Declarate Vars
$color = "";  
?>
<h3 class="form-section"><a id="status"></a>Estado</h3>
                                           
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="13%">TID</th>

									<th width="18%">Fecha</th>

									<th width="16%">Hora</th>

									<th width="25%">Acción</th>

									<th width="28%">Por Usuario</th>

								  </tr>

								</thead>

								<tbody>
                               	<?php 
							   
							   	$querystatus = "select * from letterstimes where letter = '$_GET[id]' order by id asc";
							   	$resultstatus = mysqli_query($con, $querystatus);
							   	$i=0;
								while($rowstatus=mysqli_fetch_array($resultstatus)){
							   		if($i == 0){
							   			$day1 = $rowstatus['today'];
							   		}
							   		$i++;
							   	?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowstatus['id']; ?></td><td><?php echo date('d-m-Y',strtotime($rowstatus['today'])); ?></td><td><?php echo date('h:i:s a', strtotime($rowstatus['now2'])); ?></td>
                                <td><?php 
								
								
								
								$querystage = "select * from stages where id = '$rowstatus[stage]'";
								$resultstage = mysqli_query($con, $querystage);
								$rowstage = mysqli_fetch_array($resultstage);
								echo '<a href="#">'.$rowstage['content'].$schedule_vo_msg.'</a>';
							
								 ?></td>
                                <td><?php $queryuser = "select * from workers where code = '$rowstatus[userid]'";
								$resultuser = mysqli_query($con, $queryuser);
								$rowuser = mysqli_fetch_array($resultuser);
								echo  $theuser =$rowuser['code']." | ".$rowuser['first']." ".$rowuser['last']; ?></td>
                               
                          </tr>
                          
                          <?php 
						  
						  $thecomment = $rowstatus['comment']; 
						  $thestage = $rowstatus['stage'];
						  $note = $rowstage['note'];
						  $thereason = $rowstatus['reason'];
						  
						  ?>
                                                        
                                <?php }  ?>
                                
                               
                                </tbody>

								</table>
<p>TID: ID de transacción.</p>
													
													
													
													  <h3 class="form-section">Opciones</h3>  
                                         									<div class="row">
 <div class="col-md-4">

													<div class="form-group">

											 				<label class="control-label">Aprobado:</label>

													  <select name="approve[]" class="form-control" id="approve[]" onChange="javascript:divShow(this.value);">
<option value="0">Seleccionar</option>
<option value="1">Si</option>
<option value="2">No</option>

													  </select>
			
           <script>
		   function divShow(approve){
			 
		   	if(approve == 0){
			   document.getElementById("cdiv").style.display = 'none';
			   
		   }
		   	if(approve == 1){
			   document.getElementById("cdiv").style.display = 'none';
			   
		   }
		   if(approve == 2){
			   document.getElementById("cdiv").style.display = 'block';
			   
		   }
}
	
		   </script>								    </div> 

												  </div>   
                          <div class="col-md-12 " style="display:none;" id="cdiv">
													  <div class="form-group">
														<label class="control-label">Razón:</label>

													  <select name="reason2" class="form-control" id="reason2">
<option value="0">Otro</option>
<?php $queryreason = "select * from lettersreason";
$resultreason = mysqli_query($con, $queryreason);
while($rowreason=mysqli_fetch_array($resultreason)){
?>
<option value="<?php echo $rowreason['id']; ?>"><?php echo $rowreason['name']; ?></option>
<?php } ?>

													  </select><br>
<br>
<label>Comentarios:</label>
                                                        <textarea name="reason" rows="2" class="form-control" id="reason" placeholder="Comente por qué no aprueba esta solicitud de pago."></textarea>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                        
                                                      <!--/row--></div>
													</div>                         
                                                    
  <div class="col-md-12 "><div class="form-actions right">

												

						    <button type="button" class="btn blue" onClick="goApprove();"><i class="fa fa-undo"></i> Retornar</button> 
                            <script>
							function goApprove(){
								window.location = "approve.php";  
							}
							</script>
                             <button type="submit" class="btn blue"><i class="fa fa-check"></i> Guardar</button>   
							 <input name="id[]" type="hidden" id="id[]" value="<?php echo $_GET['id']; ?>">    
                             
											</div>
                                            </div>                                                   </div>
														
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


function reloadsconcept(nid,i){		
	$.post("reload-sconcepts.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept_"+i).innerHTML = data;
	});
	reloadsconcept2(0,i);
}

function reloadsconcept2(nid,i){		
	$.post("reload-sconcepts2.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept2_"+i).innerHTML = data;
	});
	
}

function help1(){
	alert('Si el monto no coinside con la cantidad en letras utilize esta opción.');
}

function cancelAction(){
	if (confirm("Esta Seguro de cancelar este ingreso?\n")==true){
			window.location = 'letters.php';
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

function clear1(){
	document.getElementById("retention1").value = ""; 
}

function clear2(){
	document.getElementById("retention2").value = "";
}

function deleteRow(id){
	//document.getElementById("roc"+id).style.display = 'none';
	var node = document.getElementById("roc"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}

function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}

function printLetter(){

	var clienttype = document.getElementById("clienttype").value;
	
	var description = document.getElementById("description").value;
	var totalbill = document.getElementById("totalbill").value;
	
	var i = 0;
	var devtype = 0;
	var radios_devtype = document.getElementsByName('devtype');

	for(i=0;i<radios_devtype.length;i++){
 		if (radios_devtype[i].checked){
  			devtype = radios_devtype[i].value;
  			break;
 		}
	}

	var currency = 0;
	var radios_currency = document.getElementsByName('currency');

	for(i=0;i<radios_currency.length;i++){
 		if (radios_currency[i].checked){
  			currency = radios_currency[i].value;
  			break;
 		}
	}


	var strdocuments = "";
	var currenttype = "";
	var currentnumber = "";
	var currenttoday = "";
	var currentamount = "";
	var currentcurrency = "";
	
	var types = "";
	var numbers = "";
	var todays = "";
	var amounts = "";
	var currencys = "";
	
	var rocnumber =  document.getElementsByName('rocnumber[]');

	for(i=0;i<rocnumber.length; i++) { 
		//Reading Values
		currenttype =  document.getElementsByName('roctype[]')[i].value;
		currentnumber = document.getElementsByName('rocnumber[]')[i].value;
		currenttoday = document.getElementsByName('roctoday[]')[i].value;
		currentamount = document.getElementsByName('rocamount[]')[i].value;
		currentcurrency = document.getElementsByName('roccurrency[]')[i].value;
		//Making the vars
		types = types+currenttype+"|||";
		numbers = numbers+currentnumber+"|||";
		todays = todays+currenttoday+"|||";
		amounts= amounts+currentamount+"|||";
		currencys= currencys+currentcurrency+"|||";	
	} 
	 
	strdocuments = "&roctype="+encodeURIComponent(types)+"&rocnumber="+encodeURIComponent(numbers)+"&roctoday="+encodeURIComponent(todays)+"&rocamount="+encodeURIComponent(amounts)+"&roccurrency="+encodeURIComponent(currencys); 
	var theroute = document.getElementById("theroute").value;

	if(clienttype == 1){
		//Si es persona natural
		var ccode = document.getElementById("ccode").value;
		var cfirst = document.getElementById("cfirst").value;
		var clast = document.getElementById("clast").value;
		var caddress = document.getElementById("caddress").value;
		var cnid = document.getElementById("cnid").value;
		var ccity = document.getElementById("ccity").value;
		var cemail = document.getElementById("cemail").value;
		var cphone = document.getElementById("cphone").value; 
		
		window.location = "payment-order-refund-pdf.php?clienttype="+encodeURIComponent(clienttype)+"&ccode="+encodeURIComponent(ccode)+"&cfirst="+encodeURIComponent(cfirst)+"&clast="+encodeURIComponent(clast)+"&caddress="+encodeURIComponent(caddress)+"&cnid="+encodeURIComponent(cnid)+"&ccity="+encodeURIComponent(ccity)+"&cemail="+encodeURIComponent(cemail)+"&cphone="+encodeURIComponent(cphone)+"&devtype="+encodeURIComponent(devtype)+"&description="+encodeURIComponent(description)+"&totalbill="+encodeURIComponent(totalbill)+"&currency="+encodeURIComponent(currency)+"&theroute="+encodeURIComponent(theroute)+strdocuments; 
	}
	if(clienttype == 2){
		//Si es persona juridica
		var ccode2 = document.getElementById("ccode2").value;
		var cname = document.getElementById("cname").value;
		var cruc = document.getElementById("cruc").value;
		var cemail2 = document.getElementById("cemail2").value;
		var cphone2 = document.getElementById("cphone2").value;
		var caddress2 = document.getElementById("caddress2").value;
		var ccity2 = document.getElementById("ccity2").value;
		var crfirst = document.getElementById("crfirst").value;
		var crlast = document.getElementById("crlast").value;
		var crnid = document.getElementById("crnid").value;
		var cremail = document.getElementById("cremail").value;
		var crphone = document.getElementById("crphone").value;
		
		window.location = "payment-order-refund-pdf-enterprise.php?clienttype="+encodeURIComponent(clienttype)+"&ccode2="+encodeURIComponent(ccode2)+"&cname="+encodeURIComponent(cname)+"&cruc="+encodeURIComponent(cruc)+"&cemail2="+encodeURIComponent(cemail2)+"&cphone2="+encodeURIComponent(cphone2)+"&caddress2="+encodeURIComponent(caddress2)+"&ccity2="+encodeURIComponent(ccity2)+"&crfirst="+encodeURIComponent(crfirst)+"&crlast="+encodeURIComponent(crlast)+"&crnid="+encodeURIComponent(crnid)+"&cremail="+encodeURIComponent(cremail)+"&crphone="+encodeURIComponent(crphone)+"&devtype="+encodeURIComponent(devtype)+"&description="+encodeURIComponent(description)+"&totalbill="+encodeURIComponent(totalbill)+"&currency="+encodeURIComponent(currency)+"&theroute="+encodeURIComponent(theroute)+strdocuments;  
	}

	
	
//End of function printLetter() 
}



var roci = <?php if($roci > 0){ echo $roci; } else{ echo '1'; } ?>;
function addroc(){
	
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

   var rocboxadd = '<div class="row" id="roc'+roci+'"><div class="col-md-2 "><div class="form-group"><select name="roctype[]" class="form-control" id="roctype[]"><option value="0" selected>Seleccionar</option><option value="1">ROC</option><option value="2">Factura</option> </select> </div></div><div class="col-md-2 "><div class="form-group"><input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="" onKeyUp="javascript:calculateTheTotal();" '+readOnly1+'></div></div><div class="col-md-2 "><div class="form-group"><input name="roctoday[]" type="text" class="form-control date-picker" id="roctoday[]" value=""  onKeyUp="javascript:calculateTheTotal();" readonly></div></div><div class="col-md-2 "><div class="form-group"><input name="rocamount[]" type="text" class="form-control" id="rocamount[]" value=""  onKeyUp="javascript:calculateTheTotal();" onkeypress="return justNumbers(event);" '+readOnly1+'></div></div><div class="col-md-2 "><div class="form-group"><select name="roccurrency[]" class="form-control" id="roccurrency[]"><option value="0" selected>Seleccionar</option><option value="1">Córdobas</option><option value="2">Dólares</option> </select></div></div><div class="col-md-1 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+roci+');">-</button></div></div><input type="hidden" name="did[]" id="did[]" value="0"></div>'; 
     roci++; 
	 $("#rocwaiter").append(rocboxadd);  
	 
	 Metronic.init(); 
	 ComponentsPickers.init();
	 //init metronic core components
	
  
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