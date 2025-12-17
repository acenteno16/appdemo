<?php 

require("session-schedule.php");
require('functions.php');

$id = isset($_GET['id']) ? sanitizeInput(intval($_GET['id']), $con) : 0;

$query = "select * from payments where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$querycurrency = "select * from currency where id = '$row[currency]'";
$resultcurrency = mysqli_query($con, $querycurrency);
$rowcurrency = mysqli_fetch_array($resultcurrency);


#$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
#$rowtype = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[type]'"));
#$rowconcept = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept]'"));
#$rowconcept2 = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept2]'"));
#$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
?>

<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en" >

<!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

<meta charset="utf-8"/>

<title>Aplicación de Pagos | Casa Pellas S.A.</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta content="width=device-width, initial-scale=1.0" name="viewport"/>

<meta content="" name="description"/>

<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>



<link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/select2/select2.css"/>

<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/clockface/css/clockface.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



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

			

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Pagos <small>Aprobación de pagos.</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="retentions-home.php">Retenciones</a>

							<i class="fa fa-angle-right"></i>

						</li>
						
						<li>

							<a href="retentions-forwarding.php">Reenvío de retenciones</a>

							<i class="fa fa-angle-right"></i>

						</li>


						<li>

							<a href="#">Enviar</a>

							

						</li>


					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">
                
                   <?php /*<div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

										

										</div>

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="tc-add-code.php" class="horizontal-form" method="post" enctype="multipart/form-data">

											<div class="form-body">

												<h3 class="form-section">Ingresar tipo de cambio</h3>

												<div class="row"><!--/span-->

												  <div class="col-md-6 ">
													  <div class="form-group">
														<label>Fecha:</label>
                                                        <input name="today" type="text" class="form-control form-control-inline date-picker" id="schedule[]" value="">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> <div class="col-md-6 ">
													  <div class="form-group">
														<label>TC:</label>
                                                        <input name="tc" type="text" class="form-control" id="tc" value="" onkeypress="return justNumbers(event);">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 

													<!--/span-->

												</div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

											<!--/row--><!--/row--></div>


											<div class="form-actions right">


												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar</button>

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div><br>*/ ?>
                                
                	<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

							Información de la solicitud

							</div>
                            

						</div>

						

					</div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <?php ///// table ?>
                         	<div class="tab-pane" id="tab_1">
<div class="row"><!--/span-->


													<div class="col-md-12">
                           <?php $queryprovider = "select * from providers where code = '$rowbills[provider]'";
	$resultprovider = mysqli_query($con, $queryprovider);
	$rowprovider = mysqli_fetch_array($resultprovider);
	$provider = $rowprovider['name'];
	
	$queryuser = "select * from workers where code = '$row[userid]'";
											$resultuser = mysqli_query($con, $queryuser);
											$rowuser = mysqli_fetch_array($resultuser);
											$queryunit = "select * from units where code = '$rowuser[unit]'";
											$resultunit = mysqli_query($con, $queryunit);
											$rowunit = mysqli_fetch_array($resultunit);
											?>
    
<div class="col-md-4">

													 <h3>Informacion del solicitante</h3>
                                                      <p><strong>Nombre:</strong> <?php echo $rowuser['first']." ".$rowuser['last']; ?><br>
                                                      <strong>Código:</strong> <?php echo $rowuser['code']; ?><br>
                                                      <strong>Unidad de Negocio:</strong> <?php echo $rowuser['unit']; ?> | <?php echo $rowunit['name']; ?>
</p>

													</div>

<div class="col-md-4">

<?php if($row['btype'] == 1){
	$beneficiarytype = "Proveedor";
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
	$beneficiaryname = $rowprovider['name'];
	$beneficiarycode = $rowprovider['code'];
	
}elseif($row['btype'] == 2){
	$beneficiarytype = "Colaborador";
	$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
	$beneficiaryname = $rowcollaborator['first'].' '.$rowcollaborator['last'];
	$beneficiarycode = $rowcollaborator['code'];
}

?><h3> Informacion del <?php echo $beneficiarytype; ?></h3>
                                                      <p><strong>Nombre:</strong> <?php echo $beneficiaryname; ?><br>
                                                      <strong>Código:</strong> <?php echo $beneficiarycode; ?><br>
                                                      
</p>

													</div>  
                                                    
<div class="col-md-4">

<h3>Total pagar</h3>

					<div class="dashboard-stat blue">

						<div class="visual">

							
						</div>

						<div class="details">

							<div class="number">
  							<?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($row['payment'],2)); ?>	
  							</div>

							<div class="desc"><?php echo $rowcurrency['name']; ?></div>

						</div>

					

					</div>
                    

				</div>
                                       
                                       <div class="row"></div>
                                       <div class="col-md-12"><p><strong>Descripción:</strong> <?php echo $row['description']; ?><br>
<strong>Comentarios del solicitante:</strong> <?php  echo $row['notes']; ?></p></div>
                                       
                                       
                                                    
                                                    <div class="col-md-12">
    
    <h3>Lista de Documentos</h3>
    
 	<div class="table-container">
                                
                                	<div class="table-scrollable"><table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="12%">Número de Documento</th>
                                         <th width="13%">Sub-total<br>
(que graba IVA):</th>
                                         <th width="13%">Sub-total<br>
(exento de IVA):</th>
                                         <th width="12%">Monto<br>
Alojamiento:</th>
                                         <th width="12%">Monto<br>
Intur:</th>
                                         <th width="12%">IVA:</th>
                                         <th width="12%">Total</th>

									<th width="12%">Exento</th>
                                    <th width="12%">TC</th>

									
                                     
                                  </tr>

								</thead>

								<tbody>

                                <?php $querybills = "select * from bills where payment = '$_GET[id]'";
$resultbills = mysqli_query($con, $querybills);
$sumtotd = 0;
while($rowbills=mysqli_fetch_array($resultbills)){
	
$querycurrency = "select * from currency where id = '$rowbills[currency]'";
$resultcurrency = mysqli_query($con, $querycurrency);
$rowcurrency = mysqli_fetch_array($resultcurrency);

?>

								
								
                                <tr role="row" class="odd">
                                  <td class="sorting_1"><?php echo $rowbills["number"]; ?></td><td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['stotal'],2)); echo ' '.$rowcurrency['name']; ?></td>
                                  <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['stotal2'], 2))." ".$rowcurrency['name']; ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['intur'],2))." ".$rowcurrency['name']; ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['inturammount'], 2))." ".$rowcurrency['name']; ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['tax'],2))." ".$rowcurrency['name']; ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['ammount'],2))." ".$rowcurrency['name'];  ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['exempt'],2))." ".$rowcurrency['name']; ?>
                                   
                                  </td>
                                  <td><?php if($rowbills['currency'] == 2){ echo $rowcurrency['symbol'].str_replace('.00','',$rowbills['tc']);
								  }else{
									  echo "N/A";
								  } ?>
                                   
                                  </td>
                                  
                                  </tr>
                                
                                
                                
                                
                                
                                
                                <?php  
								
								$sumtotd+=$rowbills['ammount'];
								} //while ?>
                                </tbody>

								</table>
                                </div></div>
    <p><strong>Total:</strong> <?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($sumtotd,2)).' '.$rowcurrency['name']; ?> </p>
    
    <?php
	if($row['distributable'] == 1){
$querydistribution = "select * from distribution where payment = '$_GET[id]' and preturn = '$row[preturn]'"; 
$resultdistribution = mysqli_query($con, $querydistribution);
$numdistribution = mysqli_num_rows($resultdistribution);      

?>
<h3>Distribución</h3>
<div class="row">
<div class="col-md-6 ">                                                   <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="33%">

										Unidad</th>

									<?php /*<th width="12%">

										Cuenta</th>*/ ?>

									<th width="33%">

										 Porcentaje</th>
<th width="33%">

										 Total</th>
				

								  </tr>

								</thead>

								<tbody>
                            <?php while($rowdistribution=mysqli_fetch_array($resultdistribution)){
								?>                               
                                <tr role="row" class="odd">
                                <td><?php echo $rowdistribution['unit']; ?></td>
                                 <?php /*<td><?php echo $rowdistribution['account']; ?></td>*/ ?>
                               <td><?php echo str_replace('.00','',$rowdistribution['percent']).'%'; ?></td>
                                <td><?php
								echo number_format($rowdistribution['total'], 2); ?></td>
                                </tr> 
                                <?php } ?>
                                </tbody></table>
                                </div>
</div>
                                <div class="row">&nbsp;</div>
<?php } else { ?>
	<p><strong>Distribuido 100% a la UN:</strong> <?php echo $row['route']; ?> </p>
	<?php } ?>
                                
    <?php if($row['acp'] == 1){ ?>
    <div class="row">
                                <div class="col-md-6">
                               <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="12%">% Alcaldía</th>
                                         <th width="13%">Monto Alcaldía</th>
                                         <th width="13%">% IR</th>
                                         <th width="12%">Monto IR:</th>
                                   

									
                                     
                                  </tr>

								</thead>

								<tbody>

                                <tr role="row" class="odd">
                                  <td class="sorting_1"><?php echo $row['ret1']; ?></td>
                                  <td><?php echo str_replace('.00','',number_format($row['ret1a'],2)); ?></td>
                                  <td><?php echo $row['ret2']; ?></td>
                                  <td><?php echo str_replace('.00','',number_format($row['ret2a'],2)); ?></td> 
                                  </tr>
                                  
                                
                         
                                </tbody>

								</table>
                                </div> 
                                <div class="col-md-6">
                                <div class="note note-danger">
                                <strong>Nota:</strong> Retenciones asumidas por Grupo Casa Pellas.
                                </div>
                                </div>
    </div>
    <?php } ?>
                                <? 
									
									if($row['ret2id'] > 0){ ?>
                                	<div class="row">
                                	<div class="col-md-12">
									<h3 class="form-section">Opciones</h3>
									<form action="retentions-forwarding-view-code.php" class="horizontal-form" method="get" enctype="multipart/form-data" id="myform">
                                                  
                                                    
 
  <div class="form-actions right" style="margin-left:0px;">
	  
	  <table> 
	  <tr>
		  <td> <input name="send_cancellation" type="checkbox" id="send_cancellation" title="Cancellation" value="1"></td>
		  <td> Cancelación</td>
	  </tr>
	  <tr>
		  <td><input name="send_retention" type="checkbox" id="send_retention" title="Retention" value="1"> </td>
		  <td> Retención</td>
	  </tr>
	
	  </table><br>
	  
	  <div class="row">
	  	<div class="col-md-3">
			<select name="ntype" id="ntype" class="form-control" onChange="showEmail(this.value);">
				<option value="1">Contacto configurado</option>
			  	<option value="2">A dirección de email</option>
			</select>
		</div>
		<div class="col-md-3" style="display: none;" id="emailDiv">
			<input type="text" class="form-control" name="theEmail" id="theEmail" placeholder="ejemplo@casapellas.com">  
		</div>  
	  </div>
	  <script>
	  function showEmail(){
		  var ntype = document.getElementById('ntype').value;
		  if(ntype == 2){
			  document.getElementById('emailDiv').style.display = 'block';
		  }else{
			  document.getElementById('emailDiv').style.display = 'none';
		  }
	  }
	  </script>
	         
<span id="dapprove"> <button type="submit" class="btn blue"><i class="fa fa-envelope"></i> Reenviar</button>  </span>
                            
                          
                            
												<input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>">
                                                
                                                <span class="form-actions right" style="margin-left:0px;">
                                                <input name="approve" type="hidden" id="approve" value="0"> 
                                                </span> 
  </div>

                                       </form>
									</div>
                           			</div>
                               	 	<div class="row"> 
                               	 		<div class="col-md-12">   
                            			<br><br>
										<?php //desde aqui ?>
										<h3>Retención</h3> 
                                    	<object data="eretention.php?id=<? echo $row['id']; ?>" type="application/pdf" width="95%" height="700px" style="border: 10px solid #21355d;"></object>
										</div> 
                                	</div>
									<? }else{ ?>
									<div class="row">
                                	<div class="col-md-12"><br><br>
										
										<div class="note note-danger"><p><strong>Nota:</strong> No existe una retención para esta solicitud. Las retenciones se crean en la etapa <strong>"Ingreso a Banco"</strong>. Si el pago no ha pasado por esta etapa debe de esperar que esta etapa se complete. si el pago ya está cancelado, ustede bede de generar una retencion manualmente.</p></div>
										
										
									<h3 class="form-section">Opciones</h3>
									<form action="retentions-forwarding-generate-code.php" class="horizontal-form" method="get" enctype="multipart/form-data" id="myform">
										<div class="form-actions right" style="margin-left:0px;"> 
											<table> 
	  <tr>
		  <td> <input name="gIr" type="checkbox" id="gIr" title="IR" value="1"></td>
		  <td> IR</td>
	  </tr>
	  <tr>
		  <td><input name="gImi" type="checkbox" id="gImi" title="IMI" value="1"> </td>
		  <td> IMI</td>
	  </tr>
	
	  </table><br><br>
											<span id="dapprove"> <button type="submit" class="btn blue"><i class="fa fa-file-pdf-o"></i> Generar retención manual</button>  </span>
											<input name="id" type="hidden" id="id" value="<?php echo $row['id']; ?>">
										</div>
									</form>
									</div>
                           			</div>
									<? } ?>
														
                                	<div></div>
								
							</div>
                      

</div></div>

</div>


							

						

							

					<?php //table } ?>		

							

							

					

					</div>

				</div>

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

<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->

<?php include("footer.php"); ?>

<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->
<script src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimeout.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimer.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script>

jQuery(document).ready(function() {    

   Metronic.init(); // init metronic core components

Layout.init(); // init current layout

QuickSidebar.init() // init quick sidebar



});

</script>

    
<script type="text/javascript">
  
		   function divShow(approve){
			 
		   	if(approve == 0){
				document.getElementById('approve').value = '1';
				document.forms["myform"].submit();
		   }
		   
		   if(approve == 1){
			   if(document.getElementById("cdiv").style.display == 'block'){
				   document.getElementById('approve').value = '2';
				   if(validateForm()){
					   
					   document.forms["myform"].submit();
				   }
				   
			   }else{
			   document.getElementById("cdiv").style.display = 'block';
			   document.getElementById("cancelreject").style.display = 'block';
			   document.getElementById("dapprove").style.display = 'none';
			   }
			   
			   
		   }
		   
		   if(approve == 2){
			   document.getElementById("cdiv").style.display = 'none';
			   document.getElementById("cancelreject").style.display = 'none';		document.getElementById("dapprove").style.display = 'block';
			   
		   }
		   	
		   
}


function validateForm(){
	
	var reason = document.getElementById("reason").value;
	var reason2 = document.getElementById("reason2").value;
	
	if((reason2 == '0') && (reason == '')){
		alert('Cuando rechaza una solicitud de pago con la opcion "Otro" debe de justificar con comentarios.');
		return false;
		}
		
	 
		else{
			return true;
		}
		
		
}
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html> 
<?php

function cleanLink($dirtyurl){ 

	$levels = explode('/', $dirtyurl);
	$levelsize = sizeof($levels);
	$levelsize = $levelsize-1;
	$cleanurl = $levels[$levelsize];
	$cleanurl = str_replace('visor.php?key=','',$cleanurl);
	
	return $cleanurl;
}

?>