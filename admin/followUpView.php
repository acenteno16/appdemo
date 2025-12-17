<?php 

include("sessions.php");   
include("functions.php"); 
include("catalogs.php"); 

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
	

	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>	
	
<link rel="stylesheet" type="text/css" href="../assets/global/plugins/fancybox/source/jquery.fancybox.css?v=2.1.2" media="screen" />

<link rel="shortcut icon" href="favicon.ico"/>
<?php include('fn-expiration.php'); ?>
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

					Bitacora de seguimineto <? //<small>Solicitudes de pago</small> ?>

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
							<a href="#">Visor</a>
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

								Bitacora de seguimiento

							</div>

							<? /*<div class="actions">
							
							
								<a href="followUpImport.php" class="btn default blue-stripe">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
								Agregar</span> 
								</a>
								
								

							</div>*/ ?>
						</div>
						
						<div class="table-container"><div class="table-scrollable">

						<div class="portlet-body">

							<div class="table-container">

								

							

<?php 
							
								
$id = $_GET['id']; 

$query = "select * from followupLogContent where fileid = '$id'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);			
if($num > 0){  ?> 
                                
								<style>
								.chat-form .btn-cont .btn {
margin-top: 8px !important;
height: 34px !important;
padding-top: 7px !important;
}
								</style>
                                <table class="table table-striped table-bordered table-hover">

								<thead>

								<tr role="row" class="heading">

									<th>ID</th>
									<th>Compañía</th>
									<th>Banco</th>
									<th>Cuenta corriente</th>
									<th>Tipo</th>
									<th>Cuenta contable</th>
									<th>Fecha<b style="color:#EEEEEE;">aaaaaaa</b></th>
									<th>Tipo de documento</th>
									<th>Documento</th>
									<th>Explicacion<b style="color:#EEEEEE;">aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</b></th>
									<th>Monto</th>
									<th>Moneda</th>
									<th>Usuario<b style="color:#EEEEEE;">aaaaaaaaaaaaaaaaaaaa</b></th>
									<th>Batch</th>
									<th>Conciliador<b style="color:#EEEEEE;">aaaaaaaaaaaaaaaaaaaa</b></th>
									<th>Batch<b style="color:#EEEEEE;">0</b>corrección<b style="color:#EEEEEE;">aaaaaa</b></th>
									<th>Fecha<b style="color:#EEEEEE;">0</b>batch<b style="color:#EEEEEE;">000000000</b></th>
									<th>Clasificación<b style="color:#EEEEEE;">aaaaaaaaaaaa</b></th>
									<th width="300">Opciones<b style="color:#EEEEEE;">aaa</b></th>
									
									
								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
	
								$row_user = mysqli_fetch_array(mysqli_query($con, "select first, last from workers where code = '$row[originator]'"));
								$row_user2 = mysqli_fetch_array(mysqli_query($con, "select first, last from workers where code = '$row[conciliator]'"));
								?>
									
								<div id="long<?php echo $row['id']; ?>" class="modal fade modal-scroll" tabindex="-1" data-replace="true">
									

								<div class="modal-dialog">

									<div class="modal-content">

										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
											
											<h4 class="modal-title"><i class="fa fa-info-circle"></i> Información de la línea</h4>

										</div>

										<div class="modal-body">
											<div class="row">
												<div class="col-md-6"><strong>ID:</strong> <?php echo $row['id']; ?><br>
													<strong>Company:</strong> <? echo $thisCompany[$row['company']]; ?><br>
													<strong>Banco:</strong> <? echo $thisBank[$row['bank']]; ?><br>
													<strong>Cuenta corriente:</strong> <? echo $thisAccount[$row['account']]; ?><br>
                                					<strong>Tipo:</strong> <? echo $row['type']; ?><br>
                                					<strong>Cuenta contable:</strong> <? echo $thisAccount2[$row['account2']]; ?><br>
													<strong>Fecha:</strong> <? echo $row['dday']; ?><br>
													<strong>Tipo de documento:</strong> <? echo $thisDocType[$row['doctype']]; ?><br>
													<strong>Docuemento:</strong> <? echo $row['doc']; ?>
												</div>
												<div class="col-md-6"><strong>Monto:</strong> <? echo number_format($row['amount'],2); ?><br>
													<strong>Moneda:</strong> <? echo $thisCurrency[$row['currency']]; ?><br>
													<strong>Usuario:</strong> <? echo $row['originator']." | ".$row_user['first']." ".$row_user['last']; ?><br>
													<strong>Batch:</strong> <? echo $row['batch']; ?><br>
													<strong>Conciliador:</strong> <? echo $row['conciliator']." | ".$row_user2['first']." ".$row_user2['last']; ?><br>
												</div>
											</div>
											
											<strong>Explicación:</strong> <? echo $row['explanation']; ?><br>
											
											</div>
										<div class="modal-header"><h4 class="modal-title"><i class="fa fa-comments"></i> Comentarios</h4></div>
											
											<div class="modal-body">
												
											<div class="col-md-12">

					<!-- BEGIN PORTLET-->

					<div class="portlet">

					
							<div class="chat-form">

								<div class="input-cont">

									<input class="form-control" name="comments" type="text" id="comments_<? echo $row['id']; ?>" placeholder="Type a message here..."/>

								</div>

								<div class="btn-cont">

									<span class="arrow">

									</span>

									<a href="javascript:saveComment(<? echo $row['id']; ?>);" class="btn blue icn-only">

									<i class="fa fa-check icon-white"></i>
									
									</a>

								</div>
								<progress id="progressBar<? echo $row['id']; ?>" value="0" max="100" style="width:100%;"></progress><br> 
								<span id="status<? echo $row['id']; ?>"></span> <span id="status2<? echo $row['id']; ?>"></span>
							</div>
							<div id="filesWaiter<? echo $row['id']; ?>">
							<input type="file" name="file<? echo $row['id']; ?>[]" id="file<? echo $row['id']; ?>" multiple>
							</div>
						
						<div class="row"></div><br>

						<div class="portlet-body" id="chats">

					

								<ul class="chats" id="chat_<? echo $row['id']; ?>">
									
									<? 
									$queryFollowupComments = "select * from followupComments where followup = '$row[id]' order by id desc";
									$resultFollowupComments = mysqli_query($con, $queryFollowupComments);
									while($rowFollowupComments=mysqli_fetch_array($resultFollowupComments)){ 
									?>

									<li class="in">

										<img class="avatar" alt="" src="../../assets/admin/layout/img/avatar1.jpg"/>

										<div class="message">

											<span class="arrow">

											</span>

											<a href="#" class="name">

											<? echo $rowFollowupComments['userid']; ?> </a> 

											<span class="datetime">

											@<? echo $rowFollowupComments['today'].' '.$rowFollowupComments['totime']; ?> </span>

											<span class="body">

											<? echo $rowFollowupComments['comments']; ?> </span>
											<? 
	  $queryFiles = "select * from followupFiles where uid = '$rowFollowupComments[uid]'";
	  $resultFiles = mysqli_query($con, $queryFiles);
	  $numFiles = mysqli_num_rows($resultFiles);
	  if($numFiles > 0){
		  echo '<ul class="list-inline blog-images">';
		  while($rowFiles=mysqli_fetch_array($resultFiles)){ 
			  $baseId = base64_encode($row['id'].','.$rowFiles['filename']); 
			  #echo "<img src='followUpImage.php?token=$baseId' width='70px' height='70px'> "; 
			  ?>
			  <li><a class="fancybox" href="followUpImage.php?token=<? echo $baseId; ?>&image=show.png" data-fancybox-group="gallery<? echo $rowFollowupComments['id']; ?>">
				<img width="50" height="50" src="followUpImage.php?token=<? echo $baseId; ?>">
				</a> 
	    	</li>  
														   
														   
		  <? } ?>
											</ul>								
	 <? } ?> 

										</div> 

									</li>
									
									<? } ?>

							
								</ul>

						

						
								
							<? /*<a href="javascript:addFile<? echo $row['id']; ?>();">[Adjuntar]</a>*/  ?>
							<script>
							var cki<? echo $row['id']; ?> = 1;
							function addFile<? echo $row['id']; ?>(){
								
								var fileStr = '<div class="row" name="file<? echo $row['id']; ?>" id="file<? echo $row['id']; ?>_'+cki<? echo $row['id']; ?>+'"><div class="col-md-5 "><div class="form-group"><input name="theFile<? echo $row['id']; ?>[]" type="file" class="form-control form-control-inline " id="file<? ?>[]"></div></div><div class="col-md-2 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteFile<? echo $row['id']; ?>('+cki<? echo $row['id']; ?>+');">-</button></div></div><input type="hidden" name="did[]" id="did[]" value="0"></div></div>'; 
	
								$("#filesWaiter<? echo $row['id']; ?>").append(fileStr);
								cki<? echo $row['id']; ?>++;
							}
							function deleteFile<? echo $row['id']; ?>(id){
								var node = document.getElementById("file<? echo $row['id']; ?>_"+id);
								if(node.parentNode){
  									node.parentNode.removeChild(node);
								}
							}
							</script>

						</div>

					</div>

					<!-- END PORTLET-->

				</div>	

										</div>
										<div class="row"></div><br>

										<div class="modal-footer">

											<button type="button" data-dismiss="modal" class="btn">Close</button>

										</div>

									</div>

								</div> 

							</div>
                                
                                <tr role="row" class="odd <? if($row['status'] == 1) echo 'success'; ?>" id="<?php echo 'row_'.$row['id']; ?>">
                                <td class="sorting_1"><?php echo $row['id']; ?></td>
								<td><? echo $thisCompany[$row['company']]; ?></td>	
                                <td><? echo $thisBank[$row['bank']]; ?></td>
                                <td><? echo $thisAccount[$row['account']]; ?></td>
                                <td><? echo $thisType[$row['type']]; ?></td>
                                <td><? echo $thisAccount2[$row['account2']]; ?></td>
								<td><? echo $row['dday']; ?></td>
								<td><? echo $thisDocType[$row['doctype']]; ?></td>
								<td><? echo $row['doc']; ?></td>
								<td><? echo $row['explanation']; ?></td>
								<td><? echo number_format($row['amount'],2); ?></td>
								<td><? echo $thisCurrency[$row['currency']]; ?></td>
								<td><? echo $row['originator']." | ".$row_user['first'][0].". ".$row_user['last']; ?></td>
								<td><? echo $row['batch']; ?></td>
								<td><? echo $row['conciliator']." | ".$row_user2['first'][0].". ".$row_user2['last']; ?></td>
								<td><input type="text" class="form-control" id="batch_<? echo $row['id']; ?>" value="<? echo $row['batch2']; ?>" <? if($row['batch2'] != '') echo 'readonly'; ?> ></td>
								<td><input type="text" class="form-control <? if($row['status'] == 0) echo 'date-picker'; ?>" id="today_<? echo $row['id']; ?>" value="<? 
									if($row['today2'] != '0000-00-00'){
										echo date("d-m-Y", strtotime($row['today2']));
									}
									?>" readonly></td>
								<td><? if($row['status'] == 0){ ?><select id="classification_<? echo $row['id']; ?>" class="form-control">
									<option value="0" selected>Seleccionar</option> 
								<? $queryClassification = "select id, name from followupLogClassification";
									$resultClassification = mysqli_query($con, $queryClassification);
									while($rowClassification=mysqli_fetch_array($resultClassification)){ ?>
										<option value='<? echo $rowClassification['id']; ?>' <? if($rowClassification['id'] == $row['classification']) echo 'selected'; ?>><? echo $rowClassification['name']; ?></option>
									<? } ?>
									</select>
									<? }else{  
									
									$queryClassification = "select id, name from followupLogClassification where id = '$row[classification]'";
									$resultClassification = mysqli_query($con, $queryClassification);
									$rowClassification=mysqli_fetch_array($resultClassification);
									?>
									<input type="text" class="form-control" id="classification_<? echo $row['id']; ?>" value="<? echo $rowClassification['name']; ?>" readonly>
									<? } ?></td>	
								<td width="700px">
									<? 
									$permit = 0;
									if(($_SESSION['admin'] == 'active') or ($_SESSION['userid'] == $row['conciliator'])){
										$permit = 1;
									}
									if(($row['status'] == 0) and ($permit == 1)){ ?><a href="javascript:saveAction(<? echo $row['id']; ?>);" class="btn btn-xs default btn-editable"><i class="fa fa-refresh"></i></a><? } ?>
									<a data-toggle="modal" href="#long<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i></a>
									
								</td>
								</tr>
									
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                
                                <div>
								  <ul class="pagination pagination-lg">
                                    <?php if($previous != ""){ ?>
                                    <li> <a href="followUp.php?page=<?php echo $previous; ?>&form=1"> <i class="fa fa-angle-left"></i> </a> </li>
                                    <?php }  ?>
                                    <?php
                                    if ( $totpagina > 1 ) {

                                      for ( $i = 1; $i <= $totpagina; $i++ ) {
                                        if ( $pagina == $i ) {
                                          echo '<li class="active"><a href="#">' . $i . '</a></li>';
                                        } else {
                                          echo '<li><a href="followUp.php?page=' . $i . '&form=1">' . $i . '</a></li>';
                                        }
                                      }
                                    }
                                    ?>
                                    <?php if($next != ""){ ?>
                                    <li> <a href="followUp.php?page=<?php echo $next; ?>&form=1"> <i class="fa fa-angle-right"></i> </a> </li>
                                    <?php } ?>
                                  </ul>
							</div>
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ningún registro.

						</p>

					</div>
                                <?php } ?>
                             
                               
						</div>

					</div>
							
						</div></div>	

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

<script type="text/javascript" src="../assets/global/plugins/fancybox/source/jquery.fancybox.js?v=2.1.3"></script>

<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			


		

		});
	</script>
<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 100px 0 50px #222;
			
			height: 80%;
			
		}
		.fancybox-overlay {
			z-index: 999999;
		}
	</style>

<script>

jQuery(document).ready(function() {
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init() // init quick sidebar 
	ComponentsPickers.init();
	TableManaged.init();
});

</script>

</body>
</html>
<script>
function _(id){
	return document.getElementById(id);
}
function saveComment(theId){
	$.ajaxSetup({async:true}); 
	var theComment = document.getElementById('comments_'+theId).value;
	var file = _("file1").files[0];
	var uid = new Date().getTime();
	var formdata = new FormData();
	var totalfiles = document.getElementById('file'+theId).files.length;
   	for (var index = 0; index < totalfiles; index++) {
		
	  var thisFile = document.getElementById('file'+theId).files[index];
	
	  if((thisFile.type == 'image/jpg') || ((thisFile.type == 'image/jpeg'))){
		  //  
	  }else{ 
			alert('El archivo '+thisFile.name+' debe de ser .jpg. ('+thisFile.type+')'); 
			return; 
	  }
      formdata.append("file[]", document.getElementById('file'+theId).files[index]);
	}
	formdata.append("uid", uid);
	formdata.append("id", theId);
	
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", function(event){
		//start progress
		_("status2"+theId).innerHTML = "Cargado "+event.loaded+" bytes de "+event.total;
		var percent = (event.loaded / event.total) * 100;
		_("progressBar"+theId).value = Math.round(percent);
		_("status"+theId).innerHTML = Math.round(percent)+"% Archivo cargado... por favor espere"; 
		//End progress
	}, false);
	ajax.addEventListener("load", function(event){
		//Start load
		_("status"+theId).innerHTML = event.target.responseText;
		_("progressBar"+theId).value = 0;	
	
		$.post("followUpComments.php", { id: theId, comments: theComment, uid: uid }, function(data){
			$("#chat_"+theId).html(data);
			document.getElementById('comments_'+theId).value = '';
			document.getElementById('file'+theId).value = '';
		});
		//End load
	}, false);
	ajax.addEventListener("error", function(event){
		//Start err
		_("status"+theId).innerHTML = "Carga de archivo fallida";
		//Edn err
	}, false);
	ajax.addEventListener("abort", function(event){
		//Start abort
		_("status"+theId).innerHTML = "Carga de archivo cancelada";
		//End abort
	}, false);
	ajax.open("POST", "followupViewFiles.php");
	ajax.send(formdata);
	$.ajaxSetup({async:false}); 

}

function saveAction(theId){
	var theDate = document.getElementById('today_'+theId).value;
	var theBatch = document.getElementById('batch_'+theId).value;
	var theClassification = document.getElementById('classification_'+theId).value;
	if(theDate == ''){
		alert('Debe de ingresar una fecha.');
		return;
	}
	if(theBatch == ''){
		alert('Debe de ingresar un numero batch.');
		return;
	}
	if(theClassification == 0){
		alert('Debe de seleccionar una clasificacion.');
		return;
	}
	
	$.post("followUpCode.php", { id: theId, today: theDate, batch: theBatch, classification: theClassification }, function(data){
		/*$("#chat_"+theId).html(data);
		document.getElementById('comments_'+theId).value	 = '';*/
		document.getElementById('batch_'+theId).readOnly = true;
		document.getElementById('classification_'+theId).readOnly = true;
		$("#row_"+theId).html(data);		
		$("#row_"+theId).addClass("success");
		
});		
}

</script>/	
	