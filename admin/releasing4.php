`<?php include("session-releasing.php"); ?>
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

					Liberación <small>Liberación de pagos</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

					  </li>

						<li>

							<a href="#">Liberación</a>

							<i class="fa fa-angle-right"></i>

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>


<?php $thisyear = date("Y");
$thismonth = date("m");
$fmtoday = $thisyear."-".$thismonth."-1";

//todos los pagos provisionados

$queryprovisioned = "select payments.* from payments inner join times on payments.id = times.payment where (payments.status >= '8') and times.today >= '$fmtoday' group by times.payment";
$resultprovisioned = mysqli_query($con, $queryprovisioned);
$numprovisioned = mysqli_num_rows($resultprovisioned);

$query = "select routes.* from routes where type = '6' and percent > 0";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
$rowworker = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[worker]'"));

//procesados (liberacion, rechazo en liberacion, envio a provision)
$queryprovisioned2 = "select payments.* from payments inner join times on payments.id = times.payment where ((times.stage = '7.02') or (times.stage = '9') or (times.stage = '11')) and times.today >= '$fmtoday' and times.userid = '$row[worker]' group by times.payment";
$resultprovisioned2 = mysqli_query($con, $queryprovisioned2);
$numprovisioned2 = mysqli_num_rows($resultprovisioned2);

//Porcentaje asignado
$mypercent = $row['percent']; //=10
//Numero de solicitudes que debería de liberar
$mypercent2 = $numprovisioned*($mypercent/100); //=2.3

//Numero de solicitudes liberadas
$liberations = $numprovisioned2; //=1


$ndata = ($liberations*100)/$mypercent2; //=43.47 
$ndata2 = 100-$ndata;
$workercode = $rowworker['code'];
$ndata3[$workercode] = ($ndata2*$mypercent2)/100;



$liberations2 = $mypercent2-$liberations;

$tliberations = ($liberations*100)/$mypercent2;

?>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px;">

					<div class="dashboard-stat <?php if($tliberations < 33){
	echo 'blue';
}elseif($tliberations < 66){
	echo 'blue'; 
}else{
	echo 'blue';
}

?>">

						<div class="visual">

							<i class="glyphicon glyphicon-signal"></i>

						</div>

						<div class="details">

							<div class="number">
<?php echo str_replace('.00','',number_format($ndata,2)); ?>%
							</div>

							<div class="desc">

									<?php $apellido = explode(" ",$rowworker["last"]); 
																echo $rowworker["first"][0].". ".$apellido[0]; ?><br>
<?php //echo $liberations2; ?> </div>

						</div>

					

					</div>
                    

				</div>
                                                           
<?php }

?>

<?php //Personal (Usuario Activo)

$queryroute = "select routes.* from routes where type = '6' and percent > 0 and worker = '$_SESSION[userid]'";
$resultroute = mysqli_query($con, $queryroute);
$rowroute=mysqli_fetch_array($resultroute);
	

$rowworker = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$_SESSION[userid]'"));

$queryprovisioned2 = "select payments.* from payments inner join times on payments.id = times.payment where ((payments.status = '7.02') or (payments.status  = '9') or (payments.status  = '11')) and times.today >= '$fmtoday' and times.userid = '$rowworker[code]' group by times.payment";
$resultprovisioned2 = mysqli_query($con, $queryprovisioned2);
$numprovisioned2 = mysqli_num_rows($resultprovisioned2);

//Porcentaje asignado
$mypercent = $rowroute['percent'];
//Numero de solicitudes que debería de liberar
$mypercent2 = ($numprovisioned*$mypercent)/100;

//Numero de solicitudes liberadas
$liberations = $numprovisioned2;

$liberations2 = $mypercent2-$liberations;

$tliberations = ($liberations*100)/$mypercent2;



?>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px;">

					<div class="dashboard-stat <?php if($tliberations < 33){
	echo 'blue';
}elseif($tliberations < 66){
	echo 'blue'; 
}else{
	echo 'blue';
}

?>">

						<div class="visual">

							<?php //<i class="glyphicon glyphicon-signal"></i>?>

						</div>

						<div class="details">

							<div class="number">
                            
<?php $usercode = $_SESSION['userid'];
if($ndata3[$usercode]> 0){ echo number_format($ndata3[$usercode]); } else { echo "0"; } ?>
							</div>

							<div class="desc">

									Liberaciones faltantes</div>

						</div>

					

					</div>
                    

				</div>
                
                

<div class="note note-regular">
<div class="row">
<div class="col-md-12">

<form id="ungrouped" name="ungrouped" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
<input name="form" type="hidden" id="form" value="1">

							
<h4 style="margin-left:15px;">Filtro:</h4><br>

<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Proveedor:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value="">Todos los Proveedores</option>
 <?php $queryproviders = "select * from providers order by name";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Colaborador:</label>

						
											<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar...">

												<option value="">Todos los Colaboradores</option>
 <?php $queryproviders = "select * from workers order by first,last";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
<?php /*                                                    
<div class="col-md-4">
                                                    <label class="control-label">Rango de Fechas:</label>

											<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">

												<input type="text" class="form-control" name="from" placeholder="desde">

												<span class="input-group-addon">

												<i class="fa fa-angle-double-right"></i></span>

												<input type="text" class="form-control" name="to" placeholder="hasta">

											</div>

											<!-- /input-group -->

											
										</div>
<div class="row"></div>
*/ ?>
<div class="col-md-4 ">
													  <div class="form-group">
														<label>No. de Solicitud:</label>
                                                        <input name="request" type="text" class="form-control" id="request" value="">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>

                                                    
<div class="row"></div> 
<div class="col-md-4 ">
													  <div class="form-group">
														<label> No. de Factura:</label>
                                                        <input name="bill" type="text" class="form-control" id="bill" value="">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>

<div class="col-md-4 ">
													  <div class="form-group">
														<label> No. de Batch:</label>
                                                        <input name="batch" type="text" class="form-control" id="batch" value="">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-4 ">
													  <div class="form-group">
														<label>No. de Documento:</label>
                                                        <input name="document" type="text" class="form-control" id="document" value="">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>




                             
<div class="row"></div>
<br>
<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button> <button type="button" class="btn red" onClick="resetFilter();"><i class="fa fa-filter"></i> Quitar Filtro</button>  <script>
                            function resetFilter(){
                            
                            window.location = "releasing.php";
							
                            }
                            </script>
												
                 </div>                               
 </form>
</div>
</div>
</div>
			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<?php //$query = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.status = '8' and payments.approved = '1' and workers.unit = '$_SESSION[unit]' order by payments.expiration desc"; 

$sql1 = "";
if($_GET['provider'] != ""){
$sql1 = " and payments.provider = '$_GET[provider]'";
}
$sql2 = "";
if($_GET['worker'] != ""){
$sql2 = " and payments.collaborator = '$_GET[worker]'";
}
$sql3 = "";
if($_GET['request'] != ""){
$sql3 = " and payments.id = '$_GET[request]'";
}
$sql4 = "";
if($_GET['bill'] != ""){
$sql4 = " and bills.number = '$_GET[bill]'";
}
$sql5 = "";
if($_GET['batch'] != ""){
$sql5 = " and batch.nobatch = '$_GET[batch]'";
}
$sql6 = "";
if($_GET['document'] != ""){
$sql6 = " and batch.nodocument = '$_GET[document]'";
}
/*$sql4 = "";
if($_GET['from'] != ""){
$from = date("Y-m-d", strtotime($_GET['from']));
$sql4 = " and times.today >= '$from'";
}
$sql5 = "";
if($_GET['to'] != ""){
$to = date("Y-m-d", strtotime($_GET['to']));
$sql5 = " and times.today <= '$to'";
}
*/

$sql = $sql0.$sql1.$sql2.$sql3.$sql4.$sql5;
											  
//$query = "select * from payments inner join workers on payments.userid = workers.code left join bills on payments.id = bills.payment where payments.status = '8' and payments.approved = '1'".$sql." order by payments.expiration asc";

//$query = "select payments.* from payments left join bills on payments.id = bills.payment where payments.status = '8' and payments.aprovision = '1' and payments.approved = '1'".$sql." group by payments.id order by payments.expiration asc"; 

$query = "select payments.* from payments left join bills on payments.id = bills.payment left join batch on payments.id = batch.payment where payments.status = '8' and payments.aprovision = '1' and payments.approved = '1'".$sql." group by payments.id order by payments.expiration asc";  
  
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
			?>
            <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<?php echo $num;?> Pagos por liberar

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								<?php if($num > 0){ ?>
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									
                                         <th width="1%">

										 ID</th>

									<th width="2%">

										 Código</th>

									<th width="15%">

										 Nombre</th>

									<th width="10%">Total Pagar</th>

									<th width="10%">

										 Vencimiento

									</th>

									<th width="10%">

										 Estado

									</th>

									<th width="10%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
								if($row['btype'] == 1){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								}
								else{
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
								}
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"> <?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td><td><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; if($row['btype'] == 1){ echo $rowprovider['name'];
								}else{
									echo $rowprovider['first']." ".$rowprovider['last']; } ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); ?></td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
?></td><td><?php echo $rowstage['content']; ?> 
									
							
								
							</td><td> 
                            <?php 
							if(($row['blockrelease'] == "") or ($row['blockrelease'] == $_SESSION['userid'])){ ?>
                            <a href="releasing-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> <?php }
							else{ ?>
                      <a href="#" class="btn btn-xs default btn-editable"><i class="fa fa-lock"></i> Bloqueado</a>      
                            <? } ?></td></tr>
                                <?php } } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: Ninguna liberación pendiente.
						</p>

					</div>
                                <?php } ?>
                                </tbody>

								</table>

							</div>

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