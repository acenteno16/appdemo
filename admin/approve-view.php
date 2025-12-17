<?php 

include("session-approve.php"); 
require('fn-relative.php');
require('functions.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$idPayment = $id;
$atype = $_GET['atype'];

if(fnRelative($idPayment) == true){
	#doNothing
}
else{
	?> 
    <script>
	window.alert('Usted no tiene permisos para realizar esta operación. (NON RELATIVE PAYMENT ERR)');
	window.location = 'approve.php';
	</script>
	<?php 
	exit();
} 

$query = $con->prepare("select * from payments where id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$num = $result->num_rows;
$row = mysqli_fetch_array($result);

$querycurrency = "select * from currency where id = '$row[currency]'";
$resultcurrency = mysqli_query($con, $querycurrency);
$rowcurrency = mysqli_fetch_array($resultcurrency);

if(($_SESSION['approve1'] != 'active') and ($atype == 1)){
	?>
    <script>
	alert('Usted no tiene permisos para realizar esta operación');
	window.location = 'approve.php';
	</script>
    <?php }
if(($_SESSION['approve2'] != 'active') and ($atype == 2)){
	?>
    <script>
	alert('Usted no tiene permisos para realizar esta operaci\u00f3n');
	window.location = 'approve.php';
	</script>
    <?php }
if(($_SESSION['approve3'] != 'active') and ($atype == 3)){
	?>
    <script>
	alert('Usted no tiene permisos para realizar esta operaci\u00f3n.');
	window.location = 'approve.php';
	</script>
    <?php }
//
if($row['approved'] == 1){
	?>
    <script>
	alert('Este pago ya fue aprobado.');
	window.location = 'approve.php';
	</script>
    <?php }
if($row['approved'] == 2){
	?>
    <script>
	alert('Este pago ya fue rechazado.');
	window.location = 'approve.php';
	</script>
    <?php }

$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
$rowtype = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[type]'"));
$rowconcept = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept]'"));
$rowconcept2 = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept2]'"));
$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
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

<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/clockface/css/clockface.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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

			<div class="row"> 

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Solicitudes <small>Aprobar Solicitudes</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						
                        <li>
							<a href="approve.php"> <i class="fa fa-check-circle-o"></i> Aprobado de Solicitudes</a>
							<i class="fa fa-angle-right"></i>
                        </li>
						<li>
                        	<i class="fa fa-search"></i> Visor
                        </li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">
                
                   <?php /*<div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

										

										</div>

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="tc-add-code.php" class="horizontal-form" method="post" enctype="multipart/form-data">

											<div class="form-body">

												<h3 class="form-section">Ingresar tipo de cambio</h3>

												<div class="row"><!--/span-->

												  <div class="col-md-6 ">
													  <div class="form-group">
														<label>Fecha:</label>
                                                        <input name="today" type="text" class="form-control form-control-inline date-picker" id="schedule[]" value="">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> <div class="col-md-6 ">
													  <div class="form-group">
														<label>TC:</label>
                                                        <input name="tc" type="text" class="form-control" id="tc" value="" onkeypress="return justNumbers(event);">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 

													<!--/span-->

												</div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

											<!--/row--><!--/row--></div>


											<div class="form-actions right">


												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar</button>

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div><br>*/ ?>
                                
                	<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						Información de la solicitud

							</div>
                            <div class="actions">

								<a href="approve-view-advanced.php?id=<?php echo $idPayment; ?>" class="btn default blue-stripe">

								

								<span class="hidden-480">

								Vista avanzada</span>

								</a>

								                                
                                

							</div>

						</div>

						

					</div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <?php ///// table ?>
                         	<div class="tab-pane" id="tab_1">
<div class="row"><!--/span-->


													<div class="col-md-12">
                           <?php $queryprovider = "select * from providers where code = '$rowbills[provider]'";
	$resultprovider = mysqli_query($con, $queryprovider);
	$rowprovider = mysqli_fetch_array($resultprovider);
	$provider = $rowprovider['name'];
	
	$queryuser = "select * from workers where code = '$row[userid]'";
											$resultuser = mysqli_query($con, $queryuser);
											$rowuser = mysqli_fetch_array($resultuser);
											$queryunit = "select * from units where code = '$rowuser[unit]'";
											$resultunit = mysqli_query($con, $queryunit);
											$rowunit = mysqli_fetch_array($resultunit);
											?>
    
<div class="col-md-4">

													 <h3>Información del solicitante</h3>
                                                      <p><strong>Nombre:</strong> <?php echo $rowuser['first']." ".$rowuser['last']; ?><br>
                                                      <strong>Código:</strong> <?php echo $rowuser['code']; ?><br>
                                                      <strong>Unidad de Negocio:</strong> <?php echo $rowuser['unit']; ?> | <?php echo $rowunit['name']; ?>
</p>

													</div>
<? if($row['parent'] == 0){ ?>
<div class="col-md-4">

<?php if($row['btype'] == 1){
	$beneficiarytype = "Proveedor";
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
	$beneficiaryname = $rowprovider['name'];
	$beneficiarycode = $rowprovider['code'];
	
}elseif($row['btype'] == 2){
	$beneficiarytype = "Colaborador";
	$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
	$beneficiaryname = $rowcollaborator['first'].' '.$rowcollaborator['last'];
	$beneficiarycode = $rowcollaborator['code'];
}elseif($row['btype'] == 4){
	$beneficiarytype = "Cliente";
	$rowclient = mysqli_fetch_array(mysqli_query($con, "select * from clients where code = '$row[client]'"));
	$providercode = $rowclient['code']; 
	if($rowclient['type'] == 1){
		$beneficiaryname  = $rowclient['first'].' '.$rowclient['last'];
	}else{
		$beneficiaryname  = $rowclient['name'];
	}
	$beneficiarycode = $rowclient['code'];
}

?>
<h3> Información del <?php echo $beneficiarytype; ?></h3>
<p><strong>Nombre:</strong> <?php echo $beneficiaryname; ?><br>
<strong>Código:</strong> <?php echo $beneficiarycode; ?><br>                                                 
</p>
</div>
<? }else{ ?>
<div class="col-md-4"></div>
<? } ?>                                                    
<div class="col-md-4">

<h3>Total pagar</h3>

					<div class="dashboard-stat blue">

						<div class="visual">

							
						</div>

						<div class="details">

							<div class="number">
  							<?php 
							if($row['globalpayment'] > 0){
								$topay = $row['globalpayment'];
							}else{
								$topay = $row['payment'];
							}
							echo $rowcurrency['symbol'].str_replace('.00','',number_format($topay,2)); ?>	
  							</div>

							<div class="desc"><?php echo $rowcurrency['name']; ?></div>

						</div>

					

					</div>
                    

				</div>
                                       
<div class="row"></div>														
<div class="col-md-12"><p>
	<? if($row['hc'] == 1){ 
	$queryHC = "select * from hc where payment = '$id'";
	$resultHC = mysqli_query($con, $queryHC);
	$rowHC = mysqli_fetch_array($resultHC);	
	
	
		switch($rowHC['hctype']){
			case 1:
				$hcstype = 'Ayudas economicas';
					break;
			case 2:
				$hcstype = 'Embargo judicial';
			break;
				case 3:
				$hcstype = 'Pensión alimenticia';
			break;
				case 4:
				$hcstype = 'IR Laboral';
			break;
				case 5:
				$hcstype = 'INSS Labora/Patronal';
			break;
				case 7:
				$hcstype = 'INATEC';
			break;
				case 8:
				$hcstype = 'Comisiones';
			break;
				case 9:
				$hcstype = 'Horas extras';
			break;
				case 10:
				$hcstype = 'Bonos';
			break;
				case 11:
				$hcstype = 'Vacaciones';
			break;
				case 12:
				$hcstype = 'Aguinaldo';
			break;
				case 13:
				$hcstype = 'Prestamos';
			break;
				case 14:
				$hcstype = 'Liquidación de colaboradores';
			break;
				case 15:
				$hcstype = 'Salarios';
			break;
		}
		
		?>
	
	<strong>Tipo de pago:</strong> Capital Humano (<? echo $hcstype; ?>)<br><? } ?><strong>Descripción:</strong> <?php echo $row['description']; ?><br>
<strong>Comentarios del solicitante:</strong> <?php  echo $row['notes']; if($row['notes'] == '') echo 'Ninguno'; ?></p></div>
<? 
														
if($row['type'] == 4){ 
  $query_refund = "select * from clientsrefund where payment = '$row[id]'";
											$result_refund = mysqli_query($con, $query_refund);
											$row_refund = mysqli_fetch_array($result_refund);
											
											switch($row_refund['devtype']){
												case 1:
												$refund_type = "Primas";
												break;
												case 2:
												$refund_type = "Reservas";
												break;
												case 3:
												$refund_type = "Excedentes";
												break;
												case 4:
												$refund_type = "Seguros";
												break;
												case 5:
												$refund_type = "Productos";
												break;
											}
											
											
											?>
 <div class="col-md-12">
    
    <h3>Detalles de la devolución: </h3>
     <div class="row">
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>Tipo:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $refund_type;
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          
                                           <? if($row_refund['rsvp'] != "0000-00-00"){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>Fecha de Reservación:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo date("d-m-Y", strtotime($row_refund['rsvp']));
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                          <? if($row_refund['report'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>Informe de Negociación:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['report'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                           <? if($row_refund['brand'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>Marca:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['brand'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                          <? if($row_refund['model'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>Modelo:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['model'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                          
                                          <? if($row_refund['part_number'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de Parte:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['part_number'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                          <? if($row_refund['policy'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de Póliza:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['policy'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                          <? if($row_refund['claim'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de Reclamo:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['claim'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                          <? if($row_refund['plate'] != ""){ ?>
                                          <div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de Placa:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? echo $row_refund['plate'];
														
														?>" readonly >

                                                      <!--/row--></div>
													</div>
                                          <? } ?>
                                           
                                        </div>
      <? 
	$query_rocs = "select * from clientsdocuments where payment = '$row[id]'";
	$result_rocs = mysqli_query($con, $query_rocs);
	$num_rocs = mysqli_num_rows($result_rocs);
	if($num_rocs > 0){
  ?>  
	<div class="row">
	<div class="col-md-12 ">
	<div class="form-group">
	<label style="font-size: 18px;">Recibo(s) de Caja / Factura(s):</label>
	</div>
	</div>
	<? while($row_rocs=mysqli_fetch_array($result_rocs)){ ?>
	<div class="row"></div>
		
		<div class="col-md-2 ">
		<div class="form-group">
		<label>Tipo:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? switch($row_rocs['type']){ case 1: echo "ROC"; break; case 2: echo "Factura"; break; } ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-2 ">
		<div class="form-group">
		<label>Número:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $row_rocs['number']; ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-2 ">
		<div class="form-group">
		<label>Fecha:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo date('d-m-Y', strtotime($row_rocs['today'])); ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-2 ">
		<div class="form-group">
		<label>Monto:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo number_format($row_rocs['amount'],2); ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-2 ">
		<div class="form-group">
		<label>Moneda:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? switch($row_rocs['currency']){ case 1: echo "Córdobas"; break; case 2: echo "Dólares"; break; } ?>"  readonly >                                                        
		</div> 
		</div>
		
		
	<? } //End While ?>
	</div>
 <? } //End Recibos de Caja / Facturas ?>
                                                                                       
         <? 

	if(($row_refund['cardholder'] != "") or ($row_refund['bank'] > 0) or ($row_refund['account'] != "")){
	
	$query_bankrefund = "select name from banks where id = '$row_refund[bank]'";
	$result_bankrefund = mysqli_query($con, $query_bankrefund);
	$row_bankrefund = mysqli_fetch_array($result_bankrefund);
	$bank_refund = $row_bankrefund['name'];
	
  ?>  
	<div class="row">
	<div class="col-md-12 ">
	<div class="form-group">
	<label style="font-size: 18px;">En caso de Tarjetas:</label>
	</div>
	</div>
	
	<div class="row"></div>
		
		<div class="col-md-4 ">
		<div class="form-group">
		<label>Nombre Titular:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $row_refund['cardholder']; ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-3 ">
		<div class="form-group">
		<label>Banco:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $bank_refund; ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-3 ">
		<div class="form-group">
		<label># CTA/Tarjeta:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $row_refund['account']; ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-2 ">
		<div class="form-group">
		<label>Vencimiento:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $row_refund['expiration']; ?>"  readonly >                                                        
		</div>
		</div>
		
	
	</div>
 <? } //End Tarjetas ?>
                                          
                                          <? if($row_refund['seller'] != ""){ ?>
                                          <div class="row">
	<div class="col-md-12 ">
	<div class="form-group">
	<label style="font-size: 18px;">Información del Vendedor:</label>
	<? 
	
	$queryseller = "select * from workers where code = '$row_refund[seller]'";
	$resultseller = mysqli_query($con, $queryseller);
	$rowseller = mysqli_fetch_array($resultseller);
	
	?>
	</div>
	</div>
	
	<div class="row"></div>
		
		<div class="col-md-3 ">
		<div class="form-group">
		<label>Nombre:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $rowseller['first']; ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-3 ">
		<div class="form-group">
		<label>Apellido:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $rowseller['last']; ?>"  readonly >                                                        
		</div>
		</div>
		<div class="col-md-3 ">
		<div class="form-group">
		<label>Email:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $rowseller['email']; ?>"  readonly >                                                         
		</div>
		</div>
		<div class="col-md-3 "> 
		<div class="form-group">
		<label>Telefono:</label>
		<input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $row_refund['seller_phone']; ?>"  readonly >                                                        
		</div>
		</div>
		
	
	</div>
                                          <? } ?>                                               
                                                   
</div>                                      
       <? } ?>                                                       
<div class="col-md-12">
    <? 
	
	if($row['parent'] == 0){ 
	
		if($row['hc'] == 0){
	?> 
    <h3>Lista de Documentos</h3>
    
 	<div class="table-container">
                                
                                	<div class="table-scrollable"><table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="12%">Número de Documento</th>
                                         <th width="13%">Sub-total<br>
(que graba IVA):</th>
                                         <th width="13%">Sub-total<br>
(exento de IVA):</th>
                                         <th width="12%">Monto<br>
Alojamiento:</th>
                                         <th width="12%">Monto<br>
Intur:</th>
                                         <th width="12%">IVA:</th>
                                         <th width="12%">Total</th>

									<th width="12%">Exento</th>
                                    <th width="12%">TC</th>

									
                                     
                                  </tr>

								</thead>

								<tbody>

                                <?php $querybills = "select * from bills where payment = '$_GET[id]'";
$resultbills = mysqli_query($con, $querybills);
$sumtotd = 0;
while($rowbills=mysqli_fetch_array($resultbills)){
	
$querycurrency = "select * from currency where id = '$rowbills[currency]'";
$resultcurrency = mysqli_query($con, $querycurrency);
$rowcurrency = mysqli_fetch_array($resultcurrency);

?>

								
								
                                <tr role="row" class="odd">
                                  <td class="sorting_1"><?php echo $rowbills["number"]; ?></td><td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['stotal'],2)); echo ' '.$rowcurrency['name']; ?></td>
                                  <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['stotal2'], 2))." ".$rowcurrency['name']; ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['intur'],2))." ".$rowcurrency['name']; ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['inturammount'], 2))." ".$rowcurrency['name']; ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['tax'],2))." ".$rowcurrency['name']; ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['ammount'],2))." ".$rowcurrency['name'];  ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['exempt'],2))." ".$rowcurrency['name']; ?>
                                   
                                  </td>
                                  <td><?php if($rowbills['currency'] == 2){ echo $rowcurrency['symbol'].str_replace('.00','',$rowbills['tc']);
								  }else{
									  echo "N/A";
								  } ?>
                                   
                                  </td>
                                  
                                  </tr>
                                
                                
                                
                                
                                
                                
                                <?php  
								
								$sumtotd+=$rowbills['ammount'];
								} //while ?>
                                </tbody>

								</table>
                                </div></div>
    <p><strong>Total:</strong> <?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($sumtotd,2)).' '.$rowcurrency['name']; ?> </p>
    
    <?php
		}
	if($row['distributable'] == 1){
$querydistribution = "select * from distribution where payment = '$_GET[id]' and preturn = '$row[preturn]'"; 
$resultdistribution = mysqli_query($con, $querydistribution);
$numdistribution = mysqli_num_rows($resultdistribution);      

?>
<h3>Distribución</h3>
<div class="row">
<div class="col-md-6 ">                                                   <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="33%">

										Unidad</th>

									<?php /*<th width="12%">

										Cuenta</th>*/ ?>

									<th width="33%">

										 Porcentaje</th>
<th width="33%">

										 Total</th>
				

								  </tr>

								</thead>

								<tbody>
                            <?php while($rowdistribution=mysqli_fetch_array($resultdistribution)){
								?>                               
                                <tr role="row" class="odd">
                                <td><?php echo $rowdistribution['unit']; ?></td>
                                 <?php /*<td><?php echo $rowdistribution['account']; ?></td>*/ ?>
                               <td><?php echo str_replace('.00','',$rowdistribution['percent']).'%'; ?></td>
                                <td><?php
								echo number_format($rowdistribution['total'], 2); ?></td>
                                </tr> 
                                <?php } ?>
                                </tbody></table>
                                </div>
</div>
                                <div class="row">&nbsp;</div>
<?php } else { ?>
	<p><strong>Distribuido 100% a la UN:</strong> <?php echo getUnit($row['routeid'],$row['ncatalog'],'All'); ?> </p>
	<?php } ?>
                                
    <?php if($row['acp'] == 1){ ?>
    <div class="row">
                                <div class="col-md-6">
                               <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="12%">% Alcaldía</th>
                                         <th width="13%">Monto Alcaldía</th>
                                         <th width="13%">% IR</th>
                                         <th width="12%">Monto IR:</th>
                                   

									
                                     
                                  </tr>

								</thead>

								<tbody>

                                <tr role="row" class="odd">
                                  <td class="sorting_1"><?php echo $row['ret1']; ?></td>
                                  <td><?php echo str_replace('.00','',number_format($row['ret1a'],2)); ?></td>
                                  <td><?php echo $row['ret2']; ?></td>
                                  <td><?php echo str_replace('.00','',number_format($row['ret2a'],2)); ?></td> 
                                  </tr>
                                  
                                
                         
                                </tbody>

								</table>
                                </div> 
                                <div class="col-md-6">
                                <div class="note note-danger">
                                <strong>Nota:</strong> Retenciones asumidas por Grupo Casa Pellas.
                                </div>
                                </div>
    </div>
    <?php } ?>
                               <? } ?>
	
	<? #start HC
	if(($row['hc'] == 1) and ($row['parent'] == 3)){ 
	?>
	<div class="row">
     <div class="col-md-12 table-container">
<div class="table-scrollable" id="templatewaiter" name="templatewaiter">
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

	<thead>

	<tr role="row" class="heading">
   
    <th width="2%">IDS+</th>
    <? 
	$page_name = str_replace('/admin/','',$_SERVER["PHP_SELF"]);
	if(($page_name == 'provision-view-cascade.php') or ($page_name == 'releasing-view.php') or ($page_name == 'provision-view-covid-cascade.php')){ ?>
    <th width="20%">Batch</th>
    <th width="20%">Documento</th>
    <? } ?>
    <th width="34%">Proveedor</th>
	<th width="34%">Colaborador</th>
    <th width="50%">Monto<span style="color: #EEEEEE;">------------------</span></th>
	<th width="34%">Opciones</th>
	</tr>

	</thead>

	<tbody>

<?php  
	if($row['child'] > 0){
		$query_parentchilds = "select * from payments where approved != '9' and (id = '$row[child]' or child = '$row[child]') order by id asc";
	}						
	else{
		$query_parentchilds = "select * from payments where approved != '9' and (id = '$_GET[id]' or child = '$_GET[id]') order by id asc";
	}	
	$result_parentchilds = mysqli_query($con, $query_parentchilds);
	$parentchilds_approved = "";
	while($row_parentchilds=mysqli_fetch_array($result_parentchilds)){
	
		$parentchilds_approved = "";
		if($row_parentchilds['approved'] == 2){
			$parentchilds_approved = " <div class='btn red'>Rechazado</div>"; 
		}
	
		//Proveedor
		$row_benprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row_parentchilds[provider]'"));
		$benNameProvider = $row_benprovider['code'].' | '.$row_benprovider['name'];	
		
		//Collaborator
		$row_bencollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row_parentchilds[collaborator]'"));
		$ben_name = $row_bencollaborator['code'].' | '.$row_bencollaborator['first'].' '.$row_bencollaborator['last'];	
	
	//Currency
	$querycurrency = "select * from currency where id = '$row_parentchilds[currency]'"; 
	$resultcurrency = mysqli_query($con, $querycurrency);
	$rowcurrency =mysqli_fetch_array($resultcurrency);
	$ben_currency = $rowcurrency['pre'].' '.$rowcurrency['symbol'];
	
	//Amount
	$ben_ammount = $row_parentchilds['payment'];
	
	$class_parentchild = "";
	if($idPayment == $row_parentchilds['id']){
		$class_parentchild = "success";
	}
?>							

	<tr role="row" class="odd">
                                
    <td class="sorting_1"><?
        $child_str = "";
        if($row_parentchilds['parent'] > 0){
            $child_str = "+";
        }
	echo ''.$row_parentchilds['id'].' <input type="hidden" name="tableid[]" id="tableid[]" value="'.$row_parentchilds['id'].'">';
	?></td> 
   <? 
	$page_name = str_replace('/admin/','',$_SERVER["PHP_SELF"]);
	if(($page_name == 'provision-view-cascade.php') or ($page_name == 'provision-view-covid-cascade.php') or ($page_name == 'releasing-view.php')){ 
	
	
	$querybatch = "select * from batch where payment = '$row_parentchilds[id]'";
	$resultbatch = mysqli_query($con, $querybatch);
	$thedocument = "";
	while($rowbatch = mysqli_fetch_array($resultbatch)){
	 $thebatch = $rowbatch['nobatch'];
	 $thedocument.= $rowbatch['nodocument'].',';
	}
	
	$thedocument = substr($thedocument,0,-1)
	?>
	<td><input type="text" name="batch[]" id="batch[]" <? if($page_name == 'releasing-view.php'){ 
	 
	echo 'value="'.$thebatch.'"';
	echo ' disabled';
	} ?>></td>
	<td><input type="text" name="document[]" id="document[]" <? if($page_name == 'releasing-view.php'){ 
	 
	echo 'value="'.$thedocument.'"';
	echo ' disabled';
	} ?>></td>
    <? } ?>	
	<td><? echo $benNameProvider; ?></td>	
    <td><? echo $ben_name.$parentchilds_approved; ?></td>
    <td><? echo $ben_currency.number_format($ben_ammount,2); ?></td> 
    <td> <button type="button" class="btn red" onClick="rejectThis(<? echo $row_parentchilds['id']; ?>);"><i class="fa fa-times"></i> Rechazar</button> </td>
    </tr>
                                                            
<?php 

} ?>  
                                
	</tbody> 

	</table>
											</div>
											</div>
	</div>
	<script>
	function rejectThis(id){
		var reason = prompt('Favor seleccione el motivo de rechazo', '');
		window.location = 'paymentChildRejection.php?id='+id+'&reason='+reason; 
	}
	</script>
	<? } #end HC?>
                                <div class="row">
                                <div class="col-md-12">
                                             <h3 class="form-section">Opciones</h3>  
                                         									


										
			
         							    
                          <form action="approve-view-code.php" class="horizontal-form" method="get" enctype="multipart/form-data" onsubmit="return validateForm();" id="myform">
                           <div class="col-md-12 " style="display:none;" id="cdiv">
													  <div class="form-group">
														<label class="control-label">Razón:</label>

													  <select name="reason2" class="form-control" id="reason2">
<option value="0">Otro</option>
<?php $queryreason = "select * from reason";
$resultreason = mysqli_query($con, $queryreason);
while($rowreason=mysqli_fetch_array($resultreason)){
?>
<option value="<?php echo $rowreason['id']; ?>"><?php echo $rowreason['name']; ?></option>
<?php } ?>

													  </select><br>
<br>
<label>Comentarios:</label>
                                                        <textarea name="reason" rows="2" class="form-control" id="reason" placeholder="Comente por que no aprueba esta solicitud de pago."></textarea>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                        
                                                      <!--/row--></div>
													</div>                          
                                                    
  <div class="row"><div class="col-md-12">
 
  <div class="form-actions right" style="margin-left:0px;">

									 <button type="button" class="btn blue" onClick="goApprove();"><i class="fa fa-undo"></i> Retornar</button> 
                            <script>
							function goApprove(){
								window.location = "approve.php";
							}
							</script>			

						    <span id="dapprove"> <button type="button" class="btn blue" onClick="divShow(0);"><i class="fa fa-check"></i> Aprobar</button>  </span>
                            
                           <span id="cancelreject" style="display:none;"> <button type="button" class="btn blue" onClick="divShow(2);"><i class="fa fa-times"></i> Cancelar reprobar</button> </span>
                            
                           <button type="button" class="btn red" onClick="divShow(1);"><i class="fa fa-times"></i> Rechazar</button> 
						   <input name="id[]" type="hidden" id="id[]" value="<?php echo $idPayment; ?>">
						   <? if($row['parent'] > 0){ 
								$query_payments = "select id from payments where child = '$row[id]'";
								$result_payments = mysqli_query($con, $query_payments);
								while($row_payments=mysqli_fetch_array($result_payments)){
							?> 
                                   <input name="id[]" type="hidden" id="id[]" value="<?php echo $row_payments['id']; ?>">
                            <? } } ?>
                                                <input name="atype[]" type="hidden" id="atype[]" value="<?php echo $atype; ?>">
                                                <span class="form-actions right" style="margin-left:0px;">
                                                <input name="approve" type="hidden" id="approve" value="0"> 
                                                </span> 
  </div>
                                       </div></div>
                                       </form>
                                
                                       
                                       </div>
                                                                                          </div>
                                <div class="row"> 
                                <div class="col-md-12">     
                                       
                            <br>
<br>

<?php //desde aqui 

include_once('sessions.php');
$queryFiles = "select * from files where payment = '$_GET[id]'"; 
$resultFiles = mysqli_query($con, $queryFiles);
$numFiles = mysqli_num_rows($resultFiles);
if($numFiles > 0){
?>
<? /*<script src="pdf-master/pdfobject.js"></script>*/ ?>
<h3>Lista de archivos del pago <?php echo $paymentid; ?> | <? echo $numFiles; ?> Archivo(s)</h3> 
<?php
$i = 0;	
while($rowFiles = mysqli_fetch_array($resultFiles)){
	$paymentid = $rowFiles['payment']; 

?>

<p>
<?php //start while 

$url = cleanLink($rowFiles['link']);

$queryofile = "select * from filebox where url = '$url'";
$resultofile = mysqli_query($con, $queryofile);
$rowofile = mysqli_fetch_array($resultofile);
 
echo '<strong>'.ucfirst($rowofile['title']).'</strong>';
$fileArr2  = explode('=', $rowFiles['link']); 

?>

</p>
<object data="efile.php?key=<? echo $fileArr2[1]; ?>" type="application/pdf" width="95%" height="700px" style="border: 10px solid #21355d;"></object>
    
                                  
<? $i++; ?>                         
                       
                     
                                       
                                       
                                       <?php } } ?>  
                                       
                                       
                                         
                                      
                      


                                       </div> 
                                </div>
                                
                                
                                
                                <? 
								
								if($row['parent'] == 1){
									#echo 'Interns';
									include('stage-intern.php'); 
								}elseif($row['parent'] == 2){
									#echo 'Collaborator';
								 	include('stage-collaborators.php');
								} 
								 
								 ?>
                                <div></div>
								
							</div>
                    

</div></div>

</div>


					<?php //table } ?>		



					</div>

				</div>

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


<!-- BEGIN CORE PLUGINS -->

<script>

jQuery(document).ready(function() {    

   Metronic.init(); // init metronic core components

Layout.init(); // init current layout

QuickSidebar.init() // init quick sidebar



});


  
function divShow(dapprove){
			 
		   	if(dapprove == 0){
				document.getElementById('approve').value = '1';
				document.forms["myform"].submit();
		   }
		   
		   if(dapprove == 1){
			   if(document.getElementById("cdiv").style.display == 'block'){
				   document.getElementById('approve').value = '2';
				   if(validateForm()){
					   
					   document.forms["myform"].submit();
				   }
				   
			   }else{
			   document.getElementById("cdiv").style.display = 'block';
			   document.getElementById("cancelreject").style.display = 'block';
			   document.getElementById("dapprove").style.display = 'none';
			   }
			   
			   
		   }
		   
		   if(dapprove == 2){
			   document.getElementById("cdiv").style.display = 'none';
			   document.getElementById("cancelreject").style.display = 'none';		document.getElementById("dapprove").style.display = 'block';
			   
		   }
		   	
		   
}


function validateForm(){
	
	var reason = document.getElementById("reason").value;
	var reason2 = document.getElementById("reason2").value;
	
	if((reason2 == '0') && (reason == '')){
		alert('Cuando rechaza una solicitud de pago con la opcion "Otro" debe de justificar con comentarios.');
		return false;
	}
		
	 
		else{
			return true;
		}
		
		
}
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html> 
<?php

function cleanLink($dirtyurl){ 

	$levels = explode('/', $dirtyurl);
	$levelsize = sizeof($levels);
	$levelsize = $levelsize-1;
	$cleanurl = $levels[$levelsize];
	$cleanurl = str_replace('visor.php?key=','',$cleanurl);
	
	return $cleanurl;
}

?>