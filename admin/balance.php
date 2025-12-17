<?php 
exit();
include("sessions.php"); ?> 
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

					Fondo disponible <? //<small>Estados de Cuenta</small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="jt.php">JT</a>

						<i class="fa fa-angle-right"></i> 

						</li>
						<li>

							<a href="#">Fondo disponible</a>

							<? //<i class="fa fa-angle-right"></i> ?>

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">

			

					<!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Fondo disponible por compañía</div>


						</div>

						<div class="portlet-body">

						<? //squares
							$querycompany = "select * from companies"; 
							$resultcompany = mysqli_query($con, $querycompany);
							while($rowcompany=mysqli_fetch_array($resultcompany)){
								
								$querybalance_nio = "select * from balance where company = '$rowcompany[id]' and currency = '1' order by id desc limit 1";
								$resultbalance_nio = mysqli_query($con, $querybalance_nio);
								$rowbalance_nio = mysqli_fetch_array($resultbalance_nio);
								
								$querybalance_usd = "select * from balance where company = '$rowcompany[id]' and currency = '2' order by id desc limit 1";
								$resultbalance_usd = mysqli_query($con, $querybalance_usd);
								$rowbalance_usd = mysqli_fetch_array($resultbalance_usd);
								
								
						?>
						<a href="balance-view.php?company=<? echo $rowcompany['id']; ?>"><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px; cursor:pointer;"  <? //onClick="javascript:goCompany(<? echo $rowcompany['id']; );" ?>>

					<div class="dashboard-stat blue" style="height:150px;">

						<div class="visual">

							<i class="fa fa-money"></i>

						</div>

						<div class="details">

							<div class="number">
<?php echo $rowcompany['name']; ?>
							</div>

							<div class="desc" style="margin-bottom: -1px; font-weight: 500;">

									C$<? echo number_format($rowbalance_nio['balance'],2); ?><br>USD$<? echo number_format($rowbalance_usd['balance'],2); ?>
 </div>
 

						</div>
                       

					

					</div>
                    

							</div></a>
						<? } //End squares?>
						<? /*<script>
							function goCompany(id){
								window.location = "balance-view.php?company="+id;
							} 
						</script>*/ ?>

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

<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->


<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>



<!-- END PAGE LEVEL SCRIPTS -->

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