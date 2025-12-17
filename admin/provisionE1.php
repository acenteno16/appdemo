<?php 

include("session-ppe1.php"); 
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

					Provisión CIC<small>[E1]</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

					  </li>

						<li>

							<a href="#">Provisión CIC [E1]</a>

							<? #<i class="fa fa-angle-right"></i> ?>

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->
            
            <div class="note note-regular">
<div class="row">
<div class="col-md-12">
<form id="ungrouped" name="ungrouped" action="
<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
<input name="form" type="hidden" id="form" value="1">

							
<h4 style="margin-left:15px;">Filtro:</h4><br>

<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Proveedor:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value="">Todos los Proveedores</option>
 <?php 
 
$filter_provider = 0;
if(isset($_GET['provider'])){
	$filter_provider = $_GET['provider'];
}
$queryproviders = "select * from providers where code != '' and name != '' order by name";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <?php if($rowproviders["id"] == $filter_provider) echo 'selected'; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option>
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
<?php 

$filter_worker = 0;
if(isset($_GET['worker'])){
	$filter_worker = $_GET['worker'];
}

$queryproviders = "select * from workers where code != '' order by first,last";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <?php if($rowproviders["id"] == $filter_worker) echo 'selected'; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
                                            <?php }
											?>

												

											</select>
														  
														  
														  

															<div title="Page 5"></div>
													  </div>

													</div>
	
	<div class="col-md-4">
													  

													  <div class="form-group">

										<label class="control-label">Solicitante:</label>
                                        <select name="requester" class="form-control  select2me" id="requester" data-placeholder="Seleccionar...">

												<option value="" selected>Todos los Colaboradores</option>
 <?php 										$queryRequester = "select id, code, first, last from workers order by first,last";
											$resultRequester = mysqli_query($con, $queryRequester);
											
											while($rowRequester = mysqli_fetch_array($resultRequester)){ 
												
												if($rowRequester["code"] != ''){
										 
											?>
                                            <option value="<?php echo $rowRequester["code"]; ?>" <? if($rowRequester["code"] == $_GET['requester']) echo 'selected'; ?>><?php echo $rowRequester["code"].' | '.$rowRequester["first"].' '.$rowRequester["last"]; ?></option>
                                            <?php }}
											?> 
												

											</select>
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
<div class="col-md-2 ">
													  <div class="form-group">
														<label>No. de Solicitud:</label>
                                                        <input name="request" type="text" class="form-control" id="request" value="<?php if(isset($_GET['request'])){ echo $_GET['request']; } ?>">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
<div class="col-md-2 ">
													  <div class="form-group">
														<label> No. de Factura:</label>
                                                        <input name="bill" type="text" class="form-control" id="bill" value="<?php if(isset($_GET['bill'])){ echo $_GET['bill']; } ?>">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>




                             
<div class="row"></div>

<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button> <button type="button" class="btn red" onClick="resetFilter();"><i class="fa fa-filter"></i> Quitar Filtro</button>  <script>
                            function resetFilter(){
                            
                            window.location = "provisionE1.php";
							
                            }
                            </script>
												
                 </div>                               
 </form>
</div>
</div>
</div>
<? 
$inner_bills = 0;

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
	$inner_bills = 1;
}
$requester = "";
if(isset($_GET['requester'])){
	$requester = $_GET['requester'];
}
$sql5 = "";
if($requester != ""){
	$sql5 = " and payments.userid = '$requester'";
}

$inner1 = "";
if($inner_bills == 1){
	$inner1 = " inner join bills on payments.id = bills.payment";
}

$inner = $inner1; 

$sql = $sql0.$sql1.$sql2.$sql3.$sql4.$sql5;

$query = "select payments.id, payments.parent, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.currency, payments.fprovision, payments.payment, payments.globalpayment, payments.expiration from payments".$inner." where payments.ppe1 = '1' and payments.child='0' and payments.approved = '1' and ((payments.credit = 0) or (payments.credit = 2))".$sqlu.$sql." order by payments.expiration asc"; 
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
			
			?>			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<? echo $num; ?> Solicitudes pendiente de Provision E1

							</div>

							
							
							<div class="actions">

								<? if(($_SESSION['email'] == 'jairovargasg@gmail.com') or (($_SESSION['email'] == 'hgaitan@casapellas.com'))){ ?>
								<a href="provisionE1ExportDataNew.php" class="btn default blue-stripe"> 

								<i class="fa fa-file-excel-o"></i>

								<span class="hidden-480">

								Descargar Data N</span>

								</a>
								<a href="provisionE1ExportData.php" class="btn default blue-stripe"> 

								<i class="fa fa-file-excel-o"></i>

								<span class="hidden-480">

								Descargar Data</span>

								</a>
								
								<? } ?>
								<a href="provisionE1Export.php" class="btn default blue-stripe"> 

								<i class="fa fa-file-excel-o"></i>

								<span class="hidden-480">

								Descargar Reporte</span>

								</a>

							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

<?php	
							
if(isset($_GET['echo'])){
	if($_GET['echo'] == 1){
		echo $query;
	} 
}
									
if($num > 0){ 
								
								?>
                                
	<p><strong>IDS:</strong> ID de Solicitud</p>

    <div class="table-container">
	<div class="table-scrollable">
	<table class="table table-striped table-bordered table-hover" id="datatable_orders">
	<thead>
	<tr role="row" class="heading">
	<th width="5%">IDS</th>
	<th width="15%">Beneficiario</th>
	<th width="5%">Total Pagar</th>
	<th width="5%">Vencimiento</th>
	<th width="10%">Estado</th>
	<th width="5%">Opciones</th>
	</tr>
	</thead>

	<tbody>
    <?php while($row=mysqli_fetch_array($result)){
								
	$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']);
								
	$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
	$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
	$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
	?>
                                
    <tr role="row" class="odd">
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $ben_name; ?></td>
    <td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'];
	if($row['parent'] == 0){
		echo str_replace('.00','',number_format($row['payment'], 2));
	}else{
		echo str_replace('.00','',number_format($row['globalpayment'], 2));
	}
	?></td>
	<td><?php 
	$date1 = date("Y-m-d");
	echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias = (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>";
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
	?></td>
	<td><?php echo $rowstage['content']; ?> 
	</td><td><a href="provisionE1-view<? if($row['parent'] > 0) echo "-cascade"; ?>.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> </td></tr>  
   
    <?php } ?>
     </tbody>
    </table>
	</div></div>

	
    <? } else { ?>
    <div class="note note-success">
	<p>NOTA: Ninguna provisión pendiente.</p>
	</div>
	<?php } ?>
   

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