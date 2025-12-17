<?php include("session-schedule.php"); ?>
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

					Reportes <?php //<small>Ordenes de pago</small> ?> 
					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

				
                        <li>

							<a href="#">Reportes</a>

						 <i class="fa fa-angle-right"></i>

						</li>
                         <li>

							<a href="#">Proveedores</a>

						

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			
           
            <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
<form id="ungrouped" name="ungrouped" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
<div class="note note-regular">
								<div class="row">
                             <h4 style="margin-left:15px;">Filtro:</h4><br>
<?php //desde aqui ?>
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Proveedor:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value="">Todos los Proveedores</option>
 <?php $queryproviders = "select * from providers where code > '0' order by name";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>" <?php if($_GET['providers'] == $rowproviders['id']) echo "selected"; ?>><?php echo $rowproviders["code"]." | ".$rowproviders["name"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
                                                    
                                                    
                             
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
                                        
                                        <div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Solicitante:</label>

						
											<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar...">

												<option value="">Todos los usuarios</option>
 <?php $queryencharged = "select * from workers";
											$resultencharged = mysqli_query($con, $queryencharged);
											
											while($rowencharged = mysqli_fetch_array($resultencharged)){
												
											
												
										
											?>
                                            <option value="<?php echo $rowencharged["code"]; ?>"><?php echo $rowencharged["first"]." ".$rowencharged['last']; ?></option>
                                            <?php }
											?>

												

											</select>

														
													  </div>

													</div>
                                                
                                                <div class="col-md-2 ">
													  <div class="form-group">
														<label>No. de Solicitud:</label>
                                                        <input name="request" type="text" class="form-control" id="request" value="">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                    
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label> No. de Factura:</label>
                                                        <input name="bill" type="text" class="form-control" id="bill" value="">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>



<?php //Hasta aqui ?>                           
</div> 

                             
<div class="row">

<br><br>
						<div class="col-md-2">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button> 
												
                 </div>                               
  
</div>
						
								</div>
                                </form>
           
           
                <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

							Resultados del filtro

							</div>

						
						</div>

						<div class="portlet-body">
                        <?php $from = $_GET['from'];
$to = $_GET['to'];
$provider = $_GET['provider'];
$request = $_GET['request'];
$bill = $_GET['bill'];
$paymenten = $_GET['paymenten'];

$sql1 = "";
if($from != ""){
$from = date("Y-m-d", strtotime($from));
$sql1 = " and times.stage = '14' and times.today >= '$from'";
}
$sql2 = "";
if($to != ""){
$to = date("Y-m-d", strtotime($to));
$sql2 = " and times.stage = '14' and times.today <= '$to'";
}
$sql3 = "";
if($provider != ""){
$sql3 = " and payments.provider = '$provider'";
}
$sql4 = "";
if($request != ""){
$sql4 = " and payments.id = '$request'";
}
$sql5 = "";
if($bill != ""){
$sql5 = " and bills.number = '$bill'";
}
$sql6 = "";
if($paymenten != ""){
$sql6 = " and times.stage = 12 and times.userid = '$paymenten'";
}


$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6;
$order = " order by providers.name";

$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$query = "select payments.*, providers.* from payments inner join times on payments.id = times.payment inner join providers on payments.provider = providers.id where payments.id > 0".$sql.' group by payments.provider'.$order; 
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);       

$query1 = "select payments.*, providers.* from payments inner join times on payments.id = times.payment inner join providers on payments.provider = providers.id where payments.id > 0".$sql.' group by payments.provider '.$order." limit ".$inicio.",".$tampagina; 
//limit ".$inicio.",".$tampagina;  
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;		




//Solo cancelados
$queryammount = "select * from payments where id > 0 and provider > 0 and status = 14".$sql; 
$resultammount = mysqli_query($con, $queryammount);
while($rowammount = mysqli_fetch_array($resultammount)){
	if($rowammount['currency'] == 1){
		$tnio += $rowammount['ammount'];
	}if($rowammount['currency'] == 2){
		$tusd += $rowammount['ammount'];
	}if($rowammount['currency'] == 3){
		$teur += $rowammount['ammount'];
	}if($rowammount['currency'] == 4){
		$tyen += $rowammount['ammount'];
	}
}						
						?>
Cantidad de proveedores: <?php echo $num; ?><br>
Monto total cancelado NIO: C$<?php echo number_format($tnio, 2); ?><br>
Monto total cancelado USD: $<?php echo number_format($tusd,2); ?><br>
Monto total cancelado EUR: &euro;<?php echo number_format($teur, 2); ?><br>
Monto total cancelado YEN: &yen;<?php echo number_format($tyen, 2); ?>
							<div class="table-container">

								
								<?php if($num > 0){ ?> 	
                                
                                	<div class="table-scrollable"><table class="table table-striped table-bordered table-hover" id="sample_2">

								<thead>

								<tr role="row" class="heading">

								  <th width="3%">&nbsp;</th>

									<th width="200px">Código</th>

									<th width="18%">

										 Nombre</th>

									<th width="10%">Monto total C$</th>

									<th width="14%">Monto Total USD $</th>

									<th width="14%">

										 Peso NIO C$

									</th>
                                    <th width="14%">

										 Peso USD $

									</th>

									<th width="16%">

										Monto total <br>
a cancelar C$</th>
									<th width="16%">Monto total <br>
a cancelar USD $</th>
									<th width="16%">Opciones</th>
								  </tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
							
							$mtnio = 0;
							$mtusd = 0;
							
							//Cancelado
							$querymt = "select * from payments where provider = '$row[id]' and status = 14";
							$resultmt = mysqli_query($con, $querymt);
							$nummt = mysqli_num_rows($resultmt);
							while($rowmt=mysqli_fetch_array($resultmt)){
								if($rowmt['currency'] == 1){
									$mtnio+= $rowmt['ammount']; 
								} 
								if($rowmt['currency'] == 2){
									$mtusd+= $rowmt['ammount'];  
								} 
							}
							
							$mtnio2 = 0;
							$mtusd2 = 0;
							
							//Cancelar
							$querymt2 = "select * from payments where provider = '$row[id]' and status < 14";
							$resultmt2 = mysqli_query($con, $querymt2);
							$nummt2 = mysqli_num_rows($resultmt2);
							while($rowmt2=mysqli_fetch_array($resultmt2)){
								if($rowmt2['currency'] == 1){
									$mtnio2+= $rowmt2['ammount']; 
								} 
								if($rowmt2['currency'] == 2){
									$mtusd2+= $rowmt2['ammount'];  
								} 
							}
			
								
								?>
                               
                                <tr role="row" class="odd">
                                  <td><span class="sorting_1">
                                  <input name="id[]" type="checkbox" id="id[]" value="<?php echo $row['code']; ?>" class="approve1">
                                  </span></td>
                                  <td><?php echo $row['code']; ?></td><td><?php echo $row['name']; ?></td>
                                  <td><?php if($mtnio != 0){
									  echo 'NIO C$'.number_format($mtnio, 2);
								  }else{
									  echo "--";
								  }?></td><td><?php if($mtusd != 0){
									  echo 'USD $'.number_format($mtusd, 2);
								  }else{
									  echo '--';
								  }?></td>
                                  <td><?php $peso1 = ($mtnio*100)/$tnio;
								  $peso1 = number_format($peso1, 2);
								  $peso1 = str_replace('.00','',$peso1);
								  if($peso1 != 0){
									 echo $peso1.'%';
								 }else{
									 echo "--";
								 }
								  ?></td>
                                  <td><?php $peso2 = ($mtusd*100)/$tusd;
								  $peso2 = number_format($peso2, 2);
								  $peso2 = str_replace('.00','',$peso2);
								 if($peso2 != 0){
									 echo $peso2.'%';
								 }else{
									 echo "--";
								 }
								  ?></td>
                                  <td>
								  <?php if($mtnio2 != 0){
									  echo 'NIO C$'.number_format($mtnio2, 2);
								  }else{
									  echo "--";
								  }
								  ?></td>
							<td><?php if($mtusd2 != 0){
								echo 'USD $'.number_format($mtusd2, 2);
							}else{
								echo "--";
							}?></td>
							<td> <a href="report-providers-detail.php?provider=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td>
							</tr>
                                <?php } ?>
                                
                                   </tbody>

								</table></div>
                                
                                  <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="report-providers.php?page=<?php echo $previous; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
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
		  echo '<li><a href="report-providers.php?page='.$i .'&provider='.$_GET['provider'].'&from='.$_GET['from'].'&to='.$_GET['to'].'&request='.$_GET['request'].'&bill='.$_GET['bill'].'&form=1">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="report-providers.php?page=<?php echo $next; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                                
                              <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay pagos liberados con las características de este grupo.

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