<?php 

include("session-schedule.php"); 
include("functions.php");

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

$type1_values = isset($_GET['type1']) ? sanitizeInput($_GET['type1'], $con) : [];
$type2_values = isset($_GET['type2']) ? sanitizeInput($_GET['type2'], $con) : [];
$type3_values = isset($_GET['type3']) ? sanitizeInput($_GET['type3'], $con) : [];

$ptype_values = isset($_GET['ptype']) ? sanitizeInput($_GET['ptype'], $con) : [];
$currency_values = isset($_GET['currency']) ? sanitizeInput($_GET['currency'], $con) : [];
$expiration1_values = isset($_GET['expiration1']) ? sanitizeInput($_GET['expiration1'], $con) : [];
$expiration2_values = isset($_GET['expiration2']) ? sanitizeInput($_GET['expiration2'], $con) : [];
$expiration3_values = isset($_GET['expiration3']) ? sanitizeInput($_GET['expiration3'], $con) : [];

$gcp = isset($_GET['gcp']) ? sanitizeInput($_GET['gcp'], $con) : '';
$vip = isset($_GET['vip']) ? sanitizeInput($_GET['vip'], $con) : '';
$international = isset($_GET['international']) ? sanitizeInput($_GET['international'], $con) : '';

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
<? include('payment-schedule-filter.php'); ?>
                                
                                <br><br>
                                
                                
                                <ul class="page-breadcrumb breadcrumb">

						<li>

							<i class="fa fa-eye"></i>

							<a href="dashboard.php">Control de Programación </a>
                            
                            	

						</li>

					</ul>
<?
					
$corrientes = 0;
$porvencer = 0;
$vencidos = 0;

$tbl1 = 0;
$tbl2 = 0;
$tbl3 = 0;
$tbl4 = 0;
$tbl5 = 0;
$tbl6 = 0;

$querycount = "select payments.expiration from payments where ((payments.status = '9') or (payments.status = '13.02') or (payments.status = '13.03')) and ((payments.sent_approve = '1') or (payments.d_approve= '1') or (payments.immediate = '1')) group by payments.id order by payments.expiration asc";
   
$resultcount = mysqli_query($con, $querycount);
$global = $numcount = mysqli_num_rows($resultcount); 
while($rowcount=mysqli_fetch_array($resultcount)){
	
	$date1 = date("Y-m-d");
	$date2 = date('d-m-Y',strtotime($rowcount['expiration']));
							
	$dias = (strtotime($date1)-strtotime($date2))/86400;
	
	if($dias <= -10){
		$corrientes++;
	}
	if(($dias < 0) and ($dias >= -10)){
		$porvencer++;
	}
	elseif($dias >= 0){
		$vencidos++;
	}
	
	if($dias <= -10){
		$tbl1++;
	}
	if(($dias < 0) and ($dias >= -10)){
		$tbl2++;
	}
	if(($dias < 30) and ($dias >= 0)){
		$tbl3++;
	}
	if(($dias < 60) and ($dias >= 31)){
		$tbl4++;
	}
	if(($dias < 90) and ($dias >= 61)){
		$tbl5++;
	}
	if(($dias >= 90)){ 
		$tbl6++;
	}
	
	

	
}

?>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px;">

					<div class="dashboard-stat green" style="height:130px;">

						<div class="visual">

							<i class="fa fa-smile-o"></i>

						</div>

						<div class="details">

							<div class="number">
<?php echo str_replace('.00','',number_format($corrientes,2)); ?>
							</div>

							<div class="desc">

									Corriente
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px;">

					<div class="dashboard-stat yellow" style="height:130px;">

						<div class="visual">

							<i class="fa fa-meh-o"></i>

						</div>

						<div class="details">

							<div class="number">
                            <? echo $porvencer; ?>
							</div>

							<div class="desc">

									Por Vencer
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px;">

					<div class="dashboard-stat red" style="height:130px;">

						<div class="visual">

							<i class="fa fa-frown-o"></i>

						</div>

						<div class="details">

							<div class="number">
<?php echo str_replace('.00','',number_format($vencidos,2)); ?>
							</div>

							<div class="desc">

									Vencidos
 </div>
 

						</div>
                       

					

					</div>
                    

				</div> 
               <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top:15px;">

					<div class="dashboard-stat red" style="height:130px;">

						<div class="visual" style="margin-left: 10px;">

							<i class="fa  fa-flag"></i>

						</div>

						<div class="details">

							<div class="number">
<?php echo str_replace('.00','',number_format($vips,2)); ?>
							</div>

							<div class="desc">

<a href="?vip=1">Ver VIPs</a>
 </div>
 

						</div>
                       

					

					</div>
                    

				</div>
                

<div class="col-md-12"><? echo '<strong>Global:</strong> '.$global; ?></div>                   
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="16%">

								  &infin; | -11 (C)</th>

									<th width="16%">

								  -10 | 1 (PV)</th>

									<th width="16%">0 - 30 (V)</th>

									<th width="16%">

										 31 | 60 (V)

								  </th>

									<th width="16%">

										 61 | 90 (V)

								  </th>

									<th width="16%">

								  90 | &infin; (V)</th> 

								</tr>

								</thead>

								<tbody>
                              
                                <tr role="row" class="odd"><td class="sorting_1"><? echo $tbl1; ?></td><td><? echo $tbl2; ?></td><td><? echo $tbl3; ?></td>
                                <td><? echo $tbl4; ?></td><td><? echo $tbl5; ?></td><td><? echo $tbl6; ?></td></tr>
                              
                                   </tbody>

								</table>
<br>
<strong>C:</strong> Corriente<br>
<strong>PV:</strong> Por Vencer<br>
<strong>V:</strong> Vencidos <br><br>

<div class="row"></div>
                             
                                
				  <form id="theform" name="theform" action="payment-schedule-code.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">	
               
               
              <? //note
			  /* <div class="row">
               <div class="col-md-12">
               <div class="note note-success">
               
              MANTENIMIENTO FINALIZADO. FAVOR REPORTAR CUALQUIER PROBLEMA A jairovargasg@gmail.com
              </div>
              </div>
               </div> */ ?>
                <div class="portlet">

						<div class="portlet-title">

							<div class="caption">
                            <?php

$inner_bills = 0;	
$inner_units = 0;
$inner_workers = 0;
$inner_providers = 0;
$inner_providerplans = 0;  

$get_string1 = "";
$get_string2 = "";
$get_string3 = "";
$get_string4 = "";
$get_string5 = "";
$get_string6 = "";
$get_string7 = "";
$get_string8 = "";
$get_string9 = "";
$get_string10 = "";
$get_string11 = "";
$get_string12 = "";
$get_string13 = "";
$get_string14 = "";
$get_string15 = "";
$get_string16 = "";
$get_string17 = "";
$get_string18 = "";
$get_string19 = "";	
$get_string20 = "";	
$inner_providersplans = '';
$sql1 = "";
$ptype = isset($_GET['ptype']) ? sanitizeInput($_GET['ptype'], $con) : [];							
if($ptype != ""){
	
	for($c=1;$c<=sizeof($ptype);$c++){
		
		
		$cdec = $c-1;
		$filter1[$ptype[$cdec]] = 1;
		
		
		$get_string1.= "&ptype[]=$ptype[$cdec]"; 
		
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
$currency = isset($_GET['currency']) ? sanitizeInput($_GET['currency'], $con) : '';
if($currency != ""){
	$get_string2 = '&currency='.$currency;
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
$expiration1 = isset($_GET['expiration1']) ? $_GET['expiration1'] : '';
if($expiration1 != ""){
	$get_string31 = '&expiration1='.$_GET['expiration1'];
	$fecha = date("Y-m-d");
	$soon = strtotime ( '5'.' day' , strtotime ( $fecha ) ) ;
	$soon = date ( 'Y-m-d' , $soon );
	$sql31 = " and ((payments.expiration >= '$fecha') and (payments.expiration < '$soon'))";  
}								
$sql32 = "";
$expiration2 = isset($_GET['expiration2']) ? $_GET['expiration2'] : '';
if($expiration2 != ""){
	$get_string32 = '&expiration2='.$_GET['expiration2'];
	$fecha = date("Y-m-d");
	$sql32 = " and payments.expiration <= '$fecha'";
}								
$sql33 = "";
$expiration3 = isset($_GET['expiration3']) ? $_GET['expiration3'] : '';
if($expiration3 != ''){
	$get_string33 = '&expiration3='.$_GET['expiration3'];
	$fecha = date("Y-m-d");
	$sql33 = " and payments.expiration > '$fecha'";  
}								
$sql3 = $sql31.$sql32.$sql33;
$get_string3 = $get_string31.$get_string32.$get_string33;																
$sql4 = "";
#$gcp = isset($_GET['gcp']) ? $_GET['tgcp'] : [];
if($gcp != ''){
	$get_string4 = '&gcp='.$gcp;
	$inner_providers = 1;
	$sql4 = " and providers.gcp = '1'";
	$filter4['gcp'] = 1;
}
$sql5 = "";
$vip = $_GET['vip'];
if($vip != ''){
	$get_string5 = '&vip='.$_GET['vip'];
	$inner_providers = 1;
	$sql5 = " and providers.flag = '1'";
	$filter4['vip'] = 1;
}

$sql5b = "";
$acp = $_GET['acp'];
if($acp != ''){
	$get_string5 = '&acp='.$_GET['acp'];
	$inner_providers = 1;
	$sql5b = " and providers.acp = '1'";
	$filter4['acp'] = 1; 
}

$i678 = 0;								
$sql678 = '';
$sql678arr = array();
$type1 = isset($_GET['type1']) ? $_GET['type1'] : [];
if(!empty($type1)){
	$i678++;
	$get_string6 = '&type1='.$_GET['type1'];
	$inner_bills = 1;
	/*for($c=1;$c<=sizeof($type1);$c++){
		$cdec = $c-1;
		$inner_bills = 1;
		if(($c == 1) and (sizeof($type1) > 1)){
			$sql6 .= " and (bills.type = '$type1[$cdec]'";
		}
		if(($c > 1) and ($c < sizeof($type1))){
			$sql6 .= " or bills.type = '$type1[$cdec]'";
		}
		if(($c == sizeof($type2)) and (sizeof($type1) > 1)){
			$sql6 .= " or bills.type = '$type1[$cdec]')";
		}
		if(($c == 1) and (sizeof($type1) == 1)){
			$sql6 .= " and bills.type = '$type1[$cdec]'";
		}
	}*/
	$placeholders1 = implode(',', $type1);
	$sql678arr[] = "bills.type IN ($placeholders1)";
}
$type2 = isset($_GET['type2']) ? $_GET['type2'] : [];
if(!empty($type2)){
	$i678++;
	$get_string7 = '&type2='.$type2;
	$inner_bills = 1;
	/*for($c=1;$c<=sizeof($type2);$c++){
		$cdec = $c-1;
		$inner_bills = 1;
		if(($c == 1) and (sizeof($type2) > 1)){
			$sql7 .= " and (bills.concept = '$type2[$cdec]'";
		}
		if(($c > 1) and ($c < sizeof($type2))){
			$sql7 .= " or bills.concept = '$type2[$cdec]'";
		}
		if(($c == sizeof($type2)) and (sizeof($type2) > 1)){
			$sql7 .= " or bills.concept = '$type2[$cdec]')";
		}
		if(($c == 1) and (sizeof($type2) == 1)){
			$sql7 .= " and bills.concept = '$type2[$cdec]'";
		}
	}*/
	$placeholders2 = implode(',', $type2);
	$sql678arr[] = "bills.concept IN ($placeholders2)";
}
$type3 = isset($_GET['type3']) ? $_GET['type3'] : [];
if(!empty($type3)){
	$i678++;
	$get_string8 = '&type3='.$type3;
	$inner_bills = 1;
	/*for($c=1;$c<=sizeof($type3);$c++){
		$cdec = $c-1;
		$inner_bills = 1;
		if(($c == 1) and (sizeof($type3) > 1)){
			$sql8 .= " and (bills.concept2 = '$type3[$cdec]'";
		}
		if(($c > 1) and ($c < sizeof($type3))){
			$sql8 .= " or bills.concept2 = '$type3[$cdec]'";
		}
		if(($c == sizeof($type3)) and (sizeof($type3) > 1)){
			$sql8 .= " or bills.concept2 = '$type3[$cdec]')";
		}
		if(($c == 1) and (sizeof($type3) == 1)){
			$sql8 .= " and bills.concept2 = '$type3[$cdec]'";
		}
	}*/
	$placeholders3 = implode(',', $type3);
	$sql678arr[] = "bills.concept2 IN ($placeholders3)";
}
if($i678 > 0){
	$sql678 = " and (" . implode(" OR ", $sql678arr) . ")";	
}
							
								
$sql9 = "";
$provider = isset($_GET['provider']) ? sanitizeInput($_GET['provider'], $con) : '';
if($provider != ""){
	$get_string9 = '&provider='.$provider;
	$inner_providers = 1;
	$sql9 = " and payments.provider = '$provider'";
}
	
$sql10 = "";
$worker = isset($_GET['worker']) ? $_GET['worker'] : '';
if($worker != ''){
	$get_string10 = '&worker='.$worker;
	$inner_workers = 1;
	$sql10 = " and payments.collaborator = '$worker'";
}
	
$sql11 = "";
if($_GET['blocked'] != ""){
	$get_string11 = '&blocked='.$_GET['blocked'];
	$sql11 = " and payments.blockschedule = '$_GET[blocked]'";
}
	
$sql12 = "";
if($_GET['request'] != ""){
	$get_string12 = '&request='.$_GET['request'];
	$sql12 = " and payments.id = '$_GET[request]'";
}

$sql13 = "";
if($_GET['international'] != ""){
	$get_string13 = '&international='.$_GET['international'];
	$inner_providers = 1;
	$sql13 = " and providers.international = '1'";
}
	
$sql14 = "";
if($_GET['company'] != ""){
	$get_string14 = '&company='.$_GET['company'];
	//$inner_units = 1;
	$sql14 = " and payments.company = '$_GET[company]'"; 
}
	
$sql15 = "";
if($_GET['pbank'] != ""){
	$get_string15 = '&bank='.$_GET['bank'];
	$inner_providersplans = 1;
	$inner_workers = 1; 
	//$sql15 = " and ((providers.bank = '$_GET[bank]') or (workers.id > 0))"; 
	$sql15 = " and ((providers_plans.bank = '$_GET[pbank]') or (workers.id > '0'))";   
	 
} 


$beneficiary = $_GET['beneficiary'];
$sql16 = "";
if($beneficiary != ""){
	$get_string16 = '&beneficiary='.$_GET['beneficiary'];
	$sql16 = " and payments.btype = '$beneficiary'";
}

$plan = $_GET['plan'];
$sql17 = "";
if($plan != ""){
	$get_string17 = '&plan='.$_GET['plan']; 
	$inner_providersplans = 1;
	$sql17 = " and providers_plans.plan = '$plan'"; 
}

$mgmp = $_GET['mgmp'];
$sql18 = "";
if($mgmp != ""){
	$get_string18 = '&mgmp='.$_GET['mgmp'];
	$sql18 = " and payments.mgmp = '$mgmp'"; 
	/*$inner_bills = 1;
	switch($mgmp){
			case 1:
			$sql18 = " and payments.currency = '1' and bills.currency = '1'";
			break;
			case 2:
			$sql18 = " and payments.currency = '2' and bills.currency = '2'";
			break;
			case 3:
			$sql18 = " and payments.currency = '1' and bills.currency = '2'";
			break; 
	}*/
}

$paymenttype = $_GET['paymenttype'];
$sql19 = "";
if($paymenttype > 0){
	$get_string19 = '&paymenttype='.$_GET['paymenttype'];
	switch($paymenttype){
			case 1:
			//Pago tradicional
			//Falta
			$sql19 = " and payments.type < '2'";
			break;
			case 2: 
			//Pasantes (Billetera Movil)
			$sql19 = " and payments.type = '2' and payments.parent = '1'";
			break;
			case 3:
			//Viaticos (Cuenta Bancaria)
			$sql19 = " and payments.type = '3' and payments.parent = '2'";
			break;
			case 4:
			//Viaticos (Billetera Movil)
			$sql19 = " and payments.type = '5' and payments.parent = '2'";
			break;
			case 5:
			//Devoluciones 
			$sql19 = " and payments.type = '4'";
			break;
           
	} 
}
elseif($paymenttype == 'covid'){
    $sql19 = " and payments.d_approve = '1'";         
} 
								
$ppe1 = $_GET['ppe1'];
$sql20 = "";
if($ppe1 > 0){
	$get_string20 = '&ppe1='.$_GET['ppe1'];
	switch($ppe1){
			case 1:
			//Pago tradicional
			//Falta
			$sql20 = " and payments.ppe1 = '1'";
			break;
			case 2: 
			//Pasantes (Billetera Movil)
			$sql20 = " and payments.ppe1 = '0'";
			break;
	} 
}

							
$inner1 = "";	 
if($inner_units == 1){
	//$inner1 = " inner join units on (payments.route = units.code or payments.route = units.code2)";
	//$inner1 = " inner join units on payments.route = units.code"; 
} 
													
$inner2 = "";
if($inner_bills == 1){
	$inner2 = " inner join bills on payments.id = bills.payment";
}

$inner3 = "";	
if($inner_providers == 1){
	$inner3 = " left join providers on payments.provider = providers.id";
} 
	
$inner4 = "";	
if($inner_providersplans == 1){
	//$inner3 = " left join providersaccount on providers.id = providersaccount.provider";
	$inner4 = " inner join providers_plans on payments.provider = providers_plans.provider"; 
}

$inner5 = "";	
if($inner_workers == 1){ 
	$inner5 = " left join workers on payments.collaborator = workers.id";
}   
	
	
$get_string = $get_string1.$get_string2.$get_string3.$get_string4.$get_string5.$get_string6.$get_string7.$get_string8.$get_string9.$get_string10.$get_string11.$get_string12.$get_string13.$get_string14.$get_string15.$get_string16.$get_string17.$get_string18.$get_string19.$get_string20;	
$inner = $inner1.$inner2.$inner3.$inner4.$inner5; 	
$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql5b.$sql678.$sql9.$sql10.$sql11.$sql12.$sql13.$sql14.$sql15.$sql16.$sql17.$sql18.$sql19.$sql20;
						
							
							
							
							
							
								if(isset($_GET['no'])){
									$tampagina = $_GET['no'];
								}else{
									$tampagina = 50;
								}
								
								
								if(!isset($_GET['page'])){
									$inicio = 0;
									$pagina = 1;
								}else{
									$inicio=($_GET['page']-1)*$tampagina;
								}

								
								$query = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.payment, payments.expiration, payments.description, payments.blockschedule from payments".$inner." where payments.child = '0' and ((payments.status = '9') or (payments.status = '13.02') or (payments.status = '13.03')) and ((payments.sent_approve = '1') or (payments.d_approve = '1') or (payments.immediate = '1'))".$sql." group by payments.id order by payments.expiration asc";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								$totpagina = ceil($num / $tampagina);   
								
								$query1 = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.client, payments.currency, payments.payment, payments.expiration, payments.description, payments.blockschedule, payments.company, payments.immediate, payments.parent, payments.d_approve from payments".$inner." where payments.child = '0' and ((payments.status = '9') or (payments.status = '13.02') or (payments.status = '13.03')) and ((payments.sent_approve = '1') or (payments.d_approve = '1') or (payments.immediate = '1'))".$sql." group by payments.id order by payments.immediate desc, payments.expiration asc limit ".$inicio.",".$tampagina;  
								$result1 = mysqli_query($con, $query1); 
								if($pagina < $totpagina) $next = $pagina+1;
								if($pagina > 1) $previous = $pagina-1;	
							
								
								if(($_GET['echo'] == 1)){ 
	 								echo $query1; 
 								}
 
 
								?>

								Programación agrupada (<?php echo $num; ?>) Solicitudes

							</div>
                            
                            

							<div class="actions">

								<?php /*
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
								*/ ?>
                                
                                <a href="payment-schedule-group.php" class="btn default blue-stripe">

								<i class="fa fa-list"></i>

								<span class="hidden-480">

								Grupos</span>

								</a>

							

							</div>

						</div>

						<div class="portlet-body">

							<div class="table-container">
                            <div class="table-scrollable">

								<?php
								
								if($num > 0){ ?> 	
                             
                                
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="2%" class="table-checkbox">

								<input type="checkbox" class="group-checkable" id="checkall" onChange="javascript:checkAll(),calculateBalance();" /> 
                                
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
                                <? 
										 //if($_SESSION['email'] == "jairovargasg@gmail.com"){ ?>
											 <a href="javascript:lockSelection();" class="btn btn-xs default btn-editable"><i class="fa fa-lock"></i> sel</a><? //}
										 ?>
                                </th>
                                    <th width="3%">

										 COMP
                                         
                                         </th>
                                         <th width="3%">

										 ID
                                         
                                         </th>

									<th width="35%">

										 Beneficiario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

									<th width="20%">Total Pagar</th>

									<th width="20%">

										 Vencimiento

									</th>

									<th width="5%">

										 Documento

									</th>
                                    <th width="8	0%">

										 Descripción &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

									</th>

									<th width="5%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
								
								while($row=mysqli_fetch_array($result1)){
								
								$ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']);
								switch($row['btype']){
									case 1:
									$querybankp = "select * from providers_plans where provider = '$row[provider]'";
									$resultbankp = mysqli_query($con, $querybankp);
									$thebank = "";
									while($rowbankp=mysqli_fetch_array($resultbankp)){ 
										$thebank.= $rowbankp['bank'].',';	
									}  
									break;
									case 2:
									$thebank = "1,";
									break;
									case 3:
									$thebank = "1,";
									break;
									case 4:
									$thebank = "1,"; 
									break; 
								}
								
								
								
								$rowstagemain = mysqli_fetch_array(mysqli_query($con, "select * from times where payment = '$row[id]' order by id desc"));
								$rowstage = mysqli_fetch_array(mysqli_query($con, "select * from stages where id = '$rowstagemain[stage]'"));
								$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));
								
								?>
                                
                                <tr role="row" class="odd <? if($rowstagemain['stage'] == 13.02) echo 'warning'; ?>" <?php if($rowprovider['flag'] == 1) echo 'id="div2blink"'; ?>> 
                                 <td class="sorting_1" id="maintheid<?php //echo $table; ?>"> 
                                  <input name="theid[]" type="checkbox" id="theid[]" value="<?php echo $row['id']; ?>" class="checkboxes" onChange="calculateBalance();"></td>
                               
                               <td><a href="javascript:lockPayment(<?php echo $row['id']; ?>,1);" class="btn btn-xs default btn-editable"><i class="fa <? if($row['blockschedule'] == "") echo 'fa-unlock-alt'; else echo 'fa-lock'; ?>"></i></a></td>
                                
									<td><? 
										$querycomp = "select abb from companies where id = '$row[company]'";
										$resultcomp = mysqli_query($con, $querycomp); 
										$rowcomp = mysqli_fetch_array($resultcomp);
										echo $rowcomp['abb']; 
											?></td>
                                <td><?php echo $row['id']; ?>
 
</td><td><? if($row['d_approve'] == 1) echo '<img src="../images/flag-blue.png" width="13" alt=""/> '; ?><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; echo $ben_name; ?></td><td><?php echo $rowcurrency['pre'].' '.$rowcurrency['symbol'].''.str_replace('.00','',number_format($row['payment'], 2)); ?>
                                  <? $thebank = substr($thebank,0,-1); ?>
                                  <input name="tpayment[]" type="hidden" id="tpayment[]" value="<?php echo $row['payment']; ?>">
                                  <input name="tcurrency[]" type="hidden" id="tcurrency[]" value="<?php echo $row['currency']; ?>">
                                  <input name="tbank[]" type="hidden" id="tbank[]" value="<?php echo $thebank; ?>">
                                  <input name="tcompany[]" type="hidden" id="tcompany[]" value="<?php echo $row['company']; ?>">
                                  
                                  </td><td><?php $date1 = date("Y-m-d");
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
	$documents = str_replace(',','<br>',$rowdocuments['nodocument']);
	$documents = str_replace('-','<br>',$documents);
	$documents = str_replace('/','<br>',$documents);
	$documents = str_replace(' ','<br>',$documents); 
	echo $documents."<br>";  
}

 ?> 
									
							
								
							</td>
                            <td>
                            <?php echo $row['description'];  ?>
                            </td>
                            <td>
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
                               
                               <? if($rowstagemain['stage'] == 13.02){ ?>
                               <tr>
                               <td colspan="10" class="warning">
                               <? if($rowstagemain['reason'] != ""){
									echo $rowstagemain['reason'];
								}else{
								   echo "Sin comentarios de exclusión.";
								}
								?>
								  </td>
									</tr>
                               
                               <? } ?>
                                <? if($row['immediate'] == '1'){ ?>
                               <tr>
                               <td colspan="10" class="success">
                               PAGO INMEDIATO
								  </td>
									</tr>
                               
                               <? } ?>
                                <?php } 
								?> 
                                    </tbody>

								</table>
                              
                                <div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?> 
                  
                 <li>
										<a href="payment-schedule.php?page=<?php echo $previous.$get_string; ?>">
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
		  echo '<li><a href="payment-schedule.php?page='.$i.$get_string.'">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="payment-schedule.php?page=<?php echo $next.$get_string; ?>">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                                
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: No hay ninguna programación pendiente.

						</p>

					</div>
                                <?php } ?>
                            
                    <?php if($num > 0){ ?>	 
                               
                               

					</div>
                    <div class="form-actions right">


										<div class="row"> 	
                                        
                                        
<div class="col-md-3"><input name="schedule" type="text" class="form-control form-control-inline date-picker" id="schedule[]" value="" readonly></div>
<div class="col-md-3">                       <select name="schedulebank" class="form-control" id="schedulebank" style="margin-top:1px;">
<option value="0">Banco</option>
<?php $querybanks = "select * from banks order by name";
$resultbanks = mysqli_query($con, $querybanks);
while($rowbanks=mysqli_fetch_array($resultbanks)){
?>
<option value="<?php echo $rowbanks['id']; ?>"><?php echo $rowbanks['name']; ?></option>
<?php } ?>
 
</select> 
</div>
<div class="col-md-3">

													  <div class="form-group">
														  <? 
									   /*
														  $querypp = "select * from routes where type = '7' group by worker";
									   		$resultpp = mysqli_query($con, $querypp);
									   		echo $numpp = mysqli_num_rows($resultpp);
									   while($rowpp = mysqli_fetch_array($resultpp)){
										
											$queryproviders = "select * from workers where code = '$rowpp[worker]'";
											$resultproviders = mysqli_query($con, $queryproviders); 
											$rowproviders = mysqli_fetch_array($resultproviders);
										   */
														  ?>
											<select name="pp" class="form-control  select2me" id="pp" data-placeholder="Seleccionar...">

												<option value="">Seleccionar</option> 
 									 <?php
									   /*
									   	$queryprocessor0 = "select blockschedule from payments where blockschedule != '' group by blockschedule";
 												$resultprocessor0 = mysqli_query($con, $queryprocessor0);
 												$numprocessor0 = mysqli_num_rows($resultprocessor0); 
 
 while($rowprocessor0=mysqli_fetch_array($resultprocessor0)){
	 
 if($rowprocessor0['blockschedule'] != ""){
 $rowprocessor = mysqli_fetch_array(mysqli_query($con, "select code, first, last from workers where code = '$rowprocessor0[blockschedule]'"));
 
 ?>
 <option value="<?php echo $rowprocessor["code"]; ?>"><?php echo $rowprocessor["code"].' | '.$rowprocessor["first"]." ".$rowprocessor["last"]; ?></option>
 <?php } } */
									$querypp = "select * from routes where type = '7' group by worker";
									$resultpp = mysqli_query($con, $querypp);
									$numpp = mysqli_num_rows($resultpp);
									while($rowpp = mysqli_fetch_array($resultpp)){
										
											$queryProcessorUser= "select code, first, last from workers where code = '$rowpp[worker]'";
											$resultProcessorUser = mysqli_query($con, $queryProcessorUser); 
											$rowProcessorUser = mysqli_fetch_array($resultProcessorUser);
										
										?>
												 <option value="<?php echo $rowProcessorUser["code"]; ?>"><?php echo $rowProcessorUser["code"].' | '.$rowProcessorUser["first"]." ".$rowProcessorUser["last"]; ?></option>
												<?
												
									   }
												?>
												
												

												

											</select>

															<div title="Page 5"></div>
				    </div>

										  </div>                                           	
                                           	
                                           	
                                           	
                                           	
                                            	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Programar</button>
                                            

    <div class="row"></div>
    <div class="col-md-6">
    <p>Total programación: <span id="thenumbersum">0.00</span></p>
    </div>
    </div>
     <?php } ?>
                                
                               

					</div>
                    </div>

					<!-- End: life time stats -->

				</div>
                </form>
                
           
                
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
		var first_select2 = document.getElementsByName('tbank[]')[i].value;
		var first_select3 = document.getElementsByName('tcompany[]')[i].value;
		i2++;
	}
	
	tpayment =  document.getElementsByName('tpayment[]')[i].value;
	var tcurrency = document.getElementsByName('tcurrency[]')[i].value;
	var tbank = document.getElementsByName('tbank[]')[i].value;
	var tcompany = document.getElementsByName('tcompany[]')[i].value;
	
	if(tcurrency != first_select){
		document.getElementsByName('theid[]')[i].checked = false;
		alert('Favor realizar la programacion con solicitudes de una misma moneda.');
		
	}
	//Bank New code
	
	
	var talert = arrayCompare(tbank, first_select2);
	if(talert == false){
		document.getElementsByName('theid[]')[i].checked = false;
		alert('Favor realizar la programacion con solicitudes de un mismo banco.');
	}
	 
	 /*if(tbank != first_select2){
		document.getElementsByName('theid[]')[i].checked = false;
		alert('Favor realizar la programacion con solicitudes de un mismo banco.');
	}*/
	 if(tcompany != first_select3){ 
		document.getElementsByName('theid[]')[i].checked = false; 
		alert('Favor realizar la programacion con solicitudes de un misma compañia.');
	}
	 
	
	 
	totalpayment += parseFloat(tpayment);
 }

  }
  i++;
}
var pre = "";
if(first_select == 1){
	var pre = "C$";
	var pre2 = "Córdobas";
}else if(first_select == 2){
	var pre = "U$";
	var pre2 = "Dólares";
}else if(first_select == 3){
	var pre = "&euro;";
	var pre2 = "Euros";
}else if(first_select == 4){
	var pre = "&yen;";
	var pre2 = "Yenes"; 
}
	
document.getElementById('thenumbersum').innerHTML = pre+commas(totalpayment)+' '+pre2;

}

function arrayCompare(a1, a2) {
    var array1 = a1.split(',');
	var array2 = a2.split(',');
	var ret = 0;
	
    for(var i2 = 0; i2 < array2.length; i2++) {
		for(var i1 = 0; i1 < array1.length; i1++) {
			if((array1[i1] != '') && (array1[i1] != 0)){
				if(array1[i1] == array2[i2]){
		  		ret = 1;
	   			}
			}
    	}
    }
	
   if(ret == 1){
	   return true;
   }else{
	   return false;
   }
}
	
function commas(unformatedAmmount) {
    
	var floatAmmount = parseFloat(unformatedAmmount);
	var floatAmmount2 = floatAmmount.toFixed(2); 
	
	var parts = floatAmmount2.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
	var parts2 = parts.join(".");
	return parts2;  
}
	
function lockPayment(id, m){
	$.post("reload-blockpayment.php", { variable: id, message: m }, function(data){
			alert(data);
	});		 
}

function lockSelection(){
	var choices = [];
	var els = document.getElementsByName('theid[]');
	for (var i=0;i<els.length;i++){
  		if ( els[i].checked ) {
			lockPayment(els[i].value,2); 
  		}
	}
}

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

	//
	var bank = document.getElementById("schedulebank").value;
	if(bank == '0'){
		alert('No se puede programar pagos sin ingresar el banco.');
		document.getElementById("schedulebank").focus();
		return false;
	}


		
}
 	
</script>