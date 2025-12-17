<?php 

require('headers.php');
$allowedRoles = ['admin', 'request'];
require("sessionCheck.php"); 
require('includes.php');
$requiredFiles = ['general', 'select2']; 

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

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Beneficiarios <small>Agregar beneficiarios</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="beneficiaries.php">Beneficiarios</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							Agregar Beneficiarios

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

										<form action="beneficiaries-add-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="formBeneficiaries">  

											<div class="form-body">

												<h3 class="form-section">Informacion del proveedor</h3>

												<div class="row">

									<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar..." >

												<option value=""></option>
<?php $queryproviders = "select * from providers";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders=mysqli_fetch_array($resultproviders)){
?>
												<option value="<?php echo $rowproviders['id']; ?>"><?php echo $rowproviders['code']." | ".$rowproviders['name']; ?></option>
                                                <?php } ?>

												

											</select>

															<div title="Page 5">
															  <div>
															    <div>
															     <span class="help-block">

															 Ingrese código, nombre o parte de el para filtar los resultados.</span>
														        </div>
														      </div>
													    </div>
													  </div>

													</div>
                                                   <div class="col-md-12">
                                                   <h4>Lista de beneficiarios:</h4>
</div>
<div id="beneficiaries" class="col-md-12">


Esperando que seleccione un proveedor.
</div>
													<!--/span-->
</div>
		<br>
<br>
<h3 class="form-section">Informacion del beneficiario</h3>
        <div class="row">
      
	
								<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Nombre:</label>
	<input name="name" type="text" class="form-control" id="name">
													  </div>

													</div>
                                                    <div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Comentarios:</label>
	
	
    <textarea name="comments" id="comments" class="form-control"></textarea>
													  </div>

													</div>

													<!--/span-->

												</div>

												<!--/row--><!--/row-->

												

												<!--/row-->

												<div class="row"></div>

										    <!--/row--></div>

											<div class="form-actions right">

												<button type="button" class="btn default">Cancelar</button>

												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar</button>

											</div>

										</form>

										<!-- END FORM-->

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
<?php include("footer.php"); loadJS($requiredFiles, $nonce); ?>
</body>
</html>
<script nonce="<?= $nonce ?>">
	
$(document).ready(function() {
    $('#provider').on('change', function(e) {
        chargeList(this.value);
    });
});
	
document.getElementById('formBeneficiaries').addEventListener('submit', function(e) {
    if (!validateForm()) {
        e.preventDefault(); // Cancela el envío
    }
});
	
function chargeList(id){
	$.post("reload-beneficiaries.php", { variable: id }, function(data){
		$("#beneficiaries").html(data); 
	});	
}

function validateForm(){
	var provider = document.getElementById("provider").value;
	if(provider == 0){
		alert('Usted debe de seleccionar un proveedor.');
		return false;
	}
	var name = document.getElementById("name").value;
	if(name == 0){
		alert('Usted debe de ingresar el nombre del beneficiario.');
		return false;
	}
}
</script>