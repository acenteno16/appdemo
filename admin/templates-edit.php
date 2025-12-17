<?php include("sessions.php"); 

$id = $_GET['id'];

$query = "select * from templates where id = '$id'";
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

			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

				<div class="modal-dialog">

					<div class="modal-content">

						<div class="modal-header">

							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

							<h4 class="modal-title">Modal title</h4>

						</div>

						<div class="modal-body">

							 Widget settings form goes here

						</div>

						<div class="modal-footer">

							<button type="button" class="btn blue">Save changes</button>

							<button type="button" class="btn default" data-dismiss="modal">Close</button>

						</div>

					</div>

					<!-- /.modal-content -->

				</div>

				<!-- /.modal-dialog -->

			</div>

			<!-- /.modal -->

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN STYLE CUSTOMIZER -->

			

			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Plantillas <small>Plantillas de distribución</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						

						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="templates.php">Plantillas</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							Plantillas de distribución de pago

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

						

					
<div class="note note-regular">
									<p>
							                            <strong>Nombre:</strong>	<?php echo $row['name']; ?>	<br>
                                                          <strong>Agregado el día:</strong> <?php echo date('d/m/Y',strtotime($row['today'])); ?><br>
                                                            <strong>Agregado por:</strong>	<?php $rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
										echo $rowuser['first']."".$rowuser['last'];					
															
															?><br>
                                                                      <strong>Comentarios:</strong>	<?php echo $row['comments']; ?>
</p>
									 
								</div>
							

							<div class="tab-pane" id="tab_1">

								<div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

											<?php //Form Sample ?>

									  </div>

										<?php /*<div class="tools">

											<a href="javascript:;" class="collapse">

											</a>

											<a href="#portlet-config" data-toggle="modal" class="config">

											</a>

											<a href="javascript:;" class="reload">

											</a>

											<a href="javascript:;" class="remove">

											</a>

										</div>*/ ?>

									</div>

									<div class="portlet-body form"> 

										<!-- BEGIN FORM-->

										<form action="templates-view-code.php"	 method="post" enctype="multipart/form-data" class="horizontal-form" onsubmit="return validateForm();">  

											<div class="form-body">

												<h3 class="form-section">Plantilla de distribución del gasto</h3>


<?php $querydistributtemplatescontention = "select * from  where template = '$_GET[id]'";
$resultdistribution = mysqli_query($con, $querydistribution);
$numdistribution = mysqli_num_rows($resultdistribution);

?>
												<div class="row" id="distribution">

													

													<!--/span-->

													<div id="ddistribucion3" style="margin-left:20px;">  <?php if($numdistribution == 0){
													?>
                                                    	                                      									<div class="row">
 
 
<div class="col-md-2 ">
													  <div class="form-group">
														<label>Unidad:</label>
                                                        <input name="unit[]" type="text" class="form-control" id="unit[]" value="" >
						
           </div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Cuentas:</label>
                                                        <input name="accounts[]" type="text" class="form-control" id="accounts[]" value="">
						
           </div>
													</div>
                                                    
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<label>Porcentaje:</label>
                                                        <input name="percent[]" type="text" class="form-control" id="percent[]" value="" onKeyUp="javascript:reloadNumbers(this.value);" onkeypress="return justNumbers(event);"> 
                                                        
						
             </div>
													</div>  
                                                   
                                                    </div>
                                                   
      <?php }else{ 
	  $lessb = 0;
	  while($rowdistribution=mysqli_fetch_array($resultdistribution)){
		  $rtotal += $rowdistribution['percent'];
	  ?>
      <div class="row" id="distribution1-<?php echo $lessb; ?>">
 
 
<div class="col-md-2 ">
													  <div class="form-group">
														<?php if($lessb == 0){ ?><label>Unidad:</label><?php } ?>
                                                        <input name="unit[]" type="text" class="form-control" id="unit[]" value="<?php echo $rowdistribution['unit']; ?>" > 
						
           </div>
													</div>
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<?php if($lessb == 0){ ?><label>Cuentas:</label><?php } ?>
                                                        <input name="accounts[]" type="text" class="form-control" id="accounts[]" value="<?php echo $rowdistribution['account']; ?>">
						
           </div>
													</div>
                                                    
                                                    <div class="col-md-2 ">
													  <div class="form-group">
														<?php if($lessb == 0){ ?><label>Porcentaje:</label><?php } ?>
                                                        <input name="percent[]" type="text" class="form-control" id="percent[]" value="<?php echo $rowdistribution['percent']; ?>" onKeyUp="javascript:reloadNumbers(this.value);" onkeypress="return justNumbers(event);"> 
                                                        
						
             </div>
													</div>  
                                                   
                                                    <?php if($lessb != 0){
		?> 
		<div class="col-md-2 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow1(<?php echo $lessb; ?>);">-</button></div></div>
		<?php }
	  $lessb++;
	  ?>
                                                    </div>
     <?php } }?>                                              <div id="distributionwaiter">
                                                    </div>
                                                    <div class="col-md-1 ">
 <button type="button" class="btn blue" onClick="addDistribution();">+</button>
 <br><br>&nbsp;
 </div>
 <div class="row">
 <br>
<br>
</div>
 <div class="row"> 
 <?php $query2 = "select * from templatescontent";
 $result2 = mysqli_query($result2);
 while($row2=mysqli_fetch_array($result2)){
	 $rtotal += $row2['percent']; 
 }
 ?>
  <div class="col-md-2 ">
													  <div class="form-group">
														<label>Total:</label>
                                                        <input name="rtotal" type="text" class="form-control" id="rtotal" readonly value="<?php echo $rtotal; ?>" >
						
                                                        <input name="template" type="hidden" id="template" value="<?php echo $_GET['id']; ?>">
							  </div>
													</div>
                                                    </div>                                         
        </div>
                                                    <script type="text/javascript">
var distributioni = 1;
function addDistribution(){
   var distributionboxadd = '<div class="row" id="distribution'+distributioni+'"><div class="col-md-2 "><div class="form-group"><input name="unit[]" type="text" class="form-control" id="unit[]" value=""></div></div><div class="col-md-2 "><div class="form-group"><input name="accounts[]" type="text" class="form-control" id="accounts[]" value=""></div></div><div class="col-md-2 "><div class="form-group"><input name="percent[]" type="text" class="form-control" id="percent[]" value="" onKeyUp="javascript:reloadNumbers(this.value);" onkeypress="return justNumbers(event);"></div></div><div class="col-md-2 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+distributioni+');">-</button></div></div></div>';
     distributioni++; 
	 $("#distributionwaiter").append(distributionboxadd);
	
  
}
</script>  
                                                   <script>
function deleteRow(id){
	//document.getElementById("distribution"+id).style.display = 'none';
	var node = document.getElementById("distribution"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
reloadNumbers();
}

function deleteRow1(id){
	//document.getElementById("distribution"+id).style.display = 'none';
	var node = document.getElementById("distribution1-"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
reloadNumbers();
}
 </script>
                                                   

													<!--/span-->

												</div> 
                                               

												<!--/row--><!--/row-->

												

												<!--/row-->

												<div class="row"></div>

										    <!--/row--></div>

											<div class="form-actions right">

												<button type="button" class="btn default">Cancelar</button>

												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Actualizar</button>

											</div>

										</form>

										<!-- END FORM-->

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

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/form-samples.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>
jQuery(document).ready(function() {       
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
}); 
		
function validateForm(){
			i=0;
for (var obj in document.getElementsByName('unit[]')){
 if (i<distributioni){ 
 
varunit = document.getElementsByName('unit[]')[i].value;
if(varunit == ''){
	alert('El campo unidad no puede estar en blanco');
	return false;
}

accounts = document.getElementsByName('accounts[]')[i].value;
if(accounts == ''){
	alert('El campo cuenta no puede estar en blanco');
	return false;
}

percent = document.getElementsByName('percent[]')[i].value;
if(percent == ''){
	alert('El campo porcentaje no puede estar en blanco');
	return false;
}
rtotal = document.getElementById('rtotal').value;
if(rtotal != 100.00){
	alert('El total debe de ser 100'); 
	return false;
}


}
  
  i++;
}
		}

function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }
		
		
		
function reloadNumbers(thenumber){	

	
	var rtotal=0;
	i=0;
	for (var obj in document.getElementsByName('unit[]')){
	if (i<document.getElementsByName('percent[]').length){
 
   tpercent = document.getElementsByName('percent[]')[i].value;
   if(tpercent == ""){
	   tpercent = 0;
  }
   rtotal += parseFloat(tpercent);
  }
  i++;
  }
   
  document.getElementById("rtotal").value = rtotal.toFixed(2);

}

    </script>
    
    

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>