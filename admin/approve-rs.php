<?php include("session-financemanager2.php"); ?>
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

					Firma Liberadora

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Firma Liberadora</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>
                        

							<a href="payment-schedule-approve.php">Grupos de programación</a>

						

						</li>
                         

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

    <div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="note note-regular">
                        <h3>Filtro:</h3>
                        <form action="<? echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
                        <br>
                       
                        <div class="row">
                        
<div class="col-md-3">
													  <div class="form-group">
														<label>GID:</label>
                                                        <input name="gid" type="text" class="form-control" id="gid" value="<? echo $_GET['gid']; ?>">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
												  
												  <div class="col-md-3">
													  <div class="form-group">
														<label>WEB ID:</label>
                                                        <input name="webid" type="text" class="form-control" id="webid" value="<? echo $_GET['webid']; ?>">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>

<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Compañia:</label>

						
											<select name="company" class="form-control  select2me" id="company" data-placeholder="Seleccionar...">

												<option value="">Todas las compañias</option>

                                            <? 
											
											$querycompanies = "select * from companies where active = '1'";
											$resultcompanies = mysqli_query($con, $querycompanies);
											while($rowcompanies=mysqli_fetch_array($resultcompanies)){
											
											?>
                                            <option value="<? echo $rowcompanies['id']; ?>" <?php if($_GET['company'] == $rowcompanies['id']) echo 'selected'; ?>><? echo $rowcompanies['name']; ?></option>
                                           <? } ?>
                                          

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>                                             
                                                    <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Banco:</label>

						
											<select name="bank" class="form-control  select2me" id="bank" data-placeholder="Seleccionar...">

												<option value="">Todos los Bancos</option>

                                            <? 
											
											$querycompanies = "select * from banks order by name";
											$resultcompanies = mysqli_query($con, $querycompanies);
											while($rowcompanies=mysqli_fetch_array($resultcompanies)){
											
											?>
                                            <option value="<? echo $rowcompanies['id']; ?>" <?php if($_GET['bank'] == $rowcompanies['id']) echo 'selected'; ?>><? echo $rowcompanies['name']; ?></option>
                                           <? } ?>
                                          

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
                                                    <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Moneda:</label>

						
											<select name="currency" class="form-control  select2me" id="currency" data-placeholder="Seleccionar...">

												<option value="">Todas las monedas</option>

                                            <? 
											
											$querycompanies = "select * from currency";
											$resultcompanies = mysqli_query($con, $querycompanies);
											while($rowcompanies=mysqli_fetch_array($resultcompanies)){
											
											?>
                                            <option value="<? echo $rowcompanies['id']; ?>" <?php if($_GET['currency'] == $rowcompanies['id']) echo 'selected'; ?>><? echo $rowcompanies['name']; ?></option>
                                           <? } ?>
                                          

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
                                                    <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Proveedor:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value="">Todos los Proveedores</option>
 <?php $queryproviders = "select id, code, name from providers where code > '0' order by name";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <? if($_GET['provider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
                                                                             <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Colaborador:</label>

						
											<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar...">

												<option value="">Todos los Colaboradores</option>
 <?php $queryproviders = "select id, code, first, last from workers order by first,last";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <? if($_GET['worker'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de Solicitud:</label>
                                                        <input name="request" type="text" class="form-control" id="request" value="<? echo $_GET['request']; ?>">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                    

                                                    </div>
                                                    
                                                    <div class="row">

<br><br>
						<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button><input type="button" class="btn blue" style="margin-left:5px;" onClick="goRs();" value="Limpiar Filtro"> 
				<script>
				function goRs(){
					window.location = 'approve-rs.php';
				}
				</script>								
                 </div>                               
  
</div>
</form>

                        </div>

                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						<? 
$gid = $_GET['gid'];								
$webid = $_GET['webid'];
$company = $_GET['company'];
$bank = $_GET['bank'];
$provider = $_GET['provider'];
$worker = $_GET['worker']; 
$request = $_GET['request'];
$currency = $_GET['currency'];

$sql1 = "";
if($webid != ""){
	$sql1 = " and schedule.code like '%$webid%'";
}
$sql2 = "";
if($company != ""){
	$sql2 = " and units.company = '$company'";
}
$sql3 = "";
if($bank != ""){
	$sql3 = " and schedule.bank = '$bank'";
}
$sql4 = "";
if($provider != ""){
	$sql4 = " and payments.provider = '$provider'";
}
$sql5 = "";
if($worker != ""){
	$sql5 = " and payments.collaborator = '$worker'";
}
$sql6 = "";
if($request != ""){
	$sql6 = " and payments.id = '$request'";
}
$sql7 = "";
if($currency != ""){ 
	$sql7 = " and schedule.currency = '$currency'";
}
$sql8 = "";
if($gid != ""){ 
	$sql8 = " and schedule.id = '$gid'";
}
$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8;

$query = "select schedule.* from schedule inner join schedulecontent on schedule.id = schedulecontent.schedule inner join payments on schedulecontent.payment = payments.id inner join units on (payments.route = units.code or payments.route = units.code2) where schedule.status = '3'".$sql." group by schedule.id order by schedule.id desc"; 
$result = mysqli_query($con, $query);
echo $num = mysqli_num_rows($result); 

?> Grupos pendientes de Cancelación
                            </div><div class="actions">

							
                                 <a href="approve-rs-group.php" class="btn default blue-stripe" target="_blank">

								<i class="fa fa-group"></i>

								<span class="hidden-480">

								Ver grupos</span>

								</a>
                                
                                

							

							</div>
                            

						</div>

						

					</div>
                    <div class="portlet-body">			
<?php

if($_SESSION['email'] == "jairovargasg@gmail.com"){
	echo $query;
}
if($num > 0){ ?> 
                                
<?php //echo $query; ?>
<div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<?php /*<th width="2%">
                                    <input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
                                
                                  <script>
    function checkAll(){
	 var checkall = document.getElementById('checkall');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('theid[]');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
      </script>

										 </th>*/ ?>
                                         <th width="2%">GID</th>
                                          <th width="2%">

										WID</th>

									<th width="15%">

										 Usuario</th>

									<th width="5%">Fecha</th>

									<th width="5%">

										 Hora</th>

									<th width="5%">

										 Monto

									</th>
                                    
                                    <th width="1%">

										Banco 

									</th>
                                     <th width="1%">

										 Moneda 

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
								
							  
							
							
									
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$rowuser= mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"> 
                                <?php /*<td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>*/ ?>
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php echo $row['code']; ?></td>
                                  <td><?php echo $rowuser['first']; //." ".$rowuser['last']; ?></td>
                                  <td><?php echo date('d-m-Y',strtotime($row['today'])); ?><br>
                                    
</td><td><?php echo date('h:i:s a', strtotime($row['now2'])); ?></td>
                                
                               <td>
                               
                               <?php 
							   
							    $gpayment = 0;
								
								switch($row['currency']){
								  case 1:
								  $pre = "NIO C$";
								  $currency = "Cordobas";
								  break;
								  case 2:
								  $pre = "USD U$";
								  $currency = "Dolares";
								  break;
								  case 3:
								  $currency = "Euros";
								  break;
								  case 4:
								  $currency = "Yenes";
								  break;
							  }
							  
							   $querymain = "select * from schedulecontent where schedule = '$row[id]'"; 
								$resultmain = mysqli_query($con, $querymain);
								while($rowmain = mysqli_fetch_array($resultmain)){
									$querypayment = "select * from payments where id = '$rowmain[payment]'";
									$resultpayment = mysqli_query($con, $querypayment);
									$rowpayment = mysqli_fetch_array($resultpayment); 
									$gpayment+=$rowpayment['payment'];
								}
								
								echo $pre.str_replace('.00','',number_format($gpayment,2));
								
							   ?>
                               
                               </td>
                               
                                <td><?php 
								$querybank = "select * from banks where id = '$row[bank]'";
								$resultbank = mysqli_query($con, $querybank);
								$rowbank = mysqli_fetch_array($resultbank);
								echo $rowbank['name'];
								?> 
									
							
								
							</td>
                            <td><?php 
								echo $currency;
								?> 
									
							
								
							</td><td><a href="approve-rs-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                            
                            
                            </td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                </div>
                                
                                <br>
                                <div class="note note-regular">
                                GID: ID de grupo.<br>
                                WID: ID web.<br>
                                
                                </div>
                                                    
 <?php } else { 
							
								?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No se encontraron  grupos pendientes de aprobado de programación.

						</p>

					</div>
                                <?php } ?>
                                </div></div></div>
                             
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

</script> 

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>