<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('functions.php');
require('includes.php');
$requiredFiles = ['general']; 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = $con->prepare("select * from businessLines where id = ?");
$query->bind_param("i", $id);
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
<?php include("header.php"); ?>
<div class="clearfix"></div>
<div class="page-container">
	<?php include("side.php"); ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<h3 class="page-title">Líneas <small>Editor de líneas</small></h3>
					<ul class="page-breadcrumb breadcrumb">
					  <li>
							<i class="fa fa-home"></i>
							<a href="dashboard.php">Inicio</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="lines.php">Líneas</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>Editor de Líneas</li>

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

										<form action="lines-edit-code.php" method="post" enctype="multipart/form-data" class="horizontal-form">  

											<div class="form-body">

												<h3 class="form-section">Informacion de la línea</h3>

												<div class="row">

													

													<!--/span-->

													<div class="col-md-2">

													  <div class="form-group">

	<label class="control-label">Código:</label> 
	<input name="code" type="text" class="form-control" id="code" value="<?php echo $row['code']; ?>">
													  </div>


  
                                                      
                                                      </div>
													
													<div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Nombre de la línea:</label> 
	<input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>">
													  </div>


  
                                                      
                                                      </div>

												

												 <? /*<div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Notificar 1 Código | Nombre:</label>

						
											<select name="mailto" class="form-control  select2me" id="mailto" data-placeholder="Seleccionar..."> 

												<option value=""></option>
<?php $queryworkers = "select * from workers";
$resultworkers = mysqli_query($con, $queryworkers);
while($rowworkers=mysqli_fetch_array($resultworkers)){
?>
												<option value="<?php echo $rowworkers['code']; ?>" <? if($rowworkers['code'] == $row['mailto']) echo 'selected'; ?>><?php echo $rowworkers['code']." | ".$rowworkers['first']." ".$rowworkers['last']; ?></option>
                                                <?php } ?>

												

											</select>

																										  </div>

													</div>
                                                 <div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Notificar 2 Código | Nombre:</label>

						
											<select name="mailto2" class="form-control  select2me" id="mailto2" data-placeholder="Seleccionar..."> 

												<option value=""></option>
<?php $queryworkers = "select * from workers";
$resultworkers = mysqli_query($con, $queryworkers);
while($rowworkers=mysqli_fetch_array($resultworkers)){
?>
												<option value="<?php echo $rowworkers['code']; ?>" <? if($rowworkers['code'] == $row['mailto2']) echo 'selected'; ?>><?php echo $rowworkers['code']." | ".$rowworkers['first']." ".$rowworkers['last']; ?></option>
                                                <?php } ?>

												

											</select>

																										  </div>

													</div>
                                                 <div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Notificar 3 Código | Nombre:</label>

						
											<select name="mailto3" class="form-control  select2me" id="mailto3" data-placeholder="Seleccionar..."> 

												<option value=""></option>
<?php $queryworkers = "select * from workers";
$resultworkers = mysqli_query($con, $queryworkers);
while($rowworkers=mysqli_fetch_array($resultworkers)){
?>
												<option value="<?php echo $rowworkers['code']; ?>" <? if($rowworkers['code'] == $row['mailto3']) echo 'selected'; ?>><?php echo $rowworkers['code']." | ".$rowworkers['first']." ".$rowworkers['last']; ?></option>
                                                <?php } ?>

												

											</select>

																										  </div>

													</div>
                                                 <div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Notificar 4 Código | Nombre:</label>

						
											<select name="mailto4" class="form-control  select2me" id="mailto4" data-placeholder="Seleccionar..."> 

												<option value=""></option>
<?php $queryworkers = "select * from workers";
$resultworkers = mysqli_query($con, $queryworkers);
while($rowworkers=mysqli_fetch_array($resultworkers)){
?>
												<option value="<?php echo $rowworkers['code']; ?>" <? if($rowworkers['code'] == $row['mailto4']) echo 'selected'; ?>><?php echo $rowworkers['code']." | ".$rowworkers['first']." ".$rowworkers['last']; ?></option>
                                                <?php } ?>

												

											</select>

																										  </div>

													</div>
                                                 <div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Notificar 5 Código | Nombre:</label>

						
											<select name="mailto5" class="form-control  select2me" id="mailto5" data-placeholder="Seleccionar..."> 

												<option value=""></option>
<?php $queryworkers = "select * from workers";
$resultworkers = mysqli_query($con, $queryworkers);
while($rowworkers=mysqli_fetch_array($resultworkers)){
?>
												<option value="<?php echo $rowworkers['code']; ?>" <? if($rowworkers['code'] == $row['mailto5']) echo 'selected'; ?>><?php echo $rowworkers['code']." | ".$rowworkers['first']." ".$rowworkers['last']; ?></option>
                                                <?php } ?>

												

											</select>

																										  </div>

													</div>*/ ?>
                                                  

													<!--/span-->

												</div>
                                                
                                             
                                                
                
                                                            
                                                            
                                                            
                                                
                                                <div class="row">

													

													<!--/span-->
													
													<? /*

													<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Unidades de Negocio:</label> 
	
    <table width="100%">
                    <?php  
     $numcolumnas = 8;  
     $consulta = mysqli_query($con, "SELECT * FROM units where code > '0' order by right(code,2), code asc");  
     $total_resultados = mysqli_num_rows($consulta);  
     
	 if ($total_resultados>0) {  
     echo "<tr><td colspan=\"$numcolumnas\"></td></tr>";  
     $i = 1;  
     
	  while($fila = mysqli_fetch_array($consulta)){  
  
  $check = "";
  $units = ($row['units']); 
  $aunits = explode(", ", $units); 
  foreach($aunits as $b){   
  if ($b ==  $fila['code']) $check = "checked";
  
  $disable = "";
  $style = "";
  $queryinner = "select * from blines where units like '%$fila[code]%' and id != '$_GET[id]'";
  $resultinner = mysqli_query($con, $queryinner);
  $numinner = mysqli_num_rows($resultinner);
  if($numinner > 0){
	  $disable = 'disabled="disabled"';
	  $style = 'style="color:red;"'; 
  }
  
   }
  $resto = ($i % $numcolumnas);  
    if($resto == 1){ 
	//si es el primer elemento creamos una nueva fila 
    echo "<tr>";   
     }  
    echo '<td '.$style.'>  <input name="ckunits[]" type="checkbox" id="ckunits[]" value="'. $fila['code'] .'" '. $check .' '.$disable.'>'.$fila['code']."</td>"; 
	//mostramos el valor del campo especificado  
     if($resto == 0){
		 //cerramos la fila 
     echo "</tr>";  
     }  
     $i++;  
     }  
    if($resto != 0){
		//Si en la &uacute;ltima fila sobran columnas, creamos celdas vac&iacute;as  
     for ($j = 0; $j < ($numcolumnas - $resto); $j++){  
     echo "<td></td>";  
     }  
     echo "</tr>";  
     }  
    }else{  
     echo "<tr><td>0 elementos encontrados</td></tr> ";  
     } 
	  
     ?> 
                  </table>
     
													  </div>

													</div>
													
													*/ ?>
													<!--/span-->

												</div>
                                                <div class="row">

													

													<!--/span-->

													

													<!--/span-->

												</div>

												<!--/row--><!--/row-->

												

												<!--/row-->

												<div class="row"></div>

										    <!--/row--></div>

											<div class="form-actions right">

												<a href="lines.php"><button type="button" class="btn default" >Cancelar</button></a>
                                             	<button type="submit" class="btn blue" name="update"><i class="fa fa-check"></i> Guardar y regresar</button>
                                                <button type="submit" class="btn blue" name="save"><i class="fa fa-check" ></i> Guardar y salir</button>
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
<?php include('foot.php'); ?>