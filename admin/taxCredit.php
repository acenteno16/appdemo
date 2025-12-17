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

							<a href="#">IVA</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
                

<form id="ungrouped" name="ungrouped" action="taxCredit.php" enctype="multipart/form-data" method="get">
<input name="form" type="hidden" id="form" value="1">
<div class="note note-regular">
<div class="row">
<h4 style="margin-left:15px;">Filtro:</h4><br>
                           <div class="col-md-3">
	<label>Compañía:</label>
	<select name="company" id="company" class="form-control">
	<option value="0">Seleccionar</option>
	<? 
	$queryCompany = "select id, name from companies";
		$resultCompany = mysqli_query($con, $queryCompany);
		while($rowCompany=mysqli_fetch_array($resultCompany)){
		?>
		<option value="<? echo $rowCompany['id']; ?>" <? if($rowCompany['id'] == $_GET['company']) echo 'selected'; ?>><? echo $rowCompany['name']; ?></option>
	<? } ?>
	</select>
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

</div>
						
								</div>
                                </form> 
                                
                         
	

			</div>
				
				<div class="col-md-12">
					<!-- Begin: life time stats -->
 
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<? $today = date('Y-m-d'); 
$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}
								
								$company = $_GET['company'];
								$from = $_GET['from'];
								$to = $_GET['to'];
								
								$sql1 = "";
								if($company > 0){
									$sql1 = " and company = '$company'";
									$vars.="&payments.company=$company";
								}
								
								$sql2 = "";
								if($from != ""){
									$from = date("Y-m-d", strtotime($from));
									$sql2 = " and taxCredit.today >= '$from'";
									$vars.="&from=$from";
								}
								$sql3 = "";
								if($to != ""){
									$to = date("Y-m-d", strtotime($to));
									$sql3 = " and taxCredit.today <= '$to'";
									$vars.="&to=$to";
								}
								
								$sql = $sql1.$sql2.$sql3;
								

$query = "select taxCredit.id from taxCredit inner join payments on taxCredit.payment = payments.id where taxCredit.id > '0'$sql";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);       

$query1 = "select taxCredit.id, taxCredit.bill, taxCredit.payment, taxCredit.userid, taxCredit.type, taxCredit.status from taxCredit inner join payments on taxCredit.payment = payments.id where taxCredit.id > '0'$sql order by taxCredit.id desc limit ".$inicio.",".$tampagina;  
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;	

								echo number_format($numdev); ?> Documentos

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

								<?php 						
								
if($numdev > 0){  ?>
                                <form enctype="multipart/form-data" name="form" id="form" action="taxCreditExport.php" method="post">
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">
<th width="2%">

										 <input type="checkbox" class="group-checkable" id="checkall0" onChange="javascript:checkAll0();" /> 
                                
                                  <script>
    function checkAll0(){
	 var checkall = document.getElementById('checkall0');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByClassName('approve0');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			 if(checkboxes[i].disabled == true){
			 	checkboxes[i].checked = false; 
			 }
         
      }
	}
      </script>
      </th>
									<th width="2%">EDO</th>
									<th width="10%">RUC</th>
									<th width="20%">Nombre</th>
									<th width="7%">No. Factura</th><br>
									<th width="40%">Descripcion</th>
									<th width="10%">Fecha</th>
									<th width="10%">Monto</th>
									<th width="10%">Impuesto</th>
									<th width="10%">Moneda</th>
									<th width="30%">Provisionador</th>
									<th width="10%">IDS</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
				while($rowMain=mysqli_fetch_array($result1)){ 
					
					$query = "select provider, description, currency from payments where id = '$rowMain[payment]'";
					$result = mysqli_query($con, $query);
					$row = mysqli_fetch_array($result);
					
					$queryBill = "select billdate, stotal, tax from bills where id = '$rowMain[bill]'";
					$resultBill = mysqli_query($con, $queryBill);
					$rowBill = mysqli_fetch_array($resultBill);
					
					$queryProvider = "select ruc, name from providers where id = '$row[provider]'";
					$resultProvider = mysqli_query($con, $queryProvider);
					$rowProvider = mysqli_fetch_array($resultProvider);
					
					$queryUser = "select code, first, last from workers where code = '$rowMain[userid]'";
					$resultUser = mysqli_query($con, $queryUser);
					$rowUser = mysqli_fetch_array($resultUser);
					
					$thisCurrency = '';
					switch($row['currency']){
						case 1:
							$thisCurrency = 'COR';
							break;
						case 2:
							$thisCurrency = 'USD';
							break;
					}
									?>
                                
                                <tr role="row" class="odd">
									 <td class="sorting_1"> <input name="id[]" type="checkbox" id="id[]" value="<?php echo $rowMain['id']; ?>" class="approve0"></td>
									<td><i class="fa fa-arrow-down"></i></td>
									<td><?php echo $rowProvider['ruc']; ?></td>
									<td><?php echo $rowProvider['name']; ?></td>
									<td><? echo $rowMain['bill']; ?></td>
									<td><? echo substr($row['description'],0,50).'...'; ?></td>
									<td><? echo $rowBill['billdate']; ?></td>
									<td><? echo $rowBill['stotal']; ?></td>
									<td><? echo $rowBill['tax']; ?></td>
									<td><? echo $thisCurrency; ?></td>
									<td><? echo $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last']; ?></td>
									<td><? echo $rowMain['payment']; ?></td>
								</tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
								<button type="submit" class="btn blue" onClick="javascript:genExcel();" id="exp"><i class="fa fa-print"></i> Exportar</button>
								<button type="submit" class="btn blue" onClick="javascript:genExcel();" id="pre"><i class="fa fa-print"></i> Excel preliminar</button>
								</form>
                                <div>
							
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  				<li><a href="taxCredit.php?page=<?php echo $previous.$vars; ?>"><i class="fa fa-angle-left"></i></a></li>
                  				<?php }  ?>
								
								<?php if ($totpagina > 1){
  
  								for ($i=1;$i<=$totpagina;$i++){ 
										if ($pagina == $i){
											echo '<li class="active"><a href="#">'.$i .'</a></li>';  
										}else{
											echo '<li><a href="taxCredit.php?page='.$i.$vars.'">'.$i .'</a></li>'; 
										}
    							} } ?>
             					<?php if($next != ""){ ?>
									<li><a href="taxCredit.php?page=<?php echo $next.$vars; ?>"><i class="fa fa-angle-right"></i></a></li>
                  				<?php } ?>
								</ul>
							    </div>
                                <?php } else { ?>
                                <div class="note note-danger"><p>NOTA: Sin resultados.</p></div>
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
	
