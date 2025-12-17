<?php 

include("session-withholding.php"); 

$hall = base64_decode($_GET['hall']); 

$queryhall = "select * from halls where id = '$hall'";
$resulthall = mysqli_query($con, $queryhall);
$rowhall = mysqli_fetch_array($resulthall);

$query = "select * from mayor where hall = '$hall' order by id desc"; 
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

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

					Retenciones <small>Alcaldía</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Retenciones</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>

							<a href="withholding-mayor-tax-branch.php">Alcaldías</a>

							<i class="fa fa-angle-right"></i>

						</li>
                                                <li>

							<a href="withholding-mayor-tax-branch.php?hall=<?php echo base64_encode($rowhall["id"]); ?>"><?php echo $rowhall['name']; ?></a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>

							<a href="#">Grupos de cancelación</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

			<?php /*<div class="col-md-12">
														<div class="dashboard-stat blue">
															<div class="visual">
																<i class="fa fa-money"></i>
															</div>
															<div class="details">
		<?php $totaltax = 0;
		 $query1 = "select * from payments where status = '14' and irstage = '0'";
								$result1 = mysqli_query($con, $query1);
								while($row1=mysqli_fetch_array($result1)){
									$totaltax += $row1['ret1a'];
								}
								?>
<input type="hidden" id="balance" name="balance" value="<?php echo $totaltax; ?>">	
<input type="hidden" id="cbalance" name="cbalance" value="">	
													<div class="number" id="thenumber">
																	 C$<?php echo $totaltax; ?>															</div>
																<div class="desc">
																	Total retenciones IR
																</div>
															</div>
															
														</div>
													</div>*/ ?>
                                                    
                                                    
                  <div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						

                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						Grupos de cancelación | <?php echo $rowhall['name']; ?>

							</div>
                            

						</div>

						

					</div>
                    <div class="portlet-body">



							
                             
                            
                             
<form action="withholding-mayor-tax-groups-excel.php" method="post" enctype="multipart/form-data" name="form2" id="form2"><div class="table-container">
<?php

if($num > 0){ 

?>                                
<?php //echo $query; ?>
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">
                                    <input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
                                
                                  <script>
    function checkAll(){
	 var checkall = document.getElementById('checkall');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('theid[]');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
      </script>

										 </th>
                                         <th width="2%">

										 ID</th>

									<th width="5%">

										 Usuario</th>

									<th width="11%">Fecha</th>

									<th width="5%">

										 Hora</th>

									<th width="14%">

										 Estado de retención 

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
								
							   $nioammount = $row['ret2a'];	
								if($row['currency'] == 2){
									
									$query2 = "select * from tc where today = '$row[schedule]'";
									$result2 = mysqli_query($con, $query2);
									$row2 = mysqli_fetch_array($result2);
									$num2 = mysqli_num_rows($result2);
									
									$nioammount = $row['ret2a']*$row2['tc']; 
								}
								//if($nioammount > 1){
							
									
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$rowuser= mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"> <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" ></td>
                                  <td><?php echo $row['id']; ?></td><td><?php echo $rowuser['first']." ".$rowuser['last']; ?></td>
                                  <td><?php echo date('d-m-Y',strtotime($row['today'])); ?><br>
                                    
</td><td><?php echo date('h:i:s a', strtotime($row['now2'])); ?></td>
                                
                                <td><?php if($row['mayorstage'] == 0){
									echo "Pendiente de cancelación";
								}else{
								$querymayorstage = "select * from mayorstages where id = '$row[mayorstage]'";
								$resultmayorstage = mysqli_query($con, $querymayorstage);
								$rowmayorstage = mysqli_fetch_array($resultmayorstage);
								echo $rowmayorstage['name']; 
								}
								?> 
									
							
								
							</td><td><a href="withholding-mayor-tax-groups-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>  
                            
                            
                            </td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                </div>
                                
                        
							
                                
                              <div class="form-actions right">

<button type="submit" class="btn blue"><i class="fa fa-file-excel-o"></i> &nbsp; Generar Excel</button>

							</div>
                                
                                

                            
                                <?php } else { 
							
								?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No se encontró ningún grupo de cancelación.

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div></form>

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