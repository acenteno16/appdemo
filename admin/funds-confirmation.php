<?php 

include("session-request.php"); 
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
<?php include('fn-expiration.php'); ?>
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

					Solicitudes CDF

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  
						  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Solicitudes CDF</a>

						

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

								Mis solicitudes de confirmación de fondos

							</div>

							<div class="actions">
						
								
							
								<a href="funds-confirmation-add.php" class="btn default blue-stripe">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
								Agregar</span> 
								</a>
								
							

							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								

							

<?php 

$today = date('Y-m-d'); 
$tampagina = 25;
$pagina = 1;
if(isset($_GET['page'])){
	$pagina = $_GET['page'];
}
if($pagina == 1){
	$inicio = 0;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$from = "";
if(isset($_GET['from'])){
	$from = $_GET['from'];
}
$to = "";
if(isset($_GET['to'])){
	$to = $_GET['to'];
}

$request = "";
if(isset($_GET['request'])){
	$request = $_GET['request'];
}


$sql1 = "";
if($from != ""){
$from = date("Y-m-d", strtotime($from));
$sql1 = " and funds.today >= '$from'";
}
$sql2 = "";
if($to != ""){
$to = date("Y-m-d", strtotime($to));
$sql2 = " and funds.today <= '$to'";
}
$sql3 = "";
if($provider != ""){
$sql3 = " and funds.provider = '$provider'";
}
$sql4 = "";
if($request != ""){
$sql4 = " and funds.id = '$request'";
}
$sql5 = "";
if($bill != ""){
$sql5 = " and funds.number = '$bill'";
}

$sql = $sql1.$sql2.$sql3.$sql4.$sql5;
  

//$query = "select payments.* from payments left join bills on payments.id = bills.payment where userid = '$_SESSION[userid]'".$sql." order by id desc";
$query = "select * from funds where status != '1.1' and userid = '$_SESSION[userid]'".$sql." order by id desc";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);

//$query1 = "select payments.* from payments left join bills on payments.id = bills.payment where userid = '$_SESSION[userid]'".$sql." order by id desc limit ".$inicio.",".$tampagina;
$query1 = "select * from funds where status != '1.1' and userid = '$_SESSION[userid]' order by id desc limit ".$inicio.",".$tampagina;  
$result1 = mysqli_query($con, $query1); 
$next = 1;
$previous = 0;
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;							
			
			if($_GET['echo'] == 1){ 
				echo 'query: '.$query.'<br>query1: '.$query1;
			}
			
if($numdev > 0){  ?>
                                
                                <div class="table-scrollable">	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="1%">

										 ID</th>

									<th width="20%">

										 Cliente</th>

									<th width="6%">Monto</th>

								<? /*	<th width="6%">

										 Vencimiento

									</th>*/ ?>

									<th width="5%">

										 Estado

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
										$ben_name = getBen(0, 4, 0, 0, 0, $row['client']);
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
										$btnColor = 'blue';
										switch($row['status']){
											case 0:
												$btnStr = "Borrador";
												break;
											case 1:
												$btnStr = "Ingresado";
												break;
											case 1.50:
												$btnStr = "Corregido";
												break;
											case 2:
												$btnStr = 'Rechazado';
												break;
											case 3:	
												$btnStr = 'No confirmada';
												break;
											case 4:	
												$btnStr = 'Confirmada';
												break;
										
										}
										$thisClass = '';
											switch($row['status']){
											case 0:
												$thisClass = '';
												$btnColor = '';	
												break;
											case 1:
												$thisClass = '';
												$btnColor = 'blue';	
												break;
											case 2:
												$thisClass = 'danger';
												$btnColor = 'red';	
												break;
											case 3:
												$thisClass = 'danger';
												$btnColor = 'red';
												break;
											case 4:
											
												$thisClass = 'success';
												$btnColor = 'green';
												break;
										}
										$btn = '<button type="button" class="btn '.$btnColor.'">'.$btnStr.'</button>';
										
								
								?>
                                
                                <tr role="row" class="odd <? echo $thisClass; ?>"><td class="sorting_1"><?php echo $row['id']; ?></td>
								<td><?php if($row['client'] > 0) echo str_replace('<img src="../images/dev.png" width="15">','',$ben_name); else echo '-';  ?></td>
								<td><?php 
								if($row['amount'] > 0){ echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['amount'], 2)); }else{ echo '-'; }?>
								</td>
								<td><?php 

echo $btn;

										?>
							
								
							</td><td>
                            <?php if($row['status'] == 0){ ?>
								
                            <a href="funds-confirmation-order.php?id=<? echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-edit"></i> Completar</a>
                             <a href="javascript:voidPayment(<?php echo $row['id']; ?>);"><span class="label label-danger">
									<i class="fa fa-trash-o"></i>  Anular</span></a>
                                    <script>
									function voidPayment(id){
		if (confirm("Usted desea anular este borrador\n- Si usted no desea anular este borrador presione cancelar.")==true){
			window.location="funds-confirmation-draft-rejection.php?id="+id;	
	} 
}

									</script>
                            
                           <?php }else{ ?> 
								<? echo $row['type']; ?>	
                            <? if(($row['status'] == 1) and (($row['type'] == 1) or ($row['type'] == 4))){
							
								$query_thistime = "select id from fundstimes where fund='$row[id]' and stage = '1.01'";
								$result_thistime = mysqli_query($con, $query_thistime);
								$num_thistime = mysqli_num_rows($result_thistime);
								if($num_thistime == 0){
							?>
                            <a href="payment-order-draft.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-edit"></i> Regresar a borrador</a>
                            <? } } ?>
                            <a href="funds-confirmation-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                            <?php } ?>
                            
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
										<a href="payments.php?page=<?php echo $previous; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
										<i class="fa fa-angle-left"></i> 
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i .'</a></li>';  
		}else{
		  echo '<li><a href="payments.php?page='.$i .'&provider='.$_GET['provider'].'&from='.$_GET['from'].'&to='.$_GET['to'].'&request='.$_GET['request'].'&bill='.$_GET['bill'].'&form=1">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="payments.php?page=<?php echo $next; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna solicitud de pago vinculada a esta cuenta.

						</p>

					</div>
                                <?php } ?>
                             
                                
                           

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
</script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>