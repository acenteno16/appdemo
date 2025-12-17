<?php 

include("session-retentions.php");  
	
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


<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

<!-- END THEME STYLES -->



<link rel="shortcut icon" href="favicon.ico"/>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:reloadNumbers(),reloadRouteView()"> 

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

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Retenciones <small>ACP 10-15%</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="retentions-home.php">Retenciones</a></li> 
                             <i class="fa fa-angle-right"></i>

						<li>

							<a href="#">ACP 10-15%</a>

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

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form name="porder" id="porder" action="retentions-acp15-code.php" class="horizontal-form" method="post" enctype="multipart/form-data">
        

										        
                                                 
                                                 
                                                 
<div id="manualretentions">    
<div class="col-md-12">                                             
	<h3 class="form-section">Reparar retenciones ACP 10-15%</h3></div>
  


<?php //Ruc ?>
<div class="col-md-4">
<div class="form-group">
<label class="control-label">ID de Solicitud:</label> 
<input name="id" type="text" class="form-control" id="id" value="" >
</div></div>

                                                 


 
     <div class="row"></div><br>
<br>
 </div>
                                                    


                                                 
                                                 
                                                 
  
                                           
                                                 
                                                 
                                                 
                                                 
                                                  
                                                  
                                                  <div><!--/span--> 
                                                  
                                                  
              
                                    
                                                     
                                   
                                                     

                                              </div>
                                              
                                              
                                         
                               
                                                        
     
                                                           


											<div class="form-actions right" style=" margin-top:100px;">

												<button type="button" class="btn default" onClick="javascript:cancelAction();"><i class="fa fa-undo"></i> Retornar</button>
                                               <script type="text/javascript">
												  function cancelAction(){
													  history.go(-1);
												  }
												</script>

                                              <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Reparar</button>
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

<?php /*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ ?> 


<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script src="../assets/admin/pages/scripts/components-pickers.js"></script>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


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

    
<script type="text/javascript"> 


function cancelAction(){
	if (confirm("Esta Seguro de cancelar este ingreso?\n")==true){
			window.location = 'retentions-home.php';
		}
}


			
</script>

<?php //include('fn-reloadnumbers.php'); ?>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>

  
