<?

require( 'headers.php' );
$allowedRoles = [ 'admin', '2FA' ];
require( "sessionCheck.php" );
require( 'includes.php' );
$requiredFiles = [ 'general', 'datepicker', 'select2'];
require('sanitize.php');

$code = isset($_GET['code']) ? sanitizeInput($_GET['code'], $con) : '';
$name = isset($_GET['name']) ? sanitizeInput($_GET['name'], $con) : '';
$email = isset($_GET['email']) ? sanitizeInput($_GET['email'], $con) : '';
$unit = isset($_GET['unit']) ? sanitizeInput($_GET['unit'], $con) : '';

$sqlConditions = [];
$sqlParams = [];
$paramTypes = '';

if ($code !== '') {
    $sqlConditions[] = "code LIKE ?";
    $sqlParams[] = "%$code%";
    $paramTypes .= 's';
}
if ($name !== '') {
    $sqlConditions[] = "(first LIKE ? OR last LIKE ?)";
    $sqlParams[] = "%$name%";
    $sqlParams[] = "%$name%";
    $paramTypes .= 'ss';
}
if ($email !== '') {
    $sqlConditions[] = "email LIKE ?";
    $sqlParams[] = "%$email%";
    $paramTypes .= 's';
}
if ($unit !== '') {
    $sqlConditions[] = "unit = ?";
    $sqlParams[] = "%$unit%";
    $paramTypes .= 'i';
}

$sql = implode(' AND ', $sqlConditions);
$query = "SELECT * FROM workers WHERE id > 0" . ($sql ? " AND $sql" : "");
$stmt = $con->prepare($query);
if (!empty($sqlParams)) {
    $stmt->bind_param($paramTypes, ...$sqlParams);
}
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <title>Aplicación de Pagos | Casa Pellas S.A.</title>
  <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description"/>
  <meta content="" name="author"/>
  <link href="favicon.ico" rel="shortcut icon"/>
  <?php loadCSS($requiredFiles, $nonce); ?>
</head>
<style nonce="<?= $nonce; ?>">
	.portlet-title{
		height: 1px !important;
		padding: 1px !important;
	}
</style>
<body class="page-header-fixed page-quick-sidebar-over-content ">
<?php include("header.php"); ?>
<div class="clearfix"></div>
<div class="page-container">
	<?php include("side.php"); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<h3 class="page-title">Usuarios <small>2FA</small></h3>
					<ul class="page-breadcrumb breadcrumb">
					  <li>
						  <i class="fa fa-home"></i>
						  <a href="dashboard.php">Inicio</a>
						  <i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Opciones</a>
                            <i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Usuarios</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">     
                    <div class="portlet box blue">
						<div class="portlet-title">
						</div>
						<div class="portlet-body form">
							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="horizontal-form" method="get" enctype="multipart/form-data">

											<div class="form-body">
												<h3 class="form-section">Buscar Usuarios</h3>

												<div class="row"><!--/span-->

												  <div class="col-md-3 ">
													  <div class="form-group">
														<label>Código:</label>
                                                        <input name="code" type="text" class="form-control" id="code" value="<?= $_GET['code']; ?>">
						
                                                          
                       <br>
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> <div class="col-md-3 ">
													  <div class="form-group">
														<label>Nombre:</label>
                                                        <input name="name" type="text" class="form-control" id="name" value="<?= $_GET['name']; ?>">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> <div class="col-md-3 ">
													  <div class="form-group">
														<label>Email:</label>
                                                        <input name="email" type="text" class="form-control" id="email" value="<?= $_GET['email']; ?>">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-3"><div class="form-group">

														<label class="control-label">Unidad de Negocio</label>
														<select name="unitid" class="form-control select2me" id="unitid" data-placeholder="Seleccionar...">
														  <option value="0" selected>Seleccionar</option>
															<?php 
															$thisUnit = array();
															$queryunit = "select * from units where active = '1'";
															$resultunit = mysqli_query($con, $queryunit);
															while($rowunit=mysqli_fetch_array($resultunit)){ 
																$thisUnit[$rowunit['id']] = $rowunit['newCode'].' | '.$rowunit['companyName'].' '.$rowunit['lineName'].' '.$rowunit['locationName'];
															?>          
															<option value="<?php echo $rowunit['id']; ?>" <?php if($row['unitid'] == $rowunit['id']) echo 'selected'; ?>><?php echo $rowunit['newCode']." | ".$rowunit['companyName'].' '.$rowunit['lineName'].' '.$rowunit['locationName']; ?></option>   
															<?php } ?>
														</select> 
													</div></div>

													<!--/span-->

												</div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

											<!--/row--><!--/row--></div>


											<div class="form-actions right">

<input type="hidden" name="form" id="form" value="1">
												<button type="button" class="btn red cleanSearch"><i class="fa fa-times"></i> Eliminar busqueda</button>
                                                
                                                <button type="submit" class="btn blue"><i class="fa fa-check"></i> Buscasr</button>

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div><br>
                              
                              <div class="tabbable tabbable-custom boxless tabbable-reversed">
				
                                <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

							Lista de Usuarios
							</div>

							<div class="actions">

								<? if(($_GET['show'] == 1) or ($_GET['form'] == 1)){ }else{ ?>
                                <a href="?show=1" class="btn default blue-stripe">

								<i class="fa fa-eye"></i>

								<span class="hidden-480">

								Mostrar Usuarios</span>

								</a>
                                <? } ?>
                               

								
							</div>

						</div>

						

					</div>
                    

                    <? if(($_GET['show'] == 1) or ($_GET['form'] == 1)){ ?>              
                                  
					<div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <?php ///// table ?>
                         	<div class="tab-pane" id="tab_1">
								<div class="row">
									<div class="col-md-12">
										
										<table class="table table-striped table-bordered table-hover" id="datatable_orders">
								<thead>
								<tr role="row" class="heading">
									<th width="48">Código</th>
                                    <th width="78">Nombre</th>
									<th width="40">Email</th>
									<th width="50">Unidad</th>
									<th width="221">Opciones</th>
								</tr>
								</thead>
								<tbody>
                                
<?php 


while ($row = $result->fetch_assoc()) {

?>

								
								
                                <tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>">
                                  <td class="sorting_1" width="48"><?php echo $row['code']; ?></td>
								  <td><?php echo $row["first"]." ".$row["last"]; ?></td>
								  <td><?php echo $row["email"]; ?></td>
                                  <td>
                                 <?php echo $thisUnit[$row['unitid']]; ?>
                                 </td>
                                  <td><a href="workers-2fa-view.php?id=<?php echo $row['id']; ?>"><span class="label bg-blue"> 

									<i class="fa fa-search"></i> ver</span></a>
                                    
                                   
                                   
                                  </td></tr>
									
                                <?php } //while ?>
                                </tbody>

								</table>
                      

</div></div>

</div>


							

							

							

					<?php //table } ?>		

							

							

					

					</div>
                                  
                    <? }else{ ?>    
                        
                    <div class="note note-regular">
                                  
                                  NOTA: Para mostrar los Usuarios, debe de pulsar el boton "mostrar usuarios" o aplicar algun filtro.
                                  
                                  </div>              
                                  
                    <? } ?>
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
<?php include("sidebar.php"); ?>
</div>
<?php include("footer.php"); loadJS($requiredFiles, $nonce); ?>
</body>
</html>
<script nonce="<?= $nonce ?>">
	function cleanSearch(){
		window.location = "workers-2fa.php";
	}
	document.addEventListener("DOMContentLoaded", function () {
  		document.body.addEventListener("click", function (e) {
    		if (e.target.classList.contains("cleanSearch")) {
      			e.preventDefault();
      			cleanSearch();
    		}
		});
	});
</script>