<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include('session-bankingDebt.php');  
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
<?php #include('fn-expiration.php'); ?>
	
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

					Deuda bancaria <? //<small>Solicitudes de pago</small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  
						  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="bankingDebt.php">Deuda bancaria</a>
							<i class="fa fa-angle-right"></i>
						

						</li>
						<li>

							<a href="#">Vista especial</a>

						

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div> 

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->
			
			<?
			
			$queryBanks = "select id, name from banks";
			$resultBanks = mysqli_query($con, $queryBanks);
			while($rowBanks = mysqli_fetch_array($resultBanks)){

			#Checking Banks	
			#$query = "select bankingDebt.* from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id  where (bankingDebt.status2='0' or bankingDebt.status2='2') and bankingDebtContracts.bank = '$rowbanks[id]' order by bankingDebt.id desc";
                
            $query = "select bankingDebt.* from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where bankingDebtContracts.bank = '$rowBanks[id]' order by bankingDebt.id desc";
			$result = mysqli_query($con, $query);
			$num = mysqli_num_rows($result);
				
			
			if(isset($_GET['echo'])){
				echo '<br>'.$query;
			}								

		
			if($num > 0){
				
	
			?>

			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
 
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<? echo $rowBanks['name']; ?>
							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

						
							<?php 
				
				$queryCompanies = "select id, name from companies";
				$resultCompanies = mysqli_query($con, $queryCompanies);
				while($rowCompanies = mysqli_fetch_array($resultCompanies)){

				$query1 = "select bankingDebt.* from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id  where bankingDebtContracts.bank = '$rowBanks[id]' and bankingDebtContracts.company = '$rowCompanies[id]' order by bankingDebt.date2 desc";
				$result1 = mysqli_query($con, $query1);
				$numdev1 = mysqli_num_rows($result1);	
				
				if($numdev1 > 0){
					
					echo '<h4>'.$rowCompanies['name'].'</h4>';

  ?>
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="1%">

										 ID</th>
									<th width="8%">

										 Fecha</th>

									<th width="16%">

										 Compañía</th>

									<th width="16%">Banco</th>

									<th width="16%">

										 No. Prestamo

									</th>
									
									<th width="16%">

										 Movimiento

									</th>
									<th width="16%">

										 Fecha pago

									</th>
									<? /*
									<th width="5%">

										 Principal

									</th>
									<th width="5%">

										 Interes

									</th>
									*/ ?>

									<th width="8%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
									
                                <?php 
				

				while($row=mysqli_fetch_array($result1)){
								
					$queryContract = "select * from bankingDebtContracts where id = '$row[contract]'";
					$resultContract = mysqli_query($con, $queryContract);
					$rowContract = mysqli_fetch_array($resultContract);  
                                    
                                    
                                     $queryTransaction = "select * from bankingDebtTransactions where bankingDebt = '$row[id]' order by id desc limit 1";
					$resultTransaction = mysqli_query( $con, $queryTransaction );
					$numTransaction  = mysqli_num_rows($resultTransaction);
					$rowTransaction = mysqli_fetch_array( $resultTransaction );
                    
                    switch($rowTransaction['type']){
                        case 0:
                            $ttype = 'Desembolso';
                            break;
                        case 1:
                            $ttype ='Abono';
                            break;
                        case 2:
                            $ttype ='Pago de interés';
                            break;
                        case 3:
                            $ttype ='Cancelación';
                            break;
                        case 4:
                            $ttype ='Abono + Intereses';
                            break;
                        case 5:
                            $ttype ='Cancelación + Intereses';
                            break;
                    } 
                                    ?>
                                
                                <tr role="row" class="odd <? if($row['status2'] == 9) echo 'danger'; ?>">
                                <td class="sorting_1"><?php echo $row['id']; ?></td>
								<td><?php echo date("d-m-Y", strtotime($row['today']));	 ?></td>
                                <td><? echo $globalCompany[$rowContract['company']]; ?></td>
                                <td><? echo $globalBank[$rowContract['bank']]; ?></td>
                                <td><? echo $row['number']; $rowContract['title']; ?></td>
                                <td><? echo $ttype; ?></td>
								<td><? echo date("d-m-Y", strtotime($row['date2'])); ?></td>
								<? /*
								<td><? echo $pre.str_replace('.00','',number_format($row['balance'],2)); ?></td>
								<td><? echo $pre.str_replace('.00','',number_format($row['interest'],2)); ?></td>
								*/ ?>
								<td>
									<? /*<a href="bankingDebtDocument.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Documentar</a>*/ ?>
                                    <a href="bankingDebtView.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                            	</td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
                                
                            
                                <? } } ?>
                             
                               
						</div>

					</div>

					<!-- End: life time stats -->

				</div>

			</div>

			<!-- END PAGE CONTENT-->

		</div>
			
			<? } } ?>

		
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