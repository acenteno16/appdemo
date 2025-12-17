<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("session-reception.php");

$location = $_GET['location'];
$provider = $_GET['provider'];
$worker = $_GET['worker'];
							
$filter = 0; 
$sql1 = "";
if((!isset($_GET['location'])) or ($location == "%")){
    //Do nothing
	$location = "%"; 
}else{
    $sql1 = " and location = '$location'";
	$filter ++;
} 							
$sql2 = "";
if($provider != ""){
    $sql2 = " and provider = '$provider' and type = '1'";
	$filter++;
}
$sql3 = "";
if($worker != ""){ 
    $sql3 = " and provider = '$worker' and type = '2'";
	$filter++;
}							
$sql = $sql1.$sql2.$sql3;
										
$query = "select * from retentionenvelope where status = '2'".$sql." order by lastdate asc";
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



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:onFocus();">

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

					Entrega de Retenciones <? //<small>Entrega </small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="reception-home.php">Recepcion</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                            
                            
                            <li>

							<a href="#">Entrega</a>
                            
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

										<form action="<? echo $_SERVER['PHP_SELF']; ?>" class="horizontal-form" method="get" enctype="multipart/form-data">

											<div class="form-body">

												<h3 class="form-section">Filtro</h3>
                                                

												<div class="row"><!--/span-->

												  <div class="col-md-4 ">
													  <div class="form-group">
														
                                                    
	<label class="control-label">Ubicación:</label> 

						
											<? 
											$query_suggestion = "select * from retentionenvelope where status = '1' order by lastdate asc limit 1";
											$result_suggestion = mysqli_query($con, $query_suggestion);
											$row_suggestion = mysqli_fetch_array($result_suggestion);
											$location_suggestion = $row_suggestion['location'];
											
											if($location_suggestion == 0){
												$location_suggestionname = "Sin Ubicación";
											}else{ 
											$query_suggestionname = "select name from locations where id = '$location_suggestion'"; 
											$result_suggestionname = mysqli_query($con, $query_suggestionname);
											$row_suggestionname = mysqli_fetch_array($result_suggestionname);
											$location_suggestionname = $row_suggestionname['name'];
											}
											
											?>
												<select name="location" class="form-control" id="location" data-placeholder="Seleccionar...">

												<option value="%" selected>Seleccionar</option>
												<option value="0" <? if($location == '0') echo "selected"; ?>>Sin Ubicación <? if($location_suggestion == 0) echo '(Sugerido)'; ?></option>
 											<?php 
											$queryproviders = "select * from providerslocation order by id";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <? if($_GET['location'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders["name"]; ?> <? if($location_suggestion == $rowproviders['id']) echo '(Sugerido)'; ?></option>
                                            <?php 
												
												}
												
											?>

												

											</select>
                                                     
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
												  </div>
												  
												  <div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Proveedor:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value="">Todos los Proveedores</option>
 <?php $queryproviders = "select id, code, name from providers where code > '0' order by name";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option>
                                            <?php }
											?>

												

											</select>

															
													  </div>

													</div>
												  
												<? /*  <div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Colaborador:</label>

						
											<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar...">

												<option value="">Todos los Colaboradores</option>
 <?php $queryproviders = "select id, code, first, last from workers order by first,last";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div> */ ?>  

													<!--/span-->

											  </div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

										  <!--/row--><!--/row--></div>


											<div class="form-actions right">

												<button type="button" class="btn default" onClick="javascript:cancelAction();">Eliminar filtro</button>
												<script>
												function cancelAction(){
													window.location = "reception-retention-remission-delivery.php";
												}
												</script>
												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filtrar</button>
												<input type="hidden" name="filter" id="filter" value="1"> 

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div>								
<? if(($filter > 0)){  ?>	
<div class="row">
				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

						<div class="caption">Entrega de remisiones</div>
						<? /*<div class="actions">

								<a href="reception-retention-remission-records.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Ver historial</span>

								</a>

							

							</div>*/ ?>
							

						</div>

						<div class="portlet-body">

							<div class="table-container">

							<?php 
							
							
							if(($num > 0)){ 
							
							?>
                                
                                
							<form action="reception-retention-remission-delivery-code.php" enctype="multipart/form-data" method="post">
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
										 <th width="4%">

										 Sobre</th>
										 <th width="40%">

										 Proveedor</th>

									<th width="20%">

										 Ret. más antigua</th>

									<th width="20%">

										 Ubicacion</th>


									<th width="30%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                                                
                                <?php 
								
								while($row=mysqli_fetch_array($result)){
								
							
								
								
								
								$chain.= $this_one."/"; 
								
									if($row['type'] == 1){
										$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
										$providername = $rowuser['code']." | ".$rowuser['name'];
										if($rowuser['location'] > 0){
											$querylocation = "select * from providerslocation where id = '$rowuser[location]'";
											$resultlocation = mysqli_query($con, $querylocation);
											$rowlocation = mysqli_fetch_array($resultlocation);
											$location = $rowlocation['name'];
										}else{
											$location = "Sin Ubicación"; 
										}
									}else{
										$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[provider]'"));
										$providername = $rowuser['code']." | ".$rowuser['first'].' '.$rowuser['last'];
										$location = "Recepcion";
									}
									
									
								?>
                                <tr role="row" class="odd">
                                <td class="sorting_1" id="maintheid<?php echo $table; ?>">   
								<input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" ></td>
                                <td class="sorting_1"><? echo $row['id']; ?>
								</td>
                                <td><? echo $providername; ?></td>
                                <td><?php  
								/*$queryir = "select irretention.number from retentionenvelopecontent inner join irretention on retentionenvelopecontent.retention = irretention.id  where retentionenvelopecontent.envelope = '$row[id]' and retentionenvelopecontent.type = '2'";
								$resultir = mysqli_query($con, $queryir);
								$numir = mysqli_num_rows($resultir);
								if($numir == 0){
									echo "Sin retenciones";
								}else{ 
									while($rowir=mysqli_fetch_array($resultir)){
										echo $rowir['number']."<br>";
									}
								}*/
								echo $row['lastdate'];
								
								?> </td>
                                <td><? echo $location; ?></td> 
                                <td><a href="reception-retention-remission-delivery-detail.php?id=<? echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a>
                                 </td>
                                </tr>
                                <?php }  ?>
                                                                </tbody>

								</table>
							
                                
                                <div class="row">
                                    
							  <div class="col-md-4 ">
                                  <label class="control-label">Colector:</label> 
                                  <select name="collector" class="form-control" id="collector" data-placeholder="Seleccionar..." onChange="isClient(this.value)">

												<option value="0">Seleccionar</option> 
 											<?php 
											$querycollector = "select * from collector order by first, last";
											$resultcollector = mysqli_query($con, $querycollector);
											while($rowcollector = mysqli_fetch_array($resultcollector)){
										
											?>
                                            <option value="<?php echo $rowcollector["id"]; ?>"><?php echo $rowcollector["first"]." ".$rowcollector['last'];  ?></option>
                                            <?php 
												
												}
												
											?>

												

											</select>
                                  <script>
                                                          
                                                              function isClient(thisVal){
                                                                 if(thisVal == 1){
                                                                     $('.noShow').show();
                                                                 }else{
                                                                     $('.noShow').hide();
                                                                 }
                                                                  
                                                              }
                                                              
                                                          </script>
                                                   
												  </div>
                              <div class="col-md-4 noShow" style="display: none;">
                                <label  class="control-label">Nombre:</label>
                                  <input type="text" class="form-control" id="name" name="name">
                                </div>
				            <div class="col-md-4 noShow" style="display: none;">
                                <label>Cédula:</label> 
                                  <input type="text" class="form-control" id="nid" name="nid">
                                </div>
                            <div class="row"></div><br>
							  <div class="col-md-4">
							  <button type="submit" class="btn blue"><i class="fa fa-check"></i> Entregar</button>
                                    </div>					  	
							</div>
							
							</form> 
							<? }else{ ?>
							<div class="note note-danger">No se encontráron sobres para entrega.</div>
							<? } ?>
							
							</div>

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
                                
                 
                
			</div>

<? } ?>

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

<? /*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ ?>

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

function onFocus(){	
	document.getElementById("id").focus();
}
						</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>