<?php
include("session-dch-spellas.php"); 

//Danilo Chamorro Code
$this_userid = "226237";

include("functions.php");?>

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

<style type="text/css">

body{
	text-decoration:none;
	font-size:17px;
}
</style>

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

					Pagos <small>Aprobado de pagos</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Pagos</a> 

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>
                        Aprobado de pagos
                        </li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

              
                <div class="col-md-12"><!-- Begin: life time stats -->
<form id="ungrouped" name="ungrouped" 
action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
<input name="form" type="hidden" id="form" value="1">
<div class="note note-regular">
<div class="row">
<h4 style="margin-left:15px;">Filtro:</h4><br>
<?php //desde aqui ?>


<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Solicitante:</label>

						
					
                                        <select name="requester" class="form-control  select2me" id="requester" data-placeholder="Seleccionar...">

												<option value="">Todos los Colaboradores</option>
 <?php 
 
 $queryproviders = "select * from workers where code != '' order by first,last";
 $resultproviders = mysqli_query($con, $queryproviders);
 while($rowproviders = mysqli_fetch_array($resultproviders)){ 
										
											?>
                                            <option value="<?php echo $rowproviders["code"]; ?>" <?php if($rowproviders["code"] == $_GET['requester']) echo 'selected'; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
                                            <?php } ?>

											</select>
                                            
                                           

															<div title="Page 5"></div>
													  </div>

													</div>
                                                                             <div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Gerente:</label> 

						
					
                                        <select name="approver" class="form-control  select2me" id="approver" data-placeholder="Seleccionar...">

<option value="">Todos los Gerentes</option>  
<?php 
 
 $queryproviders0 = "select * from routes where ((type = '2') or (type = '3')) group by worker"; 
 $resultproviders0 = mysqli_query($con, $queryproviders0);
 while($rowproviders0 = mysqli_fetch_array($resultproviders0)){ 
 
 $queryproviders = "select * from workers where code = '$rowproviders0[worker]'";
 $resultproviders = mysqli_query($con, $queryproviders);
 $rowproviders = mysqli_fetch_array($resultproviders);
										
											?>
                                            <option value="<?php echo $rowproviders["code"]; ?>" <?php if($_GET['approver'] == $rowproviders["code"]) echo "selected"; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
                                            <?php } ?>

											</select>
                                            
                                           

															<div title="Page 5"></div>
													  </div>

													</div>
                                        
<div class="col-md-3 ">
													  <div class="form-group">
														<label>ID de Solicitud:</label>
                                                        <input name="idpayment" type="text" class="form-control" id="idpayment" value="">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                   <div class="col-md-3 ">
												     <div class="form-group">
													   <label>Unidad de Negocio:</label>
                                                      <select name="unit" class="form-control  select2me" id="unit" data-placeholder="Seleccionar...">

<option value="">Todas las unidades</option>  
<?php 
 
 $queryunits = "select * from units order by code"; 
 $resultunits = mysqli_query($con, $queryunits); 
 while($rowunits = mysqli_fetch_array($resultunits)){ 
 

										
											?>
                                            <option value="<?php echo $rowproviders0["code"]; ?>" <?php if($_GET['unit'] == $rowunits["code"]) echo "selected"; ?>><?php echo $rowunits["code"].' | '.$rowunits["name"]; ?></option>
                                            <?php } ?>

											</select>
                                             
                      

                       <!--/row-->
                                                         <!--/row-->
                                                         <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                    
                                                    
                                                    

</div>            
                                                    
<div class="row"></div>


                                        

<?php /*if($_SESSION['admin'] == "active"){ ?>
                                                   
                                                    <div class="col-md-2 " style="margin-left:50px;">
													  <div class="form-group">
														<label>Buscar como administrador:</label>
                                                    <input name="asadmin" type="checkbox" id="asadmin" value="1"> 
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                    
                                                    
                                                   <?php } */ ?>
                             
<div class="row">
</div>
<div class="row">

<br><br>
						<div class="col-md-6">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-search"></i>  Filtrar</button> <button type="button" class="btn red" onClick="javascript:deleteFilter();"><i class="fa fa-search"></i>  Eliminar filtro</button> 
                            <script>
							function deleteFilter(){
								window.location = "approve-spellas.php"; 
							}
							</script>
												
                 </div>                               
  
</div>
						
								</div>
                                </form> 
					 
			</div>
            
            <? 
			//Moved
							$sqlu = "";
							$numu = 0;
							$queryu = "select * from routes where worker = '$this_userid' and (type = '2' or type = '3' or type = '4')";
							$resultu = mysqli_query($con, $queryu);
							$numu = mysqli_num_rows($resultu); 
							if($numu > 0){
								$firstu = 1;
								while($rowu=mysqli_fetch_array($resultu)){
									$rowutype = intval($rowu['type'])-1;
									if($firstu == 1){ //First
										$sqlu = " and (((payments.status = '$rowutype') and (payments.routeid = '$rowu[unitid]') and (payments.headship = '$rowu[headship]'))";
										if($numu == 1){ $sqlu .= ")"; } $firstu++;
									}
									elseif($firstu == $numu){ //Last
										$sqlu .= " or ((payments.status = '$rowutype') and (payments.routeid = '$rowu[unitid]') and (payments.headship = '$rowu[headship]')))";
										$firstu++;
									}
									else{ //Middle
										$sqlu .= " or ((payments.status = '$rowutype') and (payments.routeid = '$rowu[unitid]') and (payments.headship = '$rowu[headship]'))";
										$firstu++;
									}
								} 
							//End moved
							
							//Moved2
							$requester = $_GET['requester'];				
$sql1 = "";
if($requester != ""){
	$sql1 = " and payments.userid = '$requester'";
}
$payment = $_GET['idpayment'];				
$sql2 = ""; 
if($payment != ""){
	$sql2 = " and payments.id = '$payment'";
}
$unit = $_GET['unit'];	 			
$sql3 = "";
if($unit != ""){
	$sql3 = " and payments.route = '$unit'";
} 

$sql4 = ""; 
$approver = $_GET['approver'];
if($approver != ""){
	$sql4 = " and ((times.stage = '2.00') or (times.stage = '3.00')) and times.userid = '$approver'"; 
}

$sql = $sql1.$sql2.$sql3.$sql4;	
							//End moved2
							
							
							
								$query = "select payments.* from payments inner join times on payments.id = times.payment where payments.approved = '0' and payments.type = '4'".$sqlu.$sql." group by payments.id order by payments.expiration desc"; 
									
								if(isset($_GET['echo'])){
									if($_GET['echo'] == 1){
										echo $query;
									}
								}	
								
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
							
							?>
             <div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<? echo $num; ?> Devoluciones pendientes de aprobación

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">
							<?php 
							
						
								
								
								
								
								if($num > 0){ ?>
                                
                              <form id="approve1" name="approve1" action="approve-view-code.php" method="get" enctype="multipart/form-data">
                                	
                                    
                                    <div class="table-container">
<div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 <input type="checkbox" class="group-checkable" id="checkall_0" onChange="javascript:checkAll('0');" checked="checked" /> 
                               
                                 <script>
    function checkAll(cki){
	 var checkall = document.getElementById('checkall_'+cki);
	  var checkboxes = new Array();
      checkboxes = document.getElementsByClassName('approve_'+cki);
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
                                
                 
      </th>
      <th width="15%">

							 Información General</th>

									<th width="10%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php //1
								
									
								while($row=mysqli_fetch_array($result)){
								
								$rowuser = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[userid]'"));
								$this_username = $rowuser['code']." | ".$rowuser['first']." ".$rowuser['last'];
								$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']); 
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								
								?>
                                
                                       <tr role="row" class="odd">
                                  <td class="sorting_1"> <input name="id[]" type="checkbox" class="approve_0" id="id_0" value="<?php echo $row['id']; ?>" checked></td> 
                                <td>ID: <?php echo $row['id']; ?><br>
                                Solicitante: <? echo $this_username; ?><br>
<span style="font-size:16px; font-wigth:bold;">Cliente: <?php echo $ben_name; ?>
                                  <br>
                                  Monto:<?php $querycurrency = "select * from currency where id = '$row[currency]'";
								$resultcurrency = mysqli_query($con, $querycurrency);
								$rowcurrency = mysqli_fetch_array($resultcurrency);
								echo $rowcurrency['pre']." ";
								echo $rowcurrency['symbol'];
								echo str_replace('.00','',number_format($row['payment'], 2));
								
								
								
								?>
                                 </span> <br>
                                Descripcion: <?php echo $row['description']; ?> 
                                <br>Ingreso: <? echo date('d-m-Y',strtotime($row['today'])); ?>
<br>Vencimiento: <?php if($row['expiration'] != '0000-00-00'){
							
							$date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.abs($dias).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
							} 
									
									$venc = intval(-1*abs($dias));
									
									if($row['expiration'] <= $row['today']){
										echo ' <span style="color:#F00"><i class="fa fa-clock-o"> </i> Ingreso Vencido</span>';
									}
							
?>
                                  
                                  
                                  </td><td>
 <a href="approve-view-code.php?id[]=<?php echo $row['id']; ?>&approve=1" class="btn btn-xs blue btn-editable"><i class="fa fa-check"></i> Aprobar</a><br>
<br>

<a href="javascript:addConversation(<?php echo $row['id']; ?>,<?php echo $rowworker['id']; ?>);" class="btn btn-xs default btn-editable"><i class="fa fa-comments"></i> Conversar</a><br><br>

<a href="javascript:rejectPayment(<?php echo $row['id']; ?>);" class="btn btn-xs red btn-editable"><i class="fa fa-times"></i> Rechazar</a><br><br><?php /*<a href="approve-view-code.php?id[]=<?php echo $row['id']; ?>&approve=2" class="btn btn-xs red btn-editable"><i class="fa fa-times"></i> Rechazar</a><br><br>*/ ?>

<a href="approve-special-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
</td></tr>
                                        
                                <?php } ?>
                                </tbody>

								</table>
                                </div></div>
                                <div class="form-actions right">

<input type="hidden" id="approve" name="approve" value="1">
<input type="hidden" id="atype" name="atype" value="1">
<button type="submit" class="btn blue"><i class="fa fa-check"></i> Aprobar</button>
                                                    </div>
                                                    </form> 
<?php } ?>
                 
							</div>

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
           		
					<? } ?>

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

<script>




function addConversation(payment,worker){
	
	document.getElementById("conversation_"+worker).style.display = "block"; 
	
	$("#waitercov_"+worker).append('<form method="post" enctype="multipart/form-data" action="approve-special-comments-add.php"><a name="newconversation"></a><textarea name="comments" id="comments" style="width:100%;"></textarea><br><br><div class="form-actions right"><button type="submit" class="btn blue"><i class="fa fa-comments"></i> Comentar</button> <input type="hidden" id="payment" name="payment" value="'+payment+'"></div></form>');  
	
	var aTag = $("a[name='newconversation']");
    $('html,body').animate({scrollTop: aTag.offset().top - 100},'slow'); 
	 
	} 
function validateForm(){ 
	//
	if(confirm('Esta seguro de querer aprobar esta solicitud') == true){
		return true;
	}else{
		return false;
	}
}

function openConversation(id){ 
	
	var thediv = document.getElementById("conversation_"+id).style.display;
	if(thediv == 'block'){
		document.getElementById("conversation_"+id).style.display = "none";
	}else{
		document.getElementById("conversation_"+id).style.display = "block";
	}
	
}

function rejectPayment(id){
	if(confirm('Esta seguro de rechazar la solicitud No. '+id) == true){
		window.location = "approve-view-code.php?id[]="+id+"&approve=2";
	}	 
}
</script>
<?php /*<a href="" class="btn btn-xs red btn-editable"><i class="fa fa-times"></i> Rechazar</a><br><br>*/ ?>
<script>
$(document).ready(function(){
  
  // Donde queremos cambiar el tamaño de la fuente
  var donde = $('.mitexto');
  var sizeFuenteOriginal = donde.css('font-size');
  
  // Resetear Font Size
  $(".resetearFont").click(function(){
  donde.css('font-size', sizeFuenteOriginal);
  });
 
  // Aumentar Font Size
  $(".aumentarFont").click(function(){s
  	var sizeFuenteActual = donde.css('font-size');
 	var sizeFuenteActualNum = parseFloat(sizeFuenteActual, 10);
    var sizeFuenteNuevo = sizeFuenteActualNum*1.2;
	donde.css('font-size', sizeFuenteNuevo);
	return false;
  });
 
  // Disminuir Font Size
  $(".disminuirFont").click(function(){
  	var sizeFuenteActual = donde.css('font-size');
 	var sizeFuenteActualNum = parseFloat(sizeFuenteActual, 10);
    var sizeFuenteNuevo = sizeFuenteActualNum*0.8;
	donde.css('font-size', sizeFuenteNuevo);
	return false;
  });
  
});
</script>