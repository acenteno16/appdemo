<?php 

include("session-review.php");

$id2 = $_GET['id2'];	
if($id2 != ""){
	header('location: file-review-detail-check.php?id='.$id2);
	exit();
}


include('functions.php');

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

<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME STYLES -->

<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>

<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/clockface/css/clockface.css"/>



<link rel="stylesheet" type="text/css" href="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:onFocus();">

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

			<!-- BEGIN STYLE CUSTOMIZER -->

			

			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Remisiones <small>Revisión de Solicitudes</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						

						<li>

							<a href="#">Solicitudes pendientes de revisión</a>

						</li>

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

        
        	
                                
                               

<div class="row">

				<div class="col-md-12">

					<div class="tabbable tabbable-custom boxless tabbable-reversed">

						

					

							

							<div class="tab-pane" id="tab_1">

								
								                            <div class="portlet box blue">

									<div class="portlet-title">

									
                                        
                                         

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="file-review-detail-code.php" class="horizontal-form" method="post" enctype="multipart/form-data">

											<div class="form-body">

												<h3 class="form-section">Revisar Solicitud</h3>

												<div class="row"><!--/span-->

												  <div class="col-md-3 ">
													  <div class="form-group">
														<label>ID de la solicitud:</label>
                                                        <input name="id" type="text" class="form-control" id="id" value="" onChange="javascript:this.form.submit;">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
												  </div>
													 <div class="col-md-3 ">
													  <div class="form-group">
														<label>ID forzado:</label>
                                                        <input name="id2" type="text" class="form-control" id="id2" value="">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
												  </div>
												  <div class="col-md-6" > 
                                                    <label class="control-label">Rango de Fechas: (Solicitud)</label>

											<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">

												<input type="text" class="form-control" name="from" placeholder="desde">

												<span class="input-group-addon">

												<i class="fa fa-angle-double-right"></i></span>

												<input type="text" class="form-control" name="to" placeholder="hasta" >

											</div>

											<!-- /input-group -->

											
										</div>

													<!--/span-->

											  </div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

										  <!--/row--><!--/row--></div>


											<div class="form-actions right">

								

												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Revisar</button> <button type="button" class="btn blue" onClick="javascript:clearFilter();"><i class="fa fa-check"></i> Limpiar filtro</button>

											</div>

										</form>
										<script>
											function clearFilter(){
												window.location= "file-review-detail.php";
											}
										</script>

										<!-- END FORM-->

									</div>
                                    
                       

								</div>
            
             		     		<br>
                           
                                  
            
             		<div class="row">
				<div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

				<? 
								
$tampagina = 25;
$pagina = $_GET['page'];

if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}
else{
	$inicio=($pagina-1)*$tampagina;
}

$stage = $_GET['stage'];

if(!$stage){ $sql = " and approved = '1' and status < '14' and ((sent = '3') or (sent = '4' and sent_complete = '0'))"; } 
elseif($stage == 1){ $sql = " and approved = '1' and sent >= '2' and sent < '5'"; } 
elseif($stage == 2){ $sql = " and approved = '1' and sent_complete = 1"; }
elseif($stage == 3){ $sql = " and approved = '1' and sent = '4' and sent_complete = '0'"; }
elseif($stage == 4){ $sql = " and approved = '1' and sent = '4' and sent_complete = '0'"; }
elseif($stage == 5){ $sql = " and approved = '1' and sent_complete = '0' and sent-approve = '1'"; }

$from = $_GET['from'];
$to = $_GET['to'];
$str= '';								
$sql1 = "";
if($from != ""){
	$from = date("Y-m-d", strtotime($from));
	$sql1 = " and today >= '$from'";
	$param++;
	$str.="&from=".$from;
}
$sql2 = "";
if($to != ""){
	$to = date("Y-m-d", strtotime($to));
	$sql2 = " and today <= '$to'";
	$param++;
	$str.= "&to=".$to;
}

						 		
$sql_main = $sql.$sql1.$sql2;								
$query = "select * from payments where id > '0' and child = '0'".$sql_main;
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina); 
			
$query1 = "select * from payments where id > '0' and parent = '0'".$sql_main." order by approved asc, expiration asc limit ".$inicio.",".$tampagina; 
$result1 = mysqli_query($con, $query1);

if($_GET['echo'] == 1){
	echo $query1.'<br>'; 
}								
echo $numdev;								
								
								?> Solicitudes

							</div>
                            

							<div class="actions">
                            <div style="margin-top:-20px;">		
															<select name="stage" class="form-control" id="stage" onChange="javascript:changer(this.value)">
                                                  
<option value="0" <?php if(!isset($_GET['stage']) or ($_GET['stage'] == 0)) echo 'selected'; ?>>No Revisados</option> 

<option value="2" <?php if($_GET['stage'] == 2) echo 'selected'; ?>>Completos</option>
<option value="3" <?php if($_GET['stage'] == 3) echo 'selected'; ?>>Todos los Incompletos</option>
<option value="4" <?php if($_GET['stage'] == 4) echo 'selected'; ?>>Incompletos no aprobados</option>
<option value="5" <?php if($_GET['stage'] == 5) echo 'selected'; ?>>Incompletos aprobados</option>
<option value="1" <?php if($_GET['stage'] == 1) echo 'selected'; ?>>Todos</option>
</select>

<script>
function changer(value){
	window.location = "file-review-detail.php?stage="+value;
}
</script>
</div>
													  </div>

						</div>

						<div class="portlet-body">

		
                         <div class="table-container">

								

<?php 
							  

if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1;						

?>

								                                
                                	 	<p><strong>IDS:</strong> ID de solicitud.<br>
                               	   </p>
                               	   
                               	   
                               	   
                               	   <div class="note note-regular">NOTA: Las solicitudes que aparecen con fondo rojo, son las que ya han sido revisadas y encontradas incompletas.
							 </div>
                              
                              <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 IDR</th>
                                         <th width="2%">

										 IDS</th>
                                          <th width="2%">

										 UN</th>
                                         <th width="20%">

										 Beneficiario</th>
                                            <th width="10%">

										 Total Pagar</th>
                                          <th width="10%">

										 Vencimiento</th>
                                        

									<th width="10%">

										 Estado

									</th>
                                    
                                    <th width="5%">

										 Opciones</th>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result1)){
		
		//MAKE RID
		$querypackage = "select * from packagescontent where payment = '$row[id]'";
		$resultpackages = mysqli_query($con, $querypackage);
		$rowpackages = mysqli_fetch_array($resultpackages);
		$rid = $rowpackages['id'];
		
		$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']); 
									
		?>
                                
                                <tr role="row" class="odd <?php 
								
								$sentvar = 0;
								if($row['sent'] == 4){ 
								switch($row['sent_complete']){
								case 0:
								echo 'danger';
								$completed = " (incompleto)";
								break;
								case 1:
								echo 'success';
								$completed = " (completo)";
								break;
								} 
								}
								?>"> 
								<td class="sorting_1"> <a href="payment-order-view.php?id=<? echo $rid; ?>" target="_blank"><?php echo $rid; ?></a></td>
                                <td> <?php echo $row['id']; ?></td>
                                <td><?php echo $row['route']; ?></td>
                                <td>
                                <?php
							    echo $ben_name;
							    ?></td>
                                <td>
                                <?php
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'")); 
								echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].str_replace('.00','',number_format($row['payment'], 2));
								/*.' '.$rowcurrency['name'];*/ ?></td>
                                <td>
                                <?php //VENCIMIENTO ?>
                                <?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	

?>
                                </td>
                                <td>
                                <?php 
								
								/*$rowstatus = mysqli_fetch_array(mysqli_query($con, "select * from sentstages where id = '$row[sent]'"));
						echo $rowstatus['name'];		
						echo $completed;*/
						$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
						$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
						echo $rowstage['content']; 	
								
								?>
                                </td>
                              
                              <td>
                              
                              <a href="file-review-detail-check.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-check-square-o"></i> Revisar</a>
                               
                                </td></tr>
                                <?php } ?>
                                </tbody>
                                

								</table>
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="file-review-detail.php?stage=<? echo $_GET['stage']; ?>&page=<?php echo $previous.$str; ?>">
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
		  echo '<li><a href="file-review-detail.php?stage='.$_GET['stage'].'&page='.$i.$str.'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="file-review-detail.php?stage=<? echo $_GET['stage']; ?>&page=<?php echo $next.$str; ?>">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                               
<div class="note note-regular">
<p>IDS: ID de Solicitud<br>
IDR: ID de Remisión</p></div>
							</div>
                      
                          

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
                                
                 
                
			</div>



							</div>

							

							

							

							

							

							

					

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

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimeout.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-idle-timeout/jquery.idletimer.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>
<script src="../assets/admin/pages/scripts/components-pickers.js"></script>
<script type="text/javascript" src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script>

jQuery(document).ready(function() {    

Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init() // init quick sidebar
ComponentsPickers.init();



});

</script>

    
    <script type="text/javascript">

function onFocus(){	
	document.getElementById("id").focus();
}
						</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>