<?php 

session_start(); 

if(($_SESSION['admin'] == "active") or ($_SESSION["stuck"] == 'active') or ($_SESSION["retentionmanager"] == 'active')){ 
	include("../connection.php");  
}else{
	session_destroy();
	header("location: ../?err=noadmin-or-retention");	 
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

					Retenciones  <small> Atascadas (FS)</small></h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						
                            <li>

							<a href="retentions-home.php">Retenciones</a> 
                             <i class="fa fa-angle-right"></i>
                                </li>
                           
                             <li>

							<a href="#">Atascadas (FS)</a> 
                            
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

						Retenciones sin sucursal

							</div>
                            

						</div>

						

					</div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <?php ///// table ?>
                         	<div class="tab-pane" id="tab_1">
<div class="row"><!--/span-->


													<div class="col-md-12">
                           
        
        <?php $today = date('Y-m-d'); 
$tampagina = 100;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}


$query = "select * from payments where status = '14' and hall = '0' and ((ret1a > '0') or (ret2a > 0))";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);

$query1 = "select * from payments where status = '14' and hall = '0' and ((ret1a > '0') or (ret2a > 0)) order by id asc limit ".$inicio.",".$tampagina; 
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;	
if($numdev > 0){		
		
		//start?>
     <form id="retentions" name="retentions" action="retentions-stuck-code.php" method="post" enctype="multipart/form-data">   
     <div class="note note-regular">Las retenciones cargadas en la siguiente tabla, son retenciones que no se generaron porque en el momento de cancelarse el pago, no estaban anidadas a una sucursal en especifico. Con esta herramienta usted podrá crear dichas retenciones que quedaron atascadas. Cabe destacar que 
    si la alcaldía configurada no cuenta con retenciones disponibles, no se podra generar la retención.</div>
     
     <br> 
 
 	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th>IDS</th>

									<th width="62%">

										 Proveedor/Colaborador</th>
                                         
                                         
                                         <th width="2%">

										 Fecha Cancelación</th>
                                         <th width="2%">

										 Monto IMI</th>
                                          <th width="2%">

										 Monto IR</th>

<th width="2%">

										 Ruta</th>
                                         <th width="2%">

										 Sucursal</th>

									<th width="14%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>

                                <?php while($row=mysqli_fetch_array($result1)){
	
	$rowhalls2 = mysqli_fetch_array(mysqli_query($con, "select * from halls where id = '$row[hall]'"));
	
	if($row['btype'] == 1){
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
									$theprovider = $flag." ".$rowprovider['code']." | ".$rowprovider['name'];
								}else{
									$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
									$theprovider = $flag." ".$rowcollaborator['code']." | ".$rowcollaborator['first']." ".$rowcollaborator['last'];
								}

?>

								
								
                                <tr role="row" class="odd">
                                  <td><input name="theid[]" type="hidden" id="theid[]" value="<?php echo $row["id"]; ?>">                                     <?php echo $row["id"]; ?></td>
                                  
                                  <td><?php echo $theprovider; ?></td>
                                  <td><?php 
								  $querycdate = "select * from times where payment = '$row[id]' and stage = '14.00'";
								  $resultcdate = mysqli_query($con, $querycdate);
								  $rowcdate = mysqli_fetch_array($resultcdate);
								  $today = strtotime($rowcdate['today']);
								  $today = date('d-m-Y', $today);
								  echo $today; ?></td>
                                  <td><?php echo "C$".$row["ret1a"]; ?></td>
                                  <td><?php echo "C$".$row["ret2a"]; ?></td>
                                  <td><?php echo $row["route"]; ?></td>
                                  <td><?php 
								  /*$queryhall = "select * from halls where units like '%$row[route]%'"; 
								  $resulthall = mysqli_query($con, $queryhall);
								  $rowhall = mysqli_fetch_array($resulthall);
								  if($rowhall['name'] == ""){
									  echo "ND";
								  }else{
								  	echo $rowhall['name'];
								  }
								  */
								  
								  ?>
                                  <select name="hallid[]" id="hallid[]">
                                  <option value="0" selected>Seleccionar</option>
                                  <?php 
								  $queryhall = "select * from halls"; 
								  $resulthall = mysqli_query($con, $queryhall);
								  while($rowhall = mysqli_fetch_array($resulthall)){
									  
									  $queryhalls0 = "select * from halls where units like '%$row[route]%'";
$resulthalls0 = mysqli_query($con, $queryhalls0);
$rowhalls0=mysqli_fetch_array($resulthalls0);

								  ?> 
                                  <option value="<?php echo $rowhall['id']; ?>" <?php //if($rowhall['id'] == $rowhalls0['id']) echo "selected"; ?>><?php echo $rowhall['name']; ?></option> 
                                  <?php } ?>
                                  </select></td>
                                  <td>
                                  <? /*if($row['ret1a'] > 0){ 
								  
								  $queryrethall = "select * from hallsretention where id = '$row[retid1]'"; 
								  $resultrethall = mysqli_query($con, $queryrethall);
								  $rowrethall = mysqli_fetch_array($resultrethall);
								  
								  ?>
                                  <a href="halls-retention-view-detail.php?id=<?php echo $rowrethall['serial']."-".$rowrethall['number']; ?>">

									 <span class="label label-primary">
									<i class="fa fa-search"> </i> Ver IMI <?php echo $rowrethall['serial']."-".$rowrethall['number']; ?></span></a>
                                    
                                  <? }*/ if($row['ret2a'] > 0){ ?>  <a href="payment-order-view.php?id=<?php echo $row['id']; ?>" style="margin-top:15px;">  

									 <span class="label label-primary">
									<i class="fa fa-search"> </i> Ver IR <?php echo $row['ret2id']; ?></span></a><? } ?>
                                    
                                    
                                    
                                    &nbsp; <?php /*<a href="javascript:deleteUnit(<?php echo $row['id']; ?>);"><span class="label label-danger">
									<i class="fa fa-trash-o"></i>  Eliminar </span></a>*/ ?>
                                   
                                  </td></tr>
                                
                                
                                
                                
                                
                                
                                <?php } //while ?>
                                </tbody>

								</table>
    
    
    <div class="form-actions right">

<button type="submit" class="btn blue" onClick="javascript:pdfPrint();"><i class="fa fa-print"></i> Procesar</button>
<input name="scheduleid" type="hidden" id="scheduleid" value="<?php echo $_GET['id']; ?>"> 

</p>                                         

							</div>
    </form>                            
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="retentions-stuck.php?page=<?php echo $previous; ?>">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i .'</a></li>';  
		}else{
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
		  echo '<li><a href="retentions-stuck.php?page='.$i .'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="retentions-stuck.php?page=<?php echo $next; ?>);">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                            <?php }else{ ?>
                            
                            <div class="note note-success">
                            <p>No se encontró ninguna retención atascada.</p>
                            </div>
                            <?php } ?>
                      

</div></div>

</div>


							

			<script>
				function deleteUnit(id){
		if (confirm("Usted desea eliminar esta unidad?\n- Si usted no desea eliminar esta unidad presione cancelar.")==true){
			window.location="units-delete.php?id="+id;	
	} 
}
			</script>				

							

					<?php //table } ?>		

							

							

					

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