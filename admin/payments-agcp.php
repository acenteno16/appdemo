<?php include("sessions.php"); ?>
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

					Retenciones <small>Asume Grupo Casa Pellas</small> 

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

							<a href="#">IR</a>

							

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

								Retenciones IR

							</div>
                            
<br><br>
            
            	<form action="withholding-income-tax.php" class="horizontal-form" method="get" enctype="multipart/form-data" >

									<?php include("withholding-filter.php"); ?>

										</form>


						</div>

	   <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						<?php
                        $sql1 = "";
if($_GET['provider'] != ""){
$sql1 = " and payments.provider = '$_GET[provider]'";
}
$sql2 = "";
if($_GET['worker'] != ""){
$sql2 = " and payments.collaborator = '$_GET[worker]'";
}
$sql3 = "";
if($_GET['request'] != ""){
$sql3 = " and payments.id = '$_GET[request]'";
}
$sql4 = "";
if($_GET['from'] != ""){
$from = date("Y-m-d", strtotime($_GET['from']));
$sql4 = " and times.today >= '$from'";
}
$sql5 = "";
if($_GET['to'] != ""){
$to = date("Y-m-d", strtotime($_GET['to']));
$sql5 = " and times.today <= '$to'";
}
$sql6 = "";
if($_GET['bill'] != ""){
$sql6 = " and bills.number = '$_GET[bill]'"; 
}

$sql = $sql0.$sql1.$sql2.$sql3.$sql4.$sql5.$sql6;
						
//$query = "select * from payments where status = '14' and ret2a > '0' and irstage = '0'".$sql;
$query = "select payments.* from payments inner join bills on payments.id = bills.payment inner join times on payments.id = times.payment where payments.status = '14' and payments.ret2a > '0' and payments.irstage = '1' and times.stage = '14.00' ".$sql." group by payments.id order by ret2id asc";

$result = mysqli_query($con, $query);
echo $num = mysqli_num_rows($result);

						?>
						 Retenciones pendientes

							</div>
                            <div class="actions">

								<a href="withholding-income-tax-groups.php" class="btn default blue-stripe">

								<i class="fa fa-search"></i>

								<span class="hidden-480">

								Ver grupos de retenciones</span>

								</a>

								                                
                                

							</div>

						</div>

						

					</div>
                    
                    					
                    <div class="portlet-body">

							 <form action="withholding-income-tax-request-code.php" method="post" enctype="multipart/form-data" name="form2" id="form2"><div class="table-container">

								
<?php 

if($num > 0){ ?> 

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
                                         <th width="2%">

										 IDR</th>
                                          <th width="2%">

										 IDS</th>

									

									<th width="17%">

										 Proveedor/Colaborador</th>

									<th width="11%">Total Pagar</th>

									<th width="14%">

										 Estado de retención 

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
								
							   $nioammount = $row['ret2a'];	
								if($row['currency'] == 2){
									
									$query2 = "select * from tc where today = '$row[schedule]'";
									$result2 = mysqli_query($con, $query2);
									$row2 = mysqli_fetch_array($result2);
									$num2 = mysqli_num_rows($result2);
									
									$nioammount = $row['ret2a']*$row2['tc']; 
								}
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
                                
                                <tr role="row" class="odd"> <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>
                                  <td><?php echo $row['ret2id']; ?></td>
                                  <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $theprovider; ?></td>
                                  <td><?php /* if($row['currency'] == 1){
								  echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)); 
								  }
								  if($row['currency'] == 2){
									  echo '<span style="text-decoration:line-through;">'.$rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)).'</span>';
									  echo '<br>NIO C$'.str_replace('.00','',number_format($nioammount, 2));
								  }
								 */ echo 'C$'.str_replace('.00','',number_format($row['ret2a'],2))." Cordobas"; ?><br>

</td>
                                
                                <td><?php 
								$queryirstage = "select * from irstages where id = '$row[irstage]'";
								$resultirstage = mysqli_query($con, $queryirstage);
								$rowirstage = mysqli_fetch_array($resultirstage);
								echo $rowirstage['name'];  
								
								?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                </div>
                                
                        
							
                                
                                
                                <div class="form-actions right">


											    <?php if(($_GET['irstage'] == 0) or (!isset($_GET['irstage']))){ ?>	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Solicitar pago</button> <?php } ?> 
                                                <?php /* <?php if($process == 3){ ?><button type="submit" class="btn blue"><i class="fa fa-check"></i> Cancelar</button> <?php } ?>
<button type="button" class="btn blue" onClick="javascript:pdfPrint();"><i class="fa fa-print"></i> Imprimir</button>
<script>
function pdfPrint(){
	var myForm = document.getElementById("form2") 
	var caction = myForm.action;
	myForm.action = "withholding-income-tax-pdf.php";
	myForm.submit();
	myForm.action = caction;
	
}
</script>
*/ ?>


                                                

                                                              

							</div>
                                
<?php /* PAGINATION <div>
								<ul class="pagination pagination-lg">
									<li>
										<a href="#">
										<i class="fa fa-angle-left"></i>
										</a>
									</li>
									<li>
										<a href="#">
										1 </a>
									</li>
									<li>
										<a href="#">
										2 </a>
									</li>
									<li>
										<a href="#">
										3 </a>
									</li>
									<li>
										<a href="#">
										4 </a>
									</li>
									<li>
										<a href="#">
										5 </a>
									</li>
									<li>
										<a href="#">
										6 </a>
									</li>
									<li>
										<a href="#">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
								</ul>
							</div> */ ?>
                            
                           <br>
<br>
 <div class="note note-success">

						<p>

							NOTA: Solo aparecen las solicitudes de pago canceladas que tengan un monto IR pendiente de pago. 
						</p>

					</div>
                            
                                <?php } else { 
							
								?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: 
							
							No hay ninguna retención de IR por generar.

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div></form>

					</div>
                  
                    
                 

					<!-- End: life time stats -->

				</div>

			</div>
            
            <?php /*<br><br>&nbsp;<br><br>
            
               	<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Pagos en espera de tipo de cambio

							</div>

							

						</div>

						<div class="portlet-body">

								<?php $query = "select * from payments where status = '14' and irstage = '0' and currency = '2'";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								
							
								if($num > 0){ ?>
                                
                                	<div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

                                         <th width="2%">

										 ID</th>

									<th width="5%">

										 Código</th>

									<th width="17%">

										 Nombre</th>

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
                                <?php $reg = 0;
							 while($row=mysqli_fetch_array($result)){
								
								$err = 0;
								
									$query2 = "select * from tc where today = '$row[schedule]'";
									$result2 = mysqli_query($con, $query2);
									$num2 = mysqli_fetch_array($result2);
									if($num2 == 0){
										$err = 1;
									}
								
								if($err == 1){
									$reg = 1;
									
								$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd"> 
                                <td class="sorting_1" id="maintheid<?php echo $table; ?>"><?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?></td>
                                  <td><?php echo $rowprovider['name']; ?></td>
                                  <td><?php if($row['currency'] == 1){
								  echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)); 
								  }
								  if($row['currency'] == 2){
									  echo '<span style="text-decoration:line-through;">'.$rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['ret2a'], 2)).'</span>';
								  }
								  ?><br>

</td><td><?php echo $rowprovider['term']; ?> días</td>
                                
                                <td><?php if($row['irstage'] == 0){
									echo "Generado";
								}else{
								$queryirstage = "select * from irstages where id = '$row[irstage]'";
								$resultirstage = mysqli_query($con, $queryirstage);
								$rowirstage = mysqli_fetch_array($resultirstage);
								echo $rowirstage['name']; 
								}
								?> 
									
							
								
							</td><td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a></td></tr>
                                <?php } 
								} 
								
								?>
                                   </tbody>

								</table>
                                </div>
                                
                            
                                <?php } 
								
								if($reg == 0){ ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay pagos en espera de tipo de cambio.

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
				*/ ?>

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