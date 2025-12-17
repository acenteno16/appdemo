<?php include("session-treasury.php"); ?>
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

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/select2/select2.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

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

	
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->


			<!-- BEGIN PAGE HEADER-->		



			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Ingreso a Banco <? //<small>Aprobación de programación</small> ?> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						
                        <li>

							<a href="#">Ingreso a Banco</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<? /*<div class="col-md-12">
														<div class="dashboard-stat blue">
															<div class="visual">
																<i class="fa fa-money"></i>
															</div>
															<div class="details">
<?php 

$querybalance = "select * from balance where currency='1' order by id desc limit 1";
$resultbalance = mysqli_query($con, $querybalance);
$rowbalance = mysqli_fetch_array($resultbalance);

?>		
<input type="hidden" id="nioBalance" name="balance" value="<?php echo $rowbalance['balance'] ?>">	
<input type="hidden" id="cbalance" name="cbalance" value="">	
													<div class="number" id="thenumber">
																	 <?php echo 'NIO C$'.number_format($rowbalance['balance'], 2);?>
																</div>
																<div class="desc">
																	 Saldo disponible en córdobas
																</div>
															</div>
															
														</div>
													</div>
				*/ ?>
				
				<? 
				$queryCurrency = "select * from currency";
				$resultCurrency = mysqli_query($con, $queryCurrency);
				while($rowCurrency=mysqli_fetch_array($resultCurrency)){
				?>
                <div class="col-md-12">

					
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<i class="fa fa-sitemap"></i>Pagos programados en <? echo $rowCurrency['name']; ?></div>

							<div class="actions">

                                <? if($_SESSION['admin'] == 'active'){ ?> <a href="javascript:;" onClick="sPayment();" class="btn default blue-stripe" target="_blank">

								<i class="fa fa-group"></i>

								<span class="hidden-480">

								Single Payment</span>

								</a> <? } ?>
								
								<a href="payment-schedule-approve-group.php?currency=<? echo $rowCurrency['id']; ?>" class="btn default blue-stripe" target="_blank">

								<i class="fa fa-group"></i>

								<span class="hidden-480">

								Grupos</span>

								</a>
                                
                                

							

							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								<div class="table-actions-wrapper">

									<span>

									</span>

								

			
								</div>

							<?php 
							
								$query = "select * from schedule where status = '1' and currency = '$rowCurrency[id]' and vo = '1' order by id desc";  
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								if($num > 0){ ?> 	
                         
								   <div class="table-scrollable">
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									
               
                                <th width="2%">

										 GID</th>

									<th width="10%">

								    WID<span style="color: #EEEEEE;">-----------------------</span></th>

									<th width="18%">

										 Usuarios</th>
                                         <th width="10%">

										 Cancelar</th>

									<th width="12%">

										 Monto</th>

									<th width="6%">

									  Solicitudes

									</th>

									<th width="2%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
									 
								while($row=mysqli_fetch_array($result)){
								
								
								
										
								$rowuser = mysqli_fetch_array(mysqli_query($con, "select first from workers where code = '$row[userid2]'"));
								if($row['userid3'] != ""){
									$rowuser3 = mysqli_fetch_array(mysqli_query($con, "select first from workers where code = '$row[userid3]'"));
								}
								$querymain = "select payment from schedulecontent where schedule = '$row[id]'"; 
								  $resultmain = mysqli_query($con, $querymain);
								  $gpayment = 0; 
								  $npayments = 0;
								  $dif = 0;
								  while($rowmain = mysqli_fetch_array($resultmain)){
									  $querypayment = "select id, currency, payment, schedule, company from payments where id = '$rowmain[payment]'";
									  $resultpayment = mysqli_query($con, $querypayment);
									  $rowpayment = mysqli_fetch_array($resultpayment);
									  
									  $querybills1 = "select * from bills where payment = '$rowpayment[id]' limit 1";
							   		  $resultbills1 = mysqli_query($con, $querybills1);
							   		  $rowbills1 = mysqli_fetch_array($resultbills1);
									  
									  if($rowbills1['currency'] != $rowpayment['currency']){
										  
										  $queryscheduletoday = "select * from times where payment = '$paymentid' and stage = '12.00'";
  								   		  $resultscheduletoday = mysqli_query($con, $queryscheduletoday);
  								   		  $rowscheduletoday = mysqli_fetch_array($resultscheduletoday);
  								   		  $scheduletoday = $rowscheduletoday['today'];
										  
										  $querytc = "select tc from tc where today = '$scheduletoday'";
								   		  $resulttc = mysqli_query($con, $querytc);
								   		  $rowtc = mysqli_fetch_array($resulttc); 
								   		  $ntc = $rowtc['tc']; 
										  
										  $querybills2 = "select ammount from bills where payment = '$rowpayment[id]'";
							   		  	  $resultbills2 = mysqli_query($con, $querybills2);
							   		  	  while($rowbills2 = mysqli_fetch_array($resultbills2)){
											  $dif+=$rowbills2['ammount']*$ntc;
										  }
										  
									  }
									
									 
									$gpayment+=$rowpayment['payment'];
									$npayments++;
									$schedule = $rowpayment['schedule'];
									
									$company_id = $rowpayment['company'];
								}
								
								$querycompany = "select * from companies where id = '$company_id'";
								$resultcompany = mysqli_query($con, $querycompany);
								$rowcompany = mysqli_fetch_array($resultcompany);
								$the_company = $rowcompany['name'];
								
								?>
                                <form action="payment-schedule-approve-code.php" id="approve-schedule" name="approveSchedule<? echo $row['id']; ?>" method="get" enctype="multipart/form-data" <? /*onsubmit="return validateForm(<? echo $row['id']; ?>,1);"*/ ?>> 
                                <tr role="row" class="odd">
                                
                                  <td><?php echo $row['id']; ?> <input type="hidden" name="theid" id="theid" value="<?php echo $row['id']; ?>"></td>
                                  <td><?php if($row['code'] == ""){
									  ?>
                                    <input name="wid" type="text" class="form-control" id="wid_<? echo $row['id']; ?>" value="" placeholder="WID" onKeyUp="checkThis<?php echo $row['id']; ?>();">
                                    <?php
								  }else{
									  echo $row['code'];
								  } ?><br>
                                  
                                  <select name="bank" class="form-control" id="bank_<? echo $row['id']; ?>" onChange="checkThis<?php echo $row['id']; ?>();" style="margin-top:1px;">
<option value="0">Banco</option>
<?php $querybanks = "select id, name from banks order by name";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){
?>
<option value="<?php echo $rowbanks['id']; ?>" <?php if($row['thebank2'] == $rowbanks['id']) echo 'selected'; ?>><?php echo $rowbanks['name']; ?></option>
<?php } ?> 
 
</select>
									  <script>
									  function checkThis<?php echo $row['id']; ?>(){
										  var wid = document.getElementById('wid_<?php echo $row['id']; ?>').value;
										  var bank = document.getElementById('bank_<?php echo $row['id']; ?>').value;
										  
										  if((wid != '') && (bank > 0)){
											  document.getElementById('btn_<?php echo $row['id']; ?>').disabled = false;
										  }else{
											  document.getElementById('btn_<?php echo $row['id']; ?>').disabled = true;
										  }
									  }
									  </script>
</td>
									
                                  <td>
                                  <strong>Programado por: </strong>
                                    <?php $rowuser0 = mysqli_fetch_array(mysqli_query($con, "select first from workers where code = '$row[userid]'"));
								   echo $rowuser0['first']; ?>
                                    <br>
                                  <strong>Asigando a:</strong> <? echo $rowuser['first']; ?><br>
								  <? if($row['userid3'] != ""){ ?><strong>Procesado por:</strong> <? echo $rowuser3['first']."<br>"; }
								  ?><strong>Compañía:</strong> <? echo $the_company; ?></td>
									
									<td><?php 
								  
								  
								if($row['schedule'] != "0000-00-00"){
								echo date('d-m-Y',strtotime($row['schedule']));
								}else{
									echo date('d-m-Y',strtotime($schedule));
								}?></td><td><?php 
							  
								switch($row['currency']){
								  case 1:
								  $pre = "NIO C$";
								  $currency = "Córdobas";
								  break;
								  case 2:
								  $pre = "USD U$";
								  $currency = "Dólares";
								  break;
								  case 3:
								  $currency = "Euros";
								  break;
								  case 4:
								  $currency = "Yenes";
								  break;
							  }
							  
							   
								
							   echo $pre.str_replace('.00','',number_format($gpayment,2));
							   if($dif > 0){
								   echo '<br>≠'.str_replace('','',number_format($gpayment-$dif,2));
							   	   echo '<br>='.number_format($dif,2);
							   }
								
							   ?> <br>
                              
                            <input name="tpayment[]" type="hidden" id="tpayment<? echo $row['id']; ?>" value="<?php echo $gpayment; ?>"></td>
                            <td><?php echo $npayments; ?></td>
                            <td>
							<a href="payment-schedule-approve-group-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a> <br><br>
							<button type="submit" class="btn green" id="btn_<? echo $row['id']; ?>" disabled><i class="fa fa-check"></i> Aprobar</button> <? if($npayments == 0){ ?><a href="payment-schedule-approve-group-delete.php?id=<? echo $row['id']; ?>" class="btn btn-xs red btn-editable" target="_blank"><i class="fa fa-trash-o"></i> Eliminar</a><? } ?></td></tr>
									
									</form>
									
									
									
                                <?php } ?>
                                
                                   </tbody>

								</table>
								   </div>
                               <? /* <div class="form-actions right">
                                <p>Total programación: <span id="thenumbersum">C$0.00</span></p>

<input type="hidden" id="currency" name="currency" value="1">
<input type="hidden" id="cbalancefloat" name="cbalancefloat" value="0">

                                                     </div> */ ?>
                                               

                               <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay pagos programados es espera de aprobación.

						</p>

					</div>
                                <?php } ?>
                              

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
                
                
                

			</div>
            	<? } #END CURRENCY ?>
            	
                                                   

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

<!--[if lt IE 9]>

<script src="../assets/global/plugins/respond.min.js"></script>

<script src="../assets/global/plugins/excanvas.min.js"></script> 

<![endif]-->

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

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>


<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/table-managed.js"></script> 

<!-- END PAGE LEVEL SCRIPTS -->

<script>
jQuery(document).ready(function() {    
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
TableManaged.init(); 
});

function calculateBalance(){

	totalpayment=0;
	
	i=0;
for (var obj in document.getElementsByName('theid[]')){
 if (i<document.getElementsByName('theid[]').length){

 if(document.getElementsByName('theid[]')[i].checked == true){
	tpayment =  document.getElementsByName('tpayment[]')[i].value;
	//alert('var: '+tpayment);
	totalpayment += parseFloat(tpayment);
 }

  }
  i++;
}
balance = document.getElementById('balance').value;
newbalance = balance-totalpayment;
document.getElementById('thenumber').innerHTML = 'C$'+commas(newbalance);
document.getElementById('thenumbersum').innerHTML = 'C$'+commas(totalpayment);
document.getElementById('cbalancefloat').value = newbalance;
document.getElementById('cbalance').value = commas(newbalance);
}

function calculateBalance2(){

	totalpayment2=0;
	
	i=0;
for (var obj in document.getElementsByName('theid2[]')){
 if (i<document.getElementsByName('theid2[]').length){

 if(document.getElementsByName('theid2[]')[i].checked == true){
	tpayment2 =  document.getElementsByName('tpayment2[]')[i].value;
	//alert('var: '+tpayment);
	totalpayment2 += parseFloat(tpayment2);
 }

  }
  i++;
}
balance2 = document.getElementById('balance2').value;
newbalance2 = balance2-totalpayment2;
document.getElementById('thenumber2').innerHTML = 'USD$'+commas(newbalance2);
document.getElementById('thenumbersum2').innerHTML = 'USD$'+commas(totalpayment2);
document.getElementById('cbalancefloat2').value = newbalance2;
document.getElementById('cbalance2').value = commas(newbalance2);
}

function validateForm(id,currency){
	
	var wid = document.getElementById('wid'+id); 
	var bank = $('#bank'+id).val();
	var tpayment = parseFloat(document.getElementById('tpayment'+id).value);
	
	var checkBalance = 0;
	if(currency == 1){
		var balance = parseFloat(document.getElementById('nioBalance').value);
		checkBalance = 1;
	}else if(currency == 2){
		var balance = parseFloat(document.getElementById('usdBalance').value);
		checkBalance = 1;
	}
	if(checkBalance == 1){
		if(balance < tpayment){
			alert('No hay fondo disponible para cubrir este pago. '+balance+' < '+tpayment);
			return false;
		}
	}
	if(bank == 0){
		alert('Usted debe de seleccionar un banco.');
		return false;
	}
	
	if((wid.value == "")){
		alert('Usted debe de ingresar el id web para el grupo de cancelacion.');
		wid.focus();
		return false;
	} 	
	
	return false;
}

function commas(unformatedAmmount) {
    
	var floatAmmount = parseFloat(unformatedAmmount);
	var floatAmmount2 = floatAmmount.toFixed(2); 
	
	var parts = floatAmmount2.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
	var parts2 = parts.join(".");
	return parts2;  
}

function deleteGroup(id){ 
	if(confirm('Desea eliminar este grupo?') == true){
		window.location = "payment-schedule-approve-group-delete.php?id="+id;
	}
}

function sPayment(){ 
	var paymentId = prompt("Ingrese el ID de la solicitud de pago.", "");
	if(confirm('Para dar ingreso a banco presione okay.') == true){
		window.location = 'payment-schedule-approve-code.php?paymentId='+paymentId;
	}
}
</script> 

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>