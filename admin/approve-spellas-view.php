<?php include("session-spellas.php"); 

$id = $_GET['id'];
$atype = $_GET['atype'];

$query = "select * from payments where id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$querycurrency = "select * from currency where id = '$row[currency]'";
$resultcurrency = mysqli_query($con, $querycurrency);
$rowcurrency = mysqli_fetch_array($resultcurrency);

if(($_SESSION['approve1'] != 'active') and ($atype == 1)){
	?>
    <script>
	alert('Usted no tiene permisos para realizar esta operación');
	window.location = 'approve.php';
	</script>
    <?php }
if(($_SESSION['approve2'] != 'active') and ($atype == 2)){
	?>
    <script>
	alert('Usted no tiene permisos para realizar esta operaci\u00f3n');
	window.location = 'approve.php';
	</script>
    <?php }
if(($_SESSION['approve3'] != 'active') and ($atype == 3)){
	?>
    <script>
	alert('Usted no tiene permisos para realizar esta operaci\u00f3n.');
	window.location = 'approve.php';
	</script>
    <?php }
//
if($row['approved'] == 1){
	?>
    <script>
	alert('Este pago ya fue aprobado.');
	window.location = 'approve.php';
	</script>
    <?php }
if($row['approved'] == 2){
	?>
    <script>
	alert('Este pago ya fue rechazado.');
	window.location = 'approve.php';
	</script>
    <?php }

$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
$rowtype = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[type]'"));
$rowconcept = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept]'"));
$rowconcept2 = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept2]'"));
$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
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

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

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

					Pagos <small>Aprobación de pagos.</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="approve-special.php">Pagos</a>
                            
                            <i class="fa fa-angle-right"></i>
                            
                            </li>
                            

						<li>

							<a>Aprobación de pagos</a>

						</li>

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">
                
                   <?php /*<div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

										

										</div>

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form action="tc-add-code.php" class="horizontal-form" method="post" enctype="multipart/form-data">

											<div class="form-body">

												<h3 class="form-section">Ingresar tipo de cambio</h3>

												<div class="row"><!--/span-->

												  <div class="col-md-6 ">
													  <div class="form-group">
														<label>Fecha:</label>
                                                        <input name="today" type="text" class="form-control form-control-inline date-picker" id="schedule[]" value="">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> <div class="col-md-6 ">
													  <div class="form-group">
														<label>TC:</label>
                                                        <input name="tc" type="text" class="form-control" id="tc" value="" onkeypress="return justNumbers(event);">
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                      <!--/row--></div>
													</div> 

													<!--/span-->

												</div>

												<!--/row--><!--/row-->
	   
												                                           
                                                   
                                                    	
                                                  
                                                  
                                                  
                                                  

											<!--/row--><!--/row--></div>


											<div class="form-actions right">


												<button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar</button>

											</div>

										</form>

										<!-- END FORM-->

									</div>
                                    
                       

								</div><br>*/ ?>
                                
                	<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						Información de la solicitud

							</div>
                           <?php /* <div class="actions">

								<a href="approve-view-advanced.php?id=<?php echo $_GET['id']; ?>" class="btn default blue-stripe">

								

								<span class="hidden-480">

								Vista avanzada</span>

								</a>

								                                
                                

							</div>*/ ?>

						</div>


					</div>
                    

					<div class="tabbable tabbable-custom boxless tabbable-reversed">
					  <?php ///// table ?>
                         	<div class="tab-pane" id="tab_1"> 
<div class="row"><!--/span-->


													<div class="col-md-12">
                           <?php $queryprovider = "select * from providers where code = '$rowbills[provider]'";
	$resultprovider = mysqli_query($con, $queryprovider);
	$rowprovider = mysqli_fetch_array($resultprovider);
	$provider = $rowprovider['name'];
	
	$queryuser = "select * from workers where code = '$row[userid]'";
											$resultuser = mysqli_query($con, $queryuser);
											$rowuser = mysqli_fetch_array($resultuser);
											$queryunit = "select * from units where code = '$rowuser[unit]'";
											$resultunit = mysqli_query($con, $queryunit);
											$rowunit = mysqli_fetch_array($resultunit);
											?>
    
<div class="col-md-4">

													 <h3>Informacion del solicitante</h3>
                                                      <p><strong>Nombre:</strong> <?php echo $rowuser['first']." ".$rowuser['last']; ?><br>
                                                      <strong>Código:</strong> <?php echo $rowuser['code']; ?><br>
                                                      <strong>Unidad de Negocio:</strong> <?php echo $rowuser['unit']; ?> | <?php echo $rowunit['name']; ?>
</p>

													</div>

<div class="col-md-4">
<?php if($row['btype'] == 1){
	$beneficiarytype = "Proveedor";
	$rowprovider = mysqli_fetch_array(mysqli_query($con, "select * from providers where id = '$row[provider]'"));
	$beneficiaryname = $rowprovider['name'];
	$beneficiarycode = $rowprovider['code'];
	
}elseif($row['btype'] == 2){
	$beneficiarytype = "Colaborador";
	$rowcollaborator = mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$row[collaborator]'"));
	$beneficiaryname = $rowcollaborator['first'].' '.$rowcollaborator['last'];
	$beneficiarycode = $rowcollaborator['code'];
}

?>



													 <h3>Informacion del <?php echo $beneficiarytype; ?></h3>
                                                      <p><strong>Nombre:</strong> <?php echo $beneficiaryname; ?><br>
                                                      <strong>Código:</strong> <?php echo $beneficiarycode; ?><br>
                                                      
</p>

													</div>  
                                                    
<div class="col-md-4">

<h3>Total pagar solicitud ID<?php echo $_GET['id']; ?></h3>

					<div class="dashboard-stat blue">

						<div class="visual">

							
						</div>

						<div class="details">

							<div class="number">
  							<?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($row['payment'],2)); ?>	
  							</div>

							<div class="desc"><?php echo $rowcurrency['name']; ?></div>

						</div>

					

					</div>
                    

				</div>
                                       
                                       <div class="row"></div>
                                       <div class="col-md-12">
                                       <p><strong>Gerente:</strong> <?php
									   
									   $querymanager = "select * from times where payment = '$row[id]' and ((stage = '2.00') or (stage = '3.00'))";
									   $resultmanager = mysqli_query($con, $querymanager);
									   while($rowmanager=mysqli_fetch_array($resultmanager)){
										   
										   $querymanager2 = "select * from workers where code = '$rowmanager[userid]'";
										   $resultmanager2 = mysqli_query($con, $querymanager2);
										   $rowmanager2 = mysqli_fetch_array($resultmanager2);
										   echo $rowmanager2['first']." ".$rowmanager2['last']."<br>";
										   
									   }
									   
									   ?>
<strong>Descripción:</strong> <?php echo $row['description']; ?>
 <br>
<strong>Comentarios del solicitante:</strong> <?php if($row['notes'] != ""){ ?><?php  echo $row['notes']; ?></p><?php }else{  echo "Sin comentarios."; }?></div>
                                       
                                       
                                                    
                                                    <div class="col-md-12">
    
    <h3>Lista de facturas</h3>
   <div class="table-scrollable"> 
 	 <?php
$mobile = 0;

    $aMobileUA = array(
        '/iphone/i' => 'iPhone', 
        '/ipod/i' => 'iPod', 
        '/ipad/i' => 'iPad', 
        '/android/i' => 'Android', 
        '/blackberry/i' => 'BlackBerry', 
        '/webos/i' => 'Mobile'
    );

    //Return true if Mobile User Agent is detected
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            $mobile = 1;
        }
    }
	
	/*if($mobile == 1){
	?> <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="12%">Fecha</th>
                                    <th width="12%">No.</th>
                                         <th width="12%">Total</th> 

								  </tr>

								</thead>

								<tbody>

                                <?php $querybills = "select * from bills where payment = '$_GET[id]'";
$resultbills = mysqli_query($con, $querybills);
while($rowbills=mysqli_fetch_array($resultbills)){
	
$querycurrency = "select * from currency where id = '$rowbills[currency]'";
$resultcurrency = mysqli_query($con, $querycurrency);
$rowcurrency = mysqli_fetch_array($resultcurrency);

?>

								
								
                                <tr role="row" class="odd">
                                  <td class="sorting_1"><?php echo $rowbills["billdate"]; ?></td>
                                  <td><?php echo $rowbills['number'];  ?></td>
                                  <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['ammount']))." ".$rowcurrency['name']; ?>
                                   
                                  </td> 
                                </tr>
                                
                                
                                
                                
                                
                                
                                <?php } //while ?>
                                </tbody>

								</table>
                                <?php } else{ ?>
           
            
                              <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="12%">Fecha</th>
                                    <th width="12%">No.</th>
                                         <th width="13%">Sub-total<br>
(que graba IVA):</th>
                                         <th width="13%">Sub-total<br>
(exento de IVA):</th>
                                         <th width="12%">Monto<br>
Alojamiento:</th>
                                         <th width="12%">Monto<br>
Intur:</th>
                                         <th width="12%">IVA:</th>
                                         <th width="12%">Total</th>

									<th width="12%">Exento</th>

									
                                     
                                  </tr>

								</thead>

								<tbody>

                                <?php $querybills = "select * from bills where payment = '$_GET[id]'";
$resultbills = mysqli_query($con, $querybills);
while($rowbills=mysqli_fetch_array($resultbills)){
	
$querycurrency = "select * from currency where id = '$rowbills[currency]'";
$resultcurrency = mysqli_query($con, $querycurrency);
$rowcurrency = mysqli_fetch_array($resultcurrency);

?>

								
								
                                <tr role="row" class="odd">
                                  <td class="sorting_1"><?php echo $rowbills["billdate"]; ?></td>
                                  <td><?php echo $rowbills['number'];  ?></td>
                                  <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['stotal'],2)); echo ' '.$rowcurrency['name']; ?></td>
                                  <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['stotal2']))." ".$rowcurrency['name']; ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['intur']))." ".$rowcurrency['name']; ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['inturammount']))." ".$rowcurrency['name']; ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['tax']))." ".$rowcurrency['name']; ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['ammount']))." ".$rowcurrency['name']; ?>
                                   
                                  </td> <td><?php echo $rowcurrency['symbol'].str_replace('.00','',number_format($rowbills['exempt']))." ".$rowcurrency['name']; ?>
                                   
                                  </td>
                                  
                                  </tr>
                                
                                
                                
                                
                                
                                
                                <?php } //while ?>
                                </tbody>

								</table>
								
								<?php } */ ?>
                                </div>
                                
    <?php /*<h3>Retenciones</h3>
    
 	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="25%">

										 % Alcaldía</th>

									<th width="25%">

										 Monto Alcaldía</th>

									<th width="25%">
                                    

										 % IR</th>
                                         <th width="25%">
                                    

										 Monto IR</th>
                                  </tr>

								</thead>

								<tbody>

                                <?php $querycurrency = "select * from currency where id = '$row[currency]'";
$resultcurrency = mysqli_query($con, $querycurrency);
$rowcurrency = mysqli_fetch_array($resultcurrency);

$querybills = "select * from bills where payment = '$_GET[id]'";
$resultbills = mysqli_query($con, $querybills);
while($rowbills=mysqli_fetch_array($resultbills)){
	
	

?>

								
								
                                <tr role="row" class="odd">
                                  <td class="sorting_1"><?php echo $row["ret1"]; ?></td>
                                  <td><?php echo 'C$'.str_replace('.00','',number_format($row['ret1a'],2)).' Córdobas'; ?></td>
                                  <td><?php echo $row['ret2']; ?>
                                   
                                  </td>
                                   <td><?php echo 'C$'.str_replace('.00','',number_format($row['ret2a'],2))." Córdobas"; ?> 
                                   
                                  </td>
                                  </tr>
                                
                                
                                
                                
                                
                                
                                <?php } //while ?>
                                </tbody>

								</table>*/ ?>
                                
                         
                         
                                <div class="row">
                                <div class="col-md-12">
                                             <h3 class="form-section">Conversación</h3>  
       
      <?php 
	  $paymentid2 = intval($_GET['id']);
	  $queryfmessages = "select * from approvecomments where payment = '$paymentid2' order by id asc";   
							   $resultfmessages = mysqli_query($con, $queryfmessages);
							   $numfmessages = mysqli_num_rows($resultfmessages);							  
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

											El <?php echo date('d-m-Y',strtotime($rowfmessages['today'])); ?> a las <?php echo date('h:i:s a', strtotime($rowfmessages['now2'])); ?> </span>

											<span class="body">

						 					<?php echo $rowfmessages['comments']; ?> </span>

										</div>

									</li>
                                    <?php //End while
									}
									?>

								</ul>
                                <?php } ?>
                                <br>
                              	<form method="post" enctype="multipart/form-data" action="approve-special-comments-add.php"> 
                                <textarea name="comments" id="comments" style="width:100%;"><?php echo $row['comments']; ?></textarea> <br><br>
                                <div class="form-actions right">  


												<button type="submit" class="btn blue"><i class="fa fa-comments"></i> Comentar</button> <input type="hidden" id="payment" name="payment" value="<?php echo $_GET['id']; ?>">
                                                
	</div>
                                
                                </form>                                  


                                             
</div></div>
                         
                                <div class="row"><br>
                                <div class="col-md-12">
                                             <h3 class="form-section">Opciones de aprobado</h3>  
                                         									
<br>

										
			
         							    
                          <form action="approve-view-code.php" class="horizontal-form" method="get" enctype="multipart/form-data" onsubmit="return validateForm();" id="myform">
                           <div class="col-md-12 " style="display:none;" id="cdiv">
													  <div class="form-group">
														<label class="control-label">Razón:</label>

													  <select name="reason2" class="form-control" id="reason2">
<option value="0">Otro</option>
<?php $queryreason = "select * from reason";
$resultreason = mysqli_query($con, $queryreason);
while($rowreason=mysqli_fetch_array($resultreason)){
?>
<option value="<?php echo $rowreason['id']; ?>"><?php echo $rowreason['name']; ?></option>
<?php } ?>

													  </select><br>
<br>
<label>Comentarios:</label>
                                                        <textarea name="reason" rows="2" class="form-control" id="reason" placeholder="Comente por que no aprueba esta solicitud de pago."></textarea>
						
                                                          
                       <br>

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                        <div class="row"></div>
                                                        
                                                      <!--/row--></div>
													</div>                          
                                                    
  <div class="row"><div class="col-md-12">
 
  <div class="form-actions right" style="margin-left:0px;">

												

						     <button type="button" class="btn blue" onClick="goHome();"><i class="fa fa-home"></i> Ir a principal</button> 
                             
                             <script>
							 function goHome(){
								 window.location = "approve-special.php";
							 }
							 </script><br>
                             <br>
                             
                             <span id="dapprove"> <button type="button" class="btn blue" onClick="divShow(0);"><i class="fa fa-check"></i> Aprobar</button>  <br><br>
</span>
                            
                           <span id="cancelreject" style="display:none;"> <button type="button" class="btn blue" onClick="divShow(2);"><i class="fa fa-times"></i> Cancelar Rechazar</button> <br><br>
</span>
                            
                             <button type="button" class="btn red" onClick="divShow(1);"><i class="fa fa-times"></i> Rechazar</button> <br>
												<input name="id[]" type="hidden" id="id[]" value="<?php echo $_GET['id']; ?>">
                                                <input name="atype[]" type="hidden" id="atype[]" value="<?php echo $atype; ?>">
                                                <span class="form-actions right" style="margin-left:0px;">
                                                <input name="approve" type="hidden" id="approve" value="0">
                                                <span class="form-actions right" style="margin-left:0px;">
                                                <input name="referer" type="hidden" id="referer" value="approve-special.php"> 
                                                </span>                                                </span> 
  </div>
                                       </div></div>
                                       </form>
                                
                                       
                                       </div>
                                                                                          </div>
                                <div class="row"> 
                                <div class="col-md-12">     
                                       
                            <br>
<br>
 <?php //desde aqui 


$querypayment = "select * from files where payment = '$paymentid2'";
$resultpayment = mysqli_query($con, $querypayment);
$numpayment = mysqli_num_rows($resultpayment);

if($numpayment > 0){
	


?>

<h3>Lista de archivos del pago </h3> 
<br>
   <div class="table-scrollable">  
   <table class="table table-striped table-bordered table-hover" id="datatable_orders" style="width:100%">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%">ID</th>
                                    <th width="80%">Archivo</th>
                                         <th width="18%">Opciones</th> 

								  </tr>

								</thead>

								<tbody>

                                <?php 
								
while($rowpayment=mysqli_fetch_array($resultpayment)){
$paymentid = $rowpayment['payment']; 
$url = $rowpayment['link'];
$url = str_replace('www.','',$url);
$url = str_replace('http://pagoscp.com/','',$url);
$url = str_replace('http://getpay.casapellas.com.ni/','',$url);
$url = str_replace('admin/visor.php?key=','',$url);

$queryofile = "select * from filebox where url = '$url'";
$resultofile = mysqli_query($con, $queryofile);
$rowofile = mysqli_fetch_array($resultofile);
//end while
if($rowofile['title'] != ""){
	$thetitle = $rowofile['title'];
}else{
	$thetitle = $rowofile['name'];
}
//echo '<strong>'.ucfirst($thetitle).'</strong></a>';

?>

								
								
                                <tr role="row" class="odd">
                                  <td class="sorting_1"><a href="files/folder_<?php echo $rowofile['user']; ?>/<?php echo str_replace(' ','%20',$rowofile['name']); ?>"><?php echo '<strong>'.$rowpayment['id'].'</a>';

?></a><a href="files/folder_<?php echo $rowofile['user']; ?>/<?php echo str_replace(' ','%20',$rowofile['name']); ?>"> </a></td>
                                  <td><a href="files/folder_<?php echo $rowofile['user']; ?>/<?php echo str_replace(' ','%20',$rowofile['name']); ?>"> <?php echo '<strong>'.ucfirst($thetitle).'</strong></a>';

?></a></td>
                                  <td><a href="files/folder_<?php echo $rowofile['user']; ?>/<?php echo str_replace(' ','%20',$rowofile['name']); ?>" target="_blank"> 
                                   
                                  <span id="dapprove"> <button type="button" class="btn blue"><i class="fa fa-search"></i> Ver archivo</button>  </span></a></td> 
                                </tr>
                                
                                
                                
                                
                                
                                
                                <?php } //while ?>
                                </tbody>

								</table>
                                </div>
 <?php /*
 <style type="text/css">
   iframe {
        width: 1px;
        min-width: 100%;
        *width: 100%;
    }
</style>
        
                                 
 <embed src="files/folder_<?php echo $rowofile['user']; ?>/<?php echo str_replace(' ','%20',$rowofile['name']); ?>"  style="width:100%;"/> ?>
  
                                 
                                      <?php /* <div style="overflow: scroll; -webkit-overflow-scrolling: touch; width: 300px; height:1000px;">
                                       <iframe src="files/folder_<?php echo $rowofile['user']; ?>/<?php echo str_replace(' ','%20',$rowofile['name']); ?>" style="width:100%;"  frameborder="0"></iframe> </div>
                                       </div>*/ ?>
                                       
                                       <?php }  ?>  
                                       
                                       
                                    
                                </div>
                                <div></div>
								
							</div>
                      

</div></div>

</div>


							

						

							

					<?php //table } ?>		

							

							

					

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

<script>

jQuery(document).ready(function() {    

   Metronic.init(); // init metronic core components

Layout.init(); // init current layout

QuickSidebar.init() // init quick sidebar



});

</script>

    
<script type="text/javascript">
  
		   function divShow(approve){
			 
		   	if(approve == 0){
				if(confirm('Esta seguro de aprobar esta solicitud?') == true){
					document.getElementById('approve').value = '1';
					document.forms["myform"].submit();
				}
		   }
		   
		   if(approve == 1){
			   if(document.getElementById("cdiv").style.display == 'block'){
				   document.getElementById('approve').value = '2';
				   if(validateForm()){
					   
					   document.forms["myform"].submit();
				   }
				   
			   }else{
			   document.getElementById("cdiv").style.display = 'block';
			   document.getElementById("cancelreject").style.display = 'block';
			   document.getElementById("dapprove").style.display = 'none';
			   }
			   
			   
		   }
		   
		   if(approve == 2){
			   document.getElementById("cdiv").style.display = 'none';
			   document.getElementById("cancelreject").style.display = 'none';		document.getElementById("dapprove").style.display = 'block';
			   
		   }
		   	
		   
}


function validateForm(){
	
	var reason = document.getElementById("reason").value;
	var reason2 = document.getElementById("reason2").value;
	
	if((reason2 == '0') && (reason == '')){
		alert('Cuando rechaza una solicitud de pago con la opcion "Otro" debe de justificar con comentarios.');
		return false;
		}
		
	 
		else{
			return true;
		}
		
		
}
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html> 