<?php include("session-financemanager.php"); ?>
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

					Gerencia Financiera <small>Aprobación</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						
						<li>

							<i class="fa fa-home"></i>

							<a href="dashboard.php">Inicio</a>

							<i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Gerencia Financiera</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>
                        

							<a href="payment-schedule-approve.php">Grupos de programación</a>

							<i class="fa fa-angle-right"></i>

						</li>
                          <li>

							<a href="#">Aprobado</a>

							

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

						
                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						Grupo de aprobación de programación</div>
                            

						</div>

						

					</div>
                    <div class="portlet-body">
                             
                             <?php /*<form action="withholding-mayor-tax-request-code.php" method="post" enctype="multipart/form-data" name="form2" id="form2"><div class="table-container">*/ ?>

								 
								<?php 
								
								$querygroup = "select * from schedule where id= '$_GET[id]'";
								$resultgroup = mysqli_query($con, $querygroup);
								$rowgroup = mysqli_fetch_array($resultgroup);
								
								$rowuser= mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$rowgroup[userid]'"));
								
								
								$querymain = "select * from schedulecontent where schedule = '$_GET[id]'";
								$resultmain = mysqli_query($con, $querymain);
								$nummain = mysqli_num_rows($resultmain);
								
							
								if($nummain > 0){ ?> 
                                
                               	<?php //echo $query; ?>
                                <p><strong>Grupo de Cancelación:</strong> <?php echo "#".$_GET['id']; ?><br>
                                <strong>Web ID:</strong> <?php echo $rowgroup['code']; ?><br>
<strong>Elborado por:</strong> <?php echo $rowuser['code']." | ".$rowuser['first']." ".$rowuser['last']; ?><br>
                                  <strong>Cancelar el:</strong> <?php echo date('d-m-Y',strtotime($rowgroup['schedule'])); ?><br>
<strong>Fecha:</strong> <?php echo date('d-m-Y',strtotime($rowgroup['today'])); ?><br>
                                  <strong>Hora: </strong><?php echo date('h:i a', strtotime($rowgroup['now2'])); ?><br>
                      <strong>No. de Solicitudes:</strong> <?php echo $nummain; ?><br>
                      
                      </p>
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
                                         <th width="2%">

										 IDS</th>
                                   

									<th width="25%">

										 Provedor/Colaborador</th>

									<th width="11%">Total Pagar</th>

									<th width="5%">

										 Vencimiento

									</th>

									<th width="14%">

										 Estado  

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($rowmain=mysqli_fetch_array($resultmain)){
								
							$query = "select * from payments where id = '$rowmain[payment]'";
							$result = mysqli_query($con, $query);
							$row = mysqli_fetch_array($result);
							
								//if($nioammount > 1){
							
									
								if($row['btype'] == 1){
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								}
								else{
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
								}
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"> 
                                <?php /*<td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>*/ ?>
                                  <td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
                                                                    <td><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; 
								echo $rowprovider['code']." | ";
								if($row['btype'] == 1){ echo $rowprovider['name'];
								}else{
									echo $rowprovider['first']." ".$rowprovider['last']; }?></td>
                                  <td> <?php echo $rowcurrency['pre']." ".$rowcurrency['symbol'].str_replace('.00','',number_format($row['payment'],2)).' '.$rowcurrency['name']; 
								  $gpayment+=$row['payment']; ?>

</td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
?></td>
                                
                                <td>
								<?php $rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								echo $rowstage['content']; ?>
							</td><td>
                            <?php
                            
							$queryfiles = "select * from files where payment = '$row[id]' order by id limit 1";
							$resultfiles = mysqli_query($con, $queryfiles);
							$rowfiles = mysqli_fetch_array($resultfiles);
							 
							
							?>
                            <a href="<?php echo $filelink = $rowfiles['link']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a> 
                           
                            </td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                </div>
                               
                              <p><strong>Total Grupo:</strong> <?php switch($row['currency']){
								  case 1:
								  $pre = "NIO C$";
								  $currency = "Córdobas";
								  break;
								  case 2:
								  $pre = "USD U$";
								  $currency = "Dólares";
								  break;
								  case 3:
								  $currency = "Euros";
								  break;
								  case 4:
								  $currency = "Yenes";
								  break;
							  } ?> <?php echo $pre.str_replace('.00','',number_format($gpayment,2))." ".$currency; ?></p> 
                              
                                         <?php 
										 
										 if($rowgroup['status'] == 3){
										 ?>
                                         <div class="row">
                                <div class="col-md-12">
                                             <h3 class="form-section">Opciones</h3>  
                                         									


										
		
         							    
                          <form action="approve-cfo-view-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="myform">
                           <div style="display:none;" id="cdiv"><br><br>
                           
													  <div class="form-group">
	
<label>Comentarios:</label>
                                                        <textarea name="reason" rows="2" class="form-control" id="reason" placeholder="Comente por que no aprueba esta solicitud de pago."></textarea>
						
                                                          
                    

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                        
                                                      <!--/row--></div>
													</div>                          
                                                    
 
 <div class="col-md-12">
  <div class="form-actions right" style="margin-left:0px;">
<div class="row">
<button type="button" class="btn blue" onClick="divShow(0);" id="dapprove" style="margin-top:20px;"><i class="fa fa-check"></i> Aprobar</button>
</div>

<script>
							function goApprove(){
								window.location = "approve-cfo.php";
							}
							</script>			
<div class="row"><button type="button" class="btn red" onClick="divShow(1);" style="margin-top:20px;"><i class="fa fa-times"></i> Reprobar</button> </div>
<div class="row"><button type="button" class="btn blue" onClick="divShow(2);" id="cancelreject" style="display:none; margin-top:20px;"><i class="fa fa-times"></i> Cancelar reprobar</button></div>
 
<div class="row"><button type="button" class="btn blue" onClick="goApprove();"style="margin-top:20px;"><i class="fa fa-times"></i> Cancelar</button> </div>
                            
                             
												<input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>">
												<span class="form-actions right" style="margin-left:0px;">
                                                <input name="approve" type="hidden" id="approve" value="0"> 
                                                </span> 
  </div>
</div>                                      
                                       </form>
                                
                                       
                                       </div>
                                                                                          </div><?php } ?>
                                <?php } else { 
							
								?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No se encontró ningún grupo de aporbado de programación.
                               

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div>
                        <?php //</form> ?>

					</div>
                  
                    
                 

					<!-- End: life time stats -->

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
			   document.getElementById("cdiv").style.display = 'none';
			   document.getElementById("cancelreject").style.display = 'none';		document.getElementById("dapprove").style.display = 'block';
			   
		   }
		   	
		   
}



function validateForm(){
	
	var reason = document.getElementById("reason").value;
	
	
	if(reason == ''){
		alert('Cuando rechaza una programacion de pago debe de justificar con un comentario.');
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

</html>