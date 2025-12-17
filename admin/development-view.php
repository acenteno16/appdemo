<?php 

include("session-admin.php");

$id = $_GET['id'];
								
$query = "select * from development where id = '$id'"; 
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);       


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

<script src="../assets/global/plugins/ckeditor/ckeditor.js"></script> 
<link rel="stylesheet" href="../assets/global/plugins/ckeditor/sample.css">
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

					Requerimientos

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>
							<i class="fa fa-code"></i> 
							<a href="development.php">Requerimientos</a>


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

								Visor de Requerimientos 
							</div>

						

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

				
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<? /*<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 ID</th>

									<th width="13%">

										 Fecha</th>

								  </tr>

								</thead>*/ ?>

								
                              <? 
										switch($row['status']){
											case  0:
												$status_name = "Pendiente";
												$status_color = "";
												break;
											case 1:
												$status_name = "Rechazado";
												$status_color = "danger";
												break;
											case 2:
												$status_name = "Solucionado";
												$status_color = "active";
											
												break;
											case 3:
												$status_name = "En desarrollo";
												$status_color = "warning";
												break;
											case 4:
												$status_name = "Finalizado";
												$status_color = "success";
												break;
										} ?>
                              
                                
                                <tr role="row" class="odd <? echo $status_color; ?>">
                                <td width="12%" class="sorting_1"><strong>Fecha:</strong></td>
                                <td width="88%"><?php echo date('d-m-Y', strtotime($row['today']))." @".$row['totime']; ?></td> 
                                </tr>
                                <tr role="row" class="odd <? echo $status_color; ?>">
                                <td width="12%" class="sorting_1"><strong>Titulo:</strong></td>
                                <td width="88%"><?php echo $row['name'];
									//." @".$row['totime']; ?></td> 
                                </tr>
                                <tr role="row" class="odd <? echo $status_color; ?>">
                                <td width="12%" class="sorting_1"><strong>Descripción:</strong></td>
                                <td width="88%"><textarea style="width: 100%;" rows="5"><?php echo strip_tags($row['description']); 
									//." @".$row['totime']; ?></textarea></td> 
                                </tr>
                                <tr role="row" class="odd <? echo $status_color; ?>"> 
                                <td width="12%" class="sorting_1"><strong>Prioridad:</strong></td>
                                <td width="88%"><?php switch($row['priority']){
									case 0:
									echo "Baja";
									break;
									case 1:
									echo "Media";
									break;
									case 2:
									echo "Alta";
									break;
									case 3:
									echo "Máxima";
									break;
								} ?></td> 
                                </tr>
                                <tr role="row" class="odd <? echo $status_color; ?>">
                                <td width="12%" class="sorting_1">&nbsp;</td>
                                <td width="88%">&nbsp;</td> 
                                </tr>
                                <tr role="row" class="odd <? echo $status_color; ?>">
                                <td width="12%" class="sorting_1"><strong>Creado por:</strong></td>
                                <td width="88%"><?php $rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'")); echo $rowuser['first']." ".$rowuser['last']; ?></td> 
                                </tr>
                                <tr role="row" class="odd <? echo $status_color; ?>">
                                <td width="12%" class="sorting_1"><strong>Encargado:</strong></td>
									<td width="88%"><?php $rowuser2 = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid2]'")); echo $rowuser2['first']." ".$rowuser2['last']; ?></td>      </tr>
                                      <tr role="row" class="odd <? echo $status_color; ?>">
                                <td width="12%" class="sorting_1"><strong>Estado:</strong></td>
									<td width="88%"><? echo $status_name; ?></td>      </tr>
                                                         
                                   </tbody>

								</table>
                               

						</div>

					</div>
					
					

					<!-- End: life time stats -->

				</div>

			</div>

			<!-- END PAGE CONTENT-->

		</div>
		
		<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
 
					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Trello
							</div>

						

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

				
                                
                                <form id="fileupload" action="development-view-code.php" method="POST" enctype="multipart/form-data">
                                               
                                                <div class="portlet-body">
							
						
							<div class="row">
							  <div class="col-md-12">
					<table id="user" class="table table-bordered table-striped">
					<tbody>
					<tr>
					  <td width="12%">
					    <strong>Comentarios:</strong></td>
					  <td width="88%">
					    <textarea name="comments" rows="3" id="comments"></textarea>	
					    <script>
               /*CKEDITOR.replace( 'txtnotes' );
			   config.extraPlugins = 'imagebrowser';*/
					CKEDITOR.replace( 'comments', {
        				
						<? /*filebrowserBrowseUrl: '../assets/global/plugins/ckeditor/plugins/imagebrowser/browser/browser.html',
					 	filebrowserUploadUrl: '../assets/global/plugins/ckeditor/upload.php',
						
					
   						"extraPlugins" : 'imagebrowser',
						"imageBrowser_listUrl" : "../assets/global/plugins/ckeditor/images.php"*/ ?>
	});
			    </script>
			    				    </td>
					  </tr>
                    <tr>
                      <td><strong>Etapa:</strong></td>
                      <td>
                        <select name="stage" class="form-control" id="stage">
                          <option value="0" selected>Comentarios/Consultas</option>
                          <option value="1">Rechazado</option> 
                          <option value="2">Solucionado de otra manera</option>
                          <option value="3">En desarrollo</option>
                          <option value="4">Finalizado</option>
                          
                          </select>
                        
                        </td>
                    </tr>
					</tbody>
					</table>
				</div></div> 
							
						</div>
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                               

												<!--/row-->

												

												<!--/row-->

												

												<!--/row-->

											<div class="form-actions right">

											 

											  <button type="submit" class="btn blue"><i class="fa fa-plus"></i> Agregar</button>
												<input name="iddevelopment" type="hidden" id="idevelopment" value="<? echo $row['id']; ?>">
												<input name="userid" type="hidden" id="userid" value="<? echo $row['userid']; ?>">
												<input name="userid2" type="hidden" id="userid2" value="<? echo $row['userid2']; ?>"> 
												<input name="taskname" type="hidden" id="taskname" value="<? echo $row['name']; ?>">  

											</div>

										</form>
                               

						</div>

					</div>
					
					

					<!-- End: life time stats -->

				</div>

			</div>

			<!-- END PAGE CONTENT-->

		</div>
		
		<? //Trello Record ?>
		
		<div class="row">
                                <div class="col-md-12">
                                             <h3 class="form-section">Trello record</h3>  <br>
                                             
<? 

$queryhigh = "select * from development_trello where development = '$_GET[id]' order by id desc limit 1";
$resulthigh = mysqli_query($con, $queryhigh);
$numhigh = mysqli_num_rows($resulthigh);
if($numhigh == 0){
?>
<p>No Trello record</p>
<?
}else{


	  						   $queryfmessages = "select * from development_trello where development = '$_GET[id]' order by id desc";   
							   $resultfmessages = mysqli_query($con, $queryfmessages);
							   $numfmessages = mysqli_num_rows($resultfmessages);							  
							   if($numfmessages > 0){
							   
							   ?>
                              
                               <ul class="chats">

									<?php $side = "out";
									$i=1; 
									while($rowfmessages=mysqli_fetch_array($resultfmessages)){
										
										 switch($rowfmessages['stage']){
								   case  0:
												$stage = "Pendiente";
												break;
											case 1:
												$stage = "Rechazado";
												break;
											case 2:
												$stage = "Solucuinado";
												break;
											case 3:
												$stage = "En desarrollo";
												break;
											case 4:
												$stage = "Finalizado";
												break;
							   }
							   
										$queryuser = "select * from workers where code = '$rowfmessages[user]'"; 
										$resultuser = mysqli_query($con, $queryuser);
										$rowuser = mysqli_fetch_array($resultuser);
										$username = $rowuser['first']." ".$rowuser['last'];
										
										if(($lastuser == $rowuser['id']) and ($i > 1)){
										$change = 0;
									}else{
										$change = 1;
									}	
									if($change == 1){
									if($side == "in"){
										$side = "out";
									}else{
										$side = "in";
									}
									}
									$lastuser = $rowuser['id'];
									$i++;
										
									?>
                                    <li class="<?php echo $side; ?>">

										<?php 
										$filepicture = "profiles/".$rowuser['code'].'/'.$rowuser['code'].".jpg"; 
					
					if(file_exists($filepicture)){
					?>
					<img class="avatar" alt="" src="<?php echo $filepicture; ?>">
                    <?php }else{
					//echo $filepicture;
					?>
                  
                   <img class="avatar" alt="" src="../assets/admin/layout/img/avatar3_small.jpg">
                   
                   
                    
                    <?php } ?>
                    
                    

										<div class="message">

											<span class="arrow">

											</span>

											<a href="#" class="name" name="<?php echo 'comment'.$rowfmessages['id']; ?>">

											<?php echo $username; ?> </a>

											<span class="datetime" style="color:#A6A6A6;">

											El <?php echo date('d-m-Y',strtotime($rowfmessages['today'])); ?> a las <?php echo date('h:ia', strtotime($rowfmessages['totime']))."  | ID:".$rowfmessages['id']; ?> | #<? echo $stage; ?> </span>

											<span class="body">

						 					<br>
<?php echo $rowfmessages['comments']; ?> </span>

										</div>

									</li>
                                    <?php //End while
									}
									?>

								</ul>
                                <?php } ?>
                                <br>
                                                    


<? } ?>                                           
</div></div>

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