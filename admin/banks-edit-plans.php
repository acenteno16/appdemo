<?php 
exit(); 

/*
include("session-admin.php");

$id = $_GET['id'];

$query = "select * from banks where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result); 

$thisBank = array();
$queryThisBank = "select * from banks";
$resultThisBank = mysqli_query($con, $queryThisBank);
while($rowThisBank = mysqli_fetch_array($resultThisBank)){
	
	$thisBank[$rowThisBank['id']] = $rowThisBank['name'];
	
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

			<!-- BEGIN STYLE CUSTOMIZER -->

			

			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Bancos <small>Editor de Bancos</small></h3>

					<ul class="page-breadcrumb breadcrumb">

						

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="banks.php">Bancos</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>Editor de Bancos

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

											<?php //Form Sample ?>

										</div>

										

									</div>

									<div class="portlet-body form">

						 				<!-- BEGIN FORM-->

										<form action="banks-edit-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 

											<div class="form-body">

												<h3 class="form-section">Informacion General</h3>

												<div class="row">

													<div class="col-md-2">

													  <div class="form-group">

															<label class="control-label">ID:</label> 

														  <input name="id2" type="text" disabled class="form-control" id="firstName" value="<?php echo $row['id']; ?>" readonly>

	

														</div>

													</div>

													<!--/span-->

													<div class="col-md-5">

													  <div class="form-group">

	<label class="control-label">Nombre:</label>
	<input name="name" type="text" class="form-control" id="name" placeholder="Ej: Casa Pellas S.A." value="<?php echo $row['name']; ?>">
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
														      </div>
													    </div>
													  </div>

													</div>

												<div class="col-md-5">
													  <div class="form-group">
														<label>Archivo:</label>
                                                  <input name="file1" type="file" class="form-control" id="file1" value="">
                                                   <br>
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
													
													<div class="col-md-5">
													  <div class="form-group">
														<label>Imágen:</label><br>
														 <img src="banks/<? echo $row['id']; ?>.jpg" width="250"> 
                                                   <br>
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
													<!--/span-->

												</div>
												
												<h3 class="form-section">Informacion de Cuentas</h3>
												
												<? 
												$query_accounts = "select * from banksaccounts where bank = '$id'";
												$result_accounts = mysqli_query($con, $query_accounts);
												$numc = 0;
												while($row_accounts=mysqli_fetch_array($result_accounts)){
												$numc++;
												
												$query_company = "select * from companies where id = '$row_accounts[company]'";
												$result_company = mysqli_query($con, $query_company);
												$row_company = mysqli_fetch_array($result_company);
												$company = $row_company['name'];
												
												$query_currency = "select * from currency where id = '$row_accounts[currency]'";
												$result_currency = mysqli_query($con, $query_currency);
												$row_currency = mysqli_fetch_array($result_currency);
												$currency = $row_currency['name'];
								
												
												if($row_accounts['plan'] == ''){
													$thisPlan = '-';
												}else{
													$thisPlan = $row_accounts['plan'];
												}
												?>
												<div id="contact_<? echo $numc; ?>">
												
												<input type="hidden" name="aid[]" value="<? echo $row_accounts['id']; ?>">
											    
											    <div class="col-md-3">
											    <div class="form-group">
												    <label>Compañía:</label>
												    <input name="xaccount[]" type="text" class="form-control" id="account" value="<? echo $company; ?>" disabled>
												</div></div>
											    <div class="col-md-3">
											    <div class="form-group">
												    <label>Cuenta según LM:</label>
												    <input name="xaccount[]" type="text" class="form-control" id="account" value="<? echo $row_accounts['account']; ?>" disabled>
												</div></div>
											    <div class="col-md-3">
											    <div class="form-group">
												    <label>Cuenta según Banco:</label>
												    <input name="xaccount2[]" type="text" class="form-control" id="account" value="<? echo $row_accounts['account2']; ?>" disabled>
												</div></div>
											    <div class="col-md-3">
											    <div class="form-group">
												    <label>Nombre:</label>
												    <input name="xaname[]" type="text" class="form-control" id="account" value="<? echo $row_accounts['aname']; ?>" disabled>
												</div></div>
												<div class="col-md-3">
											    <div class="form-group">
												    <label>Moneda:</label>
												    <input name="xaccount[]" type="text" class="form-control" id="account" value="<? echo $currency; ?>" disabled>
												</div></div>   
													<div class="col-md-3">
											    <div class="form-group">
												    <label>Plan:</label>
												    <input name="plan[]" type="text" class="form-control" id="plan" value="<? echo $thisPlan; ?>" disabled>
												</div></div>
													<div class="col-md-3">
											    <div class="form-group">
												    <label>Options:</label>
												   <br><i class="fa fa-edit" style="color:deepskyblue;"> Editar  </i>   &nbsp; &nbsp; &nbsp;<a href="banksEditAccountsDelete.php?id=<? echo $row_accounts['id']; ?>"><i class="fa fa-trash-o" style="color: firebrick;">Eliminar</i></a>
												</div></div>
												    
												   
												    <? /*<div class="col-md-2"><div class="form-group"><label class="control-label">Opciones:</label><button type="button" class="btn red icn-only" onclick="deleteContact('<? echo $numc; ?>');"><i class="fa fa-trash-o"></i>Eliminar</button></div></div>
												    */ /*?>
												<div class="row"></div><hr></div>
												<? } ?> 
												<div id="contacts"></div>
												<div class="row"></div> 
												<a href="javascript:addRow2();">[+ Agregar Cuenta]</a>
												<script>
												var ccontact = parseInt(<? echo $numc+1; ?>);
													function addRow2(){
														var str_row2 = '<input type="hidden" name="aid[]" value="0"><div class="col-md-4"><div class="form-group"><label>Compañía:</label><select name="company[]" class="form-control" id="company[]"><option value="0" selected>Seleccionar</option><? 
$query_banks = "select * from companies order by name";
$result_banks = mysqli_query($con, $query_banks);
while($row_banks=mysqli_fetch_array($result_banks)){
?><option value="<? echo $row_banks['id']; ?>" <? if($rowclient['type'] == 1) echo "selected"; ?>><? echo $row_banks['name']; ?></option><? } ?></select></div></div><div class="col-md-4"><div class="form-group"><label>Cuenta según LM:</label><input name="account[]" type="text" class="form-control" id="account[]" value=""></div></div><div class="col-md-4"><div class="form-group"><label>Cuenta según Banco:</label><input name="account2[]" type="text" class="form-control" id="account[]" value=""></div></div><div class="col-md-4"><div class="form-group"><label>Nombre:</label><input name="aname[]" type="text" class="form-control" id="aname[]" value=""></div></div><div class="col-md-4"><div class="form-group"><label>Moneda:</label><select name="currency[]" class="form-control" id="currency[]"><option value="0" selected>Seleccionar</option><? 
$query_banks = "select * from currency";
$result_banks = mysqli_query($con, $query_banks);
while($row_banks=mysqli_fetch_array($result_banks)){
?><option value="<? echo $row_banks['id']; ?>" <? if($rowclient['type'] == 1) echo "selected"; ?>><? echo $row_banks['name']; ?></option> <? } ?> </select></div></div> <div class="col-md-2"><div class="form-group"><label class="control-label">Opciones:</label><button type="button" class="btn red icn-only" onclick="deleteContact('+ccontact+');"><i class="fa fa-trash-o"></i>Eliminar</button></div></div>'; 
														
														$("#contacts").append('<div id="contact_'+ccontact+'">'+str_row2+'<div class="row"></div><hr></div>'); 
														ccontact++;
													}
													
													function deleteContact(id){  
	 													$('#contact_'+id).remove();  
													} 
													
													</script>
												
												
												<br><br>
												
												<h3 class="form-section">Informacion de Alias</h3>
												
												<? 
												$queryAlias = "select * from banksalias where bank = '$id'";
												$resultAlias = mysqli_query($con, $queryAlias);
												$numc = 0;
												while($rowAlias=mysqli_fetch_array($resultAlias)){
												$numa++;
												
												
												
												?>
												<div id="alias_<? echo $numc; ?>">
												
												<input type="hidden" name="alid[]" value="<? echo $rowAlias['id']; ?>">
											    
											    <div class="col-md-4">
											    <div class="form-group">
												    <label>Por banco:</label>
												    <input name="bankName[]" type="text" class="form-control" id="bankName" value="<? echo $thisBank[$rowAlias['bybank']]; ?>" readonly>
											
												</div></div>
											    <div class="col-md-4">
											    <div class="form-group">
												    <label>Alias:</label>
												    <input name="aname[]" type="text" class="form-control" id="aname[]" value="<? echo $rowAlias['name']; ?>" readonly>
												</div></div>
											    
											    
												
												   
												   
												<div class="row"></div><hr></div>
												<? } ?> 
												<div id="alias"></div>
												<div class="row"></div> 
												<a href="javascript:addRow3();">[+ Agregar Alias]</a>
												<script>
												var calias = parseInt(<? echo $numa+1; ?>);
													function addRow3(){
														var str_row3 = '<input type="hidden" name="alid[]" value="0"><div class="col-md-4"><div class="form-group"><label>Por banco:</label><select name="abank[]" class="form-control" id="abank[]"><option value="0" selected>Seleccionar</option><? 
$query_banks = "select * from banks order by name";
$result_banks = mysqli_query($con, $query_banks);
while($row_banks=mysqli_fetch_array($result_banks)){
?><option value="<? echo $row_banks['id']; ?>"><? echo $row_banks['name']; ?></option><? } ?></select></div></div><div class="col-md-4"><div class="form-group"><label>Alias:</label><input name="aname[]" type="text" class="form-control" id="aname[]" value=""></div></div> <div class="col-md-2"><div class="form-group"><label class="control-label">Opciones:</label><br><button type="button" class="btn red icn-only" onclick="deleteAlias('+calias+');"><i class="fa fa-trash-o"></i>Eliminar</button></div></div>'; 
														
														$("#alias").append('<div id="alias_'+calias+'">'+str_row3+'<div class="row"></div><hr></div>'); 
														ccontact++;
													}
													
													function deleteAlias(id){  
	 													$('#alias_'+id).remove();  
													} 
													
													</script>

											
												<!--/row--><!--/row-->

												

												<!--/row-->

												<div class="row"></div>

										    <!--/row--></div>

											<div class="form-actions right">

												<button type="button" class="btn default" onClick="goBanks();">Cancelar</button>
                                                <script>
												function goBanks(){
													window.location = "banks.php";
												}
												</script>

											  <button type="submit" class="btn blue"><i class="fa fa-check"></i> Editar</button>
												<input name="id" type="hidden" id="id" value="<?php echo $row['id']; ?>">

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

<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/form-samples.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/clockface/js/clockface.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
jQuery(document).ready(function() {       
// initiate layout and plugins
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
ComponentsPickers.init();
});   
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>*/ ?>