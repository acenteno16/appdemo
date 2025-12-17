<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require('headers.php');
$allowedRoles = ['admin'];
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

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Rechazos <?php //<small>Ordenes de pago</small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="dashboard.php">Inicio</a>
							<i class="fa fa-angle-right"></i>
						</li>

						<li><a href="#">Rechazos</a></li>

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

								<i class="fa fa-shopping-cart"></i>Lista de Rechazos</div>

							<div class="actions">

								<a href="rejections-add.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Agregar Rechazo</span>

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
									<th width="64%">Nombre</th>
									<th width="26%">Opciones</th>
								</tr>
								</thead>

								<tbody>

                                <?php 
									
									$query = $con->prepare("select * from reason");
									$query->execute();
									$result = $query->get_result();
									while($row=$result->fetch_assoc()){
										
									?>

								
								
                                <tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>">
                                  <td class="sorting_1"><?php echo $row["id"]; ?></td><td><?php echo $row["name"]; ?></td>
                                  <td><a href="rejections-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable">

									<i class="fa fa-search"></i> Ver</a>
                                    <?php $queryisset = "select id from payments where reason = '$row[id]'"; 
									$resultisset = mysqli_query($con, $queryisset);
									$numisset = mysqli_num_rows($resultisset);
									
									if($numisset == 0){
									
									?>
                                    <a href="#" class="deleteRejection" data-id="<?= $row['id']; ?>"><span class="label label-danger">
										<i class="fa fa-trash-o"></i> Eliminar </span></a>
									<?php } ?>
                                  </td></tr>
                                
                                
                                
                                
                                
                                
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
	function deleteRejection(id){
		if (confirm("Usted desea eliminar este rechazo\n- Si usted no desea eliminar este rechazo presione cancelar.")==true){
			let code = prompt("Por favor, ingresa el codigo de 2fa:");
			window.location=`rejections-delete.php?id=${id}&code=${code}`;	
			}
		}
	
	document.addEventListener("DOMContentLoaded", function () {
  		document.body.addEventListener("click", function (e) {
			const target = e.target.closest('.deleteRejection'); // <- más robusto
    		if (target) {
      			e.preventDefault();
      			const id = target.getAttribute('data-id');
      			deleteRejection(id);
				
    		}
  		});
	});
</script>
