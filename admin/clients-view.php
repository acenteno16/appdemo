<?php 

require('headers.php');
$allowedRoles = ['admin', 'providers'];
require("sessionCheck.php"); 
require('functions.php');
require('includes.php');
$requiredFiles = ['general'];   

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = $con->prepare("select * from clients where id = ?");
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
<div class="clearfix"></div>
<div class="page-container">
	<?php include("side.php"); ?>
	<div class="page-content-wrapper">

		<div class="page-content">

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Clientes <small>Edicion de Clientes</small>

					</h3>

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

							<a href="clients.php">Clientes</a>
                             <i class="fa fa-angle-right"></i>
                             </li>

						<li>

							<a href="#">Editor de Clientes</a>

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

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

								
											<div class="form-body">

												
												
												<h3  class="form-section">Información del Cliente</h3> 


                                                  
                                                  <div id="client-stage">

                                                  <div class="row">
                                                   
<div class="col-md-4">

<div class="form-group">
<label class="control-label">Tipo de cliente</label>
<select name="clienttype" class="form-control" id="clienttype" disabled>
<option value="0" selected>Seleccionar</option>
<option value="1" <? if($row['type'] == 1) echo "selected"; ?>>Persona Natural</option> 
<option value="2" <? if($row['type'] == 2) echo "selected"; ?>>Persona Jurídica</option> 
</select>
                                                            

													  </div>

													</div>                                                                     
<div class="row"></div>                                                  
<div id="ct_personal" style="display: <? if($row['type'] == 1){ echo "block"; }else{ echo "none"; } ?>;">
<div class="col-md-2 ">
<div class="form-group">
<label>Código:</label>
<div class="input-group">
<input name="ccode" type="text" class="form-control" id="ccode" value="<? echo $row['code']; ?>" disabled>
</div>
</div>
</div>
<div class="col-md-5 ">
<div class="form-group">
<label>Nombres:</label>
<input name="cfirst" type="text" class="form-control" id="cfirst" value="<? echo $row['first']; ?>" disabled> 
</div>
</div>
<div class="col-md-5 ">
<div class="form-group">
<label>Apellidos:</label>
<input name="clast" type="text" class="form-control" id="clast" value="<? echo $row['last']; ?>" disabled> 
</div>
</div>
<div class="col-md-8 ">
<div class="form-group">
<label>Dirección:</label>
<input name="caddress" type="text" class="form-control" id="caddress" value="<? echo $row['address']; ?>" disabled> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Ciudad:</label>
<input name="ccity" type="text" class="form-control" id="ccity" value="<? echo $row['city']; ?>" disabled> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Cédula:</label>
<input name="cnid" type="text" class="form-control" id="cnid" value="<? echo $row['nid']; ?>" disabled> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Email:</label>
<input name="cemail" type="text" class="form-control" id="cemail" value="<? echo $row['email']; ?>" disabled> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Teléfono:</label>
<input name="cphone" type="text" class="form-control" id="cphone" value="<? echo $row['phone']; ?>" disabled> 
</div>
</div>
</div>
<div id="ct_business" style="display: <? if($row['type'] == 2){ echo "block"; }else{ echo "none"; } ?>;">
<div class="col-md-2 ">
<div class="form-group">
<label>Código:</label>
<div class="input-group">
<input name="ccode2" type="text" class="form-control" id="ccode2" value="<? echo $row['code']; ?>" disabled>
</div>
 
</div>
</div>
<div class="col-md-10 ">
<div class="form-group">
<label>Nombre de la Empresa:</label>
<input name="cname" type="text" class="form-control" id="cname" value="<? echo $row['name']; ?>" disabled> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>No. RUC:</label>
<input name="cruc" type="text" class="form-control" id="cruc" value="<? echo $row['ruc']; ?>" disabled> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Email:</label>
<input name="cemail2" type="text" class="form-control" id="cemail2" value="<? echo $row['email']; ?>" disabled> 
</div>
</div>

<div class="col-md-4 ">
<div class="form-group">
<label>Teléfono:</label>
<input name="cphone2" type="text" class="form-control" id="cphone2" value="<? echo $row['phone']; ?>" disabled> 
</div>
</div>

<div class="col-md-8 ">
<div class="form-group">
<label>Dirección:</label>
<input name="caddress2" type="text" class="form-control" id="caddress2" value="<? echo $row['address']; ?>" disabled> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Ciudad:</label>
<input name="ccity2" type="text" class="form-control" id="ccity2" value="<? echo $row['city']; ?>" disabled> 
</div>
</div>


<div class="col-md-12"><h4>Información del Representante Legal</h4></div>

<div class="col-md-6 ">
<div class="form-group">
<label>Nombres:</label>
<input name="crfirst" type="text" class="form-control" id="crfirst" value="<? echo $row['rfirst']; ?>" disabled> 
</div>
</div>
<div class="col-md-6 ">
<div class="form-group">
<label>Apellidos:</label>
<input name="crlast" type="text" class="form-control" id="crlast" value="<? echo $row['rlast']; ?>" disabled> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Cédula:</label>
<input name="crnid" type="text" class="form-control" id="crnid" value="<? echo $row['rnid']; ?>" disabled> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Email:</label>
<input name="cremail" type="text" class="form-control" id="cremail" value="<? echo $row['remail']; ?>" disabled> 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Teléfono:</label>
<input name="crphone" type="text" class="form-control" id="crphone" value="<? echo $row['rphone']; ?>" disabled> 
</div>
</div>

</div>
<br>
</div>
</div>
<div class="row"></div> 
</div>
                                                                                            
                                        
											<div class="form-actions right" style=" margin-top:10px;">

												<div style="margin-right: 10px;">
												
												
											
                                              
                                              <a href="clients.php"><button type="button" class="btn grey" name="save" id="save" ><i class="fa fa-reply"></i> Regresar </button></a>
                                                    
											   
											    
											    </span>
											</div> 

										

										<!-- END FORM-->

									</div>

								</div>

							</div>
                    
                    <div class="">
						  <h3>LOG de actualizaciones</h3> 
						  
						  <? 
						   
						  $querylog = "select * from clientstimes where client = '$id'";
						  $resultlog = mysqli_query($con, $querylog);
						  $numlog = mysqli_num_rows($resultlog);
						  if($numlog > 0){
						  ?> 
						  
						  
						  <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">
									<th width="5%">TID</th>
									<th width="13%">Fecha y Hora</th>
									<th width="11%">Usuario</th>
								  </tr>
								</thead>

								<tbody>
                                <?php 
							  	while($rowlog=mysqli_fetch_array($resultlog)){
								$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$rowlog[userid]'")); 
								?>
                                <tr role="row" class="odd">
									<td class="sorting_1"><?php echo $rowlog['id']; ?></td>
									<td><? echo date('d-m-Y',strtotime($rowlog['today'])); ?> @<? echo date('h:i:s a', strtotime($rowlog['now2'])); ?></td>
									<td><? echo $rowcollaborator['first']." ".$rowcollaborator['last']; ?></td>
								</tr>
                                <?php } ?>
                                </tbody>
							</table>
						  <? }
						  else{ 
						  ?>
						  <div class="note note-regular">
						  NOTA: No se encontró ningún registro.
						  </div>
						  <? } ?>
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