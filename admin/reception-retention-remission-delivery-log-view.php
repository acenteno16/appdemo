<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("session-reception.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$querymain = "select * from retentionenveloperemission where id = ?";
$stmtmain = $con->prepare($querymain);
$stmtmain->bind_param("i", $id);
$stmtmain->execute();
$resultmain = $stmtmain->get_result();
$rowmain = $resultmain->fetch_assoc();


$querycollector = "select * from collector where id = '$rowmain[collector]'";
$resultcollector = mysqli_query($con, $querycollector);
$rowcollector = mysqli_fetch_array($resultcollector);
$name_collector = $rowcollector['first']." ".$rowcollector['last'];

$queryuser = "select * from workers where code = '$rowmain[userid]'"; 
$resultuser = mysqli_query($con, $queryuser);
$rowuser = mysqli_fetch_array($resultuser);
$name_user = $rowuser['first']." ".$rowuser['last'];

$query = "select * from retentionenveloperemissioncontent where enveloperemission = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$num = $result->num_rows;

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

					Entrega de Retenciones <small>LOG </small>

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
                            <i class="fa fa-angle-right"></i>
                            </li>
                            <li>

							<a href="reception-retention-remission-delivery-log.php">LOG</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                             <li>

							<a href="#">Visor</a>
                            
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

								
	
<div class="row">
				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

						<div class="caption">Información de Remisión</div>
						
						<br><br>
						<div class="note note-regular">
						
						<p><strong>ID de remisión:</strong> <? echo $id; ?><br>
						<strong>Serie de remisión:</strong> e <br>
						<strong>Fecha:</strong> <? echo $rowmain['today'].' @'.$rowmain['now']; ?><br>
						<strong>Usuario:</strong> <? echo $name_user; ?><br>
					
                            <? if($rowmain['collector'] == 1){ ?> 
                            <strong>Entrega a Proveedor:</strong> <? echo $rowmain['name']." (".$rowmain['nid'].")"; ?><br>
                             <? }else{  ?>
                            <strong>Colector:</strong> <? echo $name_collector." (".$rowmain['nid'].")" ?><br>
                            <? } ?><br>
						<a href="reception-retention-remission-delivery-detail-print.php?id=<? echo $_GET['id']; ?>" class="btn btn blue btn-editable" target="_blank"><i class="fa fa-print"></i> Imprimir</a>
						</p>
						</div>
						
						
						<div class="caption">Sobres incluidos</div>
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
							
							<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="4%"> Sobre</th>
									<th width="40%">Proveedor</th>
									<th width="20%">Ret. más antigua</th>
									<th width="20%">Cant. de Retenciones</th>
									<th width="30%">Opciones</th>

								</tr>

								</thead>

								<tbody>
                                                                
                                <?php 
								
								while ($row = $result->fetch_assoc()){
								
								$queryenvelope = "select * from retentionenvelope where id = '$row[envelope]'";
								$resultenvelope = mysqli_query($con, $queryenvelope);
								$rowenvelope = mysqli_fetch_array($resultenvelope);
								
								$queryenvelope2 = "select * from retentionenvelopecontent where envelope = '$row[envelope]'";
								$resultenvelope2 = mysqli_query($con, $queryenvelope2);
								$numenvelope2 = mysqli_num_rows($resultenvelope2);
								
								
								
								if($rowenvelope['type'] == 1){
										$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$rowenvelope[provider]'"));
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
										$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$rowenvelope[provider]'"));
										$providername = $rowuser['code']." | ".$rowuser['first'].' '.$rowuser['last'];
										$location = "Recepcion";
								}
									
								?>
                                <tr role="row" class="odd">
                                <td class="sorting_1"><? echo $rowenvelope['id']; ?>
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
								echo $rowenvelope['lastdate'];
								
								?> </td>
                                <td><? echo $numenvelope2; ?></td> 
                                <td><a href="reception-retention-remission-delivery-detail.php?id=<? echo $rowenvelope['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a>
                                 </td>
                                </tr>
                                <?php }  ?>
                                                                </tbody>

								</table>
						
							 
							<? } ?>
							</div>

						</div>

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