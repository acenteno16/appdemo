<?php include("session-general.php");

$id = $_GET['id'];
$query = "select * from payments where id = '$id'"; 
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));

$rowtype = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[type]'"));

$rowconcept = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept]'"));
$rowconcept2 = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept2]'"));
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

x
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

					Pagos <small>Visor de Solicitud de Pago</small>

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

							<a>Solicitudes de pagos</a>

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

										<div class="caption">

										

										</div>

										<?php /*<div class="tools">

											<a href="javascript:;" class="collapse">

											</a>

											<a href="#portlet-config" data-toggle="modal" class="config">

											</a>

											<a href="javascript:;" class="reload">

											</a>

											<a href="javascript:;" class="remove">

											</a>

										</div>*/ ?>

									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="payment-order-code.php" class="horizontal-form" method="post" enctype="multipart/form-data">

											<div class="form-body">

												<h3 class="form-section">Información del Pago</h3>

												<div class="row"><!--/span-->

													<div class="col-md-2">

													  <div class="form-group">

	<label class="control-label">ID de Pago:</label>

						
										
											  <input name="bill5" type="text" class="form-control" id="bill5" value="<?php echo $row['id']; ?>" readonly>
								
															<div title="Page 5">
															  <div>
															    <div></div>
														      </div>
													    </div>
													  </div>

													</div>

													<!--/span-->

												</div>
                                                
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
        
												<div class="row"><div class="col-md-4 ">
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

													</div>

													<!--/span-->

												  <div class="col-md-4">

													<div class="form-group">

											 				<label class="control-label">Sub Categoria:</label>
											 				<input name="bill4" type="text" class="form-control" id="bill4" value="<?php echo $rowconcept2['name']; ?>" readonly>
													</div> 

												  </div>
                                                    <div class="col-md-12 ">
													  <div class="form-group">
														<label>Descripcion:</label>
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
													  ?>
                                                   
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Factura No:</label>
                                                        <input name="bill" type="text" class="form-control" id="bill" value="<?php echo $rowbills['number']; ?>" readonly> 
						
                                                          
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
														
           <label>Monto Alcaldía</label>                                             <input name="retention1ammount" type="text" class="form-control" id="retention1ammount" placeholder="Monto" value="<?php echo str_replace('.00','',$row['ret1a']); ?>" readonly>
						
                                                          
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
                                                        <input name="retention2ammount" type="text" class="form-control" id="retention2ammount" placeholder="Monto" value="<?php echo str_replace('.00','',$row['ret2a']); ?>" readonly>
						
                                                          
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
			    <label>Monto a Pagar:</label>
			    											
                                                        <input name="payment" type="text" class="form-control" id="payment" placeholder="Calculo automático" value="<?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].str_replace('.00','',$row['payment'])." ".$rowcurrency['name']; ?>" readonly>
						
                                                          
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

										 TID</th>

									<th width="12%">

										 Fecha</th>

									<th width="12%">

										 Hora</th>

									<th width="26%">Acción</th>

									<th width="19%">

										 Por Usuario

									</th>

									<th width="14%">

										 Vencimineto</th>
	<th width="12%">

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
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowstatus['id']; ?></td><td><?php echo date('d-m-Y',strtotime($rowstatus['today'])); ?></td><td><?php echo date('h:i:s a', strtotime($rowstatus['now2'])); ?></td>
                                <td><?php $querystage = "select * from stages where id = '$rowstatus[stage]'";
								$resultstage = mysqli_query($con, $querystage);
								$rowstage = mysqli_fetch_array($resultstage);
								echo $rowstage['content'];
								 ?></td>
                                <td><?php $queryuser = "select * from workers where code = '$rowstatus[userid]'";
								$resultuser = mysqli_query($con, $queryuser);
								$rowuser = mysqli_fetch_array($resultuser);
								echo $rowuser['first']." ".$rowuser['last']; ?></td>
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
                          
                          <?php $thecomment = $rowstatus['comment']; 
						  $thestage = $rowstatus['stage'];
						  $note = $rowstage['note'];
						  ?>
                                                        
                                <?php }  ?>
                                
                               
                                </tbody>

								</table>
                                <p>TID: ID de transacción.</p>
                                 
                                 
              <?php /* <?php if($rowstatus['comment'] != ""){ ?>
                                                            <tr role="row" class="odd"><td class="sorting_1" colspan="7"><strong>Nota:</strong> 
                                                            */ ?>
              
 
          
 									<!--/row--><!--/row--></div>


							

										</form>

										<!-- END FORM-->



									</div>

								</div>

							</div>

	<div class="row">	
<?php if($thecomment != ""){ ?>
<div class="col-md-12 ">
<div class="note note-<?php echo $note;
?>">
<?php echo $thecomment; 
?>
</div> </div>
<?php } ?>
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

    
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html> 