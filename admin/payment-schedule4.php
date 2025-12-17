<?php include("session-schedule.php"); ?>
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

					Programación de pagos <?php //<small>Ordenes de pago</small> ?> 
					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

				
                        <li>

							<a href="payment-schedule.php">Programación de pagos</a>

						

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			
           
            <div class="row">

				<div class="col-md-12"><!-- Begin: life time stats -->
 <form id="ungrouped" name="ungrouped" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="get">
                

<div class="note note-regular">
								<div class="row">
                             <h4 style="margin-left:15px;">Filtro de pagos:</h4><br>
<?php //Forma de pago ?>
<div class="col-md-2">

<?php $sql1 = "";
								$ptype = $_GET['ptype'];
								if($ptype != ""){
								
									//echo 'Sizeof='.sizeof($ptype)."<br>";
									for($c=1;$c<=sizeof($ptype);$c++){
										$cdec = $c-1;
										$filter1[$ptype[$cdec]] = 1;
										
										if(($c == 1) and (sizeof($ptype) > 1)){
											$sql1 .= " and (payments.ptype = '$ptype[$cdec]'";						
										}
										if(($c > 1) and ($c < sizeof($ptype))){
											$sql1 .= " or payments.ptype = '$ptype[$cdec]'";										
											
										}
										if(($c == sizeof($ptype)) and (sizeof($ptype) > 1)){
											$sql1 .= " or payments.ptype = '$ptype[$cdec]')";											 
										}
										if(($c == 1) and (sizeof($ptype) == 1)){
											$sql1 .= " and payments.ptype = '$ptype[$cdec]'";
											
										}
									}
								}
								$sql2 = "";
								$currency = $_GET['currency'];
								if($currency != ""){
									for($c=1;$c<=sizeof($currency);$c++){
										$cdec = $c-1;
										$filter2[$currency[$cdec]] = 1;
										
										if(($c == 1) and (sizeof($currency) > 1)){
											$sql2 .= " and (payments.currency = '$currency[$cdec]'";
										}
										if(($c > 1) and ($c < sizeof($currency))){
											$sql2 .= " or payments.currency = '$currency[$cdec]'";
										}
										if(($c == sizeof($currency)) and (sizeof($currency) > 1)){
											$sql2 .= " or payments.currency = '$currency[$cdec]')"; 
										}
										if(($c == 1) and (sizeof($currency) == 1)){
											$sql2 .= " and payments.currency = '$currency[$cdec]'";
										} 
									}
								}
								
								
								$sql31 = "";
								$expiration1 = $_GET['expiration1'];
								if($expiration1 != ""){
								
								$fecha = date("Y-m-d");
								$soon = strtotime ( '-7'.' day' , strtotime ( $fecha ) ) ;
								$soon = date ( 'Y-m-d' , $soon );
								 
								$sql31 = " and ((payments.expiration >= '$soon') and (payments.expiration < '$fecha'))";  
								}
								
								$sql32 = "";
								$expiration2 = $_GET['expiration2'];
								if($expiration2 != ""){
								
								$fecha = date("Y-m-d");
								
								
								$sql32 = " and payments.expiration <= '$fecha'";  
								}
								
								$sql33 = "";
								$expiration3 = $_GET['expiration3'];
								if($expiration3 != ""){
								
								$fecha = date("Y-m-d");
								
								
								$sql33 = " and payments.expiration > '$fecha'";  
								}
								
								
								
								$sql3 = $sql31.$sql32.$sql33;
								
								
								
								$sql4 = "";
								$gcp = $_GET['gcp'];
								if($gcp != ''){
									$sql4 = " and providers.gcp = '1'";
									$filter4['gcp'] = 1;
								}
								$sql5 = "";
								$vip = $_GET['vip'];
								if($vip != ''){
									$sql5 = " and providers.vips = '1'";
									$filter4['vip'] = 1;
								}
								$sql6 = "";
								$type1 = $_GET['type1'];
								if($type1 != ""){
									for($c=1;$c<=sizeof($type1);$c++){
										$cdec = $c-1;
										if(($c == 1) and (sizeof($type1) > 1)){
											$sql6 .= " and (payments.type = '$type1[$cdec]'";
										}
										if(($c > 1) and ($c < sizeof($type1))){
											$sql6 .= " or payments.type = '$type1[$cdec]'";
										}
										if(($c == sizeof($type2)) and (sizeof($type1) > 1)){
											$sql6 .= " or payments.type = '$type1[$cdec]')"; 
										}
										if(($c == 1) and (sizeof($type1) == 1)){
											$sql6 .= " and payments.type = '$type1[$cdec]'";
										} 
									}
								}
								$sql7 = "";
								$type2 = $_GET['type2'];
								if($type2 != ""){
									for($c=1;$c<=sizeof($type2);$c++){
										$cdec = $c-1;
										if(($c == 1) and (sizeof($type2) > 1)){
											$sql7 .= " and (payments.concept = '$type2[$cdec]'";
										}
										if(($c > 1) and ($c < sizeof($type2))){
											$sql7 .= " or payments.concept = '$type2[$cdec]'";
										}
										if(($c == sizeof($type2)) and (sizeof($type2) > 1)){
											$sql7 .= " or payments.concept = '$type2[$cdec]')"; 
										}
										if(($c == 1) and (sizeof($type2) == 1)){
											$sql7 .= " and payments.concept = '$type2[$cdec]'";
										} 
									}
								}
								$sql8 = "";
								$type3 = $_GET['type3'];
								if($type3 != ""){
									for($c=1;$c<=sizeof($type3);$c++){
										$cdec = $c-1;
										if(($c == 1) and (sizeof($type3) > 1)){
											$sql8 .= " and (payments.concept2 = '$type3[$cdec]'";
										}
										if(($c > 1) and ($c < sizeof($type3))){
											$sql8 .= " or payments.concept2 = '$type3[$cdec]'";
										}
										if(($c == sizeof($type3)) and (sizeof($type3) > 1)){
											$sql8 .= " or payments.concept2 = '$type3[$cdec]')"; 
										}
										if(($c == 1) and (sizeof($type3) == 1)){
											$sql8 .= " and payments.concept2 = '$type3[$cdec]'";
										} 
									}
								}
								
								
								$sql9 = "";
if($_GET['provider'] != ""){
$sql9 = " and payments.provider = '$_GET[provider]'";
}
$sql10 = "";
if($_GET['worker'] != ""){
$sql10 = " and payments.collaborator = '$_GET[worker]'";
}
								$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10;
								
?>





										<label><strong>Forma de pago</strong></label>
										<div class="checkbox-list">
											<label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="1" <?php if($filter1[1] == 1) echo 'checked'; ?>></span> Transf. elect.<?php //echo $filter1[1]; ?> </label>
                                            <label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="2" <?php if($filter1[2] == 1) echo 'checked'; ?>></span> Cheque </label>
                                            <label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="3" <?php if($filter1[3] == 1) echo 'checked'; ?>></span> TC </label>
                                            <label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="4" <?php if($filter1[4] == 1) echo 'checked'; ?>></span> Telepagos </label>
                                            <label>
											<span class=""><input name="ptype[]" type="checkbox" id="ptype[]" value="5" <?php if($filter1[5] == 1) echo 'checked'; ?>></span> Internet </label>
											
									
									</div>
</div>
<?php //Moneda ?>
<div class="col-md-2">


										<label><strong>Moneda</strong></label>
										<div class="checkbox-list">
											<label>
											<span class=""><input name="currency[]" type="checkbox" id="currency[]" value="1" <?php if($filter2[1] == 1) echo 'checked'; ?>></span> Cordobas </label>
                                            <label>
											<span class=""><input name="currency[]" type="checkbox" id="currency[]" value="2" <?php if($filter2[2] == 1) echo 'checked'; ?>></span> Dolares </label>
                                            <label>
											<span class=""><input name="currency[]" type="checkbox" id="currency[]" value="3" <?php if($filter2[3] == 1) echo 'checked'; ?>></span> Euros </label>
                                            <label>
											<span class=""><input name="currency[]" type="checkbox" id="currency[]" value="4" <?php if($filter2[4] == 1) echo 'checked'; ?>></span> Yenes </label>
                                           
									</div>
</div>
<?php //Vencimineto/Vips ?>
<div class="col-md-2">


										<label><strong>Vencimiento</strong></label>
										<div class="checkbox-list">
											<label>
											<span class=""><input name="expiration1" type="checkbox" id="expiration1" value="1" <?php if($filter31 == 1) echo 'checked'; ?> onClick="expirationFn();"></span> Por vencerse</label>
                                            <label>
											<span class=""><input name="expiration2" type="checkbox" id="expiration2" value="1" <?php if($filter32 == 1) echo 'checked'; ?> onClick="expirationFn();"></span> Vencidos</label>
                                            <label>
											<span class=""><input name="expiration3" type="checkbox" id="expiration3" value="1" <?php if($filter33 == 1) echo 'checked'; ?> onClick="expirationFn();"></span>  No vencidos</label>
                                           
									
									</div>
                                    <label><strong>VIPs</strong></label>
										<div class="checkbox-list">
											<label>
											<span class=""><input name="gcp[]" type="checkbox" id="gcp[]" value="1" <?php if($filter4['gcp'] == 1) echo 'checked'; ?>></span> Grupo Pellas</label>
                                            <label>
											<span class=""><input name="vip[]" type="checkbox" id="vip[]" value="1" <?php if($filter4['vip'] == 1) echo 'checked'; ?>></span> VIPs externos</label>
                                           
                                           
									
									</div>
</div>
<?php //Tipo ?>
<div class="col-md-2">
<label><strong>Tipo</strong></label>
<div class="checkbox-list">
  <?php $queryt = "select * from categories where level = '1' and searchable = '1'";
$resultt = mysqli_query($con, $queryt);
while($rowt=mysqli_fetch_array($resultt)){ 
?>
<label><span class=""><input name="type1[]" type="checkbox" id="type1[]" value="<?php echo $rowt['id']; ?>"></span> <?php echo $rowt['name']; ?></label>
<?php } ?>
</div>
</div>
<?php //Concepto ?>
<div class="col-md-2">


										<label><strong>Concepto</strong></label>
									    <div class="checkbox-list">
											
                                          <?php $queryt = "select * from categories where level = '2' and searchable = '1'";
$resultt = mysqli_query($con, $queryt);
while($rowt=mysqli_fetch_array($resultt)){ 
?>
<label><span class=""><input name="type2[]" type="checkbox" id="type2[]" value="<?php echo $rowt['id']; ?>"></span> <?php echo $rowt['name']; ?></label>
<?php } ?>
    </div>
   
    </div>
<?php //Sub-categoria ?>
<div class="col-md-2">


										<label><strong>Categoría</strong></label>
									<div class="checkbox-list">
											  <?php $queryt = "select * from categories where level = '3' and searchable = '1'";
$resultt = mysqli_query($con, $queryt);
while($rowt=mysqli_fetch_array($resultt)){ 
?>
<label><span class=""><input name="type3[]" type="checkbox" id="type3[]" value="<?php echo $rowt['id']; ?>"></span> <?php echo $rowt['name']; ?></label>
<?php } ?>
                                       
    </div>
   
    </div> 
    

                                
</div> 

                             
<div class="row">
<br>
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Proveedor:</label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar...">

												<option value="">Todos los Proveedores</option>
 <?php $queryproviders = "select * from providers order by name";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["name"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Colaborador:</label>

						
											<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar...">

												<option value="">Todos los Colaboradores</option>
 <?php $queryproviders = "select * from workers order by first,last";
											$resultproviders = mysqli_query($con, $queryproviders);
											
											while($rowproviders = mysqli_fetch_array($resultproviders)){
										
											?>
                                            <option value="<?php echo $rowproviders["id"]; ?>"><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
                                            <?php }
											?>

												

											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
</div>
<div class="row">

<br><br>
						<div class="col-md-4">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button><input type="button" class="btn blue" style="margin-left:5px;" onClick="window.location='payment-schedule.php';" value="Limpiar Filtro"> 
												
                 </div>                               
  
</div>
						
								</div>
                           
                                
                                <br><br>
                <?php 
				$form = $_GET['form'];
				if($form == 0){
				?>                
                
                <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								Programación agrupada

							</div>

							<div class="actions">

								<a href="payment-schedule-print.php" class="btn default blue-stripe">

								<i class="fa fa-print"></i>

								<span class="hidden-480">

								Imprimir</span>

								</a>
                                
                                <a href="payment-schedule-manual.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Prog. manual</span>

								</a>
                                
                                <a href="payment-schedule-group.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Grupos</span>

								</a>

							

							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">

								<?php 
								
								$query = "select * from payments where ((status = '9') or (status = '13.02') or (status = '13.03')) and sent_approve = '1' order by expiration asc";
								
								if(($_SESSION['email'] == 'jairovargasg@gmail.com') or ($username == 'jairovargasg@gmail.com')){ 
	 $query = "select * from payments where ((status = '9') or (status = '13.02') or (status = '13.03')) order by expiration asc";
 }
								//TEST que deja pasar los pagos sin control de calidad.
								//echo "NO SE ESTA TOMANDO EN CUENTA CONTROL DE CALIDAD"; 
								//$query = "select * from payments where status = '9' order by expiration asc";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								if($num > 0){ ?>	
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%" class="table-checkbox">

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
                                
                                    <th width="3%">

										 ID</th>

									<th width="35%">

										 Proveedor</th>

									<th width="5%">Total Pagar</th>

									<th width="5%">

										 Vencimiento

									</th>

									<th width="5%">

										 Documento

									</th>

									<th width="5%">

										 Opciones</th>

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
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="checkboxes" onChange="calculateBalance();" <?php if(array_search($row['id'],$_GET['theid']) == true) echo "checked"; ?>></td>  
                                <td class="sorting_1"><?php echo $row['id']; ?></td><td><?php echo $rowprovider['code']; ?> | <?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; if($row['btype'] == 1){ echo $rowprovider['name'];
								}else{
									echo $rowprovider['first']." ".$rowprovider['last']; } ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); ?>
                                  <input name="tpayment[]" type="hidden" id="tpayment[]" value="<?php echo $row['payment']; ?>">
                                  <input name="tcurrency[]" type="hidden" id="tcurrency[]" value="<?php echo $row['currency']; ?>"></td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.abs($dias).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.abs($dias).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.-1*abs($dias).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
?></td><td><?php 

//Documentos

$querydocuments = "select * from batch where payment = '$row[id]'";
$resultdocuments = mysqli_query($con, $querydocuments);
while($rowdocuments=mysqli_fetch_array($resultdocuments)){
	echo $rowdocuments['nodocument']."<br>"; 
}
 ?> 
									
							
								
							</td><td>
                            <?php 
							
							if($row['blockschedule'] == ""){ ?> 
                            <a href="payment-schedule-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> <?php }else{  
							
							$queryuser = "select * from workers where code = '$row[blockschedule]'";
							$resultuser = mysqli_query($con, $queryuser);
							$rowuser = mysqli_fetch_array($resultuser);
							$initial = $rowuser['first'];
							$initial = $initial[0];
							$lastname = explode(" ",$rowuser["last"]);
							$username = $initial.". ".$lastname[0];
							?> 
                            
                      <a href="<?php if($row['blockschedule'] == $_SESSION['userid']){ echo "payment-schedule-view.php?id=".$row['id']; }else{ echo 'payment-view.php?id='.$row['id']; } ?>" class="btn btn-xs default btn-editable"><i class="fa fa-lock"></i> <?php echo $username; ?></a>      
                            <?php } ?>
                            </td></tr>
                                <?php } 
								?> 
                                    </tbody>

								</table>
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna programación pendiente.

						</p>

					</div>
                                <?php } ?>
                            
                               <?php if($num > 0){ ?>	 <div class="form-actions right">


										<div class="row">	<div class="col-md-4"><input name="schedule" type="text" class="form-control form-control-inline date-picker" id="schedule" value=""></div>
                                            	<button type="button" class="btn blue" id="scheduleButton"><i class="fa fa-check"></i> Programar</button> 
                                      
<script> 
$('#scheduleButton').click(function(){
	$('#scheduleForm').attr('action', 'payment-schedule-code.php');
	$('#scheduleForm').attr('onsubmit', 'return validateForm();');
	$( "#scheduleForm").submit();  
});  
</script>
									  
                                                
                                            

    <div class="row"></div>
    <div class="col-md-6">
    <p>Total programación: <span id="thenumbersum">C$0.00</span></p>
    </div>
    </div>
     <?php } ?>
                                
                               

					</div>

					</div>

					<!-- End: life time stats -->

				</div>
                </form>
                <script>
function validateForm(){
var today = new Date();
var dd = today.getDate();
var mm = parseInt(today.getMonth()+1); //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd='0'+dd
} 

if(mm<10) {
    mm='0'+mm
} 

//mm =  parseInt(mm,10);
//dd =  parseInt(dd,10);
today = yyyy+'/'+mm+'/'+dd;

var schedule = document.getElementById("schedule[]").value;
var schedule1 = schedule;
var elem = schedule.split('-');

var dia = elem[0];
var mes = elem[1];
var ano = elem[2];

schedule = ano+'/'+mes+'/'+dia

today = new Date(today);
schedule = new Date(schedule);

if(schedule < today){
	document.getElementById("schedule[]").focus();
	alert('No se puede programar a una fecha anterior');
	return false;
}
if(schedule1 == ''){
	alert('No se puede programar pagos sin ingresar la fecha.');
	document.getElementById("schedule[]").focus();
	return false;
}
		
}
</script>
           
                <?php }else{ ?>
                 
             
                  <form id="theform" name="theform" action="payment-schedule-code.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">	
                <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

							Resultados del filtro

							</div>

						
						</div>

						<div class="portlet-body">

							<div class="table-container">

								
								<?php 
								$query = "select payments.* from payments inner join times on payments.id = times.payment left join providers on payments.provider = providers.id where payments.status = '9' and payments.sent_approve = '1' ".$sql.' group by payments.id';

								
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								if($num > 0){ ?> 	
                                
                                	<div class="table-scrollable"><table class="table table-striped table-bordered table-hover" id="sample_2">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%" class="table-checkbox">

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
                                <th width="3%">

										 ID</th>

									<th width="9%">

										 Cóodigo</th>

									<th width="18%">

										 Nombre</th>

									<th width="10%">Total Pagar</th>

									<th width="14%">

										 Vencimiento

									</th>

									<th width="5%">

										 Estado

									</th>

									<th width="16%">

										 Opciones</th>

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
                                  <td class="sorting_1" id="maintheid<?php echo $table; ?>"><input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="checkboxes" onChange="calculateBalance();" <?php 
								  $ifselected = array_search($row['id'],$_GET['theid'],true);
								  if($ifselected != ""){
									  $_GET['theid'][$ifselected];
									  if($_GET['theid'][$ifselected] == $row['id']){
										  echo "checked";
									  }
								  }
								
								   ?>>
                                  </td> 
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php echo $rowprovider['code']; ?></td><td><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; if($row['btype'] == 1){ echo $rowprovider['name'];
								}else{
									echo $rowprovider['first']." ".$rowprovider['last']; } ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.number_format($row['payment'], 2); ?>
                                    <input name="tpayment[]" type="hidden" id="tpayment[]" value="<?php echo $row['payment']; ?>">
                                    <input name="tcurrency[]" type="hidden" id="tcurrency[]" value="<?php echo $row['currency']; ?>"></td><td><?php $date1 = date("Y-m-d");
							echo $date2 = date('d-m-Y',strtotime($row['expiration']));
							
	$dias	= (strtotime($date1)-strtotime($date2))/86400;
	if($dias <= -8) echo ' <span style="color:#060">('.abs($dias).")</span>"; 
	if(($dias <= 0) and ($dias >= -7)) echo ' <span style="color:#FC0">('.abs($dias).")</span>"; 
	
	elseif($dias > 0) echo ' <span style="color:#F00">('.-1*abs($dias).")</span>"; 
	
	//$dias = abs($dias); 
	//if($dias >= 0)$dias = floor($dias);
	//$dias = $dias <= 0 ? $dias : -$dias ;		
	//echo ' ('.$dias.")";
	
?></td><td><?php echo $rowstage['content']; ?></td><td><?php /*<a href="payment-schedule-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver</a>*/ ?>
                            <?php 
							
							if($row['blockschedule'] == ""){ ?> 
                            <a href="payment-schedule-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a> <?php }else{  
							
							$queryuser = "select * from workers where code = '$row[blockschedule]'";
							$resultuser = mysqli_query($con, $queryuser);
							$rowuser = mysqli_fetch_array($resultuser);
							$initial = $rowuser['first'];
							$initial = $initial[0];
							$lastname = explode(" ",$rowuser["last"]);
							$username = $initial.". ".$lastname[0];
							?> 
                            
                      <a href="<?php if($row['blockschedule'] == $_SESSION['userid']){ echo "payment-schedule-view.php?id=".$row['id']; }else{ echo 'payment-view.php?id='.$row['id']; } ?>" class="btn btn-xs default btn-editable"><i class="fa fa-lock"></i> <?php echo $username; ?></a>      
                            <?php } ?>
                            
                            </td></tr>
                                <?php } ?>
                                
                                   </tbody>

								</table></div>
                                <div class="row">


											<div class="col-md-4"><input name="schedule" type="text" class="form-control form-control-inline date-picker" id="schedule" value=""></div>
                                            	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Programar</button>
                                                
	</div>
     <div class="row"></div>
    <div class="col-md-6">
    <p>Total programación: <span id="thenumbersum">C$0.00</span></p>
    </div>
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay pagos liberados con las características de este grupo.

						</p>

					</div>
                                <?php } ?>
                             
                                 
                                
                               

						</div>

					</div>

					<!-- End: life time stats -->

				</div>
                </form>
<script>
function validateForm(){
var today = <?php echo date('Y-m-d'); ?>
var schedule = document.getElementById("schedule").value;
if(schedule > today){
	alert('today')
}
	alert('false');
return false;
if(schedule == ''){
	//alert('No se puede programar pagos sin ingresar la fecha.');
	document.getElementById("schedule").focus();
	return false; 
}
		
}
</script>
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


function expirationFn(){
	var varuno = 0;
	var vardos = 0;
	var vartres = 0;
	var vartotal = 0;
	
	var uno = document.getElementById('expiration1').checked;
	var dos = document.getElementById('expiration2').checked;
	var tres = document.getElementById('expiration3').checked;
	
	if(uno == true){
		var varuno = 1;
	}
	if(dos == true){
		var vardos = 1;
	}
	if(tres == true){
		var vartres = 1;
	}
	vartotal = varuno+vardos+vartres;
	if(vartotal > 1){
		
		document.getElementById('expiration1').checked = false;
		document.getElementById('expiration2').checked = false;
		document.getElementById('expiration3').checked = false;
		alert('Solo se puede seleccionar una una opcion de vencimiento.');
		 
	}
}
						
                        
function calculateBalance(){

	totalpayment=0;
	
	var i=0;
	var i2=0;
for (var obj in document.getElementsByName('theid[]')){
 if (i<document.getElementsByName('theid[]').length){

 if(document.getElementsByName('theid[]')[i].checked == true){
	
	if(i2 == 0){
		var first_select = document.getElementsByName('tcurrency[]')[i].value;
		i2++; 
	}
	
	tpayment =  document.getElementsByName('tpayment[]')[i].value;
	var tcurrency = document.getElementsByName('tcurrency[]')[i].value;
	
	if(tcurrency != first_select){
		document.getElementsByName('theid[]')[i].checked = false;
		alert('Favor realizar la programacion con solicitudes de una misma moneda.');
		
		
	} 
	totalpayment += parseFloat(tpayment);
 }

  }
  i++;
}

document.getElementById('thenumbersum').innerHTML = 'C$'+commas(totalpayment);

} 


function commas(unformatedAmmount) {
    
	var floatAmmount = parseFloat(unformatedAmmount);
	var floatAmmount2 = floatAmmount.toFixed(2); 
	
	var parts = floatAmmount2.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
	var parts2 = parts.join(".");
	return parts2;  
}

                        
                        
                        </script>

<!-- END JAVASCRIPTS --> 

</body>

<!-- END BODY -->

</html>