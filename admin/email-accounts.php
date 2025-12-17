<?php 

require('headers.php');
$allowedRoles = ['admin', 'providers'];
require("sessionCheck.php"); 
require('functions.php');
require('includes.php');
$requiredFiles = ['general'];   

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
<div class="clearfix"></div>
<div class="page-container">
	<?php include("side.php"); ?>
	<div class="page-content-wrapper">

		<div class="page-content">

		

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->


			<!-- BEGIN PAGE HEADER-->		



			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Cuentas de Correo Electrónico <?php //<small>Ordenes de pago</small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Cuentas de correo electrónico</a></li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">

					
					<!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<i class="fa fa-envelope"></i>Lista de cuentas</div>

							<div class="actions">

								<a href="email-accounts-test.php" class="btn default blue-stripe">

								<i class="fa fa-list"></i>

								<span class="hidden-480">

								Probar cuentas</span>

								</a>

								
								<a href="email-accounts-edit.php?id=0" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Agregar Cuenta</span>

								</a>

								
							</div>

						</div>

						<div class="row"><!--/span-->


													<div class="col-md-12">
                           
        
        <?php //start table ?>
 	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">
									<th width="10%">ID</th>
									<th width="54%">Email</th>
									<th width="20%">Activa</th>
									<th width="36%">Opciones</th>
								</tr>
								</thead>
								<tbody>
                                <?php 
									
									$query = "select * from mailer";
									$result = mysqli_query($con, $query);
									while($row=mysqli_fetch_array($result)){
									
								?>								
								
                                <tr role="row" class="odd <?php if($row['active'] == 1) echo 'success'; ?>">
									<td class="sorting_1"><?php echo $row["id"]; ?></td>
									<td><?php echo $row["mailUsername"]; ?></td> 
									<td><? if($row['active'] == 1) echo 'Si'; else echo '<a href="email-account-activate.php?id='.$row['id'].'"><span class="label label-success"><i class="fa fa-check"></i> Activar</span></a>'; ?></td>
									<td><a href="email-accounts-edit.php?id=<?php echo $row['id']; ?>"><span class="label label-warning">
										<i class="fa fa-edit"></i> Editar</span></a>
										<a href="#" class="deleteAccount" data-id="<?php echo $row['id']; ?>"><span class="label label-danger">
											<i class="fa fa-trash-o"></i> Eliminar </span></a>
									</td>
								</tr>
                                <?php } //while ?>
                                </tbody>

								</table>
                      

					<?php //table } ?>	
														
														
														
</div></div>

					</div>

					<!-- End: life time stats -->

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
<?php include('foot.php'); ?> 
<script nonce="<?= $nonce; ?>">
	function deleteAccount(id){
		if (confirm("Usted desea eliminar esta cuenta\n- Si usted no desea eliminar esta cuenta presione cancelar.")==true){
			window.location="email-accounts-delete.php?id="+id;
		} 
	}
	document.addEventListener("DOMContentLoaded", function () {
  	document.body.addEventListener("click", function (e) {
    const target = e.target.closest('.deleteAccount'); // <- más robusto
    if (target) {
      e.preventDefault();
      const id = target.getAttribute('data-id');
      deleteAccount(id);
    }
  });
});

	
</script>