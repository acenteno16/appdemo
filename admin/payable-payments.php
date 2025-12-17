<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL); 

include("session-payer.php"); 

$join_payment = 0;

$blocked = "";
if(isset($_GET['blocked'])){
	$blocked = $_GET['blocked'];
}

$sql1 = "";
if($blocked != ""){
	$sql1 = " and schedule.userid = '$blocked'";
}

$provider = "";
if(isset($_GET['provider'])){
	$provider = $_GET['provider'];
}

$sql2 = "";
if($provider != ""){
	$join_payment = 1;
	$sql2 = " and payments.provider = '$provider'";
}

$worker = "";
if(isset($_GET['worker'])){
	$worker = $_GET['worker'];
}

$sql3 = "";
if($worker != ""){
	$join_payment = 1;
	$sql3 = " and payments.collaborator = '$worker'";
}

$request = "";
if(isset($_GET['request'])){
	$request = $_GET["request"];
}

$sql4 = "";
if($request != ""){
	$join_payment = 1;
	$sql4 = " and payments.id = '$request'";
}

$pp = "";
if(isset($_GET['pp'])){
	$pp = $_GET["pp"];
}

$sql5 = "";
if($pp != ""){
	$sql5 = " and schedule.userid2 = '$pp'";
}

$pro = $_GET['pro'];
$sql6 = "";
if($pro > 0){
	if($pro == 2){
		$pro = 0;
	}
	$sql6 = " and schedule.vo = '$pro'"; 
}

$groupid = "";
if(isset($_GET['groupid'])){
	$groupid = $_GET['groupid'];
}

$sql7 = "";
if($groupid != ""){
	$sql7 = " and schedule.id = '$groupid'";
}						

$bank = "";
if(isset($_GET['bank'])){
	$bank = $_GET['bank'];
}
 
$sql8 = "";
if($bank != ""){
	$sql8 = " and schedule.bank = '$bank'";
}						

$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8; 
						

if($join_payment == 1){ 
	$join2 = " inner join schedulecontent on schedule.id = schedulecontent.schedule inner join payments on payments.id = schedulecontent.payment";
}	
			
$join = "";

if(isset($join1)){
	$join.=$join1;
}

if(isset($join2)){
	$join.=$join2;
	#$result1 = mysqli_query($con, $query1);
}
						

$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$query = "select schedule.* from schedule".$join." where (schedule.status = '3' or schedule.status = '5')".$sql." group by schedule.id order by schedule.id desc";  
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);  
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);      

$query1 = "select schedule.* from schedule".$join." where (schedule.status = '3' or schedule.status = '5')".$sql." group by schedule.id order by id desc limit ".$inicio.",".$tampagina;
$result1 = mysqli_query($con, $query1); 


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

					Cancelación de pagos <?php /*<small>Aprobación de programación</small> */ ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						

					
                        <li>

							<a href="#">Cancelación de pagos
</a>
							

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

						  <div class="portlet">

									<div class="portlet-title">

										<div class="caption">

										

										</div>

										
									</div>
							  

									<div class="portlet-body form">
										
										<? 
if($_GET['echo'] == 1){
	echo $query."<br>".$query1;
}
										?>
										
										  <? #if($_SESSION['email'] == 'jairovargasg@gmail.com'){ ?>
										 <form id="ungrouped" name="ungrouped" action="<? echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">  
<div class="note note-regular">
 

                             
<div class="row">
<br>
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Procesador de pago:</label>

						
											<select name="blocked" class="form-control  select2me" id="blocked" data-placeholder="Seleccionar...">

												<option value="">Todos los Procesadores</option>
 <?php
 
 $queryprocessor0 = "select * from schedule group by userid";
 $resultprocessor0 = mysqli_query($con, $queryprocessor0);
 while($rowprocessor0=mysqli_fetch_array($resultprocessor0)){

 $rowprocessor = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$rowprocessor0[userid]'")); 

 ?>
 <option value="<?php echo $rowprocessor["code"]; ?>"><?php echo $rowprocessor["code"].' | '.$rowprocessor["first"]." ".$rowprocessor["last"]; ?></option>
 <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>                      
													  
													  <div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Proveedor:</label> 

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value="">Todos los Proveedores</option>
 <?php $queryproviders = "select * from providers order by name";
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
													
													
</div>
<div class="row">

<div class="col-md-4">

													  <div class="form-group">
													  <label class="control-label">Asignado a:</label>
											<select name="pp" class="form-control  select2me" id="pp" data-placeholder="Seleccionar...">

												<option value="">Todos los procesadores</option>
 										<?php  
											$querypp = "select * from routes where type = '7' group by worker";
									   		$resultpp = mysqli_query($con, $querypp);
									   		
											while($rowpp = mysqli_fetch_array($resultpp)){
										
											$queryproviders = "select * from workers where code = '$rowpp[worker]'";
											$resultproviders = mysqli_query($con, $queryproviders); 
											$rowproviders = mysqli_fetch_array($resultproviders);
											?>
                                            <option value="<?php echo $rowproviders["code"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option> 
                                            <?php  } 
											?>

												

											</select>

															<div title="Page 5"></div>
				    </div>

										  </div>
<? /*
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Compañia:</label>

						
											<select name="company" class="form-control  select2me" id="company" data-placeholder="Seleccionar...">

												<option value="">Todas las compañias</option>

                                            <? 
											
											$querycompanies = "select * from companies where active = '1'";
											$resultcompanies = mysqli_query($con, $querycompanies);
											while($rowcompanies=mysqli_fetch_array($resultcompanies)){
											
											?>
                                            <option value="<? echo $rowcompanies['id']; ?>" <?php if($_GET['company'] == $rowcompanies['id']) echo 'selected'; ?>><? echo $rowcompanies['name']; ?></option>
                                           <? } ?>
                                          

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Banco:</label>

						
											<select name="bank" class="form-control  select2me" id="bank" data-placeholder="Seleccionar...">

												<option value="">Todos los Bancos</option>

                                            <? 
											
											$querycompanies = "select * from banks order by name";
											$resultcompanies = mysqli_query($con, $querycompanies);
											while($rowcompanies=mysqli_fetch_array($resultcompanies)){
											
											?>
                                            <option value="<? echo $rowcompanies['id']; ?>" <?php if($_GET['bank'] == $rowcompanies['id']) echo 'selected'; ?>><? echo $rowcompanies['name']; ?></option>
                                           <? } ?>
                                          

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
*/ ?>                                                   <div class="col-md-4 ">
													  <div class="form-group">
														<label>ID de Solicitud:</label>
                                                        <input name="request" type="text" class="form-control" id="request" value="">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
													
													
													   <div class="col-md-4 ">
													  <div class="form-group">
														<label>ID de Grupo:</label>
                                                        <input name="groupid" type="text" class="form-control" id="groupid" value="">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
													</div>
<div class="row">
													
													<div class="col-md-4">

													  <div class="form-group">
													  <label class="control-label">Estado</label>
											<select name="pro" class="form-control  select2me" id="pro" data-placeholder="Seleccionar...">

											<option value="0">Todos</option>
 								 
											
                                            <option value="1">Visto Bueno</option> 
                                            <option value="2">Pendientes</option> 
                                           

												

											</select>

															<div title="Page 5"></div>
				    </div>

										  </div>
	
	
	
	
	<div class="col-md-4">

													  <div class="form-group">
													  <label class="control-label">Banco</label>
											<select name="pro" class="form-control  select2me" id="pro" data-placeholder="Seleccionar...">

												<option value="">Todos</option>
 								 
										<?  
										
										$querybanks = "select * from banks order by name";
										$resultbanks = mysqli_query($con, $querybanks);
										while($rowbanks = mysqli_fetch_array($resultbanks)){ 
										 
										?>	
                                        <option value="<? echo $rowbanks['id']; ?>"><? echo $rowbanks['name']; ?></option> 
                                        <? } ?> 
                                           

												

											</select>

															<div title="Page 5"></div>
				    </div>

										  </div>
</div>
<div class="row">

<br><br>
						<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button><input type="button" class="btn blue" style="margin-left:5px;" onClick="window.location='payable-payments.php';" value="Limpiar Filtro"> 
												
                 </div>                               
  
</div>
						
								</div>
                                
                                </form>
                           
										<? #} ?>

										<!-- BEGIN FORM-->

										<? /*<form action="<? echo $_SERVER['PHP_SELF']; ?>" class="horizontal-form" method="get" enctype="multipart/form-data">

											<div class="form-body">

												<h3 class="form-section">Filtro</h3>
                                                

												<div class="row"><!--/span-->

												  <div class="col-md-4 ">
													  <div class="form-group">
														<label>ID del Grupo (GID):</label> 
                                                        <input name="gid" type="text" class="form-control" id="gid" value="<? echo $_GET['gid']; ?>">
						
                                                      <!--/row--></div>
												  </div>
                                                    
                                                     <div class="col-md-4 ">    
                                                    <div class="form-group">
														<label>ID de la solicitúd (IDS):</label> 
                                                        <input name="id" type="text" class="form-control" id="id" value="<? echo $_GET['id']; ?>">
                                                      </div>
                                                    </div> 

													<!--/span-->

											  </div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

										  <!--/row--><!--/row--></div>


											<div class="form-actions right">

												<button type="button" class="btn red" onClick="javascript:cancelAction();"><i class="fa fa-eraser"></i> Limpiar Filtro</button>
                                                <script> function cancelAction(){
                                                        window.location = "payable-payments.php";
                                                    }
                                                </script>

												<button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button>

											</div>

										</form>*/ ?>
										
										

										<!-- END FORM-->

									</div>
                                    
                       

								</div>

                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

<? 

echo $num; ?> Grupos pendientes de cancelación

							</div>
                            <div class="actions">

							
                                 <a href="payable-payments-export.php" class="btn default blue-stripe" target="_blank">

								<i class="fa fa-file-excel-o"></i>

								<span class="hidden-480">

								 Ingreso a banco </span>

								</a>
								
								  <a href="payablePaymentsExport.php" class="btn default blue-stripe" target="_blank">

								<i class="fa fa-file-excel-o"></i>

								<span class="hidden-480">

								 Pendientes de cancelación </span> 

								</a>
								
								
								<a href="payable-payments-group.php" class="btn default blue-stripe" target="_blank">

								<i class="fa fa-group"></i>

								<span class="hidden-480">

								Ver grupos cancelados</span>

								</a>
                                
                                

							

							</div>
                            

						</div>

						

					</div>
                    <div class="portlet-body">			
<?php
 
						
if($num > 0){ ?> 
                                
<?php //echo $query; ?>
<div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<?php /*<th width="2%">
                                    <input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
                                
                                  <script>
    function checkAll(){
	 var checkall = document.getElementById('checkall');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('theid[]');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
      </script>

										 </th>*/ ?>
                                    <th width="2%">Estado</th>
									<th width="2%">GID</th>
                                          <th width="2%">

										WID</th>

									<th width="20%">

										 Usuario Asignado</th>

									<th width="8%">Fecha</th>

									<th width="6%">

										 Hora</th>

									<th width="14%">

										 Monto

									</th>
                                    
                                    <th width="5%">

										 Moneda 

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody> 
                                <?php while($row=mysqli_fetch_array($result1)){
							 	
								$rowuser= mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid2]'"));
								
								$err = 0;
								$queryContent = "select payments.ppe1 from schedulecontent inner join payments on schedulecontent.payment = payments.id where schedulecontent.schedule = '$row[id]'";
								$resultContent = mysqli_query($con, $queryContent);
								$numContent = mysqli_num_rows($resultContent);			 
								while($rowContent=mysqli_fetch_array($resultContent)){
									if($rowContent['ppe1'] == 1) $err++;
								}
								
								#$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								#$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								#$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd <? if($err > 0){ echo 'danger'; } ?>"> 
                                <?php /*<td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>*/ ?>
                                 
									<td><?
								echo $numContent-$err.'/'.$numContent;
							
									  ?></td>
									<td><?php echo $row['id']; ?></td>
                                  <td><?php echo $row['code']; ?></td>
                                  <td><?php echo $rowuser['first']." ".$rowuser['last']; ?></td>
                                  <td><?php echo date('d-m-Y',strtotime($row['today'])); ?><br>
                                    
</td><td><?php echo date('h:i a', strtotime($row['now2'])); ?></td>
                                
                               <td>
                               
                               <?php 
							   $gpayment = 0;
							   switch($row['currency']){
								  case 1:
								  $pre = "NIO C$";
								  $currency = "Córdobas";
								  break;
								  case 2:
								  $pre = "USD U$";
								  $currency = "Dólares";
								  break;
								  case 3:
								  $currency = "Euros";
								  break;
								  case 4:
								  $currency = "Yenes";
								  break;
							  }
							  
							   $querymain = "select * from schedulecontent where schedule = '$row[id]'"; 
								$resultmain = mysqli_query($con, $querymain);
								while($rowmain = mysqli_fetch_array($resultmain)){
									$querypayment = "select * from payments where id = '$rowmain[payment]'";
									$resultpayment = mysqli_query($con, $querypayment);
									$rowpayment = mysqli_fetch_array($resultpayment); 
									$gpayment+=$rowpayment['payment'];
								}
								
								echo $pre.str_replace('.00','',number_format($gpayment,2));
								
							   ?>
                               
                               </td>
                               
                                <td><?php 
								echo $currency;
								?> 
									
							
								
							</td><td><a href="payable-payments-cancellation-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                            
                            
                            </td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                </div>
                                
                                <br>
                                <div class="note note-regular">
                                GID: ID de grupo.<br>
                                WID: ID web.<br>
                                
                                </div>
                        
                        
                        <div>
								<ul class="pagination pagination-lg">
<?php 
    if($previous != ""){ 
                                    ?>
                  
                 <li>
										<a href="payable-payments.php?gid=<? echo $_GET['gid']; ?>&page=<?php echo $previous; ?>&form=1">
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
		  echo '<li><a href="payable-payments.php?gid='.$_GET['gid'].'&page='.$i .'&form=1">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="payable-payments.php?gid=<? echo $_GET['gid']; ?>&page=<?php echo $next; ?>&form=1">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                                                    
 <?php } 
 else { 
							
								?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No se encontraron  grupos pendientes de aprobado de programación.

						</p>

					</div>
                                <?php } ?>
                                </div></div></div>
                             
			<!-- END PAGE CONTENT-->

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

<script src="../assets/admin/pages/scripts/table-managed.js"></script> 

<!-- END PAGE LEVEL SCRIPTS -->

<script>
jQuery(document).ready(function() {    
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
TableManaged.init(); 
});


</script> 

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>