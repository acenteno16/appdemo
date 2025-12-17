<?php include("session-retentions.php"); ?>
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
<?php include('fn-expiration.php'); ?>
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

					Remisiones <small>Retenciones IR</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Remsiones</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>

							<a href="#">Retenciones IR</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
 
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Mis Remisiones (Retenciones IR)

							</div>
                            
                            <div class="actions">

                               
                                <a href="retentions-generator-remission-ir-groups.php?hall=<? echo $_GET['hall']; ?>" class="btn default">
 
								<i class="fa fa-mail-reply"></i>

								<span class="hidden-480">

								Regresar</span>

								</a>
								
								<a href="retentions-generator-remission-ir-pdf.php?id=<? echo $_GET['id']; ?>" class="btn default ">
 
								<i class="fa fa-print"></i>

								<span class="hidden-480">

								Imprimir</span>

								</a>

							

							</div>

							<? /*<div class="actions">

								<a href="payments-add.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Nueva solicitud de pago</span>

								</a>

							

							</div>*/ ?>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

								<p>
								  <?php 
								
$today = date('Y-m-d'); 
$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}



$id = $_GET['id'];

$query = "select * from irremission where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);        

$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
								
$queryrets = "select * from irremissioncontent where irremission = '$row[id]'";
$resultrets = mysqli_query($con, $queryrets);
$numrets = mysqli_num_rows($resultrets);					
								
?>
								  
								  <strong>RID:</strong> <span class="sorting_1"><?php echo $row['id']; ?></span><br>
								  <strong>Usuario:</strong>
  <?php  echo $rowcollaborator['code']." | ".$rowcollaborator['first']." ".$rowcollaborator['last']; ?>
  <br>
  <strong>Fecha  hora:</strong> <?php echo $row['today']; ?><br>
  <strong>Cant. de retenciones:</strong> <? echo $numrets; ?><br>
  <strong>Estado:</strong>
  <?php 


$rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from irremissionstages where id = '$row[status]'"));
						
echo $rowstatus['name'];
								
?>
							  </p>
							
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

										 IDS</th>
                                          <th width="8%"> 

										 IDR</th>
                                         <th width="8%"> 

										 UN</th>

									

									<th width="17%">

										Proveedor/Colaborador</th>

									<th width="11%">Total Pagar</th>

									<th width="5%">

										Cancelación  CFO </th>

									<? /*<th width="14%">

										 Estado  

									</th>*/ ?> 
                                    <th width="14%">

										SUC 

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
								while($rowmain2=mysqli_fetch_array($resultrets)){
							
							$querymain = "select * from irretention where id = '$rowmain2[irretention]'";
							$resultmain = mysqli_query($con, $querymain);
							$rowmain = mysqli_fetch_array($resultmain);
							
							$query = "select * from payments where id = '$rowmain[payment]'";
							$result = mysqli_query($con, $query);
							$row = mysqli_fetch_array($result);
							
								//if($nioammount > 1){
							
									
								if($row['btype'] == 1){
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$providercollaborator = $rowprovider['code']." | ".$rowprovider['name'];
								}else{
									$queryprovider = "select * from workers where id = '$row[collaborator]'";
									$rowprovider = mysqli_fetch_array(mysqli_query($con, $queryprovider));
								$providercollaborator = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
								}
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd <?php if($row['irprinted'] == 1) echo 'success';  //if($row['status'] < 14) echo 'danger' ?>"> 
                                
                                <? //echo $query; ?>
                                
                                
                                
                                 <td class="sorting_1" id="maintheid<?php echo $table; ?>">  
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $rowmain['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); ">
                                  
                                  <? //echo $rowmain['id']; ?>
                                  </td>
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php 
								  
								  echo $rowmain['number'];
								  
								   ?></td>
                                  <td><?php echo $row['route']; ?></td>
                                  
                            
                                  <td><?php echo $providercollaborator;  ?></td>
                                  <td> <?php echo 'C$'.str_replace('.00','',number_format($row['ret2a'],2)).' Cordobas'; ?>

</td>
                                  <td>
                                  <?php 
								 $queryretdate = "select scheduletimes.* from scheduletimes inner join schedulecontent on scheduletimes.schedule = schedulecontent.schedule where scheduletimes.stage = '3.00' and schedulecontent.payment = '$row[id]'"; 
$resultretdate = mysqli_query($con, $queryretdate);  
$rowretdate = mysqli_fetch_array($resultretdate); 
if($rowretdate['today'] >= '2017-01-23'){
  echo date('d-m-Y',strtotime($rowretdate['today'])); 
}else{
	 $queryretdate = "select scheduletimes.* from scheduletimes inner join schedulecontent on scheduletimes.schedule = schedulecontent.schedule where scheduletimes.stage = '5.00' and schedulecontent.payment = '$row[id]'"; 
$resultretdate = mysqli_query($con, $queryretdate);  
$rowretdate = mysqli_fetch_array($resultretdate); 

  echo date('d-m-Y',strtotime($rowretdate['today'])); 
}
								  
								  ?>
                                  </td>
                                
                                <? /*<td><?php 
								
								if($row['irstage'] == 0){
									
									$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc")); 
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'")); 
									echo $rowstage['content']; 
								}else{
								$querymayorstage = "select * from mayorstages where id = '$row[mayorstage]'";
								$resultmayorstage = mysqli_query($con, $querymayorstage);
								$rowmayorstage = mysqli_fetch_array($resultmayorstage);
								echo $rowmayorstage['name']; 
								}
								?> 
									
							
								
							</td>*/ ?>
                            <td><?  
							
							
								$queryhall = "select name from halls where id = '$row[hall]'";
								$resulthall = mysqli_query($con, $queryhall);
								$rowhall = mysqli_fetch_array($resulthall);
								echo $rowhall['name']; 
								
							 ?></td>
                            <td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a>
                           
                            
                            
                            </td></tr>
                                <?php }
								
								?>
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

<?php /*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ ?>

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