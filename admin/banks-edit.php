<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('functions.php');
require('includes.php');
$requiredFiles = ['general']; 
include('functionsBanks.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = $con->prepare("select * from banks where id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$num = $result->num_rows;
$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="utf-8"/>
<title>Aplicación de Pagos | Casa Pellas S.A.</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link rel="shortcut icon" href="favicon.ico"/>
<?php loadCSS($requiredFiles, $nonce); ?>	
</head>
<body class="page-header-fixed page-quick-sidebar-over-content ">
<?php include("header.php"); ?>
<div class="clearfix">
</div>
<div class="page-container">
<?php include("side.php"); ?>
<div class="page-content-wrapper">
<div class="page-content">
<div class="row">
	<div class="col-md-12">
		<h3 class="page-title">Bancos <small>Editor de Bancos</small></h3>
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

			<div class="row">

				<div class="col-md-12">

					<div class="tabbable tabbable-custom boxless tabbable-reversed">

						

							<div class="tab-pane" id="tab_1">

								<div class="portlet box blue">

									<div class="portlet-title">

										
										

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
												
												$query_accounts = $con->prepare("select * from banksaccounts where bank = ?");
												$query_accounts->bind_param("i", $id);
												$query_accounts->execute();
												$result_accounts = $query_accounts->get_result();
												while ($row_accounts = $result_accounts->fetch_assoc()){	
													
													$numc++;
													
													$company = $globalCompany[$row_accounts['company']];
													$currency = $globalCurrencyName[$row_accounts['currency']];
													$plan = $thisPlan[$row_accounts['plan']];
													
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
												    <input name="plan[]" type="text" class="form-control" id="plan" value="<? echo $plan; ?>" disabled>
												</div></div>
													<div class="col-md-3">
											    <div class="form-group">
												    <label>Options:</label>
												   <br><a href="banks-edit-accounts.php?id=<? echo $row_accounts['id']; ?>"><button type="button" class=" btn blue"><i class="fa fa-edit"></i> Editar</button> </a>   &nbsp; &nbsp; &nbsp;<a href="banksEditAccountsDelete.php?id=<? echo $row_accounts['id']; ?>" ><button class="btn red" type="button"><i class="fa fa-trash-o" >Eliminar</i></button></a>
												</div></div>
												<div class="row"></div><hr></div>
												<? } ?> 
												<div id="contacts"></div>
												<div class="row"></div> 
												<a href="#" id="btnAddAccount">[+ Agregar Cuenta]</a>
												
												<div class="row"></div>
											</div>

											<div class="form-actions right">
												<button type="button" class="btn default" id="btnGoBanks">Cancelar</button>
												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Editar</button>
												<input name="id" type="hidden" id="id" value="<?php echo $row['id']; ?>">

											</div>

										</form>

									</div>  

								</div>

							</div>

					</div>

				</div>

			</div>
		</div>

	</div>
<?php include("sidebar.php"); ?>
</div>
<?php 
	include("footer.php"); 
	loadJS($requiredFiles, $nonce);
?>
</body>
</html>
<script nonce="<?= $nonce ?>">
	
	document.getElementById('contacts').addEventListener('click', function(e) {
		if (e.target && e.target.closest('.delete-btn')) {
			e.preventDefault();
			var id = e.target.closest('.delete-btn').getAttribute('data-id');
			document.getElementById('contact_' + id).remove();
		}
	});

	document.getElementById('btnGoBanks').addEventListener('click', function() {
		window.location.href = "banks.php";
	});

	<? /*	
	var ccontact222 = parseInt(<? echo $numc+1; ?>);
	function addRow22(){
var str_row2 = '<input type="hidden" name="aid[]" value="0"><div class="col-md-4"><div class="form-group"><label>Compañía:</label><select name="company[]" class="form-control" id="company[]"><option value="0" selected>Seleccionar</option><? 
$query_banks = "select * from companies order by name";$result_banks = mysqli_query($con, $query_banks);while($row_banks=mysqli_fetch_array($result_banks)){?><option value="<? echo $row_banks['id']; ?>"><? echo $row_banks['name']; ?></option><? } ?></select></div></div><div class="col-md-4"><div class="form-group"><label>Cuenta según LM:</label><input name="account[]" type="text" class="form-control" id="account[]" value=""></div></div><div class="col-md-4"><div class="form-group"><label>Cuenta según Banco:</label><input name="account2[]" type="text" class="form-control" id="account[]" value=""></div></div><div class="col-md-4"><div class="form-group"><label>Nombre:</label><input name="aname[]" type="text" class="form-control" id="aname[]" value=""></div></div><div class="col-md-4"><div class="form-group"><label>Moneda:</label><select name="currency[]" class="form-control" id="currency[]"><option value="0" selected>Seleccionar</option><? 
$query_banks = "select * from currency";
$result_banks = mysqli_query($con, $query_banks);
while($row_banks=mysqli_fetch_array($result_banks)){
?><option value="<? echo $row_banks['id']; ?>"><? echo $row_banks['name']; ?></option><? } ?></select></div></div> <div class="col-md-4"><div class="form-group"><label>Plan:</label><select name="plan[]" class="form-control" id="plan[]"><option value="0" selected>Seleccionar</option><? $queryPlan = "select id, name from bankspaymentplans";$resultPlan = mysqli_query($con, $queryPlan);while($rowPlan=mysqli_fetch_array($resultPlan)){
?><option value="<? echo $rowPlan['id']; ?>"><? echo $rowPlan['name']; ?></option> <? } ?> </select></div></div> <div class="col-md-2"><div class="form-group"><label class="control-label">Opciones:</label><button type="button" class="btn red icn-only delete-btn" data-id="'+ccontact+'"><i class="fa fa-trash-o"></i>Eliminar</button></div></div>'; 														
$("#contacts").append('<div id="contact_'+ccontact+'">'+str_row2+'<div class="row"></div><hr></div>');
	ccontact++;
}
	*/ ?>
	
	document.getElementById('btnAddAccount').addEventListener('click', function(e) {
		e.preventDefault();
		addRow2();
	});

	document.getElementById('contacts').addEventListener('click', function(e) {
	if (e.target && e.target.closest('.delete-btn')) {
		e.preventDefault();
		const btn = e.target.closest('.delete-btn');
		const id = btn.getAttribute('data-id');
		const row = document.getElementById('contact_' + id);
		if (row) row.remove();
	}
	});

	let ccontact = parseInt(<?= intval($numc + 1) ?>);

	function addRow2() {
	const html = `
	<input type="hidden" name="aid[]" value="0">
	<div class="row" id="contact_${ccontact}">
		<div class="col-md-4">
			<div class="form-group">
				<label>Compañía:</label>
				<select name="company[]" class="form-control">
					<option value="0">Seleccionar</option>
					<?php
					$query_banks = "select * from companies order by name";
					$result_banks = mysqli_query($con, $query_banks);
					while($row_banks = mysqli_fetch_array($result_banks)){
						echo '<option value="'.$row_banks['id'].'">'.htmlspecialchars($row_banks['name']).'</option>';
					}
					?>
				</select>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="form-group">
				<label>Cuenta según LM:</label>
				<input name="account[]" type="text" class="form-control">
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="form-group">
				<label>Cuenta según Banco:</label>
				<input name="account2[]" type="text" class="form-control">
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label>Nombre:</label>
				<input name="aname[]" type="text" class="form-control">
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="form-group">
				<label>Moneda:</label>
				<select name="currency[]" class="form-control">
					<option value="0">Seleccionar</option>
					<?php
					$query_banks = "select * from currency";
					$result_banks = mysqli_query($con, $query_banks);
					while($row_banks = mysqli_fetch_array($result_banks)){
						echo '<option value="'.$row_banks['id'].'">'.htmlspecialchars($row_banks['name']).'</option>';
					}
					?>
				</select>
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label>Plan:</label>
				<select name="plan[]" class="form-control">
					<option value="0">Seleccionar</option>
					<?php
					$queryPlan = "select id, name from bankspaymentplans";
					$resultPlan = mysqli_query($con, $queryPlan);
					while($rowPlan = mysqli_fetch_array($resultPlan)){
						echo '<option value="'.$rowPlan['id'].'">'.htmlspecialchars($rowPlan['name']).'</option>';
					}
					?>
				</select>
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label">Opciones:</label><br>
				<button type="button" class="btn red delete-btn" data-id="${ccontact}">
					<i class="fa fa-trash-o"></i> Eliminar
				</button>
			</div>
		</div>
		<hr>
	</div>`;
	
	document.getElementById('contacts').insertAdjacentHTML('beforeend', html);
	ccontact++;
}
</script>