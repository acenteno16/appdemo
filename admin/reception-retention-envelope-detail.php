<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("session-reception.php");

$btype = $_GET['btype'];
$ben = $_GET['ben'];

if($btype == 1){
	$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$ben'"));
	$providername = $rowuser['code']." | ".$rowuser['name'];
	$providertype = "Proveedor";
}else{
	$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$ben'"));
	$providername = $rowuser['code']." | ".$rowuser['first'].' '.$rowuser['last'];
	$providertype = "Colaborador";
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

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:onFocus();">

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

					Remisiones de Retenciones <small>Creacion/Relleno de Sobres </small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="reception-home.php">Recepcion</a>
                            <i class="fa fa-angle-right"></i>
                            </li>
                            <li>

							<a href="reception-retention-envelope.php">Pendientes de ensobrar</a> 
                            <i class="fa fa-angle-right"></i> 
                            </li>
                           
                            <li>

							<a href="#">Inclusión</a>
                          
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

								
	
<div class="row">
				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">
						
						<div class="note note-regular"> 
                             <h3 class="form-section">Información del <? echo $providertype; ?></h3>
                            
							<p><strong>Nombre:</strong> <?php echo $providername; ?><br>
                            <strong>Dirección:</strong> <?php echo $rowuser['address']; ?> <br>
                            <strong>Email:</strong> <?php echo $rowuser['email']; ?> <br>
                            <? 
							if($rowuser['location'] > 0){ 
							$querylocation = "select * from providerslocation where id = '$rowuser[location]'";
							$resultlocation = mysqli_query($con, $querylocation);
							$rowlocation = mysqli_fetch_array($resultlocation);
							?>
							<strong>Ubicación:</strong> <?php echo $rowlocation['name']; ?> <a href="?btype=<? echo $_GET['btype']; ?>&ben=<? echo $_GET['ben']; ?>&edit=1">[Editar]</a> <br> 
							<? }
							if(($rowuser['location'] == 0) or ($_GET['edit'] == 1)){ ?> 
                            <form enctype="multipart/form-data" method="post" action="reception-retention-remission-delivery-detail-location.php"> 
                            
<input type="hidden" id="btype" name="btype" value="<? echo $_GET['btype']; ?>">
<input type="hidden" id="ben" name="ben" value="<? echo $_GET['ben']; ?>">
<div class="form-group"> 

	<label class="control-label">Ubicación:</label>

						
											<select name="location" class="form-control" id="location" data-placeholder="Seleccionar...">

												<option value="">Seleccionar</option>
 											<?php 
											$queryproviders = "select * from providerslocation order by id";
											$resultproviders = mysqli_query($con, $queryproviders);
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["name"]; ?></option>
                                            <?php 
												
												}
												
											?>

												

											</select><br>

<button type="submit" class="btn blue"><i class="fa fa-edit"></i> Actualizar</button> 


													</div>
							</form>
                            <? } ?>
                             </p>

							

</div>      
											
												
												

						<? 
						
						$query_envelope = "select * from retentionenvelope where provider = '$ben' and type = '$btype' and status <= '1'";
						$result_envelope = mysqli_query($con, $query_envelope);
						$num_envelope = mysqli_num_rows($result_envelope);
						if($num_envelope > 0){
							$row_envelope = mysqli_fetch_array($result_envelope);
							$id_envelope = $row_envelope[0];
						}else{
							$today = date('Y-m-d');
							$now = date('H:i:s');
							$query_envelopeinsert = "insert into retentionenvelope (today, now, provider, type) values ('$today', '$now', '$ben', '$btype')";
							$result_envelopeinsert = mysqli_query($con, $query_envelopeinsert);
							$id_envelope = mysqli_insert_id($con);
							

							//Stages
							//1- Creado
							//2- Inclusion de Retenciones
							//3-Remisionado
							//4 Regresado

							$stage = 1;
							$gp_comments = "Enhorabuena, el sobre ha sido creado.";

							$querytimes = "insert into retentionenvelopetimes (envelope, today, now, userid, stage, comment, reason) values ('$id', '$today', '$now', '$userid', '$stage', '$gp_comments', '$comments')"; 
							$resulttimes = mysqli_query($con, $querytimes);


							$query_envelope = "select * from retentionenvelope where id = '$id_envelope'";
							$result_envelope = mysqli_query($con, $query_envelope);
							$row_envelope = mysqli_fetch_array($result_envelope); 
						} 
						
						$query_envelopecontentir = "select irretention.number from retentionenvelopecontent inner join irretention on retentionenvelopecontent.retention = irretention.id  where retentionenvelopecontent.type= '2' and retentionenvelopecontent.envelope = '$id_envelope' order by irretention.id asc";
						$result_envelopecontentir = mysqli_query($con, $query_envelopecontentir);
						$num_envelopecontentir = mysqli_num_rows($result_envelopecontentir);
						if($num_envelopecontentir > 0){
							while($row_envelopecontentir=mysqli_fetch_array($result_envelopecontentir)){
								$retention_ir.= $row_envelopecontentir['number'].", ";
							}
							$retention_ir = substr($retention_ir,0,-2);
						}else{
							$retention_ir = "Sin retenciones IR";
						}
						
						/*
						$query_envelopecontentimi = "select hallretention.serial, hallretention.number from retentionenvelopecontent inner join hallretention on retentionenvelopecontent.retention = hallretention.id where retentionenvelopecontent.type = '1' and retentionenvelopecontent.envelope = '$id_envelope' order by hallretention.id asc"; 
						$query_envelopecontentimi = "select hallretention.serial, hallretention.number from retentionenvelopecontent inner join hallretention on retentionenvelopecontent.retention = hallretention.id where retentionenvelopecontent.type = '1' and retentionenvelopecontent.envelope = '$id_envelope' order by hallretention.id asc"; 
						$result_envelopecontentimi = mysqli_query($con, $query_envelopecontentimi);
						$num_envelopecontentimi = mysqli_num_rows($result_envelopecontentimi);
						*/
						
						$query_envelopecontentimi = "SELECT hallsretention.serial, hallsretention.number 
                             FROM retentionenvelopecontent 
                             INNER JOIN hallsretention 
                             ON retentionenvelopecontent.retention = hallsretention.id 
                             WHERE retentionenvelopecontent.type = ? 
                             AND retentionenvelopecontent.envelope = ? 
                             ORDER BY hallsretention.id ASC";

						$stmt_envelopecontentimi = $con->prepare($query_envelopecontentimi);

						if (!$stmt_envelopecontentimi) {
    						die("Error en la preparación de la consulta: " . $con->error);
						}

$type = 1; // Valor fijo según el código original
$stmt_envelopecontentimi->bind_param("is", $type, $id_envelope);

if (!$stmt_envelopecontentimi->execute()) {
    die("Error al ejecutar la consulta: " . $stmt_envelopecontentimi->error);
}

$result_envelopecontentimi = $stmt_envelopecontentimi->get_result();
if (!$result_envelopecontentimi) {
    die("Error al obtener el resultado: " . $stmt_envelopecontentimi->error);
}

$num_envelopecontentimi = $result_envelopecontentimi->num_rows;

						
						
						if($num_envelopecontentimi > 0){
							while($row_envelopecontentimi=mysqli_fetch_array($result_envelopecontentimi)){
								$retention_imi = $row_envelopecontentimi[0]."-".$row_envelopecontentimi[1];
							}
							$retention_imi = substr($retention_ir,-2);
						}else{
							$retention_imi = "Sin retenciones IMI";
						}
						?>
						<div class="caption">Información de Sobre</div>
						<div class="row">
						<div class="col-md-12">
						<form action="reception-retention-envelope-detail-print.php" method="post" enctype="multipart/form-data">
						<div class="note note-regular">
						<p><strong>ID de sobre:</strong> <? echo $row_envelope['id']; ?><br>
						<strong>Fecha de creación:</strong> <? echo $row_envelope['today'].' @'.$row_envelope['now']; ?><br>
						<strong>Retenciones IMI:</strong> <? echo $retention_imi;?><br>
						<strong>Retenciones IR:</strong> <? echo $retention_ir; ?></p>
						<p><strong>Estado de impresión:</strong> <?
						
						if($rowuser['location'] == 0){
							echo "En espera. (Para imprimir el sobre debe de ingresar la ubicación del proveedor.)";
						}else{
						switch($row_envelope['printed']){
							case 0:
							echo "Creado (Esperando ser Impreso)";
							$print_str = "Imprimir";
							break;
							case 1: 
							echo "Impreso";
							$print_str = "Reimprimir";
							break;
						}
						?><br><br>
						<input name="id_envelope" type="hidden" id="id_envelope" value="<? echo $id_envelope; ?>"><button type="submit" class="btn blue" onClick="updatePage();"><i class="fa fa-print"></i> <? echo $print_str; ?></button> </p>
						<script>
						function updatePage(){
							setTimeout(function(){
   							window.location.reload(1);
							}, 2000); 
						}
						</script>
						<? } ?>
						</div>
						</form> 
						</div>
						</div>
						
						
						<div class="caption">Inclusión de Retenciones</div>
						<? /*<div class="actions">

								<a href="reception-retention-remission-records.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Ver historial</span>

								</a>

							

							</div>*/ ?>
							

						</div>

						<div class="portlet-body">
							
							
							<div class="table-container">

<form enctype="multipart/form-data" method="post" action="reception-retention-envelope-detail-code.php">
							<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									
									<th width="50%">

										 <input type="checkbox" class="group-checkable" id="checkallir" onChange="javascript:checkAllir();" /> 
                                
                                  <script>
    function checkAllir(){
	 var checkall = document.getElementById('checkallir');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('irid[]');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
      </script> Retenciones IR</th>

									<th width="50%">

										  <input type="checkbox" class="group-checkable" id="checkallimi" onChange="javascript:checkAllimi();" /> 
                                
                                  <script>
    function checkAllimi(){
	 var checkall = document.getElementById('checkallimi');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('hallsid[]');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
      </script>Retenciones IMI</th>

								  </tr>

								</thead>

								<tbody>
                                                                
                               
                                <tr role="row" class="odd">
                                <td><?php  
								if($btype == 1){ 
									$queryir = "select irretention.id, irretention.number from irretention inner join payments on irretention.payment = payments.id where irretention.delivery = '2' and payments.btype='$btype' and payments.provider = '$ben'"; 
								}else{
									$queryir = "select irretention.id, irretention.number from irretention inner join payments on irretention.payment = payments.id where irretention.delivery = '2' and payments.btype='$btype' and payments.collaborator = '$ben'";
								} 
								$resultir = mysqli_query($con, $queryir);
								$numir = mysqli_num_rows($resultir);
								if($numir == 0){
									echo "Sin retenciones";
								}else{
									while($rowir=mysqli_fetch_array($resultir)){
										$queryirrem = "select * from irremissioncontent where irretention = '$rowir[id]'";
										$resultirrem = mysqli_query($con, $queryirrem);
										$rowirrem = mysqli_fetch_array($resultirrem);
										echo '<input name="irid[]" type="checkbox" id="irid[]" value="'.$rowir['id'].'"> &nbsp;'.$rowir['number']." (Remisión: ".$rowirrem['irremission'].")<br>"; 
									}
								}
								
								?> </td>
                                <td><?php  
								if($btype == 1){ 
									$queryhalls = "select hallsretention.id, hallsretention.serial, hallsretention.number from hallsretention inner join payments on hallsretention.payment = payments.id where hallsretention.delivery = '2' and payments.btype='$btype' and payments.provider = '$ben'";   
								}else{
									$queryhalls = "select hallsretention.id, hallsretention.serial, hallsretention.number from hallsretention inner join payments on hallsretention.payment = payments.id where hallsretention.delivery = '2' and payments.btype='$btype' and payments.collaborator = '$ben'";
								} 
								$resulthalls = mysqli_query($con, $queryhalls);
								$numhalls = mysqli_num_rows($resulthalls);
								if($numhalls == 0){
									echo "Sin retenciones"; 
								}else{
									while($rowhalls=mysqli_fetch_array($resulthalls)){
										$queryhallsrem = "select * from hallsremissioncontent where hallsretention = '$rowhalls[id]'";
										$resulthallsrem = mysqli_query($con, $queryhallsrem);
										$rowhallsrem = mysqli_fetch_array($resulthallsrem);
										
										
										echo '<input name="hallsid[]" type="checkbox" id="hallsid[]" value="'.$rowhalls['id'].'"> &nbsp;'.$rowhalls['serial'].'-'.$rowhalls['number']." (Remisión: ".$rowhallsrem['hallsremission'].")<br>";
									} 
								}
								
								?></td> 
                                </tr>
                                
                                                                </tbody>

								</table>
								
								<div class="row">

						<? if($row_envelope['printed'] == 1){ ?>
						<div class="col-md-2">
						 
						

						    <input type="hidden" id="id_envelope" name="id_envelope" value="<? echo $id_envelope; ?>"><button type="submit" class="btn blue"><i class="fa fa-check"></i> Incluir </button> 
												
                 </div>    
                 		<? }else{ ?>
						<div class="col-md-12"><div class="note note-danger">Debe de imprimir el sobre para poder incluir las retenciones.</div></div>
                 		<? } ?>                         
  
</div>
</form> 

							</div>

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
                                
                 
                
			</div>



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
<script src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>

<?/*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ ?>

<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimeout.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimer.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script>

jQuery(document).ready(function() {    

   Metronic.init(); // init metronic core components

Layout.init(); // init current layout

QuickSidebar.init() // init quick sidebar



});

</script>

    
    <script type="text/javascript">

function onFocus(){	
	document.getElementById("id").focus();
}
						</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>