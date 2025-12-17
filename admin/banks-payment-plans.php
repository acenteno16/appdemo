<?php

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
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
<div class="clearfix">
</div>
<div class="page-container">
<?php include("side.php"); ?>
<div class="page-content-wrapper">
<div class="page-content">
<div class="row">
	<div class="col-md-12">
		<h3 class="page-title">Bancos <small>Planes de pago</small></h3>

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

						
						<li>
							<a href="#">Planes de pago</a>
						</li>
					</ul>

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

								<i class="fa fa-shopping-cart"></i>Lista de Planes de pago</div>

							<div class="actions">

								<a href="banks-payment-plans-edit.php?id=0" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Agregar Plan de pago</span>

								</a>
								
							</div>

						</div>

						<div class="row"><!--/span-->


													<div class="col-md-12">
                           
        
<?php //start table ?>
<?php $query = "select * from bankspaymentplans";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
if($num > 0){ ?>
 	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">
									<th width="10%">ID</th>
									<th width="64%">Nombre</th>
									<th width="26%">Opciones</th>
								</tr>

								</thead>

								<tbody>

              <?  while($row=mysqli_fetch_array($result)){  

?>

                                <tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>">
                                  <td class="sorting_1"><?php echo $row["id"]; ?></td><td><?php echo $row["name"]; ?></td>
                                  <td><a href="banks-payment-plans-edit.php?id=<?php echo $row['id']; ?>"><span class="label label-warning">

									<i class="fa fa-edit"></i> Editar</span></a>
                                    <a href="#" class="delete-btn" data-id="<?php echo $row['id']; ?>"><span class="label label-danger">

								  <i class="fa fa-trash-o"></i> Eliminar </span></a>
                                  </td></tr>
                                
                                <?php } //while ?>
                                </tbody>

								</table>
                      

					<?php  }else{ ?>
														
														<div class="note note-regular">
														NOTA: No se encontró ningún plan de pago. 
														</div>
														
														<? } ?>
							</div></div>

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

	function deleteBankPlan(id){
		if (confirm("Usted desea eliminar este Plan de pago?\n- Si usted no desea eliminar este plan de pgo presione cancelar.")==true){
			window.location="banks-payment-plans-delete.php?id="+id;
		}
	}
	
	document.querySelectorAll('.delete-btn').forEach(function(el) {
    	el.addEventListener('click', function(e) {
        	e.preventDefault();
        	var id = this.getAttribute('data-id');
        	deleteBankPlan(id);
		});
	});	
	
</script>