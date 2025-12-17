<?php 

include("session-reception.php");

$id = $_GET['id'];

$query = "select * from retentionenvelope where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);


if($row['type'] == 1){
	$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
	$providername = $rowuser['code']." | ".$rowuser['name'];
	$providertype = "Proveedor";
}else{
	$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[provider]'"));
	$providername = $rowuser['code']." | ".$rowuser['first'].' '.$rowuser['last']; 
	$providertype = "Colaborador";
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

					Remisiones de Retenciones <small>Detalle de Sobre </small>

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

							<a href="reception-retention-remission-delivery.php">Entrega</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                            
                             <li>

							<a href="#">Detalle</a>
                            
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
						
						<div class="note note-regular"> 
                             <h3 class="form-section">Información del <? echo $providertype; ?></h3>
                            
							<p><strong>Nombre:</strong> <?php echo $providername; ?><br>
                            Dirección: <? echo $rowuser['address']; ?><br>
                            <? if($rowuser['email'] != ""){ ?><strong>Email:</strong> <?php echo $rowuser['email']; ?> <br>
                            <? } ?>
                            <? 
							if($rowuser['location'] > 0){ 
							$querylocation = "select * from providerslocation where id = '$rowuser[location]'";
							$resultlocation = mysqli_query($con, $querylocation);
							$rowlocation = mysqli_fetch_array($resultlocation);
							?>
							<strong>Ubicación:</strong> <?php echo $rowlocation['name']; ?> <a href="?id=<? echo $_GET['id']; ?>&edit=1">[Editar]</a> <br> 
							<? }
							if(($rowuser['location'] == 0) or ($_GET['edit'] == 1)){ ?> 
                            <form enctype="multipart/form-data" method="post" action="reception-retention-remission-delivery-detail-location.php"> 
                            
<input type="hidden" id="btype" name="btype" value="<? echo $row['type']; ?>"> 
<input type="hidden" id="ben" name="ben" value="<? echo $row['provider']; ?>">
<div class="form-group"> 

	<label class="control-label">Ubicación:</label>

						
											<select name="location" class="form-control" id="location" data-placeholder="Seleccionar...">

												<option value="">Seleccionar</option>
 											<?php 
											$queryproviders = "select * from providerslocation order by id";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["name"]; ?></option>
                                            <?php 
												
												}
												
											?>

												

											</select><br>

<button type="submit" class="btn blue"><i class="fa fa-edit"></i> Actualizar</button> 


													</div>
							</form>
                            <? } ?>
                             </p>

							

</div>      

											
											<div class="caption">Retenciones incluidas</div>										
												
												
<? /*
						<div class="caption">Entrega de remisiones</div>
						<? /*<div class="actions">

								<a href="reception-retention-remission-records.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Ver historial</span>

								</a>

							

							</div>*/ /*?>
							

						</div>
*/ ?>
						<div class="portlet-body">
							
							
							<div class="table-container">

<form enctype="multipart/form-data" method="post" action="reception-retention-remission-delivery-detail-code.php">
							<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									
									<th width="50%">

										 Retenciones IR</th>

									<th width="50%">

										 Retenciones IMI</th>

								  </tr>

								</thead>

								<tbody>
                                                                
                               
                                <tr role="row" class="odd">
                                <td><?php  
								
								$queryir = "select irretention.id, irretention.number from retentionenvelopecontent inner join irretention on irretention.id = retentionenvelopecontent.retention where retentionenvelopecontent.envelope = '$id' and retentionenvelopecontent.type = '2'";  
								$resultir = mysqli_query($con, $queryir);
								$numir = mysqli_num_rows($resultir);
								if($numir == 0){
									echo "Sin retenciones";
								}else{
									while($rowir=mysqli_fetch_array($resultir)){
										$queryirrem = "select * from irremissioncontent where irretention = '$rowir[id]'";
										$resultirrem = mysqli_query($con, $queryirrem);
										$rowirrem = mysqli_fetch_array($resultirrem);
										
										echo $rowir['number']." (Remisión: ".$rowirrem['irremission'].")<br>";  
									}
								}
								
								?> </td>
                                <td><?php  
								$queryhalls = "select hallsretention.id, hallsretention.serial, hallsretention.number from retentionenvelopecontent inner join hallsretention on hallsretention.id = retentionenvelopecontent.retention where retentionenvelopecontent.envelope = '$id' and retentionenvelopecontent.type = '1'";  
								$resulthalls = mysqli_query($con, $queryhalls);
								$numhalls = mysqli_num_rows($resulthalls);
								if($numhalls == 0){ 
									echo "Sin retenciones"; 
								}else{
									while($rowhalls=mysqli_fetch_array($resulthalls)){
										$queryhallsrem = "select * from hallsremissioncontent where hallsretention = '$rowhalls[0]'";
										$resulthallsrem = mysqli_query($con, $queryhallsrem);
										$rowhallsrem = mysqli_fetch_array($resulthallsrem);
										
										//echo '<input name="hallsid[]" type="checkbox" id="hallsid[]" value="'.$rowhalls['id'].'">'.$rowhalls['serial'].'-'.$rowhalls['number']." (Remisión: ".$rowhallsrem['hallsremission'].")<br>";
										echo $rowhalls['serial'].'-'.$rowhalls['number']." (Remisión: ".$rowhallsrem['hallsremission'].")<br>";
									} 
								}
								
								?></td> 
                                </tr>
                                
                                                                </tbody>

								</table>
								
								<? /*<div class="row">

<div class="col-md-3">							

<label class="control-label">Recibe:</label>
<select name="receiver" class="form-control" id="receiver">
<option value="0">Seleccionar</option>
<option value="3">Mensajero</option>
<option value="4">Cliente</option>
</select>
												
                 </div>                             
  

<br><br>
						<div class="col-md-2">
						 
						

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-check"></i> Entregar</button> 
												
                 </div>                             
  
</div>*/ ?>
</form> 

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