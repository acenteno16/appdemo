<?php /*include("session-review.php");

$id = $_GET['id'];

$query = "select * from payments where id = '$id'";
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

					Archivos <small>Revisión de archivos</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Paquetes</a>
                                <i class="fa fa-angle-right"></i>
                                </li>
                         
                             						
                             

						<li>

							<a href="#"> Revisión de archivos</a>

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
				<div class="col-md-12"><!-- Begin: life time stats --><div class="note note-regular">
									 <h4 style="">Detalles de Remisión:</h4>
                
               <br><p>
<?php $rowpackagecontent = mysqli_fetch_array(mysqli_query($con, "select * from packagescontent where payment = '$row[id]'"));
$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
$rowunit = mysqli_fetch_array(mysqli_query($con, "select * from units where code = '$rowuser[unit]'"));
$numfiles = mysqli_num_rows(mysqli_query($con, "select * from files where payment = '$row[id]'"));
$rowtime = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id asc limit 1"));

?>							                            <strong>ID de remisión:</strong> <?php echo 'r'.$rowpackagecontent['package']; ?><br>
<strong>ID del paquete:</strong> <?php echo $row['id']; ?><br>
 <strong>Solicitante:</strong> <?php echo $rowuser['code'].' | '.$rowuser['first']." ".$rowuser['last']; ?><br>
 <strong>Unidad de negocio:</strong> <?php echo $rowunit['code'].' | '.$rowunit['name']; ?><br>
 <strong>No. de archivos:</strong> <?php echo $numfiles; ?><br>
 </p>
							
									 
								</div>

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

				Archivos

							</div>
                            

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							<?php $queryfile = "select * from files where payment = '$_GET[id]'";
								$resultfile = mysqli_query($con, $queryfile);
								$numfile = mysqli_num_rows($resultfile);
								
								?>

								                                
                                	<p><strong>IDA:</strong> ID del archivo</p>
                                    <form action="file-review-detail-check-code.php" method="post" enctype="multipart/form-data" id="myform" name="myform"> 
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 IDA</th>

									<th width="15%">Documento</th>

									<th width="15%">Link</th>

								

									<th width="10%">Opciones

										 </th>

								</tr>

								</thead>

								<tbody>
                                                                
                                <?php while($rowfile=mysqli_fetch_array($resultfile)){
								
								?>
                                <tr role="row" class="odd <?php switch($rowfile['status']){ 
								case 3:
								echo 'danger';
								break;
								case 4:
								echo "success";
								break;
								} ?>" >
                                <td class="sorting_1"><?php echo $rowfile['id']; ?></td>
                                <td><?php if($rowfile['name'] != "") echo $rowfile['name']; else echo "Archivo sin nombre."; ?></td>
                                <td><a href="<?php $oldlink = $rowfile['link'];
								$newlink = str_replace('http://www.pagoscp.com/admin/','',$oldlink);
								echo $newlink;  ?>" class="btn btn-xs default btn-editable" target="new"><i class="fa fa-link"></i> <?php echo $rowfile['link'];
								 ?></a> </td>
                                <td><input name="id[]" type="checkbox" id="id[]" value="<?php echo $rowfile['id']; ?>" <?php if($rowfile['status'] == '4') echo 'checked="checked"'; ?>>
                                Okay</td>
                                    </tr>
                                    <?php } ?>
                                                                </tbody>

								</table>
                                
                                <div class="col-md-12 " style="display:none;" id="cdiv">
													  <div class="form-group">
														<label class="control-label">Razón:</label> 

													  <select name="reason2" class="form-control" id="reason2">
<option value="0">Otro</option>
<?php $queryreason = "select * from reason";
$resultreason = mysqli_query($con, $queryreason);
while($rowreason=mysqli_fetch_array($resultreason)){
?>
<option value="<?php echo $rowreason['id']; ?>"><?php echo $rowreason['name']; ?></option>
<?php } ?>

													  </select><br>
<br>
<label>Comentarios:</label>
                                                        <textarea name="reason" rows="2" class="form-control" id="reason" placeholder="Comente por que no aprueba esta solicitud de pago."></textarea>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                        
                                                      <!--/row--></div>
													</div>
                                                    
                                <div>
                               
                                  <?php /*<div class="form-actions right">


												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Ingresar</button> <button type="button" class="btn red"><i class="fa fa-times"></i> Rechazar Pago</button> <input type="hidden" id="payment" name="payment" value="<?php echo $row['id']; ?>">
                                                
	</div>*/ /*?>
  <div class="form-actions right" style="margin-left:0px;">

												

						    <span id="dapprove"> <button type="button" class="btn blue" onClick="divShow(0);"><i class="fa fa-check"></i> Aprobar</button>  </span>
                            
                           <span id="cancelreject" style="display:none;"> <button type="button" class="btn blue" onClick="divShow(2);"><i class="fa fa-times"></i> Cancelar reprobar</button> </span>
                            
                             <button type="button" class="btn red" onClick="divShow(1);"><i class="fa fa-times"></i> Reprobar</button> 
												<?php /*<input name="id[]" type="hidden" id="id[]" value="<?php echo $_GET['id']; ?>">
                                                <input name="atype[]" type="hidden" id="atype[]" value="<?php echo $atype; ?>">*/ /*?>
                                                <span class="form-actions right" style="margin-left:0px;">
                                                <input name="approve" type="hidden" id="approve" value="0">
                                                <span class="form-actions right" style="margin-left:0px;">
                                                <input name="payment" type="hidden" id="payment" value="<?php echo $_GET['id']; ?>">
                                                </span>                                                </span> 
  </div>                             
                               </form>
                               
                               <br><br>
                               
                               <h3>Comentarios de Control de calidad</h3><br>
                               
                               <?php $queryfmessages = "select * from filescomments where payment = '$_GET[id]' order by id asc";  
							   $resultfmessages = mysqli_query($con, $queryfmessages);
							   $numfmessages = mysqli_num_rows($resultfmessages);							  
							   if($numfmessages > 0){
								   
							   ?>
                               <ul class="chats">

									<?php $side = "out";
									$i=1; 
									while($rowfmessages=mysqli_fetch_array($resultfmessages)){
										$queryuser = "select * from workers where code = '$rowfmessages[userid]'"; 
										$resultuser = mysqli_query($con, $queryuser);
										$rowuser = mysqli_fetch_array($resultuser);
										$username = $rowuser['first']." ".$rowuser['last'];
										
										if(($lastuser == $rowuser['code']) and ($i > 1)){
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
									$lastuser = $rowuser['code'];
									$i++;
										
									?>
                                    <li class="<?php echo $side; ?>">

										<?php $filepicture = "profiles/".$rowuser['code']."/".$rowuser['code'].".jpg"; 
					
					if(file_exists($filepicture)){
						?>
                           
                             <img class="avatar" alt="" src="<?php echo $filepicture; ?>">
                            <?php }else{
					
					?>
                   <img class="avatar" alt="" src="../assets/admin/layout/img/avatar3_small.jpg">
                   
                   
                    
                    <?php } ?>
                    
                    

										<div class="message">

											<span class="arrow">

											</span>

											<a href="#" class="name">

											<?php echo $username; ?> </a>

											<span class="datetime">

											El <?php echo date('d-m-Y',strtotime($rowfmessages['today'])); ?> a las <?php echo date('h:i:s a', strtotime($rowfmessages['now2'])); ?> </span>

											<span class="body">

						 					<?php echo $rowfmessages['comments']; ?> </span>

										</div>

									</li>
                                    <?php //End while
									}
									?>

								</ul>
                                <?php } ?>
                                <br>
                              	<form method="post" enctype="multipart/form-data" action="file-review-comments-add.php"> 
                                <textarea name="comments" id="comments" style="width:100%;"><?php echo $row['comments']; ?></textarea> <br><br>
                                <div class="form-actions right">


												<button type="submit" class="btn blue"><i class="fa fa-comments"></i> Comentar</button> <input type="hidden" id="payment" name="payment" value="<?php echo $_GET['id']; ?>">
                                                
	</div>
                                
                                </form>
                                </div>
                                <br>

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

<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>

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

	   function divShow(approve){
			 
		   	if(approve == 0){
				document.getElementById('approve').value = '1';
				document.forms["myform"].submit();
		   }
		   
		   if(approve == 1){
			   if(document.getElementById("cdiv").style.display == 'block'){
				   document.getElementById('approve').value = '2';
				   if(validateForm()){
					   
					   document.forms["myform"].submit();
				   }
				   
			   }else{
				   
			   document.getElementById("cdiv").style.display = 'block';
			   document.getElementById("cancelreject").style.display = 'block';
			   document.getElementById("dapprove").style.display = 'none';
			   }
			   
			   
		   }
		   
		   if(approve == 2){
			   document.getElementById('approve').value = '0';
			   document.getElementById("cdiv").style.display = 'none';
			   document.getElementById("cancelreject").style.display = 'none';		document.getElementById("dapprove").style.display = 'block'; 
			   
		   }
		   	
		   
}


function validateForm(){
	
	var reason = document.getElementById("reason").value;
	var reason2 = document.getElementById("reason2").value;
	
	if((reason2 == '0') && (reason == '')){
		alert('Cuando rechaza una solicitud de pago con la opcion "Otro" debe de justificar con comentarios.');
		return false;
		}
		
	 
		else{
			return true;
		}
		
		
}
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>*/ ?>