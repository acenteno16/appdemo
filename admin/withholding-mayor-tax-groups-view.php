<?php include("session-withholding.php"); ?>
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

					Retenciones <small>Alcaldía</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Retenciones</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>

							<a href="#">Alcaldía</a>

							

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

						Grupo de cancelación

							</div>
                            

						</div>

						

					</div>
                    <div class="portlet-body">
                             
                             <form action="withholding-mayor-tax-request-code.php" method="post" enctype="multipart/form-data" name="form2" id="form2"><div class="table-container">

								 
								<?php $query = "select payments.* from payments inner join bills on payments.id = bills.payment where payments.status >= '14' and payments.ret1a > '0'".$sql;
$querymain = "select * from mayorcontent where package = '$_GET[id]'";
	

								
								$resultmain = mysqli_query($con, $querymain);
								$nummain = mysqli_num_rows($resultmain);
								
							
								if($nummain > 0){ ?> 
                                
                               	<?php //echo $query; ?>
                                <p><strong>IDS:</strong> ID de solicitud.<br>
<strong>IDR:</strong> ID de la retención.</p>
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">
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

										 </th>
                                         <th width="1%">

										 IDS</th>
                                          <th width="6%">

										 IDR</th>

									<th width="20%">

										

										 Proveedor</th>

									<th width="11%">Fecha (Cancelación)</th>


<th width="11%">Total Pagar (Retención)</th>

									<th width="14%">

										 Estado de retención 

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
							
									
								$flag = "";
								if($rowprovider['flag'] == 1) $flag = '<img src="../images/flag.png" width="13"  alt=""/>'; 
								
								if($row['btype'] == 1){
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
									$theprovider = $flag." ".$rowprovider['code']." | ".$rowprovider['name'];
								}else{
									$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
									$theprovider = $flag." ".$rowcollaborator['code']." | ".$rowcollaborator['first']." ".$rowcollaborator['last'];
								}
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd <?php if($row['ret1void'] == 1){ echo "danger"; } ?>"> <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php 
								  
								  $queryret = "select * from hallsretention where payment = '$row[id]'";
								  $resultret = mysqli_query($con, $queryret);
								  $rowret = mysqli_fetch_array($resultret);
								  $number = str_pad((int) $rowret['number'],4,"0",STR_PAD_LEFT);
								  echo $rowret['serial'].'-'.$number;
								  
								  ; ?></td>
                                  
                                  <td><?php echo $theprovider; ?></td>
                                  <td><?php
								  
								  $querycancellation = "select * from times where payment = '$row[id]' and stage = '14.00'";
								  $resultcancellation = mysqli_query($con, $querycancellation);
								  $rowcancellation = mysqli_fetch_array($resultcancellation);
								  
								  echo $date2 = date('d-m-Y',strtotime($rowcancellation['today']));
								  
								  ?></td>
                                  <td> <?php echo 'C$'.str_replace('.00','',number_format($row['ret1a'],2)).' Cordobas'; ?>

</td>
                                
                                <td><?php if($row['mayorstage'] == 0){
									echo "Pendiente de cancelación";
								}else{
								$querymayorstage = "select * from mayorstages where id = '$row[mayorstage]'";
								$resultmayorstage = mysqli_query($con, $querymayorstage);
								$rowmayorstage = mysqli_fetch_array($resultmayorstage);
								echo $rowmayorstage['name']; 
								}
								?> 
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a>
                            
                             <a href="javascript:voidRetention(<?php echo $row['id']; ?>,'<?php echo $row['serial']."-".$row['ret1id']; ?>');" class="btn btn-xs default btn-editable"><i class="fa fa-times"></i> Anular</a>
                           
                            
                            
                            </td></tr>
                                <?php } ?>
                                   </tbody>

								</table>
                                </div>
                               
                               
                               
                               <div class="form-actions right">

<button type="button" class="btn blue" onClick="javascript:pdfPrint();"><i class="fa fa-print"></i> Imprimir</button>

<script>
function pdfPrint(){
	var myForm = document.getElementById("form2") 
	var caction = myForm.action;
	myForm.action = "withholding-mayor-tax-pdf.php";
	myForm.submit();
	myForm.action = caction;
	
}
</script>
                                                

                                                              

							</div>
                               
                                <?php } else { 
							
								?>
                                
                                <div class="note note-danger">

						<p>

							NOTA:
                              <?php if($process == 1){ ?>No hay ninguna retención de Alcaldía por generar.<?php } ?>
							  	  <?php if($process == 1){ ?>No hay ninguna retención de Alcaldía generado en espera de cancelación de solicitud.<?php } ?>
                               <?php if($process == 2){ ?>No hay ninguna retencion de Alcaldía en proceso de solicitud de pago.<?php } ?>
                               <?php if($process == 3){ ?>No hay ninguna retencion de Alcaldía por cancelar. <?php } ?>
                               <?php if($process == 4){ ?>No hay ninguna retencion de Alcaldía cancelada.<?php } ?>   

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div></form>

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



						</script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>

<script>
function voidRetention(id,id2){
	if(confirm('Esta a punto de anular la retencion No. '+id2+' para la solicitud de pago con ID '+id+'. Seguro de anular esta retencion?')){ 
		window.location = "withholding-mayor-tax-group-view-void.php?id="+id;
	}
}
</script>