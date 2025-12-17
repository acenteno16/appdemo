<?php include("session-request.php"); ?>
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

<style type="text/css">
<!--
p.MsoNormal {
margin:0cm;
margin-bottom:.0001pt;
font-size:12.0pt;
font-family:Cambria;
}
-->
</style>
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

					Centro de Ayuda <?php //<small>Ordenes de pago</small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Centro de Ayuda</a>

							<i class="fa fa-angle-right"></i>

						</li>
                         	<li>

							Agregar solicitúd de devolución a cliente

							<i class="fa fa-angle-right"></i>

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

							Como ingresar una solicitúd de devolución a Cliente?

						  </div>

						

					  </div>

						<div class="portlet-body">

							<div class="table-container">

								
<video width="100%"  controls>
  <source src="videos/devoluciones.mp4" type="video/mp4">
Your browser does not support the video tag.
</video>

<?php /*

                              <p>Para ingresar una solicitud de pago, una vez iniciada la sesión, usted deberá de verificar que tiene agregado el perfíl de solicitud.</p>
                              <p>Para comprobar esto, debemos verificar si en el bloque menu  izquierdo tenemos la opcion &quot;Solicitudes de pago&quot;.</p>
                              <p>Dando click en &quot;Solicitudes de pago&quot; encontraremos el titulo &quot;Mis Solicitudes de pago&quot; y en la parte superior derecha de este, un botón llamado &quot;Nueva Solicitud de pago&quot;.</p>
                              
                              <p >Una vez que pulsamos dicho botón, ingresamos al formulario de &quot;Solicitudes de pago&quot; el cuál esta detallado a continuación.</p>
                              <p ><strong>INFORMACIÓN DEL PROOVEDOR/COLABORADOR</strong></p>
                              <ul>
                                <li><strong>ID de Pago:</strong> Es un número entero que identifica la solicitud de pago. Este ID es un consecutivo único generado automáticamente por el sistema. El ID de pago nos ayudará a localizar una solicitud de pago especifica fácimente.</li>
                                 <li><strong>Linko:</strong> Es campo de texto en el cual debemos de ingresar el link del archivo que generamos en el modulo de &quot;Arvhivos&quot;.</li>
                                <li><strong>Tipo de Beneficiario:</strong> Este selector nos permite indicar si el pago va dirigido a un Colaborador o a un Proveedor.</li>
                                <li><strong>Código / Nombre:</strong> Es un selector para indicar a cual Colaborador o Proveedor va dirigido el pago. Puede encontrar el colaborador o proveedor que desee introduciendo el código correspondiente a la persona, o introduciendo el nombre completo o parcial de esa persona para filtrar los resultados y elegir el deseado.</li>
                              </ul>
                              <p >&nbsp;</p>
                              <p ><strong>CONCEPTO DE PAGO</strong></p>
                              <ul>
                                <li><strong>Descripción:</strong> Es un espacio destinado para describir en general la solicitud de pago.</li>
                                <li><strong>Tipo:</strong> Es un selector de tipo de pago. Elige la opción que aplique al pago.</li>
                                <li><strong>Concepto:</strong> Es un selector de concepto de pago. Elige la opción que aplique al pago.</li>
                                <li><strong>Categoría:</strong> Es un selector de categoría de pago. Elige la opción que aplique al pago.</li>
                                <li><strong>Factura No:</strong> Campo destinado para colocar el número de factura que está ingresando.</li>
                                 <li><strong>Fecha de Factura: </strong>Es un campo calendario para indicar el día, mes y año correspondiente a la entrega de la factura por parte del proveedor/Colaborador.</li>
                                           <li><strong>Fecha de Factura: </strong>Es un campo calendario para indicar el día, mes y año correspondiente a la factura.</li>
                                           
                                                     <li><strong>Sub-total (que graba IVA): </strong>Es un campo para indicar El Sub-total que graba iva en la factura.</li>
                                                                                     <li><strong>Sub-total (exento de IVA): </strong>Es un campo para indicar El Sub-total que no graba iva en la factura.</li>
                                                                                     
                                                                                                                     <li><strong>Monto de alojamiento: </strong>Es un campo para indicar El monto de consumo en alojamiento de la factura que aplica el impuesto de intur.</li><br>
<li><strong>Monto INTUR: </strong>Es un campo resultado que nos indica el total a pagar sobre el impuesto de INTUR.</li><br>
<li><strong>IVA:</strong> Es el campo resultado que muestra el total de impuestos basados en el sub-total que graba IVA.</li><br>
<li><strong>Total:</strong> Es el campo resultado que nos muestra el total de la factura.</li><br>
<li><strong>Cantidad en Letra:</strong> Es el área que muestra la cantidad en letras colocada en el Monto. El sistema le brindará el monto en letras automáticamente.</li><br>
<li><strong>Exento IR:</strong> Es el campo para indicar el monto que esta exento de retenciones IR de la factura.</li>

<li><strong>Mismo Tipo?:</strong> Esta opción se selecciona siempre y cuando desea agregar otra factura de pago y desea que la factura a agregar contenga el mismo Tipo, Concepto y Categoría que la factura de pago anterior.</li><br>
<li><strong>Agregar Factura:</strong> Este botón lo selecciona cuando desea agregar otra factura de pago. Ya sea que haya seleccionado la opción de Mismo Tipo o no, esta opción de Agregar Factura puede oprimirla siempre y cuando desea agregar otra factura de pago.</li>

<li><strong>Subtotal Facturas:</strong> Es un indicador que suma automáticamente todos los Subtotales de cada factura y señala en el espacio el total de esa suma.</li>
<li><strong>IVA Factura(s):</strong> Es un campo resultado que suma automáticamente todos los Impuestos IVA de cada factura y y nos indica el total de la suma.</li>
<li><strong>INTUR Factura(s):</strong> Es un campo resultado que suma automáticamente todos los Montos de intur de cada factura y nos indica el total de la suma.</li>
<li><strong>Total Factura(s):</strong> Es un campo resultado que suma automáticamente todos los Totales de cada factura y nos infdica el total de la suma.</li>
<li><strong>Moneda:</strong> Es un selector radio para indicar el tipo de moneda aplica a este pago.</li>
                              </ul>
                              <p >&nbsp;</p>
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