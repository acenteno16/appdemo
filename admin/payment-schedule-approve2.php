<?php include("session-treasury.php"); 

exit(); ?>
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

				<div class="col-md-12">
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
<input type="hidden" id="balance" name="balance" value="<?php echo $rowbalance['balance'] ?>">	
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
                <div class="col-md-12">

					

					<!-- Begin: life time stats -->

					
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<i class="fa fa-sitemap"></i>Lista de pagos programados en Córdobas</div>

							<div class="actions">

								<?php /*<a href="payment-schedule-approve-print-view.php?currency=1" class="btn default blue-stripe" target="_blank">

								<i class="fa fa-print"></i>

								<span class="hidden-480">

								Imprimir </span>

								</a>*/ ?>
                                
                                 <a href="payment-schedule-approve-group.php?currency=1" class="btn default blue-stripe" target="_blank">

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
							
							$query = "select * from schedule where status = '1' and currency = '1' and vo = '1' order by id desc";  
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								if($num > 0){ ?> 	
                               <form action="payment-schedule-approve-code.php" id="approve-schedule" name="approve-schedule" method="post" enctype="multipart/form-data" onsubmit="return validateForm();"> 
								   <div class="table-scrollable">
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="3%" height="24">	<input type="checkbox" class="group-checkable" id="checkall1" onChange="javascript:checkAll1();" /> 
                                
                                  <script>
    function checkAll1(){
	 var checkall = document.getElementById('checkall1');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByClassName('theid1');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	  calculateBalance();
	}
      </script></th>
               
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
                                <?php while($row=mysqli_fetch_array($result)){
								
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
										
								$rowuser = mysqli_fetch_array(mysqli_query($con, "select first from workers where code = '$row[userid2]'"));
								if($row[userid3] != ""){
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
                               
                                <tr role="row" class="odd">
                                  <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" onChange="calculateBalance();" class="theid1">
                                  <input name="id[]" type="hidden" id="id[]" value="0"></td>
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php if($row['code'] == ""){
									  ?>
                                    <input name="wid[]" type="text" class="form-control" id="wid[]" value="" placeholder="WID">
                                    <?php
								  }else{
									  echo $row['code'];
								  } ?><br>
                                  
                                  <select name="bank[]" class="form-control" id="bank[]" style="margin-top:1px;" <?php #if($row['bank'] > 0) echo "disabled"; ?>>
<option value="0">Banco</option>
<?php $querybanks = "select id, name from banks order by name";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){
?>
<option value="<?php echo $rowbanks['id']; ?>" <?php if($row['thebank2'] == $rowbanks['id']) echo 'selected'; ?>><?php echo $rowbanks['name']; ?></option>
<?php } ?> 
 
</select>
</td>
                                  <td>
                                  <strong>Programado por: </strong>
                                    <?php $rowuser0 = mysqli_fetch_array(mysqli_query($con, "select first from workers where code = '$row[userid]'"));
								   echo $rowuser0['first']; ?>
                                    <br>
                                  <strong>Asigando a:</strong> <? echo $rowuser['first']; ?><br>
								  <? if($row['userid3'] != ""){ ?><strong>Procesado por:</strong> <? echo $rowuser3['first']."<br>"; }
								  ?><strong>Compañía:</strong> <? echo $the_company; ?></td><td><?php 
								  
								  
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
                              
                                    <input name="tpayment[]" type="hidden" id="tpayment[]" value="<?php echo $gpayment; ?>"></td>
                            <td><?php 
								echo $npayments;
								?></td>
                            <td><a href="payment-schedule-approve-group-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a>  <? if($npayments == 0){ ?><a href="payment-schedule-approve-group-delete.php?id=<? echo $row['id']; ?>" class="btn btn-xs red btn-editable" target="_blank"><i class="fa fa-trash-o"></i> Eliminar</a><? } ?></td></tr>
                                <?php } ?>
                                
                                   </tbody>

								</table>
								   </div>
                                <div class="form-actions right">
                                <p>Total programación: <span id="thenumbersum">C$0.00</span></p>

<input type="hidden" id="currency" name="currency" value="1">
<input type="hidden" id="cbalancefloat" name="cbalancefloat" value="0">

											    	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Aprobar</button>
                                                    </div>
</form>                                                

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
            
            	<div class="col-md-12">
														<div class="dashboard-stat blue">
															<div class="visual">
																<i class="fa fa-money"></i>
															</div>
															<div class="details">
<?php $querybalance = "select * from balance where currency = '2' order by id desc limit 1";
$resultbalance = mysqli_query($con, $querybalance);
$rowbalance = mysqli_fetch_array($resultbalance);
?>		
<input type="hidden" id="balance2" name="balance2" value="<?php echo $rowbalance['balance'] ?>">	
<input type="hidden" id="cbalance2" name="cbalance2" value="">	
													<div class="number" id="thenumber2">
																	 <?php echo 'USD $'.number_format($rowbalance['balance'], 2);?>
															  </div>
																<div class="desc">
																	 Saldo disponible en dólares
																</div>
														  </div>
															
														</div>
													</div>
                                                    <div class="col-md-12">

					

					<!-- Begin: life time stats -->

					
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<i class="fa fa-sitemap"></i>Lista de pagos programados en Dólares</div>

							<div class="actions">

								<?php /*<a href="payment-schedule-approve-print-view.php?currency=2" class="btn default blue-stripe" target="_blank">

								<i class="fa fa-print"></i>

								<span class="hidden-480">

								Imprimir</span>

								</a>*/ ?>
                                
                                
                                
                                <a href="payment-schedule-approve-group.php?currency=2" class="btn default blue-stripe" target="_blank">

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
						
							$query = "select * from schedule where status = '1' and currency = '2' and vo = '1' order by id desc"; 
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								if($num > 0){ ?> 	
                               <form action="payment-schedule-approve-code.php" id="approve-schedule" name="approve-schedule" method="post" enctype="multipart/form-data" onsubmit="return validateForm2();"> 
								   <div class="table-scrollable">
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="3%">	<input type="checkbox" class="group-checkable" id="checkall2" onChange="javascript:checkAll2();" /> 
                                
                                  <script>
    function checkAll2(){
	 var checkall = document.getElementById('checkall2');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByClassName('theid2');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	  calculateBalance2();
	}
      </script>
</th>
               
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
                                <?php while($row=mysqli_fetch_array($result)){ 
								
								
							
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								$rowuser= mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid2]'"));
								if($row[userid3] != ""){
									$rowuser3 = mysqli_fetch_array(mysqli_query($con, "select first from workers where code = '$row[userid3]'"));
								}
								
								$querymain = "select payment from schedulecontent where schedule = '$row[id]'"; 
								$resultmain = mysqli_query($con, $querymain);
								$gpayment = 0;
								$npayments = 0;
								while($rowmain = mysqli_fetch_array($resultmain)){
									$querypayment = "select * from payments where id = '$rowmain[payment]'";
									$resultpayment = mysqli_query($con, $querypayment);
									$rowpayment = mysqli_fetch_array($resultpayment); 
									
									$gpayment+=$rowpayment['payment'];
									$npayments++;
									$schedule = $rowpayment['schedule'];
									$company_id = $rowpayment['company'];
								}
								
								$querycompany = "select name from companies where id = '$company_id'";
								$resultcompany = mysqli_query($con, $querycompany);
								$rowcompany = mysqli_fetch_array($resultcompany);
								$company_name = $rowcompany['name'];
					
								
								?>
                               
                                <tr role="row" class="odd">
                                  <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid2[]" type="checkbox" id="theid2[]" value="<?php echo $row['id']; ?>" class="theid2"  onChange="calculateBalance2(); ">
                                  <input name="id2[]" type="hidden" id="id2[]" value="0"></td> 
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php if($row['code'] == ""){
									  ?> 
                                  
													  
                                                        <input name="wid2[]" type="text" class="form-control" id="wid2[]" value="" placeholder="WID">
						
              
													
                                  <?php
								  }else{
									  echo $row['code'];
								  } ?><br>

<select name="bank2[]" class="form-control" id="bank2[]" style="margin-top:1px;">
<option value="0">Banco</option>
<?php $querybanks = "select id, name from banks order by name";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){
?>
<option value="<?php echo $rowbanks['id']; ?>" <?php if($row['thebank2'] == $rowbanks['id']) echo 'selected'; ?>><?php echo $rowbanks['name']; ?></option>
<?php } ?>
 
</select>
</td>
                                  <td><strong>Programado por:</strong> 
                                    <?php $rowuser0 = mysqli_fetch_array(mysqli_query($con, "select first from workers where code = '$row[userid]'"));
								   echo $rowuser0['first']; ?>
                                    <br>
                                    <strong>Asignado a:</strong> <?php echo $rowuser['first']; ?><br>
<? if($row['userid3'] != ""){ ?><strong>Procesado por:</strong> <? echo $rowuser3['first']."<br>"; } ?>
							<strong>Compañía:</strong> <? echo $company_name; ?></td><td><?php 
								
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
								
							   ?>                                    <input name="tpayment2[]" type="hidden" id="tpayment2[]" value="<?php echo $gpayment; ?>"></td><td><?php  
								echo $npayments;
								?></td><td><a href="payment-schedule-approve-group-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a> <? if($npayments == 0){ ?><a href="payment-schedule-approve-group-delete.php?id=<? echo $row['id']; ?>" class="btn btn-xs red btn-editable" target="_blank"><i class="fa fa-trash-o"></i> Eliminar</a><? } ?></td></tr>
                                <?php } ?>
                                
                                   </tbody>

								</table>
								   </div>
                                <div class="form-actions right">
                                 <p>Total programación: <span id="thenumbersum2">C$0.00</span></p>

<input type="hidden" id="currency" name="currency" value="2">
<input type="hidden" id="cbalancefloat2" name="cbalancefloat2" value="0">
											    	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Aprobar</button>
                                                    </div>
</form>                                                

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
                
                <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<i class="fa fa-sitemap"></i>Lista de pagos programados en otras monedas</div>

							<div class="actions">

							<?php /*	<a href="payment-schedule-approve-print-view.php?currency=0" class="btn default blue-stripe" target="_blank">

								<i class="fa fa-print"></i>

								<span class="hidden-480">

								Imprimir Aprobación de Programación</span>

								</a>*/ ?>
                                
                                

							

							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								<div class="table-actions-wrapper">

									<span>

									</span>

								

			
								</div>

							<?php $query = "select * from schedule where status = '1' and (currency = '3' or currency = '4') and vo = '1' order by schedule asc";
							//se activa para probar la parte otras monedas cuando no hay pagos en otras monedas
							//$query = "select * from schedule where status = '1' order by schedule asc";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								if($num > 0){ ?> 	
                               <form action="payment-schedule-approve-code.php" id="approve-schedule" name="approve-schedule" method="post" enctype="multipart/form-data" onsubmit="return validateForm3();"> 
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="3%">	<input type="checkbox" class="group-checkable" id="checkall3" onChange="javascript:checkAll3();" /> 
                                
                                  <script>
    function checkAll3(){
	 var checkall = document.getElementById('checkall3');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByClassName('theid3');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
      </script>
</th>
               
                                <th width="2%">

										 GID</th>

									<th width="10%">

										 WID<span style="color: #EEEEEE;">-----------------------</span></th>

									<th width="18%">

										 Usuario</th>
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
                                <?php while($row=mysqli_fetch_array($result)){
								
								if($row[userid3] != ""){
									$rowuser3 = mysqli_fetch_array(mysqli_query($con, "select first from workers where code = '$row[userid3]'"));
								}
								
								
								?>
                               
                                <tr role="row" class="odd">
                                  <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid3[]" type="checkbox" id="theid3[]" value="<?php echo $row['id']; ?>" class="theid3">
                                  <input name="id3[]" type="hidden" id="id3[]" value="0"></td>
                                  <td><?php echo $row['id']; ?></td>
                                 <td><?php if($row['code'] == ""){
									  ?>
                                    <input name="wid3[]" type="text" class="form-control" id="wid3[]" value="" placeholder="WID">
                                  <?php
								  }else{
									  echo $row['code'];
								  } ?><br>

<select name="bank3[]" class="form-control" id="bank3[]" style="margin-top:1px;">
<option value="0">Banco</option>
<?php $querybanks = "select id, name from banks order by name";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){
?>
<option value="<?php echo $rowbanks['id']; ?>" <?php if($row['thebank2'] == $rowbanks['id']) echo 'selected'; ?>><?php echo $rowbanks['name']; ?></option>
<?php } ?>
 
</select>
</td>
                                   <td><p>Programado por: <?php $rowuser0 = mysqli_fetch_array(mysqli_query($con, "select first from workers where code = '$row[userid]'"));
								   echo $rowuser0['first']; ?><br>
                                     Asignado a:
<?php $rowuser= mysqli_fetch_array(mysqli_query($con, "select first from workers where code = '$row[userid2]'"));
								   echo $rowuser['first']; ?><br>
<? if($row['userid3'] != ""){ ?>Procesado por: </p>                                     <? echo $rowuser3['first']; } ?></td>
                                   <td><?php $querymain = "select * from schedulecontent where schedule = '$row[id]'"; 
								$resultmain = mysqli_query($con, $querymain);
								$gpayment = 0;
								$npayments = 0;
								while($rowmain = mysqli_fetch_array($resultmain)){
									$querypayment = "select * from payments where id = '$rowmain[payment]'";
									$resultpayment = mysqli_query($con, $querypayment);
									$rowpayment = mysqli_fetch_array($resultpayment); 
									$gpayment+=$rowpayment['payment'];
									$npayments++;
									$schedule = $rowpayment['schedule'];
								}
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
								
							   ?>
                                  <input name="tpayment3[]" type="hidden" id="tpayment3[]" value="<?php echo $gpayment; ?>"></td><td><?php  
								echo $npayments;
								?></td><td><a href="payment-schedule-group-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a> <? if($npayments == 0){ ?><a href="javascript:deleteGroup(<?php echo $row['id']; ?>);" class="btn btn-xs red btn-editable" target="_blank"><i class="fa fa-trash-o"></i> Eliminar</a><? } ?></td></tr> 
                                <?php } ?>
                                
                                   </tbody>

								</table>
                                <div class="form-actions right">

<input type="hidden" id="currency" name="currency" value="0">
											    	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Aprobar</button>
                                 </div>
</form>                                                

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

function validateForm(){
	cbalance = document.getElementById('cbalancefloat').value;
	if(cbalance < 0){
		alert('No hay fondo disponible para cubrir estos pagos.');
		return false;
	}
	
	/*Ciclo por factura*/
	
    var i = 0;
	var size = document.getElementsByName('wid[]'); 
	var selections = 0;
	for (i = 0; i < size.length; i++) { 
 		var theid = document.getElementsByName('theid[]')[i];
		var wid = document.getElementsByName('wid[]')[i]; 
		if(theid.checked == true){
			var thevalue = theid.value;
		}else {
			var thevalue = 0;
		}
		document.getElementsByName('id[]')[i].value = thevalue;
		
		if((theid.checked == true) && (wid.value == "")){
			alert('Usted debe de ingresar el id web para el grupo de cancelacion.');
			wid.focus();
			return false; 
		} 
		if(theid.checked == true){
			selections++;
		}
	
	}
	if(selections == 0){
		alert('Usted debe de seleccionar al menos un grupo de cancelacion.');
		return false
	}
		
	
/*Fin de ciclo por factura */
	
}

function validateForm2(){
	cbalance2 = document.getElementById('cbalancefloat2').value;
	if(cbalance2 < 0){
		alert('No hay fondo disponible para cubrir estos pagos.');
		return false;
	}

		/*Ciclo por factura*/
	
    var i2 = 0;
	var size2 = document.getElementsByName('theid2[]');
	var selections2 = 0; 
	for (i2 = 0; i2 < size2.length; i2++) { 
 		var theid2 = document.getElementsByName('theid2[]')[i2];
		var wid2 = document.getElementsByName('wid2[]')[i2]; 
		if(theid2.checked == true){
			var thevalue2 = theid2.value;
		}else {
			var thevalue2 = 0;
		}
		
		document.getElementsByName('id2[]')[i2].value = thevalue2;
		if((theid2.checked == true) && (wid2.value == "")){
			alert('Usted debe de ingresar el id web para el grupo de cancelacion.');
			wid2.focus();
			return false; 
		} 
		if(theid2.checked == true){
			selections2++;
		}
	
	}
	
	if(selections2 == 0){
		alert('Usted debe de seleccionar al menos un grupo de cancelacion.');
		return false; 
	}
	
		
	
/*Fin de ciclo por factura */
}


function validateForm3(){
	
	
    var i3 = 0;
	var size3 = document.getElementsByName('wid3[]');
	var selections3 = 0; 
	for (i3 = 0; i3 < size3.length; i3++) { 
 		var theid3 = document.getElementsByName('theid3[]')[i3];
		var wid3 = document.getElementsByName('wid3[]')[i3]; 
		if(theid3.checked == true){
			var thevalue3 = theid3.value;
		}else {
			var thevalue3 = 0;
		}
		document.getElementsByName('id3[]')[i3].value = thevalue3;
		
		if((theid3.checked == true) && (wid3.value == "")){
			alert('Usted debe de ingresar el id web para el grupo de cancelacion.');
			wid3.focus();
			return false; 
		} 
		if(theid3.checked == true){
			selections3++;
		}
	
	}
	if(selections3 == 0){
		alert('Usted debe de seleccionar al menos un grupo de cancelacion.');
		return false; 
	}
	
	
	
/*Fin de ciclo por factura */
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


</script> 

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>