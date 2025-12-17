<?php 

include("session-admin.php");


//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

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

					Reteciones <small>Reenvío de retencioness</small> 

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
						
						<li>

							<a href="retentions-forwarding.php">Reenvío de retenciones</a>

							<i class="fa fa-angle-right"></i>

						</li>


						<li>

							<a href="#">Por rango de fechas</a>

							

						</li>


					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
                
                <?php if(!isset($_GET['form'])){ ?>
					
				
<form id="ungrouped" name="ungrouped" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
<input name="form" type="hidden" id="form" value="1">
<div class="note note-regular">
<div class="row">
<h4 style="margin-left:15px;">Filtro:</h4><br>
                          
</div>  


                                        
                                                                              
                                                
                                               
     
                                                    

<div class="row">
<div class="col-md-3" > 
                                                    <label class="control-label">Rango de Fechas:</label>

											<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">

												<input type="text" class="form-control" name="from" placeholder="desde">

												<span class="input-group-addon">

												<i class="fa fa-angle-double-right"></i></span>

												<input type="text" class="form-control" name="to" placeholder="hasta" >

											</div>

											<!-- /input-group -->

											
										</div>




 

        </div>                     
<div class="row">
</div>
<div class="row">

<br>
						<div class="col-md-3">
							<input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-search"></i> Consultar</button> 
							<button type="button" class="btn red" onClick="goBack();"><i class="fa fa-times"></i> Regresar</button>
                            <script>function goBack(){
								window.location = "retentions-forwarding.php"; 
							}</script>
						</div>                               
</div>
						
								</div>
                                </form> 
                                
                                <?php } ?>
					
					
					
					<?php 
					if(isset($_GET['form'])){ 
					?>
                    
                    <div class="note note-regular">
                    <a href="retentions-forwarding-range.php">Volver a consultar</a> 
                    </div>
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

<?php 
								
$param = 0;								
$today = date('Y-m-d'); 
$tampagina = 100000;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$join1i = 0;
$join2i = 0;
$join3i = 1;

$from = $_GET['from'];
$to = $_GET['to'];

$sql1 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql1 = " and times.today >= '$from'";
	$param++;
}
$sql2 = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sql2 = " and times.today <= '$to'";
	$param++;
}
$sql3 = " and times.stage = '13'";

$join = " inner join times on payments.id = times.payment";

if($param == 0){
	echo "<script>alert('Debe de seleccionar al menos un parametro de busqueda.'); history.go(-1);</script>";
	$numdev = 0;
}else{
	//Do nothing

$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10.$sql11.$sql12.$sql13.$sqlu; 
 


$query = "select payments.id from payments".$join." where payments.id > '0' and payments.ret1a > '0'".$sql." group by times.payment";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);       
		
	
$query1 = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.payment, payments.bank, payments.status, payments.reference, payments.cnumber, payments.schedule, payments.approved, payments.today, payments.reason, payments.ret1a from payments".$join." where payments.id > '0' and payments.ret1a > '0'".$sql." group by times.payment order by payments.id desc limit ".$inicio.",".$tampagina.""; 
$result1 = mysqli_query($con, $query1);
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1; 
	 
if(($_GET['echo'] == 1)){
	echo $query1."<br>";
	echo 'SQLU:('.$numu.') '.$queryu."<br>";
}

}
 

echo $numdev; ?> Solicitudes de pagos<br> 
							<? /*echo 'Admin: '.$_SESSION['admin'];
	echo '<br>DCH: '.$_SESSION['dch'];
	echo '<br>Global: '.$_SESSION['globalsearch']; */
	?>
								<span style="font-size: 12px; color: darkgrey;"><i>Ordenadas por vencimiento</i></span>

							</div>

							

					  </div>

						<div class="portlet-body">

							<div class="table-container">

								

							

								<?php 													

//echo $query;
//echo "<br>".$query1;

if($numdev > 0){  ?>
								
								<form name="cnot" id="cnot" action="retentions-forwarding-range-code.php" method="post" enctype="multipart/form-data">
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">
											 <input type="checkbox" class="group-checkable" id="checkall0" onChange="javascript:checkAll0();" /> 
                                
                                  <script>
    function checkAll0(){
	 var checkall = document.getElementById('checkall0');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByClassName('approve0');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			 if(checkboxes[i].disabled == true){
			 	checkboxes[i].checked = false; 
			 }
         
      }
	}
      </script>
										 
									</td>
									<th width="5%">

										 ID</th>

									<th width="40%">

										 Proveedor</th>

									<th width="16%">Total Pagar</th>

									<th width="15%">

										 Retencion

									</th>

									<th width="15%">

										 Documentos

									</th>

									<th width="17%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php //echo $query1; 
								while($row=mysqli_fetch_array($result1)){
								if($row['btype'] == 1){
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								}else{
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
								}
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
								<tr role="row" class="odd">
									
									
									<td class="sorting_1"><input name="id[]" type="checkbox" id="id[]" value="<?php echo $row['id']; ?>" class="approve0"></td>
									<td>
								<a href="payment-order-view.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td><td>                                  <?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; 
								if($row['btype'] == 1){ echo $rowprovider['code']." | ".$rowprovider['name'];
								}else{
									echo $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last']; }?></td>
                                    <td>
									<?php 
									
									
									if($row['payment'] != 0.00){
										echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); 
									if($rowcurrency['id'] == 1){
										$gtotal_nio+=$row['payment'];
									}
									if($rowcurrency['id'] == 2){
										$gtotal_usd+=$row['payment'];
									}
										
									
									} ?></td>
                                        <td>
										<?php 
										
										
										echo $row['ret1a']; 
										
										?></td><td><?php  
										
$querybills = "select * from bills where payment = '$row[id]'";
$resultbills = mysqli_query($con, $querybills);								
while($rowbills = mysqli_fetch_array($resultbills)){
	echo $rowbills['number'].', '; 
}
									
									$thisStage = array();
									$thisStage[1] = "Solicitúd de envío";
									$thisStage[2] = "Intento de envio Fallido";
									$thisStage[3] = "Envío exitoso";
						
?>

								
							</td><td>
                            
                            <a href="retentions-forwarding-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                         
                            
                            </td></tr>
									<? 
									$query2 = "select * from cnotificationTimes where payment = '$row[id]'";
									$result2 = mysqli_query($con, $query2);
									$num2 = mysqli_num_rows($result2);
									if($num2 > 0){
										
										
									?>
									<tr>
									<td colspan="7" style="padding-left: 36px;"><? 
										$inc = 0;
										while($row2 = mysqli_fetch_array($result2)){ 
											
											if(($row2['userid'] == '') or ($row2['userid'] == 999999999)){
												$userName = "getPaySystem";	
											}elseif($thisUser[$row2['userid']] != ''){
												$userName = $thisUser[$row2['userid']];
											}else{
												$queryUser = "select id, first, last from workers where code = '$row2[userid]'";
												$resultUser = mysqli_query($con, $queryUser);
												$rowUser = mysqli_fetch_array($resultUser);
										
												$username = $thisUser[$row2['userid']] = $rowUser['first'].''.$rowUser['last'];
											}
											$etype = '';
											switch($row2['notification']){
												case 3:
													$etype = ' de Cancelación';
													break;
												case 4:
													$etype = ' de Rentención';
													break;
											}
											
											if($inc > 0){ echo '<br>';  } $inc++;
											echo $row2['now'].' | '.$thisStage[$row2['stage']].$etype.' @'.$userName; 
										} ?></td>
									</tr>
                                <?php } }
								
								?>
									
									<tr>
									<td><input type="checkbox" class="group-checkable" id="checkall1" onChange="javascript:checkAll();" /> 
                                
                                  <script>
    function checkAll(){
	 var checkall = document.getElementById('checkall1');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByClassName('approve1');
      for (var i = 0; i < checkboxes.length; i++) {
         
             if(checkall.checked == true){ 
			   checkboxes[i].checked = true;
			 }else{
				 checkboxes[i].checked = false;
			 }
			 if(checkboxes[i].disabled == true){
			 	checkboxes[i].checked = false; 
			 }
         
      }
	}
      </script></td><td colspan="6"></td>
									</tr>
                               
                                   </tbody>

								</table>
								<div class="row">
								<div class="col-md-12">
								<textarea id="comments" name="comments" class="form-control" placeholder="Ingrese un comentario. (Razón del reenvío)"></textarea>
									</div>
								</div>
								
								<button type="submit" class="btn blue" >Procesar</button>
							
							</form>
                                <? if($gtotal_nio > 0){ ?>Total Córdobas: <? echo number_format($gtotal_nio,2); ?><br><? } ?>
                                <? if($gtotal_usd > 0){ ?> Total Dólares: <? echo number_format($gtotal_usd,2); } ?>
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php $securechain = "";
								if(($_SESSION['admin'] == "active") and ($_GET['asadmin'] == 1)){
									$securechain = "&asadmin=1";
								}
								
								if($previous != ""){ ?>
                  
                 <li>
										<a href="<?php echo str_replace('/var/www/html','',$_SERVER['SCRIPT_FILENAME']); ?>?page=<?php echo $previous; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&requester=<?php echo $_GET['requester']; echo $securechain; ?>&stage=<?php echo $_GET['stage']; ?>&form=1">
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
		  
		  echo '<li><a href="'.str_replace("/var/www/html","",$_SERVER["SCRIPT_FILENAME"]).'?page='.$i .'&provider='.$_GET['provider'].'&from='.$_GET['from'].'&to='.$_GET['to'].'&request='.$_GET['request'].'&bill='.$_GET['bill'].'&requester='.$_GET['requester'].$securechain.'&stage='.$_GET['stage'].'&form=1">'.$i .'</a></li>';  
		}
    } } ?> 
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="<?php echo str_replace('/var/www/html','',$_SERVER['SCRIPT_FILENAME']); ?>?page=<?php echo $next; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill'].'&requester='.$_GET['requester'].$securechain; ?>&form=1">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna orden de pago vinculada a esta cuenta.

						</p>

					</div>
                                <?php } ?>
                             
                                
                                

						</div>

					</div>

					<!-- End: life time stats -->

				</div><?php }else{ 
				
				
				?> 
				
				
				<button type="button" class="btn blue" onClick="deliveryLoad();"><i class="fa fa-check-circle-o" ></i> Ver pendientes de envío</button> <button type="button" class="btn blue" onClick="deliveryStart();"><i class="fa fa-check-circle-o"></i> Empezar envío</button> 
				
				<div id="dContent" style="padding-top: 10px;">
				</div>

				<div id="dProcess" style="padding-top: 10px;">
				</div>
				<script>
					
				let iStrong = 0;

				function deliveryLoad(){
					
					document.getElementById("dProcess").innerHTML = '';
					document.getElementById("dContent").innerHTML = '';
					
					$.post("retentions-forwarding-range-reloader.php", { type: 2 }, function(data){
						
						document.getElementById("dContent").innerHTML = data;
						
					});
				}	
					
				function deliveryStart(){
					
					$.ajaxSetup({async:false});
					document.getElementById("dContent").innerHTML = '';
					document.getElementById("dProcess").innerHTML = '';
					
					$.post("retentions-forwarding-range-reloader.php", { type: 0 }, function(data){
							
						iStrong = data;
						
					});
					
			
					for(let i=1;i<=iStrong;i++){
						
						$.post("retentions-forwarding-range-reloader.php", { type: 1, page: i }, function(data){
							
							var divContent = document.getElementById("dProcess").innerHTML;
							document.getElementById("dProcess").innerHTML = divContent+data;
							
						});
					
					}
					
					
				$.ajaxSetup({async:true});
				}
				</script>
				<? } ?>

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
