<?php 

include("session-schedule.php"); 
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

					Pendientes de CC<?php //<small>Ordenes de pago</small> ?> 
					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

				
                        <li>

							<a href="payment-schedule.php">Pendientes de CC</a>

						

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			
           
            <div class="row"> 

				<div class="col-md-12"><!-- Begin: life time stats -->



<div class="row"></div>
                             
                                
				  <form id="theform" name="theform" action="payment-schedule-code.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">	
               
               
              <? //note
			  /* <div class="row">
               <div class="col-md-12">
               <div class="note note-success">
               
              MANTENIMIENTO FINALIZADO. FAVOR REPORTAR CUALQUIER PROBLEMA A jairovargasg@gmail.com
              </div>
              </div>
               </div> */ ?>
                <div class="portlet">

						<div class="portlet-title">

							<div class="caption">
                            <?php
						
								
							
								
								
								

							
							
							
								if(isset($_GET['no'])){
									$tampagina = $_GET['no'];
								}else{
									$tampagina = 50;
								}
								
								
								if(!isset($_GET['page'])){
									$inicio = 0;
									$pagina = 1;
								}else{
									$inicio=($_GET['page']-1)*$tampagina;
								}

								
								$query = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.payment, payments.expiration, payments.description, payments.blockschedule from payments".$inner." where payments.child = '0' and payments.approved = '1' and payments.sent_approve = '0' and payments.status >= '12'".$sql." group by payments.id order by payments.expiration asc";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								$totpagina = ceil($num / $tampagina);    
								
								$query1 = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.client, payments.currency, payments.payment, payments.expiration, payments.description, payments.blockschedule, payments.company, payments.immediate, payments.parent, payments.d_approve from payments".$inner." where payments.child = '0' and payments.approved = '1' and payments.sent_approve = '0' and payments.status >= '12'".$sql." group by payments.id order by payments.expiration asc limit ".$inicio.",".$tampagina;  
								$result1 = mysqli_query($con, $query1); 
								if($pagina < $totpagina) $next = $pagina+1;
								if($pagina > 1) $previous = $pagina-1;	
							
								
								if(($_GET['echo'] == 1)){ 
	 								echo $query1; 
 								}
 
 
								?>

								<?php echo $num; ?> Solicitudes

							</div>
                            
                            

							<div class="actions">

								<?php /*
								<a href="payment-schedule-print.php" class="btn default blue-stripe">

								<i class="fa fa-print"></i>

								<span class="hidden-480">

								Imprimir</span>

								</a>
                                
                                <a href="payment-schedule-manual.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Prog. manual</span>

								</a>
								*/ ?>
                                
                                <a href="#" class="btn default blue-stripe">

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
                                    <th width="8	0%">

										 Descripción &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

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
                            <td>
                            <?php 
							
							if($row['blockschedule'] == ""){ ?> 
                            <a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> <?php }else{  
							
							$queryuser = "select * from workers where code = '$row[blockschedule]'";
							$resultuser = mysqli_query($con, $queryuser);
							$rowuser = mysqli_fetch_array($resultuser);
							$initial = $rowuser['first'];
							$initial = $initial[0];
							$lastname = explode(" ",$rowuser["last"]);
							$username = $initial.". ".$lastname[0];
							?> 
                            
                      <a href="<?php if($row['blockschedule'] == $_SESSION['userid']){ echo "payment-schedule-view.php?id=".$row['id']; }else{ echo 'payment-view.php?id='.$row['id']; } ?>" class="btn btn-xs default btn-editable"><i class="fa fa-lock"></i> <?php echo $username; ?></a>      
                            <?php } ?>
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
										<a href="payment-schedule.php?page=<?php echo $previous.$get_string; ?>">
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
		  echo '<li><a href="payment-schedule.php?page='.$i.$get_string.'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="payment-schedule.php?page=<?php echo $next.$get_string; ?>">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                                
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna programación pendiente.

						</p>

					</div>
                                <?php } ?>
                            
                    <?php if($num > 0){ ?>	 
                               
                               

					</div>
                    <div class="form-actions right">


										<div class="row"> 	
                                        
                                        
<div class="col-md-3"><input name="schedule" type="text" class="form-control form-control-inline date-picker" id="schedule[]" value=""></div>
<div class="col-md-3">                       <select name="schedulebank" class="form-control" id="schedulebank" style="margin-top:1px;">
<option value="0">Banco</option>
<?php $querybanks = "select * from banks order by name";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){
?>
<option value="<?php echo $rowbanks['id']; ?>"><?php echo $rowbanks['name']; ?></option>
<?php } ?>
 
</select> 
</div>
<div class="col-md-3">

													  <div class="form-group">
											<select name="pp" class="form-control  select2me" id="pp" data-placeholder="Seleccionar...">

												<option value="">Todos los procesadores</option>
 										<?php 
											$querypp = "select * from routes where type = '7' group by worker";
									   		$resultpp = mysqli_query($con, $querypp);
									   		
											while($rowpp = mysqli_fetch_array($resultpp)){
										
											$queryproviders = "select * from workers where code = '$rowpp[worker]'";
											$resultproviders = mysqli_query($con, $queryproviders); 
											$rowproviders = mysqli_fetch_array($resultproviders);
											?>
                                            <option value="<?php echo $rowproviders["code"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option> 
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
				    </div>

										  </div>                                           	
                                           	
                                           	
                                           	
                                           	
                                            	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Programar</button>
                                            

    <div class="row"></div>
    <div class="col-md-6">
    <p>Total programación: <span id="thenumbersum">0.00</span></p>
    </div>
    </div>
     <?php } ?>
                                
                               

					</div>
                    </div>

					<!-- End: life time stats -->

				</div>
                </form>
                
           
                
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


<script>

jQuery(document).ready(function() {    
 Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar 
ComponentsPickers.init();
TableManaged.init();


        });


function expirationFn(){
	var varuno = 0;
	var vardos = 0;
	var vartres = 0;
	var vartotal = 0;
	
	var uno = document.getElementById('expiration1').checked;
	var dos = document.getElementById('expiration2').checked;
	var tres = document.getElementById('expiration3').checked;
	
	if(uno == true){
		var varuno = 1;
	}
	if(dos == true){
		var vardos = 1;
	}
	if(tres == true){
		var vartres = 1;
	}
	vartotal = varuno+vardos+vartres;
	if(vartotal > 1){
		
		document.getElementById('expiration1').checked = false;
		document.getElementById('expiration2').checked = false;
		document.getElementById('expiration3').checked = false;
		alert('Solo se puede seleccionar una una opcion de vencimiento.');
		 
	}
}
						
                        
function calculateBalance(){

	totalpayment=0;
	
	var i=0;
	var i2=0;


for (var obj in document.getElementsByName('theid[]')){
 if (i<document.getElementsByName('theid[]').length){

 if(document.getElementsByName('theid[]')[i].checked == true){
	
	if(i2 == 0){
		var first_select = document.getElementsByName('tcurrency[]')[i].value;
		var first_select2 = document.getElementsByName('tbank[]')[i].value;
		var first_select3 = document.getElementsByName('tcompany[]')[i].value;
		i2++;
	}
	
	tpayment =  document.getElementsByName('tpayment[]')[i].value;
	var tcurrency = document.getElementsByName('tcurrency[]')[i].value;
	var tbank = document.getElementsByName('tbank[]')[i].value;
	var tcompany = document.getElementsByName('tcompany[]')[i].value;
	
	if(tcurrency != first_select){
		document.getElementsByName('theid[]')[i].checked = false;
		alert('Favor realizar la programacion con solicitudes de una misma moneda.');
		
	}
	//Bank New code
	
	
	var talert = arrayCompare(tbank, first_select2);
	if(talert == false){
		document.getElementsByName('theid[]')[i].checked = false;
		alert('Favor realizar la programacion con solicitudes de un mismo banco.');
	}
	 
	 /*if(tbank != first_select2){
		document.getElementsByName('theid[]')[i].checked = false;
		alert('Favor realizar la programacion con solicitudes de un mismo banco.');
	}*/
	 if(tcompany != first_select3){ 
		document.getElementsByName('theid[]')[i].checked = false; 
		alert('Favor realizar la programacion con solicitudes de un misma compañia.');
	}
	 
	
	 
	totalpayment += parseFloat(tpayment);
 }

  }
  i++;
}
var pre = "";
if(first_select == 1){
	var pre = "C$";
	var pre2 = "Córdobas";
}else if(first_select == 2){
	var pre = "U$";
	var pre2 = "Dólares";
}else if(first_select == 3){
	var pre = "&euro;";
	var pre2 = "Euros";
}else if(first_select == 4){
	var pre = "&yen;";
	var pre2 = "Yenes"; 
}
	
document.getElementById('thenumbersum').innerHTML = pre+commas(totalpayment)+' '+pre2;

}

<? /*	
function arrayCompare(a1, a2) {
    if (a1.length != a2.length) return false;
    var length = a2.length;
    for (var i = 0; i < length; i++) {
        if (a1[i] !== a2[i]) return false;
    }
    return true;
}
*/ ?>	

function arrayCompare(a1, a2) {
    var array1 = a1.split(',');
	var array2 = a2.split(',');
	var ret = 0;
	
    for(var i2 = 0; i2 < array2.length; i2++) {
		for(var i1 = 0; i1 < array1.length; i1++) {
			if((array1[i1] != '') && (array1[i1] != 0)){
				if(array1[i1] == array2[i2]){
		  		ret = 1;
	   			}
			}
    	}
    }
	
   if(ret == 1){
	   return true;
   }else{
	   return false;
   }
}
	
function commas(unformatedAmmount) {
    
	var floatAmmount = parseFloat(unformatedAmmount);
	var floatAmmount2 = floatAmmount.toFixed(2); 
	
	var parts = floatAmmount2.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
	var parts2 = parts.join(".");
	return parts2;  
}

                        
                        
                        </script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>

<script>
function lockPayment(id, m){
	$.post("reload-blockpayment.php", { variable: id, message: m }, function(data){
			alert(data);
});		 
}


function lockSelection(){
	var choices = [];
	var els = document.getElementsByName('theid[]');
	for (var i=0;i<els.length;i++){
  		if ( els[i].checked ) {
    		
			lockPayment(els[i].value,2); 
  		}
	}
	
	
	 
}


</script>
<script>
function validateForm(){
var today = new Date();
var dd = today.getDate();
var mm = parseInt(today.getMonth()+1); //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd='0'+dd
} 

if(mm<10) {
    mm='0'+mm
} 

//mm =  parseInt(mm,10);
//dd =  parseInt(dd,10);
today = yyyy+'/'+mm+'/'+dd;

var schedule = document.getElementById("schedule[]").value;
var schedule1 = schedule;
var elem = schedule.split('-');

var dia = elem[0];
var mes = elem[1];
var ano = elem[2];

schedule = ano+'/'+mes+'/'+dia

today = new Date(today);
schedule = new Date(schedule);

if(schedule < today){
	document.getElementById("schedule[]").focus();
	alert('No se puede programar a una fecha anterior');
	return false;
}
if(schedule1 == ''){
	alert('No se puede programar pagos sin ingresar la fecha.');
	document.getElementById("schedule[]").focus();
	return false;
}

//
var bank = document.getElementById("schedulebank").value;
if(bank == '0'){
	alert('No se puede programar pagos sin ingresar el banco.');
	document.getElementById("schedulebank").focus();
	return false;
}


		
}
</script>