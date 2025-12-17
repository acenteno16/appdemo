<?php 

include("session-withholding.php");

$theid = $_POST['theid'];
if($theid == ""){
	$theid = $_POST['theid2'];
}
$sql = " where (";
for($c=0;$c<sizeof($theid);$c++){
	if($c == 0){
		$pre = "";
	}else{
		$pre = " or ";
	}
	$sql .= $pre."id = '$theid[$c]'";
}
$sql .= ")";

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

					Cancelación de pagos <?php /*<small>Aprobación de programación</small> */ ?>

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

						</li>
                        <li>

							<a href="#">Cancelación de pagos
</a>
							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				
                <div class="col-md-12">

					

					<!-- Begin: life time stats -->

					
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<i class="fa fa-sitemap"></i>Lista de pagos pendientes de cancelar</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">

								<div class="table-actions-wrapper">

									<span>

									</span>

								

			
								</div>

							<?php 
							
							
							$queryglobal = "select * from config";
							$resultglobal = mysqli_query($con, $queryglobal);
							$rowglobal = mysqli_fetch_array($resultglobal);
							
							
							$query = "select * from payments where ((provider = '$rowglobal[imiprovider]') or (provider = '$rowglobal[irprovider]')) and status > '8' and status < '14'";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								if($num > 0){ ?> 	
                            
                                	<form id="payable" name="payable" enctype="multipart/form-data" method="post" action="payable-payments-cancellation-code.php">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									
               
                                <th width="4%">

										 ID</th>

									<th width="5%">

										 Código</th>

									<th width="18%">

										 Nombre</th>

									<th width="10%">Total Pagar</th>

									<th width="3%">

										 Vencimiento

									</th>

									<th width="16%">

										 No. de referencia</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){
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
                                  <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                 <input name="theid[]" type="hidden" id="theid[]" value="<?php echo $row['id']; ?>">
                                 <?php echo $row['id']; ?></td>
                                  <td><?php echo $rowprovider['code']; ?></td><td><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; 
								if($row['btype'] == 1){ echo $rowprovider['name'];
								}else{
									echo $rowprovider['first']." ".$rowprovider['last']; }?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.number_format($row['payment'], 2); ?></td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.abs($dias).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.abs($dias).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.-1*abs($dias).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
?></td><td>
                            <input name="link[]" type="text" class="form-control" id="link[]" value="" placeholder="Link"><input name="number[]" type="text" class="form-control" id="number[]" value="" placeholder="Número de transacción">
                         <?php //if($rowprovider['international'] != 1){ ?>   <input name="reference[]" type="text" class="form-control" id="reference[]" value="" placeholder="Número de referencia (Banco)"> 
                           <?php /* <input name="bank[]" type="text" class="form-control" id="bank[]" value="" placeholder="Banco">*/ ?>
                          

															<select name="bank[]" class="form-control" id="bank[]" style="margin-top:1px;">
<option value="0">Banco</option>
<?php $querybanks = "select * from banks order by name";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){
?>
<option value="<?php echo $rowbanks['id']; ?>" <?php if($rowbanks['id'] == '3') echo "selected"; ?>><?php echo $rowbanks['name']; ?></option>
<?php } ?>
 
</select>
																			
<?php //} ?>
												









                            
                            <input name="international[]" type="hidden" id="international[]" value="<?php echo $rowprovider['international']; ?>"></td>
                            
                            </tr>
                                <?php } ?>
                                
                                   </tbody>

								</table>
                              <div class="form-actions right">

<input type="hidden" id="currency" name="currency" value="1">
											    	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Cancelar pago</button>
                                                    </div>
                                               
</form>
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay pagos para cancelar.

						</p>

					</div>
                                <?php } ?>
                              

							</div>

						</div>

					</div>

					<!-- End: life time stats -->

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

function calculateBalance(){

	totalpayment=0;
	
	i=0;
for (var obj in document.getElementsByName('theid[]')){
 if (i<document.getElementsByName('theid[]').length){

 if(document.getElementsByName('theid[]')[i].checked == true){
	tpayment =  document.getElementsByName('tpayment[]')[i].value;
	//alert('var: '+tpayment);
	totalpayment += parseFloat(tpayment);
 }

  }
  i++;
}
balance = document.getElementById('balance').value;
newbalance = balance-totalpayment;
document.getElementById('thenumber').innerHTML = 'C$'+newbalance.toFixed(2);
document.getElementById('cbalance').value = newbalance.toFixed(2);
}

function validateForm(){
	cbalance = document.getElementById('cbalance').value;
	if(cbalance < 0){
		alert('No hay saldo disponible para cubrir estos pagos. Seleccione los pagos hasta llevar el saldo disponible a cero.');
		return false;
	}
}
</script> 

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>