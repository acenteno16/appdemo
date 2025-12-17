<?php 

include("session-reception.php");

if($_SESSION['email'] == "jairovargasg@gmail.com"){
	#ini_set('display_errors', 1);
	#ini_set('display_startup_errors', 1);
	#error_reporting(E_ALL); 
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

							<a href="#">Creación de Sobres</a>
                            
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

						
											<select name="location" class="form-control" id="location" data-placeholder="Seleccionar...">

											<option value="">Seleccionar</option>
 											<?php 
											$queryproviders = "select * from providerslocation order by id";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <? if($_GET['location'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders["name"]; ?></option>
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
                                                    
                                                    <div class="col-md-4 ">
													  <div class="form-group">
														
                                                    
	<label class="control-label">Tipo de retención:</label> 

						
											<select name="rtype" class="form-control" id="rtype" data-placeholder="Seleccionar...">

											<option value="">Seleccionar</option>
                                            <option value="ir" <? if($_GET['rtype'] == 'ir') echo 'selected'; ?>>IR</option>
                                            <option value="imi" <? if($_GET['rtype'] == 'imi') echo 'selected'; ?>>IMI</option>
											</select>
                                                     
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
												  </div>
												  
												  <? /*<div class="col-md-4">

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

													</div>*/ ?>  

													<!--/span-->

											  </div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

										  <!--/row--><!--/row--></div>


											<div class="form-actions right">

												<input type="hidden" name="form" id="form" value="1">
                                                <button type="button" class="btn default" onClick="javascript:cancelAction();">Cancelar</button>
												<script>
												function cancelAction(){
													window.location = "reception-retention-envelope.php";
												}
												</script>
												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filtrar</button>

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div>								
	
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

						<? if($_GET['form'] == 1){ ?>
                        <div class="portlet-body">

							<div class="table-container">

							<?php 
							$arr_in = array();
							$arr_ret = array();
							
							$location = "";
							if(isset($_GET['location'])){
								$location = $_GET['location'];
							}
							$provider = "";
							if(isset($_GET['provider'])){
								$provider = $_GET['provider'];
							}
							
							$worker = "";
							if(isset($_GET['worker'])){
								$worker = $_GET['worker'];
							}
							$rtype = "";
							if(isset($_GET['rtype'])){
								$rtype = $_GET['rtype'];
							}
							
							
							
							$sql1 = "";
							if($location != ""){
								$sql1 = " and ((providers.location = '$location') or (workers.location = '$location'))";
							} 
							
							$sql2 = "";
							if($provider != ""){ 
								$sql2 = " and payments.provider = '$provider'";
							}
							
							$sql3 = "";
							if($worker != ""){ 
								$sql3 = " and payments.collaborator = '$worker'";
							}
                                
                           
							$sql = $sql1.$sql2.$sql3;
                            $show_ir = 1;
                            $show_imi = 1;
                            $rtype = $_GET['rtype'];
                           
                            if($rtype == "ir"){
                                $show_ir = 1;
                                $show_imi = 0;
                            }
                            if($rtype == "imi"){
                                $show_ir = 0;
                                $show_imi = 1;
                            }
                               echo $show_ir."//".$show_imi;
							
                            if($show_ir == 1){    
							//IR
							$query1 = "select irretention.today, payments.id, payments.btype, payments.provider, payments.collaborator from irretention inner join payments on irretention.payment = payments.id left join providers on payments.provider = providers.id left join workers on payments.collaborator = workers.code where payments.acp2 = '0' and irretention.delivery = '2'".$sql;
							$result1 = mysqli_query($con, $query1);
							$num1 = mysqli_num_rows($result1);
							while($row1=mysqli_fetch_array($result1)){
								//if provider
								if($row1['btype'] == 1){
									$arr_in = "1,".$row1['provider'];
								}
								//if collaborator
								else{
									$arr_in = "2,".$row1['collaborator'];
								}
								$arr_ret[] = $row1['today'].','.$arr_in;
							}
                                
                            }
							if($show_imi == 1){
							//IMI
							$query2 = "select hallsretention.today, payments.id, payments.btype, payments.provider, payments.collaborator from hallsretention inner join payments on hallsretention.payment = payments.id left join providers on payments.provider = providers.id left join workers on payments.collaborator = workers.code where payments.acp = '0' and hallsretention.delivery = '2'".$sql;
							$result2 = mysqli_query($con, $query2); 
							while($row2=mysqli_fetch_array($result2)){
								if($row2['btype'] == 1){
									$arr_in = "1,".$row2['provider'];
								}
								//if collaborator
								else{
									$arr_in = "2,".$row2['collaborator'];
								}
								$arr_ret[] = $row2['today'].','.$arr_in;
							}
                            }
							
                                if($_GET['echo'] == 1){
                                    echo $query."<br>".$query2;
                                }
							$num = sizeof($arr_ret);
							if($num > 0){
							?>

							<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="40%">

										 Proveedor</th>

									<? if($show_ir == 1){ ?><th width="20%">

										 Retenciones IR</th>
                                    <? } ?>
                                    <? if($show_imi == 1){ ?>
									<th width="20%">

										 Retenciones IMI</th>
                                    <? } ?>


									<th width="30%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                                                
                                <?php 
								
								//while($rowtime=mysqli_fetch_array($result)){
								
								for($a=0;$a<sizeof($arr_ret);$a++){
								$arr_ret_strip = explode(',',$arr_ret[$a]);
								
								//foreach ($arr_ret as &$valor) {	
								//$arr_ret_strip = explode(',',$valor);
								
								
								$today = $arr_ret_strip[0];
								$btype = $arr_ret_strip[1];
								$ben = $arr_ret_strip[2];
								
								$this_one = $arr_ret_strip[1].','.$arr_ret_strip[2];
								
								$chain_arr = explode('/', $chain);
								if(!in_array($this_one, $chain_arr)){
								
								$chain.= $this_one."/"; 
								
									if($btype == 1){
										$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$ben'"));
										$providername = $rowuser['code']." | ".$rowuser['name'];
									}else{
										$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$ben'"));
										$providername = $rowuser['code']." | ".$rowuser['first'].' '.$rowuser['last'];
									}
									
									$query_env = "select * from retentionenvelope where provider='$ben' and type='$btype' and status = '1'";
									$result_env = mysqli_query($con, $query_env);
									$num_env = mysqli_num_rows($result_env);
									
								?>
                                <tr role="row" class="odd <? if($num_env > 0) echo "success"; ?>">
                                <td class="sorting_1"><? echo $providername; ?></td>
                                <? if($show_ir == 1){ ?>
                                    <td><?php  
								if($btype == 1){
									$queryir = "select irretention.number from irretention inner join payments on irretention.payment = payments.id where irretention.delivery = '2' and payments.btype='$btype' and payments.provider = '$ben'"; 
								}else{
									$queryir = "select irretention.number from irretention inner join payments on irretention.payment = payments.id where irretention.delivery = '2' and payments.btype='$btype' and payments.collaborator = '$ben'";
								} 
								$resultir = mysqli_query($con, $queryir);
								$numir = mysqli_num_rows($resultir);
								if($numir == 0){
									echo "Sin retenciones";
								}else{
									while($rowir=mysqli_fetch_array($resultir)){
										echo $rowir['number']."<br>";
									}
								}
								
								?> </td><? } ?>
                                    <? if($show_imi == 1){ ?>
                                <td><?php  
								if($btype == 1){ 
									$queryhalls = "select hallsretention.serial, hallsretention.number from hallsretention inner join payments on hallsretention.payment = payments.id where hallsretention.delivery = '2' and payments.btype='$btype' and payments.provider = '$ben'";   
								}else{
									$queryhalls = "select hallsretention.serial, hallsretention.number from hallsretention inner join payments on hallsretention.payment = payments.id where hallsretention.delivery = '2' and payments.btype='$btype' and payments.collaborator = '$ben'"; 
								} 
								$resulthalls = mysqli_query($con, $queryhalls);
								$numhalls = mysqli_num_rows($resulthalls);
								if($numhalls == 0){
									echo "Sin retenciones";
								}else{
									while($rowhalls=mysqli_fetch_array($resulthalls)){
										echo $rowhalls['serial'].'-'.$rowhalls['number']."<br>";
									}
								}
								
								?></td> <? } ?>
                                <td><a href="reception-retention-envelope-detail.php?btype=<? echo $btype; ?>&ben=<?php echo $ben; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-envelope"></i> <? if($num_env > 0){ 
									$row_env = mysqli_fetch_array($result_env);
									echo "Rellenar sobre ".$row_env['id']; 
								}else{ 
									echo "Crear Sobre"; 
								} ?></a>
                                 </td>
                                </tr>
                                <?php } } ?>
                                                                </tbody>

								</table>
                             
                             <? 
							 }else{
							 ?>
							 <div class="note note-regular">No hay retenciones pendientes.</div>
                              <? } ?>

							</div>

						</div>
                        <? } ?>

					</div>

					<!-- End: life time stats -->

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

function onFocus(){	
	document.getElementById("id").focus();
}
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>