<?php include("session-schedule.php"); 

$queryg = "select * from schedule where id = '$_GET[id]'";
$resultg = mysqli_query($con, $queryg);
$rowg = mysqli_fetch_array($resultg);

if($rowg['vo'] > 0){
	echo "<html><script> alert('No se puede incluir una solicitud de pago en un grupo aprobado.'); window.location = 'payment-schedule-group.php'; </script></html>";
	exit();
}

$querygroup = "select * from schedulecontent where schedule = '$_GET[id]'";
$resultgroup = mysqli_query($con, $querygroup);
$rowgroup = mysqli_fetch_array($resultgroup);

$querypayment = "select * from payments where id = '$rowgroup[payment]'";
$resultpayment = mysqli_query($con, $querypayment);
$rowpayment = mysqli_fetch_array($resultpayment);

$bank = $rowpayment['bank'];
$currency = $rowpayment['currency'];
$company = $rowpayment['company'];

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

					Programación de Pagos <?php //<small>Aprobación</small> ?> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="payment-schedule.php">Programación de pagos</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>
                        

							<a href="payment-schedule-group.php">Grupos de cancelación</a>

							<i class="fa fa-angle-right"></i>

						</li>
                          <li>

							<a href="#">Visor de grupo</a>
<i class="fa fa-angle-right"></i>
							

						</li>
						<li>

							<a href="#">Inclusión</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

			                                        
                  <div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						
                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						Grupo de programación</div>
                            

						</div>

						

					</div>
                    <div class="portlet-body">
                             
                             <?php /*<form action="withholding-mayor-tax-request-code.php" method="post" enctype="multipart/form-data" name="form2" id="form2"><div class="table-container">*/ ?>

								 
								<?php 
								
								
								
								$querymain = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.payment, payments.expiration, payments.description, payments.blockschedule from payments where ((payments.status = '9') or (payments.status = '13.02') or (payments.status = '13.03')) and ((payments.sent_approve = '1') or (payments.immediate = '1')) and payments.bank = '$bank' and payments.currency = '$currency' and payments.company = '$company' group by payments.id order by payments.expiration asc"; 
								$resultmain = mysqli_query($con, $querymain);
								$nummain = mysqli_num_rows($resultmain);
								
							
								if($nummain > 0){ ?> 
                                
                               	<?php //echo $query; ?>
                        
                               
                       
                              
                   
                      <form action="payment-schedule-group-view-include-code.php" method="post" enctype="multipart/form-data" name="form2" id="form2"><div class="table-container">


<div class="row" id="dproviders"><!--/span-->

													<div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">ID solicitud - Código | Nombre del Proveedor/Colaborador (Moneda Monto)</label>

						
											<select name="payment" class="form-control  select2me" id="payment" data-placeholder="Seleccionar..." > 
                                            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
                                            
                                           

											  <option value=""></option>  
<?php 
while($row=mysqli_fetch_array($resultmain)){ 

	if($row['btype'] == 1){
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
		$provider = $rowprovider['code']." | ".$rowprovider['name'];
	}else{
		$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
		$provider = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
	}
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
												
	
	 
	
												?>
												<option value="<?php echo $row['id']; ?>"><?php echo 'IDS: '.$row['id'].' - '.$provider.' ('.$rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)).')'; ?></option> 
                                                <?php } ?>

												

											</select>
											
													  </div>

													</div>

													<!--/span-->

												</div>
												
												
												
<div class="form-actions right">
<button type="submit" class="btn blue"><i class="fa fa-check"></i> Incluir</button> 


</div> 
</div>
<input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>">
<input name="schedule" type="hidden" id="schedule" value="<?php echo $rowg['schedule']; ?>">
				  
				  </form>
					  
                                <?php } else{
									
									echo '<div class="note note-regular">No se encontró ninguna solicitud de pago con las mismas caracteristicas (Compañía, Banco o Moneda)</div>';
								}
							
								?>
                                
                                
                    
                             
                                
                                

						</div>
                        <?php //</form> ?>

					</div>
                  
                    
                 

					<!-- End: life time stats -->

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