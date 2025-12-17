<?php include("sessions.php"); 

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
<?php //include('fn-expiration.php'); ?>
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

					Reportes <small>Gastos por categorías</small> 

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

							<a href="#">Gastos por categoria</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
                
<?php if(!isset($_GET['form'])){ ?>
<form id="ungrouped" name="ungrouped" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
<input name="form" type="hidden" id="form" value="1">
<div class="note note-regular">
<div class="row">
<h4 style="margin-left:15px;">Filtro:</h4><br>
                                           
<?php //Tipo ?>  
<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Tipo:</label>
<?php $queryt = "select * from categories where type = 1";
$resultt = mysqli_query($con, $queryt);
$numt = mysqli_num_rows($resultt);
$rowt = mysqli_fetch_array($resultt);
?>
															<select name="type" class="form-control" id="type" onChange="javascript:reloadsconcept(this.value,<?php echo $typeinc; ?>);">

<option value="0" <?php if($rowbill['type'] == 0){ echo 'selected'; } ?>>Seleccionar</option>
<?php $queryt1 = "select * from categories where parentcat = $rowt[id] order by name asc";
$resultt1 = mysqli_query($con, $queryt1);
while($rowt1=mysqli_fetch_array($resultt1)){
?>														<option value="<?php echo $rowt1['id']; ?>" <?php if($rowbill['type'] == $rowt1['id']) echo 'selected'; ?>><?php echo $rowt1['name']; ?></option>

<?php } ?>
	 														</select>

													  </div>

													</div>                                                    
<?php //Concepto ?>                                                    
<div class="col-md-4">

													  <div class="form-group">

															<label class="control-label">Concepto:</label>
															<select name="concept" class="form-control" id="concept" onChange="javascript:reloadsconcept2(this.value);">
<?php if($rowbill['concept'] == 0){
?>
<option value="0">Esperando la selección de tipo para cargar la lista</option>
<?php }else{ 
$queryconcept = "select * from categories where parentcat = '$rowbill[type]' order by account asc";
$resultconcept = mysqli_query($con, $queryconcept);
while($rowconcept=mysqli_fetch_array($resultconcept)){
?>
<option value="<?php echo $rowconcept['id']; ?>" <?php if($rowbill['concept'] == $rowconcept['id']) echo 'selected'; ?>><?php if($rowconcept['account'] != ""){ echo $rowconcept['account']." | "; } echo $rowconcept['name']; ?></option>
<?php } } ?>															</select>

												       
												      </div>
                                                    </div>                                                  
<?php //Categoria ?>                                                    
<div class="col-md-4"> 
                                                      <div class="form-group">
     <label class="control-label">Categoría:</label>

												        <select name="concept2" class="form-control" id="concept2">
													          
	<?php if($rowbill['concept2'] == 0){
	?>											          <option value="0">Esperando la selección de concepto para cargar la lista</option>
			<?php }else{ 
			$queryconcept2 = "select * from categories where parentcat = '$rowbill[concept]' order by account asc";
			$resultconcept2 = mysqli_query($con, $queryconcept2);
			while($rowconcept2=mysqli_fetch_array($resultconcept2)){
			?>									          <option value="<?php echo $rowconcept2['id']; ?>" <?php if($rowbill['concept2'] == $rowconcept2['id']) echo 'selected="selected"'; ?>><?php echo $rowconcept2['name']; ?></option>
			<?php } } ?> 					            </select>                                                  </div>
                                                    </div>
<?php //Rango de Fechas ?>
<div class="col-md-4" > 
                                                    <label class="control-label">Rango de Fechas:</label>

											<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">

												<input type="text" class="form-control" name="from" placeholder="desde">

												<span class="input-group-addon">

												<i class="fa fa-angle-double-right"></i></span>

												<input type="text" class="form-control" name="to" placeholder="hasta" >

											</div>

											<!-- /input-group -->

											
										</div>                                

<?php //Hasta aqui ?>                           
</div>  
                 
<div class="row">
</div>
<div class="row">

<br><br>
<div class="col-md-2">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-search"></i> Consultar</button> 
												
                 </div> 
                 
<div class="col-md-2">							

						    
						<button type="button" class="btn blue" onClick="goBack();"><i class="fa fa-repeat"></i> Regresar</button>
                           
							<script>
							function goBack(){
								window.location = "show-expenses-by-categories.php";
							}
							</script>
							
												
                 </div>                               
  
</div>
						
								</div>
                                </form> 
                                
                                <?php } ?>
					
					
					
					<?php if(isset($_GET['form'])){ ?>
                    
                    <div class="note note-regular">
                    <a href="<?php echo str_replace('/var/www/html','',$_SERVER['SCRIPT_FILENAME']); ?>">Volver a consultar</a> 
                    </div>
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

<?php 
								
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

$param1 = 0;
$param2 = 0;
												   
$type = $_GET['type'];
$concept = $_GET['concept'];
$concept2 = $_GET['concept2'];
$from = $_GET['from'];
$to = $_GET['to'];
												   
$sql1 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql1 = " and times.today >= '$from'";
	$param1++;
}
$sql2 = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sql2 = " and times.today <= '$to'";
	$param2++;
}

$sql3 = "";
if(($type == "0") or ($type == "") or ($type == " ") or ($type == "NULL")){
	//
}else{
	$sql3 = " and bills.type = '$type'";
	$param++; 
}

$sql4 = "";
if(($concept == "0") or ($concept == "") or ($concept == " ") or ($concept == "NULL")){
	//
}else{
	$sql4 = " and bills.concept = '$concept'";
	$param++;
}

$sql5 = "";
if(($concept2 == "0") or ($concept2 == "") or ($concept2 == " ") or ($concept2 == "NULL")){
	//
}else{
	$sql5 = " and bills.concept2 = '$concept2'";
	$param++;
}

												   
//$join = " inner join ";


if(($param1 == 0) or ($param2 == 0)){
	echo "<script>alert('Debe de seleccionar un rango de fechas.'); history.go(-1);</script>";
	$numdev = 0;
}elseif(($param == 0)){
	echo "<script>alert('Debe de seleccionar al menos una categoria.'); history.go(-1);</script>";
	$numdev = 0;
}else{
	//Do nothing
$join = $join1.$join2.$join3;
$sql = $sql1.$sql2.$sql3.$sql4.$sql5; 
 


$query = "select bills.niobillpayment from bills inner join times on bills.payment = times.payment inner join payments on payments.id = bills.payment where times.stage > '13' and payments.approved = '1'".$sql;
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);  
while($rowx = mysqli_fetch_array($result)){
	$lapapa+=$rowx[0];
}
	
			
$query1 = "select bills.number, bills.niobillpayment, times.today, payments.btype, payments.provider, payments.collaborator, payments.id from bills inner join times on bills.payment = times.payment inner join payments on payments.id = bills.payment where times.stage > '13' and payments.approved = '1'".$sql." order by times.today desc limit ".$inicio.",".$tampagina.""; 
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1; 
	 
if($_GET['echo'] == 1){ 
	echo $query."<br>"; 
}

}
echo $numdev; ?> Factura(s)
</div>

							<div class="actions">

								
							   
								<a href="show-expenses-by-categories-excel.php?sql=<? echo $sql; ?>" class="btn default blue-stripe">

								<i class="fa fa-excel"></i> 
								<span class="hidden-480">
								Exportar a excel</span> 
								</a>
								
								

								

							</div>

					  </div>

						<div class="portlet-body">

							<div class="table-container">

								
<br>
NIO C$<? echo str_replace('.00','',number_format($lapapa,2)); ?><br>
<span style="font-size: 12px; color: darkgrey;"><i>Ordenadas por fecha de Cancelación Descendente</i>
</span>
							

<?php 													

//echo $query;
//echo "<br>".$query1;

if($numdev > 0){  ?>
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="5%">IDS</th>
									
									<th width="5%">Factura</th>

									<th width="40%">Proveedor</th>

									<th width="16%">Total Pagar</th>

									<th width="15%">Fecha Cancelacion</th>

									<th width="17%">Opciones</th>

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
								
								
								
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><? echo $row[6]; ?></td>
                                <td>
                                <?php echo $row['number']; ?></td><td>                                  <?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; 
								if($row['btype'] == 1){ echo $rowprovider['code']." | ".$rowprovider['name'];
								}else{
									echo $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last']; }?></td>
                                    <td>
									<?php 
									echo "C$".str_replace('.00','',number_format($row['niobillpayment'],2));
									$gtotal_nio+=$row['niobillpayment'];
									 ?></td>
                                        <td>
										<?php 
										
										echo $row[2];
										//echo $elvencimiento = getExpiration($iddelpago); 
										
										?></td><td>
                             
                            <a href="payment-order-view.php?id=<?php echo $row[6]; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a> 
                           
                            
                            </td></tr>
                                <?php }
								
								?>
                               
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
<script>
	function reloadsconcept(nid){		
	$.post("reload-sconcepts.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept").innerHTML = data;
	});
	reloadsconcept2(0);
}

function reloadsconcept2(nid){		
	$.post("reload-sconcepts2.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept2").innerHTML = data; 
	});
	
}
</script>
	
