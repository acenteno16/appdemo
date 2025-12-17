<?php include("session-request.php");

$id = $_GET['id'];
$query = "select * from payments where id = '$id'";$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));


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

<?php //include("header.php"); ?>

<!-- END HEADER -->

<div class="clearfix">

</div>

<!-- BEGIN CONTAINER -->

<div class="page-container">

	<!-- BEGIN SIDEBAR -->

	<?php //include("side.php"); ?>

	<!-- END SIDEBAR -->

	<!-- BEGIN CONTENT -->

	<div class="page-content-wrapper">

		<div class="page-content">

		

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			

			<!-- BEGIN PAGE HEADER-->
            <!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="invoice">

				<div class="row invoice-logo">

					<div class="col-md-6 invoice-logo-space">

						<img src="../images/casa-pellas-blue.png" class="img-responsive" alt=""/>

					</div>

					<div class="col-md-6">

						<p style="text-align:right; margin-right:10px;">

							 #<?php echo $row['id']; ?> / <?php echo date('d/m/Y'); ?> 

						</p>
                        <p style="text-align:right;"><img alt="TESTING" src="barcode.php?&text=<?php echo $_GET['id']; ?>" /></p>

					</div>

				</div>

				<hr/>

				<div class="row">

					<div class="col-md-4">

						<h3>Solicitante:</h3>

						<ul class="list-unstyled">

							<li>

								 <strong>Nombre:</strong> <?php echo $rowuser['first']." ".$rowuser['last']; ?>

							</li>

							<li>

								 <strong>Codigo:</strong> <?php echo $rowuser[code]; ?>

							</li>

							<li>

								<strong> Unidad de Negocio:</strong>
<?php echo $rowuser['unit']; ?>
							</li>

							
							

						</ul>

					</div>

					<div class="col-md-4">

						<h3>Proveedor:</h3>

						<ul class="list-unstyled">

							<li>

				<strong>Nombre:</strong> <?php echo $rowprovider['name']; ?>
							</li> 

							<li>

							<strong>Codigo: </strong> <?php echo $rowprovider['code']; ?>

							</li>

							<li>

								<strong>Ruc: </strong> <?php echo $rowprovider['ruc']; ?>

							</li>

							<li>

						<strong>Giro: </strong> <?php echo $rowprovider['course']; ?>

							</li>

							
						</ul>

					</div>

					<div class="col-md-4 invoice-payment">

						<h3>Detalle de Pago:</h3>

						<ul class="list-unstyled">

							<li>

								

							</li>



						
						</ul>

					</div>

				</div>

				<div class="row">

					<div class="col-md-12">

						<table class="table table-striped table-hover">

						<thead>

						<tr>

							<th>

								 #

							</th>

							<th class="hidden-480">

								 Link

							</th>
                            <th class="hidden-480">

								Nombre

							</th>

						  </tr>

						</thead>

						<tbody>
                        <?php $queryfiles = "select * from files where payment = '$id'";
						$resultfiles = mysqli_query($con, $queryfiles);
						$i = 1;
						while($rowfiles=mysqli_fetch_array($resultfiles)){
							
							if($rowfiles['status'] == 0){
								$queryf = "update files set status = '1' where id = '$rowfiles[id]'"; 
								$resultf = mysqli_query($con, $queryf);  
							} 
							
							
						?>

						<tr>

							<td>

								<?php echo $i; ?>

							</td>

							<td class="hidden-480">

								<?php echo $rowfiles['link']; ?>

							</td>
                            <td class="hidden-480">

								<?php echo $rowfiles['name']; ?>

							</td>

						  </tr>

						<?php $i++;
						} 
						?>

						</tbody>

						</table>

					</div>

				</div>

				<div class="row">

					<div class="col-md-4">

						<div class="well">

							<address>

							<strong>Casa Pellas S.A.</strong><br/>

							xxxx<br/>

							xxxx<br/>

							<abbr title="Phone">xxxx </address>

							<address>

							<strong>xxxx</strong><br/>

							<a href="mailto:#">

							xxxx@xxxx.xxx </a>

							</address>

						</div>

					</div>

					<div class="col-md-8 invoice-block">

						<ul class="list-unstyled amounts">

							<li>

								<strong>Numero de Archivos:</strong> <?php echo $i-1; ?>

							</li>

							<?php /*<li>

								<strong>Discount:</strong> 12.9%

							</li>

							<li>

								<strong>VAT:</strong> -----

							</li>

							<li>

								<strong>Grand Total:</strong> $12489

							</li>*/ ?>

						</ul>

						<br/>

						<a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">

						Imprimir <i class="fa fa-print"></i>

						</a>

						<?php /*<a class="btn btn-lg green hidden-print margin-bottom-5">

						Submit Your Invoice <i class="fa fa-check"></i>

						</a>*/ ?>

					</div>

				</div>

			</div>

			<!-- END PAGE CONTENT-->

	  </div>

	</div>

	<!-- END CONTENT -->

	<!-- BEGIN QUICK SIDEBAR -->

<?php //include("sidebar.php"); ?>

<!-- END QUICK SIDEBAR -->

</div>

<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->

<?php //include("footer.php"); ?>

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