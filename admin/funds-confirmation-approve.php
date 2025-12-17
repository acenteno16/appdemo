<?php 

include("session-request.php"); 
include("functions.php");

$thisCompany = array();
$queryCompany = "select * from companies";
$resultCompany = mysqli_query($con, $queryCompany);
while($rowCompany = mysqli_fetch_array($resultCompany)){
	$thisCompany[$rowCompany['id']] = $rowCompany['name'];
}
$thisBank = array();
$queryBank = "select * from banks";
$resultBank = mysqli_query($con, $queryBank);
while($rowBank = mysqli_fetch_array($resultBank)){
	$thisBank[$rowBank['id']] = $rowBank['name'];
}
$thisCurrency = array();
$queryCurrency = "select * from currency";
$resultCurrency = mysqli_query($con, $queryCurrency);
while($rowCurrency = mysqli_fetch_array($resultCurrency)){
	$thisCurrency[$rowCurrency['id']] = $rowCurrency['name'];
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

					Aprobación de confirmación de fondos

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  
						  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>
<i class="icon-check"></i>
							<a href="#">Aprobación de confirmación de fondos</a>

						

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

<div class="col-md-3 ">
<div class="form-group">
<label>ID CDF:</label>
<input name="request" type="text" class="form-control" id="request" value="<?php if(isset($_GET['request'])){ echo $_GET['request']; } ?>">
</div></div>
	
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Solicitante:</label>
<select name="requester" class="form-control  select2me" id="requester" data-placeholder="Seleccionar...">
	<option value="" selected>Todos los Colaboradores</option>
 	<?php
	$queryRequester = "select id, code, first, last from workers order by first,last";
	$resultRequester = mysqli_query($con, $queryRequester);
	while($rowRequester = mysqli_fetch_array($resultRequester)){ 
		if($rowRequester["code"] != ''){ ?>
       		<option value="<?php echo $rowRequester["code"]; ?>" <? if($rowRequester["code"] == $_GET['requester']) echo 'selected'; ?>><?php echo $rowRequester["code"].' | '.$rowRequester["first"].' '.$rowRequester["last"]; ?></option>
     <?php } } ?> 
</select>
</div></div>
	
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Compañía:</label>
<select name="company" class="form-control" id="company">
	<option value="" selected>Todas las compañías</option>
 	<?php
	$queryCompany = "select id, name from companies order by name";
	$resultCompany = mysqli_query($con, $queryCompany);
	while($rowCompany = mysqli_fetch_array($resultCompany)){ ?>
		<option value="<?php echo $rowCompany["id"]; ?>" <? if($rowCompany["id"] == $_GET['company']) echo 'selected'; ?>><?php echo $rowCompany["name"]; ?></option>
     <?php } ?> 
</select>
</div></div>

<div class="col-md-3">
<div class="form-group">
<label class="control-label">Banco:</label>
<select name="bank" class="form-control" id="bank">
	<option value="" selected>Todos los Bancos</option>
 	<?php
	$queryBank = "select id, name from banks order by name";
	$resultBank = mysqli_query($con, $queryBank);
	while($rowBank = mysqli_fetch_array($resultBank)){ ?>
       		<option value="<?php echo $rowBank["id"]; ?>" <? if($rowBank['id'] == $_GET['bank']) echo 'selected'; ?>><?php echo $rowBank["name"]; ?></option>
     <?php } ?> 
</select>
</div></div>
	
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Moneda:</label>
<select name="currency" class="form-control" id="currency">
	<option value="" selected>Todos las monedas</option>
 	<?php
	$queryCurrency = "select * from currency";
	$resultCurrency = mysqli_query($con, $queryCurrency);
	while($rowCurrency = mysqli_fetch_array($resultCurrency)){  ?>
       		<option value="<?php echo $rowCurrency["id"]; ?>" <? if($rowCurrency['id'] == $_GET['currency']) echo 'selected'; ?>><?php echo $rowCurrency['name']; ?></option>
     <?php } ?> 
</select>
</div></div>




                             
<div class="row"></div>

<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button> <button type="button" class="btn red" onClick="resetFilter();"><i class="fa fa-filter"></i> Quitar Filtro</button>  <script>
                            function resetFilter(){
                            
                            window.location = "funds-confirmation-approve.php";
							
                            }
                            </script>
												
                 </div>                               
 </form>
</div>
</div>
</div>
			

			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
 
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Confirmación de fondos pendientes de aprobación

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

<?php 

$today = date('Y-m-d'); 
$tampagina = 25;
$pagina = 1;
if(isset($_GET['page'])){
	$pagina = $_GET['page'];
}
if($pagina == 1){
	$inicio = 0;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$from = "";
if(isset($_GET['from'])){
	$from = $_GET['from'];
}
$to = "";
if(isset($_GET['to'])){
	$to = $_GET['to'];
}

$request = "";
if(isset($_GET['request'])){
	$request = $_GET['request'];
}
$requester = '';
if(isset($_GET['requester'])){
	$requester = $_GET['requester'];
}
$company = '';
if(isset($_GET['company'])){
	$company = $_GET['company'];
}
$bank = '';
if(isset($_GET['bank'])){
	$bank = $_GET['bank'];
}
$currency = '';
if(isset($_GET['currency'])){
	$currency = $_GET['currency'];
}

$sql1 = "";
if($from != ""){
$from = date("Y-m-d", strtotime($from));
$sql1 = " and funds.today >= '$from'";
}
$sql2 = "";
if($to != ""){
$to = date("Y-m-d", strtotime($to));
$sql2 = " and funds.today <= '$to'";
}
$sql3 = "";
if($requester != ""){
$sql3 = " and funds.userid = '$requester'";
}
$sql4 = "";
if($request != ""){
	$sql4 = " and funds.id = '$request'";
}
$sql5 = "";
if($company != ''){
	$sql5 = " and funds.company = '$company'";
}
$sql6 = "";
if($bank != ''){
	$sql6 = " and funds.bank = '$bank'";
}
$sql7 = "";
if($currency != ''){
	$sql7 = " and funds.currency = '$currency'";
}

$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6	.$sql7;
  
$query = "select * from funds where status = '1'$sql order by id desc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);

$query1 = "select * from funds where status = '1'$sql order by id desc limit ".$inicio.",".$tampagina;  
$result1 = mysqli_query($con, $query1); 
$next = 1;
$previous = 0;
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;							
			
			if($_GET['echo'] == 1){ 
				echo 'query: '.$query.'<br>query1: '.$query1;
			}
			
if($numdev > 0){  ?>
                                
                                <div class="table-scrollable">	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="1%">ID</th>
									<th width="5%">Fecha</th>
									<th width="10%">Usuario</th>
									<th width="5%"> Compañía</th>
									<th width="5%">Banco</th>
									<th width="5%">Moneda</th>
									<th width="5%">Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
	
								#$ben_name = getBen(0, 4, 0, 0, 0, $row['client']); 
	
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								$rowUser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $row['id']; ?></td>
								<td><?php echo $row['totime'];  ?></td>
								<td><? echo $rowUser['code'].' | '.$rowUser['first'].' '.$rowUser['last']; ?></td>	
								<td><?php echo $thisCompany[$row['company']]; ?></td>
								<td><?php echo $thisBank[$row['bank']]; ?></td>
								<td><?php echo $thisCurrency[$row['currency']]; ?></td>
                         		<td>
                            	<a href="funds-confirmation-approve-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                         		</td></tr>
                                <?php } ?>
                                </tbody>
								</table>	
								</div>
                                
                               <? /* <div>
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
							</div> */ ?>
                            
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