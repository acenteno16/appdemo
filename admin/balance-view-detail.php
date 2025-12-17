<?php 
exit();
include("sessions.php"); 

$id = $_GET['company']; 

$querycompany = "select * from companies where id = '$id'";
$resultcompany = mysqli_query($con, $querycompany);
$rowcompany=mysqli_fetch_array($resultcompany); 
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

					Fondo disponible <small>Estados de Cuenta</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="jt.php">JT</a>

							<i class="fa fa-angle-right"></i>

						</li>
						
						<li>

							<a href="balance.php">Fondo Disponible</a>
							<i class="fa fa-angle-right"></i>
							

						</li>
						
						<li>

							<a href="#"><? echo $rowcompany['name']; ?></a>
							<i class="fa fa-angle-right"></i>

							

						</li>
						<li><a href="#">Detalle</a></li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">

			

					<!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<i class="fa fa-exchange"></i>Estados de cuenta <? switch($_GET['currency']){
								case 1:
								echo "NIO";
								break;
								case 2:
								echo "USD"; 
								break;
}
								?></div>

							<div class="actions">

								<a href="balance-credit.php?company=<? echo $id; ?>&currency=<? echo $_GET['currency']?>" class="btn default blue-stripe"> 

								<i class="fa fa-arrow-circle-down"></i>

								<span class="hidden-480">

								Notas de credito</span>

								</a>

<a href="balance-debit.php?company=<? echo $id; ?>&currency=<? echo $_GET['currency']; ?>" class="btn default blue-stripe">

								<i class="fa fa-arrow-circle-up"></i>

								<span class="hidden-480">

								Notas de debito</span>

								</a>

							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								
<div class="col-md-3 " style="left:-15px;">
													  <div class="form-group">
											
														<select name="currency" class="form-control" id="currency" onChange="javascript:changePage1(this.value);">
														  <option value="0">Todas las transacciones</option>
                                                    <option value="1" <?php if($_GET['transactions'] == 1) echo 'selected'; ?>>Notas de crédito</option>
                                                    <option value="2" <?php if($_GET['transactions'] == 2) echo 'selected'; ?>>Notas de débito</option>
                                                   
													    </select>
                                                        <script>
														function changePage1(val){
															if(val == 0){
																window.location = 'balance-view-detail.php?company=<? echo $id; ?>&currency=<? echo $_GET['currency']; ?>'; 
															}
															if(val > 0){
																window.location = 'balance-view-detail.php?company=<? echo $id; ?>&currency=<? echo $_GET['currency']; ?>&transactions='+val;
															}
											
														}
														</script>
														

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                      
                                                      <!--/row--></div>
													</div>
								
                                <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="2">IDT</th>

									<th width="10%">

										 Fecha</th>

									<th width="10%">

										 Hora

									</th>

									<th width="5%">

										Tipo</th>

									<th width="60%">

										 Descripción</th>

									<th width="5%">

										 Monto</th>

									<th width="5%">

										 Balance

									</th>

								</tr>

								</thead>

								<tbody>
                               <?php 
							   		
							   $tampagina = 50;
							   $pagina = $_GET['page'];
								if(!$pagina){
									$inicio = 0;
									$pagina = 1;
								}else{
									$inicio=($pagina-1)*$tampagina;
								}
									$transactions = $_GET['transactions'];
							   $sql = " ";
							   if($transactions == 1){
								   $sql = " and type = 'nc' ";
							   }
							   if($transactions == 2){
								   $sql = " and type = 'nd' ";
							   }
							   $query = "select * from balance where currency = '$_GET[currency]' and company = '1'".$sql."order by id desc";
							   $result = mysqli_query($con, $query);
									
							   $numdev = mysqli_num_rows($result);
							   $totpagina = ceil($numdev / $tampagina);       



								$query1 = "select * from balance where currency = '$_GET[currency]' and company = '1'".$sql."order by id desc limit ".$inicio.",".$tampagina;  
								$result1 = mysqli_query($con, $query1); 
								if($pagina < $totpagina) $next = $pagina+1;
								if($pagina > 1) $previous = $pagina-1;	
									
									
							   while($row=mysqli_fetch_array($result1)){
							   ?> 
                                <tr role="row" class="odd">
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['today']; ?></td>
                                <td><?php echo $row['now']; ?></td>
                                <td><?php echo strtoupper($row['type']); ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo number_format($row['ammount'],2); ?></td>
                                <td><?php echo number_format($row['balance'],2); ?></td>  
                                </tr><?php } ?>

								</tbody>

								</table>
                              
								<div>
								<? 
									$str = "&company=".$_GET['company']."&currency=".$_GET['currency'];
									if(isset($_GET['transactions'])){
										$str.= "&transactions=".$_GET['transactions']; 
									}
									
								?> 
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
								<li>
									<a href="<? echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $previous; ?>&form=1<? echo $str; ?>">
									<i class="fa fa-angle-left"></i> 
									</a>
								</li>
                  				<?php } 
							if ($totpagina > 1){
  
  								for ($i=1;$i<=$totpagina;$i++){ 
        							if ($pagina == $i){ ?>
										<li class="active"><a href="#"><? echo $i; ?></a></li>';  
									<? }else{ 
									//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página	
									?>
          
		  							<li><a href="<? echo $_SERVER['PHP_SELF']; ?>?page=<? echo $i; ?>&form=1<? echo $str; ?>"><? echo $i; ?></a></li>
									<?
									}
    							} 
							} if($next != ""){ ?>
                 
                 
                 					<li>
										<a href="<? echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $next; ?>&form=1<? echo $str; ?>">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
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