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

					Bitacora de seguimiento <? //<small>Importar tipos de cambio</small> ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="followUp.php">Bitacora de seguimiento</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                            <li>

							<a href="#">Importar</a>
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
					  
					  
					 <form name="importa" method="post" action="<?php echo $PHP_SELF; ?>" enctype="multipart/form-data" >

                                                  <div class="col-md-2">

													  <div class="form-group">

														<label class="control-label">Nombre:</label>

															

														<input name="filetitle" type="text" required="required" class="form-control" id="filetitle" value="" >   

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
    </form>
  <div class="col-md-12"> <br>
<br>
  
<div class="note note-success">
						<p>1. Las extenciones de los archivos a subir deben de ser XLSX.<br></p>
						<p>
						  <?php
	 
	 
extract($_POST);


$filetitle = $_POST['filetitle'];

$action = $_POST['action'];

if ($action == "upload"){ 
	
	//cargamos el archivo al servidor con el mismo nombre
    //solo le agregue el sufijo bak_ 
    $archivo = $_FILES['excel']['name'];
    $tipo = $_FILES['excel']['type'];
    $destino = "files/follow/";
	if(!file_exists($destino)){
		mkdir($destino);
	}
	$destino = "files/follow/".$archivo;
    if(copy($_FILES['excel']['tmp_name'], $destino)){
		echo "Archivo Cargado Con Éxito";
		
	}else{
		echo "Error Al Cargar el Archivo";
	}if(file_exists($destino)){
		/** Clases necesarias */
		require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
		require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel/Reader/Excel2007.php';

     	$totime = date('H:i:s');
		$query = "insert into followupLog (today, totime, title, userid) values ('$today', '$totime', '$filetitle', '$_SESSION[userid]')";
		$result = mysqli_query($con, $query); 
		$fileid = mysqli_insert_id($con);
		
		// Cargando la hoja de cálculo
        $objReader = new PHPExcel_Reader_Excel2007();
        $objPHPExcel = $objReader->load($destino);
        $objFecha = new PHPExcel_Shared_Date();
        // Asignar hoja de excel activa
        $objPHPExcel->setActiveSheetIndex(0);
		$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
		
		$rOkay = 0;
		$rErr = 0;

		for ($i=2;$i<=$lastRow;$i++){ 
			
			$company = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
			switch($company){
				  default:
				  $company = 999999999;
				  break;
				  case "CASA PELLAS S,A.":
				  $company = 1;
				  break;
				  case "ALPESA":
				  $company = 2;
				  break;
				  case "VELOSA":
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
				  case "FIDEM":
				  $company = 12;
				  break;
				  
			  } 
			$bank = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
			switch($bank){
				default:
					$bank = 999999999;
					break;
				case 'BAC':
					$bank = '1';
					break;
				case 'BANPRO':
					$bank = '2';
					break;
				case 'BANCENTRO':
					$bank = '3';
					break;
				case 'BDF':
					$bank = '4';
					break;
				case 'FICOHSA':
					$bank = '5';
					break;
				case 'AVANZ':
					$bank = '6';
					break;
				case 'BAC FLORIDA BANK':
					$bank = '7';
					break;
				case 'JP Morgan':
					$bank = '8';
					break;
				case 'Citi Bank N.Y.':
					$bank = '9';
					break;
				case 'Wells Fargo':
					$bank = '10';
					break;
				case 'FIRST COMMONWEALTH BANK':
					$bank = '11';
					break;
			}
			$account = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
			$queryAccount = "select id from followupLogAccounts where account = '$account'";
			$resultAccount = mysqli_query($con,$queryAccount);
			$numAccount = mysqli_num_rows($resultAccount);
			if($numAcccount > 0){
				$rowAccount = mysqli_fetch_array($resultAccount);
				$account  = $rowAccount['id'];
			}
			else{
				$queryAccountInsert = "insert into followupLogAccounts (account) values ('$account')";
				$resultAccountInsert = mysqli_query($con,$queryAccountInsert);
				$account = mysqli_insert_id($con);
			
			}
			$type = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
			switch($type){
				default:
					$type = 999999999;
					break;
				case 'DEBITO BANCARIO':
					$type = '1';
					break;
				case 'CREDITO BANCARIO':
					$type = '2';
					break;
				case 'DEBITO CONTABLE':
					$type = '3';
					break;
				case 'CREDITO CONTABLE':
					$type = '4';
					break;
			}
			$account2 = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
			$queryAccount2 = "select id from followupLogAccounts2 where account = '$account2'";
			$resultAccount2 = mysqli_query($con,$queryAccount2);
			$numAccount2 = mysqli_num_rows($resultAccount2);
			if($numAccount2 > 0){
				$rowAccount2 = mysqli_fetch_array($resultAccount2);
				$account2  = $rowAccount2['id'];	
			}
			else{
				$queryAccountInsert2 = "insert into followupLogAccounts2 (account) values ('$account2')";
				$resultAccountInsert2 = mysqli_query($con,$queryAccountInsert2);
				$account2 = mysqli_insert_id($con);
			
			}
			$dday = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();		
			if($dday != ''){
				$dday = PHPExcel_Shared_Date::ExcelToPHP($dday);
				$dday = gmdate("Y-m-d", $dday);
				#$jd = GregorianToJD(10, 11, 1970);
				#$gregoriano = JDToGregorian($dday);
				#$dday = date("Y-m-d", strtotime($gregoriano));
				#$dday = date("Y-m-d", strtotime($dday)); 
			}
			#tipo de documento
			$doctype = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
			#constructor de catalogo 
			$queryDC = "select id from followupLogDc where name = '$doctype'";
			$resultDC = mysqli_query($con,$queryDC);
			$numDC = mysqli_num_rows($resultDC);
			if($numDC > 0){
				$rowDC = mysqli_fetch_array($resultDC);
				$doctype  = $rowDC['id'];
			}
			else{
				$queryDC2 = "insert into followupLogDc (name) values ('$doctype')";
				$resultDC2 = mysqli_query($con,$queryDC2);
				$doctype = mysqli_insert_id($con);
			
			}
			$doc = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();
			$explanation = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue();
			$amount = $objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue();
			$amount = str_replace(',','',$amount);
			$currency = $objPHPExcel->getActiveSheet()->getCell('K' . $i)->getCalculatedValue();
			switch($currency){
				case 'COR':
					$currency = 1;
					break;	
				case 'USD':
					$currency = 2;
					break;	
			}
			$originator = $objPHPExcel->getActiveSheet()->getCell('L' . $i)->getCalculatedValue();
			$batch = $objPHPExcel->getActiveSheet()->getCell('M' . $i)->getCalculatedValue();
			$conciliator = $objPHPExcel->getActiveSheet()->getCell('N' . $i)->getCalculatedValue();
			
			$query = "insert into followupLogContent (fileid, company, bank, account, type, account2, dday, doctype, doc, explanation, amount, currency, originator, batch, conciliator) values ('$fileid', '$company', '$bank', '$account', '$type', '$account2', '$dday', '$doctype', '$doc', '$explanation', '$amount', '$currency', '$originator', '$batch', '$conciliator')";
			$result = mysqli_query($con, $query); 
			if(!$result){
				$rErr++;
			}else{
				$rOkay++;
			}
			
			
	
		}
	}
    
    else{
		echo "Necesitas primero importar el archivo";
    }
 
	
  

	//una vez terminado el proceso borramos el archivo que esta en el servidor el bak_
    unlink($destino);
	#echo $sql;
	exit("<script>alert('ARCHIVO IMPORTADO CON EXITO, EN TOTAL $rOkay REGISTROS Y $rErr ERRORES'); window.location='followUpView.php?id=$fileid';</script>");
}

?>
			    </p>
					
                    
                        
     

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