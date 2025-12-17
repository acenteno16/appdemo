<?php include("session-consultation.php");

$id = $_GET['id'];
$query = "select * from payments where id = '$id'"; 
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$thestatus = $row['status'];

$rowtype = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[type]'"));

$rowconcept = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept]'"));
$rowconcept2 = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept2]'"));
$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));

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

			


			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

		
            <div class="row">

				<div class="col-md-12">
                
                

					
                    
                            
                            <div class="tabbable tabbable-custom boxless tabbable-reversed">

						

    

							<div class="col-md-6" style=" height: 550px; overflow : auto;">

						

									


										<!-- BEGIN FORM-->

										<form action="payment-insurers-view-code.php" class="horizontal-form" method="post" enctype="multipart/form-data">

											
	<?php include("stage-main.php"); 
											
											
											
											
											?>
                                              
                                           
                                 
                                 
            


							<div class="form-actions right" style=" margin-top:100px;">


                                              <button type="submit" class="btn blue" name="save" id="save"><i class="fa fa-check"></i> Actualizar</button>
											  <input name="id" type="hidden" id="id" value="<? echo $_GET['id']; ?>">  
											    </span>
											</div>

										</form>

										<!-- END FORM-->



								

							
							</div></div>
               <div class="col-md-6" style="float: right; height: 550px; overflow : auto;">
       
                <div class="row">
                                                  <!--/span--> 
                                              <?php $query2 = "select * from files where payment = '$id' order by id asc";
											  $result2 = mysqli_query($con, $query2);
											
											  while($row2=mysqli_fetch_array($result2)){
												
											  ?>
           
                                               <?php if(($gvisor == 1) or ($_GET['visor'] == 1) or ($_SESSION['email'] == 'jairovargasg@gmail.com')){  
											   
$url = urlProcessor($row2['link'],1,0);

$queryofile = "select * from filebox where url = '$url'"; 
$resultofile = mysqli_query($con, $queryofile);
$rowofile = mysqli_fetch_array($resultofile); 

$thefile = urlProcessor($rowofile['name'],3,$rowofile['user']);
if(!file_exists($thefile)){
	$thefile = "files/nofile.pdf";
}

?>

</p>       
<div style="text-align:center;"><iframe src="<?php echo $thefile; ?>" style="width:95%; height:700px; border: 10px solid #21355d;" frameborder="0"></iframe>
<br><br>
</div> 
<?php
$filename = $_SERVER['SCRIPT_NAME'];
$filenamearr = explode('/',$filename);
$filenamesize = sizeof($filenamearr);
$filenamesize--;
$filename = $filenamearr[$filenamesize];
if($filename == 'file-review-detail-check.php'){
?>



<?php
}
?>
 <?php  } 
											  else{ ?>
                         
<div class="col-md-10 ">
													  <div class="form-group">
										        <input name="file[]" type="text" class="form-control" id="file[]"  placeholder="Ej: http://www.ejemplo.com" value="<?php echo $row2['link']; ?>" readonly><br><div class="row"></div></div></div>      
                                                       
                                                    <div class="col-md-2 ">
                             <a href="<?php  
							 echo str_replace('www.','',$row2['link']);
							 ?>" class="btn blue" target="new">
											<i class="fa fa-file-o"></i> &nbsp;Abrir</a> 
                                                                                                      </div>                                                     
                         
<?php } ?>                                                                             
                                                                                                      
<?php 
} 
 
 
 if(($gvisor == 1) or ($_GET['visor'] == 1)){ 
 ?>
 <div class="row"></div>
<div style="text-align:right; margin-right:30px;">

<input name="aorder" type="checkbox" id="aorder" value="1" <?php if($rowreview['aorder'] == 1) echo 'checked'; ?>> Archivos de solicitud 
</div>
<?php } ?>                                              </div>                                 
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


<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script src="../assets/admin/pages/scripts/components-pickers.js"></script>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


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