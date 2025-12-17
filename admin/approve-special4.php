<?php include("session-dch-spellas.php"); 
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

              <? if($_GET['filter'] == 1){ include('approve-special-filter.php'); } ?>
            
               <? 
		
							$sqlu = "";
							$numu = 0;
							$queryu = "select * from routes where worker = '$_SESSION[userid]' and (type = '2' or type = '3' or type = '4')";
							$resultu = mysqli_query($con, $queryu);
							$numu = mysqli_num_rows($resultu); 
							if($numu > 0){
								$firstu = 1;
								while($rowu=mysqli_fetch_array($resultu)){
									$rowutype = intval($rowu['type'])-1;
										
									if($firstu == 1){ //First
										$sqlu = " and (((payments.status = '$rowutype') and (payments.route = '$rowu[unit]'))";
										if($numu == 1){
											$sqlu .= ")";
										}
										$firstu++;
									}elseif($firstu == $numu){ //Last
										$sqlu.= " or ((payments.status = '$rowutype') and (payments.route = '$rowu[unit]')))";
										$firstu++;
									}else{ //Middle
										$sqlu .= " or ((payments.status = '$rowutype') and (payments.route = '$rowu[unit]'))";
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
					
							$query = "select payments.id, payments.parent, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.payment, payments.currency, payments.today, payments.expiration from payments inner join times on payments.id = times.payment where payments.approved = '0' and payments.type = '4'".$sqlu.$sql." group by payments.id order by payments.expiration desc"; 
									
							if(isset($_GET['echo'])){
								if($_GET['echo'] == 1){
									echo $query;
								}
							}	
								
							$result = mysqli_query($con, $query);
							$num = mysqli_num_rows($result);
							
							?>
             				<div class="col-md-12">
				 <!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<? echo $num; ?> Devoluciones pendientes de aprobación

							</div>
						</div>

						<div class="portlet-body">

							<div class="table-container">
							<?php if($num > 0){ ?> 
                            <form id="approve1" name="approve1" action="approve-view-code.php" method="get" enctype="multipart/form-data">
                                	
                                    
                                    <div class="table-container">
									<div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">
								<th width="2%"> <input type="checkbox" class="group-checkable" id="checkall_0" onChange="javascript:checkAll(0);" checked="checked" /> </th>
      							<th width="15%"> Información General</th>
								<th width="10%">  Opciones</th>
								</tr>
								</thead>

								<tbody>
                                <?php //1
								
									
								while($row=mysqli_fetch_array($result)){
											
								$rowuser = mysqli_fetch_array(mysqli_query($con, "select code, first, last from workers where code = '$row[userid]'"));
								$this_username = $rowuser['code']." | ".$rowuser['first']." ".$rowuser['last'];
								#confirmar si ya existe
								$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']);
								
								
								?>
                                
                                <tr role="row" class="odd">
                                <td class="sorting_1"> <input name="id[]" type="checkbox" class="approve_0" id="id_0" value="<?php echo $row['id']; ?>" checked></td> 
                                <td>ID: <?php echo $row['id']; ?><br>
                                Solicitante: <? echo $this_username; ?><br>
								<span style="font-size:16px; font-wigth:bold;">Cliente: <?php echo $ben_name; ?><br>
                                Monto: <?php 
								echo $globalCurrencyPre[$row['currency']].' '.$globalCurrencySymbol[$row['currency']].str_replace('.00','',number_format($row['payment'], 2));
								
								
								
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
				
				
           					<br><br><br><br>
				
							<div class="col-md-12">
					<!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<?php
							
									
						
//1st process
$querybefore1 = "select payments.userid from payments inner join workers on payments.userid = workers.code inner join times on payments.id = times.payment where payments.approved = '0'".$sqlu." group by payments.userid order by payments.expiration desc"; 
$resultbefore1 = mysqli_query($con, $querybefore1); 
$numbefore1 = mysqli_num_rows($resultbefore1);
$globalpaymentsnumber=0;				
								if(isset($_GET['echo'])){
								if($_GET['echo'] == 1){
									echo $querybefore1;
								}
							}
while($rowbefore1=mysqli_fetch_array($resultbefore1)){

	//2nd process
	$querybefore2 = "select payments.id from payments inner join workers on payments.userid = workers.code where payments.approved = '0' and payments.type != '4'".$sqlu." and payments.userid = '$rowbefore1[userid]' order by payments.expiration asc"; 
	$resultbefore2 = mysqli_query($con, $querybefore2);
	$numbefore2 = mysqli_num_rows($resultbefore2);
	$globalpaymentsnumber = $globalpaymentsnumber+$numbefore2;
	if(isset($_GET['echo'])){
								if($_GET['echo'] == 1){
									echo $querybefore2;
								}
							}

}

								

							?>
                            <div class="caption">

								<strong><?php echo $globalpaymentsnumber; ?></strong> Solicitudes pendientes de aprobación *

							</div>

							

						</div>

						<div class="portlet-body">
                        
                        

							<div class="table-container">
								<?php 
							
								
								//Aqui para indicador
								
								//Aqui solicitudes de pagos
								
								$querybefore = "select payments.userid from payments inner join workers on payments.userid = workers.code inner join times on payments.id = times.payment where payments.approved = '0' and payments.type != '4'".$sqlu.$sql." group by payments.userid order by payments.expiration desc"; 
								$resultbefore = mysqli_query($con, $querybefore); 
								$numbefore = mysqli_num_rows($resultbefore);
								if(isset($_GET['echo'])){
								if($_GET['echo'] == 1){
									echo $querybefore;
								}
							}
								
								
								if($numbefore > 0){ 
								$inc = 1;
								while($rowbefore=mysqli_fetch_array($resultbefore)){
									$rowworker = mysqli_fetch_array(mysqli_query($con, "select first, last, unit from workers where code = '$rowbefore[userid]'"));
									
								
								?> 
                                
                                <div><p><strong>Solicitante:</strong> <?php echo $rowworker[1]." ".$rowworker[2]; ?><br>
                                <strong>Unidad de Negocio:</strong> <?php 
								$querythisunit = "select name from units where code = '$rowworker[unit]'";
								$resultthisunit = mysqli_query($con, $querythisunit);
								$rowthisunit = mysqli_fetch_array($resultthisunit);
								echo $rowworker['unit']." | ".$rowthisunit['name']; ?></p>
                               
<br>
 </div>
                                
                                	 <form id="approve2" name="approve2" action="approve-view-code.php" method="get" enctype="multipart/form-data" onsubmit="return validateForm();"> 
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">

										 <input type="checkbox" class="group-checkable" id="checkall_<? echo $inc; ?>" onChange="javascript:checkAll(<? echo $inc; ?>);" checked="checked" />  
                                
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
                                <?php 
								
								
								//2
								$query = "select payments.id, payments.parent, payments.btype, payments.provider, payments.collaborator, payments.intern, payments.client, payments.payment, payments.currency, payments.today, payments.expiration, payments.description from payments inner join workers on payments.userid = workers.code where payments.approved = 0".$sqlu." and payments.userid = '$rowbefore[userid]' order by payments.expiration asc"; 
								$result = mysqli_query($con,$query);
									
									if(isset($_GET['echo'])){
								if($_GET['echo'] == 1){
									echo $query;
								}
							}
								unset($arpayments);
								while($row=mysqli_fetch_array($result)){
									
								$arpayments[] = $row[0];	
								$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']);
							
								?>
                                <tr role="row" class="odd">
                                  <td class="sorting_1"> <input name="id[]" type="checkbox" class="approve_<? echo $inc; ?>" id="id_<? echo $inc; ?>" value="<?php echo $row['id']; ?>" checked></td>
                                <td>ID: <?php echo $row['id']; ?><br>
<span style="font-size:16px; font-wigth:bold;">Beneficiario: <?php echo $ben_name; 
								?>
                                  <br>
                                  Monto: <?php  echo $globalCurrencyPre[$row['currency']]." ".$globalCurrencySymbol[$row['currency']].str_replace('.00','',number_format($row['payment'], 2));
								
								
								
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
                                <?php 
								
								} ?>
                                
                                    </tbody>

								</table>
                                <div class="form-actions right">
<? $inc++; ?>
<input type="hidden" id="approve" name="approve" value="1">
<input type="hidden" id="atype" name="atype" value="2">
<button type="submit" class="btn blue" style="margin-top:20px;"><i class="fa fa-check"></i> Aprobar seleccionados de <?php 
$workerfirst = explode(" ", $rowworker[1]);
$workerlast = explode(" ", $rowworker[2]);
echo $workerfirst[0]." ".$workerlast[0]; ?></button> 

</form>

<button type="button" class="btn blue" style="margin-top:20px;" onClick="openConversation(<?php echo $rowworker[0]; ?>)"><i class="fa fa-comments" ></i> Mostrar/Ocultar conversación con <?php 
$workerfirst = explode(" ", $rowworker[1]);
$workerlast = explode(" ", $rowworker[2]);
echo $workerfirst[0]." ".$workerlast[0]; ?></button>
<br>
<?php 


$sqlfm = "";
$larpayments = sizeof($arpayments)-1;
for($ar=0;$ar<sizeof($arpayments);$ar++){
	
	if($ar == 0){
		$sqlfm .= " and ((payment = $arpayments[$ar])";
		if(sizeof($arpayments) == 1){
			$sqlfm .= ")";
		}
	}
	elseif($ar == sizeof($larpayments)){
		$sqlfm .= " or (payment = $arpayments[$ar]))";
	}
	else{
		$sqlfm .= " or (payment = $arpayments[$ar])";
	}
}

$queryfmessages = "select * from approvecomments where id >0".$sqlfm." order by id asc";   
							   $resultfmessages = mysqli_query($con, $queryfmessages);
							   $numfmessages = mysqli_num_rows($resultfmessages);			
?>
<div class="row" <?php if($numfmessages == 0) echo 'style="display:none;"'; ?> id="conversation_<?php echo $rowworker[0]; ?>">
                                <div class="col-md-12">
                                             <h3 class="form-section">Conversación</h3>  
       
      <?php 				  
							   if($numfmessages > 0){
								   
							   ?><br>
                               <ul class="chats">

									<?php $side = "out";
									$i=1; 
									while($rowfmessages=mysqli_fetch_array($resultfmessages)){
										$queryuser = "select * from workers where code = '$rowfmessages[userid]'"; 
										$resultuser = mysqli_query($con, $queryuser);
										$rowuser = mysqli_fetch_array($resultuser);
										$username = $rowuser['first']." ".$rowuser['last'];
										
										if(($lastuser == $rowuser['code']) and ($i > 1)){
										$change = 0;
									}else{
										$change = 1;
									}	
									if($change == 1){
									if($side == "in"){
										$side = "out";
									}else{
										$side = "in";
									}
									}
									$lastuser = $rowuser['code'];
									$i++;
										
									?>
                                    <a name="comment<?php echo $rowfmessages['id']; ?>"></a>
                                    <li class="<?php echo $side; ?>">

										<?php $filepicture = "profiles/".$rowuser['code']."/".$rowuser['code'].".jpg"; 
					
					if(file_exists($filepicture)){
						?>
                           
                             <img class="avatar" alt="" src="<?php echo $filepicture; ?>">
                            <?php }else{
					
					?>
                   <img class="avatar" alt="" src="../assets/admin/layout/img/avatar3_small.jpg">
                   
                   
                    
                    <?php } ?>
                    
                    

										<div class="message">

											<span class="arrow">

											</span>

											<a href="#" class="name" name="<?php echo 'comment'.$rowfmessages['id']; ?>">

											<?php echo $username; ?> </a>

											<span class="datetime" style="color:#A6A6A6;">

											El <?php echo date('d-m-Y',strtotime($rowfmessages['today'])); ?> a las <?php echo date('h:i:s a', strtotime($rowfmessages['now2'])); ?> || Pago No. <?php echo $rowfmessages['payment']; ?></span>

											<span class="body">

						 					<?php echo $rowfmessages['comments']; ?> </span>

										</div>

									</li>
                                    <?php //End while
									}
									?>

								</ul>
                          
                               
                                <?php }else{ ?>
                                
                                <div class="note danger">No hay mensajes.</div>
                                <?php } ?>
                                <div id="waitercov_<?php echo $rowworker[0]; ?>"></div>
                                <br>
                              <?php /*	<form method="post" enctype="multipart/form-data" action="approve-special-comments-add.php"> 
                                <textarea name="comments" id="comments" style="width:100%;"><?php echo $row['comments']; ?></textarea> <br><br>
                                <div class="form-actions right">  


												<button type="submit" class="btn blue"><i class="fa fa-comments"></i> Comentar</button> <input type="hidden" id="payment" name="payment" value="<?php echo $_GET['id']; ?>">
                                                
	</div>
                                
                                </form>*/ ?>                                  


                                             
</div></div>
<hr>
                                       </div> 
                               
                                
                                
                                <br>
                                
                                <?php } } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: Ninguna aprobación  pendiente.

						</p>

					</div>
                                <?php } ?>
                            

							</div>

						</div>

					</div>
					
					<? } ?>

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