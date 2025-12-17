<?php 

include("session-frequest.php");  

if(!$_GET['id']){
	$id = 0;
}else{
	$id = $_GET['id'];
}

$queryFunds = "select * from funds where id = '$id'";
$resultFunds = mysqli_query($con, $queryFunds);
$rowFunds = mysqli_fetch_array($resultFunds);

if($rowFunds['status'] == 0){
	//header('location: dashboard.php');
	echo "<script> window.location='funds-confirmation.php';</script>";
	exit();
} 

$queryclient = "select * from clients where code = '$rowFunds[client]'";
$resultclient = mysqli_query($con, $queryclient);
$rowclient = mysqli_fetch_array($resultclient);

$queryuser = "select * from workers where code = '$rowFunds[userid]'"; 
$resultuser = mysqli_query($con, $queryuser);
$rowuser = mysqli_fetch_array($resultuser);
	
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


<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

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

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Fondos <small>Solicitud de confirmación de fondos</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="funds-confirmation-approve.php">Aprobación de cofirmacion de fondos</a>
                             <i class="fa fa-angle-right"></i>
                             </li>

						<li>

							<a href="#">Solicitudes de confirmación de fondos</a>

						</li>

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">

					<div class="tabbable tabbable-custom boxless tabbable-reversed">

							<div class="tab-pane" id="tab_1">

								<div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

										

										</div>

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form name="porder" id="porder" action="funds-confirmation-approve-view-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        

											<div class="form-body">
												
												<h3 class="form-section">Información del Solicitante</h3>
<div class="row"><!--/span-->
<div class="col-md-12">
<p><strong>Nombre:</strong> <?php echo $rowuser['first']." ".$rowuser['last']; ?><br>
<strong>Código:</strong> <?php echo $rowuser['code']; ?><br>
<strong>Email:</strong> <?php echo $rowuser['email']; ?> <br>
</p>
</div>
</div>
												
												

												<h3 class="form-section">Información General</h3> 
                                                <div class="row">
                                                <!--/span-->

													<div class="col-md-2">

													  <div class="form-group">

	<label class="control-label">ID de Pago:</label>
										
											  <input name="id" type="text" class="form-control" id="id" value="<?php if($id > 0) echo $rowFunds['id']; else echo 'AUTO'; ?>" readonly>  
								
															<div title="Page 5">
															  <div>
															    <div></div>
														      </div>
													    </div>
													  </div>

													</div> 
                                                    
                                                   
                                                    
                                                    

													<!--/span-->

												</div>
												
												<h3  class="form-section">Información del Cliente</h3> 

                                                  
                                                  <div id="client-stage">

                                                  <div class="row">
                                                  
													  
<div class="row"></div>   
<? if($rowclient['type'] == 1){ ?>													  
<div id="ct_personal">
<div class="col-md-2">
<div class="form-group">
<label class="control-label">Tipo de cliente</label>
<input name="amount" type="text" class="form-control" id="amount" value="<? if($rowclient['type'] == 1) echo "Persona Natural"; elseif($rowclient['type'] == 2) echo "Persona Jurídica"; ?>" readonly>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Código:</label>
<input name="ccode" type="text" class="form-control" id="ccode" value="<? echo $rowclient['code']; ?>" readonly>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Nombres:</label>
<input name="cfirst" type="text" class="form-control" id="cfirst" value="<? echo $rowclient['first']; ?>" readonly > 
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Apellidos:</label>
<input name="clast" type="text" class="form-control" id="clast" value="<? echo $rowclient['last']; ?>" readonly > 
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label>Dirección:</label>
<input name="caddress" type="text" class="form-control" id="caddress" value="<? echo $rowclient['address']; ?>" readonly > 
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Ciudad:</label>
<input name="ccity" type="text" class="form-control" id="ccity" value="<? echo $rowclient['city']; ?>" readonly > 
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Cédula:</label>
<input name="cnid" type="text" class="form-control" id="cnid" value="<? echo $rowclient['nid']; ?>" readonly > 
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Email:</label>
<input name="cemail" type="text" class="form-control" id="cemail" value="<? echo $rowclient['email']; ?>" readonly > 
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Teléfono:</label>
<input name="cphone" type="text" class="form-control" id="cphone" value="<? echo $rowclient['phone']; ?>" readonly > 
</div>
</div>
</div>
<? } ?>	
<? if($rowclient['type'] == 2){ ?>														  
<div id="ct_business">
<div class="col-md-2">
<div class="form-group">
<label class="control-label">Tipo de cliente</label>
<input name="amount" type="text" class="form-control" id="amount" value="<? if($rowclient['type'] == 1) echo "Persona Natural"; elseif($rowclient['type'] == 2) echo "Persona Jurídica"; ?>" onkeypress="return justNumbers(event);" readonly>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Código:</label>
<div class="input-group">
<input name="ccode2" type="text" class="form-control" id="ccode2" value="<? echo $rowclient['code']; ?>" readonly>
</div>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<label>Nombre de la Empresa:</label>
<input name="cname" type="text" class="form-control" id="cname" value="<? echo $rowclient['name']; ?>" readonly > 
</div>
</div>
	<div class="row"></div>
<div class="col-md-4">
<div class="form-group">
<label>No. RUC:</label>
<input name="cruc" type="text" class="form-control" id="cruc" value="<? echo $rowclient['ruc']; ?>" readonly > 
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Email:</label>
<input name="cemail2" type="text" class="form-control" id="cemail2" value="<? echo $rowclient['email']; ?>" readonly > 
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Teléfono:</label>
<input name="cphone2" type="text" class="form-control" id="cphone2" value="<? echo $rowclient['phone']; ?>" readonly > 
</div>
</div>
	
<div class="row"></div>

<div class="col-md-8">
<div class="form-group">
<label>Dirección:</label>
<input name="caddress2" type="text" class="form-control" id="caddress2" value="<? echo $rowclient['address']; ?>" readonly > 
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Ciudad:</label>
<input name="ccity2" type="text" class="form-control" id="ccity2" value="<? echo $rowclient['city']; ?>" readonly > 
</div>
</div>

<div class="col-md-12"><h4>Información del Representante Legal</h4></div>

<div class="col-md-6 ">
<div class="form-group">
<label>Nombres:</label>
<input name="crfirst" type="text" class="form-control" id="crfirst" value="<? echo $rowclient['rfirst']; ?>" readonly > 
</div>
</div>
<div class="col-md-6 ">
<div class="form-group">
<label>Apellidos:</label>
<input name="crlast" type="text" class="form-control" id="crlast" value="<? echo $rowclient['rlast']; ?>" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Cédula:</label>
<input name="crnid" type="text" class="form-control" id="crnid" value="<? echo $rowclient['rnid']; ?>" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Email:</label>
<input name="cremail" type="text" class="form-control" id="cremail" value="<? echo $rowclient['remail']; ?>" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Teléfono:</label>
<input name="crphone" type="text" class="form-control" id="crphone" value="<? echo $rowclient['rphone']; ?>" readonly > 
</div>
</div>

</div>
<? } ?>													  
<br>
</div>
</div>
<div class="row"></div> 

<div class="row">
<div class="col-md-12 "><br>
<h3 class="form-section">Detalle de fondos</h3></div>
        

<div class="col-md-2 ">
													  <div class="form-group">
														<label>Monto:</label>
                                                        <input name="amount" type="text" class="form-control" id="amount" value="<? if($rowFunds['amount'] > 0){ echo $rowFunds['amount']; } ?>" onkeypress="return justNumbers(event);" readonly>
                                                       

                                                      <!--/row--></div>
													</div>

												  
												  <div class="col-md-2 ">
													  <div class="form-group">
														<label>Moneda:</label>
                                                        <input name="currency" type="text" class="form-control" id="currency" value="<? if($rowFunds['currency'] == 1) echo "Córdobas"; elseif($rowFunds['currency'] == 2) echo "Dólares"; ?>" onkeypress="return justNumbers(event);" readonly>
                                                      </div>
													</div>

												  <div class="col-md-2 ">
													  <div class="form-group">
														<label>Fecha del depósito:</label>
                                                        <input name="depositdate" type="text" class="form-control form-control-inline" id="depositdate" value="<? if($rowFunds['depositdate'] != '0000-00-00'){ echo  date("j-n-Y", strtotime($rowFunds['depositdate'])); } ?>" readonly>
                                                       </div>
													</div>

												  
								 					<div class="col-md-2 ">
													  <div class="form-group">
														<label>Compañía:</label>
														   <? 
														  $queryCompaies = "select * from companies where id = '$rowFunds[company]'";
														  $resultCompaies = mysqli_query($con, $queryCompaies);
														  $rowCompaies=mysqli_fetch_array($resultCompaies); ?>
                                                        <input name="company" type="text" class="form-control" id="company" value="<? echo $rowCompaies['name']; ?>" onkeypress="return justNumbers(event);" readonly>
                                                       </div>
													</div>	
												  
												  
												   <div class="col-md-2 ">
													  <div class="form-group">
														<label>Banco:</label>
														   <? 
														  $querybanks = "select * from banks where id = '$rowFunds[bank]' order by name";
														  $resultbanks = mysqli_query($con, $querybanks);
														  $rowbanks=mysqli_fetch_array($resultbanks); ?>
                                                        <input name="bank" type="text" class="form-control" id="bank" value="<? echo $rowbanks['name']; ?>" onkeypress="return justNumbers(event);" readonly>
                                                       </div>
													</div>	
												  
												  
												  <div class="row"></div>
												        <div class="col-md-12 ">
													  <div class="form-group">
														<label>Comentarios:</label>
                                                        <textarea name="comments" rows="2" class="form-control" id="comments" readonly><?php if($rowFunds['comments'] != '') echo $rowFunds['comments']; else echo 'Ninguno.'; ?></textarea> 
													</div>
													</div>
												  

 </div>    
												<div class="row" id="dShow">
													
													<div class="col-md-12 ">   
<h3 class="form-section">Archivo</h3></div>
													
													
  <div class="col-md-12" >
  <p id="status"></p>
  <p id="loaded_n_total"></p>  
  <p id="myfiles" >
	<? if(file_exists('../../funds/'.$id.'.jpg')){ ?>
  
  <img src="eimage.php?key=<? echo base64_encode($id); ?>" width="100%"> 
  <? } ?>

  </p>
													</div>
										
													
													<div class="col-md-12 "> <h3 class="form-section">Estado</h3>
													
													
													<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="13%">

										 TID</th>

									<th width="18%">

										 Fecha</th>

									<th width="16%">

										 Hora</th>

									<th width="25%">Acción</th>

									<th width="28%">

										 Por Usuario

									</th>


								  </tr>

								</thead>

								<tbody>
                                <?php 
									
									$querystatus = "select * from fundstimes where fund = '$_GET[id]' order by id asc";
									$resultstatus = mysqli_query($con, $querystatus);
									$i=0;
									while($rowstatus=mysqli_fetch_array($resultstatus)){
										if($i == 0){
											$day1 = $rowstatus['today'];
										}
										$i++;
					
								?>
                                
                                <tr role="row" class="odd">
									<td class="sorting_1"><?php echo $rowstatus['id']; ?></td>
									<td><?php echo date('d-m-Y',strtotime($rowstatus['today'])); ?></td>
									<td><?php echo date('h:i:s a', strtotime($rowstatus['now2'])); ?></td>
                                	<td><?php 
										
										switch($rowstatus['stage']){
											case 1:
												echo "Ingresado";
												break;
											case 1.50:
												echo "Corregido";
												break;
											case 2:
												echo 'Rechazado';
												break;
											case 3:	
												echo 'No encontrada';
												break;
											case 4:	
												echo 'Repetida';
												break;
											case 5:	
												echo 'Confirmada';
												break;
										}
										
										?></td>
                                	<td><?php 
                                
                                	if($rowstatus[userid] == 'GETPAY'){
                                    	echo "Sistema Getpay";
                                	}else{
                                    	$queryuser = "select * from workers where code = '$rowstatus[userid]'";
										$resultuser = mysqli_query($con, $queryuser);
								    	$rowuser = mysqli_fetch_array($resultuser);
								
								    	echo  $theuser = '<a href="mailto:'.$rowuser['email'].'">'.$rowuser['code']." | ".$rowuser['first']." ".$rowuser['last']."</a>";    
                                	} ?>
									</td>
                             	</tr>
                                          
                                <?php }  ?>
                                
                               
                                </tbody>

								</table>
	<div class="portlet"><br><br>
	
<div class="portlet-title">

							<div class="caption">

								Mis solicitudes de confirmación de fondos

							</div>

							<div class="actions">
						
								
							
								<a href="javascript:showMore();" class="btn default blue-stripe">
								<i class="fa fa-bars"></i>
								<span class="hidden-480">Herramientas pre-aprobado</span> 
								</a>
								
							

							</div>

						</div>
														</div>
<script type="text/javascript">
function showMore(){
	//event.preventDefault();
	$("#showMore").slideToggle();
	$("#fDiv1").slideToggle();
	$("#fDiv2").slideToggle();
}
</script>
														
													<div id="showMore" style="display: none;">
                                                      <div class="note note-success">
                                                        <div class="row">
                                                          <div class="col-md-3 ">
                                                            <div class="form-group">
                                                              <label>Compañía:</label>
                                                              <select name="company" class="form-control" id="uCompany">
                                                                <option value="0" selected>Seleccionar</option>
                                                                <?
                                                                $queryCompaies = "select * from companies order by name";
                                                                $resultCompaies = mysqli_query( $con, $queryCompaies );
                                                                while ( $rowCompaies = mysqli_fetch_array( $resultCompaies ) ) {
                                                                  ?>
                                                                <option value="<? echo $rowCompaies['id']; ?>" <? if($rowFunds['company'] == $rowCompaies['id']) echo "selected"; ?>><? echo $rowCompaies['name']; ?></option>
                                                                <? } ?>
                                                              </select>
                                                            </div>
                                                          </div>
                                                          <div class="col-md-3 ">
                                                            <div class="form-group">
                                                              <label>Banco:</label>
                                                              <select name="bank" class="form-control" id="uBank">
                                                                <option value="0" selected>Seleccionar</option>
                                                                <?
                                                                $querybanks = "select * from banks order by name";
                                                                $resultbanks = mysqli_query( $con, $querybanks );
                                                                while ( $rowbanks = mysqli_fetch_array( $resultbanks ) ) {
                                                                  ?>
                                                                <option value="<? echo $rowbanks['id']; ?>" <? if($rowFunds['bank'] == $rowbanks['id']) echo "selected"; ?>><? echo $rowbanks['name']; ?></option>
                                                                <? } ?>
                                                              </select>
                                                            </div>
                                                          </div>
														   <div class="col-md-3 ">
                                                            <div class="form-group">
                                                              <label>Moneda:</label>
                                                              <select name="bank" class="form-control" id="uCurrency">
                                                               
                                                                <?
                                                                $querycurrency = "select * from currency limit 2";
                                                                $resultcurrency = mysqli_query( $con, $querycurrency );
                                                                while ( $rowcurrency = mysqli_fetch_array( $resultcurrency ) ) {
                                                                  ?>
                                                                <option value="<?php echo $rowcurrency['id']; ?>" <? if($rowFunds['currency'] == $rowcurrency['id']) echo "selected"; ?>><? echo $rowcurrency['name']; ?></option>
                                                                <? } ?>
                                                              </select>
                                                            </div>
                                                          </div>

															 <div class="col-md-3 ">
                                                            <div class="form-group">
                                                              <label>Fecha:</label>
                                                             <input name="uDate" type="text" class="form-control date-picker" id="uDate" value="" readonly> 
                                                            </div>
                                                          </div>
															
                                                          <div class="row"></div>
                                                          <div class="col-md-12">
                                                            <button type="button" onClick="updateInfo();" class="btn blue" name="update" id="update"><i class="fa fa-refresh"></i> Actualizar</button>
                                                          </div>
                                                        </div>
                                                      </div>
															 
														 <script>
														 function updateInfo(){
															 var company = document.getElementById('uCompany').value;
															 var bank = document.getElementById('uBank').value;
															 var currency = document.getElementById('uCurrency').value;
															 var date = document.getElementById('uDate').value;
															
															 window.location = 'funds-confirmation-update.php?id=<? echo $_GET['id']; ?>&company='+company+'&bank='+bank+'&currency='+currency+'&tdate='.$date;
														 }
														 </script>
															
														</div>
	
	
                             </div>
													
													<div id="fDiv1">
													<div class="col-md-3 ">
													  <div class="form-group">
														<label>Seleccione una acción:</label>
                                                        
                                                        <select name="fAction" class="form-control" id="fAction" onChange="javascript:foundThis(this.value);">
                                                          <option value="0" selected>Seleccionar</option>
                                                          <option value="1">Fondos encontrados</option>
                                                          <option value="2">No confirmado (No se ha encontrado el EDC)</option>
														  <option value="3">No confirmado (Otra confirmación)</option>
														  <option value="4">No confirmado (No hay archivo)</option>
                                                          <option value="5">Rechazar la solicitud por otro motivo.</option>
                                                        </select>
                        								 <script>
														  function foundThis(val){
															  if(val == 1){
																  document.getElementById('fDiv').style.display = 'block';
																  document.getElementById('mDiv').style.display = 'none';
															  }else{
																  document.getElementById('fDiv').style.display = 'none';
																   document.getElementById('mDiv').style.display = 'block';
															  }
														  }
														  </script>                                   

													  </div>

													</div> 
													
													<div id="mDiv">
													<div class="col-md-12 ">
																<div class="form-group"><label>Comentarios:</label>
																	<textarea name="reason" rows="2" class="form-control" id="reason"></textarea> 
																</div> 
															</div>
													
													</div>
													
													<div id="fDiv" style="display: none;">
													<div class="row"></div>
													
													<div class="col-md-12 ">
													  <div class="form-group">
														<label>Estado de cuenta:</label>
                                                        <input name="statement" type="text" class="form-control" id="statement" value="" >
                                                       

                                                      <!--/row--></div>
													</div>
	
													<div class="col-md-12 ">
													  <div class="form-group">
														<label>Referencia bancaria:</label>
                                                        <input name="bankreference" type="text" class="form-control" id="bankreference" value="" onkeypress="return justNumbers(event);" >
                                                       

                                                      <!--/row--></div>
													</div>
													
													<div class="col-md-12">
													<button type="button" class="btn green" onClick="validateData();" id="bValidate"><i class="fa fa-check-square-o"></i> Validar</button>
													
														
													</div> 
														
														<div id="aTable"> </div>
														</div>
														
													<div id="rDiv1" style="display: none;">
															<div class="col-md-12"><br><div class="note note-danger">NOTA: Debe de ingresar una referencia bancaria.</div></div>
														</div>
													<div id="rDiv2" style="display: none;">
															<div class="col-md-12"><br><div class="note note-success">NOTA: Enhorabuena, no se ha encontrado ningun registro con la referencia igresada. Puede confirmar la solicitud de confirmación de fondos.</div></div>
														</div>
													<div id="rDiv3" style="display: none;"></div>
													</div>
													<script>
														
														function hideAll(){
															document.getElementById('rDiv1').style.display = 'none';
															document.getElementById('rDiv2').style.display = 'none';
															document.getElementById('rDiv3').style.display = 'none';
															
														}
														function revalidate(){
															hideAll();
															document.getElementById('bValidate').setAttribute( "onClick", "javascript:validateData();" );
															document.getElementById('bValidate').setAttribute( "class", "btn green" );
															document.getElementById('bValidate').innerHTML = '<i class="fa fa-check-square-o""></i> Validar';
															document.getElementById('aTable').innerHTML = ''; 
															document.getElementById('validated').value = '0';
															document.getElementById('statement').readOnly = false;
															document.getElementById('bankreference').readOnly = false;
															document.getElementById('statement').value = '';
															document.getElementById('bankreference').value = '';
															document.getElementById('bankreference').setAttribute( "style", "" );
														}
														function validateData(){
															
															var statement = document.getElementById('statement').value;
															if(statement == ''){
																alert('Favor ingrese el valor del campo estado de cuenta.');
																return;
															}
															
															document.getElementById('bValidate').setAttribute( "onClick", "javascript:revalidate();" );
															document.getElementById('bValidate').setAttribute( "class", "btn gray" );
															document.getElementById('bValidate').innerHTML = '<i class="fa fa-times"></i> Revalidar';
															document.getElementById('validated').value = '1';
															//document.getElementById('mainStatement').value = document.getElementById('statement').value;
															//document.getElementById('mainBankreference').value = document.getElementById('bankreference').value;
															document.getElementById('statement').readOnly = true;
															document.getElementById('bankreference').readOnly = true;
															
															var bankreference = document.getElementById('bankreference').value;
															$.post("funds-confirmation-approve-view-validator.php", { id: <? echo $id; ?>, bankreference: bankreference }, function(data){
																hideAll();
															
																if(data == 0){
																	alert('Debe de ingresar un numero de referencia para hacer la validacion.');
																	revalidate();
																	document.getElementById('validated').value = '0';
																	document.getElementById('approved').value = '0';
																}else if(data == 1){
																	
																	document.getElementById('bankreference').setAttribute( "style", "border:1px solid green;" );
																	document.getElementById('validated').value = '1';
																	document.getElementById('approved').value = '1';
																	document.getElementById('rDiv2').style.display = 'block';
																	
																}else{
																	document.getElementById('bankreference').setAttribute( "style", "border:1px solid red;" );
																	document.getElementById('aTable').innerHTML = data;
																	document.getElementById('validated').value = '1';
																	document.getElementById('approved').value = '0';
																	document.getElementById('tableContent').value = data;
																}
																
															});
														}
														
													</script>	
														
													</div>
													
													
							</div>
                                                  
                                              

							<div class="row"></div><br>


<div id="fDiv2">
											<div class="form-actions right" style=" margin-top:100px;">

												<div style="margin-right: 10px;">
												
												
											
													
													<button type="button" class="btn default" onClick="javascript:window.location='funds-confirmation-approve.php';" ><i class="fa fa-undo"></i> Retornar</button>
												
                                              <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Enviar respuesta</button>
											  </div>
											    
											    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
												<input type="hidden" name="validated" id="validated" value="0">
												<input type="hidden" name="approved" id="approved" value="0">
												<input type="hidden" name="mainStatement'" id="mainStatement'" value="">
												<input type="hidden" name="mainBankreference" id="mainBankreference" value="">
												<input type="hidden" name="tableContent" id="tableContent" value="">
												
											  
											</div>
											</div>


										</form>

										<!-- END FORM-->

									</div>

								</div>

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


<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script src="../assets/admin/pages/scripts/components-pickers.js"></script>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<script src="../assets/admin/pages/scripts/table-managed.js"></script>

<script>
jQuery(document).ready(function() {    
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
ComponentsPickers.init();

});
</script>

    
<script type="text/javascript"> 

function cancelAction(){
	if (confirm("Esta Seguro de cancelar este ingreso?\n")==true){
			window.location = 'funds-confirmation.php';
		}
}

function justNumbers(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }

function commas(unformatedAmmount){
    
	var floatAmmount = parseFloat(unformatedAmmount);
	var floatAmmount2 = floatAmmount.toFixed(2); 
	
	var parts = floatAmmount2.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
	var parts2 = parts.join(".");
	return parts2;  
}

function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}



function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}
			
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>

<script>
function validateForm(){ 
	
	var errMsg = '';
	var err = 0;
	var found = document.getElementById("found").value;
	var statement = document.getElementById("statement").value;
	var bankreference = document.getElementById("bankreference").value;
	var found2 = document.getElementById("found2").value;
	var validated = document.getElementById("validated").value;
	var approved = document.getElementById("approved").value;

	if(found == 1){
		if(statement == ''){
			err++;
			errMsg = errMsg+'-Debe de llenar el campo de estado de cuenta.';
		}
		if(bankreference == ''){
			err++;
			errMsg = errMsg+'-Debe de llenar el campo de referencia bancaria.';
		}
		if(validated == 0){
			err++;
			errMsg = errMsg+'-Debe de validar la informacion.';
		}
		
	}
	
	if(err > 0){
		alert(errMsg);
		return false;
	}
	

} 


</script>