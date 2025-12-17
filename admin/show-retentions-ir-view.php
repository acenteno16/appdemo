<?php 
session_start(); 
if(($_SESSION['admin'] == "active") or ($_SESSION["withholding"] == 'active')){
	include("../connection.php");  
}else{
	session_destroy();
	header("location: ../?err=noadmin-or-retention");	 
}

	 
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





<!-- END THEME STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>


<!-- END PAGE LEVEL STYLES -->

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

			<!-- BEGIN STYLE CUSTOMIZER -->

			

			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Retenciones <small>Anular + redireccionar retenciones IR</small

					></h3>

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

							<a href="#">Retenciones</a> 
                                <i class="fa fa-angle-right"></i></li>
                            <li>

							<a href="#">Anular IR + Redireccionar</a></li>
                           
						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">
                
                
                                
                	<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						Retenciones IR (Anular + Redireccionar)

							</div>

						</div>

						

					</div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <?php ///// table ?>
                         	<div class="tab-pane" id="tab_1">
                            
                            <form action="show-retentions-ir-void.php" method="post" enctype="multipart/form-data"> 
<div class="row"><!--/span-->


													<div class="col-md-12">
                           
        
        <?php //start?>
 	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

								  RID</th>

									<th width="1%">

								  Solicitud</th>

									<th width="1%">

								  Ret. No</th>

<th width="8%">

										Ret. Company</th>

<th width="30%">

										Unidad</th>
                                        
                                        <th width="20%">

										Route Company</th>
                                        
                                  </tr>

								</thead>

								<tbody>

                                <?php 
						


$query = "select * from irretention where id = '$_GET[id]'";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
	 
	 $querypayment = "select * from payments where id = '$row[payment]'";
	 $resultpayment = mysqli_query($con, $querypayment);
	 $rowpayment = mysqli_fetch_array($resultpayment);
	 
	 if(strlen($rowpayment['route']) == 4){
		 $queryroute = "select * from units where code = '$rowpayment[route]'";
	 }else{ 
		 $queryroute = "select * from units where code2 = '$rowpayment[route]'";
	 }
	 //echo $queryroute;
	 $resultroute = mysqli_query($con, $queryroute);
	 $rowroute = mysqli_fetch_array($resultroute);

//if(($row['company'] != $rowroute['company']) and ($row['number'] > 0)){
?>

								
								
                                <tr role="row" class="odd <?php if($row['company'] != $rowroute['company']){ echo "danger"; $errors++; } ?>">
                                  <td class="sorting_1"><? echo $row['id']; ?></td><td><a href="payment-order-view.php?id=<? echo $row['payment']; ?>" target="_blank"><? echo $row['payment']; ?></a></td>
                                  <td><? echo $row['number']; ?>
                                    
                                   
                                  </td>
                                    <td><? switch($row['company']){
		  case 1:
		  echo "Casa Pellas";
		  break;
		  case 2:
		  echo "Alpesa";
		  break;
		  case 3:
		  echo "Velosa";
		  break;
	  }
	  
	  ?>
                                    
                                   
                                  </td>
                                    <td><? echo $rowpayment['route']." | ".$rowroute['name']; ?>
                                    
                                   
                                  </td>
                                    <td><? switch($rowroute['company']){
		  case 1:
		  echo "Casa Pellas";
		  break;
		  case 2:
		  echo "Alpesa";
		  break;
		  case 3:
		  echo "Velosa";
		  break;
	  }
	  
	  ?>
                                    
                                   
                                  </td>
                                  
                                  </tr>
                                
                                
                                
                                
                                
                                
                                <?php 
								//}//while ?>
                                </tbody>

								</table>
                      

</div></div>
 
     <select name="company" id="company">
                                  <option> Seleccionar</option>
                                 
                                 <? 
								 $querycompany = "select * from companies where active = 1";
								 $resultcompany = mysqli_query($con, $querycompany);
								 while($rowcompany=mysqli_fetch_array($resultcompany)){ ?>
                                 <option value="<? echo $rowcompany['id']; ?>"><? echo $rowcompany['name']; ?></option>
                                 <? } ?>
                              </select>
                              
                              
<button type="submit" class="btn red"><i class="fa fa-check"></i> Rechazar + RD</button>
<input name="id" type="hidden" id="id" value="<? echo $_GET['id']; ?>">
</form>
                      </div>


							

							

							

					<?php //table } ?>		

							

							

					

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

<script type="text/javascript" src="../assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>

<!-- END PAGE LEVEL PLUGINS -->
<?php ?> 
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/clockface/js/clockface.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<?php ?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/components-dropdowns.js"></script>

<script src="../assets/admin/pages/scripts/components-pickers.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->


<script>
jQuery(document).ready(function() {       
// initiate layout and plugins
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
ComponentsPickers.init();
ComponentsDropdowns.init();
});   
</script>

<!-- END JAVASCRIPTS --



</body>

<!-- END BODY -->

</html>