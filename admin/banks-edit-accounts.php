<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('functions.php');
require('includes.php');
$requiredFiles = ['general']; 
include('functionsBanks.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$queryAccount = $con->prepare("SELECT * FROM banksaccounts WHERE id = ?");
$queryAccount->bind_param("i", $id); // 'i' indica que $id es un entero
$queryAccount->execute();
$resultAccount = $queryAccount->get_result();
$rowAccount = $resultAccount->fetch_assoc(); 

$query = "select * from banks where id = '$rowAccount[bank]'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result); 

 
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
					<h3 class="page-title">Bancos <small>Editor de Bancos [Cuentas]</small></h3>
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

						<li>Editor de Bancos [Cuentas]

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

									<div class="portlet-title"></div>

									<div class="portlet-body form">

						 				<!-- BEGIN FORM-->

										<form action="banks-edit-accounts-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 

											<div class="form-body">

												<h3 class="form-section">Informacion del Banco</h3>

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
	<input name="name" type="text" class="form-control" id="name" placeholder="Ej: Casa Pellas S.A." value="<?php echo $row['name']; ?>" readonly>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
														      </div>
													    </div>
													  </div>

													</div>
													
													<div class="row"></div>

													
													<div class="col-md-5">
													  <div class="form-group">
														<label>Imágen:</label><br>
														 <img src="banks/<? echo $row['id']; ?>.jpg" width="250"> 
                                                   <br>
													</div>
													</div>
													<!--/span-->

												</div>
												
												<h3 class="form-section">Informacion de la Cuenta</h3>
												
												<? $company = $globalCompany[$rowAccount['company']];?>
												<div id="contact_<? echo $numc; ?>">
												
												<input type="hidden" name="aid[]" value="<? echo $row_accounts['id']; ?>">
											    <div class="col-md-3">
											    <div class="form-group">
												    <label>Compañía:</label>
												    <input name="company" type="text" class="form-control" id="company" value="<? echo $company; ?>" disabled>
												</div></div>
											    <div class="col-md-3">
											    <div class="form-group">
												    <label>Cuenta según LM:</label>
												    <input name="account" type="text" class="form-control" id="account" value="<? echo $rowAccount['account']; ?>">
												</div></div>
											    <div class="col-md-3">
											    <div class="form-group">
												    <label>Cuenta según Banco:</label>
												    <input name="account2" type="text" class="form-control" id="account2" value="<? echo $rowAccount['account2']; ?>">
												</div></div>
											    <div class="col-md-3">
											    <div class="form-group">
												    <label>Nombre:</label>
												    <input name="aname" type="text" class="form-control" id="aname" value="<? echo $rowAccount['aname']; ?>">
												</div></div>
												<div class="col-md-3">
											    <div class="form-group">
												    <label>Moneda:</label>
												    
													<select name="currency" id="currency" class="form-control">
													<option value="0" selected>Seleccionar</option>
													<? 
														$queryCurrency = "select id, name from currency";
														$resultCurrency = mysqli_query($con, $queryCurrency);
														while($rowCurrency=mysqli_fetch_array($resultCurrency)){
														?>
													<option value="<? echo $rowCurrency['id']; ?>" <? if($rowCurrency['id'] == $rowAccount['currency']) echo 'selected'; ?>><? echo $rowCurrency['name']; ?></option>
													<? } ?>	
													</select>
												</div></div>  
                                                    
                                                    <? 
                                                    
                                                    $queryPlans = "select * from bankspaymentplans where bank = '$row[id]'";
												    $resultPlans = mysqli_query($con, $queryPlans);
                                                    $numPlans = mysqli_fetch_array($resultPlans);
                                                    
                                                    ?>
													<div class="col-md-3">
											    <div class="form-group">
												    <label>Plan:</label>
													<select name="plan" id="plan" class="form-control">
													<option value="0" selected>Seleccionar</option>
													<? 
														
														while($rowPlans=mysqli_fetch_array($resultPlans)){
														?>
													<option value="<? echo $rowPlans['id']; ?>" <? if($rowPlans['id'] == $row['plan']) echo 'selected';  ?> ><? echo $rowPlans['name']; ?></option>
													<? } ?>	 
													</select>
												</div></div>
													
												   

												<div class="row"></div>

										    <!--/row--></div>

											<div class="form-actions right">

												<button type="button" class="btn default" id="btnGoBanks">Cancelar</button>
                                                

											  <button type="submit" class="btn blue"><i class="fa fa-check"></i> Editar</button>
												<input name="id" type="hidden" id="id" value="<?php echo $rowAccount['id']; ?>">

											</div>

										</form>

									</div>  
s
								</div>

							</div>

					</div>

				</div>

			</div>
		</div>

	</div>
<?php include("sidebar.php"); ?>
</div>
<?php include("footer.php"); loadJS($requiredFiles, $nonce); ?>
</body>
</html>
<script nonce="<?= $nonce ?>">
	document.getElementById('btnGoBanks').addEventListener('click', function() {
		window.location.href = "banks.php";
	});
</script> 