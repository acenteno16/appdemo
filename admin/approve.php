<?php 

include("session-approve.php"); 
include("functions.php");

if(($_SESSION['dch'] == "active") or ($_SESSION['spellas'] == "active")){ header('location: approve-special.php'); exit(); }

$thisRouteCode = array();	
$thisRouteName = array();	
								

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
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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

					Solicitudes <small>Aprobar Solicitudes</small> 

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						
                        <li>
                        <i class="fa fa-check-circle-o"></i> Aprobado de Solicitudes
                        </li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

                
                
				<?php if($_SESSION["approve_bt"] == "offline"){ ?>
				<div class="col-md-12">

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Solicitudes de pagos pendientes de aprobar  (Transferencias Bancarias)

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">
							<?php //BT
								
								
							
							 	
								$queryLetters = "select * from letters where status = '1' and approved = '0' order by id asc"; 	
								if(isset($_GET['echo'])){
									if($_GET['echo'] == 1){
										echo $query;
									}
								}	
								
								$resultLetters = mysqli_query($con, $queryLetters);
								$numLetters = mysqli_num_rows($resultLetters);
								
								
								if($numLetters > 0){ ?>
                                
                              <form id="approve1" name="approve1" action="approve-view-letters-code.php" method="get" enctype="multipart/form-data"> 
                                	
                                    
                                    <div class="table-container">
<div class="table-scrollable">
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
      </th>
                                         <th width="1%">

										 ID</th>

									

									<th width="5%">Transacción</th>

									<th width="15%">Origen</th>

									<th width="15%">Destino</th>

									<th width="5%">Monto</th>

									<th width="10%">Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php //1
								
									
								while($rowLetters=mysqli_fetch_array($resultLetters)){
								
								//FROM
								$row_from = mysqli_fetch_array(mysqli_query($con, "select * from banksaccounts where id = '$rowLetters[account1]'"));
								
								$row_companyfrom = mysqli_fetch_array(mysqli_query($con, "select name from companies where id = '$row_from[company]'"));
								$row_bankfrom = mysqli_fetch_array(mysqli_query($con, "select name from banks where id = '$row_from[bank]'"));
								$row_currencyfrom = mysqli_fetch_array(mysqli_query($con, "select pre from currency where id = '$row_from[currency]'"));
								$from = $row_companyfrom['name']."/".$row_bankfrom['name']."/".$row_from['account2']."/".$row_currencyfrom['pre'];
								
								
								//TO
								$row_to = mysqli_fetch_array(mysqli_query($con, "select * from banksaccounts where id = '$rowLetters[account2]'"));
								
								$row_companyto = mysqli_fetch_array(mysqli_query($con, "select name from companies where id = '$row_to[company]'"));
								$row_bankto = mysqli_fetch_array(mysqli_query($con, "select name from banks where id = '$row_to[bank]'"));
								$row_currencyto = mysqli_fetch_array(mysqli_query($con, "select pre from currency where id = '$row_to[currency]'"));
								$to = $row_companyto['name']."/".$row_bankto['name']."/".$row_to['account2']."/".$row_currencyto['pre'];
								
								
								?>
                                
                                <tr role="row">  
                                <td class="sorting_1"> <input name="id[]" type="checkbox" id="id[]" value="<?php echo $rowLetters['id']; ?>" class="approve0" <? if($rowLetters['parent'] > 0) echo 'disabled'; ?>></td>
                                <td><?php echo $rowLetters['id']; ?></td>
                                <td><?php 
								switch($rowLetters['transaction']){
									case 1:
									echo "Transferencia"; 
									break;
									case 2:
									echo "Cordobización";
									break;
									case 3:
									echo "Dolarizacion";
									break;
									case 4:
									echo "Prestamo"; 
									break;
									case 5:
									echo "Abono/Cancelación"; 
									break;
									
									} ?></td>
								 <td><?php echo $from; ?></td>
								 <td><?php echo $to; ?></td> 
								 <td><?php echo $row_currency['pre'].$row['amount']; ?></td>
                                 <td><a href="approve-view-letters.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> <? if($row['parent'] == 0){ ?> <a href="approve-view-letters-code.php?id[]=<?php echo $row['id']; ?>&approve=1" class="btn btn-xs default btn-editable"><i class="fa fa-check"></i> Aprobar</a><? } ?> </td></tr>
                                        
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
<?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: Ninguna aprobación de transferencias bancarias pendiente.
						</p>

					</div>
                                <?php } ?>
							</div>

						</div>

					</div>

				</div>
                <?php } ?>
                
                
				<?php if($_SESSION["approve1"] == "active"){ ?>
				  <div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Solicitudes de pagos pendientes de aprobar  (1er Nivel)

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">
							<?php //1
								
								$sqlu = "";
								$numu = 0;
								$queryu = "select * from routes where worker = '$_SESSION[userid]' and type = '2'";
								$resultu = mysqli_query($con, $queryu);
								$numu = mysqli_num_rows($resultu);
								if($numu > 0){
									$firstu = 1;
									while($rowu=mysqli_fetch_array($resultu)){
										if($firstu == 1){ //First
											$sqlu = " and (((payments.routeid = '$rowu[unitid]'))";
											if($numu == 1){
												$sqlu .= ")";
											}
											$firstu++;
										}elseif($firstu == $numu){ //Last
											$sqlu .= " or ((payments.routeid = '$rowu[unitid]')))";
											$firstu++;
										}else{ //Middle
											$sqlu .= " or ((payments.routeid = '$rowu[unitid]'))";
											$firstu++;
										}
									}
                                 
								$query = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.status = '1' and payments.arequest = '1' and payments.approved = '0' and payments.child='0'".$sqlu." order by payments.expiration asc"; 
									
								if(isset($_GET['echo'])){
									if($_GET['echo'] == 1){
										echo $query;
									}
								}	
								
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								}
								
								if($num > 0){ ?>
                                
                              <form id="approve1" name="approve1" action="approve-view-code.php" method="get" enctype="multipart/form-data">
                                	
                                    
                                    <div class="table-container">
<div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="2%">

										 <input type="checkbox" class="group-checkable" id="checkall1" onChange="javascript:checkAll();" /> 
                                
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
      </script>
      </th>
                                    <th width="1%">ID</th>
									<th width="15%">Beneficiario</th>
									<th width="3%">Compañía</th>
									<th width="1%">Info</th>
									<th width="10%">Total Pagar</th>
									<th width="10%">Vencimiento</th>
									<th width="5%">Estado</th>
									<th width="10%">Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php //1
								
								
								while($row=mysqli_fetch_array($result)){
									
								if(!isset($thisRouteCode[$row['routeid']])){
									$thisRouteCode[$row['routeid']] = getUnit($row['routeid'],$row['ncatalog'],'code');
								}
								if(!isset($thisRouteName[$row['routeid']])){
									$thisRouteName[$row['routeid']] = getUnit($row['routeid'],$row['ncatalog'],'name');
								}
								
								$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']); 
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								
								?>
                                
                                <tr role="row" <?php if($row['expiration'] < date('Y-m-d')) echo 'class="danger"'; ?>>
                                <td class="sorting_1"> <input name="id[]" type="checkbox" id="id[]" value="<?php echo $row['id']; ?>" class="approve1" <? if($row['parent'] > 0) echo 'disabled'; ?>></td>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $ben_name; ?></td>
								<td><? 
									if(file_exists("companies/$row[company].png")) echo "<img src='companies/$row[company].png' width='25px'>"; 
									echo '&nbsp;&nbsp;<span class="tooltips" data-placement="right" data-original-title="'.$thisRouteName[$row['routeid']].'">'.$thisRouteCode[$row['routeid']].'</span>'; ?>
								</td>
								<td><button class="btn tooltips" data-placement="right" data-original-title="<? echo $row['description']; ?>"><i class="fa fa-info"></i></button></td>
								 <td><?php $querycurrency = "select * from currency where id = '$row[currency]'"; 
								$resultcurrency = mysqli_query($con, $querycurrency);
								$rowcurrency = mysqli_fetch_array($resultcurrency);
								echo $rowcurrency['pre']." ";
								echo $rowcurrency['symbol'];
								if($row['parent'] == 0){
									echo str_replace('.00','',number_format($row['payment'], 2));
								}else{
									echo str_replace('.00','',number_format($row['globalpayment'], 2));
								}
								
								
								
								?></td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
?></td><td><?php echo $rowstage['content']; ?> 
										</td><td>
                                       <a href="approve-view.php?id=<?php echo $row['id']; ?>&atype=1" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> <? if($row['parent'] == 0){ ?> <a href="approve-view-code.php?id[]=<?php echo $row['id']; ?>&approve=1&atype=1" class="btn btn-xs default btn-editable"><i class="fa fa-check"></i> Aprobar</a><? } ?> </td></tr>
                                        
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
<?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: Ninguna aprobación de 1er nivel pendiente.
						</p>

					</div>
                                <?php } ?>
							</div>

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
                <?php } ?>
				
				
<?				
if($_SESSION["approve2"] == "active"){ 
?>
                <div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Solicitudes de pagos pendientes de aprobar  (2do Nivel)

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">
								<?php //2
								$sqlu = "";
								$numu = 0;
								$queryu = "select * from routes where worker = '$_SESSION[userid]' and type = '3'";
								$resultu = mysqli_query($con, $queryu);
								$numu = mysqli_num_rows($resultu);
								if($numu > 0){
									$firstu = 1;
									while($rowu=mysqli_fetch_array($resultu)){
										if($firstu == 1){ //First
											$sqlu = " and (((payments.routeid = '$rowu[unitid]'))";
											if($numu == 1){
												$sqlu .= ")";
											}
											$firstu++;
										}elseif($firstu == $numu){ //Last
											$sqlu .= " or ((payments.routeid = '$rowu[unitid]')))";
											$firstu++;
										}else{ //Middle
											$sqlu .= " or ((payments.routeid = '$rowu[unitid]'))";
											$firstu++;
										}
									}
                                   
								//2	
								$query = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.status = '2'  and payments.arequest = '1' and payments.approved = '0' and payments.child='0'".$sqlu." order by payments.expiration asc"; 
								$result = mysqli_query($con, $query); 
								$num = mysqli_num_rows($result);
								}
								
								if($num > 0){ ?>
                                
                                	 <form id="approve2" name="approve2" action="approve-view-code.php" method="get" enctype="multipart/form-data">
                                  <div class="table-container">
<div class="table-scrollable">  <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="2%">

										 <input type="checkbox" class="group-checkable" id="checkall2" onChange="javascript:checkAll2();" /> 
                                
                                  <script>
    function checkAll2(){
	 var checkall = document.getElementById('checkall2');
	  var checkboxes = new Array();
       checkboxes = document.getElementsByClassName('approve2');
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
      								<th width="1%">

										 ID</th>
									<th width="15%">Beneficiario</th>
									<th width="3%">Compañía</th>
									<th width="1%">Info</th>
									<th width="10%">Total Pagar</th>
									<th width="10%">Vencimiento</th>
									<th width="10%">Estado</th>
									<th width="10%">Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php //2
								while($row=mysqli_fetch_array($result)){
									
									
									
								if(!isset($thisRouteCode[$row['routeid']])){
									$thisRouteCode[$row['routeid']] = getUnit($row['routeid'],$row['ncatalog'],'code');
								}
								if(!isset($thisRouteName[$row['routeid']])){
									$thisRouteName[$row['routeid']] = getUnit($row['routeid'],$row['ncatalog'],'name');
								}
								
									$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']); 
									$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
									$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								
								?>
                                
                                <tr role="row" class="odd">
                                 <tr role="row" class="odd">
                                   <td class="sorting_1"> <input name="id[]" type="checkbox" id="id[]" value="<?php echo $row['id']; ?>" class="approve2" <? if($row['parent'] > 0) echo 'disabled'; ?>></td>
									 
                                <td><?php echo $row['id']; ?></td>
									 <td><?php echo $ben_name; ?></td>
									 <td><? 
									if(file_exists("companies/$row[company].png")) echo "<img src='companies/$row[company].png' width='25px'>"; 
									echo '&nbsp;&nbsp;<span class="tooltips" data-placement="right" data-original-title="'.$thisRouteName[$row['routeid']].'">'.$thisRouteCode[$row['routeid']].'</span>'; ?>
								</td>
									 <td><button class="btn tooltips" data-placement="right" data-original-title="<? echo $row['description']; ?>"><i class="fa fa-info"></i></button></td>
									 <td><?php $querycurrency = "select * from currency where id = '$row[currency]'"; 
								$resultcurrency = mysqli_query($con, $querycurrency);
								$rowcurrency = mysqli_fetch_array($resultcurrency);
								echo $rowcurrency['pre']." ";
								echo $rowcurrency['symbol'];
								if($row['parent'] == 0){
									echo str_replace('.00','',number_format($row['payment'], 2));
								}else{
									echo str_replace('.00','',number_format($row['globalpayment'], 2));
								}
								
								
								
								?></td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
?></td><td><?php echo $rowstage['content']; ?> 
									
							
								
							</td><td><a href="approve-view.php?id=<?php echo $row['id']; ?>&atype=2" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> <? if($row['parent'] == 0){ ?><a href="approve-view-code.php?id[]=<?php echo $row['id']; ?>&approve=1&atype=2" class="btn btn-xs default btn-editable"><i class="fa fa-check"></i> Aprobar</a><? } ?>  </td></tr>
                                <?php } ?>
                                
                                    </tbody>

								</table>
                                </div></div>
                                <div class="form-actions right">

<input type="hidden" id="approve" name="approve" value="1">
<input type="hidden" id="atype" name="atype" value="2">
<button type="submit" class="btn blue"><i class="fa fa-check"></i> Aprobar</button>
                                       </div>
                                </form>
                                
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: Ninguna aprobación de 2do nivel pendiente.

						</p>

					</div>
                                <?php } ?>
                            

							</div>

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
                <?php } ?>
                
                
<?
if($_SESSION["approve3"] == "active"){ 
?> 
                <div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Solicitudes de pagos pendientes de aprobar (3er Nivel)

							</div>

							

						</div>

						<div class="portlet-body">

							<div class="table-container">
							<?php //3
								$sqlu = "";
								$numu = 0;
								$queryu = "select * from routes where worker = '$_SESSION[userid]' and type = '4'";
								$resultu = mysqli_query($con, $queryu);
								$numu = mysqli_num_rows($resultu);
								if($numu > 0){
									$firstu = 1;
									while($rowu=mysqli_fetch_array($resultu)){
										if($firstu == 1){ //First
											$sqlu = " and (((payments.routeid = '$rowu[unitid]'))";
											if($numu == 1){
												$sqlu .= ")";
											}
											$firstu++;
										}elseif($firstu == $numu){ //Last
											$sqlu .= " or ((payments.routeid = '$rowu[unitid]')))";
											$firstu++;
										}else{ //Middle
											$sqlu .= " or ((payments.routeid = '$rowu[unitid]'))";
											$firstu++;
										}
									}
                                 
								$query = "select payments.* from payments inner join workers on payments.userid = workers.code where payments.status = '3' and payments.arequest = '1' and payments.approved = '0' and payments.child='0'".$sqlu." order by payments.expiration asc"; 
								
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								
								}
								
								if($num > 0){ ?>
                                
                                 <form id="approve3" name="approve3" action="approve-view-code.php" method="get" enctype="multipart/form-data">
                                	
                                    <div class="table-container">
<div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading"> <th width="2%"> <input type="checkbox" class="group-checkable" id="checkall3" onChange="javascript:checkAll3();" /> 
                                
                                  <script>
    function checkAll3(){
	 var checkall = document.getElementById('checkall3');
	  var checkboxes = new Array();
      checkboxes = document.getElementsByClassName('approve3');
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
      <th width="5%">

										 ID</th>

									

									<th width="15%">

										 Beneficiario</th>
									<th width="3%">Compañia</th>
									<th width="1%">Info</th>

									<th width="10%">Total Pagar</th>

									<th width="10%">Vencimiento</th>

									<th width="10%">Estado</th>

									<th width="10%">Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php while($row=mysqli_fetch_array($result)){

								$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']); 
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								
								?>
                                
                                <tr role="row" class="odd"><td class="sorting_1"> <input name="id[]" type="checkbox" id="id[]" value="<?php echo $row['id']; ?>" class="approve3" <? if($row['parent'] > 0) echo 'disabled'; ?>></td>
                                <td><?php echo $row['id']; ?></td>
								<td><?php echo $ben_name; ?></td>
								<td><? if(file_exists("companies/$row[company].png")) echo "<img src='companies/$row[company].png' width='25px'>"; 
									
									echo '<button class="btn tooltips" data-placement="right" data-original-title="'.$row['description'].'"><i class="fa fa-info"></i></button>'.$row['route']; ?></td>
									<td><button class="btn tooltips" data-placement="right" data-original-title="<? echo $row['description']; ?>"><i class="fa fa-info"></i></button></td>
								<td><?php $querycurrency = "select * from currency where id = '$row[currency]'"; 
								$resultcurrency = mysqli_query($con, $querycurrency);
								$rowcurrency = mysqli_fetch_array($resultcurrency);
								echo $rowcurrency['pre']." ";
								echo $rowcurrency['symbol'];
								if($row['parent'] == 0){
									echo str_replace('.00','',number_format($row['payment'], 2));
								}else{
									echo str_replace('.00','',number_format($row['globalpayment'], 2));
								}
								
								?></td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.intval(abs($dias)).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.intval(abs($dias)).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.intval(-1*abs($dias)).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
	?></td><td><?php echo $rowstage['content']; ?> 
									
							
								
							</td><td> <a href="approve-view.php?id=<?php echo $row['id']; ?>&atype=3" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> <? if($row['parent'] == 0){ ?><a href="approve-view-code.php?id[]=<?php echo $row['id']; ?>&approve=1&atype=3" class="btn btn-xs default btn-editable"><i class="fa fa-check"></i> Aprobar</a><? } ?></td></tr>
                                <?php } ?>
                                
                                 </tbody>

								</table>
                                </div></div>
                               <div class="form-actions right">

						<input type="hidden" id="approve" name="approve" value="1">
						<input type="hidden" id="atype" name="atype" value="3">
						<button type="submit" class="btn blue"><i class="fa fa-check"></i> Aprobar</button>
                                   </div>
                                </form>
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: Ninguna aprobación de 3er nivel pendiente.

						</p>

					</div>
                               
                                <?php } ?>
                               

							</div>

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
			<?php } ?>

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

<script>

jQuery(document).ready(function() {    

 Metronic.init(); // init metronic core components

Layout.init(); // init current layout

QuickSidebar.init() // init quick sidebar 

     

        });

    </script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>