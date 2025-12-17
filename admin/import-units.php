<?php include("sessions.php"); ?>
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

					Unidades de Negocio <small>Importar UN</small>

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

							<a href="users.php">UN</a></li>
                           
						

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
													Cambiar </span>
													<input type="file" name="excel">
													</span>
													<a href="#" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
													Eliminar </a>
												</div>
											</div>
										</div>
 
      <div class="row"></div>
      <div class="col-md-4">
<input type='submit' name='enviar'  value="Importar"  />
        <input type='button' name='ayuda'  value="Centro de Ayuda" onClick="openHelp();" />
        <script>
		function openHelp(){
			window.open("help-import.php"); 
		}
        </script>
        <input type="hidden" value="upload" name="action" /></div>
    </form>
 <br>
<br>
 <div class="col-md-12">   
<div class="note note-success">
						<p>Las extenciones de los archivos a subir deben de ser XLSX.</p>
					</div></div>
                    
                        
     <?php
	$today = date("Y-m-d");
	$now = date('Y-m-d H:i:s');
    $now2 = date('H:i:s');

    extract($_POST);
	$action = $_POST['action'];
	$updates = 0;
	$errores = 0;
	$campo = 0; 
    if($action == "upload"){
        //cargamos el archivo al servidor con el mismo nombre
        //solo le agregue el sufijo bak_ 
        $archivo = $_FILES['excel']['name'];
        $tipo = $_FILES['excel']['type'];
        $destino = "files/" . $archivo;
        if (copy($_FILES['excel']['tmp_name'], $destino)){
            echo "Archivo Cargado Con Éxito"; 
        }
        else{
            echo "Error Al Cargar el Archivo";
        }
        if (file_exists($destino)){
            /** Clases necesarias */

            require_once('classes/PHPExcel.php');
            require_once('classes/PHPExcel/Reader/Excel2007.php');
            // Cargando la hoja de cálculo
            $objReader = new PHPExcel_Reader_Excel2007();
            $objPHPExcel = $objReader->load($destino);
            $objFecha = new PHPExcel_Shared_Date();
            // Asignar hoja de excel activa
            $objPHPExcel->setActiveSheetIndex(0);
			$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
            //conectamos con la base de datos  
           //...
            for ($i = 2; $i <=$lastRow ; $i++) { 
			  
			  $thecompany = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
			  switch($thecompany){
				  default:
				  $company = 999999999;
				  break;
				  case "CASA PELLAS, S.A":
				  $company = 1;
				  break;
				  case "A L P E S A":
				  $company = 2;
				  break;
				  case "V E L O S A":
				  $company = 3;
				  break;
				  case "MODULOS COMERCIALES":
				  $company = 4;
				  break;
				  case "ZONA FRANCA SAN GABRIEL, S.A":
				  $company = 5;
				  break;
				  case "ZONA FRANCA SAN RAFAEL, S.A":
				  $company = 6;
				  break;
				  case "MICROTEC":
				  $company = 7;
				  break;
				  case "TRADER, S.A DE C.V":
				  $company = 8;
				  break;
				  case "ORIENTAL MOTORS, S.A DE C.V":
				  $company = 9;
				  break;
				  case "KIPESA":
				  $company = 10;
				  break;
				  case "CAPESA":
				  $company = 11;
				  break;
				  
			  } 
			 
			  $unit = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
			  $unitname = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
			  //Matriz
			  $managua = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
			  
			  
			  $code2 = 0;
			  if($managua == 0){
				  $code2 = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
				  $code2 = intval($code2); 
			  }
			  
			  $inmanagua = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();
			  
			  $queryunit = "select * from units where code = '$unit'";
			  $resultunit = mysqli_query($con, $queryunit);
			  $numunit =  mysqli_num_rows($resultunit);
			  
			  //Si no existe
			  if($numunit == 0){
				  
				  $queryiu = "insert into units (name, code, code2, company, managua, inmanagua) values ('$unitname', '$unit', '$code2', '$company', '$managua', '$inmanagua')";
				  $resultiu = mysqli_query($con, $queryiu);
				  
				  $type = 0;
				  $oldquery = "";
				  $campo++;
				  
				  $oldquery = "NA";
				  $newquery = addslashes($queryiu);
			  	  $querytimes = "insert into unitstimes (unit, today, now, now2, userid, type, oldquery, newquery) values ('$unit', '$today', '$now', '$now2', '$_SESSION[userid]', '$type', '$oldquery', '$newquery')";
			  	  $resulttimes = mysqli_query($con, $querytimes);
				  
				  
			  }
			  //Si Existe
			  else{
			  	  //Reading the old information
				  $rowunit = mysqli_fetch_array($resultunit);
				  $needed = 0;
				  $neededby = "";
				  
				  if($rowunit['name'] != $unitname){ $needed = 1; $neededby.'name,'; }
				  if($rowunit['company'] != $company){ $needed = 1; $neededby.'company,'; }
				  if($rowunit['managua'] != $managua){ $needed = 1; $neededby.'managua,'; }
				  if($rowunit['inmanagua'] != $inmanagua){ $needed = 1; $neededby.'inmanagua,'; }
				  if($rowunit['code'] != $unit){ $needed = 1; $neededby.'code,'; }
				  if($rowunit['code2'] != $code2){ $needed = 1; $neededby.'code2,'; } 
				  
				  if($needed == 1){
				  	 //Making the old query
					 $oldquery = "update units set name = '$rowunit[name]', company='$rowunit[company]', managua='$rowunit[managua]', inmanagua='$rowunit[inmanagua]', code2='$rowunit[code2]' where code = '$rowunit[code]'";
					 
					//Update
				  	$queryiu = "update units set name = '$unitname', company='$company', managua='$managua', inmanagua='$inmanagua', code2='$code2' where code = '$unit'";
				  	$resultiu = mysqli_query($con, $queryiu); 
				  	$updates++;
					
					$oldquery = addslashes($oldquery);
					$newquery = addslashes($queryiu);
			  		$querytimes = "insert into unitstimes (unit, today, now, now2, userid, type, oldquery, newquery, comment) values ('$unit', '$today', '$now', '$now2', '$_SESSION[userid]', '$type', '$oldquery', '$newquery', '$neededby')";
			  		$resulttimes = mysqli_query($con, $querytimes);
				  }
				  
			  }
			  
			  
		
            }
        } 
        //si por algo no cargo el archivo bak_ 
        else {
            echo "Necesitas primero importar el archivo";
        }
        $errores = 0;
        //recorremos el arreglo multidimensional 
        //para ir recuperando los datos obtenidos
        //del excel e ir insertandolos en la BD
        echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS AGREGADOS, $updates ACTUALIZADOS Y $errores ERRORES</center></strong>";
        //una vez terminado el proceso borramos el archivo que esta en el servidor el bak_
        unlink($destino); 
    }
    ?>

							

					

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