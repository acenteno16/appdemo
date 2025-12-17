<?php 

include("session-bankingDebtAdmin.php");   
include("functions.php"); 

$companyArr = array();
$companies = $_GET['company'];
foreach($companies as $company) {
    $companyArr[] = $company;
}

$bankArr = array();
$banks = $_GET['bank'];
foreach($banks as $bank) {
    $bankArr[] = $bank;
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

							<a href="#">Contratos</a>

						

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

<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Compañía:</label>

						
											<select name="company[]" class="form-control  select2me" id="company" data-placeholder="Seleccionar..." multiple>

												<option value="">Todos las compañías</option>
 <?php 
 

$queryproviders = "select * from companies";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <?php if(in_array($rowproviders["id"], $companyArr)) echo 'selected'; ?>><?php echo $rowproviders["name"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Banco:</label>

						
											<select name="bank[]" class="form-control  select2me" id="bank" data-placeholder="Seleccionar..." multiple>

												<option value="">Todos los Bancos</option>
<?php 

$filter_worker = 0;
if(isset($_GET['worker'])){
	$filter_worker = $_GET['worker'];
}

$queryproviders = "select * from banks";
$resultproviders = mysqli_query($con, $queryproviders);
while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <?php if(in_array($rowproviders["id"], $bankArr)) echo 'selected'; ?>><?php echo $rowproviders["name"]; ?></option>
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
<div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de contrato:</label>
                                                        <input name="number" type="text" class="form-control" id="number" value="<?php if(isset($_GET['number'])){ echo $_GET['number']; } ?>">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
<? /*<div class="col-md-2 ">
													  <div class="form-group">
														<label> No. de Factura:</label>
                                                        <input name="bill" type="text" class="form-control" id="bill" value="<?php if(isset($_GET['bill'])){ echo $_GET['bill']; } ?>">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>*/ ?>




                             
<div class="row"></div>

<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button> <button type="button" class="btn red" onClick="resetFilter();"><i class="fa fa-filter"></i> Quitar Filtro</button>  <script>
                            function resetFilter(){
                            
                            window.location = "bankingDebtContracts.php";
							
                            }
                            </script>
												
                 </div>                               
 </form>
</div>
</div>
</div>
			
			<div class="row">
				<? 
				$today = date('Y-m-d'); 
$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}
								
$sql1 = '';
if(sizeof($companyArr) > 0){
    $companyStr = implode(', ', $companyArr);
	$sql1 = " and company in ($companyStr)";
}	
															
$sql2 = '';
if(sizeof($bankArr) > 0){
    $bankStr = implode(', ',$bankArr);
	$sql2 = " and bank in ($bankStr)";
}	
$sql = $sql1.$sql2;
				?>
			<? include('dashboard-bankingDebt.php'); ?>
			</div>
			
			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
 
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Contratos
							</div>

							<div class="actions">
							
							
								<a href="bankingDebtContract.php" class="btn default blue-stripe">
								<i class="icon-notebook"></i>
								<span class="hidden-480">
								Agregar contrato</span> 
								</a>
								
								

							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

<?php 


								
$query = "select * from bankingDebtContracts where id > '0' and parent = '0'$sql";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);

                            if($_GET['echo'] == 1){
                                echo $query;
                            }    
                                
$query1 = "select * from bankingDebtContracts where id > '0' and parent = '0'$sql order by id desc limit ".$inicio.",".$tampagina;  
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;							

if($numdev > 0){ 
                                
                             
    
                                ?>
                                
                                <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="1%">

										 CID</th>
									<th width="1%">

										 Tipo</th>
									<th width="8%">

										 Fecha</th>

									<th width="15%">

										 Compañía</th>

									<th width="15%">Banco</th>

									<? /*<th width="15%">

										 Número

									</th>*/ ?>

									
									<th width="8%">

										 Moneda

									</th>
									<th width="8%">

										Monto

									</th>
									<th width="8%">

										 Balance

									</th>
                                    <? /*<th width="8%">

										 Balance Madre

									</th>*/ ?>
									

									<th width="15%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
									
                                <?php 
				
    $querycompany = "select * from companies";
    $resultcompany = mysqli_query($con, $querycompany);
    while($rowcompany=mysqli_fetch_array($resultcompany)){
        $theCompany["$rowcompany[id]"] = $rowcompany['name'];
    }

				
	$querybanks = "select * from banks";
    $resultbanks = mysqli_query($con, $querybanks);
    while($rowbanks=mysqli_fetch_array($resultbanks)){
        $theBank["$rowbanks[id]"] = $rowbanks['name'];
    }
				while($row=mysqli_fetch_array($result1)){
					
                    
                    if($row[ 'currency' ] == 1){
						$thisCurrency = 'Córdobas';
						$pre = 'C$';
      				}elseif($row['currency'] == 2){
        				$thisCurrency = 'Dólares';
						$pre = 'U$';
					} 
					
					$queryBalance = "select balance from bankingDebtContractBalance where bankingDebtContract = '$row[id]' order by id desc limit 1";
					$resultBalance = mysqli_query($con, $queryBalance);
					$rowBalance = mysqli_fetch_array($resultBalance); 
                    
                      $queryParentBalance = "select balance from bankingDebtContractParentBalance where bankingDebtContract = '$row[id]' order by id desc limit 1";
	                  $resultParentBalance = mysqli_query($con, $queryParentBalance);
	                  $rowParentBalance = mysqli_fetch_array($resultParentBalance);
                    
                       if($row[ 'currency' ] == 1){
                        $bankBalanceNIO[$row['bank']]+= $rowBalance['balance'];
      				}elseif($row['currency'] == 2){
                        $bankBalanceUSD[$row['bank']]+= $rowBalance['balance'];
					} 
                      
                   
								?>
                                
                                <tr role="row" class="odd">
                                <td class="sorting_1"><?php echo $row['id']; ?></td>
								<td>O</td>	
								<td><?php echo $row['today']; ?></td>
                                <td><? echo $theCompany[$row['company']]; ?></td>
                                <td><? echo $theBank[$row['bank']]; ?></td>
                                <? /*<td><? echo $row['number']; ?></td>*/ ?>
                                <td><? echo $thisCurrency; ?></td> 
								<td><? echo $pre.str_replace('.00','',number_format($row['amount'],2)); ?></td>
								<td><? echo $pre.str_replace('.00','',number_format($rowBalance['balance'],2)); ?></td>
                                <? /* //Balance madre <td><? echo $pre.str_replace('.00','',number_format($rowParentBalance['balance'],2)); ?></td> */ ?>
							
								<td>
									<? /*<a href="javascript:showMore(<? echo $row['id']; ?>);" class="btn btn-xs default btn-editable"><i class="fa fa-angle-down"></i> </a>*/ ?>
									<a href="bankingDebtContractView.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                                    <a href="bankingDebtContractEdit.php?id=<?php echo $row['id']; ?>" class="btn btn-xs yellow btn-editable"><i class="fa fa-edit"></i> Editar</a>
									<a href="javascript:deleteContract(<? echo $row['id']; ?>)" class="btn btn-xs red btn-editable"><i class="fa fa-trash-o"></i> Eliminar</a>
                            	</td></tr>
									<script>
									function showMore(id){
										$("#detail"+id).slideToggle();
									}
									</script>
									<? /*
									<tr id="detail<? echo $row['id']; ?>" style="display: none;">
										<td colspan="9">
										<? 
										$queryDetail = "select * from bankingDebt where contract = '$row[id]'";
										$resultDetail = mysqli_query($con, $queryDetail);
										$numDetail = mysqli_num_rows($resultDetail);
										if($numDetail > 0){ 
										?>
										<h4 style="margin-left: 25px;">Desembolsos</h4>
										<table class="table table-striped table-bordered table-hover" id="datatable_orders" style="margin-left: 25px; width: 70%">
										<thead>
										<tr role="row" class="heading">
											<th>DID</th>
											<th>Fecha</th>
											<th>Hora</th>
											<th>Monto</th>
											<th>Balance</th>
										</tr>
										</thead>	
										<? while($rowDetail=mysqli_fetch_array($resultDetail)){ ?>	
											<tr>
												<td><? echo $rowDetail['id']; ?></td>
												<td><? echo $rowDetail['today']; ?></td>
												<td><? echo $rowDetail['totime']; ?></td>
												<td><? echo $pre.str_replace('.00','',number_format($rowDetail['amount'],2)); ?></td>
												<td><? echo $pre.str_replace('.00','',number_format($rowDetail['balance'],2)); ?></td>
											</tr>
										<? } ?>
										</table>
										
										<? }else{ echo 'No se encontraron desembolsos.'; } ?>
										
										</td></tr>
										*/ ?>
									<tr style="display: none;"><td colspan="8"></td></tr>
									
									<? #subcupo 
									$queryParent = "select * from bankingDebtContracts where id > '0' and parent = '$row[id]'$sql";
									$resultParent = mysqli_query($con, $queryParent);
									while($rowParent=mysqli_fetch_array($resultParent)){
										
										$queryBalanceParent = "select balance from bankingDebtContractBalance where bankingDebtContract = '$rowParent[id]' order by id desc limit 1";
										$resultBalanceParent = mysqli_query($con, $queryBalanceParent);
										$rowBalanceParent = mysqli_fetch_array($resultBalanceParent); 
										
									?>
									<tr role="row" class="odd">
                                <td class="sorting_1"><?php echo $rowParent['id']; ?></td>
								<td>SC</td>		
								<td><?php echo $rowParent['today']; ?></td>
                                <td><? echo $globalCompany[$rowParent['company']]; ?></td>
                                <td><? echo $globalBank[$rowParent['bank']]; ?></td> 
                                <? /*<td><? echo $row['number']; ?></td>*/ ?>
                                <td><? echo $globalCurrencyName[$rowParent['currency']]; ?></td> 
								<td><? echo $pre.str_replace('.00','',number_format($rowParent['amount'],2)); ?></td>
								<td><? echo $pre.str_replace('.00','',number_format($rowBalanceParent['balance'],2)); ?></td>
                                <? //Balance madre <td>NA</td> ?>
							
								<td>
									<? /*<a href="javascript:showMore(<? echo $row['id']; ?>);" class="btn btn-xs default btn-editable"><i class="fa fa-angle-down"></i> </a>*/ ?>
									<a href="bankingDebtContractView.php?id=<?php echo $rowParent['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                                    <a href="bankingDebtContractEdit.php?id=<?php echo $rowParent['id']; ?>" class="btn btn-xs yellow btn-editable"><i class="fa fa-edit"></i> Editar</a>
									<a href="javascript:deleteContract(<? echo $rowParent['id']; ?>)" class="btn btn-xs red btn-editable"><i class="fa fa-trash-o"></i> Eliminar</a>
                            	</td></tr>
									<? } #end subcupo ?>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                <div class="row">
                                    
                                    
                                    <? if(sizeof($bankBalanceUSD) > 0){ ?>
                                     <div class="col-md-12">
                                       <h3>Disponible en Dólares</h3></div>
                               <?
     foreach($bankBalanceUSD as $bankName => $thisBalance) {
        #echo "$theBank[$bankName]: " . str_replace('.00','',number_format($thisBalance,2)) . "<br>"; ?>
                                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px; ">

					<div class="dashboard-stat white" style="height:130px; border: 4px solid #21365D;">

						<div class="visual">

							
                            <? 
         $thisBankImage = 'banks/'.$bankName.'.jpg';
         if(file_exists($thisBankImage)){ ?>
                            
                           
                            
                            <img src="<? echo $thisBankImage; ?>" height="100px">
                            <? }else{ ?>
                             <? echo $bankName; ?>
                            <? //<i class="fa fa-money"></i> */ ?>
                            <? } ?>

						</div>

						<div class="details">

							<div class="number">
								USD $<?php echo str_replace('.00','',number_format($thisBalance,2)); ?>
							</div>

							<div class="desc"><? echo $theBank[$bankName]; ?></div>
 

						</div>
                       

					

					</div>
                    

				</div>
                                <?
         
    }
                                    
                                }
    
    ?> 
                                    <? if(sizeof($bankBalanceNIO) > 0){ ?>
                                    <div class="col-md-12"><h3>Disponible en Córdobas</h3></div>
                                    <?
    
    foreach($bankBalanceNIO as $bankName => $thisBalance) {
        #echo "$theBank[$bankName]: " . str_replace('.00','',number_format($thisBalance,2)) . "<br>"; ?>
                                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px; ">

					<div class="dashboard-stat white" style="height:130px; border: 4px solid #21365D;">

						<div class="visual">

							
                            <? 
         $thisBankImage = 'banks/'.$bankName.'.jpg';
         if(file_exists($thisBankImage)){ ?>
                            
                           
                            
                            <img src="<? echo $thisBankImage; ?>" height="100px">
                            <? }else{ ?>
                             <? echo $bankName; ?>
                            <? //<i class="fa fa-money"></i> */ ?>
                            <? } ?>

						</div>

						<div class="details">

							<div class="number">
								USD $<?php echo str_replace('.00','',number_format($thisBalance,2)); ?>
							</div>

							<div class="desc"><? echo $theBank[$bankName]; ?></div>
 

						</div>
                       

					

					</div>
                    

				</div>
                                <?
         
    }
    
    }
        
        ?></div>
                                
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
                                
                                <div class="note note-success">

						<p>

							NOTA: No se encontraron contratos

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
</body>
</html>
<script>
	function deleteContract(id){
		if(confirm('Esta seguro de eliminar este contrato?') == true){
			window.location = 'bankingDebtContractDelete.php?id='+id;
		}
	}
</script>	