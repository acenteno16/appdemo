<?php 

session_start();
$lasesion = 0;
if($_SESSION["authdata"] == "active"){
	include('../connection.php');
	$lasesion = 1; 
}
?><!DOCTYPE html>

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

<?php if($lasesion == 1){ include("header.php"); } ?>

<!-- END HEADER -->

<div class="clearfix">

</div>

<!-- BEGIN CONTAINER -->

<div class="page-container">

	<!-- BEGIN SIDEBAR -->

	<?php if($lasesion == 1){ include("side.php"); } ?>

	<!-- END SIDEBAR -->

	<!-- BEGIN CONTENT -->

	<?php if($lasesion == 1){ echo '<div class="page-content-wrapper">'; } ?>

		<?php //if($lasesion == 1){ echo ''; } ?>
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

							Aprobar solicitud de pago

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

							Como aprobar un pago?

						  </div>

						

					  </div>

						<div class="portlet-body">

							<div class="table-container">

								


                             							
<video width="100%"  controls>
  <source src="videos/payment-approve-new.mp4" type="video/mp4"> 
Your browser does not support the video tag.
</video>

<?php
/* <p>Para aprobar una solicitud, usted debe de haber iniciado sesión previamente. Si usted no sabe como iniciar sesión, visite nuestra página de ayuda de <a href="#">Como iniciar sesion?</a></p>
                              <p>Una vez iniciada sesión, como aprobador de pagos se le cargará en el menu lateral izquierdo una pestaña llamada &quot;Aprobado de pagos&quot; a como aparece en la siguiente gráfica.</p>
                              <p><img src="images/pestana-aprobado-de-pagos.jpg" width="100%" alt="" style="border:2px solid #FC0004;"/></p>
                              <p>&nbsp;</p>
                              <p>Una vez que se halla presionado el menu "Aprobar Pagos" nos llevara a la siguiente ventana.</p>
                              <p><img src="images/ventana-aprobado-de-pagos.jpg" width="100%" alt="" style="border:2px solid #FC0004;"/></p>
                              
                              
<p>&nbsp;</p>           
<p>En la ventana de aprobacion de pagos, usted encontrará a la izquierda el menú principal y en el cuerpo de contenido encontrará una tabla con la siguiente información:</p>
<p><strong>X nivel:</strong> Representará el nivel de aprobación cargado en nuestro perfil. Existen 3 niveles de aprobacion. Un perfilpuede tener cargado uno, dos o bien, los tres perfiles de aprobacion configurados en su perfil.</p>
<p><strong>ID:</strong> El consecutivo identificador del pago. Este ID es único y nos sirve para buscar una solicitud de pago especifica.</p>
<p><strong>Código:</strong> El	codigo del beneficiario del pago, ya sea que este pago sea dirigido a un proveedor o colaborador.</p>
<p><strong>Nombre:</strong> El nombre del beneficiario del pago, ya sea que este pago sea dirigido a un proveedor o colaborador.</p>
<p><strong>Total Pagar:</strong> El monto total a pagar al proveedor. Este monto es libre de retenciones.</p>
<p><strong>Vencimiento: </strong>Es la fecha limite de pago calculada por el sistema según la relacion de fecha de solicitud del pago y el plazo de credito de cada proveedor especifico guardado en la base de datos. Contiguo a este dato usted podrá ver un entero indicador de los días restantes para el vencimiento del pago. Una vez que este este en negativo este indicará los dias que lleva vencido el pago.</p>
<p><strong>Estado:</strong> Es el indicador de la etapa en donde se encuentra el pago.</p>
<p><strong>Opciones</strong>: Acá encontraremos 2 herramientas fundamentales en la aprobación de un pago. </p>
<p>Por una pate tenemos la herramienta <em>&quot;ver&quot;</em> que nos lleva a la ventana del pago; ventana en donde encontraremos toda la informacion del pago como solicitante, beneficiario, descripcion de pago, tipos de pago, conceptos de pago, categorias de pago, no de facturas, monto de facturas, calculos de impuestos, calculos de retenciones, moneda, tazas de cambio, archivos adjuntos a la solicitud, etc.</p>
<p><em>&quot;La opcion ver es la opción más recomendada para la aprobación de un pago puesto que aca podemos rectificar cada detalle del pago antes de aprobarlo.&quot;</em></p>
<p>Por otro lado tenemos la opción <em>&quot;aprobrar&quot;</em>, esta opción aprueba el pago de inmediato y no permite al aprobador de pagos revisar el pago previamente.</p>

<h3>Aprobar un pago con la opcion aprobar</h3>
<p>Para aprobar un pago con esta opcion, solo debemos de localizar el pago en la tabla de pagos pendientes de aprobacion y pulsamos el botón a como aparece en la siguiente gráfica.</p>
<p><img src="images/aprobar-pago-aprobar.jpg" width="100%"  alt="" style="border:2px solid #FC0004;"/></p>

<h3>Aprobar un pago con la opcion ver</h3>
<p>Para aprobar un pago con esta opcion, solo debemos de localizar el pago oen la tabla de pagos pendientes de aprobacion y pulsamos el botón <em>&quot;Ver&quot;</em> a como aparece en la siguiente gráfica.</p>
<p><img src="images/ventana-aprobado-de-pagos2.jpg" width="100%"  alt="" style="border:2px solid #FC0004;"/></p>
<p>Una vez en la ventana del visor de pagos, nos desplazamos hasta la parte inferior de la pagina en donde encontraremos el menu de opciones a como aparece en la siguiente gráfica.</p>
<p><img src="images/aprobado-pago.jpg" width="100%"  alt="" style="border:2px solid #FC0004;"/></p>
<p>En el menú opciones seleccionamos la opcion &quot;Si&quot; y luego presionamos el boton guardar.</p>


<p>&nbsp;</p>
*/ ?>
                          </div>

						</div>

					</div>

					<!-- End: life time stats -->

				</div>

			</div>

			<!-- END PAGE CONTENT-->

		<?php if($lasesion == 1){ echo "</div>"; } ?>

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