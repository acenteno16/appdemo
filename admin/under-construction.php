<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

/*
include("sessions.php");
$id = $_GET['id'];
if($_SESSION['userid'] = "PCP0001"){
	header('location: payment-order24.php?id='.$id);
}else{
$pagename = "Ordenes de pago";
$estimated = "8/Junio/2016 8:00am";

include('under-construction.php');  
}
*/
?>
<?php //include("sessions.php"); ?> 
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
			<!-- BEGIN PAGE HEADER-->		

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					<?php echo $pagename; ?> <?php //<small>Ordenes de pago</small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#"><?php echo $pagename; ?></a>

						 <i class="fa fa-angle-right"></i>


						</li>
                        <li>

							<a href="#">Modulo en mantenimiento</a>

						

						</li>
                       

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

						<div class="portlet-title">

							<div class="caption">

							Modulo en mantenimiento</div>

						

					  </div>

						<div class="portlet-body">

							<div class="table-container">

								

<p>Este modulo se encuentra en mantenimiento. La fecha y hora estimada para finalizar esta actualizacion es: <?php echo $estimated; ?></p>
<?php /*

                              <p>Para aprobar una solicitud de pago, una vez iniciada la sesión, usted deberá de verificar que tiene agregado el perfíl de solicitud.</p>
                              <p>Para comprobar esto, debemos verificar si en el bloque menu  izquierdo tenemos la opcion &quot;Aprobar pagos&quot;.</p>
                              <p>Dando click en &quot;Aprobar pagos&quot; encontraremos el titulo &quot;Mis Aprobados de pago (X nivel)&quot; Esto depende del nivel de aprobación programado en su perfil. </p>
                              <p>En esta tabla se nos a nidaran los pagos pendientes de aprobación, ordenados por vencimiento, los pagos vencidos primero, luego los por vencerse y por ultimo los mas lejanos a vencerse.</p>
                              
                              <p ><img src="images/approve-img.jpg" width="1015" height="332" alt=""/></p>
                              <p ><strong>RETENCIONES</strong></p>
                              <ul>
                                <li><strong>Alcaldía (NIO C$): </strong>Es un espacio donde colocar el porcentaje que la Alcaldía estaría reteniendo en este pago. Al lado derecho de este espacio se encuentra un cuadro que indica en monto real en córdoba del porcentaje indicado de  la retención de la Alcaldía.</li>
                                <li><strong>IR (NIO C$):</strong> Es un espacio donde colocar el porcentaje del Impuesto sobre la Renta que se estaría reteniendo en este pago. Al lado derecho de este espacio se encuentra un cuadro que indica en monto real en córdoba del porcentaje indicado de  la retención del Impuesto sobre la Renta.</li>
                                <li><strong>No Retenedor/Exento:</strong> Esta opción se selecciona cuando no se está aplicando ninguna retención al pago. Al seleccionar esta opción, el sistema automáticamente bloquea todos los indicadores de retención.</li>
                              </ul>
                              <p >&nbsp;</p>
                              <p ><strong>PAGO A PROVEEDOR</strong></p>
                              <ul>
                                <li><strong>Monto a Pagar:</strong> Este dato es procesado  automáticamente por el sistema tomando en cuenta toda la información anteriormente ingresada. La cantidad indicada en este cuadro es la que se le deberá pagar al Colaborador o Proveedor indicado en la solicitud.</li>
                              </ul>
                              <p >&nbsp;</p>
                              <p ><strong>ARCHIVOS</strong></p>
                              <ul>
                                <li>Campo izquierdo: Es un espacio para indicar el enlace que nos proporciona el modulo de &quot;Archivos&quot;.</li>
                                <li>Campo derecho: Es un espacio para indicar rl titulo del enlace agregado.</li>
                                <li>Botón con signo +: Utiliza este botón para agregar más archivos.</li>
                              </ul>
                              <p >&nbsp;</p>
                               <p ><strong>DISTRIBUCION DEL PAGO</strong></p>
                              <ul>
                                <li><strong>Selector de distribucion de pago:</strong> Es un selector para indicar si el pago va a ser distribuido etre distintas unidades de negocio.</li>
                                <li>Al seleccionar si en el selector de distribucion de pago, se nos activará un formulario con loa campos unidad, procentaje y total. En la unidad de negocio, nosotros ingresaremos el codigo de la unidad de negocio a la que queremos cargar y en los dos últimos campos en la parte de arriba tendremos un selector de radio, con el cual nosotros decidiremos la distribucion por porcentaje o por monto.<br>
Cabe destacar que tenemos un boton + con el cual podemos agregan N unidades de negocio y distribuir el pago entre todas la unidades de negocios listadas en el formulario.</li>
                              </ul>
                              <p >&nbsp;</p>
                              <p ><strong>RUTA DE PAGO</strong></p>
                              <ul>
                                <li><strong>Lista de Rutas:</strong> Es un selector de rutas de pago donde puede elegir por cual ruta o área se le realizará el pago al Proveedor o Colaborador.</li>
                                <li><strong>Lista de Jefatura:</strong> Es un selector de jefaturas donde puede elegir por medio de cual jefatura o área se le realizará el pago al Proveedor o Colaborador.</li>
                              </ul><br>
                                <p><strong>OPCIONES DE FORMULARIO</strong></p>
                                <ul>
                                <li><strong>Cancelar:</strong> Este botónla solicitud de pago.</li>
                                <li><strong>Guardar Borrador:</strong> Este botón permite que se guarde la información que introdujo sin enviarla a su supervisor; por tanto le permite volver y realizar ajustes o correcciones.</li>
                                <li><strong>Ingresar:</strong> Este botón envía la solicitud de pago ingresada al superior encargado de su aprobación.</li>
                              </ul>
<p>&nbsp;</p>       
*/ ?>                
                                	

						  </div>

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