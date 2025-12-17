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

							<a href="#">Pagos Programados</a>

						

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
$today = date("Y-m-d");
$thisweek = ">= CURDATE() - INTERVAL CASE WEEKDAY(CURDATE()) WHEN 6 THEN -1 ELSE WEEKDAY(CURDATE()) END + 1 DAY";
if(($_SESSION["financemanager"] == 'active') or ($_SESSION["president"] == 'active') or($_SESSION["generalmanager"] == 'active')){
	$query = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on times.userid = workers.code left join bills on payments.id = bills.payment where payments.status >= '5' and payments.status <= '7' and times.stage >= '5' and times.stage <= '7' and times.today ".$thisweek.''.$sql.' group by payments.id'; 
}
elseif($_SESSION["manager"] == 'active'){
	$query = "select payments.* from payments inner join times on payments.id = times.payment inner join workers on times.userid = workers.code left join bills on payments.id = bills.payment where payments.status >= '5' and payments.status <= '7' and times.stage >= '5' and times.stage <= '7' and workers.unit = '$_SESSION[unit]' and times.today ".$thisweek.''.$sql.' group by payments.id'; 
}else{
	header("location: ".$_SERVER['HTTP_REFERER']);
	exit();
}
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);


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
						?>
Cantidad de solicitudes: <?php echo $num; ?><br>
Monto total cancelado NIO: C$<?php echo number_format($tnio, 2); ?><br>
Monto total cancelado USD: $<?php echo number_format($tusd,2); ?><br>
Monto total cancelado EUR: &euro;<?php echo number_format($teur, 2); ?><br>
Monto total cancelado YEN: &yen;<?php echo number_format($tyen, 2); ?>
							<div class="table-container">

								
								<?php if($num > 0){ ?> 	
                                
                                	<div class="table-scrollable"><table class="table table-striped table-bordered table-hover" id="sample_2">

								<thead>

								<tr role="row" class="heading">

								  <th width="3%">

										 ID solicitud</th>

									<th width="200px"> 

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
                                <th width="16%">Fecha de Vencimiento</th>
                                <th width="16%">Días Faltantes</th>
									<th width="16%">Tipo de gasto</th>
									<th width="16%">Concepto</th>
									<th width="16%">Categoría</th>
									<th width="16%">Fecha de solicitud</th>
									<th width="16%">Aprobado1 Usuario</th>
									<th width="16%">Aprobado1 Fecha</th>
									<th width="16%">Aprobado2 Usuario</th>
									<th width="16%">Aprobado2 Fecha</th>
                                    <th width="16%">Aprobado3 Usuario</th>
									<th width="16%">Aprobado3 Fecha</th>

<th width="16%">Tiempo</th>
								

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
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
			
			while($row2=mysqli_fetch_array($result2)){	
				$stage[$row[0]][$row2['stage']] = $row2['today'];
				
				
				if($row2['stage'] == 8){
					$epayment = $row['userid'];
				}
			}
			
			$query3 = "select times.stage, workers.first, workers.last from times inner join workers on times.userid = workers.code where times.payment = '$row[id]' order by times.stage asc";
			$result3 = mysqli_query($con, $query3);
			$num3 = mysqli_num_rows($result3);
			while($row3=mysqli_fetch_array($result3)){	
				
				$fstage[$row[0]][$row3[0]] = $row3[1]." ".$row3[2];
								
			}
			
			//Global time
			$datea = $stage[$row['id']][1]; //Request date
			$dateb = $stage[$row['id']][14]; //Approve1 date
			$dias = (strtotime($datea)-strtotime($dateb))/86400;
			$dias = abs($dias); $dias = floor($dias);
			$tglobal = $dias; 
			
			//Approve1 Times
			$datea = $stage[$row['id']][1]; //Request date
			$dateb = $stage[$row['id']][2]; //Approve1 date
			$dias = (strtotime($datea)-strtotime($dateb))/86400;
			$dias = abs($dias); $dias = floor($dias);
			$tapprove1 = $dias; 
			
			//Approve2
			
			if(isset($stage[$row['id']][3])){
				$datea = $stage[$row['id']][2]; //Approve1 date
				$dateb = $stage[$row['id']][3]; //Approve2 date
				
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove2 = $dias;
				$approve2 = 1;
			}
			//Approve3
			//If approve3 isset
			if(isset($stage[$row['id']][4])){
				$datea = $stage[$row['id']][3]; //Aprobado2
				$dateb = $stage[$row['id']][4]; //Aprpbado3
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tapprove3 = $dias; 
				$approve3 = 1;
			}
			//Provision
			if(isset($stage[$row['id']][8])){
				$rowusere= mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
				if(isset($stage[$row['id']][4])){
					//dateb == approve3
					$dateb = $stage[$row['id']][4]; //Aprpbado3
				}elseif(isset($stage[$row['id']][3])){
					//dateb = apprve2
					$dateb = $stage[$row['id']][3]; //Aprpbado3
				}else{
					//dateb = approve1
					$dateb = $stage[$row['id']][2]; //Aprpbado3
				}
				$datea = $stage[$row['id']][8]; //Provision
				//Load dateb
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tprovission = $dias; 
				
			} 
			//
			//Releasing
			if(isset($stage[$row['id']][9])){
				$datea = $stage[$row['id']][8]; //Provision date
				$dateb = $stage[$row['id']][9]; //releasing date
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$treleasing = $dias;
				
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
			if(isset($stage[$row['id']][14])){
				$datea = $stage[$row['id']][13]; //Schedule Approve
				$dateb = $stage[$row['id']][14]; //Cancellation
				$dias = (strtotime($datea)-strtotime($dateb))/86400;
				$dias = abs($dias); $dias = floor($dias);
				$tcancellation = $dias;
				
			}
			//end times
								
								?>
                               
                                <tr role="row" class="odd">
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php echo $rowuser['first']." ".$rowuser['last']; ?></td><td><?php echo $rowcompany[0]; ?></td><td><?php echo $rowuser['unit']; ?></td><td>&nbsp;</td>
                                  <td><?php echo $rowmanager['first']." ".$rowmanager['last']; ?></td><td>
                            <?php echo $rowprovider['code']; ?></td>
							<td><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; echo $rowprovider['name']; ?></td>
							<td><?php echo number_format($row['ammount'], 2); ?></td>
							<td><?php echo $rowcurrency['name']; ?></td>
                         <td><?php echo date('d-m-Y',strtotime($row['expiration'])); ?></td>
                         <td><?php $d2 = date('Y-m-d');
						 $d1 = $row['expiration'];
						 $dias	= (strtotime($d1)-strtotime($d2))/86400;
						
						 if($dias > 0){
							 echo $dias." días";
						 }
						 elseif($dias == 0){
							 echo "Pago vence hoy";
						 }
						 else{
							 echo "Pago vencido";
						 }
							 
								 
								?>
						 
						 </td>
                            
							<td><?php echo $rowtype['name']; ?></td>
							<td><?php echo $rowconcept['name']; ?></td>
							<td><?php echo $rowconcept2['name']; ?></td>
							<td><?php echo date('d-m-Y',strtotime($stage[$row['id']][1])); ?></td>
							<td><?php echo $fstage[$row[0]][2]; ?></td>
							<td><?php echo date('d-m-Y',strtotime($stage[$row['id']][2])); ?></td>
							<td><?php if($stage[$row['id']][3] != ""){
								echo $fstage[$row['id']][3]; }else{ echo "---"; } ?> </td>
							<td><?php if($stage[$row['id']][3] != ""){
							echo date('d-m-Y',strtotime($stage[$row['id']][3])); }else{ echo "---"; } ?></td>
							<td><?php if($fstage[$row['id']][4] != ""){
							echo $fstage[$row['id']][4]; }else{
								echo "---"; } ?></td>
							<td><?php if($stage[$row['id']][4] != ""){
							echo date('d-m-Y',strtotime($stage[$row['id']][4])); }else{ echo "---"; } ?></td>
                            <td><?php $d1 = date('Y-m-d');
						 $d2 = $stage[$row['id']][1];
						 $dias	= (strtotime($d1)-strtotime($d2))/86400;
						 echo $dias.' días';
						
						 
							 
								 
								?>
						 
						 </td>
						 
                                </tr>
                                <?php } ?>
                                
                                   </tbody>

								</table></div>
                                
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