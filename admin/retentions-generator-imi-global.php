<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

include("session-retentions.php"); 
require('functions.php');

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

					Retenciones <small>Alcaldía</small> 

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

							<a href="withholding-mayor-tax.php">Alcaldía</a>

							<i class="fa fa-angle-right"></i>

						</li>
                        <li>

							<a href="#">Visor Global</a>

							

						</li>

						

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">
<div class="col-md-12">
				  <?php 
				  
				  $queryhallsmain = "select * from routes where type = '23' and unit = '999999999' and worker = '$_SESSION[userid]'";
				  $resulthallsmain = mysqli_query($con, $queryhallsmain);
				  $numhallsmain = mysqli_num_rows($resulthallsmain);
				  
				  				  
				  
				  $queryhalls = "select * from routes where type = '23' and worker = '$_SESSION[userid]'";
				  $resulthalls = mysqli_query($con, $queryhalls);
				  $numhalls = mysqli_num_rows($resulthalls);
				  
			   
				  
				  $hall = $_GET['hall'];
				  ?>                              
                                                    
                  <div class="col-md-12">
                  	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="horizontal-form" method="get" enctype="multipart/form-data" >
				  <? 


$global_company = 0; 
$global_hall = 0;

$queryaccess = "select * from routes where type = '23' and worker = '$_SESSION[userid]'";
$resultaccess = mysqli_query($con, $queryaccess);
while($rowaccess = mysqli_fetch_array($resultaccess)){
	if($rowaccess['company'] == "999999999"){
		$global_company = 1;
	}
	if($rowaccess['unit'] == "999999999"){
		$global_hall = 1;
	}
	
	$companies[] = $rowaccess['company'];
	$halls[] = $rowaccess['unit']; 
	
}


?>
<div class="note note-regular">


<div class="row">
                             <h4 style="margin-left:15px;">Filtro:</h4><br>
<?php //desde aqui ?>
<div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Proveedor: <a href="javascript:loadProviders('load');" id="providerCharge" >[Cargar Filtro]</a></label>

						
											<select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar..." disabled>
												<option value="">Todos los Proveedores</option>
											</select>

															<div title="Page 5"></div>
													  </div>

													</div>
    
    													  <script>                                            
                                                          function loadProviders(value){
                                                              if(value == 'load'){
                                                                  $("#provider").select2('data', { id:"0", text: "Cargando Proveedores..."});
                                                                  $("#providerCharge").css("display", "none");
                                                                  $.post("reloadContent.php", { type: 'providersMenu' }, function(data){
                                                                      document.getElementById("provider").innerHTML = data;
                                                                      $("#provider").select2('data', { id:"", text: "Todos los Proveedores"});
                                                                      $("#provider").prop('disabled', false);
                                                                  });
                                                              }
                                                          }  
                                                          </script>
                                                    
                                                 
                                                    
                                                    
                                                    
                                                    <div class="col-md-4">

													  <div class="form-group">

	<label class="control-label">Solicitante:</label>

						
										
                                        <select name="requester" class="form-control  select2me" id="requester" data-placeholder="Seleccionar...">

											<option value="">Todos los Colaboradores</option>
 											<?php $queryproviders = "select id, code, first, last from workers where code != '' order by first,last";
											$resultproviders = mysqli_query($con, $queryproviders);
											while($rowproviders = mysqli_fetch_array($resultproviders)){ 
											?>
                                            <option value="<?php echo $rowproviders['code']; ?>" <? if($_GET['requester'] == $rowproviders['code']) echo 'selected'; ?>><?php echo $rowproviders["code"].' | '.$rowproviders["first"].' '.$rowproviders["last"]; ?></option>
                                            <?php }
											?> 
												

											</select>
                                            
                                            

															<div title="Page 5"></div>
													  </div>

													</div>
	
                                                    
                                                    <div class="col-md-4 ">  <div class="form-group">
									 <label>Alcaldía:</label>
                                     <select name="thehall" class="form-control" id="thehall">
                                      
                                      <option value="" selected>Seleccionar</option>
                                     <? 
									 if($global_hall == 1){
									 	$queryhallss = "select * from halls where active = '1'".$foreach_company2." order by company, name";
									 }else{
										  for($c=0;$c<sizeof($halls);$c++){
											 $halls_pre = "";
											 if($c > 0){
												 $halls_pre = " or ";
											 }
											 $foreach_halls.= $halls_pre."(id = '$halls[$c]')";   
										 }
										 $foreach_halls = " and (".$foreach_halls.")";
										 
										 
										 echo $queryhallss = "select * from halls where active = '1'".$foreach_company2.$foreach_halls." order by company, name";  
									 }
										 
									 $resulthallss = mysqli_query($con, $queryhallss);
									 while($rowhallss=mysqli_fetch_array($resulthallss)){ 
									 ?>
                                     <option value="<? echo $rowhallss[0]; ?>" <? if($_GET['thehall'] == $rowhallss['id']) echo "selected"; ?>><? echo $rowhallss['name']; ?></option>  
                                     <? } ?>
                                     </select>
                                             </div>
                                        
                                        </div>  
                             
                                                    
                                        
 <?php //Hasta aqui ?>                           
</div>  


                                        
                                                                              
                                                
                    <div class="row">                           
                                                
                                                <div class="col-md-4 ">
													  <div class="form-group">
														<label>No. de Solicitud:</label>
                                                        <input name="request" type="text" class="form-control" id="request" value="<? echo sanitizedOutput($_GET['request']); ?>">
                                             
                      

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                    
                                                  <div class="col-md-4 ">
													  <div class="form-group">
														<label> No. de Factura:</label>
                                                        <input name="bill" type="text" class="form-control" id="bill" value="<? echo sanitizedOutput($_GET['bill']); ?>">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>

                                                 <div class="col-md-4 ">
													  <div class="form-group">
														<label> No. de Retencion:</label>
                                                        <input name="retentionno" type="text" class="form-control" id="retentionno" value="<? echo sanitizedOutput($_GET['retentionno']); ?>">
                                             
                  

                       <!--/row-->
                                                          <!--/row-->
                                                          <!--/row-->
                                                     
                                                      <!--/row--></div>
													</div>
                                                    </div>
                                                    
                                 <div class="row">                   
                                 <div class="col-md-4 ">
								   <div class="form-group">
									 <label> Estado:</label>
                                     <select name="status" class="form-control" id="status">
                                     <option value="" selected>Todas</option>
                                     <option value="1" <?php if((isset($_GET['status'])) and ($_GET['status'] == 1)) echo 'selected'; ?>>Pendientes</option>
                                     <option value="2" <?php if($_GET['status'] == 2) echo 'selected'; ?>>Impresas</option> 
                                     </select>  
                                             
                  

                       <!--/row-->
                                       <!--/row-->
                                       <!--/row-->
                                                     
                                     <!--/row--></div>
													</div>
                                                    <div class="col-md-4">
                                                    <label class="control-label">Rango de Fechas: (Retención)</label>

											<div class=" input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy" style=" width: 100% !important; ">

												<input type="text" class="form-control" name="from" placeholder="desde" value="<? echo $_GET['from']; ?>">

												<span class="input-group-addon">

												<i class="fa fa-angle-double-right"></i></span>

												<input type="text" class="form-control" name="to" placeholder="hasta" value="<? echo $_GET['to']; ?>"> 

											</div>

											<!-- /input-group -->

											
										</div>
                                        
                                     
                                       <div class="col-md-4 ">  <div class="form-group">
									 <label>Compañía:</label>
                                     <select name="thecompany" class="form-control" id="thecompany">
                                      <option value="" selected>Seleccionar</option>
                                     <?
									 
									 
									 if($global_company == 1){
										$foreach_company2 = "";
									 	$querycompanys = "select * from companies";
									 }else{
										 for($c=0;$c<sizeof($companies);$c++){
											 $company_pre = "";
											 if($c > 0){
												 $company_pre = " or ";
											 }
											 $foreach_company.= $company_pre."(id = '$companies[$c]')";  
										 }
										 $foreach_company = " and (".$foreach_company.")";
										 $foreach_company2 = str_replace('id','company',$foreach_company); 
										 
										 $querycompanys = "select * from companies where active = '1'".$foreach_company;
									 }
									 $resultcompanys = mysqli_query($con, $querycompanys);
									 while($rowcompanys=mysqli_fetch_array($resultcompanys)){  
									 ?>
                                     <option value="<? echo $rowcompanys[0]; ?>" <? if($_GET['thecompany'] == $rowcompanys['id']) echo "selected"; ?>><? echo $rowcompanys['name']; ?></option>  
                                     <? } ?>
                                     </select>
                                             </div>
                                        
                                        </div>
                                       
                                     
                                        
                                       
                                        <div class="col-md-2 " >
								   <div class="form-group">
									 <label> No de resultados:</label>
                                     <select name="pagination" class="form-control" id="pagination">
                                      <option value="100000" selected>Todas</option> 
                                      <option value="50" <?php if($_GET['pagination'] == 50) echo 'selected'; ?>>50</option>
                                     <option value="100" <?php if($_GET['pagination'] == 100) echo 'selected'; ?>>100</option>
                                     <option value="500" <?php if($_GET['pagination'] == 500) echo 'selected'; ?>>500</option>
                                    
                                     </select>
                                             
                  </div>
													</div>
                                       
                                      
                                        </div>
                                        
                                        <div class="row"></div>






                             
<div class="row">

<br><br>
						<div class="col-md-6">							

						    <input type="hidden" id="form" name="form" value="1"> <button type="button" class="btn red" onClick="removeFilter();"><i class="fa fa-times"></i> Eliminar Filtro</button>  <button type="submit" class="btn blue"><i class="fa fa-filter"></i> Filtrar</button>
				<script>
				function removeFilter(){
					window.location = 'retentions-generator-imi-global.php';
				}
				</script>								
                 </div>                               
  
</div>
						
								</div>
                                            
                 <input type="hidden" name="hall" id="hall" value="<?php echo $_GET['hall'];  ?>"> 
                  
                  </form>
               
                  </div>
                  
                  <div class="row"></div><br><br>
                  
                  
                  <div class="col-md-12"><!-- Begin: life time stats -->

					<div class="portlet">

						

                    
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

						Retenciones <?php 							
$hallid = base64_decode($_GET['hall']);
$queryhall = "select * from halls where id = '$hallid'"; 
$resulthall = mysqli_query($con, $queryhall);
$rowhall = mysqli_fetch_array($resulthall);
echo $rowhall['name']; ?>

							</div>
                           <? /*<div class="actions">

								<a href="retentions-generator-remission-imi-global-groups.php?hall=<? echo $_GET['hall']; ?>" class="btn default blue-stripe">

								<i class="fa fa-truck"></i>

								<span class="hidden-480">

								Remisiones</span>

								</a>

							

							</div>*/ ?>

						</div>

						

					</div>
                    <div class="portlet-body">



							
                             
                            
                             
                             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form2" id="form2"><div class="table-container">

								
								<?php 
											  
				  
$global_company = 0;
$global_hall = 0;

$queryaccess = "select * from routes where type = '23' and worker = '$_SESSION[userid]'";
$resultaccess = mysqli_query($con, $queryaccess);
while($rowaccess = mysqli_fetch_array($resultaccess)){
	if($rowaccess['company'] == "999999999"){
		$global_company = 1;
	}
	if($rowaccess['unit'] == "999999999"){
		$global_hall = 1;
	}
	
	$companies[] = $rowaccess['company'];
	$halls[] = $rowaccess['unit']; 
	
}

				  
$today = date('Y-m-d'); 
$tampagina = 50;
if(isset($_GET['pagination'])){
	$tampagina = $_GET['pagination'];
}

$pagina = $_GET['page'];
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

if($_GET['form'] != 1){
	$limit = 100;
}
$inner_halls = 0;
$from = $_GET['from'];								 
$to = $_GET['to'];
$provider = $_GET['provider'];
$request = $_GET['request'];
$bill = $_GET['bill'];
$paymenten = $_GET['paymenten'];
$worker = $_GET['worker'];
$requester = $_GET['requester']; 

$sql1 = "";
if($from != ""){
$from = date("Y-m-d", strtotime($from));
$sql1 = " and hallsretention.created >= '$from'";

}
$sql2 = "";
if($to != ""){
$to = date("Y-m-d", strtotime($to));
$sql2 = " and hallsretention.created <= '$to'";
}
$sql3 = "";
if($provider != ""){
$sql3 = " and payments.provider = '$provider'";
$inner_payments = 1;
}
$sql4 = "";
if($request != ""){
$sql4 = " and hallsretention.payment = '$request'";
}
$sql5 = "";
if($bill != ""){
$sql5 = " and bills.number = '$bill'";
$inner_bills = 1;
}
$sql6 = "";
if($worker != ""){
$sql6 = " and payments.collaborator = '$worker'";
$inner_payments = 1;
}

$sql7 = "";
if($requester != ""){
$sql7 = " and payments.userid = '$requester'";
$inner_payments = 1;
}

$sql8 = "";
$retentionno = $_GET['retentionno'];
if($retentionno != ""){
	$retentionno_arr = explode('-', $retentionno);
	
	$sql8 = " and hallsretention.serial = '$retentionno_arr[0]'";
	$sql8.= " and hallsretention.number = '$retentionno_arr[1]'"; 
}

$sql9 = "";
if($_GET['status'] != ""){
	switch($_GET['status']){
		case 1:
		$sql9 = " and payments.irprinted = '0'";
		$inner_payments = 1;
		break;
		case 2:
		$sql9 = " and payments.irprinted = '1'";
		$inner_payments = 1; 
		break; 
	}
		
}

$sql10 = "";

if($global_hall == 1){
	if($_GET['thehall'] != ""){
		$sql10 = " and hallsretention.hall = '$_GET[thehall]'"; 
	}
}else{
	$foreach_hall = "";
	if($_GET['thehall'] != ""){
		$sql11 = " and halls.company = '$_GET[thecompany]'";
		$inner_halls = 1; 
	}else{
	for($c=0;$c<sizeof($halls);$c++){
		$hall_pre = "";
		if($c > 0){
			$hall_pre = " or ";
		}
		$foreach_hall.= $company_pre."(hallsretention.hall = '$halls[$c]')";  
	}
	
	$foreach_hall = " and (".$foreach_hall.")";
	$sql10 = $foreach_hall; 
	//$inner_halls = 1;
 }
	
}

$sql11 = "";
if($global_company == 1){
	if($_GET['thecompany'] != ""){
		$sql11 = " and halls.company = '$_GET[thecompany]'";
		$inner_halls = 1; 
	}
}else{
	$foreach_company = "";
	if($_GET['thecompany'] != ""){
		$sql11 = " and halls.company = '$_GET[thecompany]'";
		$inner_halls = 1; 
	}else{
	for($c=0;$c<sizeof($companies);$c++){
		$company_pre = "";
		if($c > 0){
			$company_pre = " or ";
		}
		$foreach_company.= $company_pre."(halls.company = '$companies[$c]')";  
	}
	
	$foreach_company = " and (".$foreach_company.")";
	$foreach_company2 = str_replace('id','company',$foreach_company); 
	$sql11 = $foreach_company; 
	$inner_halls = 1;
 }
	
}
	

$inner1 = "";
if($inner_payments == 1){
	$inner1 = " inner join payments on hallsretention.payment = payments.id";
}
$inner2 = "";
if($inner_bills == 1){  
	$inner2 = " inner join bills on hallsretention.payment = bills.payment";
}
$inner3 = "";
if($inner_halls == 1){  
	$inner3 = " inner join halls on hallsretention.hall = halls.id";
}

$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10.$sql11;
$inner = $inner1.$inner2.$inner3;

$querymain = "select hallsretention.* from hallsretention".$inner." where hallsretention.status > '0'".$sql; 

$resultmain = mysqli_query($con, $querymain);
$nummain = mysqli_num_rows($resultmain);
$totpagina = ceil($nummain / $tampagina);  

$querymain1 = "select hallsretention.* from hallsretention".$inner." where hallsretention.status > '0'".$sql." order by hallsretention.id desc limit ".$inicio.",".$tampagina;
$resultmain1 = mysqli_query($con, $querymain1);

$echo = isset($_GET['echo']) ? intval($_GET['echo']) : 0;								 
if($echo == 1){ 
	echo $querymain;  
}
				
if(($nummain > 0)){ ?>                        
							
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

										 IDR</th>
                                         <th width="8%"> 

										 UN</th>

									

									<th width="17%">

										Proveedor/Colaborador</th>

									<th width="11%">Total Pagar</th>

									<th width="5%">

										Generada</th>

								<th width="14%">

										 Alcaldía 

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
								while($rowmain=mysqli_fetch_array($resultmain1)){
									$query = "select id, ret1a, provider, currency, routeid, hall from payments where id = '$rowmain[payment]'";
									$result = mysqli_query($con, $query);
									$row = mysqli_fetch_array($result);
							
							
									if($rowmain['amount'] == 0){
										$ret1_amount = $row['ret1a'];
									}else{
										$ret1_amount = $rowmain['amount'];
									}
							
									if($thisProvider[$row['provider']] == ''){
										$rowprovider = mysqli_fetch_array(mysqli_query($con, "select code, name from providers where id = '$row[provider]'"));
										$thisProvider[$row['provider']] = $rowprovider['code']." | ".$rowprovider['name'];
									}
									
									if($thisUnit[$row['routeid']] == ''){
										$queryUnit = "select code, name, newCode, companyName, lineName, locationName from units where id = '$row[routeid]'";
										$resultUnit = mysqli_query($con, $queryUnit);
										$rowUnit = mysqli_fetch_array($resultUnit);
									
										$thisUnit[$row['routeid']] = $rowUnit['newCode'].'<br>'.$rowUnit['companyName'].'<br>'.$rowUnit['lineName'].'<br>'.$rowUnit['locationName']; 
									}
								?>
                                
                                <tr role="row" class="odd <?php if($row['imiprinted'] == 1) echo 'success';  if($rowmain['void'] == 1) echo ' danger' ?>">  <td class="sorting_1" id="maintheid<?php echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $rowmain['id']; ?>" class="group-checkable" data-set="#datatable_orders .theid" onChange="calculateBalance(); "></td>
                                  <td><?php echo $row['id']; ?></td>
                                  <td><?php $number = str_pad((int) $rowmain['number'],4,"0",STR_PAD_LEFT);
								  echo $rowmain['serial'].'-'.$number; ?></td>
                                  <td><?php echo $thisUnit[$row['routeid']]; ?></td>
								  <td><?php echo $thisProvider[$row['provider']]; ?></td>
                                  <td> <?php echo 'C$'.str_replace('.00','',number_format($ret1_amount,2)).' Cordobas'; ?></td>
                                  <td><?php echo date('d-m-Y',strtotime($rowmain['created'])); ?></td>
								  <td><?  echo $globalHall[$row['hall']]; ?></td>
								  <td><a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable" target="_blank"><i class="fa fa-search"></i> Ver solicitud</a><br><br>
								  <? if($rowmain['void'] == 0){ 
									  if($_SESSION['imivoid'] == "active"){ ?>
									  <a href="retentions-generator-imi-global-void-rd.php?id=<?php echo $rowmain['id']; ?>" class="btn btn-xs yellow btn-editable" target="_blank"><i class="fa fa-search"></i> Anular + RD</a><br><br>
									  <a href="retentions-generator-imi-global-void.php?id=<?php echo $rowmain['id']; ?>" class="btn btn-xs red btn-editable" target="_blank"><i class="fa fa-times"></i> Anular</a> <? }
								  }
                                  else{ ?>
									<a class="btn btn-xs red btn-editable" href="javascript:alert('<? if($rowmain['voidcomments'] != ''){ echo $rowmain['voidcomments']; }else{ echo "Sin comentarios de anulación."; }?>');"><i class="fa fa-info"></i> Anulada</a>
								<? } ?>
								</td></tr>
                                <?php } ?>
                                   </tbody>

								</table>
                                </div>
                               
<div class="form-actions right">
<? if($_SESSION['imiprint'] == "active"){ ?>
<button type="button" class="btn blue" onClick="javascript:pdfPrint();"><i class="fa fa-print"></i> Imprimir</button>
<script>
function pdfPrint(){
	var myForm = document.getElementById("form2") 
	var caction = myForm.action;
	myForm.action = "retentions-generator-imi-pdf.php";
	myForm.submit();
	myForm.action = caction;
	
}
</script>
<? }
	
 if($_SESSION['imiexcel'] == "active"){ ?>
 
<button type="button" class="btn blue" onClick="javascript:pdfExcel();"><i class="fa  fa-file-excel-o"></i> Generar excel</button>
<button type="button" class="btn blue" onClick="javascript:pdfExcelBills();"><i class="fa  fa-file-excel-o"></i> Generar excel por factura</button>

<script>
function pdfExcel(){
	var myForm = document.getElementById("form2") 
	var caction = myForm.action;
	myForm.action = "excel-imi.php";
	myForm.submit();
	myForm.action = caction;
	
}
function pdfExcelBills(){
	var myForm = document.getElementById("form2") 
	var caction = myForm.action;
	myForm.action = "excel-imi-bills.php";
	myForm.submit();
	myForm.action = caction;
	
}
</script>
 <? } ?>						
</div>   
<? /*
   <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="payments.php?page=<?php echo $previous; ?>&status=<?php echo $_GET['status']; ?>&hall=<?php echo $_GET['hall']; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
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
		  echo '<li><a href="'.str_replace('/admin/','',$_SERVER['SCRIPT_NAME']).'?page='.$i .'&status='.$_GET['status'].'&hall='.$_GET['hall'].'&provider='.$_GET['provider'].'&from='.$_GET['from'].'&to='.$_GET['to'].'&request='.$_GET['request'].'&bill='.$_GET['bill'].'&form=1">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="payments.php?page=<?php echo $next; ?>&status=<?php echo $_GET['status']; ?>&hall=<?php echo $_GET['hall'];  ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
 */ ?>                                         
<?php }else{ ?>
<div class="note note-danger">
	<p>
		NOTA: No se encontró ningúna retención.
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