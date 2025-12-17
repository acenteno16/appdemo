<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL); 

session_start();

function hasAccess($roles) {
    foreach ($roles as $role) {
        if (isset($_SESSION[$role]) && $_SESSION[$role] === "active") {
            return true;
        }
    }
    return false;
}

$allowedRoles = ["admin", "providers"];

if(hasAccess($allowedRoles)){
    include("../connection.php");
}else{
    session_destroy();
    header("Location: ../?err=noproviders_provider_export");
    exit;
}


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = $con->prepare("select * from providers where id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$row = mysqli_fetch_array($result);

$docTypeStr = '';
$queryDocType = "select * from providersDocsTypes";
$resultDocType = mysqli_query($con, $queryDocType);
while($rowDocType=mysqli_fetch_array($resultDocType)){
	$docTypeStr.=" <option value='$rowDocType[id],$rowDocType[expirationReq]'>$rowDocType[name]</option>";
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

		

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN STYLE CUSTOMIZER -->

			

			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Proveedores <small>Editor de Proveedores</small></h3>

					<ul class="page-breadcrumb breadcrumb">

						<?php /*<li class="btn-group">

							<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">

							<span>Actions</span><i class="fa fa-angle-down"></i>

							</button>

							<ul class="dropdown-menu pull-right" role="menu">

								<li>

									<a href="#">Action</a>

								</li>

								<li>

									<a href="#">Another action</a>

								</li>

								<li>

									<a href="#">Something else here</a>

								</li>

								<li class="divider">

								</li>

								<li>

									<a href="#">Separated link</a>

								</li>

							</ul>

						</li>*/ ?>

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="providers.php">Proveedores</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>Editor de Proveedores

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

											<?php //Form Sample ?>

										</div>

										<?php /*<div class="tools">

											<a href="javascript:;" class="collapse">

											</a>

											<a href="#portlet-config" data-toggle="modal" class="config">

											</a>

											<a href="javascript:;" class="reload">

											</a>

											<a href="javascript:;" class="remove">

											</a>

										</div>*/ ?>

									</div>

									<div class="portlet-body form">

						 				<!-- BEGIN FORM-->

										<form action="providers-edit-code.php" method="post" enctype="multipart/form-data" class="horizontal-form" id="providers"> 

											<div class="form-body">

												<h3 class="form-section">Informacion Empresarial</h3>

												<div class="row">

													<div class="col-md-3">

														<div class="form-group">

															<label class="control-label">Código:</label>

															<input name="code" type="text" class="form-control" id="firstName" value="<?php echo $row['code']; ?>">

	

														</div>

													</div>

													<div class="col-md-6">

													  <div class="form-group">

	<label class="control-label">Nombre:</label>
	<input name="name" type="text" class="form-control" id="name" placeholder="Ej: Casa Pellas S.A." value="<?php echo $row['name']; ?>">
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
														      </div>
													    </div>
														</div>

													</div>
                                                    
                                                    <div class="col-md-3">

														<div class="form-group">

															<label class="control-label">RUC:</label>

															<input name="ruc" type="text" class="form-control" id="ruc" placeholder="Ej: J03100000002371" value="<?php echo $row['ruc']; ?>">

														</div>

													</div>

													<!--/span-->

												</div>

												<!--/row-->

												<div class="row">

													
                                                    
                                                    <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">VIP/Bandera:</label>

														  <select name="flag" class="form-control" id="flag">
                                                          <option value="0" selected>No</option>
                                                          <option value="1" <?php if($row['flag'] == 1) echo 'selected'; ?>>Si</option> 
                                                          
													
														</select>
	

													  </div>

													</div>
                                                    
                                                    <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Nac/Internac:</label>

														  <select name="international" class="form-control" id="international">
                                                          <option value="0" selected>Nacional</option>
                                                          <option value="1" <?php if($row['international'] == 1) echo 'selected'; ?>>Internacional</option> 
                                                          
													
														</select>
	

													  </div>

													</div>

													<!--/span-->
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Moneda de pago:</label>
	<select name="currency" class="form-control" id="currency">
							  <option value="0" selected>Seleccionar</option>
                                                            <option value="1" <?php if($row['currency'] == 1) echo 'selected'; ?>>Cordobas</option>
<option value="2" <?php if($row['currency'] == 2) echo 'selected'; ?>>Dolares</option>
<option value="3" <?php if($row['currency'] == 3) echo 'selected'; ?>>Euros</option>
<option value="4" <?php if($row['currency'] == 4) echo 'selected'; ?>>Yenes</option>

														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>
                                                    
                                                    <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Activo:</label>
	<select name="active" class="form-control" id="active">
	<option value="0" selected>No</option>
    <option value="1" <?php if($row['active'] == 1) echo 'selected'; ?>>Si</option>



														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>
													

													<!--/span-->

												</div>
                                                
                                                
                                                <div class="row">
                                                
                                                <div class="col-md-3">

														<div class="form-group">

															<label class="control-label">Vencimiento:</label>

															<input name="term" type="text" class="form-control form-control-inline " id="term" placeholder="Ej: 30" value="<?php echo $row['term']; ?>" size="16"/>

															

														</div>

													</div>
                                                    <div class="col-md-3">

													  <div class="form-group">
 
	<label class="control-label">Regimen:</label>
	<select name="regime" class="form-control" id="regime">
	<option value="0" selected>Seleccionar</option> 
    <option value="1" <?php if($row['regime'] == 1) echo 'selected'; ?>>General</option>
    <option value="2" <?php if($row['regime'] == 2) echo 'selected'; ?>>Cuota Fija</option>



														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>
                                                   <div class="col-md-3">

													  <div class="form-group">
 
	<label class="control-label">Exo 1%:</label> 
	<select name="exo1" class="form-control" id="exo1">
	<option value="0" selected>No</option> 
    <option value="1" <?php if($row['imi'] == 1) echo 'selected'; ?>>Si</option>
  



														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>

<div class="col-md-3">

													  <div class="form-group">
 
	<label class="control-label">Exo 2%:</label>
	<select name="exo2" class="form-control" id="exo2">
	<option value="0" selected>No</option> 
    <option value="1" <?php if($row['ir'] == 1) echo 'selected'; ?>>Si</option>
   



														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>   
                                               
                                                        <div class="col-md-3">

														<div class="form-group">

														  <label>Giro</label>
															<input name="course" type="text" class="form-control" id="course" value="<?php echo $row['course']; ?>">
														</div>

													</div>
												  
												  <div class="col-md-3">

														<div class="form-group">

														  <label>Teléfono</label>
															<input name="phone" type="text" class="form-control" id="phone" value="<?php echo $row['phone']; ?>">
														</div>

													</div>
														
														
														<div class="col-md-3">

														<div class="form-group">

														  <label>Ciudad</label>
															<input name="city" type="text" class="form-control" id="city" value="<?php echo $row['city']; ?>">
														</div>

													</div>
												  
												  <div class="col-md-3">

														<div class="form-group">

														  <label>País</label>
															<input name="country" type="text" class="form-control" id="country" value="<?php echo $row['country']; ?>"> 
														</div>

													</div>
													  
													    <div class="col-md-9 ">

													  <div class="form-group">

														<label>Dirección</label>

													    <input name="address" type="text" class="form-control" id="address" placeholder="Ej: Rotonda El Gueguense 300mts al sur 2c abajo. Contiguo a PBS. Managua, Nicaragua." value="<?php echo $row['address']; ?>">

														</div>

													</div>   
                                               
                                                   <div class="col-md-3">

													<div class="form-group"> 

									 				  <label class="control-label">Última Actualización:</label>
									 				 <select name="updated" class="form-control" id="updated">
    													<option value="0" selected>No</option> 
    													<option value="1" <? if($row['updated'] == 1) echo 'selected'; ?>>Si</option> 
													 </select>
													</div> 
                                                    

												  </div> 
                                               
                                                    <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Grupo Casa Pellas:</label>

														  <select name="gcp" class="form-control" id="gcp">
                                                          <option value="0" selected>No</option>
                                                          <option value="1" <?php if($row['gcp'] == 1) echo 'selected'; ?>>Si</option> 
                                                          
													
														</select>
	

													  </div>

													</div>
                                               
                                                                                                                            <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Es Aseguradora?</label>

														  <select name="insurers" class="form-control" id="insurers">
                                                          <option value="0" selected>No</option>
                                                          <option value="1" <?php if($row['insurers'] == 1) echo 'selected'; ?>>Si</option> 
                                                          
													
														</select>
	

													  </div>

													</div>      
													
													 <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Activar pago de TC?</label>

														  <select name="cc" class="form-control" id="cc">
                                                          <option value="0" selected>No</option>
                                                          <option value="1" <?php if($row['cc'] == 1) echo 'selected'; ?>>Si</option> 
                                                          
													
														</select>
	

													  </div>

													</div>   
                                                    
                                                     <div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Es una Alcaldía?</label>

														  <select name="hall" class="form-control" id="hall">
                                                          <option value="0" selected>No</option>
                                                          <option value="1" <?php if($row['hall'] == 1) echo 'selected'; ?>>Si</option> 
                                                          
													
														</select>
	

													  </div>

													</div> 
													
													<div class="col-md-3">

													  <div class="form-group">

														<label class="control-label">Capital humano</label>

														  <select name="hc" class="form-control" id="hc">
                                                          <option value="0" selected>No</option>
                                                          <option value="1" <?php if($row['hc'] == 1) echo 'selected'; ?>>Si</option>
                                                          
													
														</select>
	

													  </div>

													</div> 
													
													
                                                </div>
                                                <? /*
                                                <div class="row">
                                                <div class="col-md-3">

													  <div class="form-group">
 
	<label class="control-label">Banco:</label>
	<select name="bank" class="form-control" id="bank">
    <option value="0" selected>Seleccionar</option> 
                                                          
<?php $querybank = "select * from banks";
$resultbank = mysqli_query($con, $querybank);
while($rowbank=mysqli_fetch_array($resultbank)){
?>																<option value="<?php echo $rowbank['id']; ?>" <? if($rowbank['id'] == $row['bank']) echo 'selected'; ?>><?php echo $rowbank['name']; ?></option>
<?php } ?>														
   



														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>
                                                    <div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Cuenta:</label>  

														  <input name="account" type="text" class="form-control" id="account" placeholder="" value="<?php echo $row['account']; ?>">

														</div>

													</div>
                                                    <div class="col-md-5">

													  <div class="form-group">
 
	<label class="control-label">Plan de Pago:</label>
	<select name="plan" class="form-control" id="plan">
    <option value="0" selected>Seleccionar</option> 
                                                          
<?php $querybank = "select * from plans";
$resultbank = mysqli_query($con, $querybank);
while($rowbank=mysqli_fetch_array($resultbank)){
	
	$querybank2 = "select * from banks where id = '$rowbank[bank]'";
	$resultbank2 = mysqli_query($con, $querybank2);
	$rowbank2=mysqli_fetch_array($resultbank2);

	$querycompany = "select * from companies where id = '$rowbank[company]'";
	$resultcompany = mysqli_query($con, $querycompany);
	$rowcompany=mysqli_fetch_array($resultcompany);

	$querycurrency = "select * from currency where id = '$rowbank[currency]'";
	$resultcurrency = mysqli_query($con, $querycurrency);
	$rowcurrency = mysqli_fetch_array($resultcurrency); 
		
	?>																	<option value="<?php echo $rowbank['id']; ?>" <? if($rowbank['id'] == $row['plan']) echo 'selected'; ?>><?php echo $rowcompany['name']."/".$rowbank2['name']."/".$rowcurrency['name']."/".$rowbank['account']; ?></option>
<?php } ?>														
   



														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>
                                                </div>
												*/ ?>

												<!--/row-->

												

												<!--/row-->

												<h3 class="form-section">Información de Contacto</h3>

												<div class="row"></div>
                                               <? 
												$queryc = "select * from providerscontacts where provider = '$row[id]'";
												$resultc = mysqli_query($con, $queryc); 
												$iba = 1;
												$numc = mysqli_num_rows($resultc);
												while($rowc=mysqli_fetch_array($resultc)){
												?>
                                                <div id="contact_<? echo $iba; ?>">
 
												<input type="hidden" name="cid[]" value="<? echo $rowc['id']; ?>">
												<div class="col-md-4">

														<div class="form-group">

														  <label>Nombre:</label>

															<input name="cname[]" type="text" class="form-control" id="cname[]" value="<?php echo $rowc['cname']; ?>">

														</div>

													</div>
												<div class="col-md-4">

														<div class="form-group"> 

														  <label>Cargo:</label>

															<input name="cjob[]" type="text" class="form-control" id="cjob[]" value="<?php echo $rowc['cjob']; ?>"> 

														</div>

													</div>
												<div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Correo:</label>
														<input name="cemail[]" type="text" class="form-control" id="cemail[]" placeholder="ejemplo@compañia.com" value="<?php echo $rowc['cemail']; ?>">
													  </div>

													</div>
												<div class="col-md-4">

													<div class="form-group">

									 				  <label class="control-label">Teléfono:</label>
									 				  <input name="cphone[]" type="text" class="form-control" id="cphone[]" placeholder="Ej: +505 2248 0120." value="<?php echo $rowc['cphone']; ?>">
													</div> 
                                                    

												  </div>
                                                <div class="col-md-4">

													<div class="form-group">

									 				  <label class="control-label">Celular:</label>
									 				  <input name="cmobile[]" type="text" class="form-control" id="cmobile[]" placeholder="Ej: +505 2248 0120." value="<?php echo $rowc['cmobile']; ?>">
													</div> 
                                                    

												  </div>
                                               
                                              <div class="col-md-4">

													<div class="form-group">

									 				  <label class="control-label">Notificaciones:</label>
									 				 <select name="cnot[]" class="form-control" id="cnot[]">
    													<option value="0" selected>No</option>
    													<option value="1" <? if($rowc['cnot'] == 1) echo 'selected'; ?>>Si</option> 
													 </select>
													</div> 
                                                    

												  </div>
                                              <div class="col-md-4">

													<div class="form-group">

									 				  <label class="control-label">Retenciones:</label>
									 				 <select name="cret[]" class="form-control" id="cret[]">
    													<option value="0" selected>No</option>
    													<option value="1" <? if($rowc['cret'] == 1) echo 'selected'; ?>>Si</option>
													 </select>
													</div> 
                                                    

												  </div>
                                              
                                               
                                                <div class="col-md-2"><div class="form-group">
												<label class="control-label">Opciones:</label><button type="button" class="btn red icn-only" onclick="deleteContact(<? echo $iba; ?>);"><i class="fa fa-trash-o"></i>Eliminar</button></div>  
												</div>
													<div class="row"></div>
												  <hr>

												  <!--/span-->
                                                
												</div>
												<? 
												$iba++;
												} 
												?>
												<div id="contacts"></div>
												<div class="row"></div> 
                                                
												<a href="javascript:addRow2();">[+ Agregar Contacto]</a>
												
												<br><br>
							
												
												<h3 class="form-section">Planes de pago</h3>
												<div class="row"></div>
												<? 
												$queryba = "select * from providers_plans where provider = '$row[id]'"; 
												$resultba = mysqli_query($con, $queryba);
												$numba = mysqli_num_rows($resultba);
												$iba = 1; 
												while($rowba=mysqli_fetch_array($resultba)){
												?>
												
												<div class="row" id="bank_<? echo $iba; ?>">
                                               <input type="hidden" name="baid[]" value="<? echo $rowba['id']; ?>">
                                                <div class="col-md-3">

													  <div class="form-group">
 
	<label class="control-label">Banco:</label>
	<select name="bank[]" class="form-control" id="bank[]">
    <option value="0" selected>Seleccionar</option> 
                                                          
<?php $querybank = "select * from banks";
$resultbank = mysqli_query($con, $querybank);
while($rowbank=mysqli_fetch_array($resultbank)){
?>																<option value="<?php echo $rowbank['id']; ?>" <? if($rowbank['id'] == $rowba['bank']) echo 'selected'; ?>><?php echo $rowbank['name']; ?></option>
<?php } ?>														
   



														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>
                                                <div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Cuenta:</label>  

														  <input name="account[]" type="text" class="form-control" id="account[]" placeholder="" value="<?php echo $rowba['account']; ?>">

														</div>

													</div>
                                                <div class="col-md-4">

													  <div class="form-group">
 
	<label class="control-label">Plan de Pago:</label>
	<select name="plan[]" class="form-control" id="plan[]">
    <option value="0" selected>Seleccionar</option> 
                                                          
<?php $querybank = "select * from plans";
$resultbank = mysqli_query($con, $querybank);
while($rowbank=mysqli_fetch_array($resultbank)){ 
	
	$querybank2 = "select * from banks where id = '$rowbank[bank]'";
	$resultbank2 = mysqli_query($con, $querybank2);
	$rowbank2=mysqli_fetch_array($resultbank2);

	$querycompany = "select * from companies where id = '$rowbank[company]'";
	$resultcompany = mysqli_query($con, $querycompany);
	$rowcompany=mysqli_fetch_array($resultcompany);

	$querycurrency = "select * from currency where id = '$rowbank[currency]'";
	$resultcurrency = mysqli_query($con, $querycurrency);
	$rowcurrency = mysqli_fetch_array($resultcurrency); 
		
	?>																	<option value="<?php echo $rowbank['id']; ?>" <? if($rowbank['id'] == $rowba['plan']) echo 'selected'; ?>><?php echo $rowcompany['name']."/".$rowbank2['name']."/".$rowcurrency['name']."/".$rowbank['account']; ?></option>
<?php } ?>														
   



														</select>
	<div title="Page 5">
															  <div>
															    <div>
															
														        </div>
						      </div>
													    </div>
													  </div>

													</div>
												<div class="col-md-1"><div class="form-group">
												<label class="control-label">Opciones:</label><button type="button" class="btn red icn-only" onclick="deleteBank(<? echo $iba; ?>);"><i class="fa fa-trash-o"></i>-</button></div>  
												</div></div>
                                                <? 
													$iba++;
													} 
												?>
												<div id="banks"></div>
                                                
												<a href="javascript:addRow();">[+ Agregar Cuenta]</a>
												<script>
													var cbank = parseInt(<?php echo $numba+1; ?>);  
													function addRow(){ 
														var str_row  = '<br><input type="hidden" name="baid[]" value="0"><div class="row"><div class="col-md-3"><select name="bank[]" class="form-control" id="bank"><option value="0" selected>Banco</option> <?php $querybank = "select * from banks";
$resultbank = mysqli_query($con, $querybank); while($rowbank=mysqli_fetch_array($resultbank)){ ?><option value="<?php echo $rowbank['id']; ?>"><?php echo $rowbank['name']; ?></option><?php } ?></select></div><div class="col-md-4"><input name="account[]" type="text" class="form-control" id="account" placeholder="Cuenta" value=""></div><div class="col-md-4"><select name="plan[]" class="form-control" id="plan"><option value="0" selected>Plan de pago</option><?php $querybank = "select * from plans"; $resultbank = mysqli_query($con, $querybank); while($rowbank=mysqli_fetch_array($resultbank)){ $querybank2 = "select * from banks where id = '$rowbank[bank]'"; $resultbank2 = mysqli_query($con, $querybank2); $rowbank2=mysqli_fetch_array($resultbank2); $querycompany = "select * from companies where id = '$rowbank[company]'"; $resultcompany = mysqli_query($con, $querycompany); $rowcompany=mysqli_fetch_array($resultcompany); $querycurrency = "select * from currency where id = '$rowbank[currency]'"; $resultcurrency = mysqli_query($con, $querycurrency); $rowcurrency = mysqli_fetch_array($resultcurrency); ?><option value="<?php echo $rowbank['id']; ?>" <? if($rowbank['id'] == $row['plan']) echo 'selected'; ?>><?php echo $rowcompany['name']."/".$rowbank2['name']."/".$rowcurrency['name']."/".$rowbank['account']; ?></option><?php } ?></select> </div><div class="col-md-1"><button type="button" class="btn red icn-only" onclick="deleteBank('+cbank+')"><i class="fa fa-trash-o"></i>-</button></div></div>';
														
														//alert(str_row);
														$("#banks").append('<div id="bank_'+cbank+'">'+str_row+'</div>');
														cbank++;
													}
													
													var ccontact = parseInt(<? echo $numc+1; ?>);
													function addRow2(){
														var str_row2 = '<input type="hidden" name="cid[]" value="0"><div class="col-md-4"><div class="form-group"><label>Nombre:</label><input name="cname[]" type="text" class="form-control" id="cname" value=""></div></div><div class="col-md-4"><div class="form-group"><label>Cargo:</label><input name="cjob[]" type="text" class="form-control" id="cjob[]" value=""></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Correo:</label><input name="cemail[]" type="text" class="form-control" id="cemail[]" placeholder="ejemplo@compañia.com" value=""></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Teléfono:</label><input name="cphone[]" type="text" class="form-control" id="cphone[]" placeholder="Ej: +505 2248 0120." value=""></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Celular:</label><input name="cmobile[]" type="text" class="form-control" id="cmobile[]" placeholder="Ej: +505 2248 0120." value=""></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Notificaciones:</label><select name="cnot[]" class="form-control" id="cnot[]"><option value="0" selected>No</option><option value="1">Si</option></select></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Retenciones:</label><select name="cret[]" class="form-control" id="cret[]"><option value="0" selected>No</option><option value="1">Si</option></select></div></div><div class="col-md-2"><div class="form-group"><label class="control-label">Opciones:</label><button type="button" class="btn red icn-only" onclick="deleteContact('+ccontact+');"><i class="fa fa-trash-o"></i>Eliminar</button></div></div>'; 
														
														$("#contacts").append('<div id="contact_'+ccontact+'">'+str_row2+'<div class="row"></div><hr></div>'); 
														ccontact++;
													}
													
													function deleteBank(id){ 
	 													$('#bank_'+id).remove();  
													}
													function deleteContact(id){  
	 													$('#contact_'+id).remove();  
													} 
													
												</script>	
											 	<? #if($_SESSION['email'] == 'jairovargasg@gmail.com'){ ?>
												<h3 class="form-section">Documentos tributarios</h3>  
												<div class="row"></div>
												<? 
												$queryDocs = "select * from providersDocs where provider = '$row[id]'"; 
												$resultDocs = mysqli_query($con, $queryDocs);
												$numDocs = mysqli_num_rows($resultDocs);
												$iDocs = 1; 
												while($rowDocs=mysqli_fetch_array($resultDocs)){
												?>
												
												<div class="row" id="doc_<? echo $iDocs; ?>">
                                               	<input type="hidden" name="docId[]" id="docId[]" value="<? echo $rowDocs['id']; ?>">
                                                <div class="col-md-3">
													  <div class="form-group">
														  <? if($iDocs == 1){ ?><label class="control-label">Tipo de documento:</label><? } ?>
														  <select name="docType[]" class="form-control" id="docType[]">
															  <option value="0,0" selected>Otro</option>
															  
															  <?
													$queryDocType = "select * from providersDocsTypes";
													$resultDocType = mysqli_query($con, $queryDocType);
													while($rowDocType=mysqli_fetch_array($resultDocType)){
														$menuSelected = '';
														if($rowDocType['id'] == $rowDocs['type']){
															$menuSelected = 'selected';
														}
														echo " <option value='$rowDocType[id],$rowDocType[expirationReq]' $menuSelected>$rowDocType[name]</option>";
													} ?>
														  </select>
													  </div>
												</div>
                                                <div class="col-md-4">
													  <div class="form-group">
														<? if($iDocs == 1){ ?><label class="control-label">URL:</label><? } ?> 
														  <input name="docUrl[]" type="text" class="form-control" id="docUrl[]" placeholder="" value="<?php echo $rowDocs['url']; ?>">
														</div>
													</div>
                                                <div class="col-md-3">
													<div class="form-group">
														<? if($iDocs == 1){ ?><label class="control-label">Fecha de expiración:</label> <? } ?> 
														<input name="docDate[]" type="text" class="form-control form-control-inline date-picker"  id="docDate[]" placeholder="" value="<?php if($rowDocs['expiration'] != '0000-00-00')
		echo date('j-n-Y', strtotime($rowDocs['expiration']));  ?>" readonly>
													</div>
												</div>
												<div class="col-md-1"><div class="form-group">
												<? if($iDocs == 1){ ?><label class="control-label">Opciones:</label><? } ?>
													<button type="button" class="btn red icn-only" onclick="deleteDocs(<? echo $iDocs; ?>);"><i class="fa fa-trash-o"></i>-</button></div>  
												</div>
												</div>
                                                <? 
													$iDocs++;
												} 
												?>
												<div id="docs"></div>
                                                
												<a href="javascript:addRowDocs();">[+ Agregar documento]</a>
												<script>
													
													var vtitle = 1;
													var iDocs = parseInt(<?php echo $iDocs+1; ?>);  
													function addRowDocs(){ 
													
													var label1 = '<label class="control-label">Tipo de documento:</label>';
													var label2 = '<label class="control-label">URL:</label> ';
													var label3 = '<label class="control-label">Fecha de expiración:</label> ';	
													var label4 = '<label class="control-label">Opciones:</label>';
													if(vtitle == 0){
														var label1 = '';
														var label2 = '';
														var label3 = '';
														var label4 = '';
													}	
														
													var str_row  = `
													<div class="row">
													<div class="col-md-3">
													  <div class="form-group">
														  `+label1+`
														  <select name="docType[]" class="form-control" id="docType[]">
															  <option value="0" selected>Otro</option> 
															  <?php echo $docTypeStr; ?>
														  </select>
													  </div>
												</div>
                                                <div class="col-md-4">
													  <div class="form-group">
														`+label2+`
														  <input name="docUrl[]" type="text" class="form-control" id="docUrl[]" placeholder="" value="">
														</div>
													</div>
                                                <div class="col-md-3">
													<div class="form-group">
														`+label3+`
														<input name="docDate[]" type="text" class="form-control form-control-inline date-picker"  id="docDate[]" placeholder="" value="" readonly>
													</div>
												</div>
												<div class="col-md-1"><div class="form-group">
												`+label4+`
												<button type="button" class="btn red icn-only" onclick="deleteDocs(`+iDocs+`);"><i class="fa fa-trash-o"></i>-</button></div>  
												</div>
												</div>
												`;
												vtitle = 0;
														
														//alert(str_row);
														$("#docs").append('<div id="doc_'+iDocs+'">'+str_row+'</div>');
														iDocs++;
														ComponentsPickers.init();
													}
													
													function deleteDocs(id){ 
	 													$('#doc_'+id).remove(); 
														
													}
													
													
												</script>
												
												<? #} ?>

											</div>

											<div class="form-actions right">

												<button type="button" class="btn default" onClick="goProviders();">Cancelar</button>
                                                <script>
												function goProviders(){
													window.location = "providers.php";
												}
												</script>

											  <button type="submit" class="btn blue"><i class="fa fa-check"></i> Editar</button>
												<input name="id" type="hidden" id="id" value="<?php echo $row['id']; ?>">

											</div>

										</form>

										<!-- END FORM-->



									</div>  

								</div>

							</div>
                            
                            
                          <? //Buscar en banks form ?>
						  <div class="">
						  <h3>LOG de actualizaciones</h3> 
						  
						  <? 
						  
						  $querylog = "select * from providerstimes where provider = '$id'";
						  $resultlog = mysqli_query($con, $querylog);
						  $numlog = mysqli_num_rows($resultlog);
						  if($numlog > 0){
						  ?> 
						  
						  
						  <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 TID</th>

									<th width="13%">

										 Fecha y Hora</th>

									<th width="11%">Usuario</th>

								  </tr>

								</thead>

								<tbody>
                                <?php while($rowlog=mysqli_fetch_array($resultlog)){
								
									$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$rowlog[userid]'")); 
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowlog['id']; ?></td>
                                  <td><? echo date('d-m-Y',strtotime($rowlog['today'])); ?> @<? echo date('h:i:s a', strtotime($rowlog['now2'])); ?>                            </td><td><? echo $rowcollaborator['first']." ".$rowcollaborator['last']; ?></td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
						  <? }
						  else{ 
						  ?>
						  <div class="note note-regular">
						  NOTA: No se encontró ningún registro.
						  </div>
						  <? } ?>
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

<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>


<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/form-samples.js"></script>
	
<script src="../assets/admin/pages/scripts/components-pickers.js"></script>
	
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>

jQuery(document).ready(function() {
	// initiate layout and plugins
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init() // init quick sidebar
	FormSamples.init();
	ComponentsPickers.init();
});

</script>






<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
<script>
function Eliminar(id){
	if (confirm("Usted desea eliminar esta cuenta?\n- Si usted no desea eliminar esta cuenta presione cancelar.")==true){
	window.location="providers-account-delete.php?id="+id+"&id2=<?php echo $_GET['id']; ?>";		
	}
}

function Favorita(id){
	window.location="providers-account-favorite.php?id="+id+"&id2=<?php echo $_GET['id']; ?>"; 
}
</script>
<script>
// --- Utilidades ---
function captureFormState(form) {
  const state = {};
  const els = form.querySelectorAll('input, select, textarea');

  // Para cubrir checkboxes no marcados (que FormData no incluye)
  const allNames = new Set(Array.from(els).map(el => el.name || el.id).filter(Boolean));

  // 1) Captura base con FormData
  const fd = new FormData(form);
  fd.forEach((v, k) => {
    if (state[k] === undefined) state[k] = v;
    else {
      // múltiples valores (select multiple / checkbox group)
      if (!Array.isArray(state[k])) state[k] = [state[k]];
      state[k].push(v);
    }
  });

  // 2) Completa lo que FormData no pone (checkbox no marcado, radios sin selección, inputs sin name)
  els.forEach(el => {
    const name = el.name || el.id;
    if (!name) return;

    if (el.type === 'checkbox') {
      // Si el checkbox no fue enviado, guardamos false
      if (!fd.has(name)) {
        // Si es grupo de checkboxes, guardamos array vacío una sola vez
        const group = form.querySelectorAll(`input[type="checkbox"][name="${CSS.escape(name)}"]`);
        if (group.length > 1) {
          if (state[name] === undefined) state[name] = [];
        } else {
          state[name] = false;
        }
      }
    } else if (el.type === 'radio') {
      // Si ningún radio del grupo fue enviado, guardamos null
      const group = form.querySelectorAll(`input[type="radio"][name="${CSS.escape(name)}"]`);
      const anyChecked = Array.from(group).some(r => r.checked);
      if (!anyChecked && state[name] === undefined) state[name] = null;
    } else if (el.tagName === 'SELECT' && el.multiple) {
      if (state[name] === undefined) state[name] = [];
    } else {
      if (state[name] === undefined) state[name] = el.value ?? '';
    }
  });

  return state;
}

function applyFormState(form, state) {
  if (!state) return;

  Object.entries(state).forEach(([name, val]) => {
    const els = form.querySelectorAll(`[name="${name}"]`);
    if (!els.length) return;

    const values = Array.isArray(val) ? val : [val];

    // Detecta tipo principal del grupo
    const first = els[0];
    const isSelect = first.tagName === 'SELECT';
    const isMultipleSelect = isSelect && first.multiple;
    const isCheckbox = first.type === 'checkbox';
    const isRadio = first.type === 'radio';

    if (isRadio) {
      // Grupo de radios: marca el que coincida
      els.forEach(el => {
        el.checked = values.includes(el.value);
      });
      return;
    }

    if (isCheckbox) {
      if (els.length > 1) {
        // Grupo de checkboxes: lista de valores
        els.forEach(el => {
          el.checked = values.includes(el.value);
        });
      } else {
        // Checkbox único: booleano/“on”/“1”
        const v = Array.isArray(val) ? val[0] : val;
        els[0].checked = !!v && v !== 'false' && v !== '0';
      }
      return;
    }

    if (isMultipleSelect) {
      // SELECT multiple: set por conjunto
      const set = new Set(values.map(v => v != null ? String(v) : ''));
      Array.from(first.options).forEach(opt => {
        opt.selected = set.has(String(opt.value));
      });
      return;
    }

    if (isSelect) {
      // SELECT simple: si llegara un array, usa índice por elemento o el primero
      els.forEach((el, i) => {
        const v = Array.isArray(val) ? (val[i] ?? val[0] ?? '') : (val ?? '');
        el.value = v;
      });
      return;
    }

    // Inputs/textarea
    if (els.length > 1) {
      // Varios inputs con el mismo name (p.ej. name="campo[]"): asigna por índice
      els.forEach((el, i) => {
        el.value = values[i] ?? '';
      });
    } else {
      // Input único: si llega array, toma el primero
      const v = Array.isArray(val) ? (val[0] ?? '') : (val ?? '');
      els[0].value = v;
    }
  });

  // Dispara 'change' por si tu UI depende de listeners
  Object.keys(state).forEach(name => {
    const els = form.querySelectorAll(`[name="${name}"]`);
    els.forEach(el => el.dispatchEvent(new Event('change', { bubbles: true })));
  });
}

// --- Persistencia con TTL (por si algo rompe el flujo) ---
const PERSIST_KEY = 'persistFormDocs';
const FLAG_KEY    = 'returningFromProcessor';
const TTL_MINUTES = 5;

function savePayload(form) {
  const payload = {
    ts: Date.now(),
    docs: (document.querySelector('#docs')?.innerHTML) ?? '',
    form: captureFormState(form)
  };
  localStorage.setItem(PERSIST_KEY, JSON.stringify(payload)); // localStorage para sobrevivir redirecciones intermedias
}

function loadPayloadAndMaybeClear() {
  const raw = localStorage.getItem(PERSIST_KEY);
  if (!raw) return null;
  try {
    const data = JSON.parse(raw);
    const ageMin = (Date.now() - data.ts) / 60000;
    if (ageMin > TTL_MINUTES) {
      localStorage.removeItem(PERSIST_KEY);
      return null;
    }
    return data;
  } catch {
    localStorage.removeItem(PERSIST_KEY);
    return null;
  }
}

// --- Hookear submit & pagehide ---
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('providers') || document.querySelector('form');
  if (!form) return;

  form.addEventListener('submit', () => {
    savePayload(form);
  });

  // Red de seguridad si se abandona sin submit
  window.addEventListener('pagehide', () => {
    savePayload(form);
  });

  // Restaurar solo si venimos de la procesadora
  window.addEventListener('pageshow', () => {
    const fromProcessor = sessionStorage.getItem(FLAG_KEY) === '1';
    if (!fromProcessor) {
      // Si no venimos de atrás, limpiar residuos
      localStorage.removeItem(PERSIST_KEY);
      return;
    }

    const data = loadPayloadAndMaybeClear();
    if (!data) {
      sessionStorage.removeItem(FLAG_KEY);
      return;
    }

    // 1) Reconstruir #docs
    const docs = document.querySelector('#docs');
    if (docs) docs.innerHTML = data.docs;

    // 2) Esperar al siguiente frame para asegurar que el DOM dinámico cayó
    requestAnimationFrame(() => {
      applyFormState(form, data.form);

      // Limpiar para que F5 no restaure
      localStorage.removeItem(PERSIST_KEY);
      sessionStorage.removeItem(FLAG_KEY);
    });
  });
});
</script>
