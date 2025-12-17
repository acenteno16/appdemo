<?php 

include("session-bankingDebtAdmin.php");
require('functions.php');

$id = isset($_GET['id']) ? sanitizeInput(intval($_GET['id']), $con) : 0;

$query = "select * from bankingDebtContracts where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

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

						<a href="bankingDebt.php">Deuda Bancaria</a>
                        <i class="fa fa-angle-right"></i>
                        </li>

						<li><a href="bankingDebtContracts.php">Contratos</a>
						<i class="fa fa-angle-right"></i></li>
						
						<li><a href="#">Visor</a></li>

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">
                    
                    <div class="portlet">
                    
                    <div class="portlet-title">

							<div class="caption">

								Información del Contrato
							</div>

							<div class="actions">
							
							
								<a href="bankingDebtContractEdit.php?id=<? echo $id; ?>" class="btn default blue-stripe">
								<i class="fa fa-edit"></i>
								<span class="hidden-480">
								Editar</span> 
								</a>
								
								

							</div>

						</div>
                    
                    </div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">

						

					

							

							<div class="tab-pane" id="tab_1">

						

									

							

									

											<div class="form-body">
                                                
                                                
												
												

											
												

                                                  <div class="row">
													 
													  <div class="col-md-3"> 

<div class="form-group">
<label class="control-label">Tipo</label> 

<?
	
if($row['type'] == 1){
	$type = 'Linea de crédito revolvente';
}
if($row['type'] == 2){
	$type = 'Linea de crédito a largo plazo';
}
if($row['type'] == 3){
	$type = 'Carta de crédito';
}
if($row['type'] == 4){
	$type = 'Mixto';
}
	
?>
	 <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $type; ?>" readonly>

                                                            

													  </div>

													</div>
													  
												<? /*	  <div class="col-md-3 ">  <div class="form-group">
									 <label>Nuevo:</label>
														  <? 
														  $isNew = 'Si';
														  if($row['isNew'] == 1){
															  $isNew = 'No';
														  }
														  ?>
                                    
	 <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $isNew; ?>" readonly>
                                             </div>
                                        
                                        </div> */ ?>
													  
													    <div class="col-md-9">  <div class="form-group">
									 <label>Titulo:</label>
														
                                    
	 <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $row['title']; ?>" readonly>
                                             </div>
                                        
                                        </div>
													  
													  <div class="row"></div>
	
													  <div id="general">
													  <? #Compañia ?>
													  <div class="col-md-3 ">  <div class="form-group">
									 <label>Compañía:</label>
														  <?
									 	 
									 $querycompanys = "select * from companies where id = '$row[company]'";
									 $resultcompanys = mysqli_query($con, $querycompanys);
									 $rowcompanys=mysqli_fetch_array($resultcompanys);
									 ?>
                                   <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $rowcompanys['name']; ?>" readonly>
                                             </div>
                                        
                                        </div>
													  <? #Banco ?>													                                                  
													  <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Banco:</label>
 <? 
											
											$queryfbanks = "select * from banks where id = '$row[bank]'";
											$resultfbanks = mysqli_query($con, $queryfbanks);
											$rowfbanks=mysqli_fetch_array($resultfbanks);
														  
														  			 if ( $row[ 'currency' ] == 1 ) {
       $thisCurrency = 'Córdobas';
						 $pre = 'C$';
      } elseif ( $row[ 'currency' ] == 2 ) {
        $thisCurrency = 'Dólares';
						 $pre = 'U$';
      }
											
											?>
						 <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $rowfbanks['name']; ?>" readonly>
											

														
													  </div>

													</div>
													  <? #Monto ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="amount" typse="text" class="form-control" id="amount" value="<? echo $pre.str_replace('.00','',number_format($row['amount'],2)); ?>" readonly>
                                                        

                                                      <!--/row--></div>
													</div>
													  <? #Moneda ?>
													  <div class="col-md-3">

													  <div class="form-group">

													  <label class="control-label">Moneda:</label>

						
											<input name="amount" typse="text" class="form-control" id="amount" value="<? echo $thisCurrency; ?>" readonly >

														
													  </div>

													</div>
													  <? #Fecha de apertura ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de apertura:</label>
                                                        <input name="date1" type="text" class="form-control " id="date1" value="<? echo date("d-m-Y", strtotime($row['date1'])); ?>" readonly >
                                                        </div>
													</div>
													  <? #Fecha proximo pagp/Finalizacion ?>
													  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de Finalizacion:</label>
                                                        <input name="date2" type="text" class="form-control " id="date2" value="<? echo date("d-m-Y", strtotime($row['date2'])); ?>" readonly >
                                                        </div>
													</div>
													  <? #Numero de prestamo ?>
													  <? /*<div class="col-md-3 ">
													  <div class="form-group">
														<label>No. Prestamo/Crédito:</label>
                                                        <input name="number" type="text" class="form-control" id="number" value="<? echo $row['number']; ?>" readonly>
                                                        
                                                      <!--/row--></div>
													</div>*/ ?>
														  
														<div class="row"></div><br>
													    <? #Factura ?>
													    <div class="col-md-3 ">
													  <div class="form-group">
														  <label>PDF contrato:</label>
														  
														  <div class="input-group" >
															  <input type="text" id="billUrl" name="billUrl" class="form-control" value="<? echo activeDomain($row['contract']); ?>" readonly>
															  <span class="input-group-addon">
																  <a href="<? echo activeDomain($row['contract']); ?>" target="_blank"><i class="fa fa-search"></i></a> 
															  </span>
														  </div>
														 
														 
														  
													  </div>
												  </div>
												
														  
													  </div>
													  
													  
												</div>
											</div>
                                                                                            
                                                                                            
                                                                                        


										

								<div class="form-body">
												
												

											
												<h3  class="form-section">Información de Desembolsos</h3> 


                                              <p>Los desembolsos con fondo rojo, son desembolsos anulados.</p>
								
								
								<? 
										$queryDetail = "select bankingDebt.* from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where bankingDebt.contract = '$row[id]'";
										$resultDetail = mysqli_query($con, $queryDetail);
										$numDetail = mysqli_num_rows($resultDetail);
										if($numDetail > 0){ 
										?>
										<table class="table table-striped table-bordered table-hover" id="datatable_orders" style=" width: 100%">
										<thead>
										<tr role="row" class="heading">
										<th>DID</th>
                                            <th>Number</th>
										<th>Fecha</th><th>Hora</th><th>Monto</th><th>Balance</th>
										</tr></thead>	
										<? while($rowDetail=mysqli_fetch_array($resultDetail)){ ?>	
										<tr class="<? if($rowDetail['status2'] == 9) echo 'danger'; ?>">
											<td><? echo $rowDetail['id']; ?></td>
                                            <td><? echo $rowDetail['number']; ?></td>
											<td><? echo date("d-m-Y", strtotime($rowDetail['today'])); ?></td>
											<td><? echo $rowDetail['totime']; ?></td>
											<td><? echo $pre.str_replace('.00','',number_format($rowDetail['amount'],2)); ?></td>
											<td><? echo $pre.str_replace('.00','',number_format($rowDetail['balance'],2)); ?></td>
										</tr>
										<? } ?>
										</table>
										
										<? }else{ echo 'No se encontraron desembolsos.'; } ?>
													  
													  
								

								

							</div>
                                
                                <div class="form-body">
												
												

											
												<h3  class="form-section">Balance de contrato</h3> 


                                              
								
								
								<? 
										$queryBalance = "select * from bankingDebtContractBalance where bankingDebtContract = '$id'";
                                        $resultBalance = mysqli_query($con, $queryBalance);
                                        $numBalance = mysqli_num_rows($resultBalance);
										if($numBalance > 0){ 
                                            
										?>
										<table class="table table-striped table-bordered table-hover" id="datatable_orders" style=" width: 800px">
										<thead>
										    <tr role="row" class="heading">
										    <th width="30px">MID</th>
                                            <th width="30px">TID</th>
                                            <th width="30px">Desembolso</th>
										    <th width="100px">Fecha</th>
                                            <th width="100px">Hora</th>
                                            <th width="50px">Tipo</th>
                                            <th width="100px">Monto</th><th>Balance</th>
										</tr></thead>	
										<? while($rowBalance=mysqli_fetch_array($resultBalance)){ 
                                            
                                            $queryBalanceTransaction = "select bankingDebtTransactions.id, bankingDebt.number from bankingDebtTransactions inner join bankingDebt on bankingDebtTransactions.bankingDebt = bankingDebt.id where bankingDebtTransactions.id = '$rowBalance[transaction]'";
                                            $resultBalanceTransaction = mysqli_query($con, $queryBalanceTransaction);
                                            $rowBalanceTransaction = mysqli_fetch_array($resultBalanceTransaction);
                                            
                                            if($rowBalance['type'] == 0){
                                               $ttype = 'NC'; 
                                                $sy = '';
                                            }else{
                                               $ttype = 'ND'; 
                                                $sy = '-';
                                            } 
                                            
                                            ?>	
										<tr class="<? if($rowBalance['type'] == 0) echo 'success'; else echo ''; ?>">
											<td><? echo $rowBalance['id']; ?></td>
                                            <td><? if($rowBalanceTransaction['id'] > 0) echo $rowBalanceTransaction['id']; else echo 'NA'; ?></td>
                                            <td><? if($rowBalanceTransaction['number'] != '') echo $rowBalanceTransaction['number']; else echo 'NA'; ?></td>
											<td><? echo date("d-m-Y", strtotime($rowBalance['today'])); ?></td>
											<td><? echo date("h:i A", strtotime($rowBalance['totime'])); ?></td>
                                            <td><? echo $ttype; ?></td>
											<td><? echo $pre.$sy.str_replace('-','',str_replace('.00','',number_format($rowBalance['amount'],2))); ?></td>
											<td><? echo $pre.str_replace('.00','',number_format($rowBalance['balance'],2)); ?></td>
										</tr>
										<? } ?>
										</table>
										
										<? }else{ echo 'No se encontraron registros.'; } ?>
													  
													  
								

								

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
	
			window.location = 'bankingDebtContracts.php';
		
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
}
 
		
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>




