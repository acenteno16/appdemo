<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('functions.php');
require('includes.php');
$requiredFiles = ['general']; 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query= $con->prepare("select * from bankspaymentplans where id = ?");
$query->bind_param("i", $id); // 'i' indica que $id es un entero
$query->execute();
$result = $query->get_result();
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

						<li>Editor Planes de pago

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

										<form action="banks-payment-plans-edit-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 

											<div class="form-body">

												<h3 class="form-section">Informacion General</h3>

												<div class="row">


													<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Nombre:</label>
	<input name="name" type="text" class="form-control" id="name" placeholder="" value="<?php echo $row['name']; ?>">
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
														      </div>
													    </div>
													  </div>

													</div>
													<div class="col-md-3">
											    <div class="form-group">
												    <label>Compañia:</label>
												  
													<select name="company" id="company" class="form-control">
													<option value="0" selected>Seleccionar</option>
													<? 
														$queryCompany = "select * from companies";
														$resultCompany = mysqli_query($con, $queryCompany);
														while($rowCompany=mysqli_fetch_array($resultCompany)){
														?>
													<option value="<? echo $rowCompany['id']; ?>" <? if($rowCompany['id'] == $row['company']) echo 'selected'; ?>><? echo $rowCompany['name']; ?></option>
													<? } ?>	
													</select>
												</div></div> 
													
													<div class="col-md-3">
											    <div class="form-group">
												    <label>Banco:</label>
												    
													<select name="bank" id="bank" class="form-control">
													<option value="0" selected>Seleccionar</option>
													<? 
														$queryBank = "select * from banks";
														$resultBank = mysqli_query($con, $queryBank);
														while($rowBank=mysqli_fetch_array($resultBank)){
														?>
													<option value="<? echo $rowBank['id']; ?>" <? if($rowBank['id'] == $row['bank']) echo 'selected'; ?>><? echo $rowBank['name']; ?></option>
													<? } ?>	
													</select>
												</div></div> 
													
													<div class="col-md-3">
											    <div class="form-group">
												    <label>Moneda:</label>
												    
													<select name="currency" id="currency" class="form-control">
													<option value="0" selected>Seleccionar</option>
													<? 
														$queryCurrency = "select * from currency";
														$resultCurrency = mysqli_query($con, $queryCurrency);
														while($rowCurrency=mysqli_fetch_array($resultCurrency)){
														?>
													<option value="<? echo $rowCurrency['id']; ?>" <? if($rowCurrency['id'] == $row['currency']) echo 'selected'; ?>><? echo $rowCurrency['name']; ?></option>
													<? } ?>	
													</select>
												</div></div> 
													
													<div class="row"></div>
													
													<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Consecutivo:</label>
	<input name="inc" type="number" class="form-control" id="inc" placeholder="" value="<?php echo $row['inc']; ?>" <? if($id > 0) echo 'disabled'; ?>>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
														      </div>
													    </div>
													  </div>

													</div>

												

												</div>
												
												

										    <!--/row--></div>

											<div class="form-actions right">

											  <button type="button" class="btn default" id="btnGoBack">Cancelar</button>
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

<?php include("sidebar.php"); ?>
</div>
<?php include("footer.php"); loadJS($requiredFiles, $nonce); ?>
</body>
</html>
<script nonce="<?= $nonce ?>">
	document.getElementById('btnGoBack').addEventListener('click', function() {
		window.location.href = "banks.php";
	});
</script>