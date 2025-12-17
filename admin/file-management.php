<?php include("session-storage.php");
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


			<!-- BEGIN PAGE HEADER-->		



			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Archivos <?php //<small></small> ?> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Remisiones</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>Almacenamiento de remisiones</li>

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

								
								                                    <div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

										

										</div>

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="file-management-code.php" class="horizontal-form" method="post" enctype="multipart/form-data">

											<div class="form-body"> 

												<h3 class="form-section">Almacenar remisión</h3>
                                                

												<div class="row"><!--/span-->

												  <div class="col-md-12 ">
													  <div class="form-group">
														<label>ID de remisión:</label>
                                                        <input name="id" type="text" class="form-control" id="id" value="" onchange="javascript:this.form.submit;">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
												  </div>

													<!--/span-->

											  </div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

										  <!--/row--><!--/row--></div>


											<div class="form-actions right">

												<button type="button" class="btn default" onclick="javascript:cancelAction();">Cancelar</button>

												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Ingresar</button>

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div>
            




							</div>

							

							

							

							

							

							

					

					</div>

				</div>

			</div>
            <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">
<? $query = "select * from schedule where status = '7' order by id desc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
								echo number_format($numdev); ?>
				Remisiones almacenadas

							</div>
							
							<div class="actions">
								<a href="file-management-report.php" class="btn default blue-stripe">
								<i class="fa fa-list"></i>
								<span class="hidden-480">
								Ver pendientes de almacenar</span> 
								</a>
								
							</div>

						

						</div>
                        
                        

					
                        <div class="portlet-body">

							<div class="table-container">

								

							<?php $tampagina = 25;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}


							

$totpagina = ceil($numdev / $tampagina);
			
$query1 = "select * from schedule where status = '7' order by id desc limit ".$inicio.",".$tampagina; 
$result1 = mysqli_query($con, $query1);  

if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;						

if($numdev > 0){

?>

								                                
                                	 	<p><strong>IDR:</strong> ID de remisión o grupo de cancelación.</p>
                              
                              <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 IDR</th>
                                         <th width="20%">

										 Procesador</th>
                                            <th width="10%">

										 Procesado</th>
                                        

									<th width="2%">

										 Acreditado</th>

									
									
									

									<th width="10%">

										 Almacenado

									</th>
                                    
                                    <th width="5%">

										 Opciones</th>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
						$querytime = "select * from scheduletimes where schedule = '$row[id]'";
						$resulttime = mysqli_query($con, $querytime);
						$numtime = mysqli_num_rows($resulttime);
						while($rowtime=mysqli_fetch_array($resulttime)){
						switch($rowtime['stage']){
							case "1.00":
							$processday =  date('d-m-Y',strtotime($rowtime['today']));
							break;
							case "6.00":
							$creditday =  date('d-m-Y',strtotime($rowtime['today']));
							break;
							case "7.00":
							$storageday =  date('d-m-Y',strtotime($rowtime['today']))." @ ".date('h:i:s a', strtotime($rowtime['now2'])); 
							break;
						}
						
						
						}
						
						
						
								?>
                                
                                <tr role="row" class="odd "> 
                                <td class="sorting_1"> <?php echo $row['id']; ?></td>
                                
                               <td>
                               <?php $rowprocessor = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
								
								echo $rowprocessor['code'].' | '.$rowprocessor['first']." ".$rowprocessor['last'];
								
                                ?></td>
                                <td>
                                <?php echo $processday;
							
								 ?>
                               </td>
                                <td><?php echo $creditday;
							
								 ?></td>
                                <td>
                                <?php
						echo  $storageday; 		
							
								
								?>
                                </td>
                              
                              <td>
                             
                      <a href="file-management-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Ver</a> 
                                </td></tr>
                                <?php } ?>
                                </tbody>
                                

								</table>
                                
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="file-management.php?page=<?php echo $previous; ?>">
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
		  echo '<li><a href="file-management.php?page='.$i .'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="file-management.php?page=<?php echo $next; ?>);">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                               
<?php }else{ ?>
<div class="note note-danger">No se encontró ninguna remisión.</div>
<?php } ?>
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
<script type="text/javascript">

function onFocus(){	
	document.getElementById("id").focus();
}
</script>


<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>