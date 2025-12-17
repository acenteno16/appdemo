<?php 

#ini_set('display_errors', 1); 
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("session-bankingDebt.php");  
include("functions.php"); 

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
<?php #include('fn-expiration.php'); ?>
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

					Deuda bancaria <? //<small>Solicitudes de pago</small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  
						  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Deuda bancaria</a>

						

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
						
						<?  if((isset($_SESSION['bankingDebtAdmin']) and ($_SESSION['bankingDebtAdmin'] == 'active')) or ($_SESSION['admin'] == 'active')){ ?>

						<div class="portlet-title">

							<div class="caption">

								Prestamos activos (Pendientes de documentrar)
							</div>

							
							<div class="actions">
							
							
								<? /*<a href="bankingDebtDataDelete.php" class="btn red blue-stripe">
								<i class="fa fa-trash-o"></i> Borrar data 
								
								</a>*/ ?>
								<a href="javascript:openCalculator();" class="btn default blue-stripe">
								<i class="icon-calculator"></i>
								
								</a>	
								<a href="bankingDebtContracts.php" class="btn default blue-stripe">
								<i class="icon-notebook"></i>
								<span class="hidden-480">
								Contratos</span> 
								</a>
								<a href="bankingDebtAll.php" class="btn default blue-stripe">
								<i class="icon-screen-desktop"></i>
								<span class="hidden-480">
								Vista Especial</span> 
								</a>
								<a href="bankingDebtOrder.php" class="btn default blue-stripe">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
								Agregar Desembolso</span> 
								</a>
								
								

							</div>
							

						</div>
						
						<div class="note note-regular">
<div class="row">
<div class="col-md-12">
<form id="ungrouped" name="ungrouped" action="
<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
<input name="form" type="hidden" id="form" value="1">							
<h4 style="margin-left:15px;">Filtro:</h4><br>
<div class="col-md-3" >
	<label class="control-label">Rango de Fechas:</label> 
	<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy" >
		<input type="text" class="form-control" name="date1" placeholder="desde" value="<? if(isset($_GET['date1'])) echo $_GET['date1']; ?>" readonly>
		<span class="input-group-addon">
			<i class="fa fa-angle-double-right"></i> 
		</span>
		<input type="text" class="form-control" name="date2" placeholder="hasta" value="<? if(isset($_GET['date2'])) echo $_GET['date2']; ?>" readonly>
	</div>
</div>       
<div class="col-md-3">
	<div class="form-group">
	<label class="control-label">Compañía:</label>
		<select name="company" class="form-control  select2me" id="company" data-placeholder="Seleccionar...">
			<option value="">Todas las Compañías</option>
			<?php
			$company = isset($_GET['company']) ? intval($_GET['company']) : 0;
			$queryproviders = "select * from companies";
			$resultproviders = mysqli_query($con, $queryproviders);
			while($rowproviders = mysqli_fetch_array($resultproviders)){
			?>
			<option value="<?php echo $rowproviders["id"]; ?>" <?php if($rowproviders["id"] == $company) echo 'selected'; ?>><?php echo $rowproviders["name"]; ?></option>
            <?php } ?>
		</select>
	</div>
</div>	

<div class="col-md-3">
	<div class="form-group">
	<label class="control-label">Banco:</label>
		<select name="bank" class="form-control  select2me" id="bank" data-placeholder="Seleccionar...">
			<option value="">Todos los Bancos</option>
			<?php 
			$bank = isset($_GET['bank']) ? intval($_GET['bank']) : 0;
			$queryproviders = "select * from banks";
			$resultproviders = mysqli_query($con, $queryproviders);
			while($rowproviders = mysqli_fetch_array($resultproviders)){
			?>
			<option value="<?php echo $rowproviders["id"]; ?>" <?php if($rowproviders["id"] == $bank) echo 'selected'; ?>><?php echo $rowproviders["name"]; ?></option>
            <?php } ?>
		</select>
	</div>
</div>		
	
<div class="row"></div><br>

<div class="col-md-4">	
	<input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button> <button type="button" class="btn red" onClick="resetFilter();"><i class="fa fa-filter"></i> Quitar Filtro</button>  
	<script>
		function resetFilter(){
			window.location = "bankingDebt.php";
		}
	</script>
</div>                               
 </form>
</div>
</div>
</div>

						<div class="portlet-body">

							<div class="table-container">


<?php 

$today = date('Y-m-d'); 
$tampagina = 50;
if(isset($_GET['page'])) $pagina = $_GET['page']; else $pagina = '';
if(!$pagina){ 
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

if(isset($_GET['date1'])) $date1 = $_GET['date1']; else $date1 = '';
if(isset($_GET['date2'])) $date2 = $_GET['date2'];  else $date2 = '';
if(isset($_GET['company'])) $company = $_GET['company']; else $company = '';
if(isset($_GET['bank'])) $bank = $_GET['bank']; else $bank = '';								
								
$firstDay = date('Y-m-1');
$lastDay = date('Y-m-t');	
														
$sql0 = " and bankingDebt.date2 >= '$firstDay' and bankingDebt.date2 <= '$lastDay'";
								
$sql1 = '';								
if($date1 != ''){
	$date1 = date("Y-m-d", strtotime($date1));
	$sql0 = '';
	$sql1 = " and bankingDebt.date2 >= '$date1'";
}
								
$sql2 = '';								
if($date2 != ''){
	$date2 = date("Y-m-d", strtotime($date2	));
	$sql0 = '';
	$sql2 = " and bankingDebt.date2 <= '$date2'";
}

$sql3 = '';
if($company != ''){
	$sql3 = " and bankingDebtContracts.company='$company'";
}

$sql4 = '';
if($bank != ''){
	$sql4 = " and bankingDebtContracts.bank='$bank'";
}
								
$sql = $sql0.$sql1.$sql2.$sql3.$sql4;								
 
$query = "select bankingDebt.*, bankingDebtContracts.company, bankingDebtContracts.bank, bankingDebtContracts.currency from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where (bankingDebt.status2 = '2' or bankingDebt.status2 = '2.10')$sql";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);
								
if(isset($_GET['echo']) and $_GET['echo'] == 1){
	echo $query;
}								

$query1 = "select bankingDebt.*, bankingDebtContracts.company, bankingDebtContracts.bank, bankingDebtContracts.currency from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where (bankingDebt.status2 = '2' or bankingDebt.status2 = '2.10')$sql order by date2 asc limit ".$inicio.",".$tampagina;  
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1; else $next = '';
if($pagina > 1) $previous = $pagina-1; else $previous = '';						

if($numdev > 0){  ?>
								<div id="dataTable0">
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="1%">

										 ID</th>
									<th width="8%">

										 Fecha</th>

									<th width="16%">

										 Compañía</th>

									<th width="16%">Banco</th>

									<th width="16%">

										 No. Prestamo

									</th>

									<th width="16%">

										 Movimiento

									</th>
									<th width="16%">

										Fecha de pago

									</th>
								

									<th width="8%">

										 Opciones</th>

									</tr>

								</thead>

								<tbody>
									
                                <?php 
				
    $querycompany = "select * from companies";
    $resultcompany = mysqli_query($con, $querycompany);
    while($rowcompany=mysqli_fetch_array($resultcompany)){
        $theCompany["$rowcompany[id]"] = $rowcompany['name'];
    }

				
	$querybanks = "select * from banks";
    $resultbanks = mysqli_query($con, $querybanks);
    while($rowbanks=mysqli_fetch_array($resultbanks)){
        $theBank["$rowbanks[id]"] = $rowbanks['name'];
    }
				while($row=mysqli_fetch_array($result1)){
								
					$queryContract = "select * from bankingDebtContracts where id = '$row[contract]'";
					$resultContract = mysqli_query($con, $queryContract);
					$rowContract = mysqli_fetch_array($resultContract);
					
					if ( $row[ 'currency' ] == 1 ) {
        $thisCurrency = 'Córdobas';
		  $pre = 'C$';
      } elseif ( $row[ 'currency' ] == 2 ) {
        $thisCurrency = 'Dólares';
		  $pre = 'U$';
      }
			
								?>
                                
                                <tr role="row" class="odd">
                                <td class="sorting_1"><a href="bankingDebtView.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
								<td><?php echo date("d-m-Y", strtotime($row['today'])); ?></td>
                                <td><? echo $theCompany[$row['company']]; ?></td>
                                <td><? echo $theBank[$row['bank']]; ?></td>
                                <td><? echo $row['number']; $rowContract['title']; ?></td>
                                <td>Pago de interés</td>
								<td><?php echo date("d-m-Y", strtotime($row['date2'])); ?></td>
								<? /*<td><? echo $pre.str_replace('.00','',number_format($row['balance'],2)); ?></td>
								<td><? echo $pre.str_replace('.00','',number_format($row['interest'],2)); ?></td>*/ ?>
								<td>
									<a href="bankingDebtDocument.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Documentar</a>
                            	</td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
                                <div>
									<ul class="pagination pagination-lg">
									<?php if($previous != ""){ ?>
									<li><a href="javascript:reloadTable(0,<?php echo $previous; ?>,'<? echo $sql; ?>');"><i class="fa fa-angle-left"></i></a></li>
                  					<?php }
									if ($totpagina > 1){

  									for ($i=1;$i<=$totpagina;$i++){ 
										 if ($pagina == $i){
											echo '<li class="active"><a href="#">'.$i .'</a></li>';  
									}else{ ?>
		  							<li><a href="javascript:reloadTable(0,<?php echo $i; ?>,'');"><?php echo $i; ?></a></li>
									<? } } } if($next != ""){ ?>
										<li>
											<a href="javascript:reloadTable(0,<?php echo $next; ?>,'');">
											<i class="fa fa-angle-right"></i>
											</a>
										</li>
                  					<?php } ?>
									</ul>
									</div>
									
								</div>
                            
                                <?php } else { ?>
                                
                                <div class="note note-success">

						<p>

							NOTA: Sin pendientes de documentar.

						</p>

					</div>
                                <?php } ?>
                             
                               
						</div>

					</div>
						
						<? } ?>

					<!-- End: life time stats -->

				</div>

			</div>

			<!-- END PAGE CONTENT-->

		</div>
			
			

			<? if(($_SESSION['bankingDebt'] == 'active') or ($_SESSION['bankingDebtAccountant'] == 'active') or ($_SESSION['admin'] == 'active')){ 
            ?>
			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
 
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Prestamos activos (Pendientes de Contabilizar)
							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">


<?php 
                                                              
$today = date('Y-m-d'); 
$tampagina = 50;
if(isset($_GET['page'])) $pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$sqlu = "and bankingDebtContracts.company = 'never'";   
    
  
if(isset($_SESSION['bankingDebtAccountantCompanies'])){
    $aCompanies = array_filter($_SESSION['bankingDebtAccountantCompanies']);
}  

if((array_key_exists('999999999', $aCompanies)) or ($_SESSION['admin'] == 'active')){
    #doNothing
    $sqlu = '';
}else{
    $firstu = 1;
    $aCompaniesSize = sizeof($aCompanies);
    foreach($aCompanies as $key => $val) {
        if($firstu == 1){ //First
            $sqlu = " and ((bankingDebtContracts.company = '$key')"; if($aCompaniesSize == 1){ $sqlu .= ")"; } $firstu++;
        }elseif($firstu == $aCompaniesSize){ //Last
            $sqlu.= " or (bankingDebtContracts.company = '$key'))"; $firstu++;
        }else{ //Middle
            $sqlu.= " or (bankingDebtContracts.company = '$key')";$firstu++;
        }
    }  
}                               

$query = "select bankingDebt.*, bankingDebtContracts.company, bankingDebtContracts.bank, bankingDebtContracts.currency from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where (bankingDebt.status2 = '1' or bankingDebt.status2 = '1.10')$sqlu order by id desc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);
								
if(isset($_GET['echo']) and $_GET['echo'] == 1){
	echo $query;
}	

$query1 = "select bankingDebt.*, bankingDebtContracts.company, bankingDebtContracts.bank, bankingDebtContracts.currency from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where (bankingDebt.status2 = '1' or bankingDebt.status2 = '1.10')$sqlu order by id desc limit ".$inicio.",".$tampagina;  
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;							

if($numdev > 0){  ?>
                                <div id="dataTable1">
                               <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									
									<th width="1%">ID</th>
									<th width="8%">

										 Fecha</th>

									<th width="16%">

										 Compañía</th>

									<th width="16%">Banco</th>

									<th width="16%">

										No. Prestamo

									</th>

									<th width="16%">

										 Movimiento

									</th>
									<th width="5%">

										 Principal

									</th>
									<th width="5%">

										 Interes

									</th>

									<th width="8%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
									
                                <?php 
				
    $querycompany = "select * from companies";
    $resultcompany = mysqli_query($con, $querycompany);
    while($rowcompany=mysqli_fetch_array($resultcompany)){
        $theCompany["$rowcompany[id]"] = $rowcompany['name'];
    }

				
	$querybanks = "select * from banks";
    $resultbanks = mysqli_query($con, $querybanks);
    while($rowbanks=mysqli_fetch_array($resultbanks)){
        $theBank["$rowbanks[id]"] = $rowbanks['name'];
    }
				while($row=mysqli_fetch_array($result1)){
					
					if ( $row[ 'currency' ] == 1 ) {
        $thisCurrency = 'Córdobas';
		  $pre = 'C$';
      } elseif ( $row[ 'currency' ] == 2 ) {
        $thisCurrency = 'Dólares';
		  $pre = 'U$';
      }
					
					
						$queryContract = "select * from bankingDebtContracts where id = '$row[contract]'";
					$resultContract = mysqli_query($con, $queryContract);
					$rowContract = mysqli_fetch_array($resultContract);
								
			
								?> 
									
									 <? 
					
					$queryTransaction = "select * from bankingDebtTransactions where bankingDebt = '$row[id]' order by id desc limit 1";
					$resultTransaction = mysqli_query( $con, $queryTransaction );
					$numTransaction  = mysqli_num_rows($resultTransaction);
					$rowTransaction = mysqli_fetch_array( $resultTransaction );
					
					switch($rowTransaction['type']){
	  case 0:
	  	$ttype = 'Desembolso';
		  break;
	  case 1:
		  $ttype ='Abono';
		  break;
		case 2:
		  $ttype ='Pago de interés';
		  break;
		  case 3:
		  $ttype ='Cancelación';
		  break;
		   case 4:
		  $ttype ='Abono + Intereses';
		  break;
		   case 5:
		  $ttype ='Cancelación + Intereses';
		  break;
  } 

?>
                                
                                <tr role="row" class="odd">
								<td class="sorting_1"><a href="bankingDebtView.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
                                <td><?php echo date("d-m-Y", strtotime($row['today']));; ?></td>
								<td><? echo $theCompany[$row['company']]; ?></td>
                                <td><? echo $theBank[$row['bank']]; ?></td>
                                <td><? echo $row['number']; $rowContract['title']; ?></td>
                                <td><? echo $ttype; ?></td>
								<td><? echo $pre.str_replace('.00','',number_format($rowTransaction['amount'],2)); #if($rowTransaction['type'] == 0) echo $ow['']; ?></td>
								<td><? echo $pre.str_replace('.00','',number_format($rowTransaction['interest'],2)); ?></td>
								<td>
									<a href="bankingDebtRecord.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Contabilizar</a>
                            	</td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
                               <div>
									<ul class="pagination pagination-lg">
									<?php if($previous != ""){ ?>
									<li><a href="javascript:reloadTable(1,<?php echo $previous; ?>,'');"><i class="fa fa-angle-left"></i></a></li>
                  					<?php }
									if ($totpagina > 1){

  									for ($i=1;$i<=$totpagina;$i++){ 
										 if ($pagina == $i){
											echo '<li class="active"><a href="#">'.$i .'</a></li>';  
									}else{ ?>
		  							<li><a href="javascript:reloadTable(1,<?php echo $i; ?>,'');"><?php echo $i; ?></a></li>
									<? } } } if($next != ""){ ?>
										<li>
											<a href="javascript:reloadTable(1,<?php echo $next; ?>,'');">
											<i class="fa fa-angle-right"></i>
											</a>
										</li>
                  					<?php } ?>
									</ul>
									</div> 
								</div>
                            
                                <?php } else { ?>
                                
                                <div class="note note-success">

						<p>

							NOTA: No se encontró ningun prestamo activo.

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
			
			<? if(($_SESSION['bankingDebt'] == 'active') or ($_SESSION['admin'] == 'active')){ ?>
			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
 
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Prestamos activos (Contabilizados)
							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

<?php 

$today = date('Y-m-d'); 
$tampagina = 25;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$query = "select bankingDebt.*, bankingDebtContracts.company, bankingDebtContracts.bank, bankingDebtContracts.currency from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where bankingDebt.status2 = '2' order by id desc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);

if($_GET['echo'] == 1){
	echo $query;
}	
$query1 = "select bankingDebt.*, bankingDebtContracts.company, bankingDebtContracts.bank, bankingDebtContracts.currency from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where bankingDebt.status2 = '2' order by id desc limit ".$inicio.",".$tampagina;  
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;							

if($numdev > 0){  ?>
                                <div id="dataTable2">
                                	<table class="table table-striped table-bordered table-hover" id="datatable">

								<thead>

								<tr role="row" class="heading">

									

									<th width="1%">

										 ID</th>
									<th width="8%">

										 Fecha</th>

									<th width="16%">

										 Compañía</th>

									<th width="16%">Banco</th>

									<th width="16%">

										No. Prestamo

									</th>

									<th width="16%">

										 Movimiento

									</th>
									<th width="5%">

										 Principal

									</th>
									<th width="5%">

										 Interes

									</th>

									<th width="12%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
									
                                <?php 
				

				while($row=mysqli_fetch_array($result1)){
					
					$queryContract = "select * from bankingDebtContracts where id = '$row[contract]'";
					$resultContract = mysqli_query($con, $queryContract);
					$rowContract = mysqli_fetch_array($resultContract);
					
					if ( $row[ 'currency' ] == 1 ) {
        $thisCurrency = 'Córdobas';
		  $pre = 'C$';
      } elseif ( $row[ 'currency' ] == 2 ) {
        $thisCurrency = 'Dólares';
		  $pre = 'U$';
      }
                    
  $queryTransaction = "select * from bankingDebtTransactions where bankingDebt = '$row[id]' order by id desc limit 1";
					$resultTransaction = mysqli_query( $con, $queryTransaction );
					$numTransaction  = mysqli_num_rows($resultTransaction);
					$rowTransaction = mysqli_fetch_array( $resultTransaction );
					
	switch($rowTransaction['type']){
	  case 0:
	  	$ttype = 'Desembolso';
		  break;
	  case 1:
		  $ttype ='Abono';
		  break;
		case 2:
		  $ttype ='Pago de interés';
		  break;
		  case 3:
		  $ttype ='Cancelación';
		  break;
		   case 4:
		  $ttype ='Abono + Intereses';
		  break;
		   case 5:
		  $ttype ='Cancelación + Intereses';
		  break;
  } 
								
			
								?>
                                
                                <tr role="row" class="odd">
                                <td class="sorting_1"><a href="bankingDebtView.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
								<td><?php echo date("d-m-Y", strtotime($row['today']));; ?></td>
                                <td><? echo $theCompany[$row['company']]; ?></td>
                                <td><? echo $theBank[$row['bank']]; ?></td>
                                <td><? echo $row['number']; $rowContract['title']; ?></td>
                                <td><? echo $ttype; ?></td>
								<td><? echo $pre.str_replace('.00','',number_format($row['amount'],2)); ?></td>
								<td><? echo $pre.str_replace('.00','',number_format($row['interest'],2)); ?></td>
								<td>
									<a href="bankingDebtView.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            	</td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
									
									<div>
									<ul class="pagination pagination-lg">
									<?php if($previous != ""){ ?>
									<li><a href="javascript:reloadTable(2,<?php echo $previous; ?>,'');"><i class="fa fa-angle-left"></i></a></li>
                  					<?php }
									if ($totpagina > 1){

  									for ($i=1;$i<=$totpagina;$i++){ 
										 if ($pagina == $i){
											echo '<li class="active"><a href="#">'.$i .'</a></li>';  
									}else{ ?>
		  							<li><a href="javascript:reloadTable(2,<?php echo $i; ?>,'');"><?php echo $i; ?></a></li>
									<? } } } if($next != ""){ ?>
										<li>
											<a href="javascript:reloadTable(2,<?php echo $next; ?>,'');">
											<i class="fa fa-angle-right"></i>
											</a>
										</li>
                  					<?php } ?>
									</ul>
									</div>
									
                                </div>
								
                               
								
								
                            
                                <?php } else { ?>
                                <div class="note note-success">

						<p>

							NOTA: No se encontró ningun prestamo activo.

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
            
            <? if(($_SESSION['bankingDebt'] == 'active') or ($_SESSION['admin'] == 'active')){ ?>
			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
 
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Desembolsos anulados
							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

<?php 

$today = date('Y-m-d'); 
$tampagina = 50;
if(isset($_GET['page'])) $pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$query = "select bankingDebt.*, bankingDebtContracts.company, bankingDebtContracts.bank, bankingDebtContracts.currency from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where bankingDebt.status2 = '9' order by id desc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);

if(isset($_GET['echo']) and $_GET['echo'] == 1){
	echo $query;
}	
    
$query1 = "select bankingDebt.*, bankingDebtContracts.company, bankingDebtContracts.bank, bankingDebtContracts.currency from bankingDebt inner join bankingDebtContracts on bankingDebt.contract = bankingDebtContracts.id where bankingDebt.status2 = '9' order by id desc limit ".$inicio.",".$tampagina;  
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;							

if($numdev > 0){  ?>
                                
                                <div id="dataTable3">	
								<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="1%">

										 ID</th>
									<th width="8%">

										 Fecha</th>

									<th width="16%">

										 Compañía</th>

									<th width="16%">Banco</th>

									<th width="16%">

										No. Prestamo

									</th>

									<th width="16%">

										 Movimiento

									</th>
									<th width="5%">

										 Principal

									</th>
									<th width="5%">

										 Interes

									</th>

									<th width="12%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
									
                                <?php 
				

				while($row=mysqli_fetch_array($result1)){
					
					$queryContract = "select * from bankingDebtContracts where id = '$row[contract]'";
					$resultContract = mysqli_query($con, $queryContract);
					$rowContract = mysqli_fetch_array($resultContract);
					
					if ( $row[ 'currency' ] == 1 ) {
        $thisCurrency = 'Córdobas';
		  $pre = 'C$';
      } elseif ( $row[ 'currency' ] == 2 ) {
        $thisCurrency = 'Dólares';
		  $pre = 'U$';
      }
                    
  $queryTransaction = "select * from bankingDebtTransactions where bankingDebt = '$row[id]' order by id desc limit 1";
					$resultTransaction = mysqli_query( $con, $queryTransaction );
					$numTransaction  = mysqli_num_rows($resultTransaction);
					$rowTransaction = mysqli_fetch_array( $resultTransaction );
					
	switch($rowTransaction['type']){
	  case 0:
	  	$ttype = 'Desembolso';
		  break;
	  case 1:
		  $ttype ='Abono';
		  break;
		case 2:
		  $ttype ='Pago de interés';
		  break;
		  case 3:
		  $ttype ='Cancelación';
		  break;
		   case 4:
		  $ttype ='Abono + Intereses';
		  break;
		   case 5:
		  $ttype ='Cancelación + Intereses';
		  break;
  } 
								
			
								?>
                                
                                <tr role="row" class="odd danger">
                                <td class="sorting_1"><a href="bankingDebtView.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
								<td><?php echo date("d-m-Y", strtotime($row['today']));; ?></td>
                                <td><? echo $theCompany[$row['company']]; ?></td>
                                <td><? echo $theBank[$row['bank']]; ?></td>
                                <td><? echo $row['number']; $rowContract['title']; ?></td>
                                <td><? echo $ttype; ?></td>
								<td><? echo $pre.str_replace('.00','',number_format($row['amount'],2)); ?></td>
								<td><? echo $pre.str_replace('.00','',number_format($row['interest'],2)); ?></td>
								<td>
									<a href="bankingDebtView.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            	</td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
                                	<div>
									<ul class="pagination pagination-lg">
									<?php if($previous != ""){ ?>
									<li><a href="javascript:reloadTable(3,<?php echo $previous; ?>,'');"><i class="fa fa-angle-left"></i></a></li>
                  					<?php }
									if ($totpagina > 1){

  									for ($i=1;$i<=$totpagina;$i++){ 
										 if ($pagina == $i){
											echo '<li class="active"><a href="#">'.$i .'</a></li>';  
									}else{ ?>
		  							<li><a href="javascript:reloadTable(3,<?php echo $i; ?>,'');"><?php echo $i; ?></a></li>
									<? } } } if($next != ""){ ?>
										<li>
											<a href="javascript:reloadTable(3,<?php echo $next; ?>,'');">
											<i class="fa fa-angle-right"></i>
											</a>
										</li>
                  					<?php } ?>
									</ul>
									</div>
								</div>	
                            
                                <?php } else { ?>
                                
                                <div class="note note-success">

						<p>

							NOTA: No se encontró ningun prestamo activo.

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
    
function openCalculator(){
    window.open("bankingDebtCalculator.php", "", "width=250,height=375");
}

function _(el){
	return document.getElementById(el);
}
	
function reloadTable(table,i,sql){
	if(table == 2){
	$.post("bankingDebtPagination.php", { table: table, i: i, sql: sql }, function(data){ 
		_("dataTable"+table).innerHTML = data;  
	});	
	}else{
		alert('En mantenimiento.');
	}
}
			
</script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>