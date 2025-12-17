<?php include("sessions.php"); ?>
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

					Pagos <small>Solicitudes de pago</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Pagos</a>

							<i class="fa fa-angle-right"></i>

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

								<? 
								$tampagina = 100;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$query = "select * from payments where approved = '2' order by id desc";
$result = mysqli_query($con, $query);
echo $numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);  

								?> Mis solicitudes de pagos

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

								<?php $today = date('Y-m-d'); 


     

$query1 = "select * from payments where approved = '2' order by id desc limit ".$inicio.",".$tampagina;  
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;							
								
if($numdev > 0){  ?>
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 ID</th>

									<th width="13%">

										 Solicitante</th>

									<th width="15%">

										 Estado

									</th>
                                    	<th width="15%">

										 Usuario
									</th>
                                    <th width="15%">

										 Fecha
									</th>
                                    <th width="15%">

										Comentario
									</th>

									<th width="17%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
							
								
								
								$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc")); 
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								$rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowuser2 = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$rowstatus[userid]'"));
								
								
							
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?></td><td><? echo $rowuser['first']." ".$rowuser['last']; ?></td><td><?php //echo $rowstage['content']; 



						
if(($rowstatus['stage2'] != "0.00") and ($rowstatus['stage2'] != "")){  
								$color == "yellow";
								if($rowstatus['color'] != ""){
									$color = $rowstatus['color']; 
								}
								echo '<button type="button" class="btn '.$color.'">'.$rowstatus['stage2'].'</button>';
							}else{    
							$querystage = "select * from stages where id = '$rowstatus[stage]'";
								$resultstage = mysqli_query($con, $querystage);
								$rowstage = mysqli_fetch_array($resultstage);
								echo $rowstage['content'];
							}
								
								
								
								?> 
									
							
								
							</td>
                            <td><? echo $rowuser2['first']." ".$rowuser2['last']; ?></td>
                            <td><? echo date('d-m-Y',strtotime($rowstatus['today'])); ?></td>
                            <td><? echo $rowstatus['reason']; ?></td>
                            <td>
                            <?php if($row['status'] == 0){ ?>
                            <a href="payment-order.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-edit"></i> Completar</a>
                             <?php /*<a href="javascript:deletePayment(<?php echo $row['id']; ?>);"><span class="label label-danger">
									<i class="fa fa-trash-o"></i>  Eliminar </span></a>*/ ?>
                                    <script>
									function deletePayment(id){
		if (confirm("Usted desea eliminar este pago\n- Si usted no desea eliminar este pago presione cancelar.")==true){
			window.location="payments-delete.php?id="+id;	
	} 
}

									</script>
                            
                           <?php }else{ ?> 
                            <a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                            <?php } ?>
                            
                            </td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="payments.php?page=<?php echo $previous; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
										<i class="fa fa-angle-left"></i> 
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i .'</a></li>';  
		}else{
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
		  echo '<li><a href="payments.php?page='.$i .'&provider='.$_GET['provider'].'&from='.$_GET['from'].'&to='.$_GET['to'].'&request='.$_GET['request'].'&bill='.$_GET['bill'].'&form=1">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="payments.php?page=<?php echo $next; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna solicitud de pago vinculada a esta cuenta.

						</p>

					</div>
                                <?php } ?>
                             
                                
           

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