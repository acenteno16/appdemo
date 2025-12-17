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
<?php 
loadCSS($requiredFiles, $nonce); // Antes de </head>
?>
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
					<h3 class="page-title">Compañías</h3>
					<ul class="page-breadcrumb breadcrumb">
					  <li>
						  <i class="fa fa-home"></i>
						  <a href="dashboard.php">Inicio</a>
						  <i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Compañías</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
 
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Lisgta de Compañías
							</div>

							<div class="actions">

								<a href="companies-add.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Agregar</span>

								</a>

							

							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

								<?php 
								
								
$tampagina = 100;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
} 
								
$query = "select * from companies order by id asc"; 
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);       
						
								
if($numdev > 0){  ?>
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">
									<th width="5%">ID</th>
									<th width="13%">Nombre</th>
									<th width="13%">IR Activo?</th>
									<th width="17%">Opciones</th>
								</tr>
								</thead>
								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){ ?>    
                                <tr role="row" class="odd <? if($row['active'] == 0) echo "danger"; ?>">
									<td class="sorting_1"><?php echo $row['id']; ?></td>
									<td><?php echo $row['name']; ?></td>
									<td><?php switch($row['iractive']){
									default:
										echo '-';
										break;
									case 1:
										echo 'Si';
										break;
									
								}
										?></td>
									<td>
                            <a href="companies-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver/Editar</a>     <a href="#" class="btn btn-xs red btn-editable delete-btn" data-id="<?php echo $row['id']; ?>">
    <i class="fa fa-trash-o"></i> Eliminar</a>        
                            
                            </td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
                                <div>
								<? #Pagination here ?>
							</div>
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna compañía.

						</p>

					</div>
                                <?php } ?>
                             
                                
                             

						</div>

					</div>

					<!-- End: life time stats -->

				</div>

			</div>

			<!-- END PAGE CONTENT-->

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
function deleteCompany(id){
	alert('No esta habilitada la opcion de eliminar companias.');
}
document.querySelectorAll('.delete-btn').forEach(function(el) {
    el.addEventListener('click', function(e) {
        e.preventDefault();
        var id = this.getAttribute('data-id');
        deleteCompany(id);
    });
});	
</script>
<? include('foot.php'); ?>	