<?php 
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL); 

include("session-consultation.php");
include("functions.php");  

$today = date('Y-m-d');
$totime = date('H:i:s');

$sqlu = "";

if(($_SESSION['admin'] == "active") or ($_SESSION['dch'] == "active") or ($_SESSION['globalsearch'] == "active") or ($_SESSION["releasing_special"] == "active") or ($_SESSION["provision_global"] == "active") or ($_SESSION["auditor_report"] == "active")){
	$permission = 1;
}
else{

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
				if($numu == 1){
					$sqlu .= ")";
				}
				$firstu++;
			}elseif($firstu == $numu){ //Last
				$sqlu .= " or ((payments.routeid = '$rowu[unitid]')".$sqluSec."))";
				$firstu++;
			}else{ //Middle
				$sqlu .= " or ((payments.routeid = '$rowu[unitid]')".$sqluSec.")";
				$firstu++;
			}
		}
		
		if(($credit == 1) and (($_SESSION["credit"] == "active") or ($_SESSION['admin'] == "active"))){
			$sqlu.= " and payments.type = '4'";
		}					
	}
	else{ 
		$sqlu = "and (payments.route = 'NONE')"; 
		if(($credit == 1) and (($_SESSION["credit"] == "active") or ($_SESSION['admin'] == 'active')) ){
			$sqlu= " and payments.type = '4'";
		}
	}
} 

$join = " inner join times on payments.id = times.payment";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$echo = isset($_GET['echo']) ? intval($_GET['echo']) : 0;

$query = $con->prepare("select payments.* from payments$join where payments.id = ? $sqlu");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$num = $result->num_rows;
$row = $result->fetch_assoc();

if($echo == 1){
	echo $query;
}
if($num == 0){
	
	
	$queryReport = $con->prepare("insert into paymentsRecords (today, totime, userid, payment) values (?, ?, ?, ?)");
	$queryReport->bind_param("sssi", $today,$totime,$_SESSION['userid'],$id);
	$queryReport->execute();
	
	exit('<script>window.location = "dashboard.php";</script>');
}

$thestatus = $row['status'];



$rowtype = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[type]'"));
$rowconcept = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept]'"));
$rowconcept2 = mysqli_fetch_array(mysqli_query($con, "select * from categories where id = '$row[concept2]'"));
$rowcurrency = mysqli_fetch_array(mysqli_query($con, "select * from currency where id = '$row[currency]'"));

if($row['hc'] == 1){
	$queryHC = "select * from hc where payment = '$id'"; 
	$resultHC = mysqli_query($con, $queryHC);
	$rowHC = mysqli_fetch_array($resultHC);
}

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

<title>Aplicación de Pagos | Casa Pellas S.A. <? if($num == 0){
	echo "MAL";
}
 ?></title>

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

					Pagos <small>Visor de Solicitud de Pago</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="payments.php">Pagos</a>
                            
                            <i class="fa fa-angle-right"></i>
                            
                            </li>
                            

						<li>

							<a>Solicitudes de pagos</a>

						</li>

					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="actions">

							<?php if(($row['status'] == 5) or ($row['status'] == 6) or (($row['status'] >= 7) and ($row['status'] < 8))){ ?><a href="payment-order-generator.php?id=<?php echo $id; ?>" class="btn blue"> 
											<i class="fa fa-file-o"></i> &nbsp; Crear un nuevo pago a partir de este</a> <?php } ?>
                                            
                                             <a href="payment-print.php?id=<?php echo $id; ?>" class="btn blue"><i class="fa fa-print"></i> &nbsp; Imprimir Solicitud</a>
											<? if($row['type'] == 4){ ?> <a href="payment-order-refund-pdf-fromdb.php?id=<?php echo $id; ?>" class="btn blue"><i class="fa fa-print"></i> &nbsp; Imprimir Carta</a><? } ?>
				
							</div><br> 
            <div class="row">

				<div class="col-md-12">
                
                

					
                    
                            
                            <div class="tabbable tabbable-custom boxless tabbable-reversed">

						

				   <?php /*	<div class="col-md-6 ">
                          <?php if(($row['status'] == 5) or ($row['status'] == 6) or (($row['status'] >= 7) and ($row['status'] < 8))){ ?><a href="payment-order-generator.php?id=<?php echo $id; ?>" class="btn blue"> 
											<i class="fa fa-file-o"></i> &nbsp; Crear un nuevo pago a partir de este</a> <?php } ?> <a href="payment-print.php?id=<?php echo $id; ?>" class="btn blue"> 
											<i class="fa fa-print"></i> &nbsp; Imprimir Solicitud</a>
                                            
                                           <?php /* <a href="<?php //echo 'payment-documents-print.php' ?><?php echo 'pdf-merge/consolidated.php'; ?>?id=<?php echo $id; ?>" class="btn blue" target="_blank"> 
											<i class="fa fa-print"></i> &nbsp; Imprimir Consolidado</a> */ /*?>
                                                                                                     
	</div>*/ ?>
    
    

							

							<div class="tab-pane" id="tab_1">

								<div class="portlet box blue">

									<div class="portlet-title">

										<div class="caption">

										

										</div>

										<?php /*<div class="tools">

											<a href="javascript:;" class="collapse">

											</a>

											<a href="#portlet-config" data-toggle="modal" class="config">

											</a>

											<a href="javascript:;" class="reload">

											</a>

											<a href="javascript:;" class="remove">

											</a>

										</div>*/ ?> 

									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										

											
											<?php
										
											include("stage-main.php");  
											
											if(($row['status'] >= 8) or ($row['status'] >= 7) or ($row['status'] >= 7.01)){
												include("stage-provision.php");
											}
											if($row['status'] >= 13){
												include("stage-schedule.php");
											}
											if($row['status'] >= 14){
												include("stage-cancellation.php");  
											}
											include("stage-status.php");
										
											include("stage-remision.php");  
										
											?> 
                                 
                                 
              
                                                           
                                                            
                                                              
              <div id="row">
                    
                 
                   
<h3 class="form-section"><a id="status"></a>Ruta de pago
<?php 
$queryRouteName = "select * from units where id = '$row[routeid]'";
$resultRouteName = mysqli_query($con, $queryRouteName);
$rowRouteName = mysqli_fetch_array($resultRouteName);
if($row['ncatalog'] == 1){
	echo "$rowRouteName[newCode] | $rowRouteName[companyName] $rowRouteName[lineName] $rowRouteName[locationName]";
}else{
	echo $rowRouteName['code'].' | '.$rowRouteName['name']; if($row['headship2'] > 0) echo " (Jef. ".$row['headship2'].")"; 
}

?></h3>
                    
                    <?php if($row['routeid'] > 0){ ?>
                         <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">
									<th width="5%">Código</th>
									<th width="12%">Usuario</th>
									<th width="8%">Email</th>
									<th width="5%">Roll</th>
								</tr>

								</thead>

								<tbody> 
                        
                        <?php 
						
						if($row['headship2'] > 0){
						
						$queryroute = "select * from routes where type > 1 and unitid = '$row[routeid]' and headship = '$row[headship2]' order by type asc";
						$resultroute = mysqli_query($con, $queryroute);
						while($rowroute = mysqli_fetch_array($resultroute)){
							$queryroute2 = "select * from workers where code = '$rowroute[worker]'";
							$resultroute2 = mysqli_query($con, $queryroute2);
							$rowroute2 = mysqli_fetch_array($resultroute2);
							
							?>
                            
                            <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowroute2['code']; ?></td>
							<td><?php echo $rowroute2['first']." ".$rowroute2['last']; ?></td>
                            <td><?php echo $rowroute2['email']; ?></td>
                            <td><?php $querytype  = "select * from usertype where id = '$rowroute[type]'";
							$resulttype = mysqli_query($con, $querytype);
							$rowtype = mysqli_fetch_array($resulttype);
							echo $rowtype['name'];
							 ?></td> 
                               
                          </tr>
                          <?php }  } ?>
                          
                            <?php 
							
							$queryroute = "select * from routes where type > '1' and type < '23' and unitid = '$row[routeid]' and headship = '0' order by type asc";
							$resultroute = mysqli_query($con, $queryroute);
							while($rowroute = mysqli_fetch_array($resultroute)){
							$queryroute2 = "select * from workers where code = '$rowroute[worker]'";
							$resultroute2 = mysqli_query($con, $queryroute2);
							$rowroute2 = mysqli_fetch_array($resultroute2);
							
							?>
                            
                            <tr role="row" class="odd"><td class="sorting_1"><?php echo $rowroute2['code']; ?> <? //echo $rowroute['type']; ?></td>
							<td><?php echo $rowroute2['first']." ".$rowroute2['last']; ?></td>
                            <td><?php echo $rowroute2['email']; ?></td>
                            <td><?php $querytype  = "select * from usertype where id = '$rowroute[type]'";
							$resulttype = mysqli_query($con, $querytype);
							$rowtype = mysqli_fetch_array($resulttype);
							echo $rowtype['name'];
							 ?></td> 
                               
                          </tr>
                          <?php }  ?>
                                
                               
                                </tbody>

								</table>	
					<?php }else{ ?>
                        
                       <?php if($row['userid'] != $_SESSION['userid']){ ?> <p>Este pago no tiene ninguna ruta de pago. Favor contactarse con el Administrador.</p>
				  
				  
				  <?php }else{ ?>

<form action="payment-order-view-reload-route.php" method="post" enctype="multipart/form-data"> 
<?php $queryroutes = "select routes.* from routes inner join usertype on routes.type = usertype.id where routes.worker = '$_SESSION[userid]' and routes.type = 1 order by routes.unit";
//group by routes.unit
$resultroutes = mysqli_query($con, $queryroutes);
$numroutes = mysqli_num_rows($resultroutes);
if($numroutes > 0){

?>
<div class="row">
 
  <div class="col-md-4">
 

													  <div class="form-group">

														<label class="control-label">Lista de Rutas:</label>  

															<select name="theroute" class="form-control" id="theroute" onchange="javascript:reloadRouteView();"> 
                                                  
<option value="0" selected>Seleccionar</option> 
<?php while($rowroutes=mysqli_fetch_array($resultroutes)){ 
	
	if(strlen($rowroutes['unit']) == 2){
		$queryrname = "select * from units where code2 = '$rowroutes[unit]'";
		$resultrname = mysqli_query($con, $queryrname);
	while($rowrname = mysqli_fetch_array($resultrname)){
		$thename.=$rowrname['name'];
		$thecode = $rowrname['code2'];
	}
		
	}else{
	
	$queryrname = "select * from units where code = '$rowroutes[unit]'";
	$resultrname = mysqli_query($con, $queryrname);
	$rowrname = mysqli_fetch_array($resultrname);
	$thename = $rowrname['name'];
	$thecode = $rowrname['code'];
	}
	
	if($rowroutes['headship'] > 0){
		$queryheadship = "select * from headship where id = '$rowroutes[headship]'";
	$resultheadship = mysqli_query($con, $queryheadship);
	$rowheadship = mysqli_fetch_array($resultheadship);
	}
	
?>
<option value="<?php echo $thecode; ?>,<?php echo $rowroutes['headship']; ?>" class="<?php echo $rowpconfirm['route']; ?>" <?php if($thecode == $rowpconfirm['route']) echo 'selected'; ?>><?php echo $thecode." | ".$thename; if($rowroutes['headship'] > 0){ echo ' > '.$rowheadship['name']; } ?></option>
<?php } ?>
															</select>

													  </div>

												
                                                    
  <script type="application/javascript">
  
  function reloadRouteView(){
	
	var myroute = document.getElementById("theroute").value;
   $.post("reload-route.php", { myvariable: myroute, <? if($row['ncatalog'] == 1) echo 'newcode: 1'; ?> }, function(data){
	
  //alert(data); 
  document.getElementById('routeFill').innerHTML = data;
   
}); 
} 
  </script>
<br>

												

													</div>
                                             
                                                    
                                                    
  <div class="col-md-8" id="routeFill">
  
  
  </div>
   
                                                
                                                    
                                                    </div>
<?php } ?>
<button type="submit" class="btn blue" name="draft" id="draft"><i class="fa fa-check"></i> Actualizar ruta</button>
<span class="form-actions right">
<input type="hidden" id="theid" name="theid" value="<?php echo $id; ?>">
</span>    
 
<?php } ?>                        
                      <?php } ?>
                      
                      
<?php 
/*
if(($_SESSION['admin'] == "active")){ 

?>
                						
	<form action="payment-order-view-overprovider.php" method="post" enctype="multipart/form-data">    <div class="row">
                                <div class="col-md-12">
                                             <h3 class="form-section">Proveedor secundario</h3>  
    
 <div class="col-md-12">

													  <div class="form-group">

	<label class="control-label">Código | Nombre:</label>

						
											<select name="sprovider" class="form-control  select2me" id="sprovider" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php $queryproviders = "select * from providers where active = '1'";
$resultproviders = mysqli_query($con, $queryproviders);

while($rowproviders=mysqli_fetch_array($resultproviders)){ 

?>
												<option value="<?php echo $rowproviders['id']; ?>"<?php if($row['sprovider'] == $rowproviders['id']) echo 'selected'; ?>><?php echo $rowproviders['code']." | ".$rowproviders['name']; ?></option> 
                                                
                                                <?php } ?>

												

											</select>
											<div title="Page 5">
											  <div>
															    <div>
															     <span class="help-block">

															 Ingrese código, nombre o parte de el para filtar los resultados. <i style=" color:#FF0004;">Si no le aparece un Proveedor, consulte con el area de Tesorería.</i></span>
														        </div>
														      </div>
													    </div>
													  </div>

													</div>   
                </div></div>

<button type="submit" class="btn blue" name="draft" id="draft"><i class="fa fa-check"></i> Actualizar proveedor secundario</button>
<span class="form-actions right">
<input type="hidden" id="sid" name="sid" value="<?php echo $id; ?>">
</span>    
    </form>
										
<?php } else{ 

 $querysprovider = "select * from providers where id = '$row[sprovider]'";
			 $resultsprovider = mysqli_query($con, $querysprovider);
			 $rowsprovider = mysqli_fetch_array($resultsprovider);
			 $sprovider = $rowsprovider['name'];
			 
			 if($sprovider != ""){
			 ?>
			 
			 
 <div class="row">
                                <div class="col-md-12">
                                             <h3 class="form-section"> Proveedor Secundario</h3>  
                           
               <div class="col-md-6 ">
									  <div class="form-group">
			 <?php 
			
			 
			 //   <label>Fecha de programación:</label> ?>
			    											
             <input name="sprovider" type="text" class="form-control" id="sprovider" placeholder="" value="<?php echo $sprovider; ?>" readonly>
						
</div>
</div>            
                                             
                                             </div></div>

<?php } } */ ?>

                      
	
	
	<? if($_SESSION['admin'] == 'active'){ ?>
	<div class="row">
		<div class="col-md-12"><h3 class="form-section">Archivos adicionales <a href="javascript:void(0);" id="AdditionalFilesBtn">[+]</a></h3> </div>
	</div>  
	<form action="payment-order-view-additional-files.php"  method="post" enctype="multipart/form-data">
		<div class="note note-regular" id="aFiles" style="display: none;">  
			<div class="form-group">
				<label>URL del Archivo adicional:</label>
				<input name="fileUrl" type="text" class="form-control" id="fileUrl" placeholder="" value="">
			</div>
			<div class="form-group">
				<label>Nota:</label>
				<input name="fileComments" type="text" class="form-control" id="fileComments" placeholder="" value="">
			</div>
			<div class="col-md-12">
				<span id="fUpload"> <button type="submit" class="btn blue"><i class="fa fa-check"></i> Agregar archivo</button>
					<input name="paymentid" type="hidden" id="paymentid" value="<? echo $id; ?>">
				</span>
			</div>
			<br><br>
		</div>
	</form> <br>
	
	<script>
document.getElementById('AdditionalFilesBtn').addEventListener('click', function(e) {
    e.preventDefault();
    const capa = document.getElementById('aFiles');
    capa.style.display = (capa.style.display === 'none' || capa.style.display === '') ? 'block' : 'none';
});
</script>
	<? } ?>
	
	
	
                      <div class="row">
                                <div class="col-md-12">
                                             <h3 class="form-section">Conversación de Aprobado</h3>  
       
      <?php $queryfmessages = "select * from approvecomments where payment = '$id' order by id asc";   
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

											<a href="#" class="name" name="<?php echo "comment".$rowfmessages['id']; ?>">

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
                                <?php }else{ ?>
									
									<div class="note note-regular">NOTA: No se encontró ninguna conversación de aprobado.</div>
									<? } ?>
									
                                <br>
                              	<?php if(($row['userid'] == $_SESSION['userid']) and ($numfmessages > 0)){ ?>
                                <form method="post" enctype="multipart/form-data" action="approve-special-comments-add.php"> 
                                <textarea name="comments" id="comments" style="width:100%;"><?php echo $row['comments']; ?></textarea> <br><br>
                                <div class="form-actions right">  


												<button type="submit" class="btn blue"><i class="fa fa-comments"></i> Comentar</button> <input type="hidden" id="payment" name="payment" value="<?php echo $id; ?>">
                                                
	</div>
                                
                                </form>
								<?php } ?>                                  


                                             
</div></div>
                   
                   
                   
                   
                   <? if($_SESSION['admin'] == 'active'){ ?>
                   <div class="row">
                   <div class="col-md-12">
				   <h3 class="form-section">Cambio de Etapa</h3> 
                   
                   </div>
                   <form action="payment-order-view-stages-changer.php" class="horizontal-form" method="post" enctype="multipart/form-data"> 
<div class="col-md-12 " id="cdiv">
<div class="form-group">
<label class="control-label">Etapa:</label>
<select name="thestage" class="form-control" id="thestage">
<option value="0">Seleccionar</option>
<option value="1">Rechazado por Admin.</option>
<option value="2">Borrador</option>
<option value="3">Rechazar dependientes</option> 
<option value="6">Regresar a Aprobado1</option>  
<option value="5">Regresar a Provisión</option>  
<option value="7">Regresar a Liberación</option>  
<option value="4">Regresar a Programación</option>     

    
</select><br><br>
<label>Razon:</label>
<textarea name="reason" rows="2" class="form-control" id="reason" placeholder="Comente por que no aprueba esta solicitud de pago."></textarea><br><div class="row"></div></div></div>                          
<div class="col-md-12">
<div class="form-actions right" style="margin-left:0px;">
<span id="dapprove"> <button type="submit" class="btn blue"><i class="fa fa-check"></i> Cambiar Estado</button>
<input name="paymentid" type="hidden" id="paymentid" value="<? echo $id; ?>">
</span></div>
</div>
</form> 
                   
                   </div>
                   <? } ?>
                    </div>
 
          
 									<!--/row--><!--/row--></div>


							

										

										<!-- END FORM-->



									</div>

								</div>

							</div>

<?php	
/*
<div class="row">	
<?php if($thecomment != ""){ ?>
<div class="col-md-12 ">
<div class="note note-<?php echo $note;
?>">
<?php echo $theuser.': '.$thecomment; 
if($thereason != ""){ ?><br>
Razón: <?php echo $thereason; ?>
<?php } ?>
</div> </div>
<?php } ?>
<br><br>
				

					</div>
*/ 
?>
                    
                    
                    

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

    
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html> 