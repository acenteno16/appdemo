<?php include("session-consultation.php"); ?> 
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en" class="no-js">

<!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

<meta charset="utf-8"/>

<title>Aplicación de Pagos | Casa Pellas S.A.</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta content="width=device-width, initial-scale=1" name="viewport"/>

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

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

<link href="../assets/global/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>

<!-- END PAGE LEVEL PLUGIN STYLES -->

<!-- BEGIN PAGE STYLES -->

<link href="../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../assets/global/plugins/select2/select2.css"/>

<!-- END PAGE STYLES -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>
<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.flot.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.flot.pie.js"></script>
    <script language="javascript" type="text/javascript" src="js/jquery.flot.stack.js"></script>

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

					Analytics <?php //<small>Órdenes de pago</small> ?> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Analytics</a>

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
<form id="ungrouped" name="ungrouped" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
<input name="form" type="hidden" id="form" value="1">
<div class="note note-regular">
<div class="row">
<h4 style="margin-left:30px;">Filtro:</h4><br>
               
<?php //Hasta aqui ?>                           
</div>  

                                        
<div class="col-md-3"> 
<label class="control-label">Tipo</label>
<select name="type" class="form-control" id="type" onChange="this.form.submit();">
<option value="0">Seleccionar</option>
<option value="1" <?php if($_GET['type'] == 1){ echo "selected"; }?>>Proveedores mas importantes</option>
<? /*<option value="2" <?php if($_GET['type'] == 2){ echo "selected"; }?>>Rubros mas importantes</option>*/ ?>
<? /*<option value="6" <?php if($_GET['type'] == 6){ echo "selected"; }?>>Rechazos</option>*/ ?>
<option value="7" <?php if($_GET['type'] == 7){ echo "selected"; }?>>Rubros más importantes</option>
<option value="8" <?php if($_GET['type'] == 8){ echo "selected"; }?>>Distribuciones (Gastos Aplicados)</option>
<option value="9" <?php if($_GET['type'] == 9){ echo "selected"; }?>>Distribuciones (Gastos Recibidos)</option>
<option value="5" <?php if($_GET['type'] == 5){ echo "selected"; }?>>Otros datos</option>




													  </select>
</div>
                             
<div class="row">
</div>
<div class="row">

<br><br>
						<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1">
							
							<? /*<button type="submit" class="btn blue"><i class="fa fa-search"></i> Buscar</button>  */ ?>
												
                						

						    <?php if($_GET['form'] == 1){ ?><button type="button" class="btn blue" onClick="goBack();"><i class="fa fa-repeat"></i> Regresar</button> 
							<script>
							function goBack(){
								window.location = "analytics.php";
							}
							</script>
							<?php } ?>
												
                 </div>                               
  
</div>
						
								</div>
                                </form> 
					
					<br><br><br>
					
					<?php 
					if($_GET['type'] == 1){
						include('analytics-providers.php'); 
					} 
					?>
                    
                    <?php 
					if($_GET['type'] == 2){
						include('analytics-categories.php'); 
					} ?>
                    
                    
					<?php if($_GET['type'] == 5){ ?>
					
					
					
					<?php 
						
						$queryglobal = "select approved, sent_approve, status from payments";
						$resultglobal = mysqli_query($con, $queryglobal);
						$numglobal = mysqli_num_rows($resultglobal);
						while($rowglobal=mysqli_fetch_array($resultglobal)){
							if(($rowglobal['approved'] == 1) and ($rowglobal['sent_approve'] == 0)){
								$rcc++;
							}
							
							switch($rowglobal['status']){
								case 0:
								$borradores++;
								break;
								case 1:
								$solicitados++;
								break;
								case 2:
								$aprobado1++;
								break;
								case 3:
								$aprobado2++;
								break;
								case 4:
								$aprobado3++;
								break;
								case 8:
								$provision++;
								break;
								case 9:
								$liberados++;
									break;
								case 9.02:
								$liberados2++;
								break;
								case 14:
								$cancelados++;
								break;
							}
						}
						
						
						 ?>
                         
                         El total de pagos en GetPay: <?php echo number_format($numglobal); ?><br>
                         Borradores: <?php echo number_format($borradores); ?><br>
                         Solicitados: <?php echo number_format($solicitados); ?><br>
                         Aprobado 1: <?php echo number_format($aprobado1); ?><br>
                         Aprobado 2: <?php echo number_format($aprobado2); ?><br>
                         Aprobado 3: <?php echo number_format($aprobado3); ?><br>
                         Provisionados: <?php echo number_format($provision); ?><br><br>
                         Liberados: <?php echo number_format($liberados); ?><br>
					     Liberación especial: <?php echo number_format($liberados2); ?><br>
                         Solicitudes sin revisar: <?php echo number_format($rcc); ?><br>
                         programados: <br>
                         Ingreso a banco:<br>
                         Cancelado: <?php echo number_format($cancelados); ?><br>
                        
                         
                    <?php } ?>
                    
                    <?php 
					
					
					if($_GET['type'] == 6){ ?>
                    
                    <a href="analytics-excel6.php">Exportar a excel</a>
                    <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
 
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<? 
$tampagina = 50;
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

										Motivo
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
								$rowreason = mysqli_fetch_array(mysqli_query($con, "select * from reason where id = '$row[reason]'"));
								
								$reason = $row['reason']."|".$rowreason['name'];
								
								
								
							
								
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
                            <td><? echo $reason; ?></td>
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
                    <? } ?>
                    <?php 
					if($_GET['type'] == 7){
						include('analytics-types.php'); 
					} ?>
                    
                     <?php 
					if($_GET['type'] == 8){
						include('analytics-distributions.php'); 
					} ?>
					
					  <?php 
					if($_GET['type'] == 9){
						include('analytics-distributions-received.php'); 
					} ?>
					
					<?php if($_GET['tipo'] == 100){ ?><div class="portlet">

						<div class="portlet-title">

							<div class="caption">

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

$from = $_GET['from'];
$to = $_GET['to'];
$provider = $_GET['provider'];

/*
$request = $_GET['request'];
$bill = $_GET['bill'];
$paymenten = $_GET['paymenten'];
$worker = $_GET['worker'];
$requester = $_GET['requester'];
$stage = $_GET['stage']; 

$sql1 = "";
if($from != ""){
$from = date("Y-m-d", strtotime($from));
$sql1 = " and payments.today >= '$from'";
}
$sql2 = "";
if($to != ""){
$to = date("Y-m-d", strtotime($to));
$sql2 = " and payments.today <= '$to'";
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
if($worker != ""){
$sql6 = " and payments.collaborator = '$worker'";
}

$sql7 = "";
if($requester != ""){
$sql7 = " and payments.userid = '$requester'";
}
$sql8 = "";
if($_GET['batch'] != ""){
$sql8 = " and batch.nobatch = '$_GET[batch]'";
}
$sql9 = "";
if($_GET['document'] != ""){
$sql9 = " and batch.nodocument = '$_GET[document]'";
}
*/


$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10;


	$query = "select payments.* from payments inner join bills on payments.id = bills.payment inner join times on payments.id = times.payment left join batch on payments.id = batch.payment where payments.id > 0".$sql." group by times.payment";
	
	$query1 = "select payments.* from payments inner join bills on payments.id = bills.payment inner join times on payments.id = times.payment left join batch on payments.id = batch.payment where payments.id > 0".$sql." group by times.payment";
	 

$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);       
$result1 = mysqli_query($con, $query1); 

if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;	

echo $numdev; ?> Solicitudes de pagos

							</div>

							

					  </div>

						<div class="portlet-body">

							<div class="table-container">

								

							

								<?php 													

//echo $query;
//echo "<br>".$query1;

if($numdev > 0){  ?>
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 ID</th>

									<th width="40%">

										 Proveedor</th>

									<th width="16%">Total Pagar</th>

									<th width="15%">

										 Vencimiento

									</th>

									<th width="15%">

										 Estado

									</th>

									<th width="17%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php //echo $query1; 
								while($row=mysqli_fetch_array($result1)){
								if($row['btype'] == 1){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								}
								else{
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
								}
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?></td><td>                                  <?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; 
								if($row['btype'] == 1){ echo $rowprovider['code']." | ".$rowprovider['name'];
								}else{
									echo $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last']; }?></td>
                                    <td>
									<?php 
									
									
									if($row['payment'] != 0.00){
										echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); } ?></td>
                                        <td>
										<?php 
										
										$iddelpago = $row['id'];
										echo $elvencimiento = getExpiration($iddelpago); 
										
										?></td><td>
                                        
                                        <?php 
										
										if($row['status'] == '14'){
										$querycancellation = "select * from times where stage = '14' and payment = '$row[id]'";
										$resultcancellation = mysqli_query($con, $querycancellation);
										$rowcancellation = mysqli_fetch_array($resultcancellation);
										$cancellationdate = date('d-m-Y',strtotime($rowcancellation["today"]));
										
										$querybank = "select * from banks where id = '$row[bank]'";
										$resultbank = mysqli_query($con, $querybank);
										$rowbank = mysqli_fetch_array($resultbank);
										$cancellationbank = $rowbank['name'];
										$cancellationref = $row["reference"];
										
										?>
                                        <a href="javascript:showCancellation('<?php echo $cancellationdate; ?>','<?php echo $row['cnumber']; ?>','<?php echo $cancellationbank; ?>','<?php echo $cancellationref; ?>');"><?php } echo $rowstage['content']; if($row['status'] == 14){ ?> </a><?php } ?>
									
							
								
							</td><td>
                            <?php if($row['status'] == 0){ ?>
                            <a href="payment-order.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-edit"></i> Completar</a>
                             <a href="javascript:deletePayment(<?php echo $row['id']; ?>);"><span class="label label-danger">
									<i class="fa fa-trash-o"></i>  Eliminar </span></a>
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
                                <script>
								function showCancellation(today,cnumber,bank,ref){
									alert('Fecha de cancelacion: '+today+'\nCKPK: '+cnumber+'\nBanco: '+bank+"\nReferencia: "+ref); 
								}
								</script> 
                                   </tbody>

								</table>
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php $securechain = "";
								if(($_SESSION['admin'] == "active") and ($_GET['asadmin'] == 1)){
									$securechain = "&asadmin=1";
								}
								
								if($previous != ""){ ?>
                  
                 <li>
										<a href="payments-consultations.php?page=<?php echo $previous; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&requester=<?php echo $_GET['requester']; echo $securechain; ?>&stage=<?php echo $_GET['stage']; ?>&form=1">
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
		  
		  echo '<li><a href="payments-consultations.php?page='.$i .'&provider='.$_GET['provider'].'&from='.$_GET['from'].'&to='.$_GET['to'].'&request='.$_GET['request'].'&bill='.$_GET['bill'].'&requester='.$_GET['requester'].$securechain.'&stage='.$_GET['stage'].'&form=1">'.$i .'</a></li>';  
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="payments-consultations.php?page=<?php echo $next; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill'].'&requester='.$_GET['requester'].$securechain; ?>&form=1">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna orden de pago vinculada a esta cuenta.

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div>

					</div>

					<!-- End: life time stats -->

				</div><?php } ?>

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
<?php /*
<script src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
*/ ?>
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

<script src="../assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>



<script src="../assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>

<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->

<script src="../assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<?php ?> 
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/clockface/js/clockface.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<?php ?>

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/index.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>
<script src="../assets/admin/pages/scripts/components-pickers.js"></script>

	<!-- END PAGE LEVEL SCRIPTS -->

<script>

jQuery(document).ready(function() {    

   Metronic.init(); // init metronic core componets

   Layout.init(); // init layout

   QuickSidebar.init() // init quick sidebar

   Index.init();   

   Index.initDashboardDaterange();

   Index.initJQVMAP(); // init index page's custom scripts



   Index.initCharts(); // init index page's custom scripts

   Index.initChat();

   Index.initMiniCharts();


   ComponentsPickers.init();

});

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
