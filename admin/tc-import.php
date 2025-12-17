<?php include("sessions.php");

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);
	 
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



<!-- END THEME STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

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

					Tipos de cambio <small>Importar tipos de cambio</small>

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

							<a href="tc.php">Tipos de cambio</a>
                             <i class="fa fa-angle-right"></i>
                             </li>
                             <li>

							Importar tipos de cambio
                            
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

Formulario para importar excel del Banco Central de Nicaragua
							</div>

							

						</div>

						

					</div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">
					  
					  
					 <form name="importa" method="post" action="tc-import.php" enctype="multipart/form-data" >
<div class="note note-regular">   
<? /*	
<div class="col-md-2">

													  <div class="form-group">

														<label class="control-label">Mes:</label>

															<select name="filemonth" class="form-control" id="filemonth">

<?php 

$thismonth = date('m');
?>
<option value="1" <?php if($thismonth == 1) echo 'selected'; ?>>Enero</option>
<option value="2" <?php if($thismonth == 2) echo 'selected'; ?>>Febrero</option>
<option value="3" <?php if($thismonth == 3) echo 'selected'; ?>>Marzo</option>
<option value="4" <?php if($thismonth == 4) echo 'selected'; ?>>Abril</option>
<option value="5" <?php if($thismonth == 5) echo 'selected'; ?>>Mayo</option>
<option value="6" <?php if($thismonth == 6) echo 'selected'; ?>>Junio</option>
<option value="7" <?php if($thismonth == 7) echo 'selected'; ?>>Julio</option>
<option value="8" <?php if($thismonth == 8) echo 'selected'; ?>>Agosto</option>
<option value="9" <?php if($thismonth == 9) echo 'selected'; ?>>Septiembre</option>
<option value="10" <?php if($thismonth == 10) echo 'selected'; ?>>Octubre</option>
<option value="11" <?php if($thismonth == 11) echo 'selected'; ?>>Noviembre</option>
<option value="12" <?php if($thismonth == 12) echo 'selected'; ?>>Diciembre</option>

															</select>

													  </div>

													</div>
<div class="col-md-2">

													  <div class="form-group">

														<label class="control-label">Año:</label>

															<select name="fileyear" class="form-control" id="fileyear">
<?php $thisyear = date('Y');
$lastyear = $thisyear-1;
$topyear = $thisyear+10;
for($c=$lastyear;$c<=$topyear;$c++){ ?>
<option value="<?php echo $c; ?>" <?php if($c == $thisyear) echo 'selected'; ?>><?php echo $c; ?></option>
<?php } ?>

															</select>

													  </div>

													</div>*/ ?>
<div class="col-md-2">

													  <div class="form-group">

														<label class="control-label">Fila:</label>

															

														<input name="filerow" type="text" required="required" class="form-control" id="filerow" value="" >   

													  </div>

													</div> 
			
	<div class="col-md-2">

													  <div class="form-group">

														<label class="control-label">Fecha inicial:</label>

															

														<input name="iDate" type="text" required="required" class="form-control date-picker" id="iDate" value="" readonly>
														  

													  </div>

													</div>
<div class="col-md-4">
																	<label class="control-label">Archivo:</label>
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
 <br>
        <div class="col-md-4"><input type='submit' name='enviar'  value="Importar"  />   <input type='button' name='ayuda'  value="Centro de Ayuda" onClick="openHelp();" />
        <script>
		function openHelp(){
			window.open("help-import.php"); 
		}
        </script></div>
        <input type="hidden" value="upload" name="action" />
	
	<div class="row"></div><br>
	<p>1. Las extenciones de los archivos a subir deben de ser XLSX.<br>
						  2. Debe de seleccionar el mes y el año al que se anidara la informacion<br>
						  3. En el campo fila debe de ingresar el numero de la fila que posee la primer taza de cambio.                        </p>
						<p> <?php
	 
	 
extract($_POST);

#$filemonth = $_POST['filemonth'];
$iDate = $_POST['iDate'];
$iDate = date('Y-m-d', strtotime($iDate)); 							
$filerow = $_POST['filerow'];

$action = $_POST['action'];

if ($action == "upload"){ 
	
    $archivo = $_FILES['excel']['name'];
    $tipo = $_FILES['excel']['type'];
    $destino = "files/" . $archivo;
    if(copy($_FILES['excel']['tmp_name'], $destino)){
		echo "Archivo Cargado Con Éxito";
		
	}else{
		echo "Error Al Cargar el Archivo";
	}
	
	
	if(file_exists($destino)){
		/** Clases necesarias */
		require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
		require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel/Reader/Excel2007.php';


        $objReader = new PHPExcel_Reader_Excel2007();
        $objPHPExcel = $objReader->load($destino);
        $objFecha = new PHPExcel_Shared_Date();
        $objPHPExcel->setActiveSheetIndex(0);
		$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
		

		for($i=$filerow;$i<=$lastRow;$i++){ 
			
			$tc = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
			$approved = 0;
			$err=0;
			if(($tc >= 0) and ($tc != '')){
				$queryTc = "insert into tcDraft (tc, today) values ('$tc', '$iDate')";
				$resultTc = mysqli_query($con, $queryTc); 
			}
			
			$iDate = date("Y-m-d",strtotime($iDate."+ 1 days"));  	
		}
	}
    //si por algo no cargo el archivo bak_ 
    else{
		echo "Necesitas primero importar el archivo";
    }
    $errores = 0; 

  
	
    echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS Y $errores ERRORES</center></strong>";

	//una vez terminado el proceso borramos el archivo que esta en el servidor el bak_
    unlink($destino);
	
}

?></p>
</div></form>
  <div class="col-md-12"> 
<br>
  


	
	
<?

$queryPre = "select * from tcDraft";
$resultPre = mysqli_query($con, $queryPre); 
$numPre = mysqli_num_rows($resultPre);
?>	
		</div>	
						
						
<div class="row"></div>
<br>
<br>
<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						Importación pendiente de procesar

							</div>
							<? if($numPre > 0){ ?>
                            <div class="actions">

								<a href="tc-import-pre-delete.php" class="btn default red-stripe">

								<i class="fa fa-trash-o"></i>

								<span class="hidden-480">

								Eliminar</span>

								</a>
								
								<a href="tc-import-pre-save.php" class="btn default blue-stripe">

								<i class="fa fa-save"></i>

								<span class="hidden-480">

								Guardar</span>

								</a>

								                                
                                

							</div>
							<? } ?>

						</div>

						

					</div>
						
						<? if($numPre > 0){ ?>
						<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="12%">

										 Fecha</th>

									<th width="62%">

										 TC</th>

									
								</tr>

								</thead>

								<tbody>

                                <?php 
								
									
									while($rowPre=mysqli_fetch_array($resultPre)){
									
								?>

								
								
                                <tr role="row" class="odd">
                                  <td class="sorting_1"><?php echo $rowPre["today"]; ?></td>
									<td><?php echo $rowPre["tc"]; ?></td>
                                  </tr>
                                
                                
                                
                                
                                
                                
                                <?php } //while ?>
                                </tbody>

								</table>
<? } else{ ?>
					<div class="note note-success">NOTA: No hay tipos de cambio pendientes de procesar.
						</div>
						<? } ?>
					

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

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script src="../assets/admin/pages/scripts/components-pickers.js"></script> 
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<script src="../assets/admin/pages/scripts/table-managed.js"></script>



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