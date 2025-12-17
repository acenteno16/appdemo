<?php include("session-financemanager2.php"); ?>
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

					Firmas Liberadoras <small>Consultas</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Firmas Liberdoras</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        
                          <li>

							<a href="#">Consultas</a>

							

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

						
<? 

$tampagina = 100;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}


$query = "select * from schedule where status > '3' order by id desc"; 
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);       
 

$query1 = "select * from schedule where status > '3' order by id desc limit ".$inicio.",".$tampagina;  
$result1 = mysqli_query($con, $query1);
$num1 = mysqli_num_rows($result1); 

if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;

?>
                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						<? echo $numdev; ?> Grupos de programación

							</div>
                            

						</div>

						

					</div>
                    <div class="portlet-body">			
<?php


						
if($num > 0){ ?> 
                                
<?php //echo $query; ?>
<div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<?php /*<th width="2%">
                                    <input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll();" /> 
                                
                                  <script>
    function checkAll(){
	 var checkall = document.getElementById('checkall');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByName('theid[]');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			
         
      }
	}
      </script>

										 </th>*/ ?>
                                         <th width="1%">GID</th>
                                          <th width="1%">

										WID</th>

									<th width="10%">

										 Usuario</th>

									<th width="2%">Fecha</th>

									<th width="5%">

										 Hora</th>

									<th width="14%">

										 Monto

									</th>
                                    
                                    <th width="2%">

										 Moneda 

									</th>
                                       <th width="2%">

										 Estado 

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
								
							  
							
							
									
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$rowuser= mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"> 
                                <?php /*<td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>*/ ?>
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php 
								  $code = str_replace('/','<br>',$row['code']);
								  $code = str_replace(',','<br>',$code);
								  echo $code;
								   ?></td>
                                  <td><?php echo $rowuser['first']." ".$rowuser['last']; ?></td>
                                  <td><?php echo date('d-m-Y',strtotime($row['today'])); ?><br>
                                    
</td><td><?php echo date('h:i:s a', strtotime($row['now2'])); ?></td>
                                
                               <td>
                               
                               <?php 
							   switch($row['currency']){
								  case 1:
								  $pre = "NIO C$";
								  $currency = "Cordobas";
								  break;
								  case 2:
								  $pre = "USD U$";
								  $currency = "Dolares";
								  break;
								  case 3:
								  $currency = "Euros";
								  break;
								  case 4:
								  $currency = "Yenes";
								  break;
							  }
							  
							   $querymain = "select * from schedulecontent where schedule = '$row[id]'"; 
								$resultmain = mysqli_query($con, $querymain);
								$gpayment = 0;  
								while($rowmain = mysqli_fetch_array($resultmain)){
									$querypayment = "select * from payments where id = '$rowmain[payment]'";
									$resultpayment = mysqli_query($con, $querypayment);
									$rowpayment = mysqli_fetch_array($resultpayment); 
									$gpayment+=$rowpayment['payment']; 
								}
								
								echo $pre.str_replace('.00','',number_format($gpayment,2));
								
							   ?>
                               
                               </td>
                               
                                <td><?php 
								echo $currency;
								?> 
									
							
								
							</td>
                            <td>
                            <? 
							
							$querystatus = "select * from schedulestages where id = '$row[status]'";
							$resultstatus = mysqli_query($con, $querystatus);
							$rowstatus = mysqli_fetch_array($resultstatus);
							
							echo $statusname = $rowstatus['name'];
							
							?>
                            </td>
                            <td><a href="approve-cfo-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                            
                            
                            </td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                </div>
                                
                                
                                <br>
                                <div class="note note-regular">
                                GID: ID de grupo.<br>
                                WID: ID web.<br>
                                
                                </div>
                                       <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="approve-rs-group.php?page=<?php echo $previous; ?>">
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
		  echo '<li><a href="approve-rs-group.php?page='.$i .'">'.$i .'</a></li>';  
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="approve-rs-group.php?page=<?php echo $next; ?>"> 
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>              
 <?php } else { 
							
								?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No se encontró ningún grupo de programación.

						</p>

					</div>
                                <?php } ?>
                                </div></div></div>
                             
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

<script src="../assets/admin/pages/scripts/table-managed.js"></script> 

<!-- END PAGE LEVEL SCRIPTS -->

<script>
jQuery(document).ready(function() {    
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
TableManaged.init(); 
});

</script> 

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>