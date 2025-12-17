<?php require("session-consultation.php"); 

/*
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

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

					Pagos <small>Órdenes de pago</small> 

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
                
<form id="ungrouped" name="ungrouped" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
<input name="form" type="hidden" id="form" value="1">
<div class="note note-regular">
<div class="row">
<h4 style="margin-left:15px;">Filtro:</h4><br> 
<?php //desde aqui ?>
<div class="col-md-4" >

													  <div class="form-group" >

											 <label class="control-label">Proveedor:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar..." onClick="loadSelector('provider','providers');">
												<option value="">Todos los Proveedores</option>
											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
													
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Colaborador:</label>

						
											<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar..." onFocus="loadSelector('worker','workers');">

												<option value="">Todos los Colaboradores</option>
 
												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
													
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Solicitante: </label>
                                        <select name="requester" class="form-control  select2me" id="requester" data-placeholder="Seleccionar..." onFocus="loadSelector('requester','requester');"> 

												<option value="">Todos los Colaboradores</option>
 
												

											</select>
                                            	<div title="Page 5"></div>
													  </div>

													</div>
                                            
<div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de Solicitud:</label>
                                                        <input name="payment" type="text" class="form-control" id="payment" value="">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>

<div class="col-md-3 ">
													  <div class="form-group">
														<label> No. de Factura:</label>
                                                        <input name="bill" type="text" class="form-control" id="bill" value="">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
	
<div class="col-md-3 ">
													  <div class="form-group">
														<label> No. de Batch:</label>
                                                        <input name="batch" type="text" class="form-control" id="batch" value="">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de Documento:</label>
                                                        <input name="document" type="text" class="form-control" id="document" value="">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>                                                      

<div class="col-md-3" > 
                                                    <label class="control-label">Rango de Fechas: (Solicitud)</label>

											<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">

												<input type="text" class="form-control" name="from" placeholder="desde">

												<span class="input-group-addon">

												<i class="fa fa-angle-double-right"></i></span>

												<input type="text" class="form-control" name="to" placeholder="hasta" >

											</div>

											<!-- /input-group -->

											
										</div>
                                    
<div class="col-md-3"> 
<label class="control-label">Etapa:</label>
<select name="stage" class="form-control" id="stage">
<option value="">Todos los estados</option>
<?php 

$querystage = "select * from stages where id > 0 and visible = 1 order by id asc";
$resultstage = mysqli_query($con, $querystage);
while($rowstage=mysqli_fetch_array($resultstage)){
?>
<option value="<?php echo $rowstage['id']; ?>" <?php if($_GET['stage'] == $rowstage['id']) echo 'selected'; ?>><?php echo str_replace('Rechazado1','Rechazado',$rowstage['name']); ?></option>
<?php } ?> 

													  </select>
</div>

<div class="col-md-3"> 
<label class="control-label">Pendiente de Cancelación:</label>
<br>
<input name="pcancellation" type="checkbox" id="pcancellation" value="1"n class="form-control">
</div> 
                                                   
<?php if(($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['globalsearch'] == "active")){ ?>	
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Ruta: <a href="javascript:loadSelector('route','routes');">[Cargar]</a></label> 
                                        <select name="route" class="form-control  select2me" id="route" data-placeholder="Seleccionar...">

												<option value="">Todos los Todas las rutas</option>
 
												

											</select>
                                            	<div title="Page 5"></div>
													  </div>

													</div>
                                            
 <?php } ?>

 </div>                     
<div class="row">
</div>
<div class="row">

<br><br>
						<div class="col-md-2">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-search"></i> Consultar</button> 
												
                 </div> <div class="col-md-2">							

						    
						<button type="button" class="btn blue" onClick="goBack();"><i class="fa fa-repeat"></i> Regresar</button>
                           
							<script>
							function goBack(){
								window.location = "payments-consultations3.php";
							}
							</script>
							
												
                 </div>                               
  
</div>
						
								</div>
                                </form> 
                                
                               
					
					
					
					<?php if(isset($_GET['form'])){ ?>
                    
                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

<?php 

$filter_str = "";												   
$param = 0;								
$today = date('Y-m-d'); 
$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$join1i = 0;
$join2i = 0;
$join3i = 1;

$from = $_GET['from'];
$to = $_GET['to'];
$provider = $_GET['provider'];
$bill = $_GET['bill'];
$worker = $_GET['worker'];
$requester = $_GET['requester'];
$stage = $_GET['stage']; 
$route = $_GET['route'];
$payment = $_GET['payment'];												   

$sql1 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql1 = " and times.today >= '$from'";
	$param++;
	$join_times = 1;
	$filter_str.="&from=".$from;
}
$sql2 = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sql2 = " and times.today <= '$to'";
	$param++;
	$join_times = 1;
	$filter_str.="&to=".$to;
}
$sql3 = "";
if($provider != ""){
	$sql3 = " and payments.provider = '$provider'";
	$param++;
	$filter_str.="&provider=".$provider;
}
$sql4 = "";
if($payment != ""){
	$sql4 = " and payments.id = '$payment'";
	$param++; 
	$filter_str.="&payment=".$payment;
}
$sql5 = "";
if($bill != ""){
	$sql5 = " and bills.number = '$bill'";
	$join_bills = 1;
	$param++;
	$filter_str.="&bill=".$bill;
}
$sql6 = "";
if($worker != ""){
	$sql6 = " and payments.collaborator = '$worker'";
	$param++;
	$filter_str.="&worker=".$worker;
}

$sql7 = "";
if($requester != ""){
	$sql7 = " and payments.userid = '$requester'";
	$param++;
	$filter_str.="&requester=".$requester;
}
$sql8 = "";
if($_GET['batch'] != ""){
	$sql8 = " and batch.nobatch = '$_GET[batch]'";
	$join2i = 1;
	$param++;
	$filter_str.="&batch=".$_GET['batch'];
}
$sql9 = "";
if($_GET['document'] != ""){
	$sql9 = " and batch.nodocument = '$_GET[document]'";
	$join2i = 1;
	$param++;
	$filter_str.="&document=".$_GET['document'];
}
$sql10 = "";
if($_GET['stage'] != ""){
	$mystage = $_GET['stage'];
	$param++;
	$filter_str.="&stage=".$_GET['stage'];
	switch($mystage){
		case '1.00':
		$mystage = intval($mystage);
		//sin visto bueno
		$sql10 = " and payments.status = '1' and times.stage='1.00'";
		$join_times = 1;
		break;
		case '1.01':
		//con visto bueno
		$mystage = intval($mystage);
		$sql10 = " and payments.status = '1' and times.stage='1.01'";
		$join_times = 1;
		break;
		case '5.00':
		$sql10 = " and payments.approved = '2'"; 
		break;
		default:
		$mystage = intval($mystage);
		$sql10 = " and payments.status = '$mystage'";
		break;
		
	}
}

$sql11 = "";
if(($_GET['route'] != "") and ($_GET['route'] != "0")){
	$sql11 = " and payments.route = '$_GET[route]'";
	$param++;
	$filter_str.="&route=".$_GET['route'];
}

$sql12 = "";
if(($_GET['pcancellation'] != "") and (($_GET['pcancellation'] != "0"))){
	$sql12 = " and payments.status < '14' and payments.approved = '1'";
	$param++;
	$filter_str.="&pcancellation=".$_GET['pcancellation'];
}


/*

//Start

if(($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['globalsearch'] == "active")){
	//Do nothing
	$sqlu = "";
}else{
	$join_times = 1;
	
$sqlu = "";
	$numu = 0;
	$queryu = "select * from routes where worker = '$_SESSION[userid]' and ((type = '2') or (type = '3') or (type = '4') or (type = '5') or (type = '20'))";
	$resultu = mysqli_query($con, $queryu);
	$numu = mysqli_num_rows($resultu);
	if($numu > 0){
		$firstu = 1;
		while($rowu=mysqli_fetch_array($resultu)){
			if($firstu == 1){ //First
				$sqlu = " and (((payments.route = '$rowu[unit]') and (times.userid= '$_SESSION[userid]'))";
				if($numu == 1){
					$sqlu .= ")";
				}
				$firstu++;
			}elseif($firstu == $numu){ //Last
				$sqlu .= " or ((payments.route = '$rowu[unit]') and (times.userid= '$_SESSION[userid]')))";
				$firstu++;
			}else{ //Middle
				$sqlu .= " or ((payments.route = '$rowu[unit]') and (times.userid= '$_SESSION[userid]'))";
				$firstu++;
			}
		}
									
	}
} 
//END
$join1 = "";
if($join_bills == 1){
	$join1 = " inner join bills on payments.id = bills.payment";
}
$join2 = "";
if($join_batch == 1){
	$join2 = " left join batch on payments.id = batch.payment";
}
$join3 = "";
if($join_times == 1){
	$join3 = " inner join times on payments.id = times.payment"; 
}
if($param == 0){
	echo "<script>alert('Debe de seleccionar al menos un parametro de busqueda.'); history.go(-1);</script>";
	$numdev = 0;
}else{
	//Do nothing
	$join = $join1.$join2.$join3;
	$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10.$sql11.$sql12.$sqlu; 
 

$query = "select payments.id from payments".$join." where payments.id > 0".$sql." group by payments.id";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);      

	if(isset($_GET['order'])){
		switch($_GET['order']){
			
			case 'id,asc':
				$order = 'id,asc';
				$order_sql = ' order by payments.id asc';
				break;
			case 'id,desc':
				$order = 'id,desc'; 
				$order_sql = ' order by payments.id desc';
				break;
			case 'payment,asc':
				$order = 'payment,asc';
				$order_sql = ' order by payments.payment asc';
				break;
			case 'payment,desc':
				$order = 'payment,desc'; 
				$order_sql = ' order by payments.payment desc';
				break;
			case 'expiration,asc':
				$order = 'expiration,asc';
				$order_sql = ' order by payments.expiration asc';
				break;
			case 'expiration,desc':
				$order = 'expiration,desc'; 
				$order_sql = ' order by payments.expiration desc';
				break;
			case 'status,asc':
				$order = 'status,asc';
				$order_sql = ' order by payments.status asc';
				break;
			case 'status,desc':
				$order = 'status,desc';  
				$order_sql = ' order by payments.status desc';
				break;
				
								
		}
	}else{
		$order = "";
		$order_sql = " order by payments.expiration asc";
							
	}		
	
$query1 = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.payment, payments.bank, payments.status, payments.reference, payments.cnumber, payments.schedule, payments.approved, payments.today, payments.expiration from payments".$join." where payments.id > 0".$sql." group by payments.id".$order_sql." limit ".$inicio.",".$tampagina.""; 
$result1 = mysqli_query($con, $query1);
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1; 
	 
if(($_SESSION['email'] == 'jairovargasg@gmail.com') or (1 == 1)){
	//echo $query."<br>".$query1;
	//echo $query1;
}

}
 

echo $numdev; ?> Solicitudes de pagos<br> 
								<span style="font-size: 12px; color: darkgrey;"><i>Ordenadas por vencimiento</i></span>

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

									<? 
									
				
									
									?>

									<th width="5%">

										<a href="?form=1<? echo $filter_str; ?>&order=<? if(($order != "id,asc") or ($order == 'id,desc')) echo 'id,asc'; elseif($order == 'id,asc') echo 'id,desc'; ?>">ID</a> <? if($order == 'id,asc') echo '<i class="fa fa-sort-amount-asc"></i>'; elseif($order == 'id,desc') echo '<i class="fa fa-sort-amount-desc"></i>'; ?></th> 

									<th width="40%">

										Proveedor</th>

									<th width="16%"><a href="?form=1<? echo $filter_str; ?>&order=<? if(($order != "payment,asc") or ($order == 'payment,desc')) echo 'payment,asc'; elseif($order == 'payment,asc') echo 'payment,desc'; ?>">Total Pagar</a> <? if($order == 'payment,asc') echo '<i class="fa fa-sort-amount-asc"></i>'; elseif($order == 'payment,desc') echo '<i class="fa fa-sort-amount-desc"></i>'; ?></th> 

									<th width="15%">

										 <a href="?form=1<? echo $filter_str; ?>&order=<? if(($order != "expiration,asc") or ($order == 'expiration,desc')) echo 'expiration,asc'; elseif($order == 'expiration,asc') echo 'expiration,desc'; ?>">Vencimiento</a> <? if($order == 'expiration,asc') echo '<i class="fa fa-sort-amount-asc"></i>'; elseif($order == 'expiration,desc') echo '<i class="fa fa-sort-amount-desc"></i>'; ?>

									</th>

									<th width="15%">

										 <a href="?form=1<? echo $filter_str; ?>&order=<? if(($order != "status,asc") or ($order == 'status,desc')) echo 'status,asc'; elseif($order == 'status,asc') echo 'status,desc'; ?>">Estado</a> <? if($order == 'status,asc') echo '<i class="fa fa-sort-amount-asc"></i>'; elseif($order == 'status,desc') echo '<i class="fa fa-sort-amount-desc"></i>'; ?>

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
									if($rowprovider['flag'] == 1) $beneficiary = '<img src="../images/flag.png" width="13" alt=""/>';
									$beneficiary.= $rowprovider['code']." | ".$rowprovider['name'];;
								}
								else{
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
									$beneficiary = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
								}
								
								
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?></td><td>                                  <?php  echo $beneficiary;
								?></td>
                                    <td>
									<?php 
									
									
									if($row['payment'] != 0.00){
										echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); } ?></td>
                                        <td>
										<?php 
										
										$iddelpago = $row['id'];
										//echo $elvencimiento = getExpiration($iddelpago); 
										echo date('d-m-Y',strtotime($row['expiration']));
										?></td><td>
                                        
                                       <?php 
									
									   $alert_str = "";
									
									   $alert_str = "Solicitado: ".date('d-m-Y',strtotime($row["today"]))." \\n"; 
									   if($row['approved'] == 2){
										   $rowreject = mysqli_fetch_array(mysqli_query($con, "select today, reason from times where payment = '$row[id]' order by id desc limit 1"));
										   $alert_str.= "Rechazado: ".date('d-m-Y',strtotime($rowreject["today"]))." \\n";
										   $alert_str.= "Motivo de rechazo: ".$rowreject['reason']." \\n";
									   }
										if($row['status'] >= '12'){
										   
										$alert_str.= 'Progrmado para: '.$row['schedule']." \\n";
										   
									   }
										if($row['status'] == '14'){ 
										   
										$querycancellation = "select today from times where stage = '14' and payment = '$row[id]'"; 
										$resultcancellation = mysqli_query($con, $querycancellation);
										$rowcancellation = mysqli_fetch_array($resultcancellation);
										$cancellationdate = date('d-m-Y',strtotime($rowcancellation["today"]));
										$alert_str.= "Fecha de cancelacion: ".$cancellationdate." \\n";
										$alert_str.= "CKPK: ".$row['cnumber']." \\n";
										
										$querybank = "select name from banks where id = '$row[bank]'";
										$resultbank = mysqli_query($con, $querybank);
										$rowbank = mysqli_fetch_array($resultbank);
										$cancellationbank = $rowbank['name']." \\n";
										$alert_str.= "Banco: ".$cancellationbank;
										$cancellationref = $row["reference"]." \\n"; 
									    $alert_str.= "Referencia: ".$cancellationref." \n"; 
									   }
									   
		
									
									
									
										
										?>
                                        <a href="javascript:alert('<?php echo $alert_str; ?>');"><?php  
										
										

$rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
						
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
								 
								 
								 echo "</a>"; ?>  
                                        
                                      
							
								
							</td><td>
                            		  
                            <a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                            
                            
                            </td></tr>
                                <?php } ?>
                               
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
										<a href="<?php echo str_replace('/var/www/html','',$_SERVER['SCRIPT_FILENAME']); ?>?page=<?php echo $previous; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&requester=<?php echo $_GET['requester']; echo $securechain; ?>&stage=<?php echo $_GET['stage']; ?>&form=1">
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
		  
		  echo '<li><a href="'.str_replace("/var/www/html","",$_SERVER["SCRIPT_FILENAME"]).'?page='.$i .'&provider='.$_GET['provider'].'&from='.$_GET['from'].'&to='.$_GET['to'].'&request='.$_GET['request'].'&bill='.$_GET['bill'].'&requester='.$_GET['requester'].$securechain.'&stage='.$_GET['stage'].'&form=1">'.$i .'</a></li>';  
		}
    } } ?> 
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="<?php echo str_replace('/var/www/html','',$_SERVER['SCRIPT_FILENAME']); ?>?page=<?php echo $next; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill'].'&requester='.$_GET['requester'].$securechain; ?>&form=1">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No se encontró ningún resultado de busqueda.

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

<script src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>

<?php /*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ /* ?>

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

<script>

function loadSelector(selId,loadInfo){
	document.getElementById(selId).innerHTML = 'Cargando...'; 
	$.post("fn-reloadselector.php", { myvariable: loadInfo, }, function(data){
		document.getElementById(selId).innerHTML = data;
		alert('Cargado!'); 
	}); 
}

</script>	
*/ ?>
