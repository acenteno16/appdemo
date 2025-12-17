<?php 

#ini_set('display_errors', 1); 
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require("sessions.php");
$thefile = '';
require('functions.php');

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

		
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->


			<!-- BEGIN PAGE HEADER-->		



			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Archivos <?php //<small>Órdenes de pago</small>  ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="files.php">Archivos</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        
                        <li>

							Visor

						

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

								Mis archivos

							</div>

							

						</div>

						
                        
                        
                                
                        <div class="portlet-body">

							<div class="table-container"> 
<?php 
$newkeyArr = [];

$key = sanitizeInput($_GET['key'], $con);
$newkey = base64_decode($key);
parse_str($newkey, $newkeyArr);

if (!isset($newkeyArr['file']) || !isset($newkeyArr['userid'])) {
    die("Datos inválidos.");
}

$fileId = sanitizeInput($newkeyArr['file'], $con);
$userId = sanitizeInput($newkeyArr['userid'], $con);

$query = $con->prepare("SELECT * FROM filebox WHERE id = ?");
$query->bind_param("i", $fileId);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();
								
$queryworker = $con->prepare("select first, last, unit from workers where code = ?");
$queryworker->bind_param("s", $userId);
$queryworker->execute();
$resultworker = $queryworker->get_result();
$rowworker = $resultworker->fetch_assoc();								

?>
<p>
<strong>FID:</strong> <? echo $newkeyArr['file']; ?><br>
<strong>Cargado por: </strong><?php echo $rowworker['first']." ".$rowworker['last']; ?><br>
<? /*<strong>Unidad de Negocio:</strong> <?php echo $rowunit['code']." | ".$rowunit['name']; ?><br>*/ ?>
<strong>Nombre del archivo:</strong> <?php echo $row['filename']; ?><br>
<strong>Titulo:</strong> <?php echo $row['title']; ?><br>
<strong>Descripción:</strong> <?php echo $row['description']; ?><br>
<strong>Fecha de carga:</strong> <?php echo date('d-m-Y',strtotime($row['today'])); ?><br>
<strong>Hora:</strong><?php echo date('h:i a', strtotime($row['now'])); ?><br><br>
<?php 
 
$allPayments = array();
$payments = array();
$queryfile = "select payment from files where link like '%$key%'";
$resultfile = mysqli_query($con, $queryfile);
$numfile = mysqli_num_rows($resultfile);
if($numfile > 0){
    while($rowfile = mysqli_fetch_array($resultfile)){
		
		$queryPaymentCheck = "select id, approved from payments where id = '$rowfile[payment]'";
    	$resultPaymentCheck = mysqli_query($con, $queryPaymentCheck);
    	$rowPaymentCheck = mysqli_fetch_array($resultPaymentCheck);
		if($rowPaymentCheck['approved'] == 2){
			$allPayments[] = $rowPaymentCheck['id'];
		}else{
			$payments[] = $rowPaymentCheck['id'];
		}
		
	}
} 

#if((sizeof($payments) == 0) and (($row['user'] == $_SESSION['userid']) or ($_SESSION['admin'] == 'active'))){ 
if($_SESSION['admin'] == 'active'){ ?>
 <button type="button" class="btn red" onClick="javascript:deleteFile(<?php echo $row['id']; ?>);"><i class="fa fa-trash-o"> </i> Eliminar este archivo</button></p><br> 
<script>
function deleteFile(nid){
	if(confirm('Esta seguro de eliminar el archivo?') == true){
		window.location = 'visor-delete-files.php?id='+nid;
	}
}
</script>
<?php } ?> 
 
 <?php if(sizeof($payments) > 1){ ?>
 <p>Este Archivo se encuentra en más de una solicitud de pago vigente. Favor consultar con el Administrador.</p>
 <?php } if(sizeof($payments) > 0){ ?><p>IDs: <?php echo implode(", ", $payments); ?></p>
 <?php } ?>
	 
<?  
 
 if(sizeof($payments) > 0){
	 if($numofile > 1){ 
 ?>
 <p>Lista de archivos del pago</p>
 <p>
 <?php //start while 
 while($rowofile=mysqli_fetch_array($resultofile)){	
$url = urlProcessor($rowofile['link'],1,0);
?>
<a href="<?php echo $url; ?>">> <?php echo $rowofile['name']; ?></a><br> 
<?php }
 //end while 
 ?>
 </p>
 <?php }
 }//hasta aqui el de 1 solo pago. ?>
 <?php


if(($thefile == '') or (!file_exists($thefile))){
	$thefile = "files/nofile.pdf";
}
								/*
if(($_SESSION['email'] == "jairovargasg@gmail.com") or ($_SESSION['email'] == "hgaitan@casapellas.com")){
	$thefile = $_GET['key'];
	$thefile = base64_decode($thefile);
	$newkey = parse_str($thefile, $newkeyArr);
	$query = "select * from filebox where id = '$newkeyArr[file]'"; 
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result); 
	$url = urlProcessor($thefile,1,0);
	$thefile = urlProcessor(str_replace(' ','%20',$row['name']),3,$row['user']);
	echo $thefile = str_replace('../files/','',$thefile);
	echo '<br><br>';	
	#echo $thefile = str_replace('../files/','//home/getpaycp/files/',$thefile);
} */

$fE = explode('.',$row['filename']);
$fES = sizeof($fE)-1;								
$fE[$fES];
if(($fE[$fES] == 'pdf')	or ($fE[$fES] == 'PDF')){ ?>
	<iframe src="efile.php?key=<? echo $_GET['key']; ?>" style="width:100%; height:900px;" frameborder="0"></iframe> 
								<? #include('efile.php'); ?>
<? } 
if(($fE[$fES] == 'xls')	or ($fE[$fES] == 'xlsx')){ ?>								
	<button type="button" class="btn blue" onClick="javascript:window.location='efile.php?key=<? echo $_GET['key']; ?>';"><i class="fa fa-download"> </i> Descargar este archivo</button>			
	<? /*<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=https://getpaycp.com/admin/efile.php?key=<? echo $_GET['key']; ?>' width='100%' height='565px' frameborder='0'> </iframe>*/ ?>
								
<? } ?>

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

<?php /*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ ?>

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


<script src="../assets/admin/pages/scripts/components-pickers.js"></script>

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

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>
<?php 
/*
function urlProcessor($furl,$fprocess,$fuser = null){
	switch($fprocess){
		case 1:
		//GET THE ZmlsZT0xJnVzZXJpZD1QQ1AwMDAx
		$farray = explode('/',$furl);
		$fsize = sizeof($farray);
		$fsize--;
		$furl = $farray[$fsize];
		$furl = str_replace('.pdf','',$furl);
		$furl = str_replace('.PDF','',$furl);
		$foutput = $furl;
		break;
		case 2:
		//GET THE FULL URL
		$foutput = 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$furl;
		break;
		case 3:
		$fchar = urlProcessor($furl, 1);
		$foutput = "../files/folder_".$fuser."/".str_replace(' ','%20',$fchar).".pdf";
		break; 
	}
	
	return $foutput; 
}
*/
?>