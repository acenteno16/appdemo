<?php include("session-review.php");

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
									 <h4 style="">Detalles del paquete:</h4>
                
               <br><p>
<?php $rowpackagecontent = mysqli_fetch_array(mysqli_query($con, "select * from packagescontent where payment = '$row[id]'"));
$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
$rowunit = mysqli_fetch_array(mysqli_query($con, "select * from units where code = '$rowuser[unit]'"));
$numfiles = mysqli_num_rows(mysqli_query($con, "select * from files where payment = '$row[id]'"));
$rowtime = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id asc limit 1"));

?>							                          <?php /*  <strong>ID de remisión:</strong> <?php echo 'r'.$rowpackagecontent['package']; ?><br>*/ ?>
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
                                    <form action="file-review-detail-approve-code.php" method="post" enctype="multipart/form-data" id="fcheck" name="fcheck" onsubmit="return validateForm();">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 IDA</th>

									<th width="15%">Nombre</th>

									<th width="15%">Link</th>

								

									<th width="10%">Comentarios

										 </th>

								</tr>

								</thead>

								<tbody>
                                                                
                                <?php while($rowfile=mysqli_fetch_array($resultfile)){
							if($rowfile['status'] != 4){	
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
                                <td><a href="<?php echo $rowfile['link']; ?>" class="btn btn-xs default btn-editable" target="new"><i class="fa fa-link"></i> <?php echo $rowfile['link']; ?></a> </td>
                                <td><input name="id[]" type="hidden" id="id[]" value="<?php echo $rowfile['id']; ?>">
                                <input name="name[]" type="hidden" id="name[]" value="<?php echo $rowfile['name']; ?>">                                  <input name="comments[]" type="text" class="form-control" id="comments[]" value="<?php echo $rowfile['comments']; ?>" placeholder=""></td>
                                    </tr>
                                    <?php } } ?>
                                                                </tbody>

								</table>
                                  <div class="form-actions right">


												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Arobar paquete incompleto</button> <input type="hidden" id="payment" name="payment" value="<?php echo $row['id']; ?>">
                                                
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


function validateForm(){

		
		i=0;
for (var obj in document.getElementsByName('comments[]')){
 if (i<document.getElementsByName('comments[]').length){
comments =  document.getElementsByName('comments[]')[i].value;
name =  document.getElementsByName('name[]')[i].value;
if(comments == ""){
	alert('Usted debe de ingresar un comentario para justificar la fatlta del archivo '+name);
	return false;
}

  }
  i++;
}
		
}

</script>

    


<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>