<?php 

include("session-request.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if($id == 0){
	echo "<script>alert('No se reconoce el ID de la solicitud.'); window.location='payments.php';</script>";
	exit();
}

$querypconfirm = $con->prepare("select * from payments where id = ?");
$querypconfirm->bind_param("i", $id);
$querypconfirm->execute();
$resultpconfirm = $querypconfirm->get_result();
$rowpconfirm = $resultpconfirm->fetch_assoc();

if($rowpconfirm['status'] != 0){
	//header('location: dashboard.php');
	echo "<script>alert('La solicitud se encuentra en otra etapa.'); window.location='payments.php';</script>";
	exit();
} 

if($rowpconfirm['userid'] != $_SESSION['userid']){
	//header('location: dashboard.php');
	echo "<script>alert('No se reconoce el Usuario.'); window.location='payments.php';</script>";
	exit();
} 

if($rowpconfirm['type'] != '4'){
	//header('location: dashboard.php');
	echo "<script>alert('No se reconoce el tipo de solicitud.'); window.location='payments.php';</script>";
	exit();
} 

$typeinc = 0;

$queryrefund = "select * from clientsrefund where payment = '$rowpconfirm[id]'";
$resultrefund = mysqli_query($con, $queryrefund);
$rowrefund = mysqli_fetch_array($resultrefund);

$queryclient = "select * from clients where code = '$rowpconfirm[client]'";
$resultclient = mysqli_query($con, $queryclient);
$rowclient = mysqli_fetch_array($resultclient);
	
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



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:reloadRouteView()"> 

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

					Pagos <small>Solicitud de Pago</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="payments.php">Pagos</a>
                             <i class="fa fa-angle-right"></i>
                             </li>

						<li>

							<a href="#">Solicitudes de pagos</a>

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

										<form name="porder" id="porder" action="payment-order-refund-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        

											<div class="form-body">

												<h3 class="form-section">Información General</h3> 
                                                <div class="row">
                                                <!--/span-->

													<div class="col-md-2">

													  <div class="form-group">

	<label class="control-label">ID de Pago:</label>
										
											  <input name="id" type="text" class="form-control" id="id" value="<?php echo $rowpconfirm['id']; ?>" readonly>  
								
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

<div class="row">
                                                   
<div class="col-md-12">
<div class="note note-success">Nota: Los campos Nombres y Apellidos tienes que ser exactos a como aparecen en el documento de identidad presentado. X</div>
</div></div>
                                                  
                                                  <div id="client-stage">

                                                  <div class="row">
                                                   
<div class="col-md-4">

<div class="form-group">
<label class="control-label">Tipo de cliente</label>
<select name="clienttype" class="form-control" id="clienttype" onChange="javascript:clientType(this.value);">
<option value="0" selected>Seleccionar</option>
<option value="1" <? if($rowclient['type'] == 1) echo "selected"; ?>>Persona Natural</option> 
<option value="2" <? if($rowclient['type'] == 2) echo "selected"; ?>>Persona Jurídica</option> 
</select>
                                                            

													  </div>

													</div>   
													  
													  
<div class="row"></div>                                                  
<div id="ct_personal" style="display: none;">
<div class="col-md-2 ">
<div class="form-group">
<label>Código:</label>
<div class="input-group">
<input name="ccode" type="text" class="form-control" id="ccode" value="<? echo $rowclient['code']; ?>" >
<span class="input-group-addon">
<a href="javascript:benType(1);"><i class="icon-reload"></i></a>
											</span> </div>
</div>
</div>
<div class="col-md-5 ">
<div class="form-group">
<label>NombresX:</label>
<input name="cfirst" type="text" class="form-control" id="cfirst" value="" readonly > 
</div>
</div>
<div class="col-md-5 ">
<div class="form-group">
<label>Apellidos:</label>
<input name="clast" type="text" class="form-control" id="clast" value="" readonly > 
</div>
</div>
<div class="col-md-8 ">
<div class="form-group">
<label>Dirección:</label>
<input name="caddress" type="text" class="form-control" id="caddress" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Ciudad:</label>
<input name="ccity" type="text" class="form-control" id="ccity" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Cédula:</label>
<input name="cnid" type="text" class="form-control" id="cnid" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Email:</label>
<input name="cemail" type="text" class="form-control" id="cemail" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Teléfono:</label>
<input name="cphone" type="text" class="form-control" id="cphone" value="" readonly > 
</div>
</div>
</div>
<div id="ct_business" style="display: none;">
<div class="col-md-2 ">
<div class="form-group">
<label>Código:</label>
<div class="input-group">
<input name="ccode2" type="text" class="form-control" id="ccode2" value="<? echo $rowclient['code']; ?>">
<span class="input-group-addon">
<a href="javascript:benType(2);"><i class="icon-reload"></i></a>
											</span> </div>
 
</div>
</div>
<div class="col-md-10 ">
<div class="form-group">
<label>Nombre de la Empresa:</label>
<input name="cname" type="text" class="form-control" id="cname" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>No. RUC:</label>
<input name="cruc" type="text" class="form-control" id="cruc" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Email:</label>
<input name="cemail2" type="text" class="form-control" id="cemail2" value="" readonly > 
</div>
</div>

<div class="col-md-4 ">
<div class="form-group">
<label>Teléfono:</label>
<input name="cphone2" type="text" class="form-control" id="cphone2" value="" readonly > 
</div>
</div>

<div class="col-md-8 ">
<div class="form-group">
<label>Dirección:</label>
<input name="caddress2" type="text" class="form-control" id="caddress2" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Ciudad:</label>
<input name="ccity2" type="text" class="form-control" id="ccity2" value="" readonly > 
</div>
</div>


<div class="col-md-12"><h4>Información del Representante Legal</h4></div>

<div class="col-md-6 ">
<div class="form-group">
<label>Nombres:</label>
<input name="crfirst" type="text" class="form-control" id="crfirst" value="" readonly > 
</div>
</div>
<div class="col-md-6 ">
<div class="form-group">
<label>Apellidos:</label>
<input name="crlast" type="text" class="form-control" id="crlast" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Cédula:</label>
<input name="crnid" type="text" class="form-control" id="crnid" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Email:</label>
<input name="cremail" type="text" class="form-control" id="cremail" value="" readonly > 
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<label>Teléfono:</label>
<input name="crphone" type="text" class="form-control" id="crphone" value="" readonly > 
</div>
</div>

</div>
<br>
</div>
</div>
<div class="row"></div> 

												
 <h3 class="form-section">Tipo de Devolución</h3>
 
<div class="form-group">
 <?php //<label>Moneda:</label> ?>
<div class="radio-list" style="margin-left:30px;">

                                        
										                                           
										  <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input name="devtype" type="radio" id="devtype" onClick="javascript:reloadRequirements(this.value);" value="1" <? if($rowrefund['devtype'] == 1) echo "checked"; ?> <?php //checked ?>></span></div> Primas</label>
									                                           
									                                             <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input type="radio" name="devtype" id="devtype" onClick="javascript:reloadRequirements(this.value);" value="2" <? if($rowrefund['devtype'] == 2) echo "checked"; ?> <?php //checked ?>></span></div> Reservas</label>
										                                           
										  <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input type="radio" name="devtype" id="devtype" onClick="javascript:reloadRequirements(this.value);" value="3" <? if($rowrefund['devtype'] == 3) echo "checked"; ?><?php //checked ?>></span></div> Excedentes</label>
									                                           
									                                             <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input type="radio" name="devtype" id="devtype" onClick="javascript:reloadRequirements(this.value);" value="4" <? if($rowrefund['devtype'] == 4) echo "checked"; ?><?php //checked ?>></span></div> Seguros</label>
										                                           
										  <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input type="radio" name="devtype" id="devtype" onClick="javascript:reloadRequirements(this.value);" value="5" <? if($rowrefund['devtype'] == 5) echo "checked"; ?> <?php //checked ?>></span></div>
									      Producto
									      </label>
	
	
										  <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input type="radio" name="devtype" id="devtype" onClick="javascript:reloadRequirements(this.value);" value="6" <? if($rowrefund['devtype'] == 6) echo "checked"; ?> <?php //checked ?>></span></div> PMP</label> 
	
	
										  <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input type="radio" name="devtype" id="devtype" onClick="javascript:reloadRequirements(this.value);" value="7" <? if($rowrefund['devtype'] == 7) echo "checked"; ?> <?php //checked ?>></span></div> Leasing</label>
	
										  <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input type="radio" name="devtype" id="devtype" onClick="javascript:reloadRequirements(this.value);" value="8" <? if($rowrefund['devtype'] == 8) echo "checked"; ?> <?php //checked ?>></span></div> Autoflex</label>
	
	 									  <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input type="radio" name="devtype" id="devtype" onClick="javascript:reloadRequirements(this.value);" value="9" <? if($rowrefund['devtype'] == 9) echo "checked"; ?> <?php //checked ?>></span></div>
									      Saldo a favor del Cliente
									      </label>
    
                                         
    
                                          <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2"> 
                                          <input type="radio" name="devtype" id="devtype" onClick="javascript:reloadRequirements(this.value);" value="10" <? if($rowrefund['devtype'] == 10) echo "checked"; ?> <?php //checked ?>></span></div>
									      FIDEM
									      </label>    
                                         
											                                           
											
						</div>
									</div> 
									
<script>
function reloadRequirements(rtype){

if(rtype == "load"){
	var devtype = 0;
	var radios_devtype = document.getElementsByName('devtype');

	for(i=0;i<radios_devtype.length;i++){
 		if (radios_devtype[i].checked){
  			rtype = radios_devtype[i].value;
  			break;
 		}
	}

}
//Primas
if(rtype == 1){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Primas)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>- Informe de Negociación<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "block";
	document.getElementById('assets_3').style.display = "none";
	document.getElementById('assets_4').style.display = "block";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	
	document.getElementById('noLabel').innerHTML = 'No. Informe de Negociación:';
	document.getElementById('fReserva').style.display = "block";
	document.getElementById('credit').value = '1';
	
}

//Reservas
if(rtype == 2){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Reservas)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>- Informe de Negociación<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "block";
	document.getElementById('assets_3').style.display = "none";
	document.getElementById('assets_4').style.display = "block";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	
	document.getElementById('noLabel').innerHTML = 'No. Informe de Negociación:';
	document.getElementById('noLabel').innerHTML = 'No. Informe de Negociación:';
	document.getElementById('fReserva').style.display = "block";
	document.getElementById('credit').value = '1';
	
}

//Excedentes
if(rtype == 3){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Excedentes)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>- Informe de Negociación<br>- Carta Emitida por el Banco<br>- Factura<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "block";
	document.getElementById('assets_3').style.display = "none";
	document.getElementById('assets_4').style.display = "block";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	
	document.getElementById('noLabel').innerHTML = 'No. Informe de Negociación:';
	document.getElementById('fReserva').style.display = "block";
	document.getElementById('credit').value = '1';
	
}

//Seguros
if(rtype == 4){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Seguros)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>-Fotocopia de Circulacion<br>- Finiquito<br>- CK de la aseguradora<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "none";
	document.getElementById('assets_3').style.display = "none";
	//Additional Information
	document.getElementById('assets_4').style.display = "none";
	document.getElementById('assets_5').style.display = "block";
	document.getElementById('assets_6').style.display = "none";
	document.getElementById('report').value = "";
	document.getElementById('credit').value = '1';
}

//Productos
if(rtype == 5){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Productos)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "none";
	document.getElementById('assets_3').style.display = "block";
	//Additional Information
	document.getElementById('assets_4').style.display = "none";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	document.getElementById('report').value = "";
	document.getElementById('credit').value = '0';
}

//PMP
if(rtype == 6){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (PMP)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "none";
	document.getElementById('assets_3').style.display = "none";
	//Additional Information
	document.getElementById('assets_4').style.display = "none";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "block";
	document.getElementById('report').value = "";
	document.getElementById('credit').value = '0';
}

//Leasing	
if(rtype == 7){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Leasing)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>- Informe de Negociación<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "block";
	document.getElementById('assets_3').style.display = "none";
	document.getElementById('assets_4').style.display = "block";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	
	document.getElementById('noLabel').innerHTML = 'No. de contrato:';
	document.getElementById('fReserva').style.display = "none";
	document.getElementById('credit').value = '0';
}
	
//Autoflex
if(rtype == 8){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Autoflex)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>- Informe de Negociación<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "block";
	document.getElementById('assets_3').style.display = "none";
	document.getElementById('assets_4').style.display = "block";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	
	document.getElementById('noLabel').innerHTML = 'No. de contrato:';
	document.getElementById('fReserva').style.display = "none";
	document.getElementById('credit').value = '0';
}
	
//Saldo a favor del cliente
if(rtype == 9){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (Saldo a favor del cliente)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>"; 
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "none";
	document.getElementById('assets_3').style.display = "block";
	//Additional Information
	document.getElementById('assets_4').style.display = "none";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	document.getElementById('report').value = "";
	document.getElementById('credit').value = '1'; 
}
    
//FIDEM
if(rtype == 10){
	document.getElementById('requirements').innerHTML = "<strong>Requisitos en base al tipo de devolución: (FIDEM)</strong> <br><br>- Carta del Cliente<br>- Fotocopia de Cédula<br>- Recibo Original de Caja<br>- Informe de Negociación<br>";
	document.getElementById('assets_1').style.display = "none";
	document.getElementById('assets_2').style.display = "block";
	document.getElementById('assets_3').style.display = "none";
	document.getElementById('assets_4').style.display = "block";
	document.getElementById('assets_5').style.display = "none";
	document.getElementById('assets_6').style.display = "none";
	
	document.getElementById('noLabel').innerHTML = 'No. de contrato:';
	document.getElementById('fReserva').style.display = "none";
	document.getElementById('credit').value = '0';
}     

}
   
</script>

<h3  class="form-section">Motivo de Devolución</h3> 

      
        
											  <div class="row">
													
													

													

                                    <div class="col-md-12 ">
													  <div class="form-group">
														<label>Descripción:</label>
                                                        <textarea name="description" rows="2" class="form-control" id="description"><?php echo $rowpconfirm['description']; ?></textarea> 
<script>
/* 
function validateFirst(){
	var recipient = document.getElementById("dspayment").value;
	var provider = document.getElementById("provider").value;
	var collaborator = document.getElementById("collaborator").value;	
	if(recipient == 0){
	document.getElementById("dspayment").focus(); 
	alert('Usted debe de seleccionar el tipo de beneficiario.');
	}
	if((recipient == 1) && (provider == "")){
		document.getElementById("provider").focus(); 
		alert('Usted debe de seleccionar un Proveedor.');
		return false;
	}
	if((recipient == 2) && (collaborator == "")){
		document.getElementById("collaborator").focus(); 
		alert('Usted debe de seleccionar un Colaborador.');
		return false;
	}
}
*/
                    </script>	
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
                                    

 
 
       
   
          
<div class="row"></div>
                                                   
<?php //MONEDA ?>                                                      
<br>
<div class="col-md-12 ">   
<h3 class="form-section">Monto de la Devolución</h3></div>
        

<div class="col-md-3 ">
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="totalbill" type="text" class="form-control" id="totalbill" value="<? if($rowpconfirm['payment'] > 0){ echo $rowpconfirm['payment']; } ?>" onkeypress="return justNumbers(event);">
                                                        <input name="floattotalbill" type="hidden" id="floattotalbill" value="">
<br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div>
													<div class="col-md-9 "> 
												

 
<div class="form-group"> <label>Moneda:</label>
<div class="radio-list" style="margin-left:30px;">
<?php 

$querycurrency = "select * from currency limit 2"; 
$resultcurrency = mysqli_query($con, $querycurrency);
$checked = 1;
while($rowcurrency=mysqli_fetch_array($resultcurrency)){

?>
                                            <label class="radio-inline">
										  <div class="radio1" id="uniform-optionsRadios4"><span class="checked2">
                                          <input name="currency" type="radio" id="currency" value="<?php echo $rowcurrency['id']; ?>" <? if($rowpconfirm['currency'] == $rowcurrency['id']) echo "checked"; ?> ></span></div> <?php echo $rowcurrency['name']; ?></label>
											                                           <?php } ?> 
											
										</div><br>
									</div> </div>


													 
 
									
<div class="col-md-12 ">   
<h3 class="form-section">Recibo(s) de Caja / Factura(s)</h3></div>
<div class="col-md-12 "> 									
<div id="ddistribucion3">

						<div class="row">

<?php //tipo ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Tipo:</label>
                                                                    
		
             </div>
													</div>
<?php //No ROC ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Número:</label>
                                                                                                               
		
             </div>
													</div>
<?php //Fecha ?>                                                    
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Fecha de doc:</label>
                                                                                                              
		
             </div>
													</div>
<?php //Monto ?>                                                    
<div class="col-md-2 ">
	<div class="form-group">
														<label>Monto:</label>
                                                                                                               
		
             </div>
													</div> 
<?php //Moneda ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Moneda:</label>
                                                                                                             
		
             </div>
													</div>													

</div>


<? //End of labels ?>

<? 
$queryrocs = "select * from clientsdocuments where payment = '$rowpconfirm[id]'";
$resultrocs = mysqli_query($con, $queryrocs);
$numrocs = mysqli_num_rows($resultrocs);
if($numrocs > 0){
while($rowrocs=mysqli_fetch_array($resultrocs)){
?>
<div class="row">

<?php //tipo ?>
<div class="col-md-2 ">
													  <div class="form-group">
														
                                                        <select name="roctype[]" class="form-control" id="roctype[]">
<option value="0" selected>Seleccionar</option>
<option value="1" <? if($rowrocs['type'] == 1) echo "selected"; ?>>ROC</option>
<option value="2" <? if($rowrocs['type'] == 2) echo "selected"; ?>>Factura</option> 
</select>                                                        
		
             </div>
													</div>
<?php //No ROC ?>
<div class="col-md-2 ">
													  <div class="form-group">
														
                                                        <input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="<? echo $rowrocs['number']; ?>" <? //onkeypress="return justNumbers(event);" ?> onKeyUp="calculateTheTotal();">                                                        
		
             </div>
													</div>
<?php //Fecha ?>                                                    
<div class="col-md-2 ">
													  <div class="form-group">
													
                                                        <input name="roctoday[]" type="text" class="form-control date-picker" id="roctoday[]" value="<? if($rowrocs['today'] != "0000-00-00") echo date('j-n-Y', strtotime($rowrocs['today'])); ?>" readonly>                                                       
		
             </div>
													</div>
<?php //Monto ?>                                                    
<div class="col-md-2 ">
	<div class="form-group">
													
                                                        <input name="rocamount[]" type="text" class="form-control" id="rocamount[]" value="<? echo $rowrocs['amount']; ?>" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal();">                                                        
		
             </div>
													</div> 
<?php //Moneda ?>
<div class="col-md-2 ">
													  <div class="form-group">
														
                                                        <select name="roccurrency[]" class="form-control" id="roccurrency[]">
<option value="0" selected>Seleccionar</option>
<option value="1" <? if($rowrocs['currency'] == 1) echo "selected"; ?>>Cordobas</option>
<option value="2" <? if($rowrocs['currency'] == 2) echo "selected"; ?>>Dolares</option> 
</select>                                                        
		
             </div>
													</div>													
<?php //DELETE ?>


<input type="hidden" name="did[]" id="did[]" value="0"> 
</div>
<? } }else{ ?>
<div class="row">

<?php //tipo ?>
<div class="col-md-2 ">
													  <div class="form-group">
														
                                                        <select name="roctype[]" class="form-control" id="roctype[]">
<option value="0" selected>Seleccionar</option>
<option value="1">ROC</option>
<option value="2">Factura</option> 
</select>                                                        
		
             </div>
													</div>
<?php //No ROC ?>
<div class="col-md-2 ">
													  <div class="form-group">
														
                                                        <input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="" <? //onkeypress="return justNumbers(event);" ?> onKeyUp="calculateTheTotal();">                                                        
		
             </div>
													</div>
<?php //Fecha ?>                                                    
<div class="col-md-2 ">
													  <div class="form-group">
													
                                                        <input name="roctoday[]" type="text" class="form-control date-picker" id="roctoday[]" value="" readonly>                                                        
		
             </div>
													</div>
<?php //Monto ?>                                                    
<div class="col-md-2 ">
	<div class="form-group">
													
                                                        <input name="rocamount[]" type="text" class="form-control" id="rocamount[]" value="" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal();">                                                        
		
             </div>
													</div> 
<?php //Moneda ?>
<div class="col-md-2 ">
													  <div class="form-group">
														
                                                        <select name="roccurrency[]" class="form-control" id="roccurrency[]">
<option value="0" selected>Seleccionar</option>
<option value="1">Cordobas</option>
<option value="2">Dolares</option> 
</select>                                                        
		
             </div>
													</div>													
<?php //DELETE ?>


<input type="hidden" name="did[]" id="did[]" value="0"> 
</div>
<? } ?>             
<div id="rocwaiter">
</div>


<div class="col-md-1 ">
<button type="button" class="btn blue" onClick="addroc();">+</button>
 <br><br>&nbsp;
 </div>                                          
        </div>
		</div>
<div class="col-md-12 ">   
<h3 class="form-section">Forma de Pago</h3></div>  

<div class="col-md-4 ">
													  <div class="form-group">
														
                                                        <select name="method" class="form-control" id="method" onChange="showorhide(this.value);">
<option value="0" selected>Seleccionar</option>

<option value="1" <? if($rowrefund['method'] == 1) echo "selected"; ?>>Efectivo</option> 
<option value="2" <? if($rowrefund['method'] == 2) echo "selected"; ?>>Tarjeta de Crédito/Débito</option> 
<option value="3" <? if($rowrefund['method'] == 3) echo "selected"; ?>>Transferencia Bancaria</option>

</select>                                                        
		
		</div></div>
<script>
function showorhide(val){
	
	var thecdiv = document.getElementById('tctdcta');
	
	if(val == 0){
		thecdiv.style.display = "none";
	}
	else if(val == 1){
		thecdiv.style.display = "none";
	}
	else if(val == 2){
		thecdiv.style.display = "block"
	}
	else if(val == 3){
		thecdiv.style.display = "block"
	}
}
</script>
<div id="tctdcta" style="display: <? if(($rowrefund['method'] == 2) or ($rowrefund['method'] == 4)) echo 'block;'; else echo 'none;'; ?>">
<div class="col-md-12 ">   
<h3 class="form-section">Información Tarjetas de Crédito/Débito o Cuenta</h3></div>  
                                                         

                                                       <?php //Nombres ?>
<div class="col-md-5 ">
													  <div class="form-group">
														<label>Nombre del Titular:</label>
                                                        <input name="cardholder" type="text" class="form-control" id="cardholder" value="<? echo $rowrefund['cardholder']; ?>"  onKeyUp="calculateTheTotal();">                                                        
		
             </div>
													</div>
                                                      <?php //Apellidos ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Banco:</label>
                                                        <select name="cardbank" class="form-control" id="cardbank">
<option value="0" selected>Seleccionar</option>
<? 
$querybanks = "select * from banks order by name";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){ ?>
<option value="<? echo $rowbanks['id']; ?>" <? if($rowrefund['bank'] == $rowbanks['id']) echo "selected"; ?>><? echo $rowbanks['name']; ?></option> 
<? } ?>
</select>                                                        
		
             </div>
													</div>
                                                       <?php //Email ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>No. Cuenta/# Tarjeta:</label>
                                                        <input name="cardnumber" type="text" class="form-control" id="cardnumber" value="<? echo $rowrefund['account']; ?>" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal();">                                                       
		
             </div>
													</div>
                                                      <?php //No ROC ?>
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Vencimiento:</label>
                                                                                                               
		 <input name="cardexpiration" type="text" class="form-control" id="cardexpiration" value="<? echo $rowrefund['expiration']; ?>" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal();">                                                        
             </div>
													</div>
													</div>												     
     
 </div>    
 	
                                     
<div class="row"></div>           
                                                 
                                                 
                                                 
<h3 class="form-section"><a id="files"></a>Información Adicional</h3>
                                                      
<div id="assets_1">
<div class="col-md-12"><p>Esperando que seleccione el tipo de devolución</p></div>
</div>

<div id="assets_2" style="display: none;">
<div class="row">
<?php //Fecha de reserva ?>
<div class="col-md-4 " id="fReserva">
<div class="form-group">
<label>Fecha de Reserva:</label>
<input name="rsvp" type="text" class="form-control date-picker" id="rsvp" value="<? if(($rowrefund['rsvp'] != "") and ($rowrefund['rsvp'] != "0000-00-00")){ echo date('j-n-Y', strtotime($rowrefund['rsvp'])); } ?>" readonly> <? #echo $rowrefund['rsvp'] ; ?>                                                    </div>
</div>

<?php //Marca ?>
<div class="col-md-4 ">
<div class="form-group">
<label>Marca:</label>
<input name="brand" type="text" class="form-control" id="brand" value="<? echo $rowrefund['brand']; ?>" >                                                     </div>
</div>

<?php //Modelo ?>
<div class="col-md-4 ">
<div class="form-group">
<label>Modelo:</label>
<input name="model" type="text" class="form-control" id="model" value="<? echo $rowrefund['model']; ?>" >                                                     </div>
</div>


<div class="col-md-12"><h3 class="form-section"><a id="files"></a>Información del Vendedor</h3></div>
                                                       
                                                       


<div class="col-md-9">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

						
											<select name="seller" class="form-control  select2me" id="seller" data-placeholder="Seleccionar..." onChange="javascript:validateBill();">  

												<option value=""></option>
<?php $queryworkers = "select * from workers";
$resultworkers = mysqli_query($con, $queryworkers);
while($rowworkers=mysqli_fetch_array($resultworkers)){
?>
												<option value="<?php echo $rowworkers['code']; ?>"<?php if($rowrefund['seller'] == $rowworkers['code']) echo 'selected'; ?>><?php echo $rowworkers['code']." | ".$rowworkers['first']." ".$rowworkers['last']; ?></option>
                                                <?php } ?>  

												
											</select>

															<div title="Page 5">
															  <div>
															    <div>
															     <span class="help-block">

															 Ingrese código, nombre o parte de el para filtar los resultados. <i style=" color:#FF0004;">Si no le aparece un Colaborador, consulte con el area de Tesoría</i></span>
														        </div>
														      </div>
													    </div>
													  </div>

													</div>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Teléfono:</label>
                                                        <input name="sellerphone" type="text" class="form-control" id="sellerphone" value="<? if($rowrefund['seller_phone'] != "") echo $rowrefund['seller_phone']; ?>">                                                        
		
             </div>
													</div>
                                                  
													 
                                                      
                                                     
													 </div>												
</div>
<div id="assets_3" style="display: none;">
<div class="row">
	<?php //No parte ?>
<div class="col-md-4 ">

<label>No. de Parte:</label>
<input name="part_number" type="text" class="form-control" id="part_number" value="" onkeypress="return justNumbers(event);">                                           </div>
	</div>
</div>
<div id="assets_4" style="display: none;">
                  
<div class="row">

<?php //No. Informe de Negociación ?>
<div class="col-md-4 ">
<div class="form-group">
<label id="noLabel">No. Informe de Negociación:</label>
<input name="report" type="text" class="form-control" id="report" value="<? echo $rowrefund['report']; ?>" onkeypress="return justNumbers(event);" onKeyUp="calculateTheTotal();">                                                     </div>
</div>                                                                         
</div>    
</div>
<div id="assets_5" style="display: none;">
                  
<div class="row">

<?php //No. Informe de Negociación ?>
<div class="col-md-4 ">
<label>No. de Poliza:</label>
<input name="policy" type="text" class="form-control" id="policy" value="<? echo $rowrefund['policy']; ?>">
</div>
  

<?php //No. Informe de Negociación ?>
<div class="col-md-4 ">
<label>No. de Reclamo:</label>
<input name="claim" type="text" class="form-control" id="claim" value="<? echo $rowrefund['claim']; ?>">
</div>
                                                                      
                                                                                   
<?php //No. Informe de Negociación ?>
<div class="col-md-4 ">
<label>No. Placa:</label>
<input name="plate" type="text" class="form-control" id="plate" value="<? echo $rowrefund['plate']; ?>">
</div> 
	
</div>		
</div>
<div id="assets_6" style="display: none;">
                  
<div class="row">

<?php //No. Informe de Negociación ?>
<div class="col-md-3 ">
<div class="form-group">
<label>No. Contrato:</label>
<input name="ncontract" type="text" class="form-control" id="ncontract" value="<? echo $rowrefund['npmp']; ?>">                                                     </div>
</div>  

<?php //Marca ?>
<div class="col-md-3 ">
<div class="form-group">
<label>Marca:</label>
<input name="brand2" type="text" class="form-control" id="brand2" value="<? echo $rowrefund['brand']; ?>" >                                                     </div>
</div>

<?php //Modelo ?>
<div class="col-md-3 ">
<div class="form-group">
<label>Modelo:</label>
<input name="model2" type="text" class="form-control" id="model2" value="<? echo $rowrefund['model']; ?>" >                                                     </div>
</div>

	
<?php //Modelo ?>
<div class="col-md-3 ">
<div class="form-group">
<label>Chasis:</label>
<input name="chasis" type="text" class="form-control" id="chasis" value="<? echo $rowrefund['chasis']; ?>" >                                                     </div>
</div>
</div>    
</div>												
												

                                                                      
                                                                           
                                                                                                    
                                                       
                                                       
                                                       
                                                       
                                                       <h3 class="form-section"><a id="files"></a>Archivos</h3>
                                                       
													   <p id="requirements"><strong>Requisitos en base al tipo de devolución:</strong> En Espera a seleccionar tipo de devolución.</p>
                                                  
                                                  <div class="row"><!--/span--> 
                                                  
                                                  <div id="emails">
                                                    <?php 
													
	$queryfile2 = "select * from files where payment = '$_GET[id]' order by id asc";  
	$resultfile2 = mysqli_query($con, $queryfile2);
	$inc_files = 0;
	$filecount = 0;
	while($rowfile2 = mysqli_fetch_array($resultfile2)){
	$filecount++;
	if($filecount > 0){
		
	?>
                                                     <div class="col-md-10 ">
													  <div class="form-group">
	<input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfile2['id']; ?>">
<select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"<?php if(cleanLink($rowfile2['link']) == $rowfbox['url']) echo 'selected'; ?>><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>   
                                            
</div></div> 
                                                        
<?php 
//End while
$inc_files++;
}
//End if
}
 
?>
             <input type="hidden" name="fileid[]" id="fileid[]" value="0">	
             <div id="fid_<? echo $inc_files; ?>"><div class="col-md-10 ">
													  <div class="form-group">
													    <select name="file[]" class="form-control  select2me" id="file[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url'];  ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

</select><div class="row"></div></div></div>
             <div class="col-md-2 "><button type="button" class="btn red icn-only" onclick="eliminarFile(<? echo $inc_files; ?>);">-</button></div>
             </div> 
                                                      
                                                    </div>
                                                    <div class="row"></div>
             
              <div class="col-md-2 "><button type="button" class="btn blue icn-only" onclick="agregar();"><i class="fa fa-plus"></i></button>
             </div>                        
                                                     
             <? $inc_files++; ?>                      
                                                     
<script type="text/javascript">
var tfile = <? echo $inc_files; ?>;
function agregar(){ 
	setTimeout(reloadTemplate, 1500);
	$.post("payment-order-refund-reload-files.php", { variable: tfile }, function(data){ 
		$("#emails").append(data);
	});
	
	tfile++;
	 
	
}

function reloadTemplate(){
	Metronic.init();
}
function eliminarFile(fid){
	 $('#fid_'+fid).remove(); 
}
</script>
                                              </div>
                                              
                                              
                                         
                                            
                                              
   <div id="dbeneficiarie" style="display:none;">                                              
  <h3 class="form-section"><a id="beneficiaries"></a>Beneficiarios</h3>
  
  <div class="row">
  <div class="col-md-4">

													  <div class="form-group">

														<label class="control-label">Lista de Beneficiarios:</label>

															<select name="beneficiarie" class="form-control" id="beneficiarie">
<option value="0" selected>Seleccionar Proveedor</option>
															</select>

													  </div>

													</div>
                                                    </div>
</div>

<div class="row"></div><br>
<div class="row">
<div class="col-md-12 ">   
<h3 class="form-section">Linea de Negocio</h3></div>  

<div class="col-md-4 ">
													  <div class="form-group">
														
                                                        <select name="bline" class="form-control" id="bline">
<option value="0" selected>Seleccionar</option>
<? 
$querylines = "select * from blines order by name";
$resultlines = mysqli_query($con, $querylines);
while($rowlines = mysqli_fetch_array($resultlines)){
?>
<option value="<? echo $rowlines['id']; ?>" <? if($rowrefund['bline'] == $rowlines['id']) echo "selected"; ?>><? echo $rowlines['name']; ?></option> 
<? } ?>
</select>                                                        
		
		</div></div>
		</div>
		
		<div class="row"></div>


<?php 

$queryroutes = "select units.id, units.newCode, units.companyName, units.lineName, units.locationName, routes.headship from routes inner join units on routes.unitid = units.id where routes.worker = '$_SESSION[userid]' and routes.type = '1' and units.active = '1' order by routes.unit";
$resultroutes = mysqli_query($con, $queryroutes);
$numroutes = mysqli_num_rows($resultroutes);

if($numroutes == 1){ ?> 

  <h3 class="form-section"><a id="route"></a>Ruta de pago</h3> 
   <div class="row">
   <div class="col-md-12" id="routeFill" onLoad="javascript:reloadRouteView();"> 
   </div>
   <select name="theroute" class="form-control" id="theroute" style="display: none;"> 
                                                  
	<?php while($rowroutes=mysqli_fetch_array($resultroutes)){ 
		
	$thename = $rowroutes['companyName'].' '.$rowroutes['lineName'].' '.$rowroutes['locationName'];
	$thecode = $rowroutes['id'];
	
	if($rowroutes['headship'] > 0){
		$queryheadship = "select * from headship where id = '$rowroutes[headship]'";
		$resultheadship = mysqli_query($con, $queryheadship);
		$rowheadship = mysqli_fetch_array($resultheadship);
	}
	
?>
<option value="<?php echo $thecode; ?>,<?php echo $rowroutes['headship']; ?>" class="<?php echo $rowpconfirm['route']; ?>" <?php if($thecode == $rowpconfirm['routeid']) echo 'selected'; ?>><?php echo $rowroutes['newCode']." | ".$thename; if($rowroutes['headship'] > 0){ echo ' > '.$rowheadship['name']; } ?></option>
<?php } ?>
															</select> 
    </div>
	<?php
}
elseif($numroutes > 1){
	
	
	

?>
	  <h3 class="form-section"><a id="route"></a>Ruta de pago</h3>

<div class="row">
 
  <div class="col-md-4">
	  
	  <div class="form-group">
		  <label class="control-label">Lista de Rutas:</label>
		  <select name="theroute" class="form-control" id="theroute" onchange="javascript:reloadRouteView();"> 
                                                  
			<option value="0" selected>Seleccionar</option> 
			<?php while($rowroutes=mysqli_fetch_array($resultroutes)){ 
		
	$thename = $rowroutes['companyName'].' '.$rowroutes['lineName'].' '.$rowroutes['locationName'];
	$thecode = $rowroutes['id'];
	

	if($rowroutes['headship'] > 0){
		$queryheadship = "select * from headship where id = '$rowroutes[headship]'";
		$resultheadship = mysqli_query($con, $queryheadship);
		$rowheadship = mysqli_fetch_array($resultheadship);
	}
	
?>
<option value="<?php echo $thecode; ?>,<?php echo $rowroutes['headship']; ?>" class="<?php echo $rowpconfirm['route']; ?>" <?php if($thecode == $rowpconfirm['routeid']) echo 'selected'; ?>><?php echo $rowroutes['newCode']." | ".$thename; if($rowroutes['headship'] > 0){ echo ' > '.$rowheadship['name']; } ?></option>
<?php } ?>
															</select>

													  </div>

												
                                                    
 
<br>

												

													</div>
                                             
                                                    
                                                    
  <div class="col-md-8" id="routeFill">
  
  
  </div>
   
                                                
                                                    
                                                    </div>
                                                    
                                                 
                                                 
  
                                                    
                                                
<?php } ?>    

                                                       										<!--/row--><!--/row--></div>
                                                                                            
                                                                                            
                                                                                            <div id="row"><div class="col-md-12 ">
													  <div class="form-group">
														<label>Notas del Solicitante:</label>
                                                        <textarea name="notes" rows="2" class="form-control" id="notes"><?php echo $rowpconfirm['notes']; ?></textarea>
	
                                                          
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        
                                                      <!--/row--></div>
													</div></div> 


											<div class="form-actions right" style=" margin-top:100px;">

												<div style="margin-right: 10px;">
												
												
												<button type="button" class="btn default" onClick="javascript:cancelAction();" style="margin-right: 10px;"><i class="fa fa-undo"></i> Retornar</button>
												
											

										
                                              <button name="draft" id="draft" type="button" class="btn blue" onClick="javascript:saveDraft();"><i class="fa fa-save"></i> Guardar Borrador</button>
                                              <? //<button type="button" class="btn blue" name="print" id="print" onClick="javascript:printLetter();"><i class="fa fa-print"></i> Imprimir Carta</button> ?>
                                              <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Ingresar</button>
											  </div>
											    <input name="newbutton" type="hidden" id="newbutton" value="save">
											    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
												<input type="hidden" name="credit" id="credit" value="<?php echo $row['credit']; ?>">
											    <span class="form-actions right" style=" margin-top:100px;">
											    <input type="hidden" name="cut" id="cut" value="<?php echo $rowpconfirm['cut']; ?>">
											    </span>
											</div>

										</form>

										<!-- END FORM-->

									</div>

								</div>

							</div>

							

			<script>
			function saveDraft(){
			document.getElementById('newbutton').value = "draft";
			alert("Para Guardar borrador primero se validan todos loc campos del cliente.");
			var resultDraft = validateClient();
			if(resultDraft == false){
				//Do nothing
			}else{
				document.forms['porder'].submit();
			}
			
			}
			
			</script>
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
TableManaged.init();
});
</script>

    
<script type="text/javascript"> 


function reloadsconcept(nid,i){		
	$.post("reload-sconcepts.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept_"+i).innerHTML = data;
	});
	reloadsconcept2(0,i);
}

function reloadsconcept2(nid,i){		
	$.post("reload-sconcepts2.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept2_"+i).innerHTML = data;
	});
	
}

function help1(){
	alert('Si el monto no coinside con la cantidad en letras utilize esta opción.');
}

function cancelAction(){
	if (confirm("Esta Seguro de cancelar este ingreso?\n")==true){
			window.location = 'payments.php';
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

function clear1(){
	document.getElementById("retention1").value = ""; 
}

function clear2(){
	document.getElementById("retention2").value = "";
}

function deleteRow(id){
	//document.getElementById("roc"+id).style.display = 'none';
	var node = document.getElementById("roc"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}

function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}

function printLetter(){

	var sendprint = 1;
	var clienttype = document.getElementById("clienttype").value;
	var description = document.getElementById("description").value;
	var totalbill = document.getElementById("totalbill").value;
	
	var i = 0;
	var devtype = 0;
	var radios_devtype = document.getElementsByName('devtype');

	for(i=0;i<radios_devtype.length;i++){
 		if (radios_devtype[i].checked){
  			devtype = radios_devtype[i].value;
  			break;
 		}
	}

	var currency = 0;
	var radios_currency = document.getElementsByName('currency');

	for(i=0;i<radios_currency.length;i++){
 		if (radios_currency[i].checked){
  			currency = radios_currency[i].value;
  			break;
 		}
	}

	
	var strdocuments = "";
	var currenttype = "";
	var currentnumber = "";
	var currenttoday = "";
	var currentamount = "";
	var currentcurrency = "";
	
	var types = "";
	var numbers = "";
	var todays = "";
	var amounts = "";
	var currencys = "";
	
	var rocnumber =  document.getElementsByName('rocnumber[]');

	for(i=0;i<rocnumber.length; i++) { 
		//Reading Values
		currenttype =  document.getElementsByName('roctype[]')[i].value;
		currentnumber = document.getElementsByName('rocnumber[]')[i].value;
		currenttoday = document.getElementsByName('roctoday[]')[i].value;
		currentamount = document.getElementsByName('rocamount[]')[i].value;
		currentcurrency = document.getElementsByName('roccurrency[]')[i].value;
		
		//Validation
		if(currenttype == "0"){
			alert('Debe de ingresar el tipo del documento');
			sendprint = 0;
			document.getElementsByName('roctype[]')[i].focus();
			return false;
		}
		if(currentnumber == ""){
			alert('Debe de ingresar el numero del documento');
			sendprint = 0;
			document.getElementsByName('rocnumber[]')[i].focus();
			return false;
		}
		if(currenttoday == ""){
			alert('Debe de ingresar la fecha del documento');
			sendprint = 0;
			document.getElementsByName('roctoday[]')[i].focus();
			return false;
		}
		if(currentamount == ""){
			alert('Debe de ingresar el monto del documento');
			sendprint = 0;
			document.getElementsByName('rocamount[]')[i].focus();
			return false;
		}
		if(currentcurrency == "0"){
			alert('Debe de ingresar la moneda del documento');
			sendprint = 0;
			document.getElementsByName('roccurrency[]')[i].focus();
			return false;
		}
		
		//Making the vars
		types = types+currenttype+"|||";
		numbers = numbers+currentnumber+"|||";
		todays = todays+currenttoday+"|||";
		amounts= amounts+currentamount+"|||";
		currencys= currencys+currentcurrency+"|||";	
	} 
	 
	strdocuments = "&roctype="+encodeURIComponent(types)+"&rocnumber="+encodeURIComponent(numbers)+"&roctoday="+encodeURIComponent(todays)+"&rocamount="+encodeURIComponent(amounts)+"&roccurrency="+encodeURIComponent(currencys); 
	var theroute = document.getElementById("theroute").value;
	if(sendprint == 1){
		if(clienttype == 1){
		//Si es persona natural
		var ccode = document.getElementById("ccode").value;
		var cfirst = document.getElementById("cfirst").value;
		var clast = document.getElementById("clast").value;
		var caddress = document.getElementById("caddress").value;
		var cnid = document.getElementById("cnid").value;
		var ccity = document.getElementById("ccity").value;
		var cemail = document.getElementById("cemail").value;
		var cphone = document.getElementById("cphone").value; 
		
		window.location = "payment-order-refund-pdf.php?clienttype="+encodeURIComponent(clienttype)+"&ccode="+encodeURIComponent(ccode)+"&cfirst="+encodeURIComponent(cfirst)+"&clast="+encodeURIComponent(clast)+"&caddress="+encodeURIComponent(caddress)+"&cnid="+encodeURIComponent(cnid)+"&ccity="+encodeURIComponent(ccity)+"&cemail="+encodeURIComponent(cemail)+"&cphone="+encodeURIComponent(cphone)+"&devtype="+encodeURIComponent(devtype)+"&description="+encodeURIComponent(description)+"&totalbill="+encodeURIComponent(totalbill)+"&currency="+encodeURIComponent(currency)+"&theroute="+encodeURIComponent(theroute)+strdocuments; 
	}
		if(clienttype == 2){
		//Si es persona juridica
		var ccode2 = document.getElementById("ccode2").value;
		var cname = document.getElementById("cname").value;
		var cruc = document.getElementById("cruc").value;
		var cemail2 = document.getElementById("cemail2").value;
		var cphone2 = document.getElementById("cphone2").value;
		var caddress2 = document.getElementById("caddress2").value;
		var ccity2 = document.getElementById("ccity2").value;
		var crfirst = document.getElementById("crfirst").value;
		var crlast = document.getElementById("crlast").value;
		var crnid = document.getElementById("crnid").value;
		var cremail = document.getElementById("cremail").value;
		var crphone = document.getElementById("crphone").value;
		
		window.location = "payment-order-refund-pdf-enterprise.php?clienttype="+encodeURIComponent(clienttype)+"&ccode2="+encodeURIComponent(ccode2)+"&cname="+encodeURIComponent(cname)+"&cruc="+encodeURIComponent(cruc)+"&cemail2="+encodeURIComponent(cemail2)+"&cphone2="+encodeURIComponent(cphone2)+"&caddress2="+encodeURIComponent(caddress2)+"&ccity2="+encodeURIComponent(ccity2)+"&crfirst="+encodeURIComponent(crfirst)+"&crlast="+encodeURIComponent(crlast)+"&crnid="+encodeURIComponent(crnid)+"&cremail="+encodeURIComponent(cremail)+"&crphone="+encodeURIComponent(crphone)+"&devtype="+encodeURIComponent(devtype)+"&description="+encodeURIComponent(description)+"&totalbill="+encodeURIComponent(totalbill)+"&currency="+encodeURIComponent(currency)+"&theroute="+encodeURIComponent(theroute)+strdocuments;  
	}
	}

	
	
//End of function printLetter() 
}

function divRetention(){
	if(document.getElementById('retainer').checked == true){
		document.getElementById('retention1').value = 0; 	
		document.getElementById('retention1ammount').value = 0.00;
		document.getElementById('retention1').readOnly = true;
		document.getElementById('retention2').value = 0;
		document.getElementById('retention2ammount').value = 0.00;
		document.getElementById('retention2').readOnly = true;
		var p1 = 0;
		var p2 = 0; 
	}else{
	document.getElementById('retention1').readOnly = false;
	document.getElementById('retention2').readOnly = false;
	
	
	}
}


var roci = <?php if($roci > 0){ echo $roci; } else{ echo '1'; } ?>;
function addroc(){
	
	//var account = document.getElementsByName('accounts[]')[0].value;
	var selectoR =  document.getElementsByName('pertot');
	
	for (var i = 0, length = selectoR.length; i < length; i++) {
	
	if (selectoR[i].checked) {

		if(selectoR[i].value == 1){
			var readOnly1 = "";
			var readOnly2 = "readonly";
		}else{
			var readOnly1 = "readonly";
			var readOnly2 = "";
		}
}
	
	
}   	 

   var rocboxadd = '<div class="row" id="roc'+roci+'"><div class="col-md-2 "><div class="form-group"><select name="roctype[]" class="form-control" id="roctype[]"><option value="0" selected>Seleccionar</option><option value="1">ROC</option><option value="2">Factura</option> </select> </div></div><div class="col-md-2 "><div class="form-group"><input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="" onKeyUp="javascript:calculateTheTotal();" '+readOnly1+'></div></div><div class="col-md-2 "><div class="form-group"><input name="roctoday[]" type="text" class="form-control date-picker" id="roctoday[]" value=""  onKeyUp="javascript:calculateTheTotal();" readonly></div></div><div class="col-md-2 "><div class="form-group"><input name="rocamount[]" type="text" class="form-control" id="rocamount[]" value=""  onKeyUp="javascript:calculateTheTotal();" onkeypress="return justNumbers(event);" '+readOnly1+'></div></div><div class="col-md-2 "><div class="form-group"><select name="roccurrency[]" class="form-control" id="roccurrency[]"><option value="0" selected>Seleccionar</option><option value="1">Córdobas</option><option value="2">Dólares</option> </select></div></div><div class="col-md-1 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+roci+');">-</button></div></div><input type="hidden" name="did[]" id="did[]" value="0"></div>'; 
     roci++; 
	 $("#rocwaiter").append(rocboxadd);  
	 
	 Metronic.init(); 
	 ComponentsPickers.init();
	 //init metronic core components
	
  
}
 
function calculateTheTotal(){ 
	
	
	var mytotalstotal = numberFormat(document.getElementById('stotalbill').value);		

		var theammount = 0;
		
		for(i=0;i<document.getElementsByName('collaborator_ammount[]').length;i++){
				
				theammount += parseFloat(document.getElementsByName('collaborator_ammount[]')[i].value);
			
		}
		
		document.getElementById('stotalbill').value = theammount;
		document.getElementById('totalbill').value = theammount; 
  			
}
			
</script>

<?php include('fn-reloadnumbers.php'); ?>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
 <script type="application/javascript">
  
function reloadRouteView(){
	var myroute = document.getElementById('theroute').value; 
	var myroute2 = document.getElementById('theroute'); 
	var newcode = myroute2.options[myroute2.selectedIndex].text; 
    $.post("reload-route.php", { myvariable: myroute, newcode: newcode }, function(data){
		//alert(data); 
		document.getElementById('routeFill').innerHTML = data;
   }); 
} 
<? /*	 
function benType2(type){

document.getElementById('client-stage').innerHTML = '<div id="client-stage"><div class="row"><div class="col-md-4"><div class="form-group"><label class="control-label">Tipo de cliente</label><select name="clienttype" class="form-control" id="clienttype" onChange="javascript:clientType(this.value);"><option value="0" selected>Seleccionar</option><option value="1">Persona Natural</option> <option value="2">Persona Jurídica</option> </select></div></div><div class="row"></div><div id="ct_personal" style="display: none;"><div class="col-md-2 "><div class="form-group"><label>Código:</label><div class="input-group"><input name="ccode" type="text" class="form-control" id="ccode" value="" ><span class="input-group-addon"><a href="javascript:benType(1);"><i class="icon-reload"></i></a></span> </div></div></div><div class="col-md-5 "><div class="form-group"><label>Nombres:</label><input name="cfirst" type="text" class="form-control" id="cfirst" value="" readonly > </div></div><div class="col-md-5 "><div class="form-group"><label>Apellidos:</label><input name="clast" type="text" class="form-control" id="clast" value="" readonly > </div></div><div class="col-md-8 "><div class="form-group"><label>Dirección:</label><input name="caddress" type="text" class="form-control" id="caddress" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Ciudad:</label><input name="ccity" type="text" class="form-control" id="ccity" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Cédula:</label><input name="cnid" type="text" class="form-control" id="cnid" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Email:</label><input name="cemail" type="text" class="form-control" id="cemail" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Teléfono:</label><input name="cphone" type="text" class="form-control" id="cphone" value="" readonly > </div></div></div><div id="ct_business" style="display: none;"><div class="col-md-2 "><div class="form-group"><label>Código:</label><div class="input-group"><input name="ccode2" type="text" class="form-control" id="ccode2" value=""><span class="input-group-addon"><a href="javascript:benType(2);"><i class="icon-reload"></i></a></span></div> </div></div><div class="col-md-10 "><div class="form-group"><label>Nombre de la Empresa:</label><input name="cname" type="text" class="form-control" id="cname" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>No. RUC:</label><input name="cruc" type="text" class="form-control" id="cruc" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Email:</label><input name="cemail2" type="text" class="form-control" id="cemail2" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Teléfono:</label><input name="cphone2" type="text" class="form-control" id="cphone2" value="" readonly > </div></div><div class="col-md-8 "><div class="form-group"><label>Dirección:</label><input name="caddress2" type="text" class="form-control" id="caddress2" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Ciudad:</label><input name="ccity2" type="text" class="form-control" id="ccity2" value="" readonly > </div></div><div class="col-md-12"><h4>Información del Representante Legal</h4></div><div class="col-md-6 "><div class="form-group"><label>Nombres:</label><input name="crfirst" type="text" class="form-control" id="crfirst" value="" readonly > </div></div><div class="col-md-6 "><div class="form-group"><label>Apellidos:</label><input name="crlast" type="text" class="form-control" id="crlast" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Cédula:</label><input name="crnid" type="text" class="form-control" id="crnid" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Email:</label><input name="cremail" type="text" class="form-control" id="cremail" value="" readonly > </div></div><div class="col-md-4 "><div class="form-group"><label>Teléfono:</label><input name="crphone" type="text" class="form-control" id="crphone" value="" readonly > </div></div></div><br></div></div>';
if(type == 1){
	alert('Puede ingresar de nuevo el codigo del Cliente.');
}
if(type == 2){
	alert('Debe de ingresar un codigo.');
}

}
*/ ?>	 
function benType(type){

if(type == 1){
	var clientcode = document.getElementById('ccode').value; 
}else if(type == 2){
	var clientcode = document.getElementById('ccode2').value; 
}

if(clientcode == ""){
	alert('Usted debe de ingresar un codigo.');
}else{

$.post("payment-order-refund-clients-reload.php", { thetype: type, thecode: clientcode }, function(data){
	//alert(data); 
    document.getElementById('client-stage').innerHTML = data;
   
});

}
	
}

function clientType(ctype){

	if(ctype == "load"){
		ctype = document.getElementById('clienttype').value;
	}

	if(ctype == 1){
		document.getElementById('ct_personal').style.display = 'block';
		document.getElementById('ct_business').style.display = 'none'; 
		
		//Clean values
		document.getElementById('cfirst').value = "";
		document.getElementById('clast').value = "";
		document.getElementById('caddress').value = "";
		document.getElementById('ccity').value = "";
		document.getElementById('cnid').value = "";
		document.getElementById('cemail').value = "";
		document.getElementById('cphone').value = "";
		
		document.getElementById('cname').value = "";
		document.getElementById('cruc').value = "";
		document.getElementById('cemail2').value = "";
		document.getElementById('cphone2').value = "";
		document.getElementById('caddress2').value = "";
		document.getElementById('ccity2').value = "";
		document.getElementById('crfirst').value = "";
		document.getElementById('crlast').value = "";
		document.getElementById('crnid').value = "";
		document.getElementById('cremail').value = "";
		document.getElementById('crphone').value = "";
	}
	if(ctype == 2){
		document.getElementById('ct_business').style.display = 'block';
		document.getElementById('ct_personal').style.display = 'none';
		
		//Clean values
		document.getElementById('cfirst').value = "";
		document.getElementById('clast').value = "";
		document.getElementById('caddress').value = "";
		document.getElementById('ccity').value = "";
		document.getElementById('cnid').value = "";
		document.getElementById('cemail').value = "";
		document.getElementById('cphone').value = "";
		
		document.getElementById('cname').value = "";
		document.getElementById('cruc').value = "";
		document.getElementById('cemail2').value = "";
		document.getElementById('cphone2').value = "";
		document.getElementById('caddress2').value = "";
		document.getElementById('ccity2').value = "";
		document.getElementById('crfirst').value = "";
		document.getElementById('crlast').value = "";
		document.getElementById('crnid').value = "";
		document.getElementById('cremail').value = "";
		document.getElementById('crphone').value = "";
	
	}
	if(ctype == 0){
		document.getElementById('ct_business').style.display = 'none';
		document.getElementById('ct_personal').style.display = 'none';
		
		//Clean values
		document.getElementById('cfirst').value = "";
		document.getElementById('clast').value = "";
		document.getElementById('caddress').value = "";
		document.getElementById('ccity').value = "";
		document.getElementById('cnid').value = "";
		document.getElementById('cemail').value = "";
		document.getElementById('cphone').value = "";
		
		document.getElementById('cname').value = "";
		document.getElementById('cruc').value = "";
		document.getElementById('cemail2').value = "";
		document.getElementById('cphone2').value = "";
		document.getElementById('caddress2').value = "";
		document.getElementById('ccity2').value = "";
		document.getElementById('crfirst').value = "";
		document.getElementById('crlast').value = "";
		document.getElementById('crnid').value = "";
		document.getElementById('cremail').value = "";
		document.getElementById('crphone').value = "";
	}
}





</script>


  
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


<script>
function validateForm(){ 

	//reloadNumbers();
	var devtype = 0;
	var radios_devtype = document.getElementsByName('devtype');

	for(i=0;i<radios_devtype.length;i++){
 		if (radios_devtype[i].checked){
  			devtype = radios_devtype[i].value;
  			break;
 		}
	}
	

	if(devtype == 0){
		alert('Debe de seleccionar un tipo de devolucion');
		return false;
	}
		
	if((devtype == 1) || (devtype == 2)){
		var rsvp = document.getElementById("rsvp").value; 
		if(rsvp == ""){
			alert("Favor ingresar la fecha de la reservaci\u00F3n");
			return false;
		}
	}
	

	var currency = 0;
	var radios_currency = document.getElementsByName('currency');

	for(i=0;i<radios_currency.length;i++){
 		if (radios_currency[i].checked){
  			currency = radios_currency[i].value;
  			break;
 		}
	}	
	 
	validateClient();

	var description = document.getElementById("description").value;
	if(description == ""){
		document.getElementById("description").focus();
		alert('Usted debe de ingresar una descripcion del pago.');
		return false;
	}
	
		
	var totalbill = document.getElementById("totalbill").value;
	if(totalbill == 0){
		alert('Usted debe de ingresar un monto.');
		return false;
	}
	
	
	if(currency == 0){
		alert('Seleccionar la moneda.');
		return false;
	}
	
		
	var i=0;
	var i2=0;
	var i3=0; 
	for (var obj in document.getElementsByName('file[]')){
 		if (i<document.getElementsByName('file[]').length){
		file =  document.getElementsByName('file[]')[i].value;
		
		
		if(!/visor.php/.test(file)){
	
		}else{
			var i2=i2+1;
		}
		
		
	}
	
	i++;
}

	if(i2 == 0){
		alert('Usted debe proporcionar al menos un archivo en cada solicitud.');
		return false;
	}
	
		if(devtype == '6'){
		var ncontract = document.getElementById("ncontract").value; 
		if(ncontract == ''){
			document.getElementById("ncontract").focus();
		   alert('Debe de ingresar el no. de contrato');
		   return false;
		}
		var brand2 = document.getElementById("brand2").value; 
		if(brand2 == ''){
			document.getElementById("brand2").focus();
		   alert('Debe de ingresar la marca.');
		   return false;
		}
		var model2 = document.getElementById("model2").value; 
		if(model2 == ''){
			document.getElementById("model2").focus();
		   alert('Debe de ingresar el modelo.');
		   return false;
		}
		var chasis = document.getElementById("chasis").value; 
		if(chasis == ''){
			document.getElementById("chasis").focus();
		   alert('Debe de ingresar el chasis.');
		   return false;
		}
	}
	
	
	//Rocs y/o Facturas
	var rocnumber =  document.getElementsByName('rocnumber[]');

	for (i=0;i<rocnumber.length;i++){
		
		currenttype =  document.getElementsByName('roctype[]')[i].value;
		currentnumber = document.getElementsByName('rocnumber[]')[i].value;
		currenttoday = document.getElementsByName('roctoday[]')[i].value;
		currentamount = document.getElementsByName('rocamount[]')[i].value;
		currentcurrency = document.getElementsByName('roccurrency[]')[i].value;
		
		if(currenttype == 0){
			document.getElementsByName('roctype[]')[i].focus();
			alert('Usted debe de seleccionar un tipo de documento.');
			return false;
		}
		if(currentnumber == ""){
			document.getElementsByName('rocnumber[]')[i].focus();
			alert('Usted debe de ingresar un numero de documento.');
			return false;
		}
		if(currenttoday == ""){
			document.getElementsByName('roctoday[]')[i].focus();
			alert('Usted debe de seleccionar una fecha de documento.');
			return false;
		}
		if(currentamount == 0){
			document.getElementsByName('rocamount[]')[i].focus();
			alert('Usted debe de seleccionar una monto de documento.');
			return false;
		}

		if(currentcurrency == 0){
			document.getElementsByName('roccurrency[]')[i].focus();
			alert('Usted debe de seleccionar una moneda.');
			return false;
		}


	}
	
	if((devtype == 1) || (devtype == 2) || (devtype == 3) || (devtype == 7) || (devtype == 8)){ 
	
		var seller = document.getElementById("seller").value;
		if(seller == ""){
			alert('Usted debe de seleccionar un vendedor.');
			return false;
		} 
		
		var sellerphone = document.getElementById("sellerphone").value;
		if(sellerphone == ""){
			alert('Usted debe de ingresar un telefono par el vendedor.');
			return false;
		}
	}
	
	if(devtype == 4){
		var policy = document.getElementById("policy").value;
		if(policy == ""){
			alert('Usted debe de ingresar un numero de poliza.');
			return false;
		}
		var claim = document.getElementById("claim").value;
		if(claim == ""){
			alert('Usted debe de ingresar un numero de reclamo.');
			return false;
		}
	
	}
		
	//Lines
	var bline = document.getElementById("bline").value;
	if(bline == 0){
		document.getElementById("bline").focus();
		alert('Usted debe de seleccionar una Linea de Negocio.');
		return false;
	}
	
	//ROUTES
	var theroute = document.getElementById("theroute").value; 
		if(theroute == 0){
			document.getElementById("theroute").focus();
			alert('Usted debe de seleccionar una ruta de pago.');
			return false;
		
	}


} 

function validateClient(){
	var clienttype = document.getElementById("clienttype").value; 

	if(clienttype == 0){
		document.getElementById("clienttype").focus(); 
		alert('Usted debe de seleccionar el tipo de cliente.');
		return false;
	}	
	if(clienttype == 1){
		//Si es persona natural
		var ccode = document.getElementById("ccode").value;
		var cfirst = document.getElementById("cfirst").value;
		var clast = document.getElementById("clast").value;
		var caddress = document.getElementById("caddress").value;
		var cnid = document.getElementById("cnid").value;
		var ccity = document.getElementById("ccity").value;
		var cemail = document.getElementById("cemail").value;
		var cphone = document.getElementById("cphone").value;
		
		if(ccode == ""){
			document.getElementById("ccode").focus(); alert('Ingrese C\u00F3digo de Cliente.'); return false;
		}
		if(cfirst == ""){
			document.getElementById("cfirst").focus(); alert('Ingrese Nombre del Cliente.'); return false;
		}
		if(clast == ""){
			document.getElementById("clast").focus(); alert('Ingrese Apellido del Cliente.'); return false;
		}
		if(caddress == ""){
			document.getElementById("caddress").focus(); alert('Ingrese Direcci\u00F3n del Cliente.'); return false;
		}
		if(cnid == ""){
			document.getElementById("cnid").focus(); alert('Ingrese C\u00E9dula del Cliente.'); return false;
		}
		if(ccity == ""){
			document.getElementById("ccity").focus(); alert('Ingrese Ciudad del Cliente.'); return false;
		}
		if(cemail == ""){
			document.getElementById("cemail").focus(); alert('Ingrese email del Cliente.'); return false;
		}
		if(cphone == ""){
			document.getElementById("cphone").focus(); alert('Ingrese Tel\u00E9fono del Cliente.'); return false;
		}
		
		//End Persona Natural
	}
	if(clienttype == 2){
		//Si es persona juridica
		var ccode2 = document.getElementById("ccode2").value;
		var cname = document.getElementById("cname").value;
		var cruc = document.getElementById("cruc").value;
		var cemail2 = document.getElementById("cemail2").value;
		var cphone2 = document.getElementById("cphone2").value;
		var caddress2 = document.getElementById("caddress2").value;
		var ccity2 = document.getElementById("ccity2").value;
		var crfirst = document.getElementById("crfirst").value;
		var crlast = document.getElementById("crlast").value;
		var crnid = document.getElementById("crnid").value;
		var cremail = document.getElementById("cremail").value;
		var crphone = document.getElementById("crphone").value;
		
		if(ccode2 == ""){
			document.getElementById("ccode2").focus(); alert('Ingrese C\u00F3digo del Cliente.'); return false;
		}
		if(cname == ""){
			document.getElementById("cname").focus(); alert('Ingrese el Nombre de la Empresa.'); return false;
		}
		if(cruc == ""){
			document.getElementById("cruc").focus(); alert('Ingrese RUC del Cliente.'); return false;
		}
		if(cemail2 == ""){
			document.getElementById("cemail2").focus(); alert('Ingrese email del Cliente.'); return false;
		}
		if(cphone2 == ""){
			document.getElementById("cphone2").focus(); alert('Ingrese T\u00E9lefono del Cliente.'); return false;
		}
		if(caddress2 == ""){
			document.getElementById("caddress2").focus(); alert('Ingrese Direcci\u00F3n del Cliente.'); return false;
		}
		if(ccity2 == ""){
			document.getElementById("ccity2").focus(); alert('Ingrese Ciudad del Cliente.'); return false;
		}
		if(crfirst == ""){
			document.getElementById("crfirst").focus(); alert('Ingrese Nombres del Representante Legal.'); return false;
		}
		if(crlast == ""){
			document.getElementById("crlast").focus(); alert('Ingrese Apellidos del Representante Legal.'); return false;
		}
		if(crnid == ""){
			document.getElementById("crnid").focus(); alert('Ingrese C\u00E9dula del Representante Legal.'); return false;
		}
		/*if(cremail == 0){
			document.getElementById("cremail").focus(); alert('Ingrese Email del Representante Legal.'); return false;
		}*/
		if(crphone == ""){
			document.getElementById("crphone").focus(); alert('Ingrese T\u00E9lefono del Representante Legal.'); return false;
		}
		
		//End Persona Juridica 
	}
}


(function() {
   //Document.ready equivalent
	reloadRequirements("load");
	<? if($rowpconfirm['client'] > 0){ ?>
	clientType("load");
	benType(<? echo $rowclient['type']; ?>);
	
	<? } ?>
})();

</script>