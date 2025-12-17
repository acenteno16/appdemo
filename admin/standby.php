<?php 

include("session-admin.php"); 
include("functions.php");

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

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

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>
<?php include('fn-expiration.php'); ?>
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

					Pagos <small>Órdenes de pago</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Pagos</a>

							<i class="fa fa-angle-right"></i>

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
                
            
<form id="ungrouped" name="ungrouped" action="standby-code.php" enctype="multipart/form-data" method="post">
<input name="form" type="hidden" id="form" value="1">
<div class="note note-regular">
<div class="row">
<h4 style="margin-left:15px;">Poner solicitud en Standby:</h4><br>                          
</div>  


                                        
                                                                              
                                                
                                               
<div class="row">                                         
<div class="col-md-3 ">
													  <div class="form-group">
														<label>ID de Solicitud:</label>
                                                        <input name="id" type="text" class="form-control" id="id" value="">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
</div>            

<div class="row">

<br><br>
						<div class="col-md-2">							

						    <input type="hidden" id="form" name="form" value="1">
						    <button type="submit" class="btn blue"><i class="fa fa-search"></i> Standby</button> 
												
                 </div> 
                                               
  
</div>
						
								</div>
                                </form> 
                                
                    
                 
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption"><?php echo $numdev; ?> Solicitudes de pago en Standby</div>

							

					  </div>

						<div class="portlet-body">

							<div class="table-container">

								
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 ID</th>

									<th width="40%">

										 Beneficiary</th>

									<th width="16%">Total Pagar</th>

									<th width="15%">

										 Vencimiento

									</th>

									<th width="15%">

										 Estado

									</th>

									<th width="17%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php //echo $query1; 
								$query1 = "select * from standby order by id desc";
								$result1 = mysqli_query($con, $query1);
								while($row1=mysqli_fetch_array($result1)){
								
								$query = "select * from payments where id = '$row1[payment]'";
								$result = mysqli_query($con, $query);
								$row = mysqli_fetch_array($result);
								
								$ben_name = getBen($row1['parent'], $row1['btype'], $row1['provider'], $row1['collaborator'], $row1['intern'], $row1['client']);
								
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?></td><td>                                  <?php 
								echo $ben_name;
								
								?></td>
                                    <td>
									<?php 
									
									
									if($row['payment'] != 0.00){
										echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); 
									if($rowcurrency['id'] == 1){
										$gtotal_nio+=$row['payment'];
									}
									if($rowcurrency['id'] == 2){
										$gtotal_usd+=$row['payment'];
									}
										
									
									} ?></td>
                                        <td>
										<?php 
										
										$iddelpago = $row['id'];
										echo $elvencimiento = getExpiration($iddelpago); 
										
										?></td><td>
                                        
                                       <?php 
									
									   $alert_str = "";
									
									   $alert_str = "Solicitado: ".date('d-m-Y',strtotime($row["today"]))." \\n"; 
									   if($row['approved'] == 2){
										   
										  
											$void_data = "";
											$rowreject = mysqli_fetch_array(mysqli_query($con, "select today, comment, reason from times where payment = '$row[id]' order by id desc limit 1"));	
											
											if($rowreject['comment'] != ""){
												$void_data.= $rowreject['comment']." \\n";
											}
											 $void_data.= "Motivo de Rechazo: ";
											 
											 if($row['reason'] > 0){
										   	    $rowreject0 = mysqli_fetch_array(mysqli_query($con, "select name from reason where id = '$row[reason]'"));
												$void_data.= $rowreject0['name']." \\n";
											}
											
											if($rowreject['reason'] != ""){
												$void_data.= $rowreject['reason']." \\n";
											}
											
										   
										   $alert_str.= "Rechazado: ".date('d-m-Y',strtotime($rowreject["today"]))." \\n";
										   $alert_str.= $void_data; 
									   }
										if($row['status'] >= '12'){
										   
										$alert_str.= 'Progrmado para: '.$row['schedule']." \\n";
										   
									   }
										if($row['status'] == '14'){ 
										   
										$querycancellation = "select today from times where stage = '14' and payment = '$row[id]'"; 
										$resultcancellation = mysqli_query($con, $querycancellation);
										$rowcancellation = mysqli_fetch_array($resultcancellation);
										$cancellationdate = date('d-m-Y',strtotime($rowcancellation["today"]));
										$alert_str.= "Fecha de cancelacion: ".$cancellationdate." \\n";
										$alert_str.= "CKPK: ".$row['cnumber']." \\n";
										
										$querybank = "select name from banks where id = '$row[bank]'";
										$resultbank = mysqli_query($con, $querybank);
										$rowbank = mysqli_fetch_array($resultbank);
										$cancellationbank = $rowbank['name']." \\n";
										$alert_str.= "Banco: ".$cancellationbank;
										$cancellationref = $row["reference"]." \\n"; 
									    $alert_str.= "Referencia: ".$cancellationref." \n"; 
									   }
									   
		
									
									
									
										
										?>
                                        <a href="javascript:alert('<?php echo $alert_str; ?>');"><?php  
										
										

$rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
						
if(($rowstatus['stage2'] != "0.00") and ($rowstatus['stage2'] != "")){  
								$color == "yellow";
								if($rowstatus['color'] != ""){
									$color = $rowstatus['color']; 
								}
								echo '<button type="button" class="btn '.$color.'">'.$rowstatus['stage2'].'</button>';
							}else{    
							$querystage = "select * from stages where id = '$rowstatus[stage]'";
								$resultstage = mysqli_query($con, $querystage);
								$rowstage = mysqli_fetch_array($resultstage);
								echo $rowstage['content'];
							}
								 
								 
								 echo "</a>"; ?>  
                                        
                                      
							
								
							</td><td>
                        
                           
                             <a href="javascript:deletePayment(<?php echo $row['id']; ?>);"><span class="label label-danger">
									<i class="fa fa-trash-o"></i>  Eliminar Standby </span></a>
                                    <script>
									function deletePayment(id){
		if (confirm("Usted desea eliminar este pago de standby?")==true){
			window.location="standby-clear.php?id="+id;	
	} 
}

									</script>
                            
                          
                            
                            </td></tr>
                                <?php }
								
								?>
                               
                                   </tbody>

								</table>
                                
                             
						</div>

					</div>

					<!-- End: life time stats -->

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

<!--[if lt IE 9]>

<script src="../assets/global/plugins/respond.min.js"></script>

<script src="../assets/global/plugins/excanvas.min.js"></script> 

<![endif]-->

<script src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>

<?php /*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ ?>

<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->


<script src="../assets/admin/pages/scripts/components-pickers.js"></script>

<script src="../assets/admin/pages/scripts/table-managed.js"></script>


<script>

jQuery(document).ready(function() {    
 Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar 
ComponentsPickers.init();
TableManaged.init();


        });



						</script> 

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>
