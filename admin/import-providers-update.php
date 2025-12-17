<?php 

error_reporting(E_ALL);
error_reporting(-1);
include("session-providers.php");
	 
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





<!-- END THEME STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>


<!-- END PAGE LEVEL STYLES -->

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

					Proveedores <small>Importar Proveedores</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Opciones</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                            <li>

							<a href="providers.php">Proveedores</a>
                             <i class="fa fa-angle-right"></i>
                             </li>
                             <li>

							Importar Proveedores
                            
                             </li>
                           
						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">
                	<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

Formulario para importar archivos
							</div>

							

						</div>

						

					</div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">
					  
					  
					 <form name="importa" method="post" action="<?php echo $PHP_SELF; ?>" enctype="multipart/form-data" >
        
        <div class="col-md-9">
											<div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
												<div class="input-group input-large">
													<div class="form-control uneditable-input span3" data-trigger="fileinput">
														<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
														</span>
													</div>
													<span class="input-group-addon btn default btn-file">
													<span class="fileinput-new">
													Seleccionar Excel (.XLSX)</span>
													<span class="fileinput-exists">
													(Cambiar) </span>
													<input type="file" name="excel">
													</span>
													<a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
													Eliminar </a>
												</div>
											</div>
										</div>
 
        <div class="col-md-4"><input type='submit' name='enviar'  value="Importar"  />   <input type='button' name='ayuda'  value="Centro de Ayuda" onClick="openHelp();" />     <input type='button' name='ayuda'  value="Ver historial" onClick="historyView();" />
        <script>
		function openHelp(){
			window.open("help-import.php"); 
		}
		function historyView(){
			window.open("providers-history.php");
		}
        </script></div>
        <input type="hidden" value="upload" name="action" />
    </form>
  <div class="col-md-12"> <br>
<br>
  
<div class="note note-success">
						<p>Las extenciones de los archivos a subir deben de ser XLSX.</p>
					
                    
                        
    <?php
    extract($_POST);
	$campo = 0;
	$errores = 0;
	$updated = 0;
	
	$action = $_POST['action'];
    
	if($action == "upload"){
    	$archivo = $_FILES['excel']['name'];
    	$tipo = $_FILES['excel']['type'];
    	$destino = "files/" .date('d-m-Y h:i').'-'.$archivo;
		$filename = date('d-m-Y h:i').'-'.$archivo;
		$today = date('Y-m-d');
		$now = date('h:i:s'); 
		
		//$queryeupdate = "insert into providers_excel (filename, today, now, userid) values ('$filename', '$today', '$now', '$_SESSION[userid]')";
		//$resulteupdate = mysqli_query($con, $queryeupdate);  
	
    	if(copy($_FILES['excel']['tmp_name'], $destino)){
			echo "Archivo Cargado Con Éxito";	
		}else{
			echo "Error Al Cargar el Archivo";
		}
	
		if(file_exists($destino)){
			require_once('classes/PHPExcel.php');
			require_once('classes/PHPExcel/Reader/Excel2007.php');
			// Cargando la hoja de cálculo
        	$objReader = new PHPExcel_Reader_Excel2007();
        	$objPHPExcel = $objReader->load($destino);
        	$objFecha = new PHPExcel_Shared_Date();
        	// Asignar hoja de excel activa
        	$objPHPExcel->setActiveSheetIndex(0);
			$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
           
           //$queryuproviders = "update providers set active = '1'"; 
		   //$resultuproviders = mysqli_query($con, $queryuproviders);
		   
		    for ($i = 2; $i <=$lastRow ; $i++) { 
				
				//email provider
				$main_email = $objPHPExcel->getActiveSheet()->getCell('U' . $i)->getCalculatedValue();
				
				$query_this_provider = "select * from providers where email = '$main_email'";
				$result_this_provider = mysqli_query($con, $query_this_provider);
				$num_this_provider = mysqli_num_rows($result_this_provider); 
				
				if($num_this_provider > 0){
					$row_this_provider = mysqli_fetch_array($result_this_provider);
				}else{
					$query_this_provider_pre = "select * from providerscontacts where cemail = '$main_email'";
					$result_this_provider_pre = mysqli_query($con, $query_this_provider_pre);
					$row_this_provider_pre = mysqli_fetch_array($result_this_provider_pre);
					
					$query_this_provider = "select * from providers where id = '$row_this_provider_pre[provider]'";
					$result_this_provider = mysqli_query($con, $query_this_provider);
					$row_this_provider = mysqli_fetch_array($result_this_provider);
					
				}
				
				if($row_this_provider['id'] > 0){
					
				
				//Nombre Gerente General
				$name_manager = $objPHPExcel->getActiveSheet()->getCell('AF' . $i)->getCalculatedValue();
				$name_manager = strtolower($name_manager);
				$name_manager = ucwords($name_manager);
				//Telefono Gerente General
				$phone_manager = $objPHPExcel->getActiveSheet()->getCell('AG' . $i)->getCalculatedValue();
				//Email Gerente General
				$email_manager = $objPHPExcel->getActiveSheet()->getCell('AH' . $i)->getCalculatedValue();
				
				//if(($email_manager =! "") and ($email_manager != 1)){ 
					echo '<br>'.$query_manager = "insert into providerscontacts_update (provider, cname, cjob, cemail, cphone) values ('$row_this_provider[id]', '$name_manager', 'Gerente General', '$email_manager', '$phone_manager')";
					$result_manager = mysqli_query($con, $query_manager);
				//}
				
				 
				//Nombre Ejecutivo de Ventas
				$name_sales = $objPHPExcel->getActiveSheet()->getCell('AI' . $i)->getCalculatedValue();
				$name_sales = strtolower($name_sales);
				$name_sales = ucwords($name_sales);
				//Telefono Ejecutivo de Ventas
				$phone_sales = $objPHPExcel->getActiveSheet()->getCell('AJ' . $i)->getCalculatedValue();
				//Email Ejecutivo de Ventas
				$email_sales = $objPHPExcel->getActiveSheet()->getCell('AK' . $i)->getCalculatedValue();
				
				//if(($email_sales =! "") and ($email_sales != 1)){
					$query_sales = "insert into providerscontacts_update (provider, cname, cjob, cemail, cphone) values ('$row_this_provider[id]', '$name_sales', 'Ejecutivo de ventas', '$email_sales', '$phone_sales')";
					$result_sales = mysqli_query($con, $query_sales);
				//}
				
				
				//Nombre Credit and Collection
				$name_credit = $objPHPExcel->getActiveSheet()->getCell('AL' . $i)->getCalculatedValue();
				$name_credit = strtolower($name_credit);
				$name_credit = ucwords($name_credit);
				//Telefono Credit and Collection
				$phone_credit = $objPHPExcel->getActiveSheet()->getCell('AM' . $i)->getCalculatedValue();
				//Email Credit and Collection
				$email_credit = $objPHPExcel->getActiveSheet()->getCell('AN' . $i)->getCalculatedValue();
				
				//if(($email_credit =! "") and ($email_credit != 1)){
					$query_credit = "insert into providerscontacts_update (provider, cname, cjob, cemail, cphone) values ('$row_this_provider[id]', '$name_credit', 'Encargado de Credito y Cobro', '$email_credit', '$phone_credit')";
					$result_credit = mysqli_query($con, $query_credit);
				//}
				
				
				//Nombre accountant
				$name_accountant = $objPHPExcel->getActiveSheet()->getCell('AO' . $i)->getCalculatedValue();
				$name_accountant = strtolower($name_accountant);
				$name_accountant= ucwords($name_accountant);
				//Telefono accountant
				$phone_accountant= $objPHPExcel->getActiveSheet()->getCell('AP' . $i)->getCalculatedValue();
				//Email accountant
				$email_accountant = $objPHPExcel->getActiveSheet()->getCell('AQ' . $i)->getCalculatedValue();
				
					 
				//if($email_accountant =! ""){
					$query_accountant = "insert into providerscontacts_update (provider, cname, cjob, cemail, cphone) values ('$row_this_provider[id]', '$name_accountant', 'Contador', '$email_accountant', '$phone_accountant')";
					$result_accountant = mysqli_query($con, $query_accountant);
				//} 
					
				
				}
		
				
//End For			
}
//End file_exists
} 
//Si el archivo no existe
else{
	echo "Necesitas primero importar el archivo";
}    
        
echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS AGREGADOS, $updated ACTUALIZADOS Y $errores ERRORES</center></strong>";
//echo $sql1;
//una vez terminado el proceso borramos el archivo que esta en el servidor el bak_

//Aqui hacemos el cambio para que el archivo quede guardado.
//unlink($destino);
    }
    ?>

		</div></div>					

					

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



<?php ?>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<?php ?>

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="../assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/components-dropdowns.js"></script>

<script src="../assets/admin/pages/scripts/components-pickers.js"></script>
<script src="../assets/admin/pages/scripts/components-form-tools.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->


<script>
jQuery(document).ready(function() {       
// initiate layout and plugins
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
ComponentsPickers.init();
ComponentsDropdowns.init();
ComponentsFormTools.init();
});   
</script>

<!-- END JAVASCRIPTS --



</body>

<!-- END BODY -->

</html>