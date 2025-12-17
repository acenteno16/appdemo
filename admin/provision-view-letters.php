<?php 

include("session-provision-bt.php");   

$id = $_GET['id']; 

$querypconfirm = "select * from letters where id = '$id'";
$resultpconfirm = mysqli_query($con, $querypconfirm);
$rowpconfirm = mysqli_fetch_array($resultpconfirm);
	
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


<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>

<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



<body class="page-header-fixed page-quick-sidebar-over-content " onLoad="javascript:reloadRouteView()"> 

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

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Transferencias Bancarias <small>Provisión</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">
					  <li>

						  <i class="fa fa-home"></i>

						  <a href="dashboard.php">Inicio</a>

						  <i class="fa fa-angle-right"></i>

						</li>

						<li>

							<a href="#">Transferencias Bancarias</a>
                             <i class="fa fa-angle-right"></i>
                             </li>

						<li>

							<a href="#">Provisionar</a>

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

										<div class="caption">

										

										</div>

										
									</div>

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

										<form name="porder" id="porder" action="provision-view-letters-code.php" class="horizontal-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
        

											<div class="form-body">

<h3 class="form-section">Información del Solicitante</h3>
<div class="row"><!--/span-->

<? include('stage-main-letters.php'); ?> 
													
													
													<div class="col-md-12">
														<?
//Declarate Vars
$color = "";  
?>
                                          
<? include('stage-times-letters.php'); ?>
													
													
													
													  <h3 class="form-section">Provisión</h3> 
                                        									<? if($rowpconfirm['intercompany'] != 1){ ?>
                                        									
                                        									  <input type="hidden" name="theaccount0" id="theaccount0" value="1">
                                         									<div id="ddistribucion0">


                                    
                                   
                                    
                                     <div class="row">
                                     
<?php //no batch ?>
<div class="col-md-3 ">
									  <div class="form-group">
			    <label>No. Batch:</label>
			    											
                                        <input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
<?php //no documento ?>                                                 <div class="col-md-3 ">
									  <div class="form-group">
			    <label>No. Documento:</label>
			    											
                                        <input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
<?php //link documento ?>                                                <div class="col-md-6 ">
												  <div class="form-group">
			    <label>Link del Documento:</label>
			    											
                                                    <?php /*<input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value="">*/ ?>
                                                    <select name="linkdocument[]" class="form-control  select2me" id="linkdocument[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit 100";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>
						
                                                          
              </div>
												</div>
                                    
 
 </div>

  <div id="batchwaiter">
                                                    </div>
                                                    <div class="row"><div class="col-md-3 ">
 <button type="button" class="btn blue" onClick="addBatch();">+</button>&nbsp;<button type="button" class="btn blue" onClick="openFiles();"><i class="fa fa-search"></i> Ver archivos</button>
 <script>
 function openFiles(){
	 window.open('files.php');
 }
 </script>
 <br><br>&nbsp;</div></div>
 
  <div class="row"></div> 
  <div class="row">
  
 <?php /*
 <div class="col-md-6 ">
													  <div class="form-group">
														<label>Aprobado Danilo Chamorro:</label>
														<input type="hidden" name="fileid[]" id="fileid[]" value="<?php echo $rowfilemain['id']; ?>">
														<select name="adch" class="form-control  select2me" id="adch" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>
						
                                                          
                       <br> 

    
                                                      <!--/row--></div>
													</div>
 
 <div class="col-md-6 ">
									  <div class="form-group">
			    <label>Aprobado Danilo Chamorro:</label>
			    											
                                        <input name="adch" type="text" class="form-control" id="adch" placeholder="" value="">
						<br>
                        * <strong>Nota:</strong> Adjuntar link del archivo de correo de Don Danilo Chamorro. 
                                                          
              </div>
												</div>
 */ ?>
                                      
</div>
<?php $queryprovider2 = "select * from providers where id = '$row[provider]'";
$resultproviders2 = mysqli_query($con, $queryprovider2);
$rowproviders2 = mysqli_fetch_array($resultproviders2);

if($rowproviders2['international'] == 1){
?>
   <div class="row"></div>
                                          <h3 class="form-section">Proveedores Internacionales</h3>
 <div class="col-md-6 ">
									  <div class="form-group">
			    <label>No. de Solicitud:</label>
			    											
                                        <input name="internationalno" type="text" class="form-control" id="internationalno" placeholder="" value=""> 
						
                                                          
              </div>
												</div>
                      <div class="col-md-6 ">
									  <div class="form-group">
			    <label>Link:</label> 
			    											
                                        <input name="internationallink" type="text" class="form-control" id="internationallink" placeholder="" value="">
						
                                                          
              </div>
												</div>
<?php }  
 ?>
 <div class="row">
<div class="col-md-12 " style="display:none;" id="cdiv">
													  <div class="form-group">
															<label class="control-label">Razón:</label>

													  <select name="reason2" class="form-control" id="reason2">
<option value="0">Otro</option>
<?php $queryreason = "select * from lettersreason"; 
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
													  </div></div>
                                                    
                                                    
   <script type="text/javascript">
var noBatch = 1;
function addBatch(){
   var newBatch = '<div class="row" id="batch'+noBatch+'"><div class="col-md-3"><div class="form-group"><input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value=""></div></div><div class="col-md-3 "><div class="form-group"><input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value=""></div></div><div class="col-md-5 "><div class="form-group"><select name="linkdocument[]" class="form-control  select2me" id="linkdocument[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"><option value=""></option><?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?><option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option><?php } ?></select></div></div><div class="col-md-1 "><div class="form-group"><button type="button" class="btn red" onclick="javascript:deleteRowBatch('+noBatch+');">-</button></div></div></div>';
     noBatch++; 
	 $("#batchwaiter").append(newBatch);
	 
	 Metronic.init(); 
  
}

function deleteRowBatch(id){
	//document.getElementById("distribution"+id).style.display = 'none';
	var node = document.getElementById("batch"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}
</script>  
  
  <div class="row">
                                                      
                                                    
  <div class="col-md-12 "><div class="form-actions right">

												
    <p>
                            
                            </p>
						    <button type="button" class="btn red" onClick="denyPayment();"><i class="fa fa-times"></i> Rechazar</button> 
                          
                              
            <script>
			
			function denyPayment(){
				
			var divdeny = document.getElementById('cdiv').style.display; 
			
			if(divdeny == 'block'){
				
				var okay = 1;
				
				//combo
				var reason2 = document.getElementById('reason2').value;
				//Comments
				var reason = document.getElementById('reason').value;
				
				if((reason2 == 0) && (reason == "")){
					var okay = 0;
					alert('Necesita sopordar la razon con un comentario.');
				}
					
				
				
				
				if(okay == 1){
				
				if (confirm("Esta usted seguro de querer rechazar esta solicitud?\n- Si usted no desea rechazar presione cancelar.")==true){
			window.location="provision-view-letters-deny.php?id=<?php echo $_GET['id']; ?>&reason="+reason+"&reason2="+reason2; 
		}else{
			document.getElementById('cdiv').style.display = "none";
		}
				}
			}else{
				alert('Para rechazar esta solicitud, usted debera de llenar la información de rechzo.');
				document.getElementById('cdiv').style.display = "block";
			}
		
			}
			
			</script>
                        
                            <button type="submit" class="btn blue"><i class="fa fa-check"></i> Provisionar</button> 
												<input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>">
                                                <input name="distributiontype" type="hidden" id="distributiontype" value="0">
  </div>
                                            </div>
                                            
                                                                                          

                                                   </div> 
                                            
                                            
                                            
                                                  

											<!--/row--><!--/row--></div>
													
													<? }else{ ?>
													<div id="ddistribucion0">


                                    
                                   
<? 
$query_bt = "select * from routes where worker = '$_SESSION[userid]' and type = '30'";  
$result_bt = mysqli_query($con, $query_bt);
$num_bt = mysqli_num_rows($result_bt);
$row_bt=mysqli_fetch_array($result_bt);
$str_units = $row_bt['access'];
$str_units_arr = explode(",", $str_units);
$str_units_arr = array_filter($str_units_arr);

//Start Origen
if(in_array($rowpconfirm['account1'],$str_units_arr)){
?>   
<input type="hidden" name="theaccount1" id="theaccount1" value="1">                                 
<div class="row">
<div class="col-md-12"><h3>Origen</h3></div> 
</div>
<div class="row">                                     
<?php //no batch ?>
<div class="col-md-3 ">
									  <div class="form-group">
			    <label>No. Batch:</label>
			    											
                                        <input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
<?php //no documento ?>
<div class="col-md-3 ">
									  <div class="form-group">
			    <label>No. Documento:</label>
			    											
                                        <input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
<?php //link documento ?>
<div class="col-md-6 ">
												  <div class="form-group">
			    <label>Link del Documento:</label>
			    											
                                                    <?php /*<input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value="">*/ ?>
                                                    <select name="linkdocument[]" class="form-control  select2me" id="linkdocument[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit 100";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>
						
                                                          
              </div>
												</div>
</div>

<div id="batchwaiter">
</div>
<div class="row"><div class="col-md-3 ">
 <button type="button" class="btn blue" onClick="addBatch();">+</button>&nbsp;<button type="button" class="btn blue" onClick="openFiles();"><i class="fa fa-search"></i> Ver archivos</button>
 <script>
 function openFiles(){
	 window.open('files.php');
 }
 </script>
 <br><br>&nbsp;</div></div>
<? 
}
//End Origen

//Start Destino
if(in_array($rowpconfirm['account2'],$str_units_arr)){
?> 
<input type="hidden" name="theaccount2" id="theaccount2" value="1">
<div class="row"></div> 
<div class="row">
<div class="col-md-12"><h3>Destino</h3></div> 
</div>
<div class="row">                                     
<?php //no batch ?>
<div class="col-md-3 ">
									  <div class="form-group">
			    <label>No. Batch:</label>
			    											
                                        <input name="nobatchd[]" type="text" class="form-control" id="nobatchd[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
<?php //no documento ?>
<div class="col-md-3 ">
									  <div class="form-group">
			    <label>No. Documento:</label>
			    											
                                        <input name="nodocumentd[]" type="text" class="form-control" id="nodocumentd[]" placeholder="" value="">
						
                                                          
              </div>
												</div>
<?php //link documento ?>
<div class="col-md-6 ">
												  <div class="form-group">
			    <label>Link del Documento:</label>
			    											
                                                    <?php /*<input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value="">*/ ?>
                                                    <select name="linkdocumentd[]" class="form-control  select2me" id="linkdocumentd[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"> 
                                           

											  <option value=""></option>
<?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit 100";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?>
												<option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option>
                                                <?php } ?>

												

											</select>
						
                                                          
              </div>
												</div>
</div>

<div id="batchwaiterd">
</div>
<div class="row"><div class="col-md-3 ">
 <button type="button" class="btn blue" onClick="addBatchd();">+</button>&nbsp;<button type="button" class="btn blue" onClick="openFiles();"><i class="fa fa-search"></i> Ver archivos</button>
 <script>
 function openFiles(){
	 window.open('files.php');
 }
 </script>
 <br><br>&nbsp;</div></div>
 
<div class="row"></div>
<? 
}
//End Destino
?>
  
<div class="row"></div>

<div class="row">
<div class="col-md-12 " style="display:none;" id="cdiv">
													  <div class="form-group">
															<label class="control-label">Razón:</label>

													  <select name="reason2" class="form-control" id="reason2">
<option value="0">Otro</option>
<?php $queryreason = "select * from lettersreason"; 
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
													  </div></div>
                                                    
                                                    
<script type="text/javascript">
var noBatch = 1;
function addBatch(){
   var newBatch = '<div class="row" id="batch'+noBatch+'"><div class="col-md-3"><div class="form-group"><input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value=""></div></div><div class="col-md-3 "><div class="form-group"><input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value=""></div></div><div class="col-md-5 "><div class="form-group"><select name="linkdocument[]" class="form-control  select2me" id="linkdocument[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"><option value=""></option><?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?><option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option><?php } ?></select></div></div><div class="col-md-1 "><div class="form-group"><button type="button" class="btn red" onclick="javascript:deleteRowBatch('+noBatch+');">-</button></div></div></div>';
     noBatch++; 
	 $("#batchwaiter").append(newBatch);
	 
	 Metronic.init(); 
  
}
function deleteRowBatch(id){
	//document.getElementById("distribution"+id).style.display = 'none';
	var node = document.getElementById("batch"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}

var noBatchd = 1;
function addBatchd(){ 
   var newBatchd = '<div class="row" id="batchd'+noBatchd+'"><div class="col-md-3"><div class="form-group"><input name="nobatchd[]" type="text" class="form-control" id="nobatchd[]" placeholder="" value=""></div></div><div class="col-md-3 "><div class="form-group"><input name="nodocumentd[]" type="text" class="form-control" id="nodocumentd[]" placeholder="" value=""></div></div><div class="col-md-5 "><div class="form-group"><select name="linkdocumentd[]" class="form-control  select2me" id="linkdocumentd[]" data-placeholder="Seleccionar..." onChange="javascript:reloadNumbers(),validateBill();"><option value=""></option><?php 
$queryfbox = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $global_limit";
$resultfbox = mysqli_query($con, $queryfbox);
while($rowfbox=mysqli_fetch_array($resultfbox)){
?><option value="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$rowfbox['url']; ?>"><?php echo $rowfbox['id']." | ".$rowfbox['title']; ?></option><?php } ?></select></div></div><div class="col-md-1 "><div class="form-group"><button type="button" class="btn red" onclick="javascript:deleteRowBatchd('+noBatchd+');">-</button></div></div></div>';
     noBatchd++; 
	 $("#batchwaiterd").append(newBatchd);
	 
	 Metronic.init(); 
  
}
function deleteRowBatchd(id){
	//document.getElementById("distribution"+id).style.display = 'none';
	var node2 = document.getElementById("batchd"+id);
if (node2.parentNode) {
  node2.parentNode.removeChild(node2);
}
}
</script>  
  
  <div class="row">
                                                      
                                                    
  <div class="col-md-12 "><div class="form-actions right">

												
    <p>
                            
                            </p>
						    <button type="button" class="btn red" onClick="denyPayment();"><i class="fa fa-times"></i> Rechazar</button> 
                          
                              
            <script>
			
			function denyPayment(){
				
			var divdeny = document.getElementById('cdiv').style.display; 
			
			if(divdeny == 'block'){
				
				var okay = 1;
				
				//combo
				var reason2 = document.getElementById('reason2').value;
				//Comments
				var reason = document.getElementById('reason').value;
				
				if((reason2 == 0) && (reason == "")){
					var okay = 0;
					alert('Necesita sopordar la razon con un comentario.');
				}
					
				
				
				
				if(okay == 1){
				
				if (confirm("Esta usted seguro de querer rechazar esta solicitud?\n- Si usted no desea rechazar presione cancelar.")==true){
			window.location="provision-view-letters-deny.php?id=<?php echo $_GET['id']; ?>&reason="+reason+"&reason2="+reason2; 
		}else{
			document.getElementById('cdiv').style.display = "none";
		}
				}
			}else{
				alert('Para rechazar esta solicitud, usted debera de llenar la información de rechzo.');
				document.getElementById('cdiv').style.display = "block";
			}
		
			}
			
			</script>
                        
                            <button type="submit" class="btn blue"><i class="fa fa-check"></i> Provisionar</button> 
												<input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>">
                                                <input name="distributiontype" type="hidden" id="distributiontype" value="0">
  </div>
                                            </div>
                                            
                                                                                          

                                                   </div> 
                                            
                                            
                                            
                                                  

											<!--/row--><!--/row--></div>
													
													<? } ?>
														
													</div>


											

										</form>

										<!-- END FORM-->

									</div>

								</div>

							</div>

							

			<script>
			function saveDraft(){
				document.getElementById('newbutton').value = "draft";
				document.forms['porder'].submit();
			}
			
			</script>
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

<?php /*<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>*/ ?> 


<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->

<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>

<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>

<script src="../assets/admin/pages/scripts/components-pickers.js"></script>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


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

    
<script type="text/javascript"> 


function reloadsconcept(nid,i){		
	$.post("reload-sconcepts.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept_"+i).innerHTML = data;
	});
	reloadsconcept2(0,i);
}

function reloadsconcept2(nid,i){		
	$.post("reload-sconcepts2.php", { variable: nid }, function(data){ 
	
	 document.getElementById("concept2_"+i).innerHTML = data;
	});
	
}

function help1(){
	alert('Si el monto no coinside con la cantidad en letras utilize esta opción.');
}

function cancelAction(){
	if (confirm("Esta Seguro de cancelar este ingreso?\n")==true){
			window.location = 'letters.php';
		}
}

function justNumbers(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }

function commas(unformatedAmmount){
    
	var floatAmmount = parseFloat(unformatedAmmount);
	var floatAmmount2 = floatAmmount.toFixed(2); 
	
	var parts = floatAmmount2.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
	var parts2 = parts.join(".");
	return parts2;  
}

function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}

function clear1(){
	document.getElementById("retention1").value = ""; 
}

function clear2(){
	document.getElementById("retention2").value = "";
}

function deleteRow(id){
	//document.getElementById("roc"+id).style.display = 'none';
	var node = document.getElementById("roc"+id);
if (node.parentNode) {
  node.parentNode.removeChild(node);
}
}

function numberFormat(unformatedNumber){
	var formatednumber = unformatedNumber.replace(',','');
	return formatednumber; 
}

function printLetter(){

	var clienttype = document.getElementById("clienttype").value;
	
	var description = document.getElementById("description").value;
	var totalbill = document.getElementById("totalbill").value;
	
	var i = 0;
	var devtype = 0;
	var radios_devtype = document.getElementsByName('devtype');

	for(i=0;i<radios_devtype.length;i++){
 		if (radios_devtype[i].checked){
  			devtype = radios_devtype[i].value;
  			break;
 		}
	}

	var currency = 0;
	var radios_currency = document.getElementsByName('currency');

	for(i=0;i<radios_currency.length;i++){
 		if (radios_currency[i].checked){
  			currency = radios_currency[i].value;
  			break;
 		}
	}


	var strdocuments = "";
	var currenttype = "";
	var currentnumber = "";
	var currenttoday = "";
	var currentamount = "";
	var currentcurrency = "";
	
	var types = "";
	var numbers = "";
	var todays = "";
	var amounts = "";
	var currencys = "";
	
	var rocnumber =  document.getElementsByName('rocnumber[]');

	for(i=0;i<rocnumber.length; i++) { 
		//Reading Values
		currenttype =  document.getElementsByName('roctype[]')[i].value;
		currentnumber = document.getElementsByName('rocnumber[]')[i].value;
		currenttoday = document.getElementsByName('roctoday[]')[i].value;
		currentamount = document.getElementsByName('rocamount[]')[i].value;
		currentcurrency = document.getElementsByName('roccurrency[]')[i].value;
		//Making the vars
		types = types+currenttype+"|||";
		numbers = numbers+currentnumber+"|||";
		todays = todays+currenttoday+"|||";
		amounts= amounts+currentamount+"|||";
		currencys= currencys+currentcurrency+"|||";	
	} 
	 
	strdocuments = "&roctype="+encodeURIComponent(types)+"&rocnumber="+encodeURIComponent(numbers)+"&roctoday="+encodeURIComponent(todays)+"&rocamount="+encodeURIComponent(amounts)+"&roccurrency="+encodeURIComponent(currencys); 
	var theroute = document.getElementById("theroute").value;

	if(clienttype == 1){
		//Si es persona natural
		var ccode = document.getElementById("ccode").value;
		var cfirst = document.getElementById("cfirst").value;
		var clast = document.getElementById("clast").value;
		var caddress = document.getElementById("caddress").value;
		var cnid = document.getElementById("cnid").value;
		var ccity = document.getElementById("ccity").value;
		var cemail = document.getElementById("cemail").value;
		var cphone = document.getElementById("cphone").value; 
		
		window.location = "payment-order-refund-pdf.php?clienttype="+encodeURIComponent(clienttype)+"&ccode="+encodeURIComponent(ccode)+"&cfirst="+encodeURIComponent(cfirst)+"&clast="+encodeURIComponent(clast)+"&caddress="+encodeURIComponent(caddress)+"&cnid="+encodeURIComponent(cnid)+"&ccity="+encodeURIComponent(ccity)+"&cemail="+encodeURIComponent(cemail)+"&cphone="+encodeURIComponent(cphone)+"&devtype="+encodeURIComponent(devtype)+"&description="+encodeURIComponent(description)+"&totalbill="+encodeURIComponent(totalbill)+"&currency="+encodeURIComponent(currency)+"&theroute="+encodeURIComponent(theroute)+strdocuments; 
	}
	if(clienttype == 2){
		//Si es persona juridica
		var ccode2 = document.getElementById("ccode2").value;
		var cname = document.getElementById("cname").value;
		var cruc = document.getElementById("cruc").value;
		var cemail2 = document.getElementById("cemail2").value;
		var cphone2 = document.getElementById("cphone2").value;
		var caddress2 = document.getElementById("caddress2").value;
		var ccity2 = document.getElementById("ccity2").value;
		var crfirst = document.getElementById("crfirst").value;
		var crlast = document.getElementById("crlast").value;
		var crnid = document.getElementById("crnid").value;
		var cremail = document.getElementById("cremail").value;
		var crphone = document.getElementById("crphone").value;
		
		window.location = "payment-order-refund-pdf-enterprise.php?clienttype="+encodeURIComponent(clienttype)+"&ccode2="+encodeURIComponent(ccode2)+"&cname="+encodeURIComponent(cname)+"&cruc="+encodeURIComponent(cruc)+"&cemail2="+encodeURIComponent(cemail2)+"&cphone2="+encodeURIComponent(cphone2)+"&caddress2="+encodeURIComponent(caddress2)+"&ccity2="+encodeURIComponent(ccity2)+"&crfirst="+encodeURIComponent(crfirst)+"&crlast="+encodeURIComponent(crlast)+"&crnid="+encodeURIComponent(crnid)+"&cremail="+encodeURIComponent(cremail)+"&crphone="+encodeURIComponent(crphone)+"&devtype="+encodeURIComponent(devtype)+"&description="+encodeURIComponent(description)+"&totalbill="+encodeURIComponent(totalbill)+"&currency="+encodeURIComponent(currency)+"&theroute="+encodeURIComponent(theroute)+strdocuments;  
	}

	
	
//End of function printLetter() 
}



var roci = <?php if($roci > 0){ echo $roci; } else{ echo '1'; } ?>;
function addroc(){
	
	//var account = document.getElementsByName('accounts[]')[0].value;
	var selectoR =  document.getElementsByName('pertot');
	
	for (var i = 0, length = selectoR.length; i < length; i++) {
	
	if (selectoR[i].checked) {

		if(selectoR[i].value == 1){
			var readOnly1 = "";
			var readOnly2 = "readonly";
		}else{
			var readOnly1 = "readonly";
			var readOnly2 = "";
		}
}
	
	
}   	 

   var rocboxadd = '<div class="row" id="roc'+roci+'"><div class="col-md-2 "><div class="form-group"><select name="roctype[]" class="form-control" id="roctype[]"><option value="0" selected>Seleccionar</option><option value="1">ROC</option><option value="2">Factura</option> </select> </div></div><div class="col-md-2 "><div class="form-group"><input name="rocnumber[]" type="text" class="form-control" id="rocnumber[]" value="" onKeyUp="javascript:calculateTheTotal();" '+readOnly1+'></div></div><div class="col-md-2 "><div class="form-group"><input name="roctoday[]" type="text" class="form-control date-picker" id="roctoday[]" value=""  onKeyUp="javascript:calculateTheTotal();" readonly></div></div><div class="col-md-2 "><div class="form-group"><input name="rocamount[]" type="text" class="form-control" id="rocamount[]" value=""  onKeyUp="javascript:calculateTheTotal();" onkeypress="return justNumbers(event);" '+readOnly1+'></div></div><div class="col-md-2 "><div class="form-group"><select name="roccurrency[]" class="form-control" id="roccurrency[]"><option value="0" selected>Seleccionar</option><option value="1">Córdobas</option><option value="2">Dólares</option> </select></div></div><div class="col-md-1 "><div class="form-group"><label>&nbsp;</label><button type="button" class="btn red" onClick="javascript:deleteRow('+roci+');">-</button></div></div><input type="hidden" name="did[]" id="did[]" value="0"></div>'; 
     roci++; 
	 $("#rocwaiter").append(rocboxadd);  
	 
	 Metronic.init(); 
	 ComponentsPickers.init();
	 //init metronic core components
	
  
}
 
		
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
 <script type="application/javascript">
  
function reloadRouteView(){
	
	var myroute = document.getElementById('theroute').value; 
   $.post("reload-route.php", { myvariable: myroute, }, function(data){
	
  //alert(data); 
  document.getElementById('routeFill').innerHTML = data;
   
}); 
} 

function reloadaccount(selector,val){
	//Transsaction type (Tranferencia, Dolarizacion, Cordobización)
	var type = document.getElementById('transaction').value;
	//Si no se ha seleccionado el tipo,
	if(type == 0){ 
		alert('Debe de seleccionar un tipo de transaccion.');
		document.getElementById("account1").innerHTML = '<select name="clienttype" class="form-control" id="clienttype"><option value="0" selected>Seleccionar Tipo de Transacción</option></select>';
		document.getElementById("account2").innerHTML = '<select name="clienttype" class="form-control" id="clienttype"><option value="0" selected>Seleccionar Cuenta Origen</option></select>';
	}else{
		
		//alert('Type: '+type+' | Selector: '+selector+' | Val: '+val);
		if(selector == 2){
			document.getElementById("account2").innerHTML = '<select name="clienttype" class="form-control" id="clienttype"><option value="0" selected>Seleccionar Cuenta Origen</option></select>';
		}
		
		showTc(type);  
		
		$.post("fn-reloadaccounts.php", { type: type, selector: selector, val: val }, function(data){ 
	 		if(selector == 1){
	 			document.getElementById("account1").innerHTML = data;
				document.getElementById("account2").innerHTML = '<select name="clienttype" class="form-control" id="clienttype"><option value="0" selected>Seleccionar</option></select>';
	 		}
	 		if(selector == 2){
	 			document.getElementById("account2").innerHTML = data;
	 		}
		});
	}
	//reloadsconcept2(0,i);
}

 function showTc(theVal){
											  	//alert(theVal); 
												if((theVal == 2) || (theVal == 3)){
													document.getElementById('thetc').style.display = "block";
												}else{
													document.getElementById('thetc').style.display = "none";
												}
											  }

</script>


  
<?php 

function cleanLink($dirtyurl){ 

	$levels = explode('/', $dirtyurl);
	$levelsize = sizeof($levels);
	$levelsize = $levelsize-1;
	$cleanurl = $levels[$levelsize];
	$cleanurl = str_replace('visor.php?key=','',$cleanurl);
	
	return $cleanurl;
}



?>

<? /*
<script>
(function() {
   //Document.ready equivalent
	reloadRequirements("load");
	<? if($rowpconfirm['client'] != 0){ ?>
	clientType("load");
	benType(<? echo $rowclient['type']; ?>);
	
	<? } ?>
})();
</script>
*/ ?>