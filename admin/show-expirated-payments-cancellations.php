<?php include("session-admin.php"); ?>

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

					Pagos <small>Ingresos vencidos</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>
						
						 <li>

						  <i class="fa icon-grid"></i>

						  <a href="jt.php">JT</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Vistas (Cancalaciones vencidas)</a>

							

						</li>
                        

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">
<div class="col-md-12">
				                           
                                                    
                  <div class="col-md-12">
                  	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="horizontal-form" method="get" enctype="multipart/form-data" >
				<div class="note note-regular">
                <h3>Buscador:</h3> 
                <div class="row">
                <div class="col-md-6">
                                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy" style="">
												<input type="text" class="form-control" name="from" value="<? if(!isset($_GET['from'])){ echo '1-'.date("m").'-'.date("Y"); }else{ echo date("d-m-Y", strtotime($_GET['from'])); } ?>" id="from">
												<span class="input-group-addon">
												hasta </span>
												<input type="text" class="form-control" name="to" value="<?php if(!isset($_GET['to'])){ echo $today = date('j-n-Y'); }else{ echo date("d-m-Y", strtotime($_GET['to'])); } ?>" id="to" onchange="javascript:reloadKhoom();">  
				  </div></div>
                </div>
             <div class="row">
</div>
<div class="row">

<br><br>
						
<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-search"></i> Buscar</button> 
												
                						

						    <?php if($_GET['form'] == 1){ ?><button type="button" class="btn blue" onClick="goBack();"><i class="fa fa-repeat"></i> Regresar</button> 
							<script>
							function goBack(){
								window.location = "show-expired-payments-request.php";
							}
							</script>
							<?php } ?>
												
                 </div>                               
  
</div>
                
                
                </div> 
               
                  
                  </form>
               
                  </div>
                  
                  <div class="row"></div><br><br>
                  
                  
                  <div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						

                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						<? 
								
	
			
				 
$fday = date("Y-m-1");
$today = date("Y-m-d"); 

$from = $_GET['from'];
$to = $_GET['to'];

$sql1 = " and times.today >= '$fday'";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql1 = " and times.today >= '$from'";
}
$sql2 = " and times.today <= '$today'";
if($from != ""){ 
	$to = date("Y-m-d", strtotime($to));
	$sql2 = " and times.today <= '$to'"; 
	
}
 
$sql = $sql1.$sql2;

$tampagina = 50;
$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$query = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.payment, payments.bank, payments.status, payments.reference, payments.cnumber, times.today, payments.expiration, payments.userid, payments.route from payments inner join times on payments.id = times.payment where times.stage = '14.00'".$sql.' and payments.expiration <= times.today group by payments.id'; 
$result = mysqli_query($con, $query);
echo $numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);

$query1 = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.payment, payments.bank, payments.status, payments.reference, payments.cnumber, times.today, payments.expiration, payments.userid, payments.route from payments inner join times on payments.id = times.payment where times.stage = '14.00'".$sql.' and payments.expiration <= times.today group by payments.id limit '.$inicio.",".$tampagina;  
$result1 = mysqli_query($con, $query1); 
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;							
			
			if($_GET['echo'] == 1){ 
				echo 'query: '.$query.'<br>query1: '.$query1;
			}


$query2 = "select payments.id from payments inner join times on payments.id = times.payment where times.stage = '1.00'".$sql.' group by payments.id';  
$result2 = mysqli_query($con, $query2);
$num2 = mysqli_num_rows($result2); 

?> Solicitudes canceladas vencidas | <? echo $num2; ?> solicitudes ingresadas.</div>
                            

						</div>

						

					</div>
                    <div class="portlet-body">



							
                             
                            
                             
                             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form2" id="form2"><div class="table-container">

								
								<?


				
if(($numdev > 0)){ ?>   
					
<a href="show-expirated-payments-request-excel.php?sql=<? echo $sql; ?>"> [Export excel]</a>     
						
								                 
							
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

										 IDS</th>
                                         <th width="8%"> 

										 UN</th>

									

									<th width="17%">

										Proveedor/Colaborador</th>

									<th width="11%">Total Pagar</th>

									<th width="5%">

										Ingreso</th>

								<th width="14%">
                                

										 Vencimiento 

									</th>
                                    <th width="14%">

										 Días 

									</th>
                                    <th width="14%">Ingresado por</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
								while($row=mysqli_fetch_array($result1)){
								
							
							
									
								if($row['btype'] == 1){
									$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
								$providercollaborator = $rowprovider['code']." | ".$rowprovider['name'];
								}else{
									$queryprovider = "select * from workers where id = '$row[collaborator]'";
									$rowprovider = mysqli_fetch_array(mysqli_query($con, $queryprovider));
								$providercollaborator = $rowprovider['code']." | ".$rowprovider['first']." ".$rowprovider['last'];
								} 
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
										$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
										$rowworker = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
								
								?>
                                
                                <tr role="row" class="odd <?php if($row['imiprinted'] == 1) echo 'success';  if($rowmain['void'] == 1) echo ' danger' ?>">  <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $rowmain['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php echo $row['route']; ?></td>
                                  
                            
                                  <td><?php echo $providercollaborator;  ?></td>
                                  <td><? if($row['payment'] != 0.00){
										echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); } ?></td>
                                  <td><? echo date("d-m-Y", strtotime($row[10])); ?></td>
                                          
                            <td><? echo date("d-m-Y", strtotime($row[11]));
							?></td>
                             
                            <td><? echo $elvencimiento = getExpiration($row[10],$row[11]); ?></td>
                             <td><? echo $rowworker['first']." ".$rowworker['last']; ?></td>
                             
                                
                                <? /*<td><?php 
								
								if($row['mayorstage'] == 0){
									
									$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc")); 
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'")); 
									echo $rowstage['content']; 
								}
								else{
								$querymayorstage = "select * from mayorstages where id = '$row[mayorstage]'";
								$resultmayorstage = mysqli_query($con, $querymayorstage);
								$rowmayorstage = mysqli_fetch_array($resultmayorstage);
								echo $rowmayorstage['name']; 
								}
								?> 
									
							
								
							</td>
                            */ ?><td></td></tr>
                                <?php }
								
								?>
                                   </tbody>

								</table>
                                </div>
                               
<div class="form-actions right">


                                                

                                                              

							
</div>   

   <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="<? echo str_replace('/admin/','',$_SERVER['SCRIPT_NAME']);?>?page=<?php echo $previous; ?>">
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
		  echo '<li><a href="'.str_replace('/admin/','',$_SERVER['SCRIPT_NAME']).'?page='.$i .'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="<? echo str_replace('/admin/','',$_SERVER['SCRIPT_NAME']);?>?page=<?php echo $next; ?>">
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

							NOTA: No se encontró ningúna Solicitud de Pago.

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


<? /*
function voidRetRd(id){
	if(confirm('La opcion Anular + RD se utiliza para anular una retencion que se debe de redireccionar a otra sucursal. Si') == true){
		window.location = ""+id;
	}
}

function voidRet(id){
	if(confirm('La opcion de anular se utiliza para anular por completop la retencion en getPay. Si se necesita retencion para este pago debera de hacerce manual.') == true){
		window.location = ""+id;
	}
}
*/ ?> 
</script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>

<? 
function getExpiration($date1,$date2){
	
	$dias = (strtotime($date1)-strtotime($date2))/86400;
	
	if($dias <= -8) $parentesis = ' <span style="color:#060">('.intval(abs($dias)).")</span>";
	if(($dias <= 0) and ($dias >= -7)) $parentesis =  ' <span style="color:#FC0">('.intval(abs($dias)).")</span>";
	elseif($dias > 0) $parentesis = ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>";
	
	$vencimiento = $date3." ".$parentesis;
	return($vencimiento); 
	
}

?>