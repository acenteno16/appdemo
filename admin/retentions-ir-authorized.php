<?php 

include("session-retentions.php"); 

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

					Retenciones <small>Autorizados IR</small> 

					</h3>

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
                        <? if(!isset($_GET['company'])){ ?>
                        <li>

							<a href="#">Autorizados IR</a>
                            

						</li>
                        
                        <? }else{ 
                        
                        $querycompany = "select id, name from companies where id = '$_GET[company]'";
                        $resultcompany = mysqli_query($con, $querycompany);
						$rowcompany = mysqli_fetch_array($resultcompany)
                        
                        ?>
                        
                        <li>

							<a href="retentions-ir-authorized.php">Autorizados IR</a>
                            <i class="fa fa-angle-right"></i>
						

						</li>
                        <li>

							
                            <a href="#"><? echo $rowcompany['name']; ?></a>

						

						</li>
                        
                        <? } ?>
                        
                        

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">
<? 
                if(!isset($_GET['company'])){
                ?>    
                <div class="col-md-12">
                <div class="portlet">

						<div class="portlet-title">

							<div class="caption"> Compañías 

							</div>
                            
						</div>

						

					</div>
                    
                    <p>
                    <? $querycompanies = "select id, name from companies";
                        $resultcompanies = mysqli_query($con, $querycompanies);
                        while($rowcompanies=mysqli_fetch_array($resultcompanies)){ ?>
                        <a href="retentions-ir-authorized.php?company=<? echo $rowcompanies['id']; ?>">- <? echo $rowcompanies['name']; ?></a><br>
                        <? } ?>
                    </p>
                
                </div>
                
                <? }else{ ?>
                
<div class="col-md-12">

                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

<? 
								
								$today = date('Y-m-d'); 
$tampagina = 50;
if(isset($_GET['pagination'])){
	$tampagina = $_GET['pagination'];
}

$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

if($_GET['form'] != 1){
	$limit = 100;
}


$querymain = "select * from authorized where company = '$rowcompany[id]'".$sql; 
$resultmain = mysqli_query($con, $querymain);
$nummain = mysqli_num_rows($resultmain);
$totpagina = ceil($nummain / $tampagina);  

//$querymain1 = "select payments.* from payments inner join bills on payments.id = bills.payment inner join hallsretention on payments.ret1id = hallsretention.id where	payments.id > '0' and payments.ret1a > '0' and hallsretention.hall = '$hallid'".$sql." and payments.status >= 13 group by payments.id order by hallsretention.id desc limit ".$inicio.",".$tampagina;
 
$querymain1 = "select * from authorized where company = '$rowcompany[id]' limit ".$inicio.",".$tampagina;
$resultmain1 = mysqli_query($con, $querymain1);

//if($pagina < $totpagina) $next = $pagina+1;
//if($pagina > 1) $previous = $pagina-1;


								echo number_format($nummain,0); ?>	Autorizados <? echo $rowcompany['name']; ?> 

							</div>
                            
                            <div class="actions">

							
                                
                                <a href="retentions-ir-authorized-add.php?company=<? echo $_GET['company']; ?>" class="btn default blue-stripe">
 
								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Agregar Autorizado</span>
 
								</a>

							

							</div>
                            

						</div>

						

					</div>
                    <div class="portlet-body">


								
								<?php  if(($nummain > 0)){ 
                                 ?>                        
						
<div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="2%">

									  ID</th>
                                        <th width="60%"> 

										 Autorizado</th>
                                    
                                    <? if($_GET['company'] == 0){ ?>
                                         <th width="8%"> 

										 Compañía</th>
                                    <? } ?>

									

									<th width="10%">Valido desde</th>

									<? /*<th width="14%">

										 Estado  

									</th>*/ ?>

									<th width="10%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
							while($row=mysqli_fetch_array($resultmain1)){
                                
                                ;
                                
						?>
                                <tr role="row" class="odd <?php if($row['imiprinted'] == 1) echo 'success'; if($rowmain['void']) echo " danger"; ?>">  
                                  <td><?php echo $row['id']; ?></td>
                                  <td><? 
								  
									echo $row['authorized'];
								  
									?></td>
                                  <? if($_GET['company'] == 0){ ?>
                                    <td><?php echo $rowcompany['name']; ?></td>
                                    <? } ?>
                                  
                            
                                  <td><?php echo $row['today']; ?></td>
                                  <? /* <td><?php 
								
								if($row['mayorstage'] == 0){
									
									$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc")); 
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'")); 
									echo $rowstage['content']; 
								}else{
								$querymayorstage = "select * from mayorstages where id = '$row[mayorstage]'";
								$resultmayorstage = mysqli_query($con, $querymayorstage);
								$rowmayorstage = mysqli_fetch_array($resultmayorstage);
								echo $rowmayorstage['name']; 
								}
								?> 
									
							
								
							</td>*/ ?><td><a href="retentions-ir-authorized-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a>
                           
                            </td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                </div>
                               
   

   <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="payments.php?page=<?php echo $previous; ?>&status=<?php echo $_GET['status']; ?>&hall=<?php echo $_GET['hall']; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
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
		  echo '<li><a href="'.str_replace('/admin/','',$_SERVER['SCRIPT_NAME']).'?page='.$i .'&status='.$_GET['status'].'&hall='.$_GET['hall'].'&provider='.$_GET['provider'].'&from='.$_GET['from'].'&to='.$_GET['to'].'&request='.$_GET['request'].'&bill='.$_GET['bill'].'&form=1">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="payments.php?page=<?php echo $next; ?>&status=<?php echo $_GET['status']; ?>&hall=<?php echo $_GET['hall'];  ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
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

							NOTA: No se encontró ningúna autorizado.

						</p>

					</div>

                        
            
               	  <?php } ?>

			</div>
                
                <? } ?>

			<!-- END PAGE CONTENT-->

		</div>

	</div>

	<!-- END CONTENT --> 

	<!-- BEGIN QUICK SIDEBAR -->

    <?php include("sidebar.php"); ?>

<!-- END QUICK SIDEBAR -->

    </div></div></div></div>

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