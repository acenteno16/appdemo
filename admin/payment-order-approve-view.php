<?php include("session-request2.php"); 
require('functions.php');

$id = $_GET['id'];
$atype = $_GET['atype'];

$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if($row['approved'] == 1){
	?>
    <script>
	alert('Este pago ya fue aprobado.');
	window.location = 'approve.php';
	</script>
    <?php }
if($row['approved'] == 2){
	?>
    <script>
	alert('Este pago ya fue rechazado.');
	window.location = 'approve.php';
	</script>
    <?php }

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



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="reloadRouteView();">

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

					Pagos <small>Visto bueno de solicitudes.</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="approve.php">Pagos</a>
                            
                            <i class="fa fa-angle-right"></i>
                            
                            </li>
                            

						<li>

							<a>Visto bueno</a>

						</li>

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

						
Detalle de la solicitud
							</div>
                            <?php /*<div class="actions">

								<a href="approve-view.php?id=<?php echo $_GET['id']; ?>" class="btn default blue-stripe">

								
								<span class="hidden-480">

								Regresar a vista minimizada</span> 

								</a>

							</div>*/ ?>

						</div>

					</div>
                    

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

										

<?php 

include("stage-main.php");
include("stage-status.php"); 

?>
									
									<h3 class="form-section"><a id="status"></a>Ruta de pago</h3>
                    				
										
                   		 			<?php /*if($row['route'] > 0){ ?>
                         			<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										Código</th>
                                        
                                        <th width="12%">

										Usuario</th>

									
                                    <th width="8%">

										 Email</th>
                                         
                                         <th width="5%">

										 Roll</th>

									
									
								
                                  

								  </tr>

								</thead>

								<tbody> 
                        
                        <?php 
						
						if($row['headship2'] > 0){
						
						$queryroute = "select * from routes where type > 1 and unit = '$row[route]' and headship = '$row[headship2]' order by type asc";
						$resultroute = mysqli_query($con, $queryroute);
						while($rowroute = mysqli_fetch_array($resultroute)){
							$queryroute2 = "select * from workers where code = '$rowroute[worker]'";
							$resultroute2 = mysqli_query($con, $queryroute2);
							$rowroute2 = mysqli_fetch_array($resultroute2);
							
							?>
                            
                            <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowroute2['code']; ?></td>
							<td><?php echo $rowroute2['first']." ".$rowroute2['last']; ?></td>
                            <td><?php echo $rowroute2['email']; ?></td>
                            <td><?php $querytype  = "select * from usertype where id = '$rowroute[type]'";
							$resulttype = mysqli_query($con, $querytype);
							$rowtype = mysqli_fetch_array($resulttype);
							echo $rowtype['name'];
							 ?></td> 
                               
                          </tr>
                          <?php }  } ?>
                          
                            <?php 
							
							$queryroute = "select * from routes where type > '1' and type < '23' and unit = '$row[route]' and headship = '0' order by type asc";
							
							$resultroute = mysqli_query($con, $queryroute);
							while($rowroute = mysqli_fetch_array($resultroute)){
							$queryroute2 = "select * from workers where code = '$rowroute[worker]'";
							$resultroute2 = mysqli_query($con, $queryroute2);
							$rowroute2 = mysqli_fetch_array($resultroute2);
							
							?>
                            
                            <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowroute2['code']; ?> <? //echo $rowroute['type']; ?></td>
							<td><?php echo $rowroute2['first']." ".$rowroute2['last']; ?></td>
                            <td><?php echo $rowroute2['email']; ?></td>
                            <td><?php $querytype  = "select * from usertype where id = '$rowroute[type]'";
							$resulttype = mysqli_query($con, $querytype);
							$rowtype = mysqli_fetch_array($resulttype);
							echo $rowtype['name'];
							 ?></td> 
                               
                          </tr>
                          <?php }  ?>
                                
                               
                                </tbody>

								</table>	
									<?php }*/ ?>
										
										<div id="routeFill"></div>
										<script type="application/javascript">  
function reloadRouteView(){
	
	var myroute = '<? echo $row['routeid']; ?>,<? echo $row['headship']; ?>'; 
	var newcode = '<?php echo getUnit($row['routeid'],$row['ncatalog'],'All'); if($row['headship2'] > 0) echo " (Jef. ".$row['headship2'].")"; ?>'; 
    $.post("reload-route.php", { myvariable: myroute, newcode: newcode }, function(data){
		//alert(data); 
		document.getElementById('routeFill').innerHTML = data;
   }); 
}


</script>
                        
									
											
                                          <form action="payment-order-approve-view-code.php" class="horizontal-form" method="get" enctype="multipart/form-data" onsubmit="return validateForm();">
                                              
                                          <h3 class="form-section">Opciones</h3>  
                                         									<div class="row">
 <div class="col-md-4">

													<div class="form-group">

											 				<label class="control-label">Visto Bueno:</label>

													  <select name="approve" class="form-control" id="approve" onChange="javascript:divShow(this.value);">
<option value="0">Seleccionar</option>
<option value="1">Si</option>
<option value="2">No</option>

													  </select>
			
           <script>
		   function divShow(approve){
			 
		   	if(approve == 0){
			   document.getElementById("cdiv").style.display = 'none';
			   
		   }
		   	if(approve == 1){
			   document.getElementById("cdiv").style.display = 'none';
			   
		   }
		   if(approve == 2){
			   document.getElementById("cdiv").style.display = 'block';
			   
		   }
}
	
		   </script>								    </div> 

												  </div>   
                          <div class="col-md-12 " style="display:none;" id="cdiv">
													  <div class="form-group">
														<label class="control-label">Razón:</label>

													  <select name="reason2" class="form-control" id="reason2">
<option value="0">Otro</option>
<?php $queryreason = "select * from reason";
$resultreason = mysqli_query($con, $queryreason);
while($rowreason=mysqli_fetch_array($resultreason)){
?>
<option value="<?php echo $rowreason['id']; ?>"><?php echo $rowreason['name']; ?></option>
<?php } ?>

													  </select><br>
<br>
<label>Comentarios:</label>
                                                        <textarea name="reason" rows="2" class="form-control" id="reason" placeholder="Comente por que no aprueba esta solicitud de pago."></textarea>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                        
                                                      <!--/row--></div>
													</div>                         
                                                    
  <div class="col-md-12 "><div class="form-actions right">

												

						    <button type="button" class="btn blue" onClick="goApprove();"><i class="fa fa-times"></i> Cancelar</button> 
                            <script>
							function goApprove(){
								window.location = "approve.php";
							}
							</script>
                             <button type="submit" class="btn blue"><i class="fa fa-check"></i> Guardar</button> 
												<input name="id[]" type="hidden" id="id[]" value="<?php echo $_GET['id']; ?>">
	   											<? if($row['parent'] > 0){ 
														$query_payments = "select id from payments where child = '$row[id]'";
														$result_payments = mysqli_query($con, $query_payments);
														while($row_payments=mysqli_fetch_array($result_payments)){
												?> 
                                  				 <input name="id[]" type="hidden" id="id[]" value="<?php echo $row_payments['id']; ?>">
                           						<? } } ?>
                                                <input name="atype[]" type="hidden" id="atype[]" value="<?php echo $atype; ?>"> 
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
	var approve = document.getElementById("approve").value;
	var reason = document.getElementById("reason").value;
	var reason2 = document.getElementById("reason2").value;
	if(approve == 0){
		alert('Debe de seleccionar una opcion de aprobado.');
		return false;
		}
	if(approve == 2){	
		if((reason2 == '0') && (reason == '')){
		alert('Cuando rechaza una solicitud de pago con la opcion "Otro" debe de justificar con comentarios.');
		return false;
		}
	}  
	
	
}
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html> 