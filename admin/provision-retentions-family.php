<?php 

include("session-provision.php"); 
include("functions.php");

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

					Provisión <small>Reparacion de Tipos de Retenciones</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

					  </li>

						<li>

							<a href="#">Provisión</a>

							<i class="fa fa-angle-right"></i>

						</li>

					<li>

							<a href="#">Familia de retenciones</a>

							<i class="fa fa-angle-right"></i>

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->
           
		    <? if(($_SESSION['email'] == 'ecastro@casapellas.com.ni') or ($_SESSION['email'] == 'rsomarriba@casapellas.com') or ($_SESSION['email'] == 'vruiz@casapellas.com.ni') or ($_SESSION['email'] == 'jrlopez@casapellas.com.ni') or ($_SESSION['email'] == 'hgaitan@casapellas.com.ni') or ($_SESSION['email'] == 'jairovargasg@gmail.com') or ($_SESSION['email'] == 'gramirez@casapellas.com.ni')){ ?>
			
			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

                    <? 
					
								$sqlu = "";
								$numu = 0;
								$queryu = "select * from routes where worker = '$_SESSION[userid]' and type = '5'";
								$resultu = mysqli_query($con, $queryu);
								$numu = mysqli_num_rows($resultu);
								if($numu > 0){
									$firstu = 1;
									
									/*while($rowu=mysqli_fetch_array($resultu)){
										if($firstu == 1){ //First
											$sqlu = " and (((payments.route = '$rowu[unit]'))";
											if($numu == 1){
												$sqlu .= ")";
											}
											$firstu++;
										}elseif($firstu == $numu){ //Last
											$sqlu .= " or ((payments.route = '$rowu[unit]')))";
											$firstu++;
										}else{ //Middle
											$sqlu .= " or ((payments.route = '$rowu[unit]'))";
											$firstu++;
										}
									}*/
									
									$sqlu = " and payments.company = '1'"; 
									
									$query = "select payments.id, payments.parent, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.currency, payments.fprovision, payments.payment, payments.globalpayment, payments.expiration from payments inner join workers on payments.userid = workers.code inner join times on payments.id = times.payment where payments.company = '1' and payments.child='0' and payments.approved = '1' and payments.ret2a > '0' and payments.retfamily = 0 and ((payments.credit = 0) or (payments.credit = 2)) and payments.status > '8' and ((payments.status < '14') or ((times.now > '2018-10-03 16:00:26') and (times.stage = '14')))".$sqlu." group by payments.id order by payments.fprovision, payments.expiration asc";  
									//and payments.status > '8' 
									$result = mysqli_query($con, $query);
									$num = mysqli_num_rows($result);
									
								}
								
					if($num > 0){ ?>
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<? echo $num; ?> Solicitudes pendientes de reparación [Casa Pellas]

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">
							
                               <?php if($num > 0){ ?>
                                
                               <p><strong>IDS:</strong> ID de Solicitud</p>
                                	
                               <? if($_GET['echo'] == 1){ echo $query;  } ?>
                                <div class="table-container">
								<div class="table-scrollable">
								<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									
										 <th width="5%">

										 IDS</th>

									<th width="20%">

										 Beneficiario</th>

									<th width="5%">Total Pagar</th>

									<th width="5%">

										 Vencimiento

									</th>

									<th width="10%">

										 Estado

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
								
								$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']); 
								
								if($row['parent'] == 1){
									$ben_name = '<i class="fa fa-users"></i> Pasantes Varios';
								}elseif($row['parent'] == 2){
									$ben_name = '<i class="fa fa-users"></i> Colaboradores Varios';
								}
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, $querystagemain = "select * from times where payment = '$row[id]' order by id desc limit 1")); 
								$rowstage = mysqli_fetch_array(mysqli_query($con, $querystage="select * from stages where id = '$rowstagemain[stage]'"));
									
									$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                
                                <td><?php echo $row['id']; ?></td>
                                <td>
                                
                                <?php echo $ben_name; ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'];
								if($row['parent'] == 0){
									echo str_replace('.00','',number_format($row['payment'], 2));
								}else{
									echo str_replace('.00','',number_format($row['globalpayment'], 2));
								}
								?></td><td><?php $date1 = date("Y-m-d");
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
									
							
								
							</td><td><a href="provision-retentions-family-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> </td></tr> 
                                <?php } } else { ?>
                                
                                <div class="note note-success">

						<p>

							NOTA: Ninguna provisión pendiente.
						</p>

					</div>
                                <?php } ?>
                                </tbody>

								</table>
								</div></div>
								
								
								

							</div>

						</div>

					</div>
                 	<? } ?>

					<!-- End: life time stats -->

				</div>
               
            
			</div>
			
			<? 
			} 
			
			if(($_SESSION['email'] == 'mllopez@casapellas.com.ni') or ($_SESSION['email'] == 'rsomarriba@casapellas.com') or ($_SESSION['email'] == 'vruiz@casapellas.com.ni')){
										
			?>						
									
			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

                    <? 
					
								$sqlu = "";
								$numu = 0;
								$queryu = "select * from routes where worker = '$_SESSION[userid]' and type = '5'";
								$resultu = mysqli_query($con, $queryu);
								$numu = mysqli_num_rows($resultu);
								if($numu > 0){
									$firstu = 1;
									
									/*while($rowu=mysqli_fetch_array($resultu)){
										if($firstu == 1){ //First
											$sqlu = " and (((payments.route = '$rowu[unit]'))";
											if($numu == 1){
												$sqlu .= ")";
											}
											$firstu++;
										}elseif($firstu == $numu){ //Last
											$sqlu .= " or ((payments.route = '$rowu[unit]')))";
											$firstu++;
										}else{ //Middle
											$sqlu .= " or ((payments.route = '$rowu[unit]'))";
											$firstu++;
										}
									}*/
									
									$sqlu = " and payments.company = '3'";
									
									$query = "select payments.id, payments.parent, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.currency, payments.fprovision, payments.payment, payments.globalpayment, payments.expiration from payments inner join workers on payments.userid = workers.code inner join times on payments.id = times.payment where payments.company = '3' and payments.child='0' and payments.approved = '1' and payments.ret2a > '0' and payments.retfamily = 0 and ((payments.credit = 0) or (payments.credit = 2)) and payments.status > '8' and ((payments.status < '14') or ((times.now > '2018-10-03 16:00:26') and (times.stage = '14')))".$sqlu." group by payments.id order by payments.fprovision, payments.expiration asc";   
									//and payments.status > '8' 
									$result = mysqli_query($con, $query);
									$num = mysqli_num_rows($result);
									
								}
									
									
					if($num > 0){ ?>
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<? echo $num; ?> Solicitudes pendientes de reparación [Velosa]

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">
							
                               <?php if($num > 0){ ?>
                                
                               <p><strong>IDS:</strong> ID de Solicitud</p>
                                	
                               <? if($_GET['echo'] == 1){ echo $query;  } ?>
                                <div class="table-container">
								<div class="table-scrollable">
								<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									
										 <th width="5%">

										 IDS</th>

									<th width="20%">

										 Beneficiario</th>

									<th width="5%">Total Pagar</th>

									<th width="5%">

										 Vencimiento

									</th>

									<th width="10%">

										 Estado

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
								
								$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']); 
								
								if($row['parent'] == 1){
									$ben_name = '<i class="fa fa-users"></i> Pasantes Varios';
								}elseif($row['parent'] == 2){
									$ben_name = '<i class="fa fa-users"></i> Colaboradores Varios';
								}
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, $querystagemain = "select * from times where payment = '$row[id]' order by id desc limit 1")); 
								$rowstage = mysqli_fetch_array(mysqli_query($con, $querystage="select * from stages where id = '$rowstagemain[stage]'"));
									
									$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                
                                <td><?php echo $row['id']; ?></td>
                                <td>
                                
                                <?php echo $ben_name; ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'];
								if($row['parent'] == 0){
									echo str_replace('.00','',number_format($row['payment'], 2));
								}else{
									echo str_replace('.00','',number_format($row['globalpayment'], 2));
								}
								?></td><td><?php $date1 = date("Y-m-d");
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
									
							
								
							</td><td><a href="provision-retentions-family-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> </td></tr> 
                                <?php } } else { ?>
                                
                                <div class="note note-success">

						<p>

							NOTA: Ninguna provisión pendiente.
						</p>

					</div>
                                <?php } ?>
                                </tbody>

								</table>
								</div></div>
								
								
								

							</div>

						</div>

					</div>
                    <? } ?>

					<!-- End: life time stats -->

				</div>
               
            
			</div>
			
			<? } ?>

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