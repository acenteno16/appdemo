<?php

require('headers.php');
$allowedRoles = ['admin', 'banks', 'bankingDebt'];
require("sessionCheck.php"); 
require('sanitize.php');
require('includes.php');
$requiredFiles = ['general']; 

?> 
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en" >
<!--<![endif]-->
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
					<h3 class="page-title">Bancos</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="dashboard.php">Inicio</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li><a href="#">Bancos</a></li>
					</ul>
				</div>
			</div>
			<div class="row">

				<div class="col-md-12">
					<div class="portlet">
						<div class="portlet-title">

							<div class="caption">

								<i class="fa fa-bank"></i>Lista de Bancos</div>

							<div class="actions">
								<? if(hasAccess(['admin'])){ ?>
								<a href="banks-payment-plans.php" class="btn default blue-stripe">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">Agregar Plan de pago</span>
								</a>
								<? } ?>
								<a href="banks-add.php" class="btn default blue-stripe">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">Agregar Banco</span>
								</a>
							</div>

						</div>

						<div class="row">
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
									$query = "select * from banks";
									$result = mysqli_query($con, $query);
									while($row=mysqli_fetch_array($result)){  
								?>
                                <tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>">
                                  <td class="sorting_1"><?php echo $row["id"]; ?></td><td><?php echo $row["name"]; ?></td>
                                  <td>
									  <? if(hasAccess(['admin'])){ ?>
									  <a href="banks-edit.php?id=<?php echo $row['id']; ?>"><span class="label label-warning"><i class="fa fa-edit"></i> Editar</span></a>
									  
                                      <a href="#" class="delete-btn" data-id="<?php echo $row['id']; ?>"><span class="label label-danger"> <i class="fa fa-trash-o"></i> Eliminar </span></a>
									  <? }else{ ?>-<? } ?>
                                  </td>
								</tr>
                                <?php } //while ?>
                                </tbody>
								</table>
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
<script nonce="<?= $nonce ?>">	
<? if(hasAccess(['admin'])){ ?>
	
	function deleteBank(id){
		if (confirm("Usted desea eliminar este Banco\n- Si usted no desea eliminar este banco presione cancelar.")==true){
			window.location="banks-delete.php?id="+id;
		}
	}
	
	document.querySelectorAll('.delete-btn').forEach(function(el) {
    	el.addEventListener('click', function(e) {
        	e.preventDefault();
        	var id = this.getAttribute('data-id');
        	deleteBank(id);
		});
	});	
	
<? } ?>	
</script>
</body>
</html>