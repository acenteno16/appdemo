<?php 

include("session-releasing.php"); 
include("functions.php");

//PERMISOS
$querypermit = "select * from routes where type = '6' and worker = '$_SESSION[userid]'";
$resultpermit = mysqli_query($con, $querypermit);
$rowpermit=mysqli_fetch_array($resultpermit);
$thepermit = substr($rowpermit['companies'], 0, -1);

$thepermit_arr = explode(',', $thepermit);

$firstu = 1;
for($in=0;$in<sizeof($thepermit_arr);$in++){
	if($firstu == 1){
		//First
		$andor = " and (((payments.company = '$thepermit_arr[$in]'))";
		if(sizeof($thepermit_arr) == 1){
			$andor .= ")";
		}
		$firstu++;
	}elseif($firstu == sizeof($thepermit_arr)){ //Last
		$andor .= " or ((payments.company = '$thepermit_arr[$in]')))";
		$firstu++;
	}else{ //Middle
		$andor .= " or ((payments.company = '$thepermit_arr[$in]'))";
		$firstu++;
	}
} 


$monitor = 0;
if (in_array("1", $thepermit_arr)) {
	$monitor = 1;
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

					Liberación <small>Liberación de pagos</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

					  </li>

						<li>

							<a href="#">Liberación</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>
<div class="row">
<? if(($monitor == 1) or ($_SESSION['email'] == 'jairovargasg@gmail.com')){
	include("releasing-status2.php");
} ?>
</div>

<p><strong>Solicitudes recibidas en liberación:</strong> <?php echo $numprovisioned_global; ?> <em>(Este mes)</em><br><strong style="font-size:14px;">Leyenda:</strong> <em><strong>sl:</strong> Solicitudes liberadas. | <strong>sp:</strong> Solicitudes pendientes.</em></p>              
                
<? 
if($_GET['filter'] == 1){
?>

<div class="note note-regular">
<div class="row">
<div class="col-md-12">

<form id="ungrouped" name="ungrouped" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
<input name="form" type="hidden" id="form" value="1">

							
<h4 style="margin-left:15px;">Filtro:</h4><br>

<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Proveedor:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value="">Todos los Proveedores</option>
 <?php $queryproviders = "select * from providers where code > '0' order by name";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Colaborador:</label>

						
											<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar...">

												<option value="">Todos los Colaboradores</option>
 <?php $queryproviders = "select * from workers order by first,last";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
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
<div class="col-md-4 ">
													  <div class="form-group">
														<label>No. de Solicitud:</label>
                                                        <input name="request" type="text" class="form-control" id="request" value="">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>

                                                    
<div class="row"></div> 
<div class="col-md-4 ">
													  <div class="form-group">
														<label> No. de Factura:</label>
                                                        <input name="bill" type="text" class="form-control" id="bill" value="">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>

<div class="col-md-4 ">
													  <div class="form-group">
														<label> No. de Batch:</label>
                                                        <input name="batch" type="text" class="form-control" id="batch" value="">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                    <div class="col-md-4 ">
													  <div class="form-group">
														<label>No. de Documento:</label>
                                                        <input name="document" type="text" class="form-control" id="document" value="">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>




                             
<div class="row"></div>
<br>
<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button> <button type="button" class="btn red" onClick="resetFilter();"><i class="fa fa-filter"></i> Quitar Filtro</button>  <script>
                            function resetFilter(){
                            
                            window.location = "releasing.php";
							
                            }
                            </script>
												
                 </div>                               
 </form>
</div>
</div>
</div>

<? } else{ ?>
<div class="note note-regular">
<a href="releasing.php?filter=1">Mostrar filtro</a>
</div>
<? } ?>
			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->


            <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					
                    <?php 
 //$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']); 
								
$queryvip = "select payments.id, payments.parent, payments.btype, payments.provider, payments.collaborator,payments.intern, payments.client, payments.currency, payments.payment, payments.expiration, payments.blockrelease from payments left join providers on payments.provider = providers.id where payments.child = '0' and payments.status = '8' and payments.aprovision = '1' and payments.approved = '1' and (providers.flag = '1' or providers.international = '1' or payments.btype = '4')".$andor." group by payments.id order by payments.expiration asc"; 

$resultvip = mysqli_query($con, $queryvip); 
$numvip = mysqli_num_rows($resultvip);
if($_GET['echo'] == 1){
		echo '<strong>Query VIP:</strong> '.$queryvip; 
		echo '<br><strong>Num:</strong> '.$numvip;
	}
	
$showvip = 1;
//(!isset($_GET['page']) or 
if(($_GET['form'] == 1) or ($_GET['filter'] == 1)){
	$showvip = 0;
}

if(($numvip > 0) and ($showvip == 1)){ 
					
	
					
					?>
                   
                    
                    <div class="portlet">

					
						
                            
                            	<div class="portlet-title">

							<div class="caption">

								<?php 
	

								
echo $numvip; ?> Pagos VIP's

</div>

							

						</div>



                            <?php 
		


 

			?>
            
            <div class="portlet-body">

							<div class="table-container">

							
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									
                                         <th width="1%">

										 ID</th>

									

									<th width="15%">

										 Beneficiario</th>

									<th width="10%">Total Pagar</th>

									<th width="10%">

										 Vencimiento

									</th>

									<th width="10%">

										 Estado

									</th>

									<th width="10%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
								
								while($row=mysqli_fetch_array($resultvip)){ 
								
								$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']); 
								
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php if(($_SESSION['admin'] == "active") and ($row['blockrelease'] != "")){ ?>
<a href="#" class="btn default blue-stripe" onclick="unlockRelease(<?php echo $row['id']; ?>);"><i class="fa fa-unlock"> <?php echo $row['id']; ?></i></a>
                                <?php }else{
									echo $row['id'];
								} 
								?>
</td>
<td><?php 
if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; 
 echo $ben_name; ?></td>
 <td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); 
?></td>
<td><?php $date1 = date("Y-m-d");
									echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias < 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias >= 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>";   
	
	
?></td><td><?php 

$rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc LIMIT 1"));
						
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
									
							
								
							</td><td> 
                            <?php 
							
							if(($row['blockrelease'] == "")){ ?>
                            <a href="releasing-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> <?php }
							else{  
							
							$queryuser = "select * from workers where code = '$row[blockrelease]'";
							$resultuser = mysqli_query($con, $queryuser);
							$rowuser = mysqli_fetch_array($resultuser);
							$initial = $rowuser['first'];
							$initial = $initial[0];
							$lastname = explode(" ",$rowuser["last"]);
							$username = $initial.". ".$lastname[0];
							?>
                            
                            
                      <a href="<?php if($row['blockrelease'] == $_SESSION['userid']){ echo "releasing-view.php?id=".$row['id']; }else{ echo 'payment-order-view.php?id='.$row['id']; } ?>" class="btn btn-xs default btn-editable"><i class="fa fa-lock"></i> <?php echo $username; ?></a>      
                            <?php } ?></td></tr>
                                <?php } ?>
                                </tbody>

								</table>
                                <br>
                              
                            
							</div>

						</div>
					

					</div>
                    <? } 
					?>
                    
                    <div class="portlet">

					
						<? if($_GET['filter'] == 1){
							//Do nothing
							}else{ 
							?>
                            
                            	<div class="portlet-title">

							<div class="caption">

								<?php 
								
								$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$joinbill = 0;
$joinbatch = 0;
$chain = "";

$sql1 = "";
if($_GET['provider'] != ""){
$sql1 = " and payments.provider = '$_GET[provider]'";
$chain.= "&provider=".$_GET['provider'];
}
$sql2 = "";
if($_GET['worker'] != ""){
$sql2 = " and payments.collaborator = '$_GET[worker]'";
$chain.= "&worker=".$_GET['worker'];
}
$sql3 = "";
$sql4 = "";
if($_GET['bill'] != ""){
$sql4 = " and bills.number = '$_GET[bill]'";
$chain.= "&bill=".$_GET['bill'];
$joinbill = 1;
}
$sql5 = "";
if($_GET['batch'] != ""){
$joinbatch = 1;	
$sql5 = " and batch.nobatch = '$_GET[batch]'";
$chain.= "&batch=".$_GET['batch'];
}
$sql6 = "";
if($_GET['document'] != ""){
$joinbatch = 1;
$sql6 = " and batch.nodocument = '$_GET[document]'";
$chain = "&document=".$_GET['document'];
}

if($joinbill == 1){
	$join.= " left join bills on payments.id = bills.payment";
}
if($joinbatch == 1){
	$join.= " left join batch on payments.id = batch.payment";
}	

$sql = $sql0.$sql1.$sql2.$sql3.$sql4.$sql5;  
$join = $join1.$join2.$join3.$join4;
    
$sqlstrong = "";
if($_GET['request'] != ""){
$sql = " and payments.id = '$_GET[request]'";
$chain= "&request=".$_GET['request'];
}
	
$query = "select payments.id from payments  ".$join." where payments.status = '8' and payments.aprovision = '1' and payments.approved = '1'".$sql.$andor." group by payments.id order by payments.expiration asc"; 
   
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);  

$query1 = "select payments.id, payments.parent, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.currency, payments.payment, payments.expiration, payments.blockrelease, payments.d_approve from payments".$join." where child = '0' and payments.status = '8' and payments.aprovision = '1' and payments.approved = '1' and payments.btype != '4'".$sql.$andor." group by payments.id order by payments.expiration asc limit ".$inicio.",".$tampagina;   
$result1 = mysqli_query($con, $query1); 
if($_GET['echo'] == 1){
	echo '<strong>Query:</strong> '.$query.'<br>
<strong>Query1:</strong> '.$query1."<br>"; 
}	
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;
								
    
    $nnum = $numdev-$numvip;
    if($_GET['form'] == 1){
        $nnum = $numdev;
    }
								echo $nnum; ?> Pagos por liberar

							</div>

							

						</div>



                            <?php 
		


 

			?>
            
            <div class="portlet-body">

							<div class="table-container">

								<?php if($numdev > 0){ ?>
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									
                                         <th width="1%">

										 ID</th>

									

									<th width="15%">

										 Beneficiario</th>

									<th width="10%">Total Pagar</th>

									<th width="10%">

										 Vencimiento

									</th>

									<th width="10%">

										 Estado

									</th>

									<th width="10%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
								
								while($row=mysqli_fetch_array($result1)){ 
								
                                   
                                        $ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']);    
                                    
								
                                    
                                if(($row['btyte'] == 4) or ($_GET['form'] == 0) and ($rowprovider['flag'] == 1) or ($rowprovider['international'] == 1)){
                                    #doNothing
                                }else{
                                    
								
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php if(($_SESSION['admin'] == "active") and ($row['blockrelease'] != "")){ ?>
<a href="#" class="btn default blue-stripe" onclick="unlockRelease(<?php echo $row['id']; ?>);"><i class="fa fa-unlock"> <?php echo $row['id']; ?></i></a>
                                <?php }else{
									echo $row['id'];
								} 
								?>
</td><td><? if($row['d_approve'] == 1) echo '<img src="../images/flag-blue.png" width="13" alt=""/> '; ?><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; echo $ben_name; ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); ?></td>
                                    <td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias < 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias >= 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	
	
?></td><td><?php 

$rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc LIMIT 1"));
						
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
									
							
								
							</td><td> 
                            <?php 
							
							if(($row['blockrelease'] == "")){ ?>
                            <a href="releasing-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> <?php }
							else{  
							
							$queryuser = "select * from workers where code = '$row[blockrelease]'";
							$resultuser = mysqli_query($con, $queryuser);
							$rowuser = mysqli_fetch_array($resultuser);
							$initial = $rowuser['first'];
							$initial = $initial[0];
							$lastname = explode(" ",$rowuser["last"]);
							$username = $initial.". ".$lastname[0];
							?>
                            
                            
                      <a href="<?php if($row['blockrelease'] == $_SESSION['userid']){ echo "releasing-view.php?id=".$row['id']; }else{ echo 'payment-order-view.php?id='.$row['id']; } ?>" class="btn btn-xs default btn-editable"><i class="fa fa-lock"></i> <?php echo $username; ?></a>      
                            <?php } ?></td></tr>
                                <?php } } ?>
                                </tbody>

								</table>
                                <br><br>
                                 <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="releasing.php?page=<?php echo $previous.$chain; ?>&form=1">
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
		  echo '<li><a href="releasing.php?page='.$i.$chain.'&form=1">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="releasing.php?page=<?php echo $next.$chain; ?>&form=1">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                            <br><br>
                                <div class="note note-success">

						<p>

							NOTA: Las solicitudes de pago pendientes de liberar que aparecen con el nombre del liberador ej:  <a class="btn btn-xs default btn-editable"><i class="fa fa-lock"></i> J. Perez</a> se encuentran en proceso de liberación por el usuario. Cada vez que se ingresa una solicitud de pago pendiente de liberar se asigna automaticamente al liberador que ejecuta la acción. Para desbloquear la solicitud de pago pendiente de liberar, y  pueda ser procesada por otro liberador, se debe ingresar a la solicitud y presionar el boton  
							<button type="button" class="btn blue"><i class="fa fa-unlock"></i> Desbloquear</button> 
							que aparece en la parte inferior del visor de la solicitud de pago.
						</p>

					</div>
                                
                                <?php }else{ ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: Ninguna liberación pendiente.
						</p>

					</div>
                                <?php } ?>

							</div>

						</div>
						<?  } ?>

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
<script>
function unlockRelease(paymentid){
	window.location = "releasing-unlock.php?id="+paymentid; 
} 
</script> 