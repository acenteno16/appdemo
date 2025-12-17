<?php 

include("sessions-reports-special-payments.php"); 
include("functions.php"); 

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
<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.flot.pie.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.flot.stack.js"></script>

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

					Reportes <?php //<small>Ordenes de pago</small> ?> 
					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

				
                        <li>

							<a href="#">Reportes</a>

						 <i class="fa fa-angle-right"></i>

						</li>
                         <li>
                             <a href="report-special-payments-home.php">Pagos Especiales</a>
                                <i class="fa fa-angle-right"></i>
						</li>
                        <li>
							<a href="#">Remisiones</a>
						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->
             
            
            <div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<!-- END PAGE TITLE & BREADCRUMB-->
                    
                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">
                            <?php
							
								if(isset($_GET['no'])){
									$tampagina = $_GET['no'];
								}else{
									$tampagina = 25; 
								}
								
								if(!isset($_GET['page'])){
									$inicio = 0;
									$pagina = 1;
								}else{
									$inicio=($_GET['page']-1)*$tampagina; 
								}

								$query = "select payments.id from payments".$inner." where payments.child = '0' and payments.d_approve = '1' and payments.sent < '2' group by payments.id order by payments.expiration asc";    
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								$totpagina = ceil($num / $tampagina);    
								
								$query1 = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.client, payments.currency, payments.payment, payments.expiration, payments.description, payments.blockschedule, payments.company, payments.immediate, payments.parent, payments.d_approve, payments.userid from payments".$inner." where payments.child = '0' and payments.d_approve = '1' and payments.sent < '2' group by payments.id order by payments.expiration asc limit ".$inicio.",".$tampagina;  
								$result1 = mysqli_query($con, $query1); 
								if($pagina < $totpagina) $next = $pagina+1;
								if($pagina > 1) $previous = $pagina-1;	
							
								
								if(($_GET['echo'] == 1)){  
	 								echo 'Query: '.$query1; 
                                    echo '<br>SQL: '.$sql; 
 								}
 
 
								?>
								<?php echo $num; ?> Solicitudes

							</div>
                            
                            

							<div class="actions">  

								
                                
                                <a href="report-special-payments-remission-excel.php" class="btn default blue-stripe">

								<i class="fa fa-file-excel-o"></i>

								<span class="hidden-480">

								Exportar</span>

								</a>

							

							</div>

						</div>

                        
                   
                    <div class="portlet-body">
                        
                        

							<div class="table-container">
                            <div class="table-scrollable">
                     
								<?php  
								
								if($num > 0){ ?> 	
                             
                                
                                <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%" class="table-checkbox">

								<input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll(),calculateBalance();" /> 
                                
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

								</th>
                               
                                    <th width="3%">

										 COMP
                                         
                                         </th>
                                         <th width="3%">

										 ID
                                         
                                         </th>

									<th width="35%">

										 Beneficiario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

									<th width="20%">Total Pagar</th>

									<th width="20%">

										 Vencimiento

									</th>

									<th width="5%">

										 Estado

									</th>
                                    
                                    <th width="80%">

										 Descripción &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

									</th>
                                    
                                    <th width="5%">

										 Solicitante

									</th>
                                    <th width="5%">

										 Contador

									</th>
                                    <th width="5%">

										 Provision

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
								
								while($row=mysqli_fetch_array($result1)){
								
								$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']);
								switch($row['btype']){
									case 1:
									$querybankp = "select * from providers_plans where provider = '$row[provider]'";
									$resultbankp = mysqli_query($con, $querybankp);
									$thebank = "";
									while($rowbankp=mysqli_fetch_array($resultbankp)){ 
										$thebank.= $rowbankp['bank'].',';	
									}  
									break;
									case 2:
									$thebank = "1,";
									break;
									case 3:
									$thebank = "1,";
									break;
									case 4:
									$thebank = "1,"; 
									break; 
								}
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
                                $queryProvision = "select userid, today from times where payment = '$row[id]' and stage = '8.05' order by id desc limit 1";
                                $resultProvision = mysqli_query($con, $queryProvision);
                                $rowProvision = mysqli_fetch_array($resultProvision); 
                                    
                                $requester = getUser($row['userid']);
                                $accountant = getUser($rowProvision['userid']);  
                                $provisionDate = date('d-m-Y',strtotime($rowProvision['today']));
                                    
								?>
                                
                                <tr role="row" class="odd <? if($rowstagemain['stage'] == 13.02) echo 'warning'; ?>" <?php if($rowprovider['flag'] == 1) echo 'id="div2blink"'; ?>> 
                                 <td class="sorting_1" id="maintheid<?php //echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="checkboxes" onChange="calculateBalance();"></td>
                               
                              
                                
									<td><? 
										$querycomp = "select abb from companies where id = '$row[company]'";
										$resultcomp = mysqli_query($con, $querycomp); 
										$rowcomp = mysqli_fetch_array($resultcomp);
										echo $rowcomp['abb']; 
											?></td>
                                <td><?php echo $row['id']; ?>
 
</td><td><? if($row['d_approve'] == 1) echo '<img src="../images/flag-blue.png" width="13" alt=""/> '; ?><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; echo $ben_name; ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); ?>
                                  <? $thebank = substr($thebank,0,-1); ?>
                                  <input name="tpayment[]" type="hidden" id="tpayment[]" value="<?php echo $row['payment']; ?>">
                                  <input name="tcurrency[]" type="hidden" id="tcurrency[]" value="<?php echo $row['currency']; ?>">
                                  <input name="tbank[]" type="hidden" id="tbank[]" value="<?php echo $thebank; ?>">
                                  <input name="tcompany[]" type="hidden" id="tcompany[]" value="<?php echo $row['company']; ?>">
                                  
                                  </td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.abs($dias).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.abs($dias).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.-1*abs($dias).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
?></td>
                                    
                                    
                                <td>
                                        
                                       <?php 
									
									   $alert_str = "";
									
									   $alert_str = "Solicitado: ".date('d-m-Y',strtotime($row["today"]))." \\n"; 
									   if($row['approved'] == 2){
										   
										  
											$void_data = "";
											$rowreject = mysqli_fetch_array(mysqli_query($con, "select today, comment, reason from times where payment = '$row[id]' order by id desc limit 1"));	
											
											if($rowreject['comment'] != ""){
												$void_data.= $rowreject['comment']." \\n";
											}
											 $void_data.= "Motivo de Rechazo: ";
											 
											 if($row['reason'] > 0){
										   	    $rowreject0 = mysqli_fetch_array(mysqli_query($con, "select name from reason where id = '$row[reason]'"));
												$void_data.= $rowreject0['name']." \\n";
											}
											
											if($rowreject['reason'] != ""){
												$void_data.= $rowreject['reason']." \\n";
											}
											
										   
										   $alert_str.= "Rechazado: ".date('d-m-Y',strtotime($rowreject["today"]))." \\n";
										   $alert_str.= $void_data; 
									   }
										if($row['status'] >= '12'){
										   
										$alert_str.= 'Progrmado para: '.$row['schedule']." \\n";
										   
									   }
										if($row['status'] == '14'){ 
										   
										$querycancellation = "select today from times where stage = '14' and payment = '$row[id]'"; 
										$resultcancellation = mysqli_query($con, $querycancellation);
										$rowcancellation = mysqli_fetch_array($resultcancellation);
										$cancellationdate = date('d-m-Y',strtotime($rowcancellation["today"]));
										$alert_str.= "Fecha de cancelacion: ".$cancellationdate." \\n";
										$alert_str.= "CKPK: ".$row['cnumber']." \\n";
										
										$querybank = "select name from banks where id = '$row[bank]'";
										$resultbank = mysqli_query($con, $querybank);
										$rowbank = mysqli_fetch_array($resultbank);
										$cancellationbank = $rowbank['name']." \\n";
										$alert_str.= "Banco: ".$cancellationbank;
										$cancellationref = $row["reference"]." \\n"; 
									    $alert_str.= "Referencia: ".$cancellationref." \n"; 
									   }
									   
		
									
									
									
										
										?>
                                        <a href="javascript:alert('<?php echo $alert_str; ?>');"><?php  
										
										

$rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
						
if(($rowstatus['stage2'] != "0.00") and ($rowstatus['stage2'] != "")){  
								$color == "yellow";
								if($rowstatus['color'] != ""){
									$color = $rowstatus['color']; 
								}
								echo '<button type="button" class="btn '.$color.'">'.$rowstatus['stage2'].'</button>';
							}else{    
							$querystage = "select * from stages where id = '$rowstatus[stage]'";
								$resultstage = mysqli_query($con, $querystage);
								$rowstage = mysqli_fetch_array($resultstage);
								echo $rowstage['content'];
							}
								 
								 
								 echo "</a>"; ?>  
                                        
                                      
							
								
							</td>
                                    
                            <td>
                            <?php echo $row['description'];  ?>
                            </td>
                                    <td><? echo $requester; ?></td>
                                    <td><? echo $accountant; ?></td>
                                    <td><? echo $provisionDate; ?></td>
                                    
                            <td>
                           
                            <a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> 
                                
                             
                            </td></tr>
                               
                               <? if($rowstagemain['stage'] == 13.02){ ?>
                               <tr>
                               <td colspan="10" class="warning">
                               <? if($rowstagemain['reason'] != ""){
									echo $rowstagemain['reason'];
								}else{
								   echo "Sin comentarios de exclusión.";
								}
								?>
								  </td>
									</tr>
                               
                               <? } ?>
                                <? if($row['immediate'] == '1'){ ?>
                               <tr>
                               <td colspan="10" class="success">
                               PAGO INMEDIATO
								  </td>
									</tr>
                               
                               <? } ?>
                                <?php } 
								?> 
                                    </tbody>

								</table>
                              
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?> 
                  
                 <li>
										<a href="">
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
		  echo '<li><a href="?page='.$i.$get_string.'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                                
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay nungun resultado

						</p>

					</div>
                                <?php } ?>
                  
                               
                               

					</div>
                    
                    </div>

					<!-- End: life time stats -->

				</div>

				</div> </div>

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
<?php /*
<script src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
*/ ?>
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

<script src="../assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>



<script src="../assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>

<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->

<script src="../assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<?php ?> 
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/clockface/js/clockface.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<?php ?>

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/index.js" type="text/javascript"></script>

<script src="../assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>
<script src="../assets/admin/pages/scripts/components-pickers.js"></script>

	<!-- END PAGE LEVEL SCRIPTS -->

<script>

jQuery(document).ready(function() {    

   Metronic.init(); // init metronic core componets

   Layout.init(); // init layout

   QuickSidebar.init() // init quick sidebar

   Index.init();   

   Index.initDashboardDaterange();

   Index.initJQVMAP(); // init index page's custom scripts



   Index.initCharts(); // init index page's custom scripts

   Index.initChat();

   Index.initMiniCharts();


   ComponentsPickers.init(); 

});

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>

