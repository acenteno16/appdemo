<?php 

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require("session-consultation.php"); 
require("functions.php");

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
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="../assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>
<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="../assets/fix.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="favicon.ico"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
	
<?php include('fn-expiration.php'); ?>
</head>
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

						Consulta de solicitudes

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>
<i class="fa fa-search"></i>
							<a href="#">Consulta de solicitudes</a>

						

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
<h4 class="filterTitle">Filtro:</h4><br>
<?php //desde aqui ?>


<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Proveedor: <a href="javascript:loadProviders('load');" id="providerCharge" >[Cargar Filtro]</a></label>
        <select name="provider" class="form-control  select2me" id="provider" data-placeholder="Seleccionar..." disabled>
            <option value="">Todos los Proveedores</option>
            <? 
				$getProvider = isset($_GET['provider']) ? intval($_GET['provider']) : 0;
				if($getProvider > 0){ 
                $rowThisProvider = mysqli_fetch_array(mysqli_query($con, "select code, name from providers where code > '0' order by name"));
            ?>
            <option value="<? echo $getProvider; ?>"><? echo $rowThisProvider['code'].' | '.$rowThisProvider['name']; ?></option>
            <? } ?>
        </select>
                                                     
                                                          <script>                                            
                                                          function loadProviders(value){
                                                              if(value == 'load'){
                                                                  $("#provider").select2('data', { id:"", text: "Cargando Proveedores..."});
                                                                  $("#providerCharge").css("display", "none");
                                                                  $.post("reloadContent.php", { type: 'providersMenu' }, function(data){
                                                                      document.getElementById("provider").innerHTML = data;
                                                                      $("#provider").select2('data', { id:"", text: "Todos los Proveedores"});
                                                                      $("#provider").prop('disabled', false);
                                                                  });
                                                              }
                                                          }  
                                                          </script>
                                                          
                                                          
											
	</div>

													</div>
    
    
    
    
    
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Colaborador: <a href="javascript:loadWorkers('load');" id="workerCharge" >[Cargar Filtro]</a></label>

						
											<select name="worker" class="form-control  select2me" id="worker" data-placeholder="Seleccionar..." disabled>

												<option value="">Todos los Colaboradores</option>
                                               
											</select>
                                                         
                                                          <script nonce="<?= $nonce ?>">
                                                          function loadWorkers(value){
                                                              if(value == 'load'){
                                                                  $("#workerCharge").css("display", "none");
                                                                  $("#worker").select2('data', { id:"", text: "Cargando Colaboradores..."});
                                                                  $.post("reloadContent.php", { type: 'workersMenu' }, function(data){
                                                                    document.getElementById("worker").innerHTML = data;
                                                                      $("#worker").select2('data', { id:"", text: "Todos los Colaboradores"});
                                                                      $("#worker").prop('disabled', false);
                                                                  }); 
                                                              }
                                                          }
                                                          </script>
                                                          
                                                          

													  </div>

													</div>
    
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Pasante: <a href="javascript:loadInterns('load');" id="internCharge" >[Cargar Filtro]</a></label>

						
											<select name="intern" class="form-control  select2me" id="intern" data-placeholder="Seleccionar..." disabled>

												<option value="">Todos los Pasantes</option>
                                             
											</select>
                                                          
                                                           <script nonce="<?= $nonce ?>">
                                                          
                                                          function loadInterns(value){
                                                              if(value == 'load'){
                                                                  $("#internCharge").css("display", "none");
                                                                  $("#intern").select2('data', { id:"", text: "Cargando Pasantes..."});
                                                                  $.post("reloadContent.php", { type: 'internsMenu' }, function(data){
                                                                    document.getElementById("intern").innerHTML = data;
                                                                    $("#intern").select2('data', { id:"", text: "Todos los Pasantes"});
                                                                    $("#intern").prop('disabled', false);
                                                                  });
                                                                  
                                                              }
 
                                                          }
                                                          </script>
													  </div>

													</div>
    
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Clientes: <a href="javascript:loadClients('load');" id="clientCharge" >[Cargar Filtro]</a></label>

						
											<select name="client" class="form-control  select2me" id="client" data-placeholder="Seleccionar..." disabled>

												<option value="">Todos los Clientes</option>
                                            
											</select>
                                                          
                                                          <script nonce="<?= $nonce ?>">
                                                          
                                                          function loadClients(value){
                                                              if(value == 'load'){
                                                                  $("#clientCharge").css("display", "none");
                                                                  $("#client").select2('data', { id:"", text: "Cargando Clients..."});
                                                                  $.post("reloadContent.php", { type: 'clientsMenu' }, function(data){
                                                                      document.getElementById("client").innerHTML = data;
                                                                      $("#client").select2('data', { id:"", text: "Todos los Clientes"});
                                                                      $("#client").prop('disabled', false);
                                                                  });
                                                                  
                                                              }
 
                                                          }
                                                          </script>
													  </div>

													</div>
    
<div class="col-md-3">
	
													  

													  <div class="form-group">

	<label class="control-label">Solicitante: <a href="javascript:loadRequester('load');" id="requesterCharge" >[Cargar Filtro]</a></label>
                                        <select name="requester" class="form-control  select2me" id="requester" data-placeholder="Seleccionar..." disabled>

												<option value="">Todos los Solicitantes</option>
                                       
											</select>
                                                            <script nonce="<?= $nonce ?>">
                                                          
                                                          function loadRequester(value){
                                                              if(value == 'load'){
                                                                  $("#requesterCharge").css("display", "none");
                                                                  $("#requester").select2('data', { id:"", text: "Cargando Solicitantes..."});
                                                                  $.post("reloadContent.php", { type: 'requesterMenu' }, function(data){
                                                                      document.getElementById("requester").innerHTML = data;
                                                                      $("#requester").select2('data', { id:"", text: "Todos los Solicitantes"});
                                                                      $("#requester").prop('disabled', false);
                                                                  }); 
                                                              }
                                                          }
                                                          </script>
                                                          
													  </div>

													</div>     
    
    
    
    
<div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de Solicitud:</label>
                                                        <input name="request" type="text" class="form-control" id="request" value="">
                                             </div>
													</div>
    
<div class="col-md-3 ">
													  <div class="form-group">
														<label> No. de Factura:</label>
                                                        <input name="bill" type="text" class="form-control" id="bill" value="">
                  </div>
													</div>
<div class="col-md-3 ">
													  <div class="form-group">
														<label> No. de Batch:</label>
                                                        <input name="batch" type="text" class="form-control" id="batch" value="">
                                             </div>
													</div>
	
	
    
    <div class="row"></div>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>No. de Documento:</label>
                                                        <input name="document" type="text" class="form-control" id="document" value="">
                  </div>
													</div>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>PK:</label> 
                                                        <input name="ckpk" type="text" class="form-control" id="ckpk" value="">
                                             </div>
					
    
    </div>
    
    <div class="col-md-3"> 
<label class="control-label">Rango de fechas (Etapa):</label>
<select name="stage2" class="form-control" id="stage2" onChange="noBorder();">
<option value="">Todas las etapas</option>
<?php 
$getStage2 = isset($_GET['stage2']) ? intval($_GET['stage2']) : 0;
$querystage = "select * from stages where id > 0 and visible = 1 order by id asc";
$resultstage = mysqli_query($con, $querystage);
while($rowstage=mysqli_fetch_array($resultstage)){
?>
<option value="<?php echo $rowstage['id']; ?>" <?php if($getStage2 == $rowstage['id']) echo 'selected'; ?>><?php echo str_replace('Rechazado1','Rechazado',$rowstage['name']); ?></option>
<?php } ?> 

													  </select>
</div>
    
    
<div class="col-md-3" > 
                                                    <label class="control-label">Rango de Fechas:</label>

											<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">

												<input type="text" class="form-control" name="from" id="from" placeholder="desde" readonly onClick="checkStage();">

												<span class="input-group-addon">

												<i class="fa fa-angle-double-right"></i></span>

												<input type="text" class="form-control" name="to" id="to" placeholder="hasta" readonly onClick="checkStage();">

											</div>

											<!-- /input-group -->

											<script nonce="<?= $nonce ?>">
    
                                                function noBorder(){
                                                    document.getElementById('stage2').style = 'border: none;;';
                                                }
                                                function checkStage(){
       var stage = document.getElementById('stage2').value;
        if(stage == ''){
            alert('Debe de seleccionar una etapa de rango de fecha.');
            document.getElementById('stage2').style = 'border: 1px solid red;';
            document.getElementById('stage2').focus(); 
            $('.datepicker').hide();
        }
        
        
    }
    </script>
										</div>
    
<div class="row"></div>

	
<div class="col-md-3"> 
<label class="control-label">Etapa:</label>
<select name="stage" class="form-control" id="stage">
<option value="">Todas las etapas</option>
<?php 
$getStage = isset($_GET['stage']) ? intval($_GET['stage']) : 0;
$querystage = "select * from stages where id > 0 and visible = 1 order by id asc";
$resultstage = mysqli_query($con, $querystage);
while($rowstage=mysqli_fetch_array($resultstage)){
?>
<option value="<?php echo $rowstage['id']; ?>" <?php if($getStage == $rowstage['id']) echo 'selected'; ?>><?php echo str_replace('Rechazado1','Rechazado',$rowstage['name']); ?></option>
<?php } ?> 

													  </select>
</div>                                            
<?php if(($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['globalsearch'] == "active")){ ?>	
<div class="col-md-3">

													  <div class="form-group">

	<label class="control-label">Ruta:</label>
           <select name="route" class="form-control  select2me" id="route" data-placeholder="Seleccionar..." onChange="loadRoute(this.value);">
			   <option value="">Todas las Rutas</option>
			   <option value="load">Cargar Rutas</option>
		   </select>
                                                            <script nonce="<?= $nonce ?>">
                                                          
                                                          function loadRoute(value){
                                                              if(value == 'load'){ 
                                                                  $("#route").select2('data', { id:"0", text: "Cargando Rutas..."});
                                                                  $.post("reloadContent.php", { type: 'routesMenu' }, function(data){
                                                                    document.getElementById("route").innerHTML = data;
                                                                    $("#route").select2('data', { id:"", text: "Seleccionar"});
                                                                  });
                                                                  
                                                              }
 
                                                          }
                                                          </script>
                                            
                                            
													  </div>

													</div>
<div class="col-md-3"> 
<label class="control-label">Compañía:</label>
<select name="company" class="form-control" id="company">
<option value="">Todas las compañías</option>
<?php 
$getCompany = isset($_GET['company']) ? intval($_GET['company']) : 0;
$querycompany = "select * from companies";
$resultcompany = mysqli_query($con, $querycompany);
while($rowcompany=mysqli_fetch_array($resultcompany)){
?>
<option value="<?php echo $rowcompany['id']; ?>" <?php if($getCompany == $rowcompany['id']) echo 'selected'; ?>><?php echo $rowcompany['name']; ?></option>
<?php } ?> 

													  </select>
</div>
<? /*    
<div class="col-md-3"> 
<label class="control-label">Inmediato:</label>
<br>
<input name="immediate" type="checkbox" id="immediate" value="1" class="form-control">
</div>  */ ?>                                                                            
 <?php } ?>
<? /*    
<div class="col-md-3"> 
<label class="control-label">Pendiente de Cancelación:</label>
<br>
<input name="pcancellation" type="checkbox" id="pcancellation" value="1" class="form-control">
</div>
<? if(($_SESSION["credit"] == 'active') or ($_SESSION['admin'] == "active")){ ?> 
<div class="col-md-3"> 
<label class="control-label">Crédito:</label>
<br>
<input name="credit" type="checkbox" id="credit" value="1" class="form-control">
</div>
<? } */?>
<? if(($_SESSION["email"] == 'jairovargasg@gmail.com')){ ?> 
<div class="col-md-12"> 
<label class="control-label">Descripción:</label>
<br>
<input name="description" type="text" id="description" value="" class="form-control">
</div>
<? } ?>	
<div class="col-md-6"> <br>
<label>Otros Filtros:</label><br>
<?php if(($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['globalsearch'] == "active")){ ?>	
<input name="immediate" type="checkbox" id="immediate" value="1" > <label class="control-label" style="margin-right: 30px;">Inmediato</label> 
<? } ?>
<input name="pcancellation" type="checkbox" id="pcancellation" value="1" >  <label class="control-label" style="margin-right: 30px;">Pendiente de Cancelación</label> 
<? if(($_SESSION["credit"] == 'active') or ($_SESSION['admin'] == "active")){ ?> 
<input name="credit" type="checkbox" id="credit" value="1" > <label class="control-label" style="margin-right: 30px;">Crédito</label>
<? } ?>    
</div>    
    


						<div class="row"></div><br>
    <div class="col-md-6">							

						    <input type="hidden" id="form" name="form" value="1"><button type="submit" class="btn blue"><i class="fa fa-search"></i> Consultar</button> 
												
                						

						    
						<button type="button" class="btn grey" onClick="goBack();"><i class="fa fa-undo"></i> Regresar</button>
                           
							<script nonce="<?= $nonce ?>">
							function goBack(){
								window.location = "payments-consultations.php";
							}
							</script>
							
												
                 </div>                               
  
</div> 
						
								</div>
</form> 
                                
<?php } ?>
					
					
					
					<?php 
					$getForm = isset($_GET['form']) ? intval($_GET['form']) : 0;
					if($getForm == 1){ 
					//if((isset($_GET['form'])) and ($_SESSION['email'] == 'jairovargasg@gmail.com')){ 
					?>
                    
                    <div class="note note-regular">
                    <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">Volver a consultar</a>
					<? /*<a href="<?php echo str_replace('/var/www/html','',$_SERVER['SCRIPT_FILENAME']); ?>">Volver a consultar</a> */ ?>	
                    </div>
                    <div class="portlet">

						<div class="portlet-title">

							<div class="caption">

<?php 
/*								
$param = 0;								
$today = date('Y-m-d'); 
$tampagina = 50;
$pagina = isset($_GET['page']) ? intval($_GET['page']) : 0;
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
}else{
	$inicio=($pagina-1)*$tampagina;
}

$join1i = 0;
$join2i = 0;
$join3i = 1;

$from = "";
if(isset($_GET['from'])){
	$from = $_GET['from'];
}
$to = "";
if(isset($_GET['to'])){
	$to = $_GET['to'];
}
$provider = "";
if(isset($_GET['provider'])){
	$provider = $_GET['provider'];
}
$request = "";
if(isset($_GET['request'])){
	$request = $_GET['request'];
}
$bill = "";
if(isset($_GET['bill'])){
	$bill = $_GET['bill'];
}
$paymenten = "";
if(isset($_GET['paymenten'])){
	$paymenten = isset($_GET['paymenten']) ? $_GET['paymenten'] : '';
}
$worker = "";
if(isset($_GET['worker'])){
	$worker = $_GET['worker'];
}
$requester = "";
if(isset($_GET['requester'])){
	$requester = $_GET['requester'];
}
$stage = "";
if(isset($_GET['stage'])){
	$stage = $_GET['stage'];
}
$route = "";
if(isset($_GET['route'])){
	$route = $_GET['route'];
}
$ckpk = "";
if(isset($_GET['ckpk'])){
	$ckpk = $_GET['ckpk'];
}

						#provider,worker,intern,client,requester,request,bill,batch,document,ckpk,from,to,stage2,stage,route,company,immediate,pcancellation,pcredit
						
$sql1 = "";
if($from != ""){
	$ch1 = "&from=$from";
	$from = date("Y-m-d", strtotime($from));
	$sql1 = " and times.today >= '$from'";
	$param++;
}
$sql2 = "";
if($to != ""){

	$ch2 = "&to=$to";
	$to = date("Y-m-d", strtotime($to));
	$sql2 = " and times.today <= '$to'";
	$param++;
}
$sql3 = "";
if($provider != ""){

	$ch3 = "&provider=$provider";
	$sql3 = " and payments.provider = '$provider'";
	$param++;
}
$sql4 = "";
if($request != ""){

	$ch4 = "&request=$request";
	$sql4 = " and payments.id = '$request'";
	$param++;
}
$sql5 = "";
if($bill != ""){

	$ch5 = "&bill=$bill";
	$sql5 = " and bills.number = '$bill'";
	$join1i = 1;
	$param++;
}
$sql6 = "";
if($worker != ""){

	$ch6 = "&worker=$worker";
	$sql6 = " and payments.collaborator = '$worker'";
	$param++;
}

$sql7 = "";
if($requester != ""){

	$ch7 = "&requester=$requester";
	$sql7 = " and payments.userid = '$requester'";
	$param++;
}
$sql8 = "";

$batch= $_GET['batch'];
if($batch != ""){

	$ch8 = "&batch=$batch";
	$sql8 = " and batch.nobatch = '$batch'";
	$join2i = 1;
	$param++;
}
$sql9 = "";
$document = $_GET['document'];						
if($_GET['document'] != ""){

	$ch9 = "&document=$document";
	$sql9 = " and batch.nodocument = '$_GET[document]'";
	$join2i = 1;
	$param++;
}
$sql10 = "";
						
$stage = $_GET['stage'];
if($_GET['stage'] != ""){

	$ch10 = "&stage=$stage";
	$mystage = $_GET['stage'];
	$param++;
	switch($mystage){
		case '1.00':
		$mystage = intval($mystage);
		//sin visto bueno
		$sql10 = " and payments.status = '1' and times.stage='1.00'";
		$join3i = 1;
		break;
		case '1.01':
		//con visto bueno
		$mystage = intval($mystage);
		$sql10 = " and payments.status = '1' and times.stage='1.01'";
		$join3i = 1;
		break;
		case '5.00':
		$sql10 = " and payments.approved = '2'"; 
		break;
		default:
		$mystage = intval($mystage);
		$sql10 = " and payments.status = '$mystage'";
		break;
		
	}
}

$sql11 = "";
$route = $_GET['route'];
if($_GET['route'] != ""){

	$ch11 = "&route=$route";
	$sql11 = " and payments.routeid = '$_GET[route]'";
	$param++;
}

$sql12 = "";
if(isset($_GET['pcancellation'])){

	$ch12 = "&pcancellation=$_GET[pcancellation]";
	if($_GET['pcancellation'] != ""){
		$sql12 = " and payments.status < '14' and payments.approved = '1'";
		$param++;
	}
}

$sql13 = "";
if(isset($_GET['stage2'])){

	$ch13 = "&stage2=$_GET[stage2]";
	if($_GET['stage2'] != ""){
		$sql13 = " and times.stage = '$_GET[stage2]'";
		$param++;
	}
}


$sql14 = "";
if(isset($_GET['immediate'])){

	$ch14 = "&immediate=$_GET[immediate]";
	if($_GET['immediate'] == 1){
		$sql14 = " and payments.immediate = '1'";
		$param++;
	}
}

$sql15 = "";
if(isset($_GET['intern'])){

	$ch15 = "&intern=$_GET[intern]";
	if($_GET['intern'] != ""){
		$sql15 = " and payments.intern = '$_GET[intern]'";
		$param++;
	} 
}

$sql16 = "";
if(isset($_GET['company'])){

	$ch16 = "&company=$_GET[company]";
	if($_GET['company'] != ""){
		$sql16 = " and payments.company = '$_GET[company]'";
		$param++;
	}
}

$sql17 = "";
if(isset($_GET['client'])){

	$ch17 = "&client=$_GET[client]";
	if($_GET['client'] != ""){
		$sql17 = " and payments.btype = '4' and payments.client = '$_GET[client]'";
		$param++;
	}
}
                        
$sql18 = "";
if(isset($_GET['ckpk'])){

	$ch18 = "&ckpk=$_GET[ckpk]";
	if($_GET['ckpk'] != ""){
		$sql18 = " and payments.cnumber = '$_GET[ckpk]'";
		$param++;
	}
}
						
$sql19 = "";
if(isset($_GET['description'])){

	$ch19 = "&description=$_GET[description]";
	if($_GET['description'] != ""){
		$sql19 = " and payments.description like '%$_GET[description]%'";
		$param++;
	}
}						

$join1 = "";
if($join1i == 1){
	$join1 = " inner join bills on payments.id = bills.payment";
}
$join2 = "";
if($join2i == 1){
	$join2 = " left join batch on payments.id = batch.payment";
}
$join3 = "";
if($join3i == 1){
	$join3 = " inner join times on payments.id = times.payment";
}

$credit = $_GET['credit'];
//Start

if(($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['globalsearch'] == "active")){
	
	//Do nothing
	$sqlu = ""; 
}
						else{

$sqlu = "";

	$numu = 0;
	$queryu = "select * from routes where worker = '$_SESSION[userid]' and ((type = '1') or (type = '2') or (type = '3') or (type = '4') or (type = '5') or (type = '19') or (type = '20') or (type = '35'))";
	$resultu = mysqli_query($con, $queryu);
	$numu = mysqli_num_rows($resultu);
	if($numu > 0){
		$firstu = 1;
		while($rowu=mysqli_fetch_array($resultu)){
			
            if(($rowu['type'] == '35') or ($rowu['type'] == '5') or ($rowu['type'] == '19')){  
                $sqluSec = "";
                
            }else{
                $sqluSec = " and (times.userid= '$_SESSION[userid]')";
            }
            
            if($firstu == 1){ //First
				$sqlu = " and (((payments.routeid = '$rowu[unitid]')".$sqluSec.")";
				if($numu == 1){ $sqlu .= ")"; } $firstu++;
			}elseif($firstu == $numu){ //Last
				$sqlu.= " or ((payments.routeid = '$rowu[unitid]')".$sqluSec."))";
				$firstu++;
			}else{ //Middle
				$sqlu.= " or ((payments.routeid = '$rowu[unitid]')".$sqluSec.")";
				$firstu++;
			}
		}
		
		
		if(($credit == 1) and (($_SESSION["credit"] == "active") or ($_SESSION['admin'] == "active"))){
			$sqlu.= " and payments.type = '4'";
		}
									
	}
	else{ 
		$sqlu = "and (payments.routeid = 'NONE')"; 
		if(($credit == 1) and (($_SESSION["credit"] == "active") or ($_SESSION['admin'] == 'active')) ){
			$sqlu= " and payments.type = '4'";
		}
	}
} 
//END

if($param == 0){
	echo "<script>alert('Debe de seleccionar al menos un parametro de busqueda.'); history.go(-1);</script>";
	$numdev = 0;
}else{
	//Do nothing
	$join = "";
	if(isset($join1)){
		$join.=$join1;
	}
	if(isset($join2)){
		$join.=$join2;
	}
	if(isset($join3)){
		$join.=$join3;
	}
	if(isset($join4)){
		$join.=$join4;
	}
	
	$sql = $sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10.$sql11.$sql12.$sql13.$sql14.$sql15.$sql16.$sql17.$sql18.$sql19; 
	$ch = $ch1.$ch2.$ch3.$ch4.$ch5.$ch6.$ch7.$ch8.$ch9.$ch10.$ch11.$ch12.$ch13.$ch14.$ch15.$ch16.$ch17.$ch18.$ch19;
 
 	if(isset($sqlu)){
 		$sql.=$sqlu;
 	}

	
$query = "select payments.id from payments".$join." where payments.id > '0'".$sql." group by times.payment";
$result = mysqli_query($con, $query);
$numdev = mysqli_num_rows($result);
$totpagina = ceil($numdev / $tampagina);       
		
	
$query1 = "select payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.payment, payments.bank, payments.status, payments.reference, payments.cnumber, payments.schedule, payments.approved, payments.today, payments.reason, payments.parent, payments.intern, payments.routeid, payments.globalpayment, payments.client, payments.d_approve, payments.description, payments.company from payments".$join." where payments.id > '0' and payments.id > 0".$sql." group by times.payment order by payments.id desc limit ".$inicio.",".$tampagina.""; 
$result1 = mysqli_query($con, $query1);
if($pagina < $totpagina) $next = $pagina+1;
if($pagina > 1) $previous = $pagina-1; 
	 
if(($_GET['echo'] == 1)){
	echo $query1."<br>";
	echo 'SQLU:('.$numu.') '.$queryu."<br>";
}
}
*/
				

$param = 0;
$tampagina = 50; // Tamaño de página
$pagina = isset($_GET['page']) ? intval(sanitizeInput($_GET['page'], $con)) : 1;
$inicio = ($pagina > 0) ? ($pagina - 1) * $tampagina : 0;
$echo = isset($_GET['echo']) ? intval($_GET['echo']) : 0;
$joinBills = 0; 
$joinBatchs = 0; 
$joinTimes = 0;
$iStage = 0;	
						
$filters = [
    'from' => '',
    'to' => '',
    'provider' => '',
    'request' => '',
    'bill' => '',
    'worker' => '',
    'requester' => '',
    'batch' => '',
    'document' => '',
    'stage' => '',
	'stage2' => '',
    'route' => '',
    'pcancellation' => '',
    'immediate' => '',
    'intern' => '',
    'company' => '',
    'client' => '',
    'ckpk' => '',
    'description' => '',
];

// Procesar y sanitizar los filtros de búsqueda
foreach ($filters as $key => &$value) {
    if (isset($_GET[$key]) && $_GET[$key] !== '') {
        $value = sanitizeInput($_GET[$key], $con);
        $param++;
    }
}

// Inicializar consultas condicionales
$sqlConditions = [];
$sqlParams = [];
$ch = [];					
						
if ($filters['stage2'] !== '') {
	$ch[] = "&stage2=$filters[stage2]";
    $sqlConditions[] = "times.stage = ?";
    $sqlParams[] = $filters['stage2'];
	$joinTimes = 1; 
	$iStage++;
}
if ($filters['from'] !== '') {
	$ch[] = "&from=$filters[from]";
    $sqlConditions[] = "times.today >= ?";
    $sqlParams[] = date("Y-m-d", strtotime($filters['from']));
	$joinTimes = 1;
	$iStage++;
}

if ($filters['to'] !== '') {
	$ch[] = "&to=$filters[to]";
    $sqlConditions[] = "times.today <= ?";
    $sqlParams[] = date("Y-m-d", strtotime($filters['to']));
	$joinTimes = 1;
	$iStage++;
}

if ($filters['provider'] !== '') {
	$ch[] = "&provider=$filters[provider]";
    $sqlConditions[] = "payments.provider = ?";
    $sqlParams[] = $filters['provider'];
}

if ($filters['request'] !== '') {
	$ch[] = "&request=$filters[request]";
    $sqlConditions[] = "payments.id = ?";
    $sqlParams[] = $filters['request'];
}
						
if ($filters['bill'] !== '') {
	$ch[] = "&bill=$filters[bill]";
    $sqlConditions[] = "bills.number = ?";
    $sqlParams[] = $filters['bill'];
	$joinBills = 1;
}
						
if ($filters['worker'] !== '') {
	$ch[] = "&worker=$filters[worker]";
    $sqlConditions[] = "payments.collaborator = ?";
    $sqlParams[] = $filters['worker'];
}						

if ($filters['requester'] !== '') {
	$ch[] = "&requester=$filters[requester]";
    $sqlConditions[] = "payments.userid = ?";
    $sqlParams[] = $filters['requester'];
}	
						
if ($filters['batch'] !== '') {
	$ch[] = "&batch=$filters[batch]";
    $sqlConditions[] = "batch.nobatch = ?";
    $sqlParams[] = $filters['batch'];
	$joinBatchs = 1;
}	

if ($filters['document'] !== '') {
	$ch[] = "&document=$filters[document]";
    $sqlConditions[] = "batch.nodocument = ?";
    $sqlParams[] = $filters['document'];
	$joinBatchs = 1;
}	
							
if ($filters['route'] !== '') {
	$ch[] = "&route=$filters[route]";
    $sqlConditions[] = "payments.routeid  = ?";
    $sqlParams[] = $filters['route'];
}
							
if ($filters['pcancellation'] !== '') {
	$ch[] = "&pcancellation=$filters[pcancellation]";
    $sqlConditions[] = "payments.status  = ?";
    $sqlParams[] = '14';
	$sqlConditions[] = "payments.approved  = ?";
    $sqlParams[] = '1';
}
							
if ($filters['immediate'] !== '') {
	$ch[] = "&immediate=$filters[immediate]";
    $sqlConditions[] = "payments.immediate = ?";
    $sqlParams[] = $filters['immedite'];
}
							
if ($filters['intern'] !== '') {
	$ch[] = "&intern=$filters[intern]";
    $sqlConditions[] = "payments.intern = ?";
    $sqlParams[] = $filters['intern'];
}						
							
if ($filters['company'] !== '') {
	$ch[] = "&company=$filters[company]"; 
    $sqlConditions[] = "payments.company = ?";
    $sqlParams[] = $filters['company'];
}						
							
if ($filters['client'] !== '') {
	$ch[] = "&client=$filters[client]";
    $sqlConditions[] = "payments.btype = ?";
    $sqlParams[] = '4';
	
	$sqlConditions[] = "payments.client = ?";
    $sqlParams[] = $filters['client'];
}						
							
if ($filters['ckpk'] !== '') {
	$ch[] = "&ckpk=$filters[ckpk]";
    $sqlConditions[] = "payments.cnumber = ?";
    $sqlParams[] = $filters['ckpk'];
}	
							
if ($filters['description'] !== '') {
	$ch[] = "&description=$filters[description]";
    $sqlConditions[] = "payments.description = ?";
    $sqlParams[] = $filters['description'];
}						

$joins = array();

$joins[] = " inner join times on payments.id = times.payment";
						
if($joinBills == 1){
	$joins[] = " inner join bills on payments.id = bills.payment";
}	
if($joinBatchs == 1){
	$joins[] = " left join batch on payments.id = batch.payment";
}							
						
$sqlJoin = '';
$sqlJoin = implode(' ', $joins);
						
if(($iStage > 0) and ($iStage < 3)){
	exit('<script nonce="'.$nonce.'">alert("Para utilizar rango de fechas de etapas debe de ingresar la etaopa de rango, fecha de inicio y fecha de finalizacion.");history.go(-1);</script>');
}						
						
$sqlWhere = count($sqlConditions) > 0 ? "WHERE (payments.status >= '1' or payments.status = '0.02') AND " . implode(" AND ", $sqlConditions) : "";		
						
if (isset($_SESSION['admin'], $_SESSION['dch'], $_SESSION['globalsearch']) && ($_SESSION['admin'] === "active" || $_SESSION['dch'] === "active" || $_SESSION['globalsearch'] === "active")) {
    $sqlu = "";
} else {
    $sqlu = "";
    $sqluSec = "";
    $userId = sanitizeInput($_SESSION['userid'], $con);

    // Consulta para obtener rutas
   $queryu = "
        SELECT unitid, type 
        FROM routes 
        WHERE worker = ? AND type IN (1, 2, 3, 4, 5, 19, 20, 35)
    ";
    $stmtu = $con->prepare($queryu);
    $stmtu->bind_param("s", $userId);
    $stmtu->execute();
    $resultu = $stmtu->get_result();
    $numu = $resultu->num_rows;

    if ($numu > 0) {
        $conditions = [];
        while ($rowu = $resultu->fetch_assoc()) {
            $unitId = sanitizeInput($rowu['unitid'], $con);
            if (in_array($rowu['type'], [35, 5, 19])) {
                $sqluSec = ""; // Sin condición adicional para estos tipos
            } else {
                $sqluSec = " AND times.userid = '$userId'";
            }
            $conditions[] = "(payments.routeid = '$unitId' $sqluSec)";
        }

        // Construir condición final
        $sqlu = " AND (" . implode(" OR ", $conditions) . ")";

        // Agregar filtro adicional si aplica crédito
        if (isset($credit) && $credit == 1 && ($_SESSION['credit'] === "active" || $_SESSION['admin'] === "active")) {
            #$sqlu .= " AND payments.type = '4'";
        }
    } else {
        // Sin rutas asignadas
        $sqlu = " AND payments.routeid = 'NONE'";
        if (isset($credit) && $credit == 1 && ($_SESSION['credit'] === "active" || $_SESSION['admin'] === "active")) {
            $sqlu = " AND payments.type = '4'";
        }
    }

    $stmtu->close();
}
					
$queryCount = "
    SELECT COUNT(DISTINCT times.payment) as total
    FROM payments
    $sqlJoin
	$sqlWhere
	$sqlu
";
						
$queryMain = "
    SELECT payments.id, payments.btype, payments.provider, payments.collaborator, payments.currency, payments.payment, 
           payments.bank, payments.status, payments.reference, payments.cnumber, payments.schedule, payments.approved, 
           payments.today, payments.reason, payments.parent, payments.intern, payments.routeid, payments.globalpayment, 
           payments.client, payments.d_approve, payments.description, payments.company
    FROM payments
    $sqlJoin
    $sqlWhere
	$sqlu
	GROUP BY times.payment
    ORDER BY payments.id DESC
    LIMIT ?, ?
";						
		
if(($echo == 1) and ($_SESSION['admin'] == 'active')){
	echo '$query: '.$queryMain.'<br><br>';	
}						
						
if (!empty($sqlParams)) {
   
$stmtCount = $con->prepare($queryCount);
$stmtCount->bind_param(str_repeat("s", count($sqlParams)), ...$sqlParams);
$stmtCount->execute();
$resultCount = $stmtCount->get_result();
$totalResults = $resultCount->fetch_assoc()['total'];
$stmtCount->close();

$totpagina = ceil($totalResults / $tampagina);

$sqlParams[] = $inicio;
$sqlParams[] = $tampagina;

$stmtMain = $con->prepare($queryMain);
$stmtMain->bind_param(str_repeat("s", count($sqlParams)), ...$sqlParams);
$stmtMain->execute();
$resultMain = $stmtMain->get_result();
$numMain = $resultMain->num_rows;
						
}else{
	$totalResults = 0;
	$newMessage = 'No hay ningun parametro de busqueda.';
}

echo number_format($totalResults,0); ?> Solicitudes de pagos<br> 
<? 

	?>
								<span style="font-size: 12px; color: darkgrey;"><i>Ordenadas por vencimiento</i></span>

							</div>

							

					  </div>

						<div class="portlet-body">

							<div class="table-container">
							

								<?php 													

//echo $query;
//echo "<br>".$query1;

if($totalResults > 0){  
								?>
                                <div class="table-scrollable">
                                	<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									<th width="5%">ID</th>
									<th width="38%">Beneficiario</th>
									<th width="3%">Comp</th>
									<th width="3%">Info</th>
                                    <th width="3%">Docs</th>
									<th width="10%">Total Pagar</th>
									<th width="2%">UN</th>
									<th width="11%">Vencimiento</th>
                                    <th width="15%">Estado</th>
                                    <th width="17%">Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php //echo $query1; 
    
                                $thisRoute = array();
                              
								while ($row = $resultMain->fetch_assoc()) {
								
								    $ben_name = getBen($row['parent'], $row['btype'], $row['provider'], $row['collaborator'], $row['intern'], $row['client']); 
                                    
                                    $bills = '';
                                    $queryBills = "select number from bills where payment = '$row[id]'";
                                    $resultBills = mysqli_query($con, $queryBills);
                                    while($rowBills=mysqli_fetch_array($resultBills)){
                                        $bills.= $rowBills['number'].',';
                                    }
								    $bills = substr($bills,0,-1); 
								
								?>
                                
                                <tr role="row" class="odd">
                                <td class="sorting_1"><?php echo $row['id']; ?></td>
                                
                                <td>
                                <? if($row['d_approve'] == 1) echo '<img src="../images/flag-blue.png" width="13" alt=""/> '; ?><?php if($rowprovider['flag'] == 1) echo '<img src="../images/flag.png" width="13" alt=""/>'; 
								echo $ben_name; 
									?></td>
                                <td><? if(file_exists("companies/$row[company].png")) echo "<img src='companies/$row[company].png' width='25px'>"; ?></td>
								<td><button class="btn tooltips" data-placement="right" data-original-title="<? echo $row['description']; ?>"><i class="fa fa-info"></i></button></td>
                                
                                <td><button class="btn tooltips" data-placement="right" data-original-title="<? echo $bills; ?>" onclick="showBills(<? echo $row['id']; ?>)"><i class="fa  fa-file-o"></i></button></td>
                              
                                <td>
								<?php 
									
									
									if($row['payment'] != 0.00){
										
										 #where id = '$row[currency]'
										
									if($row['parent'] == 0){
										echo $globalCurrencyPre[$row['currency']].' '.$globalCurrencySymbol[$row['currency']].''.str_replace('.00','',number_format($row['payment'], 2)); 
										if($rowcurrency['id'] == 1){
										$gtotal_nio+=$row['payment'];
									}
									if($rowcurrency['id'] == 2){
										$gtotal_usd+=$row['payment'];  
									}
									}else{
										echo $globalCurrencyPre[$row['currency']].' '.$globalCurrencySymbol[$row['currency']].''.str_replace('.00','',number_format($row['globalpayment'], 2));
										if($rowcurrency['id'] == 1){
										$gtotal_nio+=$row['globalpayment'];
									}
									if($rowcurrency['id'] == 2){
										$gtotal_usd+=$row['globalpayment'];
									}
									}
									
				
									
									} ?></td>
									<td><? 
                                    
                                    if($thisRoute[$row['routeid']] != ''){
                                        echo $thisRoute[$row['routeid']];
                                    }else{
                                        $queryThisRoute = "select newcode from units where id = '$row[routeid]'";
                                        $resultThisRoute = mysqli_query($con, $queryThisRoute);
                                        $rowThisRoute = mysqli_fetch_array($resultThisRoute);
                                        echo $thisRoute[$row['routeid']] = $rowThisRoute['newcode'];
                                    }
                                    
                                    
                                    
                                    #echo $row['route']; ?></td>
                                        <td>
										<?php 
										
										$iddelpago = $row['id'];
										echo $elvencimiento = getExpiration($iddelpago); 
										
										?></td><td>
                                        
                                       <?php 
									
									   $alert_str = "";
									
									   $alert_str = "Solicitado: ".date('d-m-Y',strtotime($row["today"]))." \\n"; 
									   if($row['approved'] == 2){
										   
										  
											$void_data = "";
											$rowreject = mysqli_fetch_array(mysqli_query($con, "select today, comment, reason from times where payment = '$row[id]' order by id desc limit 1"));	
											
											if($rowreject['comment'] != ""){
												$void_data.= $rowreject['comment']." \\n";
											}
											 $void_data.= "Motivo de Rechazo: ";
											 
											 if($row['reason'] > 0){
										   	    $rowreject0 = mysqli_fetch_array(mysqli_query($con, "select name from reason where id = '$row[reason]'"));
												$void_data.= $rowreject0['name']." \\n";
											}
											
											if($rowreject['reason'] != ""){
												$void_data.= $rowreject['reason']." \\n";
											}
											
										   
										   $alert_str.= "Rechazado: ".date('d-m-Y',strtotime($rowreject["today"]))." \\n";
										   $alert_str.= $void_data; 
									   }
										if($row['status'] >= '12'){
										   
										$alert_str.= 'Progrmado para: '.$row['schedule']." \\n";
										   
									   }
										if($row['status'] == '14'){ 
										   
										$querycancellation = "select today from times where stage = '14' and payment = '$row[id]'"; 
										$resultcancellation = mysqli_query($con, $querycancellation);
										$rowcancellation = mysqli_fetch_array($resultcancellation);
										$cancellationdate = date('d-m-Y',strtotime($rowcancellation["today"]));
										$alert_str.= "Fecha de cancelacion: ".$cancellationdate." \\n";
										$alert_str.= "CKPK: ".$row['cnumber']." \\n";
										
										$querybank = "select name from banks where id = '$row[bank]'";
										$resultbank = mysqli_query($con, $querybank);
										$rowbank = mysqli_fetch_array($resultbank);
										$cancellationbank = $rowbank['name']." \\n";
										$alert_str.= "Banco: ".$cancellationbank;
										$cancellationref = $row["reference"]." \\n"; 
									    $alert_str.= "Referencia: ".$cancellationref." \n"; 
											
									   }
									   
										?>
                                    <a href="javascript:alert('<?php echo $alert_str; ?>');"><?php  
										
				                    $querystatus = "select * from times where payment = '$row[id]' order by id desc";
									$resultstatus = mysqli_query($con, $querystatus);
                                    $rowstatus = mysqli_fetch_array($resultstatus);
                                    if($row['status'] == "0.02"){  
										echo '<button type="button" class="btn red">Bloqueado</button>';
									}elseif(($rowstatus['stage2'] != "0.00") and ($rowstatus['stage2'] != "")){  
								        $color == "yellow";
								        if($rowstatus['color'] != ""){
									       $color = $rowstatus['color']; 
								        }
								        echo '<button type="button" class="btn '.$color.'">'.$rowstatus['stage2'].'</button>';
							        }else{
                                        $querystage = "select * from stages where id = '$rowstatus[stage]'";
								        $resultstage = mysqli_query($con, $querystage);
                                        $rowstage = mysqli_fetch_array($resultstage);
                                        echo $rowstage['content'];
                                    }
                                    
                                    echo "</a>"; ?>
                                        
                            </td><td>
                            <?php if(($row['status'] == 0)){ /* ?> 
                            <a href="payment-order.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-edit"></i> Completar</a>
                             <a href="javascript:deletePayment(<?php echo $row['id']; ?>);"><span class="label label-danger">
									<i class="fa fa-trash-o"></i>  Eliminar </span></a>
                                    <script>
									function deletePayment(id){
		if (confirm("Usted desea eliminar este pago\n- Si usted no desea eliminar este pago presione cancelar.")==true){
			window.location="payments-delete.php?id="+id;	
	} 
}

									</script>
                            
                           <?php */ }else{ ?>  
                            <a href="payment-order-view.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                            <?php } ?>
                            
                            </td></tr>
                                    <tr style="display:none;" id="dBills<? echo $row['id']; ?>">
                                        <td colspan="10"> <? echo $bills; ?></td>
                                    </tr>
                                    
                                <?php }
								
								?>
                               
                                   </tbody>

								</table>
	</div>
                                <? if($gtotal_nio > 0){ ?>Total Córdobas: <? echo number_format($gtotal_nio,2); ?><br><? } ?>
                                <? if($gtotal_usd > 0){ ?> Total Dólares: <? echo number_format($gtotal_usd,2); } ?>
                                
                                <div>
								<ul class="pagination pagination-lg">
								<?php 
	
								$chStr = implode('', $ch);
								$securechain = "";
								if(($_SESSION['admin'] == "active") and ($_GET['asadmin'] == 1)){
									$securechain = "&asadmin=1";
								}
								
								if($previous != ""){ ?>
                  
                 <li>
										<a href="">
										<i class="fa fa-angle-left"></i> 
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i.'</a></li>';  
		}else{
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
		  
		  echo '<li><a href="?page='.$i.$chStr.'&form=1">'.$i .'</a></li>';  
		}
    } } ?> 
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div>
                            
                                <?php } else { ?>
                                
                                <div class="note note-danger">

						<p>

							NOTA: <? if($newMessage != '') echo $newMessage; else echo 'No hay ninguna orden de pago vinculada a esta cuenta.'; ?>

						</p>

					</div>
                                <?php } ?>
                             
                                <script nonce="<?= $nonce ?>">
                                function showBills(id){
                                    $("#dBills"+id).toggle();
                                }
                                </script>
                                

						</div>

					</div>

					<!-- End: life time stats -->

				</div><?php } ?>
				
				

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

<script nonce="<?= $nonce ?>" src="../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>

<script nonce="<?= $nonce ?>" src="../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script nonce="<?= $nonce ?>" src="../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>

<script nonce="<?= $nonce ?>" src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script nonce="<?= $nonce ?>" src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>

<script nonce="<?= $nonce ?>" src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script nonce="<?= $nonce ?>" src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<script nonce="<?= $nonce ?>" src="../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>

<?php /*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ ?>

<script nonce="<?= $nonce ?>" src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script nonce="<?= $nonce ?>" type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script nonce="<?= $nonce ?>" type="text/javascript" src="../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

<script nonce="<?= $nonce ?>" type="text/javascript" src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script nonce="<?= $nonce ?>" type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script nonce="<?= $nonce ?>" src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script nonce="<?= $nonce ?>" src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script nonce="<?= $nonce ?>" src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->


<script nonce="<?= $nonce ?>" src="../assets/admin/pages/scripts/components-pickers.js"></script>

<script nonce="<?= $nonce ?>" src="../assets/admin/pages/scripts/table-managed.js"></script>


<script nonce="<?= $nonce ?>">
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
