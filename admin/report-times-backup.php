<?php include("session-global.php"); ?> 
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

							<a href="#">Tiempos</a>
                            <i class="fa fa-angle-right"></i>
						

						</li>
                         <li>

							<a>Totales/Entre fases</a>

						

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
 <?php $queryproviders = "select * from providers order by name";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?> 
                                            <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"]." | ".$rowproviders["name"]; ?></option> 
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

	<label class="control-label">Encargados de pago:</label>

						
											<select name="paymenten" class="form-control  select2me" id="paymenten" data-placeholder="Seleccionar...">

												<option value="">Todos los Encargados de pago</option>
 <?php $queryencharged = "select workers.* from routes inner join workers on routes.worker = workers.code where routes.type = 12 group by workers.code";
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
						<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button>  <button type="button" class="btn red" onClick="clearFilter();"> <i class="fa fa-filter"></i> Limpiar filtro</button> 
							
                            <script>
							function clearFilter(){
								window.location = "report-times.php";
							}
							</script>
                           				
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
<?php 

$from = $_GET['from'];
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

$tampagina = 10;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

if($sql != ''){
echo $query = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on times.userid = workers.code left join bills on payments.id = bills.payment where payments.id > 0".$sql.' group by payments.id'; 
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina); 

echo '<br>'.$query1 = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on times.userid = workers.code left join bills on payments.id = bills.payment where payments.id > 0".$sql." group by payments.id limit ".$inicio.",".$tampagina;   
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;	


$resultammount = mysqli_query($con, $query);
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


}


					
						?>


								
<?php 
	if($num > 0){ 
	
	?> 	
                               
                               
                               
                               
                                
Cantidad de solicitudes: <?php echo $num; ?><br>

Monto total cancelado NIO: C$<?php echo str_replace('.00','',number_format($tnio, 2)); ?><br>
Monto total cancelado USD: $<?php echo str_replace('.00','',number_format($tusd,2)); ?><br>
Monto total cancelado EUR: &euro;<?php echo str_replace('.00','',number_format($teur, 2)); ?><br>
Monto total cancelado YEN: &yen;<?php echo str_replace('.00','',number_format($tyen, 2)); ?>
							<div class="table-container">
                                
                                	<div class="table-scrollable"><table class="table table-striped table-bordered table-hover" id="sample_2">

								<thead>

								<tr role="row" class="heading">

								  <th width="3%">

										 ID solicitud</th>

									<th width="9%">

										 Usuario</th>

									<th width="18%">

										 Compañia</th>

									<th width="10%">UN</th>

									<th width="14%">

										 Sucursal

									</th>

									<th width="14%">

										 Gerente

									</th>

									<th width="16%">

										Codigo Proveedor</th>
									<th width="16%">Nombre Proveedor</th>
									<th width="16%">Monto</th>
									<th width="16%">Moneda</th>
									<th width="16%">Tiempo total de pago</th>
									<th width="16%">Encargado de pago</th>
									<th width="16%">Tiempo en Aprobado1</th>
									<th width="16%">Tiempo en Aprobado2</th>
									<th width="16%">Tiempo en Aprobado3</th>
									<th width="16%">Tiempo en Provisión</th>
									<th width="16%">Tiempo en Liberacion</th>
									<th width="16%">Tiempo en Cancelación</th>
									<th width="16%">Recepcion de soportes</th>
									<th width="16%">Archivos completos</th>
									<th width="16%">archivado</th>
									<th width="16%">Fecha de solicitud</th>
									<th width="16%">Fecha de aprobado1</th>
									<th width="16%">Fecha de aprobado2</th>
									<th width="16%">Fecha de aprobado3</th>
									<th width="16%">Fecha de provisionado</th>
									<th width="16%">Fecha de liberación</th>
									<th width="16%">Fecha de programacion</th>
									<th width="16%">Fecha de cancelación</th>
									<th width="16%">Fecha Archivado</th>
									<th width="16%">&nbsp;</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
								
								while($row=mysqli_fetch_array($result1)){
									
								
									//Provider/Colaborator
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								/*$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								$rowtype= mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[type]'"));
								$rowconcept= mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept]'"));
								$rowconcept2= mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept2]'"));
								$rowuser= mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
								$rowcompany= mysqli_fetch_array(mysqli_query($con, "select companies.name from units inner join companies on units.company = companies.id where units.code = '$rowuser[unit]'"));
								$rowmanager = mysqli_fetch_array(mysqli_query($con, "select workers.* from routes inner join workers on routes.worker = workers.code where routes.unit='$rowuser[unit]' and routes.type = 14"));
								
								//TIMES
								
			$query2 = "select * from times where payment = $row[id] order by stage asc";
			$result2 = mysqli_query($con, $query2);
			$num2 = mysqli_num_rows($result2);
			
			$requestdate = 0;
			$approve1date = 0;
			$approve2date = 0;
			$approve3date = 0;
			$provisiondate = 0;
			$releasingdate = 0;
			$cancellationdate = 0;
			
			while($row2=mysqli_fetch_array($result2)){	
				
				switch($row2['stage']){
					case "1":
					$requestdate = $row2['today'];
					break;
					case "2":
					$approve1date = $row2['today'];
					break;
					case "3":
					$approve2date = $row2['today'];
					break;
					case "4":
					$approve3date = $row2['today'];
					break; 
					case "8":
					$provisiondate = $row2['today'];
					break;
					case "8.01":
					$provisiondate = $row2['today'];
					break;
					case "9":
					$releasingdate = $row2['today'];
					break;
					case "14":
					$cancellationdate = $row2['today'];
					break; 
				}
			}
			
			
			//Global time
			if($cancellationdate != 0){
				$datea = $requestdate; //Request date
				$dateb = $cancellationdate; //Approve1 date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tglobal = $dias;
			}else{
				$tglobal = "NA";
			}
			
			//Approve1 Times
			if($approve1date != 0){
				$datea = $requestdate; //Request date
				$dateb = $approve1date; //Approve1 date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove1 = $dias.' días';
			}else{
				$tapprove1 = "NA";
			}
			
			//Approve2
			
			if($approve2date != 0){
				$datea = $approve1date; //Approve1 date
				$dateb = $approve2date; //Approve2 date
				
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove2 = $dias.' días';
				$approve2 = 1; 
			}else{
				$tapprove2 = 'NA';
			}
			//Approve3
			//If approve3 isset
			if($approve3date != 0){
				$datea = $approve2date; //Aprobado2
				$dateb = $approve3date; //Aprpbado3
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove3 = $dias.' días'; 
				
			}else{
				$tapprove3 = "NA";
			}
			//Provision
			$scheduleuser = "NA";
			if($provisiondate != 0){
				$queryschedule1 = "select * from times where payment = '$row[id]' and stage = '12.00'";
				$resultschedule1 = mysqli_query($con, $queryschedule1);
				$numschedule1 = mysqli_num_rows($resultschedule1);
				$rowschedule1 = mysqli_fetch_array($resultschedule1);
				 
				$scheduleuserid = $rowschedule1['userid'];
				
				$queryschedule = "select * from workers where code = '$scheduleuserid'";
				$resultschedule = mysqli_query($con, $queryschedule);
				$rowschedule = mysqli_fetch_array($resultschedule);
				
				$scheduleuser = $rowschedule['first'].' '.$rowschedule['last'];
				if($numschedule1 == 0){
					$scheduleuser = "NA";
				}
				
				if($approve1date != 0){
					$datea = $approve1date;
				}
				if($approve2date != 0){
					$datea = $approve2date;
				}
				if($approve3date != 0){
					$datea = $approve3date;
				}
				$dateb = $provisiondate; //Provision
				
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tprovission = $dias." días"; 
				
			}else{
				$tprovission = "NA";
			}
				
			//
			//Releasing
			if($releasingdate != 0){
				$datea = $provisiondate; //Provision date
				$dateb = $releasingdate; //releasing date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$treleasing = $dias." días";
				
			}else{
				echo "NA";
			}
			//Schedule
			if(isset($stage[$row['id']][12])){
				$datea = $stage[$row['id']][9]; //Releasing
				$dateb = $stage[$row['id']][12]; //Schedule
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tschedule = $dias;
				
			}
			
			//Schedule Approve
			if(isset($stage[$row['id']][13])){
				$datea = $stage[$row['id']][12]; //Schedule
				$dateb = $stage[$row['id']][13]; //Schedule Approve
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tschedulea = $dias;
				
			}
			
			//Cancellation
			if($cancellationdate != 0){
				$datea = $releasingdate; //Schedule Approve
				$dateb = $cancellationdate; //Cancellation
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tcancellation = $dias;
				
			}
			//end times */
								
								?>
                               
                                <tr role="row" class="odd">
                                  <td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
                                  <td><?php echo $rowuser['first']." ".$rowuser['last']; ?></td><td><?php echo $rowcompany[0]; ?></td><td><?php echo $rowuser['unit']; ?></td><td>&nbsp;</td>
                                  <td><?php echo $rowmanager['first']." ".$rowmanager['last']; ?></td><td>
                            <?php echo $rowprovider['code']; ?></td>
							<td><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; echo $rowprovider['name']; ?></td>
							<td><?php echo str_replace('.00','',number_format($row['ammount'], 2)); ?></td>
							<td><?php echo $rowcurrency['name']; ?></td>
							<td><?php echo $tglobal; ?></td>
							<td><?php echo $scheduleuser; ?></td>
							<td><?php echo $tapprove1; ?></td>
							<td><?php echo $tapprove2; ?></td>
							<td><?php echo $tapprove3; ?></td>
							<td><?php echo $tprovission; ?></td>
							<td><?php echo $treleasing; ?></td>
							<td><?php echo $tcancellation; ?></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php if($requestdate != 0){ echo date('d-m-Y',strtotime($requestdate)); }else{ echo "-"; } ?></td>
							<td><?php if($approve1date){ echo date('d-m-Y',strtotime($approve1date)); } else{ echo "-"; }?></td>
							<td><?php if($approve2date){ echo date('d-m-Y',strtotime($approve2date)); } else { echo "-"; } ?></td>
							<td><?php if($approve3date){ echo date('d-m-Y',strtotime($approve3date)); } else { echo "-"; } ?></td>
							<td><?php if($stage[$row['id']][8] != ""){ echo date('d-m-Y',strtotime($stage[$row['id']][8])); } else { echo "-"; } ?></td>
							<td><?php if($stage[$row['id']][9] != ""){ echo date('d-m-Y',strtotime($stage[$row['id']][9])); } else { echo "-"; } ?></td>
							<td><?php if($stage[$row['id']][12] != ""){ echo date('d-m-Y',strtotime($stage[$row['id']][12])); } else { echo "-"; } ?></td>
							<td><?php if($stage[$row['id']][14] != ""){
							echo date('d-m-Y',strtotime($stage[$row['id']][14])); }else{
echo "-";								//
							}?></td>
							<td><?php //echo $stage[$row['id']][14]; ?></td>
							<td>&nbsp;</td>
                                </tr>
                                <?php } ?>
                                
                                   </tbody>

								</table>
                                
                             
                                </div>
                                  <?php /* <a href="javascript:print();" class="btn default blue-stripe">Imprimir</a>*/ ?>
                                <a href="javascript:excel();" class="btn default green-stripe">Exportar a Excel</a> "Versión Beta"
                                <script>
								function excel(){
									window.open("report-times-excel.php");
								}
								</script>
                               	<?php }else{ ?>
                                
                                <div class="note note-danger">

						<p>

							<?php if($sql == ""){
                            	echo "NOTA: Ningún filtro aplicado.";
							}else{
								echo "NOTA: Ningún resultado con los filtros aplicados.";
							}
							?>
                                

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