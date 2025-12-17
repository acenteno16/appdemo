<?php include("session-provision.php");

$id = $_GET['id'];
$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

switch($row['status']){ 
	case 1:
	?><script> alert('Este pago no ha sido aprobado.'); window.location = 'provision.php'; </script><?php break;
	case 2:
	if($row['approved'] == 0){ ?><script> alert('Este pago se ecuentra en la ruta de aprobacion.'); window.location = 'provision.php'; </script><?php } 
	break;
	case 3:
	if($row['approved'] == 0){ ?><script> alert('Este pago se ecuentra en la ruta de aprobacion.'); window.location = 'provision.php'; </script><?php } 
	break;
	case 4:
	if($row['approved'] == 0){ ?><script> alert('Este pago se ecuentra en la ruta de aprobacion.'); window.location = 'provision.php'; </script><?php } 
	break;
	case 5:
	?><script> alert('Este pago fue rechazado en la etapa 1.'); window.location = 'provision.php'; </script><?php break;
	case 6:
	?><script> alert('Este pago fue rechazado en la etapa 2.'); window.location = 'provision.php'; </script><?php break;
	case 7:
	?><script> alert('Este pago fue rechazado en la etapa 3.'); window.location = 'provision.php'; </script><?php break;
	case 8:
	?><script> alert('Este pago ya fue provisionado.'); window.location = 'provision.php'; </script><?php break;
	
}

$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
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

<link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>

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

							<a href="payments.php">Pagos</a>
                            
                            <i class="fa fa-angle-right"></i>
                            
                            </li>
                            

						<li>

							<a>Aprobación de pagos</a>

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

										<form action="provision-view-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">

											<div class="form-body">

												<h3 class="form-section">Información del Proveedor</h3>

												<div class="row"><!--/span-->

													<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

						
										
											  <input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $rowprovider['code']." | ".$rowprovider['name']; ?>" readonly>
								
															<div title="Page 5">
															  <div>
															    <div></div>
														      </div>
													    </div>
													  </div>

													</div>

													<!--/span-->

												</div>

												<!--/row--><!--/row-->
		<h3 class="form-section">Concepto de Pago</h3>
        
												<div class="row">
                                                
                                                    <div class="col-md-12 ">
													  <div class="form-group">
														<label>Descripción:</label>
                                                        <p>
                                                          <textarea name="description2" rows="2" readonly class="form-control" id="description"><?php echo $row['description']; ?></textarea>
                                                        </p>
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                     <?php $querybills = "select * from bills where payment = '$_GET[id]'";
$resultbills = mysqli_query($con, $querybills);
while($rowbills=mysqli_fetch_array($resultbills)){
													  
$rowtype = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$rowbills[type]'"));
$rowconcept = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$rowbills[concept]'"));
$rowconcept2 = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$rowbills[concept2]'"));

?>
                                                   
 		    
                                         						
                                                
<div class="col-md-4 ">
													  <div class="form-group">
														<label>Tipo de pago:</label>
                                                        <input name="bill" type="text" class="form-control" id="bill" value="<?php echo $rowtype['name']; ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<div class="col-md-4">

													  <div class="form-group">

															<label class="control-label">Concepto:</label>

<input name="bill3" type="text" class="form-control" id="bill3" value="<?php echo $rowconcept['name']; ?>" readonly>
													  </div>
                                                        <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>

													</div>
<div class="col-md-4">

													<div class="form-group">

											 				<label class="control-label">Sub Categoría:</label>
											 				<input name="bill4" type="text" class="form-control" id="bill4" value="<?php echo $rowconcept2['name']; ?>" readonly>
													</div> 
                                                      <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>

												  </div>                                            
                                           
                                          
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Factura No:</label>
                                                        
                                                        <input name="bill6" type="text" class="form-control" id="bill6" value="<?php echo $rowbills['number']; ?>" readonly>
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="ammount" type="text" class="form-control" id="ammount" onChange="javascript:reloadNumbers(this.value);" value="<?php echo str_replace('.00','',number_format($rowbills['ammount'])); ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                            <div class="col-md-3 ">
													  <div class="form-group">
														<label>Cantidad en letras:</label> 
                                                        <input name="letters" type="text" class="form-control" id="letters" value="<?php echo $rowbills['letters'];  ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                                 <div class="col-md-2 ">
													  <div class="form-group">
														<label>Sub-total:</label>
                                                        <input name="stotal[]" type="text" class="form-control" id="stotal[]" value="<?php if($rowbills['stotal'] == 0.00) echo 'n/a'; else echo $rowbills['stotal']; ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>IVA:</label>
                                                        <input name="tax[]" type="text" class="form-control" id="tax[]" value="<?php if($rowbills['tax'] == '0.00') echo 'n/a'; else echo $rowbills['tax']; ?>" readonly>
						
                                                          
                                                        
                                                        <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-1 ">
													  <div class="form-group">
														<label>Exento:</label>
                                                        <div class="checker" id="uniform-exempt[]"><span <?php if($rowbills['tax'] == 0.00){ echo 'class="checked"'; } ?>><input name="exempt[]" type="checkbox" id="exempt[]" readonly ></span></div> 
                                                         
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    
                                                  
     <?php $totalbills += $rowbills['ammount'];
	 $totaltax += $rowbills['tax']; 
	 if($rowbills['stotal'] == 0.00){
		 $totalstotal += $rowbills['ammount']; 
	 }else{
		 $totalstotal += $rowbills['stotal'];
	 }
	 } ?>  
     </div>
     <div class="row">
     <div class="col-md-2 ">
													  <div class="form-group">
														<label>Sub-total Factura(s):</label>
                                                        <input name="stotalbill" type="text" class="form-control" id="stotalbill" value="<?php echo $totalstotal; ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>IVA Factura(s):</label>
                                                        <input name="totaltax" type="text" class="form-control" id="totaltax" value="<?php echo $totaltax; ?>" readonly> 
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
     <div class="col-md-2 ">
													  <div class="form-group">
														<label>Total facturas:</label>
														<input name="totalbills" type="text" class="form-control" id="totalbills" value="<?php echo str_replace('.00','',number_format($totalbills)); ?>" readonly>
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                             
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Moneda:</label>
														<input name="bill2" type="text" class="form-control" id="bill2" value="<?php echo $rowcurrency['name']; ?>" readonly>
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>

                                                    
                                                    
         </div>      
                                                    <h3 class="form-section">Retenciones</h3>
                                                    	<div class="row">
                                                    
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														<label>% Alcaldía:</label>
                                                        <input name="retention1" type="text" class="form-control" id="retention1" placeholder="%" value="<?php echo $row['ret1']."%"; ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														
           <label>Monto Alcaldía</label>                                             <input name="retention1ammount" type="text" class="form-control" id="retention1ammount" placeholder="Monto" value="<?php echo str_replace('.00','',number_format($row['ret1a'])); ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>                                                 
                                                    <div class="col-md-3 ">
													  <div class="form-group">
														<label>% IR:</label>
                                                        <input name="retention2" type="text" class="form-control" id="retention2" value="<?php echo $row['ret2']."%"; ?>" readonly>
						
                                                          
                       <br> 

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-3 ">
													  <div class="form-group">
			    <label>Monto IR:</label>											
                                                        <input name="retention2ammount" type="text" class="form-control" id="retention2ammount" placeholder="Monto" value="<?php echo str_replace('.00','',number_format($row['ret2a'])); ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                                    

													<!--/span-->

												</div>
                                                  <h3 class="form-section">Pago a Proveedor</h3>
                                                  
                                              <div class="row"><!--/span-->
                                                <div class="col-md-3 ">
													  <div class="form-group">
			    <label>Monto a Pagar</label>
			    :											
                                                        <input name="payment" type="text" class="form-control" id="payment" placeholder="Calculo automático" value="<?php echo str_replace('.00','',number_format($row['payment'], 2))." ".$rowcurrency['name']; ?>" readonly>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
												</div>  
                                                  </div>
                                                  
                                                       <h3 class="form-section"><a id="files"></a>Archivos</h3>
                                                  
                                                  <div class="row"><!--/span--> 
                                              <?php $query2 = "select * from files where payment = '$id'";
											  $result2 = mysqli_query($con, $query2);
											  while($row2=mysqli_fetch_array($result2)){
											  ?>
           
                                                    
                                                     <div class="col-md-5 ">
													  <div class="form-group">
										        <input name="file[]" type="text" class="form-control" id="file[]"  placeholder="Ej: http://www.ejemplo.com" value="<?php echo $row2['link']; ?>" readonly><br><div class="row"></div></div></div> 
                                                        <div class="col-md-5 ">
													  <div class="form-group">
													    <input name="filename[]" type="text" class="form-control" id="filename[]"  placeholder="Ej: Factura" value="<?php echo $row2['name']; ?>" readonly>
						
                                                          
                       <br>
                       
                     

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 
                                                     
                                                                                       <div class="col-md-2 ">
                             <a href="<?php echo $row2['link']; ?>" class="btn blue" target="new">
											<i class="fa fa-file-o"></i> &nbsp;Abrir</a>
                                                                                                      </div>
                                                    <?php } ?>
                                              </div>
                                              
                                              <h3 class="form-section"><a id="status"></a>Estado</h3>
                                              <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 ID</th>

									<th width="15%">

										 Fecha</th>

									<th width="15%">

										 Hora</th>

									<th width="10%">Acción</th>

									<th width="10%">

										 Por Usuario

									</th>

									<th width="10%">

										 Vencimineto</th>
	<th width="10%">

										 Restantes</th>
								
                                  

								  </tr>

								</thead>

								<tbody>
                               <?php $querystatus = "select * from times where payment = '$_GET[id]' order by id asc";
											  $resultstatus = mysqli_query($con, $querystatus);
											  $i=0;
											  while($rowstatus=mysqli_fetch_array($resultstatus)){
											if($i == 0){
												$day1 = $rowstatus['today'];
											}
											$i++;
											  ?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowstatus['id']; ?></td><td><?php echo $rowstatus['today']; ?></td><td><?php echo date('h:i:s a', strtotime($rowstatus['now2'])); ?></td>
                                <td><?php $querystage = "select * from stages where id = '$rowstatus[stage]'";
								$resultstage = mysqli_query($con, $querystage);
								$rowstage = mysqli_fetch_array($resultstage);
								echo $rowstage['content'];
								 ?></td>
                                <td><?php $queryuser = "select * from workers where code = '$rowstatus[userid]'"; 
								$resultuser = mysqli_query($con, $queryuser);
								$rowuser = mysqli_fetch_array($resultuser);
								echo $rowuser['first']." ".$rowuser['last']; 
								if($rowstage['id'] == 1){
									$userunit = $rowuser['unit']; 
								}
								?></td>
                                <td>
								<?php echo $rowprovider['term']." días"; ?>
							</td>
                               <td>
								<?php $day2 = strtotime('+'.$rowprovider['term'].' day',strtotime($day1));
							    $day2 = date('Y-m-d',$day2);
								
								$days = (strtotime(date('Y-m-d'))-strtotime($day1))/86400;
								
								$leftdays = $rowprovider['term']-$days;

								if($leftdays <= 0){
									echo "Pago vencido";
								}else{
									echo $leftdays." días";
								}
								 
								?>
							</td>
                                                            </tr>
                                <?php }  ?>
                                
                               
                                </tbody>

								</table>
                                              
                                          <h3 class="form-section">Opciones</h3>
  <div id="ddistribucion0">

  <div id="ddistribucion1">
  <a href="javascript:distribuirPago0(1);" class="btn btn-xs default btn-editable"><i class="fa fa-retweet"></i> Distribución Automatica</a>
   <a href="javascript:distribuirPago(1);" class="btn btn-xs default btn-editable"><i class="fa fa-retweet"></i> Distribuir Manualmente</a> <a href="javascript:distribuirPago2(1);" class="btn btn-xs default btn-editable"><i class="fa fa-retweet"></i> Distribuir con plantilla</a></div>
   
   
    
  <div id="ddistribucion2" style="display:none;">
   <a href="javascript:distribuirPago(2);" class="btn btn-xs default btn-editable"><i class="fa fa-retweet"></i> No Distribuir</a> 
   </div> 
   
   <div id="ddistribucion4" style="display:none;">
   <a href="javascript:distribuirPago2(2);" class="btn btn-xs default btn-editable"><i class="fa fa-retweet"></i> No Distribuir</a> 
   </div>   <br>
<br>
                                       

<div id="ddistribucion6">
<?php $queryaccountmaker = "select *, sum(ammount) from bills where payment = '$_GET[id]' group by concept";  
$resultaccountmaker = mysqli_query($con, $queryaccountmaker);
while($rowaccountmaker=mysqli_fetch_array($resultaccountmaker)){
	
	//$type = 0;
	$conceptid = $rowaccountmaker['type'];
	$queryconcept = "select * from categories where id = '$conceptid'";
	$resultconcept = mysqli_query($con, $queryconcept);
	$rowconcept = mysqli_fetch_array($resultconcept);
	$conceptaccount = $rowconcept['account'];
	
	$concept1id = $rowaccountmaker['concept'];
	$queryconcept1 = "select * from categories where id = '$concept1id'";
	$resultconcept1 = mysqli_query($con, $queryconcept1);
	$rowconcept1 = mysqli_fetch_array($resultconcept1);
	$concept1account = $rowconcept1['account'];
	
	$concept2id = $rowaccountmaker['concept2'];
	$queryconcept2 = "select * from categories where id = '$concept2id'";
	$resultconcept2 = mysqli_query($con, $queryconcept2);
	$rowconcept2 = mysqli_fetch_array($resultconcept2);
	$concept2account = $rowconcept2['account'];
	
		
	$generalaccount = $conceptaccount.".".$concept1account;
	
?>
<div class="row">
 
											
                                                        
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Unidad:</label>
                                                        <input name="unit[]" type="text" class="form-control" id="unit[]" value="<?php echo $userunit; ?>" readonly>
						
           </div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Cuenta:</label> 
                                                        <input name="accounts[]" type="text" class="form-control" id="accounts[]" value="<?php echo $generalaccount; ?>" readonly>
						
           </div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Porcentaje:</label>
                                                        <input name="percent[]" type="text" class="form-control" id="percent[]" onKeyUp="javascript:calculateTotal1();" value="NA" readonly>
                                                        
			<script>
			function calculateTotal1(){ 
			i=0;
for (var obj in document.getElementsByName('percent[]')){
 if (i<document.getElementsByName('percent[]').length){
thepercent = document.getElementsByName('percent[]')[i].value;
thetotal1 = thepercent/100;
thetotal = <?php echo $row['payment']; ?>*thetotal1;
document.getElementsByName('total[]')[i].value = thetotal.toFixed(2);

  }
  i++;
}
			}
			</script>			
             </div>
													</div> 
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="total[]" type="text" class="form-control" id="total[]" value="<?php $ammount2pay =  $rowaccountmaker['sum(ammount)'];
if($ammount2pay >= 1000){
	
	if(($row['exempt'] == 1) and ($row['ret1a'] > 0)){
		$ammount2pay = $ammount2pay-($ammount2pay*($row['ret1']/100));
	}else{
		$ammount2paytax = $ammount2pay*0.15;
		$ammount2payr1 = $ammount2pay*($row['ret1']/100);
		$ammount2payr2 = $ammount2pay*($row['ret2']/100);
		$ammount2pay = $ammount2pay-$ammount2payr1-$ammount2payr2;
		
	}
	
}else{ //Si el pago es menos a NIO C$1,000
	
	$ammount2pay =  $ammount2pay;

}

echo str_replace('.00','',number_format($ammount2pay,2));

 ?>" readonly>
						
                                                          
               </div>
													</div> 
                                                   
                                                    </div>
<?php } ?>
</div>
        
<div id="ddistribucion3" style="display:none;">                                        									<div class="row">
 
 <?php $account = "";
 
 if($rowconcept2['account'] != ""){
		$account = $rowconcept2['account'];
	}else{
		if($rowconcept['account'] != ""){
			$account = $rowconcept['account'];
		}else{
			if($rowtype['account'] != ""){
				$account = $rowtype['account'];
			}
		}
	}
														?>
                                                        
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Unidad:</label>
                                                        <input name="unit[]" type="text" class="form-control" id="unit[]" value="">
						
           </div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Cuenta:</label> 
                                                        <input name="accounts[]" type="text" class="form-control" id="accounts[]" value="<?php if($account != ""){ echo $account; } ?>" <?php if($account != ""){ echo 'disabled'; } ?>>
						
           </div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Porcentaje:</label>
                                                        <input name="percent[]" type="text" class="form-control" id="percent[]" value="" onKeyUp="javascript:calculateTotal1();">
                                                        
			<script>
			function calculateTotal1(){ 
			i=0;
for (var obj in document.getElementsByName('percent[]')){
 if (i<document.getElementsByName('percent[]').length){
	 
thepercent = document.getElementsByName('percent[]')[i].value;
thetotal1 = thepercent/100;
thetotal = <?php echo $row['payment']; ?>*thetotal1;
document.getElementsByName('total[]')[i].value = thetotal.toFixed(2);

  }
  i++;
}
			}
			</script>			
             </div>
													</div> <div class="col-md-2 ">
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="total[]" type="text" class="form-control" id="total[]" value="" readonly>
						
                                                          
               </div>
													</div> 
                                                   <div class="col-md-2 "> 
                                                    <div class="form-group">
                                                   		<label>&nbsp;</label><br>
                                                        <button type="button" class="btn red" onClick="javascript:deleteRow(1);">-</button>  </div>
                                                        </div>
                                                    </div>
                                                   
                                                    <div id="distributionwaiter">
                                                    </div>
                                                    <div class="col-md-1 ">
 <button type="button" class="btn blue" onClick="addDistribution();">+</button>
 <br><br>&nbsp;
 </div>                                          
        </div>

<div id="ddistribucion5" style="display:none;">                                        									<div class="row">
 
 
<div class="col-md-4 ">
													  <div class="form-group">
														<label>Plantilla:</label>
														<select name="template" class="form-control" id="template" onChange="javascript:reloadtemplate(this.value);">
														  <option value="0">Seleccionar</option>
   <?php $querytemplate = "select * from templates";
   $resulttemplate = mysqli_query($con, $querytemplate);
   while($rowtemplate=mysqli_fetch_array($resulttemplate)){
   ?>                                                      <option value="<?php echo $rowtemplate['id']; ?>"><?php echo $rowtemplate['name']; ?></option>
                                                         <?php } ?>
													    </select>
														<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div> <div class="col-md-8 " id="templateinfo">
                                                    <p>Distribucion de la plantilla: </p>
                                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">Unidad</th>

									<th width="12%">

										Cuenta</th>

									<th width="12%">

										 Porcentaje</th>
                                         <th width="12%">

										 Total</th>

					
								
                                  

								  </tr>

								</thead>

								<tbody>
                                                               
                                <tr role="row" class="odd">
                                <td colspan="4">Esperando que seleccione una plantilla</td></tr></tbody></table>
                                                    </div>
  </div>
                                                   
                                                    <div id="distribution4waiter">
                                                    </div>
                                                                                              
        </div>         
        
<script type="text/javascript">
function reloadtemplate(id){	

	$.post("reload-template.php", { variable: id, variable2: '<?php echo $row['payment']; ?>' }, function(data){ 
		$("#templateinfo").html(data);		
});			
}

var distributioni = 1;


function addDistribution(){
	document.getElementsByName('accounts[]')[0].disabled = true;
	var account = document.getElementsByName('accounts[]')[0].value; 
	
   var distributionboxadd = '<div class="row" id="distribution'+distributioni+'"><div class="col-md-2 "><div class="form-group"><input name="unit[]" type="text" class="form-control" id="unit[]" value=""></div></div><div class="col-md-2 "><div class="form-group"><input name="accounts[]" type="text" class="form-control" id="accounts[]" value="<?php if($account != ""){ echo $account; }else{ ?>'+account+'<?php }?>" disabled></div></div><div class="col-md-2 "><div class="form-group"><input name="percent[]" type="text" class="form-control" id="percent[]" value=""  onKeyUp="javascript:calculateTotal1();"></div></div> <div class="col-md-2 "><div class="form-group"><input name="total[]" type="text" class="form-control" id="total[]" value="" readonly></div></div> <div class="col-md-2 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+distributioni+');">-</button></div></div></div>';
     distributioni++; 
	 $("#distributionwaiter").append(distributionboxadd);
	
  
}
</script>  
                                                   <script>
function deleteRow(id){
	//document.getElementById("distribution"+id).style.display = 'none';
	var node = document.getElementById("distribution"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}

	
}
function distribuirPago(onoff){
	if(onoff == 1){
	document.getElementById("ddistribucion1").style.display = 'none';
	document.getElementById("ddistribucion6").style.display = 'none';
	document.getElementById("ddistribucion2").style.display = 'block';
	document.getElementById("ddistribucion3").style.display = 'block';
	document.getElementById("distributiontype").value = 1;
	
	}
	if(onoff == 2){
	document.getElementById("ddistribucion1").style.display = 'block';
	document.getElementById("ddistribucion6").style.display = 'none';
	document.getElementById("ddistribucion2").style.display = 'none';
	document.getElementById("ddistribucion3").style.display = 'none';
	document.getElementById("distributiontype").value = 0;
	
	
	i=0;
for (var obj in document.getElementsByName('unit[]')){
 if (i<document.getElementsByName('unit[]').length){
	 document.getElementsByName('unit[]')[i].value = '';
	 document.getElementsByName('percent[]')[i].value = '';
	 document.getElementsByName('total[]')[i].value = '';
	 document.getElementsByName('accounts[]')[i].value = '';
}
  i++;
}


	
	}
		
}





function distribuirPago0(onoff){
	if(onoff == 1){
	document.getElementById("ddistribucion1").style.display = 'none';
	document.getElementById("ddistribucion6").style.display = 'none';
	document.getElementById("ddistribucion4").style.display = 'block';
	document.getElementById("ddistribucion5").style.display = 'block';
	document.getElementById("distributiontype").value = 2;

	}
	if(onoff == 2){
	document.getElementById("ddistribucion1").style.display = 'block';
	document.getElementById("ddistribucion6").style.display = 'block';
	document.getElementById("ddistribucion4").style.display = 'none';
	document.getElementById("ddistribucion5").style.display = 'none';
	document.getElementById("template").value = 0;
	
	var datatable = '<div id="ddistribucion6"><?php $queryaccountmaker = "select *, sum(ammount) from bills where payment = '$_GET[id]' group by concept";  
$resultaccountmaker = mysqli_query($con, $queryaccountmaker);
while($rowaccountmaker=mysqli_fetch_array($resultaccountmaker)){
	
	//$type = 0;
	$conceptid = $rowaccountmaker['type'];
	$queryconcept = "select * from categories where id = '$conceptid'";
	$resultconcept = mysqli_query($con, $queryconcept);
	$rowconcept = mysqli_fetch_array($resultconcept);
	$conceptaccount = $rowconcept['account'];
	
	$concept1id = $rowaccountmaker['concept'];
	$queryconcept1 = "select * from categories where id = '$concept1id'";
	$resultconcept1 = mysqli_query($con, $queryconcept1);
	$rowconcept1 = mysqli_fetch_array($resultconcept1);
	$concept1account = $rowconcept1['account'];
	
	$concept2id = $rowaccountmaker['concept2'];
	$queryconcept2 = "select * from categories where id = '$concept2id'";
	$resultconcept2 = mysqli_query($con, $queryconcept2);
	$rowconcept2 = mysqli_fetch_array($resultconcept2);
	$concept2account = $rowconcept2['account'];
	
		
	$generalaccount = $conceptaccount.".".$concept1account;
	
?><div class="row"><div class="col-md-2 "><div class="form-group"><label>Unidad:</label><input name="unit[]" type="text" class="form-control" id="unit[]" value="<?php echo $userunit; ?>" readonly></div></div><div class="col-md-2 "><div class="form-group"><label>Cuenta:</label><input name="accounts[]" type="text" class="form-control" id="accounts[]" value="<?php echo $generalaccount; ?>" readonly></div></div><div class="col-md-2 "><div class="form-group"><label>Porcentaje:</label><input name="percent[]" type="text" class="form-control" id="percent[]" onKeyUp="javascript:calculateTotal1();" value="NA" readonly></div></div><div class="col-md-2 "><div class="form-group"><label>Total:</label><input name="total[]" type="text" class="form-control" id="total[]" value="<?php $ammount2pay =  $rowaccountmaker['sum(ammount)'];
if($ammount2pay >= 1000){
	
	if(($row['exempt'] == 1) and ($row['ret1a'] > 0)){
		$ammount2pay = $ammount2pay-($ammount2pay*($row['ret1']/100));
	}else{
		$ammount2paytax = $ammount2pay*0.15;
		$ammount2payr1 = $ammount2pay*($row['ret1']/100);
		$ammount2payr2 = $ammount2pay*($row['ret2']/100);
		$ammount2pay = $ammount2pay-$ammount2payr1-$ammount2payr2;
		
	}
	
}else{ //Si el pago es menos a NIO C$1,000
	
	$ammount2pay =  $ammount2pay;

}

echo str_replace('.00','',number_format($ammount2pay,2));

 ?>" readonly></div></div></div><?php } ?></div>';
$("#templateinfo").html(datatable);
document.getElementById("distributiontype").value = 0;
	

	}







function distribuirPago2(onoff){
	if(onoff == 1){
	document.getElementById("ddistribucion1").style.display = 'none';
	document.getElementById("ddistribucion6").style.display = 'none';
	document.getElementById("ddistribucion4").style.display = 'block';
	document.getElementById("ddistribucion5").style.display = 'block';
	document.getElementById("distributiontype").value = 2;

	}
	if(onoff == 2){
	document.getElementById("ddistribucion1").style.display = 'block';
	document.getElementById("ddistribucion6").style.display = 'block';
	document.getElementById("ddistribucion4").style.display = 'none';
	document.getElementById("ddistribucion5").style.display = 'none';
	document.getElementById("template").value = 0;
	var datatable = '<p>Distribucion de la plantilla:</p><table class="table table-striped table-bordered table-hover" id="datatable_orders"><thead><tr role="row" class="heading"><th width="5%">Unidad</th><th width="12%">Cuenta</th><th width="12%">Porcentaje</th><th width="12%">Total</th></tr></thead><tbody><tr role="row" class="odd"><td colspan="4">Esperando que seleccione una plantilla</td></tr></tbody></table>';
$("#templateinfo").html(datatable);
document.getElementById("distributiontype").value = 0;
	

	}
		
}
</script>
 <?php //ACTIONS ?>                                                   
 

 <div class="row">
<div class="col-md-12"> 

<div class="form-group">
										<label><h4>Tipo de pago:</h4></label>
										<div class="radio-list">
											<label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2"><input type="radio" name="ptype" id="optionsRadios4" value="1" checked=""></span></div> 
										 Transferencia electrónica</label>
											<label class="radio-inline">
											<div class="radio1" ><span><input type="radio" name="ptype" id="optionsRadios5" value="2"></span></div> 
											Cheque </label>
                                            <label class="radio-inline"> 
											<div class="radio1" ><span><input type="radio" name="ptype" id="optionsRadios5" value="3"></span></div> 
											Tarjeta de crédito </label>
                                            <label class="radio-inline">
											<div class="radio1" ><span><input type="radio" name="ptype" id="optionsRadios5" value="4"></span></div> 
											Telepagos </label>
                                            <label class="radio-inline">
											<div class="radio1" ><span><input type="radio" name="ptype" id="optionsRadios5" value="5"></span></div> 
											Internet Banking  </label>                                            
											
										</div>
									</div> </div> </div>
                                    
                                    <div class="row">
                                    <br><br><br>
                                    </div>
                                    
                                     <div class="row">
                                    <div class="col-md-2 ">
									  <div class="form-group">
			    <label>No. Batch:</label>
			    											
                                        <input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value="">
						
                                                          
              </div>
												</div><div class="col-md-3 ">
												  <div class="form-group">
			    <label>Link del Batch:</label>
			    											
                                                    <input name="linkbatch[]" type="text" class="form-control" id="linkbatch[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
                                                 <div class="col-md-2 ">
									  <div class="form-group">
			    <label>No. Documento:</label>
			    											
                                        <input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value="">
						
                                                          
              </div>
												</div><div class="col-md-3 ">
												  <div class="form-group">
			    <label>Link del Documento:</label>
			    											
                                                    <input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
                                    
 
 </div>
 <?php /*since ?>
 <div class="row">
                                    <div class="col-md-2 ">
									  <div class="form-group">
			  
			    											
                                        <input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value="">
						
                                                          
              </div>
												</div><div class="col-md-3 ">
												  <div class="form-group">
			   
			    											
                                                    <input name="linkbatch[]" type="text" class="form-control" id="linkbatch[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
                                                 <div class="col-md-2 ">
									  <div class="form-group">
			   
			    											
                                        <input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value="">
						
                                                          
              </div>
												</div><div class="col-md-3 ">
												  <div class="form-group">
			  
			    											
                                                    <input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value="">
						
                                                          
              </div>
												</div> <div class="col-md-2 "> 
                                                    <div class="form-group">
                                                <button type="button" class="btn red" onclick="javascript:deleteRow(1);">-</button>  </div>
                                                        </div>
                                    
 
 </div> 
 <?php end*/?>
  <div id="batchwaiter">
                                                    </div>
                                                    <div class="col-md-1 ">
 <button type="button" class="btn blue" onClick="addBatch();">+</button>
 <br><br>&nbsp;</div>
 
  
   <script type="text/javascript">
var noBatch = 1;
function addBatch(){
   var newBatch = '<div class="row" id="batch'+noBatch+'"><div class="col-md-2 "><div class="form-group"><input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value=""></div></div><div class="col-md-3 "><div class="form-group"><input name="linkbatch[]" type="text" class="form-control" id="linkbatch[]" placeholder="" value=""></div></div><div class="col-md-2 "><div class="form-group"><input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value=""></div></div><div class="col-md-3 "><div class="form-group"><input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value=""></div></div><div class="col-md-2 "><div class="form-group"><button type="button" class="btn red" onclick="javascript:deleteRowBatch('+noBatch+');">-</button></div></div></div>';
     noBatch++; 
	 $("#batchwaiter").append(newBatch);
  
}

function deleteRowBatch(id){
	//document.getElementById("distribution"+id).style.display = 'none';
	var node = document.getElementById("batch"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}
</script>  
  
  <div class="row">
                                                      
                                                    
  <div class="col-md-12 "><div class="form-actions right">

												

						    <button type="submit" class="btn blue"><i class="fa fa-check"></i> Provisionar</button> 
												<input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>">
                                                <input name="distributiontype" type="hidden" id="distributiontype" value="0">
  </div>
                                            </div>                                                   </div>
                                            
                                            
                                            
                                                  

											<!--/row--><!--/row--></div>


							

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

function validateForm(){
	var tptotal = 0;
	distribution = document.getElementById("ddistribucion3");
	if(distribution.style.display == 'block'){
		//alert('la capa esta visible');
		//return false;
		//desd aqui
		i=0;
for (var obj in document.getElementsByName('unit[]')){
 if (i<document.getElementsByName('unit[]').length){
varunit = document.getElementsByName('unit[]')[i].value;
if(varunit == ''){
	alert('El campo unidad no puede estar en blanco');
	document.getElementsByName('unit[]')[i].focus();
	return false;
}
percent = document.getElementsByName('percent[]')[i].value;
if(percent == ''){
	alert('El campo porcentaje no puede estar en blanco');
	document.getElementsByName('percent[]')[i].focus();
	return false;
}
total = document.getElementsByName('total[]')[i].value;
if(total == ''){
	alert('El campo total no puede estar en blanco');
	document.getElementsByName('total[]')[i].focus();
	return false;
}
accounts = document.getElementsByName('accounts[]')[i].value;
if(accounts == ''){
	alert('El campo cuenta no puede estar en blanco');
	document.getElementsByName('accounts[]')[i].focus();
	return false;
}
var tptotal = 0;
if((percent != 0) && (percent != '')){
tptotal += parseFloat(percent);  
}


  }
  i++; 
}
		//hasta aqui
		
		if(tptotal != 100){
	alert('La distribucion del pago debe de sumar 100%'.+tptotal);
	tptotal = 0;
	return false;
}

}


	
i=0;
for (var obj in document.getElementsByName('nobatch[]')){
 if (i<document.getElementsByName('nobatch[]').length){
varnobatch = document.getElementsByName('nobatch[]')[i].value;
if(varnobatch == ''){
	alert('El campo "no batch" no puede estar en blanco');
	document.getElementsByName('nobatch[]')[i].focus();
	return false;
}
varlinkbatch = document.getElementsByName('linkbatch[]')[i].value;
if(varlinkbatch == ''){
	alert('El campo "Link del batch" no puede estar en blanco');
	document.getElementsByName('linkbatch[]')[i].focus();
	return false;
}
if(!/http/.test(varlinkbatch)){
	alert('Asegurese de que el link cuente con el protocolo http:// o https://');
	document.getElementsByName('linkbatch[]')[i].focus();
	return false;
}
varnodocument = document.getElementsByName('nodocument[]')[i].value;
if(varnodocument == ''){
	alert('El campo "no documento" no puede estar en blanco');
	document.getElementsByName('nodocument[]')[i].focus();
	return false;
}
varlinkdocument = document.getElementsByName('linkdocument[]')[i].value;
if(varlinkdocument == ''){
	alert('El campo "Link del documento" no puede estar en blanco');
	document.getElementsByName('linkdocument[]')[i].focus();
	return false;
}
if(!/http/.test(varlinkdocument)){
	alert('Asegurese de que el link cuente con el protocolo http:// o https://');
	document.getElementsByName('linkdocument[]')[i].focus();
	return false;
}
  }
  i++;
}	
	
}
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html> 